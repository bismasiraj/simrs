<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeAllModel extends Model
{
    protected $table      = 'employee_all';
    protected $primaryKey = 'employee_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = [
    //     'body_id',
    //     'petugas',
    //     'examination_date',
    //     'weight',
    //     'height',
    //     'temperature',
    //     'nadi',
    //     'tension_upper',
    //     'tension_below',
    //     'saturasi',
    //     'nafas',
    //     'arm_diameter',
    //     'anamnase',
    //     'pemeriksaan',
    //     'teraphy_desc',
    //     'description',
    //     'clinic_id',
    //     'class_room_id',
    //     'bed_id',
    //     'keluar_id',
    //     'employee_id',
    //     'no_registration',
    //     'visit_id',
    //     'org_unit_code',
    //     'doctor',
    //     'kal_id',
    //     'theid',
    //     'thename',
    //     'theaddress',
    //     'status_pasien_id',
    //     'isrj',
    //     'gender',
    //     'ageyear',
    //     'agemonth',
    //     'ageday',
    // ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    public function getEmployee()
    {
        $employeeModel = new EmployeeAllModel();
        $employee = $employeeModel->select("replace(fullname,'''','') as FULLNAME, , EMPLOYEE_ID, dpjp, specialist_type_id")->findAll();
        return $employee;
    }
}
