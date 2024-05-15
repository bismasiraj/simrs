<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class RespirationModel extends Model
{
    protected $table      = 'assessment_respiration';
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
        'no_registration',
        'examination_date',
        'p_type',
        'airway',
        'object_strange',
        'object_desc',
        'ett',
        'ett_size',
        'breathing',
        'respiration_rate',
        'cough',
        'spo2',
        'lung_sound',
        'lung_position',
        'breathing_trouble',
        'o2_usage',
        'clean_breathing',
        'clean_desc',
        'effective_breathing',
        'effective_desc',
        'gas_trouble',
        'gas_desc',
        'status',
        'modified_date',
        'modified_by',
        'cough_type',
        'o2_q',
        'o2_type',
        'breath_muscle'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
