<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\AssIntensivTreatModel;
use CodeIgniter\Controller;

class AssIntensivTreat extends \App\Controllers\BaseController
{
    protected $model;

    public function getData()
    {
        $request = service('request');
        $db = db_connect();
        $formData = $request->getJSON(true);

        $data = $this->lowerKey(
            $db->query("SELECT * from ASSESSMENT_INTENSIVE_TREATMENT where visit_id = ?",[$formData['visit_id']])->getResultArray()
        );
    
        if (empty($data)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        }else{
            return $this->response->setJSON([
                'message' => 'Success',
                'respon' => true,
                'value'=>['data'=>$data] 
            ]);
        }
    }
    


    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }

    public function saveData()
    {
        $model = new AssIntensivTreatModel();
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

    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!$formData['id']) {
            return ['success' => false, 'message' => 'Missing body_id'];
        }

        $model = new AssIntensivTreatModel();

        $deleted = $model->where('body_id', $formData['id'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }
}