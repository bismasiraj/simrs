<?php

namespace App\Models;

use CodeIgniter\Model;

class ExaminationDetailModel extends Model
{
    protected $table      = 'examination_detail';
    protected $primaryKey = 'body_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        "body_id",
        "document_id",
        "no_registration",
        "visit_id",
        "clinic_id",
        "examination_date",
        "temperature",
        "tension_upper",
        "tension_below",
        "nadi",
        "nafas",
        "weight",
        "height",
        "imt_score",
        "imt_desc",
        "gcs_e",
        "gcs_v",
        "gcs_m",
        "gcs_score",
        "gcs_desc",
        "saturasi",
        "arm_diameter",
        "vs_status_id",
        "cervix",
        "djj",
        "his_freq",
        "his_duration",
        "his_power",
        "his_simetry",
        "child_position",
        "heart_sound",
        "oedema",
        "urine",
        "tfu",
        "uterus"
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
