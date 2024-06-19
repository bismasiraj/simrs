<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class EducationIntegrationProvisionModel extends Model
{
    protected $table      = 'assessment_education_provision';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'body_id',
        'provision_ke',
        'p_type',
        'education_material',
        'treatment_type',
        'education_desc',
        'understanding_level',
        're_assessment',
        'examination_date',
        'education_method',
        'evaluation',
        'evaluation_date',
        're_evaluation',
        'education_duration',
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
