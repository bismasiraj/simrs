<?php

namespace App\Controllers\Admin\rm;

use App\Models\OrganizationunitModel;


class medis extends \App\Controllers\BaseController
{

    public function medis_Saraf($visit, $vactination_id = null)
    {

        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $clinic = $db->query("SELECT NAME_OF_CLINIC FROM CLINIC WHERE CLINIC_ID = ?", [$visit['clinic_id']])->getRowArray();

            if ($clinic) {
                $visit['nama_clinic'] = $clinic['NAME_OF_CLINIC'];
            }


            $title = "Asesmen Medis Saraf";

            $title .= $visit['isrj'] == 0 ? " Rawat Inap" : " Rawat Jalan";

            $select = $this->lowerKey($db->query("SELECT 
                                                    pd.NO_REGISTRATION as no_RM,
                                                    p.NAME_OF_PASIEN as nama,
                                                    pd.PASIEN_DIAGNOSA_ID,
                                                    pd.BODY_ID,
                                                    CASE 
                                                        WHEN p.gender = '1' THEN 'Laki-laki'
                                                        ELSE 'Perempuan'
                                                    END as jeniskel,
                                                    p.CONTACT_ADDRESS as alamat,
                                                    pd.DOCTOR as dpjp,
                                                    c.name_of_clinic as departemen,
                                                    class.NAME_OF_CLASS as kelas,
                                                    cr.NAME_OF_CLASS as bangsal,
                                                    pd.BED_ID as bed,
                                                    pd.IN_DATE as tanggal_masuk,
                                                    CONVERT(varchar, P.DATE_OF_BIRTH, 105) as date_of_birth,
                                                    CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
                                                    ed.WEIGHT as berat,
                                                    ed.HEIGHT as tinggi,
                                                    ed.TENSION_UPPER as tensi_atas,
                                                    ed.TENSION_BELOW as tensi_bawah,
                                                    ed.TEMPERATURE as suhu,
                                                    ed.RESPIRATION as nafas,
                                                    ed.SATURASI as SPO2,
                                                    ed.WEIGHT / (
                                                        (CAST(ed.HEIGHT AS DECIMAL(5, 2)) / CAST(100 AS DECIMAL(5, 2))) * 
                                                        (CAST(ed.HEIGHT AS DECIMAL(5, 2)) / CAST(100 AS DECIMAL(5, 2)))
                                                    ) AS IMT,
                                                    pd.DIAGNOSA_DESC as namadiagnosa,
                                                    pd.ANAMNASE as anamnesis,
                                                    pd.DESCRIPTION as riwayat_penyakit_sekarang,
                                                    an.document_id,
                                                    an.no_registration as no_reg_neuro,
                                                    an.examination_date,
                                                    an.vas_nrs,
                                                    an.left_diameter,
                                                    an.left_light_reflex,
                                                    an.left_cornea,
                                                    an.left_isokor_anisokor,
                                                    an.right_diameter,
                                                    an.right_light_reflex,
                                                    an.right_cornea,
                                                    an.right_isokor_anisokor,
                                                    an.stiff_neck,
                                                    an.meningeal_sign,
                                                    an.brudzinki_i_iv,
                                                    an.kernig_sign,
                                                    an.dolls_eye_phenomenon,
                                                    an.vertebra,
                                                    an.extremity,
                                                    an.motion_upper_left,
                                                    an.motion_upper_right,
                                                    an.motion_lower_left,
                                                    an.motion_lower_right,
                                                    an.strength_upper_left,
                                                    an.strength_upper_right,
                                                    an.strength_lower_left,
                                                    an.strength_lower_right,
                                                    an.physiological_reflex_upper_left,
                                                    an.physiological_reflex_upper_right,
                                                    an.physiological_reflex_lower_left,
                                                    an.physiological_reflex_lower_right,
                                                    an.pathologycal_reflex_upper_left,
                                                    an.pathologycal_reflex_upper_right,
                                                    an.pathologycal_reflex_lower_left,
                                                    an.pathologycal_reflex_lower_right,
                                                    an.clonus,
                                                    an.sensibility,
                                                    gcs.GCS_E,
                                                    gcs.GCS_m,
                                                    gcs.GCS_V, 
                                                    gcs.GCS_SCORE as gcs,
                                                    pd.HURT AS PENYEBAB_CIDERA,
                                                    pd.MEDICAL_PROBLEM AS MASALAH_MEDIS,
                                                    pd.DIAGNOSA_ID AS icd10,
                                                    pd.THERAPY_TARGET AS SASARAN,
                                                    pd.LAB_RESULT AS LABORATORIUM,
                                                    pd.RO_RESULT AS RADIOLOGI,  
                                                    pd.TERAPHY_DESC AS FARMAKOLOGIA,
                                                    pd.INSTRUCTION AS PROSEDUR,
                                                    pd.STANDING_ORDER AS STANDING_ORDER,
                                                    pd.rencanatl as rencana_tl,
                                                    -- Agregasi skala nyeri
                                                    STRING_AGG(CONCAT('Skor : ', apd.VALUE_SCORE, ' | ', apd.VALUE_DESC), '<br>') AS skala_nyeri
                                                FROM 
                                                    pasien_diagnosa pd
                                                LEFT JOIN 
                                                    clinic c ON pd.clinic_id = c.clinic_id
                                                LEFT JOIN 
                                                    CLASS_ROOM cr ON cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
                                                LEFT JOIN 
                                                    class ON class.CLASS_ID = cr.CLASS_ID
                                                LEFT JOIN 
                                                    EXAMINATION_INFO ei ON ei.BODY_ID = pd.BODY_ID
                                                LEFT JOIN 
                                                    EXAMINATION_DETAIL ed ON ed.BODY_ID = ei.BODY_ID
                                                LEFT JOIN 
                                                    PASIEN p ON pd.NO_REGISTRATION = p.NO_REGISTRATION
                                                LEFT JOIN 
                                                    ASSESSMENT_NEUROLOGY an ON an.document_id = pd.PASIEN_DIAGNOSA_ID AND an.VISIT_ID = pd.VISIT_ID 
                                                    AND an.EXAMINATION_DATE = (
                                                        SELECT MAX(EXAMINATION_DATE) 
                                                        FROM ASSESSMENT_NEUROLOGY 
                                                        WHERE DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID 
                                                        AND VISIT_ID = pd.VISIT_ID
                                                    )
                                                LEFT JOIN 
                                                    ASSESSMENT_GCS gcs on gcs.DOCUMENT_ID = pd.BODY_ID AND an.EXAMINATION_DATE = (
                                                        SELECT MAX(EXAMINATION_DATE) 
                                                        FROM ASSESSMENT_GCS 
                                                        WHERE DOCUMENT_ID = pd.BODY_ID 
                                                    )
                                                LEFT JOIN 
                                                    ASSESSMENT_PAIN_MONITORING apm ON apm.DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID
                                                LEFT JOIN 
                                                    ASSESSMENT_PAIN_DETAIL apd ON apd.BODY_ID = apm.BODY_ID
                                             
                                                WHERE 
                                                    pd.PASIEN_DIAGNOSA_ID = '20240902124016011344Bbismasiraj'
                                                    AND pd.VISIT_ID = '20240902124016011344B'
                                                GROUP BY 
                                                    pd.PASIEN_DIAGNOSA_ID, 
                                                    pd.BODY_ID, 
                                                    pd.NO_REGISTRATION, 
                                                    p.NAME_OF_PASIEN, 
                                                    CASE WHEN p.gender = '1' THEN 'Laki-laki' ELSE 'Perempuan' END, 
                                                    p.CONTACT_ADDRESS, 
                                                    pd.DOCTOR, 
                                                    c.name_of_clinic, 
                                                    class.NAME_OF_CLASS,  
                                                    cr.NAME_OF_CLASS,  
                                                    pd.BED_ID,  
                                                    pd.IN_DATE, 
                                                    ed.WEIGHT, 
                                                    ed.HEIGHT, 
                                                    ed.TENSION_UPPER, 
                                                    ed.TENSION_BELOW, 
                                                    ed.RESPIRATION, 
                                                    ed.SATURASI, 
                                                    ed.TEMPERATURE, 
                                                    CONVERT(varchar, P.DATE_OF_BIRTH, 105), 
                                                    CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR', 
                                                    pd.DIAGNOSA_DESC, 
                                                    pd.ANAMNASE, 
                                                    pd.DESCRIPTION,
                                                    an.document_id,
                                                    an.no_registration,
                                                    an.examination_date,
                                                    an.vas_nrs,
                                                    an.left_diameter,
                                                    an.left_light_reflex,
                                                    an.left_cornea,
                                                    an.left_isokor_anisokor,
                                                    an.right_diameter,
                                                    an.right_light_reflex,
                                                    an.right_cornea,
                                                    an.right_isokor_anisokor,
                                                    an.stiff_neck,
                                                    an.meningeal_sign,
                                                    an.brudzinki_i_iv,
                                                    an.kernig_sign,
                                                    an.dolls_eye_phenomenon,
                                                    an.vertebra,
                                                    an.extremity,
                                                    an.motion_upper_left,
                                                    an.motion_upper_right,
                                                    an.motion_lower_left,
                                                    an.motion_lower_right,
                                                    an.strength_upper_left,
                                                    an.strength_upper_right,
                                                    an.strength_lower_left,
                                                    an.strength_lower_right,
                                                    an.physiological_reflex_upper_left,
                                                    an.physiological_reflex_upper_right,
                                                    an.physiological_reflex_lower_left,
                                                    an.physiological_reflex_lower_right,
                                                    an.pathologycal_reflex_upper_left,
                                                    an.pathologycal_reflex_upper_right,
                                                    an.pathologycal_reflex_lower_left,
                                                    an.pathologycal_reflex_lower_right,
                                                    an.clonus,
                                                    an.sensibility,
                                                    gcs.GCS_E,
                                                    gcs.GCS_m,
                                                    gcs.GCS_V, 
                                                    gcs.GCS_SCORE, 
                                                    pd.HURT,
                                                    pd.MEDICAL_PROBLEM,
                                                    pd.DIAGNOSA_ID,
                                                    pd.THERAPY_TARGET,
                                                    pd.LAB_RESULT,
                                                    pd.RO_RESULT,
                                                    pd.TERAPHY_DESC,
                                                    pd.INSTRUCTION,
                                                    pd.STANDING_ORDER,
                                                    pd.rencanatl
             ")->getResultArray());

            $select = !empty($select) ? $select[0] : [];


            $ass_fall = $db->query("SELECT 
                                    STRING_AGG(CONCAT('Skor : ', apd.VALUE_SCORE, ' | ', apd.VALUE_DESC), '<br>') AS fall_risk_detail
                                FROM pasien_diagnosa pd
                                LEFT JOIN ASSESSMENT_FALL_RISK_DETAIL apd 
                                    ON apd.BODY_ID = (
                                        SELECT TOP 1 BODY_ID 
                                        FROM ASSESSMENT_FALL_RISK 
                                        WHERE DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID 
                                        ORDER BY EXAMINATION_DATE DESC
                                    )
                                WHERE pd.PASIEN_DIAGNOSA_ID = ?
                                AND pd.VISIT_ID = ?
                                GROUP BY pd.PASIEN_DIAGNOSA_ID;
                            ", ['20240902124016011344Bbismasiraj', '20240902124016011344B'])->getRowArray();

            if ($ass_fall) {
                $select['fall_risk_detail'] = $ass_fall['fall_risk_detail'];
            }



            if (isset($select)) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/medis-saraf.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/medis-saraf.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ralan_anak($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Anak Rawat Jalan";
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
            pd.alloanamnase,
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
            ei.pemeriksaan as pemeriksaan_fisik,
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
            PD.DOCTOR AS DOKTER,
            pd.rencanatl as rencana_tl,
            '' as kontrol
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
            pasien p 
            where 
            pd.diag_cat = '3'
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
            pd.rencanatl,
            ei.WEIGHT,
            ei.HEIGHT, 
            ei.TENSION_UPPER, 
            ei.TENSION_BELOW, 
            ei.nadi,
            ei.NAFAS, 
            ei.SATURASI,
            ei.TEMPERATURE,
            ei.pemeriksaan,
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
            pd.alloanamnase,
            PD.DOCTOR")->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/1-ralan-anak.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/1-ralan-anak.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ralan_bedah($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Bedah Umum Rawat Jalan";
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
            PD.DOCTOR AS DOKTER,
            pd.TGLKONTROL as kontrol,
            pd.rencanatl as rencana_tl
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
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
            pd.rencanatl,
            pd.TGLKONTROL,
            PD.DOCTOR")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/2-ralan-bedah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/2-ralan-bedah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ralan_dalam($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Penyakit Dalam Rawat Jalan";
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
            PD.DOCTOR AS DOKTER,
            pd.TGLKONTROL as kontrol,
            pd.rencanatl as rencana_tl
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
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
            pd.rencanatl,
            pd.TGLKONTROL,
            PD.DOCTOR")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/3-ralan-dalam.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/3-ralan-dalam.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ralan_kebidanan($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Kebidanan Rawat Jalan";
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
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/4-ralan-kebidanan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/4-ralan-kebidanan.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ralan_kulit_kelamin($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Kulit Kelamin Rawat Jalan";
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
            PD.DOCTOR AS DOKTER,
            pd.TGLKONTROL as kontrol,
            pd.rencanatl as rencana_tl
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
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
            PD.rencanatl,
            pd.TGLKONTROL,
            PD.DOCTOR")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/5-ralan-kulit-kelamin.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/5-ralan-kulit-kelamin.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ralan_mata($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Mata Rawat Jalan";
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
            PD.DOCTOR AS DOKTER,
            pd.TGLKONTROL as kontrol,
            pd.rencanatl as rencana_tl
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
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
            pd.TGLKONTROL,
            pd.rencanatl,
            PD.DOCTOR")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/6-ralan-mata.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/6-ralan-mata.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ralan_tht($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis THT Rawat Jalan";
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
            PD.DOCTOR AS DOKTER,
            pd.TGLKONTROL as kontrol,
            pd.rencanatl as rencana_tl
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
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
            pd.TGLKONTROL,
            pd.rencanatl,
            PD.DOCTOR")->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/7-ralan-tht.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/7-ralan-tht.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ranap_anak($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Anak Rawat Inap";
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
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/8-ranap-anak.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/8-ranap-anak.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ranap_dalam($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Penyakit Dalam Rawat Inap";
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
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/9-ranap-dalam.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/9-ranap-dalam.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ranap_kebidanan($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Kebidanan Rawat Inap";
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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/10-ranap-kebidanan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/10-ranap-kebidanan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function ranap_paru($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Paru Rawat Inap";
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
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/12-ranap-paru.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/12-ranap-paru.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ranap_neonatal($visit, $vactination_id = null)
    {
        $title = "Asesmen Medis Rawat Inap Neonatal";
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
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/11-ranap-neonatal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/11-ranap-neonatal.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function rawat_jalan($visit, $vactination_id = null, $title = "Asesmen Medis")
    {
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            // return json_encode($vactination_id);
            // return json_encode($visit);
            $specialist_type_id = $visit['specialist_type_id'];

            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT 
            pd.NO_REGISTRATION as no_RM,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end as jeniskel,
            p.CONTACT_ADDRESS as alamat,
            pd.DOCTOR as dpjp,
            c.name_of_clinic as departmen,
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
            gcs.GCS_DESC,
            max(case when apv.PARAMETER_ID = '01' and apv.VALUE_SCORE = GCS_E then apv.VALUE_DESC else '' end ) as GSC_E_DESC,
            max(case when apv.PARAMETER_ID = '02' and apv.VALUE_SCORE = GCS_M then apv.VALUE_DESC else '' end ) as GSC_M_DESC,
            max(case when apv.PARAMETER_ID = '03' and apv.VALUE_SCORE = GCS_V then apv.VALUE_DESC else '' end ) as GSC_V_DESC,
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
            MAX(CASE WHEN EDU.INFORMATION_RECEIVER = '1' THEN 'Penerima Pasien' + ' materi edukasi : '   + edu.education_material
            else 'Kerabat Pasien dengan nama : ' + edu.family_name + ' materi edukasi : ' + edu.education_material  end ) as edukasi_pasien,
            igt.nama as tindaklanjut,
            pd.TGLKONTROL as tanggal_kontrol,   
            eid.WEIGHT as berat,
            eid.HEIGHT as tinggi,
            eid.TENSION_UPPER as tensi_atas,
            eid.TENSION_BELOW as tensi_bawah,
            eid.nadi,
            eid.TEMPERATURE AS Suhu,
            eid.NAFAS as respiration,
            eid.SATURASI AS SPO2,
            EId.WEIGHT/ ( (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) AS IMT,
            isnull((select top(1) total_score from ASSESSMENT_FALL_RISK
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
            isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
            PD.DIAGNOSA_ID,
            PD.MEDICAL_PROBLEM AS MASALAH_MEDIS,
            'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
            PD.HURT AS PENYEBAB_CIDERA,
        
            ei.INSTRUCTION AS SASARAN,
            PD.INSTRUCTION AS PROSEDUR,
            PD.STANDING_ORDER AS STANDING_ORDER,
            PD.DOCTOR AS DOKTER,
            '' kontrol,
			 isnull((select top(1) case when total_score = 5 then 'ATS V' 
			 when total_score = 4 then 'ATS IV'
			 when total_score = 3 then 'ATS III'
			 when TOTAL_SCORE = 2 then 'ATS II'
			 when total_score = 1 then 'ATS I' end 
			 from ASSESSMENT_indicator
            where DOCUMENT_ID = pd.pasien_diagnosa_id order by EXAMINATION_DATE desc) ,'') as ATS_Tipe,

			 ATS_ITEM = STUFF(
             (SELECT ',' + value_desc
              FROM ASSESSMENT_INDICATOR_DETAIL aid
			  WHERE aid.BODY_ID in (select BODY_ID from ASSESSMENT_INDICATOR 
					where DOCUMENT_ID = pd.pasien_diagnosa_id)
              FOR XML PATH (''))
             , 1, 1, '') ,
			max(  case when arp.PREGNANT = '1' then 'Hamil'
			  else 'Tidak Hamil' end ) as hamil,
			  max(arp.g) as hamil_G,
			   max(arp.p) as hamil_p,
			    max(arp.a) as hamil_a

            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            left outer join EXAMINATION_DETAIL eid on eid.body_id = pd.BODY_ID
            left outer join (
					SELECT TOP 1 
						GCS_E, GCS_M, GCS_V, GCS_SCORE,gcs_desc ,DOCUMENT_ID ,P_TYPE
					FROM ASSESSMENT_GCS 
					WHERE DOCUMENT_ID = '$vactination_id'
					ORDER BY EXAMINATION_DATE DESC
				) AS gcs on pd.PASIEN_DIAGNOSA_ID = gcs.DOCUMENT_ID
            left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on pd.PASIEN_DIAGNOSA_ID = EDU.DOCUMENT_ID
			left outer join INASIS_GET_TINDAKLANJUT igt on pd.RENCANATL = igt.KODE
			left outer join ASSESSMENT_REPRODUCTION arp on pd.PASIEN_DIAGNOSA_ID = arp.DOCUMENT_ID
            LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
           , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '$vactination_id'
            and PD.VISIT_ID =  '{$visit['visit_id']}'
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
            eid.WEIGHT,
            eid.HEIGHT, 
            eid.TENSION_UPPER, 
            eid.TENSION_BELOW, 
            eid.nadi,
            eid.NAFAS, 
            eid.SATURASI,
            eid.TEMPERATURE,
            convert(varchar,P.date_of_birth,105),
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR',
            gcs.GCS_E, 
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE, 
            gcs.GCS_DESC,
            igt.nama,
            pd.TGLKONTROL,
            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            EID.WEIGHT/ ( (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ), 
            ei.INSTRUCTION,
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR")->getRow(0, "array"));

            $query = "SELECT  STUFF(
             (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
			  treatment_obat.body_id  = '$vactination_id' 
			  and DESCRIPTION <> '%jasa%' 
                group by description ,isnull(description2,'')
              FOR XML PATH (''))
             ,1, 2, '') terapi
			 from ORGANIZATIONUNIT ;";
            $farmako = $this->lowerKeyOne($db->query($query)->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $selectlokalis = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                where body_id = '$vactination_id' AND assessment_lokalis.VALUE_SCORE = 3"
            )->getResultArray());

            $selectlokalis2 = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                where body_id = '$vactination_id' AND assessment_lokalis.VALUE_SCORE = 2"
            )->getResultArray());



            $lab = $db->query("SELECT REPLACE(replace( STUFF(
                                (SELECT ';' +  ' Pemeriksaan : ' + tr.treatment + '  '
                                from TREATMENT_BILL tr where
                                -- tr.TRANS_ID = 'trans_id'  and
                                tr.VISIT_ID= ?  and
                                tr.CLINIC_ID = 'P013' 	 
                                order by tr.TREATMENT
                                FOR XML PATH (''))
                                , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksalab
                                from ORGANIZATIONUNIT
                            ", [$visit['visit_id']])->getRowArray();

            $rad = $db->query("SELECT REPLACE(replace( STUFF(
                    (SELECT ';' +  ' Pemeriksaan : ' + tr.treatment + '  '
                    from TREATMENT_BILL tr where
                    -- tr.TRANS_ID = 'trans_id'  and
                    tr.VISIT_ID= ?  and
                    tr.CLINIC_ID = 'P016' 	 
                    order by tr.TREATMENT
                    FOR XML PATH (''))
                    , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksarad
                    from ORGANIZATIONUNIT
                ", [$visit['visit_id']])->getRowArray();

            $tindakLanjut = $this->lowerKey($db->query("SELECT 
                            CASE 
                                WHEN ISINTERNAL = 2 THEN 'DIRUJUK'
                                WHEN ISINTERNAL = 3 THEN 'DI RUJUK KE UNIT LAIN (KONSUL)'
                                WHEN ISINTERNAL = 4 THEN 'PERAWATAN JALAN (KONTROL)'
                                WHEN ISINTERNAL = 5 THEN 'RAWAT INAP'
                                WHEN ISINTERNAL = 10 THEN 'TRANSFER INTERNAL'
                                WHEN ISINTERNAL = 11 THEN 'Pengobatan Selesai'
                                ELSE ''
                            END AS tindak_lanjut
                        FROM PASIEN_TRANSFER
                        WHERE visit_id = ?
                        AND ISINTERNAL <> 11;", [$visit['visit_id']])->getRowArray());

            $farma = $db->query("SELECT  STUFF(
                        (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
                        treatment_obat.visit_id  = ?
                        and DESCRIPTION <> '%jasa%' 
                            group by description ,isnull(description2,'')
                        FOR XML PATH (''))
                        ,1, 2, '') terapi
                        from ORGANIZATIONUNIT ;
                        ", [$visit['visit_id']])->getRowArray();
            if ($specialist_type_id === "1.12") {
                $kulit = $db->query(
                    "SELECT top (1)  sd_ins_location,sd_ins_ukk,sd_ins_distribution,sd_ins_configuration,
                                sd_palpation,sd_others,sv_inspection,sv_palpation from ASSESSMENT_DERMATOVENEROLOGI where 
                                DOCUMENT_ID = ? 
                                and VISIT_ID =? order by EXAMINATION_DATE desc",
                    [$visit['session_id'], $visit['visit_id']]
                )->getRowArray();
            } else if ($specialist_type_id === "1.16") {
                $saraf = $db->query(
                    "SELECT top (1) document_id,no_registration as no_reg_neuro,examination_date,
                                    vas_nrs,left_diameter,left_light_reflex,left_cornea,left_isokor_anisokor,
                                    right_diameter,right_light_reflex,right_cornea,right_isokor_anisokor,stiff_neck,
                                    meningeal_sign,brudzinki_i_iv,kernig_sign,dolls_eye_phenomenon,vertebra,extremity,
                                    motion_upper_left,motion_upper_right,motion_lower_left,motion_lower_right,strength_upper_left,
                                    strength_upper_right,strength_lower_left,strength_lower_right,physiological_reflex_upper_left,
                                    physiological_reflex_upper_right,physiological_reflex_lower_left,physiological_reflex_lower_right,
                                    pathologycal_reflex_upper_left,pathologycal_reflex_upper_right,pathologycal_reflex_lower_left,
                                    pathologycal_reflex_lower_right,clonus,sensibility FROM ASSESSMENT_NEUROLOGY where DOCUMENT_ID = ? 
                                    and VISIT_ID = ? order by EXAMINATION_DATE desc",
                    [$visit['session_id'], $visit['visit_id']]
                )->getRowArray();
            } else if ($specialist_type_id = "1.10") {
                $mata = $this->lowerKey($db->query(
                    "SELECT 
                        assessment_lokalis.*, 
                        ASSESSMENT_PARAMETER_VALUE.VALUE_DESC AS nama_lokalis 
                    FROM 
                        assessment_lokalis
                    INNER JOIN 
                        ASSESSMENT_PARAMETER_VALUE 
                    ON 
                        assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                    WHERE 
                        body_id = '$vactination_id' 
                        AND assessment_lokalis.VALUE_SCORE IN (4, 5)
                    ORDER BY 
                        assessment_lokalis.VALUE_SCORE ASC;"
                )->getResultArray());
            }


            // var_dump($lab);
            if ($lab) {
                $select['laboratorium'] = $lab['periksalab'];
            }
            if ($rad) {
                $select['radiologi'] = $rad['periksarad'];
            }
            if ($farma) {
                $select['farmakologia'] = $farma['terapi'];
            }
            if ($tindakLanjut) {
                $select['rencana_tl'] = $tindakLanjut['tindak_lanjut'];
            }
            if (@$kulit) {
                $select['kulit'] = $kulit;
            }
            if (@$saraf) {
                $select['saraf'] = $saraf;
            }

            if (@$mata) {
                $select['mata'] = $mata;
            }


            $selectinfo = $visit;

            $sign = $this->checkSignDocs($vactination_id, 2);



            // return json_encode($select['mata']);
            return view("admin/patient/profilemodul/formrm/rm/MEDIS/20-igd-rawat-jalan.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "lokalis" => $selectlokalis,
                "lokalis2" => $selectlokalis2,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "sign" => $sign,
                "farmako" => $farmako,
            ]);
        }
    }



    public function profile($visit, $vactination_id = null)
    {
        $title = "Profil Ringkas Medis Rawat Jalan (PRMRJ)";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query(
                "
                select 
                    pasien_diagnosa_id,DATE_OF_DIAGNOSA as tgl_kunjungan,
                    DOCTOR as DPJP,
                    Diagnosis = 
                            cast(STUFF(
                            (SELECT ',' + pp.diagnosa_id + '( ' + pp.diagnosa_desc + ' ) '
                            FROM PASIEN_DIAGNOSAs pp
                            WHERE pp.PASIEN_DIAGNOSA_ID =(pd.PASIEN_DIAGNOSA_ID)
                            
                            FOR XML PATH (''))
                            , 1, 1, '') as varchar(4000) ),
                    LAB_RESULT as prosedur_lab,RO_RESULT as radiologi,TERAPHY_DESC as farmasi
                from pasien_diagnosa pd 
                where NO_REGISTRATION = '{$visit['no_registration']}'
                and (CLASS_ROOM_ID is null 
                or CLASS_ROOM_ID = '')
                "
            )->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $selectinfo = $visit;
            return view("admin/patient/profilemodul/formrm/rm/MEDIS/14-profile-ringkas.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo
            ]);
        }
    }
    public function resume_medis($visit, $vactination_id = null)
    {
        $title = "Resume Medis";
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
            pd.PASIEN_DIAGNOSA_ID = '$vactination_id'
            and PD.VISIT_ID = '" . $visit['visit_id'] .
                "' -- 
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
            PD.DOCTOR")->getRow(0, "array"));

            $selectlokalis2 = $this->lowerKey($db->query(
                "
                select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                where body_id = '20240614173754692' AND assessment_lokalis.VALUE_SCORE = 2"
            )->getResultArray());
            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    ATURANMINUM2 AS SIGNATURA,
                    MAX(TREAT_DATE) AS tanggal_selesai,
                    MIN(TREAT_DATE) AS tanggal_mulai

                FROM PASIEN_PRESCRIPTION_DETAIL
                WHERE VISIT_ID = '202404241151300470C77'
                GROUP BY DESCRIPTION, ATURANMINUM2, TREAT_DATE
                "
            )->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $selectinfo = $visit;

            $sign = $this->checkSignDocs($vactination_id, 2);

            // return json_encode($sign);
            return view("admin/patient/profilemodul/formrm/rm/MEDIS/16-resume-medis.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe,
                "sign" => $sign
            ]);
        }
    }
    public function surat_diagnosis($visit, $vactination_id = null)
    {
        $title = "Surat Keterangan Diagnosis";
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
            where  INASIS_KONTROL.NOSEP = '0701R0011218V004912' 
            and surattype = '1'
            and pd.DIAG_CAT =  1")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/17-surat-diagnosis.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/17-surat-diagnosis.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => []
                ]);
            }
        }
    }
    public function surat_bpjs($visit, $vactination_id = null)
    {
        $title = "Surat Kontrol Pasien BPJS";
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
            st.SPECIALIST_TYPE as department
   
            FROM INASIS_KONTROL left outer join  pasien_visitation pv on inasis_kontrol.nosep = isnull(pv.no_skp,pv.no_skpinap) 
            inner join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            where  INASIS_KONTROL.NOSEP = '0701R0011218V004912' 
            and surattype = '1'
            and pd.DIAG_CAT =  1")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/18-surat-bpjs.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/18-surat-bpjs.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function surat_perintah($visit, $vactination_id = null)
    {
        $title = "Surat Perintah Rawat Inap";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/19-surat-perintah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/19-surat-perintah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => []
                ]);
            }
        }
    }
    public function surat_rujukan($visit, $vactination_id = null)
    {
        $title = "SURAT RUJUKAN";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/21-surat-rujukan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/21-surat-rujukan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => [],
                    "organization" => $selectorganization
                ]);
            }
        }
    }

    public function surat_transfusi_darah($visit, $vactination_id = null)
    {
        $title = "SURAT PERMINTAAN TRANSFUSI DARAH";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $bloodRequest = $this->lowerKey($db->query("
            SELECT br.*, but.usagetype AS usageType
            FROM BLOOD_REQUEST br
            LEFT JOIN BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
            WHERE br.visit_id = '" . $visit['visit_id'] . "'")->getResultArray());

            $request_date = $bloodRequest[0]['request_date'];
            $formatted_list = array_map(function ($item) {
                return $item['usagetype'] . ' (' . $item['blood_quantity'] . ')';
            }, $bloodRequest);

            $blood = [
                'tanggal' => $request_date,
                'usagetype' => implode(', ', $formatted_list)
            ];


            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/22-surat-transfusi-darah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization,
                    'blood_request' => $blood
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/22-surat-transfusi-darah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => [],
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function surat_pemasangan_infus($visit, $vactination_id = null)
    {
        $title = "SURAT PERSETUJUAN PEMASANGAN INFUS";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $bloodRequest = $this->lowerKey($db->query("
            SELECT br.*, but.usagetype AS usageType
            FROM BLOOD_REQUEST br
            LEFT JOIN BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
            WHERE br.visit_id = '" . $visit['visit_id'] . "'")->getResultArray());

            $request_date = $bloodRequest[0]['request_date'];
            $formatted_list = array_map(function ($item) {
                return $item['usagetype'] . ' (' . $item['blood_quantity'] . ')';
            }, $bloodRequest);

            $blood = [
                'tanggal' => $request_date,
                'usagetype' => implode(', ', $formatted_list)
            ];


            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/23-surat-pemasangan-infus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "organization" => $selectorganization,
                    'blood_request' => $blood
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/23-surat-pemasangan-infus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => [],
                    "organization" => $selectorganization
                ]);
            }
        }
    }

    public function kopprint()
    {
        $db = db_connect();
        $query = $db->query("select * from ORGANIZATIONUNIT");
        $orgUnits = $this->lowerKey($query->getResultArray());

        return $orgUnits;
    }

    public function medis_all_live($visit, $title = null)
    {
        if ($this->request->is('get')) {

            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();
            $specialist_type_id = $visit['specialist_type_id'];
            // $specialist_type_id = "1.12"; //KULIT & KELAMIN
            // $specialist_type_id = "1.16"; //Bedah saraf

            $session_id = $visit['session_id'];
            $visit_id = $visit['visit_id'];
            $clinic_id = $visit['clinic_id'];

            $clinic = $db->query("SELECT NAME_OF_CLINIC FROM CLINIC WHERE CLINIC_ID = ?", [$clinic_id])->getRowArray();

            if ($clinic) {
                $visit['nama_clinic'] = $clinic['NAME_OF_CLINIC'];
            }

            $title = isset($title) ? "Asesmen Medis Kulit Kelamin" : $title;

            $title .= $visit['isrj'] == 0 ? " Rawat Inap" : " Rawat Jalan";

            if ($specialist_type_id === "1.12") {
                $select = $this->lowerKey($db->query("SELECT 
                            pd.NO_REGISTRATION as no_RM,
                            p.NAME_OF_PASIEN as nama,
                            pd.PASIEN_DIAGNOSA_ID,
                            pd.BODY_ID,
                            CASE 
                                WHEN p.gender = '1' THEN 'Laki-laki'
                                ELSE 'Perempuan'
                            END as jeniskel,
                            p.CONTACT_ADDRESS as alamat,
                            pd.DOCTOR as dpjp,
                            c.name_of_clinic as departemen,
                            class.NAME_OF_CLASS as kelas,
                            cr.NAME_OF_CLASS as bangsal,
                            pd.BED_ID as bed,
                            pd.IN_DATE as tanggal_masuk,
                            CONVERT(varchar, P.DATE_OF_BIRTH, 105) as date_of_birth,
                            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
                            ed.WEIGHT as berat,
                            ed.HEIGHT as tinggi,
                            ed.TENSION_UPPER as tensi_atas,
                            ed.TENSION_BELOW as tensi_bawah,
                            ed.TEMPERATURE as suhu,
                            ed.RESPIRATION as nafas,
                            ed.SATURASI as SPO2,
                            ed.WEIGHT / (
                                (CAST(ed.HEIGHT AS DECIMAL(5, 2)) / CAST(100 AS DECIMAL(5, 2))) * 
                                (CAST(ed.HEIGHT AS DECIMAL(5, 2)) / CAST(100 AS DECIMAL(5, 2)))
                            ) AS IMT,
                            pd.DIAGNOSA_DESC as namadiagnosa,
                            pd.ANAMNASE as anamnesis,
                            pd.DESCRIPTION as riwayat_penyakit_sekarang,
                            ad.sd_ins_location,
                            ad.sd_ins_ukk,
                            ad.sd_ins_distribution,
                            ad.sd_ins_configuration,
                            ad.sd_palpation,
                            ad.sd_others,
                            ad.sv_inspection,
                            ad.sv_palpation,
                        
                            gcs.GCS_E,
                            gcs.GCS_m,
                            gcs.GCS_V, 
                            gcs.GCS_SCORE as gcs,
                            pd.HURT AS PENYEBAB_CIDERA,
                            pd.MEDICAL_PROBLEM AS MASALAH_MEDIS,
                            pd.DIAGNOSA_ID AS icd10,
                            pd.THERAPY_TARGET AS SASARAN,
                            pd.LAB_RESULT AS LABORATORIUM,
                            pd.RO_RESULT AS RADIOLOGI,  
                            pd.TERAPHY_DESC AS FARMAKOLOGIA,
                            pd.INSTRUCTION AS PROSEDUR,
                            pd.STANDING_ORDER AS STANDING_ORDER,
                            pd.rencanatl as rencana_tl,
                            -- Agregasi skala nyeri
                            STRING_AGG(CONCAT('Skor : ', apd.VALUE_SCORE, ' | ', apd.VALUE_DESC), '<br>') AS skala_nyeri
                        FROM 
                            pasien_diagnosa pd
                        LEFT JOIN 
                            clinic c ON pd.clinic_id = c.clinic_id
                        LEFT JOIN 
                            CLASS_ROOM cr ON cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
                        LEFT JOIN 
                            class ON class.CLASS_ID = cr.CLASS_ID
                        LEFT JOIN 
                            EXAMINATION_INFO ei ON ei.BODY_ID = pd.BODY_ID
                        LEFT JOIN 
                            EXAMINATION_DETAIL ed ON ed.BODY_ID = ei.BODY_ID
                        LEFT JOIN 
                            PASIEN p ON pd.NO_REGISTRATION = p.NO_REGISTRATION

                            ------------
                        LEFT JOIN 
                            ASSESSMENT_DERMATOVENEROLOGI ad ON ad.document_id = '$session_id' AND ad.VISIT_ID = pd.VISIT_ID 
                            AND ad.EXAMINATION_DATE = (
                                SELECT MAX(EXAMINATION_DATE) 
                                FROM ASSESSMENT_DERMATOVENEROLOGI 
                                WHERE DOCUMENT_ID = '$session_id' 
                                AND VISIT_ID = pd.VISIT_ID
                            )
                        LEFT JOIN 
                            ASSESSMENT_GCS gcs on gcs.DOCUMENT_ID = pd.BODY_ID AND gcs.EXAMINATION_DATE = (
                                SELECT MAX(EXAMINATION_DATE) 
                                FROM ASSESSMENT_GCS 
                                WHERE DOCUMENT_ID = pd.BODY_ID 
                            )
                        LEFT JOIN 
                            ASSESSMENT_PAIN_MONITORING apm ON apm.DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID
                        LEFT JOIN 
                            ASSESSMENT_PAIN_DETAIL apd ON apd.BODY_ID = apm.BODY_ID

                        WHERE 
                            -- pd.PASIEN_DIAGNOSA_ID = '$session_id'
                            -- AND 
                            pd.VISIT_ID = '$visit_id'
                        GROUP BY 
                            pd.PASIEN_DIAGNOSA_ID, 
                            pd.BODY_ID, 
                            pd.NO_REGISTRATION, 
                            p.NAME_OF_PASIEN, 
                            CASE WHEN p.gender = '1' THEN 'Laki-laki' ELSE 'Perempuan' END, 
                            p.CONTACT_ADDRESS, 
                            pd.DOCTOR, 
                            c.name_of_clinic, 
                            class.NAME_OF_CLASS,  
                            cr.NAME_OF_CLASS,  
                            pd.BED_ID,  
                            pd.IN_DATE, 
                            ed.WEIGHT, 
                            ed.HEIGHT, 
                            ed.TENSION_UPPER, 
                            ed.TENSION_BELOW, 
                            ed.RESPIRATION, 
                            ed.SATURASI, 
                            ed.TEMPERATURE, 
                            CONVERT(varchar, P.DATE_OF_BIRTH, 105), 
                            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR', 
                            pd.DIAGNOSA_DESC, 
                            pd.ANAMNASE, 
                            pd.DESCRIPTION,
                            ad.sd_ins_location,
                            ad.sd_ins_ukk,
                            ad.sd_ins_distribution,
                            ad.sd_ins_configuration,
                            ad.sd_palpation,
                            ad.sd_others,
                            ad.sv_inspection,
                            ad.sv_palpation,
                            gcs.GCS_E,
                            gcs.GCS_m,
                            gcs.GCS_V, 
                            gcs.GCS_SCORE, 
                            pd.HURT,
                            pd.MEDICAL_PROBLEM,
                            pd.DIAGNOSA_ID,
                            pd.THERAPY_TARGET,
                            pd.LAB_RESULT,
                            pd.RO_RESULT,
                            pd.TERAPHY_DESC,
                            pd.INSTRUCTION,
                            pd.STANDING_ORDER,
                            pd.rencanatl
                        ")->getResultArray());

                $select = !empty($select) ? $select[0] : [];
            } else if ($specialist_type_id === "1.16") {
                $select = $this->lowerKey($db->query("SELECT 
                                            pd.NO_REGISTRATION as no_RM,
                                            p.NAME_OF_PASIEN as nama,
                                            pd.PASIEN_DIAGNOSA_ID,
                                            pd.BODY_ID,
                                            CASE 
                                                WHEN p.gender = '1' THEN 'Laki-laki'
                                                ELSE 'Perempuan'
                                            END as jeniskel,
                                            p.CONTACT_ADDRESS as alamat,
                                            pd.DOCTOR as dpjp,
                                            c.name_of_clinic as departemen,
                                            class.NAME_OF_CLASS as kelas,
                                            cr.NAME_OF_CLASS as bangsal,
                                            pd.BED_ID as bed,
                                            pd.IN_DATE as tanggal_masuk,
                                            CONVERT(varchar, P.DATE_OF_BIRTH, 105) as date_of_birth,
                                            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
                                            ed.WEIGHT as berat,
                                            ed.HEIGHT as tinggi,
                                            ed.TENSION_UPPER as tensi_atas,
                                            ed.TENSION_BELOW as tensi_bawah,
                                            ed.TEMPERATURE as suhu,
                                            ed.RESPIRATION as nafas,
                                            ed.SATURASI as SPO2,
                                            ed.WEIGHT / (
                                                (CAST(ed.HEIGHT AS DECIMAL(5, 2)) / CAST(100 AS DECIMAL(5, 2))) * 
                                                (CAST(ed.HEIGHT AS DECIMAL(5, 2)) / CAST(100 AS DECIMAL(5, 2)))
                                            ) AS IMT,
                                            pd.DIAGNOSA_DESC as namadiagnosa,
                                            pd.ANAMNASE as anamnesis,
                                            pd.DESCRIPTION as riwayat_penyakit_sekarang,
                                            an.document_id,
                                            an.no_registration as no_reg_neuro,
                                            an.examination_date,
                                            an.vas_nrs,
                                            an.left_diameter,
                                            an.left_light_reflex,
                                            an.left_cornea,
                                            an.left_isokor_anisokor,
                                            an.right_diameter,
                                            an.right_light_reflex,
                                            an.right_cornea,
                                            an.right_isokor_anisokor,
                                            an.stiff_neck,
                                            an.meningeal_sign,
                                            an.brudzinki_i_iv,
                                            an.kernig_sign,
                                            an.dolls_eye_phenomenon,
                                            an.vertebra,
                                            an.extremity,
                                            an.motion_upper_left,
                                            an.motion_upper_right,
                                            an.motion_lower_left,
                                            an.motion_lower_right,
                                            an.strength_upper_left,
                                            an.strength_upper_right,
                                            an.strength_lower_left,
                                            an.strength_lower_right,
                                            an.physiological_reflex_upper_left,
                                            an.physiological_reflex_upper_right,
                                            an.physiological_reflex_lower_left,
                                            an.physiological_reflex_lower_right,
                                            an.pathologycal_reflex_upper_left,
                                            an.pathologycal_reflex_upper_right,
                                            an.pathologycal_reflex_lower_left,
                                            an.pathologycal_reflex_lower_right,
                                            an.clonus,
                                            an.sensibility,
                                            gcs.GCS_E,
                                            gcs.GCS_m,
                                            gcs.GCS_V, 
                                            gcs.GCS_SCORE as gcs,
                                            pd.HURT AS PENYEBAB_CIDERA,
                                            pd.MEDICAL_PROBLEM AS MASALAH_MEDIS,
                                            pd.DIAGNOSA_ID AS icd10,
                                            pd.THERAPY_TARGET AS SASARAN,
                                            pd.LAB_RESULT AS LABORATORIUM,
                                            pd.RO_RESULT AS RADIOLOGI,  
                                            pd.TERAPHY_DESC AS FARMAKOLOGIA,
                                            pd.INSTRUCTION AS PROSEDUR,
                                            pd.STANDING_ORDER AS STANDING_ORDER,
                                            pd.rencanatl as rencana_tl,
                                            -- Agregasi skala nyeri
                                            STRING_AGG(CONCAT('Skor : ', apd.VALUE_SCORE, ' | ', apd.VALUE_DESC), '<br>') AS skala_nyeri
                                        FROM 
                                            pasien_diagnosa pd
                                        LEFT JOIN 
                                            clinic c ON pd.clinic_id = c.clinic_id
                                        LEFT JOIN 
                                            CLASS_ROOM cr ON cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
                                        LEFT JOIN 
                                            class ON class.CLASS_ID = cr.CLASS_ID
                                        LEFT JOIN 
                                            EXAMINATION_INFO ei ON ei.BODY_ID = pd.BODY_ID
                                        LEFT JOIN 
                                            EXAMINATION_DETAIL ed ON ed.BODY_ID = ei.BODY_ID
                                        LEFT JOIN 
                                            PASIEN p ON pd.NO_REGISTRATION = p.NO_REGISTRATION
                                        LEFT JOIN 
                                            ASSESSMENT_NEUROLOGY an ON an.document_id = '$session_id' AND an.VISIT_ID = pd.VISIT_ID 
                                            AND an.EXAMINATION_DATE = (
                                                SELECT MAX(EXAMINATION_DATE) 
                                                FROM ASSESSMENT_NEUROLOGY 
                                                WHERE DOCUMENT_ID = '$session_id' 
                                                AND VISIT_ID = pd.VISIT_ID
                                            )
                                        LEFT JOIN 
                                            ASSESSMENT_GCS gcs on gcs.DOCUMENT_ID = pd.BODY_ID AND gcs.EXAMINATION_DATE = (
                                                SELECT MAX(EXAMINATION_DATE) 
                                                FROM ASSESSMENT_GCS 
                                                WHERE DOCUMENT_ID = pd.BODY_ID 
                                            )
                                        LEFT JOIN 
                                            ASSESSMENT_PAIN_MONITORING apm ON apm.DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID
                                        LEFT JOIN 
                                            ASSESSMENT_PAIN_DETAIL apd ON apd.BODY_ID = apm.BODY_ID
                                    
                                        WHERE 
                                            -- pd.PASIEN_DIAGNOSA_ID = '$session_id'
                                            -- AND 
                                            pd.VISIT_ID = '$visit_id'
                                        GROUP BY 
                                            pd.PASIEN_DIAGNOSA_ID, 
                                            pd.BODY_ID, 
                                            pd.NO_REGISTRATION, 
                                            p.NAME_OF_PASIEN, 
                                            CASE WHEN p.gender = '1' THEN 'Laki-laki' ELSE 'Perempuan' END, 
                                            p.CONTACT_ADDRESS, 
                                            pd.DOCTOR, 
                                            c.name_of_clinic, 
                                            class.NAME_OF_CLASS,  
                                            cr.NAME_OF_CLASS,  
                                            pd.BED_ID,  
                                            pd.IN_DATE, 
                                            ed.WEIGHT, 
                                            ed.HEIGHT, 
                                            ed.TENSION_UPPER, 
                                            ed.TENSION_BELOW, 
                                            ed.RESPIRATION, 
                                            ed.SATURASI, 
                                            ed.TEMPERATURE, 
                                            CONVERT(varchar, P.DATE_OF_BIRTH, 105), 
                                            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR', 
                                            pd.DIAGNOSA_DESC, 
                                            pd.ANAMNASE, 
                                            pd.DESCRIPTION,
                                            an.document_id,
                                            an.no_registration,
                                            an.examination_date,
                                            an.vas_nrs,
                                            an.left_diameter,
                                            an.left_light_reflex,
                                            an.left_cornea,
                                            an.left_isokor_anisokor,
                                            an.right_diameter,
                                            an.right_light_reflex,
                                            an.right_cornea,
                                            an.right_isokor_anisokor,
                                            an.stiff_neck,
                                            an.meningeal_sign,
                                            an.brudzinki_i_iv,
                                            an.kernig_sign,
                                            an.dolls_eye_phenomenon,
                                            an.vertebra,
                                            an.extremity,
                                            an.motion_upper_left,
                                            an.motion_upper_right,
                                            an.motion_lower_left,
                                            an.motion_lower_right,
                                            an.strength_upper_left,
                                            an.strength_upper_right,
                                            an.strength_lower_left,
                                            an.strength_lower_right,
                                            an.physiological_reflex_upper_left,
                                            an.physiological_reflex_upper_right,
                                            an.physiological_reflex_lower_left,
                                            an.physiological_reflex_lower_right,
                                            an.pathologycal_reflex_upper_left,
                                            an.pathologycal_reflex_upper_right,
                                            an.pathologycal_reflex_lower_left,
                                            an.pathologycal_reflex_lower_right,
                                            an.clonus,
                                            an.sensibility,
                                            gcs.GCS_E,
                                            gcs.GCS_m,
                                            gcs.GCS_V, 
                                            gcs.GCS_SCORE, 
                                            pd.HURT,
                                            pd.MEDICAL_PROBLEM,
                                            pd.DIAGNOSA_ID,
                                            pd.THERAPY_TARGET,
                                            pd.LAB_RESULT,
                                            pd.RO_RESULT,
                                            pd.TERAPHY_DESC,
                                            pd.INSTRUCTION,
                                            pd.STANDING_ORDER,
                                            pd.rencanatl
                            ")->getResultArray());

                $select = !empty($select) ? $select[0] : [];
            }

            $ass_fall = $db->query("SELECT 
                                    STRING_AGG(CONCAT('Skor : ', apd.VALUE_SCORE, ' | ', apd.VALUE_DESC), '<br>') AS fall_risk_detail
                                FROM pasien_diagnosa pd
                                LEFT JOIN ASSESSMENT_FALL_RISK_DETAIL apd 
                                    ON apd.BODY_ID = (
                                        SELECT TOP 1 BODY_ID 
                                        FROM ASSESSMENT_FALL_RISK 
                                        WHERE DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID 
                                        ORDER BY EXAMINATION_DATE DESC
                                    )
                                WHERE 
                                -- pd.PASIEN_DIAGNOSA_ID = ?
                                -- AND 
                                pd.VISIT_ID = ?
                                GROUP BY pd.PASIEN_DIAGNOSA_ID;
                            ", [$session_id, $visit_id])->getRowArray();

            if ($ass_fall) {
                $select['fall_risk_detail'] = $ass_fall['fall_risk_detail'];
            }

            if (isset($select)) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/medis-all-live", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    'kop' => $kopprintData[0],
                    'sepcialis' => $specialist_type_id
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/medis-all-live", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0],
                    'sepcialis' => $specialist_type_id
                ]);
            }
        }
    }
}
