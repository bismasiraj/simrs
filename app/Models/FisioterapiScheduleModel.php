<?php

namespace App\Models;

use CodeIgniter\Model;


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
        'valid_other',
        'schedule_type',
        'treatment_description'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}