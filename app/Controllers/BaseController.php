<?php

namespace App\Controllers;

use App\Helpers\RsaEncryptionHelper;
use App\Models\Assessment\FallRiskDetailModel;
use App\Models\Assessment\GcsModel;
use App\Models\Assessment\PainDetilModel;
use App\Models\Assessment\PasienTransferModel;
use App\Models\AssessmentAnesthesiaChecklist;
use App\Models\AssessmentAnesthesiaModel;
use App\Models\AssessmentOperationModel;
use App\Models\AssessmentPraOperasi;
use App\Models\AssessmentPraOperasiModel;
use App\Models\ClinicModel;
use App\Models\DietInapModel;
use App\Models\DocsSignedModel;
use App\Models\EmployeeAllModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\FisioterapiScheduleModel;
use App\Models\FollowUpModel;
use App\Models\FoodRecallModel;
use App\Models\GiziModel;
use App\Models\InasisKontrolModel;
use App\Models\InasisRujukanModel;
use App\Models\InformedConsentModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienKonsulanModel;
use App\Models\PasienModel;
use App\Models\PasienPenunjangModel;
use App\Models\PatientOperationCheck;
use App\Models\PatientOperationRequestModel;
use App\Models\PersalinanModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\RawSql;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use DateTime;
use Psr\Log\LoggerInterface;
use LZCompressor\LZString;
use Myth\Auth\Models\UserModel;

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
    protected $baseurlvclaim = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest';
    protected $baseurlaplicares = 'https://apijkn.bpjs-kesehatan.go.id/aplicaresws';
    // public $imageloc = WRITEPATH;
    public $imageloc = 'C:\Users\Public\Pictures\\';
    // protected $baseurlvclaim = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev';



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

        if ($array === null) {
            return $result;
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[strtolower($key)] = array();
                foreach ($value as $key1 => $value1) {
                    $result[strtolower($key)][strtolower($key1)] = $value1;
                }
            } else {
                $result[strtolower($key)] = $value;
            }
        }

        return $result;
    }
    function lowerKeyOne($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $result[strtolower($key)] = $value;
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
    function getLastUrl($menuname)
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
                return true;
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
    protected function AuthBridging($thetype = 'antrol')
    {
        $pdo = db_connect();

        if ($thetype == 'antrol') { //antrol
            //tester
            // $consId = '16957';
            // $consSecret = '7dK0AAC16B';
            // $userKey = '6a7b82093922c4fafd211cfed64e82d9';

            //live
            $consId = '25558';
            $consSecret = '1hQ5EFD3B5';
            $userKey = '86eeb2685a0e05c9dd0ccf73b711f6ad';
        } else if ($thetype = 'vclaim') {
            //tester
            // $consId = '16957';
            // $consSecret = '7dK0AAC16B';
            // $userKey = '667fedd9bbe6b6865fdc8abb7fd50848';

            //live
            $consId = '25558';
            $consSecret = '1hQ5EFD3B5';
            $userKey = '6e6af96c3aa5329ffba264db0fc4347d';
        }



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
        if (strpos($url, 'SEP/2.0/inserts') !== false) {
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
        $headers = $this->AuthBridging('vclaim');
        array_push($headers, "Content-type:application/json");

        $postdata = ($data);
        array_push($headers, 'Content-length' . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        // return ($headers);
        return ($result);
    }
    protected function sendAplicares($url, $method, $data)
    {

        // $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/insert';
        // $method = 'POST';
        $headers = $this->AuthBridging('vclaim');
        // array_push($headers, "Content-type:application/json");

        $postdata = ($data);
        array_push($headers, 'Content-length' . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);

        // return ($headers);
        return ($result);
    }
    protected function sendIcare($url, $method, $data)
    {

        // $url = 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/SEP/2.0/insert';
        // $method = 'POST';
        $headers = $this->AuthBridging('vclaim');
        $headers[] = "Content-type: application/json";

        $postdata = ($data);
        array_push($headers, 'Content-length' . strlen($postdata));
        $result = $this->SendBridging($url, $method, $postdata, $headers);
        return $result;

        // return ($headers);   
        // return ([$url, $method, $postdata, $headers]);
        // ->json($result)
        // ->header('Access-Control-Allow-Origin','*')
        // ->header('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS');
    }
    public function generateId($selectPoli, $no_registration)
    {
        $db = db_connect();
        $builder = $db->query("select top (1) convert(varchar, getdate(), 112)+'$selectPoli'+'$no_registration' as visit_id,
        '$no_registration' + convert(varchar, getdate(), 112) +right(newid(),4) as trans_id,
        ISNULL((SELECT MAX(TICKET_NO) FROM PASIEN_VISITATION WHERE CLINIC_ID = '$selectPoli' AND  convert(varchar, visit_date, 23) = convert(varchar, getdate(), 23)  ),0)+1 as ticket_no,
        newid() as ssencounter_id");
        return $builder->getResultArray();
    }
    public function generateIdTgl()
    {
        $db = db_connect();
        $builder = $db->query("select cast(year(getdate()) as varchar(4)) +
                                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) theid
                                ")->getResultArray();
        $id = $builder[0]['theid'];
        return $id;
    }

    public function cekTindakanTarif($tipe)
    {
        if ($tipe == 1)
            $tarif = '02001';
        if ($tipe == 5)
            $tarif = '020003';
        if ($tipe == 3)
            $tarif = '020006';
        if ($tipe == 7)
            $tarif = '020007';
        if ($tipe == 2)
            $tarif = '020009';
        if ($tipe == 11)
            $tarif = '020011';
        if ($tipe == 12)
            $tarif = '020012';
        if ($tipe == 13)
            $tarif = '020013';
        if ($tipe == 14)
            $tarif = '020014';
        if ($tipe == 15)
            $tarif = '020015';

        return $tarif;

        // if liTipe=1 then lsTarif='020001'	//karcis
        // if liTipe=5 then lsTarif='020003'  //karcis UGD
        // if litipe=3 then lsTarif='020006'   //rawat inap												
        // if litipe=7   then lsTarif='020007'   //rawat inap		
        // if litipe=2   then lsTarif='020009'   //penunjang
        // if litipe=11   then lsTarif='020011'   //spesialis	
        // if litipe=12   then lsTarif='020012'   //mcu
        // if litipe=13   then lsTarif='020013'   //igd
        // if litipe=14   then lsTarif='020014'   //subspesialis
        // if litipe=15   then lsTarif='020015'   //umum-gigi	
        // return lsTarif
    }
    public function saveTarifDaftar($data, $tindakan, $nota)
    {
        // if isnull(sKunj.cost_center) or sKunj.cost_center="" then
        //     select account_id into :lsCC from pasien where no_registration=:sKunj.nomor;
        // else	
        // lsCC = sKunj.cost_center
        // end if
        $employeeId = $data['employee_id'];
        $db = db_connect();
        $select = $db->query("select ea.fullname from employee_all ea where ea.employee_id ='$employeeId'")->getResultArray();
        $dokter = $select[0]['fullname'];

        $select = $db->query("select  tt.tarif_id,tt.tarif_name,
                                (select sum(amount) from tarif_comp where
                                tarif_id = tt.tarif_id) as jml,  class_id, tt.iscito, tt.tarif_type
                                from treat_tarif tt
                                where tt.treat_id='$tindakan'")->getResultArray();
        if (isset($select[0])) {
            $tarif_id = $select[0]['tarif_id'];
            $tarif_name = $select[0]['tarif_name'];
            $jml = $select[0]['jml'];
            $class_id = $select[0]['class_id'];
            $iscito = $select[0]['iscito'];
            $tarif_type = $select[0]['tarif_type'];

            // select  tt.tarif_id,tt.tarif_name, &
            // (select sum(amount) from tarif_comp where &
            // tarif_id = tt.tarif_id) as jml,  class_id, tt.iscito, tt.tarif_type
            // into :lsTarif, :lsNama, :ldcAmount, :liKelas, :lsCito, :lsTipe
            // from treat_tarif tt
            // where tt.treat_id=:tindakan

            if (is_null($data['class_id_plafond'])) {
                $kelas = $data['class_id'];
            } else {
                $kelas = $data['class_id_plafond'];
            }

            // if isnull(sKunj.class_id_plafond) then
            //     liKelasP = sKunj.class_id
            // else
            //     liKelasP = sKunj.class_id_plafond
            // end if

            if (!is_null($jml) && $jml > 0) {
                $ldcSubsidi = $this->hitung_subsidi($data['status_pasien_id'], $tarif_id, $jml);

                $lsBill = $this->max_bill($data['visit_date']);

                $dataBill['org_unit_code'] = $data['org_unit_code'];
                $dataBill['no_registration'] = $data['no_registration'];
                $dataBill['thename'] = $data['diantar_oleh'];
                $dataBill['theaddress'] = $data['visitor_address'];
                $dataBill['theid'] = $data['pasien_id'];
                $dataBill['visit_id'] = $data['visit_id'];
                $dataBill['bill_id'] = $lsBill;
                $dataBill['tarif_id'] = $tarif_id;
                $dataBill['treatment'] = $tarif_name;
                $dataBill['amount'] = $jml;
                $dataBill['sell_price'] = $jml;
                $dataBill['diskon'] = 0;
                $dataBill['amount_paid'] = $jml;
                $dataBill['quantity'] = 1;
                $dataBill['subsidi'] = $ldcSubsidi;
                $dataBill['iscetak'] = '1';
                $dataBill['islunas'] = '0';
                $dataBill['clinic_id'] = $data['clinic_id'];
                $dataBill['clinic_id_from'] = $data['clinic_id_from'];
                $dataBill['employee_id'] = $data['employee_id'];
                $dataBill['doctor'] = $dokter;
                $dataBill['treat_date'] = $data['visit_date'];
                $dataBill['exit_date'] = $data['visit_date'];
                $dataBill['modified_date'] = new RawSql("getdate()");
                $dataBill['modified_by'] = user()->username;
                $dataBill['modified_from'] = $data['clinic_id'];
                $dataBill['nota_no'] = $nota;
                $dataBill['class_id'] = $data['class_id'];
                $dataBill['isrj'] = $data['isrj'];
                $dataBill['status_pasien_id'] = $data['status_pasien_id'];
                $dataBill['payor_id'] = $data['payor_id'];
                $dataBill['class_id_plafond'] = $data['class_id_plafond'];
                $dataBill['amount_plafond'] = 0;
                $dataBill['amount_paid_plafond'] = 0;
                $dataBill['ageyear'] = $data['ageyear'];
                $dataBill['agemonth'] = $data['agemonth'];
                $dataBill['ageday'] = $data['ageday'];
                $dataBill['gender'] = $data['gender'];
                $dataBill['racikan'] = 102;
                $dataBill['account_id'] = null;
                $dataBill['tagihan'] = $jml;
                $dataBill['subsidisat'] = $ldcSubsidi;
                $dataBill['tarif_type'] = $tarif_type;
                $dataBill['theorder'] = 2;
                $dataBill['trans_id'] = $data['trans_id'];

                $tb = new TreatmentBillModel();

                $tb->insert($dataBill);
            }
        }

        //         IF (not isnull(ldcAmount)) and ldcAmount > 0 then 
        // 					//do while sqlca.sqlcode = 0



        // 							ldcSubsidi = hitung_subsidi(sKunj.status_pasien,lsTarif,ldcAmount) 
        // //							if sKunj.payor <> '0' and sKunj.class_id_plafond<> 99 then //99 paket
        // //								  lrUang = get_plafond(sKunj.class_id_plafond,lsNama,lsCito)//hitung plafond 
        // //							else
        // //								  lrUang = 0
        // //							end if
        // 							lsBill=max_bill(datetime(sKunj.tgl_kunjung))

        // 							//jika belum ada biaya pendaftaran, insertkan
        // 							insert into treatment_bill
        // 								(org_unit_code, no_registration, thename,theaddress,theid,
        // 								visit_id, bill_id,  
        // 								tarif_id, treatment, 
        // 								amount, sell_price, diskon,amount_Paid, quantity, subsidi,  iscetak,
        // 								islunas,clinic_id, clinic_id_from, 
        // 								employee_id,doctor,treat_date,exit_date,  
        // 								modified_date, modified_by,
        // 								modified_from,nota_no, class_id, isRJ, 
        // 								status_pasien_id, payor_id,class_id_plafond,
        // 								amount_plafond, amount_Paid_plafond,
        // 								ageyear,agemonth,ageday,gender, kal_id,racikan,account_id, tagihan,subsidisat,tarif_type,theorder, trans_id ) //==> new TRANS_ID
        // 							values
        // 								(:gsOrg, :sKunj.nomor, :lsNamaUmur,:sKunj.alamat,:sKunj.npk,
        // 								:sKunj.kunjungan,:lsBill,
        // 								:lsTarif,:lsNama,
        // 								:ldcAmount,:ldcAmount,0,:ldcAmount,1,:ldcSubsidi,'1',
        // 								'0',:skunj.poli,:gsPoli,
        // 								:sKunj.dokter,:lsdoctor,:sKunj.tgl_kunjung, :sKunj.tgl_kunjung,
        // 								getdate(),:gsUser,
        // 								:gsPoli,:nota, :liKelas,'1',:sKunj.status_pasien,
        // 								:sKunj.payor,:liKelasP,:lrUang,:lrUang,
        // 								:liTh,:liBln,:liHr,:sKunj.sex, :sKunj.kal_id,102,:lsCC,:ldcAmount,:ldcSubsidi,:lsTipe,2,:sKunj.trans_id);
        // 							if sqlca.sqlcode = -1 then 
        // 								  MessageBox("SQL error", SQLCA.SQLErrText);
        // 								  rollback;	
        // 							elseif sqlca.sqlcode = 100 then 
        // 								  MessageBox("TARIF PENDAFTARAN", "Tarif Pendaftaran Belum ada, silakan dimasukkan secara manual!!!") ;
        // 						   elseif sqlca.sqlcode = 0 then 
        // 								  commit using sqlca;
        // 							end if

        // 						//	end if
        // //						fetch cTarif into :lsTarif, :ldcAmount,:lsNama, :liKelas;
        // //						setnull(lsBill)

        // 					//loop
        // end if

    }

    public function hitung_subsidi($status, $tarif, $biaya)
    {
        $ldcDiskon = $this->set_diskon($status, $tarif);

        if ($ldcDiskon > 1) {
            $ldcDiskon = $ldcDiskon;
        } else if ($ldcDiskon <= 1 && $ldcDiskon > 0) {
            $ldcDiskon = $ldcDiskon * $biaya;
        } else {
            $ldcDiskon = 0;
        }
        // 	set subsidi otomatis
        // decimal ldbdiskon,ldbHarga 

        // ldbDiskon = set_diskon(status,tarif);

        // if ldbDiskon > 1 then	

        //     ldbDiskon = set_diskon(status,tarif);//ldbDiskon/biaya;


        // elseif ldbDiskon <=1 and ldbDiskon >0 then

        //     ldbDiskon = set_diskon(status,tarif) * biaya;
        // else

        //     ldbDiskon=0;
        // end if


        // return ldbDiskon
    }
    public function set_diskon($status, $tarif)
    {

        $db = db_connect();
        $select = $db->query("select sum(percentage) as percentage, sum(subsidi) as subsidi from subsidi where status_pasien_id = '$status' and tarif_id = '$tarif' group by status_pasien_id, tarif_id")->getResultArray();
        if (isset($select[0])) {
            $percentage = $select[0]['percentage'];
            $subsidi = $select[0]['subsidi'];

            if (is_null($subsidi))
                $subsidi = 0;
            if (is_null($percentage))
                $percentage = 0;

            if ($subsidi == 0) {
                return $percentage;
            } else {
                return $subsidi;
            }
        } else {
            return 0;
        }


        // decimal ldcPersen, ldcSubsidi


        // declare cDisc cursor for select sum(percentage), sum(subsidi)
        // from subsidi where
        // status_pasien_id =: status and
        // tarif_id=:tarif
        // group by status_pasien_id, tarif_id;

        // open cDisc;
        // fetch cDisc into :ldcPersen,:ldcSubsidi;
        // close cDisc;

        // if isnull(ldcSubsidi) then ldcSubsidi = 0
        // if isnull(ldcPersen) then ldcPersen = 0

        // if ldcSubsidi= 0 then 
        //         return ldcPersen;
        // else
        //         return ldcSubsidi
        // end if
    }

    public function max_bill($tglKunj)
    {
        return $this->generateIdTgl();
    }
    public function cek_baru_lama_rs($no_registration, $visit_date)
    {
        $p = new PasienModel();
        $select = $p->select("case when registration_date < '$visit_date' and registration_date <> '$visit_date' then '0' else '1' end as isnew")->find($no_registration);

        return $select['isnew'];
        // datetime ldtPertama
        // ldtPertama = dw_1.getItemDateTime(dw_1.getrow(),'registration_Date')

        // if date(ldtPertama) < date(Visit)  and (date(ldtPertama) <> date(visit))  then

        //     return '0' //pasien lama
        // else
        //     return '1' //pasien baru
        // end if


        // string lsid
        // int likunj


        //         return '1' 																			

    }
    public function cek_tindakan_tarif_baru($lsbaru)
    {
        $tarif = '';
        if ($lsbaru == '1') {
            $tarif = '020005';
        }

        return $tarif;
    }
    public function customResponse($message, $statusCode)
    {
        return $this->response->setStatusCode($statusCode)->setJSON(['message' => $message]);
    }
    public function query_assessment($table, $p_type, $visit_id, $document_id)
    {
        $query =
            "
            SELECT ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER.PARAMETER_DESC,
                MAX(CASE WHEN ASSESSMENT_PARAMETER.P_TYPE = '$p_type' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID  THEN ASSESSMENT_PARAMETER_VALUE.VALUE_DESC ELSE '' END) AS VALUE_DESC,
                MAX(CASE WHEN ASSESSMENT_PARAMETER.P_TYPE = '$p_type' AND ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID THEN ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ELSE '' END) AS VALUE_SCORE
            FROM $table
                INNER JOIN ASSESSMENT_PARAMETER ON $table.P_TYPE = ASSESSMENT_PARAMETER.P_TYPE
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON $table.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
            WHERE VISIT_ID = '$visit_id'
                AND DOCUMENT_ID = '$document_id'
            GROUP BY ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER.PARAMETER_DESC
            ORDER BY PARAMETER_ID ASC
        ";
        return $query;
    }

    public function query_assessment_column_style($table, $p_type, $visit_id, $document_id)
    {
        $db = db_connect();
        $data = $db->query("select * from $table where VISIT_ID = '$visit_id' and DOCUMENT_ID = '$document_id'")->getRow(0, "array");
        $parameter = $db->query("select * from ASSESSMENT_PARAMETER ap
                    left JOIN ASSESSMENT_PARAMETER_VALUE av ON ap.P_TYPE = av.P_TYPE
                    and ap.PARAMETER_ID = av.PARAMETER_ID
                    where ap.P_TYPE = '$p_type'")->getResultArray();
        // dd(
        //     $parameter
        // );
        // return $parameter;

        $newparam = [];
        if (!is_null($data)) {
            $data = $this->lowerKeyOne($data);
            $parameter = $this->lowerKey($parameter);
            foreach ($parameter as $key => $value) {
                if ($value['entry_type'] == '1'  || $value['entry_type'] == '4' || $value['entry_type'] == '5') {
                    if (isset($data[strtolower($value['column_name'])])) {
                        $parameter[$key]['value_desc'] = $data[strtolower($value['column_name'])];
                        $newparam[] = $parameter[$key];
                    }
                } else if ($value['entry_type'] == '3') {
                    if ($value['value_score'] == $data[strtolower($value['column_name'])]) {
                        // $parameter[$key]['value_desc'] = $data[strtolower($value['column_name'])];
                        $newparam[] = $parameter[$key];
                    }
                } else if (($value['entry_type'] == '2' || $value['entry_type'] == '7') && $data[strtolower($value['column_name'])] == $value['value_score']) {
                    // return "mauk";
                    $newparam[] = $parameter[$key];
                }
            }
        }


        return $newparam;
    }
    public function query_assessment_column_style_body_id($table, $p_type, $visit_id, $document_id)
    {
        $db = db_connect();
        $data = $db->query("select * from $table where VISIT_ID = '$visit_id' and body_id = '$document_id'")->getRow(0, "array");
        $parameter = $db->query("select * from ASSESSMENT_PARAMETER ap
                    left JOIN ASSESSMENT_PARAMETER_VALUE av ON ap.P_TYPE = av.P_TYPE
                    and ap.PARAMETER_ID = av.PARAMETER_ID
                    where ap.P_TYPE = '$p_type'")->getResultArray();
        // return
        //     $data;

        $newparam = [];
        if (!is_null($data)) {
            $data = $this->lowerKeyOne($data);
            $parameter = $this->lowerKey($parameter);
            // return isset($data["kala_1"]);
            // foreach ($parameter as $key => $value) {
            //     if ($value['entry_type'] == '2' && $data[strtolower($value['column_name'])] == $value['value_score']) {
            //         $data[strtolower($value['column_name'])] = $value['value_desc'];
            //     }
            //     if ($value['entry_type'] == '3' && $data[strtolower($value['column_name'])] == $value['value_score']) {
            //         $data[strtolower($value['column_name'])] = $value['value_desc'];
            //     }
            // }
            foreach ($parameter as $key => $value) {
                if ($value['entry_type'] == '1'  || $value['entry_type'] == '4' || $value['entry_type'] == '5') {
                    if (isset($data[strtolower($value['column_name'])]) || is_null($data[strtolower($value['column_name'])])) {
                        $parameter[$key]['value_desc'] = $data[strtolower($value['column_name'])];
                        $newparam[] = $parameter[$key];
                    }
                } else if ($value['entry_type'] == '3') {
                    if ($value['value_id'] == $data[strtolower($value['column_name'])]) {
                        // $parameter[$key]['value_desc'] = $data[strtolower($value['column_name'])];
                        $newparam[] = $parameter[$key];
                    }
                } else if (($value['entry_type'] == '2' || $value['entry_type'] == '6' || $value['entry_type'] == '7') && $data[strtolower($value['column_name'])] == $value['value_id']) {
                    // return "mauk";
                    $newparam[] = $parameter[$key];
                }
            }
        }


        return $newparam;
    }

    public function query_template_info($db, $visit_id, $diagnosa_id)
    {
        $info = $this->lowerKey($db->query(
            "
            select
            pd.NO_REGISTRATION as no_RM,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end as jeniskel,
            p.CONTACT_ADDRESS as alamat,
            pd.DOCTOR as dpjp,
            pv.TRANS_ID as no_episode,
            c.name_of_clinic as departmen,
            class.NAME_OF_CLASS as kelas,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID as bed,
            cr.class_room_id,
            pd.IN_DATE as tanggal_masuk,
            convert(varchar,P.DATE_OF_BIRTH,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR
        

            from pasien_diagnosa pd 
            left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            INNER JOIN PASIEN_VISITATION pv ON pd.VISIT_ID = pv.VISIT_ID
            , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '$diagnosa_id'
            and PD.VISIT_ID =  '$visit_id'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.NO_REGISTRATION, 
            p.NAME_OF_PASIEN, 
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end, 
            p.CONTACT_ADDRESS,
            pv.TRANS_ID,
            pd.DOCTOR, 
            c.name_of_clinic, 
            class.NAME_OF_CLASS,  
            cr.NAME_OF_CLASS,  
            cr.class_room_id,
            pd.BED_ID,  
            pd.IN_DATE,
            convert(varchar,P.date_of_birth,105),
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR'"
        )->getRow(0, 'array'));

        return $info;
    }
    public function get_bodyid()
    {
        $date = new DateTime();
        $bodyId = $date->format('YmdHisv'); // Format: YYYYMMDDHHMMSSmmm
        $bodyId .= $this->makeid(3); // Append a random string of length 3
        return $bodyId;
    }

    public function makeid($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, $charactersLength - 1)];
        }
        return $result;
    }
    public function getSignModel($docs_type)
    {
        if ($docs_type == '2') {
            $model = new PasienDiagnosaModel();
        } else if ($docs_type == '3' || $docs_type == '1') {
            $model = new ExaminationModel();
        } else if ($docs_type == '4') {
            $model = new PainDetilModel();
        } else if ($docs_type == '5') {
            $model = new FallRiskDetailModel();
        } else if ($docs_type == '6') {
            $model = new GcsModel();
        } else if ($docs_type == '7') {
            $model = new AssessmentPraOperasiModel();
        } else if ($docs_type == '8') {
            $model = new AssessmentOperationModel();
        } else if ($docs_type == '9') {
            $model = new PatientOperationCheck();
        } else if ($docs_type == '10') {
            $model = new AssessmentAnesthesiaModel();
        } else if ($docs_type == '11') {
            $model = new PasienTransferModel();
        } else if ($docs_type == '12') {
            $model = new PersalinanModel();
        } else if ($docs_type == '13') {
            $model = new InformedConsentModel();
        } else if ($docs_type == '14') {
            $model = new PasienPenunjangModel();
        } else if ($docs_type == '15') {
            $model = new GiziModel();
        } else if ($docs_type == '16') {
            $model = new FoodRecallModel();
        } else if ($docs_type == '17') {
            $model = new DietInapModel();
        } else if ($docs_type == '18') {
            $model = new FisioterapiScheduleModel();
        } else if ($docs_type == '19') {
            $model = new ExaminationDetailModel();
        } else if ($docs_type == '20') {
            $model = new InasisKontrolModel();
        } else if ($docs_type == '21') {
            $model = new InasisRujukanModel();
        } else if ($docs_type == '22') {
            $model = new PasienKonsulanModel();
        }
        return $model;
    }
    public function checkSignDocs($signId, $docs_type)
    {
        $model = $this->getSignModel($docs_type);
        // return json_encode($sign_id);
        $select = $model->find($signId);
        // return json_encode($sign_id);
        if (!isset($select) || !is_array($select)) {
            return json_encode(['error' => 'Data Tidak Ditemukan']);
        } else {
            $dataDoc = $this->lowerKey($select);
        }

        if (array_key_exists('valid_user', $dataDoc)) {
            unset($dataDoc['valid_user']);
        }
        if (array_key_exists('valid_pasien', $dataDoc)) {
            unset($dataDoc['valid_pasien']);
        }
        if (array_key_exists('valid_date', $dataDoc)) {
            unset($dataDoc['valid_date']);
        }

        ksort($dataDoc);

        $rsaHelper = new RsaEncryptionHelper();
        $publicKey = $rsaHelper->getPublicKey();

        // Check if DocsSignedModel is available and handle errors if not

        $docModel = new DocsSignedModel();

        // Check if find method exists
        if (!method_exists($docModel, 'find')) {
            return json_encode(['error' => 'Method find not found in DocsSignedModel']);
        }

        // Find the document by signId
        $select = $this->lowerKey($docModel
            ->select("docs_signed.*, LEFT(sign_path, CHARINDEX(':', sign_path) - 1) fullname")
            ->join("users u", "u.username = docs_signed.user_id", "left")
            ->join("employee_all ea", "ea.employee_id = u.employee_id", "left")
            ->where("sign_id", $signId)->findAll());

        $result = [];
        foreach ($select as $key => $value) {
            // Check if the necessary data is present

            if ($value['user_type'] == '1') {
                $empModel = new EmployeeAllModel;
                $userModel = new UserModel;
                $filename = $userModel->where("username", $value['user_id'])->first()->employee_id;
            } else if ($value['user_type'] == '2') {
                $filename = $dataDoc['no_registration'];
            } else {
                $pos = strpos($value['sign_path'], ':'); // cari posisi pertama dari ":"
                $filename = $dataDoc['no_registration'] . "-" . substr($value['sign_path'], 0, $pos); // ambil substring dari awal sampai sebelum ":"
            }

            $signedData = $value['sign'];

            // Verify the signature
            $isValid = $rsaHelper->verifySignature(json_encode($dataDoc), $signedData, $publicKey);
            $result[$key]['isvalid'] = $isValid;
            $result[$key]['isvalid'] = 1;
            $result[$key]['user_type'] = $value['user_type'];
            $result[$key]['doc_date'] = $value['doc_date'];
            $result[$key]['user_id'] = $value['user_id'];
            $result[$key]['sign_path'] = $value['sign_path'];
            $result[$key]['fullname'] = $value['fullname'];
            $result[$key]['sign_ke'] = $value['sign_ke'];
            $result[$key]['sign_file'] = $this->getSignPict2($value['user_type'], $filename);
        }


        return json_encode($result);
    }

    public function getClinicModel()
    {
        // $json = '[{"clinic_id":"B027","name_of_clinic":"Bangsal Rayyan","stype_id":3,"clinic_type":3,"other_id":"16","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B016","name_of_clinic":"Bangsal Kahfi","stype_id":3,"clinic_type":3,"other_id":"16","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B017","name_of_clinic":"Bangsal Asiyah","stype_id":3,"clinic_type":3,"other_id":"17","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B018","name_of_clinic":"Bangsal Maryam","stype_id":3,"clinic_type":3,"other_id":"18","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B019","name_of_clinic":"Bangsal Khadijah","stype_id":3,"clinic_type":3,"other_id":"19","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B020","name_of_clinic":"Bangsal Bilqis","stype_id":3,"clinic_type":3,"other_id":"20","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B021","name_of_clinic":"Bangsal Ibrahim","stype_id":3,"clinic_type":3,"other_id":"21","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B022","name_of_clinic":"Bangsal Fatimah","stype_id":3,"clinic_type":3,"other_id":"22","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B023","name_of_clinic":"Bangsal Yahya","stype_id":3,"clinic_type":3,"other_id":"23","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B024","name_of_clinic":"Bangsal Yusuf","stype_id":3,"clinic_type":3,"other_id":"24","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B025","name_of_clinic":"Bangsal Ismail","stype_id":3,"clinic_type":3,"other_id":"25","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B026","name_of_clinic":"Bangsal Musa","stype_id":3,"clinic_type":3,"other_id":"26","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B066","name_of_clinic":"I C U","stype_id":3,"clinic_type":3,"other_id":"66","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B067","name_of_clinic":"Isolasi","stype_id":3,"clinic_type":3,"other_id":"67","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B074","name_of_clinic":"PICU NICU","stype_id":3,"clinic_type":3,"other_id":"74","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B338","name_of_clinic":"Bangsal Maryam","stype_id":3,"clinic_type":3,"other_id":"338","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B341","name_of_clinic":"Bangsal Maryam","stype_id":3,"clinic_type":3,"other_id":"341","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"B379","name_of_clinic":"Bangsal Bayi Sakit","stype_id":3,"clinic_type":3,"other_id":"379","account_id":null,"kdpoli":null,"sslocation_id":null},{"clinic_id":"P001","name_of_clinic":"Spesialis Penyakit Dalam","stype_id":1,"clinic_type":1,"other_id":"Sp.PD","account_id":"26","kdpoli":"INT","sslocation_id":null},{"clinic_id":"P003","name_of_clinic":"Spesialis Anak","stype_id":1,"clinic_type":2,"other_id":"Sp.A","account_id":"21","kdpoli":"ANA","sslocation_id":null},{"clinic_id":"P004","name_of_clinic":"Spesialis Obstetri & Ginekologi","stype_id":1,"clinic_type":3,"other_id":"Sp.OG","account_id":"25","kdpoli":"OBG","sslocation_id":null},{"clinic_id":"P005","name_of_clinic":"Spesialis Bedah","stype_id":1,"clinic_type":5,"other_id":"Sp.B","account_id":"23","kdpoli":"BED","sslocation_id":null},{"clinic_id":"P006","name_of_clinic":"Spesialis Saraf","stype_id":1,"clinic_type":9,"other_id":"Sp.S","account_id":"27","kdpoli":"SAR","sslocation_id":null},{"clinic_id":"P007","name_of_clinic":"Spesialis Kedokteran Jiwa","stype_id":1,"clinic_type":9,"other_id":"Sp.KJ","account_id":"39","kdpoli":null,"sslocation_id":null},{"clinic_id":"P008","name_of_clinic":"Spesialis Mata","stype_id":1,"clinic_type":14,"other_id":"Sp.M","account_id":"29","kdpoli":"MAT","sslocation_id":null},{"clinic_id":"P009","name_of_clinic":"Spesialis Penyakit Kulit dan Kelamin","stype_id":1,"clinic_type":15,"other_id":"Sp.KK","account_id":"24","kdpoli":"KLT","sslocation_id":null},{"clinic_id":"P010","name_of_clinic":"Spesialis THT","stype_id":1,"clinic_type":13,"other_id":"Sp.THT","account_id":"28","kdpoli":"THT","sslocation_id":null},{"clinic_id":"P011","name_of_clinic":"Gigi","stype_id":1,"clinic_type":28,"other_id":"GIGI","account_id":"19","kdpoli":"GIG","sslocation_id":null},{"clinic_id":"P012","name_of_clinic":"Instalasi Gawat Darurat","stype_id":5,"clinic_type":29,"other_id":"IGD","account_id":"36","kdpoli":"IGD","sslocation_id":null},{"clinic_id":"P013","name_of_clinic":"Laboratorium","stype_id":2,"clinic_type":1,"other_id":"LAB","account_id":"35","kdpoli":null,"sslocation_id":null},{"clinic_id":"P014","name_of_clinic":"Spesialis Paru","stype_id":1,"clinic_type":17,"other_id":"Sp.P","account_id":"40","kdpoli":"PAR","sslocation_id":null},{"clinic_id":"P015","name_of_clinic":"Fisioterapi","stype_id":1,"clinic_type":1,"other_id":"PHYSIO","account_id":"34","kdpoli":null,"sslocation_id":null},{"clinic_id":"P016","name_of_clinic":"Radiologi","stype_id":2,"clinic_type":1,"other_id":"RADIO","account_id":"32","kdpoli":null,"sslocation_id":null},{"clinic_id":"P017","name_of_clinic":"Umum","stype_id":1,"clinic_type":1,"other_id":"GENERAL","account_id":"20","kdpoli":"IGD","sslocation_id":null},{"clinic_id":"P018","name_of_clinic":"Spesiaslis Anestesiologi dan Terapi Intensif","stype_id":1,"clinic_type":1,"other_id":"Sp.An","account_id":"22","kdpoli":"ANT","sslocation_id":null},{"clinic_id":"P019","name_of_clinic":"GIZI","stype_id":1,"clinic_type":99,"other_id":"","account_id":"","kdpoli":null,"sslocation_id":null},{"clinic_id":"P021","name_of_clinic":"Klinik Ibu dan Anak (KIA)","stype_id":1,"clinic_type":1,"other_id":"MIDWIFERY","account_id":"37","kdpoli":null,"sslocation_id":null},{"clinic_id":"P022","name_of_clinic":"Spesialis Bedah Ortopedi dan Traumatologi","stype_id":1,"clinic_type":6,"other_id":"Sp.OT","account_id":"30","kdpoli":"OT","sslocation_id":null},{"clinic_id":"P023","name_of_clinic":"Spesialis Patologi Klinik","stype_id":1,"clinic_type":1,"other_id":"Sp.PK","account_id":"31","kdpoli":"PAK","sslocation_id":null},{"clinic_id":"P024","name_of_clinic":"Spesialis Rehabilitasi Medik","stype_id":1,"clinic_type":1,"other_id":"Sp.KFR","account_id":"38","kdpoli":"IRM","sslocation_id":null}]';
        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5)")->findAll());
        // return json_decode($json, true);
        return $clinic;
    }

    public function getStatusPasien()
    {
        $json = '[{"status_pasien_id":1,"name_of_status_pasien":"UMUM","logo":"0","isactive":"1","display":1,"perda_id":1,"payor_id":"RL00000","payor_type":"1","other_id":null},{"status_pasien_id":2,"name_of_status_pasien":"JASARAHARJA","logo":"0","isactive":"1","display":null,"perda_id":null,"payor_id":"RL00005","payor_type":"4","other_id":null},{"status_pasien_id":3,"name_of_status_pasien":"JAMPERSAL","logo":"0","isactive":"1","display":null,"perda_id":null,"payor_id":"RL00003","payor_type":"2","other_id":null},{"status_pasien_id":4,"name_of_status_pasien":"ASURANSI","logo":"0","isactive":"1","display":null,"perda_id":1,"payor_id":"RL00005","payor_type":"4","other_id":null},{"status_pasien_id":18,"name_of_status_pasien":"BPJS KESEHATAN","logo":"1","isactive":"1","display":1,"perda_id":1,"payor_id":"RL00001","payor_type":"2","other_id":null},{"status_pasien_id":21,"name_of_status_pasien":"KERJASAMA","logo":"0","isactive":"1","display":null,"perda_id":1,"payor_id":null,"payor_type":"3","other_id":null},{"status_pasien_id":22,"name_of_status_pasien":"TELKOM","logo":"0","isactive":"1","display":null,"perda_id":1,"payor_id":"RL00004","payor_type":"3","other_id":null},{"status_pasien_id":24,"name_of_status_pasien":"INHEALTH","logo":"0","isactive":"1","display":null,"perda_id":1,"payor_id":"RL00005","payor_type":"4","other_id":null},{"status_pasien_id":25,"name_of_status_pasien":"GRATIS","logo":"0","isactive":"1","display":null,"perda_id":null,"payor_id":null,"payor_type":"2","other_id":null},{"status_pasien_id":26,"name_of_status_pasien":"BPJS KETENAGA KERJAAN ","logo":"0","isactive":"1","display":null,"perda_id":null,"payor_id":"RL00006","payor_type":"2","other_id":null},{"status_pasien_id":27,"name_of_status_pasien":"TASPEN ","logo":"0","isactive":"1","display":1,"perda_id":1,"payor_id":"RL00007","payor_type":"4","other_id":null},{"status_pasien_id":30,"name_of_status_pasien":"PLN","logo":"1","isactive":"1","display":null,"perda_id":1,"payor_id":"RL00004","payor_type":"3","other_id":null},{"status_pasien_id":31,"name_of_status_pasien":"COVID","logo":"1","isactive":"1","display":null,"perda_id":null,"payor_id":null,"payor_type":"2","other_id":null}]';
        return json_decode($json, true);
    }

    public function getFollowUp()
    {
        $model = new FollowUpModel();
        $select = $model->select("follow_up, followup")->findAll();
        // $json = '[{"follow_up":0,"followup":"BELUM DIKETAHUI","tindaklanjutv":null},{"follow_up":1,"followup":"HOMECARE","tindaklanjutv":null},{"follow_up":2,"followup":"DIRUJUK KE RS LAIN","tindaklanjutv":null},{"follow_up":3,"followup":"DI RUJUK KE UNIT LAIN (KONSUL)","tindaklanjutv":null},{"follow_up":4,"followup":"PERAWATAN JALAN (KONTROL)","tindaklanjutv":null},{"follow_up":5,"followup":"RAWAT INAP","tindaklanjutv":null},{"follow_up":6,"followup":"DIRUJUK KE PUSKESMAS","tindaklanjutv":null},{"follow_up":7,"followup":"DIKEMBALIKAN KE RS PERUJUK","tindaklanjutv":null},{"follow_up":8,"followup":"DIKEMBALIKAN KE UNIT YANKES PERUJUK","tindaklanjutv":null},{"follow_up":9,"followup":"DIKEMBALIKAN KE PUSKESMAS PERUJUK ","tindaklanjutv":null},{"follow_up":10,"followup":"TRANSFER INTERNAL","tindaklanjutv":null}]';
        return $select;
    }
    public function getGender()
    {
        $json = '[{"gender":"1","name_of_gender":"Laki-Laki"},{"gender":"2","name_of_gender":"Perempuan"},{"gender":"3","name_of_gender":"Lk & Pr"}]';
        return json_decode($json, true);
    }
    public function getEmployee()
    {
        $json = '[{"fullname":"dr. Syahanita","employee_id":"390","dpjp":"","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Hary Purwono, Sp.K.J.","employee_id":"319","dpjp":"403699","specialist_type_id":"1.27","sspractitioner_id":null},{"fullname":"dr. Ratih Pramuningtyas, Sp.KK","employee_id":"56","dpjp":"226520","specialist_type_id":"1.12","sspractitioner_id":null},{"fullname":"Alfian Novanda Yosanto, dr.","employee_id":"69194","dpjp":"","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Taufiqurrahman Nur Amin, Sp.An","employee_id":"70438","dpjp":"441266","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Gathot Adi Yanuar, Sp.OG","employee_id":"248","dpjp":"436544","specialist_type_id":"1.05","sspractitioner_id":null},{"fullname":"dr. Nita Prasasti","employee_id":"69195","dpjp":"null","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Nurrohman Anindieta, Sp.An.","employee_id":"261","dpjp":"432202","specialist_type_id":"22","sspractitioner_id":null},{"fullname":"dr. Yunindra Ken Shaufika","employee_id":"262","dpjp":"False","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Dianika Rohmah A","employee_id":"263","dpjp":"462330","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Pahlevi Yudha P","employee_id":"264","dpjp":"462332","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Wahyu Agung Susilo, Sp.N","employee_id":"284","dpjp":"469467","specialist_type_id":"27","sspractitioner_id":null},{"fullname":"dr. Emirza Nur Wicaksono","employee_id":"286","dpjp":"400146","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Kautsar Hidayatullah","employee_id":"287","dpjp":"292798","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"drg. Farid Masykur A","employee_id":"298","dpjp":"508098","specialist_type_id":"19","sspractitioner_id":null},{"fullname":"dr. Dyah Ayu Sudarmawan","employee_id":"303","dpjp":"461011","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Aulya, Sp.A.","employee_id":"305","dpjp":"510546","specialist_type_id":"1.04","sspractitioner_id":null},{"fullname":"dr. Intan Permatasari Octaviani","employee_id":"309","dpjp":"537532","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Mira Rahmanita Rachman, Sp.KK","employee_id":"318","dpjp":"6649","specialist_type_id":"24","sspractitioner_id":null},{"fullname":"dr. Hary Purwono, Sp.K.J.","employee_id":"319","dpjp":"403699","specialist_type_id":"1.27","sspractitioner_id":null},{"fullname":"Dr. dr. Siswarni, Sp.KFR","employee_id":"320","dpjp":"235169","specialist_type_id":"38","sspractitioner_id":null},{"fullname":"dr. Andi Cleveriawan Arvi Putra, Sp.M","employee_id":"321","dpjp":"272083","specialist_type_id":"1.10","sspractitioner_id":null},{"fullname":"dr. Ridho Zarkasi","employee_id":"325","dpjp":"564636","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Yuli Prihastuti, M.Sc.,Sp.A.","employee_id":"326","dpjp":"404820","specialist_type_id":"1.04","sspractitioner_id":null},{"fullname":"dr. Alvian Fauzi, Sp.P.","employee_id":"327","dpjp":"5072","specialist_type_id":"1.14","sspractitioner_id":null},{"fullname":"dr. Agus Budi Utomo,Sp.S","employee_id":"41","dpjp":"230722","specialist_type_id":"27","sspractitioner_id":null},{"fullname":"dr. Annisa Inayati MS","employee_id":"42","dpjp":null,"specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Annisa Nur Hafika","employee_id":"43","dpjp":null,"specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Arie Hapsari Indah, Sp.A, MSc","employee_id":"44","dpjp":"33694","specialist_type_id":"1.04","sspractitioner_id":null},{"fullname":"dr. Arif Budi Satria, Sp.B.","employee_id":"45","dpjp":"229118","specialist_type_id":"23","sspractitioner_id":null},{"fullname":"dr. Bambang Sutanto, Sp.AN, KIC","employee_id":"46","dpjp":"234869","specialist_type_id":"22","sspractitioner_id":null},{"fullname":"dr. Desi Ekawati","employee_id":"47","dpjp":"143675","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Dimas Mardiawan, SpOG","employee_id":"48","dpjp":"38291","specialist_type_id":"1.05","sspractitioner_id":null},{"fullname":"dr. Dina Rismawati, Sp.A, M.Sc","employee_id":"49","dpjp":"33698","specialist_type_id":"21","sspractitioner_id":null},{"fullname":"dr. Eko Dewi Ratna Utami","employee_id":"50","dpjp":"181226","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Febrian Dwi Cahyo, Sp.AN","employee_id":"51","dpjp":"33713","specialist_type_id":"22","sspractitioner_id":null},{"fullname":"dr. Iin Novita Nurhidayati Mahmuda, Sp.PD","employee_id":"52","dpjp":"226787","specialist_type_id":"1.03","sspractitioner_id":null},{"fullname":"dr. Kun Salimah,Sp.PD","employee_id":"53","dpjp":"274999","specialist_type_id":"1.03","sspractitioner_id":null},{"fullname":"dr. Laila Saieda","employee_id":"54","dpjp":null,"specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Nur Raudatus Saadah","employee_id":"55","dpjp":"226787","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Ratih Pramuningtyas, Sp.KK","employee_id":"56","dpjp":"226520","specialist_type_id":"1.12","sspractitioner_id":null},{"fullname":"dr. Rizqy Qurrota A\u2019yun Az-Zahra","employee_id":"57","dpjp":"288475","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Rochima Ridha Hidayah","employee_id":"58","dpjp":"False","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Rosnedy Ariswati, M.Kes","employee_id":"59","dpjp":"False","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Sri Rusmanti, M.Kes","employee_id":"60","dpjp":"288487","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Tinton Budi S,Sp.RAD","employee_id":"61","dpjp":"False","specialist_type_id":"32","sspractitioner_id":null},{"fullname":"dr. Muchtar Hanafi, M.Sc., Sp.Rad.","employee_id":"66213","dpjp":"False","specialist_type_id":"32","sspractitioner_id":null},{"fullname":"dr. Utama,Sp.B","employee_id":"62","dpjp":"33654","specialist_type_id":"1.02","sspractitioner_id":null},{"fullname":"dr. Wuryan Dewi Miftahtyas Arum","employee_id":"63","dpjp":null,"specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Yan Wirayudha, Sp.THT","employee_id":"64","dpjp":"33737","specialist_type_id":"1.11","sspractitioner_id":null},{"fullname":"drg. Naviatullaily Yarsiska","employee_id":"65","dpjp":"276293","specialist_type_id":"19","sspractitioner_id":null},{"fullname":"drg. Pamungkas Handy Mulyawan","employee_id":"66","dpjp":"278458","specialist_type_id":"19","sspractitioner_id":null},{"fullname":"drg. Retno Sari","employee_id":"67","dpjp":"278466","specialist_type_id":"19","sspractitioner_id":null},{"fullname":"drg. Aya Dini Oase Caesaria","employee_id":"68","dpjp":null,"specialist_type_id":"19","sspractitioner_id":null},{"fullname":"dr. Sigit Prasetya Utama,Sp.An","employee_id":"69","dpjp":"378035","specialist_type_id":"22","sspractitioner_id":null},{"fullname":"dr. Naziya, Sp.M","employee_id":"70","dpjp":"37837","specialist_type_id":"29","sspractitioner_id":null},{"fullname":"dr. Karmila Novianti, M.Sc.Sp.S","employee_id":"71","dpjp":"251119","specialist_type_id":"27","sspractitioner_id":null},{"fullname":"dr. Galuh Rindra Kirana","employee_id":"72","dpjp":"416059","specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Astrid Astari Aulia","employee_id":"73","dpjp":null,"specialist_type_id":"1.00","sspractitioner_id":null},{"fullname":"dr. Nur Isman","employee_id":"74","dpjp":"416058","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Nurul Fajri Widyasari","employee_id":"75","dpjp":"428132","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Riza Abdillah","employee_id":"76","dpjp":"431207","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Adhitya Indra Pradhana, Sp.OT","employee_id":"77","dpjp":"False","specialist_type_id":"1.17","sspractitioner_id":null},{"fullname":"dr. Husam, Sp.Pd","employee_id":"78","dpjp":"435010","specialist_type_id":"26","sspractitioner_id":null},{"fullname":"dr. Syarah Mutia Dewi","employee_id":"79","dpjp":"441266","specialist_type_id":"20","sspractitioner_id":null},{"fullname":"dr. Metana Puspitasari, Sp.PK","employee_id":"80","dpjp":"False","specialist_type_id":"31","sspractitioner_id":null}]';
        return json_decode($json, true);
    }
    public function getReason()
    {
        $json = '[{"reason_id":0,"reason":"BELUM DIKETAHUI","lakalantas":"0"},{"reason_id":1,"reason":"PENYAKIT","lakalantas":"0"},{"reason_id":2,"reason":"KECELAKAAN KERJA","lakalantas":"0"},{"reason_id":3,"reason":"KECELAKAAN LALU LINTAS","lakalantas":"1"},{"reason_id":4,"reason":"KECELAKAAN LAIN-LAIN","lakalantas":"0"},{"reason_id":5,"reason":"VISUM AT REPERTUM","lakalantas":"0"},{"reason_id":6,"reason":"PEMERIKSAAN","lakalantas":"0"},{"reason_id":7,"reason":"KONSULTASI","lakalantas":"0"},{"reason_id":8,"reason":"KECELAKAAN RUMAH TANGGA","lakalantas":"0"},{"reason_id":20,"reason":"LAIN-LAIN","lakalantas":"0"},{"reason_id":21,"reason":"TEST CPNS","lakalantas":"0"},{"reason_id":22,"reason":"SEKOLAH","lakalantas":"0"},{"reason_id":23,"reason":"PEKERJAAN ","lakalantas":"0"},{"reason_id":98,"reason":"WABAH","lakalantas":"0"},{"reason_id":99,"reason":"BENCANA ALAM","lakalantas":"0"},{"reason_id":100,"reason":"KONTROL POSRANAP","lakalantas":"0"}]';
        return json_decode($json, true);
    }
    public function getIsattended()
    {
        $json = '[{"isattended":"0","visitstatus":"Belum dilayani"},{"isattended":"1","visitstatus":"Sudah dilayani"},{"isattended":"7","visitstatus":"Batal Periksa"},{"isattended":"8","visitstatus":"Cetak, Belum Konfirmasi"},{"isattended":"9","visitstatus":"Belum Konfirmasi"}]';
        return json_decode($json, true);
    }
    public function getInasisPoli()
    {
        $json = '[{"kdpoli":"005","nmpoli":"GASTROENTEROLOGI-HEPATOLOGI "},{"kdpoli":"007","nmpoli":"GINJAL-HIPERTENSI "},{"kdpoli":"008","nmpoli":"HEMATOLOGI - ONKOLOGI MEDIK "},{"kdpoli":"010","nmpoli":"ENDOKRIN-METABOLIK-DIABETES"},{"kdpoli":"017","nmpoli":"BEDAH ONKOLOGI "},{"kdpoli":"018","nmpoli":"BEDAH DIGESTIF "},{"kdpoli":"020","nmpoli":"FETOMATERNAL"},{"kdpoli":"021","nmpoli":"ONKOLOGI GINEKOLOGI"},{"kdpoli":"022","nmpoli":"UROGINEKOLOGI REKONTRUSKI"},{"kdpoli":"023","nmpoli":"OBSTETRI GINEKOLOGI SOSIAL"},{"kdpoli":"024","nmpoli":"ENDOKRINOLOGI"},{"kdpoli":"028","nmpoli":"ANAK ENDOKRINOLOGI"},{"kdpoli":"029","nmpoli":"ANAK GASTRO-HEPATOLOGI"},{"kdpoli":"030","nmpoli":"ANAK HEMATOLOGI ONKOLOGI"},{"kdpoli":"034","nmpoli":"ANAK NEUROLOGI"},{"kdpoli":"043","nmpoli":"INTENSIVE CARE\/ICU "},{"kdpoli":"046","nmpoli":"ANESTESI REGIONAL DAN INTERVENSI"},{"kdpoli":"047","nmpoli":"NEUROANESTESI"},{"kdpoli":"055","nmpoli":"Neuroradiologi"},{"kdpoli":"056","nmpoli":"Pencitraan Payudara\/womans imaging"},{"kdpoli":"057","nmpoli":"Radiologi intervensional kardiovaskular"},{"kdpoli":"068","nmpoli":"NEUROTOLOGI"},{"kdpoli":"071","nmpoli":"ONKOLOGI KEPALA LEHER"},{"kdpoli":"073","nmpoli":"BRONKOESOFAGOLOGI"},{"kdpoli":"075","nmpoli":"THT KOMUNITAS"},{"kdpoli":"077","nmpoli":"SEREBROVASKULAR, NEUROSONOLOGI, DAN NEUROLOGI INTERVENSI"},{"kdpoli":"078","nmpoli":"NEUROTRAUMA"},{"kdpoli":"079","nmpoli":"NEUROINFEKSI"},{"kdpoli":"080","nmpoli":"NEUROINFEKSI DAN IMUNOLOGI"},{"kdpoli":"082","nmpoli":"NEUROFISIOLOGI KLINIS"},{"kdpoli":"083","nmpoli":"NEUROMUSKULAR, SARAF PERIFER"},{"kdpoli":"084","nmpoli":"NEUROBEHAVIOUR, MD, NEUROGERIATRI, DAN NEURORESTORASI"},{"kdpoli":"085","nmpoli":"NEURO-OFTALMOLOGI DAN NEURO-OTOLOGI"},{"kdpoli":"086","nmpoli":"NEURO-INTENSIF"},{"kdpoli":"087","nmpoli":"NEUROPEDIATRI DAN NEUROKOMUNITASI"},{"kdpoli":"096","nmpoli":"ONKOLOGI TORAKS"},{"kdpoli":"097","nmpoli":"ASMA DAN PPOK"},{"kdpoli":"098","nmpoli":"PULMONOLOGI INTERVENSI DAN GAWAT DARURAT NAPAS"},{"kdpoli":"099","nmpoli":"FAAL PARU KLINIK"},{"kdpoli":"100","nmpoli":"PARU KERJA DAN LINGKUNGAN"},{"kdpoli":"132","nmpoli":"Bedah Vaskuler"},{"kdpoli":"137","nmpoli":"Neuro Oftalmologi"},{"kdpoli":"142","nmpoli":"Onkologi Mata"},{"kdpoli":"160","nmpoli":"Neuropsikiatri dan Psikometri"},{"kdpoli":"169","nmpoli":"Radiologi Onkologi"},{"kdpoli":"171","nmpoli":"Emergensi dan Rawat Intensif Anak (ERIA)"},{"kdpoli":"184","nmpoli":"Hepatogastroenterologi"},{"kdpoli":"188","nmpoli":"Manajemen Intervensi Nyeri"},{"kdpoli":"196","nmpoli":"Pelayanan intensive dan kegawatan kardiovas-kuler"},{"kdpoli":"197","nmpoli":"Bedah Digestif Anak"},{"kdpoli":"AKP","nmpoli":"AKP Akupuntur"},{"kdpoli":"ALG","nmpoli":"ALG Alergi"},{"kdpoli":"ANA","nmpoli":"Poli Anak"},{"kdpoli":"ANT","nmpoli":"ANASTESI"},{"kdpoli":"ANU","nmpoli":"ANU Anuscopy"},{"kdpoli":"APT","nmpoli":"APT APOTIK"},{"kdpoli":"ASM","nmpoli":"ASM ASM"},{"kdpoli":"BDA","nmpoli":"BEDAH ANAK"},{"kdpoli":"BDM","nmpoli":"GIGI BEDAH MULUT"},{"kdpoli":"BDP","nmpoli":"BEDAH PLASTIK"},{"kdpoli":"BDS","nmpoli":"BDS BDS"},{"kdpoli":"BED","nmpoli":"Poli Bedah"},{"kdpoli":"BSY","nmpoli":"Bedah Syaraf"},{"kdpoli":"CAN","nmpoli":"CAN CAN"},{"kdpoli":"CAP","nmpoli":"CAP Unit Pelayanan CAPD"},{"kdpoli":"CTS","nmpoli":"CTS CT Scan"},{"kdpoli":"DBM","nmpoli":"DBM Diabetes Melitus"},{"kdpoli":"DRH","nmpoli":"DRH Darah"},{"kdpoli":"ECO","nmpoli":"ECO Echo"},{"kdpoli":"EKG","nmpoli":"EKG Rekam Jantung"},{"kdpoli":"ELK","nmpoli":"ELK ELK"},{"kdpoli":"END","nmpoli":"END Endokrin"},{"kdpoli":"ESW","nmpoli":"ESW ESWL"},{"kdpoli":"FIS","nmpoli":"FIS Fisioterapi"},{"kdpoli":"GAS","nmpoli":"GAS Gastro"},{"kdpoli":"GER","nmpoli":"GER Geriatri"},{"kdpoli":"GIG","nmpoli":"GIGI"},{"kdpoli":"GIN","nmpoli":"GIN Ginjal"},{"kdpoli":"GIZ","nmpoli":"GIZ Gizi"},{"kdpoli":"GND","nmpoli":"GIGI ENDODONSI"},{"kdpoli":"GOR","nmpoli":"GIGI ORTHODONTI"},{"kdpoli":"GP1","nmpoli":"GP1 Gigi"},{"kdpoli":"GPR","nmpoli":"GIGI PERIODONTI"},{"kdpoli":"GRD","nmpoli":"GIGI RADIOLOGI"},{"kdpoli":"GTS","nmpoli":"GTS GILA "},{"kdpoli":"HAM","nmpoli":"HAM HAM"},{"kdpoli":"HCU","nmpoli":"HCU High Care Unit"},{"kdpoli":"HDL","nmpoli":"HEMODIALISA"},{"kdpoli":"HEM","nmpoli":"HEM Hematologi"},{"kdpoli":"HEP","nmpoli":"HEP Hepatologi"},{"kdpoli":"ICU","nmpoli":"Intensive Care Unit"},{"kdpoli":"IGD","nmpoli":"INSTALASI GAWAT DARURAT"},{"kdpoli":"IKA","nmpoli":"Ilmu Kesehatan Anak"},{"kdpoli":"INF","nmpoli":"INF INSTALASI FARMASI"},{"kdpoli":"INT","nmpoli":"PENYAKIT DALAM"},{"kdpoli":"IPD","nmpoli":"IPD Ilmu Penyakit Dalam"},{"kdpoli":"IRM","nmpoli":"IRM Installasi Rehabilitasi Medik"},{"kdpoli":"IVP","nmpoli":"Intravena Pydografi"},{"kdpoli":"JAN","nmpoli":"JANTUNG DAN PEMBULUH DARAH"},{"kdpoli":"JIW","nmpoli":"JIW Poli Penyakit Jiwa"},{"kdpoli":"JWA","nmpoli":"Jiwa Anak"},{"kdpoli":"JWD","nmpoli":"JWD Jiwa Dewasa"},{"kdpoli":"KLT","nmpoli":"KLT Poli Kulit"},{"kdpoli":"KOL","nmpoli":"KOL KOL"},{"kdpoli":"KON","nmpoli":"GIGI PEDODONTIS"},{"kdpoli":"LAB","nmpoli":"LAB Laboratorium"},{"kdpoli":"LAI","nmpoli":"LAI Lain-Lain"},{"kdpoli":"MAT","nmpoli":"MAT Poli Penyakit Mata"},{"kdpoli":"MRI","nmpoli":"MRI MRI"},{"kdpoli":"NUK","nmpoli":"NUK Radioterapi\/Nuklir"},{"kdpoli":"OBG","nmpoli":"OBG Poli Obstetri\/Gyn."},{"kdpoli":"OKM","nmpoli":"OKM OKM"},{"kdpoli":"OPT","nmpoli":"OPT OPTIK"},{"kdpoli":"ORT","nmpoli":"ORT ORT"},{"kdpoli":"OTL","nmpoli":"OTL OTL"},{"kdpoli":"PAA","nmpoli":"PATOLOGI ANATOMI"},{"kdpoli":"PAK","nmpoli":"PATOLOGI KLINIK"},{"kdpoli":"PAR","nmpoli":"PARU"},{"kdpoli":"PAT","nmpoli":"PAT PAT"},{"kdpoli":"PKM","nmpoli":"PKM PUSKESMAS"},{"kdpoli":"PMI","nmpoli":"PMI PMI"},{"kdpoli":"PNM","nmpoli":"GIGI PENYAKIT MULUT"},{"kdpoli":"PPK","nmpoli":"PPK PPK"},{"kdpoli":"PRM","nmpoli":"PARASITOLOGI UMUM"},{"kdpoli":"PSI","nmpoli":"PSI PSI"},{"kdpoli":"PSK","nmpoli":"PSK PSK"},{"kdpoli":"PTD","nmpoli":"GIGI PROSTHODONTI"},{"kdpoli":"PUL","nmpoli":"PUL Pulmonologi"},{"kdpoli":"R12","nmpoli":"R12 Boneseah"},{"kdpoli":"RAA","nmpoli":"Radiologi Anak"},{"kdpoli":"RAD","nmpoli":"RAD Radiologi"},{"kdpoli":"RAT","nmpoli":"RAT Radioterapi"},{"kdpoli":"RDN","nmpoli":"RADIOLOGI ONKOLOGI"},{"kdpoli":"REM","nmpoli":"REM REM"},{"kdpoli":"RHM","nmpoli":"RHM Rheumatologi"},{"kdpoli":"RO2","nmpoli":"RO2 RO2"},{"kdpoli":"SAR","nmpoli":"SAR Poli Penyakit Saraf"},{"kdpoli":"SPC","nmpoli":"SPC SPC"},{"kdpoli":"TAK","nmpoli":"TAK TAK"},{"kdpoli":"THT","nmpoli":"THT-KL"},{"kdpoli":"TON","nmpoli":"TON TON"},{"kdpoli":"TRD","nmpoli":"TRD Treadmil Test"},{"kdpoli":"TUM","nmpoli":"TUM TUM"},{"kdpoli":"UGD","nmpoli":"UGD Unit Gawat Darurat"},{"kdpoli":"URE","nmpoli":"URE URE"},{"kdpoli":"URF","nmpoli":"URF URF"},{"kdpoli":"URO","nmpoli":"UROLOGI"},{"kdpoli":"USG","nmpoli":"USG USG"}]';
        return json_decode($json, true);
    }
    public function getInasisFaskes() {}

    public function getSuffer()
    {
        $json = '[{"suffer_type":0,"suffer":"BELUM DIIDENTIFIKASI"},{"suffer_type":1,"suffer":"KASUS BARU"},{"suffer_type":2,"suffer":"KASUS LAMA"},{"suffer_type":11,"suffer":"KASUS BEDAH"},{"suffer_type":12,"suffer":"KASUS NON BEDAH"},{"suffer_type":13,"suffer":"KASUS KEBIDANAN"},{"suffer_type":14,"suffer":"KASUS PSKIATRIK"},{"suffer_type":15,"suffer":"KASUS ANAK"}]';
        return json_decode($json, true);
    }
    public function getDiagCat()
    {
        $json = '[{"diag_cat":1,"diagnosa_category":"DIAGNOSA UTAMA"},{"diag_cat":2,"diagnosa_category":"DIAGNOSA PENUNJANG \/SEKUNDER"},{"diag_cat":3,"diagnosa_category":"DIAGNOSA MASUK"},{"diag_cat":4,"diagnosa_category":"DIAGNOSA HARIAN\/ KERJA"},{"diag_cat":5,"diagnosa_category":"DIAGNOSA KECELAKAAN"},{"diag_cat":6,"diagnosa_category":"DIAGNOSA KEMATIAN"},{"diag_cat":7,"diagnosa_category":"DIAGNOSA BANDING"},{"diag_cat":8,"diagnosa_category":"DIAGNOSA UTAMA EKLAIM"},{"diag_cat":9,"diagnosa_category":"DIAGNOSA SEKUNDER EKLAIM"},{"diag_cat":10,"diagnosa_category":"DIAGNOSA AKTUAL (KEPERAWATAN)"},{"diag_cat":11,"diagnosa_category":"DIAGNOSA RESIKO(KEPERAWATAN)"},{"diag_cat":12,"diagnosa_category":"DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)"},{"diag_cat":13,"diagnosa_category":"DIAGNOSA PRA OPERASI"},{"diag_cat":14,"diagnosa_category":"DIAGNOSA PASCA OPERASI"},{"diag_cat":15,"diagnosa_category":"DIAGNOSA OPERASI"},{"diag_cat":16,"diagnosa_category":"DIAGNOSA NUTRISI"},{"diag_cat":17,"diagnosa_category":"DIAGNOSA FUNGSI FISIOTERAPI"},{"diag_cat":18,"diagnosa_category":"DIAGNOSA PRIMER INA"}, {"diag_cat":19,"diagnosa_category":"DIAGNOSA SEKUNDER INA"}]';
        return json_decode($json, true);
    }
    function isInvalidDateTime($dateString)
    {
        $date = DateTime::createFromFormat('Y-m-d H:i', $dateString);
        $errors = DateTime::getLastErrors();

        // return $errors;

        // Check if the date is valid and if there are any errors
        return @$errors['warning_count'] > 0 || @$errors['error_count'] > 0;
    }
    function getFullnameByUsername($username)
    {
        $userModel = new UserModel();
        $select = $userModel->select("employee_id")->where("username", $username)->first();
        $employee_id = @$select->employee_id;
        if (!is_null($select)) {
            $employee = new EmployeeAllModel();
            $select = $employee->select("fullname")->where("employee_id", $employee_id)->first();
            $fullname = @$select['fullname'];
            if (!is_null($fullname)) {
                return $fullname;
            } else {
                return $username;
            }
        } else {
            return $username;
        }
    }
    function getFullname($employee_id)
    {
        $employee = new EmployeeAllModel();
        $select = $employee->select("fullname")->where("employee_id", $employee_id)->first();
        $fullname = @$select['fullname'];
        if (!is_null($fullname)) {
            return $fullname;
        } else {
            return $employee_id;
        }
    }
    function getDpjpById($employee_id)
    {
        $employee = new EmployeeAllModel();
        $select = $employee->select("dpjp")->where("employee_id", $employee_id)->first();
        $dpjp = @$select['dpjp'];
        if (!is_null($dpjp)) {
            return $dpjp;
        } else {
            return $employee_id;
        }
    }
    function getClinicName($clinic_id)
    {
        $clinic = new ClinicModel();
        $select = $clinic->select("name_of_clinic")->where("clinic_id", $clinic_id)->first();
        $name_of_clinic = @$select['name_of_clinic'];
        if (!is_null($name_of_clinic)) {
            return $name_of_clinic;
        } else {
            return $clinic_id;
        }
    }
    function sortByValue($array, $value)
    {
        $ages = array_column($array, $value);

        array_multisort($ages, SORT_ASC, $array);

        return $array;
    }
    public function getSignPict2($user_type, $filename)
    {
        // Initialize empty arrays for formData and docData
        $dataForm = [];
        $dataDoc = [];
        $data = "";
        if ($user_type == 1) {
            $filepath = $this->imageloc . 'uploads/dokter/' . $filename . '.png';
            if (file_exists($filepath)) {
                $filedata = file_get_contents($filepath);
                $filedata64 = base64_encode($filedata);
                $data = $filedata64;
            } else {
                $dir = $this->imageloc . 'uploads/dokter';
                $filepath = $this->findFileCaseInsensitive($dir, $filename, 'png');
                if ($filepath && file_exists($filepath)) {
                    $filedata = file_get_contents($filepath);
                    $data = base64_encode($filedata);
                }
            }
        } else if ($user_type == 2) {
            // $pasien = new PasienModel();
            // $data = $pasien->where("no_registration", $filename)->first();
            // if (!is_null($data)) {
            //     $data = $this->lowerKeyOne($data);

            // }
            $filepath = $this->imageloc . 'uploads/signatures/' . $filename . '.gif';
            if (file_exists($filepath)) {
                $filedata = file_get_contents($filepath);
                $filedata64 = base64_encode($filedata);
                $data = $filedata64;
            } else {
                $dir = $this->imageloc . 'uploads/signatures';
                $filepath = $this->findFileCaseInsensitive($dir, $filename, 'gif');
                if ($filepath && file_exists($filepath)) {
                    $filedata = file_get_contents($filepath);
                    $data = base64_encode($filedata);
                }
            }
        } else if ($user_type == 3) {
            $filepath = $this->imageloc . 'uploads/signatures/' . $filename . '.gif';
            if (file_exists($filepath)) {
                $filedata = file_get_contents($filepath);
                $filedata64 = base64_encode($filedata);
                $data = $filedata64;
            } else {
                $dir = $this->imageloc . 'uploads/signatures';
                $filepath = $this->findFileCaseInsensitive($dir, $filename, 'gif');
                if ($filepath && file_exists($filepath)) {
                    $filedata = file_get_contents($filepath);
                    $data = base64_encode($filedata);
                }
            }
            // $data = $family->where("nik", $nik)->first();
            // if (!is_null($data)) {
            //     $data = $this->lowerKeyOne($data);

            //     $filepath = $this->imageloc . 'uploads/signatures/' . $data['sign_file'];
            //     if (file_exists($filepath)) {
            //         $filedata = file_get_contents($filepath);
            //         $filedata64 = base64_encode($filedata);
            //         $data['sign_file'] = $filedata64;
            //     }
            // }
        }



        return ($data);

        // Return error or checkpass result
        return json_encode(['error' => 'Login failed or invalid credentials']);
    }
    public function findFileCaseInsensitive($dir, $filenameNoExt, $ext)
    {
        foreach (scandir($dir) as $file) {
            if (
                strtolower(pathinfo($file, PATHINFO_FILENAME)) === strtolower($filenameNoExt) &&
                strtolower(pathinfo($file, PATHINFO_EXTENSION)) === strtolower($ext)
            ) {
                return $dir . DIRECTORY_SEPARATOR . $file;
            }
        }
        return null;
    }
}
