<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class FallRiskModel extends Model
{
    protected $table      = 'assessment_fall_risk';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'visit_id',
        'trans_id',
        'body_id',
        'document_id',
        'no_registration',
        'examination_date',
        'clinic_id',
        'employee_id',
        'petugas_id',
        'class_room_id',
        'bed_id',
        'p_type',
        'total_score',
        'description',
        'modified_date',
        'modified_by',
        'fall_risk_status',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    // Dates
    protected $useTimestamps = false;

    function deletePasienDiagnosa($document_id)
    {
        return $this->db->query("update assessment_fall_risk
            set no_registration = 'x-'+no_registration,
            document_id = 'x-'+document_id,
            body_id = 'x-'+body_id,
            clinic_id = 'x-'+clinic_id,
            employee_id = 'x-'+employee_id,
            visit_id = 'x-'+visit_id,
            trans_id = 'x-'+trans_id
            where document_id = '$document_id'
        ");
    }
}
