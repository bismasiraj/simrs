<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationunitModel extends Model
{
    protected $orgUnitCode = '3372238';
    protected $table      = 'organizationunit';
    protected $primaryKey = 'org_unit_code';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['sstoken'];

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

    // public function generateId()
    // {
    //     $builder = $this->select('cast(year(getdate()) as varchar(4)) +
    //     right(cast((month(getdate()) + 100) as varchar(3)),2)+
    //     right(cast((day(getdate()) + 100) as varchar(3)),2)+
    //     right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
    //     right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
    //     right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
    //     right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as newid')->findAll();
    //     $result = $builder[0];

    //     return $result['newid'];
    // }

    function generateId()
    {
        // Get current date and time components
        $year = date('Y');
        $month = str_pad(date('n'), 2, '0', STR_PAD_LEFT);
        $day = str_pad(date('j'), 2, '0', STR_PAD_LEFT);
        $hour = str_pad(date('G'), 2, '0', STR_PAD_LEFT);
        $minute = str_pad(date('i'), 2, '0', STR_PAD_LEFT);
        $second = str_pad(date('s'), 2, '0', STR_PAD_LEFT);
        $millisecond = str_pad(round(microtime(true) * 1000) % 1000, 4, '0', STR_PAD_LEFT); // Get milliseconds

        // Generate a random part
        $randomPart = substr(md5(uniqid(rand(), true)), 0, 3); // Random string from md5

        // Concatenate to form the unique ID
        $uniqueId = $year . $month . $day . $hour . $minute . $second . $millisecond . $randomPart;

        return $uniqueId;
    }
}
