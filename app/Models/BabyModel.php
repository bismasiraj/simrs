<?php

namespace App\Models;

use CodeIgniter\Model;

class BabyModel extends Model
{
    protected $table      = 'BABY';
    protected $primaryKey = 'BABY_ID';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = [
    //     'org_unit_code',
    //     'no_registration',
    //     'baby_id',
    //     'visit_id',
    //     'clinic_id',
    //     'diagnosa_id',
    //     'mothername',
    //     'doctor',
    //     'class_room_id',
    //     'bed_id',
    //     'modified_date',
    //     'thename',
    //     'gender',
    //     'baby_birth',
    //     'modified_by',
    //     'modified_from',
    //     'obstetri_id',
    //     'theaddress',
    //     'theid',
    //     'status_pasien_id',
    //     'isrj',
    //     'ageyear',
    //     'agemonth',
    //     'ageday',
    //     'keluar_id',
    //     'baby_ke',
    //     'employee_id'
    // ];
    protected $allowedFields = [
        'ORG_UNIT_CODE',
        'NO_REGISTRATION',
        'BABY_ID',
        'VISIT_ID',
        'BILL_ID',
        'CLINIC_ID',
        'DIAGNOSA_ID',
        'EMPLOYEE_ID',
        'BABY_KE',
        'INSPECTION_DATE',
        'BIRTH_CON',
        'WEIGHT',
        'HEIGHT',
        'HEAD_ROUND',
        'ANOMALI_ID',
        'BREAST_FEED',
        'BABY_FEED',
        'PUSAR_ID',
        'BABY_BIRTH',
        'BREAST_FEED_DURATION',
        'START_FRUIT',
        'START_BUBUR',
        'START_TIM',
        'START_RICE',
        'DESCRIPTION',
        'MODIFIED_DATE',
        'MODIFIED_BY',
        'MODIFIED_FROM',
        'OBSTETRI_ID',
        'THENAME',
        'THEADDRESS',
        'THEID',
        'STATUS_PASIEN_ID',
        'ISRJ',
        'AGEYEAR',
        'AGEMONTH',
        'AGEDAY',
        'GENDER',
        'CLASS_ROOM_ID',
        'BED_ID',
        'KELUAR_ID',
        'DOCTOR',
        'MOTHERNAME',
        'MOTHERNO',
        'KAL_ID'
    ];
    // Dates
    protected $useTimestamps = false;
}
