<?php

namespace App\Models;

use CodeIgniter\Model;

class ExaminationModel extends Model
{
    protected $table      = 'examination_info';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "body_id",
        "org_unit_code",
        "pasien_diagnosa_id",
        "diagnosa_id",
        "no_registration",
        "visit_id",
        "bill_id",
        "clinic_id",
        "class_room_id",
        "bed_id",
        "in_date",
        "exit_date",
        "keluar_id",
        "examination_date",

        "gcs_e",
        "gcs_v",
        "gcs_m",
        "gcs_score",
        "gcs_desc",
        "anamnase",
        "alo_anamnase",
        "pemeriksaan",
        "teraphy_desc",
        "instruction",
        "medical_treatment",
        "employee_id",
        "description",
        "modified_date",
        "modified_by",
        "modified_from",
        "status_pasien_id",
        "ageyear",
        "agemonth",
        "ageday",
        "thename",
        "theaddress",
        "theid",
        "isrj",
        "gender",
        "doctor",
        "kal_id",
        "petugas_id",
        "petugas",
        "account_id",
        "kesadaran",
        "isvalid",
        'vs_status_id'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
