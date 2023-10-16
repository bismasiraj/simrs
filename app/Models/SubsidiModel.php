<?php

namespace App\Models;

use CodeIgniter\Model;

class SubsidiModel extends Model
{
    protected $table      = 'subsidi';
    protected $primaryKey = 'subsidi_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
