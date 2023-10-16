<?php

namespace App\Models;

use CodeIgniter\Model;

class MeasurementModel extends Model
{
    protected $table      = 'measurement';
    protected $primaryKey = 'measure_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
