<?php

namespace App\Models;

use CodeIgniter\Model;

class AssessmentModel extends Model
{
    protected $table      = 'assessment_info';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'clinic_id',
        'class_room_id',
        'keluar_id',
        'employee_id',
        'no_registration',
        'visit_id',
        'org_unit_code',
        'doctor',
        'kal_id',
        'theid',
        'thename',
        'theaddress',
        'status_pasien_id',
        'isrj',
        'gender',
        'ageyear',
        'agemonth',
        'ageday',
        'body_id',
        'modified_by',
        'pasien_diagnosa_id',
        'assessment_type',
        'examination_date',
        't_01',
        'v_01',
        't_02',
        't_04',
        'riwayat_alergi',
        'v_02',
        'v_03',
        'alloanamnesis_contact',
        'alloanamnesis_hub',
        'anamnase',
        'diagnosa_history',
        'riwayat_obat',
        'tension_upper',
        'tension_below',
        'nadi',
        'nafas',
        'saturasi',
        'temperature',
        't_012',
        'weight',
        'height',
        'pemeriksaan',
        // 'lokalis',
        'v_33',
        'v_34',
        'v_35',
        'diagnosa_desc',
        'v_36',
        'v_37',
        'instruction',
        'description',
        't_010',
        't_011',
        // 'dirujuk',
        'v_31',
        'teraphy_desc',
        'instruction',
        // 'education_date',
        'v_39',
        'v_40',
        'petugas',
        'diagnosa_kerja'
    ];

    // Dates
    protected $useTimestamps = false;
}
