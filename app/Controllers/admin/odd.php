<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\OddModel;
use CodeIgniter\Controller;

class odd extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new OddModel();
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $formData['visit_id'] = '2024052721452002230C3';
        $model = new OddModel();
        $data = $this->lowerKey($model->where('visit_id', $formData['visit_id'])->findAll());

        return $this->response->setJSON($data);
    }

    public function getDetail()
    {

        $json = $this->request->getJSON();

        $visit_id = $json->visit_id;
        $body_id = $json->body_id;
        $parameter_id = $json->parameter_id;


        $model = new OddModel();

        $data = $this->lowerKey($model->where('visit_id', $visit_id)
            ->where('body_id', $body_id)
            ->where('parameter_id', $parameter_id)
            ->findAll());

        return $this->response->setJSON($data);
    }


    public function updateData()
    {
        $model = new OddModel();

        $request = service('request');
        $formData = $request->getJSON(true);

        foreach ($formData as $data) {
            if (!isset($data['bill_id'])) {
                return $this->response->setStatusCode(400)->setJSON(['error' => 'Missing bill_id in request data']);
            }
        }

        foreach ($formData as $data) {
            $update = [
                'received_date' => $data['datetime'],
                'quantity_detail' => $data['qtySend'],
                'valid_date' => date('Y-m-d H:i:s'),
                'valid_user' => user()->fullname,
            ];

            $model->where('bill_id', $data['bill_id'])
                ->set($update)
                ->update();
        }

        return $this->response->setJSON(['message' => 'Data saved successfully.', 'respon' => true]);
    }




    // public function cetakData($visit, $vactination = null)
    // {

    //     if ($this->request->is('get')) {
    //         $decoded_visit = base64_decode($visit);
    //         $decoded_visit = json_decode($decoded_visit, true);
    //         // echo '<pre>';
    //         // print_r($decoded_visit);
    //         // echo '</pre>';
    //         // exit();
    //         $kopprintData = $this->kopprint();

    //         return view("admin/patient/profilemodul/cetak-informconsern.php", [
    //             "visit" => $decoded_visit,
    //             "title" => "Informed Consent - Seksio Sesarea - MOW",
    //             "title2" => "Persetujuan Tindakan Kedokteran",
    //             'kop' => $kopprintData[0]
    //         ]);
    //     }
    // }

    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }
}
