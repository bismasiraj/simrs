<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class PasienModel extends Model
{
    protected $orgUnitCode = '1771014';
    protected $table      = 'pasien';
    protected $primaryKey = 'no_registration';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'name_of_pasien',
        'no_registration',
        'pasien_id',
        'class_id',
        'place_of_birth',
        'date_of_birth',
        'description',
        'contact_address',
        'rt',
        'rw',
        'kal_id',
        'phone_number',
        'mobile',
        'status_pasien_id',
        'payor_id',
        'father',
        'mother',
        'spouse',
        'education_type_code',
        'job_id',
        'blood_type_id',
        'kode_agama',
        'maritalstatusid',
        'gender',
        'coverage_id',
        'family_status_id',
        'kk_no',
        'tmt',
        'tat',
        'ttd',
        'sspasien_id',
        'father',
        'mother',
        'spouse'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPasienList($searchText = null)
    {
        return $this->select("top(20) *, (SELECT visit_id FROM TREATMENT_AKOMODASI WHERE TREATMENT_AKOMODASI.NO_REGISTRATION = pasien.NO_REGISTRATION AND KELUAR_ID = 0) as visit_id ")
            ->like('no_registration', $searchText)
            ->orLike('name_of_pasien', $searchText)->findAll();
    }
    public function getPasien($searchText)
    {
        return $this->where('no_registration', $searchText)->find();
    }
    public function getNorm()
    {
        $builder = $this
            ->where("len(no_registration) = 6
            and TRY_CAST(NO_REGISTRATION as int) IS NOT NULL
            and NO_REGISTRATION like '0%'",)
            ->select('isnull(max(convert(bigint,right(no_registration,6))),0) as themax')->findAll();

        $theMax = $builder[0]['themax'] + 1;
        $norm = $theMax + 1000000;
        $norm = strval($norm);
        $norm = substr($norm, 1, 6);
        // $theMax = $this->where('no_registration', '846202');
        return $norm;
    }

    public function getPatientListfilter($search_term)
    {
        $result = $this
            ->select("no_registration,name_of_pasien")
            ->where("no_registration", $search_term)
            ->orLike("name_of_pasien", $search_term)
            ->findAll();
        return $result;
    }
}
