<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienDiagnosaModel extends Model
{
    protected $table      = 'pasien_diagnosa';
    protected $primaryKey = 'pasien_diagnosa_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'no_registration',
        'date_of_diagnosa',
        'report_date',
        'diagnosa_desc_06',
        'theid',
        'thename',
        'theaddress',
        'status_pasien_id',
        'isrj',
        'gender',
        'ageyear',
        'agemonth',
        'ageday',
        'kal_id',
        'clinic_id',
        'spesialistik',
        'employee_id',
        'doctor',
        'class_room_id',
        'bed_id',
        'result_id',
        'keluar_id',
        'in_date',
        'exit_date',
        'modified_date',
        'modified_by',
        'nosep',
        'nokartu',
        'tglsep',
        'visit_id',
        'pasien_diagnosa_id',
        'teraphy_desc',
        'pemeriksaan',
        'anamnase',
        'description',
        'diagnosa_desc_05',
        'diagnosa_desc_06',
        'anamnase',
        'pemeriksaan',
        'pemeriksaan_02',
        'pemeriksaan_03',
        'pemeriksaan_05',
        'teraphy_desc',
        'instruction',
        'morfologi_neoplasma',
        'disability',
        'rencanatl',
        'dirujukke',
        'tgl_kontrol',
        'kdpoli_kontrol',
        'procedure_05',
        'suffer_type',
        'tglkontrol'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';
}
