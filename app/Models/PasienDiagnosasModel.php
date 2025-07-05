<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienDiagnosasModel extends Model
{
    protected $table      = 'pasien_diagnosas';
    protected $primaryKey = 'pasien_diagnosa_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'pasien_diagnosa_id',
        'diagnosa_id',
        'diagnosa_name',
        'diagnosa_desc',
        'diag_cat',
        'suffer_type',
        'modified_by',
        'sscondition_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';


    function getData($pasien_diagnosa_id)
    {
        return $this->db->query("select * from pasien_diagnosas where pasien_diagnosa_id like '$pasien_diagnosa_id%' order by diag_cat")->getResultArray();
    }
    function getDataIn($pasien_diagnosa_id) {}

    function insertDiagnosa($dataDiag)
    {
        $sql = "INSERT INTO pasien_diagnosas 
            (pasien_diagnosa_id, diagnosa_id, diagnosa_name, diag_cat, modified_by, modified_date)
        VALUES (?, ?, ?, ?, ?, getdate())";

        return $this->db->query($sql, [
            $dataDiag['pasien_diagnosa_id'],
            $dataDiag['diagnosa_id'],
            $dataDiag['diagnosa_name'],
            $dataDiag['diag_cat'],
            $dataDiag['modified_by']
        ]);
    }
}
