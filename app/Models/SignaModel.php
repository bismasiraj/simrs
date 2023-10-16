<?php

namespace App\Models;

use CodeIgniter\Model;

class SignaModel extends Model
{
    protected $table      = 'signa';
    protected $primaryKey = 'signa';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
