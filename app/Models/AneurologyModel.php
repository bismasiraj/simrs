<?php

namespace App\Models;

use CodeIgniter\Model;

class AneurologyModel extends Model
{
    protected $table      = 'ASSESSMENT_NEUROLOGY';
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
        'examination_date',
        'vas_nrs',
        'left_diameter',
        'left_light_reflex',
        'left_cornea',
        'left_isokor_anisokor',
        'right_diameter',
        'right_light_reflex',
        'right_cornea',
        'right_isokor_anisokor',
        'stiff_neck',
        'meningeal_sign',
        'brudzinki_i_iv',
        'kernig_sign',
        'dolls_eye_phenomenon',
        'vertebra',
        'extremity',
        'motion_upper_left',
        'motion_upper_right',
        'motion_lower_left',
        'motion_lower_right',
        'strength_upper_left',
        'strength_upper_right',
        'strength_lower_left',
        'strength_lower_right',
        'physiological_reflex_upper_left',
        'physiological_reflex_upper_right',
        'physiological_reflex_lower_left',
        'physiological_reflex_lower_right',
        'pathologycal_reflex_upper_left',
        'pathologycal_reflex_upper_right',
        'pathologycal_reflex_lower_left',
        'pathologycal_reflex_lower_right',
        'clonus',
        'sensibility',
        'pemeriksaan_saraf',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien',
    ];

    // Dates
    protected $useTimestamps = false;
}