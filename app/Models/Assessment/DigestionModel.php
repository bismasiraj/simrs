<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class DigestionModel extends Model
{
    protected $table      = 'assessment_digestion';
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
        'wasir',
        'rectal_bleed',
        'diet_type',
        'feeding_tube',
        'fluid_limit',
        'abdomen',
        'intestinal_sound',
        'bab',
        'bab_when',
        'bab_freq',
        'bab_form',
        'bab_color',
        'pencahar',
        'trouble_risk',
        'trouble_desc',
        'status',
        'modified_date',
        'modified_by',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
