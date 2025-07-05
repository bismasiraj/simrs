<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\ExaminationModel;
use App\Models\PasienPenunjangModel;
use App\Models\ResultTypeModel;
use App\Models\TreatmentBillModel;
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
                result_value, conclusion, specimen_id, result_id, treat_image, isvalid, iskritis, tarif_name, tb.diagnosa_desc, tb.indication_desc, tb.doctor, 
                file_a, file_b, file_c, file_d
            FROM 
                TREAT_RESULTS TR
				LEFT JOIN 
				 TREATMENT_BILL TB ON TB.BILL_ID = TR.BILL_ID
            WHERE 
                TR.VISIT_ID = '" . $formData->visit_id . "' -- @VISIT
                AND TR.BILL_ID = '" . $formData->bill_id . "'
                AND TR.CLINIC_ID = 'P016' -- @POLI
                AND TR.BILL_ID IN (SELECT BILL_ID FROM TREATMENT_BILL)
        ";
    
        $queryInspection = $this->lowerKey($db->query($queryInspection)->getRowArray() ?? []);
      
        if (!empty($queryInspection)) {
            $hexString = $queryInspection['treat_image'];
            $relativePath = strstr($hexString, 'uploads');

            $queryInspection['treat_image'] = !empty($relativePath) ? $this->convertToBase64($relativePath) : "";
            $queryInspection['file_a'] = !empty($queryInspection['file_a']) ? $this->convertToBase64($queryInspection['file_a']) : "";
            $queryInspection['file_b'] = !empty($queryInspection['file_b']) ? $this->convertToBase64($queryInspection['file_b']) : "";
            $queryInspection['file_c'] = !empty($queryInspection['file_c']) ? $this->convertToBase64($queryInspection['file_c']) : "";
            $queryInspection['file_d'] = !empty($queryInspection['file_d']) ? $this->convertToBase64($queryInspection['file_d']) : "";
    
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
    

    private function convertToBase64($imageName)
    {
        if (!empty($imageName)) {
            $imagePath = $this->imageloc . $imageName;
            if (file_exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                $mimeType = mime_content_type($imagePath);
                return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
            }
        }
        return null;
    }

    private function convertHexToBase64($imagePath)
    {
        if (!empty($imagePath) && file_exists($imagePath)) {
            $imageData = file_get_contents($imagePath);
            $mimeType = mime_content_type($imagePath);
            return 'data:' . $mimeType . ';base64,' . base64_encode($this->imageloc .$imageData);
        }
        return null;
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
            SELECT RADIOLOGI_BACAAN_ID,
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
        $db->transBegin(); 
        $formData = $this->request->getPost();
        $formFile = $this->request->getFile('dokumen_expertise');
        $uploadedFiles = []; 
    
        $fileKeys = [
            'dokumen_expertise1' => 'file_a',
            'dokumen_expertise2' => 'file_b',
            'dokumen_expertise3' => 'file_c',
            'dokumen_expertise4' => 'file_d'
        ];
    

 
        try {
            
            if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                $fileMimeType = $formFile->getMimeType();
           
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/webp',   'application/pdf'];
                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    throw new Exception('Gagal Upload File, Format tidak mendukung.');
                }
                $uploadPath = $this->imageloc .'uploads/radiologi/' . $formData['visit_id'] . '/';
                $pathInfo = pathinfo($formFile->getClientName());
                $extension = $pathInfo['extension'];
                $newFileName = $formData['bill_id'] . '.' . $extension;
                $filePath = $uploadPath . $newFileName;

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if (!empty($filePath) && file_exists($filePath)) {
                    unlink($filePath);
                }

                $formFile->move($uploadPath, $newFileName, true); 
            }


    
            foreach ($fileKeys as $key => $dbField) {
                $file = $this->request->getFile($key);
                if ($file->isValid() && !$file->hasMoved()) {
                    $uploadedFiles[$dbField] = $this->uploadFile($file, $formData, 'uploads/radiologi/', $dbField);
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
                    I.BILL_ID = '" . $formData['bill_id'] . "' -- @BILL
                    AND I.VISIT_ID = '" . $formData['visit_id'] . "' -- @VISIT
                    AND I.CLINIC_ID = 'P016' -- @POLI
                    AND I.BILL_ID NOT IN (SELECT BILL_ID FROM TREAT_RESULTS)
    
                "
            )->getRowArray() ?? []);
            $model = new TreatResultModel();
            $date = date("Y-m-d H:i:s");

            $cek = $model->where([
                'bill_id'   => $formData['bill_id'],
                'visit_id'  => $formData['visit_id']
            ])->first();

            $uploadFile = $filePath ?? null;
    
            if ((!$cek)) {

                $modell = new TreatResultModel();
                $date = date("Y-m-d H:i:s");
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
                        'specimen_id' => $formData['no_film'] ?? null,
                        'method_id' => $getTreatment['method_id'],
                        'conclusion' => $formData['kesimpulan'] ?? null,
                        'result_value' => $formData['hasil_baca'] ?? null,
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
                        'file_a' => isset($uploadedFiles['file_a']) ? strstr($uploadedFiles['file_a'], 'uploads/radiologi') : null,
                        'file_b' => isset($uploadedFiles['file_b']) ? strstr($uploadedFiles['file_b'], 'uploads/radiologi') : null,
                        'file_c' => isset($uploadedFiles['file_c']) ? strstr($uploadedFiles['file_c'], 'uploads/radiologi') : null,
                        'file_d' => isset($uploadedFiles['file_d']) ? strstr($uploadedFiles['file_d'], 'uploads/radiologi') : null,
                        'nota_no' => $getTreatment['nota_no'],
                        'kuitansi_id' => $getTreatment['kuitansi_id'],
                        'diagnosa_desc' => isset($formData['diagnosa_desc']) ? $formData['diagnosa_desc'] : null,
                        'indication_desc' => isset($formData['indication_desc']) ? $formData['indication_desc'] : null,
                        'isvalid' => !empty($formData['isvalid']) ? $formData['isvalid'] : 0,
                        'iskritis' => !empty($formData['iskritis']) ? $formData['iskritis'] : 0,
                        'valid_date' => null,
                    ];

                    $action = 'insert';
                // $sss = json_encode($data);
                // var_dump( $sss);
                // exit();
    
                $modell->insert($data);
            }else{
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
                        I.BILL_ID = '" . $formData['bill_id'] . "' -- @BILL
                        AND I.VISIT_ID = '" . $formData['visit_id'] . "' -- @VISIT
                        AND I.CLINIC_ID = 'P016' -- @POLI
                        AND I.BILL_ID IN (SELECT BILL_ID FROM TREAT_RESULTS)
        
                    "
                )->getRowArray() ?? []);

                $queryInspection = "
                                    SELECT 
                                        result_value, conclusion, specimen_id, result_id, treat_image, isvalid, valid_date,
                                        file_a, file_b, file_c, file_d
                                    FROM 
                                        TREAT_RESULTS TR
                                    WHERE 
                                        TR.VISIT_ID = '" . $formData['visit_id'] . "' 
                                        AND TR.BILL_ID = '" . $formData['bill_id'] . "'
                                        AND TR.CLINIC_ID = 'P016'
                                        AND TR.BILL_ID IN (SELECT BILL_ID FROM TREATMENT_BILL)
                                ";

                            $queryInspection = $this->lowerKey($db->query($queryInspection)->getRowArray() ?? []);

                            
                                if (!empty($formFile->getSize()) && !empty($formFile->getClientName())) {
                                    $uploadFile =  $filePath;
                                } else {
                                    $uploadFile = $queryInspection['treat_image'];
                                }


                                // $dataFilepath = $this->imageloc . $uploadFile;
                
                                // if (!empty($dataFilepath) && file_exists($dataFilepath)) {
                                //     unlink($dataFilepath);
                                // }

                            $dataUpdate = [
                                'doctor' => $getTreatment['doctor'] ?? null,
                                'specimen_id' => $formData['no_film'] ?? null,
                                'conclusion' => $formData['kesimpulan'] ?? null,
                                'result_value' => $formData['hasil_baca'] ?? null,
                                'diagnosa_desc' => isset($formData['diagnosa_desc']) ? $formData['diagnosa_desc'] : null,
                                'indication_desc' => isset($formData['indication_desc']) ? $formData['indication_desc'] : null,
                                'modified_date' => $date,
                                'modified_by' => user()->username,
                                'treat_image' => $uploadFile,
                                'file_a' => !empty($uploadedFiles['file_a']) ? strstr($uploadedFiles['file_a'], 'uploads/radiologi') : ($queryInspection['file_a'] ?? null),
                                'file_b' => !empty($uploadedFiles['file_b']) ? strstr($uploadedFiles['file_b'], 'uploads/radiologi') : ($queryInspection['file_b'] ?? null),
                                'file_c' => !empty($uploadedFiles['file_c']) ? strstr($uploadedFiles['file_c'], 'uploads/radiologi') : ($queryInspection['file_c'] ?? null),
                                'file_d' => !empty($uploadedFiles['file_d']) ? strstr($uploadedFiles['file_d'], 'uploads/radiologi') : ($queryInspection['file_d'] ?? null),
                                'isvalid' => $formData['isvalid'],
                                'iskritis' => $formData['iskritis'],
                                'valid_date' => empty($queryInspection['valid_date']) ? $date : $queryInspection['valid_date'],
                            ];
                            $action = 'update';
                            $model1 = new TreatResultModel();
                $model1->where(['bill_id' => $formData['bill_id']])->where('visit_id', $formData['visit_id'])->set($dataUpdate)->update();
            }


            $treat_bill = [
                'quantity' => '1',
                'tagihan' => $getTreatment['sell_price'],
                'amount' => $getTreatment['sell_price'],
                'islunas' => $formData['isvalid'] == 1 ? 2 : 0,
                'amount_paid' => $getTreatment['sell_price'],
                'employee_id' => user()->employee_id,
                'doctor' => $this->getFullnameByUsername(user()->username),
                
            ];
            $bill_model = new TreatmentBillModel();
            $bill_model->where(['bill_id' => $formData['bill_id']])->where('visit_id', $formData['visit_id'])->set($treat_bill)->update();

            $db->transCommit();
    
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan', 'treat_bill' => $treat_bill,'action'=>$action, 
            'bill_id' => $formData['bill_id']]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
 
    private function uploadFile($file, $formData, $uploadDir, $suffix)
    {
        $uploadPath = $this->imageloc . $uploadDir . $formData['visit_id'] . '/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $newFileName = $formData['bill_id'] . "_{$suffix}." . $file->getExtension();
        $filePath = $uploadPath . $newFileName;
    
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    
        $file->move($uploadPath, $newFileName);
        return $filePath;
    }
    
    
    public function cancelExpertise()
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

    public function getDataAll()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $start = isset($formData->startDate) ? $formData->startDate : date('Y-m-01 00:00:00');
        $end = isset($formData->endDate) ? $formData->endDate : date('Y-m-d 23:59:59');
        $no = isset($formData->noreq) ? $formData->noreq : '';
        $visit_id = isset($formData->visit_id) ? $formData->visit_id : ''; 
        $isrj = isset($formData->isrj) ? $formData->isrj : ''; 

        $start = $db->escapeString($start);
        $end = $db->escapeString($end);


        $kopprint = $this->lowerKey($db->query("SELECT * from ORGANIZATIONUNIT")->getRowArray());

        $select = $this->lowerKey($db->query("SELECT * from PERDA_TARIF where PERDA_ID >=100")->getResultArray());

        $diag = [];
        $model = new ExaminationModel();
        if ($isrj == '0'){
                    $diag = $model->select("teraphy_desc as diagnosa_desc")->where("visit_id = '" . $visit_id . "' and petugas_type = '11' and account_id <> 7")->orderBy("examination_date desc")->first();
        }else{
                    $diag = $model->select("teraphy_desc as diagnosa_desc")->where("no_registration = '" . $no . "' and petugas_type = '11' ")->orderBy("examination_date desc")->first();
        };


        $responseData = [
            'kop' => $kopprint,
            'select' => $select,
            'diag' =>  $diag
        ];

        $formattedResponseData = $this->lowerKey($responseData);
        return $this->response->setStatusCode(200)->setJSON([
            'value' => $formattedResponseData,

        ]);
    }

    public function getDataCoverLatter()
    {
        $db = db_connect();
        $formData = $this->request->getJSON();
        $visit_id = $formData->visit_id;

        $query = "SELECT * 
                    FROM pasien_penunjang 
                    WHERE VISIT_ID = ? 
                    AND CLINIC_ID = 'P016' 
                    AND DIAGNOSA_DESC IS NOT NULL 
                    AND DESCRIPTIONS IS NOT NULL;";

        $dataTables = $this->lowerKey($db->query($query, [
            $visit_id,
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

    public function getTemplateExpertise()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $search_term = $this->request->getPost("searchTerm");
        $employee_id = $this->request->getPost("employee_id");

        if (isset($search_term) && $search_term != '') {
            $result =
                $db->query(
                    "
                   SELECT top(10) RADIOLOGI_BACAAN_ID,
                    RADIOLOGI_BACAAN_TYPE, 
                    RADIOLOGI_BACAANTYPE, 
                    EMPLOYEE_ID, 
                    TREATMENT, 
                    HASIL_BACA, KESAN
                    FROM RADIOLOGI_TEMPLATE
                    WHERE EMPLOYEE_ID = '$employee_id'
                    AND TREATMENT LIKE '" . $search_term . "%'
                    "
                )->getResultArray();

            $result = $this->lowerKey($result);
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array(
                        "id" => $value['radiologi_bacaan_id'],
                        "text" => $value['treatment'],
                        "hasil_baca" => $value['hasil_baca'],
                        "kesimpulan" => $value['kesan'],
                    );
                }
            }

            echo json_encode($data);
        }
    }


    public function getTreatResultList()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);
        $nomor = $body['nomor'];
        $visit = $body['visit'];
        $clinic_id = $body['clinic_id'] ?? null;
        $trans_id = $body['trans_id'] ?? null;

        $model = new ResultTypeModel();
        $resultType = $this->lowerKey($model->findAll());


        $tr = new TreatResultModel();
        $trselect = $this->lowerKey($tr->where('no_registration', $nomor)
                                    ->where('clinic_id', $clinic_id)
                                    ->findAll());


        $tb = new TreatmentBillModel();
        $tbselect = $this->lowerKey($tb->where('no_registration', $nomor)
        ->where('clinic_id', $clinic_id)
        ->where('trans_id', $trans_id)
        ->findAll());
      
        // $trselect = $this->lowerKey($tb->getTreatResultList($nomor, $visit, $clinic_id));

        $filteredTrselect = [];

        foreach ($trselect as $trItem) {
            $matched = false;
            foreach ($tbselect as $tbItem) {
                if (
                    $trItem['bill_id'] == $tbItem['bill_id'] &&
                    $trItem['tarif_id'] == $tbItem['tarif_id']
                ) {
                    $matched = true;
                    break;
                }
            }
        
            if (!$matched) {
                continue;
            }
        
            foreach ($resultType as $resType) {
                if ($resType['result_type'] == $trItem['result_type']) {
                    $trItem['result_name'] = $resType['results'];
                    $trItem['result_symbol'] = $resType['symbol'];
                    break;
                }
            }
        
            $filteredTrselect[] = $trItem;
        }
        
        return json_encode($filteredTrselect);
        
    }

    public function getTreatResultListAll()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);
        $nomor = $body['nomor'];
        $visit = $body['visit'];
        $clinic_id = $body['clinic_id'] ?? null;
        $trans_id = $body['trans_id'] ?? null;

        $model = new ResultTypeModel();
        $resultType = $this->lowerKey($model->findAll());


        $tr = new TreatResultModel();
        $trselect = $this->lowerKey($tr->where('no_registration', $nomor)
                                    ->where('clinic_id', $clinic_id)
                                    ->findAll());


        $tb = new TreatmentBillModel();
        $tbselect = $this->lowerKey($tb->where('no_registration', $nomor)
        ->where('clinic_id', $clinic_id)
        // ->where('trans_id', $trans_id)
        ->findAll());
      
        // $trselect = $this->lowerKey($tb->getTreatResultList($nomor, $visit, $clinic_id));

        $filteredTrselect = [];

        foreach ($trselect as $trItem) {
            $matched = false;
            foreach ($tbselect as $tbItem) {
                if (
                    $trItem['bill_id'] == $tbItem['bill_id'] &&
                    $trItem['tarif_id'] == $tbItem['tarif_id']
                ) {
                    $matched = true;
                    break;
                }
            }
        
            if (!$matched) {
                continue;
            }
        
            foreach ($resultType as $resType) {
                if ($resType['result_type'] == $trItem['result_type']) {
                    $trItem['result_name'] = $resType['results'];
                    $trItem['result_symbol'] = $resType['symbol'];
                    break;
                }
            }
        
            $filteredTrselect[] = $trItem;
        }
        
        return $this->response->setJSON($filteredTrselect);
    }
}