<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\FisioterapiDetailModel;
use App\Models\FisioterapiModel;
use App\Models\FisioterapiScheduleModel;
use CodeIgniter\Controller;
use Exception;

class jadwalFisioterapi extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new FisioterapiModel();
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        // $formData['visit_id'] = '2024052721452002230C3';
        $model = new FisioterapiModel();
        $modelSchedule = new FisioterapiScheduleModel();
        $modelDetail = new FisioterapiDetailModel();

        $data = $this->lowerKey(
            $model->where('visit_id', $formData['visit_id'])
                ->orderBy('vactination_date', 'DESC')
                ->findAll()
        );

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        $ttdDir = $this->imageloc . "uploads/dokter/";
        $ttdDirPasien = $this->imageloc . "uploads/signatures/";

        foreach ($data as &$pasien1) {
            $ttdBase64 = null;
            $ttdBase64Pasien = null;

            $employeeId = $pasien1['employee_id'] ?? null;
            $no_rmId = $pasien1['no_registration'] ?? null;

            if (!empty($employeeId)) {
                foreach ($allowedExtensions as $ext) {
                    $filePath = $ttdDir . $employeeId . '.' . $ext;
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }

            if (!empty($no_rmId)) {
                foreach ($allowedExtensions as $extPasien) {
                    $pattern = $ttdDirPasien . $no_rmId . '*.' . $extPasien;
                    $files = glob($pattern);

                    if (!empty($files)) {
                        $filePathPasien = $files[0];
                        if (file_exists($filePathPasien)) {
                            $fileDataPasien = file_get_contents($filePathPasien);
                            $mimeTypePasien = mime_content_type($filePathPasien);
                            $ttdBase64Pasien = 'data:' . $mimeTypePasien . ';base64,' . base64_encode($fileDataPasien);
                            break;
                        }
                    }
                }
            }

            $pasien1['ttd_dok'] = $ttdBase64;
            $pasien1['ttd_pasien'] = $ttdBase64Pasien;
        }
        unset($pasien1);



        $dataSchedule = [];
        foreach ($data as $key => $row) {
            $dataSchedule[$row['vactination_id']] = $this->lowerKey($modelSchedule
                ->where('visit_id', $formData['visit_id'])
                ->where('document_id', $row['vactination_id'])
                ->orderBy('start_date', 'ASC')
                ->orderBy('treatment_program', 'ASC')
                ->findAll() ?? []);
        } // baru havin 26 09

        $dataDetail = $this->lowerKey(
            $modelDetail->where('visit_id', $formData['visit_id'])
                ->orderBy('vactination_date', 'DESC')
                ->findAll()
        );

        $diagnosa = $this->lowerKey($db->query("SELECT 
                                         pd.VISIT_ID, 
                                            pd.ANAMNASE,
                                            pds.DIAG_CAT, 
                                            d.NAME_OF_DIAGNOSA as diagnosa_name
                                    FROM PASIEN_DIAGNOSA pd
                                    LEFT JOIN PASIEN_DIAGNOSAS pds 
                                        ON pd.PASIEN_DIAGNOSA_ID = pds.PASIEN_DIAGNOSA_ID
                                    LEFT JOIN DIAGNOSA d
                                        ON pds.diagnosa_id = d.diagnosa_id
                                    WHERE     pds.diag_cat IN ('1', '17') 
                                        AND d.diagnosa_id = pds.DIAGNOSA_ID
                                    AND pd.visit_id = '" . $formData['visit_id'] . "'
                                ORDER BY pd.date_of_diagnosa DESC;
            ")->getResultArray());

        $clinic = $this->lowerKey($db->query("SELECT 
                                                c.NAME_OF_CLINIC, 
                                                pv.VISIT_ID,
                                                pv.clinic_id
                                            FROM CLINIC c
                                            JOIN PASIEN_VISITATION pv ON c.clinic_id = pv.clinic_id
                                            WHERE c.clinic_id = pv.clinic_id
                                            AND pv.visit_id = '" . $formData['visit_id'] . "'
                                        ")->getRowArray());
        $employee =  $this->lowerKey($db->query("SELECT FULLNAME,EMPLOYEE_ID FROM EMPLOYEE_ALL where OBJECT_CATEGORY_ID = '20' AND SPECIALIST_TYPE_ID is Not Null
                                            ")->getResultArray());



        $pain = $this->lowerKey($db->query("select * from ASSESSMENT_PAIN_DETAIL where visit_id = '" . $formData['visit_id'] . "' and parameter_id = '01'
            ")->getResultArray() ?? []);

        $pain = array_map(function ($item) {
            return $item['value_desc'];
        }, $pain);

        $pain = implode(", ", $pain);


        $kopprint = $this->lowerKey($db->query("SELECT * from ORGANIZATIONUNIT")->getRowArray());

        $success = !empty($data);

        return $this->response->setStatusCode(200)->setJSON([
            'success' => $success,
            'value'   => [
                'fisioterapi' => $data,
                'diagnosa' => $diagnosa,
                'kop' => $kopprint,
                'fioterapi_detail' => $dataDetail,
                'fisioterapi_schedule' => $dataSchedule,
                'monitoring_nyeri' => $pain,
                'clinic_cover' => $clinic,
                'employee' => $employee
            ],



        ]);
    }

    public function insertOrUpdateDataFisio()
    {
        $model = new FisioterapiModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $data = [];

        foreach ($formData as $key => $value) {
            $data[$key] = $value;
        }

        if (!isset($data['vactination_id'])) {
            return $this->response->setJSON([
                'message' => 'vactination_id is required.',
                'respon' => false
            ])->setStatusCode(400);
        }

        $data['modified_by'] = user()->username;
        $data['modified_date'] = date('Y-m-d H:i:s');

        $existingRecord = $model->where('vactination_id', $data['vactination_id'])->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);
            $model->update($existingRecord['vactination_id'], $data);
        } else {

            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }



    public function deleteDataFisio()
    {
        $model = new FisioterapiModel();
        $modelDetail = new FisioterapiDetailModel();
        $modelSc = new FisioterapiScheduleModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!isset($formData['vactination_id'])) {
            return $this->response->setJSON(['message' => 'vactination_id is required.', 'respon' => false]);
        }
        $vactination_id = $formData['vactination_id'];

        $existingRecord = $model->find($vactination_id);

        if (!$existingRecord) {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }

        $model->delete($vactination_id);

        $modelDetail->where('document_id', $formData['vactination_id']);

        $modelSc->where('document_id', $formData['vactination_id']);

        return $this->response->setJSON(['message' => 'Data deleted successfully.', 'respon' => true]);
    }




    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }

    public function saveJadwalFisio()
    {
        $model = new FisioterapiModel();
        $modelSchedule = new FisioterapiScheduleModel();

        $request = service('request');
        $formData = $request->getJSON(true);

        $db = \Config\Database::connect();
        $db->transStart();

        try {

            if (isset($formData['program'])  && is_array($formData['program']) && !empty($formData['program'])) {
                $deleteSchedule = $modelSchedule->where('visit_id', $formData['visit_id'])->where('document_id', $formData['vactination_id'])->where('schedule_type', $formData['schedule_type'])->delete();
                if (!$deleteSchedule) {
                    throw new \Exception('Failed Delete Schedule.');
                }
                $dataProgram = [];
                $tarif_id_new = array();
                $tarif_name_new = array();
                foreach ($formData['program'] as $program) {

                    $vactination_id = $this->get_bodyid();

                    $dataProgram[] = [
                        'org_unit_code' => $formData['org_unit_code'],
                        'vactination_id' => $program['vactination_id'],
                        'no_registration' => $formData['no_registration'],
                        'visit_id' => $formData['visit_id'],
                        'document_id' => $formData['vactination_id'],
                        'clinic_id' => $formData['clinic_id'],
                        'employee_id' => $formData['employee_id'],
                        'doctor' => $formData['doctor'],
                        'vactination_date' => $program['vactination_date'],
                        'modified_date' => date("Y-m-d H:i:s"),
                        'modified_by' => user()->username,
                        'modified_from' => $formData['clinic_id'],
                        'thename' => $formData['thename'],
                        'theaddress' => $formData['theaddress'],
                        'theid' => $formData['theid'],
                        'isrj' => $formData['isrj'],
                        'ageyear' => $formData['ageyear'],
                        'agemonth' => $formData['agemonth'],
                        'ageday' => $formData['ageday'],
                        'class_room_id' => $formData['class_room_id'],
                        'bed_id' => $formData['bed_id'],
                        'tarif_id' => $program['program_id'],
                        'treatment' => $formData['treatment'],
                        'treatment_program' => $program['program_name'],
                        'start_date' => (!empty($program['vactination_date']) && !empty($program['start'])) ? $program['vactination_date'] . ' ' . $program['start'] : null,
                        'end_date' => (!empty($program['vactination_date']) && !empty($program['end'])) ? $program['vactination_date'] . ' ' . $program['end'] : null,
                        'examination_date' => date("Y-m-d H:i:s"),
                        'treatment_description' => $program['treatment_description'],
                        'schedule_type' => $program['schedule_type'],
                        'valid_user'  => $program['valid_user'] !== "" ? $program['valid_user'] : null,
                        'valid_pasien' => $program['valid_pasien'] !== "" ? $program['valid_pasien'] : null,
                        'valid_other'  => $program['valid_other'] !== "" ? $program['valid_other'] : null,


                    ];
                }

                if (!empty($dataProgram)) {
                    $insertBatchProgram = $modelSchedule->insertBatch($dataProgram);

                    if (!$insertBatchProgram) {
                        throw new \Exception('Failed to insert batch of Program.');
                    }

                    $existingData = $this->lowerKey($model->where('visit_id', $formData['visit_id'])->where('vactination_id', $formData['vactination_id'])->first() ?? []);

                    if (!is_null($existingData['tarif_id']) && !empty($existingData['tarif_id'])) {

                        $tarif_id = explode(',', $existingData['tarif_id']);
                        $tarif_name = explode(',', $existingData['tarif_name']);
                        $diff = array_diff($tarif_id_new, $tarif_id);
                        $diff2 = array_diff($tarif_name_new, $tarif_name);
                        if (!empty($diff)) {
                            $dataFisio = [
                                'tarif_id' => implode(',', $tarif_id) . ',' . implode(',', $diff),
                                'tarif_name' => implode(',', $tarif_name) . ',' . implode(',', $diff2),
                            ];
                            $updateResult = $model->update($formData['vactination_id'], $dataFisio);
                        }
                    } else {
                        $tarif_id = explode(',', $existingData['tarif_id']);
                        $tarif_name = explode(',', $existingData['tarif_name']);

                        $dataFisio = [
                            'tarif_id' => implode(',', $tarif_id_new),
                            'tarif_name' => implode(',', $tarif_name_new),
                        ];
                        $updateResult = $model->update($formData['vactination_id'], $dataFisio);
                    }
                }
            }


            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed.');
            }

            $db->transComplete();
            return $this->response->setJSON([
                'message' => 'Sukses memproses data.',
                'respon'  => true,
                'result' => $formData['visit_id']
            ]);
        } catch (\Exception $error) {

            $db->transRollback();
            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $error->getMessage(),
                'result'  => $formData['visit_id']
            ]);
        }
    } // baru havin 26 09

    // new 25/09
    public function insertOrUpdateUjiDataFisio()
    {
        $model = new FisioterapiDetailModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        if (!isset($data['vactination_id'])) {
            return $this->response->setJSON([
                'message' => 'vactination_id is required.',
                'respon' => false
            ])->setStatusCode(400);
        }

        $data['modified_by'] = user()->username;
        $data['modified_date'] = date('Y-m-d H:i:s');

        $existingRecord = $model->where('vactination_id', $data['vactination_id'])->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);
            $model->update($existingRecord['vactination_id'], $data);
        } else {

            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }
    public function getRecipes()
    {
        $db = db_connect();

        $query = $db->query("select recipe_id as id, recipe as text from recipes order by text asc")->getResultArray();

        $results = $this->lowerKey($query ?? []);
        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }
    public function getTarif()
    {
        $db = db_connect();

        $query = $db->query("
        SELECT
            TREAT_TARIF.TARIF_NAME as text, 
            TREAT_TARIF.TARIF_ID as id
        FROM TREAT_TARIF
        INNER JOIN treatment ON treatment.treat_id = TREAT_TARIF.treat_id
        WHERE TREATMENT.TREAT_TYPE IN ('16')
        ORDER BY TREAT_TARIF.TARIF_NAME")->getResultArray();

        $results = $this->lowerKey($query ?? []);
        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }
}
