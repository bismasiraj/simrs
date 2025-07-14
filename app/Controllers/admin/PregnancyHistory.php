<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\BirthHistoryModel;
use CodeIgniter\Controller;

class PregnancyHistory extends \App\Controllers\BaseController
{
    protected $model;

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        $model = new BirthHistoryModel();
        $data = $this->lowerKey(
            $model->where('org_unit_code', $formData['org_unit_code'])
                ->where('no_registration', $formData['no_registration'])
                ->findAll()
        );

        $location = $this->lowerKey($db->query("SELECT birthplace as result from BIRTH_PLACE ORDER BY birthplace ASC")->getResultArray());
        $type = $this->lowerKey($db->query("SELECT birthway as result from BIRTH_WAY where number in ('1','2','3','4','5')")->getResultArray());
        $helper = $this->lowerKey($db->query("SELECT birthby as result from BIRTH_BY PARTUS_ABNORMAL")->getResultArray());
        $penyulit = $this->lowerKey($db->query(" SELECT anomali as result from BIRTH_ANOMALI")->getResultArray());


        $result =  [
            'dataAll' => $data,
            'filterOption' => [
                'location' => $location,
                'type' => $type,
                'helper' => $helper,
                'penyulit' => $penyulit
            ]
        ];

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
        $model = new BirthHistoryModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[$key] = $value;
            }
        }

        $data['partus_date'] = str_replace("T", " ", $data['partus_date']);

        // return json_encode($data);
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

        $model = new BirthHistoryModel();

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
