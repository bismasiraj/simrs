<?php

namespace App\Models;

use CodeIgniter\Model;

class PersalinanModel extends Model
{
    protected $table      = 'assessment_obstetric';
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
        'obstetric_report',
        'kk_pecah',
        'time',
        'color',
        'kala_1',
        'kala_2',
        'kala_3',
        'kala_4',
        'born',
        'born_condition',
        'weight',
        'shape',
        'umbilical_cord',
        'amiotic_membrane',
        'cotyledon',
        'insertion',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
