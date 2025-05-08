<?php

namespace App\Controllers\Admin\reklaim;

use App\Controllers\BaseController;

class Cetak extends \App\Controllers\BaseController
{

    public function validateReport()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $check = $this->lowerKey($db->query("SELECT isnull(no_skpinap,no_skp) as no_sep, VISIT_ID from 
                      PASIEN_VISITATION where visit_id = '" . $formData->visit_id . "'  ")
            ->getRowArray() ?? []);

        $nosep = isset($check) && !empty($check) ? $check['no_sep'] : "";

        if (!empty($nosep)) {
            $result = true;
        } else {
            $result = false;
        }

        return $this->response->setJSON([
            'message' => 'Validation Result',
            'respon' => $result,
            'value' => ['data' => $check]
        ]);
    }

    public function cetakAllGrouping($visit)
    {
        if ($this->request->is('get')) {
            $db = db_connect();
            $decoded_visit = $this->decodeVisit($visit);
            $type = $this->request->getGet('type');
            $view = $this->request->getGet('result');
            // Fetch all data
            $kopprintData = $this->getKopprintDataE($db);
            $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
            $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
            $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['visit_id']);
            $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id']);
            $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
            $laboratorium = $this->getLaboratoriumDataE($db, $kirimlisData, $decoded_visit); // New function
            $visitation = $this->getVisitationDataE($db, $decoded_visit['visit_id']);
            $resumeMediis = $this->resume_medisE($db, $decoded_visit);
            $skdp = $this->cetakskdpE($db, $decoded_visit);
            $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit);
            $treatname = $this->tratnameE($db);
            $anotomiandPato = $this->patomiandanaE($decoded_visit['visit_id']);
            $igdTriase = $this->igdTriaseE($decoded_visit['visit_id'], $decoded_visit['session_id']);
            $persalinan = $this->persalinanE($visit, $decoded_visit['session_id']);
            $oprasi = $this->operasiE($visit);
            $anestesi = $this->anesthesiE($visit);

            $data = [
                "visit" => $decoded_visit,
                'radiologi_cetak' => $radiologi,
                'lab' => $laboratorium,
                'kop' => $kopprintData,
                'treatment_bill' => $queryTreatmenBill,
                'resep' => $queryTreatmenBillResep,
                'resumeMedis' => $resumeMediis,
                'sep' => $cetakSepAll,
                'get_treat' => $treatname,
                'skdp' => $skdp,
                'type' => $type,
                'anotomi' => $anotomiandPato,
                'triaseIgd' => $igdTriase,
                'persalinan' => $persalinan,
                'oprasi' => $oprasi,
                'anestesi' => $anestesi
            ];

            if ($view === "RIF")
                return view("admin/patient/profilemodul/formrm/reklaim/cetak-all.php", $data);
            elseif ($view === "RJF") {
                return view("admin/patient/profilemodul/formrm/reklaim/cetak-all-poli.php", $data);
            } elseif ($view === "RJI") {
                return view("admin/patient/profilemodul/formrm/reklaim/cetak-all-igd.php", $data);
            } else {
                return view("admin/patient/profilemodul/formrm/reklaim/cetak-all.php", $data);
            }

            // return $this->response->setJSON($data);
        }
    }

    private function getKopprintDataE($db)
    {
        return $this->lowerKey(
            $db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array')
        );
    }

    private function getHasilResultRadE($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query("SELECT * FROM TREAT_RESULTS WHERE VISIT_ID = ?", [$visit_id])->getResultArray()
        );
    }

    private function getRadiologiDataE($db, $hasilResultRad)
    {
        $resultIds = array_column($hasilResultRad, 'result_id');
        if (empty($resultIds)) {
            return [];
        }

        $resultIdsString = implode("','", $resultIds);
        return $this->lowerKey(
            $db->query(
                "SELECT TREAT_RESULTS.ORG_UNIT_CODE, TREAT_RESULTS.RESULT_ID, TREAT_RESULTS.VISIT_ID, TREAT_RESULTS.NO_REGISTRATION, 
                        TREAT_RESULTS.TARIF_ID, TREAT_RESULTS.TARIF_NAME, TREAT_RESULTS.EMPLOYEE_ID, TREAT_RESULTS.EMPLOYEE_ID_FROM, 
                        TREAT_RESULTS.PICKUP_DATE, TREAT_RESULTS.RESULT_VALUE, TREAT_RESULTS.THENAME, TREAT_RESULTS.THEADDRESS, 
                        TREAT_RESULTS.AGEYEAR, TREAT_RESULTS.AGEMONTH, TREAT_RESULTS.AGEDAY, TREAT_RESULTS.nota_no, TREAT_RESULTS.GENDER, 
                        TREAT_RESULTS.KAL_ID, TREAT_RESULTS.BOUND_ID, TREAT_RESULTS.MEASURE_ID, TREAT_RESULTS.DOCTOR_FROM, 
                        TREAT_RESULTS.DOCTOR, C.NAME_OF_CLINIC, TREAT_RESULTS.PRINT_DATE, TREAT_RESULTS.PRINTED_BY, 
                        TREAT_RESULTS.PRINTQ, TREAT_RESULTS.description, TREAT_RESULTS.CONCLUSION, TREAT_RESULTS.THEID, 
                        TREAT_RESULTS.NOSEP, TREAT_RESULTS.isvalid, TREAT_RESULTS.valid_date, TREAT_RESULTS.iskritis 
                 FROM TREAT_RESULTS 
                 JOIN CLINIC C ON TREAT_RESULTS.CLINIC_ID = C.CLINIC_ID
                 WHERE TREAT_RESULTS.RESULT_ID IN ('$resultIdsString')
                 ORDER BY TREAT_RESULTS.REAGENT_ID, TREAT_RESULTS.BOUND_ID"
            )->getResultArray()
        );
    }

    private function getTreatmentBillE($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query(
                "SELECT 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
                    tb.doctor,
                    tb.thename,
					tb.sell_price,
                    tb.CLINIC_ID,
					tb.QUANTITY * tb.sell_price as subtotal,
					tb.QUANTITY,
                    tt.TARIF_ID AS tarif_id_tt,
                    tt.ORG_UNIT_CODE AS org_unit_code_tt,
                    tt.TARIF_NAME AS tarif_name_tt,
                    cm.CASEMIX_ID,
                    cm.CASEMIX
                FROM 
                    TREATMENT_BILL tb
                JOIN 
                    TREAT_Tarif tt ON tb.ORG_UNIT_CODE = tt.ORG_UNIT_CODE 
                                AND tb.TARIF_ID = tt.TARIF_ID
                JOIN 
                    CASEMIX cm ON tt.CASEMIX_ID = cm.CASEMIX_ID
                WHERE 
                    tb.VISIT_ID = ?
                    AND tb.QUANTITY <> 0
                GROUP BY 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
					tb.QUANTITY,
                    tb.CLINIC_ID,
					tb.sell_price,
                    tb.doctor,
                    tb.thename,
                    tt.TARIF_ID,
                    tt.ORG_UNIT_CODE,
                    tt.TARIF_NAME,
                    cm.CASEMIX_ID,
                    cm.CASEMIX",

                [$visit_id]
            )->getResultArray()
        );
    }

    private function getTreatmentBillResepE($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query(
                "SELECT 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
                    tb.doctor,
                    tb.thename,
                    tb.description,
                    tb.sell_price,
                    tb.QUANTITY * tb.sell_price as subtotal,
                    tb.QUANTITY,
                    tt.TARIF_ID AS tarif_id_tt,
                    tt.ORG_UNIT_CODE AS org_unit_code_tt,
                    tt.TARIF_NAME AS tarif_name_tt,
                    cm.CASEMIX_ID,
                    cm.CASEMIX
                FROM 
                    TREATMENT_BILL tb
                JOIN 
                    TREAT_Tarif tt ON tb.ORG_UNIT_CODE = tt.ORG_UNIT_CODE 
                                AND tb.TARIF_ID = tt.TARIF_ID
                JOIN 
                    CASEMIX cm ON tt.CASEMIX_ID = cm.CASEMIX_ID
                WHERE 
                    tb.VISIT_ID = ? 
                    AND tb.brand_id IS NOT NULL
                GROUP BY 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
                    tb.QUANTITY,
                    tb.description,
                    tb.sell_price,
                    tb.doctor,
                    tb.thename,
                    tt.TARIF_ID,
                    tt.ORG_UNIT_CODE,
                    tt.TARIF_NAME,
                    cm.CASEMIX_ID,
                    cm.CASEMIX",

                [$visit_id]
            )->getResultArray()
        );
    }

    private function getKirimlisDataE($db, $queryTreatmenBill)
    {
        $filteredBills = array_filter($queryTreatmenBill, function ($item) {
            return $item['clinic_id'] === "P013";
        });
        $billIds = array_column($filteredBills, 'bill_id');

        if (empty($billIds)) {
            return [];
        }

        $billIdString = implode("','", $billIds);

        return $this->lowerKey(
            $db->query(
                "SELECT kode, kode_kunjungan
                 FROM sharelis.dbo.kirimlis 
                 WHERE kode IN ('$billIdString')
                 GROUP BY kode, kode_kunjungan"
            )->getResultArray()
        );
    }

    private function getLaboratoriumDataE($db, $kirimlisData, $decoded_visit)
    {
        $kode_kunjungan = array_column($kirimlisData, 'kode_kunjungan');
        $visit_date = $decoded_visit['visit_date'];


        $start_date = $visit_date . " 00:00:00";


        $end_date = date('Y-m-d H:i:s');

        if (empty($kode_kunjungan)) {
            return [];
        }

        $kode_kunjunganString = implode("','", $kode_kunjungan);
        $oprasi = $this->lowerKey(
            $db->query(
                "SELECT 
                        H.nolab_lis, 
                        H.kode_kunjungan, 
                        H.tarif_id, 
                        H.tarif_name, 
                        H.kel_pemeriksaan, 
                        H.urut_bound, 
                        H.PARAMETER_NAME, 
                        H.hasil, 
                        H.satuan, 
                        H.NILAI_RUJUKAN, 
                        H.METODE_PERIKSA, 
                        NULL AS kode, 
                        H.reg_date AS tgl_hasil, 
                        H.norm, 
                        K.nama, 
                        K.alamat, 
                        K.date_of_birth, 
                        K.cara_bayar_name, 
                        K.pengirim_name, 
                        K.ruang_name, 
                        K.kelas_name, 
                        K.Tgl_Periksa, 
                        H.flag_hl
                    FROM 
                        sharelis.dbo.hasillis H
                    LEFT OUTER JOIN 
                        sharelis.dbo.kirimlis K 
                        ON H.norm COLLATE database_default = K.no_pasien COLLATE database_default 
                        AND H.kode_kunjungan = K.Kode_Kunjungan
                    WHERE 
                        H.kode_kunjungan IN ('$kode_kunjunganString')
                        AND H.reg_date BETWEEN '$start_date' 
                        AND COALESCE('$end_date', GETDATE())
                    GROUP BY 
                        H.nolab_lis, 
                        H.kode_kunjungan, 
                        H.tarif_id, 
                        H.tarif_name, 
                        H.kel_pemeriksaan, 
                        H.urut_bound, 
                        H.PARAMETER_NAME, 
                        H.hasil, 
                        H.satuan, 
                        H.NILAI_RUJUKAN, 
                        H.METODE_PERIKSA, 
                        K.Tgl_Periksa, 
                        H.reg_date, 
                        H.norm, 
                        K.nama, 
                        K.alamat, 
                        K.date_of_birth, 
                        K.cara_bayar_name, 
                        K.pengirim_name, 
                        K.ruang_name, 
                        K.kelas_name, 
                        H.flag_hl
                    ORDER BY 
                        H.kode_kunjungan;
                    "
            )->getResultArray()
        );


        $doctor = $this->lowerKey($db->query("SELECT fullname from EMPLOYEE_ALL where NONACTIVE= 0 and employee_id in (select employee_id from DOCTOR_SCHEDULE where clinic_id ='P013')")->getRowArray());
        $username_valid = $this->lowerKey($db->query("SELECT users.username,
                                            isnull(EMPLOYEE_ALL.fullname, users.username) as fullname
                                        FROM 
                                            USERS
                                        left outer JOIN 
                                            EMPLOYEE_ALL 
                                            ON USERS.employee_id = EMPLOYEE_ALL.employee_id
                                            WHERE users.username = '" . user()->username . "'  
                                            
                                ")->getRowArray());

        if ($username_valid) {
            $visit['valid_users_p'] = $username_valid['fullname'];
        }


        if ($doctor) {
            $visit['doctor_responsible'] = $doctor['fullname'];
        }

        return ([
            'visit' => $visit,
            'data' => $oprasi
        ]);
    }

    private function getVisitationDataE($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query(
                "SELECT * FROM PASIEN_VISITATION WHERE VISIT_ID = ?",
                [$visit_id]
            )->getResultArray()
        );
    }

    private function resume_medisE($db, $visit, $vactination_id = null)
    {

        // var_dump($visit);


        // exit();
        $title = "Resume Medis";
        if ($this->request->is('get')) {
            // $visit = base64_decode($visit);
            // $visit = json_decode($visit, true);
            $db = db_connect();
            $id_diag = $db->query("SELECT TOP (1) pasien_diagnosa_id FROM PASIEN_DIAGNOSA WHERE VISIT_ID = '" . $visit['visit_id'] . "' ORDER BY IN_DATE DESC")->getRowArray();

            $select = $this->lowerKey($db->query("SELECT 
            pd.NO_REGISTRATION as no_RM,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end as jeniskel,
            p.CONTACT_ADDRESS as alamat,
            pd.DOCTOR as dpjp,
            c.name_of_clinic as departemen,
            class.NAME_OF_CLASS as kelas,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID as bed,
            pd.IN_DATE as tanggal_masuk,
            convert(varchar,P.DATE_OF_BIRTH,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
            gcs.GCS_E,
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE as gcs,
            pd.DIAGNOSA_ID as icd10,
            pd.DIAGNOSA_DESC as namadiagnosa,
            pd.ANAMNASE as anamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090101'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090201'  then histories else '' end ) as riwayat_penyakit_keluarga,
            max(case when PH.value_id = 'G0090301'  then histories else '' end ) as riwayat_alkohol,
            max(case when PH.value_id = 'G0090302'  then histories else '' end ) as riwayat_merokok,
            max(case when PH.value_id = 'G0090303'  then histories else '' end ) as riwayat_diet,
            max(case when PH.value_id = 'G0090401'  then histories else '' end ) as riwayat_obat_dikonsumsi,
            max(case when PH.value_id = 'G0090402'  then histories else '' end ) as riwayat_kehamilan,
            max(case when PH.value_id = 'G0090403'  then histories else '' end ) as riwayat_imunisasi,
            ed.WEIGHT as berat,
            ed.HEIGHT as tinggi,
            ed.TENSION_UPPER as tensi_atas,
            ed.TENSION_BELOW as tensi_bawah,
            ed.nadi,
            ed.TEMPERATURE AS Suhu,
            ed.NAFAS as respiration,
            ed.SATURASI AS SPO2,
            ed.WEIGHT/ ( (CAST( ed.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( ed.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) AS IMT,
            isnull((select top(1) total_score from ASSESSMENT_FALL_RISK
            where DOCUMENT_ID = pd.BODY_ID order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
            isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
            where DOCUMENT_ID = pd.BODY_ID order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
            max(case when ALO.value_id = 'G0020103'  then ALO.VALUE_DESC else '' end) as PF_KEPALA,
            max(case when ALO.value_id = 'G0020203'  then ALO.VALUE_DESC else '' end) as PF_MATA,
            max(case when ALO.value_id = 'G0020403'  then ALO.VALUE_DESC else '' end) as PF_HIDUNG,
            max(case when ALO.value_id = 'G0020303'  then ALO.VALUE_DESC else '' end) as PF_TELINGA,
            max(case when ALO.value_id = 'G0020503'  then ALO.VALUE_DESC else '' end) as PF_MULUT,
            max(case when ALO.value_id = 'G0020603'  then ALO.VALUE_DESC else '' end) as pf_LEHER,
            max(case when ALO.value_id = 'G0021403'  then ALO.VALUE_DESC else '' end) as PF_GIGI,
            max(case when ALO.value_id = 'G0020703'  then ALO.VALUE_DESC else '' end) as PF_THORAX,
            max(case when ALO.value_id = 'G0020703'  then ALO.VALUE_INFO else '' end) as LINK_THORAX,
            max(case when ALO.value_id = 'G0020803'  then ALO.VALUE_DESC else '' end) as PF_JANTUNG,
            max(case when ALO.value_id = 'G0020903'  then ALO.VALUE_DESC else '' end) as PF_PARU,
            max(case when ALO.value_id = 'G0021003'  then ALO.VALUE_DESC else '' end) as PF_PERUT,
            max(case when ALO.value_id = 'G0021003'  then ALO.VALUE_INFO else '' end) as GAMBAR_PERUT,
            max(case when ALO.value_id = 'G0021803'  then ALO.VALUE_DESC else '' end) as PF_hepar,
            max(case when ALO.value_id = 'G0021903'  then ALO.VALUE_DESC else '' end) as PF_lien,
            max(case when ALO.value_id = 'G0021303'  then ALO.VALUE_DESC else '' end) as PF_GINJAL,
            max(case when ALO.value_id = 'G0021703'  then ALO.VALUE_DESC else '' end) as PF_GENITAIS,
            max(case when ALO.value_id = 'G0021503'  then ALO.VALUE_DESC else '' end) as PF_EKSTERMITAS_ATAS,
            max(case when ALO.value_id = 'G0021603'  then ALO.VALUE_DESC else '' end) as PF_EXTERMINTAS_BAWAH,
            PD.DIAGNOSA_ID,
            PD.MEDICAL_PROBLEM AS MASALAH_MEDIS,
            'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
            PD.HURT AS PENYEBAB_CIDERA,
            PD.THERAPY_TARGET AS SASARAN,
            PD.LAB_RESULT AS LABORATORIUM,
            PD.RO_RESULT AS RADIOLOGI,
            PD.TERAPHY_DESC AS FARMAKOLOGIA,
            PD.INSTRUCTION AS PROSEDUR,
            PD.STANDING_ORDER AS STANDING_ORDER,
            PD.DOCTOR AS DOKTER
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            --
           LEFT OUTER JOIN 
                EXAMINATION_INFO ei 
                ON ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN 
                EXAMINATION_DETAIL ed 
                ON ed.body_id = ei.body_id
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
            pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '" . @$id_diag['pasien_diagnosa_id'] . "'
            and PD.VISIT_ID = '" . $visit['visit_id'] . "' -- 
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.NO_REGISTRATION, 
            p.NAME_OF_PASIEN, 
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end, 
            p.CONTACT_ADDRESS,
            pd.DOCTOR, 
            c.name_of_clinic, 
            class.NAME_OF_CLASS,  
            cr.NAME_OF_CLASS,  
            pd.BED_ID,  
            pd.IN_DATE,
            pd.ANAMNASE, 
            pd.DESCRIPTION,
            ed.WEIGHT,
            ed.HEIGHT, 
            ed.TENSION_UPPER, 
            ed.TENSION_BELOW, 
            ed.nadi,
            ed.NAFAS, 
            ed.SATURASI,
            ed.TEMPERATURE,
            convert(varchar,P.date_of_birth,105),
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR',
            gcs.GCS_E, 
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE, 

            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            ed.WEIGHT/ ( (CAST( ed.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( ed.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ), 
            THERAPY_TARGET,
            PD.LAB_RESULT, 
            PD.RO_RESULT,
            PD.TERAPHY_DESC, 
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR")->getResultArray());



            $body_idlokalis = $db->query("
                SELECT TOP 1 body_id 
                FROM assessment_lokalis 
                WHERE VISIT_ID = '" . $visit['visit_id'] . "' 
                AND VALUE_SCORE = 2 
                ORDER BY modified_date DESC
            ")->getRowArray();
            $selectlokalis2 = $this->lowerKey($db->query(
                "select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                where body_id  = '" . @$body_idlokalis['body_id'] . "' AND assessment_lokalis.VALUE_SCORE = 2"
            )->getResultArray());
            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    ATURANMINUM2 AS SIGNATURA,
                    MAX(TREAT_DATE) AS tanggal_selesai,
                    MIN(TREAT_DATE) AS tanggal_mulai

                FROM PASIEN_PRESCRIPTION_DETAIL
                WHERE VISIT_ID = '" . $visit['visit_id'] . "'
                GROUP BY DESCRIPTION, ATURANMINUM2, TREAT_DATE
                "
            )->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            // $selectinfo = $this->query_template_info($db, $id, $pasien_diagnosa_id_con) ?? [];

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => @$select[0],
                "organization" => $selectorganization,
                // "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe
            ]);
        }
    }

    private function cetakskdpE($db, $visit)
    {


        $check = $this->lowerKey($db->query("SELECT isnull(no_skpinap,no_skp) as no_sep, VISIT_ID from 
                PASIEN_VISITATION where visit_id = '" . $visit['visit_id'] . "'  
            ")->getRowArray() ?? []);
        $nosep = isset($check) && !empty($check) ? $check['no_sep'] : "";
        // $pasien = json_decode(base64_decode($pasien), true);
        $pasien = $this->lowerKeyOne($db->query("SELECT
         INASIS_KONTROL.NOSEP,  
         INASIS_KONTROL.TGLRENCKONTROL AS TGL_KONTROL_SELANJUTNYA,  
         INASIS_KONTROL.POLIKONTROL_KDPOLI,   
         INASIS_KONTROL.POLIKONTROL_NMPOLI,  
         INASIS_KONTROL.KODEDOKTER,
         INASIS_KONTROL.MODIFIED_BY,   
         INASIS_KONTROL.MODIFIED_DATE,   
		INASIS_KONTROL.NOSURATKONTROL,
		INASIS_KONTROL.SURATTYPE,
		PD.THEID AS NO_bpjS,
		PD.THENAME AS NAMA,
		pd.THEADDRESS as alamat,
		pd.GENDER as jeniskel,
		PD.NO_REGISTRATION AS NO_RM, 
		convert(varchar,PV.tgl_lahir,105) as date_of_birth,
		CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
		CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
		Pd.DIAGNOSA_DESC as diagnosis,
		PD.DIAGNOSA_ID as kode_diagnosa,
		pd.TERAPHY_DESC as farmakologi,
		igt.nama as alasan_kontrol,
		pd.DOCTOR as dpjp,
		pv.IN_DATE as tgl_masuk,
		cr.NAME_OF_CLASS as bangsal,
		pd.BED_ID no_tt,
		c.NAME_OF_CLASS as kelas,
		st.SPECIALIST_TYPE

            FROM INASIS_KONTROL left outer join  pasien_visitation pv on inasis_kontrol.nosep = isnull(pv.no_skp,pv.no_skpinap)
            inner join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            where  INASIS_KONTROL.NOSEP = '$nosep'  --diganti dengan no sep yang berlaku
            and surattype = '1' -- skdp = 1 , spri = 2
             and pd.DIAG_CAT =  1")->getFirstRow('array'));
        $select = array_merge($visit, $pasien);
        // $pv = new PasienVisitationModel();
        // $select = $this->lowerKeyOne($pv->find($visit));

        $db = db_connect();
        $rooms = $this->lowerKey($db->query("select * from rooms")->getResultArray());
        $tiket = (string)(1000 + $select['ticket_no']);
        $select['urutan'] = '';
        foreach ($rooms as $key => $value) {
            if ($select['clinic_id'] == $value['buildings_id']) {
                $select['urutan'] = $value['rooms_id'] . "-" . substr($tiket, 1, 3);
                break;
            }
        }


        // var_dump($visit); exit();


        // var_dump($select);
        // exit();
        $data['json'] = $select;
        // dd($data);
        return $data;
    }

    private function cetakSepAllE($db, $visit)
    {
        // $visit = json_decode(base64_decode($visit), true);
        // $pasien = json_decode(base64_decode($pasien), true);
        $pasien = $this->lowerKeyOne($db->query("SELECT PASIEN_VISITATION.NO_REGISTRATION,   
        PASIEN_VISITATION.VISIT_ID,   
        PASIEN_VISITATION.STATUS_PASIEN_ID,   
        PASIEN_VISITATION.VISIT_DATE,   
        PASIEN_VISITATION.CLINIC_ID,   
        PASIEN_VISITATION.EMPLOYEE_ID,
        pasien_visitation.visit_date,
        pasien.name_of_pasien  , 
        pasien.contact_address,
        pasien.date_of_birth,
        pasien.gender,
        pasien_visitation.rujukan_id,
        pasien_visitation.no_skp,
        pasien.pasien_id,
        pasien.kk_no,
        pasien_visitation.class_id,
        address_of_rujukan,
        PASIEN_VISITATION.RUJUKAN_ID,
        pasien_visitation.keluar_id,
        pasien_visitation.description,
        pasien_visitation.account_id,
        pasien.coverage_id,
        in_date, pasien_visitation.diag_awal, pasien_visitation.conclusion, pasien_visitation.COB
        , pasien_visitation.asalrujukan
        , pasien_visitation.ppkrujukan
        ,ROOMS_ID +'-'+ RIGHT(1000 +TICKET_NO,3) AS URUTAN
            FROM PASIEN_VISITATION   left outer join rooms on clinic_id = buildings_id  , pasien 
            WHERE PASIEN_VISITATION.NO_REGISTRATION='" . $visit['no_registration'] . "' AND
                PASIEN_VISITATION.VISIT_ID='" . $visit['visit_id'] . "' and 
                    pasien.no_registration = pasien_visitation.no_registration")->getFirstRow('array'));
        $select = array_merge($visit, $pasien);
        // $pv = new PasienVisitationModel();
        // $select = $this->lowerKeyOne($pv->find($visit));

        $db = db_connect();



        // var_dump($visit); exit();


        // var_dump($select);
        // exit();
        $data['json'] = $select;
        // dd($data);
        return $data;
    }

    private function tratnameE($db)
    {
        $sql = $this->lowerKey($db->query('select TARIF_ID, TARIF_NAME from TREAT_TARIF')->getResultArray());

        return $sql;
    }

    private function decodeVisit($visit)
    {
        $decoded_visit = base64_decode($visit);
        return json_decode($decoded_visit, true);
    }

    private function patomiandanaE($visit_id)
    {
        $db = db_connect();

        $queryPenunjang = $db->query(
            "SELECT file_image FROM pasien_penunjang WHERE VISIT_ID = ? AND CLINIC_ID = 'P013'",
            [$visit_id]
        )->getResultArray();

        $queryTreatResult = $db->query(
            "SELECT treat_image AS file_image FROM TREAT_RESULTS WHERE CLINIC_ID IN ('P016', 'P023') AND VISIT_ID = ?",
            [$visit_id]
        )->getResultArray();

        $result = array_merge($queryPenunjang, $queryTreatResult);
        return $this->lowerKey($result);
    }

    private function igdTriaseE($visit_id, $session_id)
    {
        $db = db_connect();
        $result = $this->lowerKey($db->query(
            "SELECT 
                        isnull((select top(1) 
                            case 
                                when total_score = 5 then 'ATS V' 
                                when total_score = 4 then 'ATS IV'
                                when total_score = 3 then 'ATS III'
                                when total_score = 2 then 'ATS II'
                                when total_score = 1 then 'ATS I' 
                            end 
                        from ASSESSMENT_INDICATOR
                        where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID 
                        order by EXAMINATION_DATE desc), '') as ATS_Tipe,
                        
                        STUFF(
                            (SELECT ',' + value_desc
                            FROM ASSESSMENT_INDICATOR_DETAIL aid
                            WHERE aid.BODY_ID IN (
                                select BODY_ID 
                                from ASSESSMENT_INDICATOR 
                                where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID)
                            FOR XML PATH ('')
                            ), 1, 1, '') as ATS_ITEM
                    FROM 
                        pasien_diagnosa pd
                    LEFT OUTER JOIN ASSESSMENT_INDICATOR ai 
                        ON pd.PASIEN_DIAGNOSA_ID = ai.DOCUMENT_ID
                    WHERE 
                        pd.PASIEN_DIAGNOSA_ID = ?
                        AND pd.VISIT_ID = ?
                    GROUP BY 
                        pd.PASIEN_DIAGNOSA_ID;",
            [$visit_id, $session_id]
        )->getResultArray());

        // return $this->lowerKey($result ? $result[0]: [] );

        return ([
            "val" => $result ? $result[0] : [],
        ]);
    }


    private function persalinanE($visit, $session_id)
    {
        $title = "Laporan Persalinan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("
            select 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            ed.WEIGHT as berat,
            ed.HEIGHT as tinggi,
            ed.TENSION_UPPER as tensi_atas,
            ed.TENSION_BELOW as tensi_bawah,
            ed.nadi,
            ed.TEMPERATURE AS Suhu,
            ed.NAFAS as respiration,
            ed.SATURASI AS SPO2

            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
			inner join EXAMINATION_DETAIL ed ON ei.PASIEN_DIAGNOSA_ID = ed.DOCUMENT_ID
           , pasien p 
            where 
			1=1
            and pd.PASIEN_DIAGNOSA_ID = '" . $session_id . "'
            and PD.VISIT_ID =  '" . $visit['visit_id'] . "'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            ed.WEIGHT,
            ed.HEIGHT, 
            ed.TENSION_UPPER, 
            ed.TENSION_BELOW, 
            ed.nadi,
            ed.NAFAS, 
            ed.SATURASI,
            ed.TEMPERATURE
            ")->getResultArray()) ?? [];

            $apgarWaktu = $this->lowerKey($db->query(
                "
               SELECT * FROM ASSESSMENT_PARAMETER_type WHERE p_type in ('ASES032','ASES033', 'ASES034')
                "
            )->getResultArray() ?? []);
            $apgarData = $this->lowerKey($db->query(
                "
               SELECT 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_PARAMETER.PARAMETER_ID,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES032' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_DESC ELSE '' END) AS menit_1,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES033' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_DESC ELSE '' END) AS menit_5,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES034' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_DESC ELSE '' END) AS menit_10,
                    MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES032' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_SCORE ELSE NULL END) AS VALUE_SCORE_1,
                        MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES033' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_SCORE ELSE NULL END) AS VALUE_SCORE_5,
                            MAX(CASE WHEN ASSESSMENT_APGAR_DETAIL.P_TYPE = 'ASES034' AND ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_APGAR_DETAIL.VALUE_SCORE ELSE NULL END) AS VALUE_SCORE_10
                FROM 
                    ASSESSMENT_APGAR_DETAIL
                LEFT JOIN 
                    ASSESSMENT_PARAMETER ON ASSESSMENT_APGAR_DETAIL.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID
                WHERE 
                    ASSESSMENT_APGAR_DETAIL.BODY_ID = '" . $session_id . "'
                    AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '" . $visit['visit_id'] . "'
                    AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
            )->getResultArray() ?? []);

            $neonatus = $this->lowerKey($db->query(
                "
                SELECT 
                    GEN_INFO AS KEADAAN_UMUM, 
                    MOBILITY AS PERGERAKAN, 
                    SKIN_TONE AS WARNA_KULIT, 
                    TURGOR AS TURGUR, 
                    TONUS AS TONUS, 
                    VOICE AS SUARA, 
                    REFLECT_MORO AS REFLEK_MORO, 
                    REFLECT_SUCK AS REFLEK_MENGHISAP, 
                    GRIPS AS MEMEGANG, 
                    TONUS_NECK AS TONUS_LEHER, 
                    HEAD_DIAMETER AS LINGKAR_KEPALA, 
                    CHEST_DIAMETER AS LINGKAR_DADA ,
                    RESUSITASI AS RESUSITASI
                FROM ASSESSMENT_NEONATUS_PHYSIC
                WHERE 
                    ASSESSMENT_NEONATUS_PHYSIC.BODY_ID = '" . $session_id . "'
                    AND ASSESSMENT_NEONATUS_PHYSIC.VISIT_ID = '" . $visit['visit_id'] . "'
               "
            )->getResultArray() ?? []);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);
            $selectinfo = $this->query_template_info($db, $visit['visit_id'], $session_id);


            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select ? $select[0] : [],
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "apgarWaktu" => $apgarWaktu,
                "apgarData" => $apgarData,
                "neonatus" => $neonatus,
            ]);
        }
    }


    private function operasiE($visit, $vactination_id = null)
    {
        $title = "Laporan Pembedahan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $select = $this->lowerKey($db->query("SELECT TOP 1 
                                                PASIEN_OPERASI.*, 
                                                treat_tarif.tarif_name, 
                                                ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as tipe_operasi
                                            FROM 
                                                PASIEN_OPERASI
                                            INNER JOIN 
                                                treat_tarif ON PASIEN_OPERASI.TARIF_ID = treat_tarif.TARIF_ID
                                            INNER JOIN 
                                                ASSESSMENT_PARAMETER_VALUE ON PASIEN_OPERASI.SURGERY_TYPE = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                                            WHERE 
                                                PASIEN_OPERASI.visit_id ='" . $visit['visit_id'] . "' 
                                            ORDER BY 
                                                PASIEN_OPERASI.START_OPERATION DESC; 
            ")->getRowArray() ?? []);

            $vactination_id = isset($select) && !empty($select) ? $select['vactination_id'] : "";


            $operation_team = $this->lowerKey($db->query("
            SELECT DOCTOR, TASK from OPERATION_TEAM 
            INNER JOIN OPERATION_TASK ON OPERATION_TEAM.TASK_ID = OPERATION_TASK.TASK_ID
            WHERE OPERATION_ID = '" . $vactination_id . "' ORDER BY OPERATION_TASK.TASK_ID ASC
            ")->getResultArray() ?? []);

            $diagnosas = $this->lowerKey($db->query("SELECT diagnosa_desc as diagnosa_name,diag_cat,suffer_type.suffer from PASIEN_DIAGNOSAS 
            inner join suffer_type on pasien_diagnosas.suffer_type = suffer_type.suffer_type
            where pasien_diagnosa_id = '" . $vactination_id . "' and diag_cat IN('13','14','15')
            ")->getResultArray() ?? []);


            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                'operation_team' => $operation_team,
                'diagnosas' => $diagnosas,
            ]);
        }
    }

    private function anesthesiE($visit, $vactination_id = null)
    {
        $title = "Laporan Anestesi Lengkap";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $visit_id = $visit['visit_id'];

            $oprasi = $this->lowerKey($db->query("SELECT Top (1) * FROM PASIEN_OPERASI where VISIT_ID = '$visit_id' order by START_OPERATION DESC")->getRowArray() ?? []);
            $vactination_id = isset($oprasi) && !empty($oprasi) ? $oprasi['vactination_id'] : "";


            $query = $this->lowerKey($db->query(
                "SELECT TOP 1 *,
                        ASSESSMENT_ANESTHESIA.org_unit_code as org_unit_code,
                        ASSESSMENT_ANESTHESIA.visit_id as visit_id,
                        ASSESSMENT_ANESTHESIA.trans_id as trans_id,
                        ASSESSMENT_ANESTHESIA.body_id as body_id,
                        ASSESSMENT_ANESTHESIA.document_id as document_id,
                        ASSESSMENT_ANESTHESIA.examination_date as examination_date,
                        ASSESSMENT_ANESTHESIA.modified_date as modified_date,
                        pasien_operasi.VACTINATION_id
                    FROM ASSESSMENT_ANESTHESIA
                    LEFT JOIN ASSESSMENT_ANESTHESIA_POST 
                        ON ASSESSMENT_ANESTHESIA.DOCUMENT_ID = ASSESSMENT_ANESTHESIA_POST.DOCUMENT_ID
                    LEFT JOIN ASSESSMENT_ANESTHESI_CHECKLIST 
                        ON ASSESSMENT_ANESTHESIA.DOCUMENT_ID = ASSESSMENT_ANESTHESI_CHECKLIST.DOCUMENT_ID
                    LEFT JOIN pasien_operasi 
                        ON ASSESSMENT_ANESTHESIA.document_id = pasien_operasi.vactination_id
                    WHERE pasien_operasi.VISIT_ID = '$visit_id' 
                    AND ASSESSMENT_ANESTHESIA.start_operation IS NOT NULL
                    ORDER BY pasien_operasi.start_operation DESC;
                "
            )->getRowArray() ?? []);

            $aldrete_score = $this->lowerKey($db->query(
                "
                select 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID, 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC
                from ASSESSMENT_ANESTHESIA_RECOVERY 
                inner join ASSESSMENT_PARAMETER on ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID AND ASSESSMENT_PARAMETER.P_TYPE = 'oprs023'
                where DOCUMENT_ID = '" . $vactination_id . "' and ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'oprs023'
                group by 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID,
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC

                "
            )->getResultArray() ?? []);

            $steward_score = $this->lowerKey($db->query(
                "
                select 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID, 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC
                from ASSESSMENT_ANESTHESIA_RECOVERY 
                inner join ASSESSMENT_PARAMETER on ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID AND ASSESSMENT_PARAMETER.P_TYPE = 'oprs025'
                where DOCUMENT_ID = '" . $vactination_id . "' and ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'oprs025'
                group by 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID,
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC

                "
            )->getResultArray() ?? []);

            $bromage_score = $this->lowerKey($db->query(
                "
                select value_desc, value_score from ASSESSMENT_ANESTHESIA_RECOVERY where DOCUMENT_ID =  '" . $vactination_id . "' and P_TYPE = 'oprs024'
                "
            )->getResultArray() ?? []);

            $infusion   = $this->filtering_array($vactination_id, 'OPRS029');
            $general    = $this->filtering_array($vactination_id, 'OPRS030');
            $regional   = $this->filtering_array($vactination_id, 'OPRS033');
            $ventilasi  = $this->filtering_array($vactination_id, 'OPRS031');
            $jalan_napas  = $this->filtering_array($vactination_id, 'OPRS032');

            $instruksi_post = $this->lowerKey($db->query(
                "
               SELECT 
                    AOP.*,
                    PV1.VALUE_DESC AS POSITION,
                    PV2.VALUE_DESC AS FASTING_UNTIL
                FROM 
                    ASSESSMENT_OPERATION_POST AOP
                INNER JOIN 
                    ASSESSMENT_PARAMETER_VALUE PV1 
                    ON AOP.POSITION = PV1.VALUE_ID
                INNER JOIN 
                    ASSESSMENT_PARAMETER_VALUE PV2 
                    ON AOP.FASTING_UNTIL = PV2.VALUE_ID
                WHERE 
                    AOP.document_id =  '" . $vactination_id . "'

                "
            )->getRowArray() ?? []);



            $cairan_masuk = $this->lowerKey($db->query("
                SELECT 
                    TREATMENT_OBAT.visit_id,
                    TREATMENT_OBAT.treat_date AS date,
                    goods.name AS name,
                    TREATMENT_OBAT.QUANTITY AS quantity
                FROM 
                    TREATMENT_OBAT 
                INNER JOIN 
                    goods ON TREATMENT_OBAT.BRAND_ID = goods.BRAND_ID 
                WHERE 
                    TREATMENT_OBAT.CLINIC_ID = 'P002' 
                    AND ISALKES = 19
                    AND TREATMENT_OBAT.visit_id = '" . $visit['visit_id'] . "'

                UNION ALL

                SELECT 
                    br.visit_id,
                    br.REQUEST_DATE AS date,
                    but.usagetype AS name,
                    br.BLOOD_QUANTITY AS quantity
                FROM 
                    BLOOD_REQUEST br
                LEFT JOIN 
                    BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
                WHERE 
                    br.visit_id = '" . $visit['visit_id'] . "';

            ")->getResultArray() ?? []);

            $cairan = $this->lowerKey($db->query("
                select examination_date,value_desc,fluid_amount,
                MAX(CASE 
                WHEN fluid_type IN('G0230301', 'G0230302') 
                THEN 1 
                ELSE 0 
                END) AS cairan_masuk 
                from assessment_fluid_balance
                inner join assessment_parameter_value on assessment_fluid_balance.P_TYPE = assessment_parameter_value.p_type AND assessment_parameter_value.VALUE_ID = assessment_fluid_balance.FLUID_TYPE
                where assessment_fluid_balance.P_TYPE = 'GEN0023' AND VISIT_ID = '" . $visit['visit_id'] . "'
                group by examination_date, value_desc, fluid_amount
            ")->getResultArray() ?? []);

            $asParameter  =  $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_PARAMETER WHERE P_TYPE  LIKE 'OPRS%' ORDER BY P_TYPE")->getResultArray() ?? []);
            $asParameterVal  =  $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_PARAMETER_VALUE WHERE P_TYPE  LIKE 'OPRS%' ORDER BY P_TYPE")->getResultArray() ?? []);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array') ?? []);
            $aldrete_score_group = [];
            $steward_score_group = [];

            foreach ($aldrete_score as $item) {
                $bodyId = $item['body_id'];
                if (!isset($aldrete_score_group[$bodyId])) {
                    $aldrete_score_group[$bodyId] = [];
                }

                $aldrete_score_group[$bodyId][] = $item;
            }
            foreach ($steward_score as $item) {
                $bodyId = $item['body_id'];
                if (!isset($steward_score_group[$bodyId])) {
                    $steward_score_group[$bodyId] = [];
                }

                $steward_score_group[$bodyId][] = $item;
            }

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $query,
                "infusion" => $infusion,
                "general" => $general,
                "regional" => $regional,
                "ventilasi" => $ventilasi,
                "jalan_napas" => $jalan_napas,
                "general_entry_type" => $this->getEntryType($general),
                "ventilasi_entry_type" => $this->getEntryType($ventilasi),
                "jalan_napas_entry_type" => $this->getEntryType($jalan_napas),
                "regional_entry_type" => $this->getEntryType($regional),
                "instruksi_post" => $instruksi_post,
                "organization" => $selectorganization,
                "cairan_masuk" => $cairan_masuk,
                "cairan" => $cairan,
                "aldrete_score" => $aldrete_score_group,
                "steward_score" => $steward_score_group,
                "bromage_score" => $bromage_score,
                'a_param' => $asParameter,
                'a_paramVal' => $asParameterVal
            ]);
        }
    }


    public function ConvertValue($arr_before, $arr_after, $p_type)
    {
        $arr_after = [];
        foreach ($arr_before as $key => $value) {
            if (preg_match('/^OP\d{6}$/', $value)) {
                $result = $this->query_getDescValue($value, $p_type);
                if ($result) {
                    $parameterDesc = $result['PARAMETER_DESC'] ?? '-';
                    $valueDesc = $result['VALUE_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $valueDesc;
                }
            } else {
                $result = $this->query_getDesc($key, $p_type);
                if ($result) {
                    $parameterDesc = $result['PARAMETER_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $value;
                } else {
                    $result2 = $this->query_getDesc2($key, $p_type);
                    $parameterDesc = $result2['PARAMETER_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $result2['VALUE_DESC'] ?? '-';
                }
            }
        }

        return $arr_after;
    }
    public function query_convertValue($value_id)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT VALUE_DESC FROM ASSESSMENT_PARAMETER_VALUE WHERE VALUE_ID = '" . $value_id . "'
        ");

        $result = $query->getRowArray();

        return $result;
    }
    public function query_getDescValue($value_id, $p_type)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT
                ASSESSMENT_PARAMETER.PARAMETER_DESC,
                ASSESSMENT_PARAMETER_VALUE.VALUE_DESC 
            FROM ASSESSMENT_PARAMETER
            INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_PARAMETER.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID 
            WHERE ASSESSMENT_PARAMETER.P_TYPE = '" . $p_type . "' AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = '" . $db->escapeString($value_id) . "'
        ");

        $result = $query->getRowArray();

        return $result;
    }
    public function query_getDesc($column_name, $p_type)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT PARAMETER_DESC FROM ASSESSMENT_PARAMETER WHERE P_TYPE = '" . $p_type . "' AND COLUMN_NAME =  '" . $db->escapeString($column_name) . "'
        ");

        $result = $query->getRowArray();

        return $result;
    }

    public function query_getDesc2($column_name, $p_type)
    {
        $db = db_connect();

        // $query = $db->query("
        //     SELECT VALUE_DESC FROM ASSESSMENT_PARAMETER_VALUE WHERE P_TYPE = '" . $p_type . "' AND VALUE_INFO =  '" . $db->escapeString($column_name) . "'
        // ");

        $query = $db->query("
            SELECT ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC  FROM ASSESSMENT_PARAMETER
            INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_PARAMETER.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID AND ASSESSMENT_PARAMETER.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
            WHERE ASSESSMENT_PARAMETER.P_TYPE = '" . $p_type . "' AND  ASSESSMENT_PARAMETER_VALUE.VALUE_INFO = '" . $db->escapeString($column_name) . "'    
        
        ");

        $result = $query->getRowArray();
        return $result;
    }

    private function getEntryType2($arr)
    {
        // digunakan untuk mengambil entry type = 2 dan ambil keys nya
        $filtered = array_filter($arr, function ($entry) {
            return isset($entry[0]['entry_type']) && $entry[0]['entry_type'] == 2;
        });
        $entryType2 = [];
        foreach ($filtered as $key => $entries) {
            $entryType2[$key] = $entries[0];
        }
        $keys = array_keys($filtered);
        return [
            'keys' => $keys,
            'entries' => $entryType2
        ];
    }
    private function getEntryType($arr)
    {
        // digunakan untuk mengambil entry type = 2 dan ambil keys nya
        $filtered = array_filter($arr, function ($entry) {
            return isset($entry[0]['entry_type']) && !in_array($entry[0]['entry_type'], ['3', '7']);
        });
        $entryType2 = [];
        foreach ($filtered as $key => $entries) {
            $entryType2[$key] = $entries[0];
        }
        $keys = array_keys($filtered);
        return [
            'keys' => $keys,
            'entries' => $entryType2
        ];
    }

    private function filtering_array($document_id, $p_type)
    {
        // digunakan untuk memfilter data berdasarkan parameter id
        $db = db_connect();
        $arr = $this->lowerKey($db->query(
            "
            select 
            assessment_parameter.PARAMETER_DESC,assessment_parameter.ENTRY_TYPE, ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER_VALUE.P_TYPE, assessment_anesthesia_recovery.VALUE_ID,ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,ASSESSMENT_PARAMETER_VALUE.VALUE_INFO,
            MAX(CASE 
            WHEN assessment_anesthesia_recovery.VALUE_ID =  assessment_parameter_value.VALUE_ID 
            THEN 1 
            ELSE 0 
            END) AS checked
            from assessment_anesthesia_recovery 
            LEFT JOIN assessment_parameter 
            ON assessment_anesthesia_recovery.PARAMETER_ID = assessment_parameter.PARAMETER_ID and assessment_anesthesia_recovery.P_TYPE = '$p_type'
            AND assessment_anesthesia_recovery.DOCUMENT_ID = '$document_id' 
            left join assessment_parameter_value on assessment_parameter.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID AND ASSESSMENT_PARAMETER_VALUE.P_TYPE = '$p_type'
            where assessment_parameter.p_Type = '$p_type'
            group by assessment_parameter.PARAMETER_DESC,assessment_parameter.ENTRY_TYPE, ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER_VALUE.P_TYPE, assessment_anesthesia_recovery.VALUE_ID,ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,ASSESSMENT_PARAMETER_VALUE.VALUE_INFO
            order by PARAMETER_ID asc

            "
        )->getResultArray() ?? []);

        $arr = array_reduce($arr, function ($result, $item) {
            $desc = $item['parameter_desc'];
            if (!isset($result[$desc])) {
                $result[$desc] = [];
            }
            $result[$desc][] = $item;
            return $result;
        }, []);

        return $arr;
    }
}
