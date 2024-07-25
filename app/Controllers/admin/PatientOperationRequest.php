<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\PatientOperationRequestModel;
use App\Models\OperationTeamModel;
use App\Models\AssessmentOperationModel;
use App\Models\PatientOperationCheck;
use App\Models\AssessmentAnesthesiaChecklist;
use App\Models\AssessmentInstrumentModel;
use APP\Models\AssessmentPraOperasi;
use APP\Models\BloodRequestModel;
use APP\Models\PasienDiagnosasModel;
use APP\Models\LokalisModel;
use APP\Models\AssessmentOperationPostModel;





use CodeIgniter\Controller;

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

        $data = $model->select("
             ORG_UNIT_CODE,
             VISIT_ID,
             VACTINATION_ID,
             PATIENT_CATEGORY_ID,
             NO_REGISTRATION,
             VACTINATION_DATE,
             DESCRIPTION,
             EMPLOYEE_ID,
             doctor,
             anestesi_type,
             MODIFIED_DATE,
             MODIFIED_BY,
             MODIFIED_FROM,
             VALIDATION,
             TERLAYANI,
             DIAGNOSA_DESC,
             THENAME,
             THEADDRESS,
             THEID,
             ISRJ,
             STATUS_PASIEN_ID,
             GENDER,
             AGEYEAR,
             AGEMONTH,
             AGEDAY,
             CLASS_ROOM_ID,
             BED_ID,
             KELUAR_ID,
             ROOMS_ID,
             DIAGNOSA_PRA,
             DIAGNOSA_PASCA,
             START_OPERATION,
             END_OPERATION,
             START_ANESTESI,
             END_ANESTESI,
             RESULT_ID,
             TARIF_ID,
             OPERATION_TYPE,
             clinic_id,
             transaksi,
            CASE
                WHEN  TERLAYANI = '1' THEN 'Proses Operasi' 
                WHEN  TERLAYANI = '2' THEN 'Selesai Operasi' 
                ELSE 'Penjadwalan Operasi' 
            END AS layan,
             clinic_id_from")
            ->where('NO_REGISTRATION', $noRegistration)
            ->where('VISIT_ID', $visitId)
            ->orderBy('VACTINATION_DATE', 'DESC');

        $result = $this->lowerKey($data->findAll());

        return $this->response->setJSON($result);
    }

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

    public function updateData()
    {
        $model = new PatientOperationRequestModel();
        $request = service('request');
        $formData = $request->getJSON(true);

        $vactinationId = $formData['vactination_id-permintaan_operasi'];
        if (!isset($formData['vactination_id-permintaan_operasi'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing vactination_id in request data']);
        }

        $updateData = [
            'trans_id' => $formData['trans_id-permintaan_operasi'],
            'class_room_id' => $formData['class_room_id-permintaan_operasi'],
            'org_unit_code' => $formData['org_unit_code-permintaan_operasi'],
            'visit_id' => $formData['visit_id-permintaan_operasi'],
            'vactination_id' => $vactinationId,
            'no_registration' => $formData['no_registration-permintaan_operasi'],
            'vactination_date' => date('Y-m-d H:i:s', strtotime($formData['vactination_date-permintaan_operasi'])),
            'description' => $formData['description-permintaan_operasi'],
            'employee_id' => $formData['employee_id-permintaan_operasi'],
            'doctor' => $formData['doctor-permintaan_operasi'],
            'anestesi_type' => $formData['anestesi_type-permintaan_operasi'],
            'modified_date' => date('Y-m-d H:i:s', strtotime($formData['modified_date-permintaan_operasi'])),
            'modified_by' => $formData['modified_by-permintaan_operasi'],
            'validation' => $formData['validation-permintaan_operasi'],
            'terlayani' => $formData['terlayani-permintaan_operasi'],
            'thename' => $formData['thename-permintaan_operasi'],
            'theaddress' => $formData['theaddress-permintaan_operasi'],
            'theid' => $formData['theid-permintaan_operasi'],
            'isrj' => $formData['isrj-permintaan_operasi'],
            'status_pasien_id' => $formData['status_pasien_id-permintaan_operasi'],
            'gender' => $formData['gender-permintaan_operasi'],
            'ageyear' => $formData['ageyear-permintaan_operasi'],
            'agemonth' => $formData['agemonth-permintaan_operasi'],
            'ageday' => $formData['ageday-permintaan_operasi'],
            'bed_id' => $formData['bed_id-permintaan_operasi'],
            'keluar_id' => $formData['keluar_id-permintaan_operasi'],
            'diagnosa_pra' => $formData['diagnosa_pra-permintaan_operasi'],
            'diagnosa_pasca' => $formData['diagnosa_pasca-permintaan_operasi'],
            'end_operation' => $formData['end_operation-permintaan_operasi'],
            'start_anestesi' => $formData['start_anestesi-permintaan_operasi'],
            'end_anestesi' => $formData['end_anestesi-permintaan_operasi'],
            'result_id' => $formData['result_id-permintaan_operasi'],
            'clinic_id' => $formData['clinic_id-permintaan_operasi'],
            'clinic_id_from' => $formData['clinic_id_from-permintaan_operasi'],
            'transaksi' => $formData['transaksi-permintaan_operasi'],
            'layan' => $formData['layan-permintaan_operasi'],
            'start_operation' => date('Y-m-d H:i:s', strtotime($formData['start_operation-permintaan_operasi'])),
            'patient_category_id' => $formData['patient_category_id-permintaan_operasi'],
            'tarif_id' => $formData['tarif_id-permintaan_operasi'],
            'diagnosa_desc' => $formData['diagnosa_desc-permintaan_operasi'],
            'operation_type' => $formData['operation_type-permintaan_operasi'],
        ];

        $model->where('vactination_id', $vactinationId)->set($updateData)->update();

        return $this->response->setJSON(['message' => 'Data updated successfully.', 'respon' => true, 'data' => $updateData]);
    }

    public function  insertData()
    {
        $model = new PatientOperationRequestModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $insertData = [
            'trans_id' => $formData['trans_id-permintaan_operasi'],
            'class_room_id' => $formData['class_room_id-permintaan_operasi'],
            'org_unit_code' => $formData['org_unit_code-permintaan_operasi'],
            'visit_id' => $formData['visit_id-permintaan_operasi'],
            'vactination_id' => $formData['vactination_id-permintaan_operasi'],
            'no_registration' => $formData['no_registration-permintaan_operasi'],
            'vactination_date' => date('Y-m-d H:i:s', strtotime($formData['vactination_date-permintaan_operasi'])),
            'description' => $formData['description-permintaan_operasi'],
            'employee_id' => $formData['employee_id-permintaan_operasi'],
            'doctor' => $formData['doctor-permintaan_operasi'],
            'anestesi_type' => $formData['anestesi_type-permintaan_operasi'],
            'modified_date' => date('Y-m-d H:i:s', strtotime($formData['modified_date-permintaan_operasi'])),
            'modified_by' => user()->username,
            'validation' => $formData['validation-permintaan_operasi'],
            'terlayani' => $formData['terlayani-permintaan_operasi'],
            'thename' => $formData['thename-permintaan_operasi'],
            'theaddress' => $formData['theaddress-permintaan_operasi'],
            'theid' => $formData['theid-permintaan_operasi'],
            'isrj' => $formData['isrj-permintaan_operasi'],
            'status_pasien_id' => $formData['status_pasien_id-permintaan_operasi'],
            'gender' => $formData['gender-permintaan_operasi'],
            'ageyear' => $formData['ageyear-permintaan_operasi'],
            'agemonth' => $formData['agemonth-permintaan_operasi'],
            'ageday' => $formData['ageday-permintaan_operasi'],
            'bed_id' => $formData['bed_id-permintaan_operasi'],
            'keluar_id' => $formData['keluar_id-permintaan_operasi'],
            'diagnosa_pra' => $formData['diagnosa_pra-permintaan_operasi'],
            'diagnosa_pasca' => $formData['diagnosa_pasca-permintaan_operasi'],
            'end_operation' => $formData['end_operation-permintaan_operasi'],
            'start_anestesi' => $formData['start_anestesi-permintaan_operasi'],
            'end_anestesi' => $formData['end_anestesi-permintaan_operasi'],
            'result_id' => $formData['result_id-permintaan_operasi'],
            'clinic_id' => $formData['clinic_id-permintaan_operasi'],
            'clinic_id_from' => $formData['clinic_id_from-permintaan_operasi'],
            'transaksi' => $formData['transaksi-permintaan_operasi'],
            'layan' => $formData['layan-permintaan_operasi'],
            'start_operation' => date('Y-m-d H:i:s', strtotime($formData['start_operation-permintaan_operasi'])),
            'patient_category_id' => $formData['patient_category_id-permintaan_operasi'],
            'tarif_id' => $formData['tarif_id-permintaan_operasi'],
            'diagnosa_desc' => $formData['diagnosa_desc-permintaan_operasi'],
            'operation_type' => $formData['operation_type-permintaan_operasi'],

        ];
        $model->insert($insertData);
        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $insertData]);
    }

    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!$formData['vactination_id'] || !$formData['visit_id'] || !$formData['no_registration']) {
            return ['success' => false, 'message' => 'Missing parameter send'];
        }

        $model = new PatientOperationRequestModel();

        $deleted = $model->where('vactination_id', $formData['vactination_id'])
            ->where('no_registration', $formData['no_registration'])
            ->where('visit_id', $formData['visit_id'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
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

        $vactinationId = $formData['vactination_id-permintaan_operasi'];
        if (!isset($formData['vactination_id-permintaan_operasi'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing vactination_id in request data']);
        }

        $updateData = [
            'class_room_id' => $formData['class_room_id-permintaan_operasi'],
            'org_unit_code' => $formData['org_unit_code-permintaan_operasi'],
            'visit_id' => $formData['visit_id-permintaan_operasi'],
            'vactination_id' => $vactinationId,
            'no_registration' => $formData['no_registration-permintaan_operasi'],
            'vactination_date' => date('Y-m-d H:i:s', strtotime($formData['vactination_date-permintaan_operasi'])),
            'description' => $formData['description-permintaan_operasi'],
            'employee_id' => $formData['employee_id-permintaan_operasi'],
            'doctor' => $formData['doctor-permintaan_operasi'],
            'anestesi_type' => $formData['anestesi_type-permintaan_operasi'],
            'modified_date' => date('Y-m-d H:i:s', strtotime($formData['modified_date-permintaan_operasi'])),
            'modified_by' => $formData['modified_by-permintaan_operasi'],
            'validation' => $formData['validation-permintaan_operasi'],
            'terlayani' => $formData['form-action-pelayanan'],
            'thename' => $formData['thename-permintaan_operasi'],
            'theaddress' => $formData['theaddress-permintaan_operasi'],
            'theid' => $formData['theid-permintaan_operasi'],
            'isrj' => $formData['isrj-permintaan_operasi'],
            'status_pasien_id' => $formData['status_pasien_id-permintaan_operasi'],
            'gender' => $formData['gender-permintaan_operasi'],
            'ageyear' => $formData['ageyear-permintaan_operasi'],
            'agemonth' => $formData['agemonth-permintaan_operasi'],
            'ageday' => $formData['ageday-permintaan_operasi'],
            'bed_id' => $formData['bed_id-permintaan_operasi'],
            'keluar_id' => $formData['keluar_id-permintaan_operasi'],
            'diagnosa_pra' => $formData['diagnosa_pra-permintaan_operasi'],
            'diagnosa_pasca' => $formData['diagnosa_pasca-permintaan_operasi'],
            'end_operation' =>  date('Y-m-d H:i:s', strtotime($formData['end_operation-permintaan_operasi'])),
            'start_anestesi' => $formData['start_anestesi-permintaan_operasi'],
            'end_anestesi' => $formData['end_anestesi-permintaan_operasi'],
            'result_id' => $formData['result_id-permintaan_operasi'],
            'clinic_id' => $formData['clinic_id-permintaan_operasi'],
            'clinic_id_from' => $formData['clinic_id_from-permintaan_operasi'],
            'transaksi' => $formData['transaksi-permintaan_operasi'],
            'layan' => $formData['layan-permintaan_operasi'],
            'start_operation' => date('Y-m-d H:i:s', strtotime($formData['start_operation-permintaan_operasi'])),
            'patient_category_id' => $formData['patient_category_id-permintaan_operasi'],
            'tarif_id' => $formData['tarif_id-permintaan_operasi'],
            'diagnosa_desc' => $formData['diagnosa_desc-permintaan_operasi'],
            'operation_type' => $formData['operation_type-permintaan_operasi'],
        ];

        // Start a database transaction
        $db = db_connect();
        $db->transStart();

        try {
            $modelRequest->where('vactination_id', $vactinationId)->set($updateData)->update();

            $dataToInsert = [];
            $operationTeamModel = new OperationTeamModel();

            $roles = ['Operator', 'Asisten', 'Instrumen', 'Sirkuler', 'Perawat', 'Anestesi', 'Dokter'];

            foreach ($roles as $role) {
                if (!empty($formData[$role])) {
                    foreach ($formData[$role] as $index => $employee) {
                        $data = [
                            'org_unit_code' => $formData['org_unit_code-permintaan_operasi'],
                            'OPERATION_ID' => $vactinationId,
                            'EMPLOYEE_ID' => $employee["EMPLOYEE_ID"],
                            'TASK_ID' => $employee["TASK_ID"],
                            'COEFFICIENT' => $employee["COEFFICIENT"],
                            'ONCALL' => $employee["ONCALL"],
                            'TARIF_ID' => $formData['tarif_id-permintaan_operasi'],
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
    }

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

        $data = [];

        foreach ($formData as $key => $value) {
            if ($value !== null && $value !== '') {
                $data[strtolower($key)] = $value;
            }
        }

        $dateFields = ['time_out', 'instrument_availability', 'implant_availability', 'start_operation', 'end_operation', 'transport_time', 'nurse_notification', 'nurse_arrived', 'modified_date'];
        foreach ($dateFields as $field) {
            if (isset($formData[$field]) && !empty($formData[$field])) {
                $data[$field] = date('Y-m-d\TH:i:s', strtotime($formData[$field]));
            }
        }

        $db = db_connect();
        $existingEntry = $db->query("SELECT * FROM assessment_operation WHERE body_id='" . $formData['body_id'] . "'")->getRow();

        if ($existingEntry) {

            $model->where(['body_id' => $formData['body_id']])
                ->set($data)
                ->update();
        } else {

            $model->insert($data);
        }

        $date = date("Y-m-d H:i:s");
        $instrumenModel = new AssessmentInstrumentModel();
        if (isset($formData['instrumen'])) {
            $instrumenModel->where('body_id', $formData['body_id'])->delete();
            foreach ($formData['instrumen'] as $key => $instrumen) {
                $dataInstrumen = [
                    'org_unit_code' => $formData['org_unit_code'] ?? null,
                    'visit_id' => $formData['visit_id'] ?? null,
                    'trans_id' => $formData['trans_id'] ?? null,
                    'body_id' => $formData['body_id'] ?? null,
                    'examination_date' => $date,
                    'modified_by' => user()->username,
                    'modified_date' => $date,
                    'brand_id' => $instrumen['brand_id'] ?? null,
                    'brand_name' => $instrumen['brand_name'] ?? null,
                    'quantity_before' => $instrumen['quantity_before'] ?? null,
                    'quantity_after' => $instrumen['quantity_after'] ?? null,
                    'quantity_intra' => $instrumen['quantity_intra'] ?? null,
                    'quantity_additional' => $instrumen['quantity_additional'] ?? null
                ];
                $instrumenModel->insert($dataInstrumen);
            }
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
    }



    public function insertChecklistKeselamatan()
    {
        $model = new PatientOperationCheck();
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();
        $date = date("Y-m-d H:i:s");
        $query = $db->query("SELECT * FROM ASSESSMENT_OPERATION_CHECK WHERE body_id='" . $formData['body_id'] . "' ")->getNumRows();

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
        if (!empty($formData['signin_time'])) {
            $formData['signin_time'] = str_replace("T", " ", $formData['signin_time']);
        }
        if (!empty($formData['timeout_time'])) {
            $formData['timeout_time'] = str_replace("T", " ", $formData['timeout_time']);
        }
        if (!empty($formData['signout_time'])) {
            $formData['signout_time'] = str_replace("T", " ", $formData['signout_time']);
        }
        $data = [
            'org_unit_code' => $formData['org_unit_code'],
            'visit_id' => $formData['visit_id'],
            'trans_id' => $formData['trans_id'],
            'body_id' => $formData['body_id'],
            'examination_date' => $date,
            'modified_by' => $formData['modified_by'],
            'modified_date' => $date,
            'patient_wristband' => $formData['patient_wristband'],
            'operation_location' => $formData['operation_location'],
            'operation_procedure' => $formData['operation_procedure'],
            'surgical_concent' => $formData['surgical_concent'],
            'signed_spot' => $formData['signed_spot'],
            'anesthesia_machine' => $formData['anesthesia_machine'],
            'oxymeter' => $formData['oxymeter'],
            // 'isallergy' => $formData['isallergy'],
            'breathing_dificulty' => $formData['breathing_dificulty'],
            'blood_loss_risk' => $formData['blood_loss_risk'],
            'signin_time' => $formData['signin_time'],
            'introducing_onself' => $formData['introducing_onself'],
            'patient_identity' => $formData['patient_identity'],
            'timeout_procedure' => $formData['timeout_procedure'],
            // 'iniscion_location' => $formData['iniscion_location'],
            'right_eye' => $formData['right_eye'],
            'left_eye' => $formData['left_eye'],
            'other_location' => $formData['other_location'],
            'prophypaltic_antibiotic' => $formData['prophypaltic_antibiotic'],
            'antibiotic_name' => $formData['antibiotic_name'],
            'antibiotic_dose' => $formData['antibiotic_dose'],
            'unexpected_incident' => $formData['unexpected_incident'],
            'operation_length' => $formData['operation_length'],
            'blood_loss' => $formData['blood_loss'],
            'consideration' => $formData['consideration'],
            'cvc' => $formData['cvc'],
            'issteril' => $formData['issteril'],
            'problematic_tools' => $formData['problematic_tools'],
            'negative_diathermy' => $formData['negative_diathermy'],
            'suchtion' => $formData['suchtion'],
            'photo_shown' => $formData['photo_shown'],
            'timeout_time' => $formData['timeout_time'],
            'procedure_name' => $formData['procedure_name'],
            'instrument' => $formData['instrument'],
            'speciment' => $formData['speciment'],
            'isproblematic_tools' => $formData['isproblematic_tools'],
            'main_problem' => $formData['main_problem'],
            'signout_time' => $formData['signout_time']
        ];

        $instrumenModel = new AssessmentInstrumentModel();
        if (isset($formData['instrumen'])) {
            $instrumenModel->where('body_id', $formData['body_id'])->delete();
            foreach ($formData['instrumen'] as $key => $instrumen) {
                $dataInstrumen = [
                    'org_unit_code' => $formData['org_unit_code'],
                    'visit_id' => $formData['visit_id'],
                    'trans_id' => $formData['trans_id'],
                    'body_id' => $formData['body_id'],
                    'examination_date' => $date,
                    'modified_by' => $formData['modified_by'],
                    'modified_date' => $date,
                    'brand_id' => $instrumen['brand_id'],
                    'brand_name' => $instrumen['brand_name'],
                    'quantity_before' => $instrumen['quantity_before']
                ];
                $instrumenModel->insert($dataInstrumen);
            }
        }


        if ($query > 0) {
            $model->where(['body_id' => $data['body_id']])
                ->set($data)
                ->update();
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true, 'data' => $data]);
    }

    public function getDataAssessmentOperation()
    {

        $formData = $this->request->getJSON();

        $model = new AssessmentOperationModel();

        $data = $this->lowerKey($model->where('body_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

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

        $data = $this->lowerKey($model->where('body_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getDataAssessmentAnestesi()
    {

        $formData = $this->request->getJSON();

        $model = new AssessmentAnesthesiaChecklist();

        $data = $this->lowerKey($model->where('body_id', $formData->body_id)
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


        if (isset($data['start_operation'])) {
            $data['start_operation'] = date('Y-m-d H:i:s', strtotime($data['start_operation']));
        }
        if (isset($data['end_operation'])) {
            $data['end_operation'] = date('Y-m-d H:i:s', strtotime($data['end_operation']));
        }
        if (isset($data['modified_date'])) {
            $data['modified_date'] = date('Y-m-d H:i:s', strtotime($data['modified_date']));
        }

        $db = db_connect();


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

        $data = $this->lowerKey($model->where('body_id', $formData->body_id)
            ->findAll());

        return $this->response->setJSON($data);
    }

    public function getDataAssessmentPostOperasi()
    {

        $formData = $this->request->getJSON();

        $model = new AssessmentAnesthesiaChecklist();

        $data = $this->lowerKey($model->where('body_id', $formData->body_id)
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
                'blood' => $blood
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


        $lokalisModel = new LokalisModel();
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


    public function insertAssessmentPostOperasi()
    {
        $model = new AssessmentOperationPostModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();
        $date = date("Y-m-d H:i:s");
        $query = $db->query("SELECT * FROM ASSESSMENT_OPERATION_POST WHERE body_id='" . $formData['body_id'] . "' ")->getNumRows();

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



        $data = [
            'org_unit_code' => $formData['org_unit_code'],
            'visit_id' => $formData['visit_id'],
            'trans_id' => $formData['trans_id'],
            'body_id' => $formData['body_id'],
            'examination_date' => $date,
            'modified_by' => user()->username,
            'modified_date' => $date,
            'infusion' => $formData['infusion'],
            'transfusion' => $formData['transfusion'],
            'fasting_until' => $formData['fasting_until'],
            // 'drink_little' => $formData['drink_little'],
            // 'free_drink' => $formData['free_drink'],
            // 'eat' => $formData['eat'],
            'drain_every' => $formData['drain_every'],
            'dc_every' => $formData['dc_every'],
            'maag_tube' => $formData['maag_tube'],
            'position' => $formData['position'],
            'instruction' => $formData['instruction'],
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
}
