<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;

class DiagnosaPerawatModel extends Model
{
    protected $table      = 'ASKEP_SDKI';
    protected $primaryKey = 'diagnosa_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getDiagnosa($text)
    {
        return $this->select("top(20) *")->like('diagnosan_id', $text)->orLike('diagnosan_name', $text)->findAll();
    }
    public function getProcedures($text)
    {
        return $this->select("top(20) *")->where("dtype", '0100')->like('diagnosa_id', $text)->orLike('name_of_diagnosa', $text)->findAll();
    }
}
