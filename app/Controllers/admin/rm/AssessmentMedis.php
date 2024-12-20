<?php

namespace App\Controllers\Admin\rm;

use App\Controllers\Admin\AssDermatovenerologi;
use App\Controllers\Admin\AssNeurology;
use App\Controllers\BaseController;
use App\Models\Assessment\FallRiskDetailModel;
use App\Models\Assessment\FallRiskModel;
use App\Models\Assessment\GcsModel;
use App\Models\Assessment\LokalisModel;
use App\Models\Assessment\PainDetilModel;
use App\Models\Assessment\PainIntervensiModel;
use App\Models\Assessment\PainMonitoringModel;
use App\Models\Assessment\RespirationModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienHistoryModel;
use App\Models\PasienProceduresModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;

class AssessmentMedis extends BaseController
{
    public function addAssessmentMedis()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        foreach ($body as $key => $value) {
            $controller = new Assessment();
            if ($value["id"] == "formaddarm") {
                $medis = $this->saveAssessmentMedis($value["data"]);
            }
            if (str_contains($value["id"], "formGcs")) {
                // return json_encode(is_null($value["data"]));
                if (!is_null($value["data"]) && $value["data"] != [])
                    $gcs = $controller->saveGcs($value["data"]);
            }
            if (str_contains($value["id"], "formPainMonitoring")) {
                // return json_encode(!is_null($value["data"]) && $value["data"] != []);
                if (!is_null($value["data"]) && $value["data"] != [])
                    $monitoring = $controller->savePainMonitoring($value["data"]);
            }
            if (str_contains($value["id"], "formFallRisk")) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $fallRisk = $controller->saveFallRisk($value["data"]);
            }
            if (str_contains($value["id"], "formTriage")) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $triage = $controller->saveTriage($value["data"]);
            }
            if (str_contains($value["id"], "FormAssessmen_Neurologi")) {
                $neuroController = new AssNeurology();
                if (!is_null($value["data"]) && $value["data"] != [])
                    $neuro = $neuroController->saveDataLokal($value["data"]);
            }
            if (str_contains($value["id"], "FormAssessmen_Neurologi")) {
                $dermaController = new AssDermatovenerologi();
                if (!is_null($value["data"]) && $value["data"] != [])
                    $dermatologi = $dermaController->saveDataLokal($value["data"]);
            }
        }

        return json_encode([
            "medis" => @$medis,
            "gcs" => @$gcs,
            "monitoring" => @$monitoring,
            "fallRisk" => @$fallRisk,
            "neuro" => @$neuro,
            "dermatologi" => @$dermatologi,
            "triage" => @$triage
        ]);
    }

    private function saveAssessmentMedis($body)
    {
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }


        $ssjson = '{
                        "resourceType": "Bundle",
                        "type": "transaction",
                        "entry": [
                        ]
                    }';
        $ssjson = json_decode($ssjson, true);

        $pd = new PasienDiagnosaModel();

        $orgModel = new OrganizationunitModel();

        if ($pasien_diagnosa_id == '') {
            $pasien_diagnosa_id = $orgModel->generateId();
            $mesej = 'tambah';
        } else {
            $mesej = 'update';
        }

        if ($body_id != '') {
            $dataexam = [];
            $dataexam = [
                "body_id" => @$body_id,
                "document_id" => @$body_id,
                "org_unit_code" => @$org_unit_code,
                "pasien_diagnosa_id" => @$pasien_diagnosa_id,
                "no_registration" => @$no_registration,
                "visit_id" => @$visit_id,
                "clinic_id" => @$clinic_id,
                "class_room_id" => @$class_room_id,
                "bed_id" => @$bed_id,
                "in_date" => @$in_date,
                "exit_date" => @$exit_date,
                "keluar_id" => @$keluar_id,
                "examination_date" => str_replace('T', ' ', $date_of_diagnosa),
                "temperature" => @$temperature,
                "tension_upper" => @$tension_upper,
                "tension_below" => @$tension_below,
                "nadi" => @$nadi,
                "nafas" => @$nafas,
                "weight" => @$weight,
                "height" => @$height,
                "awareness" => @@$awareness,
                "saturasi" => @$saturasi,
                "arm_diameter" => @$arm_diameter,
                "anamnase" => @$anamnase,
                "alo_anamnase" => @$alloanamnase,
                "pemeriksaan" => @$pemeriksaan,
                "teraphy_desc" => @$teraphy_desc,
                "instruction" => @$instruction,
                "employee_id" => @$employee_id,
                "description" => @$description,
                "modified_date" => @$modified_date,
                "modified_by" => @$modified_by,
                "modified_from" => @$clinic_id,
                "status_pasien_id" => @$status_pasien_id,
                "ageyear" => @$ageyear,
                "agemonth" => @$agemonth,
                "ageday" => @$ageday,
                "thename" => @$thename,
                "theaddress" => @$theaddress,
                "theid" => @$theid,
                "isrj" => @$isrj,
                "gender" => @$gender,
                "doctor" => @$doctor,
                "petugas_id" => user()->getOneRoles(),
                "petugas" => user()->getFullname(),
                'vs_status_id' => '2',
                'valid_date' => @$valid_date,
                'valid_user' => @$valid_user,
                'valid_pasien' => @$valid_pasien,
                'account_id' => 1
            ];
            foreach ($body as $key => $value) {
                if (!(is_null(${$key}) || ${$key} == ''))
                    $dataexam[$key] = $value;
                if (isset($examination_date))
                    $dataexam['examination_date'] = str_replace("T", " ", $examination_date);
                if (isset($temperature))
                    $dataexam['temperature'] = (float)$dataexam['temperature'];
                else
                    $dataexam['temperature'] = 0;

                if (isset($tension_upper))
                    $dataexam['tension_upper'] = (float)$dataexam['tension_upper'];
                else
                    $dataexam['tension_upper'] = 0;

                if (isset($tension_below))
                    $dataexam['tension_below'] = (float)$dataexam['tension_below'];
                else
                    $dataexam['tension_upper'] = 0;

                if (isset($nadi))
                    $dataexam['nadi'] = (float)$dataexam['nadi'];
                else
                    $dataexam['nadi'] = 0;

                if (isset($nafas))
                    $dataexam['nafas'] = (float)$dataexam['nafas'];
                else
                    $dataexam['nafas'] = 0;

                if (isset($weight))
                    $dataexam['weight'] = (float)$dataexam['weight'];
                else
                    $dataexam['weight'] = 0;

                if (isset($height))
                    $dataexam['height'] = (float)$dataexam['height'];
                else
                    $dataexam['height'] = 0;

                if (isset($arm_diameter))
                    $dataexam['arm_diameter'] = (float)$dataexam['arm_diameter'];
                else
                    $dataexam['arm_diameter'] = 0;

                if (isset($saturasi))
                    $dataexam['saturasi'] = (int)$dataexam['saturasi'];
                else
                    $dataexam['saturasi'] = 0;
            }
            $ex = new ExaminationModel();
            $ex->save($dataexam);
            $exd = new ExaminationDetailModel();
            $exd->save($dataexam);
        }


        $data = [
            'org_unit_code' => @$org_unit_code,
            'pasien_diagnosa_id' => @$pasien_diagnosa_id,
            'no_registration' => @$no_registration,
            'visit_id' => @$visit_id,
            'clinic_id' => @$clinic_id,
            'class_room_id' => @$class_room_id,
            'in_date' => @$in_date,
            'exit_date' => @$exit_date,
            'bed_id' => @$bed_id,
            'keluar_id' => @$keluar_id,
            'date_of_diagnosa' => str_replace('T', ' ', $date_of_diagnosa),
            'report_date' => @$report_date,
            'diagnosa_desc' => @$diagnosa_desc,
            'employee_id' => @$employee_id,
            'diag_cat' => @$diag_cat,
            'anamnase' => @$anamnase,
            'alloanamnase' => @$alloanamnase,
            'description' => @$description,
            'pemeriksaan' => @$pemeriksaan,
            'body_id' => @$body_id,
            'teraphy_desc' => @$teraphy_desc,
            'teraphy_home' => @$teraphy_home,
            'therapy_target' => @$therapy_target,
            'medical_problem' => @$medical_problem,
            'hurt' => @$hurt,
            'lab_result' => @$lab_result,
            'ro_result' => @$ro_result,
            'ecg_result' => @$ecg_result,
            'standing_order' => @$standing_order,
            'instruction' => @$instruction,
            'result_id' => @$result_id,
            'modified_date' => new RawSql('getdate()'),
            'modified_by' => user()->username,
            'modified_from' => @$clinic_id,
            'status_pasien_id' => @$status_pasien_id,
            'ageyear' => @$ageyear,
            'agemonth' => @$agemonth,
            'ageday' => @$ageday,
            'thename' => @$thename,
            'theaddress' => @$theaddress,
            'theid' => @$theid,
            'isrj' => @$isrj,
            'gender' => @$gender,
            'doctor' => @$doctor,
            'fullname' => @$doctor,
            'nokartu' => @$nokartu,
            'nosep' => @$nosep,
            'tglsep' => @$tglsep,
            'spesialistik' => @$spesialistik,
            'sscondition_id' => new RawSql("newid()"),
            'valid_date' => @$valid_date,
            'valid_user' => @$valid_user,
            'valid_pasien' => @$valid_pasien,
            'specialist_type_id' => @$specialist_type_id
        ];






        if ($mesej == 'tambah') {
            // $mesej = 'tambah';
            $hasil = $pd->insert($data);
        } else {
            // return json_encode($data);
            $hasil = $pd->save($data);

            // $mesej = 'update';
        }


        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where VALUE_SCORE in (2, 3, 4, 5) and P_TYPE = 'GEN0002'")->getResultArray());

        $dokter = $db->query("select fullname from employee_all where employee_id = '$doctor'")->getFirstRow();
        $dokter = @$dokter['fullname'];

        // return json_encode($doctor);

        // return json_encode($lokalisG0020206);
        $lokalisModel = new LokalisModel();
        foreach ($select as $key => $value) {
            if (isset(${'lokalis' . $value['value_id']}) && $value['value_score'] == 3) {
                $data = explode(',', (string)${'lokalis' . $value['value_id']});
                $encodedLokalis = $data[1];
                $decodedLokalis = base64_decode($encodedLokalis);
                $lokalisPath = WRITEPATH . 'uploads/signatures/';
                if (!is_dir($lokalisPath)) {
                    mkdir($lokalisPath, 0777, true);
                }
                $filenameLokalis = $clinic_id . '_' . $pasien_diagnosa_id . $value['value_id'] . '.png';
                $fullPathLokalis = $lokalisPath . $filenameLokalis;
                if (file_put_contents($fullPathLokalis, $decodedLokalis)) {
                    $dataLokalis = [
                        'org_unit_code' => $org_unit_code,
                        'visit_id' => $visit_id,
                        'trans_id' => $visit_id,
                        'body_id' => $pasien_diagnosa_id,
                        'document_id' => $pasien_diagnosa_id,
                        'p_type' => $value['p_type'],
                        'parameter_id' => $value['parameter_id'],
                        'value_id' => $value['value_id'],
                        'value_score' => $value['value_score'],
                        'value_desc' => ${'lokalis' . $value['value_id'] . 'desc'},
                        'value_detail' => $filenameLokalis,
                        'value_info' => $value['value_info'],
                        'modified_by' => user()->username
                    ];
                    $db->query("delete from assessment_lokalis where body_id = '$pasien_diagnosa_id' and value_id = '" . $value['value_id'] . "'");
                    $lokalisModel->insert($dataLokalis);
                } else {
                    return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
                }
            } else if (isset(${'fisik' . $value['value_id']}) && $value['value_score'] == 2) {
                $dataLokalis = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $visit_id,
                    'body_id' => $pasien_diagnosa_id,
                    'p_type' => $value['p_type'],
                    'parameter_id' => $value['parameter_id'],
                    'value_id' => $value['value_id'],
                    'value_score' => $value['value_score'],
                    'value_desc' => $value['value_desc'],
                    'value_detail' => ${'fisik' . $value['value_id']},
                    'value_info' => $value['value_info'],
                    'modified_by' => user()->username
                ];
                $db->query("delete from assessment_lokalis where body_id = '$pasien_diagnosa_id' and value_id = '" . $value['value_id'] . "'");
                $lokalisModel->insert($dataLokalis);
            } else if (isset(${'lokalis' . $value['value_id']}) && ($value['value_score'] == 4 || $value['value_score'] == 5)) {
                $dataLokalis = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $visit_id,
                    'body_id' => $pasien_diagnosa_id,
                    'p_type' => $value['p_type'],
                    'parameter_id' => $value['parameter_id'],
                    'value_id' => $value['value_id'],
                    'value_score' => $value['value_score'],
                    'value_desc' => $value['value_desc'],
                    'value_detail' => ${'lokalis' . $value['value_id']},
                    'value_info' => $value['value_info'],
                    'modified_by' => user()->username
                ];
                $db->query("delete from assessment_lokalis where body_id = '$pasien_diagnosa_id' and value_id = '" . $value['value_id'] . "'");
                $lokalisModel->insert($dataLokalis);
            }
        }

        $pasienHistory = new PasienHistoryModel();

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
        $db->query("delete from pasien_history where no_registration = '$no_registration'");
        $i = 0;
        foreach ($select as $key => $value) {
            if (isset(${$value['value_id']})) {
                $i++;
                $dataHistory = [
                    'org_unit_code' => $org_unit_code,
                    'no_registration' => $no_registration,
                    'item_id' => $i,
                    'value_id' => $value['value_id'],
                    'value_desc' => $value['value_desc'],
                    'histories' => ${$value['value_id']},
                    'modified_by' => user()->username
                ];
                // $db->query("delete from pasien_history where no_registration = '$no_registration' and value_id = '" . $value['value_id'] . "'");
                $pasienHistory->insert($dataHistory);
            }
        }


        if (!empty($diag_id)) {
            $pds = new PasienDiagnosasModel();
            $pds->where('pasien_diagnosa_id', $pasien_diagnosa_id)->delete();

            foreach ($diag_id as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $pasien_diagnosa_id;
                $dataDiag['diagnosa_id'] = $diag_id[$key];
                $dataDiag['diagnosa_name'] = $diag_name[$key];
                $dataDiag['diag_cat'] = $diag_cat[$key];
                $dataDiag['suffer_type'] = $suffer_type[$key];
                $dataDiag['modified_by'] = user_id();
                $dataDiag['sscondition_id'] = new RawSql('newid()');

                $pds->insert($dataDiag);
            }
        }
        if (!empty($proc_id)) {
            $pcs = new PasienProceduresModel();
            $pcs->where('pasien_diagnosa_id', $pasien_diagnosa_id)->delete();

            foreach ($proc_id as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = $pasien_diagnosa_id;
                $dataProc['diagnosa_id'] = $proc_id[$key];
                $dataProc['diagnosa_name'] = $proc_name[$key];
                $dataProc['modified_by'] = user_id();
                $pcs->insert($dataProc);
            }
        }
        $array   = array('status' => 'success', 'error' => '', 'message' => $mesej . ' riwayat rekam medis berhasil', 'data' => $data);
        return ($array);
    }
    public function getSateliteMedis()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $pasien_diagnosa_id = $body['pasien_diagnosa_id'];
        $visit_id = $body['visit_id'];
        $gcs = $this->getGcs($pasien_diagnosa_id, $visit_id);
        $fallRisk = $this->getFallRisk($pasien_diagnosa_id, $visit_id);
        $painMonitoring = $this->getPainMonitoring($pasien_diagnosa_id, $visit_id);
        $pernapasan = $this->getPernapasan($pasien_diagnosa_id, $visit_id);
        if ($clinic_id = 'P012') {
            $apgar = $this->getApgar($pasien_diagnosa_id, $visit_id);
        }
        return $this->response->setJSON([
            'gcs' => $gcs,
            'fallRisk' => $fallRisk,
            'painMonitoring' => $painMonitoring,
            'pernapasan' => $pernapasan,
            'apgar' => @$apgar
        ]);
    }
    public function getGcs($bodyId, $visit)
    {
        $model = new GcsModel();
        if ($bodyId == '') {
            $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")->findAll());
        } else {
            $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        }
        return $select;
    }
    public function saveGcs($body)
    {

        $gcsconclution = [
            '',
            'Composmentis',
            'Apatis',
            'Delirium',
            'Samnolen',
            'Sopor',
            'Coma',
        ];

        $data = [];

        if (count($body) > 0) {
            // return ($body['OBJECT_STRANGE']);
            foreach ($body as $key => $value) {
                ${$key} = $value;
                if (!(is_null(${$key}) || ${$key} == ''))
                    $data[strtolower($key)] = $value;

                if (isset($examination_date))
                    $data['examination_date'] = str_replace("T", " ", $examination_date);
                if (isset($data['gcs_desc']))
                    $data['gcs_desc'] = $gcsconclution[$GCS_DESC];
            }

            // return json_encode($data);

            $model = new GcsModel();

            $model->save($data);
        }


        return ($data);
    }
    public function getFallRisk($bodyId, $visit)
    {

        $model = new FallRiskModel();
        if ($bodyId != '') {
            $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        } else {
            $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")->findAll());
        }

        if (count($select) > 0) {
            $db = db_connect();

            $queryDetil = "select * from assessment_fall_risk_detail where body_id in (";

            foreach ($select as $key => $value) {
                $queryDetil .= "'" . $value['body_id'] . "',";
            }
            $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);

            $queryDetil .= ");";

            $fallRiskDetil = $this->lowerKey($db->query($queryDetil)->getResultArray());
        }

        return [
            'fallRisk' => $select,
            'fallRiskDetail' => @$fallRiskDetil
        ];
    }
    public function saveFallRisk($body)
    {
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }
        if (count($body) > 0) {

            $data['p_type'] = $parameter001;
            // return json_encode($data);

            $model = new FallRiskModel();

            $model->save($data);

            // return json_encode($data);

            $db = db_connect();
            $p_type = $parameter001;
            // return json_encode($parameter001);

            if (true) {
                $fallRiskDetail  = new FallRiskDetailModel();

                $db->query("delete from assessment_fall_risk_detail where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

                $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER where P_TYPE = '$p_type'")->getResultArray());
                foreach ($select as $key => $value) {
                    $valueId = ${"parameter_id" . $value['parameter_id']};
                    $paramvalue = $this->lowerKey($db->query("select * from assessment_parameter_value where value_id = '$valueId'")->getResultArray());
                    if (isset($paramvalue[0])) {
                        $data = [
                            'org_unit_code' => $org_unit_code,
                            'visit_id' => $visit_id,
                            'trans_id' => $trans_id,
                            'body_id' => $body_id,
                            'p_type' => $p_type,
                            'parameter_id' => $value['parameter_id'],
                            'value_id' => $valueId,
                            'value_score' => $paramvalue[0]['value_score'],
                            'value_desc' => $paramvalue[0]['value_desc'],
                            'modified_date' => Time::now(),
                            'modified_by' => user()->username
                        ];
                        $fallRiskDetail->insert($data);
                    } else {
                        $paramvalue = $this->lowerKey($db->query("select * from assessment_parameter_value where parameter_id = '{$value['parameter_id']}' and p_type = '{$value['p_type']}'")->getResultArray());
                        // return json_encode($paramvalue);
                        if (isset($paramvalue[0])) {
                            $data = [
                                'org_unit_code' => $org_unit_code,
                                'visit_id' => $visit_id,
                                'trans_id' => $trans_id,
                                'body_id' => $body_id,
                                'p_type' => $p_type,
                                'parameter_id' => $paramvalue[0]['parameter_id'],
                                'value_id' => $paramvalue[0]['value_id'],
                                'value_score' => $paramvalue[0]['value_score'],
                                'value_desc' => ${"parameter_id" . $paramvalue[0]['parameter_id']},
                                'modified_date' => Time::now(),
                                'modified_by' => user()->username
                            ];
                            $fallRiskDetail->insert($data);
                        }
                    }
                }
            }
            return $body_id;
        } else {
            return '';
        }
    }
    public function getPainMonitoring($bodyId, $visit)
    {


        $db = db_connect();
        if ($bodyId != '') {
            $painMonitoring = $this->lowerKey($db->query("select * from ASSESSMENT_PAIN_MONITORING where visit_id = '$visit' and document_id = '$bodyId'  ")->getResultArray());
        } else {
            $painMonitoring = $this->lowerKey($db->query("select * from ASSESSMENT_PAIN_MONITORING where visit_id = '$visit'")->getResultArray());
        }

        if (count($painMonitoring) > 0) {
            $queryDetil = "select * from assessment_pain_detail where body_id in (";
            $queryIntervensi = "select * from assessment_pain_intervensi where body_id in (";

            foreach ($painMonitoring as $key => $value) {
                $queryDetil .= "'" . $value['body_id'] . "',";
                $queryIntervensi .= "'" . $value['body_id'] . "',";
            }
            $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);
            $queryIntervensi = substr($queryIntervensi, 0, strlen($queryIntervensi) - 1);

            $queryDetil .= ");";
            $queryIntervensi .= ") order by body_id, intervensi_ke;";

            $painDetil = $this->lowerKey($db->query($queryDetil)->getResultArray());
            $painIntervensi = $this->lowerKey($db->query($queryIntervensi)->getResultArray());
        }

        return ([
            'painMonitoring' => @$painMonitoring,
            'painDetil' => @$painDetil,
            'painIntervensi' => @$painIntervensi
        ]);
    }
    public function savePainMonitoring($body)
    {
        if (count($body) > 0) {
            foreach ($body as $key => $value) {
                ${$key} = $value;
            }
            // return $body['timeIntervensi'];

            $db = db_connect();
            $painMonitoring = new PainMonitoringModel();
            $data = [
                'org_unit_code' => $org_unit_code,
                'visit_id' => $visit_id,
                'trans_id' => $trans_id,
                'body_id' => $body_id,
                'no_registration' => $no_registration,
                'examination_date' => $examination_date,
                'clinic_id' => $clinic_id,
                'employee_id' => $employee_id,
                'petugas_id' => $petugas_id,
                'class_room_id' => $class_room_id,
                'bed_id' => $bed_id,
                'p_type' => $p_type,
                'description' => $description,
                'modified_date' => Time::now(),
                'modified_by' => $modified_by,
                'pain_monitoring_status' => $pain_monitoring_status,
                'document_id' => $document_id,
                'valid_date' => $valid_date,
                'valid_user' => $valid_user,
                'valid_pasien' => $valid_pasien
            ];
            // return json_encode($data);
            $db->query("delete from assessment_pain_monitoring where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

            $isSuccess = $painMonitoring->save($data);
            // return json_encode($parameter_id07);

            if (true) {
                $painDetil = new PainDetilModel();

                $db->query("delete from assessment_pain_detail where body_id = '$body_id' and visit_id = '$visit_id'");

                $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER where P_TYPE = 'ASES021' and parameter_id <> '07'")->getResultArray());
                foreach ($select as $key => $value) {
                    if (isset(${"parameter_id" . $value['parameter_id']})) {
                        $valueId = ${"parameter_id" . $value['parameter_id']};
                        $paramvalue = $this->lowerKey($db->query("select * from assessment_parameter_value where value_id = '$valueId'")->getResultArray());
                        // dd($parameter_id07);
                        if (isset($paramvalue[0])) {
                            $data = [
                                'org_unit_code' => $org_unit_code,
                                'visit_id' => $visit_id,
                                'trans_id' => $trans_id,
                                'body_id' => $body_id,
                                'p_type' => $p_type,
                                'parameter_id' => $value['parameter_id'],
                                'value_id' => $valueId,
                                'value_score' => $paramvalue[0]['value_score'],
                                'value_desc' => $paramvalue[0]['value_desc'],
                                'modified_date' => Time::now(),
                                'modified_by' => $modified_by
                            ];
                            $painDetil->insert($data);
                        }
                    }
                }
                if (isset($parameter_id07)) {
                    $data = [
                        'org_unit_code' => $org_unit_code,
                        'visit_id' => $visit_id,
                        'trans_id' => $trans_id,
                        'body_id' => $body_id,
                        'p_type' => $p_type,
                        'parameter_id' => '07',
                        'value_id' => '0210701',
                        'value_desc' => $parameter_id07,
                        'modified_date' => Time::now(),
                        'modified_by' => $modified_by
                    ];
                    $painDetil->insert($data);
                }

                if (isset($parameter_id01) && @$parameter_id01 != '0210101') {
                    $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER 
                                                    where P_TYPE = (select value_info from ASSESSMENT_PARAMETER_VALUE where VALUE_ID = '$parameter_id01')")->getResultArray());
                    $p_type = $select[0]['p_type'];
                    if (in_array($select[0]['p_type'], [
                        'ASES025',
                        'ASES026',
                        'ASES027'
                    ])) {
                        // $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER where P_TYPE = '$parameter_id01'")->getResultArray());
                        // return json_encode($select);
                        foreach ($select as $key => $value) {
                            $valueId = ${$value['p_type'] . $value['parameter_id']};
                            $paramvalue = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type='" . $value['p_type'] . "' and parameter_id='" . $value['parameter_id'] . "' and value_score = '$valueId'")->getResultArray());
                            if (isset($paramvalue[0])) {
                                $data = [
                                    'org_unit_code' => $org_unit_code,
                                    'visit_id' => $visit_id,
                                    'trans_id' => $trans_id,
                                    'body_id' => $body_id,
                                    'p_type' => $value['p_type'],
                                    'parameter_id' => $value['parameter_id'],
                                    'value_id' => $paramvalue[0]['value_score'],
                                    'value_score' => $paramvalue[0]['value_score'],
                                    'value_desc' => $paramvalue[0]['value_desc'],
                                    'modified_date' => Time::now(),
                                    'modified_by' => $modified_by
                                ];
                                $painDetil->insert($data);
                            }
                        }
                    }

                    if ($timeIntervensi != '' && $timeIntervensi != null && isset($timeIntervensi)) {
                        $painIntervensi = new PainIntervensiModel();
                        $db->query("delete from assessment_pain_intervensi where body_id = '$body_id'");
                        foreach ($timeIntervensi as $key => $value) {
                            // return json_encode(str_replace('T', ' ', $reassessment_date));

                            $data = [
                                'body_id' => $body_id,
                                'intervensi_ke' => $key,
                                'no_registration' => $no_registration,
                                'p_type' => $p_type,
                                'intervensi_date' => str_replace('T', ' ', $timeIntervensi[$key]),
                                'intervensi' => $intervensi[$key],
                                'rute' => $rute[$key],
                                'reassessment' => $reAssessment[$key],
                                'reassessment_date' => str_replace('T', ' ', $reassessment_date[$key]),
                                'valid' => null,
                                'petugas' => user()->username,
                                'modified_date' => Time::now(),
                                'modified_by' => $modified_by,
                                'value_id' => $painscalescore[$key]
                            ];
                            $painIntervensi->insert($data);
                        }
                    }
                }
            }
            return $body_id;
        } else {
            return '';
        }
    }
    public function getPernapasan($bodyId, $visit)
    {
        $db = db_connect();

        $napas = new RespirationModel();
        $select = $this->lowerKey($napas->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return $select;
    }
    public function getApgar($bodyId, $visit)
    {

        $db = db_connect();

        $apgar = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and document_id = '$bodyId' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());
        // return json_encode($apgar);

        if (count($apgar) > 0) {
            $apgarDetil = "select * from assessment_apgar_detail where body_id in (";

            foreach ($apgar as $key => $value) {
                $apgarDetil .= "'" . $value['body_id'] . "',";
            }
            $apgarDetil = substr($apgarDetil, 0, strlen($apgarDetil) - 1);

            $apgarDetil .= ");";

            $apgarDetil = $this->lowerKey($db->query($apgarDetil)->getResultArray());
        } else {
            $apgarDetil = null;
        }


        return ([
            'apgar' => $apgar,
            'apgarDetil' => $apgarDetil
        ]);
    }
}
