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
        where visit_id = '$formData->visit_id'
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
        $employee_id =  $formData->employee_id;
        $data = [];

        $dataExist = $this->lowerKey($db->query("
        select * from pasien_konsulan where visit_id = '{@$formData->visit_id}'
        ")->getRowArray() ?? []);



        if (!empty($dataExist)) {
            $data = $dataExist;
        } else {
            $data = $this->lowerKey($db->query("
            select fullname as doctor,employee_id,specialist_type_id from EMPLOYEE_ALL
            ")->getRowArray() ?? []);
        }


        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data,
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

        try {
            $dataPasien = $this->lowerKey($db->query(
                "SELECT org_unit_code, no_registration FROM PASIEN_VISITATION WHERE visit_id = ?",
                [$formData->visit_id]
            )->getRowArray() ?? []);

            $data = array_filter((array) $formData, fn($value) => $value !== null && $value !== '');

            $model = new PasienKonsulanModel();
            $dataExist = $this->lowerKey($db->query(
                "SELECT * FROM PASIEN_KONSULAN WHERE visit_id = ? AND body_id = ?",
                [$formData->visit_id, $formData->body_id]
            )->getRowArray() ?? []);

            if (empty($dataExist)) {
                $data['org_unit_code'] = $dataPasien['org_unit_code'] ?? null;
                $data['no_registration'] = $dataPasien['no_registration'] ?? null;
                $data['body_id'] = $formData->body_id ?? $this->get_bodyid();
                $data['modified_by'] = user()->username;

                if (!$model->insert($data)) {
                    throw new \Exception('Insert failed: ' . json_encode($db->error()));
                }
            } else {
                $data['modified_by'] = user()->username;

                if (!$model->where('visit_id', $formData->visit_id)
                    ->where('body_id', $formData->body_id)
                    ->set($data)
                    ->update()) {
                    throw new \Exception('Update failed: ' . json_encode($db->error()));
                }
            }

            if (!empty($dataExist) && ($dataExist['consul_type'] === 3 || $dataExist['consul_type'] === '3')) {
                $modalAkomodasi = new TreatmentAkomodasiModel();
                $modalVisitation = new PasienVisitationModel();

                $dataAkomodasi = ['employee_id' => $dataExist['employee_id_to'], 'doctor' => $dataExist['doctor_to']];
                $dataVisitation = ['employee_inap' => $dataExist['employee_id_to']];

                if (!$modalAkomodasi->where('visit_id', $formData->visit_id)->set($dataAkomodasi)->update()) {
                    throw new \Exception('Update akomodasi failed: ' . json_encode($db->error()));
                }
                // if (!$modalVisitation->where('visit_id', $formData->visit_id)->set($dataVisitation)->update()) {
                //     throw new \Exception('Update visitation failed: ' . json_encode($db->error()));
                // }
            }

            $db->transCommit();

            return $this->response->setJSON([
                'message' => 'Data processed successfully.',
                'respon' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'message' => 'Failed to process data: ' . $e->getMessage(),
                'respon' => false
            ]);
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


    public function editStatus()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $builder = $db->table('pasien_konsulan');
        $builder->where('visit_id', $formData->visit_id);
        $builder->where('body_id', $formData->body_id);
        $update = $builder->update([
            'isfinish' => $formData->isfinish ? 1 : 0
        ]);

        $data = $this->lowerKey(
            $db->query("SELECT * FROM pasien_konsulan WHERE visit_id = ? AND body_id = ?", [
                $formData->visit_id,
                $formData->body_id
            ])->getRowArray() ?? []
        );

        return $this->response->setJSON([
            'message' => $update ? 'Status updated successfully.' : 'Failed to update status.',
            'respon' => $update,
            'data' => $data
        ]);
    }
}
