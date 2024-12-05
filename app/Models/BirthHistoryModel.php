<?php

namespace App\Models;

use CodeIgniter\Model;

class BirthHistoryModel extends Model
{
    protected $table      = 'BIRTH_HISTORY';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'no_registration',
        'body_id',
        'partus_date',
        'partus_location',
        'gestation',
        'partus_type',
        'partus_helper',
        'partus_abnormal',
        'baby_sex',
        'baby_weight',
        'baby_condition',
    ];

    // Dates
    protected $useTimestamps = false;
}