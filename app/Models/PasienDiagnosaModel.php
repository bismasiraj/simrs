<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienDiagnosaModel extends Model
{
    protected $table      = 'pasien_diagnosa';
    protected $primaryKey = 'pasien_diagnosa_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'pasien_diagnosa_id',
        'no_registration',
        'visit_id',
        'clinic_id',
        'bill_id',
        'class_room_id',
        'in_date',
        'exit_date',
        'bed_id',
        'keluar_id',
        'date_of_diagnosa',
        'report_date',
        'diagnosa_id',
        'diagnosa_desc',
        'employee_id',
        'diag_cat',
        'anamnase',
        'alloanamnase',
        'description',
        'pemeriksaan',
        'body_id',
        'teraphy_desc',
        'teraphy_home',
        'therapy_target',
        'medical_problem',
        'hurt',
        'hurt_type',
        'lab_result',
        'ro_result',
        'ecg_result',
        'standing_order',
        'instruction',
        'rencanatl',
        'dirujukke',
        'tglkontrol',
        'kdpoli_kontrol',
        'suffer_type',
        'result_id',
        'modified_date',
        'modified_by',
        'modified_from',
        'status_pasien_id',
        'ageyear',
        'agemonth',
        'ageday',
        'thename',
        'theaddress',
        'theid',
        'isrj',
        'gender',
        'doctor',
        'nokartu',
        'nosep',
        'tglsep',
        'spesialistik',
        'sscondition_id',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
