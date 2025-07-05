<?php

namespace App\Models;

use CodeIgniter\Model;

class FamilyManModel extends Model
{
    protected $table      = 'family';
    protected $primaryKey = 'family_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                        'org_unit_code',
                        'no_registration',
                        'family_id',
                        'family_status_id',
                        'no_registration2',
                        'fullname',
                        'isresponsible',
                        'gender',
                        'date_of_birth',
                        'place_of_birth',
                        'kode_agama',
                        'education_type_code',
                        'job_id',
                        'blood_id',
                        'maritalstatusid',
                        'address',
                        'kota',
                        'rt',
                        'rw',
                        'phone',
                        'mobile',
                        'fax',
                        'email',
                        'description',
                        'modified_date',
                        'modified_by',
                        'modified_from',
                        'country_code',
                        'sign',
                        'sign_file',
                        'nik',
        ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}