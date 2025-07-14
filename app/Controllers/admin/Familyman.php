<?php

namespace App\Controllers\Admin;;

use App\Models\FamilyManModel;

class Familyman extends \App\Controllers\BaseController
{
    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->no_registration)) {
            return $this->response->setJSON([]);
        }

        $model = new FamilyManModel();
        $db = db_connect();

        $data = $this->lowerKey($model->where('no_registration', $formData->no_registration)
            ->findAll());

        $responsibles = $this->lowerKey($db->query("SELECT * from dbo.responsibles")->getResultArray());
        $agama = $this->lowerKey($db->query("SELECT * from dbo.agama")->getResultArray());
        $blood_type = $this->lowerKey($db->query("SELECT * from dbo.blood_type")->getResultArray());
        $job_category = $this->lowerKey($db->query("SELECT * from dbo.job_category")->getResultArray());
        $education_category = $this->lowerKey($db->query("SELECT * from dbo.EDUCATION_CATEGORY where EDUCATION_CATEGORY in ('159','158','152','151','139','127','114')")->getResultArray());
        $martial_status = $this->lowerKey($db->query("SELECT * from dbo.MARITAL_STATUS")->getResultArray());
        $sex = $this->lowerKey($db->query("SELECT * from dbo.SEX")->getResultArray());

        $select = [
            "responsibles" => $responsibles,
            "agama" => $agama,
            "blood_type" => $blood_type,
            "job_category" => $job_category,
            "education_category" => $education_category,
            "martial_status" => $martial_status,
            "sex" => $sex
        ];

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $data,
            "select"   => $select
        ]);
    }


    public function saveData()
    {
        $model = new FamilyManModel();
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

        if (empty($data['family_id'])) {
            if (empty($data['no_registration'])) {
                return $this->response->setJSON([
                    'message' => 'no_registration is required for generating family_id.',
                    'respon' => false
                ])->setStatusCode(400);
            }

            $newFamilyId = $model->selectMax('family_id')
                ->where('no_registration', $data['no_registration'])
                ->get()
                ->getRow()
                ->family_id ?? 0;

            $data['family_id'] = $newFamilyId + 1;
        }

        if (!empty($data['isresponsible']) && $data['isresponsible'] == 1) {
            $model->where('no_registration', $data['no_registration'])
                ->where('org_unit_code', $data['org_unit_code'])
                ->set('isresponsible', 0)
                ->update();
        }

        $existingRecord = $model->where('family_id', $data['family_id'])
            ->where('org_unit_code', $data['org_unit_code'])
            ->where('no_registration', $data['no_registration'])
            ->first();

        if ($existingRecord) {
            $existingRecord = $this->lowerKey($existingRecord);

            $model->where('org_unit_code', $data['org_unit_code'])
                ->where('no_registration', $data['no_registration'])
                ->update($existingRecord['family_id'], $data);
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

        $model = new FamilyManModel();

        $deleted = $model->where('family_id', $formData['id'])->where('no_registration', $formData['no_registration'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }
}
