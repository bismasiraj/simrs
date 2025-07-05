<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaModel
extends Model
{
    protected $table      = 'diagnosa';
    protected $primaryKey = 'diagnosa_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getDiagnosa($text)
    {
        return $this->select("top(20) *")->like("replace(diagnosa_id,'.','')", str_replace(".", "", $text))->orLike('name_of_diagnosa', $text)->findAll();
    }
    public function getDiagnosaGizi($text)
    {
        return $this->select("TOP(20) *")->groupStart()->like('diagnosa_id', $text)->orLike('name_of_diagnosa', $text)->groupEnd()->where('dtype', '2000')->findAll();
    }
    public function getProcedures($text)
    {
        return $this->select("top(20) *")->where("dtype", '0100')->like("replace(diagnosa_id,'.','')", str_replace(".", "", $text))->orLike('name_of_diagnosa', $text)->findAll();
    }
}
