<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienKonsulanModel extends Model
{
    protected $table      = 'pasien_konsulan';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'body_id',
        'no_registration',
        'visit_id',
        'document_date',
        'consul_type',
        'employee_id',
        'doctor',
        'specialist_type_id',
        'description',
        'valid_user',
        'respon_date',
        'employee_id_to',
        'doctor_to',
        'specialist_type_id_to',
        'description_to',
        'valid_user_to',
        'modified_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
