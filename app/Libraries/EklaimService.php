<?php

namespace App\Libraries;

use App\Models\EklaimLogModel;
use Exception;

class EklaimService
{
    protected $key;
    protected $url;
    public function __construct()
    {
        $this->key = hex2bin(env('EKLAIM_KEY')); // 64-char hex in .env
        $this->url = env('EKLAIM_URL');
    }

    private function inacbg_encrypt($data)
    {
        /// make binary representasion of $key
        $key = $this->key;
        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) {
            throw new Exception("Needs a 256-bit key!");
        }
        /// create initialization vector
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        $iv = openssl_random_pseudo_bytes($iv_size); // dengan catatan dibawah
        /// encrypt
        $encrypted = openssl_encrypt(
            $data,
            "aes-256-cbc",
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        /// create signature, against padding oracle attacks
        $signature = mb_substr(hash_hmac(
            "sha256",
            $encrypted,
            $key,
            true
        ), 0, 10, "8bit");
        /// combine all, encode, and format
        $encoded = chunk_split(base64_encode($signature . $iv . $encrypted));
        return $encoded;
    }


    private function inacbg_decrypt($str)
    {
        /// make binary representation of $key
        $key = $this->key;
        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) {
            // throw new Exception("Needs a 256-bit key!");
        }
        /// calculate iv size
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        /// breakdown parts
        $decoded = base64_decode($str);
        $signature = mb_substr($decoded, 0, 10, "8bit");
        $iv = mb_substr($decoded, 10, $iv_size, "8bit");
        $encrypted = mb_substr($decoded, $iv_size + 10, NULL, "8bit");
        /// check signature, against padding oracle attack
        $calc_signature = mb_substr(hash_hmac(
            "sha256",
            $encrypted,
            $key,
            true
        ), 0, 10, "8bit");
        if (!$this->inacbg_compare($signature, $calc_signature)) {
            return "SIGNATURE_NOT_MATCH"; /// signature doesn't match
        }
        $decrypted = openssl_decrypt(
            $encrypted,
            "aes-256-cbc",
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        return $decrypted;
    }
    private function inacbg_compare($a, $b)
    {       /// compare individually to prevent timing attacks

        /// compare length
        if (strlen($a) !== strlen($b)) return false;

        /// compare individual
        $result = 0;
        for ($i = 0; $i < strlen($a); $i++) {
            $result |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $result == 0;
    }
    public function sendRequest($method, $json_request, $claimId = null)
    {
        // return $this->url;
        $payload = $this->inacbg_encrypt($json_request, $this->key);
        // tentukan Content-Type pada http header
        $header = array("Content-Type: application/x-www-form-urlencoded");
        // url server aplikasi E-Klaim,
        // silakan disesuaikan instalasi masing-masing
        $url = $this->url;
        // $url = "http://192.168.110.254:8081/E-Klaim/ws.php";
        // setup curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // request dengan curl
        $response = curl_exec($ch);
        // terlebih dahulu hilangkan "----BEGIN ENCRYPTED DATA----\r\n" // dan hilangkan "----END ENCRYPTED DATA----\r\n" dari response
        $first  = strpos($response, "\n") + 1;
        $last   = strrpos($response, "\n") - 1;
        $response  = substr(
            $response,
            $first,
            strlen($response) - $first - $last
        );
        // decrypt dengan fungsi inacbg_decrypt
        $response = $this->inacbg_decrypt($response, $this->key);
        // hasil decrypt adalah format json, ditranslate kedalam array
        $msg = json_decode($response, true);

        // return $msg;

        // Log to DB
        $logModel = new EklaimLogModel();
        $logModel->insert([
            'ClaimId' => $claimId,
            'ApiMethod' => $method,
            'RequestPayload' => $json_request,
            'ResponsePayload' => $response,
            'IsEncrypted' => 1,
            'ResponseCode' => $meta['code'] ?? null,
            'ResponseMessage' => $meta['message'] ?? null
        ]);

        return $msg;
    }
    public function safe_implode($glue, $array)
    {
        return is_array($array) && !empty($array) ? implode($glue, $array) : '';
    }
    function cleanCurrency($value)
    {
        if (is_null($value) || $value === '') return 0;
        $value = str_replace('.', '', $value);     // hapus titik (ribuan)
        $value = str_replace(',', '.', $value);    // ganti koma jadi titik (desimal)
        return (int) floatval($value);             // konversi ke integer (BIGINT)
    }
}
