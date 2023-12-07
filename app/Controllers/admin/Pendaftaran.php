<?php

namespace App\Controllers\Admin;

use App\Models\ClassModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\InasisKontrolModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienVisitationModel;
use App\Models\StatusPasienModel;
use App\Models\TreatmentAkomodasiModel;

class Pendaftaran extends \App\Controllers\BaseController
{

    public function getSinglePV()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());


        $visit = $body['visit'];

        $pv = new PasienVisitationModel();
        $result = $this->lowerKey($pv->find($visit));

        foreach ($employee as $key2 => $value2) {
            if ($value2['employee_id'] == $result['employee_id']) {
                $result['fullname'] = $value2['fullname'];
            }
        }

        return json_encode($result);
    }

    public function gethistoryrajaldatatable()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();


        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $kode = $body['norm'];


        // return json_encode($nama);
        $kunjungan = $this->lowerKey($pv->where('no_registration', $kode)->orderBy('visit_date desc')->findAll());


        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());


        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->findAll());

        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {

                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['status_pasien_id'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['clinic_id'] = $clinic[$key1]['name_of_clinic'];
                    }
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['clinic_id_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['employee_id'] = $employee[$key1]['fullname'];
                    }
                }
                foreach ($class as $key1 => $value1) {
                    if ($kunjungan[$key]['class_id'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['class_id'] = $class[$key1]['name_of_class'];
                    }
                    if ($kunjungan[$key]['class_id_plafond'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['class_id_plafond'] = $class[$key1]['name_of_class'];
                    }
                }
                if ($kunjungan[$key]['locked'] == '1') {
                    $kunjungan[$key]['locked'] == 'Valid Lock';
                } elseif ($kunjungan[$key]['locked'] == '2') {
                    $kunjungan[$key]['locked'] == 'Close';
                } elseif ($kunjungan[$key]['locked'] == '5') {
                    $kunjungan[$key]['locked'] == 'Close Billing';
                } else {
                    $kunjungan[$key]['locked'] == 'Open';
                }

                if (!is_null($kunjungan[$key]['rm_in_date'])) {
                    $kunjungan[$key]['rm_in_date'] = '<br>DRM - Kembali';
                } else {
                    $kunjungan[$key]['rm_in_date'] = '';
                }

                $id = $kunjungan[$key]['no_registration'];
                $info_data   = array('Rawat Jalan', 'Rawat Inap', 'Radiologi', 'Lab', 'Farmasi', 'Operasi');
                $info_url    = array();

                $info_url[0] = base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'];
                $info_url[1] = base_url() . 'admin/patient/ipdprofile/' . $id;
                $info_url[2] = base_url() . 'admin/radio/getTestReportBatch';
                $info_url[3] = base_url() . 'admin/pathology/getTestReportBatch';
                $info_url[4] = base_url() . 'admin/pharmacy/bill';

                for ($i = 0; $i < sizeof($info_url); $i++) {
                    $data[$i] = $info_data[$i];
                    $url[$i]  = $info_url[$i];
                }
                $result[$key]['info'] = $data;
                $result[$key]['url']  = $url;


                // $action = "<a href='#' onclick='getpatientData(\"" . $id . "\")' class='btn btn-default btn-xs pull-right'  data-toggle='modal' title='" . lang('show') . "'><i class='fa fa-reorder'></i></a>";
                $pvJson = ($kunjungan[$key]);
                $action = '<button type="button" class="btn btn-primary waves-effect waves-light" onclick="getAkomodasi(\'' . $pvJson["visit_id"] . '\')">Pilih</button>';

                $row = array();
                $first_action = "<a target='_blank' href=" . base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'] . " style='text-align: left !important'>";
                //==============================
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['diantar_oleh'];
                $row[] = substr($kunjungan[$key]['visit_date'], 0, 10); // . "<br>" . $kunjungan[$key]['ageyear'] . "th " . $kunjungan[$key]['agemonth'] . "bl " . $kunjungan[$key]['ageday'] . "hr";
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = "<b>" . $kunjungan[$key]['clinic_id'] . "</b><br><b>" . $kunjungan[$key]['employee_id'] . "</b>";
                $row[] = $kunjungan[$key]['no_skp'] . "<br>No. Rujukan : " . $kunjungan[$key]['norujukan'] . " Tgl : " . substr($kunjungan[$key]['tanggal_rujukan'], 0, 10);
                $row[] = $kunjungan[$key]['clinic_id_from'] . "<br>" . $kunjungan[$key]['class_id_plafond'] . "<br>" . $kunjungan[$key]['locked'];
                $row[] = $action;
                $dt_data[] = $row;
            }
        }
        // return 'json_encode($kunjungan)';
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);
    }

    public function getHistoryPv()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();


        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $kode = $body['norm'];


        // return json_encode($nama);
        $kunjungan = $this->lowerKey($pv->select('top(20) *')->where('no_registration', $kode)->where('visit_date > dateadd(month,-3,getdate())')->orderBy('visit_date asc')->findAll());

        return json_encode($kunjungan);
    }
    public function getSKDP()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $ik = new InasisKontrolModel();

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $nomor = $body['norm'];
        $clinic = $body['clinic_id'];
        $kddpjp = $body['kddpjp'];
        $visit = $body['visit_id'];

        $select = $this->lowerKey(
            $ik->select('top(1) nosuratkontrol')->join('clinic c', 'inasis_kontrol.polikontrol_kdpoli = c.kdpoli', 'inner')
                ->where('surattype', 1)
                ->where('clinic_id', $clinic)
                ->where('kodedokter', $kddpjp)
                ->where('no_registration', $nomor)
                ->where('visit_id', $visit)
                ->where('nosuratkontrol is not null')
                ->findAll()
        );

        if (isset($select[0]['nosuratkontrol'])) {
            $skdp = $select[0]['nosuratkontrol'];
            $data = [
                'isused' => 1
            ];
            $ik->update($skdp, $data);

            $response['metadata']['code'] = 200;
            $response['metdata']['message'] = 'sukses';
            $response['skdp'] = $skdp;
            return json_encode($response);
        } else {
            $response['metadata']['code'] = 201;
            $response['metdata']['message'] = 'gagal';
            return json_encode($response);
        }
    }
    public function getSPRI()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $ik = new InasisKontrolModel();

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $nomor = $body['norm'];
        $clinic = $body['clinic_id'];
        $kddpjp = $body['kddpjp'];
        $visit = $body['visit_id'];

        $select = $this->lowerKey(
            $ik->select('top(1) nosuratkontrol')->join('clinic c', 'inasis_kontrol.polikontrol_kdpoli = c.kdpoli', 'inner')
                ->where('surattype', 2)
                // ->where('clinic_id', $clinic)
                ->where('kodedokter', $kddpjp)
                ->where('no_registration', $nomor)
                ->where('nosuratkontrol is not null')
                ->where('visit_id', $visit)
                ->findAll()
        );

        if (isset($select[0]['nosuratkontrol'])) {
            $skdp = $select[0]['nosuratkontrol'];
            $data = [
                'isused' => 1
            ];
            $ik->update($skdp, $data);

            $response['metadata']['code'] = 200;
            $response['metdata']['message'] = 'sukses';
            $response['spri'] = $skdp;
            return json_encode($response);
        } else {
            $response['metadata']['code'] = 201;
            $response['metdata']['message'] = 'gagal';
            return json_encode($response);
        }
    }

    public function saveSkdp()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $request = $body['request'];
        $noskdp = $body['noSuratKontrol'];
        $visit = $body['visit_id'];
        $nomr = $body['no_registration'];

        $ws_data = [];
        if ($noskdp != '') {
            $method = 'PUT';
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/';
            $url .= 'Update';
            $request['noSuratKontrol'] = $noskdp;
        } else {
            $method = 'POST';
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/';
            $url .= 'insert';
        }



        $ws_data['request'] = $request;
        $postdata = json_encode($ws_data);
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        // $posting = ' {
        //     "metaData": {
        //         "code": "200",
        //         "message": "Ok"
        //     },
        //     "response": {
        //         "noSuratKontrol": "0301R0110520K000013",
        //         "tglRencanaKontrol": "2020-05-15",
        //         "namaDokter": "Dr. John Wick",
        //         "noKartu": "0001328186441",
        //         "nama": "ARIS",
        //         "kelamin": "Laki-laki",
        //         "tglLahir": "1947-12-31"
        //     }
        // }';
        // $response = json_decode($posting, true);
        if ($response['metaData']['code'] == '200') {
            $ik = new InasisKontrolModel();
            $data = [
                'visit_id' => $visit,
                'nosep' => $request['noSEP'],
                'surattype' => 1,
                'nosuratkontrol' => $response['response']['noSuratKontrol'],
                'tglrenckontrol' => $response['response']['tglRencanaKontrol'],
                'polikontrol_kdpoli' => $request['poliKontrol'],
                'kodedokter' => $request['kodeDokter'],
                'modified_by' => user()->username,
                'no_registration' => $nomr
            ];
            if ($method == 'POST') {
                $data['responpost'] = json_encode($response);
            } else {
                $data['responput'] = json_encode($response);
            }

            // return json_encode($data);

            $ik->save($data);
        }

        return json_encode($response);
    }
    public function deleteSkdp()
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $request = $body;

        $ws_data = [];
        $method = 'DELETE';
        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/';
        $url .= 'Delete';



        $ws_data = $request;
        $postdata = json_encode($ws_data);
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        if ($response['metaData']['code'] == '200') {
            $ik = new InasisKontrolModel();
            $ik->delete($request['request']['t_suratkontrol']['noSuratKontrol']);
        }
        return json_encode($response);
    }

    public function checkSkdp()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $ik = new InasisKontrolModel();
        $select = $ik->where('visit_id', $visit)->where('surattype', 1)->findAll();
        $select = $this->lowerKey($select);

        if (isset($select[0])) {
            $response['metadata']['code'] = '200';
            $response['metadata']['mesasge'] = 'Data SKDP ditemukan';
            $response['data'] = $select[0];
        } else {
            $response['metadata']['code'] = '201';
            $response['metadata']['mesasge'] = 'Data SKDP tidak ditemukan';
        }
        return json_encode($response);
    }
    public function getRujukan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $norujukan = $body['norujukan'];
        $nokartu = $body['nokartu'];
        $asalrujukan = $body['asalrujukan'];


        $ws_data = [];
        $method = 'GET';
        if ($norujukan != '' && $norujukan != null) {
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/';
            if ($asalrujukan == '2') {
                $url .= 'RS/';
            }
            $url .= $norujukan;
        } else {
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/';
            if ($asalrujukan == '2') {
                $url .= 'RS/';
            }
            $url .= 'Peserta/' . $nokartu;
        }

        // return json_encode($url);

        $ws_data = array();
        $postdata = json_encode($ws_data);
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;

        return json_encode($response);
    }
    public function insertSep()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        if ($body['jnsPelayanan'] == 2) {
            $body['klsRawat']['klsRawatNaik'] = "";
            $body['klsRawat']['pembiayaan'] = "";
            $body['klsRawat']['penanggungJawab'] = "";
        }
        if ($body['flagProcedure'] == '99') {
            $body['flagProcedure'] = '';
        }
        if ($body['kdPenunjang'] == '99') {
            $body['kdPenunjang'] = '';
        }

        $ws_data = [];
        $method = 'POST';
        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/insert';

        // return json_encode($url);

        $ws_data['request']['t_sep'] = $body;
        $postdata = json_encode($ws_data);
        // return $postdata;
        // $posting = $this->sendVclaim($url, $method, $postdata);
        // $response = $posting;
        $posting = '{
                "metaData": {
                    "code": "200",
                    "message": "Sukses"
                },
                "response": {
                    "sep": {
                        "assestmenPel": "1",
                        "catatan": "testinsert RJ",
                        "diagnosa": "A15 - Respiratory tuberculosis, bacteriologically and histologically confirmed",
                        "flagProcedure": "",
                        "informasi": {
                            "dinsos": null,
                            "eSEP": "True",
                            "noSKTM": null,
                            "prolanisPRB": null
                        },
                        "jnsPelayanan": "R.Jalan",
                        "kdPenunjang": "",
                        "kdPoli": "INT",
                        "kelasRawat": "-",
                        "noRujukan": "0050B1070223P000004",
                        "noSep": "0301R0010323V000039",
                        "penjamin": "-",
                        "peserta": {
                            "asuransi": "-",
                            "hakKelas": "Kelas 3",
                            "jnsPeserta": "PBI (APBN)",
                            "kelamin": "Perempuan",
                            "nama": "ARSTNUU",
                            "noKartu": "0002802875185",
                            "noMr": "MR5185",
                            "tglLahir": "1944-02-24"
                        },
                        "poli": "PENYAKIT DALAM",
                        "poliEksekutif": "Tidak",
                        "tglSep": "2023-03-30",
                        "tujuanKunj": "2"
                    }
                }
            }';
        $response = json_decode($posting, true);


        return json_encode($response);
    }
    public function editSep()
    {
        if (!$this->request->is('put')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        if ($body['jnsPelayanan'] == 2) {
            $body['klsRawat']['klsRawatNaik'] = "";
            $body['klsRawat']['pembiayaan'] = "";
            $body['klsRawat']['penanggungJawab'] = "";
        }

        $ws_data = [];
        $method = 'PUT';
        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/update';

        // return json_encode($url);

        $ws_data['request']['t_sep'] = $body;
        $postdata = json_encode($ws_data);
        // return $postdata;
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        // $posting = '{
        //         "metaData": {
        //             "code": "200",
        //             "message": "Sukses"
        //         },
        //         "response": {
        //             "sep": {
        //                 "assestmenPel": "1",
        //                 "catatan": "testinsert RJ",
        //                 "diagnosa": "A15 - Respiratory tuberculosis, bacteriologically and histologically confirmed",
        //                 "flagProcedure": "",
        //                 "informasi": {
        //                     "dinsos": null,
        //                     "eSEP": "True",
        //                     "noSKTM": null,
        //                     "prolanisPRB": null
        //                 },
        //                 "jnsPelayanan": "R.Jalan",
        //                 "kdPenunjang": "",
        //                 "kdPoli": "INT",
        //                 "kelasRawat": "-",
        //                 "noRujukan": "0050B1070223P000004",
        //                 "noSep": "0301R0010323V000039",
        //                 "penjamin": "-",
        //                 "peserta": {
        //                     "asuransi": "-",
        //                     "hakKelas": "Kelas 3",
        //                     "jnsPeserta": "PBI (APBN)",
        //                     "kelamin": "Perempuan",
        //                     "nama": "ARSTNUU",
        //                     "noKartu": "0002802875185",
        //                     "noMr": "MR5185",
        //                     "tglLahir": "1944-02-24"
        //                 },
        //                 "poli": "PENYAKIT DALAM",
        //                 "poliEksekutif": "Tidak",
        //                 "tglSep": "2023-03-30",
        //                 "tujuanKunj": "2"
        //             }
        //         }
        //     }';
        // $response = json_decode($posting, true);


        return json_encode($response);
    }
    public function deleteSep()
    {
        if (!$this->request->is('delete')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);



        $ws_data = [];
        $method = 'DELETE';
        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/SEP/2.0/delete';

        // return json_encode($url);

        $ws_data['request']['t_sep'] = $body;
        $postdata = json_encode($ws_data);
        // return $postdata;
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;
        // $posting = '{
        //         "metaData": {
        //             "code": "200",
        //             "message": "Sukses"
        //         },
        //         "response": {
        //             "sep": {
        //                 "assestmenPel": "1",
        //                 "catatan": "testinsert RJ",
        //                 "diagnosa": "A15 - Respiratory tuberculosis, bacteriologically and histologically confirmed",
        //                 "flagProcedure": "",
        //                 "informasi": {
        //                     "dinsos": null,
        //                     "eSEP": "True",
        //                     "noSKTM": null,
        //                     "prolanisPRB": null
        //                 },
        //                 "jnsPelayanan": "R.Jalan",
        //                 "kdPenunjang": "",
        //                 "kdPoli": "INT",
        //                 "kelasRawat": "-",
        //                 "noRujukan": "0050B1070223P000004",
        //                 "noSep": "0301R0010323V000039",
        //                 "penjamin": "-",
        //                 "peserta": {
        //                     "asuransi": "-",
        //                     "hakKelas": "Kelas 3",
        //                     "jnsPeserta": "PBI (APBN)",
        //                     "kelamin": "Perempuan",
        //                     "nama": "ARSTNUU",
        //                     "noKartu": "0002802875185",
        //                     "noMr": "MR5185",
        //                     "tglLahir": "1944-02-24"
        //                 },
        //                 "poli": "PENYAKIT DALAM",
        //                 "poliEksekutif": "Tidak",
        //                 "tglSep": "2023-03-30",
        //                 "tujuanKunj": "2"
        //             }
        //         }
        //     }';
        // $response = json_decode($posting, true);


        return json_encode($response);
    }
}
