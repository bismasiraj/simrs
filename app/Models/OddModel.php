<?php

namespace App\Models;

use CodeIgniter\Model;

class OddModel extends Model
{
    protected $table      = 'pasien_prescription_detail';
    protected $primaryKey = 'bill_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'vactination_id',
        'no_registration',
        'visit_id',
        'trans_id',
        'resep_no',
        'bill_id',
        'treat_date',
        'allocated_date',
        'brand_id',
        'employee_id',
        'doctor',
        'quantity',
        'quantity_detail',
        'measure_id',
        'description',
        'dose_presc',
        'sold_status',
        'racikan',
        'description2',
        'numer',
        'iter',
        'package_id',
        'module_id',
        'dose',
        'jml_bks',
        'orig_dose',
        'resep_ke',
        'iter_ke',
        'aturanminum2',
        'modified_date',
        'modified_by',
        'modified_from',
        'valid_date',
        'valid_user',
        'valid_user_2',
        'received_date',
        'status_obat'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
