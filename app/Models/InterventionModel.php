<?php

namespace App\Models;

use CodeIgniter\Model;

class InterventionModel extends Model
{

    protected $table = 'ASSESSMENT_NUTRITION_INTERVENTION';
    protected $primaryKey = 'body_id';

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'no_registration',
        'intervention_date',
        'intervention_description',
        'intervention_target',
        'intervention_result',
        'intervention_problem',
        'intervention_planning',
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
}
