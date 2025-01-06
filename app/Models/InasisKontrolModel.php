<?php

namespace App\Models;

use CodeIgniter\Model;

class InasisKontrolModel
extends Model
{
    protected $table      = 'inasis_kontrol';
    protected $primaryKey = 'nosuratkontrol';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'visit_id',
        'nosep',
        'surattype',
        'nosuratkontrol',
        'tglrenckontrol',
        'polikontrol_kdpoli',
        'polikontrol_nmpoli',
        'kodedokter',
        'modified_by',
        'modified_date',
        'responpost',
        'responput',
        'respondel',
        'isused',
        'no_registration',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
