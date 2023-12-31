<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienProceduresModel extends Model
{
    protected $table      = 'pasien_procedures';
    protected $primaryKey = 'pasien_diagnosa_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'pasien_diagnosa_id',
        'diagnosa_id',
        'diagnosa_name',
        'diag_cat',
        'suffer_type',
        'modified_by',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
