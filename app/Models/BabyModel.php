<?php

namespace App\Models;

use CodeIgniter\Model;

class BabyModel extends Model
{
    protected $table      = 'baby';
    protected $primaryKey = 'baby_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'org_unit_code',
        'no_registration',
        'baby_id',
        'visit_id',
        'bill_id',
        'document_id',
        'clinic_id',
        'diagnosa_id',
        'employee_id',
        'baby_ke',
        'inspection_date',
        'birth_con',
        'weight',
        'height',
        'head_round',
        'anomali_id',
        'breast_feed',
        'baby_feed',
        'pusar_id',
        'baby_birth',
        'breast_feed_duration',
        'start_fruit',
        'start_bubur',
        'start_tim',
        'start_rice',
        'description',
        'modified_date',
        'modified_by',
        'modified_from',
        'obstetri_id',
        'thename',
        'theaddress',
        'theid',
        'status_pasien_id',
        'isrj',
        'ageyear',
        'agemonth',
        'ageday',
        'gender',
        'class_room_id',
        'bed_id',
        'keluar_id',
        'doctor',
        'mothername',
        'motherno',
        'kal_id',
        'date_of_birth',
        'partus',
        'indication',
        'birth',
        'gender1',
        'resusitasi',
        'movement',
        'skincolor',
        'turgor',
        'tonus',
        'sound',
        'mororeflex',
        'suckingreflex',
        'holding',
        'necktone',
        'headcircumference',
        'chestcircumference',
        'valid_date',
        'valid_user',
        'valid_pasien',
        'babyno'
    ];
    protected $useTimestamps = false;
}
