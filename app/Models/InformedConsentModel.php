<?php

namespace App\Models;

use CodeIgniter\Model;

class InformedConsentModel extends Model
{
    protected $table      = 'assessment_informed_concent';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                    'org_unit_code',
                    'visit_id',
                    'trans_id',
                    'body_id',
                    'p_type',
                    'parameter_id',
                    'value_id',
                    'value_score',
                    'value_desc',
                    'value_info',
                    'modified_date',
                    'modified_by',
                    'valid_date',
                    'valid_user',
                    'valid_pasien',
                    'valid_other',
                    'valid_other2',
                    'valid_other3',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}