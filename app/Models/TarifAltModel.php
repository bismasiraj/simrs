<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class TarifAltModel extends Model
{
    protected $table      = 'tarif_alt';
    // protected $primaryKey = 'brand_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'NOSEP',
        'CLASS_ID',
        'TARIF_INACBG',
        'TARIF_SP',
        'TARIF_SR',
        'MODIFIED_DATE',
        'MODIFIED_BY'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
