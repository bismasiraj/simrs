<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class NutritionModel extends Model
{
    protected $table      = 'assessment_screening_nutrition';
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
        'total_score',
        'score_desc',
        'modified_date',
        'modified_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
