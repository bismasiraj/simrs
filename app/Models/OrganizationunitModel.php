<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationunitModel extends Model
{
    protected $orgUnitCode = '1771014';
    protected $table      = 'organizationunit';
    protected $primaryKey = 'org_unit_code';

    protected $useAutoIncrement = false;

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

    public function getHospitalName()
    {
        return $this->select('name_of_org_unit')->find($this->orgUnitCode);
    }

    public function generateId()
    {
        $builder = $this->select('cast(year(getdate()) as varchar(4)) +
        right(cast((month(getdate()) + 100) as varchar(3)),2)+
        right(cast((day(getdate()) + 100) as varchar(3)),2)+
        right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
        right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
        right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
        right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as newid')->findAll();
        $result = $builder[0];

        return $result['newid'];
    }
}
