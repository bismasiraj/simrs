<?php

namespace App\Models;

use CodeIgniter\Model;


class AssessmentOperationPostModel extends Model
{
    protected $table = 'ASSESSMENT_OPERATION_POST';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'infusion',
        'transfusion',
        'fasting_until',
        'drink_little',
        'free_drink',
        'eat',
        'drain_every',
        'dc_every',
        'maag_tube',
        'position',
        'instruction',
        'analgesik',
        'antiemetik',
        'antibiotik',
        'other_drugs'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}