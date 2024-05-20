<?php

namespace App\Controllers\Admin\rm;



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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
    public function ranap_neonatus($visit, $vactination_id = null)
    {
        $title = "Asesmen Keperawatan Rawat Inap Pasien Neonatus";
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
            order by examination_date")->getResultArray());
            $dekubitus = $dekubitusSelect[0] ?? [];
            if (isset($adl[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
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
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/5-ranap-neonatus.php", [
                    "visit" => $visit,
                    'title' => $title
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
    public function asuhan_kebidanan($visit, $vactination_id = null)
    {
        $title = "Asuhan Kebidanan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/7-asuhan-kebidanan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/7-asuhan-kebidanan.php", [
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
            $db = db_connect();
            $select = $this->lowerKey($db->query("select visit_date, '' as kodeppa, FULLNAME, '' as catatan, '' as response, '' verifikasi
            from pasien_visitation pv
            inner join EMPLOYEE_ALL ea on pv.employee_id = ea.EMPLOYEE_ID
            where pv.no_registration = '" . $visit['no_registration'] . "'
            order by visit_date")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/8-cppt-ranap.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/8-cppt-ranap.php", [
                    "visit" => $visit,
                    'title' => $title
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
            $select = $this->lowerKey($db->query("select visit_date, '' as kodeppa, FULLNAME, '' as catatan, '' as response, '' verifikasi
            from pasien_visitation pv
            inner join EMPLOYEE_ALL ea on pv.employee_id = ea.EMPLOYEE_ID
            where pv.no_registration = '" . $visit['no_registration'] . "'
            order by visit_date")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/9-cppt-ralan.php", [
                    "visit" => $visit,
                    'title' => $title
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
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/13-formulir.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/13-formulir.php", [
                    "visit" => $visit,
                    'title' => $title
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            where visit_id = '202404241151300470C77'
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
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/20-monitoring-nyeri.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/20-monitoring-nyeri.php", [
                    "visit" => $visit,
                    'title' => $title
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
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/21-resiko-jatuh.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/21-resiko-jatuh.php", [
                    "visit" => $visit,
                    'title' => $title
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
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/23-ringkasan-masuk-keluar.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/23-ringkasan-masuk-keluar.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
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
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/25-transfer-pasien-internal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rm/KEPERAWATAN/25-transfer-pasien-internal.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
}
