<?php

namespace App\Controllers;

use App\Models\BatchingBridgingModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use App\Models\SatuSehatModel;
use Firebase\JWT\JWT;
use Myth\Auth\Models\UserModel;


class SatuSehat extends BaseController
{

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
            CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'client_id=BkpwobIdxkl80VHGH1fnlAJANpmPONwGdWGVKMYkF8OV94Ov&client_secret=YPGGSATBSbqjec8MuDIGZEy03gYGZGsYa0EGAnkWAMsj5fnTaAs0Z9dXaQUFHui3',
            CURLOPT_HTTPHEADER => array(
                // 'Authorization: Bearer LA6Fj2oGDjACsnNuBoOCQHItAlIK',
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode(($response), true);
        $token = $result['access_token'];
        return json_encode($token);
        // DB::update(
        //     "Update ss_organization
        // set token = '$token'
        // where client_id  = 'aFGn978X1u07Gep2g945rS8zjawAsKH1hz7536kcCalgeaug'"
        // );
        // return response()
        //     ->json($result)
        //     ->header('Access-Control-Allow-Origin', '*')
        //     ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    public function getPasienID()
    {
        $ssToken = $this->request->getHeaderLine("ssToken");
        $curl = curl_init();

        // return json_encode(trim($ssToken));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Patient?identifier=https%3A%2F%2Ffhir.kemkes.go.id%2Fid%2Fnik%7C9271060312000001',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer $ssToken"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);
        // echo $response;


        if (!isset($response['entry']['0']['resource']['id'])) {
            return response()->setStatusCode(401);
        } else {
            return json_encode($response['entry']['0']['resource']['id']);
        }
    }
    public function postOrganization()
    {
        $token = json_decode($this->getToken(), true);
        // return json_encode($token);

        $c = new ClinicModel();
        $clinic = $this->lowerKey($c->select("*")->where("ssclinic_id is null")->findAll());

        $return = [];

        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Organization',
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
                                                "system": "http://sys-ids.kemkes.go.id/organization/913e8e48-48d9-46de-b13f-c909d5f71690",
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
                                            "reference": "Organization/913e8e48-48d9-46de-b13f-c909d5f71690"
                                        }
                                    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);
            // return $response;

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
    public function postLocation()
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
        foreach ($clinic as $key => $value) {
            $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Location',
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
            //                                     "system": "http://sys-ids.kemkes.go.id/location/913e8e48-48d9-46de-b13f-c909d5f71690",
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

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Location/' . $value['sslocation_id'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => '{
                  "resourceType": "Location",
                  "id": "' . $value['sslocation_id'] . '",
                  "identifier": [
                      {
                          "system": "http://sys-ids.kemkes.go.id/location/913e8e48-48d9-46de-b13f-c909d5f71690",
                          "value": "' . $value['clinic_id'] . '"
                      }
                  ],
                  "status": "active",
                  "name": "' . $value['name_of_clinic'] . '",
                  "description": "' . $value['name_of_clinic'] . '",
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

        // $response = '"{\"class\":{\"code\":\"AMB\",\"display\":\"ambulatory\",\"system\":\"http:\/\/terminology.hl7.org\/CodeSystem\/v3-ActCode\"},\"id\":\"3a53a4e3-ef73-463f-b5f0-2d8dfcb76f83\",\"identifier\":[{\"system\":\"http:\/\/sys-ids.kemkes.go.id\/encounter\/913e8e48-48d9-46de-b13f-c909d5f71690\",\"value\":\"20231220P001846202\"}],\"location\":[{\"location\":{\"display\":\"DALAM\",\"reference\":\"Location\/f316828e-065b-41a2-8dc0-837a630379be\"}}],\"meta\":{\"lastUpdated\":\"2023-12-20T03:07:41.903805+00:00\",\"versionId\":\"MTcwMzA0MTY2MTkwMzgwNTAwMA\"},\"participant\":[{\"individual\":{\"display\":\"YANDI KURNIAWAN, dr, Sp.PD\",\"reference\":\"Practitioner\/10009880728\"},\"type\":[{\"coding\":[{\"code\":\"ATND\",\"display\":\"attender\",\"system\":\"http:\/\/terminology.hl7.org\/CodeSystem\/v3-ParticipationType\"}]}]}],\"period\":{\"start\":\"2023-12-20T09:54:00+07:00\"},\"resourceType\":\"Encounter\",\"serviceProvider\":{\"reference\":\"Organization\/913e8e48-48d9-46de-b13f-c909d5f71690\"},\"status\":\"arrived\",\"statusHistory\":[{\"period\":{\"start\":\"2023-12-20T09:54:00+07:00\"},\"status\":\"arrived\"}],\"subject\":{\"display\":\"SAIMAN\",\"reference\":\"Patient\/P02478375538\"}}"';
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
            CURLOPT_URL => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1/Encounter',
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
        values('$no_registration','$trans_id','https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1','POST','" . json_encode($ssfulljson) . "',getdate(),getdate(),'4',getdate())");

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
