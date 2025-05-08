<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\TreatResultModel;
use CodeIgniter\Files\File;
use DateTime;
use Exception;

use function PHPUnit\Framework\isJson;
use function PHPUnit\Framework\throwException;

class radRequest extends \App\Controllers\BaseController
{

    public function getDataByID()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $queryInspection = "
            SELECT 
            result_value,conclusion,specimen_id,result_id, treat_image, isvalid, iskritis
            FROM 
                TREAT_RESULTS TR
            WHERE 
                TR.VISIT_ID = '" . $formData->visit_id . "' -- @VISIT
                AND TR.BILL_ID = '" . $formData->bill_id . "'
                AND TR.CLINIC_ID = 'P016' -- @POLI
                AND TR.BILL_ID IN (SELECT BILL_ID FROM TREATMENT_BILL)
        
                         ";

        $queryInspection = $this->lowerKey($db->query($queryInspection)->getRowArray() ?? []);

        if (!empty($queryInspection)) {
            return $this->response->setStatusCode(200)->setJSON([
                'data' => $queryInspection,
                'respon' => true
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            'data' => $queryInspection,
            'respon' => false
        ]);
    }


    public function getData()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();


        $start = isset($formData->startDate) ? $formData->startDate : date('Y-m-01 00:00:00');
        $end = isset($formData->endDate) ? $formData->endDate : date('Y-m-d 23:59:59');

        $start = $db->escapeString($start);
        $end = $db->escapeString($end);


        $queryInspection = "
            SELECT 
                I.ORG_UNIT_CODE,
                I.NO_REGISTRATION,
                I.VISIT_ID,
                -- Generate a unique identifier based on the current datetime and a new unique ID
                CONCAT(
                    FORMAT(GETDATE(), 'yyyyMM'),
                    FORMAT(GETDATE(), 'ddHHmmss'),
                    LEFT(NEWID(), 7)
                ) AS UniqueID,
                I.CLINIC_ID,
                I.BILL_ID,
                I.PACKAGE_ID,
                I.TARIF_ID,
                I.treat_date,
                I.TREATMENT AS DESCRIPTION,
                I.EMPLOYEE_ID,
                I.EMPLOYEE_ID_FROM,
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
                I.VISIT_ID = '" . $formData->visit_id . "' -- @VISIT
                AND I.CLINIC_ID = 'P016' -- @POLI
                AND I.treat_date BETWEEN '$start' AND '$end'
                AND I.BILL_ID NOT IN (SELECT BILL_ID FROM TREAT_RESULTS)

                 ";

        $queryExpertise = "
            SELECT 
                I.ORG_UNIT_CODE,
                I.NO_REGISTRATION,
                I.VISIT_ID,
                -- Generate a unique identifier based on the current datetime and a new unique ID
                CONCAT(
                    FORMAT(GETDATE(), 'yyyyMM'),
                    FORMAT(GETDATE(), 'ddHHmmss'),
                    LEFT(NEWID(), 7)
                ) AS UniqueID,
                I.CLINIC_ID,
                I.BILL_ID,
                I.PACKAGE_ID,
                I.TARIF_ID,
                I.treat_date,
                I.TREATMENT AS DESCRIPTION,
                I.EMPLOYEE_ID,
                I.EMPLOYEE_ID_FROM,
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
                I.VISIT_ID = '" . $formData->visit_id . "' -- @VISIT
                AND I.CLINIC_ID = 'P016' -- @POLI
                AND I.treat_date BETWEEN '$start' AND '$end'
                AND I.BILL_ID IN (SELECT BILL_ID FROM TREAT_RESULTS)
                        ";
        // var_dump('debug', "Query: $query");
        // die();

        $queryInspection = $this->lowerKey($db->query($queryInspection)->getResultArray());
        $queryExpertise = $this->lowerKey($db->query($queryExpertise)->getResultArray());

        $responseData = [
            'Inspection' => $queryInspection,
            'Expertise' => $queryExpertise
        ];

        $formattedResponseData = $this->lowerKey($responseData);
        return $this->response->setStatusCode(200)->setJSON([
            'value' => $formattedResponseData
        ]);
    }
    public function getDataTemplate()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();


        $query = "
            SELECT top(10) RADIOLOGI_BACAAN_ID,
            RADIOLOGI_BACAAN_TYPE, 
            RADIOLOGI_BACAANTYPE, 
            EMPLOYEE_ID, 
            TREATMENT, 
            HASIL_BACA, KESAN
            FROM RADIOLOGI_TEMPLATE
            WHERE 1=1 
                 ";
        if (!empty($formData->jenis_pemeriksaan)) {
            $query .= " AND RADIOLOGI_BACAANTYPE = '" . $formData->jenis_pemeriksaan . "' ";
        }

        $query = $this->lowerKey($db->query($query)->getResultArray() ?? []);
        return $this->response->setStatusCode(200)->setJSON([
            'data' => $query,
            'respon' => true
        ]);
    }
    public function insertExpertise()
    {
        $db = db_connect();

        $formData = $this->request->getPost();
        $formFile = $this->request->getFile('dokumen_expertise');

        // echo '<pre>';
        // var_dump(!empty($formFile->getSize()) && !empty($formFile->getClientName()));
        // die();
        try {
            if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                $fileMimeType = $formFile->getMimeType();
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp'];
                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    throw new Exception('Gagal Upload File, Format tidak mendukung.');
                }
                $uploadPath = 'uploads/radiologi/' . $formData['visit_id'] . '/';
                $pathInfo = pathinfo($formFile->getClientName());
                $extension = $pathInfo['extension'];

                $newFileName = $formData['bill_id'] . '.' . $extension;
                $formFile->move($uploadPath, $newFileName);
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true); // Create directory if it doesn't exist
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
                    NULL AS DESCRIPTION,
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
                    I.BILL_ID = '" . $formData['bill_id'] . "' -- @BILL
                    AND I.VISIT_ID = '" . $formData['visit_id'] . "' -- @VISIT
                    AND I.CLINIC_ID = 'P016' -- @POLI
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

                $data = [
                    'org_unit_code' => $getTreatment['org_unit_code'],
                    'no_registration' => $getTreatment['no_registration'],
                    'visit_id' => $getTreatment['visit_id'],
                    'result_id' => $getTreatment['uniqueid'],
                    'clinic_id' => $getTreatment['clinic_id'],
                    'bill_id' => $getTreatment['bill_id'],
                    'package_id' => $getTreatment['package_id'],
                    'tarif_id' => $getTreatment['tarif_id'],
                    'tarif_name' => $getTreatment['description'],
                    'employee_id' => $getTreatment['employee_id'],
                    'employee_id_from' => $getTreatment['employee_id_from'],
                    'pickup_date' => $getTreatment['date_created'],
                    'reagent_id' => $getTreatment['tarif_id'],
                    'bound_id' => $getTreatment['bound_id'],
                    'reagent_name' => $getTreatment['diagnosa'],
                    'specimen_id' => $formData['no_film'],
                    'method_id' => $getTreatment['method_id'],
                    'conclusion' => $formData['kesimpulan'],
                    'result_value' => $formData['hasil_baca'],
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
                    'visit_trans' => $getTreatment['nota_no'], //diambilkan dari nota no
                    'satuan' => $getTreatment['satuan'],
                    'satuan_eng' => $getTreatment['satuan_eng'],
                    'normal_english' => null,
                    'desc_english' => null,
                    'nota_no' => $getTreatment['nota_no'],
                    'kuitansi_id' => $getTreatment['kuitansi_id'],
                    'isvalid' => $formData['isvalid'],
                    'iskritis' => $formData['iskritis'],
                    'valid_date' => null,
                ];
                $model->insert($data);
            } else {
                $queryInspection = "
                SELECT 
                result_value,conclusion,specimen_id,result_id, treat_image, isvalid, valid_date
                FROM 
                    TREAT_RESULTS TR
                WHERE 
                    TR.VISIT_ID = '" . $formData['visit_id'] . "' -- @VISIT
                    AND TR.BILL_ID = '" . $formData['bill_id'] . "'
                    AND TR.CLINIC_ID = 'P016' -- @POLI
                    AND TR.BILL_ID IN (SELECT BILL_ID FROM TREATMENT_BILL)
            
                             ";
                $queryInspection = $this->lowerKey($db->query($queryInspection)->getRowArray() ?? []);
                if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                    $uploadFile =  $uploadPath . $newFileName;
                } else {
                    $uploadFile = $queryInspection['treat_image'];
                }

                $dataUpdate = [
                    'specimen_id' => $formData['no_film'],
                    'conclusion' => $formData['kesimpulan'],
                    'result_value' => $formData['hasil_baca'],
                    'modified_date' => $date,
                    'modified_by' => user()->username,
                    'treat_image' => $uploadFile,
                    'isvalid' => $formData['isvalid'],
                    'iskritis' => $formData['iskritis'],
                    'valid_date' => empty($queryInspection['valid_date']) ? $date : null,
                ];
                $model->where(['bill_id' => $formData['bill_id']])->where('visit_id', $formData['visit_id'])->set($dataUpdate)->update();
            }


            return $this->response->setJSON([
                'message' => 'File uploaded successfully.',
                'status' => true,
                'file_name' => $formFile->getClientName(),
                'file_path' => $uploadFile
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'status' => false]);
        }
    }
}
