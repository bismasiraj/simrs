<?php

namespace App\Models;

use CodeIgniter\Model;


class AssessmentInstrumentModel extends Model
{
    protected $table = 'ASSESSMENT_INSTRUMENT';
    protected $primaryKey = 'brand_id';
    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'examination_date',
        'modified_by',
        'modified_date',
        'brand_id',
        'brand_name',
        'quantity_before',
        'quantity_intra',
        'quantity_additional',
        'quantity_after'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}