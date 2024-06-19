<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class PasienTransferModel extends Model
{
    protected $table      = 'pasien_transfer';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'body_id',
        'trans_id',
        'visit_id',
        'document_id',
        'no_registration',
        'examination_date',
        'employee_id',
        'isinternal',
        'clinic_id',
        'from_petugas_id',
        'from_petugas',
        'visit_id_to',
        'bill_id',
        'document_id2',
        'clinc_id_to',
        'to_petugas_id',
        'to_petugas',
        'sign_from',
        'sign_to',
        'org_id',
        'org_name',
        'notes',
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
}
