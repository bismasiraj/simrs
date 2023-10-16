<?php

namespace App\Models;

use CodeIgniter\Model;

class RegulationTypeModel extends Model
{
    protected $table      = 'regulation_type';
    protected $primaryKey = 'regulate_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
