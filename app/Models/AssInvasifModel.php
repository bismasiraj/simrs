<?php

namespace App\Models;


use CodeIgniter\Model;

class AssInvasifModel extends Model
{
    protected $table      = 'assessment_invasif_tools';
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
        'tool_id',
        'tool_name',
        'tool_location',
        'tool_size',
    ];

    protected $useTimestamps = false; // Use false if manually setting timestamps
}