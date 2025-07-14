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
        "standing_order",
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
        "petugas_type",
        "account_id",
        "isvalid",
        'vs_status_id',
        "valid_user",
        "valid_pasien",
        "valid_date",
        "pengantarlabcppt",
        "pengantarlabcpptotherstext",
        "consul_type"
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    function deletePasienDiagnosa($pasien_diagnosa_id)
    {
        return $this->db->query("update examination_info
            set no_registration = 'x-'+no_registration,
            pasien_diagnosa_id = 'x-'+pasien_diagnosa_id,
            body_id = 'x-'+body_id,
            visit_id = 'x-'+visit_id,
            clinic_id = 'x-'+clinic_id,
            employee_id = 'x-'+employee_id
            where pasien_diagnosa_id = '$pasien_diagnosa_id'
        ");
    }
    function deleteExaminatiionInfo($body_id)
    {
        return $this->db->query("update examination_info
            set no_registration = 'x-'+no_registration,
            pasien_diagnosa_id = 'x-'+pasien_diagnosa_id,
            body_id = 'x-'+body_id,
            visit_id = 'x-'+visit_id,
            clinic_id = 'x-'+clinic_id,
            employee_id = 'x-'+employee_id
            where body_id = '$body_id'
        ");
    }
}
