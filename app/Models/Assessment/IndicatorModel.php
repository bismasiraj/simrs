<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class IndicatorModel extends Model
{
    protected $table      = 'assessment_indicator';
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
        'total_score',
        'description',
        'modified_date',
        'modified_by',
        'isvalid',
        'valid_date',
        'document_id',
        'valid_pasien',
        'valid_user'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
    function deletePasienDiagnosa($document_id)
    {
        return $this->db->query("update assessment_indicator
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
