<?php

namespace App\Controllers\Admin\rm;



class rm1 extends \App\Controllers\BaseController
{
    public function rm1($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rm1_2($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1-2.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rm1_2a($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1-2a.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rm1_2a_2($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1-2a-2.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rm1_2b($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1-2b.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rm1_2b_2($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1-2b-2.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rm1_2c($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rm/RM1/RM-1-2c.php", [
                "visit" => $visit
            ]);
        }
    }
}
