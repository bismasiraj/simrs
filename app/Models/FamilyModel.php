<?php

namespace App\Models;

use CodeIgniter\Model;

class FamilyModel extends Model
{
    protected $table      = 'family_status';
    protected $primaryKey = 'family_status_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
