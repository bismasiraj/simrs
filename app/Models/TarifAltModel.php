<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class TarifAltModel extends Model
{
    protected $table      = 'tarif_alt';
    protected $primaryKey = 'nosep';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nosep',
        'class_id',
        'tarif_inacbg',
        'tarif_sp',
        'tarif_sr',
        'modified_date',
        'modified_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
