<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorScheduleModel extends Model
{
    protected $table      = 'doctor_schedule';
    protected $primaryKey = 'schedule_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

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

    public function getSchedule()
    {
        $builder = $this->join('employee_all ea', 'doctor_schedule.employee_id = ea.employee_id')
            ->join('clinic c', 'c.clinic_id = doctor_schedule.clinic_id')
            ->select("replace(fullname,'''','') as FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id")
            ->where('day_id is not null')
            ->where('start_time > dateadd(day,-1,getdate())')
            ->where('START_TIME < GETDATE()')
            ->groupBy('FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id')
            ->orderBy('day_id');
        return $builder->findAll();
        // $builder = $this->join('employee_all ea', 'doctor_schedule.employee_id = ea.employee_id')
        //     ->join('clinic c', 'c.clinic_id = doctor_schedule.clinic_id')
        //     ->select("replace(fullname,'''','') as FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id")
        //     ->where('day_id is not null')
        //     ->where('start_time > dateadd(day,-1,getdate())')
        //     ->where('START_TIME < GETDATE()')
        //     ->groupBy('FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id')
        //     ->orderBy('day_id');
        // return $builder->findAll();
    }
}
