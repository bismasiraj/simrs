<?php

namespace App\Models;

use CodeIgniter\Model;

class KalurahanModel extends Model
{
    protected $table      = 'kalurahan';
    protected $primaryKey = 'kal_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
