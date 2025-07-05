<?php

namespace App\Controllers;

use App\Models\AntrianPendaftaranModel;
use App\Models\BatchingBridgingModel;
use App\Models\DoctorScheduleModel;
use App\Models\PasienVisitationModel;
use CodeIgniter\I18n\Time;
use LZCompressor\LZString;

class ApotekBpjs extends \App\Controllers\BaseController
{
    private $url = 'https://apijkn.bpjs-kesehatan.go.id/apotek-rest';
    // private $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/apotek-rest-dev';


    // function lzstring decompress https://github.com/nullpunkt/lz-string-php

    protected function AuthBridgingApotek()
    {
        $pdo = db_connect();

        // Sampangan
        // $consId = '17221';
        // $consSecret = '3tK71AEF7D';
        // $userKey = 'eb3699cf2c74d04e8872608623d3dd6d';
        $consId = '25558';
        $consSecret = '1hQ5EFD3B5';
        $userKey = '6e6af96c3aa5329ffba264db0fc4347d';


        $current_timestamp = Time::now()->timestamp;
        $this->keybridging = $consId . $consSecret . $current_timestamp;
        $db = db_connect('default');
        $builder = $db->query("DECLARE  @return_value int,
        @h64 varchar(max)

    EXEC    @return_value = [dbo].[SP_H002]
            @CONS = N'$consId',
            @TIMESTMP = N'$current_timestamp',
            @MESSAGES = N'$consSecret',
            @h64 = @h64 OUTPUT
    SELECT  @h64 as N'h64'");
        $signature = $builder->getResultArray();
        // return json_encode($signature);
        $signature = json_decode(json_encode($signature), true);
        $headers = [
            "X-cons-id: " . $consId,
            "X-Timestamp: " . $current_timestamp,
            "X-signature: " . $signature[0]['h64'],
            "user-key: " . $userKey,
            // "Content-type: Application/json",
            "Accept: */*"
        ];

        return ($headers);
    }
    private function checkResponse($result, $body, $url, $type)
    {
        $bb = new BatchingBridgingModel();

        if (!isset($result['metadata']['code']) || $result['metadata']['code'] != '200') {
            $bb->insert([
                'NO_REGISTRATION' => $body['norm'],
                'TRANS_ID' => $body['kodebooking'],
                'url' => $url,
                'METHOD' => 'POST',
                'PARAMETER' => json_encode($body),
                'RESULT' => json_encode($result),
                // 'STATUS'=>$result['metadata']['code'],
                'CREATED_DATE' => Time::now(),
                'MODIFIED_DATE' => Time::now(),
                'TIPE' => $type
            ]);
            $pv = new PasienVisitationModel();
            $pv->where('trans_id', $body['kodebooking'])->set('statusantrean', $type)->update();
        } else {
            $bb->insert([
                'NO_REGISTRATION' => $body['norm'],
                'TRANS_ID' => $body['kodebooking'],
                'url' => $url,
                'METHOD' => 'POST',
                'PARAMETER' => json_encode($body),
                'RESULT' => json_encode($result),
                'STATUS' => $result['metadata']['code'],
                'CREATED_DATE' => Time::now(),
                'MODIFIED_DATE' => Time::now(),
                'TIPE' => $type
            ]);
        }
    }

    public function getRef($urlpath, $urlpathii = '', $urlpathiii = '')
    {
        $url = $this->url . "/referensi/" . $urlpath;
        if ($urlpathii != '') {
            $url .= "/" . $urlpathii;
        }
        if ($urlpathiii != '') {
            $url .= "/" . $urlpathiii;
        }
        $method = 'GET';

        $postdata = json_encode([]);

        unset($result);
        $headers = $this->AuthBridgingApotek();
        // dd($url);
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);
        // dd(($result));

        return json_encode($result);
    }
    public function get($urlpath, $urlpathii = '', $urlpathiii = '')
    {
        $url = $this->url . "/" . $urlpath;
        if ($urlpathii != '') {
            $url .= "/" . $urlpathii;
        }
        if ($urlpathiii != '') {
            $url .= "/" . $urlpathiii;
        }
        $method = 'GET';

        $postdata = json_encode([]);

        unset($result);
        $headers = $this->AuthBridgingApotek();
        // dd($url);
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        return json_encode($result);
    }
    public function getRefPoli()
    {
        $url = $this->url . "/referensi/dpho";
        $method = 'GET';

        $postdata = json_encode([]);

        unset($result);
        $headers = $this->AuthBridgingApotek();
        // dd($url);
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        return json_encode($result);
    }
    public function postingNoResep()
    {
        // if (!$this->request->is('post')) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }



        $url = $this->url . "/sjpresep/v3/insert";

        $body = [
            "TGLSJP" => "2024-07-09 18:13:11",
            "REFASALSJP" => "0171R0200724V000002",
            "POLIRSP" => "IGD",
            "KDJNSOBAT" => "3",
            "NORESEP" => "12346",
            "IDUSERSJP" => "bisma",
            "TGLRSP" => "2024-07-04 00:00:00",
            "TGLPELRSP" => "2024-07-04 00:00:00",
            "KdDokter" => "143675",
            "iterasi" => "0"
        ];

        $postdata = json_encode($body);
        unset($result);
        $headers = $this->AuthBridgingApotek();
        $headers['Content-type'] = "Application/x-www-form-urlencoded";
        $method = 'POST';
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);
        // return $result;
        // $result = json_decode($result,true);


        return json_encode($result);
    }
    public function postingNonRacik()
    {
        // if (!$this->request->is('post')) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }



        $url = $this->url . "/obatnonracikan/v3/insert";

        $body = [
            "NOSJP" => "0171A04307240000001",
            "NORESEP" => "12346",
            "KDOBT" => "12240302097",
            "NMOBAT" => "Melfalan 2 SK tab 2 mg",
            "SIGNA1OBT" => 1,
            "SIGNA2OBT" => 1,
            "JMLOBT" => 1,
            "JHO" => 1,
            "CatKhsObt" => "TES"
        ];

        $postdata = json_encode($body);
        unset($result);
        $headers = $this->AuthBridgingApotek();
        $headers['Content-type'] = "Application/x-www-form-urlencoded";
        $method = 'POST';
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);
        // return $result;
        // $result = json_decode($result,true);


        return json_encode($result);
    }
    public function postingRacik()
    {
        // if (!$this->request->is('post')) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }



        $url = $this->url . "/obatracikan/v3/insert";

        $body = [
            "NOSJP" => "0171A04307240000001",
            "NORESEP" => "12346",
            "JNSROBT" => "H.1231",
            "KDOBT" => "12240303959",
            "NMOBAT" => "Azatioprin 50 SK tab 50 mg",
            "SIGNA1OBT" => 1,
            "SIGNA2OBT" => 1,
            "PERMINTAAN" => 1,
            "JMLOBT" => 23,
            "JHO" => 23,
            "CatKhsObt" => "RACIKAN 1"
        ];

        // return json_encode($body);

        $postdata = json_encode($body);
        unset($result);
        $headers = $this->AuthBridgingApotek();
        $headers['Content-type'] = "Application/x-www-form-urlencoded";
        $method = 'POST';
        array_push($headers, "Content-length: " . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);
        // return $result;
        // $result = json_decode($result,true);


        return json_encode($result);
    }
}
