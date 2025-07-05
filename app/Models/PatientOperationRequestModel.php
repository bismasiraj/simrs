<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientOperationRequestModel extends Model
{
    protected $table      = 'PASIEN_OPERASI';
    protected $primaryKey = 'vactination_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
            'org_unit_code',
            'vactination_id',
            'no_registration',
            'visit_id',
            'bill_id',
            'trans_id',
            'clinic_id',
            'document_id',
            'validation',
            'terlayani',
            'employee_id',
            'patient_category_id',
            'vactination_date',
            'description',
            'modified_date',
            'modified_by',
            'modified_from',
            'thename',
            'theaddress',
            'theid',
            'isrj',
            'ageyear',
            'agemonth',
            'ageday',
            'status_pasien_id',
            'gender',
            'doctor',
            'kal_id',
            'class_room_id',
            'bed_id',
            'keluar_id',
            'rooms_id',
            'operation_type',
            'anestesi_type',
            'diagnosa_desc',
            'diagnosa_pra',
            'diagnosa_pasca',
            'start_operation',
            'end_operation',
            'start_anestesi',
            'end_anestesi',
            'result_id',
            'tarif_id',
            'dr_opr',
            'dr_opr1',
            'dr_opr2',
            'dr_anes',
            'perawat',
            'penata_anes',
            'perawat1',
            'perawat2',
            'koef_dokter',
            'koef_anestesi',
            'koef_ruang',
            'koef_asisten',
            'koef_alat',
            'transaksi',
            'kode_operasi',
            'operation_desc',
            'surgery_type',
            're_operation',
            'bleeding',
            'implant',
            'konsultasi',
            'komplikasi',
            'special_desc',
            'patologi_date',
            'patologi_desc',
            'patologi_label',
            'delay_desc',
            'profilaksis',
            'antibiotic_desc',
            'antibiotic_time',
            'diag_sync',
            'clinic_id_from',
            'surgical_instrument',
            'petugas_room_id',
            'petugas_room_signature',
            'petugas_ibs_id',
            'petugas_ibs_signature',
            'operation_position',
            'nomarking_desc',
            'nomarking_statement',
            'employee_id_marking',
            'employee_id_mark_sign',
            'family_name',
            'family_sign',
            'therapy_plan_doctor',
            'therapy_plan_anestesi',
            'supporting_equiptment',
            'status_mental',
            'previous_operation_type',
            'previous_operation_date',
            'previous_operation_place',
            'valid_date',
            'valid_user',
            'valid_pasien',
            'valid_other',
            'advice_doctor'
            
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}