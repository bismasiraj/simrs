<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\Assessment\LokalisModel;
use App\Models\Assessment\PasienDiagnosaPerawatModel;
use App\Models\Assessment\PasienDiagnosasPerawatModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienProceduresModel;
use CodeIgniter\Controller;
use Exception;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;
use DateTime;

class DiagnosaC extends \App\Controllers\BaseController
{

    public function getAssessmentDocument()
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
        $no_registration = $body['nomor'];

        $db = db_connect();
        $selectpd = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname, st.specialist_type
                                                            from pasien_diagnosa pd 
                                                            left join employee_all ea on pd.employee_id = ea.employee_id 
                                                            left join clinic c on pd.clinic_id = c.clinic_id 
                                                            left join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPECIALIST_TYPE_ID
                                                            where no_registration = '$no_registration' and visit_id = '$visit_id'")->getResultArray());

        $selectexam = $this->lowerKey($db->query("select pd.*, c.name_of_clinic, ea.fullname 
                                                    from examination_info pd 
                                                    left join employee_all ea on pd.employee_id = ea.employee_id 
                                                    left join clinic c on pd.clinic_id = c.clinic_id where no_registration = '$no_registration' and visit_id = '$visit_id' 
                                                    and pd.ACCOUNT_ID IN ('2','3') and petugas_type In (13,11)")->getResultArray());



        // return json_encode($selectexam);
        $selectdiagnosas = [];
        $selectprocedures = [];
        $selectdiagnosasnurse = [];
        $selectlokalis = [];
        if (isset($selectpd[0])) {
            $primaryPD = "";
            foreach ($selectpd as $key => $value) {
                $primaryPD .= "'" . $value['pasien_diagnosa_id'] . "',";
            }
            $primaryPD = substr($primaryPD, 0, -1);
            $selectlokalis = $this->lowerKey($db->query("select * from assessment_lokalis where body_id in ($primaryPD)")->getResultArray());
            $primaryPD = "";
            foreach ($selectpd as $key => $value) {
                $primaryPD .= "'" . $value['pasien_diagnosa_id'] . "',";
            }
            $primaryPD = substr($primaryPD, 0, -1);

            // return ($primaryPD);
            $selectdiagnosas = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());
            $selectprocedures = $this->lowerKey($db->query("select * from pasien_procedures where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());

            $selectdiagnosasnurse = [];
        }
        if (isset($selectexam[0])) {
            $primaryExam = "";
            foreach ($selectexam as $key => $value) {
                $primaryExam .= "'" . $value['body_id'] . "',";
            }
            $primaryExam = substr($primaryExam, 0, -1);
            // return ($primaryExam);
            $selectdiagnosasnurse = $this->lowerKey($db->query("select * from pasien_diagnosa_nurse pdn inner join pasien_diagnosas_nurse pds on pdn.body_id = pds.body_id where pdn.document_id in ($primaryExam) ")->getResultArray());

            $primaryPD = "";
            foreach ($selectexam as $key => $value) {
                $primaryPD .= "'" . $value['body_id'] . "',";
            }
            $primaryPD = substr($primaryPD, 0, -1);

            // return ($primaryPD);
            $diag = $this->lowerKey($db->query("select * from pasien_diagnosas where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());
            $selectdiagnosas = array_merge($selectdiagnosas, $diag);
            $proc = $this->lowerKey($db->query("select * from pasien_procedures where pasien_diagnosa_id in ($primaryPD) ")->getResultArray());
            $selectprocedures = array_merge($selectprocedures, $proc);
        }
        return json_encode([
            'pasienDiagnosa' => $selectpd,
            'pasienDiagnosas' => $selectdiagnosas,
            'pasienProcedures' => $selectprocedures,
            'examInfo' => $selectexam,
            'pasienDiagnosasNurse' => $selectdiagnosasnurse,
            'lokalis' => $selectlokalis
        ]);
    }


    public function addAssessmentMedisDiagnosa()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return json_encode("asdf");

        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        foreach ($body as $key => $value) {
            $data[$key] = ${$key};
        }
        $data = [
            "pasien_diagnosa_id" => $pasien_diagnosa_id,
            "description" => $description,
            "anamnase" => $anamnase,
            "alloanamnase" => $alloanamnase,
            "diagnosa_desc" => $diagnosa_desc,
            "diagnosa_desc_discharge" => $diagnosa_desc_discharge,
        ];

        $pd = new PasienDiagnosaModel();
        $pd->update($pasien_diagnosa_id, $data);

        if (!empty($diagnosa_id)) {
            $pds = new PasienDiagnosasModel();
            $pds->where('pasien_diagnosa_id', $pasien_diagnosa_id)->delete();
            // return json_encode($data);

            foreach ($diagnosa_id as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $pasien_diagnosa_id;
                $dataDiag['diagnosa_id'] = $diagnosa_id[$key];
                $dataDiag['diagnosa_name'] = $diagnosa_name[$key];
                $dataDiag['diag_cat'] = $diag_cat[$key];
                // $dataDiag['suffer_type'] = $suffer_type[$key];
                $dataDiag['modified_by'] = user()->username;
                // $dataDiag['sscondition_id'] = new RawSql('newid()');

                $pds->insert($dataDiag);
            }
        }
        if (!empty($proc_id)) {
            $pcs = new PasienProceduresModel();
            $pcs->where('pasien_diagnosa_id', $pasien_diagnosa_id)->delete();

            foreach ($proc_id as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = $pasien_diagnosa_id;
                $dataProc['diagnosa_id'] = $proc_id[$key];
                $dataProc['diagnosa_name'] = $proc_name[$key];
                $dataProc['modified_by'] = user()->username;
                $pcs->insert($dataProc);
            }
        }

        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from assessment_parameter_value where VALUE_SCORE in (2, 4, 5) and P_TYPE = 'GEN0002'")->getResultArray());

        // return json_encode($doctor);

        // return json_encode($lokalisG0020206);
        $lokalisModel = new LokalisModel();
        $lokalisArray = [];

        foreach ($select as $key => $value) {
            if (isset(${'fisik' . $value['value_id']}) && $value['value_score'] == 2) {
                $dataLokalis = [
                    'body_id' => $pasien_diagnosa_id,
                    'value_detail' => ${'fisik' . $value['value_id']},
                    'modified_by' => user()->username
                ];
                $lokalisModel->set($dataLokalis)->where('body_id', $pasien_diagnosa_id)->where('value_id', $value['value_id'])->update();
                $lokalisArray[] = $dataLokalis;
            }
        }

        $array   = array('status' => 'success', 'error' => '', 'message' => "update" . ' riwayat rekam medis berhasil', 'id' => $pasien_diagnosa_id);
        return $this->response->setJSON($array);
        echo json_encode($array);
    }

    public function addDiagnosaKeperawatan()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return json_encode("asdf");

        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        foreach ($body as $key => $value) {
            $data[$key] = ${$key};
        }

        $db = db_connect();
        $org = new OrganizationunitModel();

        $id = $org->generateId();
        $pds = new PasienDiagnosasPerawatModel();
        $pdn = new PasienDiagnosaPerawatModel();
        $db->query("delete from pasien_diagnosas_nurse where body_id in (select body_id from pasien_diagnosa_nurse where document_id = '$body_id')");
        $db->query("delete from pasien_diagnosa_nurse where document_id = '$body_id'");
        $data = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'body_id' => $id,
            'document_id' => $body_id,
            'clinic_id' => $clinic_id,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'no_registration' => $no_registration,
            'examination_date' => str_replace("T", " ", $examination_date),
            'employee_id' => $employee_id,
            'petugas_id' => user()->username,
            'descriptions' => null,
            'modified_by' => user()->username,
        ];
        $pdn->insert($data);
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
                $pds->insert($dataDiag);
            }
        }

        $array   = array('status' => 'success', 'error' => '', 'message' => "update" . ' riwayat rekam medis berhasil', 'data' => $data);
        echo json_encode($array);
    }



    public function addDiagnosaDokterCppt()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return json_encode("asdf");

        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        foreach ($body as $key => $value) {
            $data[$key] = ${$key};
        }

        $db = db_connect();
        if (!empty($diagnosa_id)) {
            $pds = new PasienDiagnosasModel();
            $pds->where('pasien_diagnosa_id', $data['body_id'])->delete();
            // return json_encode($data);

            foreach ($diagnosa_id as $key => $value) {

                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $data['body_id'];
                $dataDiag['diagnosa_id'] = $diagnosa_id[$key];
                $dataDiag['diagnosa_name'] = $diagnosa_name[$key];
                $dataDiag['diag_cat'] = $diag_cat[$key];
                $dataDiag['suffer_type'] = @$suffer_type[$key];
                $dataDiag['modified_by'] = user()->username;
                $dataDiag['sscondition_id'] = new RawSql('newid()');
                // $query = `insert into pasien_diagnosas (pasien_diagnosa_id, diagnosa_id, diagnosa_name, diag_cat, modified_by, modified_date)
                // values('{$dataDiag['pasien_diagnosa_id']}','{$dataDiag['diagnosa_id']}','{$dataDiag['diagnosa_name']}', '{$dataDiag['diag_cat']}', '{$dataDiag['modified_by']}', getdate())
                // `;
                // $db->query($query);
                $pds->insertDiagnosa($dataDiag);
                // return json_encode($dataDiag);
            }
        }
        if (!empty($proc_id)) {
            $pcs = new PasienProceduresModel();
            $pcs->where('pasien_diagnosa_id', $data['body_id'])->delete();

            foreach ($proc_id as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = $data['body_id'];
                $dataProc['diagnosa_id'] = $proc_id[$key];
                $dataProc['diagnosa_name'] = $proc_name[$key];
                $dataProc['modified_by'] = user()->username;
                $pcs->insert($dataProc);
            }
        }

        $array   = array('status' => 'success', 'error' => '', 'message' => "update" . ' riwayat rekam medis berhasil', 'data' => $data);
        echo json_encode($array);
    }



    public function diagnosis_keperawatan($visit, $vactination_id = null)
    {
        $title = "Diagnosis Keperawatan - Bersihan Jalan Nafas Tidak Efektif";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $dataRequest = [];
            $kopprintData = $this->kopprint();

            if (isset($visit['d_diag_id'])) {
                $data = $this->getData_sdki($visit);
            } else {
                $data = null;
            }

            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/10-diagnosis-keperawatan.php", [
                "visit" => $visit,
                'title' => $title,
                'data' => $data,
                'kop' => $kopprintData[0],

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


    public function getData_sdki($visit)
    {
        // var_dump($visit);
        // exit();
        $formData = $this->request->getJSON();
        // $diag_id ="D.0001";
        $diag_id = $visit['d_diag_id'];

        $id =  $visit['d_id'];
        // $id =  "20240819040438075";
        $visit_id = "202408030838210037799";

        $db = db_connect();

        $date = isset($formData->date) ? $formData->date : '';
        $dateSiki = isset($formData->dateSiki) ? $formData->dateSiki : '';

        // var_dump($diag_id, $id); exit();

        //check diagnosan id tersedia atau tidak di sdki luaran
        // $checkSDKI = $this->lowerKey($db->query("
        // SELECT
        // DIAGNOSAN_ID
        // FROM ASKEP_SDKI_LUARAN WHERE DIAGNOSAN_ID = '" . $diag_id . "'
        // ")->getResultArray());

        // if (empty($checkSDKI)) {
        //     return $this->response->setJSON([
        //         'message' => 'Data Kosong',
        //         'respon' => false
        //     ]);
        // }


        $queryAskepSdkiPenyebab = $this->lowerKey($db->query("SELECT
                                                            ASKEP_SDKI.DIAGNOSAN_ID AS diag_id
                                                            , 'Penyebab'
                                                            AS child_parent
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME AS diag_name
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY_ID AS diag_val_id
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY AS diag_val_name
                                                            , ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE AS type
                                                            , MAX(
                                                                CASE WHEN ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE = ASKEP_ETIOLOGY_TYPE.ETIOLOGY_TYPE THEN ASKEP_ETIOLOGY_TYPE.ETIOLOGYTYPE ELSE ''
                                                                END
                                                            ) AS type_name
                                                            , MAX(
                                                                CASE WHEN ASKEP_SDKI_DETAIL.DETAIL_ID IS NOT NULL THEN 1 ELSE 0 END
                                                            ) AS checked FROM ASKEP_SDKI INNER JOIN ASKEP_SDKI_ETIOLOGY ON ASKEP_SDKI.DIAGNOSAN_ID = ASKEP_SDKI_ETIOLOGY
                                                            .DIAGNOSAN_ID INNER JOIN ASKEP_ETIOLOGY_TYPE ON ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE = ASKEP_ETIOLOGY_TYPE
                                                            .ETIOLOGY_TYPE INNER JOIN ASKEP_CATEGORY ON ASKEP_SDKI.ASKEP_CAT = ASKEP_CATEGORY.ASKEP_CAT LEFT JOIN ASKEP_SDKI_DETAIL ON ASKEP_SDKI_ETIOLOGY
                                                            .DIAGNOSAN_ETIOLOGY_ID = ASKEP_SDKI_DETAIL.DETAIL_ID AND ASKEP_SDKI_DETAIL.DOCUMENT_ID = '$id'
                                                            WHERE ASKEP_SDKI.DIAGNOSAN_ID = '$diag_id'
                                                            GROUP BY ASKEP_SDKI.DIAGNOSAN_ID
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY_ID
                                                            , ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY;")->getResultArray());

        $queryAskepSdkiGejala = $this->lowerKey($db->query("SELECT
                                                            ASKEP_SDKI_symptom.DIAGNOSAN_ID AS diag_id
                                                            , 'Gejala'
                                                            AS child_parent
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME AS diag_name
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOM_TYPE AS type
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOMTYPE AS type_name
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID AS diag_val_id
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM AS diag_val_name
                                                            , MAX(
                                                                CASE WHEN ASKEP_SDKI_DETAIL.DETAIL_ID IS NOT NULL THEN 1 ELSE 0 END
                                                            ) AS checked FROM ASKEP_SDKI_symptom INNER JOIN ASKEP_SYMPTOM_TYPE ON ASKEP_SDKI_symptom.SYMPTOM_TYPE = ASKEP_SYMPTOM_TYPE
                                                            .SYMPTOM_TYPE INNER JOIN ASKEP_SDKI ON ASKEP_SDKI_symptom.DIAGNOSAN_ID = ASKEP_SDKI
                                                            .DIAGNOSAN_ID LEFT JOIN ASKEP_SDKI_DETAIL ON ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID = ASKEP_SDKI_DETAIL.DETAIL_ID AND ASKEP_SDKI_DETAIL
                                                            .DOCUMENT_ID = '$id'
                                                            WHERE ASKEP_SDKI_symptom.DIAGNOSAN_ID = '$diag_id'
                                                            GROUP BY ASKEP_SDKI_symptom.DIAGNOSAN_ID
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOM_TYPE
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOMTYPE
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM;")->getResultArray());

        $queryAskepSlkiTopDate = $db->query("SELECT TOP 1  RESULT_DATE
                                            FROM ASKEP_SDKI_LUARAN_RESULTS
                                            WHERE document_id = '$id'
                                            ORDER BY RESULT_DATE DESC")->getRowArray()['RESULT_DATE'] ?? null;


        $queryAskepSlki = $db->query("SELECT 
                                        ASKEP_SDKI_LUARAN.DIAGNOSAN_ID AS diag_id,
                                        ASKEP_SDKI_LUARAN.LUARAN_NAME AS diag_name,
                                        ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE AS type,
                                        ASKEP_RELATIONAL_TYPE.RELATIONALTYPE AS type_name,
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID AS diag_val_id,
                                        ASKEP_SLKI_KRITERIA.P_TYPE AS p_type,
                                        ASKEP_SLKI_KRITERIA.KRITERIA AS diag_val_name,
                                        MAX(CASE 
                                            WHEN DATEPART(YEAR, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(YEAR, '$date')
                                            AND DATEPART(MONTH, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(MONTH, '$date')
                                            AND DATEPART(DAY, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(DAY, '$date')
                                            AND DATEPART(HOUR, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(HOUR, '$date')
                                            THEN ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE
                                            ELSE ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE
                                        END) AS RESULT_DATE,
                                        MAX(CASE 
                                            WHEN ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE IS NOT NULL 
                                            THEN 1 
                                            ELSE 0 
                                        END) AS checked
                                    FROM 
                                        ASKEP_SDKI_LUARAN
                                        INNER JOIN ASKEP_RELATIONAL_TYPE 
                                            ON ASKEP_SDKI_LUARAN.RELATIONAL_TYPE = ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE
                                        INNER JOIN ASKEP_SLKI_KRITERIA 
                                            ON ASKEP_SDKI_LUARAN.LUARAN_ID = ASKEP_SLKI_KRITERIA.LUARAN_ID 
                                        LEFT JOIN ASKEP_SDKI_LUARAN_RESULTS 
                                            ON ASKEP_SLKI_KRITERIA.KRITERIA_ID = ASKEP_SDKI_LUARAN_RESULTS.KRITERIA_ID
                                            AND ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE = 
                                                COALESCE(
                                                    (SELECT TOP 1 RESULT_DATE
                                                    FROM ASKEP_SDKI_LUARAN_RESULTS
                                                    WHERE document_id = '$id'
                                                    AND DATEPART(YEAR, RESULT_DATE) = DATEPART(YEAR, '$date')
                                                    AND DATEPART(MONTH, RESULT_DATE) = DATEPART(MONTH, '$date')
                                                    AND DATEPART(DAY, RESULT_DATE) = DATEPART(DAY, '$date')
                                                    AND DATEPART(HOUR, RESULT_DATE) = DATEPART(HOUR, '$date')
                                                    ORDER BY RESULT_DATE DESC),
                                                    (SELECT TOP 1 RESULT_DATE
                                                    FROM ASKEP_SDKI_LUARAN_RESULTS
                                                    WHERE document_id = '$id'
                                                    ORDER BY RESULT_DATE DESC)
                                                )
                                    WHERE 
                                        ASKEP_SDKI_LUARAN.DIAGNOSAN_ID = '$diag_id'
                                    GROUP BY 
                                        ASKEP_SDKI_LUARAN.DIAGNOSAN_ID,
                                        ASKEP_SDKI_LUARAN.LUARAN_NAME,
                                        ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE,
                                        ASKEP_RELATIONAL_TYPE.RELATIONALTYPE,
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID,
                                        ASKEP_SLKI_KRITERIA.KRITERIA,
                                        ASKEP_SLKI_KRITERIA.P_TYPE;")->getResultArray();



        if (empty($queryAskepSlki)) {
            $queryAskepSlkiEmpty = $db->query("
                        select KRITERIA_ID AS diag_val_id from ASKEP_SDKI_LUARAN 
                        INNER JOIN ASKEP_SLKI_KRITERIA ON ASKEP_SDKI_LUARAN.LUARAN_ID = ASKEP_SLKI_KRITERIA.LUARAN_ID
                        WHERE ASKEP_SDKI_LUARAN.DIAGNOSAN_ID = '$diag_id' ORDER BY diag_val_id")->getResultArray();
            $criteriaIds = array_column($queryAskepSlkiEmpty, 'diag_val_id');
            $criteriaIds = array_map('intval', $criteriaIds);
        } else {
            $criteriaIds = array_column($queryAskepSlki, 'diag_val_id');
            $criteriaIds = array_map('intval', $criteriaIds);
        }

        $queryDropdown = $db->query("SELECT 
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID,
                                        ASKEP_SLKI_KRITERIA.P_TYPE,
                                        ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID,  
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_ID,     
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,
                                        COALESCE(MAX(
                                            CASE 
                                                WHEN ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASKEP_SDKI_LUARAN_RESULTS.PARAMETER_ID
                                                    AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = ASKEP_SDKI_LUARAN_RESULTS.VALUE_ID
                                                    AND ASSESSMENT_PARAMETER_VALUE.VALUE_DESC = ASKEP_SDKI_LUARAN_RESULTS.VALUE_DESC
                                                    AND ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE = ASKEP_SDKI_LUARAN_RESULTS.VALUE_SCORE
                                                    AND ASKEP_SLKI_KRITERIA.KRITERIA_ID = ASKEP_SDKI_LUARAN_RESULTS.KRITERIA_ID
                                                THEN 1 
                                                ELSE 0 
                                            END
                                        ), 0) AS selected
                                    FROM 
                                        ASKEP_SLKI_KRITERIA
                                        INNER JOIN ASSESSMENT_PARAMETER_VALUE 
                                            ON ASKEP_SLKI_KRITERIA.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE 
                                            AND ASKEP_SLKI_KRITERIA.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID
                                        INNER JOIN ASKEP_SDKI_LUARAN 
                                            ON ASKEP_SLKI_KRITERIA.LUARAN_ID = ASKEP_SDKI_LUARAN.LUARAN_ID
                                        LEFT JOIN ASKEP_SDKI_LUARAN_RESULTS 
                                            ON ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASKEP_SDKI_LUARAN_RESULTS.PARAMETER_ID
                                            AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = ASKEP_SDKI_LUARAN_RESULTS.VALUE_ID
                                            AND ASSESSMENT_PARAMETER_VALUE.VALUE_DESC = ASKEP_SDKI_LUARAN_RESULTS.VALUE_DESC
                                            AND ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE = ASKEP_SDKI_LUARAN_RESULTS.VALUE_SCORE
                                            AND ASKEP_SDKI_LUARAN_RESULTS.DOCUMENT_ID = '$id'
                                            AND ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE = 
                                                COALESCE(
                                                    (
                                                        SELECT TOP 1 RESULT_DATE
                                                        FROM ASKEP_SDKI_LUARAN_RESULTS
                                                        WHERE DOCUMENT_ID = '$id'
                                                        AND DATEPART(YEAR, RESULT_DATE) = DATEPART(YEAR, '$date')
                                                        AND DATEPART(MONTH, RESULT_DATE) = DATEPART(MONTH, '$date')
                                                        AND DATEPART(DAY, RESULT_DATE) = DATEPART(DAY, '$date')
                                                        AND DATEPART(HOUR, RESULT_DATE) = DATEPART(HOUR, '$date')
                                                        ORDER BY RESULT_DATE DESC
                                                    ),
                                                    (
                                                        SELECT TOP 1 RESULT_DATE
                                                        FROM ASKEP_SDKI_LUARAN_RESULTS
                                                        WHERE DOCUMENT_ID = '$id'
                                                        ORDER BY RESULT_DATE DESC
                                                    )
                                                )
                                    WHERE 
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID IN (" . implode(',', $criteriaIds) . ")  AND ASKEP_SLKI_KRITERIA.LUARAN_ID = 'L.01001'
                                    GROUP BY 
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID,
                                        ASKEP_SLKI_KRITERIA.P_TYPE,
                                        ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID,
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_ID,     
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE
                                    ORDER BY 
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ASC;")->getResultArray();

        $slkiData = [];
        foreach ($queryAskepSlki as $slki) {
            $diag_val_id = $slki['diag_val_id'];
            if (!isset($slkiData[$diag_val_id])) {
                $slkiData[$diag_val_id] = [
                    'result_date' => $slki['RESULT_DATE'],
                    'diag_id' => $slki['diag_id'],
                    'diag_name' => $slki['diag_name'],
                    'type' => $slki['type'],
                    'type_name' => $slki['type_name'],
                    'diag_val_id' => $slki['diag_val_id'],
                    'diag_val_name' => $slki['diag_val_name'],
                    'p_type' => $slki['p_type'],
                    'checked' => $slki['checked'],
                    'selected' => []
                ];
            }
        }

        foreach ($queryDropdown as $dropdown) {
            $diag_val_id = $dropdown['KRITERIA_ID'];
            if (isset($slkiData[$diag_val_id])) {
                $slkiData[$diag_val_id]['selected'][] = [
                    'kriteria_id' => $dropdown['KRITERIA_ID'],
                    'p_type' => $dropdown['P_TYPE'],
                    'value_desc' => $dropdown['VALUE_DESC'],
                    'value_score' => $dropdown['VALUE_SCORE'],
                    'selected' => $dropdown['selected'],
                    'parameter_id' => $dropdown['PARAMETER_ID'],
                    'value_id' => $dropdown['VALUE_ID']
                ];
            }
        }

        $queryAskepSikiTopDate = $db->query("SELECT TOP 1  INTERVENSI_DATE
                                            FROM ASKEP_SDKI_INTERVENSI_RESULTS
                                            WHERE document_id = '$id'
                                            ORDER BY INTERVENSI_DATE DESC")->getRowArray()['INTERVENSI_DATE'] ?? null;

        $queryAskepSiki = $db->query("SELECT 
                                        ASKEP_SIKI.INTERVENSI_ID AS DIAG_ID,
                                        ASKEP_SIKI.INTERVENSI_NAME AS DIAG_NAME,
                                        ASKEP_SIKI_TYPE.SIKI_TYPE AS TYPE,
                                        ASKEP_SIKI_TYPE.SIKITYPE AS TYPE_NAME,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN_ID AS DIAG_VAL_ID,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN AS DIAG_VAL_NAME,
                                        MAX(CASE 
                                            WHEN DATEPART(YEAR, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(YEAR, '$dateSiki')
                                            AND DATEPART(MONTH, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(MONTH, '$dateSiki')
                                            AND DATEPART(DAY, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(DAY, '$dateSiki')
                                            AND DATEPART(HOUR, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(HOUR, '$dateSiki')
                                            THEN ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE
                                            ELSE ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE
                                        END) AS RESULT_DATE,
                                        MAX(CASE 
                                            WHEN ASKEP_SDKI_INTERVENSI_RESULTS.TINDAKAN_ID IS NOT NULL 
                                            THEN 1 
                                            ELSE 0 
                                        END) AS checked
                                    FROM 
                                        ASKEP_SIKI
                                        INNER JOIN ASKEP_SIKI_TINDAKAN 
                                            ON ASKEP_SIKI.INTERVENSI_ID = ASKEP_SIKI_TINDAKAN.INTERVENSI_ID
                                        INNER JOIN ASKEP_SIKI_TYPE 
                                            ON ASKEP_SIKI_TINDAKAN.SIKI_TYPE = ASKEP_SIKI_TYPE.SIKI_TYPE
                                        LEFT JOIN ASKEP_SDKI_INTERVENSI_RESULTS 
                                            ON ASKEP_SIKI_TINDAKAN.TINDAKAN_ID = ASKEP_SDKI_INTERVENSI_RESULTS.TINDAKAN_ID
                                            AND ASKEP_SDKI_INTERVENSI_RESULTS.DOCUMENT_ID = '$id'
                                            AND ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE = 
                                                COALESCE(
                                                    (SELECT TOP 1 INTERVENSI_DATE
                                                    FROM ASKEP_SDKI_INTERVENSI_RESULTS
                                                    WHERE DOCUMENT_ID = '$id'
                                                    AND DATEPART(YEAR, INTERVENSI_DATE) = DATEPART(YEAR, '$dateSiki')
                                                    AND DATEPART(MONTH, INTERVENSI_DATE) = DATEPART(MONTH, '$dateSiki')
                                                    AND DATEPART(DAY, INTERVENSI_DATE) = DATEPART(DAY, '$dateSiki')
                                                    AND DATEPART(HOUR, INTERVENSI_DATE) = DATEPART(HOUR, '$dateSiki')
                                                    ORDER BY INTERVENSI_DATE DESC),
                                                    (SELECT TOP 1 INTERVENSI_DATE
                                                    FROM ASKEP_SDKI_INTERVENSI_RESULTS
                                                    WHERE DOCUMENT_ID = '$id'
                                                    ORDER BY INTERVENSI_DATE DESC)
                                                )
                                    WHERE 
                                        ASKEP_SIKI.INTERVENSI_ID IN ('1.01014', '1.01011')
                                    GROUP BY 
                                        ASKEP_SIKI.INTERVENSI_ID,
                                        ASKEP_SIKI.INTERVENSI_NAME,
                                        ASKEP_SIKI_TYPE.SIKI_TYPE,
                                        ASKEP_SIKI_TYPE.SIKITYPE,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN_ID,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN;

                            ")->getResultArray();

        $slkiData = array_values($slkiData);
        $sdkiPenyebab = $this->lowerKey($queryAskepSdkiPenyebab);
        $sdkiGejala = $this->lowerKey($queryAskepSdkiGejala);
        $queryAskepSiki = $this->lowerKey($queryAskepSiki);
        $hasData = !empty($sdkiPenyebab);
        $resultDateSlki = $queryAskepSlkiTopDate ?? Null;
        $resultDateSiki = $queryAskepSikiTopDate ?? Null;


        $responseData = [
            'sdki' => [
                'penyebab' => $sdkiPenyebab ?? [],
                'Gejala' => $sdkiGejala ?? [],
            ],
            'slki' => [
                'date' => $resultDateSlki,
                'data' => $slkiData
            ],
            'siki' => [
                'diag_id' => $queryAskepSdkiPenyebab[0]['diag_id'],
                'date' => $resultDateSiki,
                'data' => $queryAskepSiki
            ]
        ];
        $formattedResponseData = $this->lowerKey($responseData);
        return  $formattedResponseData;
        // return $this->response->setStatusCode(200)->setJSON([
        //     'message' => $hasData ? 'Data retrieved successfully.' : 'No data found.', 'respon' => $hasData, 'document_id' => isset($id) ? $id : null, 'value' => $formattedResponseData
        // ]);
    }
}
