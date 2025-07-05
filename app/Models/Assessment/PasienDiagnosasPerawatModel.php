<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class PasienDiagnosasPerawatModel extends Model
{
    protected $table      = 'pasien_diagnosas_nurse';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'body_id',
        'diagnosan_id',
        'diagnosa_date',
        'diag_notes',
        'modified_date',
        'modified_by',
        'diag_cat'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
