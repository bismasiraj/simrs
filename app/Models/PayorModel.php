<?php

namespace App\Models;

use CodeIgniter\Model;

class PayorModel extends Model
{
    protected $table      = 'payor_info';
    protected $primaryKey = 'payor_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
