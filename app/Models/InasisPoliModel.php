<?php

namespace App\Models;

use CodeIgniter\Model;

class InasisPoliModel
extends Model
{
    protected $table      = 'inasis_get_poli';
    protected $primaryKey = 'kdpoli';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
