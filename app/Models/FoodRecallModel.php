<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodRecallModel extends Model
{
    protected $table = 'ASSESSMENT_NUTRITION_RECALL';
    protected $primaryKey = 'recall_id';

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'recall_id',
        'document_id',
        'no_registration',
        'recall_date',
        'meal_name',
        'meal_urt',
        'meal_grams',
        'ingredient_name',
        'ingredient_urt',
        'ingredient_grams',
        'ingredient_netto',
        'meal_description',
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
