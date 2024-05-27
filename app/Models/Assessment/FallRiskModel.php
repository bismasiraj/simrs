<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class FallRiskModel extends Model
{
    protected $table      = 'assessment_fall_risk';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = true;

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
        'clinic_id',
        'employee_id',
        'petugas_id',
        'class_room_id',
        'bed_id',
        'p_type',
        'total_score',
        'description',
        'modified_date',
        'modified_by',
        'fall_risk_status',
    ];

    // Dates
    protected $useTimestamps = false;
}
