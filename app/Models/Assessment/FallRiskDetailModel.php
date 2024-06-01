<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class FallRiskDetailModel extends Model
{
    protected $table      = 'assessment_fall_risk_detail';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'p_type',
        'parameter_id',
        'value_score',
        'value_desc',
        'modified_date',
        'modified_by',
        'value_id'
    ];

    // Dates
    protected $useTimestamps = false;
}
