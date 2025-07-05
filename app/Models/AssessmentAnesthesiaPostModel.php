<?php

namespace App\Models;

use CodeIgniter\Model;



class AssessmentAnesthesiaPostModel extends Model
{
    protected $table = 'assessment_anesthesia_post';
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
        'infus',
        'infus_volume',
        'transfusion',
        'fasting',
        'meal',
        'mealtime',
        'respiratory_interval',
        'postan_position',
        'oxygen',
        'oxygen_method',
        'vomitus_medicine',
        'bp_medicine',
        'postan_plan',
        'recovery_leave_time',
        'patient_destination',
          'pain', 'allergies'
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}