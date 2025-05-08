<?php

namespace App\Models;

use CodeIgniter\Model;

class FisioterapiModel extends Model
{
    protected $table = 'pasien_fisioterapi';
    protected $primaryKey = 'vactination_id';

    protected $allowedFields = [
        'org_unit_code',
        'vactination_id',
        'no_registration',
        'visit_id',
        'bill_id',
        'clinic_id',
        'validation',
        'terlayani',
        'employee_id',
        'patient_category_id',
        'vactination_date',
        'tarif_id',
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
        'gender',
        'doctor',
        'kal_id',
        'class_room_id',
        'bed_id',
        'keluar_id',
        'vas',
        'functions',
        'ultrasound',
        'tens',
        'exercise',
        'infrared',
        'other_desc',
        'suggestion',
        'evaluation_qty',
        'suspect_worker',
        'tarif_name',
        'terapi_desc'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}

class FisioterapiDetailModel extends Model
{
    protected $table = 'pasien_fisioterapi_detail';
    protected $primaryKey = 'vactination_id';

    protected $allowedFields = [
        'org_unit_code',
        'vactination_id',
        'document_id',
        'no_registration',
        'visit_id',
        'bill_id',
        'clinic_id',
        'employee_id',
        'doctor',
        'vactination_date',
        'tarif_id',
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
        'class_room_id',
        'bed_id',
        'treatment',
        'teraphy_desc',
        'teraphy_result',
        'teraphy_conclusion',
        'teraphy_recomendation',
        'start_date',
        'end_date',
        'valid_date',
        'valid_user',
        'valid_pasien',
        'valid_other',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}


class FisioterapiScheduleModel extends Model
{
    protected $table = 'PASIEN_FISIOTERAPI_SCHEDULE';
    protected $primaryKey = 'vactination_id';
    protected $allowedFields = [
        'org_unit_code',
        'vactination_id',
        'no_registration',
        'visit_id',
        'document_id',
        'clinic_id',
        'employee_id',
        'doctor',
        'vactination_date',
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
        'class_room_id',
        'bed_id',
        'tarif_id',
        'treatment',
        'treatment_program',
        'start_date',
        'end_date',
        'valid_date',
        'valid_user',
        'valid_pasien',
        'valid_other'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
