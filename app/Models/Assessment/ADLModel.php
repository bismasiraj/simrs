<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class ADLModel extends Model
{
    protected $table      = 'assessment_adl_barthel';
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
        'feeding',
        'bathing',
        'selfcare',
        'dressing',
        'bab',
        'bak',
        'toileting',
        'transfering',
        'mobility',
        'stairs',
        'total_dependency',
        'adl_disruption',
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
