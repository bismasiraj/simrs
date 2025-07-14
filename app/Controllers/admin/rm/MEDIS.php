<?php

namespace App\Controllers\Admin\rm;

use App\Models\OrganizationunitModel;
use App\Models\PasienVisitationModel;
use DateTime;


class medis extends \App\Controllers\BaseController
{
    public function getPvHeader($visit_id)
    {
        $model = new PasienVisitationModel();
        $pv = $model->where("visit_id", $visit_id)->first();
        $visit = $this->lowerKeyOne($pv);
        $db = db_connect();
        $classPlafond = $db->query("select name_of_class from class where class_id = '" . $visit['class_id_plafond'] . "'")->getFirstRow("array");
        $class = $db->query("select name_of_class from class where class_id = '" . $visit['class_id'] . "'")->getFirstRow("array");
        $gender = $this->getGender();
        $visit['gendername'] = '';
        foreach ($gender as $key => $value) {
            if ($gender[$key]['gender'] == $visit['gender']) {
                $visit['gendername'] = $gender[$key]['name_of_gender'];
            }
        }
        $visit['name_of_class_plafond'] = $classPlafond['name_of_class'];
        $visit['name_of_class'] = $class['name_of_class'];
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['age'] = $visit['ageyear'] . "th " . $visit['agemonth'] . "bl " . $visit['ageday'] . "hr";

        return $visit;
    }
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
        if (true) {
            // $visit = base64_decode($visit);
            // $visit = json_decode($visit, true);

            // return json_encode($vactination_id);
            // return json_encode($visit);
            // $specialist_type_id = $visit['specialist_type_id'];

            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT 
            pd.NO_REGISTRATION as no_RM,
            pd.valid_user,
            pd.valid_pasien,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            pd.DIAG_CAT,
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
            max(case when apv.PARAMETER_ID = '03' and apv.VALUE_SCORE = GCS_M then apv.VALUE_DESC else '' end ) as GSC_M_DESC,
            max(case when apv.PARAMETER_ID = '02' and apv.VALUE_SCORE = GCS_V then apv.VALUE_DESC else '' end ) as GSC_V_DESC,
            pd.DIAGNOSA_ID as icd10,
            pd.DIAGNOSA_DESC as namadiagnosa,
            case when pd.ANAMNASE = '' or pd.ANAMNASE is null then pd.ALLOANAMNASE else pd.ANAMNASE end as anamnesis,
            case when pd.ANAMNASE = '' or pd.ANAMNASE is null then 0 else 1 end as isautoanamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090201'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090101'  then histories else '' end ) as riwayat_penyakit_keluarga,
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
            case when eid.height = 0 then 0 else
            EId.WEIGHT/ ( (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) end AS IMT,
            isnull((select top(1) case when P_TYPE = 'ASES019' then
                        case when TOTAL_SCORE >= 0 and TOTAL_SCORE <= 24 then 'Tidak Ada Resiko'
                        when TOTAL_SCORE >= 24 and TOTAL_SCORE <= 50 then 'Risiko Rendah' 
                        when TOTAL_SCORE > 50 then 'Risiko Tinggi'
                        else 'Tidak ada Risiko' end
                    else 
                    case
                        when TOTAL_SCORE >= 7 and TOTAL_SCORE <= 11 then 'Risiko Rendah' 
                        when TOTAL_SCORE > 11 then 'Risiko Tinggi'
                        else 'Tidak ada Risiko' end
                    end as fall_risk from ASSESSMENT_FALL_RISK
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'Tidak ada Risiko') as FALL_SCORE,
            isnull((select top(1) '['+ cast(av.value_score as varchar(500)) +'] ' + av.VALUE_DESC as total_score from ASSESSMENT_PAIN_MONITORING apm
                    inner join ASSESSMENT_PAIN_DETAIL apd on apm.BODY_ID = apd.BODY_ID
                    inner join ASSESSMENT_PARAMETER_VALUE  av on apd.VALUE_ID = av.VALUE_ID
                    where 
                    apd.PARAMETER_ID = '05' and
                    document_id = pd.pasien_diagnosa_id) ,'') as PAIN_SCORE,
            PD.DIAGNOSA_ID,
            PD.MEDICAL_PROBLEM AS MASALAH_MEDIS,
            'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
            PD.HURT AS PENYEBAB_CIDERA,
        
            pd.INSTRUCTION AS SASARAN,
            CASE 
                WHEN ei.pemeriksaan = '0' THEN 'Baik'
                WHEN ei.pemeriksaan = '1' THEN 'Sedang'
                WHEN ei.pemeriksaan = '2' THEN 'Buruk'
                ELSE 'Tidak Diketahui' 
            END AS keadaanumum,


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
			    max(arp.a) as hamil_a,
                st.specialist_type,
                pd.class_room_id,
                pd.isrj,
                pd.clinic_id,
                pd.visit_id,
                pd.specialist_type_id,
                pd.date_of_diagnosa

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
            left outer join specialist_type st on st.specialist_type_id = pd.specialist_type_id
           , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '$vactination_id'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.alloanamnase,
            pd.DIAG_CAT,
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
            EID.WEIGHT, 
            EID.HEIGHT,
            ei.INSTRUCTION,
             ei.pemeriksaan,
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR,
            pd.valid_user,
            pd.valid_pasien,
            st.specialist_type,
            pd.class_room_id,
            pd.isrj,
            pd.clinic_id,
            pd.visit_id,
            pd.specialist_type_id,
            pd.date_of_diagnosa ")->getRow(0, "array"));

            foreach ($select as $key => $value) {
                if ($value == '') {
                    $select[$key] = null;
                }
            }



            $visit = $this->getPvHeader($select['visit_id']);
            $specialist_type_id = $select['specialist_type_id'];
            $visit['specialist_type_id'] = $specialist_type_id;
            $query = "SELECT  STUFF(
             (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
			  treatment_obat.body_id  = '$vactination_id' 
			  and DESCRIPTION <> '%jasa%' 
                group by description ,isnull(description2,'')
              FOR XML PATH (''))
             ,1, 2, '') terapi
			 from ORGANIZATIONUNIT ;";
            $farmako = $this->lowerKeyOne($db->query($query)->getResultArray());
            // return json_encode($query);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $selectlokalis = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = ? and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = ? AND assessment_lokalis.VALUE_SCORE = 3
                order by mas.theorder",
                [$specialist_type_id, $vactination_id]
            )->getResultArray());

            $selectlokalis2 = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = ? and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = ? AND assessment_lokalis.VALUE_SCORE = 2
                order by mas.theorder",
                [$specialist_type_id, $vactination_id]
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
                            END AS tindak_lanjut,
                            examination_date
                        FROM PASIEN_TRANSFER
                        WHERE visit_id = ?
                        AND ISINTERNAL <> 11;", [$visit['visit_id']])->getRowArray());
            if ($visit['class_room_id'] == '' || is_null($visit['class_room_id']))
                if (count($tindakLanjut) == 0) {
                    $waktuakhir = $this->lowerKey($db->query("select dateadd(hour,7,waktu) as waktu from batching_bridging where trans_id = ? and tipe = '25' ", [$visit['trans_id']])->getRowArray());
                    if (count($waktuakhir) > 0)
                        $visit['exit_date'] = $waktuakhir['waktu'];
                } else {
                    $visit['exit_date'] = $tindakLanjut['examination_date'];
                }
            // dd($waktuakhir);

            $farma = $db->query("SELECT  STUFF(
                        (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
                        treatment_obat.visit_id  = ?
                        and DESCRIPTION <> '%jasa%' 
                        and sold_status in ('1','5','7')
                        AND quantity > 0
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
                    [$select['pasien_diagnosa_id'], $visit['visit_id']]
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
                    [$select['pasien_diagnosa_id'], $visit['visit_id']]
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



            $sign = $this->checkSignDocs($vactination_id, 2);
            switch (@$select['specialist_type']) {
                case 'SARAF':
                    $specialistType = 'NEUROLOGI';
                    break;
                // case 'PENYAKIT DALAM':
                //     $specialistType = 'REHABILITASI MEDIS';
                //     break;
                default:
                    $specialistType = @$select['specialist_type'];
                    break;
            }
            // @$select['specialist_type']
            // $specialistType = match (@$select['specialist_type']) {
            //     'SARAF' => 'NEUROLOGI',
            //     'PENYAKIT DALAM' => 'REHABILITASI MEDIS',
            //     default => @$select['specialist_type']
            // };


            // $visit['name_of_class'] = $classPlafond['name_of_class'];


            $visit["fullname"] = $select['dpjp'];
            $visit['class_room_id'] = $select['class_room_id'];
            $visit['isrj'] = $select['isrj'];
            $visit['clinic_id'] = $select['clinic_id'];
            $visit['name_of_clinic'] = $select['departmen'] . " (" . $specialistType . ")";
            if (@$select['diag_cat'] != '1')
                if ($visit['isrj'] == '0') {
                    $title = 'ASESMEN MEDIS ' . $specialistType . ' RAWAT INAP';
                } else {
                    $title = 'ASESMEN MEDIS ' . $specialistType . ' RAWAT JALAN';
                }

            // dd($select);
            if ($visit['clinic_id'] == 'P012') {
                $title = 'ASESMEN MEDIS IGD';
            }

            $selectinfo = $visit;


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
                    pv.trans_id,pasien_diagnosa_id,EXAMINATION_DATE as tgl_kunjungan,
                    DOCTOR as DPJP,
                    Diagnosis = 
                            cast(STUFF(
                            (SELECT ',' + pp.diagnosa_id + '( ' + pp.diagnosa_desc + ' ) '
                            FROM PASIEN_DIAGNOSAs pp
                            WHERE pp.PASIEN_DIAGNOSA_ID =(pd.BODY_ID)
                            
                            FOR XML PATH (''))
                            , 1, 1, '') as varchar(4000) ),
                    prosedur_lab = 
					cast(STUFF(
                            (SELECT
                            ';' + hl.PARAMETER_NAME+': '+hl.HASIL+' '+ hl.SATUAN
                        FROM
                            treatment_bill tb

                        LEFT JOIN
                            sharelis.dbo.kirimlis kl 
                            ON tb.bill_id = kl.kode COLLATE SQL_Latin1_General_CP1_CI_AS
                        LEFT JOIN
                            sharelis.dbo.hasilLIS hl 
                            ON kl.kode_kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS + kl.kode_tarif COLLATE SQL_Latin1_General_CP1_CI_AS = 
                            hl.Kode_Kunjungan COLLATE SQL_Latin1_General_CP1_CI_AS + hl.kode_tarif COLLATE SQL_Latin1_General_CP1_CI_AS
                        WHERE
                            tb.no_registration LIKE pv.no_registration
                            AND tb.trans_id = pv.trans_id
                             and tb.bill_id IN (SELECT kode FROM sharelis.dbo.kirimlis)
                            AND tb.clinic_id = 'P013'
							and PARAMETER_NAME is not null
                        ORDER BY
                            tb.treat_date
                            
                            FOR XML PATH (''))
                            , 1, 1, '') as varchar(4000)),
				radiologi = cast(STUFF(
                            (select ';' + ts.TARIF_NAME + ': ' + cast(ts.RESULT_VALUE as varchar(4000))  from TREAT_RESULTS ts
							where visit_id = pv.VISIT_ID
                            
                            FOR XML PATH (''))
                            , 1, 1, '') as varchar(4000) ),
				farmasi = 
                            cast(STUFF(
                            (SELECT ',' + tob.description
                            FROM treatment_obat tob
                            WHERE tob.trans_id =(pv.trans_id)
                            
                            FOR XML PATH (''))
                            , 1, 1, '') as varchar(4000) )

                from EXAMINATION_INFO pd inner join PASIEN_VISITATION pv
				on pv.visit_id = pd.VISIT_ID
                where pv.NO_REGISTRATION = '{$visit['no_registration']}'
                AND DOCTOR is Not NULL  
                and (pv.CLASS_ROOM_ID is null 
                or pv.CLASS_ROOM_ID = '')
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
        // dd($vactination_id);
        $title = "Resume Medis";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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
            pd.DIAGNOSA_DESC_DISCHARGE as namadiagnosapulang,
            pd.ANAMNASE as anamnesis,
            pd.ALLOANAMNASE as alloanamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090201'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090101'  then histories else '' end ) as riwayat_penyakit_keluarga,
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
            case when ei.HEIGHT <> 0 and ei.HEIGHT is not null then EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) else 0 end AS IMT,
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
            PD.PROCEDURE_DESC,
            PD.PROCEDURE_DESC_DISCHARGE,
            PD.DISCHARGE_WAY,
            PD.DISCHARGE_CONDITION,
            pd.visit_id,
            pd.specialist_type_id,
            pd.class_room_id,
            pd.isrj,
            pd.clinic_id,
            c.name_of_clinic as departmen,
            specialist_type.specialist_type
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_DETAIL ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join specialist_type on specialist_type.specialist_type_id = '" . $visit['specialist_type_id'] . "'
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
            pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '$vactination_id'
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
            pd.ALLOANAMNASE,
            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            pd.DIAGNOSA_DESC_DISCHARGE,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            THERAPY_TARGET,
            PD.LAB_RESULT, 
            PD.RO_RESULT,
            PD.TERAPHY_DESC, 
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR,
            PD.PROCEDURE_DESC,
            PD.PROCEDURE_DESC_DISCHARGE,
            PD.DISCHARGE_WAY,
            PD.DISCHARGE_CONDITION,
            pd.visit_id,
            pd.specialist_type_id,
            pd.class_room_id,
            pd.isrj,
            pd.clinic_id,
            c.name_of_clinic ,
            specialist_type.specialist_type")->getRow(0, "array"));

            $select['gcs_display'] = $this->getGCSDisplay($select['gcs']);
            // dd($select['gcs_display']);

            $visit = $this->getPvHeader($select['visit_id']);
            $specialist_type_id = $select['specialist_type_id'];
            $visit['specialist_type_id'] = $specialist_type_id;

            $selectlokalis2 = $this->lowerKey($db->query(
                "
                select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = '1.00' and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = '$vactination_id' AND assessment_lokalis.VALUE_SCORE = 2
                order by mas.theorder"
            )->getResultArray());
            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '7'
                GROUP BY DESCRIPTION, DESCRIPTION2
                "
            )->getResultArray());
            $selectrecipedischarge = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '5'
                GROUP BY DESCRIPTION, DESCRIPTION2
                "
            )->getResultArray());
            $hasilResultRad = $this->getHasilResultRadE($db, $visit['visit_id']);
            $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
            $queryTreatmenBill = $this->getTreatmentBillE($db, $visit['visit_id']);
            $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
            $laboratorium = $this->getLaboratoriumDataE($db, $kirimlisData, $visit); // New function

            if ($specialist_type_id === "1.12") {
                $kulit = $db->query(
                    "SELECT top (1)  sd_ins_location,sd_ins_ukk,sd_ins_distribution,sd_ins_configuration,
                                sd_palpation,sd_others,sv_inspection,sv_palpation from ASSESSMENT_DERMATOVENEROLOGI where 
                                DOCUMENT_ID = ? 
                                and VISIT_ID =? order by EXAMINATION_DATE desc",
                    [$select['pasien_diagnosa_id'], $visit['visit_id']]
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
                    [$select['pasien_diagnosa_id'], $visit['visit_id']]
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
            if (@$kulit) {
                $select['kulit'] = $kulit;
            }
            if (@$saraf) {
                $select['saraf'] = $saraf;
            }

            if (@$mata) {
                $select['mata'] = $mata;
            }
            $visit_id = $visit['visit_id'];
            $trans_id = $visit['trans_id'];


            $db = db_connect();
            $procbedah = $db->query("select TARIF_ID as treatment From PASIEN_OPERASI where trans_id = '$trans_id' and terlayani <> '4' ")->getResultArray();
            // $procbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 2")->getResultArray();
            $procnonbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 1")->getResultArray();


            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $selectinfo = $visit;

            $sign = $this->checkSignDocs($vactination_id, 2);
            $visit["fullname"] = $select['dpjp'];
            $visit['class_room_id'] = $select['class_room_id'];
            $visit['isrj'] = $select['isrj'];
            $visit['clinic_id'] = $select['clinic_id'];
            $visit['name_of_clinic'] = $select['departmen'] . " (" . $select['specialist_type'] . ")";


            return view("admin/patient/profilemodul/formrm/rm/MEDIS/16-resume-medis.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe,
                "recipeDischarge" => $selectrecipedischarge,
                "procbedah" => $procbedah,
                "procnonbedah" => $procnonbedah,
                'radiologi_cetak' => $radiologi,
                'get_treat' => [],
                'lab' => $laboratorium,
                "sign" => $sign
            ]);
        }
    }
    public function resume_medis_post($visit, $vactination_id = null)
    {
        $visit = $this->request->getPost();
        // dd($visit);
        $title = "Resume Medis";
        if ($this->request->is('post')) {
            // $visit = base64_decode($visit);
            // $visit = json_decode($visit, true);
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
            pd.DIAGNOSA_DESC_DISCHARGE as namadiagnosapulang,
            pd.ANAMNASE as anamnesis,
            pd.ALLOANAMNASE as alloanamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090201'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090101'  then histories else '' end ) as riwayat_penyakit_keluarga,
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
            case when ei.HEIGHT <> 0 and ei.HEIGHT is not null then EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) else 0 end AS IMT,
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
            PD.PROCEDURE_DESC,
            PD.PROCEDURE_DESC_DISCHARGE,
            PD.DISCHARGE_WAY,
            PD.DISCHARGE_CONDITION,
            pd.visit_id,
            pd.specialist_type_id,
            pd.class_room_id,
            pd.isrj,
            pd.clinic_id,
            c.name_of_clinic as departmen,
            specialist_type.specialist_type
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_DETAIL ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join specialist_type on specialist_type.specialist_type_id = '" . $visit['specialist_type_id'] . "'
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
            pd.ALLOANAMNASE,
            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            pd.DIAGNOSA_DESC_DISCHARGE,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            THERAPY_TARGET,
            PD.LAB_RESULT, 
            PD.RO_RESULT,
            PD.TERAPHY_DESC, 
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR,
            PD.PROCEDURE_DESC,
            PD.PROCEDURE_DESC_DISCHARGE,
            PD.DISCHARGE_WAY,
            PD.DISCHARGE_CONDITION,
            pd.visit_id,
            pd.specialist_type_id,
            pd.class_room_id,
            pd.isrj,
            pd.clinic_id,
            c.name_of_clinic ,
            specialist_type.specialist_type")->getRow(0, "array"));
            $select['gcs_display'] = $this->getGCSDisplay($select['gcs']);
            // dd($select['gcs_display']);
            $visit = $this->getPvHeader($select['visit_id']);
            // dd($visit);
            $specialist_type_id = $select['specialist_type_id'];
            $visit['specialist_type_id'] = $specialist_type_id;

            $selectlokalis2 = $this->lowerKey($db->query(
                "
                select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = '1.00' and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = '$vactination_id' AND assessment_lokalis.VALUE_SCORE = 2
                order by mas.theorder"
            )->getResultArray());
            // dd($selectlokalis2);
            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '7'
                GROUP BY DESCRIPTION, DESCRIPTION2
                "
            )->getResultArray());
            $selectrecipedischarge = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '5'
                GROUP BY DESCRIPTION, DESCRIPTION2
                "
            )->getResultArray());
            $hasilResultRad = $this->getHasilResultRadE($db, $visit['visit_id']);
            $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
            $queryTreatmenBill = $this->getTreatmentBillE($db, $visit['visit_id']);
            $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
            $laboratorium = $this->getLaboratoriumDataE($db, $kirimlisData, $visit); // New function

            $specialist_type_id = $visit['specialist_type_id'];
            if ($specialist_type_id === "1.12") {
                $kulit = $db->query(
                    "SELECT top (1)  sd_ins_location,sd_ins_ukk,sd_ins_distribution,sd_ins_configuration,
                                sd_palpation,sd_others,sv_inspection,sv_palpation from ASSESSMENT_DERMATOVENEROLOGI where 
                                DOCUMENT_ID = ? 
                                and VISIT_ID =? order by EXAMINATION_DATE desc",
                    [$select['pasien_diagnosa_id'], $visit['visit_id']]
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
                    [$select['pasien_diagnosa_id'], $visit['visit_id']]
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
            if (@$kulit) {
                $select['kulit'] = $kulit;
            }
            if (@$saraf) {
                $select['saraf'] = $saraf;
            }

            if (@$mata) {
                $select['mata'] = $mata;
            }
            $visit_id = $visit['visit_id'];
            $trans_id = $visit['trans_id'];


            $db = db_connect();
            $procbedah = $db->query("select TARIF_ID as treatment From PASIEN_OPERASI where trans_id = '$trans_id' and terlayani <> '4' ")->getResultArray();
            // $procbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 2")->getResultArray();
            $procnonbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 1")->getResultArray();


            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $selectinfo = $visit;

            $sign = $this->checkSignDocs($vactination_id, 2);
            $visit["fullname"] = $select['dpjp'];
            $visit['class_room_id'] = $select['class_room_id'];
            $visit['isrj'] = $select['isrj'];
            $visit['clinic_id'] = $select['clinic_id'];
            $visit['name_of_clinic'] = $select['departmen'] . " (" . $select['specialist_type'] . ")";

            return view("admin/patient/profilemodul/formrm/rm/MEDIS/16-resume-medis.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe,
                "recipeDischarge" => $selectrecipedischarge,
                "procbedah" => $procbedah,
                "procnonbedah" => $procnonbedah,
                'radiologi_cetak' => $radiologi,
                'get_treat' => [],
                'lab' => $laboratorium,
                "sign" => $sign
            ]);
        } else {
            echo "Silahkan ulang klik cetak";
        }
    }
    private function getGCSDisplay($totalScore)
    {
        $gcsArray = ['-', 'Composmentis', 'Apatis', 'Delirium', 'Samnolen', 'Sopor', 'Coma'];
        $conclutionScore = 0;
        if ($totalScore >= 3 && $totalScore <= 8)
            $conclutionScore = 6;
        else if ($totalScore > 8 && $totalScore <= 12)
            $conclutionScore = 5;
        else if ($totalScore > 12 && $totalScore <= 14)
            $conclutionScore = 4;
        else if ($totalScore > 14 && $totalScore <= 15)
            $conclutionScore = 1;

        return $gcsArray[$conclutionScore];
        // else if (totalScore > 16 && totalScore <= 18)
        //     conclutionScore = 2
        // else if (totalScore > 18 && totalScore <= 20)
        //     conclutionScore = 1

        // var e = ($("#GEN001101" + bodyId).val() === null) ? 0 : $("#GEN001101" + bodyId).val();
        // var v = ($("#GEN001102" + bodyId).val() === null) ? 0 : $("#GEN001102" + bodyId).val();
        // var m = ($("#GEN001103" + bodyId).val() === null) ? 0 : $("#GEN001103" + bodyId).val();

        // if (parseInt(v) == 0) {

        //     $('#GCS_SCORE' + bodyId).val(0)
        //     $('#GCS_DESC' + bodyId).val(0)
        // } else {
        //     var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
        //     var conclutionScore = 0
        //     if (totalScore >= 3 && totalScore <= 8)
        //         conclutionScore = 6
        //     else if (totalScore > 8 && totalScore <= 12)
        //         conclutionScore = 5
        //     else if (totalScore > 12 && totalScore <= 14)
        //         conclutionScore = 4
        //     else if (totalScore > 14 && totalScore <= 15)
        //         conclutionScore = 1
        //     // else if (totalScore > 16 && totalScore <= 18)
        //     //     conclutionScore = 2
        //     // else if (totalScore > 18 && totalScore <= 20)
        //     //     conclutionScore = 1

        //     $('#GCS_SCORE' + bodyId).val(totalScore)
        //     $('#GCS_DESC' + bodyId).val(conclutionScore)
        // }
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
                        TREAT_RESULTS.NOSEP, TREAT_RESULTS.isvalid, TREAT_RESULTS.valid_date, TREAT_RESULTS.iskritis,
                        TB.DIAGNOSA_DESC, TB.INDICATION_DESC
                 FROM TREAT_RESULTS inner join TREATMENT_BILL TB ON TREAT_RESULTS.BILL_ID = TB.BILL_ID
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
                    cm.CASEMIX, 
                    tb.brand_id,
                    tb.description
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
                    cm.CASEMIX,
                    tb.brand_id,
                    tb.description",

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
    public function getLaboratoriumDataE($db, $kirimlisData, $visit, $data = null)
    {
        $title = "HASIL PEMERIKSAAN LABORATORIUM";
        $data = base64_decode($data);
        $data = json_decode($data, true);

        $db = db_connect();
        $getDataHasilLis = $kirimlisData;
        // $getDataHasilLis = $this->lowerKey($db->query("
        //     SELECT 
        //         h.kode_kunjungan
        //     FROM 
        //         sharelis.dbo.kirimlis k
        //     JOIN 
        //         sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
        //     WHERE 
        //         k.No_Pasien = ?
        //     GROUP BY 
        //         h.kode_kunjungan;
        // ", [$visit['no_registration']])->getResultArray());

        if (empty($data)) {
            $data = array_column($getDataHasilLis, 'kode_kunjungan');
        }

        if (!empty($data)) {
            $placeholders = implode(',', array_fill(0, count($data), '?'));
        } else {
            return [
                "visit" => $visit,
                'title' => $title,
                'data' => []
            ];
        }

        $dataTables = $this->lowerKey($db->query("
            SELECT H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, kel_pemeriksaan, urut_bound, h.TGL_HASIL_SELESAI, h.Catatan, h.Rekomendasi,
                PARAMETER_NAME, hasil, satuan, NILAI_RUJUKAN, METODE_PERIKSA, null as kode,
                reg_date AS tgl_hasil, norm, k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, 
                k.pengirim_name, k.ruang_name, k.kelas_name, k.Tgl_Periksa, h.flag_hl, k.diagnosa_desc, h.valid_user, h.valid_date, k.indication_desc
            FROM sharelis.dbo.hasillis h
            LEFT JOIN sharelis.dbo.kirimlis k ON h.norm COLLATE database_default = k.no_pasien COLLATE database_default 
                AND H.kode_kunjungan = K.Kode_Kunjungan
            WHERE H.kode_kunjungan IN ($placeholders)
            ORDER BY urut_bound, kode_kunjungan, tarif_id
        ", $data)->getResultArray());

        return [
            "visit" => $visit,
            'title' => $title,
            'data' => $dataTables
        ];
        // if ($this->request->is('get')) {
        // }
    }
    private function getLaboratoriumDataEs($db, $kirimlisData, $decoded_visit)
    {
        $kode_kunjungan = array_column($kirimlisData, 'kode_kunjungan');
        $visit_date = $decoded_visit['visit_date'];


        $start_date = $visit_date . " 00:00:00";


        $end_date = date('Y-m-d H:i:s');

        if (empty($kode_kunjungan)) {
            return [];
        }


        // var_dump($kode_kunjungan);
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
                        H.flag_hl,
                        K.diagnosa_desc,
                        k.indication_desc
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
                        H.flag_hl,
                        K.diagnosa_desc,
                        k.indication_desc
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
    public function surat_diagnosis($visit, $vactination_id = null)
    {
        $title = "Surat Keterangan Diagnosis";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT
                        pv.DIANTAR_OLEH,
                        cast(pv.AGEYEAR as varchar(3)) + 'th '+ cast(pv.AGEMONTH as varchar(3)) + 'bl ' + cast(pv.AGEDAY as varchar(3)) + 'hr' usia,
                        pv.GENDER,
                        pv.VISITOR_ADDRESS,
                        pv.VISIT_date,
                        pd.TERAPHY_DESC,
                        '' keterangan, 
                        '' tindakan,
                        farmakoterapi = replace (replace( STUFF( (SELECT '-' + DESCRIPTION  + char(13)+char(10)
                        FROM treatment_OBAT tb2
                        WHERE tb2.visit_id = pv.visit_id
                        and SOLD_STATUS in (1,5,6,7)  and tb2.BRAND_ID is not null
                        group by description
                        FOR XML PATH (''))
                        , 1, 1, '')  ,'&#x0D','') ,'-',''),
                        getdate() as valid_user
       
                FROM pasien_visitation pv 
                left outer join EXAMINATION_INFO pD on pv.VISIT_ID = pD.VISIT_ID
                where  pv.visit_id = '" . $visit['visit_id'] . "' 
				and pd.petugas_type = '11';")->getResultArray());
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

            // if (!is_null($visit['class_room_id']) && $visit['class_room_id'] != '')
            $db = db_connect();

            $select = $this->lowerKey($db->query("SELECT
            INASIS_KONTROL.NOSEP,  
            convert(varchar, INASIS_KONTROL.TGLRENCKONTROL, 103) AS TGL_KONTROL_SELANJUTNYA,  
            INASIS_KONTROL.POLIKONTROL_KDPOLI,   
            INASIS_KONTROL.POLIKONTROL_NMPOLI,  
            INASIS_KONTROL.KODEDOKTER,
            INASIS_KONTROL.MODIFIED_BY,   
            INASIS_KONTROL.MODIFIED_DATE,   
            INASIS_KONTROL.NOSURATKONTROL,
            INASIS_KONTROL.SURATTYPE,
            p.KK_NO AS NO_bpjS,
            p.NAME_OF_PASIEN AS NAMA,
            p.CONTACT_ADDRESS as alamat,
            CASE WHEN pd.GENDER = '1' THEN 'Laki-Laki'
            else 'Perempuan' end as jeniskel,
            PD.NO_REGISTRATION AS NO_RM, 
            ei.teraphy_desc diagnosa_desc,
            convert(varchar,PV.tgl_lahir,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
            pds.DIAGNOSA_DESC as diagnosis,
            pds.DIAGNOSA_ID as kode_diagnosa,
            farmakologi = 
                            cast(STUFF(
                            (SELECT ',
                            ' + tob.description
                            FROM treatment_obat tob
                            WHERE tob.trans_id =(pv.trans_id)
                            and sold_status in (1,5,7)
                            
                            FOR XML PATH (''))
                            , 1, 1, '') as varchar(4000) ),
            notes as alasan_kontrol,
            pd.DOCTOR as dpjp,
            pv.IN_DATE as tgl_masuk,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID no_tt,
            c.NAME_OF_CLASS as kelas,
            st.SPECIALIST_TYPE as department,
            INASIS_KONTROL.valid_user,
            INASIS_KONTROL.valid_pasien,
            INASIS_KONTROL.valid_date,
            ea.fullname,
            clinic.name_of_clinic
			from PASIEN_TRANSFER pt inner join
            INASIS_KONTROL on pt.DOCUMENT_ID = INASIS_KONTROL.NOSKDP_RS 
			inner join pasien p on pt.NO_REGISTRATION = p.NO_REGISTRATION
            left outer join  pasien_visitation pv on inasis_kontrol.VISIT_ID = pv.VISIT_ID 
            left outer join pasien_DIAGNOSA pD on inasis_kontrol.VISIT_ID = pD.VISIT_ID
            left outer join examination_info ei on ei.visit_id = pt.visit_id and ei.petugas_type = 11
            left outer join pasien_diagnosas pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            left outer join employee_all ea on ea.employee_id = '{$visit['employee_id']}'
            left outer join clinic on clinic.clinic_id = '{$visit['clinic_id']}'
            where  pt.body_id = '" . $vactination_id . "' 
            and surattype = '1'")->getResultArray());

            $sign = $this->checkSignDocs($vactination_id, 11);
            // dd($sign);

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/18-surat-bpjs.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'sign' => $sign,
                    "val" => $select[0]
                ]);
            } else {
                return json_encode("Tidak ada data");
            }
        }
    }
    public function surat_pengantar_cetak($visit, $vactination_id = null, $clinic_id = 'P013')
    {
        $title = "HASIL PEMERIKSAAN RADIOLOGI";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $query = "SELECT pp.*, c.name_of_clinic, ea.fullname
                    FROM pasien_penunjang pp left outer join clinic c on c.clinic_id = pp.clinic_id_from
                    left outer join employee_all ea on ea.employee_id = pp.employee_id_from
                    WHERE VISIT_ID = ? and NOTA_NO = ?
                    AND pp.CLINIC_ID = ? 
                    AND DIAGNOSA_DESC IS NOT NULL 
                    AND DESCRIPTIONS IS NOT NULL;";
            $db = db_connect();

            $birthDate = $visit['tgl_lahir']; // Example birthdate

            // Convert birthdate string to DateTime object
            $birthDate = new DateTime($birthDate);

            // Get current date
            $currentDate = new DateTime();

            // Calculate the difference between the current date and birthdate
            $age = $birthDate->diff($currentDate);

            // Get the age in years, months, and days
            $ageYears = $age->y;
            $ageMonths = $age->m;
            $ageDays = $age->d;



            $dataTables = $this->lowerKey($db->query($query, [
                $visit['visit_id'],
                $vactination_id,
                $clinic_id
            ])->getResultArray());
            $dataTables['umur'] = $ageYears . 'th ' . $ageMonths . 'bl ' . $ageDays . 'hr';
            // return json_encode($dataTables);
            $sign = $this->checkSignDocs($vactination_id, 14);

            if (isset($visit)) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/24-surat-pengantar.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "sign" => $sign,
                    // 'kop' => $kopprintData[0],
                    'val' => $dataTables[0]
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
            $select = $this->lowerKey($db->query("select top(1)
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
            ei.THENAME as nama,
            ei.THEADDRESS as alamat,
            CASE WHEN pd.GENDER = '1' THEN 'Laki-Laki'
            else 'Perempuan' end as jeniskel,
            PD.NO_REGISTRATION AS NO_RM, 
            convert(varchar,PV.tgl_lahir,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' as UMUR,
            ei.teraphy_desc as diagnosis,
            PD.DIAGNOSA_ID as kode_diagnosa,
            pd.TERAPHY_DESC as farmakologi,
            igt.nama as alasan_kontrol,
            pd.DOCTOR as dpjp,
            pd.IN_DATE as tgl_masuk,
            cr.NAME_OF_CLASS,
            pd.BED_ID no_tt,
            c.NAME_OF_CLASS as kelas,
            st.SPECIALIST_TYPE as department,
            PD.INSTRUCTION as INTRUKSI,
            INASIS_KONTROL.valid_user,
            INASIS_KONTROL.valid_pasien,
            INASIS_KONTROL.valid_date,
            pt.notes,
            ea.fullname,
            clinic.name_of_clinic,
            pt.other_notes
            
            from PASIEN_TRANSFER pt inner join
            INASIS_KONTROL on pt.DOCUMENT_ID = INASIS_KONTROL.NOSKDP_RS 
            inner join  pasien_visitation pv on inasis_kontrol.visit_id = pv.visit_id 
            left outer join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join examination_info ei on INASIS_KONTROL.VISIT_ID = ei.VISIT_ID and ei.petugas_type = 11
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pv.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            left outer join employee_all ea on ea.employee_id = '{$visit['employee_id']}'
            left outer join clinic on clinic.clinic_id = '{$visit['clinic_id']}'
            where  pt.body_id = '" . $vactination_id . "' 
            and surattype = '2' order by ei.examination_date asc")->getResultArray());

            $sign = $this->checkSignDocs($vactination_id, 11);


            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/MEDIS/19-surat-perintah.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    'sign' => $sign
                ]);
            } else {
                return json_encode("Tidak ada data");
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
            PD.INSTRUCTION as INTRUKSI,
            INASIS_KONTROL.valid_user,
            INASIS_KONTROL.valid_pasien,
            INASIS_KONTROL.valid_date
            --PD.STANDING_ORDER as INTRUKSITAMBAHAN
            FROM INASIS_KONTROL 
            left outer join  pasien_visitation pv on inasis_kontrol.visit_id = pv.visit_id
            inner join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            where  INASIS_KONTROL.NOSEP = '" . $visit['no_skp'] . "' 
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
