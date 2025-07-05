<?php

namespace App\Models;

use CodeIgniter\Model;


class PatientOperationCheck extends Model
{
    protected $table      = 'ASSESSMENT_OPERATION_CHECK';
    protected $primaryKey = 'document_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
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
                    'signin_time',
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
                    'timeout_time',
                    'procedure_name',
                    'instrument',
                    'speciment',
                    'isproblematic_tools',
                    'main_problem',
                    'signout_time',
                    'valid_date',
                    'valid_user',
                    'valid_pasien',
                    'valid_other',
                    'signin_surgeon_id',
                    'signin_surgeon_signature',
                    'signin_anesthesia_id',
                    'signin_anesthesia_signature',
                    'signin_nurse_id',
                    'signin_nurse_signature',
                    'timeout_surgeon_id',
                    'timeout_surgeon_signature',
                    'timeout_anesthesia_id',
                    'timeout_anesthesia_signature',
                    'timeout_nurse_id',
                    'timeout_nurse_signature',
                    'signout_surgeon_id',
                    'signout_surgeon_signature',
                    'signout_anesthesia_id',
                    'signout_anesthesia_signature',
                    'signout_nurse_id',
                    'signout_nurse_signature',
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}