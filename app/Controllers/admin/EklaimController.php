<?php

namespace App\Controllers\Admin;

use App\Libraries\EklaimService;
use App\Models\Eklaim\EklaimCovidModel;
use App\Models\Eklaim\EklaimJenazahModel;
use App\Models\Eklaim\EklaimObstetriDeliveryModel;
use App\Models\Eklaim\EklaimObstetriModel;
use App\Models\Eklaim\EklaimTarifRsModel;
use App\Models\Eklaim\EklaimUpgradeClassModel;
use App\Models\EklaimModel;
use App\Models\ExaminationDetailModel;
use App\Models\GrouperModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienModel;
use App\Models\PasienProceduresModel;
use App\Models\TarifAltModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\Database\RawSql;
use Exception;

class EklaimController extends \App\Controllers\BaseController
{
    private $eklaimkey = 'aaa618f82e01502b3807109d5fe7b74c19a62b4b8c0b7a4ea9b53fb185995c00';

    public function getBillEklaim18()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $trans = $body['trans'];
        $visit = $body['visit'];


        $tb = new TreatmentBillModel();
        $builder = $tb->select("sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 1 then tagihan*(1) else 0 end) as prosedur_non_bedah,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 2 then tagihan*(1) else 0 end) as prosedur_bedah,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 3 then tagihan*(1) else 0 end) as konsultasi,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 4 then tagihan*(1) else 0 end) as tenaga_ahli,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 5 then tagihan*(1) else 0 end) as keperawatan,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 6 then tagihan*(1) else 0 end) as penunjang,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 7 then tagihan*(1) else 0 end) as radiologi,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500 or isnull(tt.tarif_type, 0) = 803) and tt.casemix_id = 8 then tagihan*(1) else 0 end) as laboratorium,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 9 then tagihan*(1) else 0 end) as pelayanan_darah,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 10 then tagihan*(1) else 0 end) as rehabilitasi,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 11 then tagihan*(1) else 0 end) as kamar,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 12 then tagihan*(1) else 0 end) as rawat_intensif,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(tt.tarif_type, 0) = 500) and tt.casemix_id = 15 then tagihan*(1) else 0 end) as bmhp,
            sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 804 or isnull(isnull(tt.tarif_type, 0), 0) = 500) and tt.casemix_id = 16 then tagihan*(1) else 0 end) as sewa_alat,
            sum(case when g.isalkes <> 1 and numer <>2 and numer <> 3 then tagihan else 0 end) as obat,
            sum(case when g.isalkes <> 1 and numer = 2 then tagihan*(1-0) else 0 end) as obat_kronis,
            sum(case when g.isalkes <> 1 and numer = 3 then tagihan*(1-0) else 0 end) as obat_kemoterapi,
            sum(case when g.isalkes  = 1 then tagihan*(1) else 0 end) as alkes,
            treatment_bill.no_registration")
            ->join("treat_tarif tt", "treatment_bill.tarif_id = tt.tarif_id", "inner")
            ->join("goods g", "treatment_bill.brand_id = g.brand_id", "left")
            ->where("trans_id", $trans)
            ->where("quantity <> 0")
            ->whereIn("treatment_bill.status_pasien_id", ["18"])
            ->groupBy("treatment_bill.no_registration");
        $query = $this->lowerKey($builder->findAll());

        $ws_query = [];

        if (isset($query[0]["no_registration"])) {
            $norm = $query[0]["no_registration"];
            $ws_query["prosedur_non_bedah"] = $query[0]["prosedur_non_bedah"];
            $ws_query["prosedur_bedah"] = $query[0]["prosedur_bedah"];
            $ws_query["konsultasi"] = $query[0]["konsultasi"];
            $ws_query["tenaga_ahli"] = $query[0]["tenaga_ahli"];
            $ws_query["keperawatan"] = $query[0]["keperawatan"];
            $ws_query["penunjang"] = $query[0]["penunjang"];
            $ws_query["radiologi"] = $query[0]["radiologi"];
            $ws_query["laboratorium"] = $query[0]["laboratorium"];
            $ws_query["pelayanan_darah"] = $query[0]["pelayanan_darah"];
            $ws_query["rehabilitasi"] = $query[0]["rehabilitasi"];
            $ws_query["kamar"] = $query[0]["kamar"];
            $ws_query["rawat_intensif"] = $query[0]["rawat_intensif"];
            $ws_query["sewa_alat"] = $query[0]["sewa_alat"];


            // $builder = $tb->select("isnull(sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 803 or isnull(tt.tarif_type, 0) = 500) and isnull(treatment_bill.numer,1) = 3 then tagihan*(1-discount) else 0 end),0) as obat_kemoterapi,
            // isnull(sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 803 or isnull(tt.tarif_type, 0) = 500) and isnull(treatment_bill.numer,1) = 2 then sell_price*(DOSE_PRESC - quantity) else 0 end),0) as obat_kronis,
            // isnull(sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 803 or isnull(tt.tarif_type, 0) = 500) and (isnull(ISALKES,0) = '21' or tt.CASEMIX_ID = '15') and isnull(treatment_bill.numer,1) <> 4 then tagihan*(1-discount) else 0 end),0) as bmhp, 
            // isnull(sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 803 or isnull(tt.tarif_type, 0) = 500) and (isnull(ISALKES,0) = '1' or tt.CASEMIX_ID = '14') and isnull(treatment_bill.numer,1) <> 4 then tagihan*(1-discount) else 0 end),0) as alkes,
            // isnull(sum(case when (isnull(tt.tarif_type, 0) < 100 or isnull(tt.tarif_type, 0) = 803 or isnull(tt.tarif_type, 0) = 500) and isnull(treatment_bill.numer,1) <> 10 and tt.casemix_id = '13' and (isnull(ISALKES,0) not in ('1','21')) then tagihan*(1-discount) else 0 end),0) as obat")
            //     ->join("treat_tarif tt", "treatment_bill.tarif_id = tt.tarif_id", "inner")
            //     ->join("goods g", "treatment_bill.brand_id = g.brand_id", "left")
            //     ->where("trans_id", $trans)
            //     ->where("(treatment_bill.status_pasien_id = '18' or isrj = 0 or isnull(tt.tarif_type, 0) = 803)");



            // $query = $this->lowerKey($builder->findAll());

            $ws_query["obat"] = $query[0]["obat"];
            $ws_query["obat_kronis"] = $query[0]["obat_kronis"];
            $ws_query["obat_kemoterapi"] = $query[0]["obat_kemoterapi"];
            $ws_query["alkes"] = $query[0]["alkes"];
            $ws_query["bmhp"] = $query[0]["bmhp"];

            $p = new PasienModel();
            $query = $p->select('date_of_birth')->find($norm);
            $ws_query["date_of_birth"] = $query['date_of_birth'];
        }

        $result['data'] = $ws_query;

        //get data apgar
        $db = db_connect();

        $apgar = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005') order by examination_date desc")->getFirstRow());
        // return json_encode($apgar);
        $apgarData = [];
        if (count($apgar) > 0) {
            $apgarDetil = "select * from assessment_apgar_detail where body_id = '" . $apgar['body_id'] . "'";

            $apgarDetil = $this->lowerKey($db->query($apgarDetil)->getResultArray());

            $apgarData = [
                'apgar' => $apgar,
                'apgarDetil' => $apgarDetil
            ];
        }
        $result['apgarData'] = $apgarData;


        return json_encode($result);
    }
    public function getEklaimData()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $nosep_klaim = $body['nosep_klaim'];
        $trans_id = $body['trans_id'];

        $response = [];
        $ekModel = new EklaimModel();

        $select = $this->lowerKey($ekModel->where('nosep_klaim', $nosep_klaim)->where("trans_id", $trans_id)->first());
        unset($select['request_01']);

        $response['klaim'] = $select;

        $model = new EklaimCovidModel();
        $response['covid'] = $model->getByTransAndNosep($trans_id, $nosep_klaim);
        $model = new EklaimJenazahModel();
        $response['jenazah'] = $model->getByTransAndNosep($trans_id, $nosep_klaim);
        $model = new EklaimTarifRsModel();
        $response['tarif'] = $model->getByTransAndNosep($trans_id, $nosep_klaim);
        $model = new EklaimObstetriModel();
        $response['persalinan'] = $model->getByTransAndNosep($trans_id, $nosep_klaim);
        $model = new EklaimObstetriDeliveryModel();
        $response['delivery'] = $model->getByTransAndNosep($trans_id, $nosep_klaim);
        $response['delivery'] = $this->lowerKey($response['delivery']);
        $model = new EklaimUpgradeClassModel();
        $response['upgrade'] = $model->getByTransAndNosep($trans_id, $nosep_klaim);
        $response = $this->lowerKey($response);
        $model = new PasienDiagnosasModel();
        $diagnosa = $model->getData($nosep_klaim);
        $response['diagnosa'] = $this->lowerKey($diagnosa);
        $model = new PasienProceduresModel();
        $procedure = $model->getData($nosep_klaim);
        $response['procedure'] = $this->lowerKey($procedure);
        $model = new GrouperModel();
        $response['grouper'] = $model->getGrouper($nosep_klaim);

        $result['code'] = '200';
        $result['status'] = 'success';
        $result['data'] = $response;
        return $this->response->setJSON($result);
    }
    public function getInacbg()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $visit = $body['visit'];

        $db = db_connect('default');
        $builder = $db->table('EKLAIM_KLAIM');
        $builder = $builder->where('visit_id', $visit)->select('cbg_tarif');
        $builder = $builder->get();
        $result = $builder->getResultArray();



        return json_encode($result);
    }
    // private function inacbg_encrypt($data, $key)
    // {
    //     /// make binary representasion of $key
    //     $key = hex2bin($key);
    //     /// check key length, must be 256 bit or 32 bytes
    //     if (mb_strlen($key, "8bit") !== 32) {
    //         throw new Exception("Needs a 256-bit key!");
    //     }
    //     /// create initialization vector
    //     $iv_size = openssl_cipher_iv_length("aes-256-cbc");
    //     $iv = openssl_random_pseudo_bytes($iv_size); // dengan catatan dibawah
    //     /// encrypt
    //     $encrypted = openssl_encrypt(
    //         $data,
    //         "aes-256-cbc",
    //         $key,
    //         OPENSSL_RAW_DATA,
    //         $iv
    //     );
    //     /// create signature, against padding oracle attacks
    //     $signature = mb_substr(hash_hmac(
    //         "sha256",
    //         $encrypted,
    //         $key,
    //         true
    //     ), 0, 10, "8bit");
    //     /// combine all, encode, and format
    //     $encoded = chunk_split(base64_encode($signature . $iv . $encrypted));
    //     return $encoded;
    // }


    // private function inacbg_decrypt($str, $strkey)
    // {
    //     /// make binary representation of $key
    //     $key = hex2bin($strkey);
    //     /// check key length, must be 256 bit or 32 bytes
    //     if (mb_strlen($key, "8bit") !== 32) {
    //         // throw new Exception("Needs a 256-bit key!");
    //     }
    //     /// calculate iv size
    //     $iv_size = openssl_cipher_iv_length("aes-256-cbc");
    //     /// breakdown parts
    //     $decoded = base64_decode($str);
    //     $signature = mb_substr($decoded, 0, 10, "8bit");
    //     $iv = mb_substr($decoded, 10, $iv_size, "8bit");
    //     $encrypted = mb_substr($decoded, $iv_size + 10, NULL, "8bit");
    //     /// check signature, against padding oracle attack
    //     $calc_signature = mb_substr(hash_hmac(
    //         "sha256",
    //         $encrypted,
    //         $key,
    //         true
    //     ), 0, 10, "8bit");
    //     if (!$this->inacbg_compare($signature, $calc_signature)) {
    //         return "SIGNATURE_NOT_MATCH"; /// signature doesn't match
    //     }
    //     $decrypted = openssl_decrypt(
    //         $encrypted,
    //         "aes-256-cbc",
    //         $key,
    //         OPENSSL_RAW_DATA,
    //         $iv
    //     );
    //     return $decrypted;
    // }


    // private function inacbg_compare($a, $b)
    // {       /// compare individually to prevent timing attacks

    //     /// compare length
    //     if (strlen($a) !== strlen($b)) return false;

    //     /// compare individual
    //     $result = 0;
    //     for ($i = 0; $i < strlen($a); $i++) {
    //         $result |= ord($a[$i]) ^ ord($b[$i]);
    //     }
    //     return $result == 0;
    // }
    // public function eklaim($json_request, $key)
    // {
    //     $payload = $this->inacbg_encrypt($json_request, $key);
    //     // tentukan Content-Type pada http header
    //     $header = array("Content-Type: application/x-www-form-urlencoded");
    //     // url server aplikasi E-Klaim,
    //     // silakan disesuaikan instalasi masing-masing
    //     $url = "http://192.168.10.110/E-Klaim/ws.php";
    //     // $url = "http://192.168.110.254:8081/E-Klaim/ws.php";
    //     // setup curl
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_HEADER, 0);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //     // request dengan curl
    //     $response = curl_exec($ch);
    //     // terlebih dahulu hilangkan "----BEGIN ENCRYPTED DATA----\r\n" // dan hilangkan "----END ENCRYPTED DATA----\r\n" dari response
    //     $first  = strpos($response, "\n") + 1;
    //     $last   = strrpos($response, "\n") - 1;
    //     $response  = substr(
    //         $response,
    //         $first,
    //         strlen($response) - $first - $last
    //     );
    //     // decrypt dengan fungsi inacbg_decrypt
    //     $response = $this->inacbg_decrypt($response, $key);
    //     // hasil decrypt adalah format json, ditranslate kedalam array
    //     $msg = json_decode($response, true);

    //     return $msg;
    // }
    public function postEklaim()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }

        $currentStep = $this->request->getPost('currentStep');
        $trans_id = $this->request->getPost('trans_id');
        $visit_id = $this->request->getPost('visit_id');
        $nosep = $this->request->getPost('nosep');
        $nosep_inap = $this->request->getPost('nosep_inap');
        $nama_pasien = $this->request->getPost('nama_pasien');
        $gender = $this->request->getPost('gender');
        $nomor_rm = $this->request->getPost('nomor_rm');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $nomor_kartu = $this->request->getPost('nomor_kartu');
        $nomor_sep = $this->request->getPost('nomor_sep');
        $nama_dokter = $this->request->getPost('nama_dokter');
        $payor_id = $this->request->getPost('payor_id');
        $payor_cd = $this->request->getPost('payor_cd');
        $cob_cd = $this->request->getPost('cob_cd');
        // $kode_tarif = $this->request->getPost('kode_tarif');
        $kode_tarif = "DS";
        // return json_encode($kode_tarif);
        $jenis_rawat = $this->request->getPost('jenis_rawat');
        $kelas_rawat = $this->request->getPost('kelas_rawat');
        $tgl_masuk = $this->request->getPost('tgl_masuk');
        $tgl_masuk = str_replace("T", " ", $tgl_masuk) . ":00";
        $tgl_pulang = $this->request->getPost('tgl_pulang');
        $tgl_pulang = str_replace("T", " ", $tgl_pulang) . ":00";
        $cara_masuk = $this->request->getPost('cara_masuk');
        $discharge_status = $this->request->getPost('discharge_status');
        $coder_nik = $this->request->getPost('coder_nik');
        $sistole = $this->request->getPost('tension_upper');
        $diastole = $this->request->getPost('tension_below');
        $adl_sub_acute = $this->request->getPost('adl_sub_acute');
        $adl_chronic = $this->request->getPost('adl_chronic');
        $dializer_single_use = $this->request->getPost('dializer_single_use');
        $kantong_darah = $this->request->getPost('kantong_darah');
        $upgrade_class_ind = $this->request->getPost('upgrade_class_ind');
        $upgrade_class_class = $this->request->getPost('upgrade_class_class');
        $upgrade_class_los = $this->request->getPost('upgrade_class_los');
        $upgrade_class_payor = $this->request->getPost('upgrade_class_payor');
        $add_payment_pct = $this->request->getPost('add_payment_pct');
        $birth_weight = $this->request->getPost('birth_weight');
        $unuDiag = $this->request->getPost('unuDiag');
        $unuDiagCat = $this->request->getPost('unuDiagCat');
        $unuProc = $this->request->getPost('unuProc');
        $inaDiag = $this->request->getPost('inaDiag');
        $inaDiagCat = $this->request->getPost('inaDiagCat');
        $inaProc = $this->request->getPost('inaProc');
        $prosedur_non_bedah = $this->request->getPost('prosedur_non_bedah');
        $prosedur_bedah = $this->request->getPost('prosedur_bedah');
        $konsultasi = $this->request->getPost('konsultasi');
        $tenaga_ahli = $this->request->getPost('tenaga_ahli');
        $keperawatan = $this->request->getPost('keperawatan');
        $penunjang = $this->request->getPost('penunjang');
        $radiologi = $this->request->getPost('radiologi');
        $laboratorium = $this->request->getPost('laboratorium');
        $pelayanan_darah = $this->request->getPost('pelayanan_darah');
        $rehabilitasi = $this->request->getPost('rehabilitasi');
        $kamar = $this->request->getPost('kamar');
        $rawat_intensif = $this->request->getPost('rawat_intensif');
        $obat = $this->request->getPost('obat');
        $obat_kronis = $this->request->getPost('obat_kronis');
        $obat_kemoterapi = $this->request->getPost('obat_kemoterapi');
        $alkes = $this->request->getPost('alkes');
        $bmhp = $this->request->getPost('bmhp');
        $sewa_alat = $this->request->getPost('sewa_alat');
        $billing_amount = $this->request->getPost('billing_amount');

        $icu_indikator = $this->request->getPost('icu_indikator');
        $icu_los = $this->request->getPost('icu_los');
        $ventilator_hour = $this->request->getPost('ventilator_hour');
        $use_ind = $this->request->getPost('use_ind');
        $start_dttm = $this->request->getPost('start_dttm');
        $stop_dttm = $this->request->getPost('start_dttm');
        $apgar = $this->request->getPost('apgar');
        $appearance = $this->request->getPost('appearance');
        $pulse = $this->request->getPost('pulse');
        $grimace = $this->request->getPost('grimace');
        $activity = $this->request->getPost('activity');
        $respiration = $this->request->getPost('respiration');
        $persalinan = $this->request->getPost('persalinan');
        $usia_kehamilan = $this->request->getPost('usia_kehamilan');
        $onset_kontraksi = $this->request->getPost('onset_kontraksi');
        $gravida = $this->request->getPost('gravida');
        $partus = $this->request->getPost('partus');
        $abortus = $this->request->getPost('abortus');
        $delivery_sequence = $this->request->getPost('delivery_sequence');
        $delivery_method = $this->request->getPost('delivery_method');
        $use_manual = $this->request->getPost('use_manual');
        $use_forcep = $this->request->getPost('use_forcep');
        $use_vacuum = $this->request->getPost('use_vacuum');
        $delivery_dttm = $this->request->getPost('delivery_dttm');
        $letak_janin = $this->request->getPost('letak_janin');
        $kondisi = $this->request->getPost('kondisi');
        $shk_spesimen_ambil = $this->request->getPost('shk_spesimen_ambil');
        $shk_lokasi = $this->request->getPost('shk_lokasi');
        $shk_alasan = $this->request->getPost('shk_alasan');
        $shk_spesimen_dttm = $this->request->getPost('shk_spesimen_dttm');
        $tarif_poli_eks = $this->request->getPost('tarif_poli_eks');
        $covid_indicator = $this->request->getPost('covid_indicator');
        $covid19_status_cd = $this->request->getPost('covid19_status_cd');
        $nomor_kartu_t = $this->request->getPost('nomor_kartu_t');
        $covid19_no_sep = $this->request->getPost('covid19_no_sep');
        $terapi_konvalesen = $this->request->getPost('terapi_konvalesen');
        $isoman_ind = $this->request->getPost('isoman_ind');
        $bayi_lahir_status_cd = $this->request->getPost('bayi_lahir_status_cd');
        $covid19_rs_darurat_ind = $this->request->getPost('covid19_rs_darurat_ind');
        $covid19_cc_ind = $this->request->getPost('covid19_cc_ind');
        $covid19_co_insidense_ind = $this->request->getPost('covid19_co_insidense_ind');
        $episodes7 = $this->request->getPost('episodes7');
        $episodes8 = $this->request->getPost('episodes8');
        $episodes9 = $this->request->getPost('episodes9');
        $episodes10 = $this->request->getPost('episodes10');
        $episodes11 = $this->request->getPost('episodes11');
        $episodes12 = $this->request->getPost('episodes12');
        $lab_asam_laktat = $this->request->getPost('lab_asam_laktat');
        $lab_d_dimer = $this->request->getPost('lab_d_dimer');
        $lab_anti_hiv = $this->request->getPost('lab_anti_hiv');
        $lab_procalcitonin = $this->request->getPost('lab_procalcitonin');
        $lab_analisa_gas = $this->request->getPost('lab_analisa_gas');
        $lab_crp = $this->request->getPost('lab_crp');
        $lab_aptt = $this->request->getPost('lab_aptt');
        $lab_pt = $this->request->getPost('lab_pt');
        $lab_albumin = $this->request->getPost('lab_albumin');
        $lab_kultur = $this->request->getPost('lab_kultur');
        $lab_waktu_pendarahan = $this->request->getPost('lab_waktu_pendarahan');
        $rad_thorax_ap_pa = $this->request->getPost('rad_thorax_ap_pa');
        $pemulasaraan_jenazah = $this->request->getPost('pemulasaraan_jenazah');
        $kantong_jenazah = $this->request->getPost('kantong_jenazah');
        $peti_jenazah = $this->request->getPost('peti_jenazah');
        $plastik_erat = $this->request->getPost('plastik_erat');
        $desinfektan_jenazah = $this->request->getPost('desinfektan_jenazah');
        $mobil_jenazah = $this->request->getPost('mobil_jenazah');
        $desinfektan_mobil_jenazah = $this->request->getPost('desinfektan_mobil_jenazah');
        $tdbilling_amount = $this->request->getPost('tdbilling_amount');


        $ws_new_claim = [
            "metadata" => [
                "method" => "new_claim"
            ],
            "data" => [
                "nomor_kartu"  => $nomor_kartu,
                "nomor_sep"    => $nomor_sep,
                "nomor_rm"     => $nomor_rm,
                "nama_pasien"  => $nama_pasien,
                "tgl_lahir"    => $tgl_lahir,
                "gender"       => $gender
            ]
        ];

        $eklaim = new EklaimService();

        $json_request = json_encode($ws_new_claim);

        if ($currentStep < 1) {
            $resultNewKlaim = $eklaim->sendRequest('new_claim', $json_request, $nomor_sep);
        } else {
            $resultNewKlaim['metadata']['code'] = '400';
        }

        $dataClaim = [
            'trans_id' => $trans_id,
            'visit_id' => $visit_id,
            'nomr' => $nomor_rm,
            'nosep' => $nosep,
            'nosep_inap' => $nosep_inap,
            'nosep_klaim' => $nomor_sep,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_pulang,
            'jnsrawat' => $jenis_rawat,
            'klsrawat' => $kelas_rawat,
            'adl_sub_acute' => $adl_sub_acute,
            'adl_chronic' => $adl_chronic,
            'icu_indikator' => $icu_indikator,
            'icu_los' => $icu_los,
            'ventilator_hour' => $ventilator_hour,
            'birthweight' => $birth_weight,
            'discharge_status' => $discharge_status,
            'tarif_poli_eks' => $tarif_poli_eks,
            'dokter' => $nama_dokter,
            'kodetarif' => $kode_tarif,
            'payor_id' => $payor_id,
            'payor_cd' => $payor_cd,
            'cob_cd' => $cob_cd,
            'coder_nik' => $coder_nik,
            'modified_by' => user()->username,
            'request_01' => '',
            'cara_masuk' => $cara_masuk,
            'sistole' => $sistole,
            'diastole' => $diastole,
            'dializer_single_use' => $dializer_single_use,
            'kantong_darah' => $kantong_darah
        ];
        $eklaimModel = new EklaimModel();
        $saveEklaim = $eklaimModel->insertOrUpdateClaim($dataClaim);

        $ws_query = [
            "metadata" => [
                "method" => "set_claim_data",
                "nomor_sep" => $nomor_sep
            ],
            "data" => [
                "nomor_sep" => $nomor_sep,
                "nomor_kartu" => $nomor_kartu,
                "tgl_masuk" => $tgl_masuk,
                "tgl_pulang" => $tgl_pulang,
                "cara_masuk" => $cara_masuk,
                "jenis_rawat" => $jenis_rawat,
                "kelas_rawat" => $kelas_rawat,
                "icu_indikator" => $icu_indikator,
                "icu_los" => $icu_los,
                "ventilator_hour" => $ventilator_hour,
                "ventilator" => [
                    "use_ind" => $use_ind,
                    "start_dttm" => $start_dttm,
                    "stop_dttm" => $stop_dttm
                ],
                "upgrade_class_ind" => $upgrade_class_ind,
                "birth_weight" => $birth_weight,
                "sistole" => $sistole,
                "diastole" => $diastole,
                "discharge_status" => $discharge_status,
                "diagnosa" => rtrim($eklaim->safe_implode("#", $unuDiag), "#"),
                "procedure" => rtrim($eklaim->safe_implode("#", $unuProc), "#"),
                "diagnosa_inagrouper" => rtrim($eklaim->safe_implode("#", $inaDiag), "#"),
                "procedure_inagrouper" => rtrim($eklaim->safe_implode("#", $inaProc), "#"),
                "tarif_rs" => array_map(fn($v) => str_replace(",", ".", str_replace(".", "", $v)), [
                    "prosedur_non_bedah" => $prosedur_non_bedah,
                    "prosedur_bedah" => $prosedur_bedah,
                    "konsultasi" => $konsultasi,
                    "tenaga_ahli" => $tenaga_ahli,
                    "keperawatan" => $keperawatan,
                    "penunjang" => $penunjang,
                    "radiologi" => $radiologi,
                    "laboratorium" => $laboratorium,
                    "pelayanan_darah" => $pelayanan_darah,
                    "rehabilitasi" => $rehabilitasi,
                    "kamar" => $kamar,
                    "rawat_intensif" => $rawat_intensif,
                    "obat" => $obat,
                    "obat_kronis" => $obat_kronis,
                    "obat_kemoterapi" => $obat_kemoterapi,
                    "alkes" => $alkes,
                    "bmhp" => $bmhp,
                    "sewa_alat" => $sewa_alat
                ]),
                "bayi_lahir_status_cd" => $bayi_lahir_status_cd,
                "dializer_single_use" => $dializer_single_use,
                "kantong_darah" => $kantong_darah,
                "tarif_poli_eks" => $tarif_poli_eks,
                "nama_dokter" => $nama_dokter,
                "kode_tarif" => $kode_tarif,
                "payor_id" => $payor_id,
                "payor_cd" => $payor_cd,
                "cob_cd" => $cob_cd,
                "coder_nik" => "123123123123"
            ]
        ];
        $eklaimTarif = new EklaimTarifRsModel();

        $dataTarif = [
            'TRANS_ID' => $trans_id,
            'NOSEP_KLAIM' => $nomor_sep,

            'PROSEDUR_NON_BEDAH' => $eklaim->cleanCurrency($prosedur_non_bedah),
            'PROSEDUR_BEDAH' => $eklaim->cleanCurrency($prosedur_bedah),
            'KONSULTASI' => $eklaim->cleanCurrency($konsultasi),
            'TENAGA_AHLI' => $eklaim->cleanCurrency($tenaga_ahli),
            'KEPERAWATAN' => $eklaim->cleanCurrency($keperawatan),
            'PENUNJANG' => $eklaim->cleanCurrency($penunjang),
            'RADIOLOGI' => $eklaim->cleanCurrency($radiologi),
            'LABORATORIUM' => $eklaim->cleanCurrency($laboratorium),
            'PELAYANAN_DARAH' => $eklaim->cleanCurrency($pelayanan_darah),
            'REHABILITASI' => $eklaim->cleanCurrency($rehabilitasi),
            'KAMAR' => $eklaim->cleanCurrency($kamar),
            'RAWAT_INTENSIF' => $eklaim->cleanCurrency($rawat_intensif),
            'OBAT' => $eklaim->cleanCurrency($obat),
            'OBAT_KRONIS' => $eklaim->cleanCurrency($obat_kronis),
            'OBAT_KEMOTERAPI' => $eklaim->cleanCurrency($obat_kemoterapi),
            'ALKES' => $eklaim->cleanCurrency($alkes),
            'BMHP' => $eklaim->cleanCurrency($bmhp),
            'SEWA_ALAT' => $eklaim->cleanCurrency($sewa_alat)
        ];

        // return $this->response->setJSON($dataTarif);

        $eklaimTarif->insertOrUpdateTarifRS($dataTarif);

        if ($persalinan == 1) {
            $ws_query['data']['persalinan'] = array_merge([
                "usia_kehamilan" => $usia_kehamilan,
                "gravida" => $gravida,
                "partus" => $partus,
                "abortus" => $abortus,
                "onset_kontraksi" => $onset_kontraksi,
                "delivery" => array_reduce(array_keys($delivery_sequence ?? []), function ($carry, $key) use (
                    $delivery_sequence,
                    $delivery_method,
                    $delivery_dttm,
                    $use_manual,
                    $use_forcep,
                    $use_vacuum,
                    $letak_janin,
                    $shk_spesimen_ambil,
                    $shk_lokasi,
                    $shk_alasan,
                    $shk_spesimen_dttm,
                    $kondisi
                ) {
                    $carry[$key] = [
                        "delivery_sequence" => @$delivery_sequence[$key],
                        "delivery_method" => @$delivery_method[$key],
                        "delivery_dttm" => @$delivery_dttm[$key],
                        "use_manual" => @$use_manual[$key],
                        "use_forcep" => @$use_forcep[$key],
                        "use_vacuum" => @$use_vacuum[$key],
                        "letak_janin" => @$letak_janin[$key],
                        "shk_spesimen_ambil" => @$shk_spesimen_ambil[$key],
                        "shk_lokasi" => @$shk_lokasi[$key],
                        "shk_alasan" => @$shk_alasan[$key],
                        "shk_spesimen_dttm" => @$shk_spesimen_dttm[$key],
                        "kondisi" => @$kondisi[$key],
                    ];
                    return $carry;
                }, [])
            ]);

            $eklaimObstetri = new EklaimObstetriModel();

            $dataObstetri = [
                'TRANS_ID' => $trans_id,
                'NOSEP_KLAIM' => $nomor_sep,
                'USIA_KEHAMILAN' => $usia_kehamilan,
                'GRAVIDA' => $gravida,
                'PARTUS' => $partus,
                'ABORTUS' => $abortus,
                'ONSET_KONTRAKSI' => $onset_kontraksi
            ];

            $eklaimObstetri->insertOrUpdateObstetri($dataObstetri);


            $eklaimObsDel = new EklaimObstetriDeliveryModel();

            // Hapus delivery sebelumnya dulu (jika update total)
            $eklaimObsDel->deleteByTransAndNosep($trans_id, $nomor_sep);

            // Siapkan data delivery
            $deliveryList = [];

            foreach ($delivery_sequence as $key => $val) {
                $deliveryList[] = [
                    'TRANS_ID' => $trans_id,
                    'NOSEP_KLAIM' => $nomor_sep,
                    'DELIVERY_SEQUENCE' => @$delivery_sequence[$key],
                    'DELIVERY_METHOD' => @$delivery_method[$key],
                    'DELIVERY_DTTM' => str_replace("T", " ", $delivery_dttm[$key]) . ":00",
                    'USE_MANUAL' => @$use_manual[$key],
                    'USE_FORCEP' => @$use_forcep[$key],
                    'USE_VACUUM' => @$use_vacuum[$key],
                    'LETAK_JANIN' => @$letak_janin[$key],
                    'SHK_SPESIMEN_AMBIL' => @$shk_spesimen_ambil[$key],
                    'SHK_LOKASI' => @$shk_lokasi[$key],
                    'SHK_ALASAN' => @$shk_alasan[$key],
                    'SHK_SPESIMEN_DTTM' => str_replace("T", " ", $shk_spesimen_dttm[$key]) . ":00",
                    'KONDISI' => @$kondisi[$key]
                ];
            }

            // Insert multiple deliveries
            $eklaimObsDel->insertBatchDelivery($deliveryList);
        }

        // return $this->response->setJSON($ws_query);

        if ($upgrade_class_ind == 1) {
            $ws_query["data"] = array_merge($ws_query["data"], [
                "upgrade_class_class" => $upgrade_class_class,
                "upgrade_class_los" => $upgrade_class_los,
                "upgrade_class_payor" => $upgrade_class_payor,
                "add_payment_pct" => $add_payment_pct,
            ]);

            $eklaimUpgrade = new EklaimUpgradeClassModel();

            $dataUpgrade = [
                'TRANS_ID' => $trans_id,
                'NOSEP_KLAIM' => $nomor_sep,
                'UPGRADE_CLASS_IND' => $upgrade_class_ind,
                'UPGRADE_CLASS_CLASS' => $upgrade_class_class,
                'UPGRADE_CLASS_LOS' => $upgrade_class_los,
                'UPGRADE_CLASS_PAYOR' => $upgrade_class_payor,
                'ADD_PAYMENT_PCT' => $add_payment_pct,
                'ADD_PAYMENT_AMT' => 0
            ];

            $eklaimUpgrade->insertOrUpdateUpgradeClass($dataUpgrade);
        }
        if ($apgar == 1) {
            $ws_query["data"]["apgar"]["menit_1"]["appearance"] = $appearance[0];
            $ws_query["data"]["apgar"]["menit_1"]["pulse"] = $pulse[0];
            $ws_query["data"]["apgar"]["menit_1"]["grimace"] = $grimace[0];
            $ws_query["data"]["apgar"]["menit_1"]["activity"] = $activity[0];
            $ws_query["data"]["apgar"]["menit_1"]["respiration"] = $respiration[0];

            $ws_query["data"]["apgar"]["menit_5"]["appearance"] = $appearance[1];
            $ws_query["data"]["apgar"]["menit_5"]["pulse"] = $pulse[1];
            $ws_query["data"]["apgar"]["menit_5"]["grimace"] = $grimace[1];
            $ws_query["data"]["apgar"]["menit_5"]["activity"] = $activity[1];
            $ws_query["data"]["apgar"]["menit_5"]["respiration"] = $respiration[1];
        }

        if ($covid_indicator == 1) {
            $ws_query["data"]["pemulasaraan_jenazah"] = $pemulasaraan_jenazah;
            $ws_query["data"]["kantong_jenazah"] = $kantong_jenazah;
            $ws_query["data"]["peti_jenazah"] = $peti_jenazah;
            $ws_query["data"]["plastik_erat"] = $plastik_erat;
            $ws_query["data"]["desinfektan_jenazah"] = $desinfektan_jenazah;
            $ws_query["data"]["mobil_jenazah"] = $mobil_jenazah;
            $ws_query["data"]["desinfektan_mobil_jenazah"] = $desinfektan_mobil_jenazah;

            $eklaimJenazah = new EklaimJenazahModel();

            $dataJenazah = [
                'TRANS_ID' => $trans_id,
                'NOSEP_KLAIM' => $nomor_sep,
                'PEMULASARAAN' => $pemulasaraan_jenazah,
                'KANTONG' => $kantong_jenazah,
                'PETI' => $peti_jenazah,
                'PLASTIK' => $plastik_erat,
                'DESINFEKTAN' => $desinfektan_jenazah,
                'MOBIL' => $mobil_jenazah,
                'DESINFEKTAN_MOBIL' => $desinfektan_mobil_jenazah
            ];

            $eklaimJenazah->insertOrUpdateJenazah($dataJenazah);


            $episodes = '';

            if ($episodes7 != '') {
                $episodes = $episodes . '7;' . $episodes7 . '#';
            }
            if ($episodes8 != '') {
                $episodes = $episodes . '8;' . $episodes8 . '#';
            }
            if ($episodes9 != '') {
                $episodes = $episodes . '9;' . $episodes9 . '#';
            }
            if ($episodes10 != '') {
                $episodes = $episodes . '10;' . $episodes10 . '#';
            }
            if ($episodes11 != '') {
                $episodes = $episodes . '11;' . $episodes11 . '#';
            }
            if ($episodes12 != '') {
                $episodes = $episodes . '12;' . $episodes12 . '#';
            }
            $episodes = substr($episodes, 0, strlen($episodes) - 1);



            $ws_query["data"]["covid19_status_cd"] = $covid19_status_cd;
            $ws_query["data"]["nomor_kartu_t"] = $nomor_kartu_t;
            $ws_query["data"]["episodes"] = $episodes;
            $ws_query["data"]["covid19_cc_ind"] = $covid19_cc_ind;
            $ws_query["data"]["covid19_rs_darurat_ind"] = $covid19_rs_darurat_ind;
            $ws_query["data"]["covid19_co_insidense_ind"] = $covid19_co_insidense_ind;

            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_asam_laktat"] = $lab_asam_laktat;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_procalcitonin"] = $lab_procalcitonin;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_crp"] = $lab_crp;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_kultur"] = $lab_kultur;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_d_dimer"] = $lab_d_dimer;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_pt"] = $lab_pt;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_aptt"] = $lab_aptt;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_waktu_pendarahan"] = $lab_waktu_pendarahan;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_anti_hiv"] = $lab_anti_hiv;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_analisa_gas"] = $lab_analisa_gas;
            $ws_query["data"]["covid19_penunjang_pengurang"]["lab_albumin"] = $lab_albumin;
            $ws_query["data"]["covid19_penunjang_pengurang"]["rad_thorax_ap_pa"] = $rad_thorax_ap_pa;

            $ws_query["data"]["terapi_konvalesen"] = $terapi_konvalesen;
            $ws_query["data"]["isoman_ind"] = $isoman_ind;

            $dataCovid = [
                'TRANS_ID' => $trans_id,
                'NOSEP_KLAIM' => $nomor_sep,
                'COVID_STATUS_CD' => $covid19_status_cd,
                'CC_IND' => $covid19_cc_ind,
                'RS_DARURAT_IND' => $covid19_rs_darurat_ind,
                'CO_INSIDENSE_IND' => $covid19_co_insidense_ind,
                'ISOMAN_IND' => $isoman_ind,
                'BAYI_LAHIR_STATUS_CD' => $bayi_lahir_status_cd,
                'TERAPI_KONVALESEN' => $terapi_konvalesen,
                'NOMOR_KARTU_T' => $nomor_kartu_t,

                'EPISODES7' => $episodes7,
                'EPISODES8' => $episodes8,
                'EPISODES9' => $episodes9,
                'EPISODES10' => $episodes10,
                'EPISODES11' => $episodes11,
                'EPISODES12' => $episodes12,

                'LAB_ASAM_LAKTAT' => $lab_asam_laktat,
                'LAB_PROCALCITONIN' => $lab_procalcitonin,
                'LAB_CRP' => $lab_crp,
                'LAB_KULTUR' => $lab_kultur,
                'LAB_D_DIMER' => $lab_d_dimer,
                'LAB_PT' => $lab_pt,
                'LAB_APTT' => $lab_aptt,
                'LAB_WAKTU_PENDARAHAN' => $lab_waktu_pendarahan,
                'LAB_ANTI_HIV' => $lab_anti_hiv,
                'LAB_ANALISA_GAS' => $lab_analisa_gas,
                'LAB_ALBUMIN' => $lab_albumin,
                'RAD_THORAX_AP_PA' => $rad_thorax_ap_pa
            ];
            $covidModel = new EklaimCovidModel();
            $covidModel->insertOrUpdateCovidData($dataCovid);
        }

        $json_request = json_encode($ws_query);
        if (!empty($unuDiag)) {
            $pds = new PasienDiagnosasModel();
            $pds->like('pasien_diagnosa_id', $nomor_sep . '%')->delete();

            foreach ($unuDiag as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $nomor_sep . 'unu';
                $dataDiag['diagnosa_id'] = $unuDiag[$key];
                $dataDiag['diagnosa_name'] = $unuDiagName[$key];
                $dataDiag['diag_cat'] = $unuDiagCat[$key];
                $dataDiag['modified_by'] = user()->username;

                $pds->insert($dataDiag);
            }
            if (!empty($inaDiag))
                foreach ($inaDiag as $key => $value) {
                    $dataDiag = [];
                    $dataDiag['pasien_diagnosa_id'] = $nomor_sep . 'ina';
                    $dataDiag['diagnosa_id'] = $inaDiag[$key];
                    $dataDiag['diagnosa_name'] = $inaDiagName[$key];
                    $dataDiag['diag_cat'] = $inaDiagCat[$key];
                    $dataDiag['modified_by'] = user()->username;

                    $pds->insert($dataDiag);
                }
        }
        if (!empty($unuProc)) {
            $pcs = new PasienProceduresModel();
            $pcs->like('pasien_diagnosa_id', $nomor_sep . '%')->delete();

            foreach ($unuProc as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = $nomor_sep . 'unu';
                $dataProc['diagnosa_id'] = $unuProc[$key];
                $dataProc['diagnosa_name'] = $unuProcName[$key];
                $dataProc['modified_by'] = user()->username;
                $pcs->insert($dataProc);
            }
            if (!empty($inaProc))
                foreach ($inaProc as $key => $value) {
                    $dataProc = [];
                    $dataProc['pasien_diagnosa_id'] = $nomor_sep . 'ina';
                    $dataProc['diagnosa_id'] = $inaProc[$key];
                    $dataProc['diagnosa_name'] = $inaProcName[$key];
                    $dataProc['modified_by'] = user()->username;
                    $pcs->insert($dataProc);
                }
        }


        // return $dataClaim;
        $response['metadata']['code'] = '200';
        $response['metadata']['status'] = 'success';
        $response['data'] = $ws_query;

        if ($currentStep < 1) {
            $resultSetKlaim = $eklaim->sendRequest('set_claim_data', $json_request, $nomor_sep);
        } else {
            $resultSetKlaim['metadata']['code'] = '400';
        }

        return $this->response->setJSON($response);
    }
    public function postGrouper()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $nomor_sep = $body['nomor_sep'];
        $trans_id = $body['trans_id'];
        $ws_grouper1["metadata"]["method"] = "grouper";
        $ws_grouper1["metadata"]["stage"] = "1";
        $ws_grouper1["data"]["nomor_sep"] = $nomor_sep;
        // return $this->response->setJSON($ws_grouper1);
        $eklaim = new EklaimService();
        $json_request = json_encode($ws_grouper1);
        $resultGrouper1 = $eklaim->sendRequest('grouper1', $json_request, $nomor_sep);
        // return $this->response->setJSON($resultGrouper1);

        if ($resultGrouper1['metadata']['code'] == 200) {
            $grouperModel = new GrouperModel();
            $grouperModel->where("no_sep", $nomor_sep)->delete();
            $jmlgrouper = 0;
            if (!is_null($resultGrouper1['response']['cbg']) and isset($resultGrouper1['response']['cbg'])) {
                $cbg = $resultGrouper1['response']['cbg'];
                if (isset($cbg['tariff'])) {
                    $grouperData = [
                        'no_sep' => $nomor_sep,
                        'grouper_stage' => '1',
                        'grouper_type' => '1',
                        'code' => $cbg['code'],
                        'descriptions' => $cbg['description'],
                        'tarif' => $cbg['tariff'],
                        'modified_by' => user_id()
                    ];
                    // $db->query("delete from grouper where no_sep = '$sep' and code = '" . $cbg['code'] . "'");
                    $grouperModel->insert($grouperData);
                    $jmlgrouper += $cbg['tariff'];
                }
            }
            if (isset($resultGrouper1['response']['sub_acute'])) {
                $sub_acute = $resultGrouper1['response']['sub_acute'];
                if (isset($sub_acute['tariff'])) {
                    // DB::delete("delete from grouper where no_sep = '$sep' and code = '".$sub_acute['code']."'");
                    $grouperData = [
                        'no_sep' => $nomor_sep,
                        'grouper_stage' => '1',
                        'grouper_type' => '2',
                        'code' => $sub_acute['code'],
                        'descriptions' => $sub_acute['description'],
                        'tarif' => $sub_acute['tariff'],
                        'modified_by' => user_id()
                    ];
                    $grouperModel->insert($grouperData);
                    $jmlgrouper += $sub_acute['tariff'];
                }
            } else {
                $grouperData = [
                    'no_sep' => $nomor_sep,
                    'grouper_stage' => '1',
                    'grouper_type' => '2',
                    'code' => '-',
                    'descriptions' => '-',
                    'tarif' => 0,
                    'modified_by' => user_id()
                ];
                // $grouperModel->insert($grouperData);
            }
            if (isset($resultGrouper1['response']['chronic'])) {
                $chronic = $resultGrouper1['response']['chronic'];
                if (isset($chronic)) {
                    // DB::delete("delete from grouper where no_sep = '$sep' and code = '".$chronic['code']."'");
                    $grouperData = [
                        'no_sep' => $nomor_sep,
                        'grouper_stage' => '1',
                        'grouper_type' => '3',
                        'code' => $chronic['code'],
                        'descriptions' => $chronic['description'],
                        'tarif' => $chronic['tariff'],
                        'modified_by' => user_id()
                    ];
                    $grouperModel->insert($grouperData);
                    $jmlgrouper += $chronic['tariff'];
                }
            } else {
                $grouperData = [
                    'no_sep' => $nomor_sep,
                    'grouper_stage' => '1',
                    'grouper_type' => '3',
                    'code' => '-',
                    'descriptions' => '-',
                    'tarif' => 0,
                    'modified_by' => user_id()
                ];
            }
            $eklaimModel = new EklaimModel();
            if (isset($resultGrouper1['response']['add_payment_amt'])) {
                $amt = $resultGrouper1['response']['add_payment_amt'];
                if (isset($amt)) {
                    $grouperAmt = [
                        'add_payment_amt' => $amt
                    ];
                    $eklaimModel->update($nomor_sep, $grouperAmt);
                }
            }

            try {
                // Ensure $jmlgrouper is set and is a valid numeric value
                $jmlgrouper = isset($jmlgrouper) ? (float)$jmlgrouper : 0.0;

                // Ensure $nomor_sep is set and is a string
                $nomor_sep = isset($nomor_sep) ? (string)$nomor_sep : '';

                // Call the save method
                $eklaimModel->save([
                    'claim_value' => (float)$jmlgrouper,
                    'nomor_sep' => $nomor_sep
                ]);
            } catch (\Exception $e) {
                // Handle the exception (e.g., log the error, show a message to the user)
                // error_log($e->getMessage()); // Log the error message
                // echo 'An error occurred while saving data.';
            }
            try {

                // dd($json_response);
                if (isset($resultGrouper1['special_cmg_option'])) {
                    $special_cmg = $resultGrouper1['special_cmg_option'];
                    // dd($special_cmg);
                    // if (isset($json_response['special_cmg'])) {
                    // $special_cmg = $json_response['special_cmg'];
                    $jmlgrouper2 = 0;
                    // dd($special_cmg);
                    $grouperModel->where('grouper_stage', '2')->where('no_sep', $nomor_sep)->delete();
                    foreach ($special_cmg as $key => $value) {
                        if ($special_cmg[$key]['type'] == 'Special Prosthesist') {
                            $type = 4;
                        } elseif ($special_cmg[$key]['type'] == 'Special Procedure') {
                            $type = 5;
                        } elseif ($special_cmg[$key]['type'] == 'Special Investigation') {
                            $type = 6;
                        } elseif ($special_cmg[$key]['type'] == 'Special Drug') {
                            $type = 7;
                        }
                        $grouperModel->insert([
                            'no_sep' => $nomor_sep,
                            'grouper_stage' => '2',
                            'grouper_type' => $type,
                            'code' => $special_cmg[$key]['code'],
                            'descriptions' => $special_cmg[$key]['description'],
                            'modified_by' => user_id()
                        ]);
                        // $jmlgrouper2 += $special_cmg[$key]['tariff'];
                    };
                }
                if (isset($resultGrouper1['tarif_alt'])) {
                    $tarif_alt = $resultGrouper1['tarif_alt'];
                    foreach ($tarif_alt as $key => $value) {
                        if (isset($tarif_alt[$key]['tarif_inacbg'])) {
                            $tarifAltModel = new TarifAltModel();
                            $tarifAltModel->where('nosep', $nomor_sep)->delete();
                            $tarifAltModel->insert([
                                'nosep' => $nomor_sep,
                                'class_id' => $tarif_alt[$key]['kelas'],
                                'tarif_inacbg' => $tarif_alt[$key]['tarif_inacbg'],
                                'tarif_sp' => 0,
                                'tarif_sr' => 0,
                                'modified_by' => user_id()
                            ]);
                        }
                    }
                }
                $db = db_connect();
                $db->query("update eklaim_klaim set
                claim_value = (select sum(tarif) from grouper where no_sep = '$nomor_sep')
                where nosep_klaim = '$nomor_sep'");
            } catch (\Exception $e) {
                // Return error response
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ])->setStatusCode(500); // Internal Server Error
            }
        }
        $response['code'] = '200';
        $response['message'] = 'success';
        $response['data'] = $resultGrouper1;
        return $this->response->setJSON($response);
    }
    public function postEklaims()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getPost();
        foreach ($body as $key => $value) {
            ${$key} = $value;
        }
        // return ($body['currentStep']);

        $currentStep = $this->request->getPost('currentStep');
        $trans_id = $this->request->getPost('trans_id');
        $visit_id = $this->request->getPost('visit_id');
        $nosep = $this->request->getPost('nosep');
        $nosep_inap = $this->request->getPost('nosep_inap');
        $nama_pasien = $this->request->getPost('nama_pasien');
        $gender = $this->request->getPost('gender');
        $nomor_rm = $this->request->getPost('nomor_rm');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $nomor_kartu = $this->request->getPost('nomor_kartu');
        $nomor_sep = $this->request->getPost('nomor_sep');
        $nama_dokter = $this->request->getPost('nama_dokter');
        $payor_id = $this->request->getPost('payor_id');
        $payor_cd = $this->request->getPost('payor_cd');
        $cob_cd = $this->request->getPost('cob_cd');
        // $kode_tarif = $this->request->getPost('kode_tarif');
        $kode_tarif = "DS";
        // return json_encode($kode_tarif);
        $jenis_rawat = $this->request->getPost('jenis_rawat');
        $kelas_rawat = $this->request->getPost('kelas_rawat');
        $tgl_masuk = $this->request->getPost('tgl_masuk');
        $tgl_pulang = $this->request->getPost('tgl_pulang');
        $cara_masuk = $this->request->getPost('cara_masuk');
        $discharge_status = $this->request->getPost('discharge_status');
        $coder_nik = $this->request->getPost('coder_nik');
        $sistole = $this->request->getPost('tension_upper');
        $diastole = $this->request->getPost('tension_below');
        $adl_sub_acute = $this->request->getPost('adl_sub_acute');
        $adl_chronic = $this->request->getPost('adl_chronic');
        $dializer_single_use = $this->request->getPost('dializer_single_use');
        $kantong_darah = $this->request->getPost('kantong_darah');
        $upgrade_class_ind = $this->request->getPost('upgrade_class_ind');
        $upgrade_class_class = $this->request->getPost('upgrade_class_class');
        $upgrade_class_los = $this->request->getPost('upgrade_class_los');
        $upgrade_class_payor = $this->request->getPost('upgrade_class_payor');
        $add_payment_pct = $this->request->getPost('add_payment_pct');
        $birth_weight = $this->request->getPost('birth_weight');
        $unuDiag = $this->request->getPost('unuDiag');
        $unuDiagCat = $this->request->getPost('unuDiagCat');
        $unuProc = $this->request->getPost('unuProc');
        $inaDiag = $this->request->getPost('inaDiag');
        $inaDiagCat = $this->request->getPost('inaDiagCat');
        $inaProc = $this->request->getPost('inaProc');
        $prosedur_non_bedah = $this->request->getPost('prosedur_non_bedah');
        $prosedur_bedah = $this->request->getPost('prosedur_bedah');
        $konsultasi = $this->request->getPost('konsultasi');
        $tenaga_ahli = $this->request->getPost('tenaga_ahli');
        $keperawatan = $this->request->getPost('keperawatan');
        $penunjang = $this->request->getPost('penunjang');
        $radiologi = $this->request->getPost('radiologi');
        $laboratorium = $this->request->getPost('laboratorium');
        $pelayanan_darah = $this->request->getPost('pelayanan_darah');
        $rehabilitasi = $this->request->getPost('rehabilitasi');
        $kamar = $this->request->getPost('kamar');
        $rawat_intensif = $this->request->getPost('rawat_intensif');
        $obat = $this->request->getPost('obat');
        $obat_kronis = $this->request->getPost('obat_kronis');
        $obat_kemoterapi = $this->request->getPost('obat_kemoterapi');
        $alkes = $this->request->getPost('alkes');
        $bmhp = $this->request->getPost('bmhp');
        $sewa_alat = $this->request->getPost('sewa_alat');
        $billing_amount = $this->request->getPost('billing_amount');

        $icu_indikator = $this->request->getPost('icu_indikator');
        $icu_los = $this->request->getPost('icu_los');
        $ventilator_hour = $this->request->getPost('ventilator_hour');
        $use_ind = $this->request->getPost('use_ind');
        $start_dttm = $this->request->getPost('start_dttm');
        $stop_dttm = $this->request->getPost('start_dttm');
        $apgar = $this->request->getPost('apgar');
        $appearance = $this->request->getPost('appearance');
        $pulse = $this->request->getPost('pulse');
        $grimace = $this->request->getPost('grimace');
        $activity = $this->request->getPost('activity');
        $respiration = $this->request->getPost('respiration');
        $persalinan = $this->request->getPost('persalinan');
        $usia_kehamilan = $this->request->getPost('usia_kehamilan');
        $onset_kontraksi = $this->request->getPost('onset_kontraksi');
        $gravida = $this->request->getPost('gravida');
        $partus = $this->request->getPost('partus');
        $abortus = $this->request->getPost('abortus');
        $delivery_sequence = $this->request->getPost('delivery_sequence');
        $delivery_method = $this->request->getPost('delivery_method');
        $use_manual = $this->request->getPost('use_manual');
        $use_forcep = $this->request->getPost('use_forcep');
        $use_vacuum = $this->request->getPost('use_vacuum');
        $delivery_dttm = $this->request->getPost('delivery_dttm');
        $letak_janin = $this->request->getPost('letak_janin');
        $kondisi = $this->request->getPost('kondisi');
        $shk_spesimen_ambil = $this->request->getPost('shk_spesimen_ambil');
        $shk_lokasi = $this->request->getPost('shk_lokasi');
        $shk_alasan = $this->request->getPost('shk_alasan');
        $shk_spesimen_dttm = $this->request->getPost('shk_spesimen_dttm');
        $tarif_poli_eks = $this->request->getPost('tarif_poli_eks');
        $covid_indicator = $this->request->getPost('covid_indicator');
        $covid19_status_cd = $this->request->getPost('covid19_status_cd');
        $nomor_kartu_t = $this->request->getPost('nomor_kartu_t');
        $covid19_no_sep = $this->request->getPost('covid19_no_sep');
        $terapi_konvalesen = $this->request->getPost('terapi_konvalesen');
        $isoman_ind = $this->request->getPost('isoman_ind');
        $bayi_lahir_status_cd = $this->request->getPost('bayi_lahir_status_cd');
        $covid19_rs_darurat_ind = $this->request->getPost('covid19_rs_darurat_ind');
        $covid19_cc_ind = $this->request->getPost('covid19_cc_ind');
        $covid19_co_insidense_ind = $this->request->getPost('covid19_co_insidense_ind');
        $episodes7 = $this->request->getPost('episodes7');
        $episodes8 = $this->request->getPost('episodes8');
        $episodes9 = $this->request->getPost('episodes9');
        $episodes10 = $this->request->getPost('episodes10');
        $episodes11 = $this->request->getPost('episodes11');
        $episodes12 = $this->request->getPost('episodes12');
        $lab_asam_laktat = $this->request->getPost('lab_asam_laktat');
        $lab_d_dimer = $this->request->getPost('lab_d_dimer');
        $lab_anti_hiv = $this->request->getPost('lab_anti_hiv');
        $lab_procalcitonin = $this->request->getPost('lab_procalcitonin');
        $lab_analisa_gas = $this->request->getPost('lab_analisa_gas');
        $lab_crp = $this->request->getPost('lab_crp');
        $lab_aptt = $this->request->getPost('lab_aptt');
        $lab_pt = $this->request->getPost('lab_pt');
        $lab_albumin = $this->request->getPost('lab_albumin');
        $lab_kultur = $this->request->getPost('lab_kultur');
        $lab_waktu_pendarahan = $this->request->getPost('lab_waktu_pendarahan');
        $rad_thorax_ap_pa = $this->request->getPost('rad_thorax_ap_pa');
        $pemulasaraan_jenazah = $this->request->getPost('pemulasaraan_jenazah');
        $kantong_jenazah = $this->request->getPost('kantong_jenazah');
        $peti_jenazah = $this->request->getPost('peti_jenazah');
        $plastik_erat = $this->request->getPost('plastik_erat');
        $desinfektan_jenazah = $this->request->getPost('desinfektan_jenazah');
        $mobil_jenazah = $this->request->getPost('mobil_jenazah');
        $desinfektan_mobil_jenazah = $this->request->getPost('desinfektan_mobil_jenazah');
        $tdbilling_amount = $this->request->getPost('tdbilling_amount');





        $ws_new_claim["metadata"]["method"] = "new_claim";
        $ws_new_claim["data"]["nomor_kartu"] = $nomor_kartu;
        $ws_new_claim["data"]["nomor_sep"] = $nomor_sep;
        $ws_new_claim["data"]["nomor_rm"] = $nomor_rm;
        $ws_new_claim["data"]["nama_pasien"] = $nama_pasien;
        $ws_new_claim["data"]["tgl_lahir"] = $tgl_lahir;
        $ws_new_claim["data"]["gender"] = $gender;





        $ws_query["metadata"]["method"] = "set_claim_data";
        $ws_query["metadata"]["nomor_sep"] = $nomor_sep;

        $ws_query["data"]["nomor_sep"] = $nomor_sep;
        $ws_query["data"]["nomor_kartu"] = $nomor_kartu;
        $ws_query["data"]["tgl_masuk"] = $tgl_masuk;
        $ws_query["data"]["tgl_pulang"] = $tgl_pulang;
        $ws_query["data"]["cara_masuk"] = $cara_masuk;
        $ws_query["data"]["jenis_rawat"] = $jenis_rawat;
        $ws_query["data"]["kelas_rawat"] = $kelas_rawat;
        // $ws_query["data"]["adl_sub_acute"] = $adl_sub_acute;
        // $ws_query["data"]["adl_chronic"] = $adl_chronic;
        $ws_query["data"]["icu_indikator"] = $icu_indikator;
        $ws_query["data"]["icu_los"] = $icu_los;
        $ws_query["data"]["ventilator_hour"] = $ventilator_hour;
        $ws_query["data"]["ventilator"]["use_ind"] = $use_ind;
        $ws_query["data"]["ventilator"]["start_dttm"] = $start_dttm;
        $ws_query["data"]["ventilator"]["stop_dttm"] = $stop_dttm;


        $ws_query["data"]["upgrade_class_ind"] = $upgrade_class_ind;

        if ($upgrade_class_ind == 1) {
            $ws_query["data"]["upgrade_class_class"] = $upgrade_class_class;
            $ws_query["data"]["upgrade_class_los"] = $upgrade_class_los;
            $ws_query["data"]["upgrade_class_payor"] = $upgrade_class_payor;
            $ws_query["data"]["add_payment_pct"] = $add_payment_pct;
        }


        $ws_query["data"]["birth_weight"] = $birth_weight;
        $ws_query["data"]["sistole"] = $sistole;
        $ws_query["data"]["diastole"] = $diastole;
        $ws_query["data"]["discharge_status"] = $discharge_status;


        $diagnosa = '';
        if ($unuDiag != '') {
            foreach ($unuDiag as $key => $value) {
                $diagnosa .= $unuDiag[$key] . "#";
            }
            $diagnosa = substr($diagnosa, 0, strlen($diagnosa) - 1);
        }

        $procedure = '';
        if ($unuProc != '') {
            foreach ($unuProc as $key => $value) {
                $procedure .= $unuProc[$key] . "#";
            }
            $procedure = substr($procedure, 0, strlen($procedure) - 1);
        }


        $diagnosa_inagrouper = '';
        if ($inaDiag != '') {
            foreach ($inaDiag as $key => $value) {
                $diagnosa_inagrouper .= $inaDiag[$key] . "#";
            }
            $diagnosa_inagrouper = substr($diagnosa_inagrouper, 0, strlen($diagnosa_inagrouper) - 1);
        }

        $procedure_inagrouper = '';
        if ($inaProc != '') {
            foreach ($inaProc as $key => $value) {
                $procedure_inagrouper .= $inaProc[$key] . "#";
            }
            $procedure_inagrouper = substr($procedure_inagrouper, 0, strlen($procedure_inagrouper) - 1);
        }



        $ws_query["data"]["diagnosa"] = $diagnosa;
        $ws_query["data"]["procedure"] = $procedure;
        $ws_query["data"]["diagnosa_inagrouper"] = $diagnosa_inagrouper;
        $ws_query["data"]["procedure_inagrouper"] = $procedure_inagrouper;

        $ws_query["data"]["tarif_rs"]["prosedur_non_bedah"] = str_replace(",", ".", str_replace(".", "", $prosedur_non_bedah));
        $ws_query["data"]["tarif_rs"]["prosedur_bedah"] = str_replace(",", ".", str_replace(".", "", $prosedur_bedah));
        $ws_query["data"]["tarif_rs"]["konsultasi"] = str_replace(",", ".", str_replace(".", "", $konsultasi));
        $ws_query["data"]["tarif_rs"]["tenaga_ahli"] = str_replace(",", ".", str_replace(".", "", $tenaga_ahli));
        $ws_query["data"]["tarif_rs"]["keperawatan"] = str_replace(",", ".", str_replace(".", "", $keperawatan));
        $ws_query["data"]["tarif_rs"]["penunjang"] = str_replace(",", ".", str_replace(".", "", $penunjang));
        $ws_query["data"]["tarif_rs"]["radiologi"] = str_replace(",", ".", str_replace(".", "", $radiologi));
        $ws_query["data"]["tarif_rs"]["laboratorium"] = str_replace(",", ".", str_replace(".", "", $laboratorium));
        $ws_query["data"]["tarif_rs"]["pelayanan_darah"] = str_replace(",", ".", str_replace(".", "", $pelayanan_darah));
        $ws_query["data"]["tarif_rs"]["rehabilitasi"] = str_replace(",", ".", str_replace(".", "", $rehabilitasi));
        $ws_query["data"]["tarif_rs"]["kamar"] = str_replace(",", ".", str_replace(".", "", $kamar));
        $ws_query["data"]["tarif_rs"]["rawat_intensif"] = str_replace(",", ".", str_replace(".", "", $rawat_intensif));
        $ws_query["data"]["tarif_rs"]["obat"] = str_replace(",", ".", str_replace(".", "", $obat));
        $ws_query["data"]["tarif_rs"]["obat_kronis"] = str_replace(",", ".", str_replace(".", "", $obat_kronis));
        $ws_query["data"]["tarif_rs"]["obat_kemoterapi"] = str_replace(",", ".", str_replace(".", "", $obat_kemoterapi));
        $ws_query["data"]["tarif_rs"]["alkes"] = str_replace(",", ".", str_replace(".", "", $alkes));
        $ws_query["data"]["tarif_rs"]["bmhp"] = str_replace(",", ".", str_replace(".", "", $bmhp));
        $ws_query["data"]["tarif_rs"]["sewa_alat"] = str_replace(",", ".", str_replace(".", "", $sewa_alat));

        $ws_query["data"]["pemulasaraan_jenazah"] = $pemulasaraan_jenazah;
        $ws_query["data"]["kantong_jenazah"] = $kantong_jenazah;
        $ws_query["data"]["peti_jenazah"] = $peti_jenazah;
        $ws_query["data"]["plastik_erat"] = $plastik_erat;
        $ws_query["data"]["desinfektan_jenazah"] = $desinfektan_jenazah;
        $ws_query["data"]["mobil_jenazah"] = $mobil_jenazah;
        $ws_query["data"]["desinfektan_mobil_jenazah"] = $desinfektan_mobil_jenazah;
        $ws_query["data"]["covid19_status_cd"] = $covid19_status_cd;
        $ws_query["data"]["nomor_kartu_t"] = $nomor_kartu_t;

        $episodes = '';

        if ($episodes7 != '') {
            $episodes = $episodes . '7;' . $episodes7 . '#';
        }
        if ($episodes8 != '') {
            $episodes = $episodes . '8;' . $episodes8 . '#';
        }
        if ($episodes9 != '') {
            $episodes = $episodes . '9;' . $episodes9 . '#';
        }
        if ($episodes10 != '') {
            $episodes = $episodes . '10;' . $episodes10 . '#';
        }
        if ($episodes11 != '') {
            $episodes = $episodes . '11;' . $episodes11 . '#';
        }
        if ($episodes12 != '') {
            $episodes = $episodes . '12;' . $episodes12 . '#';
        }
        $episodes = substr($episodes, 0, strlen($episodes) - 1);



        $ws_query["data"]["episodes"] = $episodes;
        $ws_query["data"]["covid19_cc_ind"] = $covid19_cc_ind;
        $ws_query["data"]["covid19_rs_darurat_ind"] = $covid19_rs_darurat_ind;
        $ws_query["data"]["covid19_co_insidense_ind"] = $covid19_co_insidense_ind;

        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_asam_laktat"] = $lab_asam_laktat;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_procalcitonin"] = $lab_procalcitonin;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_crp"] = $lab_crp;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_kultur"] = $lab_kultur;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_d_dimer"] = $lab_d_dimer;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_pt"] = $lab_pt;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_aptt"] = $lab_aptt;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_waktu_pendarahan"] = $lab_waktu_pendarahan;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_anti_hiv"] = $lab_anti_hiv;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_analisa_gas"] = $lab_analisa_gas;
        $ws_query["data"]["covid19_penunjang_pengurang"]["lab_albumin"] = $lab_albumin;
        $ws_query["data"]["covid19_penunjang_pengurang"]["rad_thorax_ap_pa"] = $rad_thorax_ap_pa;

        $ws_query["data"]["terapi_konvalesen"] = $terapi_konvalesen;
        $ws_query["data"]["isoman_ind"] = $isoman_ind;


        $ws_query["data"]["bayi_lahir_status_cd"] = $bayi_lahir_status_cd;
        $ws_query["data"]["dializer_single_use"] = $dializer_single_use;
        $ws_query["data"]["kantong_darah"] = $kantong_darah;



        $ws_query["data"]["persalinan"]["usia_kehamilan"] = $usia_kehamilan;
        $ws_query["data"]["persalinan"]["gravida"] = $gravida;
        $ws_query["data"]["persalinan"]["partus"] = $partus;
        $ws_query["data"]["persalinan"]["abortus"] = $abortus;
        $ws_query["data"]["persalinan"]["onset_kontraksi"] = $onset_kontraksi;

        foreach ($delivery_sequence as $key => $value) {
            $ws_query["data"]["persalinan"]['delivery'][$key]["delivery_sequence"] = @$delivery_sequence[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["delivery_method"] = @$delivery_method[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["delivery_dttm"] = @$delivery_dttm[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["use_manual"] = @$use_manual[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["use_forcep"] = @$use_forcep[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["use_vacuum"] = @$use_vacuum[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["letak_janin"] = @$letak_janin[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["shk_spesimen_ambil"] = @$shk_spesimen_ambil[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["shk_lokasi"] = @$shk_lokasi[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["shk_alasan"] = @$shk_alasan[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["shk_spesimen_dttm"] = @$shk_spesimen_dttm[$key];
            $ws_query["data"]["persalinan"]['delivery'][$key]["kondisi"] = @$kondisi[$key];
        }
        $ws_query["data"]["tarif_poli_eks"] = $tarif_poli_eks;
        $ws_query["data"]["nama_dokter"] = $nama_dokter; //'RASMIJON, dr, Sp.PD';
        $ws_query["data"]["kode_tarif"] = $kode_tarif;
        $ws_query["data"]["payor_id"] = $payor_id;
        $ws_query["data"]["payor_cd"] = $payor_cd;
        $ws_query["data"]["cob_cd"] = $cob_cd;
        $ws_query["data"]["coder_nik"] = '123123123123'; //$coder_nik;




        $ws_grouper1["metadata"]["method"] = "grouper";
        $ws_grouper1["metadata"]["stage"] = "1";
        $ws_grouper1["data"]["nomor_sep"] = $nomor_sep;

        $eklaim = new EklaimService();

        $json_request = json_encode($ws_new_claim);


        if ($currentStep < 1) {
            $resultNewKlaim = $eklaim->sendRequest('new_claim', $json_request, $nomor_sep);
        } else {
            $resultNewKlaim['metadata']['code'] = '400';
        }

        if (isset($resultNewKlaim['duplicate'][0])) {
            if ($resultNewKlaim['duplicate'][0]['nomor_rm'] != $nomor_rm) {
                $result = [
                    "metadata" => [
                        "code" => 400,
                        "message" => json_encode($resultNewKlaim['duplicate'][0])
                    ]
                ];
                return json_encode($result);
            } else {
                $resultNewKlaim['metadata']['code'] = '200';
            }
        }
        // return json_encode($resultNewKlaim);

        $ekModel = new EklaimModel();

        if ($resultNewKlaim['metadata']['code'] == '200' && $currentStep < 1) {
            $json_request = json_encode($ws_query);

            // return $json_request;

            $resultSetKlaim = $this->eklaim($json_request, $this->eklaimkey);



            if ($resultSetKlaim['metadata']['code'] == 200 && $currentStep < 2) {
                $json_request = json_encode($ws_grouper1);

                // return json_encode($ws_query);

                $resultGrouper1 = $this->eklaim($json_request, $this->eklaimkey);

                // return json_encode($resultGrouper1);

                if ($resultGrouper1['metadata']['code'] == 200 && $currentStep <= 3) {
                    $data = [
                        'trans_id' => $trans_id,
                        'visit_id' => $visit_id,
                        'nomr' => $nomor_rm,
                        'nosep' => $nosep,
                        'nosep_inap' => $nosep_inap,
                        'nosep_klaim' => $nomor_sep,
                        'nokartu' => $nomor_kartu,
                        'namapasien' => $nama_pasien,
                        'tgllahir' => $tgl_lahir,
                        'gender' => $gender,
                        'tgl_masuk' => $tgl_masuk,
                        'tgl_keluar' => $tgl_pulang,
                        'jnsrawat' => $jenis_rawat,
                        'klsrawat' => $kelas_rawat,
                        'adl_sub_acute' => $adl_sub_acute,
                        'adl_chronic' => $adl_chronic,
                        'icu_indikator' => $icu_indikator,
                        'icu_los' => $icu_los,
                        'ventilator_hour' => $ventilator_hour,
                        'upgrade_class_id' => (int)$upgrade_class_ind,
                        'upgrade_class_class' => (int)$upgrade_class_class,
                        'upgrade_class_los' => (int)$upgrade_class_los,
                        'add_payment_pct' => $add_payment_pct,
                        'birthweight' => (float)$birth_weight,
                        'discharge_status' => $discharge_status,
                        'diagnosanya' => $diagnosa,
                        'procedurenya' => $procedure,
                        'proc_nonbedah' => (float)$prosedur_non_bedah,
                        'proc_bedah' => (float)$prosedur_bedah,
                        'konsultasi' => (float)$konsultasi,
                        'tenaga_ahli' => (float)$tenaga_ahli,
                        'keperawatan' => (float)$keperawatan,
                        'penunjang' => (float)$penunjang,
                        'radiologi' => (float)$radiologi,
                        'laboratorium' => (float)$laboratorium,
                        'pelayanandarah' => (float)$pelayanan_darah,
                        'rehabilitasi' => (float)$rehabilitasi,
                        'kamar' => (float)$kamar,
                        'rawat_intensif' => (float)$rawat_intensif,
                        'obat' => (float)$obat,
                        'obatkronis' => (float)$obat_kronis,
                        'obatkemoterapi' => (float)$obat_kemoterapi,
                        'alkes' => (float)$alkes,
                        'bmhp' => (float)$bmhp,
                        'sewa_alat' => (float)$sewa_alat,
                        'tarif_poli_eks' => (float)$tarif_poli_eks,
                        'dokter' => $nama_dokter,
                        'kodetarif' => $kode_tarif,
                        'payor_id' => $payor_id,
                        'payor_cd' => $payor_cd,
                        'cob_cd' => $cob_cd,
                        'coder_nik' => $coder_nik,
                        'modified_by' => user_id(),
                        'request_01' => json_encode($ws_new_claim),
                        'request_02' => json_encode($ws_query),
                        'request_03' => json_encode($ws_grouper1),
                        'request_04' => '',
                        'respon_04' => '',
                        'cara_masuk' => $cara_masuk,
                        'ventilator' => json_encode($ws_query["data"]["ventilator"]),
                        'upgrade_class_payor' => $upgrade_class_payor,
                        'sistole' => (float)$sistole,
                        'diastole' => (float)$diastole,
                        'diagnosa_inagrouper' => $diagnosa_inagrouper,
                        'procedure_inagrouper' => $procedure_inagrouper,
                        'pemulasaraan_jenazah' => (int)$pemulasaraan_jenazah,
                        'kantong_jenazah' => (int)$kantong_jenazah,
                        'peti_jenazah' => (int)$peti_jenazah,
                        'plastik_erat' => (int)$plastik_erat,
                        'desinfektan_jenazah' => (int)$desinfektan_jenazah,
                        'covid19_status_cd' => (int)$covid19_status_cd,
                        'nomor_kartu_t' => $nomor_kartu_t,
                        'covid19_cc_ind' => (int)$covid19_cc_ind,
                        'covid19_rs_darurat_ind' => (int)$covid19_rs_darurat_ind,
                        'covid19_co_insidense_ind' => (int)$covid19_co_insidense_ind,
                        'covid19_penunjang_pengurang' => json_encode($ws_query["data"]["covid19_penunjang_pengurang"]),
                        'terapi_konvalesen' => (int)$terapi_konvalesen,
                        'isoman_ind' => (int)$isoman_ind,
                        'bayi_lahir_status_cd' => (int)$bayi_lahir_status_cd,
                        'dializer_single_use' => (int)$dializer_single_use,
                        'kantong_darah' => (int)$kantong_darah,
                        'apgar' => $apgar,
                        'persalinan' => $persalinan,
                        'klaim_status' => 1
                    ];

                    if ($currentStep == 0) {
                        $data['respon_01'] = json_encode($resultNewKlaim);
                        $data['respon_02'] = json_encode($resultSetKlaim);
                        $data['respon_03'] = json_encode($resultGrouper1);
                    }
                    if ($currentStep == 1) {
                        $data['respon_02'] = json_encode($resultSetKlaim);
                        $data['respon_03'] = json_encode($resultGrouper1);
                    }
                    if ($currentStep == 3) {
                        $data['respon_03'] = json_encode($resultGrouper1);
                    }

                    $ekModel->delete($nomor_sep);
                    $ekModel->insert($data);

                    $grouperModel = new GrouperModel();

                    // $grouperModel->query("delete from grouper where no_sep = '$nomor_sep'");

                    // return json_encode($resultGrouper1);
                    $db = db_connect();
                    $jmlgrouper = 0;
                    if (!is_null($resultGrouper1['response']['cbg']) and isset($resultGrouper1['response']['cbg'])) {
                        $cbg = $resultGrouper1['response']['cbg'];
                        if (isset($cbg['tariff'])) {
                            $grouperData = [
                                'no_sep' => $nomor_sep,
                                'grouper_stage' => '1',
                                'grouper_type' => '1',
                                'code' => $cbg['code'],
                                'descriptions' => $cbg['description'],
                                'tarif' => $cbg['tariff'],
                                'modified_by' => user_id()
                            ];
                            // $db->query("delete from grouper where no_sep = '$sep' and code = '" . $cbg['code'] . "'");
                            $grouperModel->insert($grouperData);
                            $jmlgrouper += $cbg['tariff'];
                        }
                    }
                    if (isset($resultGrouper1['response']['sub_acute'])) {
                        $sub_acute = $resultGrouper1['response']['sub_acute'];
                        if (isset($sub_acute['tariff'])) {
                            // DB::delete("delete from grouper where no_sep = '$sep' and code = '".$sub_acute['code']."'");
                            $grouperData = [
                                'no_sep' => $nomor_sep,
                                'grouper_stage' => '1',
                                'grouper_type' => '2',
                                'code' => $sub_acute['code'],
                                'descriptions' => $sub_acute['description'],
                                'tarif' => $sub_acute['tariff'],
                                'modified_by' => user_id()
                            ];
                            $grouperModel->insert($grouperData);
                            $jmlgrouper += $sub_acute['tariff'];
                        }
                    } else {
                        $grouperData = [
                            'no_sep' => $nomor_sep,
                            'grouper_stage' => '1',
                            'grouper_type' => '2',
                            'code' => '-',
                            'descriptions' => '-',
                            'tarif' => 0,
                            'modified_by' => user_id()
                        ];
                        // $grouperModel->insert($grouperData);
                    }
                    if (isset($resultGrouper1['response']['chronic'])) {
                        $chronic = $resultGrouper1['response']['chronic'];
                        if (isset($chronic)) {
                            // DB::delete("delete from grouper where no_sep = '$sep' and code = '".$chronic['code']."'");
                            $grouperData = [
                                'no_sep' => $nomor_sep,
                                'grouper_stage' => '1',
                                'grouper_type' => '3',
                                'code' => $chronic['code'],
                                'descriptions' => $chronic['description'],
                                'tarif' => $chronic['tariff'],
                                'modified_by' => user_id()
                            ];
                            $grouperModel->insert($grouperData);
                            $jmlgrouper += $chronic['tariff'];
                        }
                    } else {
                        $grouperData = [
                            'no_sep' => $nomor_sep,
                            'grouper_stage' => '1',
                            'grouper_type' => '3',
                            'code' => '-',
                            'descriptions' => '-',
                            'tarif' => 0,
                            'modified_by' => user_id()
                        ];
                    }
                    if (isset($resultGrouper1['response']['add_payment_amt'])) {
                        $amt = $resultGrouper1['response']['add_payment_amt'];
                        if (isset($amt)) {
                            $grouperAmt = [
                                'add_payment_amt' => $amt
                            ];
                            $ekModel->update($nomor_sep, $grouperAmt);
                        }
                    }
                    // return($amt);
                    try {
                        // Ensure $jmlgrouper is set and is a valid numeric value
                        $jmlgrouper = isset($jmlgrouper) ? (float)$jmlgrouper : 0.0;

                        // Ensure $nomor_sep is set and is a string
                        $nomor_sep = isset($nomor_sep) ? (string)$nomor_sep : '';

                        // Call the save method
                        $ekModel->save([
                            'claim_value' => (float)$jmlgrouper,
                            'nomor_sep' => $nomor_sep
                        ]);
                    } catch (\Exception $e) {
                        // Handle the exception (e.g., log the error, show a message to the user)
                        // error_log($e->getMessage()); // Log the error message
                        // echo 'An error occurred while saving data.';
                    }
                    try {

                        // dd($json_response);
                        if (isset($resultGrouper1['special_cmg_option'])) {
                            $special_cmg = $resultGrouper1['special_cmg_option'];
                            // dd($special_cmg);
                            // if (isset($json_response['special_cmg'])) {
                            // $special_cmg = $json_response['special_cmg'];
                            $jmlgrouper2 = 0;
                            // dd($special_cmg);
                            $grouperModel->where('grouper_stage', '2')->where('no_sep', $nomor_sep)->delete();
                            foreach ($special_cmg as $key => $value) {
                                if ($special_cmg[$key]['type'] == 'Special Prosthesist') {
                                    $type = 4;
                                } elseif ($special_cmg[$key]['type'] == 'Special Procedure') {
                                    $type = 5;
                                } elseif ($special_cmg[$key]['type'] == 'Special Investigation') {
                                    $type = 6;
                                } elseif ($special_cmg[$key]['type'] == 'Special Drug') {
                                    $type = 7;
                                }
                                $grouperModel->insert([
                                    'no_sep' => $nomor_sep,
                                    'grouper_stage' => '2',
                                    'grouper_type' => $type,
                                    'code' => $special_cmg[$key]['code'],
                                    'descriptions' => $special_cmg[$key]['description'],
                                    'modified_by' => user_id()
                                ]);
                                // $jmlgrouper2 += $special_cmg[$key]['tariff'];
                            };
                        }
                        if (isset($resultGrouper1['tarif_alt'])) {
                            $tarif_alt = $resultGrouper1['tarif_alt'];
                            foreach ($tarif_alt as $key => $value) {
                                if (isset($tarif_alt[$key]['tarif_inacbg'])) {
                                    $tarifAltModel = new TarifAltModel();
                                    $tarifAltModel->where('nosep', $nomor_sep)->delete();
                                    $tarifAltModel->insert([
                                        'nosep' => $nomor_sep,
                                        'class_id' => $tarif_alt[$key]['kelas'],
                                        'tarif_inacbg' => $tarif_alt[$key]['tarif_inacbg'],
                                        'tarif_sp' => 0,
                                        'tarif_sr' => 0,
                                        'modified_by' => user_id()
                                    ]);
                                }
                            }
                        }
                        $db = db_connect();
                        $db->query("update eklaim_klaim set
                        grouper_date = current_timestamp ,
                        claim_value = (select sum(tarif) from grouper where no_sep = '$nomor_sep'),
                        cbg_tarif = (select sum(tarif) from grouper where no_sep = '$nomor_sep')
                        where nosep_klaim = '$nomor_sep'");
                    } catch (\Exception $e) {
                        // Return error response
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => $e->getMessage()
                        ])->setStatusCode(500); // Internal Server Error
                    }



                    return json_encode($resultGrouper1);
                } else {
                    return json_encode($resultGrouper1);
                }
            } else {
                return json_encode($resultSetKlaim);
            }
        } else {
            return json_encode($resultNewKlaim);
        }
    }
    public function postGrouper2()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $code = $body['code'];
        $type = $body['type'];
        $nomor_sep = $body['nomor_sep'];

        // $db = db_connect();
        // $db->query("update grouper set isgenerate = '1' where no_sep = '$nomor_sep' and code = '$code'");
        // $db->close();
        // $db = db_connect();
        // $builder = $db->table("grouper")->select("code")->where("no_sep", $nomor_sep)->where("grouper_stage", 2);
        // $query = $builder->get();
        // $result = $query->getResultArray();
        // $result = $this->lowerKey($result);
        // if (sizeof($result) > 0) {
        //     $grouper2code = '';
        //     foreach ($result as $key => $value) {
        //         $grouper2code .= $result[$key]['code'] . '#';
        //     }
        //     $grouper2code = substr($grouper2code, 0, strlen($response) - 1);
        // }
        $grouper2_query = [];
        $grouper2_query['metadata']['method'] = "grouper";
        $grouper2_query['metadata']['stage'] = "2";
        $grouper2_query['data']['nomor_sep'] = $nomor_sep;
        $grouper2_query['data']['special_cmg'] = $code;

        $json_request = json_encode($grouper2_query);
        $this->eklaimkey = 'f3a070d3b5acc9f61653215f1ac5465d5dabe4b34f86e264e9eb162b4d92f70b';
        $resultGrouper2 = $this->eklaim($json_request, $this->eklaimkey);
        $ekModel = new EklaimModel();
        $data = [
            'respon_03' => json_encode($resultGrouper2)
        ];
        $ekModel->update($nomor_sep, $data);
        return json_encode($resultGrouper2);
    }
    public function finalKlaim()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $coder_nik = $body['coder_nik'];
        $nomor_sep = $body['nomor_sep'];

        // $db = db_connect();
        // $db->query("update grouper set isgenerate = '1' where no_sep = '$nomor_sep' and code = '$code'");
        // $db->close();
        // $db = db_connect();
        // $builder = $db->table("grouper")->select("code")->where("no_sep", $nomor_sep)->where("grouper_stage", 2);
        // $query = $builder->get();
        // $result = $query->getResultArray();
        // $result = $this->lowerKey($result);
        // if (sizeof($result) > 0) {
        //     $grouper2code = '';
        //     foreach ($result as $key => $value) {
        //         $grouper2code .= $result[$key]['code'] . '#';
        //     }
        //     $grouper2code = substr($grouper2code, 0, strlen($response) - 1);
        // }
        $final_query = [];
        $final_query['metadata']['method'] = "claim_final";
        $final_query['data']['nomor_sep'] = $nomor_sep;
        $final_query['data']['coder_nik'] = $coder_nik;

        $json_request = json_encode($final_query);
        $eklaim = new EklaimService();


        $resultGrouper2 = $eklaim->sendRequest('claim_final', $json_request, $nomor_sep);
        if ($resultGrouper2['metadata']['code'] == '200') {
            $data = [
                'claim_final' => date('Y-m-d H:i'),
                'claim_finalby' => $coder_nik,
                'modified_by' => $coder_nik,
                'klaim_status' => 2,
                'request_04' => json_encode($final_query),
                'respon_04' => json_encode($resultGrouper2)
            ];
            $ekModel = new EklaimModel();
            $ekModel->update($nomor_sep, $data);
        }

        return json_encode($resultGrouper2);
    }
    public function editKlaim()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $nomor_sep = $body['nomor_sep'];

        // $db = db_connect();
        // $db->query("update grouper set isgenerate = '1' where no_sep = '$nomor_sep' and code = '$code'");
        // $db->close();
        // $db = db_connect();
        // $builder = $db->table("grouper")->select("code")->where("no_sep", $nomor_sep)->where("grouper_stage", 2);
        // $query = $builder->get();
        // $result = $query->getResultArray();
        // $result = $this->lowerKey($result);
        // if (sizeof($result) > 0) {
        //     $grouper2code = '';
        //     foreach ($result as $key => $value) {
        //         $grouper2code .= $result[$key]['code'] . '#';
        //     }
        //     $grouper2code = substr($grouper2code, 0, strlen($response) - 1);
        // }
        $edit_query = [];
        $edit_query['metadata']['method'] = "reedit_claim";
        $edit_query['data']['nomor_sep'] = $nomor_sep;


        $json_request = json_encode($edit_query);
        $this->eklaimkey = 'f3a070d3b5acc9f61653215f1ac5465d5dabe4b34f86e264e9eb162b4d92f70b';
        $resultEditKlaim = $this->eklaim($json_request, $this->eklaimkey);
        if ($resultEditKlaim['metadata']['code'] == '200') {
            $data = [
                'claim_final' => null,
                'claim_finalby' => null,
                'modified_by' => user_id(),
                'klaim_status' => 1,
                'request_04' => null,
                'respon_04' => null
            ];
            $ekModel = new EklaimModel();
            $ekModel->update($nomor_sep, $data);
        }
        return json_encode($resultEditKlaim);
    }
    public function getLastCppt()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $ex = new ExaminationDetailModel();
        $exam = $ex->select("tension_upper, tension_below")->where('visit_id', $body['visit_id'])->where("tension_upper is not null and tension_below is not null and tension_upper <> 0 and tension_below <> 0")->orderBy("examination_date asc")->first();
        $data['exam'] = $exam;
        $data['apgar'] = $this->getApgar($body['visit_id']);

        return $this->response->setJSON([
            'message' => 'Data saved successfully.',
            'respon' => true,
            'data' => $data
        ]);
    }
    public function getApgar($visit)
    {

        return [];
        $db = db_connect();

        $apgar = $this->lowerKey($db->query("select * from assessment_indicator where visit_id = '$visit' and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());
        // return json_encode($apgar);

        if (count($apgar) > 0) {
            $apgarDetil = "select * from assessment_apgar_detail where body_id in (";

            foreach ($apgar as $key => $value) {
                $apgarDetil .= "'" . $value['body_id'] . "',";
            }
            $apgarDetil = substr($apgarDetil, 0, strlen($apgarDetil) - 1);

            $apgarDetil .= ");";

            $apgarDetil = $this->lowerKey($db->query($apgarDetil)->getResultArray());
        } else {
            $apgarDetil = null;
        }


        return ([
            'apgar' => $apgar,
            'apgarDetil' => $apgarDetil
        ]);
    }
}
