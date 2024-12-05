<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\PasienKonsulanModel;
use App\Models\PasienVisitationModel;
use App\Models\TreatmentAkomodasiModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\RawSql;
use DateTime;
use Exception;

class PasienKonsulan extends \App\Controllers\BaseController
{

    public function getData()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
        $data = $this->lowerKey($db->query("
        select * from pasien_konsulan 
        where employee_id_to = '$formData->employee_id'
        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
    }

    public function getPasienKonsulan()
    {
        $formData = $this->request->getJSON();

        $db = db_connect();
        $employee_id =  $formData->employee_id ?? '327';
        $data = [];

        $dataExist = $this->lowerKey($db->query("
        select * from pasien_konsulan where visit_id = '$formData->visit_id'
        ")->getRowArray() ?? []);


        if (!empty($dataExist)) {
            $data = $dataExist;
        } else {
            $data = $this->lowerKey($db->query("
            select fullname as doctor,employee_id,specialist_type_id from EMPLOYEE_ALL where employee_id = '$employee_id'
            ")->getRowArray() ?? []);
        }


        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
    }


    public function getSpecialistType()
    {
        $db = db_connect();

        $query = $db->query("select SPECIALIST_TYPE_ID AS id, SPECIALIST_TYPE AS text from SPECIALIST_TYPE order by SPECIALIST_TYPE asc")->getResultArray();

        $results = $this->lowerKey($query ?? []);
        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }


    public function insert()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin();
        $formData = $request->getJSON();

        $dataPasien = $this->lowerKey($db->query("
        select org_unit_code,no_registration from PASIEN_VISITATION where visit_id = '$formData->visit_id'
        ")->getRowArray() ?? []);


        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }


        try {


            $model = new PasienKonsulanModel();
            $dataExist = $this->lowerKey($db->query("
            select * from PASIEN_KONSULAN where visit_id = '$formData->visit_id'
            ")->getRowArray() ?? []);

            if (empty($dataExist)) {
                $data['org_unit_code'] = $dataPasien['org_unit_code'];
                $data['no_registration'] = $dataPasien['no_registration'];
                $data['body_id'] = $this->get_bodyid();
                $data['modified_by'] = user()->username;
                $insert = $model->insert($data);
                if (!$insert) {
                    $error = $db->error();
                    throw new \Exception('Insert failed: ' . $error['message']);
                }
            } else {
                $data['modified_by'] = user()->username;
                $update = $model->where('visit_id', $formData->visit_id)->where('body_id', $dataExist['body_id'])->set($data)->update();
                if (!$update) {
                    $error = $db->error();
                    throw new \Exception('Update failed: ' . $error['message']);
                }

                if ($dataExist['consul_type'] == '3') {
                    $modalAkomodasi = new TreatmentAkomodasiModel();
                    $modalVisitation = new PasienVisitationModel();
                    $dataAkomodasi = [
                        'employee_id' => $dataExist['employee_id_to'],
                        'doctor' => $dataExist['doctor_to']
                    ];
                    $dataVisitation = [
                        'employee_inap' => $dataExist['employee_id_to'],
                    ];

                    $updateAkomodasi = $modalAkomodasi->where('visit_id', $formData->visit_id)->set($dataAkomodasi)->update();
                    if (!$updateAkomodasi) {
                        $error = $db->error();
                        throw new \Exception('Update akomodasi failed: ' . $error['message']);
                    }

                    $updateVisitation = $modalVisitation->where('visit_id', $formData->visit_id)->set($dataVisitation)->update();
                    if (!$updateVisitation) {
                        $error = $db->error();
                        throw new \Exception('Update visitation failed: ' . $error['message']);
                    }
                }
            }


            $db->transCommit();

            return $this->response->setJSON([
                'message' => 'File insert successfully.',
                'respon' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'respon' => false]);
        }
    }

    public function delete()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();
        $db->transBegin();

        if (!$formData->body_id) {
            return $this->response->setJSON(['message' => 'Error : body_id is missing', 'respon' => false]);
        }

        try {
            $model = new PasienKonsulanModel();

            $deleted = $model->where('body_id', $formData->body_id)
                ->delete();

            if (!$deleted) {
                throw new \Exception('Failed to delete data.');
            }

            $db->transCommit();

            return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Error : ' . $e->getMessage(), 'respon' => false]);
        }
    }
}
