<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianFarmasiModel extends Model
{
    protected $table      = 'antrian_farmasi';
    protected $primaryKey      = 'q_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'q_id',
        'no_urut',
        'tanggal_daftar',
        'tanggal_panggil',
        'loket',
        'status_panggil',
        'no_registration',
        'thename',
        'visit_id',
    ];



    // Dates
    protected $useTimestamps = false;

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

    public function getAntrian()
    {
        $builder = $this->join('clinic c', 'loket = c.clinic_id')
            ->select("MAX(CASE when status_panggil = 2 then no_urut
                        else 0
                        end) as noUrut,
                        MAX(no_urut) as pengunjung,loket,c.NAME_OF_CLINIC")
            ->where('tanggal_daftar > CAST(CONVERT(VARCHAR(10),DATEADD(DAY, -1, GETDATE()),112) AS DATETIME)')
            ->groupBy('loket,name_of_clinic');
        return $builder->findAll();
    }
    public function getNomorAntrian($visit_id)
    {
        $builder = $this->select('no_urut')
            ->where('visit_id', $visit_id)
            ->first();

        return @$builder['no_urut'];
    }
}
