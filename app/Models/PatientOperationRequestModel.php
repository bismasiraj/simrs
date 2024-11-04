<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientOperationRequestModel extends Model
{
    protected $table      = 'PASIEN_OPERASI';
    protected $primaryKey = 'vactination_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'vactination_id',
        'org_unit_code',
        'no_registration',
        'visit_id',
        'bill_id',
        'trans_id',
        'clinic_id',
        'validation',
        'terlayani',
        'employee_id',
        'patient_category_id',
        'vactination_date',
        'description',
        'modified_date',
        'modified_by',
        'modified_from',
        'thename',
        'theaddress',
        'theid',
        'isrj',
        'ageyear',
        'agemonth',
        'ageday',
        'status_pasien_id',
        'gender',
        'doctor',
        'kal_id',
        'class_room_id',
        'bed_id',
        'keluar_id',
        'rooms_id',
        'operation_type',
        'anestesi_type',
        'diagnosa_pra',
        'diagnosa_pasca',
        'start_operation',
        'end_operation',
        'start_anestesi',
        'end_anestesi',
        'result_id',
        'tarif_id',
        'dr_opr',
        'dr_opr1',
        'dr_opr2',
        'dr_anes',
        'perawat',
        'penata_anes',
        'perawat1',
        'perawat2',
        'koef_dokter',
        'koef_anestesi',
        'koef_ruang',
        'koef_asisten',
        'koef_alat',
        'transaksi',
        'kode_operasi',
        'operation_desc',
        'bleeding',
        'mplant',
        'komplikasi',
        'special_desc',
        'patologi_date',
        'patologi_desc',
        'patologi_label',
        'diag_sync',
        'clinic_id_from',
        'diagnosa_desc',
        'delay_desc',
        'surgery_type',
        're_operation',
        'profilaksis',
        'antibiotic_desc',
        'implant',
        'konsultasi',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentOperationModel extends Model
{
    protected $table      = 'assessment_operation';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id', //new
        'examination_date',
        'modified_by',
        'modified_date',
        'status_mental',
        'helping_tools',
        'operation_type_before',
        'operation_time_before',
        'operation_placebefore',
        'iv_line',
        'iv_line_ke',
        'operation_desc',
        'time_out',
        'instrument_availability',
        'implant_availability',
        'start_operation',
        'end_operation',
        'do_operation',
        'operation_type',
        'type_of_anesthesia',
        'consiousness_level',
        'emotional_state',
        'intra_vena',
        'operation_supervision',
        'operation_position',
        'operation_hand',
        'operation_tools',
        'urinary_catheter',
        'skin_preparation',
        'diathermy_usage',
        'dispersive_electrode',
        'condition_before',
        'condition_after',
        'heater_unit',
        'cooler_unit',
        'wound_irigation',
        'irigation_water',
        'sodium_chloride',
        'others_pra',
        'operator_tools',
        'bandage',
        'histology',
        'culture',
        'frozen_section',
        'sitology',
        'others_pra2',
        'total_tissue',
        'post_op',
        'transport',
        'transport_time',
        'post_general_condition',
        'post_consousness_level',
        'breath_way',
        'breath',
        'oxygen_treatment',
        'skin_come',
        'skin_out',
        'patient_position',
        'nurse_notification',
        'nurse_arrived',
        'xray',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class OperationTeamModel extends Model
{
    protected $table      = 'operation_team';
    protected $primaryKey = 'OPERATION_ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'OPERATION_ID',
        'EMPLOYEE_ID',
        'TASK_ID',
        'TARIF_ID',
        'DESCRIPTION',
        'DOCTOR',
        'ONCALL',
        'COEFFICIENT'
    ];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'modified_date';
    // protected $updatedField  = 'modified_date';
    // protected $deletedField  = 'deleted_at';
}

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
        'signout_time'
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentAnesthesiaChecklist extends Model
{
    protected $table = 'ASSESSMENT_ANESTHESI_CHECKLIST';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'anesthesia_machine_on',
        'oxygen_tube',
        'flow_meter',
        'power_on',
        'circuit_leakage',
        'volatil',
        'face_mask',
        'laringoskop',
        'ett_lma',
        'stylet',
        'spuit_cuff',
        'ekg_cable',
        'nibp_connection',
        'stetoscope',
        'suction_tube',
        'bandage',
        'nasal_cannula',
        'intravenous_line',
        'spuit_size',
        'epinefrin',
        'atropin',
        'sedative',
        'opioid',
        'muscle_relaxant',
        'intravena_fluid',
        'other_fluid'
    ];
}

class AssessmentInstrumentModel extends Model
{
    protected $table = 'ASSESSMENT_INSTRUMENT';
    protected $primaryKey = 'brand_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'brand_id',
        'brand_name',
        'quantity_before',
        'quantity_intra',
        'quantity_additional',
        'quantity_after'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentPraOperasi extends Model
{
    protected $table = 'ASSESSMENT_OPERATION_PRA';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'identity_wristband',
        'denturers',
        'softlens',
        'lipstick_nailpolish',
        'accessories',
        'hearing',
        'haid',
        'cought',
        'cought_practice',
        'relactation_practice',
        'skern',
        'oral_hygyene',
        'neck_fixation',
        'lavemen',
        'broomstick',
        'fasting',
        'intravenous_infusion',
        'dc',
        'ngt',
        'wsd',
        'drainage',
        'other_checklist'
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentOperationPostModel extends Model
{
    protected $table = 'ASSESSMENT_OPERATION_POST';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
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
        'analgesik',
        'antiemetik',
        'antibiotik',
        'other_drugs'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentOperationDrainModel extends Model
{
    protected $table = 'ASSESSMENT_OPERATION_DRAIN';
    protected $primaryKey = 'document_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'document_id',
        'drain_id',
        'drain_type',
        'drain_kinds',
        'size',
        'description'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentAnesthesiaModel extends Model
{
    protected $table = 'assessment_anesthesia';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'start_operation',
        'end_operation',
        'start_anesthesia',
        'end_anesthesia',
        'type_of_anesthesia',
        'rooms_id',
        'losing_teeth',
        'neck_problem',
        'short_neck',
        'cough',
        'dispnea',
        'ispa',
        'abnormal_menstruation',
        'stroke',
        'chest_pain',
        'aritmia',
        'vomitus',
        'urinary_retention',
        'seizure',
        'pregnant',
        'syncope',
        'obesity',
        'system_description',
        'denture',
        'mallampati',
        'asa_class',
        'anesthesia_assessment',
        'sedation',
        'general_anesthesia',
        'regional_spinal',
        'regional_epidural',
        'regional_kaudal',
        'regional_blokperifer',
        'others_anesthesia',
        'inpatient',
        'outpatient',
        'intensive_care',
        'anesthesia_preparation',
        'nipb',
        'ipb',
        'ecg',
        'temp',
        'precordial',
        'spo2',
        'etco_2',
        'cvp',
        'an_position',
        'bleeding_amount',
        'urine_amount',
        'auto_anamnesis',
        'breathway_normal',
        'breathway_abnormal',
        'mouth_open',
        'tyromental',
        'neck_movement',
        'penyulit',
        'ijin_operasi',
        'mesin_anestesi',
        'persiapan_obat',
        'antibiotik'
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentAnesthesiaPostModel extends Model
{
    protected $table = 'assessment_anesthesia_post';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'start_operation',
        'end_operation',
        'start_anesthesia',
        'end_anesthesia',
        'rooms_id',
        'losing_teeth',
        'neck_problem',
        'short_neck',
        'cough',
        'dispnea',
        'ispa',
        'abnormal_menstruation',
        'stroke',
        'chest_pain',
        'aritmia',
        'vomitus',
        'urinary_retention',
        'seizure',
        'pregnant',
        'syncope',
        'obesity',
        'system_description',
        'denture',
        'mallampati',
        'asa_class',
        'anesthesia_assessment',
        'sedation',
        'general_anesthesia',
        'regional_spinal',
        'regional_epidural',
        'regional_kaudal',
        'regional_blokperifer',
        'others_anesthesia',
        'inpatient',
        'outpatient',
        'intensive_care',
        'anesthesia_preparation',
        'document_id',
        'recovery_leave_time',
        'patient_destination'
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}

class AssessmentAnesthesiaRecoveryModel extends Model
{
    protected $table = 'assessment_anesthesia_recovery';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
        'org_unit_code',      // ORG_UNIT_CODE
        'visit_id',           // VISIT_ID
        'trans_id',           // TRANS_ID
        'body_id',            // BODY_ID
        'document_id',        // DOCUMENT_ID
        'p_type',             // P_TYPE
        'parameter_id',       // PARAMETER_ID
        'value_score',        // VALUE_SCORE
        'value_desc',         // VALUE_DESC
        'observation_date',   // OBSERVATION_DATE
        'modified_date',      // MODIFIED_DATE
        'modified_by',        // MODIFIED_BY
        'value_id'            // VALUE_ID
    ];



    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
