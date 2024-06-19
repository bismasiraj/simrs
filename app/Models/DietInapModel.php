<?php

namespace App\Models;

use CodeIgniter\Model;

class DietInapModel extends Model
{
    protected $table      = 'diet_inap';
    protected $primaryKey = 'dtype_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "org_unit_code",
        "visit_id",
        "no_registration",
        "dtype_id",
        "clinic_id",
        "description",
        "diet_date",
        "order_date",
        "thename",
        "theaddress",
        "theid",
        "isrj",
        "ageyear",
        "agemonth",
        "ageday",
        "status_pasien_id",
        "gender",
        "employee_id",
        "doctor",
        "petugas_id",
        "petugas",
        "class_room_id",
        "bed_id",
        "keluar_id",
        "kal_id",
        "modified_date",
        "modified_by",
        "diagnosa_id",
        "diet_time",
        "dmineral_id",
        "dtypes_id",
        "dtype_pagi",
        "dtype_siang",
        "dtype_malam",
        "dtype_iddesc",
        "dtype_siangdesc",
        "dtype_malamdesc",
        "valid_id",
        "pantangan_pagi",
        "pantangan_siang",
        "pantangan_malam",
        "iscetak",
        "penunggu_pagi",
        "penunggu_siang",
        "penunggu_malam",
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
