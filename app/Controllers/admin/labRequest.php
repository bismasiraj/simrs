<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\AskepIntervensiModel;
use App\Models\AskepModel;
use App\Models\AskepSlkiluaranModel;
use App\Models\PasienPenunjangModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class labRequest extends \App\Controllers\BaseController
{
    public function getData()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $start = isset($formData->startDate) ? $formData->startDate : date('Y-m-01 00:00:00');
        $end = isset($formData->endDate) ? $formData->endDate : date('Y-m-d 23:59:59');
        $no = isset($formData->noRegis) ? $formData->noRegis : '';
        $trans_id = isset($formData->trans_id) ? $formData->trans_id : '';

        $start = $db->escapeString($start);
        $end = $db->escapeString($end);
        $no = $db->escapeLikeString($no);

        $queryInspection = "SELECT
                    tb.no_registration,
                    p.name_of_pasien,
                    tb.treatment,
                    tb.bill_id,
                    c.name_of_clinic,
                    tb.treat_date,
                    tb.doctor_from,
                    tb.tagihan,
                    tb.visit_id,
                    tb.isrj,
                    tb.tarif_id,
                    tb.nota_no,
                    tb.trans_id,
                    tb.sell_price
                     from treatment_bill tb, pasien p,clinic c, status_pasien s,class k
                    where tb.no_registration = p.no_registration
                    and tb.clinic_id ='P013' 
                    and tb.trans_id ='$trans_id'
                    and c.clinic_id = tb.CLINIC_ID_FROM
                    and tb.CLASS_ID =k.CLASS_ID
                    and tb.status_pasien_id = s.STATUS_PASIEN_ID
                    AND tb.treat_date BETWEEN '$start' AND '$end'
                    AND tb.no_registration LIKE '%$no%'
                    and tb.bill_id not in (select kode from sharelis.dbo.kirimlis)
                      ORDER BY tb.treat_date;
                 ";

        $queryBridging = "SELECT
                            tb.*, 
                            p.*, 
                            c.*, 
                            k.*, 
                            s.*,
                            kl.modified_by as Validation_by, 
                            CASE 
                                WHEN kl.kode IS NOT NULL AND hl.Kode_Kunjungan IS NULL THEN 0
                                ELSE 1
                            END AS checked
                        FROM
                            treatment_bill tb
                        JOIN
                            pasien p ON tb.no_registration = p.no_registration
                        JOIN
                            clinic c ON c.clinic_id = tb.clinic_id_from
                        JOIN
                            class k ON tb.class_id = k.class_id
                        JOIN
                            status_pasien s ON tb.status_pasien_id = s.status_pasien_id
                        LEFT JOIN
                            sharelis.dbo.kirimlis kl 
                            ON tb.bill_id = kl.kode COLLATE SQL_Latin1_General_CP1_CI_AS
                        LEFT JOIN
                            sharelis.dbo.hasilLIS hl 
                            ON kl.kode_kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS + kl.kode_tarif COLLATE SQL_Latin1_General_CP1_CI_AS = 
                            hl.Kode_Kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS + hl.kode_tarif COLLATE SQL_Latin1_General_CP1_CI_AS
                        WHERE
                            tb.treat_date BETWEEN '$start' AND '$end'
                            AND tb.no_registration LIKE '%$no%'
                            AND tb.trans_id ='$trans_id'
                            AND tb.bill_id IN (SELECT kode FROM sharelis.dbo.kirimlis)
                            AND tb.clinic_id = 'P013'
                        ORDER BY
                            tb.treat_date;

                    ";



        // var_dump('debug', "Query: $query");
        // die();

        $queryInspection = $this->lowerKey($db->query($queryInspection)->getResultArray());
        $queryBridging = $this->lowerKey($db->query($queryBridging)->getResultArray());

        $getDataHasilLis = $this->lowerKey($db->query("SELECT 
                                                        h.kode_kunjungan,
                                                        k.No_Pasien,
                                                        h.nolab_lis,
                                                        MAX(h.reg_date) AS reg_date  
                                                    FROM 
                                                        sharelis.dbo.kirimlis k
                                                    JOIN 
                                                        sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
                                                    WHERE 
                                                        k.No_Pasien = '$no'
                                                    GROUP BY 
                                                        h.kode_kunjungan,  
                                                        k.No_Pasien,       
                                                        h.nolab_lis;       
                                                        ")->getResultArray());

        $responseData = [
            'Inspection' => $queryInspection,
            'Bridging' => $queryBridging,
            'hasilLis' => $getDataHasilLis
        ];

        $formattedResponseData = $this->lowerKey($responseData);
        return $this->response->setStatusCode(200)->setJSON([
            'no_registration' => isset($formData->noRegis) ? $formData->noRegis : 'null',
            'value' => $formattedResponseData
        ]);
    }

    public function saveLabLIS()
    {
        $db = db_connect();
        $formData = $this->request->getJSON();
        $start = isset($formData->startDate) ? $formData->startDate : date('Y-m-01 00:00:00');
        $end = isset($formData->endDate) ? $formData->endDate : date('Y-m-d 23:59:59');
        $username = user()->username;


        $selectedDetails = isset($formData->details) ? $formData->details : [];
        $noRegistrationsList = isset($formData->noRegistrationsList) ? $formData->noRegistrationsList : [];

        if (!is_array($selectedDetails)) {
            $selectedDetails = [];
        }

        if (!is_array($noRegistrationsList)) {
            $noRegistrationsList = [$noRegistrationsList];
        }

        $db->transBegin();

        try {
            if (count($selectedDetails) === 0 && count($noRegistrationsList) > 0) {
                $noRegistrationCodes = array_map('trim', $noRegistrationsList);
                $noRegistrationCodesString = "'" . implode("','", $noRegistrationCodes) . "'";

                $sqlDeleteOldData = "DELETE FROM sharelis.dbo.kirimlis
                                        WHERE kode IN (
                                            SELECT bill_id 
                                            FROM treatment_bill 
                                            WHERE no_registration IN ({$noRegistrationCodesString}) 
                                            AND clinic_id = 'P013' 
                                            AND treat_date BETWEEN '$start' AND '$end'
                                        )
                                       AND (modified_by = '{$username}' OR modified_by IS NULL)";
                $db->query($sqlDeleteOldData);

                $sqlUpdateBill = "UPDATE treatment_bill
                        SET quantity = 0, tagihan = 0, amount_paid = 0, amount=0
                        WHERE bill_id IN (
                         SELECT bill_id FROM treatment_bill WHERE no_registration IN ({$noRegistrationCodesString}) AND clinic_id = 'P013' AND treat_date BETWEEN  '$start' AND '$end'
                    )";
                $db->query($sqlUpdateBill);
            } else {
                if (count($selectedDetails) > 0) {
                    $noRegistrationCodes = array_map(function ($item) {
                        return $item->no_registration;
                    }, $selectedDetails);

                    $noRegistrationCodesString = "'" . implode("','", $noRegistrationCodes) . "'";

                    $sqlDeleteOldData = "DELETE FROM sharelis.dbo.kirimlis
                                        WHERE kode IN (
                                            SELECT bill_id 
                                            FROM treatment_bill 
                                            WHERE no_registration IN ({$noRegistrationCodesString}) 
                                            AND clinic_id = 'P013' 
                                            AND treat_date BETWEEN '$start' AND '$end'
                                        )
                                       AND (modified_by = '{$username}' OR modified_by IS NULL)";
                    $db->query($sqlDeleteOldData);

                    $sqlUpdateBill = "UPDATE treatment_bill
                    SET quantity = 0, tagihan = 0, amount_paid = 0, amount = 0
                    WHERE bill_id IN (
                    SELECT bill_id FROM treatment_bill WHERE no_registration IN ({$noRegistrationCodesString}) AND clinic_id = 'P013' AND treat_date BETWEEN  '$start' AND '$end'
                )";
                    $db->query($sqlUpdateBill);
                }

                $tgl_skrg = date('Y-m-d H:i:s');
                foreach ($selectedDetails as $data) {
                    // if (!isset($data->bill_id, $data->tagihan, $data->amount, $data->citoCheckbox)) {
                    //     continue; 
                    // }

                    $billId = $data->bill_id;
                    $citoCheckbox = $data->citoCheckbox;
                    $isCito = $citoCheckbox ? 'C' : 'E';
                    $tagihan = $data->tagihan ?? 0;
                    $amount = $data->amount ?? 0;
                    $amount_sell = $data->sell_price ?? 0;


                    $sqlInsert = "INSERT INTO sharelis.dbo.kirimlis
                                (kode, modified_date, No_Pasien, NOLAB_LIS, Kode_Kunjungan, Nama, Email, Date_of_birth,
                                UmurTahun, UmurBulan, UmurHari, Gender, Alamat, Diagnosa, Tgl_Periksa, pengirim_name,
                                Kelas, kelas_name, Ruang, ruang_name, Cara_Bayar, cara_bayar_name, Kode_Tarif, IS_Inap, Status, IS_UPDATE, tarif_name, modified_by)
                            SELECT
                                tb.bill_id, GETDATE(), tb.NO_REGISTRATION, 
                                FORMAT(GETDATE(), 'yyyymmddhhmm') + tb.no_registration,
                                tb.nota_no, p.NAME_OF_PASIEN, p.email, p.date_of_birth,
                                tb.ageyear, tb.agemonth, tb.ageday, p.gender,
                                tb.theaddress, tb.DESCRIPTION, '$tgl_skrg', tb.doctor_from,
                                tb.class_id, k.name_of_class, tb.clinic_id_from, c.name_of_clinic,
                                tb.status_pasien_id, s.name_of_status_pasien, tb.tarif_id,
                                ABS(tb.ISRJ - 1), '{$isCito}', 0, tb.treatment,
                                '$username'  -- replace this with the actual username variable if necessary
                            FROM treatment_bill tb
                            JOIN pasien p ON tb.no_registration = p.no_registration
                            JOIN clinic c ON c.clinic_id = tb.CLINIC_ID_FROM
                            JOIN class k ON tb.CLASS_ID = k.CLASS_ID
                            JOIN status_pasien s ON tb.status_pasien_id = s.STATUS_PASIEN_ID
                            WHERE tb.clinic_id = 'P013'
                            AND tb.BILL_ID = '{$billId}'";

                    $db->query($sqlInsert);

                    $sqlUpdateBill = "UPDATE treatment_bill
                            SET 
                                quantity = 1, 
                                tagihan = {$amount_sell}, 
                                amount_paid = {$amount_sell}, 
                                amount = {$amount_sell},
                                employee_id = subquery.employee_id,
                                doctor = subquery.doctor
                            FROM (
                            sELECT top(1) EMPLOYEE_all.EMPLOYEE_ID  as employee_id,   
                                    EMPLOYEE_ALL.FULLNAME  as doctor

                                FROM DOCTOR_SCHEDULE,   
                                    EMPLOYEE_ALL  ,DAYS_NUMBER DN ,days
                                WHERE ( DOCTOR_SCHEDULE.EMPLOYEE_ID = EMPLOYEE_ALL.EMPLOYEE_ID ) and  
                                    ( ( DOCTOR_SCHEDULE.CLINIC_ID like 'P013' ) )  and
                            convert(date,the_day) = convert(date,getdate()) and 
                            DOCTOR_SCHEDULE.DAY_ID = days.DAY_ID and 
                            days.DAY_NAME = dn.NAMA_HARI
                            ) AS subquery
                            WHERE bill_id = '{$billId}';";
                    $db->query($sqlUpdateBill);
                }
            }

            $db->transCommit();
            return $this->response->setJSON(['message' => 'Data has been processed successfully', 'status' => true]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'status' => false]);
        }
    }

    public function saveImgToPenunjang()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        if (!isset($formData['dokumen_Bridge']) || !isset($formData['visit_id']) || !isset($formData['bill_id'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Missing required fields in payload']);
        }

        $fileData = $formData['dokumen_Bridge'];
        $visitId = $formData['visit_id'];
        $billId = $formData['bill_id'];
        $nota_no = $formData['nota_no'];

        if (!isset($fileData['content']) || !isset($fileData['extension']) || !isset($fileData['type'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid file data']);
        }

        $base64Content = $fileData['content'];
        $fileContent = base64_decode($base64Content);
        $fileExtension = strtolower($fileData['extension']);
        $fileType = $fileData['type'];

        $fileName = $billId . '.' . $fileExtension;
        $relativeFilePath = 'uploads/lab/' . $visitId . '/' . $fileName;
        $absoluteFilePath = WRITEPATH . $relativeFilePath;


        if (!is_dir(dirname($absoluteFilePath))) {
            if (!mkdir(dirname($absoluteFilePath), 0755, true)) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to create directories']);
            }
        }

        try {
            $username = user()->username;

            $checkSql = "SELECT BODY_ID, file_image FROM pasien_penunjang WHERE BODY_ID = ? AND CLINIC_ID = 'P013' AND VISIT_ID = ?";
            $result = $db->query($checkSql, [$nota_no, $visitId])->getRow();

            if ($result) {

                if (!empty($result->file_image)) {
                    $oldFilePath = WRITEPATH . $result->file_image;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $updateSql = "UPDATE pasien_penunjang SET 
                    file_image = ?
                    WHERE BODY_ID = ? AND CLINIC_ID = 'P013' AND VISIT_ID = ?";
                $db->query($updateSql, [$relativeFilePath, $nota_no, $visitId]);
            } else {
                $insertSql = "INSERT INTO pasien_penunjang (
                    ORG_UNIT_CODE, VISIT_ID, TRANS_ID, BODY_ID, DOCUMENT_ID, NO_REGISTRATION, BILL_ID, CLINIC_ID, 
                    VALIDATION, TERLAYANI, ISCITO, EMPLOYEE_ID, PATIENT_CATEGORY_ID, TREAT_DATE, DIAGNOSA_DESC, 
                    DESCRIPTIONS, THENAME, THEADDRESS, THEID, ISRJ, AGEYEAR, AGEMONTH, AGEDAY, STATUS_PASIEN_ID, 
                    GENDER, DOCTOR, CLASS_ROOM_ID, BED_ID, KELUAR_ID, PERUJUK, ALAMAT_PERUJUK, NO_SPECIMEN, 
                    MODIFIED_DATE, MODIFIED_BY, MODIFIED_FROM, VALID_DATE, VALID_USER, VALID_PASIEN, file_image
                )
                SELECT
                    I.ORG_UNIT_CODE, I.VISIT_ID, I.TRANS_ID,
                    I.NOTA_NO AS BODY_ID, NULL AS DOCUMENT_ID, I.NO_REGISTRATION, I.BILL_ID, I.CLINIC_ID,
                    0 AS VALIDATION, 0 AS TERLAYANI, 0 AS ISCITO, I.EMPLOYEE_ID, NULL AS PATIENT_CATEGORY_ID,
                    I.TREAT_DATE, NULL AS DIAGNOSA_DESC, NULL AS DESCRIPTIONS, I.THENAME, I.THEADDRESS, I.THEID,
                    I.ISRJ, I.AGEYEAR, I.AGEMONTH, I.AGEDAY, I.STATUS_PASIEN_ID, I.GENDER, I.DOCTOR,
                    I.CLASS_ROOM_ID, I.BED_ID, I.KELUAR_ID, I.PERUJUK, NULL AS ALAMAT_PERUJUK, NULL AS NO_SPECIMEN,
                    NOW() AS MODIFIED_DATE, ? AS MODIFIED_BY, I.MODIFIED_FROM, NULL AS VALID_DATE,
                    NULL AS VALID_USER, NULL AS VALID_PASIEN, ? AS file_image
                FROM TREATMENT_BILL I
                WHERE I.BILL_ID = ? AND I.VISIT_ID = ? AND I.CLINIC_ID = 'P013'";

                $db->query($insertSql, [$username, $relativeFilePath, $billId, $visitId]);
            }

            file_put_contents($absoluteFilePath, $fileContent);

            return $this->response->setJSON(['status' => 'success', 'message' => 'File and data saved successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getDataPenunjang()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        if (!isset($formData['nota_no']) || !isset($formData['visit_id'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Missing required fields in payload']);
        }

        $nota_no = $formData['nota_no'];
        $visitId = $formData['visit_id'];

        $checkSql = "SELECT * FROM pasien_penunjang WHERE BODY_ID = ? AND CLINIC_ID = 'P013' AND VISIT_ID = ?";
        $result = $db->query($checkSql, [$nota_no, $visitId])->getRow();

        if ($result) {
            if ($result->file_image) {
                $filePath = WRITEPATH . $result->file_image;
                if (file_exists($filePath)) {
                    $fileType = mime_content_type($filePath);
                    $fileContent = base64_encode(file_get_contents($filePath));
                    $result->file_image_base64 = 'data:' . $fileType . ';base64,' . $fileContent;
                } else {
                    $result->file_image_base64 = null;
                }
            } else {
                $result->file_image_base64 = null;
            }

            return $this->response->setJSON(['status' => 'success', 'data' => $result]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No data found for the given parameters']);
        }
    }

    public function getValidate()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        if (!isset($formData['no_registration']) || !isset($formData['trans_id'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Missing required fields in payload']);
        }

        $no_registration = $formData['no_registration'];
        $trans_id = $formData['trans_id'];

        $checkSql = "SELECT
                            tb.bill_id, 
                            tb.visit_id, 
                            p.no_registration,
                            CASE 
                                WHEN kl.kode IS NOT NULL AND hl.Kode_Kunjungan IS NULL THEN 0
                                ELSE 1
                            END AS checked
                        FROM
                            treatment_bill tb
                        JOIN
                            pasien p ON tb.no_registration = p.no_registration
                        LEFT JOIN
                            sharelis.dbo.kirimlis kl ON tb.bill_id = kl.kode COLLATE SQL_Latin1_General_CP1_CI_AS
                        LEFT JOIN
                            sharelis.dbo.hasilLIS hl 
                            ON kl.kode_kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS + kl.kode_tarif COLLATE SQL_Latin1_General_CP1_CI_AS = 
                            hl.Kode_Kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS + hl.kode_tarif COLLATE SQL_Latin1_General_CP1_CI_AS
                        WHERE
                            tb.no_registration LIKE ?
                            AND tb.trans_id = ?
                            AND tb.bill_id IN (SELECT kode FROM sharelis.dbo.kirimlis)
                            AND tb.clinic_id = 'P013'
                            AND (
                                kl.kode IS NULL 
                                OR hl.Kode_Kunjungan IS NOT NULL
                            )
                        ORDER BY
                            tb.treat_date;
                        ";
        $result = $db->query($checkSql, [$no_registration, $trans_id])->getResultArray();

        return $this->response->setStatusCode(200)->setJSON([
            'no_registration' => isset($no_registration) ? $no_registration : 'null',
            'value' => $result
        ]);
    }

    public function getDataByFilter()
    {
        $db = db_connect();
        $formData = $this->request->getJSON();

        $noPasien = $formData->no_pasien;
        $startDate = $formData->start_date;
        $endDate = $formData->end_date;
        $tarifId = $formData->tarif_id;

        $query = "SELECT H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, kel_pemeriksaan, urut_bound,
                    PARAMETER_NAME, hasil, satuan, NILAI_RUJUKAN, METODE_PERIKSA, null as kode,
                    reg_date AS tgl_hasil, norm, k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, 
                    k.pengirim_name, k.ruang_name, k.kelas_name, k.Tgl_Periksa, h.flag_hl
                        FROM sharelis.dbo.hasillis h
                        LEFT OUTER JOIN sharelis.dbo.kirimlis k 
                        ON h.norm COLLATE database_default = k.no_pasien COLLATE database_default 
                        AND H.NOLAB_LIS COLLATE database_default = K.nolab_lis COLLATE database_default 
                        AND h.TARIF_ID COLLATE database_default = k.Kode_Tarif COLLATE database_default
                        WHERE h.NORM = ? 
                        AND h.TARIF_ID = ? 
                        AND reg_date BETWEEN DATEADD(hour, 0, ?) 
                        AND DATEADD(hour, 24, COALESCE(?, GETDATE()))
                        GROUP BY H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, kel_pemeriksaan, urut_bound,
                                PARAMETER_NAME, hasil, satuan, NILAI_RUJUKAN, METODE_PERIKSA, k.Tgl_Periksa, reg_date, norm,
                                k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, k.pengirim_name, k.ruang_name, k.kelas_name, h.flag_hl
                        ORDER BY urut_bound, kode_kunjungan, tarif_id, kel_pemeriksaan";

        $dataTables = $this->lowerKey($db->query($query, [
            $noPasien,
            $tarifId,
            $startDate,
            $endDate
        ])->getResultArray());



        if ($dataTables) {
            return $this->response->setJSON([
                'message' => 'successful',
                'respon' => true,
                'dataTables' => $dataTables
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'message' => 'Data Tidak Ada',
                'respon' => false
            ]);
        }
    }
}
