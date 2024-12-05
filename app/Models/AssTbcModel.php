<?php

namespace App\Models;


use CodeIgniter\Model;

class AssTbcModel extends Model
{
    protected $table      = 'assessment_tbc';
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
        'cough',
        'hemoptisis',
        'weight_loss',
        'dispnea',
        'close_contact',
        'pneumonia',
        'hiperhidrosis',
        'diabetes',
        'hiv',
        'suspect',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien',
    ];

    protected $useTimestamps = false; // Use false if manually setting timestamps
}
