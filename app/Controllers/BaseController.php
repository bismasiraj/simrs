<?php

namespace App\Controllers;

use App\Models\EmployeeAllModel;
use App\Models\PasienModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\RawSql;
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
}
