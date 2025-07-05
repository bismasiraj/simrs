<?php

namespace App\Models;

use CodeIgniter\Model;


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
        'operation_place_before',
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
        'petugas_ibs_id',
        'petugas_ibs_signature',
        'instrument_id',
        'instrument_signature',
        'sirkulasi_id',
        'sirkulasi_signature',
        'rr_id',
        'rr_signature',

    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}