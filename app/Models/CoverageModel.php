<?php

namespace App\Models;

use CodeIgniter\Model;

class CoverageModel extends Model
{
    protected $table      = 'coverage_type';
    protected $primaryKey = 'coverage_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
