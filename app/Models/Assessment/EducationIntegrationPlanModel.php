<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class EducationIntegrationPlanModel extends Model
{
    protected $table      = 'assessment_education_plan';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'body_id',
        'plan_ke',
        'p_type',
        'education_material',
        'treatment_type',
        'examination_date',
        'education_provision',
        'education_target',
        'education_method',
        'EDUCATION_EVALUATION',
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
