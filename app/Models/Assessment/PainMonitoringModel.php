<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class PainMonitoringModel extends Model
{
    protected $table      = 'assessment_pain_monitoring';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'no_registration',
        'examination_date',
        'clinic_id',
        'employee_id',
        'petugas_id',
        'class_room_id',
        'bed_id',
        'p_type',
        'description',
        'modified_date',
        'modified_by',
        'pain_monitoring_status',
        'document_id'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}