<?php

namespace App\Controllers\Admin\rm;

use Dompdf\Dompdf;

class keperawatan extends \App\Controllers\BaseController
{
    public function ralan_anak($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan Rawat Jalan Pasien Anak"; //hosnic_emr_rj_bedah
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select
            tension_upper, tension_below, temperature, NADI, NAFAS, WEIGHT, HEIGHT, format(round(WEIGHT*10000/height/height,2), '0.##') as bmi, saturasi as respiration,
            alkohol, merokok, riwayat_dahulu, riwayat_drug, riwayat_nondrug, riwayat_keluarga, riwayat_diet, riwayat_obat_konsumsi, riwayat_hamil, riwayat_imunisasi,
            
            ARM_DIAMETER as lingkar_lengan, 'kondisi_pasien' as kondisi_pasien,
            'hubungan_keluarga' as hubungan_keluarga, 'permintaan_khusus' as permintaan_khusus, 'agama' as agama,
            'hambatan_sosial' as hambatan_sosial, 'larangan_keyakinan' as larangan_keyakinan, 'mitos_budaya' as mitos_budaya,
            'status_perkawinan' as status_perkawinan, 'punya_anak' as punya_anak, 'jumlah_anak' as jumlah_anak,
            'pendidikan' as pendidikan, 'kewarganegaraan' as kewarganegaraan, 'pekerjaan' as pekerjaan, 'aktivitas' as aktivitas,
            'penganiayaan' as penganiayaan, 'tinggal_bersama' as tinggal_bersama, 'pasien_operasi' as pasien_operasi,
            'gangguan_makan' as gangguan_makan, 'masalah_nutrisi' as masalah_nutrisi, 'masalah_makan' as masalah_makan,
            'nutrisi_ngt' as nutrisi_ngt, 'mukosa_mulut' as mukosa_mulut, 'fluid_intake' as fluid_intake, 'penyakit' as penyakit, 
            'gangguan_metabolik' as gangguan_metabolik, 'status_gangguan' as status_gangguan, 'kategori_usia' as kategori_usia, 
            'resiko_malnutrisi' as resiko_malnutrisi, 'perlu_konsultasi' as perlu_konsultasi, 'lama_kehamilan' as lama_kehamilan, 
            'komplikasi' as komplikasi, 'masalah_neonatus' as masalah_neonatus, 'masalah_maternal' as masalah_maternal, 
            'riwayat_imunisasi' as riwayat_imunisasi, 'umur_tengkurap' as umur_tengkurap, 'umur_duduk' as umur_duduk, 
            'umur_mengoceh' as umur_mengoceh, 'umur_berdiri' as umur_berdiri, 'umur_bicara' as umur_bicara, 'umur_berjalan' as umur_berjalan, 
            'asi' as asi, 'makanan_tambahan' as makanan_tambahan, 'pengasuh' as pengasuh, 'pembawaan_umum' as pembawaan_umum, 
            'tempramen' as tempramen, 'kebiasaan_perilaku' as kebiasaan_perilaku, 'pd3i' as pd3i, 'gangguan_tumbuh' as gangguan_tumbuh, 
            'skala_nyeri' as skala_nyeri, 'resiko_jatuh' as resiko_jatuh, 'luka_operasi' as luka_operasi, 'deskripsi_nyeri' as deskripsi_nyeri, 
            'hipertermi' as hipertermi, 'nama_diagnosis' as nama_diagnosis
            from examination_info ea left outer join (select no_registration, max(case when VALUE_ID = 'G0090301' then HISTORIES else '' end) as alkohol,
            max(case when VALUE_ID = 'G0090302' then HISTORIES else '' end) as merokok,
            max(case when VALUE_ID = 'G0090202' then HISTORIES else '' end) as riwayat_dahulu,
            max(case when VALUE_ID = 'G0090101' then HISTORIES else '' end) as riwayat_drug,
            max(case when VALUE_ID = 'G0090102' then HISTORIES else '' end) as riwayat_nondrug,
            max(case when VALUE_ID = 'G0090201' then HISTORIES else '' end) as riwayat_keluarga,
            max(case when VALUE_ID = 'G0090303' then HISTORIES else '' end) as riwayat_diet,
            max(case when VALUE_ID = 'G0090401' then HISTORIES else '' end) as riwayat_obat_konsumsi,
            max(case when VALUE_ID = 'G0090402' then HISTORIES else '' end) as riwayat_hamil,
            max(case when VALUE_ID = 'G0090403' then HISTORIES else '' end) as riwayat_imunisasi
            from PASIEN_HISTORY group by no_registration)ph on ph.no_registration = ea.no_registration  where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            $spiritualSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            KODE_AGAMA,
            RELIGION_BAN,
            MYTH,
            FAMILYRELATION,
            SOCIAL_BARIER,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SPIRITUAL
            where visit_id = '" . $visit['visit_id'] . "'
            order by examination_date")->getResultArray());
            $spiritual = $spiritualSelect[0] ?? [];
            $socecSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            MARITALSTATUSID,
            CHILDREN,
            EDUCATION_TYPE_CODE,
            NATION_ID,
            JOB_ID,
            RESIDENCE,
            ACTIVITY,
            SUSPICION,
            LIVINGWITH,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SOCEC
            where visit_id = '" . $visit['visit_id'] . "'
            order by examination_date")->getResultArray());
            $socec = $socecSelect[0] ?? [];

            // $aParam = 
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/1-ralan-anak.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "spiritual" => $spiritual,
                    "socec" => $socec
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/1-ralan-anak.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }

            // $html =
            //     view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/1-ralan-anak.php", [
            //         "visit" => $visit,
            //         'title' => $title,
            //         "val" => $select[0],
            //         "spiritual" => $spiritual,
            //         "socec" => $socec
            //     ]);

            // // Create new PDF instance
            // $dompdf = new Dompdf();

            // // Load HTML content
            // $dompdf->loadHtml($html);

            // // Render the PDF
            // $dompdf->render();

            // // Output the generated PDF

            // $pdfContent = $dompdf->output();

            // header('Content-Type: application/pdf');
            // header('Content-Disposition: attachment; filename="filename.pdf"');
            // header('Cache-Control: private, max-age=0, must-revalidate');
            // header('Pragma: public');
            // header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
            // header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

            // return $pdfContent;
        }
    }
    public function ralan_dewasa($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan Rawat Jalan Pasien Dewasa"; //hosnic_emr_rj_bedah
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select
            tension_upper, tension_below, temperature, NADI, NAFAS, WEIGHT, HEIGHT, format(round(WEIGHT*10000/height/height,2), '0.##') as bmi, 'respiration' as respiration,
            'alkohol' as alkohol, 'merokok' as merokok, 'lingkar_lengan' as lingkar_lengan, 'kondisi_pasien' as kondisi_pasien,
            'hubungan_keluarga' as hubungan_keluarga, 'permintaan_khusus' as permintaan_khusus, 'agama' as agama,
            'hambatan_sosial' as hambatan_sosial, 'larangan_keyakinan' as larangan_keyakinan, 'mitos_budaya' as mitos_budaya,
            'status_perkawinan' as status_perkawinan, 'punya_anak' as punya_anak, 'jumlah_anak' as jumlah_anak,
            'pendidikan' as pendidikan, 'kewarganegaraan' as kewarganegaraan, 'pekerjaan' as pekerjaan, 'aktivitas' as aktivitas,
            'penganiayaan' as penganiayaan, 'tinggal_bersama' as tinggal_bersama, 'pasien_operasi' as pasien_operasi,
            'gangguan_makan' as gangguan_makan, 'masalah_nutrisi' as masalah_nutrisi, 'masalah_makan' as masalah_makan,
            'nutrisi_ngt' as nutrisi_ngt, 'mukosa_mulut' as mukosa_mulut, 'fluid_intake' as fluid_intake, 'penyakit' as penyakit, 
            'gangguan_metabolik' as gangguan_metabolik, 'status_gangguan' as status_gangguan, 'kategori_usia' as kategori_usia, 
            'resiko_malnutrisi' as resiko_malnutrisi, 'perlu_konsultasi' as perlu_konsultasi, 'lama_kehamilan' as lama_kehamilan, 
            'komplikasi' as komplikasi, 'masalah_neonatus' as masalah_neonatus, 'masalah_maternal' as masalah_maternal, 
            'riwayat_imunisasi' as riwayat_imunisasi, 'umur_tengkurap' as umur_tengkurap, 'umur_duduk' as umur_duduk, 
            'umur_mengoceh' as umur_mengoceh, 'umur_berdiri' as umur_berdiri, 'umur_bicara' as umur_bicara, 'umur_berjalan' as umur_berjalan, 
            'asi' as asi, 'makanan_tambahan' as makanan_tambahan, 'pengasuh' as pengasuh, 'pembawaan_umum' as pembawaan_umum, 
            'tempramen' as tempramen, 'kebiasaan_perilaku' as kebiasaan_perilaku, 'pd3i' as pd3i, 'gangguan_tumbuh' as gangguan_tumbuh, 
            'skala_nyeri' as skala_nyeri, 'resiko_jatuh' as resiko_jatuh, 'luka_operasi' as luka_operasi, 'deskripsi_nyeri' as deskripsi_nyeri, 
            'hipertermi' as hipertermi, 'nama_diagnosis' as nama_diagnosis
            from examination_info where visit_id = '80214'")->getResultArray());
            $spiritualSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            KODE_AGAMA,
            RELIGION_BAN,
            MYTH,
            FAMILYRELATION,
            SOCIAL_BARIER,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SPIRITUAL
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $spiritual = $spiritualSelect[0] ?? [];
            $socecSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            MARITALSTATUSID,
            CHILDREN,
            EDUCATION_TYPE_CODE,
            NATION_ID,
            JOB_ID,
            RESIDENCE,
            ACTIVITY,
            SUSPICION,
            LIVINGWITH,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SOCEC
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $socec = $socecSelect[0] ?? [];
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/2-ralan-dewasa.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "spiritual" => $spiritual,
                    "socec" => $socec
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/2-ralan-dewasa.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ranap_dewasa($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan Rawat Inap Pasien Dewasa";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $adl = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            FEEDING,
            BATHING,
            SELFCARE,
            DRESSING,
            BAB,
            BAK,
            TOILETING,
            TRANSFERING,
            MOBILITY,
            STAIRS,
            TOTAL_DEPENDENCY,
            ADL_DISRUPTION,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_ADL_BARTHEL
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $spiritualSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            KODE_AGAMA,
            RELIGION_BAN,
            MYTH,
            FAMILYRELATION,
            SOCIAL_BARIER,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SPIRITUAL
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $spiritual = $spiritualSelect[0] ?? [];
            $integumenSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            INTEGUMEN,
            TURGOR,
            HAIR,
            NAIL,
            WOUND,
            WOUND_DEPTH,
            BLEEDING,
            FRACTURE,
            LOCATION,
            SKIN_DISORDER,
            SKIN_DESC,
            ADI_DISORDER,
            ADI_DESC,
            MOBILIZATION_DISORDER,
            MOBILIZATION_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_INTEGUMEN
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $integumen = $integumenSelect[0] ?? [];
            $socecSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            MARITALSTATUSID,
            CHILDREN,
            EDUCATION_TYPE_CODE,
            NATION_ID,
            JOB_ID,
            RESIDENCE,
            ACTIVITY,
            SUSPICION,
            LIVINGWITH,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SOCEC
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $socec = $socecSelect[0] ?? [];
            $neurosensorisSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            MEMORY,
            ORIENTASI,
            LPUPIL_DIAMETER,
            LPUPIL_REACTION,
            RPUPIL_DIAMETER,
            RPUPIL_REACTION,
            NEUROSENSORS,
            INJURY_RISK,
            INJURY_DESC,
            STATUS
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_NEUROSENSORIS
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $neurosensoris = $neurosensorisSelect[0] ?? [];
            $circulationSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            TENSION_UPPER,
            TENSION_BELOW,
            CIRCULATION_DISORDER,
            OTHER_DISORDER,
            CAPILLARY_FILLING,
            NADI,
            NAFAS,
            HEART_RHYTHM,
            PACEMAKER,
            AKRAL,
            PERFUSI_DISORDER,
            PERFUSI_DESC,
            SHOCK_RISK,
            SHOCK_DESC,
            HEART_RISK,
            HEART_RISK_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_CIRCULATION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $circulation = $circulationSelect[0] ?? [];
            $digestionSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            WASIR,
            RECTAL_BLEED,
            DIET_TYPE,
            FEEDING_TUBE,
            FLUID_LIMIT,
            ABDOMEN,
            INTESTINAL_SOUND,
            BAB,
            BAB_WHEN,
            BAB_FREQ,
            BAB_FORM,
            BAB_COLOR,
            PENCAHAR,
            TROUBLE_RISK,
            TROUBLE_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_DIGESTION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $digestion = $digestionSelect[0] ?? [];
            $respirationSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            AIRWAY,
            OBJECT_STRANGE,
            OBJECT_DESC,
            ETT,
            ETT_SIZE,
            BREATHING,
            RESPIRATION_RATE,
            COUGH,
            SPO2,
            LUNG_SOUND,
            LUNG_POSITION,
            BREATHING_TROUBLE,
            O2_USAGE,
            CLEAN_BREATHING,
            CLEAN_DESC,
            EFFECTIVE_BREATHING,
            EFFECTIVE_DESC,
            GAS_TROUBLE,
            GAS_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY,
            COUGH_TYPE,
            O2_Q,
            O2_TYPE,
            BREATH_MUSCLE
            from ASSESSMENT_RESPIRATION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $respiration = $respirationSelect[0] ?? [];
            $bladderSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            BAK,
            URINE_CATHETER,
            URINE_VOL,
            URINE_COLOR,
            URINE_CATHETER_DESC,
            PROSTATE,
            PROSTATE_DESC,
            BACK_PAIN,
            DISORDERS,
            DISORDER_DESC,
            ELIMINATION,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_BLADDER
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $bladder = $bladderSelect[0] ?? [];
            $reproductionSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            G,
            P,
            A,
            MENSTRUASI,
            PREGNANT,
            POSTPARTUM_DAY,
            LOCHEA,
            COUNTING,
            BREAST,
            ASI,
            ASI_FAIL,
            ASI_FAIL_DESC,
            CONTRACTION,
            PAPSMEAR,
            MAMMOGRAFI,
            SADARI,
            BLEEDING_RISK,
            BLEEDING_DESC,
            SELFDISORDER,
            SELFDISORDER_DESC,
            SKRINING_PROSTAT,
            SKRINING_DATE,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_REPRODUCTION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $reproduction = $reproductionSelect[0] ?? [];
            $hearingSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            EARS,
            SWOLLEN_PAIN,
            TEETH,
            TOOTHACHE,
            DENTUREST,
            EYES,
            CENSORY_DISORDER,
            CENSORY_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_VISION_HEARING
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $hearing = $hearingSelect[0] ?? [];
            $sleepingSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            SLEEP_DURATION,
            SLEEPING_PILLS,
            LIGHT,
            CURRENT_SLEEPING,
            REASONS,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_SLEEPING
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $sleeping = $sleepingSelect[0] ?? [];
            $dekubitusSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            DEKUBITUS_RISK,
            DEKUBITUS_TYPE,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_DEKUBITUS
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $dekubitus = $dekubitusSelect[0] ?? [];
            if (isset($adl[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/3-ranap-dewasa.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "adl" => $adl[0],
                    "spiritual" => $spiritual,
                    "integumen" => $integumen,
                    "socec" => $socec,
                    "neurosensoris" => $neurosensoris,
                    "circulation" => $circulation,
                    "digestion" => $digestion,
                    "respiration" => $respiration,
                    "bladder" => $bladder,
                    "reproduction" => $reproduction,
                    "hearing" => $hearing,
                    "sleeping" => $sleeping,
                    "dekubitus" => $dekubitus
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/3-ranap-dewasa.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function cetak_keperawatan($visit, $vactination_id = null, $titlekeperawatan = null)
    {
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);

            $db = db_connect();
            $select = $this->lowerKey($db->query("
                SELECT
                    ei.ANAMNASE as anamnesis,
                    ei.vs_status_id,
                    ei.DESCRIPTION AS riwayat_penyakit_sekarang,
                    gcs.GCS_E,
                    gcs.GCS_m,
                    gcs.GCS_V, 
                    gcs.GCS_SCORE as gcs,
                    gcs.GCS_DESC,
                    ei.isrj,
                    max(case when apv.PARAMETER_ID = '01' and apv.VALUE_SCORE = GCS_E then apv.VALUE_DESC else '' end ) as GSC_E_DESC,
                    max(case when apv.PARAMETER_ID = '02' and apv.VALUE_SCORE = GCS_M then apv.VALUE_DESC else '' end ) as GSC_M_DESC,
                    max(case when apv.PARAMETER_ID = '03' and apv.VALUE_SCORE = GCS_V then apv.VALUE_DESC else '' end ) as GSC_V_DESC,
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
                    where ASSESSMENT_FALL_RISK.DOCUMENT_ID = ei.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
					isnull((select top(1) ASSESSMENT_FALL_RISK.DESCRIPTION from ASSESSMENT_FALL_RISK
                    where ASSESSMENT_FALL_RISK.DOCUMENT_ID = ei.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as FALL_DESC,
                    isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
                    where ASSESSMENT_PAIN_MONITORING.DOCUMENT_ID = ei.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
					isnull((select top(1) ASSESSMENT_PAIN_MONITORING.DESCRIPTION from ASSESSMENT_PAIN_MONITORING
                    where ASSESSMENT_PAIN_MONITORING.DOCUMENT_ID = ei.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as FALL_DESC
                FROM EXAMINATION_INFO ei
                    left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = ei.NO_REGISTRATION
                    left outer join ASSESSMENT_GCS gcs on ei.PASIEN_DIAGNOSA_ID = gcs.DOCUMENT_ID
                    left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on ei.PASIEN_DIAGNOSA_ID = EDU.DOCUMENT_ID
                    left outer join ASSESSMENT_REPRODUCTION arp on ei.PASIEN_DIAGNOSA_ID = arp.DOCUMENT_ID
                    LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
                WHERE ei.VISIT_ID = '{$visit['visit_id']}' AND ei.BODY_ID = '$vactination_id'	

                group by 
                    ei.ANAMNASE, 
                    ei.DESCRIPTION,
                    gcs.GCS_E,
                    gcs.GCS_m,
                    gcs.GCS_V, 
                    gcs.GCS_SCORE,
                    gcs.GCS_DESC,
                    ei.WEIGHT,
                    ei.HEIGHT,
                    ei.TENSION_UPPER,
                    ei.TENSION_BELOW,
                    ei.nadi,
                    ei.TEMPERATURE,
                    ei.NAFAS,
                    ei.SATURASI,
                    ei.PASIEN_DIAGNOSA_ID,
                    ei.vs_status_id,
                    ei.isrj

        ")->getResultArray());

            $title = "Asesmen Keperawatan ";
            if (!is_null($visit['class_room_id']) && $visit['class_room_id'] != '') {
                $title .= 'Rawat Inap ';
            } else {
                $title .= 'Rawat Jalan ';
            }
            if ($titlekeperawatan != null) {
                $title .= $titlekeperawatan;
            }

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
                    CHEST_DIAMETER AS LINGKAR_DADA 
                FROM ASSESSMENT_NEONATUS_PHYSIC
                WHERE 
                    ASSESSMENT_NEONATUS_PHYSIC.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_NEONATUS_PHYSIC.VISIT_ID = '{$visit['visit_id']}'
               "
            )->getResultArray());
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
                    ASSESSMENT_APGAR_DETAIL.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '{$visit['visit_id']}'
                    AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
            )->getResultArray());

            $spiritual = $this->lowerKey($db->query(
                "
                SELECT 
                    RELIGION_BAN_DESC as LARANGAN_KEYAKINAN,
                    FAMILYRELATION as HUBUNGAN_KELUARGA,
                    SOCIAL_BARIER AS HAMBATAN_SOSIAL,
                    NAMA_AGAMA AS NAMA_AGAMA,
                    MYTH_DESC AS MITOS_BUDAYA
                FROM ASSESSMENT_SPIRITUAL
                INNER JOIN AGAMA ON ASSESSMENT_SPIRITUAL. KODE_AGAMA = AGAMA.KODE_AGAMA
                WHERE 
                    ASSESSMENT_SPIRITUAL.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_SPIRITUAL.VISIT_ID = '{$visit['visit_id']}'
                    "
            )->getFirstRow());

            $activity = $this->lowerKey($db->query(
                "
                SELECT 
                    PARAMETER_DESC, TOTAL_DEPENDENCY,
                    MAX(CASE WHEN ASSESSMENT_ADL_BARTHEL.P_TYPE = 'ASES016' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_DESC ELSE '' END) AS VALUE_DESC,
                    MAX(CASE WHEN ASSESSMENT_ADL_BARTHEL.P_TYPE = 'ASES016' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ELSE '' END) AS VALUE_SCORE
                FROM ASSESSMENT_ADL_BARTHEL
                INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ADL_BARTHEL.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ADL_BARTHEL.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
                WHERE VISIT_ID = '{$visit['visit_id']}'
                AND BODY_ID = '$vactination_id'
                GROUP BY ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID, TOTAL_DEPENDENCY
                "
            )->getResultArray());

            //NEW
            $hipertensi = $this->lowerKey($db->query(
                "
                SELECT 
                    ASSESSMENT_PARAMETER.PARAMETER_ID, 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    MAX(CASE 
                            WHEN ASSESSMENT_PARAMETER.P_TYPE = 'ASES020' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID  
                            THEN ASSESSMENT_PARAMETER_VALUE.VALUE_DESC 
                            ELSE '' 
                        END) AS VALUE_DESC,
                    MAX(CASE 
                            WHEN ASSESSMENT_PARAMETER.P_TYPE = 'ASES020' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID 
                            THEN ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE 
                            ELSE 0  
                        END) AS VALUE_SCORE
                FROM 
                    ASSESSMENT_FALL_RISK
                INNER JOIN 
                    ASSESSMENT_PARAMETER ON ASSESSMENT_FALL_RISK.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                INNER JOIN 
                    ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_FALL_RISK.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
                where visit_id = '{$visit['visit_id']}'
                and body_id = '$vactination_id'
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER.PARAMETER_DESC
                HAVING 
                    MAX(CASE 
                            WHEN ASSESSMENT_PARAMETER.P_TYPE = 'ASES020' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID 
                            THEN ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE 
                            ELSE 0 
                        END) != 0  
                ORDER BY 
                    PARAMETER_ID ASC;
                "
            )->getResultArray());

            $neurosensoris = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_NEUROSENSORIS', 'ASES038', $visit['visit_id'], $vactination_id))->getResultArray());

            $circulation = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_CIRCULATION', 'ASES039', $visit['visit_id'], $vactination_id))->getResultArray());

            $pencernaan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_DIGESTION', 'ASES040', $visit['visit_id'], $vactination_id))->getResultArray());

            $pernapasan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_RESPIRATION', 'ASES041', $visit['visit_id'], $vactination_id))->getResultArray());

            $perkemihan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_BLADDER', 'ASES042', $visit['visit_id'], $vactination_id))->getResultArray());

            $reproduksi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_REPRODUCTION', 'ASES043', $visit['visit_id'], $vactination_id))->getResultArray());

            $thtdanmata = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_VISION_HEARING', 'ASES044', $visit['visit_id'], $vactination_id))->getResultArray());

            $tidurdanistirahat = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SLEEPING', 'ASES046', $visit['visit_id'], $vactination_id))->getResultArray());

            $dekubitus = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_DEKUBITUS', 'ASES047', $visit['visit_id'], $vactination_id))->getResultArray());

            $integumen = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_INTEGUMEN', 'ASES036', $visit['visit_id'], $vactination_id))->getResultArray());

            $sosialekonomi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SOCEC', 'ASES037', $visit['visit_id'], $vactination_id))->getResultArray());


            $pediatri = $this->lowerKey($db->query(
                "
                SELECT
                    PREGNANCY_PERIOD AS LAMA_KEHAMILAN,
                    COMPLICATION AS KOMPLIKASI,
                    NEONATUS_ISSUES AS MASALAH_NEONATUS,
                    MATERNAL_ISSUES AS MASALAH_METERNAL,
                    VACTINATION_HSITORY AS RIWAYAT_IMUNISASI,
                    PRONE_AGE AS USIA_TENGKURAP,
                    SITTING_AGE AS USIA_DUDUK,
                    BABLING_AGE AS USIA_MENGOCEH,
                    STANDING_AGE AS USIA_BERDIRI,
                    TALKING_AGE AS USIA_BERBICARA,
                    WALKING_AGE AS USIA_BERJALAN,
                    MILK_FEEDING AS ASI,
                    ADDITINAL_FOOD AS MAKANAN_TAMBAHAN,
                    SITTER AS PENGASUH,
                    CHARACTERS AS PEMBAWAAN,
                    TEMPRAMEN AS TEMPRAMEN,
                    ILLNESRISK_AVOID AS RESIKO_PENYAKIT,
                    GROWTH_DISORDER AS GANGGUAN_TUMBUH
                FROM ASSESSMENT_PEDIATRIC AP
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and document_id = '$vactination_id'
                    "
            )->getResultArray());

            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            // dd($selectorganization);
            // $selectinfo = $this->query_template_info($db, $visit['visit_id'], '20240614173754692');
            $selectinfo = $visit;

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "neonatus" => $neonatus,
                    "apgarWaktu" => $apgarWaktu,
                    "apgarData" => $apgarData,
                    "spiritual" => $spiritual,
                    "activity" => $activity,
                    "neurosensoris" => $neurosensoris,
                    "circulation" => $circulation,
                    "pencernaan" => $pencernaan,
                    "pernapasan" => $pernapasan,
                    "perkemihan" => $perkemihan,
                    "hipertensi" => $hipertensi,
                    "reproduksi" => $reproduksi,
                    "thtdanmata" => $thtdanmata,
                    "tidurdanistirahat" => $tidurdanistirahat,
                    "dekubitus" => $dekubitus,
                    "integumen" => $integumen,
                    "sosialekonomi" => $sosialekonomi,
                    "organization" => $selectorganization,
                    "info" => $selectinfo,
                    "pediatri" => $pediatri,
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "info" => $selectinfo,
                    "val" => $select[0]
                ]);
            }
        }
    }
    public function ranap_neonatuslama($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan Rawat Inap Pasien Neonatus";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);

            $db = db_connect();
            $select = $this->lowerKey($db->query("select 
            pd.NO_REGISTRATION as no_RM,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            pd.CLASS_ROOM_ID,
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
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
            isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
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
            '' rencana_tl,
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
            left outer join ASSESSMENT_GCS gcs on pd.PASIEN_DIAGNOSA_ID = gcs.DOCUMENT_ID
            left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on pd.PASIEN_DIAGNOSA_ID = EDU.DOCUMENT_ID
			left outer join INASIS_GET_TINDAKLANJUT igt on pd.RENCANATL = igt.KODE
			left outer join ASSESSMENT_REPRODUCTION arp on pd.PASIEN_DIAGNOSA_ID = arp.DOCUMENT_ID
            LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
           , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '202405262033530190C16'
            and PD.VISIT_ID =  '2024052400101208008C3'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.CLASS_ROOM_ID,
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
            gcs.GCS_DESC,
            igt.nama,
            pd.TGLKONTROL,
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
                    CHEST_DIAMETER AS LINGKAR_DADA 
                FROM ASSESSMENT_NEONATUS_PHYSIC
                WHERE 
                    ASSESSMENT_NEONATUS_PHYSIC.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_NEONATUS_PHYSIC.VISIT_ID = '{$visit['visit_id']}'
               "
            )->getResultArray());
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
                    ASSESSMENT_APGAR_DETAIL.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '{$visit['visit_id']}'
                    AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
            )->getResultArray());

            $spiritual = $this->lowerKey($db->query(
                "
                SELECT 
                    RELIGION_BAN_DESC as LARANGAN_KEYAKINAN,
                    FAMILYRELATION as HUBUNGAN_KELUARGA,
                    SOCIAL_BARIER AS HAMBATAN_SOSIAL,
                    NAMA_AGAMA AS NAMA_AGAMA,
                    MYTH_DESC AS MITOS_BUDAYA
                FROM ASSESSMENT_SPIRITUAL
                INNER JOIN AGAMA ON ASSESSMENT_SPIRITUAL. KODE_AGAMA = AGAMA.KODE_AGAMA
                WHERE 
                    ASSESSMENT_SPIRITUAL.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_SPIRITUAL.VISIT_ID = '{$visit['visit_id']}'
                    "
            )->getFirstRow());

            $activity = $this->lowerKey($db->query(
                "
                SELECT 
                    PARAMETER_DESC, TOTAL_DEPENDENCY,
                    MAX(CASE WHEN ASSESSMENT_ADL_BARTHEL.P_TYPE = 'ASES016' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_DESC ELSE '' END) AS VALUE_DESC,
                    MAX(CASE WHEN ASSESSMENT_ADL_BARTHEL.P_TYPE = 'ASES016' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ELSE '' END) AS VALUE_SCORE
                FROM ASSESSMENT_ADL_BARTHEL
                INNER JOIN ASSESSMENT_PARAMETER ON ASSESSMENT_ADL_BARTHEL.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_ADL_BARTHEL.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
                WHERE VISIT_ID = '{$visit['visit_id']}'
                AND BODY_ID = '$vactination_id'
                GROUP BY ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID, TOTAL_DEPENDENCY
                    "
            )->getResultArray());

            $neurosensoris = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_NEUROSENSORIS', 'ASES038', $visit['visit_id'], $vactination_id))->getResultArray());

            $circulation = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_CIRCULATION', 'ASES039', $visit['visit_id'], $vactination_id))->getResultArray());

            $pencernaan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_DIGESTION', 'ASES040', $visit['visit_id'], $vactination_id))->getResultArray());

            $pernapasan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_RESPIRATION', 'ASES041', $visit['visit_id'], $vactination_id))->getResultArray());

            $perkemihan = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_BLADDER', 'ASES042', $visit['visit_id'], $vactination_id))->getResultArray());

            $reproduksi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_REPRODUCTION', 'ASES043', $visit['visit_id'], $vactination_id))->getResultArray());

            $thtdanmata = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_VISION_HEARING', 'ASES044', $visit['visit_id'], $vactination_id))->getResultArray());

            $tidurdanistirahat = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SLEEPING', 'ASES046', $visit['visit_id'], $vactination_id))->getResultArray());

            $dekubitus = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_DEKUBITUS', 'ASES047', $visit['visit_id'], $vactination_id))->getResultArray());

            $integumen = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_INTEGUMEN', 'ASES036', $visit['visit_id'], $vactination_id))->getResultArray());

            $sosialekonomi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SOCEC', 'ASES037', $visit['visit_id'], $vactination_id))->getResultArray());


            // $pediatri = $this->lowerKey($db->query("
            //     SELECT
            //         PREGNANCY_PERIOD AS LAMA_KEHAMILAN,
            //         COMPLICATION AS KOMPLIKASI,
            //         NEONATUS_ISSUES AS MASALAH_NEONATUS,
            //         MATERNAL_ISSUES AS MASALAH_METERNAL,
            //         VACTINATION_HSITORY AS RIWAYAT_IMUNISASI,
            //         PRONE_AGE AS USIA_TENGKURAP,
            //         SITTING_AGE AS USIA_DUDUK,
            //         BABLING_AGE AS USIA_MENGOCEH,
            //         STANDING_AGE AS USIA_BERDIRI,
            //         TALKING_AGE AS USIA_BERBICARA,
            //         WALKING_AGE AS USIA_BERJALAN,
            //         MILK_FEEDING AS ASI,
            //         ADDITINAL_FOOD AS MAKANAN_TAMBAHAN,
            //         SITTER AS PENGASUH,
            //         CHARACTERS AS PEMBAWAAN,
            //         TEMPRAMEN AS TEMPRAMEN,
            //         ILLNESRISK_AVOID AS RESIKO_PENYAKIT,
            //         GROWTH_DISORDER AS GANGGUAN_TUMBUH
            //     FROM ASSESSMENT_PEDIATRIC AP
            //     WHERE VISIT_ID = $visit['visit_id']
            //     AND DOCUMENT_ID = $vactination_id
            //         "
            // )->getResultArray());

            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            $selectinfo = $this->query_template_info($db, $visit['visit_id'], '20240614173754692');

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "neonatus" => $neonatus,
                    "apgarWaktu" => $apgarWaktu,
                    "apgarData" => $apgarData,
                    "spiritual" => $spiritual,
                    "activity" => $activity,
                    "neurosensoris" => $neurosensoris,
                    "circulation" => $circulation,
                    "pencernaan" => $pencernaan,
                    "pernapasan" => $pernapasan,
                    "perkemihan" => $perkemihan,
                    "reproduksi" => $reproduksi,
                    "thtdanmata" => $thtdanmata,
                    "tidurdanistirahat" => $tidurdanistirahat,
                    "dekubitus" => $dekubitus,
                    "integumen" => $integumen,
                    "sosialekonomi" => $sosialekonomi,
                    "organization" => $selectorganization,
                    "info" => $selectinfo,
                    // "pediatri" => $pediatri[0],
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "info" => $selectinfo
                ]);
            }
        }
    }
    public function asuhan_gizi($visit, $vactination_id = null)
    {
        $title = "Asuhan Gizi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/6-asuhan-gizi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/6-asuhan-gizi.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }

    public function cppt_ranap($visit, $vactination_id = null)
    {
        // $title = "Catatan Perkembangan Pasien Terintegrasi RI";
        // if ($this->request->is('get')) {
        //     $visit = base64_decode($visit);
        //     $visit = json_decode($visit, true);

        //     // return json_encode($visit);
        //     $db = db_connect();
        //     $select = $this->lowerKey($db->query("select visit_date, '' as kodeppa, FULLNAME, '' as catatan, '' as response, '' verifikasi
        //     from pasien_visitation pv
        //     inner join EMPLOYEE_ALL ea on pv.employee_id = ea.EMPLOYEE_ID
        //     where pv.no_registration = '" . $visit['no_registration'] . "'
        //     order by visit_date")->getResultArray());
        //     if (isset($select[0])) {
        //         return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/8-cppt-ranap.php", [
        //             "visit" => $visit,
        //             'title' => $title,
        //             "val" => $select
        //         ]);
        //     } else {
        //         return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/8-cppt-ranap.php", [
        //             "visit" => $visit,
        //             'title' => $title
        //         ]);
        //     }
        // }
        $title = "Catatan Perkembangan Pasien Terintegrasi RI";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query(
                "
            select ei.examination_date ,
            case when ea2.specialist_type_id = '20' then 'D'
            when ea2.OBJECT_CATEGORY_ID = '21' then 'P'
            when ea2.OBJECT_CATEGORY_ID = '22' then 'Far'
            when ea2.OBJECT_CATEGORY_ID = '23' then 'B'
                when ea2.OBJECT_CATEGORY_ID = '24' then 'G'
                when ea2.OBJECT_CATEGORY_ID = '25' then 'Fis'
                else '' end as kode_PPA,
                case when ea2.FULLNAME is null then ei.modified_by else ea2.fullname end as nama_ppa ,
                ei.ANAMNASE as Subyectif,
                'BB : ' + cast(WEIGHT as varchar(10))  + 'Kg , ' +'TB : ' + cast(height as varchar(10)) + ' cm , ' +
            'Tensi : '+ cast(TENSION_UPPER as varchar(10)) + ' / ' + cast(TENSION_BELOW as varchar(10)) + ' mmHg , ' + 
            'Nadi : ' + cast(nadi as varchar(10)) + ' /mnt , ' + 'RR : ' + cast(NAFAS as varchar(10)) + ' /mnt , ' + ' SpO2 : ' + 
            cast(saturasi as varchar(10)) + ' % ' 
            + ' Keadaan Umum : ' + ei.ALO_ANAMNASE  as obyektif,
                ei.DESCRIPTION as asesmen,
                ei.instruction as  planning,
                ei.examination_date as tanggal_dibuat,
                ei.valid_date as tanggal_konfirm,
                ea.fullname as konfirm_oleh

            from examination_info ei
            left outer join employee_all ea on ei.employee_id = ea.employee_id
            left outer join users u on ei.modified_by = u.username
            left outer join employee_all ea2 on u.employee_id = ea2.employee_id
            where
            visit_id  = '{$visit['visit_id']}'
            and NO_REGISTRATION = '{$visit['no_registration']}'
            "
            )->getResultArray());

            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            $selectinfo = $visit;
            // $selectinfo = $this->query_template_info($db, $visit['visit_id'], '20240614173754692');

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization,
                    "info" => $selectinfo

                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function cppt_ralan($visit, $vactination_id = null)
    {
        $title = "Catatan Perkembangan Pasien Terintegrasi RJ";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query(
                "
            select ei.examination_date ,
            case when ea.OBJECT_CATEGORY_ID = '20' then 'D'
            when ea.OBJECT_CATEGORY_ID = '21' then 'P'
            when ea.OBJECT_CATEGORY_ID = '22' then 'Far'
            when ea.OBJECT_CATEGORY_ID = '23' then 'B'
                when ea.OBJECT_CATEGORY_ID = '24' then 'G'
                when ea.OBJECT_CATEGORY_ID = '25' then 'Fis'
                else '' end as kode_PPA,
                ea.FULLNAME as nama_ppa ,
                ei.ANAMNASE as Subyectif,
                'BB : ' + cast(WEIGHT as varchar(10))  + 'Kg , ' +'TB : ' + cast(height as varchar(10)) + ' cm , ' +
            'Tensi : '+ cast(TENSION_UPPER as varchar(10)) + ' / ' + cast(TENSION_BELOW as varchar(10)) + ' mmHg , ' + 
            'Nadi : ' + cast(nadi as varchar(10)) + ' /mnt , ' + 'RR : ' + cast(NAFAS as varchar(10)) + ' /mnt , ' + ' SpO2 : ' + 
            cast(saturasi as varchar(10)) + ' % ' 
            + ' Keadaan Umum : ' + ei.ALO_ANAMNASE  as obyektif,
                ei.DESCRIPTION as asesmen,
                ei.instruction as  planning,
                ei.examination_date as tanggal_dibuat,
                ei.valid_date as tanggal_konfirm,
                ei.MODIFIED_BY as konfirm_oleh

            from examination_info ei
            left outer join employee_all ea on ei.employee_id = ea.employee_id
            where
            visit_id  = '{$visit['visit_id']}'
            and NO_REGISTRATION = '{$visit['no_registration']}'
            and vs_status_id in('2','7')
            "
            )->getResultArray());

            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            $selectinfo = $visit;
            // $selectinfo = $this->query_template_info($db, $visit['visit_id'], '20240614173754692');

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization,
                    "info" => $selectinfo

                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function diagnosis_keperawatan($visit, $vactination_id = null)
    {
        $title = "Diagnosis Keperawatan - Bersihan Jalan Nafas Tidak Efektif";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/10-diagnosis-keperawatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/10-diagnosis-keperawatan.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function edukasi_obat($visit, $vactination_id = null)
    {
        $title = "Edukasi Obat Oleh Apoteker";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/12-edukasi-obat.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/12-edukasi-obat.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function formulir_edukasi($visit, $vactination_id = null)
    {
        $title = "Formulir Pemberian Edukasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();
            $select = $this->lowerKey($db->query("SELECT MODIFIED_DATE as date, EDUCATION_MATERIAL as education, FAMILY_NAME, FAMILY_RELATION, MODIFIED_BY as staff
                                                         from ASSESSMENT_EDUCATION_FORMULIR where VISIT_ID = '" . $visit['visit_id'] . "'")->getResultArray());

            if (isset($select)) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/13-formulir.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "data" => !$select ? "" : $select,
                    'kop' => $kopprintData[0]

                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/13-formulir.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0]

                ]);
            }
        }
    }


    public function identitas($visit, $vactination_id = null)
    {
        $title = "Identitas dan Pernyataan Rawat Inap Pasien";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/15-identitas.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/15-identitas.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function igd_anak($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan IGD Pasien Anak"; //hosnic_emr_rj_bedah
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select
            tension_upper, tension_below, temperature, NADI, NAFAS, WEIGHT, HEIGHT, format(round(WEIGHT*10000/height/height,2), '0.##') as bmi, 'respiration' as respiration,
            'lla' as lla, 'penyebab_cidera' as penyebab_cidera, 'airway' as airway, 'benda_asing' as benda_asing, 'ett' as ett,
            'breathing' as breathing, 'bunyi_paru' as bunyi_paru, 'posisi_paru' as posisi_paru, 'kesulitan_bernafas' as kesulitan_bernafas,
            'penggunaan_bantu_nafas' as penggunaan_bantu_nafas, 'menggunakan_oksigen' as menggunakan_oksigen, 'frekuensi_nafas' as frekuensi_nafas,
            'batuk' as batuk, 'bersihan_jalan_nafas' as bersihan_jalan_nafas, 'pola_nafas_efektif' as pola_nafas_efektif, 'gangguan_gas' as gangguan_gas,
            'gangguan_sirkulasi' as gangguan_sirkulasi, 'pengisian_kapiler' as pengisian_kapiler, 'denyut_nadi' as denyut_nadi, 
            'irama_jantung' as irama_jantung, 'pacemaker' as pacemaker, 'akral' as akral, 'gangguan_perfusi' as gangguan_perfusi,
            'resiko_syok' as resiko_syok, 'gangguan_penurunan' as gangguan_penurunan, 'orientasi' as orientasi, 'memori' as memori,
            'gcs' as gcs, 'gcs_e' as gcs_e, 'gcs_v' as gcs_v, 'gcs_m' as gcs_m, 'gcs_score' as gcs_score, 'ukuran_pupil_kiri' as ukuran_pupil_kiri,
            'ukuran_pupil_kanan' as ukuran_pupil_kanan, 'reaksi_pupil_kiri' as reaksi_pupil_kiri, 'reaksi_pupil_kanan' as reaksi_pupil_kanan,
            'tanda_perangsang' as tanda_perangsang, 'resiko_injury' as resiko_injury, 'integumen' as integumen, 'turgor' as turgor, 
            'rambut' as rambut, 'kuku' as kuku, 'luka' as luka, 'pendarahan' as pendarahan, 'fraktur' as fraktur, 'dislokasi' as dislokasi,
            'gangguan_integritas' as gangguan_integritas, 'resiko_infeksi' as resiko_infeksi, 'gangguan_pemenuhan' as gangguan_pemenuhan,
            'gangguan_mobilisasi' as gangguan_mobilisasi, 'skala_nyeri' as skala_nyeri, 'alat_ukur_nyeri' as alat_ukur_nyeri,
            'penjelasan' as penjelasan, 'tipe_resiko' as tipe_resiko, 'rating_scale' as rating_scale, 'luka_operasi' as luka_operasi,
            'deskripsi_nyeri' as deskripsi_nyeri, 'hipertermi' as hipertermi, 'riwayat_jatuh' as riwayat_jatuh, 'diagnosis_sekunder' as diagnosis_sekunder,
            'alat_bantu' as alat_bantu, 'infuse' as infuse, 'gaya_berjalan' as gaya_berjalan, 'status_mental' as status_mental,
            'medikasi' as medikasi, 'fall_score' as fall_score, 'pasien_operasi' as pasien_operasi, 'gangguan_makan' as gangguan_makan,
            'masalah_nutrisi' as masalah_nutrisi, 'masalah_makan' as masalah_makan, 'nutrisi_ngt' as nutrisi_ngt, 'mukosa_mulut' as mukosa_mulut,
            'fluid_intake' as fluid_intake, 'penyakit' as penyakit, 'gengguan_metabolik' as gangguan_metabolik, 'status_gangguan' as status_gangguan,
            'kategori_usia' as kategori_usia, 'resiko_malnutrisi' as resiko_malnutrisi, 'perlu_konsultasi' as perlu_konsultasi,
            'nama_diagnosis' as nama_diagnosis
            from examination_info where visit_id = '80214'")->getResultArray());
            $respirationSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            AIRWAY,
            OBJECT_STRANGE,
            OBJECT_DESC,
            ETT,
            ETT_SIZE,
            BREATHING,
            RESPIRATION_RATE,
            COUGH,
            SPO2,
            LUNG_SOUND,
            LUNG_POSITION,
            BREATHING_TROUBLE,
            O2_USAGE,
            CLEAN_BREATHING,
            CLEAN_DESC,
            EFFECTIVE_BREATHING,
            EFFECTIVE_DESC,
            GAS_TROUBLE,
            GAS_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY,
            COUGH_TYPE,
            O2_Q,
            O2_TYPE,
            BREATH_MUSCLE
            from ASSESSMENT_RESPIRATION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $respiration = $respirationSelect[0] ?? [];
            $circulationSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            TENSION_UPPER,
            TENSION_BELOW,
            CIRCULATION_DISORDER,
            OTHER_DISORDER,
            CAPILLARY_FILLING,
            NADI,
            NAFAS,
            HEART_RHYTHM,
            PACEMAKER,
            AKRAL,
            PERFUSI_DISORDER,
            PERFUSI_DESC,
            SHOCK_RISK,
            SHOCK_DESC,
            HEART_RISK,
            HEART_RISK_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_CIRCULATION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $circulation = $circulationSelect[0] ?? [];
            $neurosensorisSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            MEMORY,
            ORIENTASI,
            LPUPIL_DIAMETER,
            LPUPIL_REACTION,
            RPUPIL_DIAMETER,
            RPUPIL_REACTION,
            NEUROSENSORS,
            INJURY_RISK,
            INJURY_DESC,
            STATUS
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_NEUROSENSORIS
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $neurosensoris = $neurosensorisSelect[0] ?? [];
            $integumenSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            INTEGUMEN,
            TURGOR,
            HAIR,
            NAIL,
            WOUND,
            WOUND_DEPTH,
            BLEEDING,
            FRACTURE,
            LOCATION,
            SKIN_DISORDER,
            SKIN_DESC,
            ADI_DISORDER,
            ADI_DESC,
            MOBILIZATION_DISORDER,
            MOBILIZATION_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_INTEGUMEN
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $integumen = $integumenSelect[0] ?? [];
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/18-igd-anak.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "respiration" => $respiration,
                    "circulation" => $circulation,
                    "neurosensoris" => $neurosensoris,
                    "integumen" => $integumen
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/18-igd-anak.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function igd_dewasa($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan IGD Pasien Dewasa"; //hosnic_emr_rj_bedah
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select
            tension_upper, tension_below, temperature, NADI, NAFAS, WEIGHT, HEIGHT, format(round(WEIGHT*10000/height/height,2), '0.##') as bmi, 'respiration' as respiration,
            'lla' as lla, 'penyebab_cidera' as penyebab_cidera, 'airway' as airway, 'benda_asing' as benda_asing, 'ett' as ett,
            'breathing' as breathing, 'bunyi_paru' as bunyi_paru, 'posisi_paru' as posisi_paru, 'kesulitan_bernafas' as kesulitan_bernafas,
            'penggunaan_bantu_nafas' as penggunaan_bantu_nafas, 'menggunakan_oksigen' as menggunakan_oksigen, 'frekuensi_nafas' as frekuensi_nafas,
            'batuk' as batuk, 'bersihan_jalan_nafas' as bersihan_jalan_nafas, 'pola_nafas_efektif' as pola_nafas_efektif, 'gangguan_gas' as gangguan_gas,
            'gangguan_sirkulasi' as gangguan_sirkulasi, 'pengisian_kapiler' as pengisian_kapiler, 'denyut_nadi' as denyut_nadi, 
            'irama_jantung' as irama_jantung, 'pacemaker' as pacemaker, 'akral' as akral, 'gangguan_perfusi' as gangguan_perfusi,
            'resiko_syok' as resiko_syok, 'gangguan_penurunan' as gangguan_penurunan, 'orientasi' as orientasi, 'memori' as memori,
            'gcs' as gcs, 'gcs_e' as gcs_e, 'gcs_v' as gcs_v, 'gcs_m' as gcs_m, 'gcs_score' as gcs_score, 'ukuran_pupil_kiri' as ukuran_pupil_kiri,
            'ukuran_pupil_kanan' as ukuran_pupil_kanan, 'reaksi_pupil_kiri' as reaksi_pupil_kiri, 'reaksi_pupil_kanan' as reaksi_pupil_kanan,
            'tanda_perangsang' as tanda_perangsang, 'resiko_injury' as resiko_injury, 'integumen' as integumen, 'turgor' as turgor, 
            'rambut' as rambut, 'kuku' as kuku, 'luka' as luka, 'pendarahan' as pendarahan, 'fraktur' as fraktur, 'dislokasi' as dislokasi,
            'gangguan_integritas' as gangguan_integritas, 'resiko_infeksi' as resiko_infeksi, 'gangguan_pemenuhan' as gangguan_pemenuhan,
            'gangguan_mobilisasi' as gangguan_mobilisasi, 'skala_nyeri' as skala_nyeri, 'alat_ukur_nyeri' as alat_ukur_nyeri,
            'penjelasan' as penjelasan, 'tipe_resiko' as tipe_resiko, 'rating_scale' as rating_scale, 'luka_operasi' as luka_operasi,
            'deskripsi_nyeri' as deskripsi_nyeri, 'hipertermi' as hipertermi, 'riwayat_jatuh' as riwayat_jatuh, 'diagnosis_sekunder' as diagnosis_sekunder,
            'alat_bantu' as alat_bantu, 'infuse' as infuse, 'gaya_berjalan' as gaya_berjalan, 'status_mental' as status_mental,
            'medikasi' as medikasi, 'fall_score' as fall_score, 'pasien_operasi' as pasien_operasi, 'gangguan_makan' as gangguan_makan,
            'masalah_nutrisi' as masalah_nutrisi, 'masalah_makan' as masalah_makan, 'nutrisi_ngt' as nutrisi_ngt, 'mukosa_mulut' as mukosa_mulut,
            'fluid_intake' as fluid_intake, 'penyakit' as penyakit, 'gengguan_metabolik' as gangguan_metabolik, 'status_gangguan' as status_gangguan,
            'kategori_usia' as kategori_usia, 'resiko_malnutrisi' as resiko_malnutrisi, 'perlu_konsultasi' as perlu_konsultasi,
            'nama_diagnosis' as nama_diagnosis
            from examination_info where visit_id = '80214'")->getResultArray());
            $respirationSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            AIRWAY,
            OBJECT_STRANGE,
            OBJECT_DESC,
            ETT,
            ETT_SIZE,
            BREATHING,
            RESPIRATION_RATE,
            COUGH,
            SPO2,
            LUNG_SOUND,
            LUNG_POSITION,
            BREATHING_TROUBLE,
            O2_USAGE,
            CLEAN_BREATHING,
            CLEAN_DESC,
            EFFECTIVE_BREATHING,
            EFFECTIVE_DESC,
            GAS_TROUBLE,
            GAS_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY,
            COUGH_TYPE,
            O2_Q,
            O2_TYPE,
            BREATH_MUSCLE
            from ASSESSMENT_RESPIRATION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $respiration = $respirationSelect[0] ?? [];
            $circulationSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            TENSION_UPPER,
            TENSION_BELOW,
            CIRCULATION_DISORDER,
            OTHER_DISORDER,
            CAPILLARY_FILLING,
            NADI,
            NAFAS,
            HEART_RHYTHM,
            PACEMAKER,
            AKRAL,
            PERFUSI_DISORDER,
            PERFUSI_DESC,
            SHOCK_RISK,
            SHOCK_DESC,
            HEART_RISK,
            HEART_RISK_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_CIRCULATION
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $circulation = $circulationSelect[0] ?? [];
            $neurosensorisSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            MEMORY,
            ORIENTASI,
            LPUPIL_DIAMETER,
            LPUPIL_REACTION,
            RPUPIL_DIAMETER,
            RPUPIL_REACTION,
            NEUROSENSORS,
            INJURY_RISK,
            INJURY_DESC,
            STATUS
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_NEUROSENSORIS
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $neurosensoris = $neurosensorisSelect[0] ?? [];
            $integumenSelect = $this->lowerKey($db->query("select
            ORG_UNIT_CODE,
            VISIT_ID,
            TRANS_ID,
            BODY_ID,
            DOCUMENT_ID,
            NO_REGISTRATION,
            EXAMINATION_DATE,
            P_TYPE,
            INTEGUMEN,
            TURGOR,
            HAIR,
            NAIL,
            WOUND,
            WOUND_DEPTH,
            BLEEDING,
            FRACTURE,
            LOCATION,
            SKIN_DISORDER,
            SKIN_DESC,
            ADI_DISORDER,
            ADI_DESC,
            MOBILIZATION_DISORDER,
            MOBILIZATION_DESC,
            STATUS,
            MODIFIED_DATE,
            MODIFIED_BY
            from ASSESSMENT_INTEGUMEN
            where visit_id = '{$visit['visit_id']}'
            order by examination_date")->getResultArray());
            $integumen = $integumenSelect[0] ?? [];
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/19-igd-dewasa.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0],
                    "respiration" => $respiration,
                    "circulation" => $circulation,
                    "neurosensoris" => $neurosensoris,
                    "integumen" => $integumen
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/19-igd-dewasa.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function monitoring_nyeri($visit, $vactination_id = null)
    {
        $title = "Monitoring Nyeri";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $query = "
            SELECT 
            apm.BODY_ID,
            apm.EXAMINATION_DATE as TGL,
            apm.DESCRIPTION as ASSESMENT,
            apm.TOTAL_SCORE,
            api.INTERVENSI_DATE,
            api.INTERVENSI,
            api.RUTE,
            api.REASSESSMENT,
            api.PETUGAS,
            case when api.REASSESSMENT_DATE < '2000-01-01' then examination_date else api.REASSESSMENT_DATE end as REASSESSMENT_DATE,
            apd.value_desc AS ALAT_UKUR
            FROM ASSESSMENT_PAIN_MONITORING apm
            INNER JOIN ASSESSMENT_PAIN_DETAIL apd ON apm.BODY_ID = apd.BODY_ID
            INNER JOIN ASSESSMENT_PAIN_INTERVENSI api ON apm.BODY_ID = api.BODY_ID
            ";
            if (is_null($vactination_id)) {
                $query .= "
            WHERE apm.VISIT_ID = '{$visit['visit_id']}'";
            } else {
                $query .= "
            WHERE apm.VISIT_ID = '{$visit['visit_id']}' AND apm.BODY_ID = '$vactination_id'";
            }
            $query .= "
            and apd.parameter_id = '01' 
            group by 
            apm.BODY_ID,
            apm.EXAMINATION_DATE, 
            apm.DESCRIPTION,
            apm.TOTAL_SCORE,
            api.INTERVENSI_DATE,
            api.INTERVENSI,
            api.RUTE,
            api.REASSESSMENT,
            api.PETUGAS,
            apd.value_desc,
            api.REASSESSMENT_DATE";
            $select = $this->lowerKey($db->query($query)->getResultArray());

            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            $selectinfo = $visit;
            // $selectinfo = $this->query_template_info($db, $visit['visit_id'], '20240614173754692');
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/20-monitoring-nyeri.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization,
                    "info" => $selectinfo
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/20-monitoring-nyeri.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization,
                    "info" => $selectinfo
                ]);
            }
        }
    }
    public function resiko_jatuh($visit, $vactination_id = null)
    {
        $title = "Monitoring Resiko Jatuh";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $query = "
            SELECT ASSESSMENT_FALL_RISK.BODY_ID, EMPLOYEE_ALL.DESCRIPTION AS DOCTOR, ASSESSMENT_PARAMETER_TYPE.P_DESCRIPTION AS ALAT_UKUR, ASSESSMENT_FALL_RISK.DESCRIPTION AS INTERVENSI, ASSESSMENT_FALL_RISK.EXAMINATION_DATE AS TANGGAL,
            SUM(ASSESSMENT_FALL_RISK_DETAIL.VALUE_SCORE) AS total_value_score
            FROM ASSESSMENT_FALL_RISK_DETAIL
            INNER JOIN ASSESSMENT_FALL_RISK ON ASSESSMENT_FALL_RISK_DETAIL.BODY_ID = ASSESSMENT_FALL_RISK.BODY_ID
            INNER JOIN ASSESSMENT_PARAMETER_TYPE ON ASSESSMENT_FALL_RISK_DETAIL.P_TYPE = ASSESSMENT_PARAMETER_TYPE.P_TYPE
            INNER JOIN EMPLOYEE_ALL ON ASSESSMENT_FALL_RISK.EMPLOYEE_ID = EMPLOYEE_ALL.EMPLOYEE_ID
            WHERE ASSESSMENT_FALL_RISK_DETAIL.VISIT_ID = '{$visit['visit_id']}' 
            ";
            if (!is_null($vactination_id)) {
                $query .= "and ASSESSMENT_FALL_RISK_DETAIL.body_id = '$vactination_id'";
            }
            $query .= "group by ASSESSMENT_FALL_RISK.BODY_ID, EMPLOYEE_ALL.DESCRIPTION , ASSESSMENT_PARAMETER_TYPE.P_DESCRIPTION, ASSESSMENT_FALL_RISK.DESCRIPTION, ASSESSMENT_FALL_RISK.EXAMINATION_DATE";
            $select = $this->lowerKey($db->query($query)->getResultArray());

            // dd($select);
            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());
            $selectinfo = $visit;

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/21-resiko-jatuh.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization,
                    "info" => $selectinfo
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/21-resiko-jatuh.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization,
                    "info" => $selectinfo
                ]);
            }
        }
    }
    public function persetujuan_umum($visit, $vactination_id = null)
    {
        $title = "Persetujuan Umum";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/22-persetujuan-umum.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/22-persetujuan-umum.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function ringkasan($visit, $vactination_id = null)
    {
        $title = "Ringkasan Masuk Keluar";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $riwayat = $this->lowerKey($db->query("SELECT 'riwayat_imunisasi' as riwayat_imunisasi from examination_info where visit_id='" . $visit['visit_id'] . "'")->getResultArray());
            $status = $this->lowerKey($db->query("SELECT KELUAR_ID, CARA_KELUAR from CARA_KELUAR where KELUAR_ID='" . $visit['keluar_id'] . "' ")->getResultArray());
            $oprasi = $this->lowerKey($db->query("SELECT operasi = CAST(STUFF((SELECT ',' + tt.TARIF_NAME
                                                                        FROM PASIEN_operasi po
                                                                        JOIN treat_tarif tt ON tt.TARIF_ID = po.tarif_id
                                                                        WHERE po.visit_id = pv.visit_id
                                                                        FOR XML PATH('')), 1, 1, '') AS VARCHAR(4000))
                                                                FROM pasien_visitation pv WHERE 
                                                                    pv.NO_REGISTRATION = '" . $visit['no_registration'] . "' 
                                                                    AND pv.visit_id = '" . $visit['visit_id'] . "';")->getResultArray());
            $statusPulang = $this->lowerKey($db->query("SELECT pd.RENCANATL, it.NAMA
                                                                        FROM PASIEN_DIAGNOSA pd
                                                                        LEFT OUTER JOIN INASIS_GET_TINDAKLANJUT it ON pd.rencanaTL = it.KODE where pd.VISIT_ID ='" . $visit['keluar_id'] . "' ")->getResultArray());
            $diagnosis = $this->lowerKey($db->query("select PASIEN_DIAGNOSA_ID, DIAGNOSA_ID, DIAGNOSA_NAME, DIAG_CAT from PASIEN_DIAGNOSAS where pasien_diagnosa_id = '20240612091917506' ORDER BY diag_cat;")->getResultArray());
            $procedure = $this->lowerKey($db->query("select PASIEN_DIAGNOSA_ID, DIAGNOSA_ID, DIAGNOSA_NAME from PASIEN_PROCEDURES where pasien_diagnosa_id = '20240612091917506'")->getResultArray());
            $pasien = $this->lowerKey($db->query("SELECT 
                                            p.EMPLOYEE_ID AS pekerjaan,
                                            p.NATION_ID AS warganegara,
                                            p.EDUCATION_TYPE_CODE AS pendidikan,
                                            p.MARITALSTATUSID AS pernikahan,
                                            p.blood_type_id AS gol,
                                            (
                                                SELECT VALUE_DESC
                                                FROM ASSESSMENT_PARAMETER_VALUE
                                                WHERE VALUE_SCORE = p.EMPLOYEE_ID
                                                AND PARAMETER_ID = '05'
                                                AND P_TYPE = 'ASES037'
                                            ) AS pekerjaan_desc,
                                            (
                                                SELECT VALUE_DESC
                                                FROM ASSESSMENT_PARAMETER_VALUE
                                                WHERE VALUE_SCORE = p.NATION_ID
                                                AND PARAMETER_ID = '04'
                                                AND P_TYPE = 'ASES037'
                                            ) AS warganegara_desc,
                                            (
                                                SELECT VALUE_DESC
                                                FROM ASSESSMENT_PARAMETER_VALUE
                                                WHERE VALUE_SCORE = p.EDUCATION_TYPE_CODE
                                                AND PARAMETER_ID = '03'
                                                AND P_TYPE = 'ASES037'
                                            ) AS pendidikan_desc,
                                            (
                                                SELECT VALUE_DESC
                                                FROM ASSESSMENT_PARAMETER_VALUE
                                                WHERE VALUE_SCORE = p.MARITALSTATUSID
                                                AND PARAMETER_ID = '01'
                                                AND P_TYPE = 'ASES037'
                                            ) AS pernikahan_desc
                                        FROM PASIEN p
                                        WHERE p.ORG_UNIT_CODE = '" . $visit['org_unit_code'] . "'AND p.NO_REGISTRATION ='" . $visit['no_registration'] . "'")->getResultArray());

            $kopprintData = $this->kopprint();




            if (isset($visit)) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/23-ringkasan-masuk-keluar.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "pasien" => $pasien[0],
                    "diag" => $diagnosis,
                    'prod' => $procedure,
                    'kop' => $kopprintData[0],
                    'kondisi' => $status[0],
                    'statusP' => !$statusPulang ? $statusPulang : $statusPulang[0],
                    'tindakan' => $oprasi,
                    'riwayat' => $riwayat
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/23-ringkasan-masuk-keluar.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "pasien" => $pasien[0],
                    'kop' => $kopprintData[0]
                ]);
            }
        }
    }
    public function transfer_internal($visit, $aValue, $vactination_id = null)
    {
        $title = "Transfer Pasien Internal";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $kopprintData = $this->kopprint();
            $select = $this->lowerKey($db->query("select CLINIC_ID, CLINC_ID_TO,visit_id,body_id, document_id, document_id2 from pasien_transfer where body_id='202406070348269862WA'")->getResultArray());
            $document = $this->lowerKey($db->query("select * from EXAMINATION_INFO where body_id='" . $select[0]['document_id'] . "'")->getResultArray());
            $document2 = $this->lowerKey($db->query("select * from EXAMINATION_INFO where body_id='" . $select[0]['document_id2'] . "'")->getResultArray());
            $subyektif = $this->lowerKey($db->query("select 
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
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID
            LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE,
            pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '202405031057300447D03'
            and PD.VISIT_ID ='" . $visit['visit_id'] . "' -- 
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
            gcs.GCS_DESC,

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

                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/25-transfer-pasien-internal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'doc' => $document[0],
                    'doc2' => $document2[0],
                    'sub' => $subyektif !== null  ? $subyektif : $subyektif[0],
                    'val' => $select !== null  ? $select : $select[0],
                    'kop' => $kopprintData[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/25-transfer-pasien-internal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'doc' => $document[0],
                    'doc2' => $document2[0],
                    'sub' => $subyektif !== null  ? $subyektif : $subyektif[0],
                    'kop' => $kopprintData[0]
                ]);
            }
        }
    }

    public function implementasi($visit, $vactination_id = null)
    {
        $title = "Implementasi Asuhan Keperawatan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select treat_date as tanggal, TREATMENT as tindakan, DESCRIPTION as respons, doctor as nama 
                                                            FROM TREATMENT_PERAWAT where TARIF_TYPE = 98 and visit_id ='{$visit['visit_id']}'")->getResultArray());

            $kopprintData = $this->kopprint();

            if (isset($select)) {

                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/26-implemntasi-asuhan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'data' => $select,
                    'kop' => $kopprintData[0]


                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/26-implemntasi-asuhan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData[0]


                ]);
            }
        }
    }

    public function asuhan_kebidanan($visit, $vactination_id = null)
    {
        $title = "Asuhan Kebidanan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select treat_date as tanggal, TREATMENT as tindakan, DESCRIPTION as respons, doctor as nama 
                                                            FROM TREATMENT_PERAWAT where TARIF_TYPE = 10 and visit_id ='{$visit['visit_id']}'")->getResultArray());
            $kopprintData = $this->kopprint();

            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/7-asuhan-kebidanan.php", [
                "visit" => $visit,
                'title' => $title,
                "data" => $select,
                'kop' => $kopprintData[0]

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
