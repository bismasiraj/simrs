<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class NeonatusModel extends Model
{
    protected $table      = 'assessment_neonatus_physic';
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
        'pregnancy_period',
        'complication',
        'neonatus_issues',
        'neonatus_desc',
        'maternal_issues',
        'maternal_desc',
        'vactination_hsitory',
        'prone_age',
        'sitting_age',
        'babling_age',
        'standing_age',
        'talking_age',
        'walking_age',
        'milk_feeding',
        'additinal_food',
        'sitter',
        'characters',
        'tempramen',
        'unique_behaviour',
        'illnesrisk_avoid',
        'avoid_desc',
        'growth_disorder',
        'disorder_desc',
        'status',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
