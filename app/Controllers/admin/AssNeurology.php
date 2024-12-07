<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\AneurologyModel;
use CodeIgniter\Controller;

class AssNeurology extends \App\Controllers\BaseController
{
    protected $model;

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        $model = new AneurologyModel();
        $data = $this->lowerKeyOne(
            $model->where('org_unit_code', $formData['org_unit_code'])
                ->where('no_registration', $formData['no_registration'])
                ->where('document_id', $formData['session_id'])
                ->orderBy('examination_date', 'DESC')
                ->first()
        );

        $result =  ['dataAll' => $data];

        if (empty($result)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Success',
                'respon' => true,
                'value' => ['data' => $result]
            ]);
        }
    }

    public function saveData()
    {
        $model = new AneurologyModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }
        $data['modified_by'] = user()->username;
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (!isset($data['body_id'])) {
            return $this->response->setJSON([
                'message' => 'body_id is required.',
                'respon' => false
            ])->setStatusCode(400);
        }

        $existingRecord = $model->where('body_id', $data['body_id'])->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);
            $model->update($existingRecord['body_id'], $data);
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }

    public function saveDataLokal($formData)
    {
        $model = new AneurologyModel();
        // $request = service('request');
        // $formData = $request->getJSON(true);
        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }
        $data['modified_by'] = user()->username;
        $data['modified_date'] = date('Y-m-d H:i:s');
        if (!isset($data['body_id'])) {
            return ([
                'message' => 'body_id is required.',
                'respon' => false
            ]);
        }

        $existingRecord = $model->where('body_id', $data['body_id'])->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);
            $model->update($existingRecord['body_id'], $data);
        } else {
            $model->insert($data);
        }

        return (['message' => 'Data saved successfully.', 'respon' => true]);
    }


    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!$formData['id']) {
            return ['success' => false, 'message' => 'Missing body_id'];
        }

        $model = new AneurologyModel();

        $deleted = $model->where('body_id', $formData['id'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }

    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }
}
