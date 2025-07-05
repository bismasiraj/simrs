<?php

namespace App\Models;

use CodeIgniter\Model;



class AssessmentAnesthesiaRecoveryModel extends Model
{
    protected $table = 'assessment_anesthesia_recovery';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
        'org_unit_code',      // ORG_UNIT_CODE
        'visit_id',           // VISIT_ID
        'trans_id',           // TRANS_ID
        'body_id',            // BODY_ID
        'document_id',        // DOCUMENT_ID
        'p_type',             // P_TYPE
        'parameter_id',       // PARAMETER_ID
        'value_score',        // VALUE_SCORE
        'value_desc',         // VALUE_DESC
        'observation_date',   // OBSERVATION_DATE
        'modified_date',      // MODIFIED_DATE
        'modified_by',        // MODIFIED_BY
        'value_id'            // VALUE_ID
    ];



    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}