<?php

namespace App\Models;

use CodeIgniter\Model;

class ClinicDoctorModel extends Model
{
    protected $table      = 'clinic_doctor';
    protected $primaryKey = 'clinic_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
