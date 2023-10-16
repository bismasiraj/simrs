<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultTypeModel extends Model
{
    protected $table      = 'result_type';
    protected $primaryKey = 'result_type';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
