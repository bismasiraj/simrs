<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class PainIntervensiModel extends Model
{
    protected $table      = 'assessment_pain_intervensi';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'body_id',
        'intervensi_ke',
        'no_registration',
        'p_type',
        'intervensi_date',
        'intervensi',
        'rute',
        'reassessment',
        'reassessment_date',
        'valid',
        'petugas',
        'modified_date',
        'modified_by',
        'value_id'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
