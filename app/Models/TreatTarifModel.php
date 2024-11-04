<?php

namespace App\Models;

use CodeIgniter\Model;

class TreatTarifModel extends Model
{
    // protected $org_unit_code = '1771014';
    protected $table      = 'treat_tarif';
    protected $primaryKey = 'tarif_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;


    public function getTarif($klinik, $kelas, $search)
    {
        $tarif_type = ['100', '200', '300', '400', '500', '501', '600', '700', '800', '900'];
        if ($klinik == 'P013') {
            $this->select("top(50) TREAT_TARIF.TARIF_NAME,   
        AMOUNT_PAID as amount,
        TREAT_TARIF.TARIF_ID,   
        TREAT_TARIF.OTHER_ID,   
        TREAT_TARIF.TREAT_ID,   
        TREAT_TARIF.TARIF_TYPE,   
        TREAT_TARIF.ORG_UNIT_CODE,
        TREAT_TARIF.class_id,
        TREAT_TARIF.ISCITO,
        TREAT_TARIF.perda_id,
        TREAT_TARIF.CASEMIX_ID")
                ->join('treatment', 'treatment.treat_id=TREAT_TARIF.treat_id', 'inner')
                // ->like('treat_tarif.implemented', '1')
                // ->notLike('treat_tarif.treat_id', '010001')
                // ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                ->like("TREAT_TARIF.TARIF_NAME", $search)
                ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                // ->whereNotIn('tarif_type', $tarif_type)
                ->where("TREAT_TYPE in ('23')")
                // ->like('cast(class_id as varchar(10))', $kelas)
                ->orderBy('tarif_name');
            // return [];
            return $this->findAll();
        } else if ($klinik == 'P016') {
            $this->select("top(20) TREAT_TARIF.TARIF_NAME,   
        AMOUNT_PAID as amount,
        TREAT_TARIF.TARIF_ID,   
        TREAT_TARIF.OTHER_ID,   
        TREAT_TARIF.TREAT_ID,   
        TREAT_TARIF.TARIF_TYPE,   
        TREAT_TARIF.ORG_UNIT_CODE,
        TREAT_TARIF.class_id,
        TREAT_TARIF.ISCITO,
        TREAT_TARIF.perda_id,
        TREAT_TARIF.CASEMIX_ID")
                ->join('treatment', 'treatment.treat_id=TREAT_TARIF.treat_id', 'inner')
                // ->like('treat_tarif.implemented', '1')
                // ->notLike('treat_tarif.treat_id', '010001')
                // ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                ->like("TREAT_TARIF.TARIF_NAME", $search)
                // ->whereNotIn('tarif_type', $tarif_type)
                ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                ->where("TREAT_TYPE in ('08')")
                // ->like('cast(class_id as varchar(10))', $kelas)
                ->orderBy('tarif_name');
            // return [];
            return $this->findAll();
        } else if ($klinik == 'P015') {
            $this->select("top(20) TREAT_TARIF.TARIF_NAME,   
        AMOUNT_PAID as amount,
        TREAT_TARIF.TARIF_ID,   
        TREAT_TARIF.OTHER_ID,   
        TREAT_TARIF.TREAT_ID,   
        TREAT_TARIF.TARIF_TYPE,   
        TREAT_TARIF.ORG_UNIT_CODE,
        TREAT_TARIF.class_id,
        TREAT_TARIF.ISCITO,
        TREAT_TARIF.perda_id,
        TREAT_TARIF.CASEMIX_ID")
                ->join('treatment', 'treatment.treat_id=TREAT_TARIF.treat_id', 'inner')
                // ->like('treat_tarif.implemented', '1')
                // ->notLike('treat_tarif.treat_id', '010001')
                // ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                ->like("TREAT_TARIF.TARIF_NAME", $search)
                // ->whereNotIn('tarif_type', $tarif_type)
                ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')

                ->where("TREAT_TYPE in ('16')")
                // ->like('cast(class_id as varchar(10))', $kelas)
                ->orderBy('tarif_name');
            // return [];
            return $this->findAll();
        } else if ($klinik == 'P024' || $klinik == 'P015') {
            $this->select("top(20) TREAT_TARIF.TARIF_NAME,   
                AMOUNT_PAID as amount,
                TREAT_TARIF.TARIF_ID,   
                TREAT_TARIF.OTHER_ID,   
                TREAT_TARIF.TREAT_ID,   
                TREAT_TARIF.TARIF_TYPE,   
                TREAT_TARIF.ORG_UNIT_CODE,
                TREAT_TARIF.class_id,
                TREAT_TARIF.ISCITO,
                TREAT_TARIF.perda_id,
                TREAT_TARIF.CASEMIX_ID")
                ->join('treatment', 'treatment.treat_id=TREAT_TARIF.treat_id', 'inner')
                // ->like('treat_tarif.implemented', '1')
                // ->notLike('treat_tarif.treat_id', '010001')
                // ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                ->like("TREAT_TARIF.TARIF_NAME", $search)
                // ->whereNotIn('tarif_type', $tarif_type)
                ->where("TREAT_TYPE in ('16')")
                // ->like('cast(class_id as varchar(10))', $kelas)
                ->orderBy('tarif_name');
            // return [];
            return $this->findAll();
        } else if ($klinik == 'P001') {

            return $this->query("SELECT TOP 20
                TREAT_TARIF.TARIF_NAME,   
                AMOUNT_PAID AS amount,
                TREAT_TARIF.TARIF_ID,   
                TREAT_TARIF.OTHER_ID,   
                TREAT_TARIF.TREAT_ID,   
                TREAT_TARIF.TARIF_TYPE,   
                TREAT_TARIF.ORG_UNIT_CODE,
                TREAT_TARIF.class_id,
                TREAT_TARIF.ISCITO,
                TREAT_TARIF.perda_id,
                TREAT_TARIF.CASEMIX_ID
            FROM 
                TREAT_TARIF
            right JOIN 
                treatment ON treatment.treat_id = TREAT_TARIF.treat_id AND (TREAT_TARIF.TARIF_NAME LIKE '%ekg%'
                    OR TREAT_TARIF.TARIF_NAME LIKE '%ecg%'
                    OR TREAT_TARIF.TARIF_NAME LIKE '%usg%')
            WHERE 
                    TREAT_TARIF.TARIF_NAME LIKE '%$search%'
            ORDER BY 
                TREAT_TARIF.TARIF_NAME;

            ")->getResultArray();
        } else if ($klinik == 'PATOLOGI') {

            return $this->query("SELECT TOP 20
                TREAT_TARIF.TARIF_NAME,   
                AMOUNT_PAID AS amount,
                TREAT_TARIF.TARIF_ID,   
                TREAT_TARIF.OTHER_ID,   
                TREAT_TARIF.TREAT_ID,   
                TREAT_TARIF.TARIF_TYPE,   
                TREAT_TARIF.ORG_UNIT_CODE,
                TREAT_TARIF.class_id,
                TREAT_TARIF.ISCITO,
                TREAT_TARIF.perda_id,
                TREAT_TARIF.CASEMIX_ID
            FROM 
                TREAT_TARIF
            WHERE 
                    TREAT_TARIF.TARIF_NAME LIKE 'PA %' AND TREAT_TARIF.TARIF_NAME LIKE '%$search%'
            ORDER BY 
                TREAT_TARIF.TARIF_NAME;

            ")->getResultArray();
        } else {
            $this->select("top(50) case when tarif_id = '31010001' then '$search' else TREAT_TARIF.TARIF_NAME end as TARIF_NAME,   
                                    AMOUNT_PAID as amount,
                                    TREAT_TARIF.TARIF_ID,   
                                    TREAT_TARIF.OTHER_ID,   
                                    TREAT_TARIF.TREAT_ID,   
                                    TREAT_TARIF.TARIF_TYPE,   
                                    TREAT_TARIF.ORG_UNIT_CODE,
                                    TREAT_TARIF.class_id,
                                    TREAT_TARIF.ISCITO,
                                    TREAT_TARIF.perda_id,
                                    TREAT_TARIF.CASEMIX_ID")
                ->join('treatment', 'treatment.treat_id=TREAT_TARIF.treat_id', 'inner')
                // ->like('treat_tarif.implemented', '1')
                // ->notLike('treat_tarif.treat_id', '010001')
                ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
                ->where("TREAT_TARIF.TARIF_NAME like '%" . $search . "%'",)
                // ->orWhere("tarif_id = '31010001'")
                // ->whereNotIn('tarif_type', $tarif_type)
                // ->where("TREAT_TYPE in ('08')")
                // ->like('cast(class_id as varchar(10))', $kelas)
                ->orderBy('tarif_name');
            // return [];
            return $this->findAll();
        }
    }
    public function getTarifPerawat($klinik, $kelas, $search)
    {
        $tarif_type = ['100', '200', '300', '400', '500', '501', '600', '700', '800', '900'];
        $this->select("top(50) case when tarif_id = '31010001' then '$search' else TREAT_TARIF.TARIF_NAME end as TARIF_NAME,   
                                    AMOUNT_PAID as amount,
                                    TREAT_TARIF.TARIF_ID,   
                                    TREAT_TARIF.OTHER_ID,   
                                    TREAT_TARIF.TREAT_ID,   
                                    TREAT_TARIF.TARIF_TYPE,   
                                    TREAT_TARIF.ORG_UNIT_CODE,
                                    TREAT_TARIF.class_id,
                                    TREAT_TARIF.ISCITO,
                                    TREAT_TARIF.perda_id,
                                    TREAT_TARIF.CASEMIX_ID")
            ->join('treatment', 'treatment.treat_id=TREAT_TARIF.treat_id', 'inner')
            // ->like('treat_tarif.implemented', '1')
            // ->notLike('treat_tarif.treat_id', '010001')
            // ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
            ->where("TREAT_TARIF.TARIF_NAME like '%" . $search . "%'",)
            ->orWhere("tarif_id = '31010001'")
            // ->whereNotIn('tarif_type', $tarif_type)
            // ->where("TREAT_TYPE in ('08')")
            // ->like('cast(class_id as varchar(10))', $kelas)
            ->orderBy('tarif_name');
        // return [];
        return $this->findAll();
    }
}
