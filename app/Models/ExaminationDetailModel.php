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
        'body_id',
        'document_id',
        'vs_status_id',
        'no_registration',
        'visit_id',
        'trans_id',
        'clinic_id',
        'examination_date',
        'account_id',
        'temperature',
        'tension_upper',
        'tension_below',
        'nadi',
        'nafas',
        'weight',
        'height',
        'imt_score',
        'imt_desc',
        'saturasi',
        'arm_diameter',
        'oxygen_usage',
        'oxygen_usage_score',
        'temperature_score',
        'tension_upper_score',
        'tension_below_score',
        'nadi_score',
        'nafas_score',
        'saturasi_score',
        'awareness',
        'pain',
        'lochia',
        'general_condition',
        'cardiovascular',
        'respiration',
        'proteinuria',
        'cervix',
        'djj',
        'his_freq',
        'his_duration',
        'his_power',
        'his_symmetry',
        'child_position',
        'heart_sound',
        'oedema',
        'urine',
        'tfu',
        'uterus',
        'modified_date',
        'modified_by'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
