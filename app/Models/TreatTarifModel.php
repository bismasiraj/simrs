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
        $this->select("top(20) TREAT_TARIF.TARIF_NAME,   
        (select sum(amount) from tarif_comp where 
        tarif_id = treat_tarif.tarif_id) as amount,    
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
            //     ->where("tarif_id in (select tarif_id from clinic_tarif where clinic_id like '$klinik' and 
            // org_unit_code=treat_tarif.org_unit_code and tarif_id =treat_tarif.tarif_id)")
            // ->where('org_unit_code', $this->org_unit_code)
            ->like('treat_tarif.implemented', '1')
            ->notLike('treat_tarif.treat_id', '010001')
            ->like("cast(isnull(TREAT_TARIF.PERDA_ID,1) as varchar(10))", '1')
            ->like("TREAT_TARIF.TARIF_NAME", $search)
            ->whereNotIn('tarif_type', $tarif_type)
            ->like('cast(class_id as varchar(10))', $kelas)
            ->orderBy('tarif_name');

        return $this->findAll();
    }
}
