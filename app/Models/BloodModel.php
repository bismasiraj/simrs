<?php

namespace App\Models;

use CodeIgniter\Model;

class BloodModel extends Model
{
    protected $table      = 'BLOOD_TYPE';
    protected $primaryKey = 'blood_type_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
