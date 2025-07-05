<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\AskepIntervensiModel;
use App\Models\AskepModel;
use App\Models\AskepSlkiluaranModel;
use App\Models\ExaminationModel;
use App\Models\PasienPenunjangModel;
use App\Models\TreatTarifModel;
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
        $visit_id = isset($formData->visit_id) ? $formData->visit_id : '';
        $isrj = isset($formData->isrj) ? $formData->isrj : '';

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
                            FROM treatment_bill tb
                            JOIN pasien p ON tb.no_registration = p.no_registration
                            JOIN clinic c ON c.clinic_id = tb.CLINIC_ID_FROM
                            JOIN class k ON tb.CLASS_ID = k.CLASS_ID
                            JOIN status_pasien s ON tb.status_pasien_id = s.STATUS_PASIEN_ID
                            WHERE tb.clinic_id = 'P013'
                            AND tb.trans_id = '$trans_id'
                            AND tb.treat_date BETWEEN '$start' AND '$end'
                            AND tb.no_registration LIKE '$no'
                            AND tb.bill_id NOT IN (
                                SELECT kode FROM sharelis.dbo.kirimlis where No_Pasien = '$no'
                            )
                            ORDER BY tb.treat_date;
                         ";

        $queryBridging = "SELECT
                            hl.nolab_lis,
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
                            AND tb.no_registration LIKE '$no'
                            AND tb.trans_id ='$trans_id'
                            AND tb.bill_id IN (SELECT kode FROM sharelis.dbo.kirimlis where No_Pasien = '$no')
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
														k.tarif_name as tarif_names,
                                                        MAX(h.reg_date) AS reg_date ,
                                                         'HASILLIS' AS source,
                                                         h.valid_user   
                                                    FROM 
                                                        sharelis.dbo.kirimlis k
                                                    JOIN 
                                                        sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
                                                    WHERE 
                                                        k.No_Pasien = '$no'
														AND k.KODE IN 
														(SELECT BILL_ID FROM TREATMENT_BILL 
															WHERE NO_REGISTRATION = '$no' AND 
															TRANS_ID = '$trans_id')
                                                    GROUP BY 
                                                        h.kode_kunjungan,  
                                                        k.No_Pasien,  
														k.tarif_name,
                                                        h.nolab_lis,
                                                        h.valid_user   
                                                    UNION ALL
                                                    SELECT
                                                    PP.BILL_ID,
                                                    PP.No_REGISTRATION,
                                                    PP.nOTA_NO,
                                                    TB.TREATMENT as tarif_names,
                                                    PP.TREAT_date AS reg_date,
                                                    'PENUNJANG' AS source,
                                                    '' as valid_user   
                                                    FROM  PASIEN_PENUNJANG PP ,TREATMENT_BILL TB
                                                    WHERE TB.BILL_ID  = PP.BILL_ID AND 
                                                    PP.NO_REGISTRATION ='$no' AND
													PP.TRANS_ID = '$trans_id'AND
                                                    PP.file_image IS NOT NULL

                                                    UNION ALL

                                                SELECT  
                                                    k.nolab_lis,
                                                    MAX(k.No_Pasien) AS No_Pasien,
                                                    MAX(k.Kode_Kunjungan) AS Kode_Kunjungan,
                                                    MAX(k.tarif_name) AS tarif_names,
                                                    MAX(k.Tgl_Periksa) AS reg_date,
                                                    'KIRIMLIS' AS source,
                                                    '' as valid_user 
                                                FROM 
                                                    sharelis.dbo.kirimlis k
                                                WHERE 
                                                    k.No_Pasien = '$no'
													AND k.KODE IN 
														(SELECT BILL_ID FROM TREATMENT_BILL 
															WHERE NO_REGISTRATION = '$no' AND 
															TRANS_ID = '$trans_id')
                                                GROUP BY 
                                                    k.nolab_lis
                                    ")->getResultArray());




        $kopprint = $this->lowerKey($db->query("SELECT * from ORGANIZATIONUNIT")->getRowArray());

        $select = $this->lowerKey($db->query("SELECT * from PERDA_TARIF where PERDA_ID >=100")->getResultArray());

        $resultArray = [];

        foreach ($getDataHasilLis as $row) {
            if ($row['source'] === 'KIRIMLIS') {
                $kodeKunjungan = $row['kode_kunjungan'];
                $nolabLis = $row['nolab_lis'];
                $basePath = "\\\\192.168.100.99\\rujukan\\" . $kodeKunjungan . "\\";
                $files = glob($basePath . "*.{pdf,jpg,png}", GLOB_BRACE);

                if (!empty($files)) {
                    if (count($files) === 1) {
                        $row['tarif_names'] = basename($files[0]);
                        $resultArray[] = $row;
                    } else {
                        foreach ($files as $file) {
                            $newRow = $row;
                            $newRow['tarif_names'] = basename($file);
                            $resultArray[] = $newRow;
                        }
                    }
                }
            } else {
                $resultArray[] = $row;
            }
        }

        $getDataHasilLis = array_values($resultArray);
        $diag = [];
        $model = new ExaminationModel();
        if ($isrj == '0') {
            $diag = $model->select("teraphy_desc as diagnosa_desc")->where("visit_id = '" . $visit_id . "' and petugas_type = '11' and account_id <> 7")->orderBy("examination_date desc")->first();
        } else {
            $diag = $model->select("teraphy_desc as diagnosa_desc")->where("no_registration = '" . $no . "' and petugas_type = '11' ")->orderBy("examination_date desc")->first();
        };
        // $diag = $this->lowerKey( $db->query("SELECT TOP 1 diagnosa_desc as diagnosaDesc		
        // FROM pasien_diagnosa
        // WHERE NO_REGISTRATION = ?
        // ORDER BY DATE_OF_DIAGNOSA DESC", [$no])->getRowArray() ?? []);



        $responseData = [
            'Inspection' => $queryInspection,
            'Bridging' => $queryBridging,
            'hasilLis' => $getDataHasilLis,
            'kop' => $kopprint,
            'select' => $select,
            'diag' => $diag
        ];

        $formattedResponseData = $this->lowerKey($responseData);


        return $this->response->setStatusCode(200)->setJSON([
            'no_registration' => isset($formData->noRegis) ? $formData->noRegis : 'null',
            'value' => $formattedResponseData,

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
        $selectedInspection = isset($formData->inspection) ? $formData->inspection : [];
        $noRegistrationsList = isset($formData->noRegistrationsList) ? $formData->noRegistrationsList : [];

        if (!is_array($selectedDetails)) {
            $selectedDetails = [];
        }

        if (!is_array($selectedInspection)) {
            $selectedInspection = [];
        }

        if (!is_array($noRegistrationsList)) {
            $noRegistrationsList = [$noRegistrationsList];
        }
        $db->transBegin();

        try {

            if (count($selectedDetails) === 0 && count($noRegistrationsList) > 0) {

                $noRegistrationCodes = array_map('trim', $noRegistrationsList);
                $noRegistrationCodesString = "'" . implode("','", $noRegistrationCodes) . "'";
                $excludedBillIds = array_column($selectedInspection, 'bill_id');
                $excludedBillIdsString = "'" . implode("','", array_map('trim', $excludedBillIds)) . "'";

                $sqlDeleteOldData = "DELETE FROM sharelis.dbo.kirimlis
                WHERE kode COLLATE SQL_Latin1_General_CP1_CI_AS IN ({$excludedBillIdsString}) AND No_Pasien IN ({$noRegistrationCodesString})";

                $db->query($sqlDeleteOldData);

                $sqlUpdateBill = "UPDATE treatment_bill
                            SET quantity = 0, tagihan = 0, amount_paid = 0, amount=0, islunas = 0
                            WHERE bill_id IN ({$excludedBillIdsString}) AND NO_REGISTRATION IN ({$noRegistrationCodesString})";
                $db->query($sqlUpdateBill);
            } else {
                $noRegistrationCodes = array_map('trim', $noRegistrationsList);
                $noRegistrationCodesString = "'" . implode("','", $noRegistrationCodes) . "'";
                $excludedBillIds = array_column($selectedInspection, 'bill_id');
                $excludedBillIdsString = "'" . implode("','", array_map('trim', $excludedBillIds)) . "'";

                $sqlDeleteOldData = "DELETE FROM sharelis.dbo.kirimlis
                WHERE kode COLLATE SQL_Latin1_General_CP1_CI_AS IN ({$excludedBillIdsString}) AND No_Pasien IN ({$noRegistrationCodesString})";

                $db->query($sqlDeleteOldData);

                $sqlUpdateBill = "UPDATE treatment_bill
                            SET quantity = 0, tagihan = 0, amount_paid = 0, amount=0, islunas = 0
                            WHERE bill_id IN ({$excludedBillIdsString}) AND NO_REGISTRATION IN ({$noRegistrationCodesString})";
                $db->query($sqlUpdateBill);

                $tgl_skrg = date('Y-m-d H:i:s');
                foreach ($selectedDetails as $data) {

                    $billId = $data->bill_id;
                    $citoCheckbox = $data->citoCheckbox;
                    $isCito = $citoCheckbox ? 'C' : 'E';
                    $tagihan = $data->tagihan ?? 0;
                    $amount = $data->amount ?? 0;
                    $amount_sell = $data->sell_price ?? 0;


                    $sqlInsert = "INSERT INTO sharelis.dbo.kirimlis
                                (kode, modified_date, No_Pasien, NOLAB_LIS, Kode_Kunjungan, Nama, Email, Date_of_birth,
                                UmurTahun, UmurBulan, UmurHari, Gender, Alamat, Diagnosa, Tgl_Periksa, pengirim_name,
                                Kelas, kelas_name, Ruang, ruang_name, Cara_Bayar, cara_bayar_name, Kode_Tarif, IS_Inap, Status, IS_UPDATE, tarif_name, modified_by, diagnosa_desc,indication_desc)
                            SELECT
                                tb.bill_id, GETDATE(), tb.NO_REGISTRATION, 
                                FORMAT(GETDATE(), 'yyyyMMddhhmm') + tb.no_registration,
                                tb.nota_no, p.NAME_OF_PASIEN, p.email, p.date_of_birth,
                                tb.ageyear, tb.agemonth, tb.ageday, p.gender,
                                tb.theaddress, tb.DESCRIPTION, '$tgl_skrg', tb.doctor_from,
                                tb.class_id, k.name_of_class, tb.clinic_id_from, c.name_of_clinic,
                                tb.status_pasien_id, s.name_of_status_pasien, tb.tarif_id,
                                ABS(tb.isrj - 1),  CASE WHEN pp.ISCITO = 1 THEN 'C' ELSE 'E'
                                END AS ISCITO, 0, tb.treatment,
                                '$username', tb.diagnosa_desc, tb.indication_desc 
                            FROM treatment_bill tb
                            JOIN pasien p ON tb.no_registration = p.no_registration
                            JOIN clinic c ON c.clinic_id = tb.CLINIC_ID_FROM
                            JOIN class k ON tb.CLASS_ID = k.CLASS_ID
                            JOIN pasien_penunjang pp ON tb.NOTA_NO = pp.NOTA_NO
                            JOIN status_pasien s ON tb.status_pasien_id = s.STATUS_PASIEN_ID
                            WHERE tb.clinic_id = 'P013'
                            AND tb.BILL_ID = '{$billId}'";

                    $db->query($sqlInsert);



                    $sqlUpdateBill = "UPDATE treatment_bill
                            SET
                                quantity = 1,
                                islunas = '0',
                                tagihan = {$amount_sell},
                                amount_paid = {$amount_sell},
                                amount = {$amount_sell},
                                employee_id = subquery.employee_id,
                                doctor = subquery.doctor
                            FROM (
                            SELECT TOP(1) EMPLOYEE_all.EMPLOYEE_ID  as employee_id,
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
        $absoluteFilePath = $this->imageloc  . $relativeFilePath;


        if (!is_dir(dirname($absoluteFilePath))) {
            if (!mkdir(dirname($absoluteFilePath), 0755, true)) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to create directories']);
            }
        }

        try {
            $username = user()->username;

            $checkSql = "SELECT nota_no, file_image FROM pasien_penunjang WHERE nota_no = ? AND CLINIC_ID = 'P013' AND VISIT_ID = ?";
            $result = $db->query($checkSql, [$nota_no, $visitId])->getRow();

            if ($result) {

                if (!empty($result->file_image)) {
                    $oldFilePath = $this->imageloc  . $result->file_image;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $updateSql = "UPDATE pasien_penunjang SET 
                    file_image = ?
                    WHERE nota_no = ? AND CLINIC_ID = 'P013' AND VISIT_ID = ?";
                $db->query($updateSql, [$relativeFilePath, $nota_no, $visitId]);
            } else {
                $insertSql = "INSERT INTO pasien_penunjang (
                    ORG_UNIT_CODE, VISIT_ID, TRANS_ID, nota_no, DOCUMENT_ID, NO_REGISTRATION, BILL_ID, CLINIC_ID, 
                    VALIDATION, TERLAYANI, ISCITO, EMPLOYEE_ID, PATIENT_CATEGORY_ID, TREAT_DATE, DIAGNOSA_DESC, 
                    DESCRIPTIONS, THENAME, THEADDRESS, THEID, ISRJ, AGEYEAR, AGEMONTH, AGEDAY, STATUS_PASIEN_ID, 
                    GENDER, DOCTOR, CLASS_ROOM_ID, BED_ID, KELUAR_ID, PERUJUK, ALAMAT_PERUJUK, NO_SPECIMEN, 
                    MODIFIED_DATE, MODIFIED_BY, MODIFIED_FROM, VALID_DATE, VALID_USER, VALID_PASIEN, file_image
                )
                SELECT
                    I.ORG_UNIT_CODE, I.VISIT_ID, I.TRANS_ID,
                    I.NOTA_NO AS nota_no, NULL AS DOCUMENT_ID, I.NO_REGISTRATION, I.BILL_ID, I.CLINIC_ID,
                    0 AS VALIDATION, 0 AS TERLAYANI, 0 AS ISCITO, I.EMPLOYEE_ID, NULL AS PATIENT_CATEGORY_ID,
                    I.TREAT_DATE, NULL AS DIAGNOSA_DESC, NULL AS DESCRIPTIONS, I.THENAME, I.THEADDRESS, I.THEID,
                    I.ISRJ, I.AGEYEAR, I.AGEMONTH, I.AGEDAY, I.STATUS_PASIEN_ID, I.GENDER, I.DOCTOR,
                    I.CLASS_ROOM_ID, I.BED_ID, I.KELUAR_ID, I.PERUJUK, NULL AS ALAMAT_PERUJUK, NULL AS NO_SPECIMEN,
                    GETDATE() AS MODIFIED_DATE, ? AS MODIFIED_BY, I.MODIFIED_FROM, NULL AS VALID_DATE,
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

        $checkSql = "SELECT * FROM pasien_penunjang WHERE nota_no = ? AND CLINIC_ID = 'P013' AND VISIT_ID = ?";
        $result = $db->query($checkSql, [$nota_no, $visitId])->getRow();

        if ($result) {

            if (isset($result->file_image) && $result->file_image) {
                $filePath = $this->imageloc  . $result->file_image;
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
                            tb.bill_id, tb.visit_id, p.no_registration, kl.kode_kunjungan, h.Kode_Kunjungan
                        FROM 
                            treatment_bill tb
                        JOIN 
                            pasien p ON tb.no_registration = p.no_registration
                        LEFT JOIN 
                            sharelis.dbo.kirimlis kl ON tb.bill_id = kl.kode COLLATE SQL_Latin1_General_CP1_CI_AS
                        INNER JOIN 
                            sharelis.dbo.hasillis h ON kl.kode_kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS = 
                                        h.Kode_Kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS
                        WHERE 
                            tb.no_registration LIKE  ? 
                            AND tb.trans_id = ?
                            AND tb.clinic_id = 'P013'
                        ORDER BY 
                            tb.treat_date;

                        ";

        $result = $db->query($checkSql, [$no_registration, $trans_id])->getResultArray();

        $diag = $this->lowerKey($db->query("SELECT TOP 1 diagnosa_desc as diagnosaDesc		
                FROM pasien_diagnosa
                WHERE NO_REGISTRATION = ?
                ORDER BY DATE_OF_DIAGNOSA DESC", [$no_registration])->getRowArray() ?? []);

        return $this->response->setStatusCode(200)->setJSON([
            'no_registration' => isset($no_registration) ? $no_registration : 'null',
            'value' => $result,
            'diag' =>  $diag
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

    public function getDataCoverLatter()
    {
        $db       = db_connect();
        $formData = $this->request->getJSON();
        $visit_id = $formData->visit_id;

        $query = "
            SELECT *
            FROM pasien_penunjang
            WHERE VISIT_ID   = ?
            AND CLINIC_ID  = 'P013'
            AND DIAGNOSA_DESC IS NOT NULL
            AND DESCRIPTIONS IS NOT NULL
            AND DESCRIPTIONS <> 'none';
        ";

        $dataTables = $this->lowerKey(
            $db->query($query, [$visit_id])->getResultArray()
        );


        foreach ($dataTables as &$row) {
            $notaNo    = $row['nota_no'] ?? null;
            $rawSign   = $notaNo ? $this->checkSignDocs($notaNo, 14) : null;
            $sign = [];

            if (is_array($rawSign)) {
                $sign = $rawSign[0] ?? [];
            } elseif (is_object($rawSign)) {
                $sign = (array) $rawSign;
            } elseif (is_string($rawSign) && trim($rawSign) !== '') {
                $decoded = json_decode($rawSign, true);
                $sign = is_array($decoded) ? ($decoded[0] ?? []) : [];
            }

            $row['sign'] = $sign ?: (object)[];
        }
        unset($row);


        if ($dataTables) {
            return $this->response->setJSON([
                'message'    => 'successful',
                'respon'     => true,
                'dataTables' => $dataTables
            ])->setStatusCode(200);
        }

        return $this->response->setJSON([
            'message' => 'Data Tidak Ada',
            'respon'  => false
        ]);
    }


    public function actionCoverLatter()
    {
        $model = new PasienPenunjangModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $data = [];
        $date = date("Y-m-d H:i:s");
        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        $data['modified_date'] = $date;
        $data['modified_by'] = user()->username;

        if (!isset($data['nota_no'])) {
            return $this->response->setJSON([
                'message' => 'nota_no is required.',
                'respon' => false
            ])->setStatusCode(400);
        }

        $existingRecord = $model->where('nota_no', $data['nota_no'])->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);
            $model->update($existingRecord['nota_no'], $data);
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }

    public function deleteCoverLatter()
    {
        $model = new PasienPenunjangModel();

        $request = service('request');
        $formData = $request->getJSON(true);

        if (!isset($formData['nota_no'])) {
            return $this->response->setJSON(['message' => 'nota_no is required.', 'respon' => false]);
        }
        $nota_no = $formData['nota_no'];

        $existingRecord = $model->find($nota_no);

        if (!$existingRecord) {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }

        $model->delete($nota_no);

        return $this->response->setJSON(['message' => 'Data deleted successfully.', 'respon' => true]);
    }

    public function deleteAllPenunjang()
    {
        $model = new PasienPenunjangModel();

        $request = service('request');
        $formData = $request->getJSON(true);

        if (!isset($formData['nota_no']) || !is_array($formData['nota_no'])) {
            return $this->response->setJSON(['message' => 'nota_no is required and should be an array.', 'respon' => false]);
        }

        $nota_nos = $formData['nota_no'];

        if (empty($nota_nos) || (count($nota_nos) === 1 && $nota_nos[0] === "%")) {
            return $this->response->setJSON(['message' => 'Invalid nota_no data.', 'respon' => false]);
        }

        $builder = $model->builder();
        $builder->where('VISIT_ID', $formData['visit_id'])
            ->where('CLINIC_ID', 'P013')
            ->whereNotIn('nota_no', $nota_nos)
            ->where('DIAGNOSA_DESC', null)
            ->where('DESCRIPTIONS', null);

        $deleted = $builder->delete();

        if ($deleted) {
            return $this->response->setJSON(['message' => 'Data deleted successfully.', 'respon' => true]);
        } else {
            return $this->response->setJSON(['message' => 'Failed to delete data.', 'respon' => false]);
        }
    }

    public function getDatatariftreatData()
    {
        $searchTerm = $this->request->getGet('search');
        $orgUnitCode = $this->request->getGet('org_unit_code');

        $db = db_connect();
        $sql = "SELECT tarif_name, tarif_id, amount_paid AS amount, tarif_id, other_id, treat_id, tarif_type,
                        org_unit_code, class_id, iscito, perda_id, casemix_id
                FROM TREAT_TARIF
                WHERE perda_id >= 100 AND perda_id <= 120";

        if ($orgUnitCode !== '%') {
            $sql .= " AND org_unit_code = :orgUnitCode:";
        }

        if ($searchTerm) {
            $sql .= " AND tarif_name LIKE :searchTerm:";
            if ($orgUnitCode !== '%') {
                $query = $db->query($sql, [
                    'searchTerm' => '%' . $searchTerm . '%',
                    'orgUnitCode' => $orgUnitCode
                ]);
            } else {
                $query = $db->query($sql, ['searchTerm' => '%' . $searchTerm . '%']);
            }
        } else {
            if ($orgUnitCode !== '%') {
                $query = $db->query($sql, ['orgUnitCode' => $orgUnitCode]);
            } else {
                $query = $db->query($sql);
            }
        }

        $result = $query->getResultArray();
        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'id' => json_encode($row),
                'text' => "{$row['tarif_name']} (Rp. " . number_format($row['amount'], 2, ',', '.') . ")"
            ];
        }

        return $this->response->setJSON([
            'success' => true,
            'results' => $data
        ]);
    }


    public function getDataHasilDuplo()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        if (!isset($formData['nota_no']) || !isset($formData['no_registration']) || !isset($formData['kode_tarif'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required fields in payload',
                'data' => []
            ]);
        }

        $nota_no = $formData['nota_no'];
        $noRm = $formData['no_registration'];
        $tarifId = $formData['kode_tarif'];

        $checkSqlKirimLis = "SELECT *
                             FROM sharelis.dbo.KirimLIS 
                             WHERE no_pasien = ? AND kode_kunjungan = ? AND kode_tarif = ?";

        $result = $this->lowerKey($db->query($checkSqlKirimLis, [$noRm, $nota_no, $tarifId])->getRowArray());

        if (!$result) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan di KirimLIS',
                'data' => []
            ]);
        }

        $nolabKirim = $result['nolab_lis'];
        $tarifKirim = $result['kode_tarif'];
        $kodekjKirim = $result['kode_kunjungan'];

        $checkSqlDuplo = "SELECT tarif_id, tarif_name, parameter_name, hasil, satuan, nilai_rujukan, 
                                 FLAG_HL, DUPLO_RESULT, catatan, DUPLO_date, DUPLO_USER, *
                          FROM sharelis.dbo.hasillis 
                          WHERE NOLAB_LIS = ? AND tarif_id = ? AND KODE_KUNJUNGAN = ?";


        $resultDuplo = $this->lowerKey($db->query($checkSqlDuplo, [$nolabKirim, $tarifKirim, $kodekjKirim])->getRowArray());

        if (empty($resultDuplo)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $result,
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $resultDuplo
        ]);
    }

    public function saveToHasillist()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        $kode_kunjungan = $formData['kode_kunjungan'];
        $nolab_lis = $formData['nolab_lis'];
        $norm = $formData['norm'];
        $tarif_id = $formData['tarif_id'];

        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        $data['duplo_date'] = date('Y-m-d H:i:s');
        $data['duplo_user'] = user()->username;

        $dataRable = [
            'nolab_lis',
            'kode_kunjungan',
            'reg_date',
            'tarif_id',
            'tarif_name',
            'parameter_id',
            'parameter_name',
            'hasil',
            'satuan',
            'nilai_rujukan',
            'norm',
            'urut_bound',
            'id_hasil',
            'modified_date',
            'kel_pemeriksaan',
            'flag_hl',
            'metode_periksa',
            'catatan',
            'rekomendasi',
            'lis_id',
            'kode',
            'kode_tarif',
            'tgl_specimen',
            'tgl_hasil_selesai',
            'pengirim',
            'duplo_result',
            'duplo_user',
            'duplo_date'
        ];

        $filteredData = array_filter($data, function ($key) use ($dataRable) {
            return in_array($key, $dataRable);
        }, ARRAY_FILTER_USE_KEY);

        try {
            $checkSql = "SELECT * FROM sharelis.dbo.hasillis WHERE kode_kunjungan = ? AND nolab_lis = ? AND norm = ? AND tarif_id = ?";
            $result = $db->query($checkSql, [$kode_kunjungan, $nolab_lis, $norm, $tarif_id])->getRow();

            if ($result) {
                $updateFields = [];
                $updateValues = [];
                foreach ($filteredData as $key => $value) {
                    $updateFields[] = "$key = ?";
                    $updateValues[] = $value;
                }

                $updateSql = "UPDATE sharelis.dbo.hasillis SET " . implode(', ', $updateFields) . " WHERE kode_kunjungan = ? AND nolab_lis = ? AND norm = ? AND tarif_id = ?";
                $updateValues = array_merge($updateValues, [$kode_kunjungan, $nolab_lis, $norm, $tarif_id]);
                $db->query($updateSql, $updateValues);
            } else {
                $columns = implode(', ', array_keys($filteredData));
                $placeholders = implode(', ', array_fill(0, count($filteredData), '?'));
                $insertSql = "INSERT INTO sharelis.dbo.hasillis ($columns) VALUES ($placeholders)";

                $db->query($insertSql, array_values($filteredData));
            }

            return $this->response->setJSON(['success' => true, 'message' => 'File and data saved successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateValidation()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        if (!isset($formData['valid']) || !isset($formData['nolis']) || !isset($formData['kodeKunjungan'])) {
            return $this->response->setJSON([
                'message' => 'Invalid request data',
                'respon' => false
            ]);
        }

        $valid_user = $this->getFullnameByUsername($formData['valid']);

        if (!$valid_user) {
            return $this->response->setJSON([
                'message' => 'User not found',
                'respon' => false
            ]);
        }

        $sql = "UPDATE sharelis.dbo.hasillis 
                SET valid_user = ?, 
                    valid_date = GETDATE() 
                WHERE NOLAB_LIS = ? 
                AND KODE_KUNJUNGAN = ?";

        try {
            $query = $db->query($sql, [$valid_user, $formData['nolis'], $formData['kodeKunjungan']]);

            if ($db->affectedRows() > 0) {
                return $this->response->setJSON([
                    'message' => 'Data updated successfully.',
                    'respon' => true,
                    'data' => $formData
                ]);
            } else {
                return $this->response->setJSON([
                    'message' => 'No data updated, check input values.',
                    'respon' => false
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'message' => 'Database error: ' . $e->getMessage(),
                'respon' => false
            ]);
        }
    }

    public function getDataAllHasilLIS()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $no = isset($formData->noRegis) ? $formData->noRegis : '';
        $no = $db->escapeLikeString($no);

        $getDataHasilLis = $this->lowerKey($db->query("SELECT 
                                                         h.kode_kunjungan,
                                                         k.No_Pasien,
                                                         h.nolab_lis,
         												k.tarif_name as tarif_names,
                                                         MAX(h.reg_date) AS reg_date ,
                                                          'HASILLIS' AS source,
                                                          	h.valid_user  
                                                     FROM 
                                                         sharelis.dbo.kirimlis k
                                                     JOIN 
                                                         sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
                                                     WHERE 
                                                         k.No_Pasien = '$no'
                                                     GROUP BY 
                                                         h.kode_kunjungan,  
                                                         k.No_Pasien,  
         												k.tarif_name,
                                                         h.nolab_lis,
                                                         	h.valid_user 
                                                     UNION ALL
                                                     SELECT
                                                     PP.BILL_ID,
                                                     PP.No_REGISTRATION,
                                                     PP.nOTA_NO,
                                                     TB.TREATMENT as tarif_names,
                                                     PP.TREAT_date AS reg_date,
                                                     'PENUNJANG' AS source,
                                                     '' as valid_user   
                                                     FROM  PASIEN_PENUNJANG PP ,TREATMENT_BILL TB
                                                     WHERE TB.BILL_ID  = PP.BILL_ID AND 
                                                     PP.NO_REGISTRATION ='$no' AND
                                                     PP.file_image IS NOT NULL
 
                                                     UNION ALL
 
                                                 SELECT  
                                                     k.nolab_lis,
                                                     MAX(k.No_Pasien) AS No_Pasien,
                                                     MAX(k.Kode_Kunjungan) AS Kode_Kunjungan,
                                                     MAX(k.tarif_name) AS tarif_names,
                                                     MAX(k.Tgl_Periksa) AS reg_date,
                                                     'KIRIMLIS' AS source,
                                                     '' as valid_user 
                                                 FROM 
                                                     sharelis.dbo.kirimlis k
                                                 WHERE 
                                                     k.No_Pasien = '$no'
                                                 GROUP BY 
                                                     k.nolab_lis
                                                 ")->getResultArray());


        $select = $this->lowerKey($db->query("SELECT * from PERDA_TARIF where PERDA_ID >=100")->getResultArray());

        $resultArray = [];

        foreach ($getDataHasilLis as $row) {
            if ($row['source'] === 'KIRIMLIS') {
                $kodeKunjungan = $row['kode_kunjungan'];
                $nolabLis = $row['nolab_lis'];
                $basePath = "\\\\192.168.100.99\\rujukan\\" . $kodeKunjungan . "\\";
                $files = glob($basePath . "*.{pdf,jpg,png}", GLOB_BRACE);

                if (!empty($files)) {
                    if (count($files) === 1) {
                        $row['tarif_names'] = basename($files[0]);
                        $resultArray[] = $row;
                    } else {
                        foreach ($files as $file) {
                            $newRow = $row;
                            $newRow['tarif_names'] = basename($file);
                            $resultArray[] = $newRow;
                        }
                    }
                }
            } else {
                $resultArray[] = $row;
            }
        }

        $getDataHasilLis = array_values($resultArray);

        $responseData = [
            'hasilLis' => $getDataHasilLis,
            'select' => $select
        ];

        $formattedResponseData = $this->lowerKey($responseData);
        return $this->response->setStatusCode(200)->setJSON([
            'no_registration' => isset($formData->noRegis) ? $formData->noRegis : 'null',
            'value' => $formattedResponseData,

        ]);
    }

    public function updateCito()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        $nota_no = $formData['nota_no'] ?? null;
        $noRm = $formData['no_registration'] ?? null;
        $transId = $formData['trans_id'] ?? null;
        $visitId = $formData['visit_id'] ?? null;
        $cito = $formData['cito'] ?? null;

        $result = $this->lowerKey(
            $db->query(
                "SELECT * FROM pasien_penunjang 
                WHERE no_registration = ? AND clinic_id = 'P013' 
                AND nota_no = ? AND trans_id = ?",
                [$noRm, $nota_no, $transId]
            )->getRowArray()
        );

        if (!$result) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'data' => []
            ]);
        }

        $builder = $db->table('pasien_penunjang');
        $builder->where([
            'no_registration' => $noRm,
            'nota_no' => $nota_no,
            'trans_id' => $transId,
            'clinic_id' => 'P013'
        ]);
        $updated = $builder->update(['iscito' => $cito]);

        return $this->response->setJSON([
            'success' => $updated,
            'message' => $updated ? 'Status CITO berhasil diupdate.' : 'Gagal mengupdate data.',
            'data' => ['iscito' => $cito]
        ]);
    }


    public function getCitoPenunjang()
    {
        $db = db_connect();
        $formData = $this->request->getJSON(true);

        $noRm = $formData['no_registration'] ?? null;
        $transId = $formData['trans_id'] ?? null;

        $result = $this->lowerKey(
            $db->query(
                "SELECT DISTINCT 
                        pp.ISCITO,
                        pp.NOTA_NO
                    FROM 
                        pasien_penunjang pp
                    INNER JOIN 
                        TREATMENT_BILL tb ON tb.NOTA_NO = pp.NOTA_NO
                    WHERE 
                        pp.TRANS_ID = ?
                        AND pp.no_registration = ?
                        AND pp.CLINIC_ID = 'P013'",
                [$transId, $noRm]
            )->getResultArray()
        );
        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data ditemukan.',
                'data' => $result
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'data' => []
            ]);
        }
    }
}
