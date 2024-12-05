<?php

namespace App\Models;

use CodeIgniter\Model;

class AskepModel extends Model
{
    protected $table      = 'askep_sdki_detail';
    protected $primaryKey = 'body_id';


    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'document_id',
        'body_id',
        'diagnosan_id',
        'detail_type',
        'detail_id',
        'examination_date',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    protected $useTimestamps = false; // Use false if manually setting timestamps
}
