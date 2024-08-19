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
use App\Models\ExaminationModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\RawSql;
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
        $bloodRequestData = [];

        $getDataInstrumenModel = new AssessmentInstrumentModel();
        $getDataPatientOperationCheckModel = new PatientOperationCheck();
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
        $dataAldrete = $this->lowerKey($db->query("
          SELECT
              BODY_ID, OBSERVATION_DATE,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_02,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_02,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_02,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_04,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_04,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_04,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_04,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_05,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_05,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_05,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_05
          FROM ASSESSMENT_ANESTHESIA_RECOVERY
          INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
          INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
          WHERE DOCUMENT_ID = '" . $formData->id . "'
          AND ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'OPRS023'
          GROUP BY BODY_ID, OBSERVATION_DATE;
      ")->getResultArray()); // NEW 07/08

        $dataSteward = $this->lowerKey($db->query("
          SELECT
              BODY_ID, OBSERVATION_DATE,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_01,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_02,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_02,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_02,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_03,
              MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03
          FROM ASSESSMENT_ANESTHESIA_RECOVERY
          INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
          INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
          WHERE DOCUMENT_ID = '" . $formData->id . "'
          AND ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'OPRS025'
          GROUP BY BODY_ID, OBSERVATION_DATE;
      ")->getResultArray()); // NEW 08/08

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
        $dataBromage = $this->lowerKey($dataBromage); // new 07/08
        $dataAldrete = $this->lowerKey($dataAldrete); // new 07/08
        $dataSteward = $this->lowerKey($dataSteward); // new 07/08

        if (!empty($formData->visit_id)) {
            $sqlTreatment = "
                SELECT TREATMENT_OBAT.BRAND_ID, TREATMENT_OBAT.treat_date, goods.name, TREATMENT_OBAT.QUANTITY, goods.isalkes 
                FROM TREATMENT_OBAT 
                INNER JOIN goods ON TREATMENT_OBAT.BRAND_ID = goods.BRAND_ID 
                WHERE TREATMENT_OBAT.CLINIC_ID = 'P002' 
                AND TREATMENT_OBAT.visit_id = ?
            ";
            $queryTreatment = $db->query($sqlTreatment, [$formData->visit_id]);
            $treatmentData = $this->lowerKey($queryTreatment->getResultArray());

            $sqlBloodRequest = "
                SELECT br.*, but.usagetype AS usageType
                FROM BLOOD_REQUEST br
                LEFT JOIN BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
                WHERE br.visit_id = ?
            ";
            $queryBloodRequest = $db->query($sqlBloodRequest, [$formData->visit_id]);
            $bloodRequestData = $this->lowerKey($queryBloodRequest->getResultArray());
        }


        $responseData = [
            'assessment_instrument' => $dataInstrumen,
            'assessment_operation_check' => $dataPatientOperationCheck,
            'assessment_operation' => $dataAssessmentOperation,
            'assessment_anesthesia' => $dataLaporanAssessmentAnestesi,
            'assessment_anesthesia_checklist' => $dataAssessmentAnestesi,
            'operation_team' => $dataTim,
            'operation_task' => $dataDropdowntempAll,
            'assessment_operation_drain' => $dataDrai,
            'TreatmentObat' => [
                'treatment' => $treatmentData,
                'blood_request' => $bloodRequestData
            ],
            'assessment_anesthesia_post' => $dataAssessmentAnesthesiaPost,
            'assessment_anesthesia_recovery' => ['bromage' => $dataBromage, 'aldrete' => $dataAldrete, 'steward' => $dataSteward],
            'assessment_anesthesia_recovery_bromage' => $dataBromage, //new 07/08
            'assessment_anesthesia_recovery_aldrete' => $dataAldrete, //new 07/08
            'assessment_anesthesia_recovery_steward' => $dataSteward //new 07/08

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

        $end_operation = null;

        if (isset($formData['end_operation']) && !empty($formData['end_operation'])) {
            $end_operation = date('Y-m-d\TH:i:s', strtotime($formData['end_operation']));
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
            'end_operation' =>  $end_operation,
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
        // echo '<pre>';
        // var_dump($formData);
        // die();
        $data = [];
        foreach ($formData as $key => $value) {
            if (!is_array($value) && $value !== null && $value !== '') {
                $data[strtolower($key)] = $value;
            }
        }

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
                    throw new \Exception('Failed to update AssessmentOperation.');
                }
            } else {
                $data['body_id'] = $this->get_bodyid();
                $insertResult = $model->insert($data);

                if (!$insertResult) {
                    throw new \Exception('Failed to insert AssessmentOperation.');
                }
            }

            // Process AssessmentInstrument
            $instrumenModel = new AssessmentInstrumentModel();
            if (isset($formData['instrumen']) && is_array($formData['instrumen'])) {
                $instrumenModel->where('body_id', $formData['body_id_instrument'] ?? '')->delete();
                $instrumenData = [];
                foreach ($formData['instrumen'] as $instrumen) {
                    $instrumenData[] = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'visit_id' => $formData['visit_id'] ?? null,
                        'trans_id' => $formData['trans_id'] ?? null,
                        'body_id' => $formData['body_id_instrument'] ?? null,
                        'document_id' => $formData['document_id'] ?? null,
                        'examination_date' => date("Y-m-d H:i:s"),
                        'modified_by' => user()->username,
                        'modified_date' => date("Y-m-d H:i:s"),
                        'brand_id' => $instrumen['brand_id'] ?? null,
                        'brand_name' => $instrumen['brand_name'] ?? null,
                        'quantity_before' => $instrumen['quantity_before'] ?? null,
                        'quantity_after' => $instrumen['quantity_after'] ?? null,
                        'quantity_intra' => $instrumen['quantity_intra'] ?? null,
                        'quantity_additional' => $instrumen['quantity_additional'] ?? null
                    ];
                }
                if (!empty($instrumenData)) {
                    $insertBatchResult = $instrumenModel->insertBatch($instrumenData);

                    if (!$insertBatchResult) {
                        throw new \Exception('Failed to insert batch of AssessmentInstrument.');
                    }
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
                throw new \Exception('Failed to insert PasienDiagnosaPerawat.');
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
                        throw new \Exception('Failed to insert PasienDiagnosasPerawat.');
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
                        throw new \Exception('Failed to insert batch of AssessmentOperationDrain.');
                    }
                }
            }

            // Process Examination
            $examinationModel = new ExaminationModel();
            if (isset($formData['vitailsign']) && is_array($formData['vitailsign'])) {
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

                if (isset($vitalsignData['pasien_diagnosa_id'])) {
                    $existingVitalsignEntry = $examinationModel->where('pasien_diagnosa_id', $vitalsignData['pasien_diagnosa_id'])->where('account_id', '10')->first();

                    if (!empty($existingVitalsignEntry)) {
                        $updateVitalsignResult = $examinationModel->where('pasien_diagnosa_id', $vitalsignData['pasien_diagnosa_id'])
                            ->set($vitalsignData)
                            ->update();

                        if (!$updateVitalsignResult) {
                            throw new \Exception('Failed to update Examination.');
                        }
                    } else {
                        $vitalsignData['body_id'] = $this->get_bodyid();
                        $insertVitalsignResult = $examinationModel->insert($vitalsignData);

                        if (!$insertVitalsignResult) {
                            throw new \Exception('Failed to insert Examination.');
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
                        throw new \Exception('Failed to insert batch of AssessmentAnesthesiaRecovery Aldrete.');
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
                        throw new \Exception('Failed to insert batch of AssessmentAnesthesiaRecovery.');
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
            'isallergy',
            'breathing_dificulty',
            'blood_loss_risk',
            'signin_time',
            'introducing_onself',
            'patient_identity',
            'timeout_procedure',
            'iniscion_location',
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
            'timeout_time',
            'procedure_name',
            'instrument',
            'speciment',
            'isproblematic_tools',
            'main_problem',
            'signout_time'
        ];

        $data = [];
        foreach ($requiredKeys as $key) {
            $data[$key] = !empty($formData[$key]) ? $formData[$key] : null;
        }

        $data['examination_date'] = $data['modified_date'] = $date;
        $data['modified_by'] = user()->username;

        // Convert date-time format
        foreach (['signin_time', 'timeout_time', 'signout_time'] as $timeField) {
            if (!empty($data[$timeField])) {
                $data[$timeField] = str_replace("T", " ", $data[$timeField]);
            }
        }

        // Database transaction
        $db->transStart();
        try {
            // Update or insert data in PatientOperationCheck
            if ($db->table('ASSESSMENT_OPERATION_CHECK')->where('document_id', $data['document_id'])->countAllResults() > 0) {
                $patientOperationCheckModel->update($data['document_id'], $data);
            } else {
                $patientOperationCheckModel->insert($data);
            }

            // Handle instrumen data
            if (isset($formData['instrumen']) && is_array($formData['instrumen'])) {
                $instrumenModel->where('document_id', $data['document_id'])->delete();
                foreach ($formData['instrumen'] as $instrumen) {
                    $dataInstrumen = [
                        'org_unit_code' => $data['org_unit_code'],
                        'visit_id' => $data['visit_id'],
                        'trans_id' => $data['trans_id'],
                        'document_id' => $data['document_id'],
                        'body_id' => $instrumen['body_id'],
                        'examination_date' => $date,
                        'modified_by' => $data['modified_by'],
                        'modified_date' => $date,
                        'brand_id' => $instrumen['brand_id'],
                        'brand_name' => $instrumen['brand_name'],
                        'quantity_before' => $instrumen['quantity_before']
                    ];
                    $instrumenModel->insert($dataInstrumen);
                }
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
    } // new update 29/7

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
            // 'circuit_leakage' => $formData['circuit_leakage'],
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
            $data['start_operation'] = date('Y-m-d H:i:s', strtotime($data['start_operation']));
        }
        if (isset($data['end_operation'])) {
            $data['end_operation'] = date('Y-m-d H:i:s', strtotime($data['end_operation']));
        }
        if (isset($data['modified_date'])) {
            $data['modified_date'] = date('Y-m-d H:i:s', strtotime($data['modified_date']));
        }
        if (isset($data['patologi_date'])) {
            $data['patologi_date'] = date('Y-m-d H:i:s', strtotime($data['patologi_date']));
        }



        $existingRecord = $model->where('vactination_id', $data['vactination_id'])->first();

        if ($existingRecord) {

            $model->update($data['vactination_id'], $data);
        } else {

            $model->insert($data);
        }

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
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
                    $filepath = WRITEPATH . 'uploads/signatures/' . $value['value_detail'];
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
                $lokalisPath = WRITEPATH . 'uploads/signatures/';
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
            $bloodmodel->where('document_id', $body_id)->delete();

            foreach ($bloodblood_request as $key => $value) {
                $datablood = [
                    'org_unit_code' => $bloodorg_unit_code[$key],
                    'blood_request' => $bloodblood_request[$key],
                    'no_registration' => '021732',
                    'visit_id' => $bloodvisit_id[$key],
                    'trans_id' => $bloodtrans_id[$key],
                    'document_id' => $body_id,
                    'request_date' => $bloodrequest_date[$key],
                    'blood_usage_type' => $bloodblood_usage_type[$key],
                    'blood_quantity' => $bloodblood_quantity[$key],
                    'measure_id' => $bloodmeasure_id[$key],
                    'descriptions' => $blooddescriptions[$key]
                ];
                $bloodmodel->insert($datablood);
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

            if (isset($formData['vitailsign']) && is_array($formData['vitailsign']) && !empty($formData['vitailsign'])) {
                $examinationModel = new ExaminationModel();

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

                    if (isset($vitalsignData['pasien_diagnosa_id'])) {
                        $existingVitalsignEntry = $examinationModel->where('pasien_diagnosa_id', $vitalsignData['pasien_diagnosa_id'])->first();
                        // echo '<pre>';
                        // var_dump($existingVitalsignEntry);
                        // die();
                        $vitalsignData['body_id'] = $existingVitalsignEntry['BODY_ID'];
                        if (!empty($existingVitalsignEntry)) {
                            $examinationModel->where('body_id', $existingVitalsignEntry['BODY_ID'])
                                ->set($vitalsignData)
                                ->update();
                        } else {
                            $vitalsignData['body_id'] = $this->get_bodyid();
                            $examinationModel->insert($vitalsignData);
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
                            'diagnosa_id' => $diagnosis['diag_id'],
                            'diagnosa_name' => $diagnosis['diag_name'],
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
            $data['start_operation'] = date('Y-m-d H:i:s', strtotime($data['start_operation']));
        }
        if (isset($data['end_operation'])) {
            $data['end_operation'] = date('Y-m-d H:i:s', strtotime($data['end_operation']));
        }

        if (isset($data['modified_date'])) {
            $data['modified_date'] = date('Y-m-d H:i:s', strtotime($data['modified_date']));
        }
        if (isset($data['start_anesthesia'])) {
            $data['start_anesthesia'] = date('Y-m-d H:i:s', strtotime($data['start_anesthesia']));
        }
        if (isset($data['end_anesthesia'])) {
            $data['end_anesthesia'] = date('Y-m-d H:i:s', strtotime($data['end_anesthesia']));
        }

        $db = db_connect();
        $db->transStart();

        try {
            // Uncomment and test if necessary
            $model = new AssessmentAnesthesiaModel();
            $existingRecord = $model->where('document_id', $data['document_id'])->first();

            if ($existingRecord) {
                $data['body_id'] = $existingRecord['BODY_ID'];
                $result = $model->where(['body_id' => $existingRecord['BODY_ID']])
                    ->set($data)
                    ->update();
                if (!$result) throw new Exception('Failed to update main record.');
                $message = 'Data updated successfully.';
            } else {
                $data['body_id'] = $this->get_bodyid();
                $result = $model->insert($data);
            }

            if (isset($formData['vitailsign']) && is_array($formData['vitailsign']) && !empty($formData['vitailsign'])) {
                $examinationModel = new ExaminationModel();
                $vitalsignData = [];
                foreach ($formData['vitailsign'] as $key => $value) {
                    if ($key === 'examination_date') {
                        $vitalsignData[strtolower($key)] = date('Y-m-d\TH:i:s', strtotime($value));
                    } else {
                        $vitalsignData[strtolower($key)] = $value;
                    }
                }
                $vitalsignData['pasien_diagnosa_id'] = $data['body_id'];
                $vitalsignData['account_id'] = '12';
                $vitalsignData['modified_by'] = user()->username;
                $vitalsignData['modified_date'] = date("Y-m-d H:i:s");
                $vitalsignData['examination_date'] = date("Y-m-d H:i:s");

                if (isset($vitalsignData['pasien_diagnosa_id'])) {
                    $existingVitalsignEntry = $examinationModel->where('pasien_diagnosa_id', $vitalsignData['pasien_diagnosa_id'])->where('account_id', '12')->first();

                    if (!empty($existingVitalsignEntry)) {

                        $vitalsignData['body_id'] = $existingVitalsignEntry['BODY_ID'];
                        $ex = $examinationModel->where('body_id', $existingVitalsignEntry['BODY_ID'])
                            ->set($vitalsignData)
                            ->update();
                        // if (!$ex) {
                        //     $dbError = $examinationModel->error(); // Get the error information
                        //     echo '<pre>';
                        //     var_dump($dbError); // Display the error details
                        //     die();
                        // }
                    } else {
                        $vitalsignData['body_id'] = $this->get_bodyid();
                        $examinationModel->insert($vitalsignData);
                    }
                } else {
                    throw new \Exception('Body ID is required.');
                }
            }

            if (isset($formData['vitailsign2']) && is_array($formData['vitailsign2']) && !empty($formData['vitailsign2'])) {
                $examinationModel = new ExaminationModel();
                $vitalsignData2 = [];
                foreach ($formData['vitailsign2'] as $key => $value) {
                    // Remove the number 2 from the key names
                    $newKey = str_replace('2', '', strtolower($key));

                    if ($newKey === 'examination_date') {
                        $vitalsignData2[$newKey] = date('Y-m-d\TH:i:s', strtotime($value));
                    } else {
                        $vitalsignData2[$newKey] = $value;
                    }
                }
                $vitalsignData2['pasien_diagnosa_id'] = $data['body_id'];
                $vitalsignData2['account_id'] = '13';
                $vitalsignData2['modified_by'] = user()->username;
                $vitalsignData2['modified_date'] = date("Y-m-d H:i:s");
                $vitalsignData2['examination_date'] = date("Y-m-d H:i:s");

                if (isset($vitalsignData2['pasien_diagnosa_id'])) {
                    $existingVitalsignEntry2 = $examinationModel->where('pasien_diagnosa_id', $vitalsignData2['pasien_diagnosa_id'])->where('account_id', '13')->first();

                    if (!empty($existingVitalsignEntry2)) {

                        $vitalsignData2['body_id'] = $existingVitalsignEntry2['BODY_ID'];
                        $ex = $examinationModel->where('body_id', $existingVitalsignEntry2['BODY_ID'])
                            ->set($vitalsignData2)
                            ->update();

                        // if (!$ex) {
                        //     $dbError = $examinationModel->error(); // Get the error information
                        //     echo '<pre>';
                        //     var_dump($dbError); // Display the error details
                        //     die();
                        // }
                    } else {
                        $vitalsignData2['body_id'] = $this->get_bodyid();
                        $examinationModel->insert($vitalsignData2);
                    }
                } else {
                    throw new \Exception('Body ID is required.');
                }
            }

            // Uncomment and test if necessary
            if (isset($formData['diagnosa']) && is_array($formData['diagnosa'])) {

                $pds = new PasienDiagnosasModel();
                $pds->where('pasien_diagnosa_id', $formData['body_id'])->delete();
                $diagnosaData = [];
                foreach ($formData['diagnosa'] as $diagnosis) {
                    if (is_array($diagnosis) && isset($diagnosis['pasien_diagnosa_id'])) {
                        $diagnosaData[] = [
                            'pasien_diagnosa_id' => $diagnosis['pasien_diagnosa_id'],
                            'diagnosa_id' => $diagnosis['diag_id'],
                            'diagnosa_name' => $diagnosis['diag_name'],
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
                $anesthesiaPost['modified_by'] = $data['modified_by'];
                $anesthesiaPost['modified_date'] = date("Y-m-d H:i:s");
                $anesthesiaPost['examination_date'] = date("Y-m-d H:i:s");


                if (!empty($existingAnesthesiaPost)) {

                    $anesthesiaPost['body_id'] = $existingAnesthesiaPost['BODY_ID'];
                    $ex = $anesthesiaPostModel->where('body_id', $existingAnesthesiaPost['BODY_ID'])
                        ->set($anesthesiaPost)
                        ->update();
                } else {
                    $anesthesiaPost['body_id'] = $this->get_bodyid();
                    $ex = $anesthesiaPostModel->insert($anesthesiaPost);
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
                        throw new \Exception('Failed to insert batch of AssessmentAnesthesiaRecovery Aldrete.');
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
                        throw new \Exception('Failed to insert batch of AssessmentAnesthesiaRecovery.');
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
        $examinationModel = new ExaminationModel();

        $anesthesiaData = $anesthesiaModel->where('document_id', $formData->document_id)->first();

        if (empty($anesthesiaData)) {
            return $this->response->setJSON(['message' => 'Data not found.', 'respon' => false]);
        }

        $anesthesiaData = $this->lowerKey($anesthesiaData);
        $startAnesthesia = $anesthesiaData['start_anesthesia'];
        $endAnesthesia = $anesthesiaData['end_anesthesia'];

        if (is_null($startAnesthesia)) {
            $startAnesthesia = date('Y-m-d') . ' 00:01:00';
        }
        if (is_null($endAnesthesia)) {
            $endAnesthesia = date('Y-m-d') . ' 23:59:59';
        }

        $visitId = $anesthesiaData['visit_id'];

        $examinationQuery = $examinationModel->where('visit_id', $visitId)
            ->where('clinic_id', 'P002')
            ->where('examination_date >=', $startAnesthesia)
            ->where('examination_date <=', $endAnesthesia);

        if (isset($formData->filter) && !empty($formData->filter)) {
            $filter = strtolower($formData->filter);
            if ($filter === 'all') {
                $examinationQuery->where('account_id >=', 10)
                    ->where('account_id <=', 15)
                    ->where('account_id !=', 13);
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

        $sql = "SELECT $formData->column_name FROM $formData->table_name WHERE $formData->column_id = '" . $formData->id . "' ";

        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());

        return $this->response->setJSON($results);
    } // new 29/07

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

        return $this->response->setJSON($results);
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
}
