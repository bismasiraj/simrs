<?php

namespace App\Models;

use CodeIgniter\Model;

class SexModel extends Model
{
    protected $table      = 'sex';
    protected $primaryKey = 'gender';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
