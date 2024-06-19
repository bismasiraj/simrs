<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class IntegumenModel extends Model
{
    protected $table      = 'assessment_integumen';
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
        'integumen',
        'turgor',
        'hair',
        'nail',
        'wound',
        'wound_depth',
        'bleeding',
        'fracture',
        'location',
        'skin_disorder',
        'skin_desc',
        'adi_disorder',
        'adi_desc',
        'mobilization_disorder',
        'mobilization_desc',
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
