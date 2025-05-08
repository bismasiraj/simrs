<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienPrescriptionModel extends Model
{
    protected $table      = 'pasien_prescription';
    protected $primaryKey = 'resep_no';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'no_registration',
        'visit_id',
        'trans_id',
        'resep_no',
        'nota_no',
        'treat_date',
        'sold_status',
        'start_date',
        'end_date',
        'iter',
        'clinic_id',
        'validation',
        'terlayani',
        'employee_id',
        'description',
        'modified_date',
        'modified_by',
        'modified_from',
        'thename',
        'theaddress',
        'theid',
        'isrj',
        'ageyear',
        'agemonth',
        'ageday',
        'status_pasien_id',
        'payor_id',
        'doctor',
        'class_room_id',
        'bed_id',
        'keluar_id',
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
