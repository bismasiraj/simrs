<?php

namespace App\Controllers\Admin\rm;

use App\Controllers\BaseController;
use App\Models\Assessment\ADLModel;
use App\Models\Assessment\AnakModel;
use App\Models\Assessment\ApgarDetailModel;
use App\Models\Assessment\BladderModel;
use App\Models\Assessment\CirculationModel;
use App\Models\Assessment\DekubitusModel;
use App\Models\Assessment\DigestionModel;
use App\Models\Assessment\EducationFormModel;
use App\Models\Assessment\EducationIntegrationDetailModel;
use App\Models\Assessment\EducationIntegrationModel;
use App\Models\Assessment\EducationIntegrationPlanModel;
use App\Models\Assessment\EducationIntegrationProvisionModel;
use App\Models\Assessment\FallRiskDetailModel;
use App\Models\Assessment\FallRiskModel;
use App\Models\Assessment\GcsModel;
use App\Models\Assessment\indicatorDetail;
use App\Models\Assessment\indicatorDetailModel;
use App\Models\Assessment\IndicatorModel;
use App\Models\Assessment\IntegumenModel;
use App\Models\Assessment\LokalisModel;
use App\Models\Assessment\NeonatusModel;
use App\Models\Assessment\NeurosensorisModel;
use App\Models\Assessment\NutritionDetailModel;
use App\Models\Assessment\NutritionModel;
use App\Models\Assessment\PainDetilModel;
use App\Models\Assessment\PainIntervensiModel;
use App\Models\Assessment\PainMonitoringModel;
use App\Models\Assessment\PasienDiagnosaPerawatModel;
use App\Models\Assessment\PasienDiagnosasPerawatModel;
use App\Models\Assessment\PasienTransferModel;
use App\Models\Assessment\ReproductionModel;
use App\Models\Assessment\RespirationModel;
use App\Models\Assessment\SleepingModel;
use App\Models\Assessment\SocialModel;
use App\Models\Assessment\SocialonModel;
use App\Models\Assessment\SpiritualDetailModel;
use App\Models\Assessment\SpiritualModel;
use App\Models\Assessment\TreatmentPerawatModel;
use App\Models\Assessment\TriaseDetilModel;
use App\Models\Assessment\VisionHearingModel;
use App\Models\BabyModel;
use App\Models\ClinicModel;
use App\Models\DietInapModel;
use App\Models\EducationModel;
use App\Models\EmployeeAllModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\InasisKontrolModel;
use App\Models\NifasModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienHistoryModel;
use App\Models\PasienModel;
use App\Models\PasienProceduresModel;
use App\Models\PasienVisitationModel;
use App\Models\PersalinanModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;
use Myth\Auth\Models\UserModel;

class AssessmentPerawat extends BaseController
{
    public function saveExaminationInfo()
    {

        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $menu['fallrisk'] = 1;
        $menu['painmonitoring'] = 1;
        $menu['triase'] = 1;
        $menu['painmonitoring'] = 1;
        $menu['apgar'] = 1;
        $menu['skrininggizi'] = 1;
        $menu['adl'] = 1;
        $menu['dekubitus'] = 1;
        $menu['stabilitas'] = 1;
        $menu['edukasiintegrasi'] = 1;
        $menu['formedukasi'] = 1;
        $menu['gcs'] = 1;
        $menu['integumen'] = 1;
        $menu['anak'] = 1;
        $menu['neonatus'] = 1;
        $menu['neurosensoris'] = 1;
        $menu['pencernaan'] = 1;
        $menu['pernapasan'] = 1;
        $menu['perkemihan'] = 1;
        $menu['psikologi'] = 1;
        $menu['sirkulasi'] = 1;
        $menu['seksual'] = 1;
        $menu['social'] = 1;
        $menu['tht'] = 1;
        $menu['tidur'] = 1;

        $controller = new Assessment();
        foreach ($body as $key => $value) {
            if ($value["id"] == "formaddarp" || $value["id"] == "formaddarb") {
                $perawat = json_decode($this->saveAssessmentPerawat($value["data"]));
            }
            if (strpos($value["id"], "formGcs") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $gcs = json_decode($controller->saveGcs($value["data"]));
            }
            if (strpos($value["id"], "formPainMonitoring") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $monitoring = json_encode($controller->savePainMonitoring($value["data"]));
            }
            if (strpos($value["id"], "formFallRisk") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $fallRisk = json_encode($controller->saveFallRisk($value["data"]));
            }
            if (strpos($value["id"], "formGizi") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $gizi = json_decode($controller->savegizi($value["data"]));
            }
            if (strpos($value["id"], "formTriage") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $triage = json_decode($controller->saveTriage($value["data"]));
            }
            if (strpos($value["id"], "formApgar") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $apgar = json_decode($controller->saveApgar($value["data"]));
            }
            if (strpos($value["id"], "formStabilitas") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $stabilitas = json_decode($controller->saveStabilitas($value["data"]));
            }
            if (strpos($value["id"], "formPernapasan") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $pernapasan = json_decode($controller->savePernapasan($value["data"]));
            }
            if (strpos($value["id"], "formSirkulasi") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $sirkulasi = json_decode($controller->saveSirkulasi($value["data"]));
            }
            if (strpos($value["id"], "formNeurosensoris") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $neurosensori = json_decode($controller->saveNeurosensoris($value["data"]));
            }
            if (strpos($value["id"], "formIntegumen") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $integumen = json_decode($controller->saveIntegumen($value["data"]));
            }
            if (strpos($value["id"], "formAnak") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $anak = json_decode($controller->saveAnak($value["data"]));
            }
            if (strpos($value["id"], "formADL") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $adl = json_decode($controller->saveADL($value["data"]));
            }
            if (strpos($value["id"], "formDekubitus") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $dekubitus = json_decode($controller->saveDekubitus($value["data"]));
            }
            if (strpos($value["id"], "formPencernaan") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $pencernaan = json_decode($controller->savePencernaan($value["data"]));
            }
            if (strpos($value["id"], "formPerkemihan") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $perkemihan = json_decode($controller->savePerkemihan($value["data"]));
            }
            if (strpos($value["id"], "formPsikologi") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $psikologi = json_decode($controller->savePsikologi($value["data"]));
            }
            if (strpos($value["id"], "formEducationForm") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $education = json_decode($controller->saveeducationForm($value["data"]));
            }
            if (strpos($value["id"], "formEducationIntegration") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $educationIntegration = json_decode($controller->saveeducationIntegration($value["data"]));
            }
            if (strpos($value["id"], "formSocial") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $social = json_decode($controller->saveSocial($value["data"]));
            }
            if (strpos($value["id"], "formSeksual") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $seksual = json_decode($controller->saveSeksual($value["data"]));
            }
            if (strpos($value["id"], "formHearing") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $hearing = json_decode($controller->saveHearing($value["data"]));
            }
            if (strpos($value["id"], "formSleeping") !== false) {
                if (!is_null($value["data"]) && $value["data"] != [])
                    $sleeping = json_decode($controller->saveSleeping($value["data"]));
            }
        }

        return json_encode([
            "perawat" => @$perawat,
            "gcs" => @$gcs,
            "monitoring" => @$monitoring,
            "fallRisk" => @$fallRisk,
            "triage" => @$triage,
            "gizi" => @$gizi,
            "apgar" => @$apgar,
            "stabilitas" => @$stabilitas,
            "apgar" => @$apgar,
            "pernapasan" => @$pernapasan,
            "sirkulasi" => @$sirkulasi,
            "neurosensoris" => @$neurosensori,
            "integumen" => @$integumen,
            "anak" => @$anak,
            "adl" => @$adl,
            "dekubitus" => @$dekubitus,
            "pencernaan" => @$pencernaan,
            "perkemihan" => @$perkemihan,
            "psikologi" => @$psikologi,
            "education" => @$education,
            "educationIntegration" => @$educationIntegration,
            "social" => @$social,
            "seksual" => @$seksual,
            "hearing" => @$hearing,
            "sleeping" => @$sleeping
        ]);
    }
    public function saveAssessmentPerawat($body)
    {
        $dataexam = [];
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $dataexam[$key] = $value;
            if ($value == '')
                $dataexam[$key] = null;

            if (isset($examination_date))
                $dataexam['examination_date'] = str_replace("T", " ", $examination_date);
            if (isset($temperature) && $temperature != '')
                $dataexam['temperature'] = (float)$dataexam['temperature'];
            else
                $dataexam['temperature'] = null;

            if (isset($tension_upper) && $tension_upper != '')
                $dataexam['tension_upper'] = (float)$dataexam['tension_upper'];
            else
                $dataexam['tension_upper'] = null;

            if (isset($tension_below) && $tension_below != '')
                $dataexam['tension_below'] = (float)$dataexam['tension_below'];
            else
                $dataexam['tension_below'] = null;

            if (isset($nadi) && $nadi != '')
                $dataexam['nadi'] = (float)$dataexam['nadi'];
            else
                $dataexam['nadi'] = null;

            if (isset($nafas) && $nafas != '')
                $dataexam['nafas'] = (float)$dataexam['nafas'];
            else
                $dataexam['nafas'] = null;

            if (isset($weight) && $weight != '')
                $dataexam['weight'] = (float)$dataexam['weight'];
            else
                $dataexam['weight'] = null;

            if (isset($height) && $height != '')
                $dataexam['height'] = (float)$dataexam['height'];
            else
                $dataexam['height'] = null;

            if (isset($arm_diameter) && $arm_diameter != '')
                $dataexam['arm_diameter'] = (float)$dataexam['arm_diameter'];
            else
                $dataexam['arm_diameter'] = null;

            if (isset($saturasi) && $saturasi != '')
                $dataexam['saturasi'] = (int)$dataexam['saturasi'];
            else
                $dataexam['saturasi'] = null;
        }

        $ex = new ExaminationModel();
        $ex->save($dataexam);
        $dataexam['document_id'] = $dataexam['body_id'];
        $exd = new ExaminationDetailModel();
        $exd->save($dataexam);

        $dataexam['fullname'] = $this->getFullname($dataexam['employee_id']);
        $dataexam['name_of_clinic'] = $this->getClinicName($dataexam['clinic_id']);

        $db = db_connect();

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
        $i = 0;
        $pasienHistory = [];
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
                // if ($value['value_id'] == 'G0090301')
                //     return json_encode($G0090301);
                // $data = [
                //     'org_unit_code' => $org_unit_code,
                //     'no_registration' => $no_registration,
                //     'item_id' => $i,
                //     'value_id' => $value['value_id'],
                //     'value_desc' => $value['value_desc'],
                //     'histories' => ${$value['value_id']},
                //     'modified_by' => user()->username
                // ];
                // $db->query("delete from pasien_history where no_registration = '$no_registration' and value_id = '" . $value['value_id'] . "'");
                // return json_encode($data);
                // $pasienHistory->insert($data);
            }
        }

        $pdn = new PasienDiagnosaPerawatModel();
        $org = new OrganizationunitModel();

        $id = $org->generateId();
        $pds = new PasienDiagnosasPerawatModel();
        $db->query("delete from pasien_diagnosas_nurse where body_id in (select body_id from pasien_diagnosa_nurse where document_id = '$body_id')");
        $db->query("delete from pasien_diagnosa_nurse where document_id = '$body_id'");
        $data = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'body_id' => $id,
            'document_id' => $body_id,
            'clinic_id' => $clinic_id,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'no_registration' => $no_registration,
            'examination_date' => str_replace("T", " ", $examination_date),
            'employee_id' => $employee_id,
            'petugas_id' => user()->username,
            'descriptions' => null,
            'modified_by' => $modified_by,
        ];
        $pdn->insert($data);
        if (!empty($diagnosan_id)) {
            foreach ($diagnosan_id as $key => $value) {
                $dataDiag = [
                    'org_unit_code' => $org_unit_code,
                    'body_id' => $id,
                    'diagnosan_id' => $diagnosan_id[$key],
                    'diagnosa_date' => new RawSql("getdate()"),
                    'diag_notes' => $diag_notes[$key],
                    'modified_by' => user()->username
                ];
                // return json_encode($dataDiag);
                $pds->insert($dataDiag);
            }
        }

        $dataexam['pasienHistory'] = $pasienHistory;



        return json_encode($dataexam);
    }
    public function getSatelitePerawat()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $document_id = $body['document_id'];
        $visit_id = $body['visit_id'];
        $no_registration = @$body['no_registration'];
        $db = db_connect();
        $diagPerawat = $this->lowerKey($db->query("select * from pasien_diagnosa_nurse pdn inner join pasien_diagnosas_nurse pds on pdn.body_id = pds.body_id where pdn.document_id in ('$document_id') ")->getResultArray());

        $gcs = $this->getGcs($document_id, $visit_id);
        $fallRisk = $this->getFallRisk($document_id, $visit_id);
        $painMonitoring = $this->getPainMonitoring($document_id, $visit_id);
        $pernapasan = $this->getPernapasan($document_id, $visit_id);
        if ($clinic_id = 'P012') {
            $apgar = $this->getApgar($document_id, $visit_id);
            $triage = $this->getTriage($document_id, $visit_id);
        }
        $gizi = $this->getGizi($document_id, $visit_id);
        $adl = $this->getADL($document_id, $visit_id);
        $dekubitus = $this->getDekubitus($document_id, $visit_id);
        $stabilitas = $this->getStabilitas($document_id, $visit_id);
        $integumen = $this->getIntegumen($document_id, $visit_id);
        $neurosensoris = $this->getNeurosensoris($document_id, $visit_id);
        $pencernaan = $this->getPencernaan($document_id, $visit_id);
        $perkemihan = $this->getPerkemihan($document_id, $visit_id);
        $psikologi = $this->getPsikologi($document_id, $visit_id);
        $sirkulasi = $this->getSirkulasi($document_id, $visit_id);
        $seksual = $this->getSeksual($document_id, $visit_id);
        $hearing = $this->getHearing($document_id, $visit_id);
        $sleeping = $this->getSleeping($document_id, $visit_id);
        $social = $this->getSocial($document_id, $visit_id);
        $pasienHistory = $this->getHistoryPasien($no_registration);

        return $this->response->setJSON([
            'gcs' => $gcs,
            'fallRisk' => $fallRisk,
            'painMonitoring' => $painMonitoring,
            'pernapasan' => $pernapasan,
            'apgar' => @$apgar,
            'triage' => @$triage,
            'gizi' => @$gizi,
            'adl' => @$adl,
            'dekubitus' => @$dekubitus,
            'stabilitas' => @$stabilitas,
            'integumen' => @$integumen,
            'neurosensoris' => @$neurosensoris,
            'pencernaan' => @$pencernaan,
            'perkemihan' => @$perkemihan,
            'psikologi' => @$psikologi,
            'sirkulasi' => @$sirkulasi,
            'seksual' => @$seksual,
            'social' => @$social,
            'hearing' => @$hearing,
            'sleeping' => @$sleeping,
            'diagPerawat' => @$diagPerawat,
            'pasienHistory' => @$pasienHistory
        ]);
    }
    public function getHistoryPasien($no_registration)
    {
        $model = new PasienHistoryModel();
        $select = $this->lowerKey($model->where("no_registration", $no_registration)->select("*")->findAll());
        return $select;
    }
    public function getDiagPerawat()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $document_id = $body['body_id'];
        $db = db_connect();
        $diagPerawat = $this->lowerKey($db->query("select * from pasien_diagnosa_nurse pdn inner join pasien_diagnosas_nurse pds on pdn.body_id = pds.body_id where pdn.document_id in ('$document_id') ")->getResultArray());
        return $this->response->setJSON([
            'diagPerawat' => @$diagPerawat
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
            'painMonitoring' => $painMonitoring,
            'painDetil' => @$painDetil,
            'painIntervensi' => @$painIntervensi
        ]);
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
    public function getTriage($bodyId, $visit)
    {
        $db = db_connect();

        $triage = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and document_id = '$bodyId' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '004') ")->getResultArray());
        // return json_encode($triage);

        if (count($triage) > 0) {
            $triageDetil = "select * from assessment_triase_detail where body_id in (";

            foreach ($triage as $key => $value) {
                $triageDetil .= "'" . $value['body_id'] . "',";
            }
            $triageDetil = substr($triageDetil, 0, strlen($triageDetil) - 1);

            $triageDetil .= ");";

            $triageDetil = $this->lowerKey($db->query($triageDetil)->getResultArray());
        }

        return ([
            'triage' => $triage,
            'triageDetil' => @$triageDetil
        ]);
    }
    public function getGizi($bodyId, $visit)
    {


        $model = new NutritionModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        $bodyAll = [];
        if (count($select) > 0) {
            foreach ($select as $key => $value) {
                $bodyAll[] = $value['body_id'];
            }

            $giziDetail = new NutritionDetailModel();
            $selectgizi = $this->lowerKey($giziDetail->whereIn("body_id", $bodyAll)->findAll());
        }

        return ([
            'gizi' => $select,
            'giziDetail' => @$selectgizi
        ]);
    }
    public function getADL($bodyId, $visit)
    {
        $model = new ADLModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'adl' => $select
        ]);
    }
    public function getDekubitus($bodyId, $visit)
    {
        $model = new DekubitusModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'dekubitus' => $select
        ]);
    }
    public function getStabilitas($bodyId, $visit)
    {


        $db = db_connect();

        $apgar = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and document_id = '$bodyId'  and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());
        // return json_encode($apgar);

        if (count($apgar)) {
            $apgarDetil = "select * from assessment_indicator_detail where body_id in (";

            foreach ($apgar as $key => $value) {
                $apgarDetil .= "'" . $value['body_id'] . "',";
            }
            $apgarDetil = substr($apgarDetil, 0, strlen($apgarDetil) - 1);

            $apgarDetil .= ");";

            $apgarDetil = $this->lowerKey($db->query($apgarDetil)->getResultArray());
        }

        return ([
            'stabilitas' => $apgar,
            'stabilitasDetail' => @$apgarDetil
        ]);
    }
    public function getIntegumen($bodyId, $visit)
    {
        $db = db_connect();

        $model = new IntegumenModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'integumen' => $select
        ]);
    }
    public function getNeurosensoris($bodyId, $visit)
    {
        $db = db_connect();

        $model = new NeurosensorisModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'neuro' => $select
        ]);
    }
    public function getPencernaan($bodyId, $visit)
    {
        $model = new DigestionModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'pencernaan' => $select
        ]);
    }
    public function getPerkemihan($bodyId, $visit)
    {
        $model = new BladderModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'perkemihan' => $select
        ]);
    }
    public function getPsikologi($bodyId, $visit)
    {
        $model = new SpiritualModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        if (count($select)) {
            $bodyAll = [];
            foreach ($select as $key => $value) {
                $bodyAll[] = $value['body_id'];
            }

            $spiritualDetail = new SpiritualDetailModel();
            $selectSpiritual = $this->lowerKey($spiritualDetail->whereIn("body_id", $bodyAll)->findAll());
        }

        return ([
            'psikologi' => $select,
            'psikologiDetail' => @$selectSpiritual
        ]);
    }
    public function getSirkulasi($bodyId, $visit)
    {
        $db = db_connect();

        $model = new CirculationModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'sirkulasi' => $select
        ]);
    }
    public function getSeksual($bodyId, $visit)
    {
        $model = new ReproductionModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'seksual' => $select
        ]);
    }
    public function getSocial($bodyId, $visit)
    {
        $model = new SocialModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'social' => $select
        ]);
    }
    public function getHearing($bodyId, $visit)
    {

        $model = new VisionHearingModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'hearing' => $select
        ]);
    }
    public function getSleeping($bodyId, $visit)
    {
        $model = new SleepingModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return ([
            'sleeping' => $select
        ]);
    }
}
