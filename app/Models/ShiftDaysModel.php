<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftDaysModel extends Model
{
    protected $table      = 'DAYS_SHIFT';
    protected $primaryKey = 'shift_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
