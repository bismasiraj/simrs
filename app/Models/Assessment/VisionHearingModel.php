<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class VisionHearingModel extends Model
{
    protected $table      = 'ASSESSMENT_VISION_HEARING';
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
        'p_type',
        'ears',
        'swollen_pain',
        'teeth',
        'toothache',
        'denturest',
        'eyes',
        'censory_disorder',
        'censory_desc',
        'status',
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
    protected $deletedField  = 'deleted_at';
}
