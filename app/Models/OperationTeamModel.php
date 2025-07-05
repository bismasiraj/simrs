<?php

namespace App\Models;

use CodeIgniter\Model;



class OperationTeamModel extends Model
{
    protected $table      = 'operation_team';
    protected $primaryKey = 'OPERATION_ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'OPERATION_ID',
        'EMPLOYEE_ID',
        'TASK_ID',
        'TARIF_ID',
        'DESCRIPTION',
        'DOCTOR',
        'ONCALL',
        'COEFFICIENT'
    ];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'modified_date';
    // protected $updatedField  = 'modified_date';
    // protected $deletedField  = 'deleted_at';
}