<?php

namespace App\Models;

use CodeIgniter\Model;

class BatchingBridgingModel extends Model
{
    protected $table      = 'batching_bridging';
    protected $primaryKey = 'trans_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'no_registration',
        'trans_id',
        'url',
        'method',
        'parameter',
        'result',
        'status',
        'created_date',
        'modified_date',
        'tipe',
        'waktu'
    ];

    // Dates
    protected $useTimestamps = false;

    public function getLapAntrol()
    {
        $connect = DB::connect();
    }
}
