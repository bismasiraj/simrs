<?php

namespace App\Models;

use CodeIgniter\Model;

class MaritalModel extends Model
{
    protected $table      = 'marital_status';
    protected $primaryKey = 'maritalstatusid';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
