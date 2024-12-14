<?php

namespace App\Controllers;

use App\Helpers\RsaEncryptionHelper;
use App\Models\Assessment\FallRiskDetailModel;
use App\Models\Assessment\GcsModel;
use App\Models\Assessment\PainDetilModel;
use App\Models\Assessment\PasienTransferModel;
use App\Models\DocsSignedModel;
use App\Models\ExaminationModel;
use App\Models\FamilyModel;
use App\Models\FamilyPasienModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienModel;
use App\Models\RsaKeyModel;
use Myth\Auth\Models\UserModel;

class Signature extends BaseController
{
    public function index()
    {
        // Create an instance of the RSA helper
        $rsaHelper = new RsaEncryptionHelper;

        // Get public key
        $publicKey = $rsaHelper->getPublicKey();

        // Data to sign
        $data = "Data to sign";

        // Sign the data
        $signature = $rsaHelper->signData($data);

        // Example of verifying the signature
        $isValid = $rsaHelper->verifySignature($data, $signature, $publicKey);

        if ($isValid === 1) {
            echo "Signature is valid\n";
        } elseif ($isValid === 0) {
            echo "Signature is not valid\n";
        } else {
            echo "Verification error\n";
        }
    }
    private function checkpass($login, $password)
    {
        // if (!$this->request->is('post')) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // $body = $this->request->getPost();
        // // $body = json_decode($body, true);


        // foreach ($body as $key => $value) {
        //     ${$key} = $value;
        //     if (!(is_null(${$key}) || ${$key} == ''))
        //         $data[strtolower($key)] = $value;
        // }


        $users = new UserModel();

        $select = $users->select('password_hash')->where('username', $login)->first();

        if (isset($select->password_hash)) {
            return (password_verify(base64_encode(hash('sha384', $password, true)), $select->password_hash));
        } else {
            return false;
        }

        // return json_encode(base64_encode(hash('sha384', $password, true)));

        // return json_encode(password_verify(base64_encode(hash('sha384', "Heny3008", true)), $select[0]->password_hash));
        // return json_encode(password_hash(("Agussalim7"), PASSWORD_BCRYPT));
    }
    private function saveKeyModel()
    {
        $rsaKeyModel = new RsaKeyModel();

        // Simpan private key dan public key
        $privateKey = ''; // Ambil dari tempat penyimpanan yang aman
        $publicKey = '';  // Ambil dari tempat yang sesuai

        $rsaKeyModel->saveKeys($privateKey, $publicKey);

        // Ambil private key dari database
        $storedPrivateKey = $rsaKeyModel->getPrivateKey();

        // Gunakan private key sesuai kebutuhan Anda
        // ...

        // Tampilkan response atau lakukan operasi lainnya
        return json_encode(['privateKey' => $storedPrivateKey]);
    }
    private function checkPrivate()
    {
        $rsa = new RsaKeyModel();
        $private = $rsa->getPrivateKey();

        return json_encode($private);
    }

    private static function createSignature($data)
    {
        $rsaHelper = new RsaEncryptionHelper;

        $privateKey = $rsaHelper->getPrivateKey();

        // Load kunci privat
        $privateKey = openssl_pkey_get_private($privateKey);

        // Tandatangani data menggunakan kunci privat
        openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        // Kembalikan signature dalam bentuk base64 untuk disimpan
        return base64_encode($signature);
    }
    private static function verifySignature($data, $signature)
    {
        $rsaHelper = new RsaEncryptionHelper;

        $publicKey = $rsaHelper->getPublicKey();

        // Load kunci publik
        $publicKey = openssl_pkey_get_public($publicKey);

        // Verifikasi signature
        $isValid = openssl_verify($data, base64_decode($signature), $publicKey, OPENSSL_ALGO_SHA256);

        // Hapus kunci dari memori

        // Kembalikan hasil verifikasi
        return $isValid === 1;
    }

    public function getSignedData()
    {
        return $this->createSignature("bisma");
    }

    public function postingSignedDocs()
    {
        // Check if the request is POST
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // Get JSON body from request
        $body = $this->request->getBody();
        $jsonData = json_decode($body, true);

        // Check if JSON decoding was successful
        if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            return json_encode(['error' => 'Invalid JSON data']);
        }

        // Initialize empty arrays for formData and docData
        $dataForm = [];
        $dataDoc = [];

        // Process signData
        if (isset($jsonData["signData"]) && is_array($jsonData["signData"])) {
            foreach ($jsonData["signData"] as $key => $value) {
                if (!is_null($value) && $value !== '') {
                    ${strtolower($key)} = $value;
                    $dataForm[strtolower($key)] = $value;
                }
            }
        }
        // return json_encode($docs_type);

        // Process docData
        if (isset($jsonData["docData"]) && is_array($jsonData["docData"])) {
            foreach ($jsonData["docData"] as $key => $value) {
                if (!is_null($value) && $value !== '') {
                    ${strtolower($key)} = $value;
                    $dataDoc[strtolower($key)] = $value;
                }
            }
        }
        if (isset($dataDoc['valid_user'])) {
            unset($dataDoc['valid_user']);
        }
        if (isset($dataDoc['valid_pasien'])) {
            unset($dataDoc['valid_pasien']);
        }
        if (isset($dataDoc['valid_date'])) {
            unset($dataDoc['valid_date']);
        }
        ksort($dataDoc);

        // return json_encode($dataDoc);
        // Validate login and password
        $checkpass = $this->checkpass($dataForm['user_id'] ?? null, $dataForm['password'] ?? null);

        if ($checkpass) {
            // Create signature for docData
            $signedData = $this->createSignature(json_encode($dataDoc));

            // Insert signed data into database
            $docModel = new DocsSignedModel();
            $docModel
                ->where("docs_type", $docs_type)
                ->where("sign_id", $sign_id)
                ->where("user_type", $user_type)
                ->where("sign_ke", $sign_ke)->delete();
            $dataForm["sign"] = $signedData;
            $return = $docModel->insert($dataForm);

            return json_encode($return);
        }

        // Return error or checkpass result
        return json_encode(['error' => 'Login failed or invalid credentials']);
    }
    public function postingSignedDocsTable()
    {
        // Check if the request is POST
        if (!$this->request->is('post')) {
            return json_encode(['error' => 'wrong method']);
        }

        // Get JSON body from request
        $body = $this->request->getBody();
        $jsonData = json_decode($body, true);

        // Check if JSON decoding was successful
        if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            return json_encode(['error' => 'Invalid JSON data']);
        }

        // Initialize empty arrays for formData and docData
        $dataForm = [];
        $dataDoc = [];

        // Process signData
        if (isset($jsonData["signData"]) && is_array($jsonData["signData"])) {
            foreach ($jsonData["signData"] as $key => $value) {
                if (!is_null($value) && $value !== '') {
                    ${strtolower($key)} = $value;
                    $dataForm[strtolower($key)] = $value;
                }
            }
        }
        // return json_encode($docs_type);
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
            $model = new PasienTransferModel();
        }
        // return json_encode($sign_id);
        $select = $model->find($sign_id);
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

        // return json_encode($dataDoc);
        // Validate login and password
        if ($user_type == 1) {
            $checkpass = $this->checkpass($dataForm['user_id'] ?? null, $dataForm['password'] ?? null);
        } else if ($user_type == 2) {



            $pModel = new PasienModel();
            $select = $pModel->select("no_registration")
                ->where("left(replace(replace(REPLACE(convert(varchar,date_of_birth,121),'-',''),':',''),' ',''),8) = " . $dataForm['datebirth'] . "")
                ->where("no_registration", $dataForm['no_registration'])
                ->findAll();
            if (count($select) > 0) {
                $checkpass = true;
            } else {
                $checkpass = false;
            }

            $data = explode(',', (string)$tandatangansign);

            $encodedLokalis = $data[1];
            $decodedLokalis = base64_decode($encodedLokalis);
            $lokalisPath = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($lokalisPath)) {
                mkdir($lokalisPath, 0777, true);
            }

            $filenameLokalis = $nik . '.gif';
            $fullPathLokalis = $lokalisPath . $filenameLokalis;
            if (file_put_contents($fullPathLokalis, $decodedLokalis)) {
                $model = new PasienModel();
                $db = [
                    'no_registration' => $no_registration,
                    'sign_file' => $filenameLokalis
                ];
                if ($model->save($db)) {
                    $checkpass = true;
                } else {
                    $checkpass = false;
                }
                // return json_encode($db);
            } else {
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }
        } else {

            $data = explode(',', (string)$tandatangansign);

            $encodedLokalis = $data[1];
            $decodedLokalis = base64_decode($encodedLokalis);
            $lokalisPath = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($lokalisPath)) {
                mkdir($lokalisPath, 0777, true);
            }

            $filenameLokalis = $nik . '.gif';
            $fullPathLokalis = $lokalisPath . $filenameLokalis;
            if (file_put_contents($fullPathLokalis, $decodedLokalis)) {
                $model = new FamilyPasienModel();
                $db = [
                    'org_unit_code' => '3372096',
                    'no_registration' => $no_registration,
                    'family_id' => 1,
                    'family_status_id' => '99',
                    'fullname' => $name,
                    'sign_file' => $filenameLokalis,
                    'nik' => $nik,
                    'modified_by' => user()->username
                ];
                if ($model->save($db)) {
                    $checkpass = true;
                } else {
                    $checkpass = false;
                }
                // return json_encode($db);
            } else {
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }
        }

        if ($checkpass) {
            // Create signature for docData
            $signedData = $this->createSignature(json_encode($dataDoc));

            // Insert signed data into database
            $docModel = new DocsSignedModel();
            $docModel
                ->where("docs_type", $docs_type)
                ->where("sign_id", $sign_id)
                ->where("user_type", $user_type)
                ->where("sign_ke", $sign_ke)->delete();
            $dataForm["sign"] = $signedData;
            $return = $docModel->insert($dataForm);

            return json_encode($dataForm);
        }

        // Return error or checkpass result
        return json_encode(['error' => 'Login failed or invalid credentials']);
    }

    public function checkSignedDocs()
    {
        // Ensure the request is a POST request
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', 'Invalid request type');
        }

        // Get JSON body from request
        $body = $this->request->getBody();
        $jsonData = json_decode($body, true);

        // Check if JSON decoding was successful
        if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
            return json_encode(['error' => 'Invalid JSON data']);
        }

        // Check if signId is set
        if (!isset($jsonData['signId'])) {
            return json_encode(['error' => 'Missing signId']);
        }

        $signId = $jsonData['signId'];

        // Initialize empty arrays for formData and docData
        $dataForm = [];
        $dataDoc = [];

        // Process signData
        if (isset($jsonData["signData"]) && is_array($jsonData["signData"])) {
            foreach ($jsonData["signData"] as $key => $value) {
                if (!is_null($value) && $value !== '') {
                    $dataForm[strtolower($key)] = $value;
                }
            }
        }

        // Process docData
        if (isset($jsonData["docData"]) && is_array($jsonData["docData"])) {
            foreach ($jsonData["docData"] as $key => $value) {
                if (!is_null($value) && $value !== '') {
                    $dataDoc[strtolower($key)] = $value;
                }
            }
        }

        if (isset($dataDoc['valid_user'])) {
            unset($dataDoc['valid_user']);
        }
        if (isset($dataDoc['valid_pasien'])) {
            unset($dataDoc['valid_pasien']);
        }
        if (isset($dataDoc['valid_date'])) {
            unset($dataDoc['valid_date']);
        }
        ksort($dataDoc);

        // return json_encode($dataDoc);

        // Validate login and password (assumed to be a placeholder)
        $checkpass = true;

        if ($checkpass) {
            // Initialize RsaEncryptionHelper
            $rsaHelper = new RsaEncryptionHelper();
            $publicKey = $rsaHelper->getPublicKey();

            // Check if DocsSignedModel is available and handle errors if not

            $docModel = new DocsSignedModel();

            // Check if find method exists
            if (!method_exists($docModel, 'find')) {
                return json_encode(['error' => 'Method find not found in DocsSignedModel']);
            }

            // Find the document by signId
            $select = $this->lowerKey($docModel->where("sign_id", $signId)->findAll());

            $result = [];
            foreach ($select as $key => $value) {
                // Check if the necessary data is present

                $signedData = $value['sign'];

                // Verify the signature
                $isValid = $rsaHelper->verifySignature(json_encode($dataDoc), $signedData, $publicKey);
                $result[$key]['isvalid'] = $isValid;
                $result[$key]['user_type'] = $value['user_type'];
                $result[$key]['doc_date'] = $value['doc_date'];
                $result[$key]['user_id'] = $value['user_id'];
                $result[$key]['sign_path'] = $value['sign_path'];
            }


            return json_encode($result);
        }

        return json_encode(['error' => 'Authentication failed']);
    }
    public function checkSignedDocsTable()
    {
        // Ensure the request is a POST request
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', 'Invalid request type');
        }

        // Get JSON body from request
        $body = $this->request->getBody();
        $jsonData = json_decode($body, true);

        // Check if JSON decoding was successful
        if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
            return json_encode(['error' => 'Invalid JSON data']);
        }

        // Check if signId is set
        if (!isset($jsonData['signId'])) {
            return json_encode(['error' => 'Missing signId']);
        }

        $signId = $jsonData['signId'];
        $docs_type = $jsonData['docs_type'];

        // Initialize empty arrays for formData and docData
        $dataForm = [];
        $dataDoc = [];

        // Process signData
        if (isset($jsonData["signData"]) && is_array($jsonData["signData"])) {
            foreach ($jsonData["signData"] as $key => $value) {
                if (!is_null($value) && $value !== '') {
                    $dataForm[strtolower($key)] = $value;
                }
            }
        }

        // Process docData
        // if (isset($jsonData["docData"]) && is_array($jsonData["docData"])) {
        //     foreach ($jsonData["docData"] as $key => $value) {
        //         if (!is_null($value) && $value !== '') {
        //             $dataDoc[strtolower($key)] = $value;
        //         }
        //     }
        // }

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
        }
        // return json_
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


        // Validate login and password (assumed to be a placeholder)
        $checkpass = true;

        if ($checkpass) {
            // Initialize RsaEncryptionHelper
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
                ->select("docs_signed.*, ea.fullname")
                ->join("users u", "u.username = docs_signed.user_id", "left")
                ->join("employee_all ea", "ea.employee_id = u.employee_id", "left")
                ->where("sign_id", $signId)->findAll());

            $result = [];
            foreach ($select as $key => $value) {
                // Check if the necessary data is present

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
            }


            return json_encode($result);
        }

        return json_encode(['error' => 'Authentication failed']);
    }

    public function getSignPict()
    {
        if (!$this->request->is('post')) {
            return json_encode(['error' => 'wrong method']);
        }

        // Get JSON body from request
        $body = $this->request->getBody();
        $jsonData = json_decode($body, true);

        // Check if JSON decoding was successful
        if ($jsonData === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            return json_encode(['error' => 'Invalid JSON data']);
        }

        // Initialize empty arrays for formData and docData
        $dataForm = [];
        $dataDoc = [];

        // Process signData
        if (isset($jsonData["signData"]) && is_array($jsonData["signData"])) {
            foreach ($jsonData["signData"] as $key => $value) {
                ${strtolower($key)} = $value;
                // if (!is_null($value) && $value !== '') {
                //     $dataForm[strtolower($key)] = $value;
                // }
            }
        }

        if ($user_type == 2) {
            $pasien = new PasienModel();
            $data = $this->lowerKeyOne($family->where("no_registration", $no_registration)->first());

            $filepath = WRITEPATH . 'uploads/signatures/' . $data['sign_file'];
            if (file_exists($filepath)) {
                $filedata = file_get_contents($filepath);
                $filedata64 = base64_encode($filedata);
                $data['sign_file'] = $filedata64;
            }
        } else if ($user_type == 3) {
            $family = new FamilyPasienModel();
            $data = $this->lowerKeyOne($family->where("nik", $nik)->first());

            $filepath = WRITEPATH . 'uploads/signatures/' . $data['sign_file'];
            if (file_exists($filepath)) {
                $filedata = file_get_contents($filepath);
                $filedata64 = base64_encode($filedata);
                $data['sign_file'] = $filedata64;
            }
        }



        return json_encode($data);

        // Return error or checkpass result
        return json_encode(['error' => 'Login failed or invalid credentials']);
    }
}
