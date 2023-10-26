<?php

namespace App\Models;

use CodeIgniter\Model;

class InasisRujukanModel
extends Model
{
    protected $table      = 'inasis_rujukan';
    protected $primaryKey = 'nokunjungan';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'visit_id',
        'nosep',
        'tglsep',
        'tglrujukan',
        'tiperujukan',
        'kdjnspelayanan',
        'catatan',
        'kddiag',
        'nmdiag',
        'polirujukan_kdpoli',
        'polirujukan_nmpoli',
        'provrujukan_kdprovider',
        'provrujukan_nmprovider',
        'nokunjungan',
        'sex',
        'nama',
        'nokartu',
        'nomr',
        'modified_by',
        'jnspelayanan',
        'responpost',
        'responput',
        'respondel'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
