<?php

namespace App\Controllers\Admin\rm;

use App\Controllers\BaseController;
use App\Models\Assessment\ADLModel;
use App\Models\Assessment\ApgarDetailModel;
use App\Models\Assessment\BladderModel;
use App\Models\Assessment\CirculationModel;
use App\Models\Assessment\DekubitusModel;
use App\Models\Assessment\DigestionModel;
use App\Models\Assessment\indicatorDetail;
use App\Models\Assessment\indicatorDetailModel;
use App\Models\Assessment\IndicatorModel;
use App\Models\Assessment\IntegumenModel;
use App\Models\Assessment\LokalisModel;
use App\Models\Assessment\NeurosensorisModel;
use App\Models\Assessment\PainDetilModel;
use App\Models\Assessment\PainIntervensiModel;
use App\Models\Assessment\PainMonitoringModel;
use App\Models\Assessment\RespirationModel;
use App\Models\Assessment\SpiritualDetailModel;
use App\Models\Assessment\SpiritualModel;
use App\Models\Assessment\TreatmentPerawatModel;
use App\Models\Assessment\TriaseDetilModel;
use App\Models\EmployeeAllModel;
use App\Models\ExaminationModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienHistoryModel;
use App\Models\PasienModel;
use App\Models\PasienProceduresModel;
use App\Models\PasienVisitationModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;

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
    public function savePainMonitoring()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // $parameter002 = $this->request->getPost('parameter002');
        $parameter_id01 = $this->request->getPost('parameter_id01');
        $parameter_id02 = $this->request->getPost('parameter_id02');
        $parameter_id03 = $this->request->getPost('parameter_id03');
        $parameter_id04 = $this->request->getPost('parameter_id04');
        $parameter_id05 = $this->request->getPost('parameter_id05');
        $parameter_id06 = $this->request->getPost('parameter_id06');
        $parameter_id07 = $this->request->getPost('parameter_id07');
        $parameter_id08 = $this->request->getPost('parameter_id08');
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
        $examination_date = $this->request->getPost('examination_date');
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
            'document_id' => $document_id
        ];
        // return json_encode($data);
        $db->query("delete from assessment_pain_monitoring where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

        $isSuccess = $painMonitoring->save($data);
        // return json_encode($isSuccess);

        if (true) {
            $painDetil = new PainDetilModel();

            $db->query("delete from assessment_pain_detail where body_id = '$body_id' and visit_id = '$visit_id' and p_type = '$p_type'");

            $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER where P_TYPE = 'ASES021'")->getResultArray());
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
                        'modified_by' => $modified_by
                    ];
                    $painDetil->insert($data);
                }
            }

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

        return json_encode('berhasil');
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

        $painMonitoring = $this->lowerKey($db->query("select * from ASSESSMENT_PAIN_MONITORING where visit_id = '$visit' and document_id = '$bodyId'  ")->getResultArray());

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
            'total_score' => 0,
            'description' => $description,
            // 'modified_date' => Time::now(),
            'modified_by' => $modified_by,
            'isvalid' => null,
            'valid_date' => null,
            'document_id' => $document_id
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


        $select = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER_VALUE where P_TYPE = '$p_type'")->getResultArray());


        foreach ($select as $key => $value) {
            if (isset(${'val' . $value['value_id']})) {
                $data = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $trans_id,
                    'body_id' => $body_id,
                    'p_type' => $p_type,
                    'parameter_id' => $value['parameter_id'],
                    'value_score' => $value['value_score'],
                    'value_desc' => $value['value_desc'],
                    // 'modified_date' => Time::now(),
                    'modified_by' => user()->username,
                    'value_id' => $value['value_id']
                ];

                $istrue = $triaseDetil->insert($data);
                // return json_encode(($istrue));
            }
        }
        return json_encode(($istrue));
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

    public function saveApgar()
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
            // 'modified_date' => Time::now(),
            'modified_by' => $modified_by,
            'isvalid' => null,
            'valid_date' => null,
            'document_id' => $document_id
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




        // dd(json_encode($diag_id[0]));
        $pv = new PasienVisitationModel();
        $kunjungan = $this->lowerKeyOne($pv->find($visit_id));
        $p = new PasienModel();
        $pasien = $this->lowerKeyOne($p->find($no_registration));
        $ea = new EmployeeAllModel();
        $employee = $this->lowerKeyOne($ea->find($employee_id));


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
        // dd($id);


        // return json_encode($description);

        foreach ($body as $key => $value) {
            $data[$key] = ${$key};
        }

        $data = [
            'org_unit_code' => $org_unit_code,
            'pasien_diagnosa_id' => $pasien_diagnosa_id,
            'no_registration' => $no_registration,
            'visit_id' => $visit_id,
            'clinic_id' => $clinic_id,
            // 'bill_id' => $bill_id,
            'class_room_id' => $class_room_id,
            'in_date' => $in_date,
            'exit_date' => $exit_date,
            'bed_id' => $bed_id,
            'keluar_id' => $keluar_id,
            'date_of_diagnosa' => str_replace('T', ' ', $date_of_diagnosa),
            'report_date' => $report_date,
            // 'diagnosa_id' => $diagnosa_id,
            // 'diagnosa_desc' => $diagnosa_desc,
            'employee_id' => $employee_id,
            'diag_cat' => 4,
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
            'rencanatl' => $rencanatl,
            // 'dirujukke' => $dirujukke,
            // 'tglkontrol' => $tglkontrol,
            // 'kdpoli_kontrol' => $kdpoli_kontrol,
            // 'suffer_type' => $suffer_type,
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
            'sscondition_id' => new RawSql("newid()")
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
        // return json_encode($select);
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
                $db->query("delete from pasien_history where no_registration = '$no_registration' and value_id = '" . $value['value_id'] . "'");
                $pasienHistory->insert($data);
            }
        }


        if (!empty($diag_id)) {
            $pds = new PasienDiagnosaModel();
            $pds->where('pasien_diagnosa_id', $id)->delete();

            foreach ($diag_id as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $id;
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
            $pcs->where('pasien_diagnosa_id', $id)->delete();

            foreach ($proc_id as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = $id;
                $dataProc['diagnosa_id'] = $proc_id[$key];
                $dataProc['diagnosa_name'] = $proc_name[$key];
                $dataProc['modified_by'] = user_id();
                $pcs->insert($dataProc);
            }
        }


        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => $mesej . ' riwayat rekam medis berhasil', 'data' => $data);
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

        $db = db_connect();
        $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname from pasien_diagnosa pd left join employee_all ea on pd.employee_id = ea.employee_id left join clinic c on pd.clinic_id = c.clinic_id where no_registration = '$no_registration' and visit_id = '$visit_id'")->getResultArray());

        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = '$no_registration'")->getResultArray());

        $primaryPD = "";
        foreach ($selectpd as $key => $value) {
            $primaryPD .= "'" . $value['pasien_diagnosa_id'] . "',";
        }
        $primaryPD = substr($primaryPD, 0, -1);
        // return ($primaryPD);
        $selectdiagnosas = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());
        $selectprocedures = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());

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
            'papsienDiagnosas' => $selectdiagnosas,
            'pasienProcedures' => $selectprocedures,
            'lokalis' => $selectlokalis
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
            $db = db_connect();

            $db->query("insert into treatment_bill (ORG_UNIT_CODE, BILL_ID, NO_REGISTRATION, VISIT_ID, TARIF_ID, CLASS_ID, CLINIC_ID, CLINIC_ID_FROM, TREATMENT, TREAT_DATE, AMOUNT, QUANTITY, MEASURE_ID, POKOK_JUAL, PPN, MARGIN, SUBSIDI, 
                         EMBALACE, PROFESI, DISCOUNT, PAY_METHOD_ID, PAYMENT_DATE, ISLUNAS, DUEDATE_ANGSURAN, DESCRIPTION, KUITANSI_ID, NOTA_NO, ISCETAK, PRINT_DATE, RESEP_NO, RESEP_KE, DOSE, ORIG_DOSE, 
                         DOSE_PRESC, ITER, ITER_KE, SOLD_STATUS, RACIKAN, CLASS_ROOM_ID, KELUAR_ID, BED_ID, PERDA_ID, EMPLOYEE_ID, DESCRIPTION2, MODIFIED_BY, MODIFIED_DATE, MODIFIED_FROM, BRAND_ID, DOCTOR, 
                         JML_BKS, EXIT_DATE, FA_V, TASK_ID, EMPLOYEE_ID_FROM, DOCTOR_FROM, status_pasien_id, amount_paid, THENAME, THEADDRESS, THEID, serial_nb, TREATMENT_PLAFOND, AMOUNT_PLAFOND, 
                         AMOUNT_PAID_PLAFOND, CLASS_ID_PLAFOND, PAYOR_ID, PEMBULATAN, ISRJ, AGEYEAR, AGEMONTH, AGEDAY, GENDER, KAL_ID, CORRECTION_ID, CORRECTION_BY, KARYAWAN, ACCOUNT_ID, sell_price, diskon, 
                         INVOICE_ID, NUMER, MEASURE_ID2, POTONGAN, BAYAR, RETUR, TARIF_TYPE, PPNVALUE, TAGIHAN, KOREKSI, STATUS_OBAT, SUBSIDISAT, PRINTQ, PRINTED_BY, STOCK_AVAILABLE, STATUS_TARIF, CLINIC_TYPE, 
                         PACKAGE_ID, MODULE_ID, profession, THEORDER, CASHIER, TRANS_ID, NOSEP, PASIEN_ID, TOTAL_TAGIHAN, tarif_id_plafond)

select ORG_UNIT_CODE, BILL_ID, NO_REGISTRATION, VISIT_ID, TARIF_ID, CLASS_ID, CLINIC_ID, CLINIC_ID_FROM, TREATMENT, TREAT_DATE, AMOUNT, QUANTITY, MEASURE_ID, POKOK_JUAL, PPN, MARGIN, SUBSIDI, 
                         EMBALACE, PROFESI, DISCOUNT, PAY_METHOD_ID, PAYMENT_DATE, ISLUNAS, DUEDATE_ANGSURAN, DESCRIPTION, KUITANSI_ID, NOTA_NO, ISCETAK, PRINT_DATE, RESEP_NO, RESEP_KE, DOSE, ORIG_DOSE, 
                         DOSE_PRESC, ITER, ITER_KE, SOLD_STATUS, RACIKAN, CLASS_ROOM_ID, KELUAR_ID, BED_ID, PERDA_ID, EMPLOYEE_ID, DESCRIPTION2, MODIFIED_BY, MODIFIED_DATE, MODIFIED_FROM, BRAND_ID, DOCTOR, 
                         JML_BKS, EXIT_DATE, FA_V, TASK_ID, EMPLOYEE_ID_FROM, DOCTOR_FROM, status_pasien_id, amount_paid, THENAME, THEADDRESS, THEID, serial_nb, TREATMENT_PLAFOND, AMOUNT_PLAFOND, 
                         AMOUNT_PAID_PLAFOND, CLASS_ID_PLAFOND, PAYOR_ID, PEMBULATAN, ISRJ, AGEYEAR, AGEMONTH, AGEDAY, GENDER, KAL_ID, CORRECTION_ID, CORRECTION_BY, KARYAWAN, ACCOUNT_ID, sell_price, diskon, 
                         INVOICE_ID, NUMER, MEASURE_ID2, POTONGAN, BAYAR, RETUR, TARIF_TYPE, PPNVALUE, TAGIHAN, KOREKSI, STATUS_OBAT, SUBSIDISAT, PRINTQ, PRINTED_BY, STOCK_AVAILABLE, STATUS_TARIF, CLINIC_TYPE, 
                         PACKAGE_ID, MODULE_ID, profession, THEORDER, CASHIER, TRANS_ID, NOSEP, PASIEN_ID, TOTAL_TAGIHAN, tarif_id_plafond
                        from treatment_perawat where 
                        bill_id = '$id'
                        and STATUS_TARIF is null

                        -- jangan lupa setelah dikirim ke treatment_bill , status_tarifnya  diubah jadi 1 artinya sudah dikirim.");

            $tpModel->update(['status_tarif' => 1, 'bill_id' => $id]);
        }
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
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

        $db = db_connect();
        $selectex = $this->lowerKey($db->query("select ex.*, c.name_of_clinic, ea.fullname from examination_info ex left join employee_all ea on ex.employee_id = ea.employee_id left join clinic c on ex.clinic_id = c.clinic_id where no_registration = '$no_registration' and visit_id = '$visit_id'")->getResultArray());

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

        return json_encode([
            'examInfo' => $selectex,
            'pasienHistory' => $selecthistory,
            // 'papsienDiagnosas' => $selectdiagnosas,
            // 'pasienProcedures' => $selectprocedures,
            // 'lokalis' => $selectlokalis
        ]);
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

        // return ($body['OBJECT_STRANGE']);
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
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'ASES035' and parameter_id in ('01','02','03')")->getResultArray());
        $spiritual = new SpiritualDetailModel();
        $db->query("delete from assessment_spiritual_detail where body_id = '$body_id' and visit_id = '$visit_id'");
        foreach ($select as $key => $value) {
            if (isset(${$value['value_id']})) {

                $data = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $trans_id,
                    'body_id' => $body_id,
                    'p_type' => $p_type,
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

    public function saveExaminationInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $data = [];
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[$key] = $value;
            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
            if (isset($temperature))
                $data['temperature'] = (float)$data['temperature'];
            if (isset($tension_upper))
                $data['tension_upper'] = (float)$data['tension_upper'];
            if (isset($tension_below))
                $data['tension_below'] = (float)$data['tension_below'];
            if (isset($nadi))
                $data['nadi'] = (float)$data['nadi'];
            if (isset($nafas))
                $data['nafas'] = (float)$data['nafas'];
            if (isset($weight))
                $data['weight'] = (float)$data['weight'];
            if (isset($height))
                $data['height'] = (float)$data['height'];
            if (isset($arm_diameter))
                $data['arm_diameter'] = (float)$data['arm_diameter'];
            if (isset($saturasi))
                $data['saturasi'] = (int)$data['saturasi'];
        }

        $ex = new ExaminationModel();

        $orgModel = new OrganizationunitModel();

        $db = db_connect();

        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
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
                $db->query("delete from pasien_history where no_registration = '$no_registration' and value_id = '" . $value['value_id'] . "'");
                $pasienHistory->insert($data);
            }
        }


        $ex->save($data);

        return json_encode($data);
    }
}
