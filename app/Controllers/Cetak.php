<?php

namespace App\Controllers\Admin;

use App\Models\CairanModel;
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
            ")->getResultArray() ?? []);

            if (!empty($select)) {
                $selectlokalis = $this->lowerKey($db->query(
                    "
                    select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                    INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                    where body_id = '" . $vactination_id . "'"
                )->getResultArray() ?? []);

                $selectDiagnosa = $this->lowerKey($db->query(
                    "select DIAGNOSA_NAME from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $select[0]['body_id'] . "' "
                )->getResultArray()) ?? [];

                $informasiMedis = array_slice($select[0], 8, 22);

                $newData = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS001');
            }

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array') ?? []);

            if (isset($select[0])) {
                return view("admin/patient/cetak/operasi/pra-operasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "informasiMedis" => $newData ?? [],
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
            left outer join EXAMINATION_detail ei on ASSESSMENT_ANESTHESIA.BODY_ID = ei.document_id
            where ASSESSMENT_ANESTHESIA.visit_id = '" . $visit['visit_id'] . "' and ASSESSMENT_ANESTHESIA.document_id = '" . $vactination_id . "' and ei.ACCOUNT_ID = '11'
            ")->getRowArray() ?? []);


            if (!empty($select)) {
                $selectlokalis = $this->lowerKey($db->query(
                    "
                    select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                    INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                    where body_id = '" . $vactination_id . "' AND assessment_lokalis.VALUE_SCORE = 2"
                )->getResultArray() ?? []);

                $selectDiagnosa = $this->lowerKey($db->query(
                    "select DIAGNOSA_NAME from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $select['body_id'] . "' "
                )->getResultArray() ?? []);

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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);

            if (isset($select)) {
                return view("admin/patient/cetak/operasi/laporan-anesthesi.php", [
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
            } else {
                return view("admin/patient/cetak/operasi/laporan-anesthesi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function cetak_laporan_pembedahan($visit, $vactination_id = null)
    {
        $title = "Laporan Pembedahan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array') ?? []);

            if (isset($select)) {
                return view("admin/patient/cetak/operasi/laporan-pembedahan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    'operation_team' => $operation_team,
                    'diagnosas' => $diagnosas,
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/operasi/laporan-pembedahan.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "organization" => $selectorganization
                ]);
            }
        }
    }
    public function cetak_post_operasi($visit, $vactination_id = null)
    {
        $title = "Asesmen Post Operasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select ASSESSMENT_OPERATION_POST.*
            from ASSESSMENT_OPERATION_POST 
            where ASSESSMENT_OPERATION_POST.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "'
            ")->getResultArray() ?? []);


            if (!empty($select)) {

                $informasiMedis = array_slice($select[0], 8, 11);

                $newData = [];

                $newData = $this->ConvertValue($informasiMedis, $newData, 'OPRS009');
            }
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array') ?? []);

            if (isset($select[0])) {
                return view("admin/patient/cetak/operasi/post-operasi.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select,
                    "informasiMedis" => $newData ?? [],
                    "organization" => $selectorganization
                ]);
            } else {
                return view("admin/patient/cetak/operasi/post-operasi.php", [
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
            ed.TEMPERATURE as suhu,
            ed.TENSION_UPPER as tensi_atas,
            ed.TENSION_BELOW as tensi_bawah,
            ed.NADI as nadi,
            ed.NAFAS as respirasi,
            ed.WEIGHT as bb,
            ed.HEIGHT as tb,
            ed.IMT_SCORE,
            ed.IMT_DESC,
            ed.SATURASI as saturasi,
            CASE
                WHEN ed.HEIGHT = 0 THEN NULL
                ELSE ROUND(ed.WEIGHT * 10000.0 / (ed.HEIGHT * ed.HEIGHT), 2)
            END AS bmi
            from ASSESSMENT_OPERATION 
            left outer join EXAMINATION_detail ed on ASSESSMENT_OPERATION.document_id = ed.document_id
            where ASSESSMENT_OPERATION.visit_id = '" . $visit['visit_id'] . "' and ASSESSMENT_OPERATION.document_id = '" . $vactination_id . "' and ed.ACCOUNT_ID = '10'
            ")->getRowArray() ?? []);
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
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array') ?? []);


            if (isset($select)) {
                return view("admin/patient/cetak/operasi/catatan-keperawatan.php", [
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
        $title = "Checklist Keselamatan Operasi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $select = $this->lowerKey($db->query("
            select * FROM ASSESSMENT_OPERATION_CHECK
            where ASSESSMENT_OPERATION_CHECK.visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "'
            ")->getRowArray() ?? []);


            $instruments = $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_INSTRUMENT where visit_id = '" . $visit['visit_id'] . "' and document_id = '" . $vactination_id . "' ")->getResultArray() ?? []);
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);

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
                    "theSignIn" => $newData ?? [],
                    "theTimeOut" => $newData2 ?? [],
                    "theSignOut" => $newData3 ?? [],
                    "theSignOut2" => $newData4 ?? [],
                    "instruments" => $instruments ?? [],
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
            )->getRowArray() ?? []);


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

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);

            $treatmentData = $this->getTreatment();

            $AParameter = $db->table('ASSESSMENT_PARAMETER')
                ->where('P_TYPE', 'OPRS007')
                ->get();
            $resultArrayAParameter = $AParameter->getResultArray();
            $selectAParameter = $this->lowerKey($resultArrayAParameter ?? []);




            return view("admin/patient/cetak/operasi/checklist-anestesi.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $query,
                "organization" => $selectorganization,
                "informasiTindakan" => $newData ?? [],
                "treatment" => $treatmentData
            ]);
        }
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

    public function cetak_anesthesi_lengkap($visit, $vactination_id = null)
    {
        $title = "Laporan Anestesi Lengkap";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $query = $this->lowerKey($db->query(
                "
                select *,
                ASSESSMENT_ANESTHESIA.org_unit_code as org_unit_code,
                ASSESSMENT_ANESTHESIA.visit_id as visit_id,
                ASSESSMENT_ANESTHESIA.trans_id as trans_id,
                ASSESSMENT_ANESTHESIA.body_id as body_id,
                ASSESSMENT_ANESTHESIA.document_id as document_id,
                ASSESSMENT_ANESTHESIA.examination_date as examination_date,
                ASSESSMENT_ANESTHESIA.modified_date as modified_date
                
                from ASSESSMENT_ANESTHESIA
                left join ASSESSMENT_ANESTHESIA_POST on ASSESSMENT_ANESTHESIA.DOCUMENT_ID = ASSESSMENT_ANESTHESIA_POST.DOCUMENT_ID
                left join ASSESSMENT_ANESTHESI_CHECKLIST on ASSESSMENT_ANESTHESIA.DOCUMENT_ID = ASSESSMENT_ANESTHESI_CHECKLIST.DOCUMENT_ID
				left join pasien_operasi on assessment_anesthesia.document_id = pasien_operasi.vactination_id
                where ASSESSMENT_ANESTHESIA.DOCUMENT_ID =  '" . $vactination_id . "'
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

            return view("admin/patient/cetak/operasi/laporan-anesthesi-lengkap.php", [
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

    public function asuhan_gizi($visit, $body_id)
    {
        $title = "Asuhan Gizi";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $query = $this->lowerKey($db->query(
                "
                select ASSESSMENT_NUTRITION.*, examination_info.weight, examination_info.height, age_range.display,ASSESSMENT_NUTRITION_HABIT.dietary_habit  from ASSESSMENT_NUTRITION 
                inner join examination_info on ASSESSMENT_NUTRITION.examination_date = examination_info.examination_date
                inner join age_range on ASSESSMENT_NUTRITION.age_category = age_range.age_range
                inner join ASSESSMENT_NUTRITION_HABIT on ASSESSMENT_NUTRITION.pola_makan = ASSESSMENT_NUTRITION_HABIT.habit_id
                where ASSESSMENT_NUTRITION.body_id = '$body_id'
                "
            )->getRowArray());


            $selectDiagnosa = $this->lowerKey($db->query(
                "select DIAGNOSA_NAME from PASIEN_DIAGNOSAS where PASIEN_DIAGNOSA_ID = '" . $query['body_id'] . "' "
            )->getResultArray());

            $selectIntervensi = $this->lowerKey($db->query(
                "select * from ASSESSMENT_NUTRITION_INTERVENTION where document_id = '" . $query['body_id'] . "' "
            )->getResultArray());

            $selectFoodRecall = $this->lowerKey($db->query(
                "select * from ASSESSMENT_NUTRITION_RECALL where document_id = '" . $query['body_id'] . "' "
            )->getResultArray());

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            return view("admin/patient/cetak/laporan-gizi.php", [
                "visit" => $visit,
                'title' => $title,
                "val" => $query,
                "organization" => $selectorganization,
                "diagnosa" => $selectDiagnosa,
                "intervensi" => $selectIntervensi,
                "foodRecall" => $selectFoodRecall
            ]);
        }
    }

    public function cairan_cetak($visit)
    {
        if ($this->request->is('get')) {
            $decoded_visit = base64_decode($visit);
            $decoded_visit = json_decode($decoded_visit, true);
            $db = db_connect();

            $model = new CairanModel();

            $sql = $model->where('visit_id', $decoded_visit["id"]);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            if (!empty($decoded_visit["startDate"]) && !empty($decoded_visit["endDate"])) {
                $sql->where('examination_date >=', $decoded_visit["startDate"])
                    ->where('examination_date <=', $decoded_visit["endDate"]);
            }
            $sql->orderBy('examination_date', 'ASC');
            $results = $this->lowerKey($sql->findAll());

            $AParameter = $db->table('ASSESSMENT_PARAMETER')
                ->where('P_TYPE', 'GEN0023')
                ->get();
            $resultArrayAParameter = $AParameter->getResultArray();
            $selectAParameter = $this->lowerKey($resultArrayAParameter);

            $AParameterValue = $db->table('ASSESSMENT_PARAMETER_VALUE')
                ->where('P_TYPE', 'GEN0023')
                ->get();
            $resultArrayAParameterValue = $AParameterValue->getResultArray();
            $selectAParameterValue = $this->lowerKey($resultArrayAParameterValue);

            $diagnosa = $db->table('PASIEN_DIAGNOSA')
                ->where('visit_id', $decoded_visit["id"])
                ->get();
            $resultArrayDiagnosa = $diagnosa->getResultArray();
            $resultArrayDiagnosa = $this->lowerKey($resultArrayDiagnosa);


            return view("admin/patient/cetak/cairan-cetak.php", [
                "visit" => $decoded_visit,
                "title" => "FORMULIR BALANCE CAIRAN",
                "organization" => $selectorganization,
                "dataTabels" => $results,
                "visit" => $decoded_visit["visit"],
                "aValue" => $selectAParameterValue,
                "aPrameter" => $selectAParameter,
                "diagnosa" => $resultArrayDiagnosa

            ]);
        }
    }


    public function cetakAllGrouping($visit)
    {
        if ($this->request->is('get')) {
            $db = db_connect();
            $decoded_visit = $this->decodeVisit($visit);

            // Fetch all data
            $kopprintData = $this->getKopprintData($db);
            $hasilResultRad = $this->getHasilResultRad($db, $decoded_visit['visit_id']);
            $radiologi = $this->getRadiologiData($db, $hasilResultRad);
            $queryTreatmenBill = $this->getTreatmentBill($db, $decoded_visit['visit_id']);
            $queryTreatmenBillResep = $this->getTreatmentBillResep($db, $decoded_visit['visit_id']);

            $kirimlisData = $this->getKirimlisData($db, $queryTreatmenBill); // New function
            $laboratorium = $this->getLaboratoriumData($db, $kirimlisData, $decoded_visit); // New function
            $visitation = $this->getVisitationData($db, $decoded_visit['visit_id']);
            $resumeMediis = $this->resume_medis($db, $decoded_visit);
            $skdp = $this->cetakskdp($db, $decoded_visit);

            $cetakSepAll = $this->cetakSepAll($db, $decoded_visit);
            $treatname = $this->tratname($db);




            // Prepare data for response
            $data = [
                // 'template' => $kopprintData,
                // 'treatment_bill' => $queryTreatmenBill,
                // // 'kirimlis' => $kirimlisData, // Include kirimlis data
                // // 'visitation' => $visitation,
                // 'lab'=>$laboratorium,
                // 'radiologi_cetak' => $radiologi,
                // 'resumeMedis'=>$resumeMediis
                'sep' => $cetakSepAll
            ];

            return view("admin/patient/profilemodul/formrm/rm/cetak-all.php", [
                "visit" => $decoded_visit,
                'radiologi_cetak' => $radiologi,
                'lab' => $laboratorium,
                'kop' => $kopprintData,
                'treatment_bill' => $queryTreatmenBill,
                'resep' => $queryTreatmenBillResep,
                'resumeMedis' => $resumeMediis,
                'sep' => $cetakSepAll,
                'get_treat' => $treatname,
                'skdp' => $skdp

            ]);
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
            where  INASIS_KONTROL.NOSEP = '0701R0011218V004912'  --diganti dengan no sep yang berlaku
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


    private function getLaboratoriumData($db, $kirimlisData, $decoded_visit)
    {
        $kode_kunjungan = array_column($kirimlisData, 'kode_kunjungan');

        if (empty($kode_kunjungan)) {
            return [];
        }

        $kode_kunjunganString = implode("','", $kode_kunjungan);

        // var_dump($decoded_visit['in_date']);
        // exit();

        return $this->lowerKey(
            $db->query(
                "SELECT 
                    H.nolab_lis, H.kode_kunjungan, H.tarif_id, H.tarif_name, H.kel_pemeriksaan, H.urut_bound,
                    H.PARAMETER_NAME, H.hasil, H.satuan, H.NILAI_RUJUKAN, H.METODE_PERIKSA, null as kode,
                    H.reg_date AS tgl_hasil, H.norm, K.nama, K.alamat, K.date_of_birth, K.cara_bayar_name, 
                    K.pengirim_name, K.ruang_name, K.kelas_name, K.Tgl_Periksa, H.flag_hl
                FROM 
                    sharelis.dbo.hasillis H
                LEFT OUTER JOIN 
                    sharelis.dbo.kirimlis K 
                    ON H.norm COLLATE database_default = K.no_pasien COLLATE database_default 
                    AND H.kode_kunjungan = K.Kode_Kunjungan
                WHERE 
                    H.kode_kunjungan IN ('20240608P013RJ0001', '20240608P013RJ0002') 
                    -- ('$kode_kunjunganString')
                    AND No_Pasien IN ('111111','222222') 
                    -- `'" . $decoded_visit['org_unit_code'] . "'`
				-- 	AND reg_date BETWEEN DATEADD(hour, 0, '" . $decoded_visit['in_date'] . "')
                --    AND DATEADD(hour, 24, COALESCE('" . $decoded_visit['exit_date'] . "', GETDATE()))
                AND reg_date BETWEEN DATEADD(hour, 0, '2024-01-01 10:00:00')
                AND DATEADD(hour, 24, COALESCE('2024-09-22 10:00:00', GETDATE()))

                GROUP BY 
                    H.nolab_lis, H.kode_kunjungan, H.tarif_id, H.tarif_name, H.kel_pemeriksaan, H.urut_bound, 
                    H.PARAMETER_NAME, H.hasil, H.satuan, H.NILAI_RUJUKAN, H.METODE_PERIKSA, K.Tgl_Periksa, 
                    H.reg_date, H.norm, K.nama, K.alamat, K.date_of_birth, K.cara_bayar_name, 
                    K.pengirim_name, K.ruang_name, K.kelas_name, H.flag_hl
                ORDER BY 
                   H.kode_kunjungan"
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
            $db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array')
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

    private function resume_medis($db, $visit, $vactination_id = null)
    {

        // var_dump($visit);
        // exit();
        $title = "Resume Medis";
        if ($this->request->is('get')) {
            // $visit = base64_decode($visit);
            // $visit = json_decode($visit, true);
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
            $selectinfo = $this->query_template_info($db, '2024052400101208008C3', '202405262033530190C16');

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select[0],
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe
            ]);
        }
    }
}
