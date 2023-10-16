<?php

namespace App\Models;

use CodeIgniter\Model;

class TreatResultModel extends Model
{
    // protected $org_unit_code = '1771014';
    protected $table      = 'treat_results';
    protected $primaryKey = 'result_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getTreatResult($nomor, $visit, $tarif)
    {
        $this->select("TREAT_RESULTS.ORG_UNIT_CODE,   
        TREAT_RESULTS.RESULT_ID,   
        TREAT_RESULTS.VISIT_ID,   
        TREAT_RESULTS.NO_REGISTRATION,   
        TREAT_RESULTS.CLINIC_ID,   
        TREAT_RESULTS.BILL_ID,   
        TREAT_RESULTS.PACKAGE_ID,   
        TREAT_RESULTS.TARIF_ID,   
        TREAT_RESULTS.TARIF_NAME,   
        TREAT_RESULTS.EMPLOYEE_ID,   
        TREAT_RESULTS.EMPLOYEE_ID_FROM,   
        TREAT_RESULTS.PICKUP_DATE,   
        TREAT_RESULTS.REAGENT_ID,  
        TREAT_RESULTS.REAGENT_NAME,     
        TREAT_RESULTS.SPECIMEN_ID,   
        TREAT_RESULTS.METHOD_ID,   
        TREAT_RESULTS.CONCLUSION,   
        TREAT_RESULTS.RESULT_VALUE,   
        TREAT_RESULTS.RESULT_ENGLISH,   
        TREAT_RESULTS.NORMAL_VALUE,    
        TREAT_RESULTS.MIN_VALUE,     
        TREAT_RESULTS.MAX_VALUE,    
        TREAT_RESULTS.CONVERSION,   
        TREAT_RESULTS.MODIFIED_DATE,   
        TREAT_RESULTS.MODIFIED_BY,   
        TREAT_RESULTS.DESCRIPTION,   
        TREAT_RESULTS.DOCTOR,   
        TREAT_RESULTS.DOCTOR_FROM,   
        TREAT_RESULTS.STATUS_PASIEN_ID,   
        TREAT_RESULTS.THENAME,   
        TREAT_RESULTS.THEADDRESS,   
        TREAT_RESULTS.AGEYEAR,   
        TREAT_RESULTS.AGEMONTH,   
        TREAT_RESULTS.AGEDAY,   
        TREAT_RESULTS.THEID,   
        TREAT_RESULTS.GENDER,   
        TREAT_RESULTS.ISRJ,   
        TREAT_RESULTS.KAL_ID,   
        TREAT_RESULTS.ISNEW,   
        TREAT_RESULTS.ISNEW_CLINIC,   
        TREAT_RESULTS.VISIT_TRANS,   
        TREAT_RESULTS.REAGENT_NAME,   
        TREAT_RESULTS.BOUND_ID,   
        TREAT_RESULTS.MEASURE_ID,   
        TREAT_RESULTS.MEASURE_ENGLISH,   
        TREAT_RESULTS.SATUAN,   
        TREAT_RESULTS.SATUAN_ENG , 
        TREAT_RESULTS.RESULT_TYPE,
        TREAT_RESULTS.NORMAL_ENGLISH,
        TREAT_RESULTS.DESC_ENGLISH,
         TREAT_RESULTS.PRINT_DATE,
        TREAT_RESULTS.PRINTED_BY,
        TREAT_RESULTS.NOTA_NO,
           TREAT_RESULTS.CLINIC_ID_FROM, TREAT_RESULTS.NOSEP")
            ->where('no_registration', $nomor)
            ->where('visit_id', $visit)
            ->where('tarif_id', $tarif)
            ->orderBy('TREAT_RESULTS.REAGENT_ID, treat_results.bound_id');
        return $this->findAll();
    }
}
