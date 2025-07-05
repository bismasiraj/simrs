<?php

namespace App\Models;

use CodeIgniter\Model;

class BloodRequestModel extends Model
{
    protected $table      = 'BLOOD_REQUEST';
    protected $primaryKey = 'blood_request';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'blood_request',
        'no_registration',
        'visit_id',
        'trans_id',
        'document_id',
        'request_date',
        'blood_usage_type',
        'blood_type_id',
        'blood_quantity',
        'measure_id',
        'descriptions',
        'using_time',
        'clinic_id',
        'calf_number',
        'delivery_time',
        'terlayani',
        'transfusion_start',
        'transfusion_end',
        'reaction_desc',
        'doctor'
    ];

    // Dates
    protected $useTimestamps = false;
}