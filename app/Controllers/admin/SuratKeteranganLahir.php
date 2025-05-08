<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\BabyModel;
use CodeIgniter\Controller;

class SuratKeteranganLahir extends \App\Controllers\BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BabyModel();
    }

    public function insertData()
    {
        $model = new BabyModel();
        $request = service('request');
        $formData = $request->getJSON(true);
        $db = db_connect();
        $date = date("Y-m-d H:i:s");
        $query = $this->lowerKey($db->query("SELECT baby_id FROM baby WHERE visit_id='" . $formData['visit_id'] . "' ")->getResultArray());
        $jumlah_baby = count($query) + 1;

        // CHECK JIKA DATA '' MAKA UBAH MENJADI NULL
        foreach ($formData as &$filter) {
            if (empty($filter)) {
                $filter = null;
            }
        }
        if (!empty($formData['inspection_date'])) {
            $formData['inspection_date'] = str_replace("T", " ", $formData['inspection_date']);
        }
        $data = [
            'org_unit_code' => $formData['org_unit_code'],
            'no_registration' => $formData['no_registration'],
            'baby_id' => $formData['baby_id'],
            'visit_id' => $formData['visit_id'],
            // 'bill_id' => '1',
            'clinic_id' => $formData['clinic_id'],
            'diagnosa_id' => $formData['diagnosa_id'],
            'employee_id' => $formData['employee_id'],
            'baby_ke' => $jumlah_baby,
            'inspection_date' => $formData['inspection_date'],
            // 'birth_con' => '1',
            // 'weight' => '1',
            // 'height' => '1',
            // 'head_round' => '1',
            // 'anomali_id' => '1',
            // 'breast_feed' => '1',
            // 'baby_feed' => '1',
            // 'pusar_id' => '1',
            'baby_birth' => $formData['baby_birth'],
            // 'breast_feed_duration' => '1',
            // 'start_fruit' => '1',
            // 'start_bubur' => '1',
            // 'start_tim' => '1',
            // 'start_rice' => '1',
            // 'description' => '1',
            'modified_date' => $date,
            'modified_by' => user()->username,
            'modified_from' => $formData['clinic_id'],
            'obstetri_id' => null,
            'thename' => $formData['thename'],
            'theaddress' => $formData['contact_address'],
            'theid' => $formData['pasien_id'],
            'status_pasien_id' => $formData['status_pasien_id'],
            'isrj' => $formData['isrj'],
            'ageyear' => $formData['ageyear'],
            'agemonth' => $formData['agemonth'],
            'ageday' => $formData['ageday'],
            'gender' => $formData['gender'],
            'class_room_id' => $formData['class_room_id'],
            'bed_id' => $formData['bed_id'],
            'keluar_id' => $formData['keluar_id'],
            'doctor' => $formData['doctor'],
            'mothername' => $formData['mothername'],
            // 'MOTHERNO' => '1',
            // 'KAL_ID' => '1'
        ];

        // $result = $model->insert($data);
        $result = $model->where(['baby_id' => $formData['baby_id'], 'visit_id' => $formData['visit_id']])
            ->set($data)
            ->update();

        return $this->response->setJSON(['message' => 'Data update successfully.', 'respon' => true, 'data' => $data]);
    }


    public function getData()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit_id = $body['visit_id'];


        $query = $this->lowerKey($this->model->query("SELECT * FROM baby WHERE visit_id='" . $visit_id . "' ")->getResultArray());

        $data = $this->lowerKey($query);

        return $this->response->setJSON($data);
    }

    public function getDetail()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $baby_id = $body['baby_id'];
        $visit_id = $body['visit_id'];


        $query = $this->lowerKey($this->model->query("SELECT * FROM baby WHERE visit_id='" . $visit_id . "' AND baby_id = '" . $baby_id . "' ")->getRow(0, 'array'));

        $data = $this->lowerKey($query);

        return $this->response->setJSON($data);
    }

    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!$formData['visit'] || !$formData['id']) {
            return ['success' => false, 'message' => 'Missing visit_id or body_id'];
        }

        $model = new BabyModel();

        $deleted = $model->where('baby_id', $formData['id'])
            ->where('visit_id', $formData['visit'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }

    public function cetakData($visit, $vactination = null)
    {

        if ($this->request->is('get')) {
            $decoded_visit = base64_decode($visit);
            $decoded_visit = json_decode($decoded_visit, true);
            $kopprintData = $this->kopprint();

            $db = db_connect();
            $visitation = $this->lowerKey($db->query("SELECT * FROM pasien_VISITATION WHERE visit_id = '" . $decoded_visit['visit_id'] . "'")->getResultArray());
            $data = $this->lowerKey($db->query(
                "
                SELECT baby.thename, baby.gender, baby.inspection_date,baby.height, baby.weight, baby.baby_ke,baby.mothername,baby.fathername,baby.fatherno,baby.theaddress, pasien.job_id, pasien.date_of_birth as father_age, JOB_CATEGORY.NAME_OF_JOB AS JOB
                FROM baby 
                LEFT OUTER JOIN PASIEN ON BABY.FATHERNO = PASIEN.NO_REGISTRATION
				LEFT OUTER JOIN JOB_CATEGORY ON PASIEN.JOB_ID = JOB_CATEGORY.JOB_ID
                WHERE BABY.visit_id = '" . $decoded_visit['visit_id'] . "' AND BABY.baby_id = '" . $decoded_visit['baby_id'] . "'
                "
            )->getRow(0, 'array'));


            return view("admin/patient/profilemodul/cetak-suratketeranganlahir.php", [
                "visit" => $decoded_visit,
                "title" => "Dokumentasi Surat Keterangan Lahir",
                'kop' => !empty($kopprintData) ? $kopprintData[0] : "",
                'visitation' => $visitation,
                'data' => $data,
            ]);
        }
    }

    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }
}
