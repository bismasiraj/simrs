<?php

namespace App\Models;

use CodeIgniter\Model;

class ClinicTypeModel extends Model
{
    protected $table      = 'clinic_type';
    protected $primaryKey = 'clinic_type';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
