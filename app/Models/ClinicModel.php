<?php

namespace App\Models;

use CodeIgniter\Model;

class ClinicModel extends Model
{
    protected $table      = 'clinic';
    protected $primaryKey = 'clinic_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ssclinic_id', 'sslocation_id'];

    // Dates
    protected $useTimestamps = false;
}
