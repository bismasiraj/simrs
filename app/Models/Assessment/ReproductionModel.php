<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class ReproductionModel extends Model
{
    protected $table      = 'assessment_reproduction';
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
        'g',
        'p',
        'a',
        'menstruasi',
        'pregnant',
        'postpartum_day',
        'lochea',
        'counting',
        'breast',
        'asi',
        'asi_fail',
        'asi_fail_desc',
        'contraction',
        'papsmear',
        'mammografi',
        'sadari',
        'bleeding_risk',
        'bleeding_desc',
        'selfdisorder',
        'selfdisorder_desc',
        'skrining_prostat',
        'skrining_date',
        'status',
        'modified_date',
        'modified_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
