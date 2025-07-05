<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienDiagnosaModel extends Model
{
    protected $table      = 'pasien_diagnosa';
    protected $primaryKey = 'pasien_diagnosa_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'pasien_diagnosa_id',
        'no_registration',
        'visit_id',
        'clinic_id',
        'bill_id',
        'class_room_id',
        'in_date',
        'exit_date',
        'bed_id',
        'keluar_id',
        'date_of_diagnosa',
        'report_date',
        'diagnosa_id',
        'diagnosa_desc',
        'diagnosa_desc_discharge',
        'employee_id',
        'diag_cat',
        'anamnase',
        'alloanamnase',
        'description',
        'pemeriksaan',
        'body_id',
        'teraphy_desc',
        'teraphy_home',
        'therapy_target',
        'medical_problem',
        'hurt',
        'hurt_type',
        'lab_result',
        'ro_result',
        'ecg_result',
        'standing_order',
        'instruction',
        'rencanatl',
        'dirujukke',
        'tglkontrol',
        'kdpoli_kontrol',
        'suffer_type',
        'result_id',
        'modified_date',
        'modified_by',
        'modified_from',
        'status_pasien_id',
        'ageyear',
        'agemonth',
        'ageday',
        'thename',
        'theaddress',
        'theid',
        'isrj',
        'gender',
        'doctor',
        'nokartu',
        'nosep',
        'tglsep',
        'spesialistik',
        'sscondition_id',
        'valid_date',
        'valid_user',
        'valid_pasien',
        'specialist_type_id',
        'procedure_desc',
        'procedure_desc_discharge',
        'discharge_way',
        'discharge_condition',
        'emergency'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    function deletePasienDiagnosa($pasien_diagnosa_id)
    {
        return $this->db->query("update pasien_diagnosa
            set no_registration = 'x-'+no_registration,
            pasien_diagnosa_id = 'x-'+pasien_diagnosa_id,
            visit_id = 'x-'+visit_id,
            clinic_id = 'x-'+clinic_id,
            employee_id = 'x-'+employee_id
            where pasien_diagnosa_id = '$pasien_diagnosa_id'
        ");
    }
}
