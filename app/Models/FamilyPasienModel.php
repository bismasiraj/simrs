<?php

namespace App\Models;

use CodeIgniter\Model;

class FamilyPasienModel extends Model
{
    protected $table = 'family';
    protected $primaryKey = 'nik';
    protected $useAutoIncrement = false;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'no_registration',
        'family_id',
        'family_status_id',
        'no_registration2',
        'fullname',
        'isresponsible',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'kode_agama',
        'education_type_code',
        'job_id',
        'blood_id',
        'maritalstatusid',
        'address',
        'kota',
        'rt',
        'rw',
        'phone',
        'mobile',
        'fax',
        'email',
        'description',
        'modified_date',
        'modified_by',
        'modified_from',
        'country_code',
        'sign',
        'sign_file',
        'nik',
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
