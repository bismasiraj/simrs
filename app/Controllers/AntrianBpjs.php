<?php

namespace App\Controllers;

use App\Models\AntrianPendaftaranModel;
use App\Models\BatchingBridgingModel;
use App\Models\DoctorScheduleModel;
use App\Models\PasienVisitationModel;
use CodeIgniter\I18n\Time;
use LZCompressor\LZString;

class AntrianBpjs extends \App\Controllers\BaseController
{
    // private $url = 'https://apijkn.bpjs-kesehatan.go.id/antreanrs';
    private $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev/';

    // function lzstring decompress https://github.com/nullpunkt/lz-string-php

    // public function AuthBridgingAntrean()
    // {
    //     // tester sampangan
    //     $consId = '25558';
    //     $consSecret = '1hQ5EFD3B5';
    //     $userKey = '86eeb2685a0e05c9dd0ccf73b711f6ad';
    //     $current_timestamp = Time::now()->timestamp;
    //     $this->keybridging = $consId . $consSecret . $current_timestamp;
    //     $db = db_connect('default');
    //     $signature = $db->query("DECLARE  @return_value int,
    //                                 @h64 varchar(max)

    //                             EXEC    @return_value = [dbo].[SP_H002]
    //                                     @CONS = N'$consId',
    //                                     @TIMESTMP = N'$current_timestamp',
    //                                     @MESSAGES = N'$consSecret',
    //                                     @h64 = @h64 OUTPUT
    //                             SELECT  @h64 as N'h64'");
    //     $signature = json_decode(json_encode($signature), true);
    //     $headers = [
    //         "X-cons-id: " . $consId,
    //         "X-Timestamp: " . $current_timestamp,
    //         "X-signature: " . $signature[0]['h64'],
    //         "user-key: " . $userKey,
    //         "Content-type: application/json",
    //         "Accept: application/json"
    //     ];

    //     return $headers;
    // }
    private function checkResponse($result, $body, $url, $type)
    {
        $bb = new BatchingBridgingModel();

        if (!isset($result['metadata']['code']) || $result['metadata']['code'] != '200') {
            $bb->where("trans_id = '" . $body['kodebooking'] . "' and tipe = '" . $type . "'")->delete();
            $bb->insert([
                'no_registration' => $body['norm'],
                'trans_id' => $body['kodebooking'],
                'url' => $url,
                'method' => 'POST',
                'parameter' => json_encode($body),
                'result' => json_encode($result),
                // 'STATUS'=>$result['metadata']['code'],
                'created_date' => Time::now(),
                'modified_date' => Time::now(),
                'tipe' => $type
            ]);
            $pv = new PasienVisitationModel();
            $pv->where('trans_id', $body['kodebooking'])->set('statusantrean', $type)->update();
        } else {
            $bb->where("trans_id = '" . $body['kodebooking'] . "' and tipe = '" . $type . "'")->delete();
            $bb->insert([
                'no_registration' => $body['norm'],
                'trans_id' => $body['kodebooking'],
                'url' => $url,
                'method' => 'POST',
                'parameter' => json_encode($body),
                'result' => json_encode($result),
                'status' => $result['metadata']['code'],
                'created_date' => Time::now(),
                'modified_date' => Time::now(),
                'tipe' => $type
            ]);
        }
    }

    public function tambahAntrean()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $employeeId = $body['employee_id'];
        $clinicId = $body['clinic_id'];

        $visitDate = $body['tanggalperiksa'];
        $ticket = $body['angkaantrean'];


        $ds = new DoctorScheduleModel();

        $select = $ds->where("day_id = DATEPART(dw,'" . $visitDate . "')")
            ->where("employee_id = '$employeeId'")
            ->where('clinic_id', $clinicId)
            ->select("ABS(DATEDIFF_BIG(MILLISECOND,'" . $visitDate . "'+start_time,'1970-01-01 00:00:00.000')
                                                    + (" . $ticket . "-1)*10*60*1000)
                                                     as estimasidilayani,
                            (isnull(maxquota,40) - " . $ticket . ") as sisakuotajkn,
                            isnull(maxquota,40) as kuotajkn,
                            (isnull(maxquota,40) - " . $ticket . ") as sisakuotanonjkn,
                            isnull(maxquota,40) as kuotanonjkn,
                            ''keterangan")
            ->first();
        if (!isset($select['estimasidilayani'])) {
            return response()->setStatusCode(503, "Jadwal dokter tidak tersedia. Silahkan atur ulang jadwal dokter.");
        }

        $body['estimasidilayani'] = $select['estimasidilayani'];
        $body['sisakuotajkn'] = $select['sisakuotajkn'];
        $body['kuotajkn'] = $select['kuotajkn'];
        $body['sisakuotanonjkn'] = $select['sisakuotanonjkn'];
        $body['kuotanonjkn'] = $select['kuotanonjkn'];

        $url = $this->url . "/antrean/add";
        $method = 'POST';

        $postdata = json_encode($body);

        unset($result);
        $headers = $this->AuthBridging();
        // return json_encode($postdata);
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        $this->checkResponse($result, $body, $url, 1);
        return json_encode($result);
    }
    public function deleteAntrean()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);



        $url = $this->url . "/antrean/batal";
        $method = 'POST';

        $postdata = json_encode($body);

        unset($result);
        $headers = $this->AuthBridging();
        // return json_encode($postdata);
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        $this->checkResponse($result, $body, $url, 1);
        return json_encode($result);
    }
    public function updateWaktu()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);
        // return json_encode($body['waktu']);

        $url = $this->url . "/antrean/updatewaktu";

        if (!isset($body['waktu'])) {
            // return json_encode($body['waktu']);

            $ap = new AntrianPendaftaranModel();
            if ($body['taskid'] == '1') {
                $antrianPendaftaran = $ap->select("abs(DATEDIFF_BIG(MILLISECOND,dateadd(hour,-7,ap.tanggal_daftar),'1970-01-01 00:00:00.000')) as tanggal_daftar")
                    ->join('pasien_visitation pv', 'pv.ticket_all = antrian_pendaftaran.id', 'inner')
                    ->where("pv.clinic_id_from", 'P000')
                    ->where('trans_id', $body['kodebooking'])
                    ->findAll();
                // $antrianPendaftaran = DB::select("select abs(DATEDIFF_BIG(MILLISECOND,dateadd(hour,-7,ap.tanggal_daftar),'1970-01-01 00:00:00.000')) as tanggal_daftar
                //                          from antrian_pendaftaran ap inner join pasien_visitation pv on pv.ticket_all = ap.id
                //                          where pv.clinic_id_from = 'P000' and trans_id = '" . $body['kodebooking'] . "'");
                // $antrianPendaftaran = json_decode(json_encode($antrianPendaftaran), true);
                if (!isset($antrianPendaftaran[0]['tanggal_daftar'])) {
                    $body['waktu'] = Time::now()->setTimezone('Asia/Jakarta')->timestamp * 1000 - 960000;
                } else {
                    $body['waktu'] = (float)$antrianPendaftaran[0]['tanggal_daftar'];
                }
            } elseif ($body['taskid'] == '2') {
                $antrianPendaftaran = $ap->select("abs(DATEDIFF_BIG(MILLISECOND,dateadd(hour,-7,ap.tanggal_panggil),'1970-01-01 00:00:00.000')) as tanggal_panggil")
                    ->join('pasien_visitation pv', 'pv.ticket_all = antrian_pendaftaran.id', 'inner')
                    ->where("pv.clinic_id_from", 'P000')
                    ->where('trans_id', $body['kodebooking'])
                    ->findAll();
                // $antrianPendaftaran = DB::select("select abs(DATEDIFF_BIG(MILLISECOND,dateadd(hour,-7,ap.tanggal_panggil),'1970-01-01 00:00:00.000')) as tanggal_panggil
                //                          from antrian_pendaftaran ap inner join pasien_visitation pv on pv.ticket_all = ap.id
                //                          where pv.clinic_id_from = 'P000' and trans_id = '" . $body['kodebooking'] . "'");
                // $antrianPendaftaran = json_decode(json_encode($antrianPendaftaran), true);
                if (!isset($antrianPendaftaran[0]['tanggal_panggil'])) {
                    $body['waktu'] = Time::now()->setTimezone('Asia/Jakarta')->timestamp * 1000 - 160000;
                } else {
                    $body['waktu'] = (float)$antrianPendaftaran[0]['tanggal_panggil'];
                }
            } else {
                $body['waktu'] = Time::now()->setTimezone('Asia/Jakarta')->timestamp * 1000;
            }
        }
        $mil = $body['waktu'];
        $seconds = $mil / 1000;
        //echo date("d-m-Y", $seconds);
        // return $body;
        $postdata = json_encode($body);
        unset($result);
        $headers = $this->AuthBridging();
        // return json_encode($headers);
        $method = 'POST';
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);
        // return $result;
        // $result = json_decode($result,true);

        if ($result['metadata']['code'] == '200') {
            $this->checkResponse($result, $body, $url, '2' . $body['taskid']);
            $db = db_connect();
            $db->query("update BATCHING_BRIDGING
                          set waktu = DATEADD(S, CONVERT(int,LEFT($seconds, 10)), '1970-01-01')
                          where tipe like '2" . $body['taskid'] . "' and trans_id = '" . $body['kodebooking'] . "';");
        }

        return json_encode($result);
    }
    public function updateStatusAntraenPV()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $trans = $body['kodebooking'];
        $task = $body['taskid'];

        $pv = new PasienVisitationModel();
        $response = $pv->where('trans_id', $trans)->set('statusantrean', $task)->update();

        if ($response) {
            return json_encode("berhasil simpan");
        } else {
            return response()->setStatusCode(401, "Gagal simpan");
        }
    }
}
