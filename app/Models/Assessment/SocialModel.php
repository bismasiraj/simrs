<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class SocialModel extends Model
{
    protected $table      = 'assessment_socec';
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
        'maritalstatusid',
        'children',
        'education_type_code',
        'nation_id',
        'job_id',
        'residence',
        'activity',
        'suspicion',
        'livingwith',
        'status',
        'modified_date',
        'modified_by',
        'children_desc',
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
