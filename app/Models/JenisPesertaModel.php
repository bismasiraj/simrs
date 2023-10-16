<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPesertaModel extends Model
{
    protected $table      = 'inasis_jenis_peserta';
    protected $primaryKey = 'kdjnspeserta';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;
}
