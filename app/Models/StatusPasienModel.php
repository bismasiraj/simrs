<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPasienModel extends Model
{
    protected $table      = 'status_pasien';
    protected $primaryKey = 'status_pasien_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
