<?php

namespace App\Models;

use CodeIgniter\Model;

class ClinicDoctorModel extends Model
{
    protected $table      = 'clinic_doctor';
    protected $primaryKey = 'clinic_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getSchedule()
    {
        $builder = $this->join('employee_all ea', 'clinic_doctor.employee_id = ea.employee_id')
            ->join('clinic c', 'c.clinic_id = clinic_doctor.clinic_id')
            ->select("replace(ea.fullname,'''','') as FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, ea.dpjp, ea.specialist_type_id")
            ->groupBy('ea.FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, ea.dpjp, ea.specialist_type_id')
            ->orderBy('ea.fullname');
        return $builder->findAll();
    }
}
