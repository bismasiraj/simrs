<?php

namespace App\Models;

use CodeIgniter\Model;

class PmkpModel extends Model
{
    protected $table = 'INDICATOR_PMKP';
    protected $primaryKey = 'no_registration';

    protected $allowedFields = [
        'no_registration',
        'clinic_id',
        'treat_date',
        'indicator_id',
        'result',
        'thename',
        'employee_id',
        'modified_date',
        'modified_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
