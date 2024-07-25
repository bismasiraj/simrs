<?php

namespace App\Helpers;

use App\Models\RsaKeyModel;

class RsaEncryptionHelper
{
    protected $privateKey;
    protected $publicKey;


    public function __construct()
    {
        // Generate or load your keys here
        // $this->generateKeys();
        $this->privateKey = $this->getPrivateKey();
        $this->publicKey = $this->getPublicKey();
    }

    private function generateKeys()
    {
        $config = [
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];

        // Generate new key pair
        $privateKey = openssl_pkey_new($config);

        dd($privateKey);

        // Extract private key
        openssl_pkey_export($privateKey, $this->privateKey);

        // Extract public key
        $publicKeyDetails = openssl_pkey_get_details($privateKey);
        $this->publicKey = $publicKeyDetails['key'];
    }

    public function getPublicKey()
    {
        $rsa = new RsaKeyModel();
        $key = $rsa->getPublicKey();
        return "-----BEGIN PUBLIC KEY-----
$key
-----END PUBLIC KEY-----";
        // return $this->publicKey;
    }
    public function getPrivateKey()
    {
        $rsa = new RsaKeyModel();
        $key = $rsa->getPrivateKey();
        return "-----BEGIN RSA PRIVATE KEY-----
$key
-----END RSA PRIVATE KEY-----";
    }
    public function signData($data)
    {
        $signature = '';
        $privateKey = $this->privateKey;
        openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }
    public function verifySignature($data, $signature, $publicKey)
    {
        $signature = base64_decode($signature);
        return openssl_verify($data, $signature, $publicKey, OPENSSL_ALGO_SHA256);
    }
}
