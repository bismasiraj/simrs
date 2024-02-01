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

    protected $allowedFields = [
        'sspractitioner_id',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    public function getEmployee()
    {
        $employeeModel = new EmployeeAllModel();
        $employee = $employeeModel->select("replace(fullname,'''','') as FULLNAME, , EMPLOYEE_ID, dpjp, specialist_type_id, sspractitioner_id")->where('SPECIALIST_TYPE_ID is not null')->findAll();
        return $employee;
    }
}
