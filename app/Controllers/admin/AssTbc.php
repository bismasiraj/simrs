<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\AssTbcModel;

use CodeIgniter\Controller;
use Exception;

class AssTbc extends \App\Controllers\BaseController
{
    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $model = new AssTbcModel();
        $data = $this->lowerKey(
            $model->where('trans_id', $formData['trans_id'])
                ->orderBy('examination_date', 'DESC')
                ->findAll()
        );
        $success = !empty($data);

        return $this->response->setStatusCode(200)->setJSON([
            'status' => $success,
            'value'   => ['data' => $data],

        ]);
    }


    public function insertOrUpdateData()
    {
        $model = new AssTbcModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        if (!isset($data['body_id'])) {
            return $this->response->setJSON([
                'message' => 'body_id is required.',
                'respon' => false
            ])->setStatusCode(400);
        }

        $data['modified_by'] = user()->username;
        $data['modified_date'] = date('Y-m-d H:i:s');

        $existingRecord = $model->where('body_id', $data['body_id'])->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);
            $model->update($existingRecord['body_id'], $data);
        } else {

            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }
}
