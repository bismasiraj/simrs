<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPesertaModel extends Model
{
    protected $table      = 'inasis_status_peserta';
    protected $primaryKey = 'status_peserta_kode';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
