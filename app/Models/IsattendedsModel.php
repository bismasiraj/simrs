<?php

namespace App\Models;

use CodeIgniter\Model;

class IsattendedsModel
extends Model
{
    protected $table      = 'visit_status';
    protected $primaryKey = 'isattended';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
