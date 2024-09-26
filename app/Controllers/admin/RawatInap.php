<?php

namespace App\Controllers\Admin;

use App\Models\CaraKeluarModel;
use App\Models\ClassModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\InasisKontrolModel;
use App\Models\InasisRujukanModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienVisitationModel;
use App\Models\StatusPasienModel;
use App\Models\TreatmentAkomodasiModel;
use App\Models\TreatTarifModel;

class RawatInap extends \App\Controllers\BaseController
{
    public function getBangsalInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect('default');
        $builder = $db->query("  SELECT class_room.*, c.name_of_clinic,
                    CLASS_ROOM.name_of_class as classroomname,
                    cl.name_of_class,   
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
                    CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) capasity,
                    ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) terisi,
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
                    CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) - ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) sisa,
                    tt.tarif_id,
                    tt.amount_paid,
                    tt.tarif_name

      
                FROM CLASS_ROOM ,CLINIC C  ,CLASS CL, treat_tarif tt
                WHERE CLASS_ROOM_ID <> '0' 
                and CLASS_ROOM.isactive LIKE '1'
                AND CL.CLASS_ID= CLASS_ROOM.CLASS_ID
                AND CAST(CL.OTHER_ID AS VARCHAR(10)) LIKE '%'
                AND ( CLASS_ROOM.CLINIC_ID LIKE '%' or  CLASS_ROOM.NAME_OF_CLASS like '%' or
                    C.NAME_OF_CLINIC like '%')   AND C.CLINIC_ID = CLASS_ROOM.CLINIC_ID
                AND CLASS_ROOM.TARIF_ID = tt.TARIF_ID
            ");
        $bedInfo = $builder->getResultArray();
        $bedInfo = $this->lowerKey($bedInfo);

        $data = [];
        $i = 0;
        foreach ($bedInfo as $key => $value) {
            if ($value['sisa'] > 0) {
                $bedJson = json_encode($value);
                $row = [];
                $row[] = $value["name_of_clinic"];
                $row[] = $value["classroomname"];
                $row[] = $value["name_of_class"];
                $row[] = $value["capasity"];
                $row[] = $value["sisa"];
                $row[] = '<button id="asd" onclick="pilihBed(\'bed' . $i . '\')" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"> <i class="fas fa-angle-double-right"></i></button><div style="display: none;" id="bed' . $i . '">' . $bedJson . '</div>';
                $data[] = $row;
                $i++;
            }
        }
        $result = [];
        $result['data'] = $data;
        $result['classRoom'] = $bedInfo;

        return json_encode($result);
    }
    public function getBedInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect('default');
        $builder = $db->query("SELECT BEDS.BED_ID,   
            BEDS.CLASS_ROOM_ID,   
            BEDS.ORG_UNIT_CODE  
        FROM BEDS  
        WHERE  
            BEDS.BED_ID not in  (SELECT BED_ID FROM treatment_akomodasi WHERE 
            CLASS_ROOM_ID = beds.CLASS_ROOM_ID and class_room_id is not null 
            -- AND KELUAR_ID in (0,35) 
            AND KELUAR_ID in (0) --new 30 jan 2020
            AND ORG_UNIT_CODE = beds.ORG_UNIT_CODE)   
            ");
        $bedInfo = $builder->getResultArray();
        $bedInfo = $this->lowerKey($bedInfo);


        return json_encode($bedInfo);
    }
    public function getAkomodasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $nomor = $body['nomor'];
        $visit = $body['visit'];

        $ta = new TreatmentAkomodasiModel;
        $taSelect = $this->lowerKey($ta->getAkomodasi($nomor, $visit));

        $classRoomModel = new ClassRoomModel();
        $classRoom = $this->lowerKey($classRoomModel->findAll());

        $employeeModel = new EmployeeAllModel;
        $employee = $this->lowerKey($employeeModel->getEmployee());

        $keluarModel = new CaraKeluarModel();
        $keluar = $this->lowerKey($keluarModel->findAll());

        $treatTarifModel = new TreatTarifModel();

        foreach ($taSelect as $key => $value) {
            foreach ($classRoom as $key1 => $value1) {
                if ($value['class_room_id'] == $value1['class_room_id']) {
                    $taSelect[$key]['name_of_class'] = $value1['name_of_class'];
                }
            }
            foreach ($employee as $key1 => $value1) {
                if ($value['employee_id'] == $value1['employee_id']) {
                    $taSelect[$key]['fullname'] = $value1['fullname'];
                }
            }
            foreach ($keluar as $key1 => $value1) {
                if ($value['keluar_id'] == $value1['keluar_id']) {
                    $taSelect[$key]['cara_keluar'] = $value1['cara_keluar'];
                }
            }
            $tarif = $treatTarifModel->find($value['tarif_id']);
            if (isset($tarif['TARIF_NAME'])) {
                $taSelect[$key]['tarif_name'] = $tarif['TARIF_NAME'];
            }
        }

        $response['data'] = $taSelect;
        $response['cara_keluar'] = $keluar;

        return json_encode($response);
    }
    public function saveAkomodasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bill_id = $this->request->getPost('bill_id');
        $treat_date = $this->request->getPost('treat_date');
        $exit_date = $this->request->getPost('exit_date');
        $keluar_id = $this->request->getPost('keluar_id');
        $quantity = $this->request->getPost('quantity');
        $amount_paid = $this->request->getPost('amount_paid');
        $tagihan = $this->request->getPost('tagihan');

        $ta = new TreatmentAkomodasiModel();
        $lastKeluar = 0;
        foreach ($bill_id as $key => $value) {
            $data = [
                'treat_date' => str_replace("T", " ", $treat_date[$key]),
                'exit_date' => str_replace("T", " ", $exit_date[$key]),
                'keluar_id' => $keluar_id[$key],
                'quantity' => $quantity[$key],
                'amount_paid' => $amount_paid[$key],
                'tagihan' => $tagihan[$key]
            ];
            $ta->update($bill_id[$key], $data);
            $lastKeluar = $keluar_id[$key];
        }

        $response['metadata']['code'] = 200;
        $response['metadata']['message'] = "Berhasil Simpan";
        $response['response']['lastkeluar'] = $lastKeluar;

        return json_encode($response);
    }

    public function postAddAkomodasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $class_room_id = $body['class_room_id'];
        $treat_date = $body['treat_date'];
        $exit_date = $body['exit_date'];
        $quantity = $body['quantity'];
        $measure_id = $body['measure_id'];
        $amount = $body['amount'];
        $amount_paid = $body['amount_paid'];
        $payment_date = $body['payment_date'];
        $islunas = $body['islunas'];
        $modified_from = $body['modified_from'];
        $iscetak = $body['iscetak'];
        $print_date = $body['print_date'];
        $employee_id = $body['employee_id'];
        $doctor = $body['doctor'];
        $employee_id_from = $body['employee_id_from'];
        $doctor_from = $body['doctor_from'];
        $visit_id = $body['visit_id'];
        $no_registration = $body['no_registration'];
        $bill_id = $body['bill_id'];
        $subsidi = $body['subsidi'];
        $org_unit_code = $body['org_unit_code'];
        $clinic_id = $body['clinic_id'];
        $treatment = $body['treatment'];
        $description = $body['description'];
        $tarif_id = $body['tarif_id'];
        $bed_id = $body['bed_id'];
        $keluar_id = $body['keluar_id'];
        $nota_no = $body['nota_no'];
        $clinic_id_from = $body['clinic_id_from'];
        $sold_status = $body['sold_status'];
        $status_pasien_id = $body['status_pasien_id'];
        $thename = $body['thename'];
        $theaddress = $body['theaddress'];
        $theid = $body['theid'];
        $class_id = $body['class_id'];
        $class_id_plafond = $body['class_id_plafond'];
        $amount_plafond = $body['amount_plafond'];
        $treatment_plafond = $body['treatment_plafond'];
        $amount_paid_plafond = $body['amount_paid_plafond'];
        $pembulatan = $body['pembulatan'];
        $isrj = $body['isrj'];
        $payor_id = $body['payor_id'];
        $ageyear = $body['ageyear'];
        $agemonth = $body['agemonth'];
        $ageday = $body['ageday'];
        $gender = $body['gender'];
        $kal_id = $body['kal_id'];
        $discount = $body['discount'];
        $karyawan = $body['karyawan'];
        $account_id = $body['account_id'];
        $sell_price = $body['sell_price'];
        $diskon = $body['diskon'];
        $invoice_id = $body['invoice_id'];
        $tagihan = $body['tagihan'];
        $koreksi = $body['koreksi'];
        $potongan = $body['potongan'];
        $bayar = $body['bayar'];
        $retur = $body['retur'];
        $ppnvalue = $body['ppnvalue'];
        $tarif_type = $body['tarif_type'];
        $subsidisat = $body['subsidisat'];
        $printq = $body['printq'];
        $printed_by = $body['printed_by'];
        $clinic_type = $body['clinic_type'];
        $package_id = $body['package_id'];
        $module_id = $body['module_id'];
        $theorder = $body['theorder'];
        $cashier = $body['cashier'];
        $no_skpinap = $body['no_skpinap'];
        $pasien_id = $body['pasien_id'];
        $respon = $body['respon'];
        $mapping_sep = $body['mapping_sep'];
        $trans_id = $body['trans_id'];
        $sppkasir = $body['sppkasir'];
        $sppbill = $body['sppbill'];
        $spppoli = $body['spppoli'];

        if (is_null($bill_id) || strlen($bill_id) == 0) {
            $orgModel = new OrganizationunitModel();
            $bill_id = $orgModel->generateId();
        }

        if (is_null($nota_no) || strlen($nota_no) == 0) {
            $orgModel = new OrganizationunitModel();
            $nota_no = $orgModel->generateId();
        }

        $data = [
            'class_room_id' => $class_room_id,
            'treat_date' => str_replace('T', ' ', $treat_date),
            'exit_date' => str_replace("T", " ", $exit_date),
            'quantity' => $quantity,
            'measure_id' => $measure_id,
            'amount' => $amount,
            'amount_paid' => $amount_paid,
            'payment_date' => $payment_date,
            'islunas' => $islunas,
            'modified_from' => $modified_from,
            'iscetak' => $iscetak,
            'print_date' => $print_date,
            'employee_id' => $employee_id,
            'doctor' => $doctor,
            'employee_id_from' => $employee_id_from,
            'doctor_from' => $doctor_from,
            'visit_id' => $visit_id,
            'no_registration' => $no_registration,
            'bill_id' => $bill_id,
            'subsidi' => $subsidi,
            'org_unit_code' => $org_unit_code,
            'clinic_id' => $clinic_id,
            'treatment' => $treatment,
            'description' => $description,
            'tarif_id' => $tarif_id,
            'bed_id' => $bed_id,
            'keluar_id' => $keluar_id,
            'nota_no' => $nota_no,
            'clinic_id_from' => $clinic_id_from,
            'sold_status' => $sold_status,
            'status_pasien_id' => $status_pasien_id,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'theid' => $theid,
            'class_id' => $class_id,
            'class_id_plafond' => $class_id_plafond,
            'amount_plafond' => $amount_plafond,
            'treatment_plafond' => $treatment_plafond,
            'amount_paid_plafond' => $amount_paid_plafond,
            'pembulatan' => $pembulatan,
            'isrj' => $isrj,
            'payor_id' => $payor_id,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
            'gender' => $gender,
            'kal_id' => $kal_id,
            'discount' => $discount,
            'karyawan' => $karyawan,
            'account_id' => $account_id,
            'sell_price' => $sell_price,
            'diskon' => $diskon,
            'invoice_id' => $invoice_id,
            'tagihan' => $tagihan,
            'koreksi' => $koreksi,
            'potongan' => $potongan,
            'bayar' => $bayar,
            'retur' => $retur,
            'ppnvalue' => $ppnvalue,
            'tarif_type' => $tarif_type,
            'subsidisat' => $subsidisat,
            'printq' => $printq,
            'printed_by' => $printed_by,
            'clinic_type' => $clinic_type,
            'package_id' => $package_id,
            'module_id' => $module_id,
            'theorder' => $theorder,
            'cashier' => $cashier,
            'no_skpinap' => $no_skpinap,
            'pasien_id' => $pasien_id,
            'respon' => $respon,
            'mapping_sep' => $mapping_sep,
            'trans_id' => $trans_id,
            'sppkasir' => $sppkasir,
            'sppbill' => $sppbill,
            'spppoli' => $spppoli,
        ];

        $taModel = new TreatmentAkomodasiModel();
        $taModel->save($data);

        return json_encode($data);
    }

    public function deleteAkomodasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $bill = $body['bill'];
        $pastBill = $body['pastBill'];

        $ta = new TreatmentAkomodasiModel();
        $result = $ta->delete($bill);
        if (!$result) {
            $response['metadata']['code'] = '201';
            $response['metadata']['message'] = 'gagal';
            return json_encode($response);
        }
        if ($pastBill != '') {
            $dataPast = [
                'keluar_id' => 0,
                'bill_id' => $pastBill
            ];

            $resultPast = $ta->save($dataPast);
            if ($resultPast) {
            } else {
                $response['metadata']['code'] = '201';
                $response['metadata']['message'] = 'gagal';
                return json_encode($response);
            }
        }
        $response['metadata']['code'] = '200';
        $response['metadata']['message'] = 'sukses';
        return json_encode($response);



        // SAMPAI SINI YA. NANTI BIKIN KODING NGAMBIL BILL ID DELETE, DAN BILL ID BEFORE, LALU YG DELETE YA DIDELETE, YG BEFORE DIUBAH JADI MASIH RAWAT INAP DAN EXIT DATE DLL DISESUAIKAN
    }
    public function insertSep()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visit = $body['visit_id'];

        if ($body['jnsPelayanan'] == 2) {
            $body['klsRawat']['klsRawatNaik'] = "";
            $body['klsRawat']['pembiayaan'] = "";
            $body['klsRawat']['penanggungJawab'] = "";
        } else {
            $body['poli']['tujuan'] = '';
            $body['poli']['eksekutif'] = '0';
            $c = new ClassModel();
            $select = $c->select('kdkelasv, other_id')->find($body['klsRawat']['klsRawatHak']);
            $selectNaik = $c->select('kdkelasv')->find($body['klsRawat']['klsRawatNaik']);
            // return json_encode($selectNaik);
            if ($select['kdkelasv'] == $selectNaik['kdkelasv']) {
                $body['klsRawat']['klsRawatNaik'] = "";
                $body['klsRawat']['pembiayaan'] = "";
                $body['klsRawat']['penanggungJawab'] = "";
            } else {
                $body['klsRawat']['klsRawatNaik'] = $select['kdkelasv'];
            }
            $body['klsRawat']['klsRawatHak'] = $select['other_id'];
            $body['jaminan']['noLP'] = "";
            $body['jaminan']['penjamin']['tglKejadian'] = "";
            $body['jaminan']['penjamin']['keterangan'] = "";
            $body['jaminan']['penjamin']['suplesi']['noSepSuplesi'] = "";
        }
        if ($body['flagProcedure'] == '99') {
            $body['flagProcedure'] = '';
        }
        if ($body['assesmentPel'] == '99') {
            $body['assesmentPel'] = '';
        }
        if ($body['kdPenunjang'] == '99') {
            $body['kdPenunjang'] = '';
        }
        if ($body['diagAwal'] == null) {
            $body['diagAwal'] = 'E10';
        }
        $body['noTelp'] = '081379131123';


        // $headers = $this->AuthBridging();
        // return json_encode($headers);



        $ws_data = [];
        $method = 'POST';
        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/insert';

        // return json_encode($url);

        $ws_data['request']['t_sep'] = $body;
        $postdata = json_encode($ws_data);
        // return $postdata;


        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;

        if ($response['metaData']['code'] == '200') {
            $pv = new PasienVisitationModel();
            $nosep = $response['response']['sep']['noSep'];
            $pv->update($visit, [
                'no_skpinap' => $nosep,
                'tujuankunj' => $body['tujuanKunj'],
                'assesmentpel' => $body['assesmentPel'],
                'flagprocedure' => $body['flagProcedure'],
                'kdPenunjang' => $body['kdPenunjang'],
                'diag_awal' => $body['diagAwal'],
                'specimenno' => $body['skdp']['noSurat'],
                'asalrujukan' => $body['rujukan']['asalRujukan'],
                'tanggal_rujukan' => $body['rujukan']['tglRujukan'],
                'norujukan' => $body['rujukan']['norujukan'],
                'ppkrujukan' => $body['rujukan']['ppkRujukan'],

            ]);
        }


        return json_encode($response);
    }
    public function updateSepInap()
    {
        if (!$this->request->is('put')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $pv = new PasienVisitationModel();
        $resultQuery = $pv->selectSep($visit);
        $select = $resultQuery[0];

        $sep['noSep'] = $select['no_skpinap'];
        $sep['klsRawat']['klsRawatHak'] = $select['klsRawat'];
        $sep['klsRawat']['klsRawatNaik'] = $select['klsRawatNaik'];
        $sep['klsRawat']['pembiayaan'] = '1';
        $sep['klsRawat']['penanggungJawab'] = 'Pribadi';
        $sep['noMr'] = $select['noMr'];
        $sep['catatan'] = $select['catatan'];
        $sep['diagAwal'] = $select['diagAwal'];
        $sep['poli']['tujuan'] = $select['tujuan'];
        $sep['poli']['eksekutif'] = $select['eksekutif'];
        $sep['cob']['cob'] = $select['cob'];
        $sep['katarak']['katarak'] = $select['katarak'];
        $sep['jaminan']['lakaLantas'] = $select['lakaLantas'];
        $sep['jaminan']['noLP'] = $select['noLP'];
        $sep['jaminan']['penjamin']['tglKejadian'] = ['tglKejadian'];
        $sep['jaminan']['keterangan'] = $select['keterangan'];
        $sep['suplesi']['suplesi'] = $select['suplesi'];
        $sep['suplesi']['noSepSuplesi'] = $select['noSepSuplesi'];
        $sep['suplesi']['lokasiLaka']['kdPropinsi'] = $select['kdPropinsi'];
        $sep['suplesi']['lokasiLaka']['kdKabupaten'] = $select['kdKabupaten'];
        $sep['suplesi']['lokasiLaka']['kdKecamatan'] = $select['kdKecamatan'];
        $sep['dpjpLayan'] = $select['dpjpLayan'];
        $sep['noTelp'] = $select['noTelp'];
        $sep['user'] = user()->username;

        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/update';

        $data['request']['t_sep'] = $sep;

        // $response = $this->sendVclaim($url, 'PUT', json_encode($data));

        $response = '{
          "metaData": {
            "code": "200",
            "message": "Sukses"
          },
          "response": "1101R0070420V000017"
        }';

        return json_encode(json_decode($response, true));
        // return json_encode($response);
    }

    public function deleteSepInap()
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $noSep = $body['noSep'];


        $sep['noSep'] = $noSep;
        $sep['user'] = user()->username;

        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/delete';

        $data['request']['t_sep'] = $sep;
        $method = 'DELETE';
        $postdata = json_encode($data);

        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        // $response = '{
        //     "metaData": 
        //         {
        //         "code": "200",
        //         "message": "OK"
        //         },
        //     "response": "0301R0011017V000007"
        // }';

        // return json_encode(json_decode($response, true));
        return json_encode($response);
    }

    public function updatePulangSep()
    {
        if (!$this->request->is('put')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $pv = new PasienVisitationModel();
        $resultQuery = $pv->selectSep($visit);
        $select = $resultQuery[0];

        $sep['noSep'] = $select['no_skpinap'];
        $sep['klsRawat']['klsRawatHak'] = $select['klsRawat'];
        $sep['klsRawat']['klsRawatNaik'] = $select['klsRawatNaik'];
        $sep['klsRawat']['pembiayaan'] = '1';
        $sep['klsRawat']['penanggungJawab'] = 'Pribadi';
        $sep['noMr'] = $select['noMr'];
        $sep['catatan'] = $select['catatan'];
        $sep['diagAwal'] = $select['diagAwal'];
        $sep['poli']['tujuan'] = $select['tujuan'];
        $sep['poli']['eksekutif'] = $select['eksekutif'];
        $sep['cob']['cob'] = $select['cob'];
        $sep['katarak']['katarak'] = $select['katarak'];
        $sep['jaminan']['lakaLantas'] = $select['lakaLantas'];
        $sep['jaminan']['noLP'] = $select['noLP'];
        $sep['jaminan']['penjamin']['tglKejadian'] = ['tglKejadian'];
        $sep['jaminan']['keterangan'] = $select['keterangan'];
        $sep['suplesi']['suplesi'] = $select['suplesi'];
        $sep['suplesi']['noSepSuplesi'] = $select['noSepSuplesi'];
        $sep['suplesi']['lokasiLaka']['kdPropinsi'] = $select['kdPropinsi'];
        $sep['suplesi']['lokasiLaka']['kdKabupaten'] = $select['kdKabupaten'];
        $sep['suplesi']['lokasiLaka']['kdKecamatan'] = $select['kdKecamatan'];
        $sep['dpjpLayan'] = $select['dpjpLayan'];
        $sep['noTelp'] = $select['noTelp'];
        $sep['user'] = user()->username;

        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/update';

        $data['request']['t_sep'] = $sep;

        // $response = $this->sendVclaim($url, 'PUT', json_encode($data));

        $response = '{
          "metaData": {
            "code": "200",
            "message": "Sukses"
          },
          "response": "1101R0070420V000017"
        }';

        return json_encode(json_decode($response, true));
    }

    public function getSPRI()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $kddpjp = $body['kddpjp'];
        $clinic_id = $body['clinic_id'];
        $no_registration = $body['no_registration'];

        $ik = new InasisKontrolModel();
        $inasisKontrol = $ik->select('top(1) nosuratkontrol')->join('clinic c', 'c.kdpoli = inasis_kontrol.polikontrol_kdpoli', 'inner')
            ->where('surattype', '2')
            // ->where('clinic_id', $clinic_id)
            // ->where('kodedokter', $kddpjp)
            // ->where('no_registration', $no_registration)
            ->findAll();

        if (isset($inasisKontrol[0])) {
            $response['metadata']['code'] = '200';
            $response['metadata']['message'] = 'sukses';
            $response['response'] = $inasisKontrol[0];
            return json_encode($response);
        } else {
            $response['metadata']['code'] = '201';
            $response['metadata']['message'] = 'gagal, data tidak ditemukan';
            return json_encode($response);
        }
    }
    public function getDiagRujukan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $d = new PasienDiagnosasModel();
        $selectDiagnosa = $d->join('pasien_diagnosa pd', 'pd.pasien_diagnosa_id = pasien_diagnosas.pasien_diagnosa_id', 'inner')
            ->select("top(1) pasien_diagnosas.diagnosa_id, diagnosa_name")
            ->where('visit_id', $visit)
            ->where('pasien_diagnosas.diag_cat', '1')
            ->orderBy('pasien_diagnosas.modified_date desc')
            ->findAll();
        if (isset($selectDiagnosa[0])) {
            $response['metadata']['code'] = '200';
            $response['metadata']['message'] = 'sukses';
            $response['response']['data'] = $selectDiagnosa[0];
            return json_encode($response);
        } else {
            $response['metadata']['code'] = '201';
            $response['metadata']['message'] = 'gagal';
            return json_encode($response);
        }
    }
    public function getRujukanInap()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $ir = new InasisRujukanModel();
        $select = $this->lowerKey($ir->join('clinic c', 'c.kdpoli = inasis_rujukan.polirujukan_kdpoli')
            ->where('visit_id', $visit)
            ->findAll());

        if (isset($select[0])) {
            $response['metadata']['code'] = '200';
            $response['metadata']['message'] = 'sukses';
            $response['response']['data'] = $select[0];
            return json_encode($response);
        } else {
            $response['metadata']['code'] = '201';
            $response['metadata']['message'] = 'gagal';
            return json_encode($response);
        }
    }
    public function deleteRujukanInap()
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];
    }
}
