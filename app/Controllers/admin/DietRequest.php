<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;

use CodeIgniter\Controller;

class DietRequest extends \App\Controllers\BaseController
{
    public function getData()
    {
        $db = db_connect();
        $data_diet_type = $this->lowerKey($db->query("SELECT * from diet_type")->getResultArray() ?? []);
        $diet_type = [];
        $diet_type = array_column($data_diet_type, 'dtype_id');

        $data_diet_warning = $this->lowerKey($db->query("SELECT * from diet_warning")->getResultArray() ?? []);
        $diet_warning  = [];
        $diet_warning = array_column($data_diet_warning, 'diet_warning');

        $result = [
            'diet_type' => $diet_type, // ini
            'diet_warning' => $diet_warning,
        ];


        return $this->response->setJSON(['message' => 'Data successfully.', 'respon' => true, 'data' => $result]);
    }
}
