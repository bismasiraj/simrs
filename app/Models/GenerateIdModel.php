<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class GenerateIdModel extends Model
{
    protected $table      = 'generate_id';
    protected $primaryKey = 'treat_date';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['counterrj', 'counterri', 'treat_date'];

    // Dates
    protected $useTimestamps = false;

    public function generateResep($norm, $tgl, $clinicId, $isrj)
    {
        $tipe = 11;

        $select = $this->select('counterrj, counterri')
            ->where('clinic_id', $clinicId)
            ->where(' day(treat_date) = day(getdate()) and
            month(treat_date) = month(getdate()) and
            year(treat_date) = year(getdate())')
            ->where('doc_type', $tipe)->find();




        if ($isrj == '1') {
            $j = 'RJ';
        } else if ($isrj == '0') {
            $j = 'RI';
        }
        $themax = 0;
        if ($isrj == '1') {
            if (isset($select[0]['counterrj'])) {
                $themax += $select[0]['counterrj'];
            }
        } else if ($isrj == '0') {
            if (isset($select[0]['counterri'])) {
                $themax += $select[0]['counterri'];
            }
        }

        // return $select;


        $isset = isset($select[0]['counterrj']) || isset($select[0]['counterri']);

        $themax = (($isset)) ? $themax + 1 : 1;

        $sql = "select '$j' + right(rtrim(ltrim(str(year(getdate())))),2) +
        rtrim(ltrim(stuff(cast((month(getdate()) + 100) as varchar(3)),1,1,'')))+ 
        rtrim(ltrim(stuff(cast((day(getdate()) + 100) as varchar(3)),1,1,'')))+ 
        '$clinicId'+
        rtrim(ltrim(stuff(cast(($themax + 1000) as varchar(4)),1,1,''))) as theid ";
        $result = $this->db->query(new RawSql($sql));
        $result = $result->getResult();


        if ($isrj == '1') {
            if (!$isset) {
                $sql = "insert into generate_id (clinic_id,doc_type,treat_date,counterrj,counterri)
                VALUES (?,?,getdate(),?,0)";
                $this->db->query($sql, array($clinicId, $tipe, $themax));
            } else {
                $sql = "UPDATE generate_id SET counterrj = ?, treat_date = getdate() where clinic_id=? and
                day(treat_date) = day(getdate()) and
                month(treat_date) = month(getdate()) and
                year(treat_date) = year(getdate()) and
                doc_type=?";
                $this->db->query($sql, array($themax, $clinicId, $tipe));
            }
        } else {
            if (!$isset) {
                $sql = "insert into generate_id (clinic_id,doc_type,treat_date,counterrj,counterri)
                VALUES (?,?,getdate(),0,?)";
                $this->db->query($sql, array($clinicId, $tipe, $themax));
            } else {
                $sql = "UPDATE generate_id SET counterri = ?, treat_date = getdate() where clinic_id=? and
                day(treat_date) = day(getdate()) and
                month(treat_date) = month(getdate()) and
                year(treat_date) = year(getdate()) and
                doc_type=?";
                $this->db->query($sql, array($themax, $clinicId, $tipe));
            }
        }


        return $result[0]->theid;
    }
}
