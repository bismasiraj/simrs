<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\Assessment\DiagnosaPerawatModel;
use App\Models\Assessment\LokalisModel as AssessmentLokalisModel;
use App\Models\Assessment\PasienDiagnosaPerawatModel;
use App\Models\Assessment\PasienDiagnosasPerawatModel;
use App\Models\PatientOperationRequestModel;
use App\Models\OperationTeamModel;
use App\Models\AssessmentOperationModel;
use App\Models\PatientOperationCheck;
use App\Models\AssessmentAnesthesiaChecklist;
use App\Models\AssessmentAnesthesiaPostModel;
use App\Models\AssessmentInstrumentModel;
use APP\Models\AssessmentPraOperasi;
use App\Models\BloodRequestModel;

use APP\Models\LokalisModel;
use APP\Models\AssessmentOperationPostModel;
use APP\Models\AssessmentAnesthesiaModel;
use App\Models\AssessmentAnesthesiaRecoveryModel;
use APP\Models\AssessmentOperationDrainModel;
use App\Models\DiagnosaModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\RawSql;
use DateTime;
use Exception;

class PatientOperationRequest extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PatientOperationRequestModel();
    }

    public function getOperationData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $noRegistration = $formData['no_registration'];
        $visitId = $formData['visit_id'];


        $model = new PatientOperationRequestModel();

        $data = $model->where('VISIT_ID', $visitId)
            ->orderBy('VACTINATION_DATE', 'DESC');

        $result = $this->lowerKey($data->findAll());

        return $this->response->setJSON($result);
    } //new update 3/8





    public function getAllArcodions()
    {
        $db = db_connect();
        $formData = $this->request->getJSON();
        $treatmentData = [];

        $getDataInstrumenModel = new AssessmentInstrumentModel();
        $getDataPatientOperationCheckModel = new PatientOperationCheck();
        $getDataAssessmentOperationPraModel = new AssessmentPraOperasi();
        $getDataAssessmentOperationModel = new AssessmentOperationModel();
        $getDataLaporanAssessmentAnestesiModel = new AssessmentAnesthesiaModel();
        $getDataAssessmentAnestesiModel = new AssessmentAnesthesiaChecklist();
        $getDataTimModel = new OperationTeamModel();
        $getDropdowntempAllModel = $db->query("SELECT * FROM OPERATION_TASK");
        $getDataDrainModel = new AssessmentOperationDrainModel();
        $getDataAssessmentAnesthesiaPostModel = new AssessmentAnesthesiaPostModel();
        $getDataAssessmentAnesthesiaRecoveryModel = new AssessmentAnesthesiaRecoveryModel();

        $dataInstrumen = $getDataInstrumenModel->where('document_id', $formData->id)->findAll() ?? [];
        $dataPatientOperationCheck = $getDataPatientOperationCheckModel->where('document_id', $formData->id)->first() ?? [];
        $dataAssessmentOperation = $getDataAssessmentOperationModel->where('document_id', $formData->id)->first() ?? [];
        $dataLaporanAssessmentAnestesi = $getDataLaporanAssessmentAnestesiModel->where('document_id', $formData->id)->first() ?? [];
        $dataAssessmentAnestesi = $getDataAssessmentAnestesiModel->where('document_id', $formData->id)->first() ?? [];
        $dataTim = $getDataTimModel->where('OPERATION_ID', $formData->id)->findAll() ?? [];
        $dataDropdowntempAll = $getDropdowntempAllModel->getResultArray() ?? [];
        $dataDrai = $getDataDrainModel->where('document_id', $formData->id)->findAll() ?? [];
        $dataAssessmentAnesthesiaPost = $getDataAssessmentAnesthesiaPostModel->where('document_id', $formData->id)->first() ?? [];
        $dataAssessmentAnesthesiaRecovery = $getDataAssessmentAnesthesiaRecoveryModel->where('document_id', $formData->id)->first() ?? [];
        $dataBromage = $getDataAssessmentAnesthesiaRecoveryModel->where('document_id', $formData->id)->where('p_type', 'OPRS024')->findAll() ?? [];

        $dataInfusion = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS029') ?? []);
        $dataRegional = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS033') ?? []);
        $dataGeneral = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS030') ?? []);
        $dataVentilasi = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS031') ?? []);
        $dataJalanNapas = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS032') ?? []);
        $dataAldrete = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS023') ?? []);
        $dataSteward = $this->lowerKey($this->getAnestesiaRecovery($formData->id, 'OPRS025') ?? []);

        $dataInstrumen = $this->lowerKey($dataInstrumen);
        $dataPatientOperationCheck = $this->lowerKey($dataPatientOperationCheck);
        $dataAssessmentOperation = $this->lowerKey($dataAssessmentOperation);
        $dataLaporanAssessmentAnestesi = $this->lowerKey($dataLaporanAssessmentAnestesi);
        $dataAssessmentAnestesi = $this->lowerKey($dataAssessmentAnestesi);
        $dataTim = $this->lowerKey($dataTim);
        $dataDropdowntempAll = $this->lowerKey($dataDropdowntempAll);
        $dataDrai = $this->lowerKey($dataDrai);
        $dataAssessmentAnesthesiaPost = $this->lowerKey($dataAssessmentAnesthesiaPost);
        $dataAssessmentAnesthesiaRecovery = $this->lowerKey($dataAssessmentAnesthesiaRecovery);
        $dataBromage = $this->lowerKey($dataBromage);
        $dataPraOperasi = $this->lowerKey($getDataAssessmentOperationPraModel->where('body_id', $formData->id)->first() ?? []);
        $dataDiagnosas = $this->lowerKey($db->query("select * from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $formData->id . "'")->getResultArray() ?? []);
        $vitalSignTerakhir = $this->lowerKey($db->query("select top 1 * from examination_info where visit_id = '" . $formData->visit_id . "' order by examination_date desc ")->getRowArray() ?? []);
        if (!empty($formData->visit_id)) {
            $sqlTreatment = "
                SELECT TREATMENT_OBAT.BRAND_ID, TREATMENT_OBAT.treat_date, goods.name, TREATMENT_OBAT.QUANTITY, goods.isalkes 
                FROM TREATMENT_OBAT 
                INNER JOIN goods ON TREATMENT_OBAT.BRAND_ID = goods.BRAND_ID 
                WHERE TREATMENT_OBAT.CLINIC_ID = 'P002' 
                AND TREATMENT_OBAT.visit_id = '$formData->visit_id'
            ";
            $queryTreatment = $db->query($sqlTreatment, [$formData->visit_id]);
            $treatmentData = $this->lowerKey($queryTreatment->getResultArray());

            $dataBloodRequest = $this->lowerKey($db->query("
            select 
                br.*, but.usagetype AS usageType 
            from blood_request as br
            LEFT JOIN 
                BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
            where 
                br.VISIT_ID = '" . $formData->visit_id . "' 
                AND br.DOCUMENT_ID = '" . $formData->id . "'
                and br.CLINIC_ID = 'P002' 
                and (TRANSFUSION_START is null OR TRANSFUSION_END is null)
            ")->getResultArray() ?? []);

            $bloodRequestHistory = $this->lowerKey($db->query("
            select 
                br.*, but.usagetype AS usageType 
            from blood_request as br
            LEFT JOIN 
                BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
            where br.VISIT_ID = '" . $formData->visit_id . "' 
            AND br.DOCUMENT_ID = '" . $formData->id . "'
            and br.CLINIC_ID = 'P002' 
            and (TRANSFUSION_START is not null OR TRANSFUSION_END is not null OR REACTION_DESC is not null)
            ")->getResultArray() ?? []);
        }


        $responseData = [
            'assessment_instrument' => $dataInstrumen,
            'assessment_operation_check' => $dataPatientOperationCheck,
            'assessment_operation_pra' => $dataPraOperasi,
            'assessment_operation' => $dataAssessmentOperation,
            'assessment_anesthesia' => $dataLaporanAssessmentAnestesi,
            'assessment_anesthesia_checklist' => $dataAssessmentAnestesi,
            'operation_team' => $dataTim,
            'operation_task' => $dataDropdowntempAll,
            'assessment_operation_drain' => $dataDrai,
            'TreatmentObat' => [
                'treatment' => $treatmentData,
                'blood_request' => $dataBloodRequest
            ],
            'assessment_anesthesia_post' => $dataAssessmentAnesthesiaPost,
            'assessment_anesthesia_recovery' => [
                'bromage' => $dataBromage,
                'aldrete' => $dataAldrete,
                'steward' => $dataSteward,
                'infusion' => $dataInfusion[0] ?? [],
                'regional' => $dataRegional[0] ?? [],
                'general' => $dataGeneral[0] ?? [],
                'ventilasi' => $dataVentilasi[0] ?? [],
                'jalan_napas' => $dataJalanNapas[0] ?? [],
            ],
            'diagnosas' => $dataDiagnosas,
            'exam_info' => $vitalSignTerakhir,
            'blood_history' => $bloodRequestHistory,

        ];

        $formattedResponseData = $this->lowerKey($responseData);

        return $this->response->setStatusCode(200)
            ->setJSON([
                'message' => 'Data retrieved successfully.',
                'respon' => true,
                'document_id' => $formData->id,
                'data' => $formattedResponseData
            ]);
    }

    private function getAnestesiaRecovery($document_id, $p_type)
    {
        $db = db_connect();
        $parameter_id = array_column($this->lowerKey($db->query("
        SELECT PARAMETER_ID FROM ASSESSMENT_PARAMETER WHERE P_TYPE = '$p_type'
        ")->getResultArray()), 'parameter_id');

        $sqlRecovery = '
            SELECT
                BODY_ID,
                OBSERVATION_DATE,
            ';


        $params = $parameter_id;
        $case_statements = [];

        foreach ($params as $param) {
            $case_statements[] = "MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '$param' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_$param";
            $case_statements[] = "MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '$param' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_$param";
            $case_statements[] = "MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '$param' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_$param";
        }

        $sqlRecovery .= implode(', ', $case_statements);


        $sqlRecovery .= '
            FROM ASSESSMENT_ANESTHESIA_RECOVERY
            INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
            LEFT JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
            WHERE DOCUMENT_ID = ? 
            AND ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ?
            GROUP BY BODY_ID, OBSERVATION_DATE;
        ';


        $query = $db->query($sqlRecovery, [$document_id, $p_type]);


        return $query->getResultArray();
    }
    public function insertData()
    {
        $model = new PatientOperationRequestModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $insertData = [];

        $requiredKeys = [
            'trans_id',
            'class_room_id',
            'org_unit_code',
            'visit_id',
            'vactination_id',
            'no_registration',
            'vactination_date',
            'description',
            'employee_id',
            'doctor',
            'anestesi_type',
            'modified_date',
            'modified_by',
            'validation',
            'terlayani',
            'thename',
            'theaddress',
            'theid',
            'isrj',
            'status_pasien_id',
            'gender',
            'ageyear',
            'agemonth',
            'ageday',
            'bed_id',
            'keluar_id',
            'diagnosa_pra',
            'diagnosa_pasca',
            'end_operation',
            'start_anestesi',
            'end_anestesi',
            'result_id',
            'clinic_id',
            'clinic_id_from',
            'transaksi',
            'start_operation',
            'patient_category_id',
            'tarif_id',
            'diagnosa_desc',
            'operation_type',
            'bill_id'

        ];


        foreach ($requiredKeys as $key) {
            if (isset($formData[$key])) {

                if ($key === 'vactination_date' || $key === 'modified_date' || $key === 'start_operation') {
                    $dateValue = str_replace("T", " ", $formData[$key]);
                    $insertData[$key] = date('Y-m-d H:i:s', strtotime($dateValue));
                } else if ($key === 'patient_category_id') {
                    $insertData[$key] = is_numeric($formData[$key]) ? (int)$formData[$key] : 0;
                } else {
                    $insertData[$key] = $formData[$key];
                }
            } else {
                $insertData[$key] = null;
            }
        }

        $insertData['modified_by'] = user()->username;

        $model->insert($insertData);

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $insertData
        ]);
    } // new update 27/07

    public function updateData()
    {
        $model = new PatientOperationRequestModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!isset($formData['vactination_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing vactination_id in request data']);
        }

        // $end_operation = null;

        // if (isset($formData['end_operation']) && !empty($formData['end_operation'])) {
        //     $end_operation = date('Y-m-d\TH:i:s', strtotime($formData['end_operation']));
        // }
        $dateFields = [
            'start_operation',
        ];
        foreach ($dateFields as $field) {
            if (isset($formData[$field]) && !empty($formData[$field])) {
                $formData[$field] = $this->convertToDateFormat($formData[$field]);
            }
        }

        $updateData = [
            'trans_id' => $formData['trans_id'],
            'class_room_id' => $formData['class_room_id'],
            'org_unit_code' => $formData['org_unit_code'],
            'visit_id' => $formData['visit_id'],
            'vactination_id' => $formData['vactination_id'],
            'no_registration' => $formData['no_registration'],
            'vactination_date' => date('Y-m-d H:i:s', strtotime($formData['vactination_date'])),
            'description' => $formData['description'],
            'employee_id' => $formData['employee_id'],
            'doctor' => $formData['doctor'],
            'anestesi_type' => $formData['anestesi_type'],
            'modified_date' => date('Y-m-d H:i:s', strtotime($formData['modified_date'])),
            'modified_by' => $formData['modified_by'],
            'validation' => $formData['validation'],
            'terlayani' => $formData['terlayani'],
            'thename' => $formData['thename'],
            'theaddress' => $formData['theaddress'],
            'theid' => $formData['theid'],
            'isrj' => $formData['isrj'],
            'status_pasien_id' => $formData['status_pasien_id'],
            'gender' => $formData['gender'],
            'ageyear' => $formData['ageyear'],
            'agemonth' => $formData['agemonth'],
            'ageday' => $formData['ageday'],
            'bed_id' => $formData['bed_id'],
            'keluar_id' => $formData['keluar_id'],
            'diagnosa_pra' => $formData['diagnosa_pra'],
            'diagnosa_pasca' => $formData['diagnosa_pasca'],
            // 'end_operation' =>  $end_operation,
            'start_anestesi' => $formData['start_anestesi'],
            'end_anestesi' => $formData['end_anestesi'],
            'result_id' => $formData['result_id'],
            'clinic_id' => $formData['clinic_id'],
            'clinic_id_from' => $formData['clinic_id_from'],
            'transaksi' => $formData['transaksi'],
            'layan' => $formData['layan'],
            'start_operation' => date('Y-m-d H:i:s', strtotime($formData['start_operation'])),
            'patient_category_id' => $formData['patient_category_id'],
            'tarif_id' => $formData['tarif_id'],
            'diagnosa_desc' => $formData['diagnosa_desc'],
            'operation_type' => $formData['operation_type'],
            'bill_id' => $formData['bill_id'],
        ];

        $model->where('vactination_id', $formData['vactination_id'])->set($updateData)->update();

        return $this->response->setJSON(['message' => 'Data updated successfully.', 'respon' => true, 'data' => $updateData]);
    }

    public function deleteData()
    {
        // Get the request data
        $request = service('request');
        $formData = $request->getJSON(true);

        // Validate required parameters
        if (empty($formData['vactination_id']) || empty($formData['visit_id']) || empty($formData['no_registration'])) {
            return $this->response->setJSON([
                'message' => 'Missing parameter send',
                'respon' => false
            ]);
        }

        // Initialize models
        $models = [
            'assessment_anesthesia' => new AssessmentAnesthesiaModel(),
            'assessment_anesthesia_recovery' => new AssessmentAnesthesiaRecoveryModel(),
            'diagnosa_nurse' => new PasienDiagnosaPerawatModel(),
            'diagnosas' => new PasienDiagnosasModel(),
            'diagnosa' => new PasienDiagnosaModel(),
            'drain' => new AssessmentOperationDrainModel(),
            'instrument' => new AssessmentInstrumentModel(),
            'anesthesia_check' => new AssessmentAnesthesiaChecklist(),
            'operation_check' => new PatientOperationCheck(),
            'operation_post' => new AssessmentOperationPostModel(),
            'operation' => new AssessmentOperationModel(),
            'patient_operation_request' => new PatientOperationRequestModel(),
            'operation_team' => new OperationTeamModel(),
            'examination' => new ExaminationModel(),
            'diagnosas_nurse' => new PasienDiagnosasPerawatModel()
        ];

        // Retrieve necessary data
        $data_assessment_anesthesia = $models['assessment_anesthesia']->where('document_id', $formData['vactination_id'])->first();
        $data_diagnosa_nurse = $models['diagnosa_nurse']->where('document_id', $formData['vactination_id'])->first();

        // Start transaction
        $db = db_connect();
        $db->transStart();

        try {
            // Delete records in a secure and ordered manner
            $deletions = [
                $models['examination']->where('pasien_diagnosa_id', $formData['vactination_id'])->delete(),
                // $models['examination']->where('pasien_diagnosa_id', $data_assessment_anesthesia['BODY_ID'])->delete(),
                // $models['diagnosas_nurse']->where('body_id', $data_diagnosa_nurse['BODY_ID'])->delete(),
                // $models['diagnosas']->where('pasien_diagnosa_id', $data_assessment_anesthesia['BODY_ID'])->delete(),
                $models['diagnosa_nurse']->where('document_id', $formData['vactination_id'])->delete(),
                $models['diagnosa']->where('visit_id', $formData['visit_id'])->delete(),
                $models['drain']->where('document_id', $formData['vactination_id'])->delete(),
                $models['instrument']->where('document_id', $formData['vactination_id'])->delete(),
                $models['operation_check']->where('document_id', $formData['vactination_id'])->delete(),
                $models['anesthesia_check']->where('document_id', $formData['vactination_id'])->delete(),
                $models['operation_post']->where('document_id', $formData['vactination_id'])->delete(),
                $models['assessment_anesthesia_recovery']->where('document_id', $formData['vactination_id'])->delete(),
                $models['assessment_anesthesia']->where('document_id', $formData['vactination_id'])->delete(),
                $models['operation_team']->where('operation_id', $formData['vactination_id'])->delete(),
                $models['operation']->where('document_id', $formData['vactination_id'])->delete(),
                $models['patient_operation_request']->where('vactination_id', $formData['vactination_id'])
                    ->where('no_registration', $formData['no_registration'])
                    ->where('visit_id', $formData['visit_id'])
                    ->delete()
            ];
            // echo '<pre>';
            // var_dump($deletions);
            // die();
            // Check if all deletions were successful
            $allDeleted = !in_array(false, $deletions, true);;
            if ($allDeleted) {
                // Commit transaction if all deletions were successful

                $db->transCommit();
                return $this->response->setJSON([
                    'message' => 'Data deleted successfully.',
                    'respon' => true
                ]);
            } else {
                // Rollback transaction if any deletion failed
                $db->transRollback();
                return $this->response->setJSON([
                    'message' => 'Data not found or failed to delete.',
                    'respon' => false
                ]);
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of an exception
            $db->transRollback();
            return $this->response->setJSON([
                'message' => 'Error: ' . $e->getMessage(),
                'respon' => false
            ]);
        }
    }


    public function getDropdownAddAll()
    {
        // $formData = $this->request->getJSON();
        $db = db_connect();
        $query = $db->query("SELECT e.EMPLOYEE_ID, e.fullname, ds.shift_id FROM EMPLOYEE_all e JOIN doctor_schedule ds ON e.EMPLOYEE_ID = ds.employee_id WHERE ds.clinic_id = 'P002';");
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON(['data' => $results, 'response' => true]);
    }

    public function getDropdowntempAll()
    {
        // $formData = $this->request->getJSON();
        $db = db_connect();
        $query = $db->query("SELECT * FROM OPERATION_TASK");
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON(['data' => $results, 'response' => true]);
    }

    // ------------
    public function updateDataAndInsert()
    {
        $modelRequest = new PatientOperationRequestModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $vactinationId = $formData['vactination_id'];
        if (!isset($formData['vactination_id'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing vactination_id in request data']);
        }
        $dateFields = [
            'end_operation',
            'start_operation',
        ];
        foreach ($dateFields as $field) {
            if (isset($formData[$field]) && !empty($formData[$field])) {
                $formData[$field] = $this->convertToDateFormat($formData[$field]);
            }
        }

        $updateData = [
            'class_room_id' => $formData['class_room_id'],
            'org_unit_code' => $formData['org_unit_code'],
            'visit_id' => $formData['visit_id'],
            'vactination_id' => $vactinationId,
            'no_registration' => $formData['no_registration'],
            'vactination_date' => date('Y-m-d H:i:s', strtotime($formData['vactination_date'])),
            'description' => $formData['description'],
            'employee_id' => $formData['employee_id'],
            'doctor' => $formData['doctor'],
            'anestesi_type' => $formData['anestesi_type'],
            'modified_date' => date('Y-m-d H:i:s', strtotime($formData['modified_date'])),
            'modified_by' => $formData['modified_by'],
            'validation' => $formData['validation'],
            'terlayani' => $formData['form-action-pelayanan'],
            'thename' => $formData['thename'],
            'theaddress' => $formData['theaddress'],
            'theid' => $formData['theid'],
            'isrj' => $formData['isrj'],
            'status_pasien_id' => $formData['status_pasien_id'],
            'gender' => $formData['gender'],
            'ageyear' => $formData['ageyear'],
            'agemonth' => $formData['agemonth'],
            'ageday' => $formData['ageday'],
            'bed_id' => $formData['bed_id'],
            'keluar_id' => $formData['keluar_id'],
            'diagnosa_pra' => $formData['diagnosa_pra'],
            'diagnosa_pasca' => $formData['diagnosa_pasca'],
            'end_operation' =>  date('Y-m-d H:i:s', strtotime($formData['end_operation'])),
            'start_anestesi' => $formData['start_anestesi'],
            'end_anestesi' => $formData['end_anestesi'],
            'result_id' => $formData['result_id'],
            'clinic_id' => $formData['clinic_id'],
            'clinic_id_from' => $formData['clinic_id_from'],
            'transaksi' => $formData['transaksi'],
            'layan' => $formData['layan'],
            'start_operation' => date('Y-m-d H:i:s', strtotime($formData['start_operation'])),
            'patient_category_id' => $formData['patient_category_id'],
            'tarif_id' => $formData['tarif_id'],
            'diagnosa_desc' => $formData['diagnosa_desc'],
            'operation_type' => $formData['operation_type'],
            'rooms_id' => $formData['rooms_id'],
            'bill_id' => $formData['bill_id'],
        ];

        // Start a database transaction
        $db = db_connect();
        $db->transStart();

        try {
            if ($db->table('PASIEN_OPERASI')->where('vactination_id', $updateData['vactination_id'])->countAllResults() > 0) {
                $updateResult = $modelRequest->update($updateData['vactination_id'], $updateData);
            } else {
                $updateResult = $modelRequest->insert($updateData);
            }

            // Check if update was successful
            if ($updateResult === false) {
                // Get the last query and error details
                $error = $db->error();
                throw new \Exception('Update failed: ' . $error['message']);
            }
            $dataToInsert = [];
            $operationTeamModel = new OperationTeamModel();

            $roles = ['Operator', 'Asisten', 'Instrumen', 'Sirkuler', 'Perawat', 'Anestesi', 'Dokter'];

            foreach ($roles as $role) {
                if (!empty($formData[$role])) {
                    foreach ($formData[$role] as $index => $employee) {
                        $data = [
                            'org_unit_code' => $formData['org_unit_code'],
                            'OPERATION_ID' => $vactinationId,
                            'EMPLOYEE_ID' => $employee["EMPLOYEE_ID"],
                            'TASK_ID' => $employee["TASK_ID"],
                            'COEFFICIENT' => $employee["COEFFICIENT"],
                            'ONCALL' => $employee["ONCALL"],
                            'TARIF_ID' => $formData['tarif_id'],
                            'DESCRIPTION' => null,
                            'DOCTOR' => $employee["DOCTOR"]
                        ];

                        $dataToInsert[] = $data;
                    }
                }
            }

            // Delete existing records for the current operation_id
            $operationTeamModel->where('operation_id', $vactinationId)->delete();

            // Insert new records
            foreach ($dataToInsert as $data) {
                $operationTeamModel->insert($data);
            }

            // Commit transaction if all operations succeed
            $db->transCommit();

            return $this->response->setJSON([
                'message' => 'Data updated and inserted successfully.',
                'respon' => true,
                'data' => $updateData,
                'inserted_data' => $dataToInsert
            ]);
        } catch (\Exception $e) {
            // Rollback transaction if an error occurred
            $db->transRollback();

            return $this->response->setJSON([
                'error' => 'Failed to update and insert data: ' . $e->getMessage()
            ]);
        }
    } // new update 29/7


    public function getDataTim()
    {
        $formData = $this->request->getJSON();

        $model = new OperationTeamModel();

        $data = $this->lowerKey($model->where('OPERATION_ID', $formData->vactination_id)
            ->findAll());

        return $this->response->setJSON(['data' => $data, 'response' => true]);
    }

    public function getAssessmentParameterType()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        $sql = "select * from ASSESSMENT_PARAMETER where P_TYPE = '" . $formData['p_type'] . "'";

        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($results);
    }


    public function getAssessmentParameterValueType()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        $sql = "SELECT * FROM ASSESSMENT_PARAMETER_VALUE WHERE P_TYPE = '" . $formData['p_type'] . "'";
        $query = $db->query($sql);



        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($results);
    }


    // 

    public function getPasienOprasiValue()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        $sql = "select * from ASSESSMENT_PARAMETER_VALUE  where  P_TYPE = 'OPRS003' and parameter_id ='" . $formData['parameter_id'] . "'";

        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($results);
    }


    public function getPasienOprasiHistory()
    {
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();

        $sql = "SELECT value_id, value_desc, histories from pasien_history WHERE (VALUE_ID like 'G00905%' OR VALUE_ID in ('G0090201','G0090202','G0090101','G0090102')) and NO_REGISTRATION ='" . $formData['NO_REGISTRATION'] . "'";

        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($results);
    }


    //praOprasi
    public function insertDataPraOprasi()
    {
        $model = new AssessmentOperationModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        foreach ($formData as $key => $value) {
            if (!is_array($value) && $value !== null && $value !== '') {
                $data[strtolower($key)] = $value;
            }
        }

        $data['xray'] = $formData['xray'];
        $dateFields = [
            'time_out',
            'instrument_availability',
            'implant_availability',
            'start_operation',
            'end_operation',
            'transport_time',
            'nurse_notification',
            'nurse_arrived',
            'modified_date'
        ];
        foreach ($dateFields as $field) {
            if (isset($formData[$field]) && !empty($formData[$field])) {
                $data[$field] = date('Y-m-d\TH:i:s', strtotime($formData[$field]));
            }
        }

        $db = db_connect();
        $db->transStart();

        try {
            // Process AssessmentOperation
            $existingEntry = $model->where(['document_id' => $formData['document_id'] ?? ''])->first();

            if ($existingEntry) {
                $data['body_id'] = $existingEntry['BODY_ID'];

                $updateResult = $model->where(['body_id' => $existingEntry['BODY_ID']])
                    ->set($data)
                    ->update();

                if (!$updateResult) {
                    $error = $db->error();
                    throw new \Exception('Update AssessmentOperation failed: ' . $error['message']);
                }
            } else {
                $data['body_id'] = $this->get_bodyid();
                $insertResult = $model->insert($data);

                if (!$insertResult) {
                    $error = $db->error();
                    throw new \Exception('Insert AssessmentOperation failed: ' . $error['message']);
                }
            }

            // Process AssessmentInstrument
            $instrumenModel = new AssessmentInstrumentModel();


            if (isset($formData['instrumen']) && is_array($formData['instrumen']) && !empty($formData['instrumen'])) {
                $instrumenModel->where('document_id', $data['document_id'])->delete();

                if (empty($formData['body_id_instrument'])) {
                    $formData['body_id_instrument'] = $this->get_bodyid();
                }

                foreach ($formData['instrumen'] as $instrumen) {
                    $dataInstrumen = [
                        'org_unit_code' => $formData['org_unit_code'],
                        'visit_id' => $formData['visit_id'],
                        'trans_id' => $formData['trans_id'],
                        'document_id' => $formData['document_id'],
                        'body_id' => $formData['body_id_instrument'],
                        'examination_date' => date("Y-m-d H:i:s"),
                        'modified_by' => user()->username,
                        'modified_date' => date("Y-m-d H:i:s"),
                        'brand_id' => $instrumen['brand_id'],
                        'brand_name' => $instrumen['brand_name'],
                        'quantity_intra' => $instrumen['quantity_intra'],
                        'quantity_after' => $instrumen['quantity_after'],
                        'quantity_additional' => $instrumen['quantity_additional'],
                        'quantity_before' => $instrumen['quantity_before']
                    ];

                    $instrumenModel->insert($dataInstrumen);
                }
            }

            if (isset($formData['instrumen2']) && is_array($formData['instrumen2']) && !empty($formData['instrumen2']) && count($formData['instrumen']) == count($formData['instrumen2'])) {
                $instrumenModel->where('document_id', $data['document_id'])->delete();
                if (empty($formData['body_id_instrument'])) {
                    $formData['body_id_instrument'] = $this->get_bodyid();
                }

                foreach ($formData['instrumen2'] as $key => $instrumen2) {
                    $dataInstrumen2 = [
                        'org_unit_code' => $formData['org_unit_code'],
                        'visit_id' => $formData['visit_id'],
                        'trans_id' => $formData['trans_id'],
                        'document_id' => $formData['document_id'],
                        'body_id' => $formData['body_id_instrument'],
                        'examination_date' => date("Y-m-d H:i:s"),
                        'modified_by' => user()->username,
                        'modified_date' => date("Y-m-d H:i:s"),
                        'brand_id' => $formData['instrumen'][$key]['brand_id'],
                        'brand_name' => $formData['instrumen'][$key]['brand_name'],
                        'quantity_intra' => $instrumen2['quantity_intra'],
                        'quantity_after' => $instrumen2['quantity_after'],
                        'quantity_additional' => $instrumen2['quantity_additional'],
                        'quantity_before' => $formData['instrumen'][$key]['quantity_before']
                    ];
                    $instrumenModel->insert($dataInstrumen2);
                }
            }
            // Process PasienDiagnosaPerawat
            $pdn = new PasienDiagnosaPerawatModel();
            $org = new OrganizationunitModel();
            $id = $org->generateId();
            $pds = new PasienDiagnosasPerawatModel();

            $db->query("DELETE FROM pasien_diagnosas_nurse WHERE body_id IN (SELECT body_id FROM pasien_diagnosa_nurse WHERE document_id = ?)", [$formData['body_id'] ?? '']);
            $db->query("DELETE FROM pasien_diagnosa_nurse WHERE document_id = ?", [$formData['body_id'] ?? '']);

            $pdnData = [
                'org_unit_code' => $formData['org_unit_code'] ?? null,
                'visit_id' => $formData['visit_id'] ?? null,
                'trans_id' => $formData['trans_id'] ?? null,
                'body_id' => $id,
                'document_id' => $formData['body_id'] ?? null,
                'clinic_id' => $formData['clinic_id'] ?? null,
                'class_room_id' => $formData['class_room_id'] ?? null,
                'bed_id' => $formData['bed_id'] ?? null,
                'no_registration' => $formData['no_registration'] ?? null,
                'examination_date' => isset($formData['examination_date']) ? str_replace("T", " ", $formData['examination_date']) : null,
                'employee_id' => $formData['employee_id'] ?? null,
                'petugas_id' => user()->username,
                'descriptions' => null,
                'modified_by' => $formData['modified_by'] ?? user()->username,
            ];
            $insertPDNResult = $pdn->insert($pdnData);

            if (!$insertPDNResult) {
                $error = $db->error();
                throw new \Exception('Insert PasienDiagnosaPerawat failed: ' . $error['message']);
            }

            if (isset($formData['diagnosas']) && is_array($formData['diagnosas'])) {
                foreach ($formData['diagnosas'] as $diagnosa) {
                    $dataDiag = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'body_id' => $id,
                        'diagnosan_id' => $diagnosa['diagnosa_id'] ?? null,
                        'diagnosa_date' => date('Y-m-d H:i:s'),
                        'diag_notes' => $diagnosa['diag_notes'] ?? null,
                        'modified_by' => user()->username
                    ];
                    $insertDiagResult = $pds->insert($dataDiag);

                    if (!$insertDiagResult) {
                        $error = $db->error();
                        throw new \Exception('Insert PasienDiagnosaPerawat failed: ' . $error['message']);
                    }
                }
            }

            $anesthesiaRecoveryModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['bromage']) && is_array($formData['bromage'])) {

                $anesthesiaRecoveryModel->where('document_id', $data['document_id'])->where('p_type', 'OPRS024')->delete();

                foreach ($formData['bromage'] as $bromage) {
                    $dataBromage = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'visit_id' => $formData['visit_id'] ?? null,
                        'trans_id' => $formData['trans_id'] ?? null,
                        'document_id' => $formData['document_id'] ?? null,
                        'body_id' => $this->get_bodyid(),  // Custom method to get body_id
                        'p_type' => $bromage['p_type'] ?? null,
                        'parameter_id' => $bromage['parameter_id'] ?? null,
                        'value_score' => $bromage['value_score'] ?? null,
                        'value_desc' => $bromage['value_desc'] ?? null,
                        'observation_date' => date('Y-m-d H:i:s'),
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,  // Assumes user() returns an object with a username property
                        'value_id' => $bromage['value_id'] ?? null
                    ];

                    $anesthesiaRecoveryModel->insert($dataBromage);

                    // if (!$insertBromageResult) {
                    //     throw new \Exception('Failed to insert Assessment Anesthesia Recovery.');
                    // }
                }
            }

            // Process AssessmentOperationDrain
            $drainModel = new AssessmentOperationDrainModel();
            if (isset($formData['drain']) && is_array($formData['drain'])) {
                foreach ($formData['drain'] as $drain) {
                    if (isset($drain['document_id'])) {
                        $drainModel->where('document_id', $drain['document_id'])->delete();
                    }
                }

                $drainData = [];
                foreach ($formData['drain'] as $drain) {
                    $drainDetails = [
                        'examination_date' => date("Y-m-d H:i:s"),
                        'modified_by' => user()->username,
                        'modified_date' => date("Y-m-d H:i:s")
                    ];
                    foreach ($drain as $key => $value) {
                        if ($value !== null && $value !== '') {
                            $drainDetails[strtolower($key)] = $value;
                        }
                    }
                    $drainData[] = $drainDetails;
                }
                if (!empty($drainData)) {
                    $insertBatchDrainResult = $drainModel->insertBatch($drainData);

                    if (!$insertBatchDrainResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentOperationDrain failed: ' . $error['message']);
                    }
                }
            }

            // Process Examination
            $examinationModel = new ExaminationDetailModel();

            if (isset($formData['vitailsign']) && is_array($formData['vitailsign']) && isset($formData['vitailsign']['vs_status_id']) && in_array($formData['vitailsign']['vs_status_id'], ['1', '4', '5', '10'])) {
                $vitalsignData = [];
                foreach ($formData['vitailsign'] as $key => $value) {
                    if ($key === 'examination_date') {
                        $vitalsignData[strtolower($key)] = date('Y-m-d\TH:i:s', strtotime($value));
                    } else {
                        $vitalsignData[strtolower($key)] = $value;
                    }
                }

                $vitalsignData['account_id'] = '10';
                $vitalsignData['modified_by'] = user()->username;
                $vitalsignData['modified_date'] = date("Y-m-d H:i:s");
                $vitalsignData['awareness'] = $formData['gen0021_01'] ?? null;
                $vitalsignData['pain'] = $formData['gen0021_02'] ?? null;
                $vitalsignData['lochia'] = $formData['gen0021_03'] ?? null;
                $vitalsignData['proteinuria'] = $formData['gen0021_04'] ?? null;
                $vitalsignData['general_condition'] = $formData['gen0022_01'] ?? null; //keadaan mmum
                $vitalsignData['cardiovasculer'] = $formData['gen0022_02'] ?? null;
                $vitalsignData['respiration'] = $formData['gen0022_03'] ?? null;


                if (isset($vitalsignData['pasien_diagnosa_id'])) {

                    $existingVitalsignEntry = $this->lowerKey($db->query("select * from EXAMINATION_DETAIL 
                    where EXAMINATION_DETAIL.document_id = '" . $vitalsignData['pasien_diagnosa_id'] . "' AND examination_detail.body_id = '" . $vitalsignData['body_id'] . "' AND examination_detail.account_id = 10 order by examination_detail.EXAMINATION_DATE desc
                    ")->getRowArray() ?? []);

                    if (!empty($existingVitalsignEntry)) {
                        $updateVitalsignResult = $examinationModel->where('body_id', $existingVitalsignEntry['body_id'])
                            ->set($vitalsignData)
                            ->update();

                        if (!$updateVitalsignResult) {
                            $error = $db->error();
                            throw new \Exception('Update Examination failed: ' . $error['message']);
                        }
                    } else {
                        $vitalsignData['body_id'] = $this->get_bodyid();
                        $vitalsignData['document_id'] = $vitalsignData['pasien_diagnosa_id'];

                        $insertVitalsignResult = $examinationModel->insert($vitalsignData);

                        if (!$insertVitalsignResult) {
                            $error = $db->error();
                            throw new \Exception('Insert Examination failed: ' . $error['message']);
                        }
                    }
                } else {
                    throw new \Exception('Body ID is required.');
                }
            }
            $aldreteModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['aldrete']) && is_array($formData['aldrete'])) {

                $documentIds = array_column($formData['aldrete'], 'document_id');


                if (!empty($documentIds)) {
                    $aldreteModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS023')->delete();
                }

                $aldreteData = [];
                foreach ($formData['aldrete'] as $aldrete) {
                    $observationDate = isset($aldrete['observation_date']) ? str_replace('T', ' ', $aldrete['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $aldreteData[] = [
                        'org_unit_code' => $aldrete['org_unit_code'] ?? null,
                        'visit_id' => $aldrete['visit_id'] ?? null,
                        'trans_id' => $aldrete['trans_id'] ?? null,
                        'body_id' => $aldrete['body_id'] ?? null,
                        'document_id' => $aldrete['document_id'] ?? null,
                        'p_type' => $aldrete['p_type'] ?? null,
                        'parameter_id' => $aldrete['parameter_id'] ?? null,
                        'value_score' => $aldrete['value_score'] ?? null,
                        'value_desc' => $aldrete['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $aldrete['value_id'] ?? null
                    ];
                }



                if (!empty($aldreteData)) {
                    $insertBatchAldreteResult = $aldreteModel->insertBatch($aldreteData);

                    if (!$insertBatchAldreteResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery failed: ' . $error['message']);
                    }
                }
            }

            $stewardModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['steward']) && is_array($formData['steward'])) {

                $documentIds = array_column($formData['steward'], 'document_id');


                if (!empty($documentIds)) {
                    $stewardModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS025')->delete();
                }

                $stewardData = [];
                foreach ($formData['steward'] as $steward) {
                    $observationDate = isset($steward['observation_date']) ? str_replace('T', ' ', $steward['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $stewardData[] = [
                        'org_unit_code' => $steward['org_unit_code'] ?? null,
                        'visit_id' => $steward['visit_id'] ?? null,
                        'trans_id' => $steward['trans_id'] ?? null,
                        'body_id' => $steward['body_id'] ?? null,
                        'document_id' => $steward['document_id'] ?? null,
                        'p_type' => $steward['p_type'] ?? null,
                        'parameter_id' => $steward['parameter_id'] ?? null,
                        'value_score' => $steward['value_score'] ?? null,
                        'value_desc' => $steward['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $steward['value_id'] ?? null
                    ];
                }



                if (!empty($stewardData)) {
                    $insertBatchStewardResult = $stewardModel->insertBatch($stewardData);

                    if (!$insertBatchStewardResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery failed: ' . $error['message']);
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON(['message' => 'Data save failed.', 'respon' => false]);
            }

            return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error occurred: ' . $e->getMessage());
            return $this->response->setJSON(['message' => 'Data save failed: ' . $e->getMessage(), 'respon' => false]);
        }
    }

    // new 02/08 new 03/08



    public function insertChecklistKeselamatan()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $db = db_connect();
        $date = date("Y-m-d H:i:s");

        // Initialize models
        $patientOperationCheckModel = new PatientOperationCheck();
        $instrumenModel = new AssessmentInstrumentModel();

        // Prepare data
        $requiredKeys = [
            'org_unit_code',
            'visit_id',
            'trans_id',
            'body_id',
            'document_id',
            'examination_date',
            'modified_by',
            'modified_date',
            'patient_wristband',
            'operation_location',
            'operation_procedure',
            'surgical_concent',
            'signed_spot',
            'anesthesia_machine',
            'oxymeter',
            'isalergy',
            'breathing_dificulty',
            'blood_loss_risk',
            'introducing_onself',
            'patient_identity',
            'timeout_procedure',
            'inicision_location',
            'right_eye',
            'left_eye',
            'other_location',
            'prophypaltic_antibiotic',
            'antibiotic_name',
            'antibiotic_dose',
            'unexpected_incident',
            'operation_length',
            'blood_loss',
            'consideration',
            'cvc',
            'issteril',
            'problematic_tools',
            'negative_diathermy',
            'suchtion',
            'photo_shown',
            'procedure_name',
            'instrument',
            'speciment',
            'isproblematic_tools',
            'main_problem',
        ];

        $data = [];
        foreach ($requiredKeys as $key) {
            $data[$key] = !empty($formData[$key]) ? $formData[$key] : null;
        }

        $data['examination_date'] = $data['modified_date'] = $date;
        $data['modified_by'] = user()->username;

        // Database transaction
        $db->transStart();
        try {
            // Update or insert data in PatientOperationCheck
            $existData = $this->lowerKey($patientOperationCheckModel->where('document_id', $data['document_id'])->first() ?? []);

            if ($db->table('ASSESSMENT_OPERATION_CHECK')->where('document_id', $data['document_id'])->countAllResults() > 0) {
                $data['examination_date'] = $existData['examination_date'];
                $data['modified_date'] =  $existData['modified_date'];

                $patientOperationCheckModel->update($data['document_id'], $data);
                if (!$patientOperationCheckModel->update($data['document_id'], $data)) {
                    // Handle update error
                    throw new Exception('Error updating record: ' . implode(", ", $patientOperationCheckModel->errors()));
                }
            } else {
                $data['examination_date'] = $data['modified_date'] = $date;
                $data['modified_by'] = user()->username;
                $patientOperationCheckModel->insert($data);
            }


            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Database transaction failed');
            }

            return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Data save failed.', 'respon' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getDataAssessmentOperation()
    {

        $formData = $this->request->getJSON();

        $model = new AssessmentOperationModel();

        $data = $this->lowerKey($model->where('document_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    } //new 03/08

    public function insertChecklistanestesi()
    {
        $model = new AssessmentAnesthesiaChecklist();
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();
        $date = date("Y-m-d H:i:s");
        $query = $db->query("SELECT * FROM ASSESSMENT_ANESTHESI_CHECKLIST WHERE body_id='" . $formData['body_id'] . "' ")->getNumRows();

        $data = [];

        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == '')) {
                $data[strtolower($key)] = $value;
            }
        }

        foreach ($formData as &$filter) {
            if (empty($filter)) {
                $filter = null;
            }
        }
        if (!empty($formData['start_operation'])) {
            $formData['start_operation'] = str_replace("T", " ", $formData['start_operation']);
        }

        $data = [
            'org_unit_code' => $formData['org_unit_code'],
            'visit_id' => $formData['visit_id'],
            'trans_id' => $formData['trans_id'],
            'document_id' => $formData['document_id'],
            'body_id' => $formData['body_id'],
            'anesthesia_machine_on' => $formData['anesthesia_machine_on'],
            'oxygen_tube' => $formData['oxygen_tube'],
            'flow_meter' => $formData['flow_meter'],
            'power_on' => $formData['power_on'],
            'circuit_leackage' => $formData['circuit_leackage'],
            'volatil' => $formData['volatil'],
            'face_mask' => $formData['face_mask'],
            'laringoskop' => $formData['laringoskop'],
            'ett_lma' => $formData['ett_lma'],
            'stylet' => $formData['stylet'],
            'spuit_cuff' => $formData['spuit_cuff'],
            'ekg_cable' => $formData['ekg_cable'],
            'nibp_connection' => $formData['nibp_connection'],
            'stetoscope' => $formData['stetoscope'],
            'suction_tube' => $formData['suction_tube'],
            'bandage' => $formData['bandage'],
            'nasal_cannula' => $formData['nasal_cannula'],
            'intravenous_line' => $formData['intravenous_line'],
            'spuit_size' => $formData['spuit_size'],
            'epinefrin' => $formData['epinefrin'],
            'atropin' => $formData['atropin'],
            'sedative' => $formData['sedative'],
            'opioid' => $formData['opioid'],
            'muscle_relaxant' => $formData['muscle_relaxant'],
            'intravena_fluid' => $formData['intravena_fluid'],
            'other_fluid' => $formData['other_fluid'],
        ];


        if ($query > 0) {
            $model->where(['body_id' => $data['body_id']])
                ->set($data)
                ->update();
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
    }


    public function getDataPatientOperationCheck()
    {

        $formData = $this->request->getJSON();

        $model = new PatientOperationCheck();

        $data = $this->lowerKey($model->where('document_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getDataAssessmentAnestesi()
    {

        $formData = $this->request->getJSON();

        $model = new AssessmentAnesthesiaChecklist();

        $data = $this->lowerKey($model->where('document_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function insertLaporanPembedahan()
    {
        $model = new PatientOperationRequestModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();
        $data = array_filter($formData, function ($value) {
            return !is_null($value) && $value !== '';
        });

        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == '')) {
                $data[strtolower($key)] = $value;
            }
        }

        if (isset($data['start_operation'])) {
            $data['start_operation'] = $this->formatDateString($data['start_operation']);
        }
        if (isset($data['end_operation'])) {
            $data['end_operation'] = $this->formatDateString($data['end_operation']);
        }
        if (isset($data['modified_date'])) {
            $data['modified_date'] = $this->formatDateString($data['modified_date']);
        }
        if (isset($data['patologi_date'])) {
            $data['patologi_date'] = $this->formatDateString($data['patologi_date']);
        }

        $db->transStart();
        try {
            $existingRecord = $model->where('vactination_id', $data['vactination_id'])->first();
            if ($existingRecord) {
                $update = $model->update($data['vactination_id'], $data);
                if (!$update) {
                    $error = $db->error();
                    throw new \Exception('Update Pembedahan failed: ' . $error['message']);
                }
            } else {
                $insert = $model->insert($data);
                if (!$insert) {
                    $error = $db->error();
                    throw new \Exception('Insert Pembedahan failed: ' . $error['message']);
                }
            }


            if (!empty($data['diagnosas'])) {
                $pds = new PasienDiagnosasModel();
                $pds->where('pasien_diagnosa_id', $data['vactination_id'])->delete();
                // return json_encode($body_id);
                $insertDiagnosa = [];
                foreach ($data['diagnosas'] as $key => $value) {
                    $dataDiag = [];
                    $dataDiag['pasien_diagnosa_id'] = $data['vactination_id'];
                    $dataDiag['diagnosa_id'] = new RawSql('newid()');
                    $dataDiag['diagnosa_desc'] = $data['diagnosas'][$key]['diagnosa_desc'];
                    $dataDiag['diagnosa_name'] = !empty($data['diagnosas'][$key]['diagnosa_name']) ? $data['diagnosas'][$key]['diagnosa_name'] : null;
                    $dataDiag['diag_cat'] = $data['diagnosas'][$key]['diagnosa_cat'];
                    $dataDiag['suffer_type'] = $data['diagnosas'][$key]['suffer_type'];
                    $dataDiag['modified_by'] = user()->username;
                    $dataDiag['modified_date'] = date('Y-m-d H:i:s');
                    $dataDiag['sscondition_id'] = new RawSql('newid()');
                    $insertDiagnosa[] = $pds->insert($dataDiag);
                }
                if (!$insertDiagnosa) {
                    $error = $db->error();
                    throw new \Exception('Insert Diagnosa failed: error when insert ' . $data['diagnosas'][$key]['diagnosa_desc']);
                }
            }

            $db->transComplete();
            return $this->response->setJSON([
                'message' => 'Data saved successfully.',
                'respon' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Data save failed.', 'respon' => false, 'error' => $e->getMessage()]);
        }
    }


    public function getDataInstrumen()
    {
        $formData = $this->request->getJSON();

        $model = new AssessmentInstrumentModel();

        $data = $this->lowerKey($model->where('document_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }


    public function getDataAssessmentPostOperasi()
    {

        $formData = $this->request->getJSON();

        $model = new AssessmentOperationPostModel();

        $data = $this->lowerKey($model->where('document_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getDataPraOperasi()
    {
        $formData = $this->request->getJSON();

        $model = new AssessmentPraOperasi();

        $data = $this->lowerKey($model->where('body_id', $formData->body_id)
            ->findAll());

        if (isset($data[0])) {
            $db = db_connect();
            $primaryPD = "";
            foreach ($data as $key => $value) {
                $primaryPD .= "'" . $value['body_id'] . "',";
            }
            $primaryPD = substr($primaryPD, 0, -1);
            $selectdiagnosas = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());

            $selectlokalis = $this->lowerKey($db->query("select * from assessment_lokalis where body_id in ($primaryPD)")->getResultArray());

            foreach ($selectlokalis as $key => $value) {
                if ($value['value_score'] == 3) {
                    $filepath = WRITEPATH . 'uploads/lokalis/' . $value['value_detail'];
                    if (file_exists($filepath)) {
                        $filedata = file_get_contents($filepath);
                        $filedata64 = base64_encode($filedata);
                        $selectlokalis[$key]['filedata64'] = $filedata64;
                    }
                }
            }

            $bloodmodel = new BloodRequestModel();
            $blood = $bloodmodel->where("document_id in ($primaryPD)")->findAll();

            // return json_encode([
            // 'praoperasi' => $data,
            // 'lokalis' => $selectlokalis
            // ]);
            return $this->response->setJSON([
                'praoperasi' => $data,
                'lokalis' => $selectlokalis,
                'pasienDiagnosas' => $selectdiagnosas,
                // 'blood' => $blood
            ]);
        }
        return $this->response->setJSON($data);
    }


    public function savePraOperasiDummy()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getPost();

        // return json_encode($body);
        // $body = json_decode($body, true);

        $db = db_connect();
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
        $data['modified_by'] = user()->username;

        if (isset($bloodblood_request)) {
            $bloodblood_request = [
                '202412040411113432R6',
                '20241204041114617B4V'
            ];

            $bloodmodel = new BloodRequestModel();

            $bloodBeforeDelete = $this->lowerKey($db->query("
            select * from blood_request 
            where VISIT_ID = '" . $bloodvisit_id[0] . "' 
            -- and CLINIC_ID = '" . 'P002' . "' 
            and NO_REGISTRATION = '" . $bloodno_registration[0] . "' 
            and (TRANSFUSION_START is null OR TRANSFUSION_END is null)
            ")->getResultArray() ?? []);

            // $bloodmodel->where('visit_id', $bloodvisit_id[0])
            //     ->where('document_id', '20241203101426927')
            //     ->where('no_registration', $bloodno_registration[0])
            //     // ->where('clinic_id', 'P002')
            //     ->where('TRANSFUSION_START', NULL)
            //     ->orWhere('TRANSFUSION_END', NULL)
            //     ->delete();
            // $bloodmodel->where('document_id', $body_id)->delete();

            foreach ($bloodblood_request as $key => $value) {

                $existData = array_filter($bloodBeforeDelete, function ($item) use ($value) {
                    return isset($item['blood_request']) && $item['blood_request'] === $value;
                });

                $datablood = [
                    'org_unit_code' => $bloodorg_unit_code[$key],
                    'blood_request' => $bloodblood_request[$key],
                    'no_registration' => $bloodno_registration[$key],
                    'visit_id' => $bloodvisit_id[$key],
                    'trans_id' => $bloodtrans_id[$key],
                    'document_id' => '20241203101426927',
                    'request_date' => $bloodrequest_date[$key],
                    'blood_type_id' => $bloodblood_type_id[$key],
                    'using_time' => $bloodusing_time[$key],
                    'blood_usage_type' => $bloodblood_usage_type[$key],
                    'blood_quantity' => $bloodblood_quantity[$key],
                    'measure_id' => $bloodmeasure_id[$key],
                    'descriptions' => $blooddescriptions[$key],
                    'transfusion_start' => !empty(@$bloodtransfusion_start[$key]) ? @$bloodtransfusion_start[$key]  : null,
                    'transfusion_end' => !empty(@$bloodtransfusion_end[$key]) ? @$bloodtransfusion_end[$key]  : null,
                    'reaction_desc' => !empty(@$bloodreaction_desc[$key]) ? @$bloodreaction_desc[$key] : null,
                ];
                echo '<pre>';
                var_dump($datablood);
                die();
                $bloodmodel->insert($datablood);
            }
        }

        return json_encode($data);
    }
    public function savePraOperasi()
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
        $data['modified_by'] = user()->username;

        // return json_encode($data);

        $model = new AssessmentPraOperasi();

        $model->delete($body_id);

        $model->save($data);

        if (!empty($diag_id)) {
            $pds = new PasienDiagnosasModel();
            $pds->where('pasien_diagnosa_id', $body_id)->delete();
            // return json_encode($body_id);

            foreach ($diag_id as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $body_id;
                $dataDiag['diagnosa_id'] = $diag_id[$key];
                $dataDiag['diagnosa_name'] = $diag_name[$key];
                $dataDiag['diag_cat'] = $diag_cat[$key];
                $dataDiag['suffer_type'] = $suffer_type[$key];
                $dataDiag['modified_by'] = user_id();
                $dataDiag['sscondition_id'] = new RawSql('newid()');
                try {
                    $pds->insert($dataDiag);
                } catch (\Throwable $th) {
                }
            }
        }

        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where VALUE_SCORE in (3) and P_TYPE = 'OPRS002'")->getResultArray());


        $lokalisModel = new AssessmentLokalisModel();
        foreach ($select as $key => $value) {
            $value['value_id'] = strtolower($value['value_id']);
            if (isset(${'lokalis' . $value['value_id']})) {
                $data = explode(',', (string)${'lokalis' . $value['value_id']});
                $encodedLokalis = $data[1];
                $decodedLokalis = base64_decode($encodedLokalis);
                $lokalisPath = WRITEPATH . 'uploads/lokalis/';
                if (!is_dir($lokalisPath)) {
                    mkdir($lokalisPath, 0777, true);
                }
                $filenameLokalis = 'P002_' . $body_id . $value['value_id'] . '.png';
                $fullPathLokalis = $lokalisPath . $filenameLokalis;
                if (file_put_contents($fullPathLokalis, $decodedLokalis)) {
                    $data = [
                        'org_unit_code' => $org_unit_code,
                        'visit_id' => $visit_id,
                        'trans_id' => $visit_id,
                        'body_id' => $body_id,
                        'document_id' => $body_id,
                        'p_type' => $value['p_type'],
                        'parameter_id' => $value['parameter_id'],
                        'value_id' => $value['value_id'],
                        'value_score' => $value['value_score'],
                        'value_desc' => ${'lokalis' . $value['value_id'] . 'desc'},
                        'value_detail' => $filenameLokalis,
                        'value_info' => $value['value_info'],
                        'modified_by' => user()->username
                    ];
                    $db->query("delete from assessment_lokalis where body_id = '$body_id' and value_id = '" . $value['value_id'] . "'");
                    $lokalisModel->insert($data);
                } else {
                    return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
                }
            } else if (isset(${'fisik' . $value['value_id']}) && $value['value_score'] == 2) {
                $data = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $visit_id,
                    'body_id' => $body_id,
                    'p_type' => $value['p_type'],
                    'parameter_id' => $value['parameter_id'],
                    'value_id' => $value['value_id'],
                    'value_score' => $value['value_score'],
                    'value_desc' => $value['value_desc'],
                    'value_detail' => ${'fisik' . $value['value_id']},
                    'value_info' => $value['value_info'],
                    'modified_by' => user()->username
                ];
                $db->query("delete from assessment_lokalis where body_id = '$body_id' and value_id = '" . $value['value_id'] . "'");
                $lokalisModel->insert($data);
            }
        }

        if (isset($bloodblood_request)) {
            $bloodmodel = new BloodRequestModel();

            $bloodBeforeDelete = $this->lowerKey($db->query("
            select * from blood_request 
            where VISIT_ID = '" . $data['visit_id'] . "' 
            and CLINIC_ID = '" . $bloodclinic_id[0] . "' 
            and NO_REGISTRATION = '" . $bloodno_registration[0] . "' 
            and (TRANSFUSION_START is null OR TRANSFUSION_END is null)
            ")->getResultArray() ?? []);

            $bloodmodel->where('visit_id', $data['visit_id'])
                ->where('document_id', $body_id)
                ->where('no_registration', $bloodno_registration[0])
                ->where('clinic_id', $bloodclinic_id[0])
                ->groupStart()
                ->where('TRANSFUSION_START', NULL)
                ->orWhere('TRANSFUSION_END', NULL)
                ->groupEnd()
                ->delete();

            foreach ($bloodblood_request as $key => $value) {

                $existData = array_filter($bloodBeforeDelete, function ($item) use ($value) {
                    return isset($item['blood_request']) && $item['blood_request'] === $value;
                });

                $datablood = [
                    'org_unit_code' => $bloodorg_unit_code[$key],
                    'blood_request' => $bloodblood_request[$key],
                    'no_registration' => $bloodno_registration[$key],
                    'visit_id' => $bloodvisit_id[$key],
                    'trans_id' => $bloodtrans_id[$key],
                    'clinic_id' => $bloodclinic_id[$key],
                    'document_id' => $body_id,

                    'request_date' => $bloodrequest_date[$key],
                    'blood_type_id' => $bloodblood_type_id[$key],
                    'using_time' => $bloodusing_time[$key],
                    'blood_usage_type' => $bloodblood_usage_type[$key],
                    'blood_quantity' => $bloodblood_quantity[$key],
                    'measure_id' => $bloodmeasure_id[$key],
                    'descriptions' => $blooddescriptions[$key],

                    'calf_number' => $existData[0]['calf_number'] ?? null,
                    'delivery_time' => $existData[0]['delivery_time'] ?? null,
                    'terlayani' => $existData[0]['terlayani'] ?? null,

                    'transfusion_start' => !empty(@$bloodtransfusion_start[$key]) ? @$bloodtransfusion_start[$key]  : null,
                    'transfusion_end' => !empty(@$bloodtransfusion_end[$key]) ? @$bloodtransfusion_end[$key]  : null,
                    'reaction_desc' => !empty(@$bloodreaction_desc[$key]) ? @$bloodreaction_desc[$key] : null,
                ];
                $insertBloodRequest = $bloodmodel->insert($datablood);
                if (!$insertBloodRequest) {
                    $error = $db->error();
                    throw new \Exception('Update failed: ' . $error['message']);
                }
            }
        }

        return json_encode($data);
    }


    public function insertLaporanAnestesia()
    {
        $model = new AssessmentAnesthesiaModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $data = array_filter($formData, function ($value) {
            return !is_null($value) && $value !== '';
        });

        if (empty($data['body_id'])) {
            return $this->response->setJSON([
                'message' => 'body_id is required.',
                'respon' => false
            ]);
        }

        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!is_null(${$key}) && ${$key} != '') {
                $data[strtolower($key)] = $value;
            }
        }

        if (isset($data['start_operation'])) {
            $data['start_operation'] = date('Y-m-d H:i:s', strtotime($data['start_operation']));
        }

        if (isset($data['modified_date'])) {
            $data['modified_date'] = date('Y-m-d H:i:s', strtotime($data['modified_date']));
        }
        if (isset($data['examination_date'])) {
            $data['examination_date'] = date('Y-m-d H:i:s', strtotime($data['examination_date']));
        } else {
            $data['examination_date'] = date('Y-m-d H:i:s');
        }


        $db = db_connect();
        $db->transStart();

        try {
            $existingRecord = $model->where('document_id', $data['document_id'])->first();

            if ($existingRecord) {
                $existingRecord = $this->lowerKey($existingRecord);
                $result = $model->where(['body_id' => $existingRecord['body_id']])
                    ->set($data)
                    ->update();
                if (!$result) {
                    throw new Exception('Failed to update main record.');
                }
                $message = 'Data updated successfully.';
            } else {
                $model->insert($data);
                $message = 'Data inserted successfully.';
            }

            if (isset($formData['vitailsign']) && is_array($formData['vitailsign']) && !empty($formData['vitailsign']) && isset($formData['vitailsign']['vs_status_id'])  && in_array($formData['vitailsign']['vs_status_id'], ['1', '4', '5', '10'])) {
                $examinationModel = new ExaminationDetailModel();

                if (isset($formData['vitailsign']) && is_array($formData['vitailsign'])) {
                    $vitalsignData = [];
                    foreach ($formData['vitailsign'] as $key => $value) {
                        if ($key === 'examination_date') {
                            $vitalsignData[strtolower($key)] = date('Y-m-d\TH:i:s', strtotime($value));
                        } else {
                            $vitalsignData[strtolower($key)] = $value;
                        }
                    }
                    $vitalsignData['account_id'] = '11';
                    $vitalsignData['modified_by'] = user()->username;
                    $vitalsignData['modified_date'] = date("Y-m-d H:i:s");
                    $vitalsignData['awareness'] = $formData['gen0021_01'] ?? null;
                    $vitalsignData['pain'] = $formData['gen0021_02'] ?? null;
                    $vitalsignData['lochia'] = $formData['gen0021_03'] ?? null;
                    $vitalsignData['proteinuria'] = $formData['gen0021_04'] ?? null;
                    $vitalsignData['general_condition'] = $formData['gen0022_01'] ?? null; //keadaan mmum
                    $vitalsignData['cardiovasculer'] = $formData['gen0022_02'] ?? null;
                    $vitalsignData['respiration'] = $formData['gen0022_03'] ?? null;
                    $vitalsignData['document_id'] = $vitalsignData['pasien_diagnosa_id'] ?? null;


                    if (isset($vitalsignData['pasien_diagnosa_id'])) {

                        $existingVitalsignEntry = $this->lowerKey($db->query("
                        select * from EXAMINATION_DETAIL 
                        where EXAMINATION_DETAIL.document_id = '" . $vitalsignData['pasien_diagnosa_id'] . "' 
                        AND examination_detail.body_id = '" . $vitalsignData['body_id'] . "' 
                        AND examination_detail.account_id = 11 
                        order by examination_detail.EXAMINATION_DATE desc
                        ")->getRowArray() ?? []);

                        if (!empty($existingVitalsignEntry)) {
                            $updateVitalsignResult = $examinationModel->where('body_id', $existingVitalsignEntry['body_id'])
                                ->set($vitalsignData)
                                ->update();

                            if (!$updateVitalsignResult) {
                                $error = $db->error();
                                throw new \Exception('Update Examination failed: ' . $error['message']);
                            }
                        } else {
                            $vitalsignData['body_id'] = $this->get_bodyid();

                            $insertVitalsignResult = $examinationModel->insert($vitalsignData);

                            if (!$insertVitalsignResult) {
                                $error = $db->error();
                                throw new \Exception('Insert Examination failed: ' . $error['message']);
                            }
                        }
                    } else {
                        throw new \Exception('Body ID is required.');
                    }
                }
            }

            if (isset($formData['diagnosa']) && is_array($formData['diagnosa'])) {
                $pds = new PasienDiagnosasModel();
                $diagnosaData = [];

                $pds->where('pasien_diagnosa_id', $formData['body_id'])->delete();

                foreach ($formData['diagnosa'] as $diagnosis) {
                    if (is_array($diagnosis) && isset($diagnosis['pasien_diagnosa_id'])) {
                        $diagnosaData[] = [
                            'pasien_diagnosa_id' => $diagnosis['pasien_diagnosa_id'],
                            'diagnosa_id' => new RawSql('newid()'),
                            'diagnosa_desc' => $diagnosis['diag_desc'],
                            'diag_cat' => $diagnosis['diag_cat'],
                            'suffer_type' => $diagnosis['suffer_type'],
                            'modified_by' => user()->username,
                            'sscondition_id' => new RawSql('newid()'),
                        ];
                    } else {
                        throw new Exception('Invalid diagnosis data format.');
                    }
                }

                if (!empty($diagnosaData)) {
                    $pds->insertBatch($diagnosaData);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new Exception('Transaction failed.');
            }

            return $this->response->setJSON(['message' => $message, 'respon' => true, 'data' => $data]);
        } catch (Exception $e) {
            $db->transRollback();
            log_message('error', 'Transaction failed: ' . $e->getMessage());
            return $this->response->setJSON(['message' => $e->getMessage(), 'respon' => false]);
        }
    }

    public function insertAnestesiaLengkap()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $data = array_filter($formData, function ($value) {
            return !is_null($value) && $value !== '';
        });

        if (empty($data['body_id'])) {
            return $this->response->setJSON([
                'message' => 'body_id is required.',
                'respon' => false
            ]);
        }

        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!is_null(${$key}) && ${$key} != '') {
                $data[strtolower($key)] = $value;
            }
        }

        if (isset($data['start_operation'])) {
            $data['start_operation'] = $this->formatDateString($data['start_operation']);
        }
        if (isset($data['end_operation'])) {
            $data['end_operation'] = $this->formatDateString($data['end_operation']);
        }

        if (isset($data['modified_date'])) {
            $data['modified_date'] = $this->formatDateString($data['modified_date']);
        }
        if (isset($data['start_anesthesia'])) {
            $data['start_anesthesia'] = $this->formatDateString($data['start_anesthesia']);
        }
        if (isset($data['end_anesthesia'])) {
            $data['end_anesthesia'] = $this->formatDateString($data['end_anesthesia']);
        }
        if (isset($data['observation_date'])) {
            $data['observation_date'] = $this->formatDateString($data['observation_date']);
        }
        if (isset($data['surgeryEnd'])) {
            $data['surgeryEnd'] = $this->formatDateString($data['surgeryEnd']);
        }
        if (isset($data['surgeryStart'])) {
            $data['surgeryStart'] = $this->formatDateString($data['surgeryStart']);
        }

        $db = db_connect();
        $db->transStart();

        try {

            $model = new AssessmentAnesthesiaModel();
            $existingRecord = $model->where('document_id', $data['document_id'])->first();

            if ($existingRecord) {
                $data['body_id'] = $existingRecord['BODY_ID'];

                $result = $model->where(['body_id' => $existingRecord['BODY_ID']])
                    ->set($data)
                    ->update();

                if (!$result) {
                    $error = $db->error();
                    throw new \Exception('Update main record failed: ' . $error['message']);
                }
                $message = 'Data updated successfully.';
            } else {
                $data['body_id'] = $this->get_bodyid();
                $result = $model->insert($data);
                // if (!$result) {
                //     throw new \Exception('Failed to insert main record.');
                // }
            }

            if (isset($formData['vitailsign']) && is_array($formData['vitailsign']) && !empty($formData['vitailsign']) && !empty($formData['vitailsign']['vs_status_id'])) {
                $examinationModel = new ExaminationDetailModel();
                $vitalsignData = [];
                foreach ($formData['vitailsign'] as $key => $value) {
                    if ($key === 'examination_date') {
                        $vitalsignData[strtolower($key)] = date('Y-m-d\TH:i:s', strtotime($value));
                    } else {
                        $vitalsignData[strtolower($key)] = $value;
                    }
                }
                $vitalsignData['document_id'] = $data['body_id'];
                $vitalsignData['account_id'] = '12';
                $vitalsignData['modified_by'] = user()->username;
                $vitalsignData['modified_date'] = date("Y-m-d H:i:s");
                $vitalsignData['examination_date'] = date("Y-m-d H:i:s");

                if (isset($vitalsignData['document_id'])) {
                    // jika hanya 1 data
                    // $existingVitalsignEntry = $examinationModel->where('document_id', $vitalsignData['document_id'])->where('account_id', '12')->first();
                    // jika data multiple
                    $existingVitalsignEntry = $examinationModel->where('document_id', $vitalsignData['document_id'])->where('body_id', $vitalsignData['body_id'])->where('account_id', '12')->first();

                    if (!empty($existingVitalsignEntry)) {
                        $vitalsignData['examination_date'] = $existingVitalsignEntry['EXAMINATION_DATE'];
                        $vitalsignData['body_id'] = $existingVitalsignEntry['BODY_ID'];
                        $ex = $examinationModel->where('body_id', $existingVitalsignEntry['BODY_ID'])
                            ->set($vitalsignData)
                            ->update();
                        if (!$ex) {
                            $error = $db->error();
                            throw new \Exception('Update vital sign 1 failed: ' . $error['message']);
                        }
                    } else {
                        $vitalsignData['body_id'] = $this->get_bodyid();
                        $ex = $examinationModel->insert($vitalsignData);
                        if (!$ex) {
                            $error = $db->error();
                            throw new \Exception('Insert vital sign 1 failed: ' . $error['message']);
                        }
                    }
                } else {
                    throw new \Exception('Body ID is required.');
                }
            }

            if (isset($formData['vitailsign2']) && is_array($formData['vitailsign2']) && !empty($formData['vitailsign2']) && !empty($formData['vitailsign2']['vs_status_id2'])) {
                $examinationModel = new ExaminationDetailModel();
                $vitalsignData2 = [];
                foreach ($formData['vitailsign2'] as $key => $value) {
                    // Remove the trailing '2' from the key if present
                    $newKey = (substr($key, -1) === '2') ? substr($key, 0, -1) : $key;

                    if (in_array($newKey, ['vs_status_id', 'saturasi', 'temperature_score', 'tension_upper_score', 'tension_below_score', 'nadi_score', 'nafas_score', 'saturasi_score', 'awareness', 'pain', 'lochia', 'general_condition', 'cardiovascular', 'respiration', 'proteinuria'])) {
                        $vitalsignData[$newKey] = (int)$value;
                    } elseif (in_array($newKey, ['examination_date', 'modified_date'])) {
                        $vitalsignData[$newKey] = date('Y-m-d H:i:s', strtotime($value));
                    } elseif (in_array($newKey, ['temperature', 'tension_upper', 'tension_below', 'nadi', 'nafas', 'weight', 'height', 'arm_diameter', 'oxygen_usage'])) {
                        $vitalsignData[$newKey] = number_format((float)$value, 2, '.', '');
                    } elseif (in_array($newKey, ['body_id', 'document_id', 'no_registration', 'visit_id', 'trans_id', 'clinic_id', 'account_id', 'modified_by'])) {
                        $vitalsignData[$newKey] = (string)$value;
                    } else {
                        $vitalsignData[$newKey] = $value;
                    }

                    $vitalsignData2[strtolower($newKey)] = ($newKey === 'examination_date') ? date('Y-m-d H:i:s', strtotime($value)) : $vitalsignData[$newKey];
                }


                $vitalsignData2['document_id'] = $data['body_id'];
                $vitalsignData2['account_id'] = '13';
                $vitalsignData2['modified_by'] = user()->username;
                $vitalsignData2['modified_date'] = date("Y-m-d H:i:s");
                $vitalsignData2['examination_date'] = date("Y-m-d H:i:s");

                if (isset($vitalsignData2['document_id'])) {
                    $existingVitalsignEntry2 = $examinationModel->where('document_id', $vitalsignData2['document_id'])->where('body_id', $vitalsignData2['body_id'])->where('account_id', '13')->first();

                    if (!empty($existingVitalsignEntry2)) {
                        $vitalsignData2['examination_date'] = $existingVitalsignEntry2['EXAMINATION_DATE'];
                        $vitalsignData2['body_id'] = $existingVitalsignEntry2['BODY_ID'];
                        $ex = $examinationModel->where('body_id', $existingVitalsignEntry2['BODY_ID'])
                            ->set($vitalsignData2)
                            ->update();
                        if (!$ex) {
                            $error = $db->error();
                            throw new \Exception('Update vital sign 2 failed: ' . $error['message']);
                        }
                        // if (!$ex) {
                        //     $dbError = $examinationModel->error(); // Get the error information
                        //     echo '<pre>';
                        //     var_dump($dbError); // Display the error details
                        //     die();
                        // }
                    } else {
                        $vitalsignData2['body_id'] = $this->get_bodyid();

                        $ex = $examinationModel->insert($vitalsignData2);

                        if (!$ex) {
                            $error = $db->error();
                            throw new \Exception('Insert vital sign 2 failed: ' . $error['message']);
                        }

                        // if (!$ex) {
                        //     $dbError = $examinationModel->error(); // Get the error information
                        //     echo '<pre>';
                        //     var_dump($dbError); // Display the error details
                        //     die();
                        // }
                    }
                } else {
                    throw new \Exception('Body ID is required.');
                }
            }

            // Uncomment and test if necessary
            if (isset($formData['diagnosa']) && is_array($formData['diagnosa'])) {

                $pds = new PasienDiagnosasModel();

                $pds->where('pasien_diagnosa_id', $formData['pasien_diagnosa_id'])->delete();
                $diagnosaData = [];
                foreach ($formData['diagnosa'] as $diagnosis) {
                    if (is_array($diagnosis)) {
                        $diagnosaData[] = [
                            'pasien_diagnosa_id' => $formData['pasien_diagnosa_id'],
                            'diagnosa_id' => new RawSql('newid()'),
                            'diagnosa_desc' => $diagnosis['diag_desc'],
                            'diagnosa_name' => !empty($diagnosis['diag_name']) ? $diagnosis['diag_name'] : null,
                            'diag_cat' => $diagnosis['diag_cat'],
                            'suffer_type' => $diagnosis['suffer_type'],
                            'modified_by' => user()->username,
                            'sscondition_id' => new RawSql('newid()'),
                        ];
                    } else {
                        $error = $db->error();
                        throw new \Exception('Invalid diagnosis data format : ' . $error['message']);
                    }
                }

                if (!empty($diagnosaData)) {

                    $insertPDS = $pds->insertBatch($diagnosaData);

                    if (!$insertPDS) {
                        $error = $db->error();
                        throw new \Exception('Failed to insert diagnosis : ' . $error['message']);
                    }
                }
            }

            if (isset($formData['post_anesthesia'])) {
                $anesthesiaPostModel = new AssessmentAnesthesiaPostModel();
                $anesthesiaPost = [];
                foreach ($formData['post_anesthesia'] as $key => $value) {
                    if ($key === 'examination_date') {
                        $anesthesiaPost[strtolower($key)] = date('Y-m-d\TH:i:s', strtotime($value));
                    } else {
                        $anesthesiaPost[strtolower($key)] = $value;
                    }
                }

                $existingAnesthesiaPost = $anesthesiaPostModel->where('document_id',  $data['document_id'])->first();

                $anesthesiaPost['document_id'] = $data['document_id'];
                $anesthesiaPost['no_registration'] = $data['no_registration'];
                $anesthesiaPost['visit_id'] = $data['visit_id'];
                $anesthesiaPost['trans_id'] = $data['trans_id'];
                $anesthesiaPost['org_unit_code'] = $data['org_unit_code'];
                $anesthesiaPost['modified_by'] = user()->username;
                $anesthesiaPost['modified_date'] = date("Y-m-d H:i:s");
                $anesthesiaPost['examination_date'] = date("Y-m-d H:i:s");
                $anesthesiaPost['recovery_leave_time'] = date('Y-m-d H:i:s', strtotime($anesthesiaPost['recovery_leave_time']));


                if (!empty($existingAnesthesiaPost)) {

                    $anesthesiaPost['body_id'] = $existingAnesthesiaPost['BODY_ID'];

                    $ex = $anesthesiaPostModel->where('body_id', $existingAnesthesiaPost['BODY_ID'])
                        ->set($anesthesiaPost)
                        ->update();
                    if (!$ex) {
                        $error = $db->error();
                        throw new \Exception('Failed to update anesthesi post : ' . $error['message']);
                    }
                } else {
                    $anesthesiaPost['body_id'] = $this->get_bodyid();
                    $ex = $anesthesiaPostModel->insert($anesthesiaPost);
                    // if (!$ex) {
                    //     throw new \Exception('Failed to insert anesthesi post');
                    // }
                    // echo '<pre>';
                    // var_dump($anesthesiaPostModel->error());
                    // die();
                }
            }

            $aldreteModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['aldrete']) && is_array($formData['aldrete'])) {

                $documentIds = array_column($formData['aldrete'], 'document_id');


                if (!empty($documentIds)) {
                    $aldreteModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS023')->delete();
                }

                $aldreteData = [];
                foreach ($formData['aldrete'] as $aldrete) {
                    $observationDate = isset($aldrete['observation_date']) ? str_replace('T', ' ', $aldrete['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $aldreteData[] = [
                        'org_unit_code' => $aldrete['org_unit_code'] ?? null,
                        'visit_id' => $aldrete['visit_id'] ?? null,
                        'trans_id' => $aldrete['trans_id'] ?? null,
                        'body_id' => $aldrete['body_id'] ?? null,
                        'document_id' => $aldrete['document_id'] ?? null,
                        'p_type' => $aldrete['p_type'] ?? null,
                        'parameter_id' => $aldrete['parameter_id'] ?? null,
                        'value_score' => $aldrete['value_score'] ?? null,
                        'value_desc' => $aldrete['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $aldrete['value_id'] ?? null
                    ];
                }



                if (!empty($aldreteData)) {
                    $insertBatchAldreteResult = $aldreteModel->insertBatch($aldreteData);

                    if (!$insertBatchAldreteResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery Aldrete failed: ' . $error['message']);
                    }
                }
            }

            $recoveryModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['infusion']) && is_array($formData['infusion'])) {

                $documentIds = array_column($formData['infusion'], 'document_id');


                if (!empty($documentIds)) {
                    $recoveryModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS029')->delete();
                }

                $infusionData = [];
                foreach ($formData['infusion'] as $infusion) {
                    $observationDate = isset($infusion['observation_date']) ? str_replace('T', ' ', $infusion['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $infusionData[] = [
                        'org_unit_code' => $infusion['org_unit_code'] ?? null,
                        'visit_id' => $infusion['visit_id'] ?? null,
                        'trans_id' => $infusion['trans_id'] ?? null,
                        'body_id' => $infusion['body_id'] ?? null,
                        'document_id' => $infusion['document_id'] ?? null,
                        'p_type' => $infusion['p_type'] ?? null,
                        'parameter_id' => $infusion['parameter_id'] ?? null,
                        'value_score' => $infusion['value_score'] ?? null,
                        'value_desc' => $infusion['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $infusion['value_id'] ?? null
                    ];
                }

                if (!empty($infusionData)) {
                    $insertBatchInfusionResult = $recoveryModel->insertBatch($infusionData);

                    if (!$insertBatchInfusionResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery Infusion. failed: ' . $error['message']);
                    }
                }
            }

            if (isset($formData['regional']) && is_array($formData['regional'])) {

                $documentIds = array_column($formData['regional'], 'document_id');


                if (!empty($documentIds)) {
                    $recoveryModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS033')->delete();
                }

                $regionalData = [];
                foreach ($formData['regional'] as $regional) {
                    $observationDate = isset($regional['observation_date']) ? str_replace('T', ' ', $regional['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $regionalData[] = [
                        'org_unit_code' => $regional['org_unit_code'] ?? null,
                        'visit_id' => $regional['visit_id'] ?? null,
                        'trans_id' => $regional['trans_id'] ?? null,
                        'body_id' => $regional['body_id'] ?? null,
                        'document_id' => $regional['document_id'] ?? null,
                        'p_type' => $regional['p_type'] ?? null,
                        'parameter_id' => $regional['parameter_id'] ?? null,
                        'value_score' => $regional['value_score'] ?? null,
                        'value_desc' => $regional['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $regional['value_id'] ?? null
                    ];
                }



                if (!empty($regionalData)) {
                    $insertBatchRegionalResult = $recoveryModel->insertBatch($regionalData);

                    if (!$insertBatchRegionalResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery Regional Anestesia failed: ' . $error['message']);
                    }
                }
            }

            if (isset($formData['general']) && is_array($formData['general'])) {

                $documentIds = array_column($formData['general'], 'document_id');


                if (!empty($documentIds)) {
                    $recoveryModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS030')->delete();
                }

                $generalData = [];
                foreach ($formData['general'] as $general) {
                    $observationDate = isset($general['observation_date']) ? str_replace('T', ' ', $general['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $generalData[] = [
                        'org_unit_code' => $general['org_unit_code'] ?? null,
                        'visit_id' => $general['visit_id'] ?? null,
                        'trans_id' => $general['trans_id'] ?? null,
                        'body_id' => $general['body_id'] ?? null,
                        'document_id' => $general['document_id'] ?? null,
                        'p_type' => $general['p_type'] ?? null,
                        'parameter_id' => $general['parameter_id'] ?? null,
                        'value_score' => $general['value_score'] ?? null,
                        'value_desc' => $general['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $general['value_id'] ?? null
                    ];
                }



                if (!empty($generalData)) {
                    $insertBatchGeneralResult = $recoveryModel->insertBatch($generalData);

                    if (!$insertBatchGeneralResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery General Anestesia failed: ' . $error['message']);
                    }
                }
            }
            if (isset($formData['ventilasi']) && is_array($formData['ventilasi'])) {

                $documentIds = array_column($formData['ventilasi'], 'document_id');


                if (!empty($documentIds)) {
                    $recoveryModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS031')->delete();
                }

                $ventilasiData = [];
                foreach ($formData['ventilasi'] as $ventilasi) {
                    $observationDate = isset($ventilasi['observation_date']) ? str_replace('T', ' ', $ventilasi['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $ventilasiData[] = [
                        'org_unit_code' => $ventilasi['org_unit_code'] ?? null,
                        'visit_id' => $ventilasi['visit_id'] ?? null,
                        'trans_id' => $ventilasi['trans_id'] ?? null,
                        'body_id' => $ventilasi['body_id'] ?? null,
                        'document_id' => $ventilasi['document_id'] ?? null,
                        'p_type' => $ventilasi['p_type'] ?? null,
                        'parameter_id' => $ventilasi['parameter_id'] ?? null,
                        'value_score' => $ventilasi['value_score'] ?? null,
                        'value_desc' => $ventilasi['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $ventilasi['value_id'] ?? null
                    ];
                }



                if (!empty($ventilasiData)) {
                    $insertBatchVentilasiResult = $recoveryModel->insertBatch($ventilasiData);

                    if (!$insertBatchVentilasiResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery Ventilasi Anestesia failed: ' . $error['message']);
                    }
                }
            }
            if (isset($formData['jalan_napas']) && is_array($formData['jalan_napas'])) {

                $documentIds = array_column($formData['jalan_napas'], 'document_id');


                if (!empty($documentIds)) {
                    $recoveryModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS032')->delete();
                }

                $jalanNapasData = [];
                foreach ($formData['jalan_napas'] as $jalan_napas) {
                    $observationDate = isset($jalan_napas['observation_date']) ? str_replace('T', ' ', $jalan_napas['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $jalanNapasData[] = [
                        'org_unit_code' => $jalan_napas['org_unit_code'] ?? null,
                        'visit_id' => $jalan_napas['visit_id'] ?? null,
                        'trans_id' => $jalan_napas['trans_id'] ?? null,
                        'body_id' => $jalan_napas['body_id'] ?? null,
                        'document_id' => $jalan_napas['document_id'] ?? null,
                        'p_type' => $jalan_napas['p_type'] ?? null,
                        'parameter_id' => $jalan_napas['parameter_id'] ?? null,
                        'value_score' => $jalan_napas['value_score'] ?? null,
                        'value_desc' => $jalan_napas['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $jalan_napas['value_id'] ?? null
                    ];
                }



                if (!empty($jalanNapasData)) {
                    $insertBatchJalanNapasResult = $recoveryModel->insertBatch($jalanNapasData);

                    if (!$insertBatchJalanNapasResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery Jalan Napas Anestesia failed: ' . $error['message']);
                    }
                }
            }

            $anesthesiaRecoveryModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['bromage']) && is_array($formData['bromage'])) {

                $anesthesiaRecoveryModel->where('document_id', $data['document_id'])->where('p_type', 'OPRS024')->delete();

                foreach ($formData['bromage'] as $bromage) {
                    $dataBromage = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'visit_id' => $formData['visit_id'] ?? null,
                        'trans_id' => $formData['trans_id'] ?? null,
                        'document_id' => $formData['document_id'] ?? null,
                        'body_id' => $this->get_bodyid(),  // Custom method to get body_id
                        'p_type' => $bromage['p_type'] ?? null,
                        'parameter_id' => $bromage['parameter_id'] ?? null,
                        'value_score' => $bromage['value_score'] ?? null,
                        'value_desc' => $bromage['value_desc'] ?? null,
                        'observation_date' => date('Y-m-d H:i:s'),
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,  // Assumes user() returns an object with a username property
                        'value_id' => $bromage['value_id'] ?? null
                    ];

                    $anesthesiaRecoveryModel->insert($dataBromage);
                    if (!$anesthesiaRecoveryModel) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery bromage failed: ' . $error['message']);
                    }
                }
            }
            $stewardModel = new AssessmentAnesthesiaRecoveryModel();

            if (isset($formData['steward']) && is_array($formData['steward'])) {

                $documentIds = array_column($formData['steward'], 'document_id');


                if (!empty($documentIds)) {
                    $stewardModel->whereIn('document_id', $documentIds)->where('p_type', 'OPRS025')->delete();
                }

                $stewardData = [];
                foreach ($formData['steward'] as $steward) {
                    $observationDate = isset($steward['observation_date']) ? str_replace('T', ' ', $steward['observation_date']) : null;
                    $observationDate = $observationDate ? date('Y-m-d H:i:s', strtotime($observationDate)) : null;

                    $stewardData[] = [
                        'org_unit_code' => $steward['org_unit_code'] ?? null,
                        'visit_id' => $steward['visit_id'] ?? null,
                        'trans_id' => $steward['trans_id'] ?? null,
                        'body_id' => $steward['body_id'] ?? null,
                        'document_id' => $steward['document_id'] ?? null,
                        'p_type' => $steward['p_type'] ?? null,
                        'parameter_id' => $steward['parameter_id'] ?? null,
                        'value_score' => $steward['value_score'] ?? null,
                        'value_desc' => $steward['value_desc'] ?? null,
                        'observation_date' => $observationDate,
                        'modified_date' => date('Y-m-d H:i:s'),
                        'modified_by' => user()->username,
                        'value_id' => $steward['value_id'] ?? null
                    ];
                }



                if (!empty($stewardData)) {
                    $insertBatchStewardResult = $stewardModel->insertBatch($stewardData);

                    if (!$insertBatchStewardResult) {
                        $error = $db->error();
                        throw new \Exception('Insert AssessmentAnesthesiaRecovery steward failed: ' . $error['message']);
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                $error = $db->error();
                log_message('error', 'Transaction failed: ' . $error['message']);
                throw new Exception('Transaction failed: ' . $error['message']);
            }

            return $this->response->setJSON(['message' => $message ?? 'Operation completed.', 'respon' => true, 'data' => $data]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Transaction failed: ' . $e->getMessage());
            return $this->response->setJSON(['message' => $e->getMessage(), 'respon' => false]);
        }
    }
    // new 02/08


    public function insertAssessmentPostOperasi()
    {
        $model = new AssessmentOperationPostModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();
        $date = date("Y-m-d H:i:s");
        $query = $db->query("SELECT * FROM ASSESSMENT_OPERATION_POST WHERE document_id='" . $formData['document_id'] . "' ")->getNumRows();

        $data = [];

        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == '')) {
                $data[strtolower($key)] = $value;
            }
        }

        foreach ($formData as &$filter) {
            if (empty($filter)) {
                $filter = null;
            }
        }


        // Ensure all required keys are set in $data with null if missing
        $requiredKeys = [
            'org_unit_code',
            'visit_id',
            'trans_id',
            'body_id',
            'document_id',
            'examination_date',
            'modified_by',
            'modified_date',
            'infusion',
            'transfusion',
            'fasting_until',
            'drink_little',
            'free_drink',
            'eat',
            'drain_every',
            'dc_every',
            'maag_tube',
            'position',
            'instruction',
        ];

        foreach ($requiredKeys as $key) {
            if (!isset($formData[$key])) {
                $data[$key] = null;
            } else {
                $data[$key] = $formData[$key];
            }
        }

        // var_dump($data);
        $data['examination_date'] = $date;
        $data['modified_date'] = $date;
        $data['modified_by'] = user()->username;


        if ($query > 0) {
            $model->where(['document_id' => $data['document_id']])
                ->set($data)
                ->update();
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
    }



    public function getDataLaporanAssessmentAnestesi()
    {
        $formData = $this->request->getJSON();

        $model = new AssessmentAnesthesiaModel();

        $data = $this->lowerKey($model->where('document_id', $formData->document_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getDataDrain()
    {
        $formData = $this->request->getJSON();

        $model = new AssessmentOperationDrainModel();

        $data = $this->lowerKey($model->where('document_id', $formData->document_id)
            ->findAll());

        return $this->response->setJSON($data);
    }


    public function getDataVitailSignRangeAnesthesia()
    {
        $formData = $this->request->getJSON();

        $anesthesiaModel = new AssessmentAnesthesiaModel();
        $examinationDetailModel = new ExaminationDetailModel();

        $anesthesiaData = $anesthesiaModel->where('document_id', $formData->document_id)->first();

        if (empty($anesthesiaData)) {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }

        $anesthesiaData = $this->lowerKey($anesthesiaData);
        // $startAnesthesia = $anesthesiaData['start_anesthesia'];
        // $endAnesthesia = $anesthesiaData['end_anesthesia'];

        $startAnesthesia = !empty($anesthesiaData['start_anesthesia']) ? date('Y-m-d', strtotime($anesthesiaData['start_anesthesia'])) . ' 00:01:00' : date('Y-m-d') . ' 00:00:01';
        $endAnesthesia = !empty($anesthesiaData['end_anesthesia']) ? date('Y-m-d', strtotime($anesthesiaData['end_anesthesia'])) . ' 23:59:59' : date('Y-m-d') . ' 23:59:59';


        $visitId = $anesthesiaData['visit_id'];

        $examinationQuery = $examinationDetailModel->where('visit_id', $visitId)
            ->groupStart()
            ->where('document_id', $anesthesiaData['body_id'])
            ->orWhere('document_id', $formData->document_id)
            ->groupEnd()
            ->where('clinic_id', 'P002')
            ->where('modified_date >=', $startAnesthesia)
            ->where('modified_date <=', $endAnesthesia);

        if (isset($formData->filter) && !empty($formData->filter)) {
            $filter = strtolower($formData->filter);
            if ($filter === 'all') {
                $examinationQuery->where('account_id >=', 10)
                    ->where('account_id <=', 12);
            } else {
                $examinationQuery->where('account_id', $formData->filter);
            }
        }

        $examinationData = $examinationQuery->findAll();
        if (!empty($examinationData)) {
            $examinationData = $this->lowerKey($examinationData);
        } else {
            $examinationData = [];
        }

        $responseData = [
            'assessment_anesthesia' => [
                'start_anesthesia' => $startAnesthesia,
                'end_anesthesia' => $endAnesthesia,
                'document_id' => $anesthesiaData['document_id']
            ],
            'examination_info' => $examinationData
        ];

        if (!empty($examinationData)) {
            return $this->response->setJSON(['message' => 'Data found.', 'respon' => true, 'data' => $responseData]);
        } else {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false, 'data' => $responseData]);
        }
    } //new 02/08


    public function getExaminationData()
    {
        $request = $this->request->getJSON();

        if (empty($request->pasien_diagnosa_id)) {
            return $this->response->setJSON(['message' => 'Pasien Diagnosa ID is required.', 'respon' => false]);
        }

        $accountIds = isset($request->account_ids) ? (array)$request->account_ids : [];

        if (empty($accountIds)) {
            return $this->response->setJSON(['message' => 'Account IDs are required.', 'respon' => false]);
        }

        $examinationModel = new ExaminationModel();


        $query = $examinationModel->where('pasien_diagnosa_id', $request->pasien_diagnosa_id);
        if (!empty($accountIds)) {
            $query->whereIn('account_id', $accountIds);
        }

        $examinationData = $this->lowerKey($query->findAll());

        if ($examinationData) {
            return $this->response->setJSON(['message' => 'Data found.', 'respon' => true, 'data' => $examinationData]);
        } else {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }
    }

    public function getDiagnosassDockterData()
    {
        $request =  $this->request->getJSON();

        if (empty($request->pasien_diagnosa_id)) {
            return $this->response->setJSON(['message' => 'Pasien Diagnosa ID is required.', 'respon' => false]);
        }

        $model = new PasienDiagnosasModel();
        $data = $this->lowerKey($model->where('pasien_diagnosa_id', $request->pasien_diagnosa_id)->findAll());

        if ($data) {
            return $this->response->setJSON(['message' => 'Data found.', 'respon' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }
    } // new 29/07
    public function getDiagnosassPerawatData()
    {
        $request =  $this->request->getJSON();

        if (empty($request->document_id)) {
            return $this->response->setJSON(['message' => 'Pasien Diagnosa ID is required.', 'respon' => false]);
        }

        $model = new PasienDiagnosaPerawatModel();
        $data = $this->lowerKey($model->where('document_id', $request->document_id)
            ->where('visit_id', $request->visit_id)->findAll());

        if ($data) {
            $diagnosaModel = new PasienDiagnosasPerawatModel();
            foreach ($data as &$item) {
                $item['diagnosa'] = $this->lowerKey($diagnosaModel->where('body_id', $item['body_id'])->findAll());
            }

            return $this->response->setJSON(['message' => 'Data found.', 'respon' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }
    } // new update 30/07


    public function getDataColumnName()
    {

        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->id)) {

            return $this->response->setJSON([]);
        }


        $sql = "SELECT $formData->column_name FROM $formData->table_name WHERE $formData->column_id = '" . $formData->id . "' ";

        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($results);
    }

    public function getDataTreatmentObat()
    {
        $request = $this->request->getJSON();

        if (empty($request->visit_id)) {
            return $this->response->setJSON(['message' => 'Visit ID is required.', 'respon' => false]);
        }

        $db = db_connect();

        // Query for TREATMENT_OBAT
        $sqlTreatment = "SELECT treat_date, DESCRIPTION, QUANTITY FROM TREATMENT_OBAT WHERE visit_id = ?";
        $queryTreatment = $db->query($sqlTreatment, [$request->visit_id]);
        $treatmentData = $this->lowerKey($queryTreatment->getResultArray());

        // Query for BLOOD_REQUEST with join to BLOOD_USAGE_TYPE
        $sqlBloodRequest = "
            SELECT br.*, but.usagetype AS usageType
            FROM BLOOD_REQUEST br
            LEFT JOIN BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
            WHERE br.visit_id = ?
        ";
        $queryBloodRequest = $db->query($sqlBloodRequest, [$request->visit_id]);
        $bloodRequestData = $this->lowerKey($queryBloodRequest->getResultArray());

        // Combine data from both queries
        $data = [
            'treatment' => $treatmentData,
            'blood_request' => $bloodRequestData
        ];

        if (!empty($treatmentData) || !empty($bloodRequestData)) {
            return $this->response->setJSON(['message' => 'Data found.', 'respon' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }
    } // new 31/07


    public function getTreatment()
    {

        $db = db_connect();

        $sql = "SELECT
                C.NAME_OF_CLASS,
                T.TREATMENT,
                tt.tarif_id,
                tt.TARIF_NAME,
                tt.AMOUNT_PAID,
                tt.TREAT_ID as operation_type
            FROM
                treat_tarif tt,
                treatment t,
                CLASS C
            WHERE
                LEFT(tt.treat_id, 2) = '13'
                AND PERDA_ID = 1
                AND TT.TREAT_ID = T.TREAT_ID
                AND C.CLASS_ID = TT.CLASS_ID
            ORDER BY
                C.NAME_OF_CLASS,
                T.TREATMENT";

        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());

        $oprasi_type_tarif = $this->lowerKey($db->query("SELECT OPERATION_TYPE,OPERATION as id,OPERATION as text  FROM OPERATION_TYPE")->getResultArray());


        return $this->response->setJSON(
            [
                'bill_id' => $results,
                'tarif_id' => $oprasi_type_tarif
            ]
        );
    }

    public function getDetail()
    {
        $formData = $this->request->getJSON();

        $model = new PatientOperationRequestModel();

        $data = $this->lowerKey($model->where('visit_id', $formData->visit_id)
            ->where('NO_REGISTRATION', $formData->no_registration)
            ->where('vactination_id', $formData->vactination_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getExaminfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];
        $no_registration = $body['nomor'];
        $account_id = $body['account_id'];

        $db = db_connect();
        $selectex = $this->lowerKey($db->query("
        select ex.*, 
        c.name_of_clinic, 
        '' as fullname,
        gcs.GCS_DESC
        from examination_detail ex 
        left join clinic c on ex.clinic_id = c.clinic_id 
        left outer join ASSESSMENT_GCS gcs on ex.BODY_ID = gcs.DOCUMENT_ID
        where ex.no_registration = '$no_registration' and ex.visit_id = '$visit_id' and ex.vs_status_id IN(1,4,5,10) and ex.account_id = '$account_id'
        order by examination_date desc
        ")->getResultArray()); // new 30/07


        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = '$no_registration' ")->getResultArray());

        return $this->response->setJSON([
            'examInfo' => $selectex,
            'pasienHistory' => $selecthistory,
        ]);
    }

    private function formatDateString($dateString)
    {
        // Define possible formats
        $formats = ['d/m/Y H:i', 'Y-m-d H:i', 'd-m-Y H:i', 'm/d/Y H:i'];

        // Attempt to parse the date with each format
        $date = null;
        foreach ($formats as $format) {
            $date = DateTime::createFromFormat($format, $dateString);
            if ($date !== false) {
                break; // Exit loop once a valid date is found
            }
        }

        // If parsing was successful, return the formatted date
        if ($date) {
            return $date->format('Y-m-d H:i');
        } else {
            // If no valid date was found, return an error message or false
            return false; // Or you can return "Invalid date format" or handle the error as needed
        }
    }
    private function convertToDateFormat($date)
    {
        // Try to create a DateTime object using different possible formats
        $formats = [
            'Y-m-d H:i',    // e.g., 2024-12-17 07:00
            'd/m/Y H:i',    // e.g., 18/12/2024 07:00
            'd-m-Y H:i'     // e.g., 18-12-2024 07:00
        ];

        // Try each format to convert the date
        foreach ($formats as $format) {
            $dateTime = \DateTime::createFromFormat($format, $date);
            if ($dateTime) {
                // Convert to the desired format
                return $dateTime->format('d-m-Y H:i:s');
            }
        }

        // If no format matches, return the original value or handle errors as needed
        return $date;
    }
}
