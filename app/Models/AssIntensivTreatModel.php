<?php

namespace App\Models;


use CodeIgniter\Model;

class AssIntensivTreatModel extends Model
{
    protected $table      = 'ASSESSMENT_INTENSIVE_TREATMENT';
    protected $primaryKey ='body_id';
    
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
        'treatment_id',
        'treatment_name',
        'results',
        'p_type',
        'parameter_id'
    ];

    protected $useTimestamps = false; // Use false if manually setting timestamps
}