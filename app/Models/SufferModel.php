<?php

namespace App\Models;

use CodeIgniter\Model;

class SufferModel extends Model
{
    protected $table      = 'suffer_type';
    protected $primaryKey = 'suffer_type';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
