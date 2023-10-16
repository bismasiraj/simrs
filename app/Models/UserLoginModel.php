<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLoginModel extends Model
{
    protected $table      = 'user_login';
    protected $primaryKey = 'username';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // protected $allowedFields = ['name', 'email'];

    // Dates
    protected $useTimestamps = false;

    public function getKasir()
    {
        return $this->join('akses_operator a', "user_login.username = a.username")
            ->where("a.clinic_id like 'A001'")
            // ->orderBy("user_login.fullname")
            ->select('user_login.username, user_login.fullname')
            ->findAll();
    }
}
