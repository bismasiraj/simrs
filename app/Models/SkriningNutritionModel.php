<?php

namespace App\Models;

use CodeIgniter\Model;

class SkriningNutritionModel extends Model
{
    protected $table = 'ASSESSMENT_SCREENING_NUTRITION';
    protected $primaryKey = 'body_id';

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'no_registration',
        'thename',
        'theaddress',
        'examination_date',
        'clinic_id',
        'employee_id',
        'petugas_id',
        'class_room_id',
        'bed_id',
        'parent_id',
        'malnutrition_risk',
        'nutrition_consult',
        'operation_elder',
        'malnutrition',
        'ageyear',
        'agemonth',
        'ageday',
        'age_range',
        'age_cat',
        'weight',
        'height',
        'imt',
        'imt_score',
        'imt_desc',
        'step1_score_imt',
        'step2_score_wightloss',
        'step3_score_acute_disease',
        'step4_score_malnutrition',
        'step5_score',
        'step6_score',
        'p_type',
        'special_diagnose',
        'total_score',
        'score_desc',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
