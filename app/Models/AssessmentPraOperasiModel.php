<?php

namespace App\Models;

use CodeIgniter\Model;


class AssessmentPraOperasiModel extends Model
{
    protected $table = 'ASSESSMENT_OPERATION_PRA';
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
                    'examination_date',
                    'modified_by',
                    'modified_date',
                    'identity_wristband',
                    'denturers',
                    'softlens',
                    'lipstick_nailpolish',
                    'accessories',
                    'hearing',
                    'haid',
                    'cought',
                    'cought_practice',
                    'relactation_practice',
                    'skern',
                    'oral_hygyene',
                    'neck_fixation',
                    'lavemen',
                    'broomstick',
                    'fasting',
                    'intravenous_infusion',
                    'dc',
                    'ngt',
                    'wsd',
                    'drainage',
                    'other_checklist',
                    'valid_date',
                    'valid_user',
                    'valid_pasien',
                    'valid_other',
                    'nurse_id',
                    'nurse_sign',
                    'doctor_marker_id',
                    'doctor_marker_sign',
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}