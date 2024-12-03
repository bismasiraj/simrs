<?php

namespace App\Models;

use CodeIgniter\Model;

class AdermatovenerologiModel extends Model
{
    protected $table      = 'ASSESSMENT_DERMATOVENEROLOGI';
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
        'sd_ins_location',
        'sd_ins_ukk',
        'sd_ins_distribution',
        'sd_ins_configuration',
        'sd_palpation',
        'sd_others',
        'sv_inspection',
        'sv_palpation',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien',
    ];

    // Dates
    protected $useTimestamps = false;
}