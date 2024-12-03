<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\BloodRequestModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\RawSql;
use DateTime;
use Exception;

class BloodRequest extends \App\Controllers\BaseController
{

    public function getData()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
        $data = $this->lowerKey($db->query("
        select * from blood_request 
        where VISIT_ID = '" . $formData->visit_id . "' 
        and CLINIC_ID = '" . $formData->clinic_id . "' 
        and NO_REGISTRATION = '" . $formData->no_registration . "' 
        and (TRANSFUSION_START is null OR TRANSFUSION_END is null)
        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
    }
    public function getDataFromLab()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
        $start_date = DateTime::createFromFormat('d/m/Y', $formData->start_date)->format('Y-m-d');
        $end_date = DateTime::createFromFormat('d/m/Y', $formData->end_date)->format('Y-m-d');

        $query =
            "
            select pv.diantar_oleh, blood_request.* from blood_request 
            inner join PASIEN_VISITATION pv ON blood_request.VISIT_ID = pv.VISIT_ID
            where 1=1
            and CAST(request_date AS DATE) between '$start_date' and '$end_date'
            and (TRANSFUSION_START is null OR TRANSFUSION_END is null OR REACTION_DESC is null) 
            and (terlayani is null OR terlayani != 1)
            ";
        if (!empty($formData->visit_id)) {
            $query .= " and blood_request.VISIT_ID = '" . $formData->visit_id . "' ";
        }
        $data = $this->lowerKey($db->query($query)->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
    }

    public function getHistory()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
        $data = $this->lowerKey($db->query("
        select * from blood_request 
        where VISIT_ID = '" . $formData->visit_id . "' 
        and CLINIC_ID = '" . $formData->clinic_id . "' 
        and NO_REGISTRATION = '" . $formData->no_registration . "' 
        and (TRANSFUSION_START is not null OR TRANSFUSION_END is not null OR REACTION_DESC is not null)
        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
    }

    public function insertData()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin();
        $formData = $request->getJSON();

        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        try {


            $model = new BloodRequestModel();

            $dataBloodRequest = [];
            if (isset($formData->blood) && !empty($formData->blood)) {

                $bloodBeforeDelete = $this->lowerKey($db->query("
                select * from blood_request 
                where VISIT_ID = '" . $formData->blood[0]->visit_id . "' 
                and CLINIC_ID = '" . $formData->blood[0]->clinic_id . "' 
                and NO_REGISTRATION = '" . $formData->blood[0]->no_registration . "' 
                and (TRANSFUSION_START is null OR TRANSFUSION_END is null)
                ")->getResultArray() ?? []);

                $model->where('visit_id', $formData->blood[0]->visit_id)
                    ->where('no_registration', $formData->blood[0]->no_registration)
                    ->where('clinic_id', $formData->blood[0]->clinic_id)
                    ->where('TRANSFUSION_START', NULL)
                    ->orWhere('TRANSFUSION_END', NULL)
                    ->delete();

                foreach ($formData->blood as $blood) {
                    $existData = array_filter($bloodBeforeDelete, function ($item) use ($blood) {
                        return isset($item['blood_request']) && $item['blood_request'] === $blood->blood_request;
                    });


                    $dataBlood = [
                        'org_unit_code' => $blood->org_unit_code,
                        'blood_request' => !empty($blood->blood_request) ? $blood->blood_request : $this->get_bodyid(),
                        'no_registration' => $blood->no_registration,
                        'visit_id' => $blood->visit_id,
                        'trans_id' => $blood->trans_id,
                        'document_id' => null,
                        'clinic_id' => $blood->clinic_id,

                        'calf_number' => $existData[0]['calf_number'] ?? null,
                        'delivery_time' => $existData[0]['delivery_time'] ?? null,
                        'terlayani' => $existData[0]['terlayani'] ?? null,

                        'request_date' => $blood->request_date,
                        'blood_type_id' => $blood->blood_type_id,
                        'using_time' => $blood->using_time,
                        'blood_usage_type' => $blood->blood_usage_type,
                        'blood_quantity' => $blood->blood_quantity,
                        'measure_id' => $blood->measure_id,
                        'descriptions' => $blood->descriptions,

                        'transfusion_start' => !empty($blood->transfusion_start) ? $blood->transfusion_start : null,
                        'transfusion_end' => !empty($blood->transfusion_end) ? $blood->transfusion_end : null,
                        'reaction_desc' => !empty($blood->reaction_desc) ? $blood->reaction_desc : null,
                    ];
                    $dataBloodRequest[] = $dataBlood;

                    $insert = $model->insert($dataBlood);
                    if (!$insert) {
                        $error = $db->error();
                        throw new \Exception('Update failed: ' . $error['message']);
                    }
                }
            }
            $db->transCommit();

            return $this->response->setJSON([
                'message' => 'File insert successfully.',
                'respon' => true,
                'data' => $dataBloodRequest
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'respon' => false]);
        }
    }

    public function updateFromLab()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin();
        $formData = $request->getJSON();
        // echo '<pre>';
        // var_dump($formData);
        // die();
        $model = new BloodRequestModel();

        $dataBloodRequest = [];
        try {
            if (isset($formData->blood) && !empty($formData->blood)) {
                foreach ($formData->blood as $blood) {

                    $dataBlood = [
                        'calf_number' => $blood->calf_number,
                        'delivery_time' => $blood->delivery_time,
                        'terlayani' => 1
                    ];
                    $dataBloodRequest[] = $dataBlood;
                    $model->where('visit_id', $blood->visit_id)->where('blood_request', $blood->blood_request)->set($dataBlood)->update();
                }
            }

            $db->transCommit();
            return $this->response->setJSON([
                'message' => 'File uploaded successfully.',
                'respon' => true,
                'data' => $dataBloodRequest
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'respon' => false]);
        }
    }
}
