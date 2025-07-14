<?php

namespace App\Controllers\Admin\rm;

use App\Controllers\Admin\AssDermatovenerologi;
use App\Controllers\Admin\AssNeurology;
use App\Controllers\BaseController;
use App\Models\Assessment\EducationFormModel;
use App\Models\Assessment\FallRiskDetailModel;
use App\Models\Assessment\FallRiskModel;
use App\Models\Assessment\GcsModel;
use App\Models\Assessment\IndicatorModel;
use App\Models\Assessment\LokalisModel;
use App\Models\Assessment\PainDetilModel;
use App\Models\Assessment\PainIntervensiModel;
use App\Models\Assessment\PainMonitoringModel;
use App\Models\Assessment\PasienTransferModel;
use App\Models\Assessment\RespirationModel;
use App\Models\Assessment\TriaseDetilModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienHistoryModel;
use App\Models\PasienProceduresModel;
use App\Models\PasienVisitationModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;

class AssessmentMedis extends BaseController
{
    public function getAssessmentMedis()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];
        $no_registration = $body['nomor'];
        $diag_cat = $body['diagCat'];
        $norujukan = $body['norujukan'];
        $isrj = $body['isrj'];

        $stringDiagCat = "";
        if ($diag_cat != 99) {
            // $stringDiagCat = " and pd.diag_cat = '$diag_cat'";
        }

        $db = db_connect();
        if ($isrj == 1) {
            $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname,
            eid.weight, eid.height, eid.temperature, eid.nadi, eid.tension_upper, eid.tension_below, eid.saturasi, eid.nafas, eid.arm_diameter, eid.saturasi, eid.vs_status_id, eid.awareness
            from pasien_diagnosa pd 
            inner join pasien_visitation pv on pd.visit_id = pv.visit_id
            left join examination_info ei on ei.body_id = pd.body_id
            left join examination_detail eid on ei.body_id = eid.document_id
            left join employee_all ea on pd.employee_id = ea.employee_id 
            left join clinic c on pd.clinic_id = c.clinic_id where pd.no_registration = ? 
            and (pd.visit_id = ? or pv.norujukan = ?)" . $stringDiagCat, [$no_registration, $visit_id, $norujukan])->getResultArray());
        } else {
            $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname,
            eid.weight, eid.height, eid.temperature, eid.nadi, eid.tension_upper, eid.tension_below, eid.saturasi, eid.nafas, eid.arm_diameter, eid.saturasi, eid.vs_status_id, eid.awareness
            from pasien_diagnosa pd left join examination_info ei on ei.body_id = pd.body_id
            left join examination_detail eid on ei.body_id = eid.document_id
            left join employee_all ea on pd.employee_id = ea.employee_id 
            left join clinic c on pd.clinic_id = c.clinic_id where pd.no_registration = ? and pd.visit_id = ?" . $stringDiagCat, [$no_registration, $visit_id])->getResultArray());
        }
        // $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname,
        // ei.weight, ei.height, ei.temperature, ei.nadi, ei.tension_upper, ei.tension_below, ei.saturasi, ei.nafas, ei.arm_diameter, ei.saturasi, ei.vs_status_id, ei.awareness
        // from pasien_diagnosa pd left join examination_info ei on ei.body_id = pd.body_id
        // left join employee_all ea on pd.employee_id = ea.employee_id 
        // left join clinic c on pd.clinic_id = c.clinic_id where pd.no_registration = '$no_registration' and pd.visit_id = '$visit_id'" . $stringDiagCat)->getResultArray());

        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = ", [$no_registration])->getResultArray());

        // return json_encode($selectpd);
        if (isset($selectpd[0])) {
            $primaryPD = "";
            foreach ($selectpd as $key => $value) {
                $primaryPD .= "'" . $value['pasien_diagnosa_id'] . "',";
            }
            $primaryPD = substr($primaryPD, 0, -1);
            // return ($primaryPD);
            $selectdiagnosas = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());
            $selectprocedures = $this->lowerKey($db->query("select * from pasien_procedures where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());

            $selectlokalis = $this->lowerKey($db->query("select * from assessment_lokalis where body_id in ($primaryPD)")->getResultArray());


            foreach ($selectlokalis as $key => $value) {
                if ($value['value_score'] == 3) {
                    $filepath = $this->imageloc . 'uploads/lokalis/' . $value['value_detail'];
                    if (file_exists($filepath)) {
                        $filedata = file_get_contents($filepath);
                        $filedata64 = base64_encode($filedata);
                        $selectlokalis[$key]['filedata64'] = $filedata64;
                    }
                }
            }

            return json_encode([
                'pasienDiagnosa' => $selectpd,
                'pasienHistory' => $selecthistory,
                'pasienDiagnosas' => $selectdiagnosas,
                'pasienProcedures' => $selectprocedures,
                'lokalis' => $selectlokalis
            ]);
        } else {
            return json_encode([
                'pasienDiagnosa' => $selectpd,
                'pasienHistory' => $selecthistory,
                // 'papsienDiagnosas' => $selectdiagnosas,
                // 'pasienProcedures' => $selectprocedures,
                // 'lokalis' => $selectlokalis
            ]);
        }
    }
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
            if (strpos($value["id"], "formEducationForm") !== false) {
                // return json_encode(is_null($value["data"]));
                if (!is_null($value["data"]) && $value["data"] != [])
                    $education = $controller->saveeducationForm($value["data"]);
            }
            if (strpos($value["id"], "formGcs") !== false) {
                // return json_encode(is_null($value["data"]));
                if (!is_null($value["data"]) && $value["data"] != [])
                    $gcs = $controller->saveGcs($value["data"]);
            }
            if (strpos($value["id"], "formPainMonitoring") !== false) {
                // return json_encode(!is_null($value["data"]) && $value["data"] != []);
                if (!is_null($value["data"]) && $value["data"] != [])
                    $monitoring = $controller->savePainMonitoring($value["data"]);
            }
            if (strpos($value["id"], "formFallRisk") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $fallRisk = $controller->saveFallRisk($value["data"]);
            }
            if (strpos($value["id"], "formTriage") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $triage = $controller->saveTriage($value["data"]);
            }
            if (strpos($value["id"], "FormAssessmen_Neurologi") !== false) {
                $neuroController = new AssNeurology();
                if (!is_null($value["data"]) && $value["data"] != [])
                    $neuro = $neuroController->saveDataLokal($value["data"]);
            }
            if (strpos($value["id"], "FormAssessmen_Dermatovenerologi") !== false) {
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
            "triage" => @$triage,
            "educationForm" => @$education
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
        if ((!is_null(@$standing_order) && @$standing_order != '') && (!is_null(@$instruction) && @$instruction != ''))
            $newInstruction =
                "Standing Order: $standing_order"
                . "; Terapi/Sasaran Terapi: $instruction;";
        else if (!is_null(@$instruction) && @$instruction != '')
            $newInstruction = "Terapi/Sasaran Terapi: $instruction;";
        else
            $newInstruction = '';

        // return $body_id;
        $dataexam = [];
        if ($body_id != '') {
            $dataexam = [
                'account_id' => 1,
                'ageday' => @$ageday,
                'agemonth' => @$agemonth,
                'ageyear' => @$ageyear,
                'alo_anamnase' => @$alloanamnase,
                'anamnase' => @$anamnase,
                'arm_diameter' => @$arm_diameter,
                'awareness' => @$awareness,
                'bed_id' => @$bed_id,
                'body_id' => @$pasien_diagnosa_id,
                'cardiovasculer' => @$cardiovasculer,
                'child_position' => @$child_position,
                'clinic_id' => @$clinic_id,
                'cervix' => @$cervix,
                'djj' => @$djj,
                'class_room_id' => @$class_room_id,
                'description' => @$description,
                'doctor' => @$doctor,
                'document_id' => @$body_id,
                'employee_id' => @$employee_id,
                'exit_date' => @$exit_date,
                'examination_date' => str_replace('T', ' ', $date_of_diagnosa),
                'general_condition' => @$general_condition,
                'gender' => @$gender,
                'heart_sound' => @$heart_sound,
                'his_duration' => @$his_duration,
                'his_freq' => @$his_freq,
                'his_power' => @$his_power,
                'his_simetry' => @$his_simetry,
                'height' => @$height,
                'in_date' => @$in_date,
                'instruction' => @$newInstruction,
                'isrj' => @$isrj,
                'lochia' => @$lochia,
                'modified_by' => @$modified_by,
                'modified_date' => new RawSql('getdate()'),
                'modified_from' => @$clinic_id,
                'keluar_id' => @$keluar_id,
                'nafas' => @$nafas,
                'nafas_score' => @$nafas_score,
                'nadi' => @$nadi,
                'nadi_score' => @$nadi_score,
                'no_registration' => @$no_registration,
                'oedema' => @$oedema,
                'org_unit_code' => @$org_unit_code,
                'oxygen_usage' => @$oxygen_usage,
                'oxygen_usage_score' => @$oxygen_usage_score,
                'pain' => @$pain,
                'pemeriksaan' => @$pemeriksaan,
                'petugas' => user()->getFullname(),
                'petugas_id' => user()->getOneRoles(),
                'petugas_type' => 11,
                'pasien_diagnosa_id' => @$pasien_diagnosa_id,
                'proteinuria' => @$proteinuria,
                'respiration' => @$respiration,
                'status_pasien_id' => @$status_pasien_id,
                'saturasi' => @$saturasi,
                'saturasi_score' => @$saturasi_score,
                'temperature' => @$temperature,
                'temperature_score' => @$temperature_score,
                'teraphy_desc' => @$diagnosa_desc,
                'theaddress' => @$theaddress,
                'theid' => @$theid,
                'thename' => @$thename,
                'tfu' => @$tfu,
                'tension_below' => @$tension_below,
                'tension_below_score' => @$tension_below_score,
                'tension_upper' => @$tension_upper,
                'tension_upper_score' => @$tension_upper_score,
                'trans_id' => @$trans_id,
                'urine' => @$urine,
                'vs_status_id' => @$vs_status_id,
                'valid_date' => @$valid_date == '' ? null : @$valid_date,
                'valid_pasien' => @$valid_pasien == '' ? null : @$valid_pasien,
                'valid_user' => @$valid_user == '' ? null : @$valid_user,
                'visit_id' => @$visit_id,
                'weight' => @$weight
            ];
            if (@$diag_cat == 1) {
                $dataexam['account_id'] = 7;
            }
            foreach ($dataexam as $key => $value) {
                if (@$value == '') {
                    $dataexam[$key] = null;
                }
            }

            // return $body_id;

            foreach ($body as $key => $value) {
                // if (isset($examination_date))
                //     $dataexam['examination_date'] = str_replace("T", " ", $examination_date);
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
            foreach ($dataexam as $key => $value) {
                if (@$value == '') {
                    unset($dataexam[$key]);
                }
            }
            // return ($dataexam);
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
            'diagnosa_desc_discharge' => @$diagnosa_desc_discharge,
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
            'fullname' => $this->getFullname($employee_id),
            'nokartu' => @$nokartu,
            'nosep' => @$nosep,
            'tglsep' => @$tglsep,
            'spesialistik' => @$spesialistik,
            // 'sscondition_id' => new RawSql("newid()"),
            'valid_date' => @$valid_date,
            'valid_user' => @$valid_user,
            'valid_pasien' => @$valid_pasien,
            'specialist_type_id' => @$specialist_type_id,
            'procedure_desc' => @$procedure_desc,
            'procedure_desc_discharge' => @$procedure_desc_discharge,
            'discharge_way' => @$discharge_way,
            'discharge_condition' => @$discharge_condition,
            // 'fullname' => $this->getFullname(@$employee_id),
            'name_of_clinic' => $this->getClinicName(@$clinic_id),
            'emergency' => @$emergency
        ];


        foreach ($data as $key => $value) {
            if ($value == '') {
                $data[$key] = null;
            }
        }

        foreach ($dataexam as $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $dataexam[$key];
            }
        }




        if ($mesej == 'tambah') {
            // $mesej = 'tambah';
            $hasil = $pd->insert($data);
        } else {
            // return json_encode($data);
            $hasil = $pd->save($data);
        }


        $data['exam'] = $dataexam;



        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where VALUE_SCORE in (2, 3, 4, 5) and P_TYPE = 'GEN0002'")->getResultArray());

        $dokter = $db->query("select fullname from employee_all where employee_id = '$doctor'")->getFirstRow();
        $dokter = @$dokter['fullname'];

        // return json_encode($doctor);

        // return json_encode($lokalisG0020206);
        $lokalisModel = new LokalisModel();
        $lokalisArray = [];

        foreach ($select as $key => $value) {
            if (isset(${'lokalis' . $value['value_id']}) && $value['value_score'] == 3) {
                $dataImage = explode(',', (string)${'lokalis' . $value['value_id']});
                $encodedLokalis = $dataImage[1];
                // return $data;
                $decodedLokalis = base64_decode($encodedLokalis);
                $lokalisPath = $this->imageloc . 'uploads/lokalis/';
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
                        'modified_by' => user()->username,
                        'filedata64' => $encodedLokalis
                    ];
                    $db->query("delete from assessment_lokalis where body_id = '$pasien_diagnosa_id' and value_id = '" . $value['value_id'] . "'");
                    $lokalisModel->insert($dataLokalis);
                } else {
                    return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
                }
                $lokalisArray[] = $dataLokalis;
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
                $lokalisArray[] = $dataLokalis;
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
                $lokalisArray[] = $dataLokalis;
            }
        }
        $data['lokalis'] = $lokalisArray;

        $pasienHistory = [];

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
        // $db->query("delete from pasien_history where no_registration = '$no_registration'");
        $i = 0;
        foreach ($select as $key => $value) {
            if (isset(${$value['value_id']})) {

                $i++;
                $db->query("MERGE INTO pasien_history AS target
                USING (VALUES ('$org_unit_code', '$no_registration', '$i', '" . $value['value_id'] . "', '" . $value['value_desc'] . "', '" . ${$value['value_id']} . "', '" . user()->username . "', getdate())) AS source 
                (org_unit_code, no_registration, item_id, value_id,value_desc, histories,modified_by, modified_date)
                        ON target.no_registration = source.no_registration and target.value_id = source.value_id
                        WHEN MATCHED THEN
                            UPDATE SET target.org_unit_code = source.org_unit_code, target.item_id = source.item_id, 
                            target.histories = source.histories, target.modified_by = source.modified_by, target.modified_date = getdate()
                            WHEN NOT MATCHED BY TARGET THEN
                            INSERT (org_unit_code, no_registration, item_id, value_id,value_desc, histories,modified_by, modified_date)
                            VALUES ('$org_unit_code', '$no_registration', '$i', '" . $value['value_id'] . "', '" . $value['value_desc'] . "', '" . ${$value['value_id']} . "', '" . user()->username . "', getdate());");
                $pasienHistory[] = [
                    'org_unit_code' => $org_unit_code,
                    'no_registration' => $no_registration,
                    'item_id' => $i,
                    'value_id' => $value['value_id'],
                    'value_desc' => $value['value_desc'],
                    'histories' => ${$value['value_id']},
                    'modified_by' => user()->username,
                    'modified_date' => Time::now()
                ];
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
            $pcs->where('pasien_diagnosa_id', @$pasien_diagnosa_id)->delete();

            foreach ($proc_id as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = @$pasien_diagnosa_id;
                $dataProc['diagnosa_id'] = @$proc_id[$key];
                $dataProc['diagnosa_name'] = @$proc_name[$key];
                $dataProc['modified_by'] = user_id();
                $pcs->insert($dataProc);
            }
        }
        if (@$clinic_id == 'P012') {
            $pv = new PasienVisitationModel();
            // $emergency = @$emergency ?? '';
            // $employee_id = @$employee_id ?? '';
            $pvdata = [
                'patient_category_id' => @$emergency,
                // 'employee_id' => @$employee_id,
                'visit_id' => @$visit_id
            ];

            $tb = new TreatmentBillModel();
            // $db->query("update pasien_visitation
            // set patient_category_id = '$emergency',
            // employee_id = '$employee_id'
            // where visit_id = '$visit_id'
            // ");
            $pv->set([
                'patient_category_id' => @$emergency,
                // 'employee_id' => @$employee_id
            ])->where('visit_id', @$visit_id)->update();
            // return json_encode($pvdata);
            $pv->save($pvdata);
            // $tb->where("visit_id", @$visit_id)->where("tarif_id", "0211001")->set("employee_id", @$employee_id)->update();
        }
        $data['pasienHistory'] = $pasienHistory;

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
        // $triage = $this->getTriage($pasien_diagnosa_id, $visit_id);
        $gcs = $this->getGcs($pasien_diagnosa_id, $visit_id);
        $fallRisk = $this->getFallRisk($pasien_diagnosa_id, $visit_id);
        $painMonitoring = $this->getPainMonitoring($pasien_diagnosa_id, $visit_id);
        $pernapasan = $this->getPernapasan($pasien_diagnosa_id, $visit_id);
        $educationForm = $this->getEducation($pasien_diagnosa_id, $visit_id);
        $examDetail = $this->getExamDetail($pasien_diagnosa_id, $visit_id);
        if ($clinic_id = 'P012') {
            $apgar = $this->getApgar($pasien_diagnosa_id, $visit_id);
        }
        $pasienHistory = $this->getHistoryPasien($pasien_diagnosa_id);
        $lokalis = $this->getLokalis($pasien_diagnosa_id);

        return $this->response->setJSON([
            // 'triage' => $triage,
            'gcs' => $gcs,
            'fallRisk' => $fallRisk,
            'painMonitoring' => $painMonitoring,
            'pernapasan' => $pernapasan,
            'apgar' => @$apgar,
            'educationForm' => @$educationForm,
            'examDetail' => @$examDetail,
            'pasienHistory' => @$pasienHistory,
            'lokalis' => @$lokalis
        ]);
    }
    public function getLokalis($pasien_diagnosa_id)
    {
        $db = db_connect();
        $selectlokalis = $this->lowerKey($db->query("select * from assessment_lokalis where body_id = ?", [$pasien_diagnosa_id])->getResultArray());


        foreach ($selectlokalis as $key => $value) {
            if ($value['value_score'] == 3) {
                $filepath = $this->imageloc . 'uploads/lokalis/' . $value['value_detail'];
                if (file_exists($filepath)) {
                    $filedata = file_get_contents($filepath);
                    $filedata64 = base64_encode($filedata);
                    $selectlokalis[$key]['filedata64'] = $filedata64;
                }
            }
        }
        return $selectlokalis;
    }
    public function getHistoryPasien($pasien_diagnosa_id)
    {
        $pd = new PasienDiagnosaModel();
        $pddata = $pd->select("no_registration")->find($pasien_diagnosa_id);
        if (isset($pddata['no_registration'])) {
            $no_registration = @$pddata['no_registration'];
            $model = new PasienHistoryModel();
            $select = $this->lowerKey($model->where("no_registration", $no_registration)->select("*")->findAll());
        } else {
            $select = [];
        }
        return $select;
    }
    public function getExamDetail($bodyId, $visit)
    {
        $model = new ExaminationDetailModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)
            ->where("(isnull(TEMPERATURE,0) > 0 or  isnull(TENSION_UPPER,0) > 0 or  isnull(TENSION_BELOW,0) > 0 or  isnull(nadi,0) > 0
                or  isnull(nafas,0) > 0 or  isnull(weight,0) > 0 or  isnull(height,0) > 0)")->select("*")->first());
        if (count($select) == 0) {
            $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")
                ->where("(isnull(TEMPERATURE,0) > 0 or  isnull(TENSION_UPPER,0) > 0 or  isnull(TENSION_BELOW,0) > 0 or  isnull(nadi,0) > 0
                or  isnull(nafas,0) > 0 or  isnull(weight,0) > 0 or  isnull(height,0) > 0)")->orderBy("examination_date desc")->first());
        }
        $select['body_id'] = $bodyId;
        $select['document_id'] = $bodyId;
        return $select;
    }
    public function getTriage($bodyId, $visit)
    {
        $db = db_connect();

        $triage = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and document_id = '$bodyId' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '004') ")->getResultArray());
        // return json_encode($triage);

        $triageDetil = "select * from assessment_triase_detail where body_id in (";

        foreach ($triage as $key => $value) {
            $triageDetil .= "'" . $value['body_id'] . "',";
        }
        $triageDetil = substr($triageDetil, 0, strlen($triageDetil) - 1);

        $triageDetil .= ");";

        $triageDetil = $this->lowerKey($db->query($triageDetil)->getResultArray());

        return ([
            'triage' => $triage,
            'triageDetil' => $triageDetil
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
    public function getEducation($bodyId, $visit)
    {
        $db = db_connect();

        $napas = new EducationFormModel();
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
    public function fillResumeMedis()
    {

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];
        $trans_id = $body['trans_id'];

        $pt = new PasienTransferModel();
        $indikasi = $pt->select("notes")->where("visit_id", $visit_id)->where("isinternal", 5)->first();

        $db = db_connect();
        // $procbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 2")->getResultArray();
        $procbedah = $db->query("select TARIF_ID as treatment From PASIEN_OPERASI where trans_id = '$trans_id'")->getResultArray();

        $procnonbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 1")->getResultArray();

        $select = $db->query("select teraphy_desc from examination_info where visit_id = '$visit_id' and petugas_type = '11' order by examination_date desc")->getFirstRow('array');
        $lastDiag = @$select['teraphy_desc'];

        return $this->response->setJSON([
            'indikasi' => $indikasi,
            'procbedah' => $procbedah,
            'procnonbedah' => $procnonbedah,
            'lastDiag' => $lastDiag,
        ]);
    }
    public function copyGcsResume()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new GcsModel();
        $data = $this->lowerKey($model->where("visit_id", $visit)->where("account_id", '1')->orderBy("examination_date desc")->select("*")->first());
        $org = new OrganizationunitModel();
        $id = $org->generateId();
        $data['body_id'] = $id;
        $data['document_id'] = $bodyId;
        unset($data['modified_date']);
        $data['examination_date'] = date('Y-m-d h:i:s', time());
        $model->insert($data);
        $result[] = $data;

        return json_encode([
            'gcs' => $result
        ]);
    }
    public function duplicateAssessmentMedis()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        try {
            $pasien_diagnosa_id = $body['pasien_diagnosa_id'];

            $pd = new PasienDiagnosaModel();
            $dataToDuplicate = $pd->where('pasien_diagnosa_id', @$pasien_diagnosa_id) // Filter by visit_id
                ->first(); // Fetch all rows matching the conditions
            if (!is_null($dataToDuplicate)) {
                if (count($dataToDuplicate) > 0) {
                    $dataToDuplicate = $this->lowerKeyOne($dataToDuplicate);
                    // $dataToDelete = $dataToDuplicate;
                    // return json_encode(($dataToDuplicate));
                    // Step 2: Prepare the data with the new body_id
                    $dataToDelete['no_registration'] = 'x' . $dataToDuplicate['no_registration'];
                    $dataToDelete['visit_id'] = 'x' . $dataToDuplicate['visit_id'];
                    $dataToDelete['org_unit_code'] = 'x' . $dataToDuplicate['org_unit_code'];
                    $dataToDelete['pasien_diagnosa_id'] = $pasien_diagnosa_id;
                    $pd->save($dataToDelete);

                    // return json_encode($pd->save($dataToDelete));

                    $body_id = $this->get_bodyid();

                    $dataToDuplicate['pasien_diagnosa_id'] = $body_id;  // Change body_id to '124'
                    $dataToDuplicate['body_id'] = $body_id;  // Change body_id to '124'
                    $dataToDuplicate['modified_by'] = user()->username;  // Change body_id to '124'
                    $dataToDuplicate['valid_user'] = null;
                    $dataToDuplicate['valid_pasien'] = null;
                    $dataToDuplicate['valid_date'] = null;
                    // Step 3: Insert the new data into the table
                    $pd->save($dataToDuplicate);


                    $ex = new ExaminationModel();
                    $examToDuplicate = $ex->where('pasien_diagnosa_id', @$pasien_diagnosa_id)->first();
                    $examToDuplicate = $this->lowerKeyOne($examToDuplicate);
                    // $examToDelete = $examToDuplicate;
                    $examToDelete['no_registration'] = 'x' . $examToDuplicate['no_registration'];
                    $examToDelete['visit_id'] = 'x' . $examToDuplicate['visit_id'];
                    $examToDelete['org_unit_code'] = 'x' . $examToDuplicate['org_unit_code'];
                    $ex->update($pasien_diagnosa_id, $examToDelete);

                    $examToDuplicate['body_id'] = $body_id;  // Change body_id to '124'
                    $examToDuplicate['pasien_diagnosa_id'] = $body_id;  // Change body_id to '124'
                    $examToDuplicate['modified_by'] = user()->username;  // Change body_id to '124'
                    $examToDuplicate['valid_user'] = null;
                    $examToDuplicate['valid_pasien'] = null;
                    $examToDuplicate['valid_date'] = null;
                    $ex->insert($examToDuplicate);

                    $exd = new ExaminationDetailModel();
                    $examdToDuplicate = $exd->where('body_id', @$pasien_diagnosa_id)->first();
                    $examdToDuplicate = $this->lowerKeyOne($examdToDuplicate);
                    // $examdToDelete = $examdToDuplicate;
                    $examdToDelete['no_registration'] = 'x' . $examdToDuplicate['no_registration'];
                    $examdToDelete['visit_id'] = 'x' . $examdToDuplicate['visit_id'];
                    $examdToDelete['org_unit_code'] = 'x' . $examToDuplicate['org_unit_code'];
                    $exd->update($pasien_diagnosa_id, $examdToDelete);

                    $examdToDuplicate['body_id'] = $body_id;  // Change body_id to '124'
                    $examdToDuplicate['document_id'] = $body_id;  // Change body_id to '124'
                    $examdToDuplicate['modified_by'] = user()->username;  // Change body_id to '124'
                    $examdToDuplicate['valid_user'] = null;
                    $examdToDuplicate['valid_pasien'] = null;
                    $examdToDuplicate['valid_date'] = null;
                    $exd->insert($examdToDuplicate);

                    try {
                        $model = new GcsModel();
                        $data = $this->lowerKey($model->where("document_id", $pasien_diagnosa_id)->orderBy("examination_date desc")->select("*")->first());
                        if (!is_null($data)) {
                            if (count($data) > 0) {
                                $org = new OrganizationunitModel();
                                $id = $org->generateId();
                                $data['body_id'] = $id;
                                $data['document_id'] = $body_id;
                                unset($data['modified_date']);
                                $data['examination_date'] = date('Y-m-d h:i:s', time());
                                $model->insert($data);

                                $gcsToDelete['no_registration'] = 'x' . $examdToDelete['no_registration'];
                                $gcsToDelete['visit_id'] = 'x' . $examdToDelete['visit_id'];
                                $gcsToDelete['trans_id'] = 'x' . $examdToDelete['trans_id'];
                                $gcsToDelete['org_unit_code'] = 'x' . $examdToDelete['org_unit_code'];
                                $model->where('document_id', $pasien_diagnosa_id)->set($gcsToDelete)->update();
                            }
                        }
                    } catch (\Exception $e) {
                        //throw $th;
                    }

                    try {
                        $model = new LokalisModel();
                        $data = $this->lowerKey($model->where("document_id", $pasien_diagnosa_id)->findAll());
                        if (!is_null($data)) {
                            if (count($data) > 0) {
                                $org = new OrganizationunitModel();
                                $id = $org->generateId();
                                $data['body_id'] = $id;
                                $data['document_id'] = $body_id;
                                unset($data['modified_date']);
                                $data['examination_date'] = date('Y-m-d h:i:s', time());
                                $model->insert($data);

                                $dataToDelete['visit_id'] = 'x' . $examdToDelete['visit_id'];
                                $dataToDelete['trans_id'] = 'x' . $examdToDelete['trans_id'];
                                $model->where('document_id', $pasien_diagnosa_id)->set($dataToDelete)->update();
                            }
                        }
                    } catch (\Exception $e) {
                        //throw $th;
                    }
                }
            }
            return $this->response->setJSON([
                'message' => 'Berhasil',
                'response' => 'sukses'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'message' => $e->getMessage(),
                'response' => 'gagal'
            ]);
        }
    }
    public function deleteAssessmentMedis()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        try {
            $pasien_diagnosa_id = $body['pasien_diagnosa_id'];

            $model = new PasienDiagnosaModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            $model = new ExaminationModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            $model = new ExaminationDetailModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            $model = new GcsModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            $model = new PainMonitoringModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            $model = new FallRiskModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            $model = new IndicatorModel();
            $hasil = $model->deletePasienDiagnosa($pasien_diagnosa_id);
            return $this->response->setJSON([
                'message' => 'Berhasil',
                'response' => 'sukses',
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'message' => $e->getMessage(),
                'response' => 'gagal'
            ]);
        }
    }
}
