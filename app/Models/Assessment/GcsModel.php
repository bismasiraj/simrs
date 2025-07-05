<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class GcsModel extends Model
{
    protected $table      = 'assessment_gcs';
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
        'p_type',
        'gcs_e',
        'gcs_v',
        'gcs_m',
        'gcs_score',
        'gcs_desc',
        'status',
        'modified_date',
        'modified_by',
        'valid_date',
        'valid_user',
        'valid_pasien'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    function deletePasienDiagnosa($document_id)
    {
        return $this->db->query("update assessment_gcs
            set no_registration = 'x-'+no_registration,
            document_id = 'x-'+document_id,
            body_id = 'x-'+body_id,
            visit_id = 'x-'+visit_id,
            trans_id = 'x-'+trans_id
            where document_id = '$document_id'
        ");
    }
}
