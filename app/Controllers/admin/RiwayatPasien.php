<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PasienHistoryModel;

class RiwayatPasien extends BaseController
{
    public function getData()
    {
        $body = $this->request->getBody();
        $body = json_decode($body);
        $no_registration = $body->no_registration;
        $db = db_connect();
        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = '$no_registration'")->getResultArray());

        return $this->response->setJSON($selecthistory);
    }
    public function postData()
    {
        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }

        $pasienHistory = new PasienHistoryModel();
        $db = db_connect();
        // $select = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type = 'GEN0009'")->getResultArray());
        $i = 0;
        unset($body['no_registration']);
        unset($body['org_unit_code']);
        foreach ($body as $key => $value) {
            $pasienHistory->where('no_registration', $no_registration)->where('value_id', $key)->delete();
            $select = $this->lowerKey($db->query("select value_desc from assessment_parameter_value where p_type = 'GEN0009' and value_id = '$key'")->getResultArray());
            // return json_encode($key);
            $i++;
            $data = [
                'org_unit_code' => $org_unit_code,
                'no_registration' => $no_registration,
                'item_id' => $i,
                'value_id' => $key,
                'value_desc' => $select[0]['value_desc'],
                'histories' => $value,
                'modified_by' => user()->username
            ];
            $pasienHistory->insert($data);
        }
        return $this->response->setJSON([
            'status' => "sukses"
        ]);
    }
    public function updateCheckRiwayatPasien()
    {
        $body = $this->request->getBody();
        $body = json_decode($body);
        $no_registration = $body->no_registration;
        $org_unit_code = $body->org_unit_code;
        $key = $body->value_id;
        $ischecked = $body->ischecked;
        $db = db_connect();
        $selecthistory = $this->lowerKey($db->query("select * from pasien_history where no_registration = '$no_registration'")->getResultArray());

        $pasienHistory = new PasienHistoryModel();

        if ($ischecked) {
            $select = $this->lowerKey($db->query("select right(value_id,3) as item_id,value_desc from assessment_parameter_value where p_type = 'GEN0009' and value_id = '$key'")->getResultArray());
            $i = 0;
            $data = [
                'org_unit_code' => $org_unit_code,
                'no_registration' => $no_registration,
                'item_id' => $select[0]['item_id'],
                'value_id' => $key,
                'value_desc' => $select[0]['value_desc'],
                'histories' => 1,
                'modified_by' => user()->username
            ];
            $pasienHistory->insert($data);
        } else {
            $pasienHistory->where('no_registration', $no_registration)->where('value_id', $key)->delete();
        }
        // return json_encode($key);

        return $this->response->setJSON([
            'status' => "sukses"
        ]);
    }
}
