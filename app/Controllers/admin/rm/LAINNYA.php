<?php

namespace App\Controllers\Admin\rm;



class lainnya extends \App\Controllers\BaseController
{
    public function lainnya_14($visit, $vactination_id = null)
    {
        $title = "Permintaan Laboratorium Patologi Anatomi (PA)";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/14-permintaan-lab.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/14-permintaan-lab.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
}
