<?php

namespace App\Models;

use CodeIgniter\Model;

class CairanModel extends Model
{
    protected $table      = 'assessment_fluid_balance';
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
        'awareness',
        'balance_type',
        'fluid_type',
        'fluid_amount',
        'drip_rate',
        'botle_amount',
        'status',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    // Dates
    protected $useTimestamps = false;
}
