<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Assessment\PasienDiagnosaPerawatModel;
use App\Models\Assessment\PasienDiagnosasPerawatModel;
use App\Models\Assessment\PasienTransferModel;
use App\Models\ExaminationModel;
use App\Models\OrganizationunitModel;
use CodeIgniter\Database\RawSql;

class TindakLanjut extends BaseController
{
    public function saveTransfer()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getPost();
        // $body = json_decode($body, true);

        // return json_encode($body['diagnosan_id']);
        $data = [];

        // return ($body['OBJECT_STRANGE']);
        foreach ($body as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == ''))
                $data[strtolower($key)] = $value;

            if (isset($examination_date))
                $data['examination_date'] = str_replace("T", " ", $examination_date);
        }
        if (!isset($data['employee_id']))
            $data['employee_id'] = user()->employee_id;
        if (is_null($data['employee_id']))
            $data['employee_id'] = user()->employee_id;

        $model = new PasienTransferModel();

        $model->save($data);

        $pdn = new PasienDiagnosaPerawatModel();
        $org = new OrganizationunitModel();
        $db = db_connect();
        $id = $org->generateId();
        $pds = new PasienDiagnosasPerawatModel();
        $db->query("delete from pasien_diagnosas_nurse where body_id in (select body_id from pasien_diagnosa_nurse where document_id = '$body_id')");
        $db->query("delete from pasien_diagnosa_nurse where document_id = '$body_id'");
        $dataDN = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'body_id' => $id,
            'document_id' => $body_id,
            'clinic_id' => $clinic_id,
            // 'class_room_id' => $class_room_id,
            // 'bed_id' => $bed_id,
            'no_registration' => $no_registration,
            'examination_date' => str_replace("T", " ", $examination_date),
            'employee_id' => $employee_id,
            'petugas_id' => user()->username,
            'descriptions' => null,
            'modified_by' => user()->username,
        ];
        $pdn->insert($dataDN);
        if (!empty($diagnosan_id)) {
            foreach ($diagnosan_id as $key => $value) {
                $dataDiag = [
                    'org_unit_code' => $org_unit_code,
                    'body_id' => $id,
                    'diagnosan_id' => $diagnosan_id[$key],
                    'diagnosa_date' => new RawSql("getdate()"),
                    'diag_notes' => $diag_notes[$key],
                    'modified_by' => user()->username
                ];
                // return json_encode($dataDiag);
                $pds->insert($dataDiag);
            }
        }

        return json_encode($data);
    }
    public function getTransfer()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body['visit_id']);

        $visit = $body['visit_id'];
        // $bodyId = $body['body_id'];

        $model = new PasienTransferModel();
        // if ($bodyId != '') {
        //     $select = $this->lowerKey($model->where("visit_id", $visit)->where("document_id", $bodyId)->select("*")->findAll());
        // } else {
        // }
        $select = $this->lowerKey($model->where("visit_id", $visit)->select("*, employee_all.fullname")->join("employee_all", "employee_all.employee_id = pasien_transfer.employee_id", "inner")->findAll());

        $db = db_connect();

        $queryDetil = "select *, c.name_of_clinic, ea.fullname from examination_info ei left join clinic c on c.clinic_id = ei.clinic_id left join employee_all ea on ei.employee_id = ea.employee_id
        where body_id in (";

        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id'] . "',";
        }
        $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);

        $queryDetil .= ");";

        if (count($select) > 0) {
            $examinfo = $this->lowerKey($db->query($queryDetil)->getResultArray());
        } else {
            $examinfo = [];
        }


        $queryDetil = "select * from examination_detail ei 
        where body_id in (";

        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id'] . "',";
        }
        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id2'] . "',";
        }
        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id3'] . "',";
        }
        $queryDetil = substr($queryDetil, 0, strlen($queryDetil) - 1);

        $queryDetil .= ");";

        if (count($select) > 0) {
            $examDetail = $this->lowerKey($db->query($queryDetil)->getResultArray());
        } else {
            $examDetail = [];
        }




        $queryVisit = "select ei.*, c.name_of_clinic, ea.fullname from pasien_visitation ei left join clinic c on c.clinic_id = ei.clinic_id left join employee_all ea on ei.employee_id = ea.employee_id
        where visit_id in (";

        foreach ($select as $key => $value) {
            $queryVisit .= "'" . $value['document_id'] . "',";
        }
        foreach ($select as $key => $value) {
            $queryVisit .= "'" . $value['document_id2'] . "',";
        }
        foreach ($select as $key => $value) {
            $queryDetil .= "'" . $value['document_id3'] . "',";
        }
        $queryVisit = substr($queryVisit, 0, strlen($queryVisit) - 1);

        $queryVisit .= ");";
        if (count($select) > 0) {
            $visit = $this->lowerKey($db->query($queryVisit)->getResultArray());
        } else {
            $visit = [];
        }



        return json_encode([
            'transfer' => $select,
            'examinfo' => $examinfo,
            'visit' => $visit,
            'examDetail' => $examDetail
        ]);
    }
    public function checkCppt()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit = $body['visit_id'];
        $username = $body['username'];

        $ei = new ExaminationModel();
        $checkCppt = $ei->where("visit_id", $visit)->where("petugas_id", $username)->select("body_id")->first();

        $message = [];
        if (!isset($checkCppt['body_id'])) {
            $message['cppt'] = "Dokter belum membuat CPPT. Apakah anda ingin melanjutkan membuat tindak lanjut?";
        }

        return $this->response->setJSON($message);
    }
}
