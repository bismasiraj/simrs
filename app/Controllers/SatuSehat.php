<?php

namespace App\Controllers;

use App\Models\BatchingBridgingModel;
use App\Models\ClinicModel;
use App\Models\DoctorScheduleModel;
use App\Models\EmployeeAllModel;
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
        $org->update("1771014", ["sstoken" => $token]);
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
        $ssToken = $select['sstoken'];
        // return json_encode($token);

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->select("replace(name_of_clinic,' ','%20') as name_of_clinic, clinic_id")->where("ssclinic_id is null")->findAll());

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
        $ssToken = $select['sstoken'];
        // return json_encode($token);

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->select("*")->where("ssclinic_id is null")->findAll());
        // return json_encode($clinic);

        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
    public function viewLocationpost()
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
                $row[] = '<div id="clinic_id_' . $value['clinic_id'] . '">' . $value['sslocation_id'];
                // $row[] = $value['visit_date'];
                $row[] = $value['name_of_clinic'];
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
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
}
