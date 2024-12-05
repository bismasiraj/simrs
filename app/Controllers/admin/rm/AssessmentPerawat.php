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
        $social = $this->getSocial($document_id, $visit_id);
        $hearing = $this->getHearing($document_id, $visit_id);
        $sleeping = $this->getSleeping($document_id, $visit_id);
        $social = $this->getSocial($document_id, $visit_id);
        $social = $this->getSocial($document_id, $visit_id);
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

        $db = db_connect();

        $queryDetil = "select * from assessment_fall_risk_detail where body_id in (";

        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['body_id'] . "',";
        }
        $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);

        $queryDetil .= ");";

        $fallRiskDetil = $this->lowerKey($db->query($queryDetil)->getResultArray());

        return [
            'fallRisk' => $select,
            'fallRiskDetail' => $fallRiskDetil
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

        return ([
            'painMonitoring' => $painMonitoring,
            'painDetil' => $painDetil,
            'painIntervensi' => $painIntervensi
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
