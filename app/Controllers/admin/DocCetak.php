<?php

namespace App\Controllers\Admin;


class DocCetak extends \App\Controllers\BaseController
{

    public function cetakGroupeRajalFilePoli($visit)
    {
        if ($this->request->is('get')) {
            $db = db_connect();
            $decoded_visit = $this->decodeVisit($visit);

            // Fetch all data
            // Kop
            $kopprintData = $this->getKopprintData($db);

            // SEP
            $cetakSepAll = $this->cetakSepAll($db, $decoded_visit);

            // Surat Kontrol
            $skdp = $this->cetakskdp($db, $decoded_visit);

            //INVOICE
            $queryTreatmenBill = $this->getTreatmentBill($db, $decoded_visit['visit_id']);

            // Hasil Penunjang
            $penunjang_medis = $this->penunjang_medis($decoded_visit, $queryTreatmenBill);

            return view("admin/patient/profilemodul/formrm/rm/cetak-rajal-file-poli.php", [
                "visit" => $decoded_visit,
                'kop' => $kopprintData,
                'sep' => $cetakSepAll,
                'skdp' => $skdp,
                'treatment_bill' => $queryTreatmenBill,
                'penunjang_medis' => $penunjang_medis

            ]);

            // return $this->response->setJSON($data);
        }
    }

    public function cetakGroupeRajalIgd($visit)
    {
        if ($this->request->is('get')) {
            $db = db_connect();
            $decoded_visit = $this->decodeVisit($visit);

            // Fetch all data
            // Kop
            $kopprintData = $this->getKopprintData($db);

            // SEP
            $cetakSepAll = $this->cetakSepAll($db, $decoded_visit);

            // Surat Diag
            $surat_diag = $this->surat_diagnosis($decoded_visit);

            //INVOICE
            $queryTreatmenBill = $this->getTreatmentBill($db, $decoded_visit['visit_id']);

            // Hasil Penunjang
            $penunjang_medis = $this->penunjang_medis($decoded_visit, $queryTreatmenBill);

            //Get Parameter
            $getParameter = $this->getParameter();

            //getIndikator
            $getIndikator = $this->getIndikator($decoded_visit);

            return view("admin/patient/profilemodul/formrm/rm/cetak-rajal-igd.php", [
                "visit" => $decoded_visit,
                'kop' => $kopprintData,
                'sep' => $cetakSepAll,
                'surat_diag' => $surat_diag,
                'treatment_bill' => $queryTreatmenBill,
                'penunjang_medis' => $penunjang_medis,
                'param' => $getParameter,
                'getIndikator' => $getIndikator

            ]);

            // return $this->response->setJSON($data);
        }
    }

    public function cetakGroupeRanapFile($visit)
    {
        if ($this->request->is('get')) {
            $db = db_connect();
            $decoded_visit = $this->decodeVisit($visit);

            // Fetch all data
            // Kop
            $kopprintData = $this->getKopprintData($db);

            // SEP
            $cetakSepAll = $this->cetakSepAll($db, $decoded_visit);
            // Surat perintah Ranap

            $surat_perintah = $this->surat_perintah($decoded_visit);

            // Surat Diag
            $surat_diag = $this->surat_diagnosis($decoded_visit);

            //INVOICE
            $queryTreatmenBill = $this->getTreatmentBill($db, $decoded_visit['visit_id']);

            // Hasil Penunjang
            $penunjang_medis = $this->penunjang_medis($decoded_visit, $queryTreatmenBill);

            // persalinan
            $persalinan = $this->persalinan($decoded_visit);

            //Anestesi
            $anestesi = $this->cetak_anesthesi($decoded_visit, '20240928130032381');

            //Operasi 
            ///Pra Operasi
            $praopra = $this->cetak_pra_operasi($decoded_visit, '20240928130032381');
            $priopra = $this->cetak_catatan_keperawatan($decoded_visit, '20240928130032381');
            $checklistKel = $this->cetak_checklist_keselamatan($decoded_visit, '20240928130032381');
            $checklistAnes = $this->cetak_checklist_anestesi($decoded_visit, '20240928130032381');
            $lapbedah = $this->cetak_laporan_pembedahan($decoded_visit, '20240928130032381');
            $postoprs = $this->cetak_post_operasi($decoded_visit, '20240928130032381');

            // patologi
            $patologi = $this->patologi($decoded_visit);

            //resume Pulang
            $resume_medis = $this->resume_medis($decoded_visit);

            //Get Parameter
            $getParameter = $this->getParameter();

            //getIndikator
            $getIndikator = $this->getIndikator($decoded_visit);


            return view("admin/patient/profilemodul/formrm/rm/cetak-ranap-file.php", [
                "visit" => $decoded_visit,
                'kop' => $kopprintData,
                'sep' => $cetakSepAll,
                'surat_diag' => $surat_diag,
                'treatment_bill' => $queryTreatmenBill,
                'penunjang_medis' => $penunjang_medis,
                'persalinan' => $persalinan,
                'anestesi' => $anestesi,
                // operasi
                'praopra' => $praopra,
                'priopra' => $priopra,
                'checklistKel' => $checklistKel,
                'checklistAnes' => $checklistAnes,
                'lapbedah' => $lapbedah,
                'postoprs' => $postoprs,
                'surat_perintah' => $surat_perintah,

                'patologi' => $patologi,
                'resume_medis' => $resume_medis,
                'param' => $getParameter,
                'getIndikator' => $getIndikator

            ]);
            // return $this->response->setJSON($data);
        }
    }

    private function tratname($db)
    {
        $sql = $this->lowerKey($db->query('select TARIF_ID, TARIF_NAME from TREAT_TARIF')->getResultArray());

        return $sql;
    }

    private function cetakSepAll($db, $visit)
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


    private function cetakskdp($db, $visit)
    {

        // $visit = json_decode(base64_decode($visit), true);
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
            where INASIS_KONTROL.VISIT_ID  = '" . $visit['visit_id'] . "'  --diganti dengan no sep yang berlaku
            and surattype = '1' -- skdp = 1 , spri = 2
             and pd.DIAG_CAT =  1")->getResultArray());

        $pasien = $pasien ? $pasien[0] : [];


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

    private function getKirimlisData($db, $queryTreatmenBill)
    {

        $billIds = array_column($queryTreatmenBill, 'bill_id');

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

    // visit_date
    private function getLaboratoriumData($db, $kirimlisData, $decoded_visit)
    {
        $kode_kunjungan = array_column($kirimlisData, 'kode_kunjungan');
        $visit_date = $decoded_visit['visit_date'];


        $start_date = $visit_date . " 00:00:00";


        $end_date = date('Y-m-d H:i:s');

        if (empty($kode_kunjungan)) {
            return [];
        }

        $kode_kunjunganString = implode("','", $kode_kunjungan);
        // exit();
        // visit_date

        return $this->lowerKey(
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
    }

    private function decodeVisit($visit)
    {
        $decoded_visit = base64_decode($visit);
        return json_decode($decoded_visit, true);
    }

    private function getKopprintData($db)
    {
        return $this->lowerKey(
            $db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address,org_type,OTHER_CODE FROM ORGANIZATIONUNIT")->getRow(0, 'array')
        );
    }

    private function getHasilResultRad($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query("SELECT * FROM TREAT_RESULTS WHERE VISIT_ID = ?", [$visit_id])->getResultArray()
        );
    }

    private function getRadiologiData($db, $hasilResultRad)
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

    private function getTreatmentBill($db, $visit_id)
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
					tb.QUANTITY * tb.sell_price as subtotal,
					tb.QUANTITY,
                    tb.CLINIC_ID,
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
                GROUP BY 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
					tb.QUANTITY,
					tb.sell_price,
                    tb.doctor,
                    tb.thename,
                    tb.CLINIC_ID,
                    tt.TARIF_ID,
                    tt.ORG_UNIT_CODE,
                    tt.TARIF_NAME,
                    cm.CASEMIX_ID,
                    cm.CASEMIX",

                [$visit_id]
            )->getResultArray()
        );
    }

    private function getTreatmentBillResep($db, $visit_id)
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


    private function getVisitationData($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query(
                "SELECT * FROM PASIEN_VISITATION WHERE VISIT_ID = ?",
                [$visit_id]
            )->getResultArray()
        );
    }

    private function resume_medis($visit)
    {

        $title = "Resume Medis";
        if ($this->request->is('get')) {

            $db = db_connect();
            $id_diag = $db->query("SELECT TOP (1) pasien_diagnosa_id, VISIT_ID FROM PASIEN_DIAGNOSA WHERE VISIT_ID = '202404241151300470C77' ORDER BY IN_DATE DESC")->getRowArray();
            $id_diag = $this->lowerKey($id_diag);

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
            ei.WEIGHT as berat,
            ei.HEIGHT as tinggi,
            ei.TENSION_UPPER as tensi_atas,
            ei.TENSION_BELOW as tensi_bawah,
            ei.nadi,
            ei.TEMPERATURE AS Suhu,
            ei.NAFAS as respiration,
            ei.SATURASI AS SPO2,
            EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) AS IMT,
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
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
            pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '" . @$id_diag['pasien_diagnosa_id'] . "'
            and PD.VISIT_ID = '" . @$id_diag['visit_id'] . "' -- 
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
            ei.WEIGHT,
            ei.HEIGHT, 
            ei.TENSION_UPPER, 
            ei.TENSION_BELOW, 
            ei.nadi,
            ei.NAFAS, 
            ei.SATURASI,
            ei.TEMPERATURE,
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
            EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ), 
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

    private function penunjang_medis($visit, $queryTreatmenBill)
    {
        $db = db_connect();
        $billl = $this->lowerKey($db->query("SELECT * FROM TREATMENT_BILL WHERE VISIT_ID = :visit_id: AND CLINIC_ID IN ('P001', 'P016')", [
            'visit_id' => $visit['visit_id']
        ])->getResultArray() ?? []);

        $title = "Laporan Penunjang Medis";

        $billIds = array_column($billl, 'bill_id');
        $tarifIds = array_column($billl, 'tarif_id');

        // Menghapus duplikat
        // $billIds = array_unique($billIds);
        // $tarifIds = array_unique($tarifIds);

        if (empty($billIds)) {
            return [];
        }
        if (empty($tarifIds)) {
            return [];
        }

        $billIdString = implode("','", $billIds);
        $tarifIdString = implode("','", $tarifIds);



        if ($this->request->is('get')) {
            $treat_bound = $this->lowerKey($db->query("select reagent_id,description from TREAT_BOUND_DIAGNOSA where tarif_id ='0216012'")->getResultArray() ?? []);
            $select = $this->lowerKey($db->query("
            select * from TREAT_RESULTS where BILL_ID ='202410070851300087039'
            AND clinic_id IN ('P001', 'P016') 
            and (tarif_name LIKE '%USG%' OR tarif_name LIKE '%EKG%' OR tarif_name LIKE '%ECG%')
            and tarif_id ='0216012' ")->getResultArray() ?? []);



            return ([
                "visit" => $visit,
                'title' => $title,
                "bound" => $treat_bound,
                "val" => $select,
            ]);
        }
    }

    private function surat_diagnosis($visit, $vactination_id = null)
    {
        $title = "Surat Keterangan Diagnosis";
        if ($this->request->is('get')) {

            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT
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
            CASE WHEN pd.GENDER = '1' THEN 'Laki-Laki'
            else 'Perempuan' end as jeniskel,
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
            pd.DESCRIPTION as keterangan,
		    pd.INSTRUCTION as tindakan,
            st.SPECIALIST_TYPE as department
   
            FROM INASIS_KONTROL left outer join  pasien_visitation pv on inasis_kontrol.nosep = isnull(pv.no_skp,pv.no_skpinap) 
            inner join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            where  INASIS_KONTROL.VISIT_ID  = '" . $visit['visit_id'] . "' 
            and surattype = '1'
            and pd.DIAG_CAT=1")->getResultArray());

            $select = $select ? $select[0] : [];

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select
            ]);
        }
    }

    private function persalinan($visit, $vactination_id = null)
    {
        $title = "Laporan Persalinan";
        if ($this->request->is('get')) {
            $db = db_connect();
            $select = $this->lowerKey($db->query("
            select 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            ei.WEIGHT as berat,
            ei.HEIGHT as tinggi,
            ei.TENSION_UPPER as tensi_atas,
            ei.TENSION_BELOW as tensi_bawah,
            ei.nadi,
            ei.TEMPERATURE AS Suhu,
            ei.NAFAS as respiration,
            ei.SATURASI AS SPO2

            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
           , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '2024050311063402401BC'
            and PD.VISIT_ID =  '202404241151300470C77'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            ei.WEIGHT,
            ei.HEIGHT, 
            ei.TENSION_UPPER, 
            ei.TENSION_BELOW, 
            ei.nadi,
            ei.NAFAS, 
            ei.SATURASI,
            ei.TEMPERATURE
            ")->getResultArray());

            $apgarWaktu = $this->lowerKey($db->query(
                "
               SELECT * FROM ASSESSMENT_PARAMETER_type WHERE p_type in ('ASES032','ASES033', 'ASES034')
                "
            )->getResultArray());
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
                    ASSESSMENT_APGAR_DETAIL.BODY_ID = '20240530183632520'
                    AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '20240530141940038069A'
                    AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
            )->getResultArray());

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
                    ASSESSMENT_NEONATUS_PHYSIC.BODY_ID = '20240530183632520'
                    AND ASSESSMENT_NEONATUS_PHYSIC.VISIT_ID = '20240530141940038069A'
               "
            )->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $selectinfo = $this->query_template_info($db, '2024052400101208008C3', '202405262033530190C16');

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


    private function cetak_pra_operasi($visit, $vactination_id = null)
    {
        $title = "Asesmen Pra Operasi";
        if ($this->request->is('get')) {
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select assessment_operation_pra.*
            from assessment_operation_pra 
            where assessment_operation_pra.visit_id = '" . $visit['visit_id'] . "' and body_id = '" . $vactination_id . "'
            ")->getResultArray());

            if (!empty($select)) {
                $selectlokalis = $this->lowerKey($db->query(
                    "
                    select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                    INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                    where body_id = '" . $vactination_id . "'"
                )->getResultArray());

                $selectDiagnosa = $this->lowerKey($db->query(
                    "select DIAGNOSA_NAME from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $select[0]['body_id'] . "' "
                )->getResultArray());

                $informasiMedis = array_slice($select[0], 8, 22);

                $newData = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS001');
            }

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "informasiMedis" => $newData ?? [],
                "lokalis" => $selectlokalis ?? [],
                "diagnosa" => $selectDiagnosa ?? [],
                "organization" => $selectorganization ?? []
            ]);
        }
    }

    private function cetak_anesthesi($visit, $vactination_id = null)
    {

        $title = "Laporan Anestesi/Sedasi";
        if ($this->request->is('get')) {

            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select ASSESSMENT_ANESTHESIA.*,
            ei.TEMPERATURE as suhu,
            ei.TENSION_UPPER as tensi_atas,
            ei.TENSION_BELOW as tensi_bawah,
            ei.NADI as nadi,
            ei.NAFAS as respirasi,
            ei.WEIGHT as bb,
            ei.HEIGHT as tb,
            ei.IMT_SCORE,
            ei.IMT_DESC,
            ei.SATURASI as saturasi,
            format(round(ei.WEIGHT*10000/ei.height/ei.height,2), '0.##') as bmi
            from ASSESSMENT_ANESTHESIA 
            left outer join EXAMINATION_info ei on ASSESSMENT_ANESTHESIA.BODY_ID = ei.PASIEN_DIAGNOSA_ID
            where ASSESSMENT_ANESTHESIA.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' and ei.ACCOUNT_ID = '11'
            ")->getResultArray());


            if (!empty($select)) {
                $selectlokalis = $this->lowerKey($db->query(
                    "
                    select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                    INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                    where body_id = '" . $vactination_id . "' AND assessment_lokalis.VALUE_SCORE = 2"
                )->getResultArray());

                $selectDiagnosa = $this->lowerKey($db->query(
                    "select DIAGNOSA_NAME from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $select[0]['body_id'] . "' "
                )->getResultArray());

                $informasiMedis = array_splice($select[0], 13, 16);
                $keadaanUmum = array_splice($select[0], 14, 3);
                $perencanaanAnestesi = array_splice($select[0], 15, 7);

                $newData = [];
                $newData2 = [];
                $newData3 = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS006');
                $newData3 = $this->ConvertValue($keadaanUmum, $newData3, 'OPRS006');
                $newData2 = $this->ConvertValue($perencanaanAnestesi, $newData2, 'OPRS006');
            }

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $select = $select ? $select[0] : [];


            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "informasiMedis" => $newData ?? [],
                "perencanaanAnestesi" => $newData2 ?? [],
                "keadaanUmum" => $newData3 ?? [],
                "lokalis" => $selectlokalis ?? [],
                "diagnosa" => $selectDiagnosa ?? [],
                "organization" => $selectorganization
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
                    $arr_after[$parameterDesc] = $result2['VALUE_DESC'];
                }
            }
        }

        return $arr_after;
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

    public function query_convertValue($value_id)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT VALUE_DESC FROM ASSESSMENT_PARAMETER_VALUE WHERE VALUE_ID = '" . $value_id . "'
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

    public function getTreatment()
    {
        $db = db_connect();

        $sql = "SELECT
                C.NAME_OF_CLASS,
                T.TREATMENT,
                tt.tarif_id,
                tt.TARIF_NAME,
                tt.TREAT_ID as operation_type
            FROM
                treat_tarif tt
                JOIN treatment t ON tt.TREAT_ID = t.TREAT_ID
                JOIN CLASS C ON C.CLASS_ID = TT.CLASS_ID
            WHERE
                LEFT(tt.treat_id, 2) = '13'
                AND PERDA_ID = 1
            ORDER BY
                C.NAME_OF_CLASS,
                T.TREATMENT";
        $query = $db->query($sql);
        $results = $this->lowerKey($query->getResultArray());
        return $results; // Return results instead of JSON
    }
    private function cetak_catatan_keperawatan($visit, $vactination_id = null)
    {
        $title = "Catatan Keperawatan Peri Operasi";
        if ($this->request->is('get')) {

            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select ASSESSMENT_OPERATION.*,
            ei.TEMPERATURE as suhu,
            ei.TENSION_UPPER as tensi_atas,
            ei.TENSION_BELOW as tensi_bawah,
            ei.NADI as nadi,
            ei.NAFAS as respirasi,
            ei.WEIGHT as bb,
            ei.HEIGHT as tb,
            ei.IMT_SCORE,
            ei.IMT_DESC,
            ei.SATURASI as saturasi,
            CASE
                WHEN ei.HEIGHT = 0 THEN NULL
                ELSE ROUND(ei.WEIGHT * 10000.0 / (ei.HEIGHT * ei.HEIGHT), 2)
            END AS bmi
            from ASSESSMENT_OPERATION 
            left outer join EXAMINATION_info ei on ASSESSMENT_OPERATION.document_id = ei.PASIEN_DIAGNOSA_ID
            where ASSESSMENT_OPERATION.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' and ei.ACCOUNT_ID = '10'
            ")->getRow(0, 'array') ?? []);
            if (!empty($select)) {

                $selectDiagnosa = $this->lowerKey($db->query("
                SELECT PASIEN_DIAGNOSAS_NURSE.DIAG_NOTES FROM PASIEN_DIAGNOSA_NURSE
                INNER JOIN PASIEN_DIAGNOSAS_NURSE ON PASIEN_DIAGNOSA_NURSE.BODY_ID = PASIEN_DIAGNOSAS_NURSE.BODY_ID
                WHERE DOCUMENT_ID = '" . $vactination_id . "'
                ")->getResultArray() ?? []);

                $selectDrain = $this->lowerKey($db->query("
                SELECT DRAIN_TYPE,DRAIN_KINDS,SIZE,DESCRIPTION 
                FROM ASSESSMENT_OPERATION_DRAIN WHERE DOCUMENT_ID = '" . $vactination_id . "'
                ")->getResultArray() ?? []);

                $selectInstrument = $this->lowerKey($db->query("
                SELECT BRAND_NAME,QUANTITY_BEFORE,QUANTITY_INTRA,QUANTITY_ADDITIONAL,QUANTITY_AFTER 
                FROM ASSESSMENT_INSTRUMENT WHERE DOCUMENT_ID = '" . $vactination_id . "'
                ")->getResultArray() ?? []);
                $instruments = [
                    ['Quantity Before', 0, 0, 0],
                    ['Quantity Intra', 0, 0, 0],
                    ['Quantity Additional', 0, 0, 0],
                    ['Quantity After', 0, 0, 0],
                ];
                foreach ($selectInstrument as $item) {
                    $instruments[0][1] += $item['quantity_before'];
                    $instruments[1][1] += $item['quantity_intra'];
                    $instruments[2][1] += $item['quantity_additional'];
                    $instruments[3][1] += $item['quantity_after'];
                }
                foreach ($selectInstrument as $index => $item) {
                    $instruments[0][$index + 1] = $item['quantity_before'];
                    $instruments[1][$index + 1] = $item['quantity_intra'];
                    $instruments[2][$index + 1] = $item['quantity_additional'];
                    $instruments[3][$index + 1] = $item['quantity_after'];
                }

                $aldrete = $this->lowerKey($db->query("
                      SELECT
                            BODY_ID, OBSERVATION_DATE,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_01,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_01,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_01,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_01,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_02,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_02,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_02,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_03,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_03,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_03,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_04,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_04,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_04,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '04' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_04,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_05,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_05,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_05,
                            MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '05' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_05
                        FROM ASSESSMENT_ANESTHESIA_RECOVERY
                        INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                        INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
                        WHERE DOCUMENT_ID = '" . $vactination_id . "'
                        AND ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'OPRS023'
                        GROUP BY BODY_ID, OBSERVATION_DATE;
                ")->getResultArray() ?? []);
                $bromage = $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_ANESTHESIA_RECOVERY where visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' and p_type = 'oprs024' ")->getResultArray() ?? []);
                $steward = $this->lowerKey($db->query("
                    SELECT
                        BODY_ID, OBSERVATION_DATE,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_01,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_01,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_01,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '01' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_01,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_02,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_02,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_02,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '02' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_ID ELSE '' END) AS VALUE_ID_03,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC ELSE '' END) AS VALUE_DESC_03,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE ELSE '' END) AS VALUE_SCORE_03,
                        MAX(CASE WHEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = '03' THEN ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID ELSE '' END) AS PARAMETER_ID_03
                    FROM ASSESSMENT_ANESTHESIA_RECOVERY
                    INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                    INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
                    WHERE DOCUMENT_ID = '" . $vactination_id . "'
                    AND ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'OPRS025'
                    GROUP BY BODY_ID, OBSERVATION_DATE;
                ")->getResultArray() ?? []);


                $informasiMedis = array_slice($select, 8, 8);
                $informasiIntra = array_slice($select, 16, 23);
                $informasiIntra2 = array_slice($select, 39, 13);
                $informasiPasca = array_slice($select, 51, 11);
                $newData = [];
                $newData2 = [];
                $newData3 = [];
                $newData4 = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS003');
                $newData2 = $this->ConvertValue($informasiIntra, $newData2, 'OPRS004');
                $newData3 = $this->ConvertValue($informasiIntra2, $newData3, 'OPRS004');
                $newData4 = $this->ConvertValue($informasiPasca, $newData4, 'OPRS005');
            }
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "informasiMedis" => $newData ?? [],
                "informasiIntra" => $newData2 ?? [],
                "informasiIntra2" => $newData3 ?? [],
                "informasiPasca" => $newData4 ?? [],
                "diagnosas" => $selectDiagnosa ?? [],
                "drains" => $selectDrain ?? [],
                "instrument" => $instruments ?? [],
                "aldrete" => $aldrete ?? [],
                "bromage" => $bromage ?? [],
                "steward" => $steward ?? [],
                "organization" => $selectorganization
            ]);
        }
    }

    private function cetak_checklist_keselamatan($visit, $vactination_id = null)
    {
        $title = "Asesmen Pra Operasi";
        if ($this->request->is('get')) {
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select * FROM ASSESSMENT_OPERATION_CHECK
            where ASSESSMENT_OPERATION_CHECK.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "'
            ")->getResultArray());

            $select = $select ? $select[0] : [];


            $instruments = $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_INSTRUMENT where visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' ")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $theSignIn = array_slice($select, 8, 10);
            $theTimeOut = array_slice($select, 19, 20);
            $theSignOut = array_slice($select, 40, 2);
            $theSignOut2 = array_slice($select, 42, 3);

            $newData = [];
            $newData2 = [];
            $newData3 = [];
            $newData4 = [];


            $newData = $this->ConvertValue($theSignIn, $newData, 'OPRS026');
            $newData2 = $this->ConvertValue($theTimeOut, $newData2, 'OPRS027');
            $newData3 = $this->ConvertValue($theSignOut, $newData3, 'OPRS028');
            $newData4 = $this->ConvertValue($theSignOut2, $newData4, 'OPRS028');

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "theSignIn" => $newData,
                "theTimeOut" => $newData2,
                "theSignOut" => $newData3,
                "theSignOut2" => $newData4,
                "instruments" => $instruments,
                "organization" => $selectorganization
            ]);
        }
    }

    private function cetak_checklist_anestesi($visit, $vactination_id = null)
    {
        $title = "Checklist Anestesi";
        if ($this->request->is('get')) {
            $db = db_connect();

            $query = $this->lowerKey($db->query(
                "
                select * from ASSESSMENT_ANESTHESI_CHECKLIST where DOCUMENT_ID = '" . $vactination_id . "'
                "
            )->getRow(0, 'array'));
            // $query2 = $this->lowerKey($db->query(
            //     "
            //     select * from ASSESSMENT_PARAMETER WHERE P_TYPE = 'OPRS007'
            //     "
            // )->getResultArray());
            // $arr = array_slice($query2, 3);

            // $arrayNew = [];
            // foreach ($arr as $key => $val) {
            //     if ($val['entry_type'] == '8') {
            //         $arrayNew[$val['parameter_desc']] = null;
            //     }
            // }

            $informasiTindakan = array_splice($query, 5, 26);

            $newData = [];
            $index = 0;
            foreach ($informasiTindakan as $key => $value) {
                $value = $value === NULL ? "" : $value;
                $result = $this->query_getDesc($key, 'OPRS007');
                if ($result) {
                    $parameterDesc = $result['PARAMETER_DESC'] ?? 'Unknown Parameter';
                    $newData[$parameterDesc] = $value;
                } else {
                    $newData['Not Found'] = 'Not Found';
                }
                $index++;
            }

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $treatmentData = $this->getTreatment();

            $AParameter = $db->table('ASSESSMENT_PARAMETER')
                ->where('P_TYPE', 'OPRS007')
                ->get();
            $resultArrayAParameter = $AParameter->getResultArray();
            $selectAParameter = $this->lowerKey($resultArrayAParameter);

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $query,
                "organization" => $selectorganization,
                "informasiTindakan" => $newData,
                "treatment" => $treatmentData
            ]);
        }
    }

    private function cetak_laporan_pembedahan($visit, $vactination_id = null)
    {
        $title = "Laporan Pembedahan";
        if ($this->request->is('get')) {
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select PASIEN_OPERASI.*, treat_tarif.tarif_name,ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as tipe_operasi
            from PASIEN_OPERASI
            INNER JOIN treat_tarif ON PASIEN_OPERASI.TARIF_ID = treat_tarif.TARIF_ID
            inner join ASSESSMENT_PARAMETER_VALUE on PASIEN_OPERASI.SURGERY_TYPE = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
            where PASIEN_OPERASI.visit_id = '" . $visit['visit_id'] . "' and PASIEN_OPERASI.VACTINATION_ID = '" . $vactination_id . "'
            ")->getRowArray() ?? []);

            $operation_team = $this->lowerKey($db->query("
            SELECT DOCTOR, TASK from OPERATION_TEAM 
            INNER JOIN OPERATION_TASK ON OPERATION_TEAM.TASK_ID = OPERATION_TASK.TASK_ID
            WHERE OPERATION_ID = '" . $vactination_id . "' ORDER BY OPERATION_TASK.TASK_ID ASC
            ")->getResultArray() ?? []);

            $diagnosas = $this->lowerKey($db->query("
            select diagnosa_name,diag_cat,suffer_type.suffer from PASIEN_DIAGNOSAS 
            inner join suffer_type on pasien_diagnosas.suffer_type = suffer_type.suffer_type
            where pasien_diagnosa_id = '" . $vactination_id . "' and diag_cat IN('13','14','15')
            ")->getResultArray() ?? []);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                'operation_team' => $operation_team,
                'diagnosas' => $diagnosas,
                "organization" => $selectorganization
            ]);
        }
    }

    private function cetak_post_operasi($visit, $vactination_id = null)
    {
        $title = "Asesmen Post Operasi";
        if ($this->request->is('get')) {
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select ASSESSMENT_OPERATION_POST.*
            from ASSESSMENT_OPERATION_POST 
            where ASSESSMENT_OPERATION_POST.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "'
            ")->getResultArray());


            if (!empty($select)) {
                $informasiMedis = array_slice($select[0], 8, 11);

                $newData = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS009');
            }
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select ?? [],
                "informasiMedis" => $newData ?? [],
                "organization" => $selectorganization
            ]);
        }
    }

    private function surat_perintah($visit, $vactination_id = null)
    {
        $title = "Surat Perintah Rawat Inap";
        if ($this->request->is('get')) {
            $db = db_connect();
            $select = $this->lowerKey($db->query("select
            INASIS_KONTROL.NOSEP,  
            INASIS_KONTROL.TGLRENCKONTROL AS TGL_KONTROL_SELANJUTNYA,  
            INASIS_KONTROL.POLIKONTROL_KDPOLI,   
            INASIS_KONTROL.POLIKONTROL_NMPOLI,  
            INASIS_KONTROL.KODEDOKTER,
            INASIS_KONTROL.MODIFIED_BY,   
            INASIS_KONTROL.MODIFIED_DATE,   
            INASIS_KONTROL.NOSURATKONTROL,
            INASIS_KONTROL.SURATTYPE,
            PD.THEID as NO_bpjS,
            PD.THENAME as nama,
            pd.THEADDRESS as alamat,
            CASE WHEN pd.GENDER = '1' THEN 'Laki-Laki'
            else 'Perempuan' end as jeniskel,
            PD.NO_REGISTRATION AS NO_RM, 
            convert(varchar,PV.tgl_lahir,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' as UMUR,
            Pd.DIAGNOSA_DESC as diagnosis,
            PD.DIAGNOSA_ID as kode_diagnosa,
            pd.TERAPHY_DESC as farmakologi,
            igt.nama as alasan_kontrol,
            pd.DOCTOR as dpjp,
            pd.IN_DATE as tgl_masuk,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID no_tt,
            c.NAME_OF_CLASS as kelas,
            st.SPECIALIST_TYPE as department,
            polikontrol_nmpoli as bangsal,
            PD.INSTRUCTION as INTRUKSI--,
            --PD.STANDING_ORDER as INTRUKSITAMBAHAN
            FROM INASIS_KONTROL left outer join  pasien_visitation pv on inasis_kontrol.nosep = isnull(pv.no_skp,pv.no_skpinap) 
            inner join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            where  INASIS_KONTROL.NOSEP = '0701R0011218V004912' 
            and surattype = '2'
            and pd.DIAG_CAT = '1'")->getResultArray());

            $select =  $select ? $select[0] : [];

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select
            ]);
        }
    }

    private function patologi($visit)
    {
        $title = "Laporan Patologi";
        if ($this->request->is('get')) {
            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT * from TREAT_RESULTS where 
                VISIT_ID = '" . $visit['visit_id'] . "' AND (CLINIC_ID = 'P023' OR (CLINIC_ID = 'P013' AND TARIF_NAME LIKE 'PA %')) 
                ORDER BY pickup_date DESC;")->getRowArray() ?? []);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray());

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization
            ]);
        }
    }

    private function getParameter()
    {
        $db = db_connect();

        $aParameter = $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_PARAMETER")->getResultArray() ?? []);
        $avalue = $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_PARAMETER_VALUE")->getResultArray() ?? []);
        return (['aValue' => $avalue, 'aParam' => $aParameter]);
    }

    private function getIndikator($visit)
    {
        $db = db_connect();
        $indikator = $this->lowerKey($db->query("SELECT * from assessment_indicator where VISIT_ID = '" . $visit['visit_id'] . "' 
                                                 and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '004')")->getRowArray() ?? []);


        $detail = $this->lowerKey($db->query("SELECT * 
                                                FROM assessment_triase_detail 
                                                WHERE body_id IN ('" . @$indikator['body_id'] . "');")->getResultArray() ?? []);


        return (['indikator' => $indikator, 'detail' => $detail]);
    }
}
