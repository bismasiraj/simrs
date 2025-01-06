<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\InformedConsentModel;
use CodeIgniter\Controller;

class InformedConsent extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new InformedConsentModel();
    }

    // public function getData()
    // {
    //     $request = service('request');
    //     $formData = $request->getJSON(true);

    //     $model = new InformedConsentModel();
    //     // $data = $this->lowerKey($model->where('visit_id', $formData['visit_id'])->findAll());
    //     $data = $this->lowerKey($model->query(
    //         "
    //         SELECT DISTINCT PARAMETER_ID, BODY_ID, VISIT_ID
    //         FROM ASSESSMENT_INFORMED_CONCENT WHERE VISIT_ID = '" . $formData['visit_id'] . "'
    //         "
    //     )->getResultArray());

    //     return $this->response->setJSON($data);
    // }

    // public function getDataAssesment()
    // {
    //     $db = db_connect();
    //     $aParam = $this->lowerKey($db->query("SELECT * from ASSESSMENT_PARAMETER where P_type = 'GEN0017'")->getResultArray());
    //     $aValue = $this->lowerKey($db->query("SELECT * from ASSESSMENT_PARAMETER_VALUE where P_type = 'GEN0017'")->getResultArray());

    //     $data = [
    //         'aPram' => $aParam,
    //         'aValue' => $aValue,
    //     ];

    //     return $this->response->setJSON($data);
    // }
    public function getDataAssesment($id = null)
    {
        $db = db_connect();
        $aParam = $this->lowerKey($db->query("SELECT * from ASSESSMENT_PARAMETER where P_type = 'GEN0017'")->getResultArray());
        $aValue = $this->lowerKey($db->query("SELECT * from ASSESSMENT_PARAMETER_VALUE where P_type = 'GEN0017'")->getResultArray());
        $queryAssessment = "SELECT 'sex' AS category, gender AS id, name_of_gender AS name FROM SEX
                            UNION
                            SELECT 'family_status' AS category, family_status_id AS id, FAMILY_STATUS AS name FROM FAMILY_STATUS
                            UNION
                            SELECT 'agama' AS category, kode_agama AS id, nama_agama AS name FROM AGAMA
                            UNION
                            SELECT 'class' AS category, class_id AS id, name_of_class AS name FROM CLASS
                            UNION
                            SELECT 'job_category' AS category, job_id AS id, name_of_job AS name FROM JOB_CATEGORY
                            UNION
                            SELECT 'marital_status' AS category, maritalstatusid AS id, name_of_maritalstatus AS name FROM MARITAL_STATUS
                            UNION
                            SELECT 'status_pasien' AS category, status_pasien_id AS id, name_of_status_pasien AS name FROM STATUS_PASIEN

                        ";
        $options = $db->query($queryAssessment)->getResultArray();

        $visit = $this->lowerKey($db->query("SELECT no_registration, class_id, class_id_plafond, status_pasien_id from PASIEN_VISITATION where VISIT_ID ='$id'")->getRowArray());

        $no_regis = $visit['no_registration'];


        $family = $this->lowerKey($db->query("SELECT * from FAMILY where NO_REGISTRATION ='$no_regis' and ISRESPONSIBLE = 1")->getRowArray());

        $data = [
            'aPram' => $aParam,
            'aValue' => $aValue,
            'options' => $options,
            'family' => $family,
            'visit' => $visit
        ];

        return $this->response->setJSON($data);
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $model = new InformedConsentModel();

        $data = $model->select('visit_id, parameter_id, body_id, MIN(modified_date) as modified_date, VALID_USER')
            ->where('visit_id', $formData['visit_id'])
            ->where('p_type', 'GEN0017')
            ->groupBy(['visit_id', 'parameter_id', 'body_id', 'VALID_USER'])
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
        $parameter_id = $json->parameter_id;


        $model = new InformedConsentModel();

        $data = $this->lowerKey($model->where('visit_id', $visit_id)
            ->where('body_id', $body_id)
            ->where('parameter_id', $parameter_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function insertData()
    {
        $model = new InformedConsentModel();
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

        if (!isset($formData['parameter_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing parameter_id in request data']);
        }

        $bodyId = $formData['body_id'];
        $parameterId = $formData['parameter_id'];

        $db = db_connect();

        $query = $db->query("SELECT * FROM assessment_parameter_value WHERE p_type='" . $formData['p_type'] . "' AND parameter_id = '" . $parameterId . "'")->getResultArray();

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
    public function cetakData($visit, $vactination = null)
    {
        if ($this->request->is('get')) {
            $decoded_visit = base64_decode($visit);
            $decoded_visit = json_decode($decoded_visit, true);
            $kopprintData = $this->kopprint();

            // print_r($kopprintData);
            // exit();
            $db = db_connect();
            $query = $this->lowerKey($db->query("SELECT * FROM assessment_parameter_value WHERE p_type='GEN0017' AND parameter_id = '" . $decoded_visit['parameter_id'] . "'")->getResultArray());
            $visitation = $this->lowerKey($db->query("SELECT * FROM pasien_VISITATION WHERE visit_id = '" . $decoded_visit['visit_id'] . "'")->getResultArray());


            return view("admin/patient/profilemodul/cetak-informedConsent.php", [
                "visit" => $decoded_visit,
                "title" => "Informed Consent - Seksio Sesarea - MOW",
                "title2" => "Persetujuan Tindakan Kedokteran",
                'kop' => !empty($kopprintData) ? $kopprintData[0] : "",
                'AValue' => $query,
                'visitation' => $visitation
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

    public function getTableByID()
    {
        $tableNameRequest = service('request');
        $nameJson = $tableNameRequest->getJSON(true);

        if (!isset($nameJson['nameTables']) || !isset($nameJson['vId']) || !isset($nameJson['vInfo'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request data']);
        }

        $tableName = $nameJson['nameTables'];
        $vId = $nameJson['vId'];
        $vInfo = $nameJson['vInfo'];

        $db = db_connect();
        $query = $db->query("SELECT * FROM $tableName WHERE $vId = $vInfo ");
        $data = $query->getResultArray();
        $data = $this->lowerKey($data);

        switch ($tableName) {
            case 'sex':
                $valColumn = 'name_of_gender';
                break;
            case 'family_status':
                $valColumn = 'family_status';
                break;
            case 'agama':
                $valColumn = 'nama_agama';
                break;
            case 'JOB_CATEGORY':
                $valColumn = 'name_of_job';
                break;
            case 'class':
                $valColumn = 'name_of_class';
                break;
            case 'class_room':
                $valColumn = 'name_of_class';
                break;
            case 'status_pasien':
                $valColumn = 'name_of_status_pasien';
                break;
            case 'family_type':
                $valColumn = 'name_of_class';
                break;
            case 'job_category':
                $valColumn = 'name_of_job';
                break;
            case 'marital_status':
                $valColumn = 'name_of_maritalstatus';
                break;
            case 'pasien':
                $valColumn = 'kk_no';
                break;
            case 'family':
                $valColumn = 'mobile';
                break;
            case 'none':
                $valColumn = 'name_of_class';
                break;
            default:
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Unknown table name']);
        }


        $data = array_column($data, $valColumn);

        return $this->response->setJSON($data);
    }

    public function getParameterOption()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();
        $sql = "
                SELECT 'sex' AS category, 'gender' AS id, name_of_gender AS name FROM SEX
                UNION
                SELECT 'family_status' AS category, 'family_status_id' AS id, FAMILY_STATUS AS name FROM FAMILY_STATUS
                UNION
                SELECT 'agama' AS category, 'kode_agama' AS id, nama_agama AS name FROM AGAMA
                UNION
                SELECT 'class' AS category, 'class_id' AS id, name_of_class AS name FROM CLASS
                UNION
                SELECT 'job_category' AS category, 'job_id' AS id, name_of_job AS name FROM JOB_CATEGORY
                UNION
                SELECT 'marital_status' AS category, 'marital_status_id' AS id, name_of_maritalstatus AS name FROM MARITAL_STATUS
                UNION
                SELECT 'status_pasien' AS category, 'status_pasien_id' AS id, name_of_status_pasien AS name FROM STATUS_PASIEN

        ";
        $result = $this->lowerKey($db->query($sql)->getResultArray() ?? []);

        return $this->response->setJSON([
            'data' => $result
        ]);
    }
}
