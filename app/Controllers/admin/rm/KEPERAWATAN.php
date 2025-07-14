<?php

namespace App\Controllers\Admin\rm;

use App\Controllers\Admin\Familyman;
use App\Models\Assessment\PasienDiagnosaPerawatModel;
use App\Models\Assessment\PasienDiagnosasPerawatModel;
use App\Models\BabyModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\FamilyManModel;
use App\Models\PersalinanModel;
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
            // return json_encode($vactination_id);
            $db = db_connect();
            $select = $this->lowerKey($db->query("
                SELECT
					ei.VISIT_ID,
                    ei.ANAMNASE as anamnesis,
                    ed.vs_status_id,
                    ei.DESCRIPTION AS riwayat_penyakit_sekarang,
                    gcs.GCS_E,
                    gcs.GCS_m,
                    gcs.GCS_V, 
                    gcs.GCS_SCORE as gcs,
                    gcs.GCS_DESC,
                    ei.isrj,
                    isnull((select top(1) case when total_score = 5 then 'ATS V' 
                    when total_score = 4 then 'ATS IV'
                    when total_score = 3 then 'ATS III'
                    when TOTAL_SCORE = 2 then 'ATS II'
                    when total_score = 1 then 'ATS I' end
                    from ASSESSMENT_indicator
                    where DOCUMENT_ID = ei.body_id order by EXAMINATION_DATE desc) ,'') as ats_tipe,
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
                    MAX(CASE WHEN EDU.INFORMATION_RECEIVER = '1' THEN 'Penerima Pasien' + ' materi `edukasi `: '   + edu.education_material
                    else 'Kerabat Pasien dengan nama : ' + edu.family_name + ' materi edukasi : ' + edu.education_material  end ) as edukasi_pasien,
                    ed.WEIGHT as berat,
                    ed.HEIGHT as tinggi,
                    ed.TENSION_UPPER as tensi_atas,
                    ed.TENSION_BELOW as tensi_bawah,
                    ed.nadi,
                    ed.TEMPERATURE AS Suhu,
                    ed.NAFAS as respiration,
                    ed.SATURASI AS SPO2,
                    CASE 
						WHEN Ed.HEIGHT IS NOT NULL AND Ed.HEIGHT > 0 
						THEN Ed.WEIGHT / ( (CAST(Ed.HEIGHT AS DECIMAL(5,2)) / CAST(100 AS DECIMAL(5,2))) * (CAST(Ed.HEIGHT AS DECIMAL(5,2)) / CAST(100 AS DECIMAL(5,2))) )
						ELSE NULL -- or 0, or another appropriate value
					END AS IMT,
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
                    where DOCUMENT_ID = ei.body_id order by EXAMINATION_DATE desc) ,'Tidak ada Risiko') as FALL_SCORE,
					isnull((select top(1) ASSESSMENT_FALL_RISK.DESCRIPTION from ASSESSMENT_FALL_RISK
                    where ASSESSMENT_FALL_RISK.DOCUMENT_ID = ed.DOCUMENT_ID order by EXAMINATION_DATE desc) ,'') as FALL_DESC,
                    isnull((select top(1) '['+ cast(av.value_score as varchar(500)) +'] ' + av.VALUE_DESC as total_score from ASSESSMENT_PAIN_MONITORING apm
                    inner join ASSESSMENT_PAIN_DETAIL apd on apm.BODY_ID = apd.BODY_ID
                    inner join ASSESSMENT_PARAMETER_VALUE  av on apd.VALUE_ID = av.VALUE_ID
                    where 
                    apd.PARAMETER_ID = '05' and
                    document_id = ei.body_id) ,'') as PAIN_SCORE,
                    isnull(ea.fullname, petugas) as petugas_name
                FROM EXAMINATION_INFO ei
					left outer join EXAMINATION_DETAIL ed ON ei.body_id = ed.DOCUMENT_ID
                    left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = ed.NO_REGISTRATION
                    left outer join ASSESSMENT_GCS gcs on ei.body_id = gcs.DOCUMENT_ID
                    left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on ei.body_id = EDU.DOCUMENT_ID
                    left outer join ASSESSMENT_REPRODUCTION arp on ei.body_id = arp.DOCUMENT_ID
                    LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
                    left outer join users u on u.username = ei.petugas_id
                    left outer join employee_all ea on ea.employee_id = u.employee_id  
                WHERE ei.BODY_ID = '" . $vactination_id . "'
                group by 
                ei.body_id,
				ei.VISIT_ID,
                    ei.ANAMNASE, 
                    ei.DESCRIPTION,
                    gcs.GCS_E,
                    gcs.GCS_m,
                    gcs.GCS_V, 
                    gcs.GCS_SCORE,
                    gcs.GCS_DESC,
                    ed.WEIGHT,
                    ed.HEIGHT,
                    ed.TENSION_UPPER,
                    ed.TENSION_BELOW,
                    ed.nadi,
                    ed.TEMPERATURE,
                    ed.NAFAS,
                    ed.SATURASI,
					ed.DOCUMENT_ID,
                    ei.PASIEN_DIAGNOSA_ID,
                    ed.vs_status_id,
                    ei.isrj,
                    ea.fullname,
                    ei.petugas

            ")->getRowArray() ?? []);

            // dd($select);

            $title = "Asesmen Keperawatan ";
            if ($select['isrj'] != 1) {
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
            )->getResultArray() ?? []);
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
                    ASSESSMENT_APGAR_DETAIL.BODY_ID = '$vactination_id'
                    AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '{$visit['visit_id']}'
                    AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                GROUP BY 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
            )->getResultArray() ?? []);

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
            )->getFirstRow() ?? []);

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
            )->getResultArray() ?? []);

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
            )->getResultArray() ?? []);

            $neurosensoris = $this->query_assessment_column_style('ASSESSMENT_NEUROSENSORIS', 'ASES038', $visit['visit_id'], $vactination_id);
            // dd($neurosensoris);

            $circulation = $this->query_assessment_column_style('ASSESSMENT_CIRCULATION', 'ASES039', $visit['visit_id'], $vactination_id);

            $pencernaan = $this->query_assessment_column_style('ASSESSMENT_DIGESTION', 'ASES040', $visit['visit_id'], $vactination_id);

            $pernapasan = $this->query_assessment_column_style('ASSESSMENT_RESPIRATION', 'ASES041', $visit['visit_id'], $vactination_id);
            // return json_encode($pernapasan);

            $perkemihan = $this->query_assessment_column_style('ASSESSMENT_BLADDER', 'ASES042', $visit['visit_id'], $vactination_id);

            $reproduksi = $this->query_assessment_column_style('ASSESSMENT_REPRODUCTION', 'ASES043', $visit['visit_id'], $vactination_id);

            $thtdanmata = $this->query_assessment_column_style('ASSESSMENT_VISION_HEARING', 'ASES044', $visit['visit_id'], $vactination_id);

            $tidurdanistirahat = $this->query_assessment_column_style('ASSESSMENT_SLEEPING', 'ASES046', $visit['visit_id'], $vactination_id);

            $dekubitus = $this->query_assessment_column_style('ASSESSMENT_DEKUBITUS', 'ASES047', $visit['visit_id'], $vactination_id);

            $integumen = $this->query_assessment_column_style('ASSESSMENT_INTEGUMEN', 'ASES036', $visit['visit_id'], $vactination_id);

            $sosialekonomi = $this->query_assessment_column_style('ASSESSMENT_SOCEC', 'ASES037', $visit['visit_id'], $vactination_id);

            $nutrition = $this->query_assessment_column_style('ASSESSMENT_SCREENING_NUTRITION', 'GIZI001', $visit['visit_id'], $vactination_id);
            $nutrition = $db->query("select case age_cat when 21 then 'Anak 0 - 24 Bulan'
                                            when 22 then 'Anak 24 - 60 Bulan'
                                            when 23 then 'Anak 5 - 18 tahun'
                                            when 24 then 'Dewasa'
                                            else '' end as age_cat, weight, height, imt,
                                            (select top(1) value_desc from ASSESSMENT_PARAMETER_VALUE av where av.p_type = 'GIZI009' and PARAMETER_ID = '01' and VALUE_SCORE = asn.step1_score_imt) as step1_score_imt,  --GIZI009 01
                                            (select top(1) value_desc from ASSESSMENT_PARAMETER_VALUE av where av.p_type = 'GIZI009' and PARAMETER_ID = '02' and VALUE_SCORE = asn.step2_score_wightloss) as step2_score_wightloss, --GIZI009 02
                                            (select top(1) value_desc from ASSESSMENT_PARAMETER_VALUE av where av.p_type = 'GIZI009' and PARAMETER_ID = '03' and VALUE_SCORE = asn.step3_score_acute_disease) as step3_score_acute_disease, --GIZI009 03
                                            step4_score_malnutrition,
                                            case score_desc when 21 then 'Anak 0 - 24 Bulan'
                                            when 22 then 'Anak 24 - 60 Bulan'
                                            when 22 then 'Anak 5 - 18 tahun'
                                            else '' end as step5
                                            from 
                                            ASSESSMENT_SCREENING_NUTRITION  asn
                                            where document_id = '$vactination_id';")->getRow(0, 'array');
            if (is_null($nutrition)) {
                $nutrition = [];
            }
            // dd($nutrition);

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
            )->getRowArray() ?? []);

            $diag = $this->lowerKey($db->query(
                "
                select pds.diagnosan_id, pds.diag_notes from PASIEN_DIAGNOSA_NURSE pdn
                inner join pasien_diagnosas_nurse pds on pdn.BODY_ID = pds.BODY_ID
                where document_id = '$vactination_id'                    
                "
            )->getResultArray() ?? []);


            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);

            $sign = $this->checkSignDocs($vactination_id, 3);

            // return json_encode($vactination_id);
            $selectinfo = $visit;

            // return json_encode($reproduksi);


            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
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
                "nutrition" => $nutrition,
                "diag" => $diag,
                "sign" => $sign
            ]);
        }
    }
    public function cetak_kebidanan($visit, $vactination_id = null, $titlekeperawatan = null)
    {
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            // return json_encode($vactination_id);
            $db = db_connect();
            $select = $this->lowerKey($db->query("
                SELECT
					ei.VISIT_ID,
                    ei.examination_date,
                    ei.ANAMNASE as anamnesis,
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
                    max(case when PH.value_id = 'G0090601'  then histories else null end ) as haid,
                    max(case when PH.value_id = 'G0090602'  then histories else null end) as menarche,
                    max(case when PH.value_id = 'G0090603'  then histories else null end ) as siklus,
                    max(case when PH.value_id = 'G0090604'  then histories else null end ) as lama,
                    max(case when PH.value_id = 'G0090605'  then histories else null end ) as jumlah,
                    max(case when PH.value_id = 'G0090606'  then histories else null end ) as hpht,
                    max(case when PH.value_id = 'G0090607'  then histories else null end ) as hpl,
                    max(case when PH.value_id = 'G0090608'  then histories else null end ) as keluhan,
                    MAX(CASE WHEN EDU.INFORMATION_RECEIVER = '1' THEN 'Penerima Pasien' + ' materi `edukasi `: '   + edu.education_material
                    else 'Kerabat Pasien dengan nama : ' + edu.family_name + ' materi edukasi : ' + edu.education_material  end ) as edukasi_pasien,
                    isnull((select top(1) total_score from ASSESSMENT_FALL_RISK
                    where ASSESSMENT_FALL_RISK.DOCUMENT_ID = ei.body_id order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
					isnull((select top(1) ASSESSMENT_FALL_RISK.DESCRIPTION from ASSESSMENT_FALL_RISK
                    where ASSESSMENT_FALL_RISK.DOCUMENT_ID = ei.body_id order by EXAMINATION_DATE desc) ,'') as FALL_DESC,
                    isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
                    where ASSESSMENT_PAIN_MONITORING.DOCUMENT_ID = ei.body_id order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
					isnull((select top(1) ASSESSMENT_PAIN_MONITORING.DESCRIPTION from ASSESSMENT_PAIN_MONITORING
                    where ASSESSMENT_PAIN_MONITORING.DOCUMENT_ID = ei.body_id order by EXAMINATION_DATE desc) ,'') as FALL_DESC,
                    isnull(ea.fullname, ei.modified_by) as dokter,
                    ei.modified_by,
                    ei.teraphy_desc as asesmen,
                    ei.instruction
                FROM EXAMINATION_INFO ei
                    left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = ei.NO_REGISTRATION
                    left outer join ASSESSMENT_GCS gcs on ei.body_id = gcs.DOCUMENT_ID
                    left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on ei.body_id = EDU.DOCUMENT_ID
                    left outer join ASSESSMENT_REPRODUCTION arp on ei.body_id = arp.DOCUMENT_ID
                    left outer join ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
                    left outer join users u on u.username = ei.modified_by
                    left outer join employee_all ea on ea.employee_id = u.employee_id
                WHERE ei.BODY_ID = '" . $vactination_id . "' 
                group by 
                ei.body_id,
				ei.VISIT_ID,
                    ei.ANAMNASE, 
                    ei.DESCRIPTION,
                    gcs.GCS_E,
                    gcs.GCS_m,
                    gcs.GCS_V, 
                    gcs.GCS_SCORE,
                    gcs.GCS_DESC,
                    ei.PASIEN_DIAGNOSA_ID,
                    ei.isrj,
                    ea.fullname,
                    ei.modified_by,
                    ea.fullname,
                    ei.teraphy_desc,
                    ei.instruction,
                    ei.examination_date

        ")->getRowArray() ?? []);

            $selectDetail = $this->lowerKey($db->query("select
            ed.examination_date,
            ed.tfu,
            ed.child_position,
            ed.heart_sound,
            ed.oedema,
            ed.urine,
            ed.tension_upper,
            ed.tension_below,
            ed.weight
            from examination_detail ed where ed.visit_id = ? and ed.body_id = ? order by examination_Date desc ", [$visit['visit_id'], $vactination_id])->getResultArray());

            $pregnancy = $this->lowerKey($db->query("select * from birth_history where no_registration = '" . $visit['no_registration'] . "'")->getResultArray());

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

            // return json_encode($rad);

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
                        and SOLD_STATUS IN (1,5,6,7) 
                            group by description ,isnull(description2,'')
                        FOR XML PATH (''))
                        ,1, 2, '') terapi
                        from ORGANIZATIONUNIT ;
                        ", [$visit['visit_id']])->getRowArray();

            // return json_encode($select);

            $title = "Asesmen Kebidanan ";
            if (!is_null($visit['class_room_id']) && $visit['class_room_id'] != '') {
                $title .= 'Rawat Inap ';
            } else {
                $title .= 'Rawat Jalan ';
            }
            if ($titlekeperawatan != null) {
                $title .= $titlekeperawatan;
            }


            $sosialekonomi = $this->lowerKey($db->query($this->query_assessment('ASSESSMENT_SOCEC', 'ASES037', $visit['visit_id'], $vactination_id))->getResultArray() ?? []);
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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);

            $sign = $this->checkSignDocs($vactination_id, 3);
            // dd($sign);
            $selectinfo = $visit;
            $no_registration = $visit['no_registration'];
            $suami = $db->query("select top(1) fullname, date_of_birth, nama_agama, et.name_of_edu_type, j.name_of_job, address, ms.name_of_maritalstatus,
                                        f.modified_date
                                        from FAMILY f
                                        left outer join AGAMA a on a.KODE_AGAMA = f.KODE_AGAMA
                                        left outer join EDUCATION_TYPE et on et.EDUCATION_TYPE_CODE = f.EDUCATION_TYPE_CODE
                                        left outer join JOB_CATEGORY j on j.JOB_ID = f.JOB_ID
                                        left outer join MARITAL_STATUS ms on ms.MARITALSTATUSID = f.MARITALSTATUSID
                                        where NO_REGISTRATION = '$no_registration'
                                        and family_status_id = 11
                                        order by MODIFIED_BY desc")->getFirstRow('array');
            $istri = $db->query("select top(1) name_of_pasien, date_of_birth, nama_agama, et.name_of_edu_type, j.name_of_job, contact_address, ms.name_of_maritalstatus,
                                        f.modified_date
                                        from PASIEN f
                                        left outer join AGAMA a on a.KODE_AGAMA = f.KODE_AGAMA
                                        left outer join EDUCATION_TYPE et on et.EDUCATION_TYPE_CODE = f.EDUCATION_TYPE_CODE
                                        left outer join JOB_CATEGORY j on j.JOB_ID = f.JOB_ID
                                        left outer join MARITAL_STATUS ms on ms.MARITALSTATUSID = f.MARITALSTATUSID
                                        where NO_REGISTRATION = '$no_registration'
                                        order by MODIFIED_BY desc")->getFirstRow('array');

            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/cetak_kebidanan.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "detail" => $selectDetail,
                "pregnancy" => $pregnancy,
                "sosialekonomi" => $sosialekonomi,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "sign" => $sign,
                "suami" => $suami,
                "istri" => $istri
            ]);
        }
    }
    public function laporan_persalinan($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $data = $db->query("select examination_date from assessment_obstetric where VISIT_ID = '" . $visit['visit_id'] . "' and body_id = '$vactination_id'")->getRow(0, "array");
            $ikhtisar = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN003', $visit['visit_id'], $vactination_id);
            $laporanPersalinan = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN002', $visit['visit_id'], $vactination_id);
            $perdarahan = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN004', $visit['visit_id'], $vactination_id);
            $placenta = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN005', $visit['visit_id'], $vactination_id);

            // dd($ikhtisar);
            $examModel = new ExaminationDetailModel();

            $babyModel = new BabyModel();
            $baby = $babyModel->select("
                org_unit_code,
                visit_id,
                baby_id,
                babyno,
                inspection_date,
                baby_ke,
                no_registration,
                date_of_birth,
                partus,
                indication,
                birth,
                birth_con,
                gender,
                resusitasi,
                movement,
                skincolor,
                turgor,
                tonus,
                sound,
                mororeflex,
                suckingreflex,
                holding,
                necktone,
                headcircumference,
                chestcircumference,
                valid_date,
                valid_user,
                valid_pasien
                ")->where("document_id", $vactination_id)->findAll();

            if (count($baby) > 0) {
                $whereIn = '';
                foreach ($baby as $key => $value) {
                    $whereIn .= "'" . $value['baby_id'] . "',";
                }
                $whereIn = substr($whereIn, 0, -1);

                $exambaby = $examModel->select("*")
                    ->where("document_id in ($whereIn)")->findAll();
                $exambaby = $this->lowerKey($exambaby);

                $apgar = $this->lowerKey($db->query("select * from assessment_indicator where document_id in ($whereIn) and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());
                if (count($apgar) > 0) {
                    $whereIn = '';
                    foreach ($apgar as $key => $value) {
                        $whereIn .= "'" . $value['body_id'] . "',";
                    }
                    $whereIn = substr($whereIn, 0, -1);
                }
                $apgarWaktu = $this->lowerKey($db->query(
                    "
                   SELECT * FROM ASSESSMENT_PARAMETER_type WHERE p_type in ('ASES032','ASES033', 'ASES034')
                    "
                )->getResultArray() ?? []);
                $apgarData = $this->lowerKey($db->query(
                    "
                   SELECT 
                        BODY_ID,
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
                        ASSESSMENT_APGAR_DETAIL.body_id in ($whereIn)
                        AND ASSESSMENT_APGAR_DETAIL.VISIT_ID = '{$visit['visit_id']}'
                        AND ASSESSMENT_PARAMETER.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                    GROUP BY 
                        BODY_ID,ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER.PARAMETER_ID"
                )->getResultArray() ?? []);
            }

            $selectinfo = $visit;
            $title = "Laporan Persalinan";
            $val = [];
            $sign = $this->checkSignDocs($vactination_id, 12);
            // dd($baby);
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);
            return view("admin/patient/profilemodul/formrm/rm/keperawatan/laporan_persalinan.php", [
                "visit" => $visit,
                "title" => $title,
                "info" => $selectinfo,
                "ikhtisar" => $ikhtisar,
                "laporanPersalinan" => $laporanPersalinan,
                "perdarahan" => $perdarahan,
                "organization" => $selectorganization,
                "placenta" => $placenta,
                "sign" => $sign,
                "apgarWaktu" => @$apgarWaktu ?? [],
                "apgarData" => @$apgarData ?? [],
                "apgar" => @$apgar ?? [],
                'baby' => @$baby,
                'exambaby' => @$exambaby,
                "val" => $data
            ]);
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
        $title = "Catatan Perkembangan Pasien Terintegrasi RI";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);

            // return json_encode($visit);

            $class_room_id = $visit['class_room_id'];

            if (is_null($class_room_id)) {
                $where = "";
            } else {
                $where = " and ei.account_id
				 not in ('1', '2')";
            }
            $db = db_connect();
            $select = $this->lowerKey($db->query(
                "
                select 
                case ei.account_id when 1 then 'Asesmen Medis'
                when 2 then 'Asesmen Keperawatan'
                when 3 then 'CPPT SOAP'
                when 4 then 'CPPT SBAR'
                when 6 then 'CPPT Gizi' end as dokumen,
                ei.account_id,
                convert(varchar, ei.examination_date, 100) as examination_date ,
                case when ei.petugas_type = '11' then 'D'
                when ei.petugas_type = '13' then 'P'
                when ea2.OBJECT_CATEGORY_ID = '21' then 'P'
                when ea2.OBJECT_CATEGORY_ID = '22' then 'Far'
                when ea2.OBJECT_CATEGORY_ID = '23' then 'B'
                    when ea2.OBJECT_CATEGORY_ID = '24' then 'G'
                    when ea2.OBJECT_CATEGORY_ID = '25' then 'Fis'
                    else '' end as kode_ppa,
                    case when ea2.FULLNAME is null then ed.modified_by else ea2.fullname end as nama_ppa ,
                    ei.ANAMNASE as Subyectif,
                    'BB : ' + cast(isnull(WEIGHT, 0.0) as varchar(10))  + 'Kg , ' +'TB : ' + cast(isnull(HEIGHT, 0.0) as varchar(10)) + ' cm , ' +
                'Tensi : '+ cast(isnull(TENSION_UPPER, 0.0) as varchar(10)) + ' / ' + cast(isnull(TENSION_BELOW, 0.0) as varchar(10)) + ' mmHg , ' + 
                'Nadi : ' + cast(isnull(nadi, 0.0) as varchar(10)) + ' /mnt , ' + 'RR : ' + cast(isnull(NAFAS, 0.0) as varchar(10)) + ' /mnt , ' + ' SpO2 : ' + 
                cast(isnull(saturasi, 0.0) as varchar(10)) + ' % ' 
                + ' Keadaan Umum : ' + isnull(ei.ALO_ANAMNASE, '')  as obyektif,
                    ei.teraphy_desc as asesmen,
                    ei.instruction as  planning,
                    ed.examination_date as tanggal_dibuat,
                    ei.valid_date as tanggal_konfirm,
                    case when ei.valid_user is null or ei.valid_user = '' then '' else isnull(ea.fullname, ed.modified_by) end as konfirm_oleh

                from 
                EXAMINATION_INFO ei
                left join examination_detail ed on ed.body_id = ei.body_id
                left outer join employee_all ea on ei.employee_id = ea.employee_id
                left outer join users u on ei.modified_by = u.username
                left outer join employee_all ea2 on u.employee_id = ea2.employee_id
                where
                ei.visit_id  = '" . $visit['visit_id'] . "'
                and ei.NO_REGISTRATION = '" . $visit['no_registration'] . "'
                $where
                order by ei.examination_date desc
            "
            )->getResultArray() ?? []);

            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);
            $selectinfo = $visit;
            // $selectinfo = $this->query_template_info($db, $visit['visit_id'], '20240614173754692');
            // dd($select);

            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo
            ]);
            if (isset($select[0])) {
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization,
                    "info" => $selectinfo
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
                select 
                case ei.account_id when '1' then 'Asesmen Medis'
                when '2' then 'Asesmen Keperawatan'
                when '3' then 'CPPT SOAP'
                when '4' then 'CPPT SBAR'
                when '6' then 'CPPT Gizi' end as dokumen,
                ei.account_id,
                convert(varchar, ei.examination_date, 100) as examination_date ,
                case when ea2.specialist_type_id = '20' then 'D'
                when ea2.OBJECT_CATEGORY_ID = '21' then 'P'
                when ea2.OBJECT_CATEGORY_ID = '22' then 'Far'
                when ea2.OBJECT_CATEGORY_ID = '23' then 'B'
                    when ea2.OBJECT_CATEGORY_ID = '24' then 'G'
                    when ea2.OBJECT_CATEGORY_ID = '25' then 'Fis'
                    else '' end as kode_ppa,
                    case when ea2.FULLNAME is null then ed.modified_by else ea2.fullname end as nama_ppa ,
                    ei.ANAMNASE as Subyectif,
                    'BB : ' + cast(isnull(WEIGHT, 0.0) as varchar(10))  + 'Kg , ' +'TB : ' + cast(isnull(HEIGHT, 0.0) as varchar(10)) + ' cm , ' +
                'Tensi : '+ cast(isnull(TENSION_UPPER, 0.0) as varchar(10)) + ' / ' + cast(isnull(TENSION_BELOW, 0.0) as varchar(10)) + ' mmHg , ' + 
                'Nadi : ' + cast(isnull(nadi, 0.0) as varchar(10)) + ' /mnt , ' + 'RR : ' + cast(isnull(NAFAS, 0.0) as varchar(10)) + ' /mnt , ' + ' SpO2 : ' + 
                cast(isnull(saturasi, 0.0) as varchar(10)) + ' % ' 
                + ' Keadaan Umum : ' + isnull(ei.ALO_ANAMNASE, '')  as obyektif,
                    ei.teraphy_desc as asesmen,
                    ei.instruction as  planning,
                    ed.examination_date as tanggal_dibuat,
                    ei.valid_date as tanggal_konfirm,
                    case when ei.valid_user is null or ei.valid_user = '' then '' else isnull(ea.fullname, ed.modified_by) end as konfirm_oleh

                from 
                EXAMINATION_INFO ei
                inner join pasien_visitation pv on ei.visit_id = pv.visit_id
                left join examination_detail ed on ed.DOCUMENT_ID = ei.PASIEN_DIAGNOSA_ID
                left outer join employee_all ea on ei.employee_id = ea.employee_id
                left outer join users u on ei.modified_by = u.username
                left outer join employee_all ea2 on u.employee_id = ea2.employee_id
                where
                (pv.norujukan  = '" . $visit['norujukan'] . "'
                and ei.NO_REGISTRATION = '" . $visit['no_registration'] . "') or ei.visit_id = '{$visit['visit_id']}'
                order by ei.examination_date desc
            "
            )->getResultArray() ?? []);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);
            $selectinfo = $this->query_template_info($db, $visit['visit_id'], $vactination_id);

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
    // private function getData_sdki()
    // {
    //     $formData = $this->request->getJSON();
    //     $diag_id = "D.0001";
    //     $id =  "20240819040438075";
    //     $visit_id = "202408030838210037799";

    //     $db = db_connect();

    //     $date = isset($formData->date) ? $formData->date : '';
    //     $dateSiki = isset($formData->dateSiki) ? $formData->dateSiki : '';

    //     //check diagnosan id tersedia atau tidak di sdki luaran
    //     $checkSDKI = $this->lowerKey($db->query("
    //     SELECT
    //     DIAGNOSAN_ID
    //     FROM ASKEP_SDKI_LUARAN WHERE DIAGNOSAN_ID = '" . $diag_id . "'
    //     ")->getResultArray());
    //     if (empty($checkSDKI)) {
    //         return $this->response->setJSON([
    //             'message' => 'Data Kosong',
    //             'respon' => false
    //         ]);
    //     }


    //     $queryAskepSdkiPenyebab = $this->lowerKey($db->query("SELECT
    //                                                         ASKEP_SDKI.DIAGNOSAN_ID AS diag_id
    //                                                         , 'Penyebab'
    //                                                         AS child_parent
    //                                                         , ASKEP_SDKI.DIAGNOSAN_NAME AS diag_name
    //                                                         , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY_ID AS diag_val_id
    //                                                         , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY AS diag_val_name
    //                                                         , ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE AS type
    //                                                         , MAX(
    //                                                             CASE WHEN ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE = ASKEP_ETIOLOGY_TYPE.ETIOLOGY_TYPE THEN ASKEP_ETIOLOGY_TYPE.ETIOLOGYTYPE ELSE ''
    //                                                             END
    //                                                         ) AS type_name
    //                                                         , MAX(
    //                                                             CASE WHEN ASKEP_SDKI_DETAIL.DETAIL_ID IS NOT NULL THEN 1 ELSE 0 END
    //                                                         ) AS checked FROM ASKEP_SDKI INNER JOIN ASKEP_SDKI_ETIOLOGY ON ASKEP_SDKI.DIAGNOSAN_ID = ASKEP_SDKI_ETIOLOGY
    //                                                         .DIAGNOSAN_ID INNER JOIN ASKEP_ETIOLOGY_TYPE ON ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE = ASKEP_ETIOLOGY_TYPE
    //                                                         .ETIOLOGY_TYPE INNER JOIN ASKEP_CATEGORY ON ASKEP_SDKI.ASKEP_CAT = ASKEP_CATEGORY.ASKEP_CAT LEFT JOIN ASKEP_SDKI_DETAIL ON ASKEP_SDKI_ETIOLOGY
    //                                                         .DIAGNOSAN_ETIOLOGY_ID = ASKEP_SDKI_DETAIL.DETAIL_ID AND ASKEP_SDKI_DETAIL.DOCUMENT_ID = '$id'
    //                                                         WHERE ASKEP_SDKI.DIAGNOSAN_ID = '$diag_id'
    //                                                         GROUP BY ASKEP_SDKI.DIAGNOSAN_ID
    //                                                         , ASKEP_SDKI.DIAGNOSAN_NAME
    //                                                         , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY_ID
    //                                                         , ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE
    //                                                         , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY;")->getResultArray());

    //     $queryAskepSdkiGejala = $this->lowerKey($db->query("SELECT
    //                                                         ASKEP_SDKI_symptom.DIAGNOSAN_ID AS diag_id
    //                                                         , 'Gejala'
    //                                                         AS child_parent
    //                                                         , ASKEP_SDKI.DIAGNOSAN_NAME AS diag_name
    //                                                         , ASKEP_SYMPTOM_TYPE.SYMPTOM_TYPE AS type
    //                                                         , ASKEP_SYMPTOM_TYPE.SYMPTOMTYPE AS type_name
    //                                                         , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID AS diag_val_id
    //                                                         , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM AS diag_val_name
    //                                                         , MAX(
    //                                                             CASE WHEN ASKEP_SDKI_DETAIL.DETAIL_ID IS NOT NULL THEN 1 ELSE 0 END
    //                                                         ) AS checked FROM ASKEP_SDKI_symptom INNER JOIN ASKEP_SYMPTOM_TYPE ON ASKEP_SDKI_symptom.SYMPTOM_TYPE = ASKEP_SYMPTOM_TYPE
    //                                                         .SYMPTOM_TYPE INNER JOIN ASKEP_SDKI ON ASKEP_SDKI_symptom.DIAGNOSAN_ID = ASKEP_SDKI
    //                                                         .DIAGNOSAN_ID LEFT JOIN ASKEP_SDKI_DETAIL ON ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID = ASKEP_SDKI_DETAIL.DETAIL_ID AND ASKEP_SDKI_DETAIL
    //                                                         .DOCUMENT_ID = '$id'
    //                                                         WHERE ASKEP_SDKI_symptom.DIAGNOSAN_ID = '$diag_id'
    //                                                         GROUP BY ASKEP_SDKI_symptom.DIAGNOSAN_ID
    //                                                         , ASKEP_SDKI.DIAGNOSAN_NAME
    //                                                         , ASKEP_SYMPTOM_TYPE.SYMPTOM_TYPE
    //                                                         , ASKEP_SYMPTOM_TYPE.SYMPTOMTYPE
    //                                                         , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID
    //                                                         , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM;")->getResultArray());

    //     $queryAskepSlkiTopDate = $db->query("SELECT TOP 1  RESULT_DATE
    //                                         FROM ASKEP_SDKI_LUARAN_RESULTS
    //                                         WHERE document_id = '$id'
    //                                         ORDER BY RESULT_DATE DESC")->getRowArray()['RESULT_DATE'] ?? null;


    //     $queryAskepSlki = $db->query("SELECT 
    //                                     ASKEP_SDKI_LUARAN.DIAGNOSAN_ID AS diag_id,
    //                                     ASKEP_SDKI_LUARAN.LUARAN_NAME AS diag_name,
    //                                     ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE AS type,
    //                                     ASKEP_RELATIONAL_TYPE.RELATIONALTYPE AS type_name,
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA_ID AS diag_val_id,
    //                                     ASKEP_SLKI_KRITERIA.P_TYPE AS p_type,
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA AS diag_val_name,
    //                                     MAX(CASE 
    //                                         WHEN DATEPART(YEAR, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(YEAR, '$date')
    //                                         AND DATEPART(MONTH, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(MONTH, '$date')
    //                                         AND DATEPART(DAY, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(DAY, '$date')
    //                                         AND DATEPART(HOUR, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(HOUR, '$date')
    //                                         THEN ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE
    //                                         ELSE ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE
    //                                     END) AS RESULT_DATE,
    //                                     MAX(CASE 
    //                                         WHEN ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE IS NOT NULL 
    //                                         THEN 1 
    //                                         ELSE 0 
    //                                     END) AS checked
    //                                 FROM 
    //                                     ASKEP_SDKI_LUARAN
    //                                     INNER JOIN ASKEP_RELATIONAL_TYPE 
    //                                         ON ASKEP_SDKI_LUARAN.RELATIONAL_TYPE = ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE
    //                                     INNER JOIN ASKEP_SLKI_KRITERIA 
    //                                         ON ASKEP_SDKI_LUARAN.LUARAN_ID = ASKEP_SLKI_KRITERIA.LUARAN_ID 
    //                                     LEFT JOIN ASKEP_SDKI_LUARAN_RESULTS 
    //                                         ON ASKEP_SLKI_KRITERIA.KRITERIA_ID = ASKEP_SDKI_LUARAN_RESULTS.KRITERIA_ID
    //                                         AND ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE = 
    //                                             COALESCE(
    //                                                 (SELECT TOP 1 RESULT_DATE
    //                                                 FROM ASKEP_SDKI_LUARAN_RESULTS
    //                                                 WHERE document_id = '$id'
    //                                                 AND DATEPART(YEAR, RESULT_DATE) = DATEPART(YEAR, '$date')
    //                                                 AND DATEPART(MONTH, RESULT_DATE) = DATEPART(MONTH, '$date')
    //                                                 AND DATEPART(DAY, RESULT_DATE) = DATEPART(DAY, '$date')
    //                                                 AND DATEPART(HOUR, RESULT_DATE) = DATEPART(HOUR, '$date')
    //                                                 ORDER BY RESULT_DATE DESC),
    //                                                 (SELECT TOP 1 RESULT_DATE
    //                                                 FROM ASKEP_SDKI_LUARAN_RESULTS
    //                                                 WHERE document_id = '$id'
    //                                                 ORDER BY RESULT_DATE DESC)
    //                                             )
    //                                 WHERE 
    //                                     ASKEP_SDKI_LUARAN.DIAGNOSAN_ID = '$diag_id'
    //                                 GROUP BY 
    //                                     ASKEP_SDKI_LUARAN.DIAGNOSAN_ID,
    //                                     ASKEP_SDKI_LUARAN.LUARAN_NAME,
    //                                     ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE,
    //                                     ASKEP_RELATIONAL_TYPE.RELATIONALTYPE,
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA_ID,
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA,
    //                                     ASKEP_SLKI_KRITERIA.P_TYPE;")->getResultArray();



    //     if (empty($queryAskepSlki)) {
    //         $queryAskepSlkiEmpty = $db->query("
    //                     select KRITERIA_ID AS diag_val_id from ASKEP_SDKI_LUARAN 
    //                     INNER JOIN ASKEP_SLKI_KRITERIA ON ASKEP_SDKI_LUARAN.LUARAN_ID = ASKEP_SLKI_KRITERIA.LUARAN_ID
    //                     WHERE ASKEP_SDKI_LUARAN.DIAGNOSAN_ID = '$diag_id' ORDER BY diag_val_id")->getResultArray();
    //         $criteriaIds = array_column($queryAskepSlkiEmpty, 'diag_val_id');
    //         $criteriaIds = array_map('intval', $criteriaIds);
    //     } else {
    //         $criteriaIds = array_column($queryAskepSlki, 'diag_val_id');
    //         $criteriaIds = array_map('intval', $criteriaIds);
    //     }

    //     $queryDropdown = $db->query("SELECT 
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA_ID,
    //                                     ASKEP_SLKI_KRITERIA.P_TYPE,
    //                                     ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID,  
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_ID,     
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,
    //                                     COALESCE(MAX(
    //                                         CASE 
    //                                             WHEN ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASKEP_SDKI_LUARAN_RESULTS.PARAMETER_ID
    //                                                 AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = ASKEP_SDKI_LUARAN_RESULTS.VALUE_ID
    //                                                 AND ASSESSMENT_PARAMETER_VALUE.VALUE_DESC = ASKEP_SDKI_LUARAN_RESULTS.VALUE_DESC
    //                                                 AND ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE = ASKEP_SDKI_LUARAN_RESULTS.VALUE_SCORE
    //                                                 AND ASKEP_SLKI_KRITERIA.KRITERIA_ID = ASKEP_SDKI_LUARAN_RESULTS.KRITERIA_ID
    //                                             THEN 1 
    //                                             ELSE 0 
    //                                         END
    //                                     ), 0) AS selected
    //                                 FROM 
    //                                     ASKEP_SLKI_KRITERIA
    //                                     INNER JOIN ASSESSMENT_PARAMETER_VALUE 
    //                                         ON ASKEP_SLKI_KRITERIA.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE 
    //                                         AND ASKEP_SLKI_KRITERIA.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID
    //                                     INNER JOIN ASKEP_SDKI_LUARAN 
    //                                         ON ASKEP_SLKI_KRITERIA.LUARAN_ID = ASKEP_SDKI_LUARAN.LUARAN_ID
    //                                     LEFT JOIN ASKEP_SDKI_LUARAN_RESULTS 
    //                                         ON ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASKEP_SDKI_LUARAN_RESULTS.PARAMETER_ID
    //                                         AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = ASKEP_SDKI_LUARAN_RESULTS.VALUE_ID
    //                                         AND ASSESSMENT_PARAMETER_VALUE.VALUE_DESC = ASKEP_SDKI_LUARAN_RESULTS.VALUE_DESC
    //                                         AND ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE = ASKEP_SDKI_LUARAN_RESULTS.VALUE_SCORE
    //                                         AND ASKEP_SDKI_LUARAN_RESULTS.DOCUMENT_ID = '$id'
    //                                         AND ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE = 
    //                                             COALESCE(
    //                                                 (
    //                                                     SELECT TOP 1 RESULT_DATE
    //                                                     FROM ASKEP_SDKI_LUARAN_RESULTS
    //                                                     WHERE DOCUMENT_ID = '$id'
    //                                                     AND DATEPART(YEAR, RESULT_DATE) = DATEPART(YEAR, '$date')
    //                                                     AND DATEPART(MONTH, RESULT_DATE) = DATEPART(MONTH, '$date')
    //                                                     AND DATEPART(DAY, RESULT_DATE) = DATEPART(DAY, '$date')
    //                                                     AND DATEPART(HOUR, RESULT_DATE) = DATEPART(HOUR, '$date')
    //                                                     ORDER BY RESULT_DATE DESC
    //                                                 ),
    //                                                 (
    //                                                     SELECT TOP 1 RESULT_DATE
    //                                                     FROM ASKEP_SDKI_LUARAN_RESULTS
    //                                                     WHERE DOCUMENT_ID = '$id'
    //                                                     ORDER BY RESULT_DATE DESC
    //                                                 )
    //                                             )
    //                                 WHERE 
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA_ID IN (" . implode(',', $criteriaIds) . ")  AND ASKEP_SLKI_KRITERIA.LUARAN_ID = 'L.01001'
    //                                 GROUP BY 
    //                                     ASKEP_SLKI_KRITERIA.KRITERIA_ID,
    //                                     ASKEP_SLKI_KRITERIA.P_TYPE,
    //                                     ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID,
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_ID,     
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE
    //                                 ORDER BY 
    //                                     ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ASC;")->getResultArray();

    //     $slkiData = [];
    //     foreach ($queryAskepSlki as $slki) {
    //         $diag_val_id = $slki['diag_val_id'];
    //         if (!isset($slkiData[$diag_val_id])) {
    //             $slkiData[$diag_val_id] = [
    //                 'result_date' => $slki['RESULT_DATE'],
    //                 'diag_id' => $slki['diag_id'],
    //                 'diag_name' => $slki['diag_name'],
    //                 'type' => $slki['type'],
    //                 'type_name' => $slki['type_name'],
    //                 'diag_val_id' => $slki['diag_val_id'],
    //                 'diag_val_name' => $slki['diag_val_name'],
    //                 'p_type' => $slki['p_type'],
    //                 'checked' => $slki['checked'],
    //                 'selected' => []
    //             ];
    //         }
    //     }

    //     foreach ($queryDropdown as $dropdown) {
    //         $diag_val_id = $dropdown['KRITERIA_ID'];
    //         if (isset($slkiData[$diag_val_id])) {
    //             $slkiData[$diag_val_id]['selected'][] = [
    //                 'kriteria_id' => $dropdown['KRITERIA_ID'],
    //                 'p_type' => $dropdown['P_TYPE'],
    //                 'value_desc' => $dropdown['VALUE_DESC'],
    //                 'value_score' => $dropdown['VALUE_SCORE'],
    //                 'selected' => $dropdown['selected'],
    //                 'parameter_id' => $dropdown['PARAMETER_ID'],
    //                 'value_id' => $dropdown['VALUE_ID']
    //             ];
    //         }
    //     }

    //     $queryAskepSikiTopDate = $db->query("SELECT TOP 1  INTERVENSI_DATE
    //                                         FROM ASKEP_SDKI_INTERVENSI_RESULTS
    //                                         WHERE document_id = '$id'
    //                                         ORDER BY INTERVENSI_DATE DESC")->getRowArray()['INTERVENSI_DATE'] ?? null;

    //     $queryAskepSiki = $db->query("SELECT 
    //                                     ASKEP_SIKI.INTERVENSI_ID AS DIAG_ID,
    //                                     ASKEP_SIKI.INTERVENSI_NAME AS DIAG_NAME,
    //                                     ASKEP_SIKI_TYPE.SIKI_TYPE AS TYPE,
    //                                     ASKEP_SIKI_TYPE.SIKITYPE AS TYPE_NAME,
    //                                     ASKEP_SIKI_TINDAKAN.TINDAKAN_ID AS DIAG_VAL_ID,
    //                                     ASKEP_SIKI_TINDAKAN.TINDAKAN AS DIAG_VAL_NAME,
    //                                     MAX(CASE 
    //                                         WHEN DATEPART(YEAR, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(YEAR, '$dateSiki')
    //                                         AND DATEPART(MONTH, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(MONTH, '$dateSiki')
    //                                         AND DATEPART(DAY, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(DAY, '$dateSiki')
    //                                         AND DATEPART(HOUR, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(HOUR, '$dateSiki')
    //                                         THEN ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE
    //                                         ELSE ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE
    //                                     END) AS RESULT_DATE,
    //                                     MAX(CASE 
    //                                         WHEN ASKEP_SDKI_INTERVENSI_RESULTS.TINDAKAN_ID IS NOT NULL 
    //                                         THEN 1 
    //                                         ELSE 0 
    //                                     END) AS checked
    //                                 FROM 
    //                                     ASKEP_SIKI
    //                                     INNER JOIN ASKEP_SIKI_TINDAKAN 
    //                                         ON ASKEP_SIKI.INTERVENSI_ID = ASKEP_SIKI_TINDAKAN.INTERVENSI_ID
    //                                     INNER JOIN ASKEP_SIKI_TYPE 
    //                                         ON ASKEP_SIKI_TINDAKAN.SIKI_TYPE = ASKEP_SIKI_TYPE.SIKI_TYPE
    //                                     LEFT JOIN ASKEP_SDKI_INTERVENSI_RESULTS 
    //                                         ON ASKEP_SIKI_TINDAKAN.TINDAKAN_ID = ASKEP_SDKI_INTERVENSI_RESULTS.TINDAKAN_ID
    //                                         AND ASKEP_SDKI_INTERVENSI_RESULTS.DOCUMENT_ID = '$id'
    //                                         AND ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE = 
    //                                             COALESCE(
    //                                                 (SELECT TOP 1 INTERVENSI_DATE
    //                                                 FROM ASKEP_SDKI_INTERVENSI_RESULTS
    //                                                 WHERE DOCUMENT_ID = '$id'
    //                                                 AND DATEPART(YEAR, INTERVENSI_DATE) = DATEPART(YEAR, '$dateSiki')
    //                                                 AND DATEPART(MONTH, INTERVENSI_DATE) = DATEPART(MONTH, '$dateSiki')
    //                                                 AND DATEPART(DAY, INTERVENSI_DATE) = DATEPART(DAY, '$dateSiki')
    //                                                 AND DATEPART(HOUR, INTERVENSI_DATE) = DATEPART(HOUR, '$dateSiki')
    //                                                 ORDER BY INTERVENSI_DATE DESC),
    //                                                 (SELECT TOP 1 INTERVENSI_DATE
    //                                                 FROM ASKEP_SDKI_INTERVENSI_RESULTS
    //                                                 WHERE DOCUMENT_ID = '$id'
    //                                                 ORDER BY INTERVENSI_DATE DESC)
    //                                             )
    //                                 WHERE 
    //                                     ASKEP_SIKI.INTERVENSI_ID IN ('1.01014', '1.01011')
    //                                 GROUP BY 
    //                                     ASKEP_SIKI.INTERVENSI_ID,
    //                                     ASKEP_SIKI.INTERVENSI_NAME,
    //                                     ASKEP_SIKI_TYPE.SIKI_TYPE,
    //                                     ASKEP_SIKI_TYPE.SIKITYPE,
    //                                     ASKEP_SIKI_TINDAKAN.TINDAKAN_ID,
    //                                     ASKEP_SIKI_TINDAKAN.TINDAKAN;

    //                         ")->getResultArray();

    //     $slkiData = array_values($slkiData);
    //     $sdkiPenyebab = $this->lowerKey($queryAskepSdkiPenyebab);
    //     $sdkiGejala = $this->lowerKey($queryAskepSdkiGejala);
    //     $queryAskepSiki = $this->lowerKey($queryAskepSiki);
    //     $hasData = !empty($sdkiPenyebab);
    //     $resultDateSlki = $queryAskepSlkiTopDate ?? Null;
    //     $resultDateSiki = $queryAskepSikiTopDate ?? Null;


    //     $responseData = [
    //         'sdki' => [
    //             'penyebab' => $sdkiPenyebab ?? [],
    //             'Gejala' => $sdkiGejala ?? [],
    //         ],
    //         'slki' => [
    //             'date' => $resultDateSlki,
    //             'data' => $slkiData
    //         ],
    //         'siki' => [
    //             'diag_id' => $queryAskepSdkiPenyebab[0]['diag_id'],
    //             'date' => $resultDateSiki,
    //             'data' => $queryAskepSiki
    //         ]
    //     ];
    //     $formattedResponseData = $this->lowerKey($responseData);
    //     return  $formattedResponseData;
    //     // return $this->response->setStatusCode(200)->setJSON([
    //     //     'message' => $hasData ? 'Data retrieved successfully.' : 'No data found.', 'respon' => $hasData, 'document_id' => isset($id) ? $id : null, 'value' => $formattedResponseData
    //     // ]);
    // }
    public function diagnosis_keperawatan($visit, $vactination_id = null)
    {
        $title = "Diagnosis Keperawatan - Bersihan Jalan Nafas Tidak Efektif";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $dataRequest = [];
            $kopprintData = $this->kopprint();

            $data = $this->getData_sdki($visit);


            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/10-diagnosis-keperawatan.php", [
                "visit" => $visit,
                'title' => $title,
                'data' => $data,
                'kop' => $kopprintData[0],
                // 'sdki' =>$sdki,
                // 'slki' =>$slki,
                // 'siki' =>$siki,
            ]);
        }
    }

    private function getData_sdki($visit)
    {
        $formData = $this->request->getJSON();
        $diag_id = "D.0001";
        $diag_id = $visit['d_diag_id'];

        $id =  $visit['d_id'];
        // $id =  "20240819040438075";
        $visit_id = "202408030838210037799";

        $db = db_connect();

        $date = isset($formData->date) ? $formData->date : '';
        $dateSiki = isset($formData->dateSiki) ? $formData->dateSiki : '';

        //check diagnosan id tersedia atau tidak di sdki luaran
        $checkSDKI = $this->lowerKey($db->query("
        SELECT
        DIAGNOSAN_ID
        FROM ASKEP_SDKI_LUARAN WHERE DIAGNOSAN_ID = '" . $diag_id . "'
        ")->getResultArray());
        if (empty($checkSDKI)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        }


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
    public function formulir_edukasi($visit, $vactination_id = null)
    {
        $title = "Formulir Pemberian Edukasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();
            $select = $this->lowerKey($db->query("SELECT document_id, MODIFIED_DATE as date, isnull(EDUCATION_MATERIAL, '') as education, FAMILY_NAME, FAMILY_RELATION, MODIFIED_BY as staff
                                                         from ASSESSMENT_EDUCATION_FORMULIR where VISIT_ID = ?", [$visit['visit_id']])->getResultArray());
            if (count($select) > 0) {
                foreach ($select as $key => $value) {
                    $sign = $this->checkSignDocs($value['document_id'], 2);
                    $sign = json_decode($sign, true);
                    if (count($sign) == 0) {
                        $sign = $this->checkSignDocs($value['document_id'], 1);
                        $sign = json_decode($sign, true);
                    }
                    if (count($sign) > 0 && !isset($sign['error'])) {
                        foreach ($sign as $key1 => $value1) {
                            if ($value1['user_type'] == '1') {
                                $select[$key]['staff'] = $value1['fullname'];
                                $select[$key]['sign_file_staff'] = $value1['sign_file'];
                            } else if ($value1['user_type'] == '2') {
                                $select[$key]['family_name'] = $value1['fullname'];
                                $select[$key]['sign_file_family'] = $value1['sign_file'];
                            } else if ($value1['user_type'] == '3') {
                                $select[$key]['family_name'] = $value1['fullname'];
                                $select[$key]['sign_file_family'] = $value1['sign_file'];
                            }
                        }
                    }
                }
                $header = $db->query("select name_of_class as name_of_class_room from class_room where class_room_id = ?", [$visit['class_room_id']])->getRowArray();
                if (!is_null($header)) {
                    $visit['name_of_class_room'] = $header['name_of_class_room'];
                }
            }

            // dd($select);

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
            $select = [];
            $kopprintData = $this->kopprint();
            $selectFamily =  $this->lowerKey($db->query("SELECT F.*, FS.FAMILY_STATUS 
                                FROM FAMILY F
                                JOIN FAMILY_STATUS FS ON F.FAMILY_STATUS_ID = FS.FAMILY_STATUS_ID
                                WHERE F.NO_REGISTRATION = '{$visit['no_registration']}';")->getResultArray());

            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/15-identitas.php", [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData[0],
                'family_data' => !empty($selectFamily) ? $selectFamily[0] : []

            ]);
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

            $query = "SELECT 
                        apm.BODY_ID,
                        apm.EXAMINATION_DATE as TGL,
                        apm.DESCRIPTION as ASSESMENT,
                        apm.TOTAL_SCORE,
                        api.INTERVENSI_DATE,
                        api.INTERVENSI,
                        api.RUTE,
                        api.REASSESSMENT,
                        api.PETUGAS,
                        api.REASSESSMENT_DATE,
                        ASSESSMENT_PARAMETER_TYPE.P_DESCRIPTION AS ALAT_UKUR
                      FROM ASSESSMENT_PAIN_MONITORING apm
                      INNER JOIN ASSESSMENT_PAIN_DETAIL apd ON apm.BODY_ID = apd.BODY_ID
                      LEFT OUTER JOIN ASSESSMENT_PAIN_INTERVENSI api ON apm.BODY_ID = api.BODY_ID
                      INNER JOIN ASSESSMENT_PARAMETER_TYPE ON apd.P_TYPE = ASSESSMENT_PARAMETER_TYPE.P_TYPE
                      WHERE apm.VISIT_ID = '" . $visit['visit_id'] . "'";

            if (!empty($vactination_id)) {
                $query .= " AND apm.BODY_ID = '" . $vactination_id . "'";
            }

            $query .= " GROUP BY 
                        apm.BODY_ID,
                        apm.EXAMINATION_DATE, 
                        apm.DESCRIPTION,
                        apm.TOTAL_SCORE,
                        api.INTERVENSI_DATE,
                        api.INTERVENSI,
                        api.RUTE,
                        api.REASSESSMENT,
                        api.PETUGAS,
                        ASSESSMENT_PARAMETER_TYPE.P_DESCRIPTION,
                        api.REASSESSMENT_DATE";

            $select = $this->lowerKey($db->query($query)->getResultArray());

            $ap = $this->lowerKey($db->query("select * from assessment_parameter where p_type in ('GEN0003','GEN0004')")->getResultArray());
            $av = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type in ('GEN0005')")->getResultArray());


            foreach ($select as $key => $value) {
                foreach ($ap as $key1 => $value1) {
                    if ($value['intervensi'] == $value1['parameter_id'] && $value1['p_type'] == 'GEN0003')
                        $select[$key]['intervensi'] = $value1['parameter_desc'];

                    if ($value['rute'] == $value1['parameter_id'] && $value1['p_type'] == 'GEN0004')
                        $select[$key]['rute'] = $value1['parameter_desc'];
                }
                foreach ($av as $key1 => $value1) {
                    if ($value['reassessment'] == $value1['value_score'])
                        $select[$key]['reassessment'] = $value1['value_desc'];
                }
            }


            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);
            $selectinfo = $this->query_template_info($db, $visit['visit_id'], $vactination_id);

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
            SELECT ASSESSMENT_FALL_RISK.BODY_ID, EMPLOYEE_ALL.DESCRIPTION AS DOCTOR, ASSESSMENT_PARAMETER_TYPE.P_DESCRIPTION AS ALAT_UKUR, 
            max(case when (ASSESSMENT_FALL_RISK_DETAIL.parameter_id = '08' and ASSESSMENT_FALL_RISK_DETAIL.p_type = 'ASES020')
            or (ASSESSMENT_FALL_RISK_DETAIL.parameter_id = '07' and ASSESSMENT_FALL_RISK_DETAIL.p_type = 'ASES019')
            then ASSESSMENT_FALL_RISK_DETAIL.value_desc else null end) as INTERVENSI, ASSESSMENT_FALL_RISK.EXAMINATION_DATE AS TANGGAL,
            SUM(ASSESSMENT_FALL_RISK_DETAIL.VALUE_SCORE) AS total_value_score,
            ASSESSMENT_FALL_RISK.modified_by
            FROM ASSESSMENT_FALL_RISK_DETAIL
            INNER JOIN ASSESSMENT_FALL_RISK ON ASSESSMENT_FALL_RISK_DETAIL.BODY_ID = ASSESSMENT_FALL_RISK.BODY_ID
            INNER JOIN ASSESSMENT_PARAMETER_TYPE ON ASSESSMENT_FALL_RISK_DETAIL.P_TYPE = ASSESSMENT_PARAMETER_TYPE.P_TYPE
            INNER JOIN EMPLOYEE_ALL ON ASSESSMENT_FALL_RISK.EMPLOYEE_ID = EMPLOYEE_ALL.EMPLOYEE_ID
            WHERE ASSESSMENT_FALL_RISK_DETAIL.VISIT_ID = '{$visit['visit_id']}' 
            ";
            if (!is_null($vactination_id)) {
                $query .= "and ASSESSMENT_FALL_RISK_DETAIL.body_id = '$vactination_id'";
            }
            $query .= "group by ASSESSMENT_FALL_RISK.BODY_ID, EMPLOYEE_ALL.DESCRIPTION , ASSESSMENT_PARAMETER_TYPE.P_DESCRIPTION, ASSESSMENT_FALL_RISK.DESCRIPTION, ASSESSMENT_FALL_RISK.EXAMINATION_DATE, ASSESSMENT_FALL_RISK.modified_by";
            $select = $this->lowerKey($db->query($query)->getResultArray());

            // dd($select);
            $selectorganization = $this->lowerKeyOne($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, "array"));
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
            $riwayat = $this->lowerKey($db->query("SELECT histories as riwayat_imunisasi from PASIEN_HISTORY where no_registration='" . $visit['no_registration'] . "' and value_id = 'G0090403'")->getResultArray());
            $status = $this->lowerKey($db->query("SELECT KELUAR_ID, CARA_KELUAR from CARA_KELUAR where KELUAR_ID='" . $visit['keluar_id'] . "' ")->getResultArray());
            $oprasi = $this->lowerKey($db->query("SELECT operasi = CAST(STUFF((SELECT ',' + tt.TARIF_NAME
                                                                        FROM PASIEN_operasi po
                                                                        JOIN treat_tarif tt ON tt.TARIF_ID = po.tarif_id
                                                                        WHERE po.visit_id = pv.visit_id
                                                                        FOR XML PATH('')), 1, 1, '') AS VARCHAR(4000))
                                                                FROM pasien_visitation pv WHERE 
                                                                    pv.NO_REGISTRATION = '" . $visit['no_registration'] . "' 
                                                                    AND pv.visit_id = '" . $visit['visit_id'] . "';")->getResultArray());
            $pasienDiagnosa = $this->lowerKey($db->query("SELECT pd.RENCANATL, it.NAMA, pd.pasien_diagnosa_id
                                                                        FROM PASIEN_DIAGNOSA pd
                                                                        LEFT OUTER JOIN INASIS_GET_TINDAKLANJUT it ON pd.rencanaTL = it.KODE where pd.VISIT_ID ='" . $visit['visit_id'] . "' ")->getResultArray());
            $diagnosaId = '';
            if (isset($pasienDiagnosa[0])) {
                $diagnosaId = $pasienDiagnosa[0]['pasien_diagnosa_id'];
            }

            $diagnosis = $this->lowerKey($db->query("select PASIEN_DIAGNOSA_ID, DIAGNOSA_ID, DIAGNOSA_NAME, DIAG_CAT from PASIEN_DIAGNOSAS where pasien_diagnosa_id = '$diagnosaId' ORDER BY diag_cat;")->getResultArray());
            $procedure = $this->lowerKey($db->query("select PASIEN_DIAGNOSA_ID, DIAGNOSA_ID, DIAGNOSA_NAME from PASIEN_PROCEDURES where pasien_diagnosa_id = '$diagnosaId'")->getResultArray());
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
                    // 'status' => !$statusPulang ? $statusPulang : $statusPulang[0],
                    'tindakan' => $oprasi,
                    'riwayat' => $riwayat
                ]);
            } else {
                return json_encode("Data tidak ditemukan");
            }
        }
    }
    public function transfer_internal($visit, $vactination_id = null)
    {
        $title = "Transfer Pasien Internal";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $kopprintData = $this->kopprint();
            $select = $this->lowerKey($db->query("select 
            c.clinic_id, pt.clinic_id_to,visit_id,body_id, document_id, document_id3, c.name_of_clinic as name_of_clinic, c2.name_of_clinic as name_of_clinic_to,
            ea.fullname
            from pasien_transfer pt left outer join clinic c on c.clinic_id = pt.clinic_id 
            left outer join clinic c2 on c2.clinic_id = pt.clinic_id_to
            left outer join employee_all ea on ea.employee_id = pt.employee_id
            where body_id = '$vactination_id'")->getResultArray());
            $select = $select[0];
            $stabilitas = $db->query("
                                                        select av.value_desc from ASSESSMENT_INDICATOR ai inner join ASSESSMENT_INDICATOR_DETAIL aid
                                                                    on ai.BODY_ID = aid.BODY_ID
                                                                    inner join ASSESSMENT_PARAMETER_VALUE av on aid.VALUE_ID = av.VALUE_ID
                                                        where DOCUMENT_ID = '" . $select['body_id'] . "'")->getRow(0, 'array');
            $examModel = new ExaminationModel();
            $examDetil = new ExaminationDetailModel();
            $document = $examModel->where("body_id", @$select['document_id'])->first();
            $document = $this->lowerKeyOne($document);
            $document1 = $examDetil->where("body_id", @$select['document_id'])->first();
            if (!is_null($document1))
                $document1 = $this->lowerKeyOne($document1);
            $document3 = $examDetil->where("body_id", @$select['document_id3'])->first();
            if (!is_null($document3))
                $document3 = $this->lowerKeyOne($document3);

            // $subyektif = $this->lowerKey($db->query("")->getResultArray());

            $sign = $this->checkSignDocs($vactination_id, 11);

            $pdn = new PasienDiagnosaPerawatModel();
            $diagNurse = $pdn->select("diagnosan_id,diag_notes")->where("document_id", $select['body_id'])->join("pasien_diagnosas_nurse", "pasien_diagnosas_nurse.body_id = pasien_diagnosa_nurse.body_id", "inner")->findAll();
            // dd($diagNurse);


            if (isset($select)) {

                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/25-transfer-pasien-internal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    'doc' => @$document !== null  ? $document : [],
                    'doc1' => @$document1 !== null  ? $document1 : [],
                    'doc3' => @$document3 !== null  ? $document3 : [],
                    // 'sub' => $subyektif !== null  ? $subyektif : $subyektif[0],
                    'val' => $select !== null  ? $select : $select[0],
                    'kop' => $kopprintData[0],
                    'stabil' => $stabilitas,
                    'sign' => $sign,
                    "diag" => $diagNurse
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

    public function implementasi($visit, $aValue = null, $vactination_id = null)
    {
        $title = "Implementasi Asuhan Keperawatan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);

            $db = db_connect();
            $select = $this->lowerKey($db->query("select treat_date as tanggal, TREATMENT as tindakan, DESCRIPTION as respons, doctor as nama, 'treatment_perawat' as type
            FROM TREATMENT_PERAWAT where TARIF_TYPE = 98  and visit_id ='{$visit['visit_id']}'
            union all
            select HANDOVER_DATE as tanggal,  'Handover by: '+HANDOVER_BY as tindakan, received_by as respons, ah.BODY_ID as nama, 'handover' as type
            from ASSESSMENT_HANDOVER ah inner join ASSESSMENT_HANDOVER_DETAIL ahd on ah.BODY_ID = ahd.BODY_ID
            where HANDOVER_BY is not null and HANDOVER_BY != ''  and visit_id ='{$visit['visit_id']}'
            order by tanggal;")->getResultArray());

            $kopprintData = $this->kopprint();

            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/26-implemntasi-asuhan.php", [
                "visit" => $visit,
                'title' => $title,
                'data' => $select,
                'kop' => $kopprintData[0]
            ]);
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

    public function edukasi_obat($visit, $vactination_id = null)
    {
        $title = "Edukasi Obat Oleh Apoteker";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $kopprintData = $this->kopprint();
            $daftar_obat = $this->lowerKey($db->query("SELECT brand_id,description as nama_obat, description2 as aturanpakai, RESEP_NO from treatment_obat where visit_id ='" . $visit['visit_id'] . "'")->getResultArray());
            if (empty($daftar_obat)) {

                foreach ($daftar_obat as &$obat) {

                    if (empty($obat['resep_no'])) {
                        $obat['resep_no'] = $obat['resep_no'];
                    }
                }
            }

            $resep_nos = array_unique(array_column($daftar_obat, 'resep_no'));
            if (!empty($resep_nos)) {

                $resep_nos_in = "'" . implode("','", $resep_nos) . "'";

                $desc_tutor = $this->lowerKey(
                    $db->query(
                        "
                        SELECT AFE.BODY_ID as resep_no, afe.VALUE_DESC, AP.PARAMETER_DESC, AFE.PARAMETER_ID
                        FROM ASSESSMENT_FARMASI_EDUKASI afe, ASSESSMENT_PARAMETER AP
                        WHERE AFE.PARAMETER_ID = AP.PARAMETER_ID 
                        AND AP.P_TYPE = AFE.P_TYPE
                        AND afe.body_id IN (" . $resep_nos_in . ")
                        ORDER BY AFE.PARAMETER_ID, AFE.VALUE_DESC"
                    )->getResultArray()
                );
            }
            return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/12-edukasi-obat.php", [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData[0],
                'daftar' => $daftar_obat ?? [],
                'desc' => $desc_tutor ?? []

            ]);
        }
    }
}
