<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class BladderModel extends Model
{
    protected $table      = 'assessment_bladder';
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
        'bak',
        'urine_catheter',
        'urine_vol',
        'urine_color',
        'urine_catheter_desc',
        'prostate',
        'prostate_desc',
        'back_pain',
        'disorders',
        'disorder_desc',
        'elimination_disorder',
        'elimination',
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
