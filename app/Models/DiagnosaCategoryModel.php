<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaCategoryModel extends Model
{
    protected $table      = 'diagnosa_category';
    protected $primaryKey = 'diag_cat';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
