<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienPenunjangModel extends Model
{
    protected $table      = 'pasien_penunjang';
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
        'no_registration',
        'bill_id',
        'clinic_id',
        'validation',
        'terlayani',
        'iscito',
        'employee_id',
        'patient_category_id',
        'treat_date',
        'diagnosa_desc',
        'descriptions',
        'thename',
        'theaddress',
        'theid',
        'isrj',
        'ageyear',
        'agemonth',
        'ageday',
        'status_pasien_id',
        'gender',
        'doctor',
        'class_room_id',
        'bed_id',
        'keluar_id',
        'perujuk',
        'alamat_perujuk',
        'no_specimen',
        'modified_date',
        'modified_by',
        'modified_from',
        'valid_date',
        'valid_user',
        'valid_pasien',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}