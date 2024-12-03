<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\TreatmentBillModel;
use App\Models\TreatResultModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\RawSql;
use DateTime;
use Exception;

class PenunjangMedis extends \App\Controllers\BaseController
{

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $treat_bound = $this->lowerKey($db->query("select reagent_id,description from TREAT_BOUND_DIAGNOSA where tarif_id = '$formData->tarif_id'")->getResultArray() ?? []);
        $data = $this->lowerKey($db->query("select * from TREAT_RESULTS where BILL_ID = '$formData->bill_id' and tarif_id = '$formData->tarif_id' and (CLINIC_ID = 'P001' OR (CLINIC_ID = 'P016' AND TARIF_NAME LIKE '%USG%' OR TARIF_NAME LIKE '%EKG%' OR TARIF_NAME LIKE '%ECG%'))")->getResultArray() ?? []);
        $kopprint = $this->lowerKey($db->query("SELECT * from ORGANIZATIONUNIT")->getRowArray() ?? []);

        if (!empty($data[0]['treat_image'])) {
            $filePath = WRITEPATH . $data[0]['treat_image'];

            if (file_exists($filePath)) {
                $fileType = mime_content_type($filePath);
                $fileContent = base64_encode(file_get_contents($filePath));
                $data[0]['treat_image_base64'] = 'data:' . $fileType . ';base64,' . $fileContent;
            } else {
                $data[0]['treat_image_base64'] = null;
            }
        } else {
            $data[0]['treat_image_base64'] = null;
        }
        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'kop'    => $kopprint,
            'bound' => $treat_bound,
            'data' => $data
        ]);
    }

    public function getDataResult()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $trans_id = $formData->trans_id;
        $no_registration = $formData->no_registration;
        $visit_id = $formData->visit_id;
        $result = $this->lowerKey($db->query("SELECT
                    tb.no_registration,
                    p.name_of_pasien,
                    tb.treatment,
                    tb.bill_id,
                    c.name_of_clinic,
                    tb.treat_date,
                    tb.doctor,
                    tb.tagihan,
                    tb.visit_id,
                    tb.isrj,
                    tr.isvalid,
                    tr.iskritis,
                    tb.tarif_id,
                    tb.nota_no,
                    tb.no_registration
                     from treatment_bill tb, pasien p,clinic c, status_pasien s,class k, treat_results tr
                    where tb.no_registration = p.no_registration
                    and tb.clinic_id IN ('P001', 'P016') 
                    and tb.trans_id ='$trans_id'
                    and c.clinic_id = tb.CLINIC_ID_FROM
                    and tb.CLASS_ID =k.CLASS_ID
                    and tb.bill_id = tr.bill_id
                    and (treatment LIKE '%USG%' OR treatment LIKE '%EKG%' OR treatment LIKE '%ECG%') 
                    and tb.status_pasien_id = s.STATUS_PASIEN_ID
                    AND tb.no_registration LIKE '%$no_registration%'
                    AND tb.visit_id = '$visit_id'
                    and tb.bill_id in (select bill_id from TREAT_RESULTS)
                      GROUP BY 
                        tb.bill_id,
					    tb.no_registration,
						p.name_of_pasien,
						tb.treatment,
						c.name_of_clinic,
						tb.treat_date,
						tb.doctor,
						tb.tagihan,
						tb.visit_id,
						tb.isrj,
						tr.isvalid,
						tr.iskritis,
						tb.tarif_id,
						tb.nota_no
                      ORDER BY tb.treat_date
                      ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'result'    => $result,
        ]);
    }
    public function insertData()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin(); // Start transaction
        $formData = $request->getPost();
        $formFile = $request->getFile('file');

        $formData['bound'] = json_decode($formData['bound']);
        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        $data['bound'] = array_filter($data['bound']);

        try {

            if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                $fileMimeType = $formFile->getMimeType();
                $allowedMimeTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/jpg',
                    'image/webp',
                    'application/pdf'
                ];
                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    throw new Exception('Gagal Upload File, Format tidak mendukung.');
                }
                $uploadPath = WRITEPATH . 'uploads/penunjang_medis/' . $formData['visit_id'] . '/';
                $pathInfo = pathinfo($formFile->getClientName());
                $extension = $pathInfo['extension'];

                $newFileName = $formData['bill_id'] . '.' . $extension;
                $filePath = 'uploads/penunjang_medis/' . $formData['visit_id'] . '/' . $newFileName;
                $formFile->move($uploadPath, $newFileName);

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
            }


            $getTreatment = $this->lowerKey($db->query(
                "
                SELECT 
                    I.ORG_UNIT_CODE,
                    I.NO_REGISTRATION,
                    I.VISIT_ID,
                    I.TRANS_ID,
                    CONCAT(
                        FORMAT(GETDATE(), 'yyyyMM'),
                        FORMAT(GETDATE(), 'ddHHmmss'),
                        LEFT(NEWID(), 7)
                    ) AS UniqueID,
                    I.CLINIC_ID,
                    I.BILL_ID,
                    I.PACKAGE_ID,
                    I.TARIF_ID,
                    I.TREATMENT AS DESCRIPTION,
                    I.EMPLOYEE_ID,
                    I.EMPLOYEE_ID_FROM,
                    I.TAGIHAN,
                    I.AMOUNT,
                    I.sell_price,
                    I.ISLUNAS,
                    GETDATE(),
                    I.TARIF_ID AS REAGENT_ID,
                    NULL AS BOUND_ID,
                    NULL AS DIAGNOSA, -- REAGENT_NAME
                    NULL AS SPECIMEN_ID,
                    NULL AS METHOD_ID,
                    NULL,
                    NULL,
                    NULL AS MEASURE_ID,
                    NULL AS MEASURE_ENGLISH,
                    NULL AS BOUND,
                    NULL AS CONVERSION,
                    GETDATE() AS DATE_CREATED,
                    I.MODIFIED_BY,
                    I.DOCTOR,
                    I.DOCTOR_FROM,
                    I.STATUS_PASIEN_ID,
                    I.THENAME,
                    I.THEADDRESS,
                    I.AGEYEAR,
                    I.AGEMONTH,
                    I.AGEDAY,
                    I.THEID,
                    I.GENDER,
                    '1' AS STATUS,
                    I.KAL_ID,
                    NULL AS SATUAN,
                    NULL AS SATUAN_ENG,
                    NULL AS BOUND_ENGLISH,
                    NULL AS DESC_ENGLISH,
                    I.NOTA_NO,
                    I.KUITANSI_ID,
                    I.CLASS_ROOM_ID
                FROM 
                    TREATMENT_BILL I
                WHERE 
                    I.BILL_ID = '" . $data['bill_id'] . "' -- @BILL
                    AND I.VISIT_ID = '" . $data['visit_id'] . "' -- @VISIT
                    AND I.CLINIC_ID = 'P001' -- @POLI
                    AND I.BILL_ID NOT IN (SELECT BILL_ID FROM TREAT_RESULTS)
    
                "
            )->getRowArray() ?? []);

            $model = new TreatResultModel();
            $date = date("Y-m-d H:i:s");

            $uploadFile = null;

            if (!empty($getTreatment)) {
                $getTreatment = $this->lowerKey($getTreatment);
                if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                    $uploadFile =  $uploadPath . $newFileName;
                }
                $action = '';
                $check = [];
                foreach ($data['bound'] as $value) {
                    $dataPenunjang = [
                        'org_unit_code' => $getTreatment['org_unit_code'],
                        'no_registration' => $getTreatment['no_registration'],
                        'visit_id' => $getTreatment['visit_id'],
                        'result_id' => $this->get_bodyid(),
                        'clinic_id' => $getTreatment['clinic_id'],
                        'bill_id' => $getTreatment['bill_id'],
                        'package_id' => $getTreatment['package_id'],
                        'tarif_id' => $getTreatment['tarif_id'],
                        'tarif_name' => $getTreatment['description'],
                        'employee_id' => $getTreatment['employee_id'],
                        'employee_id_from' => $getTreatment['employee_id_from'],
                        'pickup_date' => $getTreatment['date_created'],
                        'reagent_id' => $value->id,
                        'bound_id' => $getTreatment['bound_id'],
                        'reagent_name' => $getTreatment['diagnosa'],
                        'specimen_id' => null,
                        'method_id' => $getTreatment['method_id'],
                        'conclusion' => $data['conclusion'],
                        'result_value' => $value->value,
                        'measure_id' => $getTreatment['measure_id'],
                        'result_english' => null,
                        'measure_english' => null,
                        'normal_value' => null,
                        'conversion' => $getTreatment['conversion'],
                        'modified_date' => $date,
                        'modified_by' => user()->username,
                        'description' => $getTreatment['description'],
                        'doctor' => $getTreatment['doctor'],
                        'doctor_from' => $getTreatment['doctor_from'],
                        'status_pasien_id' => $getTreatment['status_pasien_id'],
                        'thename' => $getTreatment['thename'],
                        'theaddress' => $getTreatment['theaddress'],
                        'ageyear' => $getTreatment['ageyear'],
                        'agemonth' => $getTreatment['agemonth'],
                        'ageday' => $getTreatment['ageday'],
                        'theid' => $getTreatment['theid'],
                        'gender' => $getTreatment['gender'],
                        'isrj' => 1,
                        'kal_id' => $getTreatment['kal_id'],
                        'treat_image' => $uploadFile,
                        'isnew' => null,
                        'isnew_clinic' => null,
                        'isvalid' => !empty($formData['isvalid']) ? $formData['isvalid'] : 0,
                        'iskritis' => !empty($formData['iskritis']) ? $formData['iskritis'] : 0,
                        'visit_trans' => $getTreatment['nota_no'], //diambilkan dari nota no
                        'satuan' => $getTreatment['satuan'],
                        'satuan_eng' => $getTreatment['satuan_eng'],
                        'normal_english' => null,
                        'desc_english' => null,
                        'nota_no' => $getTreatment['nota_no'],
                        'kuitansi_id' => $getTreatment['kuitansi_id'],
                        'valid_date' => null,
                    ];
                    $insert = $model->insert($dataPenunjang);
                    $check[] = $insert;
                }
                $action = 'insert';
            } else {

                $getTreatment = $this->lowerKey($db->query(
                    "
                    SELECT 
                        I.ORG_UNIT_CODE,
                        I.NO_REGISTRATION,
                        I.VISIT_ID,
                        I.TRANS_ID,
                        CONCAT(
                            FORMAT(GETDATE(), 'yyyyMM'),
                            FORMAT(GETDATE(), 'ddHHmmss'),
                            LEFT(NEWID(), 7)
                        ) AS UniqueID,
                        I.CLINIC_ID,
                        I.BILL_ID,
                        I.PACKAGE_ID,
                        I.TARIF_ID,
                        I.TREATMENT AS DESCRIPTION,
                        I.EMPLOYEE_ID,
                        I.EMPLOYEE_ID_FROM,
                        I.TAGIHAN,
                        I.AMOUNT,
                        I.sell_price,
                        I.ISLUNAS,
                        GETDATE(),
                        I.TARIF_ID AS REAGENT_ID,
                        NULL AS BOUND_ID,
                        NULL AS DIAGNOSA, -- REAGENT_NAME
                        NULL AS SPECIMEN_ID,
                        NULL AS METHOD_ID,
                        NULL,
                        NULL,
                        NULL AS MEASURE_ID,
                        NULL AS MEASURE_ENGLISH,
                        NULL AS BOUND,
                        NULL AS CONVERSION,
                        GETDATE() AS DATE_CREATED,
                        I.MODIFIED_BY,
                        I.DOCTOR,
                        I.DOCTOR_FROM,
                        I.STATUS_PASIEN_ID,
                        I.THENAME,
                        I.THEADDRESS,
                        I.AGEYEAR,
                        I.AGEMONTH,
                        I.AGEDAY,
                        I.THEID,
                        I.GENDER,
                        '1' AS STATUS,
                        I.KAL_ID,
                        NULL AS SATUAN,
                        NULL AS SATUAN_ENG,
                        NULL AS BOUND_ENGLISH,
                        NULL AS DESC_ENGLISH,
                        I.NOTA_NO,
                        I.KUITANSI_ID,
                        I.CLASS_ROOM_ID
                    FROM 
                        TREATMENT_BILL I
                    WHERE 
                        I.BILL_ID = '" . $data['bill_id'] . "' -- @BILL
                        AND I.VISIT_ID = '" . $data['visit_id'] . "' -- @VISIT
                        AND (I.CLINIC_ID = 'P001' OR (I.CLINIC_ID = 'P016' AND I.TREATMENT LIKE '%USG%' OR I.TREATMENT LIKE '%EKG%' OR I.TREATMENT LIKE '%ECG%'))
                        AND I.BILL_ID IN (SELECT BILL_ID FROM TREAT_RESULTS)

                    "
                )->getRowArray() ?? []);

                if ($getTreatment['clinic_id'] == 'P001') {

                    $fileImage =  $model->where('bill_id', $data['bill_id'])->where('clinic_id', 'P001')->where('tarif_id', $getTreatment['tarif_id'])->first()['treat_image'];
                } else {

                    $fileImage =  $model->where('bill_id', $data['bill_id'])->where('clinic_id', 'P016')->where('tarif_id', $getTreatment['tarif_id'])->first()['treat_image'];
                }

                if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                    $uploadFile =  $filePath;
                } else {
                    $uploadFile = $fileImage;
                }
                if ($getTreatment['clinic_id'] == 'P001') {
                    $model->where('bill_id', $data['bill_id'])->where('clinic_id', 'P001')->where('tarif_id', $getTreatment['tarif_id'])->delete();
                    foreach ($data['bound'] as $value) {
                        $dataPenunjang = [
                            'org_unit_code' => $getTreatment['org_unit_code'],
                            'no_registration' => $getTreatment['no_registration'],
                            'visit_id' => $getTreatment['visit_id'],
                            'result_id' => $this->get_bodyid(),
                            'clinic_id' => $getTreatment['clinic_id'],
                            'bill_id' => $getTreatment['bill_id'],
                            'package_id' => $getTreatment['package_id'],
                            'tarif_id' => $getTreatment['tarif_id'],
                            'tarif_name' => $getTreatment['description'],
                            'employee_id' => $getTreatment['employee_id'],
                            'employee_id_from' => $getTreatment['employee_id_from'],
                            'pickup_date' => $getTreatment['date_created'],
                            'reagent_id' => $value->id,
                            'bound_id' => $getTreatment['bound_id'],
                            'reagent_name' => $getTreatment['diagnosa'],
                            'specimen_id' => null,
                            'method_id' => $getTreatment['method_id'],
                            'conclusion' => $data['conclusion'],
                            'result_value' => $value->value,
                            'measure_id' => $getTreatment['measure_id'],
                            'result_english' => null,
                            'measure_english' => null,
                            'normal_value' => null,
                            'conversion' => $getTreatment['conversion'],
                            'modified_date' => $date,
                            'modified_by' => user()->username,
                            'description' => $getTreatment['description'],
                            'doctor' => $getTreatment['doctor'],
                            'doctor_from' => $getTreatment['doctor_from'],
                            'status_pasien_id' => $getTreatment['status_pasien_id'],
                            'thename' => $getTreatment['thename'],
                            'theaddress' => $getTreatment['theaddress'],
                            'ageyear' => $getTreatment['ageyear'],
                            'agemonth' => $getTreatment['agemonth'],
                            'ageday' => $getTreatment['ageday'],
                            'theid' => $getTreatment['theid'],
                            'gender' => $getTreatment['gender'],
                            'isrj' => 1,
                            'kal_id' => $getTreatment['kal_id'],
                            'treat_image' => $uploadFile,
                            'isnew' => null,
                            'isnew_clinic' => null,
                            'isvalid' => !empty($formData['isvalid']) ? $formData['isvalid'] : 0,
                            'iskritis' => !empty($formData['iskritis']) ? $formData['iskritis'] : 0,
                            'visit_trans' => $getTreatment['nota_no'], //diambilkan dari nota no
                            'satuan' => $getTreatment['satuan'],
                            'satuan_eng' => $getTreatment['satuan_eng'],
                            'normal_english' => null,
                            'desc_english' => null,
                            'nota_no' => $getTreatment['nota_no'],
                            'kuitansi_id' => $getTreatment['kuitansi_id'],
                            'valid_date' => null,
                        ];
                        $insert = $model->insert($dataPenunjang);
                        $check[] = $insert;
                    }
                } else {
                    $dataUpdate = [
                        'doctor' => $getTreatment['doctor'] ?? null,
                        'conclusion' => $data['conclusion'] ?? null,
                        'result_value' => $data['bound'][0]->value ?? null,
                        'modified_date' => $date,
                        'modified_by' => user()->username,
                        'treat_image' => $uploadFile,
                        'isvalid' => $formData['isvalid'],
                        'iskritis' => $formData['iskritis'],
                    ];
                    $model->where(['bill_id' => $getTreatment['bill_id']])->where('visit_id', $getTreatment['visit_id'])->set($dataUpdate)->update();
                }
                $action = 'update';
            }

            $treat_bill = [
                'quantity' => '1',
                'tagihan' => $getTreatment['sell_price'],
                'amount' => $getTreatment['sell_price'],
                'islunas' => $formData['isvalid'] == 1 ? 2 : 0,
                'amount_paid' => $getTreatment['sell_price'],
            ];
            $bill_model = new TreatmentBillModel();
            $bill_model->where(['bill_id' => $formData['bill_id']])->where('visit_id', $formData['visit_id'])->set($treat_bill)->update();


            $db->transCommit();
            if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                unlink($fileImage);
            }
            return $this->response->setJSON([
                'message' => 'File uploaded successfully.',
                'status' => true,
                // 'file_name' => $formFile->getClientName(),
                'file_path' => $uploadFile,
                'treat_bill' => $treat_bill,
                'bill_id' => $data['bill_id'],
                'action' => $action
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'status' => false]);
        }
    }
    public function cancelTreatResult()
    {
        $db = db_connect();

        // Fetch JSON data from request
        $formData = $this->request->getJSON(true);

        // Validate the input
        if (!isset($formData['bill_id']) || !isset($formData['visit_id'])) {
            return $this->response->setJSON(['message' => 'Invalid input data.', 'status' => false]);
        }

        $billId = $formData['bill_id'];
        $visitId = $formData['visit_id'];

        // Start transaction
        $db->transBegin();

        try {
            // Prepare data for update
            $treat_bill = [
                'quantity' => '0',
                'tagihan' => 0,
                'amount' => 0,
                'islunas' => $formData['isvalid'] == 1 ? 2 : 0,
                'amount_paid' => 0,
            ];

            $model = new TreatResultModel();
            $bill_model = new TreatmentBillModel();

            // Check if the result exists
            $existData = $this->lowerKey($model->where('visit_id', $visitId)
                ->where('bill_id', $billId)
                ->first() ?? []);

            if ($existData) {
                // Delete image if exists
                if (file_exists($existData['treat_image'])) {
                    unlink($existData['treat_image']);
                }

                // Delete the result
                $model->where('result_id', $existData['result_id'])
                    ->where('visit_id', $visitId)
                    ->delete();
            }

            // Update the treatment bill
            $bill_model->where('bill_id', $billId)
                ->where('visit_id', $visitId)
                ->set($treat_bill)
                ->update();

            // Commit transaction
            $db->transCommit();

            return $this->response->setJSON([
                'message' => 'File updated and treatment cancelled successfully.',
                'status' => true,
                'data' => $treat_bill,
                'bill_id' => $billId,
            ]);
        } catch (\Exception $e) {
            // Rollback transaction on error
            $db->transRollback();

            return $this->response->setJSON([
                'message' => 'Failed to process data: ' . $e->getMessage(),
                'status' => false,
            ]);
        }
    }
}
