<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class SpiritualDetailModel extends Model
{
    protected $table      = 'assessment_spiritual_detail';
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
        'value_id',
        'value_score',
        'value_desc',
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
