<?php

namespace App\Controllers\Admin;

use App\Models\PasienVisitationModel;


class Cetak extends \App\Controllers\BaseController
{
    function cetakAntrian($visit)
    {
        $select = json_decode(base64_decode($visit), true);
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
        // $pv = new PasienVisitationModel();
        // $select = $this->lowerKeyOne($pv->find($visit));

        // $db = db_connect();
        // $select = $db->query("select pasien_visitation.no_registration,   
        //  pasien_visitation.visit_id,   
        //  pasien_visitation.status_pasien_id,   
        //  pasien_visitation.visit_date,   
        //  pasien_visitation.clinic_id,   
        //  pasien_visitation.ticket_no,   
        //  pasien_visitation.employee_id,
        // 	pasien_visitation.ageyear,
        // pasien_visitation.agemonth,
        // pasien_visitation.ageday, 
        // pasien_visitation.diantar_oleh,
        // pasien_visitation.visitor_address,
        // rooms_id +'-'+ right(1000 +ticket_no,3) as urutan

        //     from pasien_visitation  left outer join rooms on clinic_id = buildings_id 
        //     where pasien_visitation.visit_id='$visit'")->getFirstRow('array');

        $data['json'] = $select;
        // dd($data);
        return view('admin\patient\cetak\pendaftaran\cetakantrian', $data);
    }
    function formRekamMedis($nomor, $status)
    {
        // $pv = new PasienVisitationModel();
        // $select = $this->lowerKeyOne($pv->find($visit));

        $db = db_connect();
        $select = $this->lowerKeyOne($db->query("SP_INFO_PASIEN;1 @NOMOR = '$nomor', @STATUS = '$status'")->getFirstRow('array'));

        $data['json'] = $select;
        // dd($data);
        return view('admin\patient\cetak\pendaftaran\formrekammedis', $data);
    }
    function tagihanPendaftaran($nomor, $clinic, $visit)
    {
        // $pv = new PasienVisitationModel();
        // $select = $this->lowerKeyOne($pv->find($visit));

        $db = db_connect();
        $select = $this->lowerKey($db->query("SELECT T.ORG_UNIT_CODE,   
         T.BILL_ID,   
         T.NO_REGISTRATION,   
         T.VISIT_ID,  
         T.CLINIC_ID,   
         T.TREATMENT,   
         T.TREAT_DATE,  
         T.PAYMENT_DATE,   
         T.DESCRIPTION,   
         T.NOTA_NO,    
         T.ISCETAK,   
         T.PRINT_DATE,   
         T.EMPLOYEE_ID,   
         T.MODIFIED_BY,   
         T.DOCTOR,   
         pv.status_pasien_id,   
         T.amount_paid,  
         T.THEID,  
         T.PAYOR_ID,
         PV.ageyear,
         PV.agemonth,
         PV.ageday, 
         T.tarif_type,
         T.QUANTITY,
         T.SELL_PRICE,
         T.TAGIHAN,
         T.RETUR,
         T.BAYAR,
         T.SUBSIDI,
         T.POTONGAN,
         T.DISKON,
         T.karyawan,
         T.KOREKSI,
         T.RESEP_NO,
         T.measure_id,
         pv.class_room_id,
         pv.employee_inap,
         T.printQ, 
         T.printed_by,
         T.theorder,
         pv.diantar_oleh,pv.visitor_address, pv.ticket_no, t.thename,
			o.name_of_org_unit,
            c.name_of_clinic,
            sp.name_of_status_pasien
    FROM TREATMENT_BILL T, treat_tarif tt 
         , pasien_visitation pv , organizationunit o, clinic c, status_pasien sp
   WHERE ( T.NO_REGISTRATION = '$nomor' ) AND
           T.CLINIC_ID LIKE '$clinic' AND
           Tt.TREAT_ID LIKE '02%' AND
           Tt.TARIF_ID = T.TARIF_ID and
           Tt.ORG_UNIT_CODE = T.ORG_UNIT_CODE and
           pv.no_registration = T.no_registration and
           pv.org_unit_code = T.org_unit_code and
           pv.visit_id = T.visit_id  and
           pv.clinic_id = c.clinic_id and
           pv.visit_id = '$visit' and   
           pv.status_pasien_id = sp.status_pasien_id and
           T.ORG_UNIT_CODE = o.ORG_UNIT_CODE")->getResultArray());

        $data['json'] = $select;
        // dd($data);
        return view('admin\patient\cetak\pendaftaran\tagihanpendaftaran', $data);
    }
    function cetakGelang($visit, $pasien)
    {
        $visit = json_decode(base64_decode($visit), true);
        $pasien = json_decode(base64_decode($pasien), true);
        $select = array_merge($visit, $pasien);
        $select['date_of_birth'] = substr($select['date_of_birth'], 8, 2) . '-' . substr($select['date_of_birth'], 5, 2) . '-' . substr($select['date_of_birth'], 0, 4);
        // // $pv = new PasienVisitationModel();
        // // $select = $this->lowerKeyOne($pv->find($visit));

        // $db = db_connect();
        // $select = $this->lowerKeyOne($db->query("SELECT PASIEN_VISITATION.NO_REGISTRATION,   
        // PASIEN_VISITATION.VISIT_ID,   
        // PASIEN_VISITATION.STATUS_PASIEN_ID,   
        // PASIEN_VISITATION.VISIT_DATE,   
        // PASIEN_VISITATION.CLINIC_ID,   
        // PASIEN_VISITATION.TICKET_NO,   
        // PASIEN_VISITATION.EMPLOYEE_ID,
        // pasien_visitation.ageyear,
        // pasien_visitation.agemonth,
        // pasien_visitation.ageday, 
        // pasien_visitation.diantar_oleh,
        // pasien_visitation.visitor_address,
        // pasien.date_of_birth

        // FROM PASIEN_VISITATION   left outer join pasien on PASIEN_VISITATION.NO_REGISTRATION = pasien.no_registration
        // WHERE PASIEN_VISITATION.NO_REGISTRATION='$nomor' AND
        //   PASIEN_VISITATION.VISIT_ID='$visit'")->getFirstRow('array'));

        $data['json'] = $select;
        // dd($data);
        return view('admin\patient\cetak\pendaftaran\cetakgelang', $data);
    }
    function cetakLabelPasien($pasien)
    {
        $select = json_decode(base64_decode($pasien), true);
        // $pv = new PasienVisitationModel();
        $select['date_of_birth'] = substr($select['date_of_birth'], 8, 2) . '-' . substr($select['date_of_birth'], 5, 2) . '-' . substr($select['date_of_birth'], 0, 4);
        $kelurahan = $select['kal_id'];
        $db = db_connect();
        $kalurahan = $db->query("select nama_kota from KALURAHAN kal inner join KECAMATAN kec on kal.KEC_ID = kec.KEC_ID inner join KOTA k on k.KODE_KOTA = kec.KODE_KOTA
        where KAL_ID = '$kelurahan'")->getFirstRow('array');
        $select['nama_kota'] = $kalurahan['nama_kota'];
        // $select = $this->lowerKeyOne($db->query("select p.NAME_OF_PASIEN,
        // p.no_registration,
        // p.CONTACT_ADDRESS,
        // k.NAMA_KOTA,
        // p.date_of_birth,
        // p.gender
        // from pasien p left outer join kota k on p.kal_id in (select kal_id from kalurahan where kec_id in (select kec_id  from kecamatan where KODE_KOTA = k.kode_kota))
        //     WHERE p.NO_REGISTRATION='$nomor'")->getFirstRow('array'));

        $data['json'] = $select;
        // dd(json_encode($data));
        return view('admin\patient\cetak\pendaftaran\cetaklabelpasien', $data);
    }
    function cetakSep($visit, $pasien)
    {
        $visit = json_decode(base64_decode($visit), true);
        $pasien = json_decode(base64_decode($pasien), true);
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
        // $select = $this->lowerKeyOne($db->query("SELECT PASIEN_VISITATION.NO_REGISTRATION,   
        // PASIEN_VISITATION.VISIT_ID,   
        // PASIEN_VISITATION.STATUS_PASIEN_ID,   
        // PASIEN_VISITATION.VISIT_DATE,   
        // PASIEN_VISITATION.CLINIC_ID,   
        // PASIEN_VISITATION.EMPLOYEE_ID,
        // pasien_visitation.visit_date,
        // pasien.name_of_pasien  , 
        // pasien.contact_address,
        // pasien.date_of_birth,
        // pasien.gender,
        // pasien_visitation.rujukan_id,
        // pasien_visitation.no_skp,
        // pasien.pasien_id,
        // pasien.kk_no,
        // pasien_visitation.class_id,
        // address_of_rujukan,
        // PASIEN_VISITATION.RUJUKAN_ID,
        // pasien_visitation.keluar_id,
        // pasien_visitation.description,
        // pasien_visitation.account_id,
        // pasien.coverage_id,
        // in_date, pasien_visitation.diag_awal, pasien_visitation.conclusion, pasien_visitation.COB
        // , pasien_visitation.asalrujukan
        // , pasien_visitation.ppkrujukan
        // ,ROOMS_ID +'-'+ RIGHT(1000 +TICKET_NO,3) AS URUTAN
        //     FROM PASIEN_VISITATION   left outer join rooms on clinic_id = buildings_id  , pasien 
        //     WHERE PASIEN_VISITATION.NO_REGISTRATION=:NOMOR AND
        //         PASIEN_VISITATION.VISIT_ID=:KE and 
        //             pasien.no_registration = pasien_visitation.no_registration")->getFirstRow('array'));

        $data['json'] = $select;
        // dd($data);
        return view('admin\patient\cetak\pendaftaran\cetaksep', $data);
    }

    //==new
    public function cetakVitalSign($visit, $vactination_id = null)
    {
        $title = "Early Warning Score";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("
            select 
                ex.*, 
                c.name_of_clinic, 
                ea.fullname, gcs.GCS_DESC
            from examination_info ex 
            left join employee_all ea on ex.employee_id = ea.employee_id 
            left join clinic c on ex.clinic_id = c.clinic_id 
            left outer join ASSESSMENT_GCS gcs on ex.BODY_ID = gcs.DOCUMENT_ID
            where ex.no_registration = '060133' 
            and ex.visit_id = '202406140643270000A44'
            and ex.vs_status_id IN(1,4,5)
            order by examination_date desc
            ")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            if (isset($select[0])) {
                return view("admin/patient/cetak/cetakvitalsign.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/cetakvitalsign.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    //==endofnew
    public function cetakVitalSignNeonatal($visit, $vactination_id = null)
    {
        $title = "Adult Early Warning Score";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("
            select an.*
            from ASSESSMENT_NEONATUS_PHYSIC an 
            where an.no_registration = '060133' and an.visit_id = '202406140643270000A44' 
            order by examination_date desc
            ")->getResultArray());
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            if (isset($select[0])) {
                return view("admin/patient/cetak/cetakvitalsign-neonatal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/cetakvitalsign-neonatal.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }

    public function cetak_pra_operasi($visit, $vactination_id = null)
    {
        $title = "Asesmen Pra Operasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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

            if (isset($select[0])) {
                return view("admin/patient/cetak/operasi/pra-operasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "informasiMedis" => $newData,
                    "lokalis" => $selectlokalis,
                    "diagnosa" => $selectDiagnosa,
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/operasi/pra-operasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function cetak_laporan_anesthesi($visit, $vactination_id = null)
    {
        $title = "Laporan Anestesi/Sedasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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
                    "select DIAGNOSA_NAME from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $select['body_id'] . "' "
                )->getResultArray());

                $informasiMedis = array_splice($select, 13, 16);
                $keadaanUmum = array_splice($select, 14, 3);
                $perencanaanAnestesi = array_splice($select, 15, 7);

                $newData = [];
                $newData2 = [];
                $newData3 = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS006');
                $newData3 = $this->ConvertValue($keadaanUmum, $newData3, 'OPRS006');
                $newData2 = $this->ConvertValue($perencanaanAnestesi, $newData2, 'OPRS006');
            }

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            if (isset($select[0])) {
                return view("admin/patient/cetak/operasi/laporan-anesthesi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "informasiMedis" => $newData,
                    "perencanaanAnestesi" => $newData2,
                    "keadaanUmum" => $newData3,
                    "lokalis" => $selectlokalis,
                    "diagnosa" => $selectDiagnosa,
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/operasi/laporan-anesthesi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }

    public function cetak_catatan_keperawatan($visit, $vactination_id = null)
    {
        $title = "Catatan Keperawatan Peri Operasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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
            format(round(ei.WEIGHT*10000/ei.height/ei.height,2), '0.##') as bmi
            from ASSESSMENT_OPERATION 
            left outer join EXAMINATION_info ei on ASSESSMENT_OPERATION.document_id = ei.PASIEN_DIAGNOSA_ID
            where ASSESSMENT_OPERATION.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' and ei.ACCOUNT_ID = '10'
            ")->getRow(0, 'array'));

            if (!empty($select)) {

                $selectDiagnosa = $this->lowerKey($db->query("
                SELECT PASIEN_DIAGNOSAS_NURSE.DIAG_NOTES FROM PASIEN_DIAGNOSA_NURSE
                INNER JOIN PASIEN_DIAGNOSAS_NURSE ON PASIEN_DIAGNOSA_NURSE.BODY_ID = PASIEN_DIAGNOSAS_NURSE.BODY_ID
                WHERE DOCUMENT_ID = '" . $vactination_id . "'
                ")->getResultArray());

                $selectDrain = $this->lowerKey($db->query("
                SELECT DRAIN_TYPE,DRAIN_KINDS,SIZE,DESCRIPTION 
                FROM ASSESSMENT_OPERATION_DRAIN WHERE DOCUMENT_ID = '" . $vactination_id . "'
                ")->getResultArray());


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
                ")->getResultArray());
                $bromage = $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_ANESTHESIA_RECOVERY where visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' and p_type = 'oprs024' ")->getResultArray());
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
                ")->getResultArray());


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


            if (isset($select)) {
                return view("admin/patient/cetak/operasi/catatan-keperawatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "informasiMedis" => $newData,
                    "informasiIntra" => $newData2,
                    "informasiIntra2" => $newData3,
                    "informasiPasca" => $newData4,
                    "diagnosas" => $selectDiagnosa,
                    "drains" => $selectDrain,
                    "aldrete" => $aldrete,
                    "bromage" => $bromage,
                    "steward" => $steward,
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/operasi/catatan-keperawatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function cetak_checklist_keselamatan($visit, $vactination_id = null)
    {
        $title = "Asesmen Pra Operasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select * FROM ASSESSMENT_OPERATION_CHECK
            where ASSESSMENT_OPERATION_CHECK.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "'
            ")->getRow(0, 'array'));


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

            if (isset($select)) {
                return view("admin/patient/cetak/operasi/checklist-keselamatan.php", [
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
            } else {
                return view("admin/patient/cetak/operasi/checklist-keselamatan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
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
                $parameterDesc = $result['PARAMETER_DESC'] ?? '-';
                $arr_after[$parameterDesc] = $value;
                if ($result) {
                    $parameterDesc = $result['PARAMETER_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $value;
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
    public function cetak_checklist_anestesi($visit, $vactination_id = null)
    {
        $title = "Checklist Anestesi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $query = $this->lowerKey($db->query(
                "
                select * from ASSESSMENT_ANESTHESI_CHECKLIST where DOCUMENT_ID = '" . $vactination_id . "'
                "
            )->getRow());
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




            return view("admin/patient/cetak/operasi/checklist-anestesi.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $query,
                "organization" => $selectorganization,
                "informasiTindakan" => $newData,
                "treatment" => $treatmentData
            ]);
        }
    }
}
