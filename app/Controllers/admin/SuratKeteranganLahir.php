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
            'ORG_UNIT_CODE' => $formData['org_unit_code'],
            'NO_REGISTRATION' => $formData['no_registration'],
            'BABY_ID' => $formData['baby_id'],
            'VISIT_ID' => $formData['visit_id'],
            // 'BILL_ID' => '1',
            'CLINIC_ID' => $formData['clinic_id'],
            'DIAGNOSA_ID' => $formData['diagnosa_id'],
            'EMPLOYEE_ID' => $formData['employee_id'],
            'BABY_KE' => $jumlah_baby,
            'INSPECTION_DATE' => $formData['inspection_date'],
            // 'BIRTH_CON' => '1',
            // 'WEIGHT' => '1',
            // 'HEIGHT' => '1',
            // 'HEAD_ROUND' => '1',
            // 'ANOMALI_ID' => '1',
            // 'BREAST_FEED' => '1',
            // 'BABY_FEED' => '1',
            // 'PUSAR_ID' => '1',
            'BABY_BIRTH' => $formData['baby_birth'],
            // 'BREAST_FEED_DURATION' => '1',
            // 'START_FRUIT' => '1',
            // 'START_BUBUR' => '1',
            // 'START_TIM' => '1',
            // 'START_RICE' => '1',
            // 'DESCRIPTION' => '1',
            'MODIFIED_DATE' => $date,
            'MODIFIED_BY' => user()->username,
            'MODIFIED_FROM' => $formData['clinic_id'],
            'OBSTETRI_ID' => null,
            'THENAME' => $formData['thename'],
            'THEADDRESS' => $formData['contact_address'],
            'THEID' => $formData['pasien_id'],
            'STATUS_PASIEN_ID' => $formData['status_pasien_id'],
            'ISRJ' => $formData['isrj'],
            'AGEYEAR' => $formData['ageyear'],
            'AGEMONTH' => $formData['agemonth'],
            'AGEDAY' => $formData['ageday'],
            'GENDER' => $formData['gender'],
            'CLASS_ROOM_ID' => $formData['class_room_id'],
            'BED_ID' => $formData['bed_id'],
            'KELUAR_ID' => $formData['keluar_id'],
            'DOCTOR' => $formData['doctor'],
            'MOTHERNAME' => $formData['mothername'],
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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $baby_id = $body['baby_id'];
        $visit_id = $body['visit_id'];


        $query = $this->lowerKey($this->model->query("SELECT * FROM baby WHERE visit_id='" . $visit_id . "' AND baby_id = '" . $baby_id . "' ")->getRow());

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
            )->getRow());


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
