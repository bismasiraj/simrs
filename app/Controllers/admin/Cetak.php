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
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());

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
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow());

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
}
