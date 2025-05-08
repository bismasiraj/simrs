<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class PasienDiagnosaPerawatModel extends Model
{
    protected $table      = 'pasien_diagnosa_nurse';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'clinic_id',
        'class_room_id',
        'bed_id',
        'no_registration',
        'examination_date',
        'employee_id',
        'petugas_id',
        'descriptions',
        'modified_date',
        'modified_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
