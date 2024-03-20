<?php

namespace App\Controllers;

use App\Models\BatchingBridgingModel;
use App\Models\BedsModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicModel;
use App\Models\DoctorScheduleModel;
use App\Models\EmployeeAllModel;
use App\Models\KfaIngredientModel;
use App\Models\KfaProductModel;
use App\Models\KfaTemplateModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use App\Models\SatuSehatModel;
use App\Models\StatusPasienModel;
use CodeIgniter\I18n\Time;
use Firebase\JWT\JWT;
use Myth\Auth\Models\UserModel;


class SatuSehat extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->session->set(['selectedMenu' => '']);
    }
    protected $orgunitcode = '3372238';

    protected $baseurloath = 'https://api-satusehat.kemkes.go.id/oauth2/v1';
    protected $baseurlfhir = 'https://api-satusehat.kemkes.go.id/fhir-r4/v1';
    protected $baseurlconsent = 'https://api-satusehat.dto.kemkes.go.id/consent/v1';
    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (is_null($user)) {
            return response(['error' => 'Invalid username or password.'], 401);
        }

        $pwd_verify = password_verify(base64_encode(hash('sha384', $password, true)), $user->password_hash);

        // return json_encode($pwd_verify);

        if (!$pwd_verify) {
            return response()->setStatusCode(401, 'Invalid username or password');
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "username" => $user->username,
        );

        $token = JWT::encode($payload, $key, 'HS256');
        // return json_encode($token);

        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];

        return response()->setJSON($response);
    }
    public function loginInternal()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $username = $body['username'];
        // $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        // return json_encode($username);

        if (is_null($user)) {
            return response(['error' => 'Invalid username or password.'], 401);
        }

        // $pwd_verify = password_verify(base64_encode(hash('sha384', $password, true)), $user->password_hash);

        // // return json_encode($pwd_verify);

        // if (!$pwd_verify) {
        //     return response()->setStatusCode(401, 'Invalid username or password');
        // }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 64800;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "username" => $user->username,
        );

        $token = JWT::encode($payload, $key, 'HS256');
        // return json_encode($token);

        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];

        return response()->setJSON($response);
    }

    public function getToken()
    {
        // $header = $this->request->getHeaderLine("Authorization");
        // return $header;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseurloath . '/accesstoken?grant_type=client_credentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'client_id=fUcn9oKZiLM8nXWOUmxqlJOaMo80QQF6fJkQBZZhdbkZNzSF&client_secret=pxifAfWAFv13byLQ3BwOVAGpBkwEAWCXFgeGr2uYi7Gz2ACA1cMERfqmeJqXn9T6',
            CURLOPT_HTTPHEADER => array(
                // 'Authorization: Bearer LA6Fj2oGDjACsnNuBoOCQHItAlIK',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode(($response), true);
        $token = $result['access_token'];

        $org = new OrganizationunitModel();
        $org->update($this->orgunitcode, ["sstoken" => $token]);
        return json_encode($token);
    }

    public function getPasienID()
    {
        $ssToken = $this->request->getHeaderLine("ssToken");
        $nik = $this->request->getHeaderLine('nik');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseurlfhir . '/Patient?identifier=https%3A%2F%2Ffhir.kemkes.go.id%2Fid%2Fnik%7C' . $nik,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $ssToken
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);
        // return json_encode($response);


        if (!isset($response['entry']['0']['resource']['id'])) {
            return response()->setStatusCode(401);
        } else {
            return json_encode($response['entry']['0']['resource']['id']);
        }
    }
    public function getKFA()
    {
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];
        $curl = curl_init();

        $db = db_connect();
        $select = $db->query("select count(kfa_code) as jml from kfa_product")->getResultArray();
        $jml = $select[0]['jml'];
        $jml = round($jml / 2000) + 1;

        echo $jml;

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-satusehat.kemkes.go.id/kfa-v2/products/all?page=' . $jml . '&size=2000&product_type=farmasi',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . $ssToken
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = json_decode($response, true);
        $return[] = $response;


        curl_close($curl);


        if ($httpcode != 401) {
            $kfaproduct = new KfaProductModel();
            $kfatemplate = new KfaTemplateModel();
            $kfaingredient = new KfaIngredientModel();
            $db = db_connect();

            $data = $response["items"]["data"];
            foreach ($data as $key => $value) {
                echo $value['kfa_code'] . "<br>";
                $kfaproduct->save([
                    'kfa_code' => $value['kfa_code'],
                    'name' => $value['name'],
                    'active' => $value['active'],
                    'state' => $value['state'],
                    'updated_at' => $value['updated_at'],
                    'farmalkes_type' => $value['farmalkes_type']['code'],
                    'dosage_form' => $value['dosage_form']['code'],
                    'produksi_buatan' => $value['produksi_buatan'],
                    'nie' => $value['nie'],
                    'nama_dagang' => $value['nama_dagang'],
                    'manufacturer' => $value['manufacturer'],
                    'registrar' => $value['registrar'],
                    'generik' => $value['generik'],
                    'rxterm' => $value['rxterm'],
                    'dose_per_unit' => $value['dose_per_unit'],
                    'fix_price' => $value['fix_price'],
                    'het_price' => $value['het_price'],
                    'farmalkes_hscode' => $value['farmalkes_hscode'],
                    'tayang_lkpp' => $value['tayang_lkpp'],
                    'kode_lkpp' => $value['kode_lkpp'],
                    'net_weight' => $value['net_weight'],
                    'net_weight_uom_name' => $value['net_weight_uom_name'],
                    'volume' => $value['volume'],
                    'volume_uom_name' => $value['volume_uom_name'],
                    'uom_name' => $value['uom']['name'],
                    'product_template' => $value['product_template']['kfa_code'],
                    'active_ingredients' => null,
                    'tags' => null,
                    'replacement_product' => $value['replacement']['product']['kfa_code'],
                    'replacement_template' => $value['replacement']['template']['kfa_code']
                ]);
                $kfatemplate->save([
                    'kfa_code' => $value['product_template']['kfa_code'],
                    'name' => $value['product_template']['name'],
                    'state' => $value['product_template']['state'],
                    'active' => $value['product_template']['active'],
                    'updated_at' => $value['product_template']['updated_at'],
                    'display_name' => $value['product_template']['display_name'],
                ]);
                foreach ($value['active_ingredients'] as $key1 => $value1) {
                    if (!is_null($value1['kfa_code'])) {
                        $kfaingredient->save([
                            'kfa_code' => $value1['kfa_code'],
                            'state' => $value1['state'],
                            'active' => $value1['active'],
                            'zat_aktif' => $value1['zat_aktif'],
                            'updated_at' => $value1['updated_at'],
                            'kekuatan_zat_aktif' => $value1['kekuatan_zat_aktif'],
                        ]);
                        try {
                            $db->query("insert into kfa_ingredient_mapping values ('" . $value['kfa_code'] . "', '" . $value1['kfa_code'] . "')");
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
                foreach ($value['tags'] as $key2 => $value2) {
                    if (!is_null($value2['code'])) {
                        try {
                            $db->query("insert into kfa_tags values ('" . $value['kfa_code'] . "', '" . $value2['code'] . "', '" . $value2['name'] . "')");
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
        } else {
            $token = $this->getToken();
            return $token;
        }
        echo json_encode($response);
    }
    public function getAllPasienId()
    {
        // $token = json_decode($this->getToken(), true);
        // return json_encode($token);

        // $pv = new PasienVisitationModel();
        $p = new PasienModel();
        // $pasien = $this->lowerKey($pv->join("pasien", "pasien.no_registration = pasien_visitation.no_registration", "inner")->where("pasien.sspasien_id is null")->where("visit_date between dateadd(day,-1,getdate()) and getdate()")->select("top(100) pasien.pasien_id")->findAll());
        $db = db_connect();
        $pasien = $db->query("select top(100) sspasien_id, p.no_registration, p.pasien_id from pasien p inner join pasien_visitation pv on p.no_registration = pv.no_registration where visit_date between dateadd(day,-1,getdate()) and getdate() and (sspasien_id is null or SSPASIEN_ID = '')")->getResultArray();
        // return json_encode($pasien);



        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];

        $return = [];

        foreach ($pasien as $key => $value) {
            // return $value['pasien_id'];
            if (!is_null($value["pasien_id"]) && $value["pasien_id"] != '') {
                $nik = $value["pasien_id"];
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->baseurlfhir . '/Patient?identifier=https%3A%2F%2Ffhir.kemkes.go.id%2Fid%2Fnik%7C' . $nik,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $ssToken
                    ),
                ));

                $response = curl_exec($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $response = json_decode($response, true);
                $return[] = $response;

                curl_close($curl);
                // return json_encode($httpcode);

                if ($httpcode == 401) {
                    $token = $this->getToken();
                } else {
                    if (!isset($response['entry']['0']['resource']['id'])) {
                        // return response()->setStatusCode(401);
                    } else {
                        $p->update($value['no_registration'], [
                            "sspasien_id" => $response['entry']['0']['resource']['id']
                        ]);
                    }
                }
            }
        }


        return json_encode($return);
    }
    public function getOrganization()
    {
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        // return json_encode($token);

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->select("replace(name_of_clinic,' ','%20') as name_of_clinic, clinic_id")->where("ssclinic_id is null")->findAll());

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find($this->orgunitcode));
        $ssorgid = $select['ssorganizationid'];

        $return = [];

        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-satusehat.kemkes.go.id/fhir-r4/v1/Organization?partof=' . $ssorgid . '&name=' . $value['name_of_clinic'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $return[] = $response;
            // return json_encode($response);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response["entry"][0]["resource"]["id"])) {
                    $c->update($response["entry"]['resource']['identifier'][0]['value'], [
                        'ssclinic_id' => $response["entry"][0]["resource"]["id"]
                    ]);
                } else {
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }


        return json_encode($return);
    }
    public function postOrganization()
    {
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        // return json_encode($token);

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->select("*")->where("ssclinic_id is null")->findAll());
        // return json_encode($clinic);

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find($this->orgunitcode));
        $ssorgid = $select['ssorganizationid'];

        $return = [];

        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir . '/Organization',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                                        "resourceType": "Organization",
                                        "active": true,
                                        "identifier": [
                                            {
                                                "use": "official",
                                                "system": "http://sys-ids.kemkes.go.id/organization/' . $ssorgid . '",
                                                "value": "' . $clinic[$key]['clinic_id'] . '"
                                            }
                                        ],
                                        "type": [
                                            {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.hl7.org/CodeSystem/organization-type",
                                                        "code": "dept",
                                                        "display": "Hospital Department"
                                                    }
                                                ]
                                            }
                                        ],
                                        "name": "' . $clinic[$key]['name_of_clinic'] . '",
                                        "partOf": {
                                            "reference": "Organization/' . $ssorgid . '"
                                        }
                                    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $ssToken
                ),
            ));

            $response = curl_exec($curl);
            // return json_encode($value);

            $response = json_decode($response, true);
            $return[] = $response;
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response['id'])) {
                    $c->update($clinic[$key]['clinic_id'], [
                        'ssclinic_id' => $response['id']
                    ]);
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }

        return json_encode($return);
    }

    public function getLocation()
    {
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];

        $c = new ClinicModel();
        // $clinic = $this->lowerKey($c->select("*")->orderBy('clinic_id OFFSET 20 ROWS
        // FETCH NEXT 30 ROWS ONLY')->findAll());
        $db = db_connect();
        $clinic = $this->lowerKey($db->query("select * from  clinic
        where sslocation_id is null
        order by CLINIC_ID;
        ")->getResultArray());
        // return json_encode($clinic);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find($this->orgunitcode));
        $ssorgid = $select['ssorganizationid'];
        foreach ($clinic as $key => $value) {
            $curl = curl_init();


            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir . '/Location?organization=' . $value['ssclinic_id'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken
                ),
            ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response['entry'][0]['resource']['id'])) {
                    // if (isset($response['id'])) {
                    $c->update($clinic[$key]['clinic_id'], [
                        'sslocation_id' => $response['entry'][0]['resource']['id']
                        // 'sslocation_id' => $response['id']
                    ]);
                } else {
                    $c->update($clinic[$key]['clinic_id'], [
                        'sslocation_id' => null
                    ]);
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }
        return json_encode($return);
    }
    public function postLocation()
    {
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];

        $c = new ClinicModel();
        // $clinic = $this->lowerKey($c->select("*")->orderBy('clinic_id OFFSET 20 ROWS
        // FETCH NEXT 30 ROWS ONLY')->findAll());
        $db = db_connect();
        $clinic = $this->lowerKey($db->query("select * from  clinic
        where sslocation_id is null
        order by CLINIC_ID
        ")->getResultArray());
        // return json_encode($clinic);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find($this->orgunitcode));
        $ssorgid = $select['ssorganizationid'];
        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir . '/Location',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                                        "resourceType": "Location",
                                        "identifier": [
                                            {
                                                "system": "http://sys-ids.kemkes.go.id/location/' . $ssorgid . '",
                                                "value": "' . $clinic[$key]['clinic_id'] . '"
                                            }
                                        ],
                                        "status": "active",
                                        "name": "Poli Dalam",
                                        "description": "' . $clinic[$key]['name_of_clinic'] . '",
                                        "mode": "instance",


                                        "physicalType": {
                                            "coding": [
                                                {
                                                    "system": "http://terminology.hl7.org/CodeSystem/location-physical-type",
                                                    "code": "ro",
                                                    "display": "Room"
                                                }
                                            ]
                                        },





                                        "managingOrganization": {
                                            "reference": "Organization/' . $clinic[$key]['ssclinic_id'] . '"
                                        }
                                    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $ssToken
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response['id'])) {
                    // if (isset($response['id'])) {
                    $c->update($clinic[$key]['clinic_id'], [
                        'sslocation_id' => $response['id']
                        // 'sslocation_id' => $response['id']
                    ]);
                } else {
                    $c->update($clinic[$key]['clinic_id'], [
                        'sslocation_id' => null
                    ]);
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }
        return json_encode($return);
    }
    public function getPractitioner()
    {
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];

        $c = new EmployeeAllModel();
        // $clinic = $this->lowerKey($c->select("*")->orderBy('clinic_id OFFSET 20 ROWS
        // FETCH NEXT 30 ROWS ONLY')->findAll());
        $db = db_connect();
        $employee = $this->lowerKey($db->query("select employee_id, npk from  employee_all
        where SPECIALIST_TYPE_ID is not null
        order by npk
        ")->getResultArray());
        // return json_encode($clinic);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find($this->orgunitcode));
        $ssorgid = $select['ssorganizationid'];
        foreach ($employee as $key => $value) {
            if ($value['npk']) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api-satusehat.kemkes.go.id/fhir-r4/v1/Practitioner?identifier=https%3A%2F%2Ffhir.kemkes.go.id%2Fid%2Fnik%7C' . $value['npk'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $ssToken
                    ),
                ));


                $response = curl_exec($curl);
                $response = json_decode($response, true);

                $return[] = $response;
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                if ($httpcode != 401) {
                    if (isset($response['entry'][0]['resource']['id'])) {
                        // if (isset($response['id'])) {
                        $c->update($employee[$key]['employee_id'], [
                            'sspractitioner_id' => $response['entry'][0]['resource']['id']
                            // 'sslocation_id' => $response['id']
                        ]);
                    } else {
                        $c->update($employee[$key]['employee_id'], [
                            'sspractitioner_id' => null
                        ]);
                    }
                } else {
                    $token = $this->getToken();
                    return $token;
                }
            }
        }
        return json_encode($return);
    }
    public function postEncounter()
    {

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseurlfhir . '/Encounter',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $ssToken,
                'Content-Type: application/json'
            ),
        ));


        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
    public function generateBatchingBundleSingle()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $ssToken = $this->request->getHeaderLine("ssToken");

        $sslocation_id = $body['sslocation_id'];
        $sslocation_name = $body['sslocation_name'];
        $sspractitioner_id = $body['sspractitioner_id'];
        $sspractitioner_name = $body['sspractitioner_name'];
        $ssencounter_id = $body['ssencounter_id'];
        $ssorganizationid = $body['ssorganizationid'];
        $visit_id = $body['visit_id'];
        $trans_id = $body['trans_id'];
        $no_registration = $body['no_registration'];

        $ss = new SatuSehat();

        $p = new PasienModel();
        $pasien = $this->lowerKeyOne($p->find($no_registration));

        $db = db_connect();
        $select = $db->query('select pds.diagnosa_id, pds.diagnosa_name, pds.sscondition_id from pasien_diagnosa pd inner join pasien_diagnosas pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id
        where visit_id = \'' . $visit_id . '\'')->getResultArray();

        $bb = new BatchingBridgingModel();

        $batching = $bb->where('trans_id', $trans_id)->where('status', 200)->like('tipe', '2%')->select("replace(convert(varchar,waktu,20),' ','T')+'+07:00' as waktu, tipe")->orderBy('waktu')->findAll();


        $jsonencounter = '{
                                "fullUrl": "urn:uuid:' . $ssencounter_id . '",
                                "resource": {
                                    "resourceType": "Encounter",
                                    "status": "finished",
                                    "class": {
                                        "system": "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                                        "code": "AMB",
                                        "display": "ambulatory"
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $pasien['sspasien_id'] . '",
                                        "display": "' . $pasien['name_of_pasien'] . '"
                                    },
                                    "participant": [
                                        {
                                            "type": [
                                                {
                                                    "coding": [
                                                        {
                                                            "system": "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                                            "code": "ATND",
                                                            "display": "attender"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "individual": {
                                                "reference": "Practitioner/' . $sspractitioner_id . '",
                                                "display": "' . $sspractitioner_name . '"
                                            }
                                        }
                                    ],
                                    "location": [
                                        {
                                            "location": {
                                                "reference": "Location/' . $sslocation_id . '",
                                                "display": "' . $sslocation_name . '"
                                            }
                                        }
                                    ],
                                    "diagnosis": [
                                    ],
                                    "statusHistory": [
                                        
                                    ],
                                    "serviceProvider": {
                                        "reference": "Organization/' . $ssorganizationid . '"
                                    },
                                    "identifier": [
                                        {
                                            "system": "http://sys-ids.kemkes.go.id/encounter/' . $ssorganizationid . '",
                                            "value": "' . $trans_id . '"
                                        }
                                    ]
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Encounter"
                                }
                            }';
        $jsonencounter = json_decode($jsonencounter, true);
        // return json_encode(in_array($batching[4]['tipe'], ['25', '27']));
        foreach ($batching as $key => $value) {
            if ($value['tipe'] == '21') {
                $jsonencounter['resource']['period']['start'] = $value['waktu'];
            } else if ($key == count($batching) - 1 && ($value['tipe'] == '25' || $value['tipe'] == '27')) {
                $jsonencounter['resource']['period']['end'] = $value['waktu'];
            } else if ($key == count($batching) - 1 && !in_array($value['tipe'], ['25', '27'])) {
                return response()->setStatusCode(401, 'Kunjungan belum selesai, silahkan selesaikan kunjungan terlebih dahulu.');
            }
            if ($value['tipe'] == '21') {
                $jsonencounter['resource']['statusHistory'][0]['status'] = 'arrived';
                $jsonencounter['resource']['statusHistory'][0]['period']['start'] = $value['waktu'];
            } else if ($value['tipe'] == '23') {
                $jsonencounter['resource']['statusHistory'][0]['period']['end'] = $value['waktu'];
                $jsonencounter['resource']['statusHistory'][1]['status'] = 'in_progress';
                $jsonencounter['resource']['statusHistory'][1]['period']['start'] = $value['waktu'];
            } else if ($value['tipe'] == '25') {
                $jsonencounter['resource']['statusHistory'][1]['period']['end'] = $value['waktu'];
                $jsonencounter['resource']['statusHistory'][2]['status'] = 'finished';
                $jsonencounter['resource']['statusHistory'][2]['period']['start'] = $value['waktu'];
            }
            if ($key == count($batching) - 1 && in_array($value['tipe'], ['25', '27'])) {
                $jsonencounter['resource']['statusHistory'][2]['period']['end'] = $value['waktu'];
            }
        }
        $ssjson[] = $jsonencounter;

        $sscondition = array();
        foreach ($select as $key => $value) {
            $jsonencounter['resource']['diagnosis'][] = json_decode('{
                                            "condition": {
                                                "reference": "urn:uuid:' . $value['sscondition_id'] . '",
                                                "display": "' . $value['diagnosa_name'] . '"
                                            },
                                            "use": {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                                        "code": "DD",
                                                        "display": "Discharge diagnosis"
                                                    }
                                                ]
                                            },
                                            "rank": ' . (string)($key + 1) . '
                                        }', true);

            $sscondition = '{
                                "fullUrl": "urn:uuid:' . $value['sscondition_id'] . '",
                                "resource": {
                                    "resourceType": "Condition",
                                    "clinicalStatus": {
                                        "coding": [
                                            {
                                                "system": "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                                "code": "active",
                                                "display": "Active"
                                            }
                                        ]
                                    },
                                    "category": [
                                        {
                                            "coding": [
                                                {
                                                    "system": "http://terminology.hl7.org/CodeSystem/condition-category",
                                                    "code": "encounter-diagnosis",
                                                    "display": "Encounter Diagnosis"
                                                }
                                            ]
                                        }
                                    ],
                                    "code": {
                                        "coding": [
                                            {
                                                "system": "http://hl7.org/fhir/sid/icd-10",
                                                "code": "' . $value['diagnosa_id'] . '",
                                                "display": "' . $value['diagnosa_name'] . '"
                                            }
                                        ]
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $pasien['sspasien_id'] . '",
                                        "display": "Budi Santoso"
                                    },
                                    "encounter": {
                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                        "display": "Kunjungan ' . $pasien['name_of_pasien'] . '"
                                    }
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Condition"
                                }
                            }';
            $sscondition = json_decode($sscondition, true);
            $ssjson[] = $sscondition;
        }
        $ssfulljson['resourceType'] = 'Bundle';
        $ssfulljson['type'] = 'transaction';
        $ssfulljson['entry'] = $ssjson;


        $db = db_connect();
        $db->query("insert into satu_sehat(no_registration, trans_id, url, method, parameter, created_date, modified_date, tipe, waktu)
        values('$no_registration','$trans_id','$this->baseurlfhir','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'4',getdate())");

        return json_encode("selesai");
    }
    public function generateBatchingBundleGroup()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $sstoken = $select['sstoken'];
        // $ssToken = $this->request->getHeaderLine("ssToken");
        $db = db_connect();

        $select = $db->query("select ssencounter_id, sslocation_id, name_of_clinic as sslocation_name,sspractitioner_id,replace(fullname,'''','') as sspractitioner_name, ssencounter_id, ssorganizationid, visit_id, trans_id, no_registration from pasien_visitation pv
                                inner join clinic c on c.clinic_id = pv.clinic_id
                                inner join employee_all ea on ea.employee_id = pv.employee_id
                                inner join ORGANIZATIONUNIT o on o.ORG_UNIT_CODE = pv.ORG_UNIT_CODE
                                where visit_date between dateadd(day,-7,getdate()) and dateadd(day,-6,getdate()) and pv.trans_id not in (select trans_id from satu_sehat)
                                and sspractitioner_id is not null
                                and stype_id = '1'")->getResultArray();;
        // return json_encode($select);

        foreach ($select as $key => $value) {
            $body = $value;
            $sslocation_id = $body['sslocation_id'];
            $sslocation_name = $body['sslocation_name'];
            $sspractitioner_id = $body['sspractitioner_id'];
            $sspractitioner_name = $body['sspractitioner_name'];
            $ssencounter_id = $body['ssencounter_id'];
            $ssorganizationid = $body['ssorganizationid'];
            $visit_id = $body['visit_id'];
            $trans_id = $body['trans_id'];
            $no_registration = $body['no_registration'];

            $ss = new SatuSehat();

            $p = new PasienModel();
            $pasien = $this->lowerKeyOne($p->find($no_registration));


            $bb = new BatchingBridgingModel();

            $batching = $bb->where('trans_id', $trans_id)->where('status', 200)->like('tipe', '2%')->select("replace(convert(varchar,waktu,20),' ','T')+'+07:00' as waktu, tipe")->orderBy('waktu')->findAll();

            $jsonencounter = '';
            $jsonencounter = '{
                                "fullUrl": "urn:uuid:' . $ssencounter_id . '",
                                "resource": {
                                    "resourceType": "Encounter",
                                    "status": "finished",
                                    "class": {
                                        "system": "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                                        "code": "AMB",
                                        "display": "ambulatory"
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $pasien['sspasien_id'] . '",
                                        "display": "' . $pasien['name_of_pasien'] . '"
                                    },
                                    "participant": [
                                        {
                                            "type": [
                                                {
                                                    "coding": [
                                                        {
                                                            "system": "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                                            "code": "ATND",
                                                            "display": "attender"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "individual": {
                                                "reference": "Practitioner/' . $sspractitioner_id . '",
                                                "display": "' . $sspractitioner_name . '"
                                            }
                                        }
                                    ],
                                    "location": [
                                        {
                                            "location": {
                                                "reference": "Location/' . $sslocation_id . '",
                                                "display": "' . $sslocation_name . '"
                                            }
                                        }
                                    ],
                                    "diagnosis": [
                                    ],
                                    "statusHistory": [
                                        
                                    ],
                                    "serviceProvider": {
                                        "reference": "Organization/' . $ssorganizationid . '"
                                    },
                                    "identifier": [
                                        {
                                            "system": "http://sys-ids.kemkes.go.id/encounter/' . $ssorganizationid . '",
                                            "value": "' . $trans_id . '"
                                        }
                                    ]
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Encounter"
                                }
                            }';
            $jsonencounter = json_decode($jsonencounter, true);
            // return json_encode(in_array($batching[4]['tipe'], ['25', '27']));
            $iscontinue = true;
            foreach ($batching as $key => $value) {
                if ($value['tipe'] == '21') {
                    $jsonencounter['resource']['period']['start'] = $value['waktu'];
                } else if ($key == count($batching) - 1 && ($value['tipe'] == '25' || $value['tipe'] == '27')) {
                    $jsonencounter['resource']['period']['end'] = $value['waktu'];
                } else if ($key == count($batching) - 1 && !in_array($value['tipe'], ['25', '27'])) {
                    // return response()->setStatusCode(401, 'Kunjungan belum selesai, silahkan selesaikan kunjungan terlebih dahulu.');
                    $iscontinue = false;
                    break;
                }
                if ($value['tipe'] == '21') {
                    $jsonencounter['resource']['statusHistory'][0]['status'] = 'arrived';
                    $jsonencounter['resource']['statusHistory'][0]['period']['start'] = $value['waktu'];
                } else if ($value['tipe'] == '23') {
                    $jsonencounter['resource']['statusHistory'][0]['period']['end'] = $value['waktu'];
                    $jsonencounter['resource']['statusHistory'][1]['status'] = 'in_progress';
                    $jsonencounter['resource']['statusHistory'][1]['period']['start'] = $value['waktu'];
                } else if ($value['tipe'] == '25') {
                    $jsonencounter['resource']['statusHistory'][1]['period']['end'] = $value['waktu'];
                    $jsonencounter['resource']['statusHistory'][2]['status'] = 'finished';
                    $jsonencounter['resource']['statusHistory'][2]['period']['start'] = $value['waktu'];
                }
                if ($key == count($batching) - 1 && in_array($value['tipe'], ['25', '27'])) {
                    $jsonencounter['resource']['statusHistory'][2]['period']['end'] = $value['waktu'];
                }
            }
            if ($iscontinue == true) {
                $ssjson = array();
                $ssjson[] = $jsonencounter;

                $sscondition = array();
                $condition = $db->query('select pds.diagnosa_id, pds.diagnosa_name, pds.sscondition_id from pasien_diagnosa pd inner join pasien_diagnosas pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id
                where visit_id = \'' . $visit_id . '\'')->getResultArray();

                foreach ($condition as $key1 => $value1) {
                    $jsonencounter['resource']['diagnosis'][] = json_decode('{
                                            "condition": {
                                                "reference": "urn:uuid:' . $value1['sscondition_id'] . '",
                                                "display": "' . $value1['diagnosa_name'] . '"
                                            },
                                            "use": {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                                        "code": "DD",
                                                        "display": "Discharge diagnosis"
                                                    }
                                                ]
                                            },
                                            "rank": ' . (string)($key + 1) . '
                                        }', true);

                    $sscondition = '{
                                "fullUrl": "urn:uuid:' . $value1['sscondition_id'] . '",
                                "resource": {
                                    "resourceType": "Condition",
                                    "clinicalStatus": {
                                        "coding": [
                                            {
                                                "system": "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                                "code": "active",
                                                "display": "Active"
                                            }
                                        ]
                                    },
                                    "category": [
                                        {
                                            "coding": [
                                                {
                                                    "system": "http://terminology.hl7.org/CodeSystem/condition-category",
                                                    "code": "encounter-diagnosis",
                                                    "display": "Encounter Diagnosis"
                                                }
                                            ]
                                        }
                                    ],
                                    "code": {
                                        "coding": [
                                            {
                                                "system": "http://hl7.org/fhir/sid/icd-10",
                                                "code": "' . $value1['diagnosa_id'] . '",
                                                "display": "' . $value1['diagnosa_name'] . '"
                                            }
                                        ]
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $pasien['sspasien_id'] . '",
                                        "display": "Budi Santoso"
                                    },
                                    "encounter": {
                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                        "display": "Kunjungan ' . $pasien['name_of_pasien'] . '"
                                    }
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Condition"
                                }
                            }';
                    $sscondition = json_decode($sscondition, true);
                    $ssjson[] = $sscondition;
                }
                $ssfulljson['resourceType'] = 'Bundle';
                $ssfulljson['type'] = 'transaction';
                $ssfulljson['entry'] = $ssjson;


                $db = db_connect();
                try {
                    $db->query("insert into satu_sehat(no_registration, trans_id, url, method, parameter, created_date, modified_date, tipe, waktu)
                    values('$no_registration','$trans_id','" . $this->baseurlfhir . "','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'4',getdate())");
                } catch (\Exception $e) {
                    exit($e->getMessage());
                }
            }
        }

        return json_encode("selesai");
    }
    public function postingAllBatch()
    {
        $ss = new SatuSehatModel();
        $satusehat = $this->lowerKey($ss->where('status', null)->where('parameter is not null')->orderBy("trans_id, waktu")->findAll());        // return json_encode($satusehat);

        // $ssToken = $this->request->getHeaderLine("ssToken");
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $db = db_connect();
        // return json_encode(str_replace('\\', '', $satusehat[0]['parameter']));

        foreach ($satusehat as $key => $value) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $value['url'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => str_replace('\\', '', $value['parameter']),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken,
                    'Content-Type: application/json'
                ),
            ));

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $response = curl_exec($curl);
            curl_close($curl);

            if ($httpcode != 401) {
                $statuscode = null;
                if (isset($response['entry'])) {
                    $statuscode = "200";
                }
                $db->query("update satu_sehat set status = '$statuscode', result = '" . $response . "' where trans_id = '" . $value['trans_id'] . "' and tipe = '" . $value['tipe'] . "'");
            } else {
                $token = $this->getToken();
                return $token;
            }
            curl_close($curl);
        }
    }


























    public function viewPasienId()
    {
        $giTipe = 7;
        $title = 'Generate Pasien ID';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>ID Satu Sehat</th>
                        <th>Nama</th>
                        <th>No.CM</th>
                        <th>NIK</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            // 'clinic' => $clinic,
            // 'status' => $status,
            'header' => $header
        ]);
    }
    public function viewPasienIdpost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $pv = new PasienVisitationModel();

        $kunjungan = $pv->join("pasien p", "p.no_registration = pasien_visitation.no_registration", "inner")
            ->join("clinic c", "c.clinic_id = pasien_visitation.clinic_id", "inner")
            ->join("employee_all ea", "ea.employee_id = pasien_visitation.employee_id", "inner")
            ->join("status_pasien sp", "sp.status_pasien_id = pasien_visitation.status_pasien_id", "inner")
            ->where("visit_date between dateadd(day,0,'$mulai') and dateadd(day,1,'$akhir')")
            ->where("pasien_visitation.no_registration != '000000'")
            ->groupBy("p.sspasien_id, pasien_visitation.diantar_oleh, p.no_registration, p.pasien_id")
            ->orderBy("p.no_registration")->select("p.sspasien_id, pasien_visitation.diantar_oleh, p.no_registration, p.pasien_id")->findAll();
        $dt_data     = array();

        if (!empty($kunjungan)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($kunjungan as $key => $value) {
                $row = [];
                $row[] = $i + 1;
                $row[] = '<div id="pasienid_' . $value['pasien_id'] . '">' . $value['sspasien_id'];
                // $row[] = $value['visit_date'];
                $row[] = $value['diantar_oleh'];
                $row[] = $value['no_registration'];
                $row[] = $value['pasien_id'];
                // $row[] = $value['sspasien_id'];
                // $row[] = $value['name_of_status_pasien'];
                // $row[] = $value['sspasien_id'];

                $dt_data[] = $row;
                $i++;
            }
        }

        $json_data = array(
            "body"            => $dt_data,
            "jsonData" => $kunjungan
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function viewPasienIdbridging()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);        // $body = json_decode($body);
        $pasien_id = $body['pasien_id'];
        // return json_encode($body);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];
        $p = new PasienModel();
        if (!is_null($body["pasien_id"]) && $body["pasien_id"] != '') {
            $nik = $body["pasien_id"];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir . '/Patient?identifier=https%3A%2F%2Ffhir.kemkes.go.id%2Fid%2Fnik%7C' . $nik,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $ssToken
                ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $response = json_decode($response, true);
            $return[] = $response;

            curl_close($curl);
            // return json_encode($httpcode);

            if ($httpcode == 401) {
                $token = $this->getToken();
            } else {
                if (!isset($response['entry']['0']['resource']['id'])) {
                    return json_encode("-");
                } else {
                    $p->update($body['no_registration'], [
                        "sspasien_id" => $response['entry']['0']['resource']['id']
                    ]);
                    return json_encode($response['entry']['0']['resource']['id']);
                }
            }
        }
    }




    public function viewOrganization()
    {
        $giTipe = 7;
        $title = 'Organisasi Poli';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());
        // $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());


        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Kode Organisasi Satu Sehat</th>
                        <th>Nama</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'header' => $header
        ]);
    }
    public function viewOrganizationpost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $clinic_id = $this->request->getPost('clinic_id');

        $c = new ClinicModel();
        $select = $this->lowerKey($c->where("clinic_id like '%$clinic_id%'")->orderBy("name_of_clinic")->findAll());
        $dt_data = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $row[] = $i + 1;
                $row[] = '<div id="clinic_id_' . $value['clinic_id'] . '">' . $value['ssclinic_id'];
                // $row[] = $value['visit_date'];
                $row[] = $value['name_of_clinic'];

                $dt_data[] = $row;
                $i++;
            }
        }

        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $select
        );
        echo json_encode($json_data);
    }
    public function viewOrganizationbridging()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);        // $body = json_decode($body);
        $clinic_id = $body['clinic_id'];
        $name_of_clinic = $body['clinic_id'];
        // return json_encode($body);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];
        $c = new ClinicModel();
        if (!is_null($body["clinic_id"]) && $body["clinic_id"] != '') {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-satusehat.kemkes.go.id/fhir-r4/v1/Organization?partof=' . $ssorgid . '&name=' . $name_of_clinic,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $return[] = $response;
            // return json_encode($response);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response["entry"][0]["resource"]["id"])) {
                    $c->update($clinic_id, [
                        'ssclinic_id' => $response["entry"][0]["resource"]["id"]
                    ]);
                    return json_encode($response["entry"][0]["resource"]["id"]);
                } else {
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $this->baseurlfhir . '/Organization',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                                        "resourceType": "Organization",
                                        "active": true,
                                        "identifier": [
                                            {
                                                "use": "official",
                                                "system": "http://sys-ids.kemkes.go.id/organization/' . $ssorgid . '",
                                                "value": "' . $clinic_id . '"
                                            }
                                        ],
                                        "type": [
                                            {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.hl7.org/CodeSystem/organization-type",
                                                        "code": "dept",
                                                        "display": "Hospital Department"
                                                    }
                                                ]
                                            }
                                        ],
                                        "name": "' . $name_of_clinic . '",
                                        "partOf": {
                                            "reference": "Organization/' . $ssorgid . '"
                                        }
                                    }',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer ' . $ssToken
                        ),
                    ));

                    $response = curl_exec($curl);
                    // return json_encode($value);

                    $response = json_decode($response, true);
                    $return[] = $response;
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    curl_close($curl);

                    if ($httpcode != 401) {
                        if (isset($response['id'])) {
                            $c->update($clinic_id, [
                                'ssclinic_id' => $response['id']
                            ]);
                            return json_encode($response['id']);
                        } else {
                            return null;
                        }
                    } else {
                        $token = $this->getToken();
                        return $token;
                    }
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }
    }












    public function viewLocation()
    {
        $giTipe = 7;
        $title = 'Lokasi Rajal';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());
        // $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());


        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Kode Lokasi Satu Sehat</th>
                        <th>Nama</th>
                        <th>Kode Organisasi Satu Sehat</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'header' => $header
        ]);
    }
    public function viewLocationInap()
    {
        $giTipe = 7;
        $title = 'Lokasi Inap';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());
        // $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());


        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Kode Lokasi Satu Sehat</th>
                        <th>Nama</th>
                        <th>Kode Organisasi Satu Sehat</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'header' => $header
        ]);
    }
    public function viewLocationInappost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $clinic_id = $this->request->getPost('clinic_id');

        $cr = new ClassRoomModel();
        // $select = $this->lowerKey($cr->join("clinic c","class_room.clinic_id = c.clinic_id", "inner")->select("class_room.SSLOCATIONBED_ID, class_room."))

        $db = db_connect();
        $select = $this->lowerKey($db->query("select c.clinic_id,b.sslocationbed_id, b.bed_id, cr.NAME_OF_CLASS, cf.KELAS_CODE, cf.KELAS_DISPLAY, o.SSORGANIZATIONID, c.SSCLINIC_ID, c.SSLOCATION_ID, c.NAME_OF_CLINIC, cr.class_room_id
                                from CLASS_ROOM cr inner join beds b on cr.CLASS_ROOM_ID = b.CLASS_ROOM_ID 
                                inner join class cl on cl.CLASS_ID = cr.CLASS_ID
                                inner join CLASS_FHIR cf on cf.KELAS_CODE = cl.CLASS_FHIR_CODE
                                inner join clinic c on c.CLINIC_ID = cr.CLINIC_ID
                                ,ORGANIZATIONUNIT o
                                where cr.CLASS_ROOM_ID = '04.03'
                                order by c.name_of_clinic, cr.class_room_id,b.bed_id")->getResultArray());

        $dt_data = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $row[] = $i + 1;
                $row[] = '<div id="clinic_id_' . str_replace('.', '', $value['class_room_id']) . '-' . $value['bed_id'] . '">' . $value['sslocationbed_id'];
                // $row[] = $value['visit_date'];
                $row[] = 'Bed ' . $value['bed_id'] . ', Bangsal ' . $value['name_of_class'];
                $row[] = $value['ssclinic_id'];

                $dt_data[] = $row;
                $i++;
            }
        }

        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $select
        );
        echo json_encode($json_data);
    }
    public function viewLocationbridging()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);        // $body = json_decode($body);
        $ssclinic_id = $body['ssclinic_id'];
        $name_of_clinic = $body['clinic_id'];
        // return json_encode($body);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];
        $c = new ClinicModel();
        if (!is_null($body["ssclinic_id"]) && $body["ssclinic_id"] != '') {
            $curl = curl_init();


            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir . '/Location?organization=' . $body['ssclinic_id'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken
                ),
            ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response['entry'][0]['resource']['id'])) {
                    // if (isset($response['id'])) {
                    $c->update($body['clinic_id'], [
                        'sslocation_id' => $response['entry'][0]['resource']['id']
                        // 'sslocation_id' => $response['id']
                    ]);
                    return json_encode($response['entry'][0]['resource']['id']);
                } else {
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $this->baseurlfhir . '/Location',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                                        "resourceType": "Location",
                                        "identifier": [
                                            {
                                                "system": "http://sys-ids.kemkes.go.id/location/' . $ssorgid . '",
                                                "value": "' . $body['clinic_id'] . '"
                                            }
                                        ],
                                        "status": "active",
                                        "name": "' . $body['name_of_clinic'] . '",
                                        "description": "' . $body['name_of_clinic'] . '",
                                        "mode": "instance",


                                        "physicalType": {
                                            "coding": [
                                                {
                                                    "system": "http://terminology.hl7.org/CodeSystem/location-physical-type",
                                                    "code": "ro",
                                                    "display": "Room"
                                                }
                                            ]
                                        },
                                        "managingOrganization": {
                                            "reference": "Organization/' . $body['ssclinic_id'] . '"
                                        }
                                    }',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer ' . $ssToken
                        ),
                    ));

                    $response = curl_exec($curl);
                    $response = json_decode($response, true);

                    $return[] = $response;
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    curl_close($curl);

                    if ($httpcode != 401) {
                        if (isset($response['id'])) {
                            // if (isset($response['id'])) {
                            $c->update($body['clinic_id'], [
                                'sslocation_id' => $response['id']
                                // 'sslocation_id' => $response['id']
                            ]);
                            return json_encode($response['id']);
                        } else {
                            $c->update($body['clinic_id'], [
                                'sslocation_id' => null
                            ]);
                            return json_encode($response);
                        }
                    } else {
                        $token = $this->getToken();
                        return $token;
                    }
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }
    }
    public function viewLocationInapbridging()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);        // $body = json_decode($body);
        $ssclinic_id = $body['ssclinic_id'];
        $name_of_clinic = $body['clinic_id'];

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];

        // return '{
        //                                             "description": "Bed ' . $body['bed_id'] . ', Bangsal ' . $body['name_of_class'] . '",
        //                                             "extension": [
        //                                                 {
        //                                                     "url": "https://fhir.kemkes.go.id/r4/StructureDefinition/LocationServiceClass",
        //                                                     "valueCodeableConcept": {
        //                                                         "coding": [
        //                                                             {
        //                                                                 "code": "' . $body['kelas_code'] . '",
        //                                                                 "display": "' . $body['kelas_display'] . '",
        //                                                                 "system": "http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient"
        //                                                             }
        //                                                         ]
        //                                                     }
        //                                                 }
        //                                             ],
        //                                             "identifier": [
        //                                                 {
        //                                                     "system": "http://sys-ids.kemkes.go.id/organization/' . $body['ssorganizationid'] . '",
        //                                                     "value": "' . $body['class_room_id'] . '-' . $body['bed_id'] . '"
        //                                                 }
        //                                             ],
        //                                             "managingOrganization": {
        //                                                 "reference": "Organization/' . $body['ssclinic_id'] . '"
        //                                             },
        //                                             "mode": "instance",
        //                                             "name": "Bed' . $body['bed_id'] . ', Bangsal ' . $body['name_of_class'] . '",
        //                                             "partOf": {
        //                                                 "display": "' . $body['name_of_clinic'] . '",
        //                                                 "reference": "Location/' . $body['sslocation_id'] . '"
        //                                             },
        //                                             "physicalType": {
        //                                                 "coding": [
        //                                                     {
        //                                                         "code": "bd",
        //                                                         "display": "Bed",
        //                                                         "system": "http://terminology.hl7.org/CodeSystem/location-physical-type"
        //                                                     }
        //                                                 ]
        //                                             },
        //                                             "resourceType": "Location",
        //                                             "status": "active",
        //                                             "type": [
        //                                                 {
        //                                                     "coding": [
        //                                                         {
        //                                                             "code": "RT0004",
        //                                                             "display": "Tempat Tidur",
        //                                                             "system": "http://terminology.kemkes.go.id/CodeSystem/location-type"
        //                                                         }
        //                                                     ]
        //                                                 }
        //                                             ]
        //                                         }';
        $db = db_connect();
        if (!is_null($body["ssclinic_id"]) && $body["ssclinic_id"] != '') {
            $curl = curl_init();


            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir . '/Location?organization=' . $body['ssclinic_id'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken
                ),
            ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;

            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response['entry'][0]['resource']['id'])) {
                    $isbedexist = false;
                    foreach ($response['entry'] as $key => $value) {
                        if ($value['resource']['physicalType']['coding'][0]['code'] == 'bd' && $value['resource']['identifier'][0]['value'] == $body['class_room_id'] . '-' . $body['bed_id']) {
                            $db->query("update beds set sslocationbed_id = '" . $value['resource']['id'] . "' where bed_id ='" . $body['bed_id'] . "' and class_room_id ='" . $body['class_room_id'] . "'");
                            return json_encode($value['resource']['id']);
                        }
                    }
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $this->baseurlfhir . '/Location',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                                                    "description": "Bed ' . $body['bed_id'] . ', Bangsal ' . $body['name_of_class'] . '",
                                                    "extension": [
                                                        {
                                                            "url": "https://fhir.kemkes.go.id/r4/StructureDefinition/LocationServiceClass",
                                                            "valueCodeableConcept": {
                                                                "coding": [
                                                                    {
                                                                        "code": "' . $body['kelas_code'] . '",
                                                                        "display": "' . $body['kelas_display'] . '",
                                                                        "system": "http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient"
                                                                    }
                                                                ]
                                                            }
                                                        }
                                                    ],
                                                    "identifier": [
                                                        {
                                                            "system": "http://sys-ids.kemkes.go.id/organization/' . $body['ssorganizationid'] . '",
                                                            "value": "' . $body['class_room_id'] . '-' . $body['bed_id'] . '"
                                                        }
                                                    ],
                                                    "managingOrganization": {
                                                        "reference": "Organization/' . $body['ssclinic_id'] . '"
                                                    },
                                                    "mode": "instance",
                                                    "name": "Bed' . $body['bed_id'] . ', Bangsal ' . $body['name_of_class'] . '",
                                                    "partOf": {
                                                        "display": "' . $body['name_of_clinic'] . '",
                                                        "reference": "Location/' . $body['sslocation_id'] . '"
                                                    },
                                                    "physicalType": {
                                                        "coding": [
                                                            {
                                                                "code": "bd",
                                                                "display": "Bed",
                                                                "system": "http://terminology.hl7.org/CodeSystem/location-physical-type"
                                                            }
                                                        ]
                                                    },
                                                    "resourceType": "Location",
                                                    "status": "active",
                                                    "type": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "code": "RT0004",
                                                                    "display": "Tempat Tidur",
                                                                    "system": "http://terminology.kemkes.go.id/CodeSystem/location-type"
                                                                }
                                                            ]
                                                        }
                                                    ]
                                                }',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer ' . $ssToken
                        ),
                    ));

                    $response = curl_exec($curl);
                    $response = json_decode($response, true);

                    $return[] = $response;
                    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                    curl_close($curl);

                    if ($httpcode != 401) {
                        if (isset($response['id'])) {
                            // if (isset($response['id'])) {
                            $db->query("update beds set sslocationbed_id = '" . $response['id'] . "' where bed_id ='" . $body['bed_id'] . "' and class_room_id ='" . $body['class_room_id'] . "'");
                            // $c->update($body['clinic_id'], [
                            //     'sslocation_id' => $response['id']
                            //     // 'sslocation_id' => $response['id']
                            // ]);
                            return json_encode($response['id']);
                        } else {
                            $db->query("update beds set sslocationbed_id = null where bed_id ='" . $body['bed_id'] . "' and class_room_id ='" . $body['class_room_id'] . "'");

                            return json_encode($response);
                        }
                    } else {
                        $token = $this->getToken();
                        return $token;
                    }
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }
    }

















    public function viewPractitioner()
    {
        $giTipe = 7;
        $title = 'Kode Satu Sehat Dokter';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());

        $ea = new EmployeeAllModel();
        $dokter = $this->lowerKey($ea->where("specialist_type_id is not null")->findAll());

        // $ds = new DoctorScheduleModel();
        // $dokter = $this->lowerKey($ds->getSchedule());

        // return json_encode($dokter);
        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Kode Satu Sehat Dokter</th>
                        <th>Nama Dokter</th>
                        <th>NIK Dokter</th>
                        <th>Spesialis</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            // 'schedule' => $dokter,
            'dokterfill' => $dokter,
            'header' => $header
        ]);
    }

    public function viewPractitionerpost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $dokter = $this->request->getPost('dokter');

        $dokter = $dokter ?? '%';
        // return json_encode($dokter);
        // $ea = new EmployeeAllModel();
        // $select = $this->lowerKey($ea->where("employee_id like '%$dokter%'")->orderBy("fullname")->findAll());

        $db = db_connect();
        $select = $db->query("select ea.fullname, ea.employee_id, ea.sspractitioner_id,st.specialist_type, ea.npk from EMPLOYEE_ALL ea
        inner join SPECIALIST_TYPE st on ea.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        where employee_id like '%$dokter$' or fullname like '%$dokter%'
        order by fullname")->getResultArray();
        // return json_encode($select);
        $dt_data = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $row[] = $i + 1;
                $row[] = '<div id="employee_id_' . $value['employee_id'] . '">' . $value['sspractitioner_id'];
                // $row[] = $value['visit_date'];
                $row[] = $value['fullname'];
                $row[] = $value['npk'];
                $row[] = $value['specialist_type'];

                $dt_data[] = $row;
                $i++;
            }
        }

        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $select
        );
        echo json_encode($json_data);
    }
    public function viewPractitionerbridging()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);        // $body = json_decode($body);
        $employee_id = $body['employee_id'];
        $fullname = $body['fullname'];
        $npk = $body['npk'];
        // return json_encode($body);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $ssorgid = $select['ssorganizationid'];
        $c = new ClinicModel();
        if (!is_null($body["sspractitioner_id"]) && $body["sspractitioner_id"] != '') {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-satusehat.kemkes.go.id/fhir-r4/v1/Practitioner?identifier=https%3A%2F%2Ffhir.kemkes.go.id%2Fid%2Fnik%7C' . $body['npk'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $ssToken
                ),
            ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($httpcode != 401) {
                if (isset($response['entry'][0]['resource']['id'])) {
                    // if (isset($response['id'])) {
                    $c->update($body['employee_id'], [
                        'sspractitioner_id' => $response['entry'][0]['resource']['id']
                        // 'sslocation_id' => $response['id']
                    ]);
                    return json_encode($response['entry'][0]['resource']['id']);
                } else {
                    $c->update($body['employee_id'], [
                        'sspractitioner_id' => null
                    ]);
                }
            } else {
                $token = $this->getToken();
                return $token;
            }
        }
    }

















    public function viewEncounterCondition()
    {
        $giTipe = 7;
        $title = 'Kunjungan dan Diagnosa';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());

        $ea = new EmployeeAllModel();
        $dokter = $this->lowerKey($ea->where("specialist_type_id is not null")->findAll());

        $sp = new StatusPasienModel();
        $status = $this->lowerKey($sp->where("name_of_status_pasien <> ''")->findAll());

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->where("stype_id in ('1','2')")->findAll());

        // $ds = new DoctorScheduleModel();
        // $dokter = $this->lowerKey($ds->getSchedule());

        // return json_encode($dokter);
        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Kode Kunjungan RS</th>
                        <th>Kode Kunjungan Satu Sehat</th>
                        <th>Antrol</th>
                        <th>Diagnosa</th>
                        <th>Prosedur</th>
                        <th>Observasi</th>
                        <th>Status Bridging</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            // 'schedule' => $dokter,
            'dokterfill' => $dokter,
            'header' => $header
        ]);
    }
    public function viewEncounterConditionpost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $dokter = $this->request->getPost('dokter');
        $clinic_id = $this->request->getPost('clinic_id');
        $status = $this->request->getPost('status_pasien_id');

        $dokter = $dokter ?? '%';
        // return json_encode($dokter);
        // $ea = new EmployeeAllModel();
        // $select = $this->lowerKey($ea->where("employee_id like '%$dokter%'")->orderBy("fullname")->findAll());

        $db = db_connect();
        $select = $db->query("select replace(pv.diantar_oleh,'''','') diantar_oleh, min(pv.visit_date) visit_date, ssencounter_id, sslocation_id, 
                                name_of_clinic,sspractitioner_id,replace(fullname,'''','') as fullname, ssencounter_id, 
                                ssorganizationid, pv.trans_id, pv.visit_id, 
                                pv.no_registration, ss.status, ss.parameter, ss.url, ss.method, ss.result,
                                replace(p.name_of_pasien,'''','') name_of_pasien, p.sspasien_id
                                from pasien_visitation pv
                                inner join pasien p on p.no_registration = pv.no_registration
                                inner join clinic c on c.clinic_id = pv.clinic_id
                                inner join employee_all ea on ea.employee_id = pv.employee_id
                                inner join ORGANIZATIONUNIT o on o.ORG_UNIT_CODE = pv.ORG_UNIT_CODE
                                left outer join satu_sehat ss on ss.trans_id = pv.trans_id
                                where visit_date between dateadd(day,0,'$mulai') and dateadd(day,1,'$akhir')
                                and pv.clinic_id like '%$clinic_id%'
                                and pv.status_pasien_id like '%$status%'
                                and sspractitioner_id is not null
                                and stype_id = '1'
                                and pv.clinic_id_from = 'P000'
                                group by pv.diantar_oleh,ssencounter_id, sslocation_id, name_of_clinic,sspractitioner_id,replace(fullname,'''',''), ssencounter_id, ssorganizationid, pv.trans_id,pv.visit_id, pv.no_registration, ss.status, ss.parameter, ss.url, ss.method, ss.result, p.name_of_pasien, p.sspasien_id")->getResultArray();;
        // return json_encode($select);
        $dt_data = array();
        $kunjungan = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $ssfulljson = json_decode($value['parameter'], true);
                // if (false) {
                if ($value['status'] != '200') {
                    $db->query("delete from satu_sehat where trans_id = '" . $value['trans_id'] . "' and tipe = 4");
                    $body = $value;
                    $sspasien_id = $value['sspasien_id'];
                    $namapasien = $value['name_of_pasien'];
                    $sslocation_id = $value['sslocation_id'];
                    $sslocation_name = $value['name_of_clinic'];
                    $sspractitioner_id = $value['sspractitioner_id'];
                    $sspractitioner_name = $value['fullname'];
                    $ssencounter_id = $value['ssencounter_id'];
                    $ssorganizationid = $value['ssorganizationid'];
                    $visit_id = $value['visit_id'];
                    $trans_id = $value['trans_id'];
                    $no_registration = $value['no_registration'];

                    $ss = new SatuSehat();

                    if ($ssencounter_id == '' || is_null(($ssencounter_id))) {
                        $db = db_connect();
                        $id = $db->query("select newid() as newid")->getResultArray();
                        $ssencounter_id = $id[0];
                    }



                    $jsonencounter = '';
                    $jsonencounter = '{
                                "fullUrl": "urn:uuid:' . $ssencounter_id . '",
                                "resource": {
                                    "resourceType": "Encounter",
                                    "status": "finished",
                                    "class": {
                                        "system": "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                                        "code": "AMB",
                                        "display": "ambulatory"
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $value['sspasien_id'] . '",
                                        "display": "' . $value['name_of_pasien'] . '"
                                    },
                                    "participant": [
                                        {
                                            "type": [
                                                {
                                                    "coding": [
                                                        {
                                                            "system": "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                                            "code": "ATND",
                                                            "display": "attender"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "individual": {
                                                "reference": "Practitioner/' . $sspractitioner_id . '",
                                                "display": "' . $sspractitioner_name . '"
                                            }
                                        }
                                    ],
                                    "location": [
                                        {
                                            "location": {
                                                "reference": "Location/' . $sslocation_id . '",
                                                "display": "' . $sslocation_name . '"
                                            }
                                        }
                                    ],
                                    "diagnosis": [
                                    ],
                                    "statusHistory": [
                                        
                                    ],
                                    "serviceProvider": {
                                        "reference": "Organization/' . $ssorganizationid . '"
                                    },
                                    "identifier": [
                                        {
                                            "system": "http://sys-ids.kemkes.go.id/encounter/' . $ssorganizationid . '",
                                            "value": "' . $trans_id . '"
                                        }
                                    ]
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Encounter"
                                }
                            }';
                    $jsonencounter = json_decode($jsonencounter, true);
                    // return json_encode(in_array($batching[4]['tipe'], ['25', '27']));
                    $iscontinue = false;

                    $bb = new BatchingBridgingModel();

                    $batching = $bb->where('trans_id', $trans_id)->where('status', 200)->like('tipe', '2%')->select("
                    replace(convert(varchar,max(case when tipe = 21 then waktu else null end),20),' ','T')+'+07:00' as waktu1,
                    replace(convert(varchar,max(case when tipe = 22 then waktu else null end),20),' ','T')+'+07:00' as waktu2,
                    replace(convert(varchar,max(case when tipe = 23 then waktu else null end),20),' ','T')+'+07:00' as waktu3,
                    replace(convert(varchar,max(case when tipe = 24 then waktu else null end),20),' ','T')+'+07:00' as waktu4,
                    replace(convert(varchar,max(case when tipe = 25 then waktu else null end),20),' ','T')+'+07:00' as waktu5,
                    replace(convert(varchar,max(case when tipe = 26 then waktu else null end),20),' ','T')+'+07:00' as waktu6,
                    replace(convert(varchar,max(case when tipe = 27 then waktu else null end),20),' ','T')+'+07:00' as waktu7
                    ")->findAll();
                    if (isset($batching[0])) {
                        $valueb = $batching[0];
                        $jsonencounter['resource']['period']['start'] = $valueb['waktu1'];
                        if ($valueb['waktu7'] == null) {
                            $jsonencounter['resource']['period']['end'] = $valueb['waktu5'];
                        } else {
                            $jsonencounter['resource']['period']['end'] = $valueb['waktu7'];
                        }
                        $jsonencounter['resource']['statusHistory'][0]['status'] = 'arrived';
                        $jsonencounter['resource']['statusHistory'][0]['period']['start'] = $valueb['waktu1'];
                        $jsonencounter['resource']['statusHistory'][0]['period']['end'] = $valueb['waktu3'];
                        $jsonencounter['resource']['statusHistory'][1]['status'] = 'in_progress';
                        $jsonencounter['resource']['statusHistory'][1]['period']['start'] = $valueb['waktu3'];
                        $jsonencounter['resource']['statusHistory'][1]['period']['end'] = $valueb['waktu5'];
                        $jsonencounter['resource']['statusHistory'][2]['status'] = 'finished';
                        $jsonencounter['resource']['statusHistory'][2]['period']['start'] = $valueb['waktu5'];
                        if ($valueb['waktu7'] == null) {
                            $jsonencounter['resource']['statusHistory'][2]['period']['end'] = $valueb['waktu5'];
                        } else {
                            $jsonencounter['resource']['statusHistory'][2]['period']['end'] = $valueb['waktu7'];
                        }
                        if ($valueb['waktu7'] == null && $valueb['waktu5']  == null) {
                            $iscontinue = false;
                        } else {
                            $iscontinue = true;
                        }



                        // if ($valueb['tipe'] == '21') {
                        //     $jsonencounter['resource']['period']['start'] = $valueb['waktu'];
                        // } else if ($keyb == count($batching) - 1 && ($valueb['tipe'] == '25' || $valueb['tipe'] == '27')) {
                        //     $jsonencounter['resource']['period']['end'] = $valueb['waktu'];
                        // } else if ($keyb == count($batching) - 1 && !in_array($valueb['tipe'], ['25', '27'])) {
                        //     // return response()->setStatusCode(401, 'Kunjungan belum selesai, silahkan selesaikan kunjungan terlebih dahulu.');
                        //     $iscontinue = false;
                        //     break;
                        // }
                        // if ($valueb['tipe'] == '21') {
                        //     $jsonencounter['resource']['statusHistory'][0]['status'] = 'arrived';
                        //     $jsonencounter['resource']['statusHistory'][0]['period']['start'] = $valueb['waktu'];
                        // } else if ($valueb['tipe'] == '23') {
                        //     $jsonencounter['resource']['statusHistory'][0]['period']['end'] = $valueb['waktu'];
                        //     $jsonencounter['resource']['statusHistory'][1]['status'] = 'in_progress';
                        //     $jsonencounter['resource']['statusHistory'][1]['period']['start'] = $valueb['waktu'];
                        // } else if ($valueb['tipe'] == '25') {
                        //     $jsonencounter['resource']['statusHistory'][1]['period']['end'] = $valueb['waktu'];
                        //     $jsonencounter['resource']['statusHistory'][2]['status'] = 'finished';
                        //     $jsonencounter['resource']['statusHistory'][2]['period']['start'] = $valueb['waktu'];
                        // }
                        // if ($keyb == count($batching) - 1 && in_array($valueb['tipe'], ['25', '27'])) {
                        //     $jsonencounter['resource']['statusHistory'][2]['period']['end'] = $valueb['waktu'];
                        //     $iscontinue = true;
                        //     $lastwaktu = $valueb['tipe'];
                        // }
                    }
                    // $select[$key]['lastwaktu'] = $lastwaktu;
                    if ($iscontinue == true) {
                        // if (true) {
                        $ssjson = array();

                        $sscondition = array();
                        $condition = $db->query('select pds.diagnosa_id, pds.diagnosa_name, isnull(pds.sscondition_id, newid()) sscondition_id from pasien_diagnosa pd inner join pasien_diagnosas pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id
                        where visit_id = \'' . $visit_id . '\'')->getResultArray();

                        foreach ($condition as $key1 => $value1) {
                            $jsonencounter['resource']['diagnosis'][] = json_decode('{
                                            "condition": {
                                                "reference": "urn:uuid:' . $value1['sscondition_id'] . '",
                                                "display": "' . $value1['diagnosa_name'] . '"
                                            },
                                            "use": {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                                        "code": "DD",
                                                        "display": "Discharge diagnosis"
                                                    }
                                                ]
                                            },
                                            "rank": ' . (string)($key + 1) . '
                                        }', true);
                        }
                        $ssjson[] = $jsonencounter;
                        foreach ($condition as $key1 => $value1) {
                            $sscondition = '{
                                "fullUrl": "urn:uuid:' . $value1['sscondition_id'] . '",
                                "resource": {
                                    "resourceType": "Condition",
                                    "clinicalStatus": {
                                        "coding": [
                                            {
                                                "system": "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                                "code": "active",
                                                "display": "Active"
                                            }
                                        ]
                                    },
                                    "category": [
                                        {
                                            "coding": [
                                                {
                                                    "system": "http://terminology.hl7.org/CodeSystem/condition-category",
                                                    "code": "encounter-diagnosis",
                                                    "display": "Encounter Diagnosis"
                                                }
                                            ]
                                        }
                                    ],
                                    "code": {
                                        "coding": [
                                            {
                                                "system": "http://hl7.org/fhir/sid/icd-10",
                                                "code": "' . $value1['diagnosa_id'] . '",
                                                "display": "' . $value1['diagnosa_name'] . '"
                                            }
                                        ]
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $value['sspasien_id'] . '",
                                        "display": "Budi Santoso"
                                    },
                                    "encounter": {
                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                        "display": "Kunjungan ' . $value['name_of_pasien'] . '"
                                    }
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Condition"
                                }
                            }';
                            $sscondition = json_decode($sscondition, true);
                            $ssjson[] = $sscondition;
                        }

                        $isprocedure = '';

                        if (isset($condition[0])) {
                            $procedures = $db->query("select pds.diagnosa_id, pds.diagnosa_name, isnull(pds.ssprocedure_id, newid()) as ssprocedure_id from pasien_diagnosa pd inner join pasien_procedures pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id where visit_id = '$visit_id'")->getResultArray();
                            foreach ($procedures as $pkey => $pvalue) {
                                $ssprocedure = '{
                                                    "fullUrl": "urn:uuid:' . $pvalue['ssprocedure_id'] . '",
                                                    "resource": {
                                                        "resourceType": "Procedure",
                                                        "status": "completed",
                                                        "category": {
                                                            "coding": [
                                                                {
                                                                    "system": "http://snomed.info/sct",
                                                                    "code": "103693007",
                                                                    "display": "Diagnostic procedure"
                                                                }
                                                            ],
                                                            "text": "Diagnostic procedure"
                                                        },
                                                        "code": {
                                                            "coding": [
                                                                {
                                                                    "system": "http://hl7.org/fhir/sid/icd-9-cm",
                                                                    "code": "' . $pvalue['diagnosa_id'] . '",
                                                                    "display": "' . $pvalue['diagnosa_name'] . '"
                                                                }
                                                            ]
                                                        },
                                                        "subject": {
                                                            "reference": "Patient/' . $sspasien_id . '",
                                                            "display": "Budi Santoso"
                                                        },
                                                        "encounter": {
                                                            "reference": "Encounter/' . $ssencounter_id . '",
                                                            "display": "Tindakan ' . $pvalue['diagnosa_name'] . '"
                                                        },
                                                        "performedPeriod": {
                                                                                "start": "' . $jsonencounter['resource']['statusHistory'][1]['period']['start'] . '",
                                                                                "end": "' . $jsonencounter['resource']['statusHistory'][1]['period']['end'] . '"
                                                                            },
                                                        "performer": [
                                                            {
                                                                "actor": {
                                                                    "reference": "Practitioner/' . $sspractitioner_id . '",
                                                                    "display": "' . $sspractitioner_name . '"
                                                                }
                                                            }
                                                        ],
                                                        "reasonCode": [
                                                            {
                                                                "coding": [
                                                                    {
                                                                        "system": "http://hl7.org/fhir/sid/icd-10",
                                                                        "code": "' . $condition[0]['diagnosa_id'] . '",
                                                                        "display": "' . $condition[0]['diagnosa_name'] . '"
                                                                    }
                                                                ]
                                                            }
                                                        ]
                                                    },
                                                    "request": {
                                                        "method": "POST",
                                                        "url": "Procedure"
                                                    }
                                                }';
                                $ssprocedure = json_decode($ssprocedure, true);
                                $ssjson[] = $ssprocedure;
                                $isprocedure = 'terisi';
                            }
                        }


                        $exam = $this->lowerKey($db->query("select replace(convert(varchar,examination_date,20),' ','T')+'+07:00' as examination_date, nadi, newid() as nadi_id, nafas,  newid() as nafas_id, temperature, newid() as temperature_id, tension_upper, newid() as tension_upper_id, tension_below, newid() as tension_below_id, weight, newid() as weight_id, height, newid() as height_id from examination_info
                        where visit_id = '" . $visit_id . "'")->getResultArray());
                        $isexam = '';

                        if (isset($exam[0])) {
                            $examvalue = $exam[0];
                            if ($examvalue['nadi'] != null && $examvalue['nadi'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['nadi_id'] . '",
                                                "resource": {
                                                    "resourceType": "Observation",
                                                    "status": "final",
                                                    "category": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                    "code": "vital-signs",
                                                                    "display": "Vital Signs"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "code": {
                                                        "coding": [
                                                            {
                                                                "system": "http://loinc.org",
                                                                "code": "8867-4",
                                                                "display": "Heart rate"
                                                            }
                                                        ]
                                                    },
                                                    "subject": {
                                                        "reference": "Patient/' . $sspasien_id . '"
                                                    },
                                                    "performer": [
                                                        {
                                                            "reference": "Practitioner/' . $sspractitioner_id . '"
                                                        }
                                                    ],
                                                    "encounter": {
                                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                                        "display": "Pemeriksaan Nadi' . $namapasien . '"
                                                    },
                                                    "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                    "issued": "' . $examvalue['examination_date'] . '",
                                                    "valueQuantity": {
                                                        "value": ' . $examvalue['nadi'] . ',
                                                        "unit": "beats/minute",
                                                        "system": "http://unitsofmeasure.org",
                                                        "code": "/min"
                                                    }
                                                },
                                                "request": {
                                                    "method": "POST",
                                                    "url": "Observation"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['nafas'] != null && $examvalue['nafas'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['nafas_id'] . '",
                                                "resource": {
                                                    "resourceType": "Observation",
                                                    "status": "final",
                                                    "category": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                    "code": "vital-signs",
                                                                    "display": "Vital Signs"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "code": {
                                                        "coding": [
                                                            {
                                                                "system": "http://loinc.org",
                                                                "code": "9279-1",
                                                                "display": "Respiratory rate"
                                                            }
                                                        ]
                                                    },
                                                    "subject": {
                                                        "reference": "Patient/' . $sspasien_id . '"
                                                    },
                                                    "performer": [
                                                        {
                                                            "reference": "Practitioner/' . $sspractitioner_id . '"
                                                        }
                                                    ],
                                                    "encounter": {
                                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                                        "display": "Pemeriksaan Nafas' . $namapasien . '"
                                                    },
                                                    "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                    "issued": "' . $examvalue['examination_date'] . '",
                                                    "valueQuantity": {
                                                        "value": ' . $examvalue['nafas'] . ',
                                                        "unit": "breaths/minute",
                                                        "system": "http://unitsofmeasure.org",
                                                        "code": "/min"
                                                    }
                                                },
                                                "request": {
                                                    "method": "POST",
                                                    "url": "Observation"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['tension_upper'] != null && $examvalue['tension_upper'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['tension_upper_id'] . '",
                                                "resource": {
                                                    "resourceType": "Observation",
                                                    "status": "final",
                                                    "category": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                    "code": "vital-signs",
                                                                    "display": "Vital Signs"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "code": {
                                                        "coding": [
                                                            {
                                                                "system": "http://loinc.org",
                                                                "code": "8480-6",
                                                                "display": "Systolic blood pressure"
                                                            }
                                                        ]
                                                    },
                                                    "subject": {
                                                        "reference": "Patient/' . $sspasien_id . '"
                                                    },
                                                    "performer": [
                                                        {
                                                            "reference": "Practitioner/' . $sspractitioner_id . '"
                                                        }
                                                    ],
                                                    "encounter": {
                                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                                        "display": "Pemeriksaan Sistol' . $namapasien . '"
                                                    },
                                                    "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                    "issued": "' . $examvalue['examination_date'] . '",
                                                    "bodySite": {
                                                        "coding": [
                                                            {
                                                                "system": "http://snomed.info/sct",
                                                                "code": "368209003",
                                                                "display": "Right arm"
                                                            }
                                                        ]
                                                    },
                                                    "valueQuantity": {
                                                        "value": ' . $examvalue['tension_upper'] . ',
                                                        "unit": "mm[Hg]",
                                                        "system": "http://unitsofmeasure.org",
                                                        "code": "mm[Hg]"
                                                    }
                                                },
                                                "request": {
                                                    "method": "POST",
                                                    "url": "Observation"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['tension_below'] != null && $examvalue['tension_below'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['tension_below_id'] . '",
                                                "resource": {
                                                    "resourceType": "Observation",
                                                    "status": "final",
                                                    "category": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                    "code": "vital-signs",
                                                                    "display": "Vital Signs"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "code": {
                                                        "coding": [
                                                            {
                                                                "system": "http://loinc.org",
                                                                "code": "8462-4",
                                                                "display": "Diastolic blood pressure"
                                                            }
                                                        ]
                                                    },
                                                    "subject": {
                                                        "reference": "Patient/' . $sspasien_id . '"
                                                    },
                                                    "performer": [
                                                        {
                                                            "reference": "Practitioner/' . $sspractitioner_id . '"
                                                        }
                                                    ],
                                                    "encounter": {
                                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                                        "display": "Pemeriksaan Diastol' . $namapasien . '"
                                                    },
                                                    "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                    "issued": "' . $examvalue['examination_date'] . '",
                                                    "bodySite": {
                                                        "coding": [
                                                            {
                                                                "system": "http://snomed.info/sct",
                                                                "code": "368209003",
                                                                "display": "Right arm"
                                                            }
                                                        ]
                                                    },
                                                    "valueQuantity": {
                                                        "value": ' . $examvalue['tension_below'] . ',
                                                        "unit": "mm[Hg]",
                                                        "system": "http://unitsofmeasure.org",
                                                        "code": "mm[Hg]"
                                                    }
                                                },
                                                "request": {
                                                    "method": "POST",
                                                    "url": "Observation"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            // if (!is_null($examvalue['temperature']) && $examvalue['temperature'] != '') {
                            //     $ssexam = '{
                            //                     "fullUrl": "urn:uuid:' . $examvalue['temperature_id'] . '",
                            //                     "resource": {
                            //                         "resourceType": "Observation",
                            //                         "status": "final",
                            //                         "category": [
                            //                             {
                            //                                 "coding": [
                            //                                     {
                            //                                         "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                            //                                         "code": "vital-signs",
                            //                                         "display": "Vital Signs"
                            //                                     }
                            //                                 ]
                            //                             }
                            //                         ],
                            //                         "code": {
                            //                             "coding": [
                            //                                 {
                            //                                     "system": "http://loinc.org",
                            //                                     "code": "8310-5",
                            //                                     "display": "Body temperature"
                            //                                 }
                            //                             ]
                            //                         },
                            //                         "subject": {
                            //                             "reference": "Patient/' . $sspasien_id . '"
                            //                         },
                            //                         "performer": [
                            //                             {
                            //                                 "reference": "Practitioner/' . $sspractitioner_id . '"
                            //                             }
                            //                         ],
                            //                         "encounter": {
                            //                             "reference": "urn:uuid:' . $ssencounter_id . '",
                            //                             "display": "Pemeriksaan Suhu' . $namapasien . '"
                            //                         },
                            //                         "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                            //                         "issued": "' . $examvalue['examination_date'] . '",
                            //                         "valueQuantity": {
                            //                             "value": ' . $examvalue['temperature'] . ',
                            //                             "unit": "C",
                            //                             "system": "http://unitsofmeasure.org",
                            //                             "code": "Cel"
                            //                         },
                            //                     },
                            //                     "request": {
                            //                         "method": "POST",
                            //                         "url": "Observation"
                            //                     }
                            //                 }';
                            //     $ssjson[] = json_decode($ssexam, true);
                            // }
                            $isexam = 'terisi';
                        }

















                        $ssfulljson['resourceType'] = 'Bundle';
                        $ssfulljson['type'] = 'transaction';
                        $ssfulljson['entry'] = $ssjson;


                        $db = db_connect();
                        try {
                            $db->query("insert into satu_sehat(no_registration, trans_id, url, method, parameter, created_date, modified_date, tipe, waktu)
                            values('$no_registration','$trans_id','" . $this->baseurlfhir . "','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'4',getdate())");
                        } catch (\Exception $e) {
                            exit($e->getMessage());
                        }

                        $select[$key]['parameter'] = json_encode($ssfulljson);
                        $select[$key]['isdiagnosa'] = null;
                        $select[$key]['url'] = $this->baseurlfhir;
                        $isdiagnosa = '';
                        if (isset($ssfulljson['entry'])) {
                            foreach ($ssfulljson['entry'] as $key2 => $value2) {
                                // return json_encode($value2);
                                if (isset($value2['resource']['resourceType'])) {
                                    if ($value2['resource']['resourceType'] == 'Condition') {
                                        $isdiagnosa = "terisi";
                                        $select[$key]['isdiagnosa'] = $isdiagnosa;
                                    }
                                }
                            }
                        }
                        $select[$key]['isdiagnosa'] = $isdiagnosa;
                        $select[$key]['isprocedure'] = $isprocedure;
                        $select[$key]['isexam'] = $isexam;
                        // return json_encode($value);
                        $row[] = $i + 1;
                        $row[] = $value['diantar_oleh'] . "/" . $value['sspasien_id'];
                        $row[] = $value['fullname'];
                        $row[] = $value['name_of_clinic'];
                        $row[] = $value['trans_id'];
                        $row[] = $value['ssencounter_id'];
                        $row[] = $iscontinue;
                        $row[] = $isdiagnosa;
                        $row[] = $isprocedure;
                        $row[] = $isexam;
                        $row[] = '<div id="status_' . $value['sspasien_id'] . '">' . $value['status'] . '</div>';
                        $dt_data[] = $row;
                        $i++;
                        $kunjungan[] = $select[$key];
                    }
                } else {
                    $parameter = $value['parameter'];
                    $parameter = json_decode($parameter, true);

                    // return json_encode($parameter['entry']);
                    if (!isset($parameter['entry'])) {
                        foreach ($parameter['entry'] as $key2 => $value2) {
                            if (isset($value2['resource']['resourceType']) == 'Condition') {
                                $isdiagnosa = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Procedure') {
                                $isprocedure = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Observation') {
                                $isexam = 'terisi';
                            }
                        }
                    }

                    $isdiagnosa = '';
                    $isprocedure = '';
                    $isexam = '';


                    $row[] = $i + 1;
                    $row[] = $value['diantar_oleh'] . "/" . $value['sspasien_id'];
                    $row[] = $value['fullname'];
                    $row[] = $value['name_of_clinic'];
                    $row[] = $value['trans_id'];
                    $row[] = $value['ssencounter_id'];
                    $row[] = $isdiagnosa;
                    $row[] = $isprocedure;
                    $row[] = $isexam;
                    $row[] = '<div id="status_' . $value['sspasien_id'] . '">' . $value['status'] . '</div>';
                    $dt_data[] = $row;
                    $i++;
                    $kunjungan[] = $select[$key];
                }
            }
        }


        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $kunjungan
        );
        echo json_encode($json_data);
    }

    public function viewEncounterConditionbridging()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $parameter = json_decode($body['parameter'], true);
        // return json_encode($body);

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find($this->orgunitcode));
        $ssToken = $select['sstoken'];
        $db = db_connect();
        $ispass = false;
        $conditionCount = 0;
        $statusHistoryCount = 0;
        foreach ($parameter['entry'] as $key => $value) {
            if ($value['resource']['resourceType'] == 'Encounter') {
                if (count($value['resource']['statusHistory']) > 0) {
                    $statusHistoryCount++;
                };
            }
            if ($value['resource']['resourceType'] == 'Condition') {
                $conditionCount++;
            }
        }
        if ($conditionCount > 0 && $statusHistoryCount > 0)
            $ispass = true;
        // return json_encode(str_replace('\\', '', $satusehat[0]['parameter']));
        if ($ispass) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseurlfhir,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => str_replace('\\', '', $body['parameter']),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $ssToken,
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // curl_close($curl);
            // return json_encode($response);

            if ($httpcode != 401) {
                $statuscode = null;
                if (isset($response['entry'])) {
                    $statuscode = "200";
                }
                $db->query("update satu_sehat set status = '$statuscode', result = '" . $response . "' where trans_id = '" . $body['trans_id'] . "' and tipe = '4'");
                return json_encode($httpcode);
                // return json_encode($httpcode . " ===== " . $response);
            } else {
                $token = $this->getToken();
                return $token;
            }
            curl_close($curl);
        } else {
            return json_encode(0);
        }
    }


































    public function viewMedication()
    {
        $giTipe = 7;
        $title = 'Medikasi Resep';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());

        $ea = new EmployeeAllModel();
        $dokter = $this->lowerKey($ea->where("specialist_type_id is not null")->findAll());

        $sp = new StatusPasienModel();
        $status = $this->lowerKey($sp->where("name_of_status_pasien <> ''")->findAll());

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->where("stype_id in ('1','2')")->findAll());

        // $ds = new DoctorScheduleModel();
        // $dokter = $this->lowerKey($ds->getSchedule());

        // return json_encode($dokter);
        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Nomor Resep RS</th>
                        <th>Kode Kunjungan Satu Sehat</th>
                        <th>Diagnosa</th>
                        <th>Status Bridging</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            // 'schedule' => $dokter,
            'dokterfill' => $dokter,
            'header' => $header
        ]);
    }
    public function viewMedicationpost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $dokter = $this->request->getPost('dokter');
        $clinic_id = $this->request->getPost('clinic_id');
        $status = $this->request->getPost('status_pasien_id');

        $dokter = $dokter ?? '%';
        // return json_encode($dokter);
        // $ea = new EmployeeAllModel();
        // $select = $this->lowerKey($ea->where("employee_id like '%$dokter%'")->orderBy("fullname")->findAll());

        $db = db_connect();
        $select = $db->query("select 
        ss.trans_id,
        ss.parameter,
        bill_id,
        resep_no,
        brand_id,
        ssorganizationid, 
        sstoken,
        newid() as ssobatid,
        newid() as ssobatreqid,
        case when numer = 9 then 'NC' else 'SD' end as racikan,
        case when numer = 9 then 'Non-compound' else 'Gives of such doses' end as racikanText,
        replace(convert(varchar,treat_date,20),' ','T')+'+07:00' treat_date
        from satu_sehat ss inner join
        treatment_obat tbo on ss.trans_id = tbo.trans_id
        inner join organizationunit org on tbo.org_unit_code = org.org_unit_code
        where ss.tipe = '4'
        and tbo.treat_date between dateadd(day,0,'$mulai') and dateadd(day,0,'$akhir') ")->getResultArray();;
        // return json_encode($select);
        $dt_data = array();
        $kunjungan = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $ssfulljson = json_decode($value['parameter'], true);
                // if (false) {
                if ($value['status'] != '200') {
                    $db->query("delete from satu_sehat where trans_id = '" . $value['trans_id'] . "' and tipe = 4");
                    $parameter = json_decode($value['parameter'], true);
                    if (isset($parameter['entry'][0])) {
                        $pbody = $parameter['entry'][0];
                        $ssencounter_id = $pbody['fullUrl'];
                        $ssencounter_id = substr($ssencounter_id, 8);

                        $subject = $pbody['resource']['subject'];
                        $namapasien = $subject['display'];
                        $sspasien_id = substr($subject['reference'], 8);

                        $participant = $pbody['location'][0]['location'];
                        $sspractitioner_id = substr($participant['reference'], 13);
                        $sspractitioner_name = $participant['display'];

                        $location = $pbody['participant'][0]['individual'];
                        $sslocation_id = substr($location['reference'], 9);
                        $sslocation_name = $location['display'];




                        $ssorganizationid = $value['ssorganizationid'];
                        $ssobatid = $value['ssobatid'];
                        $ssobatreqid = $value['ssobatreqid'];
                        $bill_id = $value['bill_id'];
                        $resep_no = $value['resep_no'];
                        $brand_id = $value['brand_id'];


                        $ss = new SatuSehat();



                        $jsonencounter = '';
                        $jsonencounter = '{
                                            "fullUrl": "' . $ssobatid . '",
                                            "resourceType": "Medication",
                                            "meta": {
                                                "profile": [
                                                    "https://fhir.kemkes.go.id/r4/StructureDefinition/Medication"
                                                ]
                                            },
                                            "identifier": [
                                                {
                                                    "system": "http://sys-ids.kemkes.go.id/medication/' . $ssorganizationid . '",
                                                    "use": "official",
                                                    "value": "' . $brand_id . '"
                                                }
                                            ],
                                            "status": "active",
                                            "form": {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.kemkes.go.id/CodeSystem/medication-form",
                                                        "code": "BS023",
                                                        "display": "Kaplet Salut Selaput"
                                                    }
                                                ]
                                            },
                                            "extension": [
                                                {
                                                    "url": "https://fhir.kemkes.go.id/r4/StructureDefinition/MedicationType",
                                                    "valueCodeableConcept": {
                                                        "coding": [
                                                            {
                                                                "system": "http://terminology.kemkes.go.id/CodeSystem/medication-type",
                                                                "code": "' . $value['racikan'] . '",
                                                                "display": "' . $value['racikanText'] . '"
                                                            }
                                                        ]
                                                    }
                                                }
                                            ]
                                            }';
                        $jsonencounter = json_decode($jsonencounter, true);

                        $jsonDispense = '{
                                            "resourceType": "MedicationRequest",
                                            "identifier": [
                                                {
                                                    "system": "http://sys-ids.kemkes.go.id/prescription/' . $ssorganizationid . '",
                                                    "use": "official",
                                                    "value": "' . $resep_no . '"
                                                },
                                                {
                                                    "system": "http://sys-ids.kemkes.go.id/prescription-item/' . $ssorganizationid . '",
                                                    "use": "official",
                                                    "value": "' . $bill_id . '"
                                                }
                                            ],
                                            "status": "completed",
                                            "intent": "order",
                                            "category": [
                                                {
                                                    "coding": [
                                                        {
                                                            "system": "http://terminology.hl7.org/CodeSystem/medicationrequest-category",
                                                            "code": "outpatient",
                                                            "display": "Outpatient"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "medicationReference": {
                                                "reference": "Medication/' . $ssobatid . '",
                                                "display": "Rifampicin 150 mg / Isoniazid 75 mg / Pyrazinamide 400 mg / Ethambutol 275 mg Tablet Salut Selaput (KIMIA FARMA)"
                                            },
                                            "subject": {
                                                "reference": "Patient/' . $sspasien_id . '",
                                                "display": "' . $namapasien . '"
                                            },
                                            "encounter": {
                                                "reference": "Encounter/' . $ssencounter_id . '"
                                            },
                                            "authoredOn": "$",
                                            "requester": {
                                                "reference": "Practitioner/' . $sspractitioner_id . '",
                                                "display": "' . $sspractitioner_name . '"
                                            },
                                            "dosageInstruction": [
                                                {
                                                    "sequence": 1,
                                                    "text": "' . $value['description2'] . '",
                                                    "timing": {
                                                        "repeat": {
                                                            "frequency": 1, //3 kali
                                                            "period": 1, // 1 hari
                                                            "periodUnit": "d" //satuan hari nya
                                                        }
                                                    },
                                                    "route": {
                                                        "coding": [
                                                            {
                                                                "system": "http://www.whocc.no/atc",
                                                                "code": "O",
                                                                "display": "Oral"
                                                            }
                                                        ]
                                                    }
                                                }
                                            ],
                                            "dispenseRequest": {
                                                "quantity": {
                                                    "value": 120,
                                                    "unit": "TAB",
                                                    "system": "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                                                    "code": "TAB"
                                                }
                                            }
                                        }';
                    }


                    // return json_encode(in_array($batching[4]['tipe'], ['25', '27']));

                } else {
                    $parameter = $value['parameter'];
                    $parameter = json_decode($parameter, true);

                    // return json_encode($parameter['entry']);
                    if (!isset($parameter['entry'])) {
                        foreach ($parameter['entry'] as $key2 => $value2) {
                            if (isset($value2['resource']['resourceType']) == 'Condition') {
                                $isdiagnosa = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Procedure') {
                                $isprocedure = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Observation') {
                                $isexam = 'terisi';
                            }
                        }
                    }

                    $isdiagnosa = '';
                    $isprocedure = '';
                    $isexam = '';


                    $row[] = $i + 1;
                    $row[] = $value['diantar_oleh'] . "/" . $value['sspasien_id'];
                    $row[] = $value['fullname'];
                    $row[] = $value['name_of_clinic'];
                    $row[] = $value['trans_id'];
                    $row[] = $value['ssencounter_id'];
                    $row[] = $isdiagnosa;
                    $row[] = $isprocedure;
                    $row[] = $isexam;
                    $row[] = '<div id="status_' . $value['sspasien_id'] . '">' . $value['status'] . '</div>';
                    $dt_data[] = $row;
                    $i++;
                    $kunjungan[] = $select[$key];
                }
            }
        }


        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $kunjungan
        );
        echo json_encode($json_data);
    }

















    public function viewEncounterConditionInap()
    {
        $giTipe = 7;
        $title = 'Kunjungan dan Diagnosa Inap';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());

        $ea = new EmployeeAllModel();
        $dokter = $this->lowerKey($ea->where("specialist_type_id is not null")->findAll());

        $sp = new StatusPasienModel();
        $status = $this->lowerKey($sp->where("name_of_status_pasien <> ''")->findAll());

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->where("stype_id in ('1','2')")->findAll());

        // $ds = new DoctorScheduleModel();
        // $dokter = $this->lowerKey($ds->getSchedule());

        // return json_encode($dokter);
        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Kode Kunjungan RS</th>
                        <th>Kode Kunjungan Satu Sehat</th>
                        <th>Antrol</th>
                        <th>Diagnosa</th>
                        <th>Prosedur</th>
                        <th>Observasi</th>
                        <th>Status Bridging</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            // 'schedule' => $dokter,
            'dokterfill' => $dokter,
            'header' => $header
        ]);
    }
    public function viewEncounterConditionInappost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $dokter = $this->request->getPost('dokter');
        $clinic_id = $this->request->getPost('clinic_id');
        $status = $this->request->getPost('status_pasien_id');

        $dokter = $dokter ?? '%';
        // return json_encode($dokter);
        // $ea = new EmployeeAllModel();
        // $select = $this->lowerKey($ea->where("employee_id like '%$dokter%'")->orderBy("fullname")->findAll());

        $db = db_connect();
        $select = $db->query("select
                                ta.no_registration,
                                ta.diantar_oleh,
                                ta.ssencounter_id,
                                o.ssorganizationid,
                                ta.trans_id,
                                ta.visit_id,
                                p.sspasien_id,
                                p.name_of_pasien,
                                ea.sspractitioner_id,
                                ea.fullname sspractitioner_name,
                                ea.fullname,
                                replace(convert(varchar,ta.visit_date,20),' ','T')+'+07:00' as visit_date,
                                replace(convert(varchar,ta.exit_date,20),' ','T')+'+07:00' as exit_date,
                                cf.KELAS_CODE,
                                cf.KELAS_DISPLAY,
                                cuf.KELAS_CODE as UPGRADE_CODE,
                                cuf.KELAS_DISPLAY as UPGRADE_DISPLAY,
                                ckh.disposition_code,
                                ckh.disposition_display,
                                ckh.description disposition_description,
                                b.sslocationbed_id,
                                b.bed_id,
                                cr.name_of_class,
                                c.name_of_clinic,
                                ss.status,
                                ss.parameter
                                from PASIEN_VISITATION ta
                                inner join EMPLOYEE_ALL ea on ta.KDDPJP = ea.DPJP
                                inner join pasien p on ta.NO_REGISTRATION = p.NO_REGISTRATION
                                inner join CLASS_ROOM cr on ta.CLASS_ROOM_ID = cr.CLASS_ROOM_ID
                                    inner join CLASS cl on cr.CLASS_ID = cl.CLASS_ID
                                    inner join CARA_KELUAR ck on ta.KELUAR_ID = ck.KELUAR_ID
                                        inner join CARA_KELUAR_FHIR ckh on ck.disposition_code = ckh.disposition_code
                                inner join beds b on ta.BED_ID = b.BED_ID and cr.CLASS_ROOM_ID = b.CLASS_ROOM_ID
                                inner join CLASS_FHIR cf on cl.CLASS_FHIR_CODE = cf.KELAS_CODE
                                inner join clinic c on c.clinic_id = cr.clinic_id
                                inner join CLASS_UPGRADE_FHIR cuf on 
                                                                case when (case when p.class_id in (2,3,4) and (case when ta.class_id = '11' then p.class_id else ta.CLASS_ID end) > ta.class_id then p.class_id
                                                                else (case when ta.class_id = '11' then p.class_id else ta.CLASS_ID end) end) <> p.class_id then 'naik-kelas' else 'kelas-tetap' end = cuf.KELAS_CODE
                                left join satu_sehat ss on ss.trans_id = ta.trans_id,
                                ORGANIZATIONUNIT o
                                where exit_date between dateadd(day,0,'$mulai') and dateadd(day,1,'$mulai')
                                and c.clinic_id like '%$clinic_id%'
                                and ta.status_pasien_id like '%$status%'
                                and sspractitioner_id is not null
                                and ta.CLASS_ROOM_ID is not null")->getResultArray();
        $select = $this->lowerKey($select);
        // return json_encode($select);
        $dt_data = array();
        $kunjungan = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $ssfulljson = json_decode($value['parameter'], true);
                // if (false) {
                if ($value['status'] != '200') {
                    $db->query("delete from satu_sehat where trans_id = '" . $value['trans_id'] . "' and tipe = 4");
                    $ssencounter_id = $value['ssencounter_id'];
                    $ssorganizationid = $value['ssorganizationid'];
                    $trans_id = $value['trans_id'];
                    $visit_id = $value['visit_id'];
                    $sspasien_id = $value['sspasien_id'];
                    $namapasien = $value['name_of_pasien'];
                    $sspractitioner_id = $value['sspractitioner_id'];
                    $sspractitioner_name = $value['sspractitioner_name'];
                    $visit_date = $value['visit_date'];
                    $exit_date = $value['exit_date'];
                    $kelas_code = $value['kelas_code'];
                    $kelas_display = $value['kelas_display'];
                    $upgrade_code = $value['upgrade_code'];
                    $upgrade_display = $value['upgrade_display'];
                    $disposition_code = $value['disposition_code'];
                    $disposition_display = $value['disposition_display'];
                    $disposition_description = $value['disposition_description'];
                    $sslocationbed_id = $value['sslocationbed_id'];
                    $no_registration = $value['no_registration'];

                    $ss = new SatuSehat();



                    $jsonencounter = '';
                    $jsonencounter = '{
                                        "fullUrl": "urn:uuid:' . $ssencounter_id . '",
                                        "resource": {
                                            "resourceType": "Encounter",
                                            "identifier": [
                                                {
                                                    "system": "http://sys-ids.kemkes.go.id/encounter/' . $ssorganizationid . '",
                                                    "value": "' . $trans_id . '"
                                                }
                                            ],
                                            "status": "finished",
                                            "class": {
                                                "system": "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                                                "code": "IMP",
                                                "display": "inpatient encounter"
                                            },
                                            "subject": {
                                                "reference": "Patient/' . $sspasien_id . '",
                                                "display": "' . $namapasien . '"
                                            },
                                            "participant": [
                                                {
                                                    "type": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                                                    "code": "ATND",
                                                                    "display": "attender"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "individual": {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '",
                                                        "display": "' . $sspractitioner_name . '"
                                                    },
                                                    "period": {
                                                        "start": "' . $visit_date . '",
                                                        "end": "' . $exit_date . '"
                                                    }
                                                },
                                                {
                                                    "type": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                                                    "code": "ATND",
                                                                    "display": "attender"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "individual": {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '",
                                                        "display": "' . $sspractitioner_name . '"
                                                    },
                                                    "period": {
                                                        "start": "' . $visit_date . '",
                                                        "end": "' . $exit_date . '"
                                                    }
                                                }
                                            ],
                                            "period": {
                                                        "start": "' . $visit_date . '",
                                                        "end": "' . $exit_date . '"
                                                    },
                                            "location": [
                                                {
                                                    "location": {
                                                        "reference": "Location/' . $sslocationbed_id . '",
                                                        "display": "Bed' . $value['bed_id'] . ', Bangsal ' . $value['name_of_class'] . '"
                                                    },
                                                    "extension": [
                                                        {
                                                            "url": "https://fhir.kemkes.go.id/r4/StructureDefinition/ServiceClass",
                                                            "extension": [
                                                                {
                                                                    "url": "value",
                                                                    "valueCodeableConcept": {
                                                                        "coding": [
                                                                            {
                                                                                "system": "http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Inpatient",
                                                                                "code": "' . $kelas_code . '",
                                                                                "display": "' . $kelas_display . '"
                                                                            }
                                                                        ]
                                                                    }
                                                                },
                                                                {
                                                                    "url": "upgradeClassIndicator",
                                                                    "valueCodeableConcept": {
                                                                        "coding": [
                                                                            {
                                                                                "system": "http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass",
                                                                                "code": "' . $upgrade_code . '",
                                                                                "display": "' . $upgrade_display . '"
                                                                            }
                                                                        ]
                                                                    }
                                                                }
                                                            ]
                                                        }
                                                    ]
                                                }
                                            ],
                                            "diagnosis": [
                                                
                                            ],
                                            "statusHistory": [
                                                {
                                                    "status": "in-progress",
                                                    "period": {
                                                        "start": "' . $visit_date . '",
                                                        "end": "' . $exit_date . '"
                                                    }
                                                },
                                                {
                                                    "status": "finished",
                                                    "period": {
                                                        "start": "' . $exit_date . '",
                                                        "end": "' . $exit_date . '"
                                                    }
                                                }
                                            ],
                                            "hospitalization": {
                                                "dischargeDisposition": {
                                                    "coding": [
                                                        {
                                                            "system": "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                                                            "code": "' . $disposition_code . '",
                                                            "display": "' . $disposition_display . '"
                                                        }
                                                    ],
                                                    "text": "' . $disposition_description . '"
                                                }
                                            },
                                            "serviceProvider": {
                                                "reference": "Organization/' . $ssorganizationid . '"
                                            }
                                        },
                                        "request": {
                                            "method": "POST",
                                            "url": "Encounter"
                                        }
                                    }';
                    $jsonencounter = json_decode($jsonencounter, true);
                    // return json_encode(in_array($batching[4]['tipe'], ['25', '27']));
                    $iscontinue = false;

                    if (true) {
                        $ssjson = array();

                        $sscondition = array();
                        $condition = $db->query('select pds.diagnosa_id, pds.diagnosa_name, pds.sscondition_id from pasien_diagnosa pd inner join pasien_diagnosas pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id
                        where visit_id = \'' . $visit_id . '\'')->getResultArray();

                        foreach ($condition as $key1 => $value1) {
                            $jsonencounter['resource']['diagnosis'][] = json_decode('{
                                            "condition": {
                                                "reference": "urn:uuid:' . $value1['sscondition_id'] . '",
                                                "display": "' . $value1['diagnosa_name'] . '"
                                            },
                                            "use": {
                                                "coding": [
                                                    {
                                                        "system": "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                                        "code": "DD",
                                                        "display": "Discharge diagnosis"
                                                    }
                                                ]
                                            },
                                            "rank": ' . (string)($key + 1) . '
                                        }', true);
                        }
                        $ssjson[] = $jsonencounter;
                        foreach ($condition as $key1 => $value1) {
                            $sscondition = '{
                                "fullUrl": "urn:uuid:' . $value1['sscondition_id'] . '",
                                "resource": {
                                    "resourceType": "Condition",
                                    "clinicalStatus": {
                                        "coding": [
                                            {
                                                "system": "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                                "code": "active",
                                                "display": "Active"
                                            }
                                        ]
                                    },
                                    "category": [
                                        {
                                            "coding": [
                                                {
                                                    "system": "http://terminology.hl7.org/CodeSystem/condition-category",
                                                    "code": "encounter-diagnosis",
                                                    "display": "Encounter Diagnosis"
                                                }
                                            ]
                                        }
                                    ],
                                    "code": {
                                        "coding": [
                                            {
                                                "system": "http://hl7.org/fhir/sid/icd-10",
                                                "code": "' . $value1['diagnosa_id'] . '",
                                                "display": "' . $value1['diagnosa_name'] . '"
                                            }
                                        ]
                                    },
                                    "subject": {
                                        "reference": "Patient/' . $value['sspasien_id'] . '",
                                        "display": "Budi Santoso"
                                    },
                                    "encounter": {
                                        "reference": "urn:uuid:' . $ssencounter_id . '",
                                        "display": "Kunjungan ' . $value['name_of_pasien'] . '"
                                    }
                                },
                                "request": {
                                    "method": "POST",
                                    "url": "Condition"
                                }
                            }';
                            $sscondition = json_decode($sscondition, true);
                            $ssjson[] = $sscondition;
                        }

                        $isprocedure = '';

                        if (isset($condition[0])) {
                            $procedures = $db->query("select pds.diagnosa_id, pds.diagnosa_name, pds.ssprocedure_id from pasien_diagnosa pd inner join pasien_procedures pds on pd.pasien_diagnosa_id = pds.pasien_diagnosa_id where visit_id = '$visit_id'")->getResultArray();
                            foreach ($procedures as $pkey => $pvalue) {
                                $ssprocedure = '{
                                                    "fullUrl": "urn:uuid:' . $pvalue['ssprocedure_id'] . '",
                                                    "resourceType": "Procedure",
                                                    "status": "completed",
                                                    "category": {
                                                        "coding": [
                                                            {
                                                                "system": "http://snomed.info/sct",
                                                                "code": "103693007",
                                                                "display": "Diagnostic procedure"
                                                            }
                                                        ],
                                                        "text": "Diagnostic procedure"
                                                    },
                                                    "code": {
                                                        "coding": [
                                                            {
                                                                "system": "http://hl7.org/fhir/sid/icd-9-cm",
                                                                "code": "' . $pvalue['diagnosa_id'] . '",
                                                                "display": "' . $pvalue['diagnosa_name'] . '"
                                                            }
                                                        ]
                                                    },
                                                    "subject": {
                                                        "reference": "Patient/' . $sspasien_id . '",
                                                        "display": "Budi Santoso"
                                                    },
                                                    "encounter": {
                                                        "reference": "Encounter/' . $ssencounter_id . '",
                                                        "display": "Tindakan ' . $pvalue['diagnosa_name'] . '"
                                                    },
                                                    "performedPeriod": {
                                                                            "start": "' . $visit_date . '",
                                                                            "end": "' . $exit_date . '"
                                                                        },
                                                    "performer": [
                                                        {
                                                            "actor": {
                                                                "reference": "Practitioner/' . $sspractitioner_id . '",
                                                                "display": "' . $sspractitioner_name . '"
                                                            }
                                                        }
                                                    ],
                                                    "reasonCode": [
                                                        {
                                                            "coding": [
                                                                {
                                                                    "system": "http://hl7.org/fhir/sid/icd-10",
                                                                    "code": "' . $condition[0]['diagnosa_id'] . '",
                                                                    "display": "' . $condition[0]['diagnosa_name'] . '"
                                                                }
                                                            ]
                                                        }
                                                    ]
                                                }';
                                $ssprocedure = json_decode($ssprocedure, true);
                                $ssjson[] = $ssprocedure;
                                $isprocedure = 'terisi';
                            }
                        }


                        $exam = $this->lowerKey($db->query("select replace(convert(varchar,examination_date,20),' ','T')+'+07:00' as examination_date, nadi, newid() as nadi_id, nafas,  newid() as nafas_id, temperature, newid() as temperature_id, tension_upper, newid() as tension_upper_id, tension_below, newid() as tension_below_id, weight, newid() as weight_id, height, newid() as height_id from examination_info
                        where visit_id = '" . $visit_id . "'")->getResultArray());
                        $isexam = '';

                        if (isset($exam[0])) {
                            $examvalue = $exam[0];
                            if ($examvalue['nadi'] != null && $examvalue['nadi'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['nadi_id'] . '",
                                                "resourceType": "Observation",
                                                "status": "final",
                                                "category": [
                                                    {
                                                        "coding": [
                                                            {
                                                                "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                "code": "vital-signs",
                                                                "display": "Vital Signs"
                                                            }
                                                        ]
                                                    }
                                                ],
                                                "code": {
                                                    "coding": [
                                                        {
                                                            "system": "http://loinc.org",
                                                            "code": "8867-4",
                                                            "display": "Heart rate"
                                                        }
                                                    ]
                                                },
                                                "subject": {
                                                    "reference": "Patient/' . $sspasien_id . '"
                                                },
                                                "performer": [
                                                    {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '"
                                                    }
                                                ],
                                                "encounter": {
                                                    "reference": "Encounter/' . $ssencounter_id . '",
                                                    "display": "Pemeriksaan Nadi' . $namapasien . '"
                                                },
                                                "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                "issued": "' . $examvalue['examination_date'] . '",
                                                "valueQuantity": {
                                                    "value": ' . $examvalue['nadi'] . ',
                                                    "unit": "beats/minute",
                                                    "system": "http://unitsofmeasure.org",
                                                    "code": "/min"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['nafas'] != null && $examvalue['nafas'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['nafas_id'] . '",
                                                "resourceType": "Observation",
                                                "status": "final",
                                                "category": [
                                                    {
                                                        "coding": [
                                                            {
                                                                "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                "code": "vital-signs",
                                                                "display": "Vital Signs"
                                                            }
                                                        ]
                                                    }
                                                ],
                                                "code": {
                                                    "coding": [
                                                        {
                                                            "system": "http://loinc.org",
                                                            "code": "9279-1",
                                                            "display": "Respiratory rate"
                                                        }
                                                    ]
                                                },
                                                "subject": {
                                                    "reference": "Patient/' . $sspasien_id . '"
                                                },
                                                "performer": [
                                                    {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '"
                                                    }
                                                ],
                                                "encounter": {
                                                    "reference": "Encounter/' . $ssencounter_id . '",
                                                    "display": "Pemeriksaan Nafas' . $namapasien . '"
                                                },
                                                "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                "issued": "' . $examvalue['examination_date'] . '",
                                                "valueQuantity": {
                                                    "value": ' . $examvalue['nafas'] . ',
                                                    "unit": "breaths/minute",
                                                    "system": "http://unitsofmeasure.org",
                                                    "code": "/min"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['tension_upper'] != null && $examvalue['tension_upper'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['tension_upper_id'] . '",
                                                "resourceType": "Observation",
                                                "status": "final",
                                                "category": [
                                                    {
                                                        "coding": [
                                                            {
                                                                "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                "code": "vital-signs",
                                                                "display": "Vital Signs"
                                                            }
                                                        ]
                                                    }
                                                ],
                                                "code": {
                                                    "coding": [
                                                        {
                                                            "system": "http://loinc.org",
                                                            "code": "8480-6",
                                                            "display": "Systolic blood pressure"
                                                        }
                                                    ]
                                                },
                                                "subject": {
                                                    "reference": "Patient/' . $sspasien_id . '"
                                                },
                                                "performer": [
                                                    {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '"
                                                    }
                                                ],
                                                "encounter": {
                                                    "reference": "Encounter/' . $ssencounter_id . '",
                                                    "display": "Pemeriksaan Sistol' . $namapasien . '"
                                                },
                                                "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                "issued": "' . $examvalue['examination_date'] . '",
                                                "bodySite": {
                                                    "coding": [
                                                        {
                                                            "system": "http://snomed.info/sct",
                                                            "code": "368209003",
                                                            "display": "Right arm"
                                                        }
                                                    ]
                                                },
                                                "valueQuantity": {
                                                    "value": ' . $examvalue['tension_upper'] . ',
                                                    "unit": "mm[Hg]",
                                                    "system": "http://unitsofmeasure.org",
                                                    "code": "mm[Hg]"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['tension_below'] != null && $examvalue['tension_below'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['tension_below_id'] . '",
                                                "resourceType": "Observation",
                                                "status": "final",
                                                "category": [
                                                    {
                                                        "coding": [
                                                            {
                                                                "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                "code": "vital-signs",
                                                                "display": "Vital Signs"
                                                            }
                                                        ]
                                                    }
                                                ],
                                                "code": {
                                                    "coding": [
                                                        {
                                                            "system": "http://loinc.org",
                                                            "code": "8462-4",
                                                            "display": "Diastolic blood pressure"
                                                        }
                                                    ]
                                                },
                                                "subject": {
                                                    "reference": "Patient/' . $sspasien_id . '"
                                                },
                                                "performer": [
                                                    {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '"
                                                    }
                                                ],
                                                "encounter": {
                                                    "reference": "Encounter/' . $ssencounter_id . '",
                                                    "display": "Pemeriksaan Diastol' . $namapasien . '"
                                                },
                                                "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                "issued": "' . $examvalue['examination_date'] . '",
                                                "bodySite": {
                                                    "coding": [
                                                        {
                                                            "system": "http://snomed.info/sct",
                                                            "code": "368209003",
                                                            "display": "Right arm"
                                                        }
                                                    ]
                                                },
                                                "valueQuantity": {
                                                    "value": ' . $examvalue['tension_below'] . ',
                                                    "unit": "mm[Hg]",
                                                    "system": "http://unitsofmeasure.org",
                                                    "code": "mm[Hg]"
                                                }
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            if ($examvalue['temperature'] != null && $examvalue['temperature'] != '') {
                                $ssexam = '{
                                                "fullUrl": "urn:uuid:' . $examvalue['temperature_id'] . '",
                                                "resourceType": "Observation",
                                                "status": "final",
                                                "category": [
                                                    {
                                                        "coding": [
                                                            {
                                                                "system": "http://terminology.hl7.org/CodeSystem/observation-category",
                                                                "code": "vital-signs",
                                                                "display": "Vital Signs"
                                                            }
                                                        ]
                                                    }
                                                ],
                                                "code": {
                                                    "coding": [
                                                        {
                                                            "system": "http://loinc.org",
                                                            "code": "8310-5",
                                                            "display": "Body temperature"
                                                        }
                                                    ]
                                                },
                                                "subject": {
                                                    "reference": "Patient/' . $sspasien_id . '"
                                                },
                                                "performer": [
                                                    {
                                                        "reference": "Practitioner/' . $sspractitioner_id . '"
                                                    }
                                                ],
                                                "encounter": {
                                                    "reference": "Encounter/' . $ssencounter_id . '",
                                                    "display": "Pemeriksaan Suhu' . $namapasien . '"
                                                },
                                                "effectiveDateTime": "' . $examvalue['examination_date'] . '",
                                                "issued": "' . $examvalue['examination_date'] . '",
                                                "valueQuantity": {
                                                    "value": ' . $examvalue['temperature'] . ',
                                                    "unit": "C",
                                                    "system": "http://unitsofmeasure.org",
                                                    "code": "Cel"
                                                },
                                            }';
                                $ssjson[] = json_decode($ssexam, true);
                            }
                            $isexam = 'terisi';
                        }

















                        $ssfulljson['resourceType'] = 'Bundle';
                        $ssfulljson['type'] = 'transaction';
                        $ssfulljson['entry'] = $ssjson;


                        $db = db_connect();
                        try {
                            $result = $db->query("insert into satu_sehat(no_registration, trans_id, url, method, parameter, created_date, modified_date, tipe, waktu)
                            values('$no_registration','$trans_id','" . $this->baseurlfhir . "','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'6',getdate())");
                            // return json_encode($result);
                        } catch (\Exception $e) {
                            exit($e->getMessage());
                        }

                        $select[$key]['parameter'] = json_encode($ssfulljson);
                        $select[$key]['isdiagnosa'] = null;
                        $select[$key]['url'] = $this->baseurlfhir;
                        $isdiagnosa = '';
                        if (isset($ssfulljson['entry'])) {
                            foreach ($ssfulljson['entry'] as $key2 => $value2) {
                                // return json_encode($value2);
                                if (isset($value2['resource']['resourceType'])) {
                                    if ($value2['resource']['resourceType'] == 'Condition') {
                                        $isdiagnosa = "terisi";
                                        $select[$key]['isdiagnosa'] = $isdiagnosa;
                                    }
                                }
                            }
                        }
                        $select[$key]['isdiagnosa'] = $isdiagnosa;
                        $select[$key]['isprocedure'] = $isprocedure;
                        $select[$key]['isexam'] = $isexam;
                        // return json_encode("insert into satu_sehat(no_registration, trans_id, url, method, parameter, created_date, modified_date, tipe, waktu)
                        //     values('$no_registration','$trans_id','" . $this->baseurlfhir . "','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'4',getdate())");
                        $row[] = $i + 1;
                        $row[] = $value['diantar_oleh'] . "/" . $value['sspasien_id'];
                        $row[] = $value['fullname'];
                        $row[] = $value['name_of_clinic'];
                        $row[] = $value['trans_id'];
                        $row[] = $value['ssencounter_id'];
                        $row[] = $iscontinue;
                        $row[] = $isdiagnosa;
                        $row[] = $isprocedure;
                        $row[] = $isexam;
                        $row[] = '<div id="status_' . $value['sspasien_id'] . '">' . $value['status'] . '</div>';
                        $dt_data[] = $row;
                        $i++;
                        $kunjungan[] = $select[$key];
                    }
                } else {
                    $parameter = $value['parameter'];
                    $parameter = json_decode($parameter, true);

                    // return json_encode($parameter['entry']);
                    if (!isset($parameter['entry'])) {
                        foreach ($parameter['entry'] as $key2 => $value2) {
                            if (isset($value2['resource']['resourceType']) == 'Condition') {
                                $isdiagnosa = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Procedure') {
                                $isprocedure = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Observation') {
                                $isexam = 'terisi';
                            }
                        }
                    }

                    $isdiagnosa = '';
                    $isprocedure = '';
                    $isexam = '';


                    $row[] = $i + 1;
                    $row[] = $value['diantar_oleh'] . "/" . $value['sspasien_id'];
                    $row[] = $value['fullname'];
                    $row[] = $value['name_of_clinic'];
                    $row[] = $value['trans_id'];
                    $row[] = $value['ssencounter_id'];
                    $row[] = $isdiagnosa;
                    $row[] = $isprocedure;
                    $row[] = $isexam;
                    $row[] = '<div id="status_' . $value['sspasien_id'] . '">' . $value['status'] . '</div>';
                    $dt_data[] = $row;
                    $i++;
                    $kunjungan[] = $select[$key];
                }
            }
        }


        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $kunjungan
        );
        echo json_encode($json_data);
    }


    public function viewServiceRequest()
    {
        $giTipe = 7;
        $title = 'Kunjungan dan Diagnosa Inap';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['satusehat'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->orderBy("name_of_clinic")->findAll());

        $ea = new EmployeeAllModel();
        $dokter = $this->lowerKey($ea->where("specialist_type_id is not null")->findAll());

        $sp = new StatusPasienModel();
        $status = $this->lowerKey($sp->where("name_of_status_pasien <> ''")->findAll());

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->where("stype_id in ('1','2')")->findAll());

        // $ds = new DoctorScheduleModel();
        // $dokter = $this->lowerKey($ds->getSchedule());

        // return json_encode($dokter);
        $header = [];
        $header =
            '<tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Tanggal Permintaan</th>
                    </tr>';

        return view('admin\satusehat\ssview', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            // 'schedule' => $dokter,
            'dokterfill' => $dokter,
            'header' => $header
        ]);
    }
    public function viewServiceRequestpost()
    {

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $dokter = $this->request->getPost('dokter');
        $clinic_id = $this->request->getPost('clinic_id');
        $status = $this->request->getPost('status_pasien_id');

        $dokter = $dokter ?? '%';
        // return json_encode($dokter);
        // $ea = new EmployeeAllModel();
        // $select = $this->lowerKey($ea->where("employee_id like '%$dokter%'")->orderBy("fullname")->findAll());

        $db = db_connect();
        $labtype = $db->query("select * from laborat_type")->getResultArray();
        $labtype = $this->lowerKey($labtype);

        $select = $db->query("select * from pasien_visitation pv ")->getResultArray();
        $select = $this->lowerKey($select);
        // return json_encode($select);
        $dt_data = array();
        $kunjungan = array();

        if (!empty($select)) {
            $kunjbaru = [];
            $i = 0;

            foreach ($select as $key => $value) {
                $row = [];
                $ssfulljson = json_decode($value['parameter'], true);
                // if (false) {
                if ($value['status'] != '200') {
                    $db->query("delete from satu_sehat where trans_id = '" . $value['trans_id'] . "' and tipe = 4");
                    $id = $value['id'];
                    $ssencounter_id = $value['ssencounter_id'];
                    $sspasien_id = $value['sspasien_id'];
                    $ssorganizationid = $value['ssorganizationid'];
                    $vactination_id = $value['$vactination_id'];
                    $sspractitioner_idreq  = $value['sspractitioner_idreq'];
                    $fullnamereq = $value['fullnamereq'];
                    $sspractitioner_id  = $value['sspractitioner_id'];
                    $fullname = $value['fullname'];
                    $namapasien = $value['name_of_pasien'];
                    $description = $value['description'];

                    $ss = new SatuSehat();



                    $jsonencounter = '';
                    $jsonencounter = '{
                                        "fullUrl": "urn:uuid:' . $id . '",
                                        "resource": {
                                            "resourceType": "ServiceRequest",
                                            "identifier": [
                                                {
                                                    "system": "http://sys-ids.kemkes.go.id/servicerequest/' . $ssorganizationid . '",
                                                    "value": "' . $vactination_id . '"
                                                }
                                            ],
                                            "status": "active",
                                            "intent": "original-order",
                                            // "priority": "routine",
                                            "category": [
                                                {
                                                    "coding": [
                                                        {
                                                            "system": "http://snomed.info/sct",
                                                            "code": "108252007",
                                                            "display": "Laboratory procedure"
                                                        }
                                                    ]
                                                }
                                            ],
                                            "code": {
                                                "coding": [
                                                    {
                                                        "system": "http://loinc.org",
                                                        "code": "11477-7",
                                                        "display": "Microscopic observation [Identifier] in Sputum by Acid fast stain"
                                                    }
                                                ],
                                                "text": "Pemeriksaan Sputum BTA"
                                            },
                                            "subject": {
                                                "reference": "Patient/' . $sspasien_id . '"
                                            },
                                            "encounter": {
                                                "reference": "Encounter/' . $ssencounter_id . '",
                                                "display": "Permintaan BTA Sputum Budi Santoso di tanggakl 14 Juli 2023 pukul 09:30 WIB"
                                            },
                                            "occurrenceDateTime": "2022-11-14T16:00:00+00:00",
                                            "authoredOn": "2022-11-13T19:30:00+00:00",
                                            "requester": {
                                                "reference": "Practitioner/' . $sspractitioner_idreq . '",
                                                "display": "' . $fullnamereq . '"
                                            },
                                            "performer": [
                                                {
                                                    "reference": "Practitioner/' . $sspractitioner_id . '", //dokter pembaca
                                                    "display": "' . $fullname . '"
                                                }
                                            ],
                                            "reasonCode": [
                                                {
                                                    "text": "' . $description . '"
                                                }
                                            ]
                                        },
                                        "request": {
                                            "method": "POST",
                                            "url": "ServiceRequest"
                                        }
                                    }';
                    $jsonencounter = json_decode($jsonencounter, true);
                    // return json_encode(in_array($batching[4]['tipe'], ['25', '27']));
                    $iscontinue = false;
                } else {
                    $parameter = $value['parameter'];
                    $parameter = json_decode($parameter, true);

                    // return json_encode($parameter['entry']);
                    if (!isset($parameter['entry'])) {
                        foreach ($parameter['entry'] as $key2 => $value2) {
                            if (isset($value2['resource']['resourceType']) == 'Condition') {
                                $isdiagnosa = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Procedure') {
                                $isprocedure = 'terisi';
                            }
                            if (isset($value2['resource']['resourceType']) == 'Observation') {
                                $isexam = 'terisi';
                            }
                        }
                    }

                    $isdiagnosa = '';
                    $isprocedure = '';
                    $isexam = '';


                    $row[] = $i + 1;
                    $row[] = $value['diantar_oleh'] . "/" . $value['sspasien_id'];
                    $row[] = $value['fullname'];
                    $row[] = $value['name_of_clinic'];
                    $row[] = $value['trans_id'];
                    $row[] = $value['ssencounter_id'];
                    $row[] = $isdiagnosa;
                    $row[] = $isprocedure;
                    $row[] = $isexam;
                    $row[] = '<div id="status_' . $value['sspasien_id'] . '">' . $value['status'] . '</div>';
                    $dt_data[] = $row;
                    $i++;
                    $kunjungan[] = $select[$key];
                }
            }
        }


        $json_data = array(
            "body" => $dt_data,
            "jsonData" => $kunjungan
        );
        echo json_encode($json_data);
    }
}
