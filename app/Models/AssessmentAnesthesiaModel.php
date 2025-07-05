<?php

namespace App\Models;

use CodeIgniter\Model;


class AssessmentAnesthesiaModel extends Model
{
    protected $table = 'assessment_anesthesia';
    protected $primaryKey = 'body_id';
    protected $allowedFields = [
            'org_unit_code',
            'visit_id',
            'trans_id',
            'body_id',
            'document_id',
            'examination_date',
            'modified_by',
            'modified_date',
            'start_operation',
            'end_operation',
            'start_anesthesia',
            'end_anesthesia',
            'type_of_anesthesia',
            'rooms_id',
            'losing_teeth',
            'neck_problem',
            'short_neck',
            'cough',
            'dispnea',
            'ispa',
            'abnormal_menstruation',
            'stroke',
            'chest_pain',
            'aritmia',
            'vomitus',
            'urinary_retention',
            'seizure',
            'pregnant',
            'syncope',
            'obesity',
            'system_description',
            'denture',
            'mallampati',
            'asa_class',
            'anesthesia_assessment',
            'sedation',
            'general_anesthesia',
            'regional_spinal',
            'regional_epidural',
            'regional_kaudal',
            'regional_blokperifer',
            'others_anesthesia',
            'inpatient',
            'outpatient',
            'intensive_care',
            'anesthesia_preparation',
            'nipb',
            'ipb',
            'ecg',
            'temp',
            'precordial',
            'spo2',
            'etco_2',
            'cvp',
            'an_position',
            'bleeding_amount',
            'urine_amount',
            'auto_anamnesis',
            'breathway_normal',
            'breathway_abnormal',
            'mouth_open',
            'tyromental',
            'neck_movement',
            'penyulit',
            'ijin_operasi',
            'mesin_anestesi',
            'persiapan_obat',
            'antibiotik',
            'valid_date',
            'valid_user',
            'valid_pasien',
            'valid_other',
            'signin_surgeon_id',
            'signin_surgeon_signature',
            'signin_anesthesia_id',
            'signin_anesthesia_signature',
    ];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}