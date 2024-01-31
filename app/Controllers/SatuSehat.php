<?php

namespace App\Controllers;

use App\Models\BatchingBridgingModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use App\Models\SatuSehatModel;
use Firebase\JWT\JWT;
use Myth\Auth\Models\UserModel;


class SatuSehat extends BaseController
{

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
        return json_encode($pasien);



        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid, sstoken")->find("1771014"));
        $token = $select['sstoken'];
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
                        'Authorization: Bearer ' . $token
                    ),
                ));

                $response = curl_exec($curl);
                $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $response = json_decode($response, true);

                curl_close($curl);
                // return json_encode($httpcode);

                if ($httpcode == 401) {
                    $token = $this->getToken();
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
                            'Authorization: Bearer ' . $token
                        ),
                    ));

                    $response = curl_exec($curl);
                    $response = json_decode($response, true);

                    $return[] = $response;

                    curl_close($curl);
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
        $token = json_decode($this->getToken(), true);
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
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            $response = json_decode($response, true);
            $return[] = $response;
            // return json_encode($response);

            foreach ($response["entry"] as $key1 => $value1) {
                $id = ($value1['resource']['id']);
                if (isset($id)) {
                    // return json_encode($id);
                    $c->update($value1['resource']['identifier'][0]['value'], [
                        'ssclinic_id' => $id
                    ]);
                }
            }
            curl_close($curl);
        }


        return json_encode($return);
    }
    public function postOrganization()
    {
        $token = json_decode($this->getToken(), true);
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
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);
            return json_encode($value);

            $response = json_decode($response, true);
            $return[] = $response;

            curl_close($curl);
            // return json_encode($response);
            if (isset($response['id'])) {
                $c->update($clinic[$key]['clinic_id'], [
                    'ssclinic_id' => $response['id']
                ]);
            }
        }

        return json_encode($return);
    }

    public function getLocation()
    {
        $token = json_decode($this->getToken(), true);

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
                    'Authorization: Bearer ' . $token
                ),
            ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;

            curl_close($curl);
            // $c->set('sslocation_id', $response['id'])->update($clinic[$key]['clinic_id']);
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
        }
        return json_encode($return);
    }
    public function postLocation()
    {
        $token = json_decode($this->getToken(), true);

        $c = new ClinicModel();
        // $clinic = $this->lowerKey($c->select("*")->orderBy('clinic_id OFFSET 20 ROWS
        // FETCH NEXT 30 ROWS ONLY')->findAll());
        $db = db_connect();
        $clinic = $this->lowerKey($db->query("select * from  clinic
        where sslocation_id is null
        order by CLINIC_ID
        OFFSET 0 ROWS
        FETCH NEXT 100 ROWS ONLY;
        ")->getResultArray());
        // return json_encode($clinic);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
        $ssorgid = $select['ssorganizationid'];
        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => $this->baseurlfhir . '/Location',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS => '{
            //                             "resourceType": "Location",
            //                             "identifier": [
            //                                 {
            //                                     "system": "http://sys-ids.kemkes.go.id/location/' . $ssorgid . '",
            //                                     "value": "' . $clinic[$key]['clinic_id'] . '"
            //                                 }
            //                             ],
            //                             "status": "active",
            //                             "name": "Poli Dalam",
            //                             "description": "' . $clinic[$key]['name_of_clinic'] . '",
            //                             "mode": "instance",


            //                             "physicalType": {
            //                                 "coding": [
            //                                     {
            //                                         "system": "http://terminology.hl7.org/CodeSystem/location-physical-type",
            //                                         "code": "ro",
            //                                         "display": "Room"
            //                                     }
            //                                 ]
            //                             },





            //                             "managingOrganization": {
            //                                 "reference": "Organization/' . $clinic[$key]['ssclinic_id'] . '"
            //                             }
            //                         }',
            //     CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/json',
            //         'Authorization: Bearer ' . $token
            //     ),
            // ));
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
                    'Authorization: Bearer ' . $token
                ),
            ));

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => $this->baseurlfhir . '/Location/' . $value['sslocation_id'],
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'PUT',
            //     CURLOPT_POSTFIELDS => '{
            //       "resourceType": "Location",
            //       "id": "' . $value['sslocation_id'] . '",
            //       "identifier": [
            //           {
            //               "system": "http://sys-ids.kemkes.go.id/location/' . $ssorgid . '",
            //               "value": "' . $value['clinic_id'] . '"
            //           }
            //       ],
            //       "status": "active",
            //       "name": "' . $value['name_of_clinic'] . '",
            //       "description": "' . $value['name_of_clinic'] . '",
            //       "mode": "instance",
            //       "physicalType": {
            //           "coding": [
            //               {
            //                   "system": "http://terminology.hl7.org/CodeSystem/location-physical-type",
            //                   "code": "ro",
            //                   "display": "Room"
            //               }
            //           ]
            //       },
            //       "managingOrganization": {
            //           "reference": "Organization/' . $clinic[$key]['ssclinic_id'] . '"
            //       }
            //   }',
            //     CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/json',
            //         'Authorization: Bearer ' . $token
            //     ),
            // ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;

            curl_close($curl);
            // $c->set('sslocation_id', $response['id'])->update($clinic[$key]['clinic_id']);
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
        }
        return json_encode($return);
    }
    public function postPractitioner()
    {
        $token = json_decode($this->getToken(), true);

        $c = new ClinicModel();
        // $clinic = $this->lowerKey($c->select("*")->orderBy('clinic_id OFFSET 20 ROWS
        // FETCH NEXT 30 ROWS ONLY')->findAll());
        $db = db_connect();
        $clinic = $this->lowerKey($db->query("select * from  clinic
        order by CLINIC_ID
        OFFSET 0 ROWS
        FETCH NEXT 100 ROWS ONLY;
        ")->getResultArray());
        // return json_encode($clinic);
        $org = new OrganizationunitModel();
        $select = $this->lowerKey($org->select("ssorganizationid")->find("1771014"));
        $ssorgid = $select['ssorganizationid'];
        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Location',
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
                                                "system": "http://sys-ids.kemkes.go.id/location/100026655",
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
                    'Authorization: Bearer ' . $token
                ),
            ));
            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Location?organization='.$value['ssclinic_id'],
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'GET',
            //     CURLOPT_HTTPHEADER => array(
            //       'Authorization: Bearer '.$token
            //     ),
            //   ));

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => $this->baseurlfhir . '/Location/' . $value['sslocation_id'],
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'PUT',
            //     CURLOPT_POSTFIELDS => '{
            //       "resourceType": "Location",
            //       "id": "' . $value['sslocation_id'] . '",
            //       "identifier": [
            //           {
            //               "system": "http://sys-ids.kemkes.go.id/location/' . $ssorgid . '",
            //               "value": "' . $value['clinic_id'] . '"
            //           }
            //       ],
            //       "status": "active",
            //       "name": "' . $value['name_of_clinic'] . '",
            //       "description": "' . $value['name_of_clinic'] . '",
            //       "mode": "instance",
            //       "physicalType": {
            //           "coding": [
            //               {
            //                   "system": "http://terminology.hl7.org/CodeSystem/location-physical-type",
            //                   "code": "ro",
            //                   "display": "Room"
            //               }
            //           ]
            //       },
            //       "managingOrganization": {
            //           "reference": "Organization/' . $clinic[$key]['ssclinic_id'] . '"
            //       }
            //   }',
            //     CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/json',
            //         'Authorization: Bearer ' . $token
            //     ),
            // ));


            $response = curl_exec($curl);
            $response = json_decode($response, true);

            $return[] = $response;

            curl_close($curl);
            // $c->set('sslocation_id', $response['id'])->update($clinic[$key]['clinic_id']);
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
        }
        return json_encode($return);
    }
    public function postEncounter()
    {

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $ssToken = $this->request->getHeaderLine("ssToken");

        // $response = '"{\"class\":{\"code\":\"AMB\",\"display\":\"ambulatory\",\"system\":\"http:\/\/terminology.hl7.org\/CodeSystem\/v3-ActCode\"},\"id\":\"3a53a4e3-ef73-463f-b5f0-2d8dfcb76f83\",\"identifier\":[{\"system\":\"http:\/\/sys-ids.kemkes.go.id\/encounter\/100026655\",\"value\":\"20231220P001846202\"}],\"location\":[{\"location\":{\"display\":\"DALAM\",\"reference\":\"Location\/f316828e-065b-41a2-8dc0-837a630379be\"}}],\"meta\":{\"lastUpdated\":\"2023-12-20T03:07:41.903805+00:00\",\"versionId\":\"MTcwMzA0MTY2MTkwMzgwNTAwMA\"},\"participant\":[{\"individual\":{\"display\":\"YANDI KURNIAWAN, dr, Sp.PD\",\"reference\":\"Practitioner\/10009880728\"},\"type\":[{\"coding\":[{\"code\":\"ATND\",\"display\":\"attender\",\"system\":\"http:\/\/terminology.hl7.org\/CodeSystem\/v3-ParticipationType\"}]}]}],\"period\":{\"start\":\"2023-12-20T09:54:00+07:00\"},\"resourceType\":\"Encounter\",\"serviceProvider\":{\"reference\":\"Organization\/100026655\"},\"status\":\"arrived\",\"statusHistory\":[{\"period\":{\"start\":\"2023-12-20T09:54:00+07:00\"},\"status\":\"arrived\"}],\"subject\":{\"display\":\"SAIMAN\",\"reference\":\"Patient\/P02478375538\"}}"';
        // $response = json_decode($response, true);
        // $response = json_decode($response, true);
        // return json_encode($response);

        // $select = DB::select("select ss_patient_id, name_of_pasien from pasien where no_registration = '$noRegistration'");
        // $select = json_decode(json_encode($select), true);

        // $selectToken = DB::select("select token from ss_organization");
        // $selectToken = json_decode(json_encode($selectToken), true);
        // $token = $selectToken[0]['token'];

        // $pasienId = $select[0]['ss_patient_id'];
        // $pasienName = $select[0]['name_of_pasien'];
        // $visitId = $body['visit_id'];



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
    public function postBundleEncounter()
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
    public function generateBundleEncounter()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $ssToken = $this->request->getHeaderLine("ssToken");
        $db = db_connect();

        $select = $db->query("select ssencounter_id, sslocation_id, name_of_clinic as sslocation_name,sspractitioner_id,replace(fullname,'''','') as sspractitioner_name, ssencounter_id, ssorganizationid, visit_id, trans_id, no_registration from pasien_visitation pv
                                inner join clinic c on c.clinic_id = pv.clinic_id
                                inner join employee_all ea on ea.employee_id = pv.employee_id
                                inner join ORGANIZATIONUNIT o on o.ORG_UNIT_CODE = pv.ORG_UNIT_CODE
                                where visit_date between dateadd(day,-4,getdate()) and dateadd(day,-3,getdate()) and pv.trans_id not in (select trans_id from satu_sehat)
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
                    values('$no_registration','$trans_id','$this->baseurlfhir','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'4',getdate())");
                } catch (\Exception $e) {
                    // exit($e->getMessage());
                }
            }
        }

        return json_encode("selesai");
    }
    public function postingBatch()
    {
        $ss = new SatuSehatModel();
        $satusehat = $this->lowerKey($ss->where('status', null)->where('parameter is not null')->orderBy("trans_id, waktu")->findAll());        // return json_encode($satusehat);

        // $ssToken = $this->request->getHeaderLine("ssToken");
        $ssToken = json_decode($this->getToken(), true);
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


            $response = curl_exec($curl);
            $db->query("update satu_sehat set status = '200', result = '" . $response . "' where trans_id = '" . $value['trans_id'] . "' and tipe = '" . $value['tipe'] . "'");

            curl_close($curl);
        }
    }
}
