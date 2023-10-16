<?php

namespace App\Models;

use CodeIgniter\Model;

class DistributionTypeModel
extends Model
{
    protected $table      = 'distribution_type';
    protected $primaryKey = 'distribution_type';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
