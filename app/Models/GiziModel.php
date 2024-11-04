<?php

namespace App\Models;

use CodeIgniter\Model;

class GiziModel extends Model
{
    protected $table = 'ASSESSMENT_NUTRITION';
    protected $primaryKey = 'body_id';

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'no_registration',
        'examination_date',
        'p_type',
        'nutrition_diagnose',
        'antropometri',
        'age_category',
        'pola_makan',
        'biokimia',
        'clinical_description',
        'food_alergy',
        'energi',
        'karbohidrat',
        'protein',
        'lemak',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasiem'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
