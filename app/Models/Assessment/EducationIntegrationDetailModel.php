<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class EducationIntegrationDetailModel extends Model
{
    protected $table      = 'assessment_education_integration_detail';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

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
        'value_id',
        'value_desc',
        'modified_date',
        'modified_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
