<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class SpiritualModel extends Model
{
    protected $table      = 'assessment_spiritual';
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
        'kode_agama',
        'religion_ban',
        'myth',
        'familyrelation',
        'social_barier',
        'status',
        'modified_date',
        'modified_by',
        'religion_ban_desc',
        'myth_desc'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
