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
use App\Models\ClinicModel;
use App\Models\DietInapModel;
use App\Models\EducationModel;
use App\Models\EmployeeAllModel;
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

class Assessment extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {

        return view('welcome_message');
    }

    public function getMapAssessment()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $specialist_type_id = $body['specialist_type_id'];

        $db = db_connect();
        $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        where st.specialist_type_id = '{$specialist_type_id}'
        ;")->getResultArray());
        // $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        // inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        // inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        // inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        // where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        // return json_encode($mapAssessment);
        if ($mapAssessment == []) {
            $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, '' as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
                inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
                inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
                inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
                where c.CLINIC_ID = 'P001';")->getResultArray());
        }
        foreach ($mapAssessment as $key => $value) {
            $mapAssessment[$key]['specialist_type_id'] = $specialist_type_id;
        }

        return json_encode($mapAssessment);
    }
    public function savePainMonitoring()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        // $parameter_id01 = $this->request->getPost('parameter_id01');
        // $parameter_id02 = $this->request->getPost('parameter_id02');
        // $parameter_id03 = $this->request->getPost('parameter_id03');
        // $parameter_id04 = $this->request->getPost('parameter_id04');
        // $parameter_id05 = $this->request->getPost('parameter_id05');
        // $parameter_id06 = $this->request->getPost('parameter_id06');
        // $parameter_id07 = $this->request->getPost('parameter_id07');
        // $parameter_id08 = $this->request->getPost('parameter_id08');
        $timeIntervensi = $this->request->getPost('timeIntervensi');
        $intervensi = $this->request->getPost('intervensi');
        $rute = $this->request->getPost('rute');
        $painscalescore = $this->request->getPost('painscalescore');
        $reAssessment = $this->request->getPost('reAssessment');
        $reassessment_date = $this->request->getPost('reassessment_date');

        $org_unit_code = $this->request->getPost('org_unit_code');
        $visit_id = $this->request->getPost('visit_id');
        $trans_id = $this->request->getPost('trans_id');
        $body_id = $this->request->getPost('body_id');
        $no_registration = $this->request->getPost('no_registration');
        $examination_date = str_replace('T', ' ', $this->request->getPost('examination_date'));
        $clinic_id = $this->request->getPost('clinic_id');
        $employee_id = $this->request->getPost('employee_id');
        $petugas_id = $this->request->getPost('petugas_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $bed_id = $this->request->getPost('bed_id');
        $p_type = $this->request->getPost('p_type');
        $description = $this->request->getPost('description');
        $modified_date = $this->request->getPost('modified_date');
        $modified_by = $this->request->getPost('modified_by');
        $pain_monitoring_status = $this->request->getPost('pain_monitoring_status');
        $document_id = $this->request->getPost('document_id');
        $valid_date = $this->request->getPost('valid_date');
        $valid_user = $this->request->getPost('valid_user');
        $valid_pasien = $this->request->getPost('valid_pasien');

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
        // return json_encode($isSuccess);

        if (true) {
            $painDetil = new PainDetilModel();

            $db->query("delete from assessment_pain_detail where body_id = '$body_id' and visit_id = '$visit_id'");

            $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER where P_TYPE = 'ASES021'")->getResultArray());
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

            if ($timeIntervensi != '' && $timeIntervensi != null) {
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

        return $this->response->setStatusCode(200)
            ->setJSON([
                "code" => 200,
                "status" => "success"
            ]);
    }
    public function getPainMonitoring()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

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

        return json_encode([
            'painMonitoring' => $painMonitoring,
            'painDetil' => $painDetil,
            'painIntervensi' => $painIntervensi
        ]);
    }
    public function copyPainMonitoring()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();
        if ($bodyId != '') {
            $painMonitoring = $this->lowerKey($db->query("select top(1) * from ASSESSMENT_PAIN_MONITORING where visit_id = '$visit' order by examination_date")->getResultArray());
            if (!empty($painMonitoring)) {
                $model = new PainMonitoringModel();
                $data = $painMonitoring[0];
                $data['document_id'] = $bodyId;
                $org = new OrganizationunitModel();
                $id = $org->generateId();
                $idOld = $data['body_id'];
                $data['body_id'] = $id;
                unset($data['modified_date']);
                $data['examination_info'] = Time::now();
                $data['modified_by'] = user()->username;
                $ispassing = $model->insert($data);
                $selectPain[] = $data;
                if ($ispassing) {
                    $queryDetil = "select * from assessment_pain_detail where body_id = '$idOld'";
                    $painDetil = $this->lowerKey($db->query($queryDetil)->getResultArray());
                    $selectDetil = [];
                    foreach ($painDetil as $key => $value) {
                        $modelDetail = new PainDetilModel();
                        $dataDetail = $value;
                        $dataDetail['body_id'] = $id;
                        unset($data['modified_date']);
                        $dataDetail['modified_by'] = user()->username;
                        $modelDetail->insert($dataDetail);
                        $selectDetil[] = $dataDetail;
                    }


                    $queryIntervensi = "select * from assessment_pain_intervensi where body_id= '$idOld'";
                    $painIntervensi = $this->lowerKey($db->query($queryIntervensi)->getResultArray());
                    $selectIntervensi = [];
                    foreach ($painIntervensi as $key => $value) {
                        $modelIntervensi = new PainIntervensiModel();
                        $dataIntervensi = $value;
                        $dataIntervensi['body_id'] = $id;
                        unset($data['modified_date']);
                        $dataIntervensi['modified_by'] = user()->username;
                        $modelIntervensi->insert($dataIntervensi);
                        $selectIntervensi[] = $dataIntervensi;
                    }
                    return json_encode([
                        'painMonitoring' => $selectPain,
                        'painDetil' => $selectDetil,
                        'painIntervensi' => $selectIntervensi
                    ]);
                }
            } else {
                return $this->customResponse('No records found', 404);
            }
        } else {
            return $this->customResponse('No records found', 404);
        }
    }

    public function saveTriage()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        foreach ($body as $key => $value) {
            ${$key} = $value;
        }

        $step1 = $this->request->getPost("step1");
        $step2 = $this->request->getPost("step2");
        $step3 = $this->request->getPost("step3");

        // $org_unit_code = $this->request->getPost('org_unit_code');
        // $visit_id = $this->request->getPost('visit_id');
        // $trans_id = $this->request->getPost('trans_id');
        // $body_id = $this->request->getPost('body_id');
        // $no_registration = $this->request->getPost('no_registration');
        // $examination_date = $this->request->getPost('examination_date');
        // $clinic_id = $this->request->getPost('clinic_id');
        // $employee_id = $this->request->getPost('employee_id');
        // $petugas_id = $this->request->getPost('petugas_id');
        // $class_room_id = $this->request->getPost('class_room_id');
        // $bed_id = $this->request->getPost('bed_id');
        // $p_type = $this->request->getPost('p_type');
        // $description = $this->request->getPost('description');
        // $modified_date = $this->request->getPost('modified_date');
        // $modified_by = $this->request->getPost('modified_by');

        $db = db_connect();
        $indicator = new IndicatorModel();
        $data = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'body_id' => $body_id,
            'no_registration' => $no_registration,
            'examination_date' => Time::now(),
            'clinic_id' => $clinic_id,
            'employee_id' => $employee_id,
            'petugas_id' => $petugas_id,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'p_type' => $p_type,
            'total_score' => $total_score,
            'description' => $description,
            // 'modified_date' => Time::now(),
            'modified_by' => $modified_by,
            'isvalid' => null,
            'valid_date' => null,
            'document_id' => $document_id,
            'valid_date' => $valid_date,
            'valid_user' => $valid_user,
            'valid_pasien' => $valid_pasien
        ];
        // return json_encode($data);
        $select = $db->query("select body_id from assessment_indicator where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'")->getResultArray();
        // $db->query("delete from assessment_indicator where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

        // if (!isset($select[0]['body_id']))
        $isSuccess = $indicator->save($data);
        // return json_encode($isSuccess);

        $triaseDetil = new TriaseDetilModel();

        $db->query("delete from assessment_triase_detail where body_id = '$body_id' and visit_id = '$visit_id' and p_type in ('$p_type','GEN0008')");

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0008'")->getResultArray());


        foreach ($select as $key => $value) {
            if (isset(${'gen0008' . $value['parameter_id']}))
                if ($value['value_id'] == ${'gen0008' . $value['parameter_id']}) {
                    $data = [
                        'org_unit_code' => $org_unit_code,
                        'visit_id' => $visit_id,
                        'trans_id' => $trans_id,
                        'body_id' => $body_id,
                        'p_type' => 'GEN0008',
                        'parameter_id' => $value['parameter_id'],
                        'value_score' => $value['value_score'],
                        'value_desc' => $value['value_desc'],
                        // 'modified_date' => Time::now(),
                        'modified_by' => user()->username,
                        'value_id' => $value['value_id']
                    ];
                    $triaseDetil->insert($data);
                }
        }


        // $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER_VALUE where P_TYPE = '$p_type'")->getResultArray());


        // foreach ($select as $key => $value) {
        //     if (isset(${'val' . $value['value_id']})) {
        //         $data = [
        //             'org_unit_code' => $org_unit_code,
        //             'visit_id' => $visit_id,
        //             'trans_id' => $trans_id,
        //             'body_id' => $body_id,
        //             'p_type' => $p_type,
        //             'parameter_id' => $value['parameter_id'],
        //             'value_score' => $value['value_score'],
        //             'value_desc' => $value['value_desc'],
        //             // 'modified_date' => Time::now(),
        //             'modified_by' => user()->username,
        //             'value_id' => $value['value_id']
        //         ];

        //         $istrue = $triaseDetil->insert($data);
        //         // return json_encode(($istrue));
        //     }
        // }
        return json_encode("berhasil");
    }

    public function getTriage()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

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

        return json_encode([
            'triage' => $triage,
            'triageDetil' => $triageDetil
        ]);
    }
    public function copyTriage()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $document_id = $body['document_id'];

        $triageCopy = [];
        $triageDetilCopy = [];

        $db = db_connect();

        $triage = $this->lowerKey($db->query("select top(1) * from assessment_indicator where visit_id = '$visit' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '004') order by modified_date desc")->getResultArray());

        if (!empty($triage)) {
            $indicator = new IndicatorModel();
            $data = $triage[0];
            $data['document_id'] = $document_id;
            $data['modified_by'] = user()->username;
            $data['examination_date'] = Time::now();
            unset($data['modified_date']);
            $idOld = $data['body_id'];
            $org = new OrganizationunitModel();
            $id = $org->generateId();
            $data['body_id'] = $id;
            $isSuccess = $indicator->save($data);

            if ($isSuccess) {
                $triageCopy[0] = $data;
                $triageDetail = $this->lowerKey($db->query("select * from assessment_triase_detail where body_id = '$idOld'")->getResultArray());
                if (!empty($triageDetail)) {
                    $triaseDetil = new TriaseDetilModel();
                    foreach ($triageDetail as $key => $value) {
                        // return json_encode($value);
                        $dataDetil = $value;
                        $dataDetil['body_id'] = $id;
                        $dataDetil['modified_by'] = user()->username;
                        unset($dataDetil['modified_date']);
                        $triaseDetil->insert($dataDetil);
                        $triaseDetilCopy[] = $dataDetil;
                        unset($dataDetil);
                    }
                }
            }
            return $this->customResponse('No records found', 404);
        } else {
            return $this->customResponse('No records found', 404);
        }



















        $triageDetil = "select * from assessment_triase_detail where body_id in (";

        foreach ($triage as $key => $value) {
            $triageDetil .= "'" . $value['body_id'] . "',";
        }
        $triageDetil = substr($triageDetil, 0, strlen($triageDetil) - 1);

        $triageDetil .= ");";

        $triageDetil = $this->lowerKey($db->query($triageDetil)->getResultArray());

        return json_encode([
            'triage' => $triage,
            'triageDetil' => $triageDetil
        ]);
    }

    public function saveApgar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        // return json_encode($document_id);

        $db = db_connect();
        $indicator = new IndicatorModel();
        $data = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'body_id' => $body_id,
            'no_registration' => $no_registration,
            'examination_date' => Time::now(),
            'clinic_id' => $clinic_id,
            'employee_id' => $employee_id,
            'petugas_id' => $petugas_id,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'p_type' => $p_type,
            'total_score' => 0,
            'description' => $description,
            // 'modified_date' => Time::now(),
            'modified_by' => $modified_by,
            'isvalid' => null,
            'valid_date' => null,
            'document_id' => $document_id,
            'valid_date' => $valid_date,
            'valid_user' => $valid_user,
            'valid_pasien' => $valid_pasien
        ];
        // return json_encode($data);
        $select = $db->query("select body_id from assessment_indicator where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'")->getResultArray();
        // $db->query("delete from assessment_indicator where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

        if (!isset($select[0]['body_id']))
            $isSuccess = $indicator->insert($data);
        // return json_encode($isSuccess);

        $apgarDetil = new ApgarDetailModel();

        $db->query("delete from assessment_apgar_detail where body_id = '$body_id' and visit_id = '$visit_id'");


        $select = $this->lowerKey($db->query("select PARENT_ID, apt.P_TYPE, apt.P_DESCRIPTION, ap.PARAMETER_ID, ap.PARAMETER_DESC from ASSESSMENT_PARAMETER_TYPE apt inner join assessment_parameter ap on apt.P_TYPE = ap.P_TYPE
                                                where apt.PARENT_ID = '005'")->getResultArray());


        foreach ($select as $key => $value) {
            if (isset(${$value['parent_id'] . $value['p_type'] . $value['parameter_id']})) {
                $avalue = $this->lowerKey($db->query("select * from assessment_parameter_value where value_id = '" . ${$value['parent_id'] . $value['p_type'] . $value['parameter_id']} . "'")->getResultArray());
                $data = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $trans_id,
                    'body_id' => $body_id,
                    'p_type' => $avalue[0]['p_type'],
                    'parameter_id' => $avalue[0]['parameter_id'],
                    'value_score' => $avalue[0]['value_score'],
                    'value_desc' => $avalue[0]['value_desc'],
                    'modified_by' => user()->username,
                    'value_id' => $avalue[0]['value_id']
                ];

                $istrue = $apgarDetil->insert($data);
            }
        }
        return json_encode(($istrue));
    }
    public function getApgar()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();

        $apgar = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and document_id = '$bodyId' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());
        // return json_encode($apgar);

        $apgarDetil = "select * from assessment_apgar_detail where body_id in (";

        foreach ($apgar as $key => $value) {
            $apgarDetil .= "'" . $value['body_id'] . "',";
        }
        $apgarDetil = substr($apgarDetil, 0, strlen($apgarDetil) - 1);

        $apgarDetil .= ");";

        $apgarDetil = $this->lowerKey($db->query($apgarDetil)->getResultArray());

        return json_encode([
            'apgar' => $apgar,
            'apgarDetil' => $apgarDetil
        ]);
    }






    public function addAssessmentMedis()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();
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
                "body_id" => $body_id,
                "org_unit_code" => $org_unit_code,
                "pasien_diagnosa_id" => $pasien_diagnosa_id,
                "no_registration" => $no_registration,
                "visit_id" => $visit_id,
                "clinic_id" => $clinic_id,
                "class_room_id" => $class_room_id,
                "bed_id" => $bed_id,
                "in_date" => $in_date,
                "exit_date" => $exit_date,
                "keluar_id" => $keluar_id,
                "examination_date" => str_replace('T', ' ', $date_of_diagnosa),
                "temperature" => $temperature,
                "tension_upper" => $tension_upper,
                "tension_below" => $tension_below,
                "nadi" => $nadi,
                "nafas" => $nafas,
                "weight" => $weight,
                "height" => $height,
                "awareness" => $awareness,
                "saturasi" => $saturasi,
                "arm_diameter" => $arm_diameter,
                "anamnase" => $anamnase,
                "alo_anamnase" => $alloanamnase,
                "pemeriksaan" => $pemeriksaan,
                "teraphy_desc" => $teraphy_desc,
                "instruction" => $instruction,
                "employee_id" => $employee_id,
                "description" => $description,
                "modified_date" => $modified_date,
                "modified_by" => $modified_by,
                "modified_from" => $clinic_id,
                "status_pasien_id" => $status_pasien_id,
                "ageyear" => $ageyear,
                "agemonth" => $agemonth,
                "ageday" => $ageday,
                "thename" => $thename,
                "theaddress" => $theaddress,
                "theid" => $theid,
                "isrj" => $isrj,
                "gender" => $gender,
                "doctor" => $doctor,
                "petugas_id" => user()->username,
                "petugas" => user()->getFullname(),
                'vs_status_id' => '2',
                'valid_date' => $valid_date,
                'valid_user' => $valid_user,
                'valid_pasien' => $valid_pasien
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
        }


        $data = [
            'org_unit_code' => $org_unit_code,
            'pasien_diagnosa_id' => $pasien_diagnosa_id,
            'no_registration' => $no_registration,
            'visit_id' => $visit_id,
            'clinic_id' => $clinic_id,
            'class_room_id' => $class_room_id,
            'in_date' => $in_date,
            'exit_date' => $exit_date,
            'bed_id' => $bed_id,
            'keluar_id' => $keluar_id,
            'date_of_diagnosa' => str_replace('T', ' ', $date_of_diagnosa),
            'report_date' => $report_date,
            // 'diagnosa_id' => $diagnosa_id,
            'diagnosa_desc' => $diagnosa_desc,
            'employee_id' => $employee_id,
            'diag_cat' => $diag_cat,
            'anamnase' => $anamnase,
            'alloanamnase' => $alloanamnase,
            'description' => $description,
            'pemeriksaan' => $pemeriksaan,
            'body_id' => $body_id,
            'teraphy_desc' => $teraphy_desc,
            'teraphy_home' => $teraphy_home,
            'therapy_target' => $therapy_target,
            'medical_problem' => $medical_problem,
            'hurt' => $hurt,
            // 'hurt_type' => $hurt_type,
            'lab_result' => $lab_result,
            'ro_result' => $ro_result,
            'ecg_result' => $ecg_result,
            'standing_order' => $standing_order,
            'instruction' => $instruction,
            'result_id' => $result_id,
            'modified_date' =>  new RawSql('getdate()'),
            'modified_by' => user()->username,
            'modified_from' => $clinic_id,
            'status_pasien_id' => $status_pasien_id,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'theid' => $theid,
            'isrj' => $isrj,
            'gender' => $gender,
            'doctor' => $doctor,
            'nokartu' => $nokartu,
            'nosep' => $nosep,
            'tglsep' => $tglsep,
            'spesialistik' => $spesialistik,
            'sscondition_id' => new RawSql("newid()"),
            'valid_date' => $valid_date,
            'valid_user' => $valid_user,
            'valid_pasien' => $valid_pasien,
            'specialist_type_id' => $specialist_type_id
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
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where VALUE_SCORE in (2, 3) and P_TYPE = 'GEN0002'")->getResultArray());

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
                    $data = [
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
                    $lokalisModel->insert($data);
                } else {
                    return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
                }
            } else if (isset(${'fisik' . $value['value_id']}) && $value['value_score'] == 2) {
                $data = [
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
                $lokalisModel->insert($data);
            }
        }

        $pasienHistory = new PasienHistoryModel();

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
        $db->query("delete from pasien_history where no_registration = '$no_registration'");
        $i = 0;
        foreach ($select as $key => $value) {
            if (isset(${$value['value_id']})) {
                $i++;
                $data = [
                    'org_unit_code' => $org_unit_code,
                    'no_registration' => $no_registration,
                    'item_id' => $i,
                    'value_id' => $value['value_id'],
                    'value_desc' => $value['value_desc'],
                    'histories' => ${$value['value_id']},
                    'modified_by' => user()->username
                ];
                // $db->query("delete from pasien_history where no_registration = '$no_registration' and value_id = '" . $value['value_id'] . "'");
                $pasienHistory->insert($data);
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
        echo json_encode($array);
    }
    public function addAssessmentMedisDiagnosa()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // return json_encode("asdf");

        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        foreach ($body as $key => $value) {
            $data[$key] = ${$key};
        }

        if (!empty($diag_id)) {
            $pds = new PasienDiagnosasModel();
            $pds->where('pasien_diagnosa_id', $pasien_diagnosa_id)->delete();
            // return json_encode($data);

            foreach ($diag_id as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $pasien_diagnosa_id;
                $dataDiag['diagnosa_id'] = $diag_id[$key];
                $dataDiag['diagnosa_name'] = $diag_name[$key];
                $dataDiag['diag_cat'] = $diag_cat[$key];
                $dataDiag['suffer_type'] = $suffer_type[$key];
                $dataDiag['modified_by'] = user()->username;
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
                $dataProc['modified_by'] = user()->username;
                $pcs->insert($dataProc);
            }
        }

        $array   = array('status' => 'success', 'error' => '', 'message' => "update" . ' riwayat rekam medis berhasil', 'data' => $data);
        echo json_encode($array);
    }
    public function addDiagnosaKeperawatan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // return json_encode("asdf");

        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        foreach ($body as $key => $value) {
            $data[$key] = ${$key};
        }

        $db = db_connect();
        $org = new OrganizationunitModel();

        $id = $org->generateId();
        $pds = new PasienDiagnosasPerawatModel();
        $pdn = new PasienDiagnosaPerawatModel();
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
            'modified_by' => user()->username,
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
                $pds->insert($dataDiag);
            }
        }

        $array   = array('status' => 'success', 'error' => '', 'message' => "update" . ' riwayat rekam medis berhasil', 'data' => $data);
        echo json_encode($array);
    }
    public function getAssessmentMedis()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];
        $no_registration = $body['nomor'];
        $diag_cat = $body['diagCat'];

        $db = db_connect();
        $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname,
        ei.weight, ei.height, ei.temperature, ei.nadi, ei.tension_upper, ei.tension_below, ei.saturasi, ei.nafas, ei.arm_diameter, ei.saturasi, ei.vs_status_id, ei.awareness
        from pasien_diagnosa pd left join examination_info ei on ei.body_id = pd.body_id
        left join employee_all ea on pd.employee_id = ea.employee_id 
        left join clinic c on pd.clinic_id = c.clinic_id where pd.no_registration = '$no_registration' and pd.visit_id = '$visit_id' and pd.diag_cat = '$diag_cat'")->getResultArray());

        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = '$no_registration'")->getResultArray());

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
                    $filepath = WRITEPATH . 'uploads/signatures/' . $value['value_detail'];
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
    public function getAssessmentDocument()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];
        $no_registration = $body['nomor'];

        $db = db_connect();
        $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname from pasien_diagnosa pd left join employee_all ea on pd.employee_id = ea.employee_id left join clinic c on pd.clinic_id = c.clinic_id where no_registration = '$no_registration' and visit_id = '$visit_id'")->getResultArray());
        $selectexam = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname 
                                                    from examination_info pd 
                                                    left join employee_all ea on pd.employee_id = ea.employee_id 
                                                    left join clinic c on pd.clinic_id = c.clinic_id where no_registration = '$no_registration' and visit_id = '$visit_id'")->getResultArray());
        // return json_encode($selectexam);
        $selectdiagnosas = [];
        $selectprocedures = [];
        $selectdiagnosasnurse = [];
        if (isset($selectpd[0])) {
            $primaryPD = "";
            foreach ($selectpd as $key => $value) {
                $primaryPD .= "'" . $value['pasien_diagnosa_id'] . "',";
            }
            $primaryPD = substr($primaryPD, 0, -1);
            // return ($primaryPD);
            $selectdiagnosas = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());
            $selectprocedures = $this->lowerKey($db->query("select * from pasien_procedures where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());

            $selectdiagnosasnurse = [];
        }
        if (isset($selectexam[0])) {
            $primaryExam = "";
            foreach ($selectexam as $key => $value) {
                $primaryExam .= "'" . $value['body_id'] . "',";
            }
            $primaryExam = substr($primaryExam, 0, -1);
            // return ($primaryExam);
            $selectdiagnosasnurse = $this->lowerKey($db->query("select * from pasien_diagnosa_nurse pdn inner join pasien_diagnosas_nurse pds on pdn.body_id = pds.body_id where pdn.document_id in ($primaryExam) ")->getResultArray());
        }
        return json_encode([
            'pasienDiagnosa' => $selectpd,
            'pasienDiagnosas' => $selectdiagnosas,
            'pasienProcedures' => $selectprocedures,
            'examInfo' => $selectexam,
            'pasienDiagnosasNurse' => $selectdiagnosasnurse
        ]);
    }
    public function saveStabilitas()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        foreach ($body as $key => $value) {
            ${$key} = $value;
        }

        $db = db_connect();
        $indicator = new IndicatorModel();
        $data = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'body_id' => $body_id,
            'no_registration' => $no_registration,
            'examination_date' => Time::now(),
            'clinic_id' => $clinic_id,
            'employee_id' => $employee_id,
            'petugas_id' => $petugas_id,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'p_type' => $p_type,
            'total_score' => 0,
            'description' => $description,
            'modified_by' => $modified_by,
            'isvalid' => null,
            'valid_date' => null,
            'document_id' => $document_id
        ];
        // return json_encode($data);
        $select = $db->query("select body_id from assessment_indicator where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'")->getResultArray();
        // $db->query("delete from assessment_indicator where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

        if (!isset($select[0]['body_id']))
            $isSuccess = $indicator->save($data);
        // return json_encode($isSuccess);

        $apgarDetil = new indicatorDetailModel();

        $db->query("delete from assessment_indicator_detail where body_id = '$body_id' and visit_id = '$visit_id'");


        if (isset($stabilitas)) {
            $avalue = $this->lowerKey($db->query("select * from assessment_parameter_value where value_id = '" . $stabilitas . "'")->getResultArray());
            $data = [
                'org_unit_code' => $org_unit_code,
                'visit_id' => $visit_id,
                'trans_id' => $trans_id,
                'body_id' => $body_id,
                'p_type' => $avalue[0]['p_type'],
                'parameter_id' => $avalue[0]['parameter_id'],
                'value_score' => $avalue[0]['value_score'],
                'value_desc' => $avalue[0]['value_desc'],
                'modified_by' => user()->username,
                'value_id' => $avalue[0]['value_id']
            ];

            $istrue = $apgarDetil->insert($data);
        }
        return json_encode(($istrue));
    }
    public function getStabilitas()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();

        $apgar = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and document_id = '$bodyId'  and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());
        // return json_encode($apgar);

        $apgarDetil = "select * from assessment_indicator_detail where body_id in (";

        foreach ($apgar as $key => $value) {
            $apgarDetil .= "'" . $value['body_id'] . "',";
        }
        $apgarDetil = substr($apgarDetil, 0, strlen($apgarDetil) - 1);

        $apgarDetil .= ");";

        $apgarDetil = $this->lowerKey($db->query($apgarDetil)->getResultArray());

        return json_encode([
            'stabilitas' => $apgar,
            'stabilitasDetail' => $apgarDetil
        ]);
    }

    public function addBillCharge()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }


        // return json_encode($description);


        $eaModel = new EmployeeAllModel();
        $doctor = $eaModel->select('fullname')->find($employee_id);




        $tpModel = new TreatmentPerawatModel();


        $orgModel = new OrganizationunitModel();

        $isnew = true;
        if ($bill_id == null || $bill_id == '') {
            $id = $orgModel->generateId();
            $isnew = false;
        } else {
            $id = $bill_id;
            $isnew = true;
        }

        if (is_null($nota_no)) {
            $nota_no = $orgModel->generateId();
        }


        // return json_encode($kalurahan);

        $data = [];

        foreach ($body as $key => $value) {
            $data[$key] = $value;
        }

        $data['bill_id'] = $id;

        if (is_null($amount) || empty($amount) || $amount == '') {
            $data['amount'] = 0;
        } else {
            $data['amount'] = (float)$data['amount'];
        }
        if (
            is_null($quantity) || empty($quantity) || $quantity == ''
        ) {
            $data['quantity'] = 0;
        } else {
            $data['quantity'] = (float)$data['quantity'];
        }
        if (is_null($pokok_jual) || empty($pokok_jual) || $pokok_jual == '') {
            $data['pokok_jual'] = 0;
        } else {
            $data['pokok_jual'] = (float)$data['pokok_jual'];
        }
        if (is_null($ppn) || empty($ppn) || $ppn == '') {
            $data['ppn'] = 0;
        } else {
            $data['ppn'] = (float)$data['ppn'];
        }
        if (
            is_null($margin) || empty($margin) || $margin == ''
        ) {
            $data['margin'] = 0;
        } else {
            $data['margin'] = (float)$data['margin'];
        }
        if (
            is_null($subsidi) || empty($subsidi) || $subsidi == ''
        ) {
            $data['subsidi'] = 0;
        } else {
            $data['subsidi'] = (float)$data['subsidi'];
        }
        if (
            is_null($profesi) || empty($profesi) || $profesi == ''
        ) {
            $data['profesi'] = 0;
        } else {
            $data['profesi'] = (float)$data['profesi'];
        }
        if (
            is_null($discount) || empty($discount) || $discount == ''
        ) {
            $data['discount'] = 0;
        } else {
            $data['discount'] = (float)$data['discount'];
        }
        if (is_null($dose) || empty($dose) || $dose == '') {
            $data['dose'] = 0;
        } else {
            $data['dose'] = (float)$data['dose'];
        }
        if (is_null($orig_dose) || empty($orig_dose) || $orig_dose == '') {
            $data['orig_dose'] = 0;
        } else {
            $data['orig_dose'] = (float)$data['orig_dose'];
        }
        if (is_null($dose_presc) || empty($dose_presc) || $dose_presc == '') {
            $data['dose_presc'] = 0;
        } else {
            $data['dose_presc'] = (float)$data['dose_presc'];
        }
        if (
            is_null($amount_paid) || empty($amount_paid) || $amount_paid == ''
        ) {
            $data['amount_paid'] = 0;
        } else {
            $data['amount_paid'] = (float)$data['amount_paid'];
        }
        if (
            is_null($amount_plafond) || empty($amount_plafond) || $amount_plafond == ''
        ) {
            $data['amount_plafond'] = 0;
        } else {
            $data['amount_plafond'] = (float)$data['amount_plafond'];
        }
        if (is_null($amount_paid_plafond) || empty($amount_paid_plafond) || $amount_paid_plafond == '') {
            $data['amount_paid_plafond'] = 0;
        } else {
            $data['amount_paid_plafond'] = (float)$data['amount_paid_plafond'];
        }
        if (is_null($sell_price) || empty($sell_price) || $sell_price == '') {
            $data['sell_price'] = 0;
        } else {
            $data['sell_price'] = (float)$data['sell_price'];
        }
        if (
            is_null($diskon) || empty($diskon) || $diskon == ''
        ) {
            $data['diskon'] = 0;
        } else {
            $data['diskon'] = (float)$data['diskon'];
        }
        if (
            is_null($potongan) || empty($potongan) || $potongan == ''
        ) {
            $data['potongan'] = 0;
        } else {
            $data['potongan'] = (float)$data['potongan'];
        }
        if (is_null($bayar) || empty($bayar) || $bayar == '') {
            $data['bayar'] = 0;
        } else {
            $data['bayar'] = (float)$data['bayar'];
        }
        if (is_null($retur) || empty($retur) || $retur == '') {
            $data['retur'] = 0;
        } else {
            $data['retur'] = (float)$data['retur'];
        }
        if (
            is_null($ppnvalue) || empty($ppnvalue) || $ppnvalue == ''
        ) {
            $data['ppnvalue'] = 0;
        } else {
            $data['ppnvalue'] = (float)$data['ppnvalue'];
        }
        if (
            is_null($tagihan) || empty($tagihan) || $tagihan == ''
        ) {
            $data['tagihan'] = 0;
        } else {
            $data['tagihan'] = (float)$data['tagihan'];
        }
        if (
            is_null($koreksi) || empty($koreksi) || $koreksi == ''
        ) {
            $data['koreksi'] = 0;
        } else {
            $data['koreksi'] = (float)$data['koreksi'];
        }
        if (is_null($subsidisat) || empty($subsidisat) || $subsidisat == '') {
            $data['subsidisat'] = 0;
        } else {
            $data['subsidisat'] = (float)$data['subsidisat'];
        }
        if (is_null($stock_available) || empty($stock_available) || $stock_available == '') {
            $data['stock_available'] = 0;
        } else {
            $data['stock_available'] = (float)$data['stock_available'];
        }
        if (is_null($profession) || empty($profession) || $profession == '') {
            $data['profession'] = 0;
        } else {
            $data['profession'] = (float)$data['profession'];
        }



        $isSuccess = $tpModel->save($data);

        if ($isSuccess && $sell_price > 0) {

            $tbModel = new TreatmentBillModel();

            $tbModel->save($data);

            //             $db = db_connect();

            //             $db->query("insert into treatment_bill (ORG_UNIT_CODE, BILL_ID, NO_REGISTRATION, VISIT_ID, TARIF_ID, CLASS_ID, CLINIC_ID, CLINIC_ID_FROM, TREATMENT, TREAT_DATE, AMOUNT, QUANTITY, MEASURE_ID, POKOK_JUAL, PPN, MARGIN, SUBSIDI, 
            //                          EMBALACE, PROFESI, DISCOUNT, PAY_METHOD_ID, PAYMENT_DATE, ISLUNAS, DUEDATE_ANGSURAN, DESCRIPTION, KUITANSI_ID, NOTA_NO, ISCETAK, PRINT_DATE, RESEP_NO, RESEP_KE, DOSE, ORIG_DOSE, 
            //                          DOSE_PRESC, ITER, ITER_KE, SOLD_STATUS, RACIKAN, CLASS_ROOM_ID, KELUAR_ID, BED_ID, PERDA_ID, EMPLOYEE_ID, DESCRIPTION2, MODIFIED_BY, MODIFIED_DATE, MODIFIED_FROM, BRAND_ID, DOCTOR, 
            //                          JML_BKS, EXIT_DATE, FA_V, TASK_ID, EMPLOYEE_ID_FROM, DOCTOR_FROM, status_pasien_id, amount_paid, THENAME, THEADDRESS, THEID, serial_nb, TREATMENT_PLAFOND, AMOUNT_PLAFOND, 
            //                          AMOUNT_PAID_PLAFOND, CLASS_ID_PLAFOND, PAYOR_ID, PEMBULATAN, ISRJ, AGEYEAR, AGEMONTH, AGEDAY, GENDER, KAL_ID, CORRECTION_ID, CORRECTION_BY, KARYAWAN, ACCOUNT_ID, sell_price, diskon, 
            //                          INVOICE_ID, NUMER, MEASURE_ID2, POTONGAN, BAYAR, RETUR, TARIF_TYPE, PPNVALUE, TAGIHAN, KOREKSI, STATUS_OBAT, SUBSIDISAT, PRINTQ, PRINTED_BY, STOCK_AVAILABLE, STATUS_TARIF, CLINIC_TYPE, 
            //                          PACKAGE_ID, MODULE_ID, profession, THEORDER, CASHIER, TRANS_ID, NOSEP, PASIEN_ID, TOTAL_TAGIHAN, tarif_id_plafond)

            // select ORG_UNIT_CODE, BILL_ID, NO_REGISTRATION, VISIT_ID, TARIF_ID, CLASS_ID, CLINIC_ID, CLINIC_ID_FROM, TREATMENT, TREAT_DATE, AMOUNT, QUANTITY, MEASURE_ID, POKOK_JUAL, PPN, MARGIN, SUBSIDI, 
            //                          EMBALACE, PROFESI, DISCOUNT, PAY_METHOD_ID, PAYMENT_DATE, ISLUNAS, DUEDATE_ANGSURAN, DESCRIPTION, KUITANSI_ID, NOTA_NO, ISCETAK, PRINT_DATE, RESEP_NO, RESEP_KE, DOSE, ORIG_DOSE, 
            //                          DOSE_PRESC, ITER, ITER_KE, SOLD_STATUS, RACIKAN, CLASS_ROOM_ID, KELUAR_ID, BED_ID, PERDA_ID, EMPLOYEE_ID, DESCRIPTION2, MODIFIED_BY, MODIFIED_DATE, MODIFIED_FROM, BRAND_ID, DOCTOR, 
            //                          JML_BKS, EXIT_DATE, FA_V, TASK_ID, EMPLOYEE_ID_FROM, DOCTOR_FROM, status_pasien_id, amount_paid, THENAME, THEADDRESS, THEID, serial_nb, TREATMENT_PLAFOND, AMOUNT_PLAFOND, 
            //                          AMOUNT_PAID_PLAFOND, CLASS_ID_PLAFOND, PAYOR_ID, PEMBULATAN, ISRJ, AGEYEAR, AGEMONTH, AGEDAY, GENDER, KAL_ID, CORRECTION_ID, CORRECTION_BY, KARYAWAN, ACCOUNT_ID, sell_price, diskon, 
            //                          INVOICE_ID, NUMER, MEASURE_ID2, POTONGAN, BAYAR, RETUR, TARIF_TYPE, PPNVALUE, TAGIHAN, KOREKSI, STATUS_OBAT, SUBSIDISAT, PRINTQ, PRINTED_BY, STOCK_AVAILABLE, STATUS_TARIF, CLINIC_TYPE, 
            //                          PACKAGE_ID, MODULE_ID, profession, THEORDER, CASHIER, TRANS_ID, NOSEP, PASIEN_ID, TOTAL_TAGIHAN, tarif_id_plafond
            //                         from treatment_perawat where 
            //                         bill_id = '$id'
            //                         and STATUS_TARIF = 0");

            //             $db->query("update treatment_perawat set status_tarif = '1' where bill_id = '$id'");
        }

        // $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => 'tambah tindakan berhasil', 'billId' => $id, 'data' => $data);
        echo json_encode($array);
    }

    public function getTindakanPerawat()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];

        $db = db_connect();

        $select = $this->lowerKey($db->query("select * from treatment_perawat where visit_id = '$visit'")->getResultArray());


        return json_encode($select);
    }

    public function getAssessmentKeperawatan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];
        $no_registration = $body['nomor'];

        // return json_encode($no_registration);
        $db = db_connect();
        // $selectex = $this->lowerKey($db->query("select ex.*, c.name_of_clinic, ea.fullname 
        // from examination_info ex left join employee_all ea on ex.employee_id = ea.employee_id 
        // left join clinic c on ex.clinic_id = c.clinic_id where no_registration = '$no_registration' 
        // and visit_id = '$visit_id' order by examination_date desc")->getResultArray());


        $selectex = $this->lowerKey($db->query("
        select ex.*, 
        c.name_of_clinic, 
        ea.fullname,
        gcs.GCS_DESC
        from examination_info ex 
        left join employee_all ea on ex.employee_id = ea.employee_id 
        left join clinic c on ex.clinic_id = c.clinic_id 
        left outer join ASSESSMENT_GCS gcs on ex.BODY_ID = gcs.DOCUMENT_ID
        where ex.no_registration = '$no_registration' and ex.visit_id = '$visit_id' 
        order by examination_date desc
        ")->getResultArray()); //havin

        // return json_encode(count($selectex));
        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = '$no_registration'")->getResultArray());

        // $primaryex = "";
        // foreach ($selectex as $key => $value) {
        //     $primaryex .= "'" . $value['pasien_diagnosa_id'] . "',";
        // }
        // $primaryex = substr($primaryex, 0, -1);
        // // return ($primaryex);
        // $selectdiagnosas = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryex) ")->getResultArray());
        // $selectprocedures = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryex) ")->getResultArray());
        // $selectlokalis = $this->lowerKey($db->query("select * from assessment_lokalis where body_id in ($primaryex)")->getResultArray());

        // foreach ($selectlokalis as $key => $value) {
        //     if ($value['value_score'] == 3) {
        //         $filepath = WRITEPATH . 'uploads/signatures/' . $value['value_detail'];
        //         if (file_exists($filepath)) {
        //             $filedata = file_get_contents($filepath);
        //             $filedata64 = base64_encode($filedata);
        //             $selectlokalis[$key]['filedata64'] = $filedata64;
        //         }
        //     }
        // }

        // return json_encode([
        //     'examInfo' => $selectex,
        //     'pasienHistory' => $selecthistory,
        //     // 'papsienDiagnosas' => $selectdiagnosas,
        //     // 'pasienProcedures' => $selectprocedures,
        //     // 'lokalis' => $selectlokalis
        // ]);
        return $this->response->setJSON([
            'examInfo' => $selectex,
            'pasienHistory' => $selecthistory,
        ]); //havin
    }

    public function savePernapasan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();
        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                if ($value == 'on')
                    $data[strtolower($key)] = 1;
                else if ($value == 'off')
                    $data[strtolower($key)] = 0;
                else
                    $data[strtolower($key)] = $value;


            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }

        $napas = new RespirationModel();

        $napas->save($data);

        return json_encode($data);
    }
    public function getPernapasan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();

        $napas = new RespirationModel();
        $select = $this->lowerKey($napas->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'napas' => $select
        ]);
    }

    public function saveSirkulasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new CirculationModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getSirkulasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();

        $model = new CirculationModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'sirkulasi' => $select
        ]);
    }
    public function saveNeurosensoris()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new NeurosensorisModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getNeurosensoris()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();

        $model = new NeurosensorisModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'neuro' => $select
        ]);
    }

    public function saveIntegumen()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new IntegumenModel();

        $model->save($data);

        return json_encode($data);
    }
    public function saveAnak()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new AnakModel();

        $model->save($data);

        return json_encode($data);
    }
    public function saveNeonatus()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new NeonatusModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getIntegumen()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $db = db_connect();

        $model = new IntegumenModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'integumen' => $select
        ]);
    }

    public function saveADL()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new ADLModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getADL()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new ADLModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'adl' => $select
        ]);
    }
    public function saveDekubitus()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new DekubitusModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getDekubitus()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new DekubitusModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'dekubitus' => $select
        ]);
    }

    public function savePencernaan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new DigestionModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getPencernaan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new DigestionModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'pencernaan' => $select
        ]);
    }
    public function savePerkemihan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new BladderModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getPerkemihan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new BladderModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'perkemihan' => $select
        ]);
    }
    public function savePsikologi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];


        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new SpiritualModel();

        $model->save($data);

        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GIZI001' and value_score = '1'")->getResultArray());
        $spiritual = new SpiritualDetailModel();
        $db->query("delete from assessment_spiritual_detail where body_id = '$body_id' and visit_id = '$visit_id'");
        foreach ($select as $key => $value) {
            if (isset(${$value['p_type'] . $value['parameter_id']})) {

                $data = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $trans_id,
                    'body_id' => $body_id,
                    'p_type' => $value['p_type'],
                    'parameter_id' => $value['parameter_id'],
                    'value_id' => $value['value_id'],
                    'value_score' => $value['value_score'],
                    'value_desc' => $value['value_desc'],
                    'modified_by' => user()->username
                ];

                $spiritual->insert($data);
            }
        }



        return json_encode($data);
    }
    public function getPsikologi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new SpiritualModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        $bodyAll = [];
        foreach ($select as $key => $value) {
            $bodyAll[] = $value['body_id'];
        }

        $spiritualDetail = new SpiritualDetailModel();
        $selectSpiritual = $this->lowerKey($spiritualDetail->whereIn("body_id", $bodyAll)->findAll());

        return json_encode([
            'psikologi' => $select,
            'psikologiDetail' => $selectSpiritual
        ]);
    }

    public function savegizi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];


        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new NutritionModel();

        $model->save($data);

        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type like 'gizi%'")->getResultArray());
        $nutrition = new NutritionDetailModel();
        $db->query("delete from assessment_screen_nutrition_detail where body_id = '$body_id' and visit_id = '$visit_id'");
        foreach ($select as $key => $value) {
            if (isset(${$value['p_type'] . $value['parameter_id']})) {
                if (${$value['p_type'] . $value['parameter_id']} == $value['value_score']) {
                    $data = [
                        'org_unit_code' => $org_unit_code,
                        'visit_id' => $visit_id,
                        'trans_id' => $trans_id,
                        'body_id' => $body_id,
                        'p_type' => $value['p_type'],
                        'parameter_id' => $value['parameter_id'],
                        'value_id' => $value['value_id'],
                        'value_score' => $value['value_score'],
                        'value_desc' => $value['value_desc'],
                        'modified_by' => user()->username
                    ];

                    $nutrition->insert($data);
                }
            }
        }



        return json_encode($data);
    }
    public function getgizi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new NutritionModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        $bodyAll = [];
        foreach ($select as $key => $value) {
            $bodyAll[] = $value['body_id'];
        }

        $giziDetail = new NutritionDetailModel();
        $selectgizi = $this->lowerKey($giziDetail->whereIn("body_id", $bodyAll)->findAll());

        return json_encode([
            'gizi' => $select,
            'giziDetail' => $selectgizi
        ]);
    }
    public function saveeducationForm()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new EducationFormModel();

        $model->save($data);

        return json_encode($data);
    }
    public function geteducationForm()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new EducationFormModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'educationForm' => $select
        ]);
    }
    public function saveeducationIntegration()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }

        $model = new EducationIntegrationModel();

        $model->save($data);

        $modelDetail = new EducationIntegrationDetailModel();

        $db = db_connect();

        // return json_encode($p_type);
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = '" . $p_type . "' ")->getResultArray());
        $db->query("delete from assessment_education_integration_detail where body_id = '" . $body_id . "'");


        foreach ($select as $key => $value) {
            if ($value['p_type'] == $p_type && isset(${$value['value_info']})) {

                if ($value['value_score'] == ${$value['value_info']}) {
                    $data1 = [
                        'org_unit_code' => $org_unit_code,
                        'visit_id' => $visit_id,
                        'trans_id' => $trans_id,
                        'body_id' => $body_id,
                        'p_type' => $p_type,
                        'parameter_id' => $value['parameter_id'],
                        'value_score' => $value['value_score'],
                        'value_id' => $value['value_id'],
                        'value_desc' => $value['value_desc'],
                        'modified_by' => user()->username,
                    ];
                    // return json_encode($data1);
                    try {
                        $modelDetail->insert($data1);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }
        }

        if (isset($GEN0014Bahasa) && false) {
            foreach ($GEN0014Bahasa as $key => $value) {
                $data1 = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $trans_id,
                    'body_id' => $body_id,
                    'p_type' => 'GEN0014',
                    'parameter_id' => $value,
                    'value_score' => $value,
                    'value_id' => 'G014' . $value,
                    'value_desc' => $GEN0014Aktif[$key],
                    'modified_by' => user()->username,
                ];

                $modelDetail->insert($data1);
            }
        }

        return json_encode($data);
    }
    public function saveEducationIntegrationPlan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new EducationIntegrationPlanModel();

        $model->insert($data);

        return json_encode($data);
    }
    public function saveEducationIntegrationProvision()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
            if (isset($reevaluation_date))
                $data['reevaluation_date'] = str_replace("T", " ", $reevaluation_date);
        }


        $model = new EducationIntegrationProvisionModel();

        $model->insert($data);

        return json_encode($data);
    }
    public function geteducationIntegration()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new EducationIntegrationModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        // return json_encode($select);
        $db = db_connect();
        $queryDetil = "select * from assessment_education_integration_detail where body_id in (";
        $queryPlan = "select * from assessment_education_plan where body_id in (";
        $queryProvision = "select * from assessment_education_plan where body_id in (";

        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['body_id'] . "',";
            $queryPlan .= "'" . $value['body_id'] . "',";
            $queryProvision .= "'" . $value['body_id'] . "',";
        }
        $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);
        $queryPlan = substr($queryPlan, 0, strlen($queryPlan) - 1);
        $queryProvision = substr($queryProvision, 0, strlen($queryProvision) - 1);

        $queryDetil .= ");";
        $queryPlan .= ") order by body_id, plan_ke;";
        $queryProvision .= ") order by body_id, plan_ke;";

        $eduDetail = $this->lowerKey($db->query($queryDetil)->getResultArray());
        $eduPlan = $this->lowerKey($db->query($queryPlan)->getResultArray());
        $eduProvision = $this->lowerKey($db->query($queryProvision)->getResultArray());


        return json_encode([
            'educationIntegration' => $select,
            'educationIntegrationDetail' => $eduDetail,
            'educationPlan' => $eduPlan,
            'educationProvision' => $eduProvision
        ]);
    }
    public function saveSeksual()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new ReproductionModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getSeksual()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new ReproductionModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'seksual' => $select
        ]);
    }
    public function saveSocial()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new SocialModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getSocial()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new SocialModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'social' => $select
        ]);
    }
    public function saveHearing()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new VisionHearingModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getHearing()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new VisionHearingModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'hearing' => $select
        ]);
    }
    public function saveSleeping()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }


        $model = new SleepingModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getSleeping()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new SleepingModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());

        return json_encode([
            'sleeping' => $select
        ]);
    }
    public function saveGcs()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

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

        return json_encode($data);
    }
    public function getGcs()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new GcsModel();
        if ($bodyId == '') {
            $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")->findAll());
        } else {
            $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        }
        return json_encode([
            'gcs' => $select
        ]);
    }
    public function copyGcs()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new GcsModel();
        $data = $this->lowerKey($model->where("visit_id", $visit)->orderBy("examination_date desc")->select("*")->first());
        $org = new OrganizationunitModel();
        $id = $org->generateId();
        $data['body_id'] = $id;
        $data['document_id'] = $bodyId;
        unset($data['modified_date']);
        $data['examination_date'] = Time::now();
        $model->insert($data);
        $result[] = $data;

        return json_encode([
            'gcs' => $result
        ]);
    }

    public function saveFallRisk()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }
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

        return json_encode('berhasil');
    }
    public function getFallRisk()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

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

        return json_encode([
            'fallRisk' => $select,
            'fallRiskDetail' => $fallRiskDetil
        ]);
    }
    public function copyFallRisk()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        $bodyId = $body['body_id'];

        $model = new FallRiskModel();
        if ($bodyId != '') {
            $select = $this->lowerKey($model->where("visit_id", $visit)->select("top(1) *")->orderBy("examination_date")->findAll());
            if (!empty($select)) {
                $model = new FallRiskModel();
                $data = $select[0];
                $data['document_id'] = $bodyId;
                $org = new OrganizationunitModel();
                $id = $org->generateId();
                $idOld = $data['body_id'];
                $data['body_id'] = $id;
                unset($data['modified_date']);
                $data['examination_info'] = Time::now();
                $data['modified_by'] = user()->username;
                $ispassing = $model->insert($data);
                $selectFall[] = $data;
                if ($ispassing) {
                    $db = db_connect();
                    $queryDetil = "select * from assessment_fall_risk_detail where body_id = '$idOld'";
                    $fallRiskDetil = $this->lowerKey($db->query($queryDetil)->getResultArray());
                    $selectDetil = [];
                    foreach ($fallRiskDetil as $key => $value) {
                        $modelDetail = new FallRiskDetailModel();
                        $dataDetail = $value;
                        $dataDetail['body_id'] = $id;
                        unset($data['modified_date']);
                        $dataDetail['modified_by'] = user()->username;
                        $modelDetail->insert($dataDetail);
                        $selectDetil[] = $dataDetail;
                    }
                    return json_encode([
                        'fallRisk' => $selectFall,
                        'fallRiskDetail' => $selectDetil
                    ]);
                }
            } else {
                return $this->customResponse('No records found', 404);
            }
        } else {
            return $this->customResponse('No records found', 404);
        }
    }

    public function saveOrderGizi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();
        // $body = json_decode($body, true);



        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }

        // return json_encode($data);

        $model = new DietInapModel();

        $model->save($data);

        return json_encode($data);
    }
    public function deleteOrderGizi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $dtype_id = $body['dtype_id'];

        $model = new DietInapModel();

        $isDelete = $model->delete($dtype_id);

        if ($isDelete) {
            return $this->response->setStatusCode(200)
                ->setJSON([
                    "code" => 200,
                    "status" => "success"
                ]);
        } else {
            return $this->response->setStatusCode(200)
                ->setJSON([
                    "code" => 500,
                    "status" => "gagal"
                ]);
        }
    }
    public function getOrderGizi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        // $bodyId = $body['body_id'];

        $model = new DietInapModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")->findAll());
        return json_encode([
            'orderGizi' => $select
        ]);
    }
    public function saveTransfer()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();
        // $body = json_decode($body, true);


        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }
        // $data['org_unit_code'] = '330710';
        // $data['visit_id'] = '202405231955390970F26';

        // return json_encode($data);

        $model = new PasienTransferModel();

        $model->save($data);

        return json_encode($data);
    }
    public function getTransfer()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        // $bodyId = $body['body_id'];

        $model = new PasienTransferModel();
        // if ($bodyId != '') {
        //     $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        // } else {
        // }
        $select = $this->lowerKey($model->where("visit_id", $visit)->select("*, employee_all.fullname")->join("employee_all", "employee_all.employee_id = pasien_transfer.employee_id", "inner")->findAll());

        $db = db_connect();

        $queryDetil = "select *, c.name_of_clinic, ea.fullname from examination_info ei left join clinic c on c.clinic_id = ei.clinic_id left join employee_all ea on ei.employee_id = ea.employee_id
        where body_id in (";

        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id'] . "',";
        }
        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id2'] . "',";
        }
        $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);

        $queryDetil .= ");";

        $examinfo = $this->lowerKey($db->query($queryDetil)->getResultArray());

        $queryVisit = "select *, c.name_of_clinic, ea.fullname from pasien_visitation ei left join clinic c on c.clinic_id = ei.clinic_id left join employee_all ea on ei.employee_id = ea.employee_id
        where visit_id in (";

        foreach ($select as $key => $value) {
            $queryVisit .= "'" . $value['document_id'] . "',";
        }
        foreach ($select as $key => $value) {
            $queryVisit .= "'" . $value['document_id2'] . "',";
        }
        $queryVisit = substr($queryVisit, 0, strlen($queryVisit) - 1);

        $queryVisit .= ");";

        $visit = $this->lowerKey($db->query($queryVisit)->getResultArray());



        return json_encode([
            'transfer' => $select,
            'examinfo' => $examinfo,
            'visit' => $visit
        ]);
    }

    public function saveExaminationInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getPost();
        $dataexam = [];
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $dataexam[$key] = $value;
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

        $pasienHistory = new PasienHistoryModel();

        $db = db_connect();

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
        $db->query("delete from pasien_history where no_registration = '$no_registration'");
        $i = 0;
        foreach ($select as $key => $value) {
            if (isset(${$value['value_id']})) {
                $i++;
                $data = [
                    'org_unit_code' => $org_unit_code,
                    'no_registration' => $no_registration,
                    'item_id' => $i,
                    'value_id' => $value['value_id'],
                    'value_desc' => $value['value_desc'],
                    'histories' => ${$value['value_id']},
                    'modified_by' => user()->username
                ];
                // $db->query("delete from pasien_history where no_registration = '$no_registration' and value_id = '" . $value['value_id'] . "'");
                $pasienHistory->insert($data);
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
        if (!empty($diag_id)) {
            foreach ($diag_id as $key => $value) {
                $dataDiag = [
                    'org_unit_code' => $org_unit_code,
                    'body_id' => $id,
                    'diagnosan_id' => $diag_id[$key],
                    'diagnosa_date' => new RawSql("getdate()"),
                    'diag_notes' => $diag_name[$key],
                    'modified_by' => user()->username
                ];
                $pds->insert($dataDiag);
            }
        }



        return json_encode($dataexam);
    }
    public function verifyAllCppt()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $data = $body['data'];
        // return json_encode($data[0]);


        if (is_array($data)) {
            if (true) {
                $where = '';
                foreach ($data as $key => $value) {
                    $where .= "'$value',";
                }
                $where = substr($where, 0, -1);
                $update = [
                    "valid_user" => user()->username,
                    "valid_date" => new RawSql("get_date()")
                ];
                // return json_encode($where);
                $db = db_connect();
                $db->query("update examination_info
                    set valid_user = '" . user()->username . "',
                    valid_date = getdate()
                    where body_id in (" . $where . ")
                ");
            }
        }

        return
            $this->response->setJSON(['response' => true]);
    }
    public function getNifasAll()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $visit = $body['visit_id'];

        $model = new NifasModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")->findAll());
        return json_encode([
            'nifas' => $select
        ]);
    }

    public function saveNifas()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        // return json_encode($body);
        // $body = json_decode($body, true);



        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }

        // return json_encode($data);

        $model = new NifasModel();

        $model->save($data);

        return json_encode($data);
    }
    public function deleteNifas($bodyId)
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $model = new NifasModel();
        $select = $model->delete($bodyId);
        return json_encode([
            'result' => $select
        ]);
    }
    public function getPersalinan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $visit = $body['visit_id'];

        $model = new PersalinanModel();
        $select = $this->lowerKey($model->where("visit_id", $visit)->select("*")->findAll());
        return json_encode([
            'persalinan' => $select
        ]);
    }

    public function savePersalinan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        // return json_encode($body);
        // $body = json_decode($body, true);



        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${strtolower($key)} = $value;
            if (!(is_null(${strtolower($key)}) || ${strtolower($key)} == ''))
                $data[strtolower($key)] = $value;
            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
            if (isset($time))
                $data['time'] = str_replace("T", " ", $time);
        }

        // return json_encode($data);

        $model = new PersalinanModel();

        $model->save($data);

        return json_encode($data);
    }
    public function deletePersalinan($bodyId)
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $model = new PersalinanModel();
        $select = $model->delete($bodyId);
        return json_encode([
            'result' => $select
        ]);
    }
    public function checkpass()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();
        // $body = json_decode($body, true);


        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;
        }


        $users = new UserModel();

        $select = $users->select('password_hash')->where('username', $user_id)->findAll();

        // return json_encode(base64_encode(hash('sha384', $password, true)));

        return json_encode(password_verify(base64_encode(hash('sha384', $password, true)), $select[0]->password_hash));
        // return json_encode(password_verify(base64_encode(hash('sha384', "Heny3008", true)), $select[0]->password_hash));
        // return json_encode(password_hash(("Agussalim7"), PASSWORD_BCRYPT));
    }
    public function cetakKeperawatan($visit, $vactination_id = null, $titlekeperawatan = null)
    {
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);

            $db = db_connect();
            $select = $this->lowerKey($db->query("select 
            pd.NO_REGISTRATION as no_RM,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            pd.CLASS_ROOM_ID,
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end as jeniskel,
            p.CONTACT_ADDRESS as alamat,
            pd.DOCTOR as dpjp,
            c.name_of_clinic as departmen,
            class.NAME_OF_CLASS as kelas,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID as bed,
            pd.IN_DATE as tanggal_masuk,
            convert(varchar,P.DATE_OF_BIRTH,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
            gcs.GCS_E,
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE as gcs,
            gcs.GCS_DESC,
            max(case when apv.PARAMETER_ID = '01' and apv.VALUE_SCORE = GCS_E then apv.VALUE_DESC else '' end ) as GSC_E_DESC,
            max(case when apv.PARAMETER_ID = '02' and apv.VALUE_SCORE = GCS_M then apv.VALUE_DESC else '' end ) as GSC_M_DESC,
            max(case when apv.PARAMETER_ID = '03' and apv.VALUE_SCORE = GCS_V then apv.VALUE_DESC else '' end ) as GSC_V_DESC,
            pd.DIAGNOSA_ID as icd10,
            pd.DIAGNOSA_DESC as namadiagnosa,
            pd.ANAMNASE as anamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090101'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090201'  then histories else '' end ) as riwayat_penyakit_keluarga,
            max(case when PH.value_id = 'G0090301'  then histories else '' end ) as riwayat_alkohol,
            max(case when PH.value_id = 'G0090302'  then histories else '' end ) as riwayat_merokok,
            max(case when PH.value_id = 'G0090303'  then histories else '' end ) as riwayat_diet,
            max(case when PH.value_id = 'G0090401'  then histories else '' end ) as riwayat_obat_dikonsumsi,
            max(case when PH.value_id = 'G0090402'  then histories else '' end ) as riwayat_kehamilan,
            max(case when PH.value_id = 'G0090403'  then histories else '' end ) as riwayat_imunisasi,
            MAX(CASE WHEN EDU.INFORMATION_RECEIVER = '1' THEN 'Penerima Pasien' + ' materi edukasi : '   + edu.education_material
            else 'Kerabat Pasien dengan nama : ' + edu.family_name + ' materi edukasi : ' + edu.education_material  end ) as edukasi_pasien,
            igt.nama as tindaklanjut,
            pd.TGLKONTROL as tanggal_kontrol,
            ei.WEIGHT as berat,
            ei.HEIGHT as tinggi,
            ei.TENSION_UPPER as tensi_atas,
            ei.TENSION_BELOW as tensi_bawah,
            ei.nadi,
            ei.TEMPERATURE AS Suhu,
            ei.NAFAS as respiration,
            ei.SATURASI AS SPO2,
            EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) AS IMT,
            isnull((select top(1) total_score from ASSESSMENT_FALL_RISK
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
            isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
            PD.DIAGNOSA_ID,
            PD.MEDICAL_PROBLEM AS MASALAH_MEDIS,
            'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
            PD.HURT AS PENYEBAB_CIDERA,
            PD.THERAPY_TARGET AS SASARAN,
            PD.LAB_RESULT AS LABORATORIUM,
            PD.RO_RESULT AS RADIOLOGI,
            PD.TERAPHY_DESC AS FARMAKOLOGIA,
            PD.INSTRUCTION AS PROSEDUR,
            PD.STANDING_ORDER AS STANDING_ORDER,
            PD.DOCTOR AS DOKTER,
            '' rencana_tl,
            '' kontrol,
			 isnull((select top(1) case when total_score = 5 then 'ATS V' 
			 when total_score = 4 then 'ATS IV'
			 when total_score = 3 then 'ATS III'
			 when TOTAL_SCORE = 2 then 'ATS II'
			 when total_score = 1 then 'ATS I' end 
			 from ASSESSMENT_indicator
            where DOCUMENT_ID = pd.pasien_diagnosa_id order by EXAMINATION_DATE desc) ,'') as ATS_Tipe,

			 ATS_ITEM = STUFF(
             (SELECT ',' + value_desc
              FROM ASSESSMENT_INDICATOR_DETAIL aid
			  WHERE aid.BODY_ID in (select BODY_ID from ASSESSMENT_INDICATOR 
					where DOCUMENT_ID = pd.pasien_diagnosa_id)
              FOR XML PATH (''))
             , 1, 1, '') ,
			max(  case when arp.PREGNANT = '1' then 'Hamil'
			  else 'Tidak Hamil' end ) as hamil,
			  max(arp.g) as hamil_G,
			   max(arp.p) as hamil_p,
			    max(arp.a) as hamil_a

            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            left outer join ASSESSMENT_GCS gcs on pd.PASIEN_DIAGNOSA_ID = gcs.DOCUMENT_ID
            left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on pd.PASIEN_DIAGNOSA_ID = EDU.DOCUMENT_ID
			left outer join INASIS_GET_TINDAKLANJUT igt on pd.RENCANATL = igt.KODE
			left outer join ASSESSMENT_REPRODUCTION arp on pd.PASIEN_DIAGNOSA_ID = arp.DOCUMENT_ID
            LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
           , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '202405262033530190C16'
            and PD.VISIT_ID =  '2024052400101208008C3'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.CLASS_ROOM_ID,
            pd.NO_REGISTRATION, 
            p.NAME_OF_PASIEN, 
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end, 
            p.CONTACT_ADDRESS,
            pd.DOCTOR, 
            c.name_of_clinic, 
            class.NAME_OF_CLASS,  
            cr.NAME_OF_CLASS,  
            pd.BED_ID,  
            pd.IN_DATE,
            pd.ANAMNASE, 
            pd.DESCRIPTION,
            ei.WEIGHT,
            ei.HEIGHT, 
            ei.TENSION_UPPER, 
            ei.TENSION_BELOW, 
            ei.nadi,
            ei.NAFAS, 
            ei.SATURASI,
            ei.TEMPERATURE,
            convert(varchar,P.date_of_birth,105),
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR',
            gcs.GCS_E, 
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE, 
            gcs.GCS_DESC,
            igt.nama,
            pd.TGLKONTROL,
            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ), 
            THERAPY_TARGET,
            PD.LAB_RESULT, 
            PD.RO_RESULT,
            PD.TERAPHY_DESC, 
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR")->getResultArray());

            $neonatus = $this->lowerKey($db->query(
                "
                SELECT 
                    GEN_INFO AS KEADAAN_UMUM, 
                    MOBILITY AS PERGERAKAN, 
                    SKIN_TONE AS WARNA_KULIT, 
                    TURGOR AS TURGUR, 
                    TONUS AS TONUS, 
                    VOICE AS SUARA, 
                    REFLECT_MORO AS REFLEK_MORO, 
                    REFLECT_SUCK AS REFLEK_MENGHISAP, 
                    GRIPS AS MEMEGANG, 
                    TONUS_NECK AS TONUS_LEHER, 
                    HEAD_DIAMETER AS LINGKAR_KEPALA, 
                    CHEST_DIAMETER AS LINGKAR_DADA 
                FROM ASSESSMENT_NEONATUS_PHYSIC
                WHERE 
                    ASSESSMENT_NEONATUS_PHYSIC.BODY_ID = '20240530183632520'
                    AND ASSESSMENT_NEONATUS_PHYSIC.VISIT_ID = '20240530141940038069A'
               "
            )->getResultArray());
            $apgarWaktu = $this->lowerKey($db->query(
                "
               SELECT * FROM ASSESSMENT_PARAMETER_type WHERE p_type in ('ASES032','ASES033', 'ASES034')
                "
            )->getResultArray());
            $apgarData = $this->lowerKey($db->query(
                "
               SELECT 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_PARAMETER.PARAMETER_ID,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES032' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_DESC ELSE '' END) AS menit_1,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES033' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_DESC ELSE '' END) AS menit_5,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES034' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_DESC ELSE '' END) AS menit_10,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES032' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_SCORE ELSE NULL END) AS VALUE_SCORE_1,
                        MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES033' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_SCORE ELSE NULL END) AS VALUE_SCORE_5,
                            MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES034' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_SCORE ELSE NULL END) AS VALUE_SCORE_10
                FROM 
                    ASSESSMENT_APGAR_DETAIL
                LEFT JOIN 
                    ASSESSMENT_PARAMETER ON ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID
                WHERE 
                    ASSESSMENT_APGAR_DETAIL.BODY_ID = '20240530183632520'
                    AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '20240530141940038069A'
                    AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
            )->getResultArray());

            $spiritual = $this->lowerKey($db->query(
                "
                SELECT 
                    RELIGION_BAN_DESC as LARANGAN_KEYAKINAN,
                    FAMILYRELATION as HUBUNGAN_KELUARGA,
                    SOCIAL_BARIER AS HAMBATAN_SOSIAL,
                    NAMA_AGAMA AS NAMA_AGAMA,
                    MYTH_DESC AS MITOS_BUDAYA
                FROM ASSESSMENT_SPIRITUAL
                INNER JOIN AGAMA ON ASSESSMENT_SPIRITUAL. KODE_AGAMA = AGAMA.KODE_AGAMA
                WHERE 
                    ASSESSMENT_SPIRITUAL.BODY_ID = '20240512091400602'
                    AND ASSESSMENT_SPIRITUAL.VISIT_ID = '202404241151300470C77'
                    "
            )->getFirstRow());

            $activity = $this->lowerKey($db->query(
                "
                SELECT 
                    PARAMETER_DESC, TOTAL_DEPENDENCY,
                    MAX(CASE WHEN ASSESSMENT_ADL_BARTHEL.P_TYPE = 'ASES016' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_DESC ELSE '' END) AS VALUE_DESC,
                    MAX(CASE WHEN ASSESSMENT_ADL_BARTHEL.P_TYPE = 'ASES016' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ELSE '' END) AS VALUE_SCORE
                FROM ASSESSMENT_ADL_BARTHEL
                INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ADL_BARTHEL.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ADL_BARTHEL.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
                WHERE VISIT_ID = '202404241151300470C77'
                AND BODY_ID = '20240510071513301'
                GROUP BY ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID, TOTAL_DEPENDENCY
                    "
            )->getResultArray());

            $neurosensoris = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_NEUROSENSORIS', 'ASES038', '202404241151300470C77', '20240509195746955'))->getResultArray());

            $circulation = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_CIRCULATION', 'ASES039', '202404241151300470C77', '20240509190723989'))->getResultArray());

            $pencernaan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_DIGESTION', 'ASES040', '202406201025550143A8D', '20240621034426544'))->getResultArray());

            $pernapasan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_RESPIRATION', 'ASES041', '202406201025550143A8D', '20240621053857150'))->getResultArray());

            $perkemihan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_BLADDER', 'ASES042', '202406201025550143A8D', '20240621054026822'))->getResultArray());

            $reproduksi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_REPRODUCTION', 'ASES043', '202406140643270000A44', '20240618170701073'))->getResultArray());

            $thtdanmata = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_VISION_HEARING', 'ASES044', '202406201025550143A8D', '20240621034812725'))->getResultArray());

            $tidurdanistirahat = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SLEEPING', 'ASES046', '202406201025550143A8D', '20240621034741735'))->getResultArray());

            $dekubitus = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_DEKUBITUS', 'ASES047', '202406201025550143A8D', '20240621033901362'))->getResultArray());

            $integumen = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_INTEGUMEN', 'ASES036', '202406201025550143A8D', '20240621034557612'))->getResultArray());

            $sosialekonomi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SOCEC', 'ASES037', '202406140643270000A44', '20240618170820848'))->getResultArray());


            $title = "Asesmen Keperawatan ";
            if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '') && $visit['class_room_id'] != '') {
                $title .= 'Rawat Inap ';
            } else {
                $title .= 'Rawat Jalan ';
            }
            if ($titlekeperawatan != null) {
                $title .= $titlekeperawatan;
            }





            // $pediatri = $this->lowerKey($db->query("
            //     SELECT
            //         PREGNANCY_PERIOD AS LAMA_KEHAMILAN,
            //         COMPLICATION AS KOMPLIKASI,
            //         NEONATUS_ISSUES AS MASALAH_NEONATUS,
            //         MATERNAL_ISSUES AS MASALAH_METERNAL,
            //         VACTINATION_HSITORY AS RIWAYAT_IMUNISASI,
            //         PRONE_AGE AS USIA_TENGKURAP,
            //         SITTING_AGE AS USIA_DUDUK,
            //         BABLING_AGE AS USIA_MENGOCEH,
            //         STANDING_AGE AS USIA_BERDIRI,
            //         TALKING_AGE AS USIA_BERBICARA,
            //         WALKING_AGE AS USIA_BERJALAN,
            //         MILK_FEEDING AS ASI,
            //         ADDITINAL_FOOD AS MAKANAN_TAMBAHAN,
            //         SITTER AS PENGASUH,
            //         CHARACTERS AS PEMBAWAAN,
            //         TEMPRAMEN AS TEMPRAMEN,
            //         ILLNESRISK_AVOID AS RESIKO_PENYAKIT,
            //         GROWTH_DISORDER AS GANGGUAN_TUMBUH
            //     FROM ASSESSMENT_PEDIATRIC AP
            //     WHERE VISIT_ID = '202406140643270000A44'
            //     AND DOCUMENT_ID = '20240618170820848'
            //         "
            // )->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            // $selectinfo = $this->query_template_info($db, '202406140643270000A44', '20240614173754692');
            $selectinfo = $visit;

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "neonatus" => $neonatus,
                    "apgarWaktu" => $apgarWaktu,
                    "apgarData" => $apgarData,
                    "spiritual" => $spiritual,
                    "activity" => $activity,
                    "neurosensoris" => $neurosensoris,
                    "circulation" => $circulation,
                    "pencernaan" => $pencernaan,
                    "pernapasan" => $pernapasan,
                    "perkemihan" => $perkemihan,
                    "reproduksi" => $reproduksi,
                    "thtdanmata" => $thtdanmata,
                    "tidurdanistirahat" => $tidurdanistirahat,
                    "dekubitus" => $dekubitus,
                    "integumen" => $integumen,
                    "sosialekonomi" => $sosialekonomi,
                    "organization" => $selectorganization,
                    "info" => $selectinfo,
                    // "pediatri" => $pediatri[0],
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "info" => $selectinfo
                ]);
            }
        }
    }
    public function getKontrol()
    {
        // Check if the request method is POST
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'error' => 'Invalid request method.',
                'status' => 405 // Method Not Allowed
            ])->setStatusCode(405);
        }

        // Get and decode the JSON body
        $body = $this->request->getBody();
        $bodyArray = json_decode($body, true);

        // Check if the JSON body was decoded correctly
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setJSON([
                'error' => 'Invalid JSON format.',
                'status' => 400 // Bad Request
            ])->setStatusCode(400);
        }

        // Validate the presence of 'visit' and 'nosurat' in the body
        if (!isset($bodyArray['visit']) || !isset($bodyArray['nosurat'])) {
            return $this->response->setJSON([
                'error' => 'Missing required parameters.',
                'status' => 400 // Bad Request
            ])->setStatusCode(400);
        }

        $visit = $bodyArray['visit'];
        $nosurat = $bodyArray['nosurat'];

        // Validate 'visit' and 'nosurat' are not empty
        if (empty($visit) || empty($nosurat)) {
            return $this->response->setJSON([
                'error' => 'Visit ID and No. Surat cannot be empty.',
                'status' => 400 // Bad Request
            ])->setStatusCode(400);
        }

        // Initialize the model and perform the query
        $model = new InasisKontrolModel();

        // Assuming 'find' is a method that should be used with an ID,
        // verify if 'find' is appropriate or use another method if needed.
        $select = $this->lowerKey($model->join("clinic c", "c.kdpoli = inasis_kontrol.polikontrol_kdpoli")->where("visit_id", $visit)->where("surattype", 1)->find($nosurat));

        // Check if the result was found
        if ($select === null) {
            return $this->response->setJSON([
                'error' => 'No records found.',
                'status' => 404 // Not Found
            ])->setStatusCode(200);
        }

        // Return the result as JSON
        return $this->response->setJSON([
            'data' => $select,
            'status' => 200 // OK
        ])->setStatusCode(200);
    }
    public function saveSkdp()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $request = $body['request'];
        $noskdp = $body['noSuratKontrol'];
        $visit = $body['visit_id'];
        $nomr = $body['no_registration'];
        $transfer = $body['transfer'];
        $no_registration = $body['no_registration'];
        $visit_id = $body['visit_id'];
        $noSuratKontrol = $body['noSuratKontrol'];

        $clinic_id = $request['poliKontrol'];
        $cModel = new ClinicModel();
        $query = $cModel->select("kdpoli, name_of_clinic")->where('clinic_id', $clinic_id)->find($clinic_id);
        $request['poliKontrol'] = $query['kdpoli'];

        if ($request['noSEP'] != '') {
            $ws_data = [];
            if ($noskdp != '') {
                $method = 'PUT';
                $url = $this->baseurlvclaim . '/RencanaKontrol/';
                $url .= 'Update';
                $request['noSuratKontrol'] = $noskdp;
            } else {
                $method = 'POST';
                $url = $this->baseurlvclaim . '/RencanaKontrol/';
                $url .= 'insert';
            }



            $ws_data['request'] = $request;
            $postdata = json_encode($ws_data);
            $posting = $this->sendVclaim($url, $method, $postdata);
            $response = $posting;
            // $posting = ' {
            //     "metaData": {
            //         "code": "200",
            //         "message": "Ok"
            //     },
            //     "response": {
            //         "noSuratKontrol": "0301R0110520K000013",
            //         "tglRencanaKontrol": "2020-05-15",
            //         "namaDokter": "Dr. John Wick",
            //         "noKartu": "0001328186441",
            //         "nama": "ARIS",
            //         "kelamin": "Laki-laki",
            //         "tglLahir": "1947-12-31"
            //     }
            // }';
            // $response = json_decode($posting, true);
            if ($response['metaData']['code'] == '200') {
                $ik = new InasisKontrolModel();
                $data = [
                    'visit_id' => $visit,
                    'nosep' => $request['noSEP'],
                    'surattype' => 1,
                    'nosuratkontrol' => $response['response']['noSuratKontrol'],
                    'tglrenckontrol' => $response['response']['tglRencanaKontrol'],
                    'polikontrol_kdpoli' => $request['poliKontrol'],
                    'kodedokter' => $request['kodeDokter'],
                    'modified_by' => user()->username,
                    'no_registration' => $nomr
                ];
                if ($method == 'POST') {
                    $data['responpost'] = json_encode($response);
                } else {
                    $data['responput'] = json_encode($response);
                }

                // return json_encode($data);

                $ik->save($data);
            }
        } else {
            if ($noSuratKontrol == '') {
                $org = new OrganizationunitModel();
                $noSuratKontrol = $org->generateId();
            }
            // return json_encode($noSuratKontrol);


            $ik = new InasisKontrolModel();
            $ik->where("visit_id", $visit)->where("surattype", 1)->delete();
            $data = [
                'visit_id' => $visit,
                'nosep' => $request['noSEP'],
                'surattype' => 1,
                'nosuratkontrol' => $noSuratKontrol,
                'tglrenckontrol' => $request['tglRencanaKontrol'],
                'polikontrol_kdpoli' => $request['poliKontrol'],
                'kodedokter' => $request['kodeDokter'],
                'modified_by' => user()->username,
                'no_registration' => $nomr
            ];

            // return json_encode($data);

            $ik->insert($data);

            $response['metaData']['code'] = "200";
            $response['metaData']['message'] = "200";
            $response['response']['noSuratKontrol'] = $noSuratKontrol;
            // return json_encode($response);
            // $posting = '{"metaData": {"code": "200","message": "Ok"},"response": {"noSuratKontrol": "' . $noSuratKontrol . '","tglRencanaKontrol": "' . $request['tglRencanaKontrol'] . '",}}';
            // return $posting;
            // $response = json_decode($posting, true);
            // return json_encode($response);
        }

        $tf = new PasienTransferModel();
        $transfer['document_id'] = $noSuratKontrol;
        $transfer['examination_date'] = str_replace("T", " ", $transfer['examination_date']);
        $tf->save($transfer);


        return json_encode($response);
    }
    public function deleteSkdp()
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $request = $body;

        $ws_data = [];
        $method = 'DELETE';
        $url = $this->baseurlvclaim . '/RencanaKontrol/';
        $url .= 'Delete';



        $ws_data = $request;
        $postdata = json_encode($ws_data);
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        if ($response['metaData']['code'] == '200') {
            $ik = new InasisKontrolModel();
            $ik->delete($request['request']['t_suratkontrol']['noSuratKontrol']);
        }
        return json_encode($response);
    }

    public function checkSkdp()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $ik = new InasisKontrolModel();
        $select = $ik->where('visit_id', $visit)->where('surattype', 1)->findAll();
        $select = $this->lowerKey($select);

        if (isset($select[0])) {
            $response['metadata']['code'] = '200';
            $response['metadata']['message'] = 'Data SKDP ditemukan';
            $response['data'] = $select[0];
        } else {
            $response['metadata']['code'] = '201';
            $response['metadata']['message'] = 'Data SKDP tidak ditemukan';
        }
        return json_encode($response);
    }

    public function getSPRI()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'error' => 'Invalid request method.',
                'status' => 405 // Method Not Allowed
            ])->setStatusCode(405);
        }

        // Get and decode the JSON body
        $body = $this->request->getBody();
        $bodyArray = json_decode($body, true);

        // Check if the JSON body was decoded correctly
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setJSON([
                'error' => 'Invalid JSON format.',
                'status' => 400 // Bad Request
            ])->setStatusCode(400);
        }

        // Validate the presence of 'visit' and 'nosurat' in the body
        if (!isset($bodyArray['visit']) || !isset($bodyArray['nosurat'])) {
            return $this->response->setJSON([
                'error' => 'Missing required parameters.',
                'status' => 400 // Bad Request
            ])->setStatusCode(400);
        }

        $visit = $bodyArray['visit'];
        $nosurat = $bodyArray['nosurat'];

        // Validate 'visit' and 'nosurat' are not empty
        if (empty($visit) || empty($nosurat)) {
            return $this->response->setJSON([
                'error' => 'Visit ID and No. Surat cannot be empty.',
                'status' => 400 // Bad Request
            ])->setStatusCode(400);
        }

        // Initialize the model and perform the query
        $model = new InasisKontrolModel();

        // Assuming 'find' is a method that should be used with an ID,
        // verify if 'find' is appropriate or use another method if needed.
        $select = $this->lowerKey($model->join("clinic c", "c.kdpoli = inasis_kontrol.polikontrol_kdpoli")->where("visit_id", $visit)->where("surattype", 1)->find($nosurat));

        // Check if the result was found
        if ($select === null) {
            return $this->response->setJSON([
                'error' => 'No records found.',
                'status' => 404 // Not Found
            ])->setStatusCode(200);
        }

        // Return the result as JSON
        return $this->response->setJSON([
            'data' => $select,
            'status' => 200 // OK
        ])->setStatusCode(200);
    }
    public function saveSpri()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $request = $body['request'];
        $nospri = $body['noSuratKontrol'];
        $visit = $body['visit_id'];
        $nomr = $body['no_registration'];
        $noSuratKontrol = $body['noSuratKontrol'];

        $ws_data = [];

        $clinic_id = $request['poliKontrol'];
        $cModel = new ClinicModel();
        $query = $cModel->select("kdpoli, name_of_clinic")->where('clinic_id', $clinic_id)->find($clinic_id);
        $request['poliKontrol'] = $query['kdpoli'];

        if ($request['noKartu'] != '') {
            if ($nospri != '') {
                $method = 'PUT';
                $url = $this->baseurlvclaim . '/RencanaKontrol/';
                $url .= 'UpdateSPRI';
                $request['noSPRI'] = $nospri;
            } else {
                $method = 'POST';
                $url = $this->baseurlvclaim . '/RencanaKontrol/';
                $url .= 'InsertSPRI';
            }



            $ws_data['request'] = $request;
            $postdata = json_encode($ws_data);
            $posting = $this->sendVclaim($url, $method, $postdata);
            $response = $posting;
            // $posting = ' {
            //     "metaData": {
            //         "code": "200",
            //         "message": "Ok"
            //     },
            //     "response": {
            //         "noSuratKontrol": "0301R0110520K000013",
            //         "tglRencanaKontrol": "2020-05-15",
            //         "namaDokter": "Dr. John Wick",
            //         "noKartu": "0001328186441",
            //         "nama": "ARIS",
            //         "kelamin": "Laki-laki",
            //         "tglLahir": "1947-12-31"
            //     }
            // }';
            // $response = json_decode($posting, true);
            if ($response['metaData']['code'] == '200') {
                $ik = new InasisKontrolModel();
                $data = [
                    'visit_id' => $visit,
                    'nosep' => $visit,
                    'surattype' => 2,
                    'nosuratkontrol' => $response['response']['noSPRI'],
                    'tglrenckontrol' => $response['response']['tglRencanaKontrol'],
                    'polikontrol_kdpoli' => $request['poliKontrol'],
                    'kodedokter' => $request['kodeDokter'],
                    'modified_by' => user()->username,
                    'no_registration' => $nomr
                ];
                if ($method == 'POST') {
                    $data['responpost'] = json_encode($response);
                } else {
                    $data['responput'] = json_encode($response);
                }

                // return json_encode($data);

                $ik->save($data);
            }
        } else {
            if ($noSuratKontrol == '') {
                $org = new OrganizationunitModel();
                $noSuratKontrol = $org->generateId();
            }

            $ik = new InasisKontrolModel();
            $ik->where("visit_id", $visit)->where("surattype", 1)->delete();
            $data = [
                'visit_id' => $visit,
                'surattype' => 2,
                'nosuratkontrol' => $noSuratKontrol,
                'tglrenckontrol' => $request['tglRencanaKontrol'],
                'polikontrol_kdpoli' => $request['poliKontrol'],
                'kodedokter' => $request['kodeDokter'],
                'modified_by' => user()->username,
                'no_registration' => $nomr
            ];

            // return json_encode($data);

            $ik->insert($data);

            $response['metaData']['code'] = "200";
            $response['metaData']['message'] = "Success";
            $response['response']['noSPRI'] = $noSuratKontrol;
        }



        return json_encode($response);
    }
    public function checkSpri()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $ik = new InasisKontrolModel();
        $select = $ik->where('visit_id', $visit)->where('surattype', 2)->findAll();
        $select = $this->lowerKey($select);

        if (isset($select[0])) {
            $response['metadata']['code'] = '200';
            $response['metadata']['message'] = 'Data SPRI ditemukan';
            $response['data'] = $select[0];
        } else {
            $response['metadata']['code'] = '201';
            $response['metadata']['message'] = 'Data SPRI tidak ditemukan';
        }
        return json_encode($response);
    }
    public function deleteSpri()
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $request = $body;

        $ws_data = [];
        $method = 'DELETE';
        $url = $this->baseurlvclaim . '/RencanaKontrol/';
        $url .= 'Delete';



        $ws_data = $request;
        $postdata = json_encode($ws_data);
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        if ($response['metaData']['code'] == '200') {
            $ik = new InasisKontrolModel();
            $ik->delete($request['request']['t_suratkontrol']['noSuratKontrol']);
        }
        return json_encode($response);
    }
}
