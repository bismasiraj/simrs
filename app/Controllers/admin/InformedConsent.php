<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\ExaminationModel;
use App\Models\InformedConsentModel;
use CodeIgniter\Controller;

class InformedConsent extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new InformedConsentModel();
    }

    public function getDataAssesment($id = null)
    {
        $db = db_connect();
        $aParam = $this->lowerKey($db->query("SELECT * from ASSESSMENT_PARAMETER where P_type = 'GEN0017' ORDER BY 
                                                TRY_CAST(PARSENAME(REPLACE(PARAMETER_ID, '_', '.'), 3) AS INT) DESC,
                                                TRY_CAST(PARSENAME(REPLACE(PARAMETER_ID, '_', '.'), 2) AS INT) DESC,
                                                TRY_CAST(PARSENAME(REPLACE(PARAMETER_ID, '_', '.'), 1) AS INT) DESC;")->getResultArray());
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

        $visit = $this->lowerKey($db->query("SELECT no_registration, class_id, class_id_plafond, status_pasien_id,isrj from PASIEN_VISITATION where VISIT_ID ='$id'")->getRowArray());

        $no_regis = $visit['no_registration'];
        $isrj = $visit['isrj'];



        $family = $this->lowerKey($db->query("SELECT * from FAMILY where NO_REGISTRATION ='$no_regis' and ISRESPONSIBLE = 1")->getRowArray());
        $diag = [];
        $model = new ExaminationModel();
        if ($isrj == '0') {
            $diag = $model->select("teraphy_desc as diagnosa_desc")->where("visit_id = '" . $id . "' and petugas_type = '11' and account_id <> 7")->orderBy("examination_date desc")->first();
        } else {
            $diag = $model->select("teraphy_desc as diagnosa_desc")->where("no_registration = '" . $no_regis . "' and petugas_type = '11' ")->orderBy("examination_date desc")->first();
        };

        // $diag = $this->lowerKey($db->query("SELECT 
        //                                         pd.NO_REGISTRATION, 
        //                                         pds.*
        //                                     FROM PASIEN_DIAGNOSA pd
        //                                     JOIN PASIEN_DIAGNOSAS pds 
        //                                         ON pd.PASIEN_DIAGNOSA_ID = pds.PASIEN_DIAGNOSA_ID
        //                                     WHERE 
        //                                         pd.NO_REGISTRATION = '$no_regis'
        //                                         AND pd.DIAGNOSA_ID IS NOT NULL
        //                                     ORDER BY 
        //                                         pd.DATE_OF_DIAGNOSA DESC;
        //                                     ")->getRowArray());

        $employeeAll = $this->lowerKey($db->query("SELECT FULLNAME FROM EMPLOYEE_ALL")->getResultArray());

        $data = [
            'aPram' => $aParam,
            'aValue' => $aValue,
            'options' => $options,
            'family' => $family,
            'visit' => $visit,
            'diag' => $diag,
            'employeeAll' => $employeeAll
        ];

        return $this->response->setJSON($data);
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $model = new InformedConsentModel();

        $data = $model->select('parameter_id, body_id, MIN(modified_date) AS modified_date,
                                    MAX(visit_id) AS visit_id,
                                    MAX(VALID_USER) AS VALID_USER,
                                    MAX(valid_pasien) AS valid_pasien,
                                    MAX(valid_other) AS valid_other,
                                    MAX(valid_other2) AS valid_other2,
                                    MAX(valid_other3) AS valid_other3')
            ->where('visit_id', $formData['visit_id'])
            ->where('p_type', 'GEN0017')
            ->groupBy(['body_id', 'parameter_id'])
            ->orderBy('MIN(modified_date)', 'ASC')
            ->findAll();


        $data = $this->lowerKey($data);

        return $this->response->setJSON($data);
    }


    public function getDetail()
    {
        $json = $this->request->getJSON();
        $db = db_connect();

        $visit_id = $json->visit_id;
        $body_id = $json->body_id;
        $parameter_id = $json->parameter_id;

        $model = new InformedConsentModel();

        $data = $this->lowerKey($model->where('visit_id', $visit_id)
            ->where('body_id', $body_id)
            ->where('parameter_id', $parameter_id)
            ->findAll());

        $noRegVisit = $this->lowerKey($db->query(
            'SELECT NO_REGISTRATION FROM PASIEN_VISITATION WHERE VISIT_ID = ?',
            [$visit_id]
        )->getRowArray());

        $signs = $this->lowerKey($db->query(
            'SELECT * FROM DOCS_SIGNED WHERE DOCS_TYPE = 13 AND sign_id = ?',
            [$body_id]
        )->getResultArray());

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        $signsWithTtd = [];

        foreach ($signs as $sign) {
            $ttdBase64 = null;

            if ($sign['user_type'] == 1) {
                $signPath = $sign['sign_path'] ?? '';
                $namaDokter = trim(explode(':', $signPath)[0]);

                $employeeQuery = $db->query(
                    'SELECT employee_id FROM EMPLOYEE_ALL WHERE NONACTIVE = 0 AND FULLNAME LIKE ?',
                    ['%' . $namaDokter . '%']
                )->getRowArray();


                if ($employeeQuery) {
                    $employeeId = $employeeQuery['employee_id'];
                    $ttdDokterDir = $this->imageloc . "uploads/dokter/";

                    foreach ($allowedExtensions as $ext) {
                        $pattern = $ttdDokterDir . '*' . $employeeId . '*.' . $ext;
                        $files = glob($pattern);
                        if (!empty($files)) {
                            $filePath = $files[0];
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }
            } else  if ($sign['user_type'] == 2) {
                $noReg = $noRegVisit['no_registration'] ?? '';
                if (!empty($noReg)) {
                    $ttdPasienDir = $this->imageloc . "uploads/signatures/";

                    foreach ($allowedExtensions as $ext) {
                        $pattern = $ttdPasienDir . '*' . $noReg . '*.' . $ext;
                        $files = glob($pattern);
                        if (!empty($files)) {
                            $filePath = $files[0];
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }
            } else {
                $noReg = $noRegVisit['no_registration'] ?? '';
                if (!empty($noReg) && isset($sign['sign_path'])) {
                    $pos = strpos($sign['sign_path'], ':');
                    $filename = $noReg . '-' . substr($sign['sign_path'], 0, $pos);
                    $ttdPasienDir = $this->imageloc . "uploads/signatures/";

                    foreach ($allowedExtensions as $ext) {
                        $pattern = $ttdPasienDir . '*' . $filename . '*.' . $ext;
                        $files = glob($pattern);
                        if (!empty($files)) {
                            $filePath = $files[0];
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }
            }

            $sign['ttd_sign'] = $ttdBase64;
            $signsWithTtd[] = $sign;
        }

        $result = [
            'data' => $data,
            'sign' => $signsWithTtd
        ];

        return $this->response->setJSON($result);
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

        if (!isset($formData['body_id']) || !isset($formData['parameter_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing required parameters']);
        }

        $bodyId = $formData['body_id'];
        $parameterId = $formData['parameter_id'];
        $db = db_connect();

        $query = $db->query("SELECT * FROM assessment_parameter_value WHERE p_type = ? AND parameter_id = ?", [$formData['p_type'], $parameterId])->getResultArray();

        if (!$query) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'No data found for given parameters']);
        }

        $query = $this->lowerKey($query);
        $updateData = [];

        foreach ($query as $key) {
            $valueId = $key['value_id'];
            $data = [
                'org_unit_code' => $formData['org_unit_code'] ?? null,
                'visit_id' => $formData['visit_id'] ?? null,
                'trans_id' => $formData['trans_id'] ?? null,
                'body_id' => $bodyId,
                'p_type' => $formData['p_type'],
                'parameter_id' => $key['parameter_id'],
                'value_id' => $valueId,
                'modified_by' => user()->username,
            ];

            foreach (['value_score', 'value_desc', 'value_info'] as $field) {
                $fieldKey = "{$field}-{$valueId}";
                $data[$field] = $formData[$fieldKey] ?? ($field === 'value_score' ? 0 : '');
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


            // echo json_encode($decoded_visit);
            // exit();
            // print_r($kopprintData);
            // exit();
            $db = db_connect();
            $query = $this->lowerKey($db->query("SELECT * FROM assessment_parameter_value WHERE p_type='GEN0017' AND parameter_id = '" . $decoded_visit['parameter_id'] . "'")->getResultArray());
            $visitation = $this->lowerKey($db->query("SELECT * FROM pasien_VISITATION WHERE visit_id = '" . $decoded_visit['visit_id'] . "'")->getResultArray());

            return view("admin/patient/profilemodul/cetak-informedConsent.php", [
                "visit" => $decoded_visit,
                "title" => "",
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
