<?php

namespace App\Models;

use CodeIgniter\Model;

class CaraKeluarModel extends Model
{
    protected $table      = 'cara_keluar';
    protected $primaryKey = 'keluar_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
