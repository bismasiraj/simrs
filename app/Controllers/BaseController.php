<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use Psr\Log\LoggerInterface;
use LZCompressor\LZString;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'auth'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Add these lines
        $session = \Config\Services::session();
        $language = \Config\Services::language();
        $language->setLocale($session->lang);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    public function jenisPasien()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('status_pasien');
        $builder->select('status_pasien_id, name_of_status_pasien')
            ->where('NAME_OF_STATUS_PASIEN is not null')
            ->orderBy('status_pasien_id');
        $jenisPasien = $builder->get();
        // $jenisPasien = json_decode(json_encode($jenisPasien), true);
        return json_decode(json_encode($jenisPasien->getResult()), true);
    }
    function composePatientName($patient_name, $patient_id)
    {
        $name = "";
        if ($patient_name != "") {
            $name = ($patient_id != "") ? $patient_name . " (" . $patient_id . ")" : $patient_name;
        }

        return $name;
    }
    function getPatientAge($year, $month, $day)
    {

        $age = "";

        if ($year != 0) {
            $age .= $year . ' th ';
        }

        if ($month != 0) {
            $age .= $month . ' bl ';
        }

        if ($day != 0) {
            $age .= $day . ' hr';
        }

        return $age;
    }
    function lowerKey($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key1 => $value1) {
                    $result[strtolower($key)][strtolower($key1)] = $value1;
                }
            } else {
                $result[strtolower($key)] = $value;
            }
        }
        return $result;
    }


    function checkMenuActive($menuname)
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $session = session();
        $selectedMenu = [];
        if (!empty($session->get('selectedMenu')))
            $selectedMenu = $session->get('selectedMenu');
        $selectedMenu[] = basename($actual_link);
        // dd($selectedMenu);
        foreach ($selectedMenu as $value) {
            if ($menuname == $value) {
                // return 'active';
                return 'mm-active';
            }
        }
    }

    private $urlvclaim = 'https://apijkn.bpjs-kesehatan.go.id/antreanrs/';
    protected $keybridging = 'f3a070d3b5acc9f61653215f1ac5465d5dabe4b34f86e264e9eb162b4d92f70b';
    protected function stringDecrypt($key, $string)
    {


        $encrypt_method = 'AES-256-CBC';

        // hash
        $key_hash = hex2bin(hash('sha256', $key));

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        return $output;
    }
    protected function decompress($string)
    {
        $return = LZString::decompressFromEncodedURIComponent($string);
        $return = json_decode(($return), true);
        return $return;
    }
    protected function AuthBridging()
    {
        $pdo = db_connect();


        // //WATES
        // $consId = '30659';
        // $consSecret = 'rsud766wates38';
        // $userKey = '70b62d70a50f4866e8484a065a0de1bb';

        //BENGKULU
        $consId = '4633';
        $consSecret = 'rsud344myns618';
        $userKey = '3c6bee8d6d6a74c295e50f462810c43d';



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
    protected function SendBridging($url, $method, $postdata, $headers)
    {
        // Gunakan curl untuk mengakses/merequest alamat api
        if (strpos($url, 'aplicaresws') == true) {
            array_push($headers, "Content-type: Application/json");
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $results = curl_exec($curl);
        curl_close($curl);

        // return $results;
        $results = json_decode(($results), true);
        if (str_contains($url, 'SEP/2.0/inserts')) {
            $results = '{
           "metadata": {
              "code": "200",
              "message": "Sukses"
           },
           "response": {
              "sep": {
                 "catatan": "test",
                 "diagnosa": "A00.1 - Cholera due to Vibrio cholerae 01, biovar eltor",
                 "jnsPelayanan": "R.Inap",
                 "kelasRawat": "1",
                 "noSep": "0301R0011117V000008",
                 "penjamin": "-",
                 "peserta": {
                    "asuransi": "-",
                    "hakKelas": "Kelas 1",
                    "jnsPeserta": "PNS PUSAT",
                    "kelamin": "Laki-Laki",
                    "nama": "ZIYADUL",
                    "noKartu": "0001112230666",
                    "noMr": "123456",
                    "tglLahir": "2008-02-05"
                 },
                 "informasi:": {
                    "Dinsos":null,
                    "prolanisPRB":null,
                    "noSKTM":null
                 },
                 "poli": "-",
                 "poliEksekutif": "-",
                 "tglSep": "2017-10-12"
              }
           }
        }';
            $results = json_decode($results, true);
        } else if (isset($results['response'])) {
            if (strpos($url, 'aplicaresws') == false) {
                $result = $this->stringDecrypt($this->keybridging, $results['response']);
                $result = $this->decompress($result);
            } else {
                $result = $results;
            }
            $results['response'] = $result;
        }
        return $results;
    }
    protected function sendVclaim($url, $method, $data)
    {

        // $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/insert';
        // $method = 'POST';
        $headers = $this->AuthBridging();

        $postdata = ($data);
        array_push($headers, 'Content-length' . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        return ($result);
        // ->json($result)
        // ->header('Access-Control-Allow-Origin','*')
        // ->header('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS');
    }
}
