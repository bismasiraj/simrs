<?php

namespace App\Controllers\Admin\rm;



class lainnya extends \App\Controllers\BaseController
{
    public function lainnya_1($visit, $vactination_id = null)
    {
        $title = "Permintaan Laboratorium Patologi Anatomi (PA)";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/1-permintaan-lab.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/1-permintaan-lab.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function lainnya_2($visit, $vactination_id = null)
    {
        $title = "Daftar Pengobatan Parenteral";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/2-daftar-pengobatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/2-daftar-pengobatan.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function surat_rujukan($visit, $vactination_id = null)
    {
        $title = "Surat Rujukan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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
                                                        where  INASIS_KONTROL.NOSEP = '0701R0011218V004912'  --diganti dengan no sep yang berlaku
                                                        and surattype = '1' -- skdp = 1 , spri = 2
                                                        and pd.DIAG_CAT =  1")->getResultArray());
            $kopprintData = $this->kopprint();


            return view("admin/patient/profilemodul/formrm/rm/LAINNYA/surat-rujukan.php", [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData[0],
                'data' => !$select ? [] : $select[0]
            ]);
        }
    }
    public function surat_darah($visit, $vactination_id = null)
    {
        $title = "Surat Permintaan Transfusi Darah";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/surat-darah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/surat-darah.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function vaksinasi($visit, $vactination_id = null)
    {
        $title = "Surat Persetujuan Pemberian Vaksinasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/vaksinasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/vaksinasi.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function susu_formula($visit, $vactination_id = null)
    {
        $title = "Surat Persetujuan Pemberian Susu Formula";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/susu-formula.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/susu-formula.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function fisioterapi($visit, $vactination_id = null)
    {
        $title = "Surat Pengantar Fisioterapi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/fisioterapi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/fisioterapi.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function konsultasi($visit, $vactination_id = null)
    {
        $title = "Surat Perintah Konsultasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/konsultasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/konsultasi.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function pengobatan($visit, $vactination_id = null)
    {
        $title = "Daftar Pengobatan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();

            $select = $this->lowerKey($db->query("select VISIT_Id, org_unit_code, DESCRIPTION as nama_obat, DESCRIPTION2 as aturan_pakai, MODULE_ID,TREAT_DATE from PASIEN_PRESCRIPTION_DETAIL where 
                                                                VISIT_ID ='" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select)) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/pengobatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "data" => $select,
                    'kop' => $kopprintData[0]

                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/pengobatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0]

                ]);
            }
        }
    }
    public function bedah_umum($visit, $vactination_id = null)
    {
        $title = "Assessmen Bedah Umum Rawat Inap";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select 
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
            RENCANATL as rencana_tl,
            PD.DOCTOR AS DOKTER,
            POLIKONTROL_KDPOLI as kontrol
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID
            left outer join  inasis_kontrol ik on pd.VISIT_ID = ik.VISIT_ID,
            pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '202405031057300447D03'
            and PD.VISIT_ID = '202404241151300470C77' -- 
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
            RENCANATL,
            POLIKONTROL_KDPOLI,
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
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/bedah-umum.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/bedah-umum.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function nadi_suhu($visit, $vactination_id = null)
    {
        $title = "Lembar Nadi dan Suhu";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT * from EXAMINATION_INFO where visit_id = '202408030835470650684' ORDER BY examination_date DESC ")->getResultArray());
            $kopprintData = $this->kopprint();


            return view("admin/patient/profilemodul/formrm/rm/LAINNYA/nadi-suhu.php", [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData[0],
                'data' => $select
            ]);
        }
    }
    public function persalinan($visit, $vactination_id = null)
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

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/persalinan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization,
                    "info" => $selectinfo,
                    "apgarWaktu" => $apgarWaktu,
                    "apgarData" => $apgarData,
                    "neonatus" => $neonatus,
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/persalinan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization,
                    "info" => $selectinfo
                ]);
            }
        }
    }
    public function sedasi($visit, $vactination_id = null)
    {
        $title = "Assessmen Pra Anastesi Sedasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from assessment_anesthesia where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            $val = isset($select[0]) ? $select[0] : [];
            $option = $this->lowerKey($db->query("select * from ASSESSMENT_PARAMETER_VALUE where P_TYPE ='OPRS006'")->getResultArray());
            $examination = $this->lowerKey($db->query("select * from EXAMINATION_INFO where visit_id = '202406231817490203553' and pasien_diagnosa_id = '20240724122815041WTM'")->getFirstRow());
            $lokalis = $this->lowerKey($db->query("select * from ASSESSMENT_LOKALIS where visit_id = '202406231817490203553' and pasien_diagnosa_id = '20240724122815041WTM'")->getFirstRow());

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/sedasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $val,
                    "option" => $option,
                    "examination" => $examination
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/LAINNYA/sedasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $val,
                    "option" => $option,
                    "examination" => $examination
                ]);
            }
        }
    } //new Update 31/07
    public function surat_lahir($visit, $vactination_id = null)
    {
        $title = "Surat Keterangan Lahir";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();
            $select = $this->lowerKey($db->query("SELECT * from BABY where baby_id = '20240719101812088'")->getResultArray());
            $pasaran = $this->lowerKey($db->query("SELECT  THE_DAY,nama_hari,pasaran  from DAYS_NUMBER dn, baby b 
                                                    where convert(date,the_day) = convert(date,date_of_birth) 
                                                    and b.baby_id = '20240719103013776'")->getResultArray());

            return view("admin/patient/profilemodul/formrm/rm/LAINNYA/surat-lahir.php", [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData[0],
                'data' => !empty($select) ? $select[0] : [],
                'pasaran' => !empty($pasaran) ? $pasaran[0] : [],

            ]);
            // }
        }
    }
    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }


    // lab 
    public function laboratorium_cetak($visit, $vactination_id = null)
    {

        $title = "HASIL PEMERIKSAAN LABORATORIUM";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();

            //       var_dump($visit);
            // exit();


            $dataTables = $this->lowerKey($db->query("SELECT H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, kel_pemeriksaan, urut_bound,
                                                        PARAMETER_NAME, hasil, satuan, NILAI_RUJUKAN, METODE_PERIKSA, null as kode,
                                                        reg_date AS tgl_hasil, norm, k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, 
                                                        k.pengirim_name, k.ruang_name, k.kelas_name, k.Tgl_Periksa, h.flag_hl
                                                        FROM sharelis.dbo.hasillis h
                                                        LEFT OUTER JOIN sharelis.dbo.kirimlis k ON h.norm COLLATE database_default = k.no_pasien COLLATE 
                                                        database_default AND H.kode_kunjungan = K.Kode_Kunjungan
                                                        WHERE H.kode_kunjungan LIKE '" . $visit['nolist'] . "'
                                                        AND No_Pasien LIKE '" . $visit['no_pasien'] . "'
                                                        AND reg_date BETWEEN DATEADD(hour, 0, '" . $visit['start_request'] . "')
                                                        AND DATEADD(hour, 24, COALESCE('" . $visit['end_request'] . "', GETDATE()))
                                                        GROUP BY H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, kel_pemeriksaan, urut_bound,
                                                        PARAMETER_NAME, hasil, satuan, NILAI_RUJUKAN, METODE_PERIKSA, k.Tgl_Periksa, reg_date, norm,
                                                        k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, k.pengirim_name, k.ruang_name, k.kelas_name, h.flag_hl
                                                        ORDER BY urut_bound, kode_kunjungan, tarif_id, kel_pemeriksaan")->getResultArray());


            $select = $this->lowerKey($db->query("select VISIT_Id, org_unit_code, DESCRIPTION as nama_obat, DESCRIPTION2 as aturan_pakai, MODULE_ID,TREAT_DATE from PASIEN_PRESCRIPTION_DETAIL where 
                                                                VISIT_ID ='" . $visit['visit_id'] . "' AND ORG_UNIT_CODE ='" . $visit['org_unit_code'] . "'")->getResultArray());
            if (isset($select)) {
                return view("admin/patient/profilemodul/formrm/rm/hasil-pemeriksaan-laboratorium.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "data" => $select,
                    'kop' => $kopprintData[0],
                    'dataTables' => $dataTables

                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/hasil-pemeriksaan-laboratorium.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0],
                    'dataTables' => $dataTables

                ]);
            }
        }
    }


    // radiologi
    public function radiologi_cetak($visit, $vactination_id = null)
    {
        $title = "HASIL PEMERIKSAAN LABORATORIUM";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();

            $dataTables = $this->lowerKey($db->query("SELECT TREAT_RESULTS.ORG_UNIT_CODE, TREAT_RESULTS.RESULT_ID, TREAT_RESULTS.VISIT_ID, TREAT_RESULTS.NO_REGISTRATION, TREAT_RESULTS.TARIF_ID,
                                                                 TREAT_RESULTS.TARIF_NAME, TREAT_RESULTS.EMPLOYEE_ID, TREAT_RESULTS.EMPLOYEE_ID_FROM, TREAT_RESULTS.PICKUP_DATE, TREAT_RESULTS.RESULT_VALUE,
                                                                 TREAT_RESULTS.THENAME, TREAT_RESULTS.THEADDRESS, TREAT_RESULTS.AGEYEAR, TREAT_RESULTS.AGEMONTH, TREAT_RESULTS.AGEDAY, TREAT_RESULTS.nota_no,
                                                                 TREAT_RESULTS.GENDER, TREAT_RESULTS.KAL_ID, TREAT_RESULTS.BOUND_ID, TREAT_RESULTS.MEASURE_ID, TREAT_RESULTS.DOCTOR_FROM,  TREAT_RESULTS.DOCTOR, C.NAME_OF_CLINIC, TREAT_RESULTS.PRINT_DATE, 
                                                                 TREAT_RESULTS.PRINTED_BY, TREAT_RESULTS.PRINTQ, TREAT_RESULTS.description, TREAT_RESULTS.CONCLUSION,TREAT_RESULTS.THEID,TREAT_RESULTS.NOSEP, 
                                                                 treat_results.isvalid, treat_results.valid_date, treat_results.iskritis FROM TREAT_RESULTS, CLINIC C WHERE 
                                                                 TREAT_RESULTS.result_id = '" . $vactination_id . "' and treat_results.clinic_id = c.clinic_id ORDER BY TREAT_RESULTS.REAGENT_ID, 
                                                                 TREAT_RESULTS.BOUND_ID")->getResultArray());

            if (isset($visit)) {
                return view("admin/patient/profilemodul/formrm/rm/hasil-pemeriksaan-radiologi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0],
                    'dataTables' => $dataTables

                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/hasil-pemeriksaan-radiologi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0],
                    'dataTables' => $dataTables

                ]);
            }
        }
    }
    public function rajalFisikAndRehab($visit, $vactination_id = null)
    {
        $title = "FORMULIR KLAIM RAWAT JALAN LAYANAN KEDOKTERAN FISIK DAN REHABILITASI";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();

            $select = $this->lowerKey($db->query("
                SELECT VISIT_Id, org_unit_code, DESCRIPTION AS nama_obat, DESCRIPTION2 AS aturan_pakai, MODULE_ID, TREAT_DATE 
                FROM PASIEN_PRESCRIPTION_DETAIL 
                WHERE VISIT_ID ='" . $visit['visit_id'] . "' 
                AND ORG_UNIT_CODE ='" . $visit['org_unit_code'] . "'")->getResultArray());

            $pasienData = $this->lowerKey($db->query("SELECT * FROM PASIEN 
                WHERE NO_REGISTRATION ='" . $visit['no_registration'] . "'")->getRowArray());

            // WHERE visit_id = '20240705P012021119' 
            $diagnosa = $this->lowerKey($db->query("SELECT TOP 1 * 
                                        FROM PASIEN_DIAGNOSA 
                                        WHERE visit_id ='" . $visit['visit_id'] . "' 
                                        ORDER BY date_of_diagnosa DESC
                                        ")->getResultArray());

            if ($diagnosa) {
                $diagnosas = $this->lowerKey($db->query("
                        SELECT * 
                        FROM PASIEN_DIAGNOSAS 
                        WHERE PASIEN_DIAGNOSA_ID = '" . $diagnosa[0]['pasien_diagnosa_id'] . "'
                    ")->getResultArray());

                if ($diagnosas) {
                    $diagnosa = ['diagnosa' => $diagnosa[0], 'diagnosas' => $diagnosas[0]];
                } else {
                    $diagnosa = ['diagnosa' => $diagnosa[0], 'diagnosas' => []];
                }
            } else {
                $diagnosa = [];
            }

            if ($pasienData) {
                $visit = array_merge($visit, $pasienData);
            }

            return view("admin/patient/profilemodul/formrm/rm/gangguan-pola-jalan.php", [
                "visit" => $visit,
                'title' => $title,
                "data" => $select,
                'kop' => $kopprintData[0],
                'diagnosa' => $diagnosa,
            ]);
        }
    }



    public function requestFisioterapiVisit($visit, $vactination_id = null)
    {
        $title = "FORMULIR KLAIM RAWAT JALAN LAYANAN KEDOKTERAN FISIK DAN REHABILITASI";

        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();

            $dataTables = $this->lowerKey(
                $db->query("SELECT pfd.*, tt.tarif_name 
                    FROM PASIEN_FISIOTERAPI_DETAIL pfd 
                    INNER JOIN TREAT_TARIF tt ON pfd.tarif_id = tt.tarif_id 
                    WHERE pfd.visit_id ='" . $visit['visit_id'] . "'
                ")->getResultArray()
            );

            $select = $this->lowerKey($db->query("SELECT VISIT_Id, org_unit_code, DESCRIPTION as nama_obat, DESCRIPTION2 as aturan_pakai, MODULE_ID, TREAT_DATE 
                                                  FROM PASIEN_PRESCRIPTION_DETAIL 
                                                  WHERE VISIT_ID ='" . $visit['visit_id'] . "' 
                                                  AND ORG_UNIT_CODE ='" . $visit['org_unit_code'] . "'")->getResultArray());

            return view("admin/patient/profilemodul/formrm/rm/request-fisoterapi-visit.php", [
                "visit" => $visit,
                'title' => $title,
                "data" => $select,
                'kop' => $kopprintData[0],
                'dataTables' => $dataTables,
            ]);
        }
    }
    public function blood_request_ctk($visit, $vactination_id = null)
    {
        $title = "Surat Permintaan Tranfusi Darah";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT * from BLOOD_REQUEST where VISIT_ID = '202406231817490203553' And BLOOD_REQUEST ='20240722042830570R50'")->getResultArray());
            if (!empty($select)) {
                $select = $select[0];
            }
            $kopprintData = $this->kopprint();

            $usage_type =  $this->lowerKey($db->query("select * from blood_usage_type")->getResultArray());
            $measurement =  $this->lowerKey($db->query("select * from measurement")->getResultArray());
            $blood_type = $this->lowerKey($db->query("select * from blood_type")->getResultArray());

            return view("admin/patient/profilemodul/formrm/rm/LAINNYA/blood_request-cetak.php", [
                "visit" => $visit,
                'title' => $title,
                'data' => $select,
                'usage_type' => $usage_type,
                'measurement' => $measurement,
                'blood_type' => $blood_type,
                'kop' => $kopprintData[0],
            ]);
        }
    }
}
