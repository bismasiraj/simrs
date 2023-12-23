<?php

namespace App\Models;

use CodeIgniter\Model;

class BatchingBridgingModel extends Model
{
    protected $table      = 'batching_bridging';
    protected $primaryKey = 'trans_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'NO_REGISTRATION',
        'TRANS_ID',
        'url',
        'METHOD',
        'PARAMETER',
        'RESULT',
        'STATUS',
        'CREATED_DATE',
        'MODIFIED_DATE',
        'TIPE'
    ];

    // Dates
    protected $useTimestamps = false;

    public function getLapAntrol()
    {
        $connect = DB::connect();
    }
}
