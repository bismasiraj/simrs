<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class CirculationModel extends Model
{
    protected $table      = 'assessment_circulation';
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
        'tension_upper',
        'tension_below',
        'circulation_disorder',
        'other_disorder',
        'capillary_filling',
        'nadi',
        'nafas',
        'heart_rhythm',
        'pacemaker',
        'akral',
        'perfusi_disorder',
        'perfusi_desc',
        'shock_risk',
        'shock_desc',
        'heart_risk',
        'heart_risk_desc',
        'status',
        'modified_date',
        'modified_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
