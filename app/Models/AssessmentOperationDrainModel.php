<?php

namespace App\Models;

use CodeIgniter\Model;


class AssessmentOperationDrainModel extends Model
{
    protected $table = 'ASSESSMENT_OPERATION_DRAIN';
    protected $primaryKey = 'document_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'document_id',
        'drain_id',
        'drain_type',
        'drain_kinds',
        'size',
        'description'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}