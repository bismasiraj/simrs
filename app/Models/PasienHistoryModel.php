<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class PasienHistoryModel extends Model
{
    // protected $orgUnitCode = '3372238';
    protected $table      = 'pasien_history';
    protected $primaryKey = 'item_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'no_registration',
        'item_id',
        'value_id',
        'value_desc',
        'histories',
        'modified_date',
        'modified_by',
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
        $builder = $this->where('len(no_registration)', 6)
            ->where("no_registration < '949962'",)
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
