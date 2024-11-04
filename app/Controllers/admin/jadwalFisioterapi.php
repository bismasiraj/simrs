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
        $modelSchedule = new FisioterapiScheduleModel(); // baru havin 26 09
        $modelDetail = new FisioterapiDetailModel();

        $data = $this->lowerKey(
            $model->where('visit_id', $formData['visit_id'])
                ->orderBy('vactination_date', 'DESC')
                ->findAll()
        );
        $dataSchedule = [];
        foreach ($data as $key => $row) {
            $dataSchedule[$row['vactination_id']] = $this->lowerKey($modelSchedule->where('visit_id', $formData['visit_id'])->where('document_id', $row['vactination_id'])->findAll() ?? []);
        } // baru havin 26 09

        $dataDetail = $this->lowerKey(
            $modelDetail->where('visit_id', $formData['visit_id'])
                ->orderBy('vactination_date', 'DESC')
                ->findAll()
        );

        $diagnosa = $this->lowerKey($db->query("SELECT * FROM PASIEN_DIAGNOSA WHERE diag_cat IN ('1', '17') AND visit_id = '" . $formData['visit_id'] . "'
            ORDER BY date_of_diagnosa DESC
            ")->getResultArray());

        $kopprint = $this->lowerKey($db->query("SELECT * from ORGANIZATIONUNIT")->getRowArray());

        $success = !empty($data);

        return $this->response->setStatusCode(200)->setJSON([
            'success' => $success,
            'value'   => ['fisioterapi' => $data, 'diagnosa' => $diagnosa, 'kop' => $kopprint, 'fioterapi_detail' => $dataDetail, 'fisioterapi_schedule' => $dataSchedule],


        ]); // baru havin 26 09
    }

    public function insertOrUpdateDataFisio()
    {
        $model = new FisioterapiModel();
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
                $deleteSchedule = $modelSchedule->where('visit_id', $formData['visit_id'])->where('document_id', $formData['vactination_id'])->delete();
                if (!$deleteSchedule) {
                    throw new \Exception('Failed Delete Schedule.');
                }
                $dataProgram = [];
                $tarif_id_new = array();
                $tarif_name_new = array();
                foreach ($formData['program'] as $program) {

                    $vactination_id = $this->get_bodyid();
                    array_push($tarif_id_new, json_decode($program['program_name'])->tarif_id);
                    array_push($tarif_name_new, json_decode($program['program_name'])->tarif_name);

                    $dataProgram[] = [
                        'org_unit_code' => $formData['org_unit_code'],
                        'vactination_id' => $vactination_id,
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
                        'tarif_id' => json_decode($program['program_name'])->tarif_id,
                        'treatment' => $formData['treatment'],
                        'treatment_program' => json_decode($program['program_name'])->tarif_name,
                        'start_date' => $program['vactination_date'] . ' ' . $program['start'],
                        'end_date' => $program['vactination_date'] . ' ' . $program['end'],
                        'examination_date' => date("Y-m-d H:i:s"),
                    ];
                }

                if (!empty($dataProgram)) {
                    $insertBatchProgram = $modelSchedule->insertBatch($dataProgram);

                    if (!$insertBatchProgram) {
                        throw new \Exception('Failed to insert batch of Program.');
                    }

                    // check table pasien fisioterapi
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
}
