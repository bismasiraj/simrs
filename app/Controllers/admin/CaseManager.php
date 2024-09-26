<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\InformedConsentModel;
use CodeIgniter\Controller;

class CaseManager extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new InformedConsentModel();
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $model = new InformedConsentModel();

        $data = $model->select('visit_id, parameter_id, body_id, MIN(modified_date) as modified_date')
            ->where('visit_id', $formData['visit_id'])
            ->where('p_type', 'GEN0019')
            ->groupBy(['visit_id', 'parameter_id', 'body_id'])
            ->orderBy('modified_date', 'ASC')
            ->findAll();

        $data = $this->lowerKey($data);

        return $this->response->setJSON($data);
    }

    public function getDetail()
    {

        $json = $this->request->getJSON();

        $visit_id = $json->visit_id;
        $body_id = $json->body_id;


        $model = new InformedConsentModel();

        $data = $this->lowerKey($model->where('visit_id', $visit_id)
            ->where('body_id', $body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getDetailByVisit()
    {

        $json = $this->request->getJSON();

        $visit_id = $json->visit_id;


        $model = new InformedConsentModel();

        $data = $this->lowerKey($model->where('visit_id', $visit_id)
            ->where('p_type', 'GEN0019')
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function insertData()
    {
        $model = new InformedConsentModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $db = db_connect();
        $query = $this->lowerKey($db->query("SELECT * FROM assessment_parameter_value WHERE p_type='" . $formData['p_type'] . "' ")->getResultArray());

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
                $data['value_score'] = '';
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

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
    }

    public function updateData()
    {
        $model = new InformedConsentModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!isset($formData['body_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing body_id in request data']);
        }

        $bodyId = $formData['body_id'];

        $db = db_connect();

        $query = $db->query("SELECT * FROM assessment_parameter_value WHERE p_type='" . $formData['p_type'] . "' ")->getResultArray();

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
                $data['value_score'] = 0;
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

        $model = new InformedConsentModel();

        $deleted = $model->where('body_id', $formData['id'])
            ->where('visit_id', $formData['visit'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }

    public function getType()
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM ENTRY_TYPES");
        $data = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($data);
    }

    public function getTablesAll()
    {
        $tableNameRequest = service('request');
        $nameJson = $tableNameRequest->getJSON(true);

        if (!isset($nameJson['nameTables']) || !isset($nameJson['score']) || !isset($nameJson['vId'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request data']);
        }

        $tableName = $nameJson['nameTables'];
        $score = $nameJson['score'];
        $vId = $nameJson['vId'];

        $db = db_connect();
        $query = $db->query("SELECT * FROM $tableName");
        $data = $query->getResultArray();
        $data = $this->lowerKey($data);

        switch ($tableName) {
            case 'sex':
                $idColumn = 'gender';
                $valColumn = 'name_of_gender';
                break;
            case 'family_status':
                $idColumn = 'family_status_id';
                $valColumn = 'family_status';
                break;
            case 'agama':
                $idColumn = 'kode_agama';
                $valColumn = 'nama_agama';
                break;
            case 'JOB_CATEGORY':
                $idColumn = 'job_id';
                $valColumn = 'name_of_job';
                break;
            case 'class':
                $idColumn = 'class_id';
                $valColumn = 'name_of_class';
                break;
            case 'status_pasien':
                $idColumn = 'status_pasien_id';
                $valColumn = 'name_of_status_pasien';
                break;
            case 'family_type':
                $idColumn = 'class_id';
                $valColumn = 'name_of_class';
                break;
            case 'job_category':
                $idColumn = 'job_id';
                $valColumn = 'name_of_job';
                break;
            case 'marital_status':
                $idColumn = 'maritalstatusid';
                $valColumn = 'name_of_maritalstatus';
                break;
            case 'none':
                $idColumn = 'class_id';
                $valColumn = 'name_of_class';
                break;
            default:
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Unknown table name']);
        }

        $data = array_map(function ($item) use ($idColumn, $valColumn, $score, $vId) {
            return [
                'id' => $item[$idColumn],
                'val' => $item[$valColumn],
                'score' => $score,
                'vId' => $vId
            ];
        }, $data);

        return $this->response->setJSON($data);
    }

    public function cetakData($visit, $vactination = null)
    {

        if ($this->request->is('get')) {
            $decoded_visit = base64_decode($visit);
            $decoded_visit = json_decode($decoded_visit, true);
            $kopprintData = $this->kopprint();

            $db = db_connect();
            $query = $this->lowerKey($db->query("SELECT * FROM assessment_parameter_value WHERE p_type='GEN0019' AND parameter_id = '" . $decoded_visit['parameter_id'] . "'")->getResultArray());
            $visitation = $this->lowerKey($db->query("SELECT * FROM pasien_VISITATION WHERE visit_id = '" . $decoded_visit['visit_id'] . "'")->getResultArray());
            $data_cm_01 = $this->lowerKey($db->query(
                "
                SELECT ASSESSMENT_INFORMED_CONCENT.visit_id, ASSESSMENT_INFORMED_CONCENT.body_id, ASSESSMENT_INFORMED_CONCENT.p_type, ASSESSMENT_INFORMED_CONCENT.parameter_id, ASSESSMENT_INFORMED_CONCENT.VALUE_SCORE, ASSESSMENT_INFORMED_CONCENT.VALUE_INFO,ASSESSMENT_INFORMED_CONCENT.VALUE_DESC , ASSESSMENT_PARAMETER_VALUE.VALUE_INFO AS 'DESC',ASSESSMENT_INFORMED_CONCENT.MODIFIED_DATE FROM ASSESSMENT_INFORMED_CONCENT 
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_INFORMED_CONCENT.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                WHERE ASSESSMENT_INFORMED_CONCENT.visit_id = '" . $decoded_visit['visit_id'] . "' AND ASSESSMENT_INFORMED_CONCENT.p_type='GEN0019' AND ASSESSMENT_INFORMED_CONCENT.body_id = '" . $decoded_visit['body_id'] . "' AND ASSESSMENT_INFORMED_CONCENT.parameter_id = 'CM_A_01' 
                "
            )->getResultArray());
            $data_cm_02 = $this->lowerKey($db->query(
                "
                SELECT * 
                FROM assessment_informed_concent
                WHERE visit_id = '" . $decoded_visit['visit_id'] . "' AND p_type='GEN0019' AND body_id = '" . $decoded_visit['body_id'] . "' AND parameter_id = 'CM_A_02'
                "
            )->getResultArray());
            $data_cm_03 = $this->lowerKey($db->query(
                "
                SELECT * 
                FROM assessment_informed_concent
                WHERE visit_id = '" . $decoded_visit['visit_id'] . "' AND p_type='GEN0019' AND body_id = '" . $decoded_visit['body_id'] . "' AND parameter_id = 'CM_A_03'
                "
            )->getResultArray());

            return view("admin/patient/profilemodul/cetak-caseManager.php", [
                "visit" => $decoded_visit,
                "title" => "Dokumentasi Case Manager",
                'kop' => !empty($kopprintData) ? $kopprintData[0] : "",
                'AValue' => $query,
                'visitation' => $visitation,
                'data1' => $data_cm_01,
                'data2' => $data_cm_02,
                'data3' => $data_cm_03,
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
