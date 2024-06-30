<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\InformConsernModel;
use CodeIgniter\Controller;

class InformendConsent extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new InformConsernModel();
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $model = new InformConsernModel();
        $data = $this->lowerKey($model->where('visit_id', $formData['visit_id'])->findAll());

        return $this->response->setJSON($data);
    }

    public function getDetail()
    {

        $json = $this->request->getJSON();

        $visit_id = $json->visit_id;
        $body_id = $json->body_id;
        $parameter_id = $json->parameter_id;


        $model = new InformConsernModel();

        $data = $this->lowerKey($model->where('visit_id', $visit_id)
            ->where('body_id', $body_id)
            ->where('parameter_id', $parameter_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function insertData()
    {
        $model = new InformConsernModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $db = db_connect();
        $query = $this->lowerKey($db->query("SELECT * FROM assessment_parameter_value WHERE p_type='" . $formData['p_type'] . "' AND parameter_id = '" . $formData['parameter_id'] . "'")->getResultArray());

        $insertData = [];

        foreach ($query as $key) {
            $valueId = $key['value_id'];
            $data = [
                'org_unit_code' => $formData['org_unit_code'],
                'visit_id' => $formData['visit_id'],
                'trans_id' => $formData['trans_id'],
                'body_id' => $formData['body_id'],
                'p_type' => $formData['p_type'],
                'parameter_id' => $key['parameter_id'],
                'value_id' => $valueId,
                'modified_by' => user()->username,
            ];

            $valueScoreKey = 'value_score-' . $valueId;
            if (isset($formData[$valueScoreKey])) {
                $data['value_score'] = $formData[$valueScoreKey];
            } else {
                $data['value_score'] = 1;
            }

            $valueDescKey = 'value_desc-' . $valueId;
            if (isset($formData[$valueDescKey])) {
                $data['value_desc'] = $formData[$valueDescKey];
            } else {
                $data['value_desc'] = '';
            }

            $valueInfoKey = 'value_info-' . $valueId;
            if (isset($formData[$valueInfoKey])) {
                $data['value_info'] = $formData[$valueInfoKey];
            } else {
                $data['value_info'] = '';
            }

            $insertData[] = $data;
        }

        foreach ($insertData as $data) {
            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }

    public function updateData()
    {
        $model = new InformConsernModel();
        $request = service('request');
        $formData = $request->getJSON(true);


        if (!isset($formData['body_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing body_id in request data']);
        }

        $bodyId = $formData['body_id'];

        $db = db_connect();

        $query = $db->query("SELECT * FROM assessment_parameter_value WHERE p_type='" . $formData['p_type'] . "' AND parameter_id = '" . $formData['parameter_id'] . "'")->getResultArray();

        if (!$query) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'No data found for given parameters']);
        }

        $query = $this->lowerKey($query);

        $updateData = [];

        foreach ($query as $key) {
            $valueId = $key['value_id'];
            $data = [
                'org_unit_code' => $formData['org_unit_code'],
                'visit_id' => $formData['visit_id'],
                'trans_id' => $formData['trans_id'],
                'body_id' => $bodyId,
                'p_type' => $formData['p_type'],
                'parameter_id' => $key['parameter_id'],
                'value_id' => $valueId,
                'modified_by' => user()->username,
            ];

            $valueScoreKey = 'value_score-' . $valueId;
            if (isset($formData[$valueScoreKey])) {
                $data['value_score'] = $formData[$valueScoreKey];
            } else {
                $data['value_score'] = 1;
            }

            $valueDescKey = 'value_desc-' . $valueId;
            if (isset($formData[$valueDescKey])) {
                $data['value_desc'] = $formData[$valueDescKey];
            } else {
                $data['value_desc'] = '';
            }

            $valueInfoKey = 'value_info-' . $valueId;
            if (isset($formData[$valueInfoKey])) {
                $data['value_info'] = $formData[$valueInfoKey];
            } else {
                $data['value_info'] = '';
            }

            $updateData[] = $data;
        }

        foreach ($updateData as $data) {
            $model->where(['body_id' => $data['body_id'], 'value_id' => $data['value_id']])
                ->set($data)
                ->update();
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }


    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!$formData['visit'] || !$formData['id']) {
            return ['success' => false, 'message' => 'Missing visit_id or body_id'];
        }

        $model = new InformConsernModel();

        $deleted = $model->where('body_id', $formData['id'])
            ->where('visit_id', $formData['visit'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }

    public function cetakData($visit, $vactination = null)
    {

        if ($this->request->is('get')) {
            $decoded_visit = base64_decode($visit);
            $decoded_visit = json_decode($decoded_visit, true);
            // echo '<pre>';
            // print_r($decoded_visit);
            // echo '</pre>';
            // exit();
            $kopprintData = $this->kopprint();

            return view("admin/patient/profilemodul/cetak-informconsern.php", [
                "visit" => $decoded_visit,
                "title" => "Informed Consent - Seksio Sesarea - MOW",
                "title2" => "Persetujuan Tindakan Kedokteran",
                'kop' => $kopprintData[0]
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
}
