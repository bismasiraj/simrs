<?php

namespace App\Controllers;

use App\Models\AssessmentModel;
use App\Models\BatchingBridgingModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\erm\RMJ27Model;
use App\Models\GenerateIdModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use App\Models\UserLoginModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;
use Config\Services;
use DateTime;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class Home extends BaseController
{
    function getAge($dob)
    {
        $dob = new DateTime($dob);
        $today = new DateTime(); // Current date
        $age = $dob->diff($today);

        return "{$age->y} years, {$age->m} months, {$age->d} days";
    }

    function clearCache()
    {
        $cache = \Config\Services::cache(); // Get the cache service
        $cache->clean(); // Clear all cached items
        return "done";
    }
    function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function coba()
    {
        return $this->getAge('1994-01-21');
        // $ipaddress = '';
        // if (getenv('HTTP_CLIENT_IP'))
        //     $ipaddress = getenv('HTTP_CLIENT_IP');
        // else if (getenv('HTTP_X_FORWARDED_FOR'))
        //     $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        // else if (getenv('HTTP_X_FORWARDED'))
        //     $ipaddress = getenv('HTTP_X_FORWARDED');
        // else if (getenv('HTTP_FORWARDED_FOR'))
        //     $ipaddress = getenv('HTTP_FORWARDED_FOR');
        // else if (getenv('HTTP_FORWARDED'))
        //     $ipaddress = getenv('HTTP_FORWARDED');
        // else if (getenv('REMOTE_ADDR'))
        //     $ipaddress = getenv('REMOTE_ADDR');
        // else
        //     $ipaddress = 'UNKNOWN';
        // return $ipaddress;
        dd($_SERVER['REMOTE_ADDR']);
        $sql = " SELECT PASIEN_VISITATION.NO_REGISTRATION,   
         PASIEN_VISITATION.VISIT_ID,   
         PASIEN_VISITATION.STATUS_PASIEN_ID,   
         PASIEN_VISITATION.VISIT_DATE,   
         PASIEN_VISITATION.CLINIC_ID,   
         PASIEN_VISITATION.EMPLOYEE_ID,
			pasien_visitation.visit_date,
pasien.name_of_pasien  , 
pasien.contact_address,
pasien.date_of_birth,
pasien.gender,
pasien_visitation.rujukan_id,
pasien_visitation.no_skp,
pasien.pasien_id,
pasien.kk_no,
pasien_visitation.class_id,
address_of_rujukan,
PASIEN_VISITATION.RUJUKAN_ID,
pasien_visitation.keluar_id,
pasien_visitation.description,
pasien_visitation.account_id,
pasien.coverage_id,
in_date, pasien_visitation.diag_awal, pasien_visitation.conclusion, pasien_visitation.COB
, pasien_visitation.asalrujukan
, pasien_visitation.ppkrujukan
,ROOMS_ID +'-'+ RIGHT(1000 +TICKET_NO,3) AS URUTAN
    FROM PASIEN_VISITATION   left outer join rooms on clinic_id = buildings_id  , pasien 
    WHERE PASIEN_VISITATION.NO_REGISTRATION='869740' AND
          PASIEN_VISITATION.VISIT_ID='202310020930560230506' and 
			 pasien.no_registration = pasien_visitation.no_registration	
";
        $db = db_connect();
        $result = $db->query(new RawSql($sql));
        return json_encode($this->lowerKey($result->getResultArray()));
    }
    public function index()
    {
        $userLogin = new UserLoginModel();

        $users = new UserModel();

        $select = $this->lowerKey($userLogin->findAll());

        $berhasil = array();
        $i = 1007;
        foreach ($select as $key => $value) {
            $user              = new User();
            $i++;
            $user->id = $i;
            $user->email = $value['username'] . '@exindo.com';
            $user->username = $value['username'];
            $user->employee_id = $value['employee_id'];
            $user->password_hash = base64_encode(hash('sha384', $value['password'], true));
            $user->active = true;
            $user->force_pass_reset = false;
            $user->user_image = 'staff/no_image.png';

            if (!$users->insert($user)) {
                $berhasil[] = $i;
            }
        }

        return json_encode($berhasil);
        return json_encode(password_verify(base64_encode(hash('sha384', "Agussalim7", true)), user()->password_hash));
        return json_encode(password_hash(("Agussalim7"), PASSWORD_BCRYPT));
    }
    public function refresh()
    {
        return view('refresh', []);
    }
    public function homebase()
    {
        // $cache = Services::cache();
        // $cache->clean();
        return json_encode(user()->employee_id);
        $user              = new User($this->request->getPost($allowedPostFields));

        $selector = $users->select("max(id)+1 as id")->findAll();
        // return json_encode($user);
        $user->id = $selector[0]->id;

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (!empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }
    }

    public function checkpass()
    {
        $users = new UserModel();

        // $select = $users->select('password_hash')->where('username', 'heny')->findAll();

        $hash = '$pbkdf2-sha512$25000$NIYQohQCIAQAIGRs7f0f4w$2GUfZWQTg5qjUnAAKf9Feh59QDz1jUJH4uEl15iRZ5x.by.vx7B/VJHi8wixIRIwd2MaY29Tc/ID7DT3JXP2JA';

        // Pisahkan data dalam teks
        $parts = explode('$', $hash);

        // Ambil salt, iterasi, dan hash
        $salt = base64_decode($parts[3]);
        $iter = (int)$parts[2];
        $hash = base64_decode($parts[4]);
        $gabungan = $parts[3] . '$' . $parts[4];

        $password = '123';
        $decrypted_hash = hash_pbkdf2('sha512', $password, $salt, $iter, 64);


        return json_encode($decrypted_hash);

        return json_encode(password_verify(base64_encode(hash('sha384', "Heny3008", false)), $select[0]->password_hash));
        return json_encode(password_verify(base64_encode(hash('sha384', "Heny3008", true)), $select[0]->password_hash));
        return json_encode(password_hash(("Agussalim7"), PASSWORD_BCRYPT));
    }
    public function insertuserlogin()
    {
        $userLogin = new UserLoginModel();

        $users = new UserModel();

        $select = $this->lowerKey($userLogin->where('username not in (select username from users)')->findAll());

        $berhasil = array();
        $i = 0;
        foreach ($select as $key => $value) {
            $i++;
            $user = new User([
                'password' => $value['password'],
                'email' => strtolower(str_replace(' ', '', $value['username'])) . '@exindo.com',
                'username' => strtolower(str_replace(' ', '', $value['username'])),
                'employee_id' => $value['employee_id']
            ]);
            $selector = $users->select("max(id)+1 as id")->findAll();
            // return json_encode($user);

            $user->id = $selector[0]->id;
            // return json_encode($user);

            // $user->email = $value['username'] . '@exindo.com';
            // $user->username = $value['username'];
            // $user->employee_id = $value['employee_id'];
            // $user->password_hash = $value['password'];
            // // $user->password_hash = base64_encode(hash('sha384', $value['password'], true));
            // $user->active = true;
            // $user->force_pass_reset = false;
            // $user->user_image = 'staff/no_image.png';

            if (!$users->insert($user)) {
                $berhasil[] = $user;
            }
            // if ($i == 40) {
            //     break;
            // }
        }

        return json_encode($berhasil);
        return json_encode(password_verify(base64_encode(hash('sha384', "Agussalim7", true)), user()->password_hash));
        return json_encode(password_hash(("Agussalim7"), PASSWORD_BCRYPT));
    }
    public function insertuserloginManual()
    {
        $userLogin = new UserLoginModel();

        $users = new UserModel();
        $user = new User([
            'password' => 'elyexindo',
            'email' => strtolower(str_replace(' ', '', 'ely')) . '@exindo.com',
            'username' => strtolower(str_replace(' ', '', 'ely'))
        ]);
        $selector = $users->select("max(id)+1 as id")->findAll();
        $user->id = $selector[0]->id;
        $berhasil = array();

        if (!$users->insert($user)) {
            $berhasil[] = $user;
        }

        // $select = $this->lowerKey($userLogin->where('username not in (select username from users)')->findAll());

        // $i = 0;
        // foreach ($select as $key => $value) {
        //     $i++;
        //     $user = new User([
        //         'password' => $value['password'],
        //         'email' => strtolower(str_replace(' ', '', $value['username'])) . '@exindo.com',
        //         'username' => strtolower(str_replace(' ', '', $value['username']))
        //     ]);
        //     $selector = $users->select("max(id)+1 as id")->findAll();
        //     // return json_encode($user);

        //     $user->id = $selector[0]->id;
        //     // return json_encode($user);

        //     // $user->email = $value['username'] . '@exindo.com';
        //     // $user->username = $value['username'];
        //     // $user->employee_id = $value['employee_id'];
        //     // $user->password_hash = $value['password'];
        //     // // $user->password_hash = base64_encode(hash('sha384', $value['password'], true));
        //     // $user->active = true;
        //     // $user->force_pass_reset = false;
        //     // $user->user_image = 'staff/no_image.png';

        //     if (!$users->insert($user)) {
        //         $berhasil[] = $user;
        //     }
        //     // if ($i == 40) {
        //     //     break;
        //     // }
        // }

        return json_encode($berhasil);
        return json_encode(password_verify(base64_encode(hash('sha384', "Agussalim7", true)), user()->password_hash));
        return json_encode(password_hash(("Agussalim7"), PASSWORD_BCRYPT));
    }

    public function checkimage($format, $norm, $namatable)
    {
        $db = db_connect();

        $select = $db->query("select paraf_doctor from employee_sign where employee_id = '$norm'")->getResultArray();

        // return json_encode(($select));
        echo '<img src="data:image/' . $format . ';base64,' . ($select[$namatable]['paraf_doctor']) . '" />';
    }

    public function saveimage()
    {
        $db = db_connect();

        $list = $this->lowerKey($db->query("select employee_id 
        from hosnic_emr_rj_psikiatri where 
        doctor_name is not null
        group by employee_id ")->getResultArray());

        foreach ($list as $k => $v) {
            $select = $this->lowerKey($db->query("select top(10) * 
            from hosnic_emr_rj_psikiatri where 
            doctor_name is not null
            and employee_id = '" . $v['employee_id'] . "' ")->getResultArray());
            // $select = $this->lowerKey($db->query("select top(10) * from hosnic_emr_rj_ases_tht where doctor_name is not null")->getResultArray());

            $ea = new EmployeeAllModel();

            foreach ($select as $key => $value) {
                // Decode the base64 data
                $imageData = base64_decode($select[0]['doctor_name']);

                // Generate a unique filename for the image (or use any desired filename)
                $filename = $value['employee_id'] . '-ttd.png';

                // Specify the folder where you want to save the image
                $folderPath = 'uploads/signatures/';

                // Create the folder if it doesn't exist
                if (!is_dir(FCPATH . $folderPath)) {
                    mkdir(FCPATH . $folderPath, 0777, true);
                }

                // Specify the full path to save the image
                $filePath = $folderPath . $filename;

                file_put_contents($filePath, $imageData);


                $ea->update($value['employee_id'], [
                    'ttdpath' => $filePath
                ]);

                // return json_encode($filePath);

                // Save the image to the specified path
            }
        }
    }
    public function changePassword()
    {
        $userModel = new UserModel();
        $userId = user()->id;
        $request = service('request');
        $sendRequest = $request->getJSON(true);

        $oldPassword = $sendRequest['old_password'];
        $newPassword =  $sendRequest['new_password'];
        $confirmPassword =  $sendRequest['confirm_password'];

        if (empty($oldPassword)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password lama tidak boleh kosong.']);
        }

        if (empty($newPassword) || empty($confirmPassword)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Kolom password baru tidak boleh kosong.']);
        }

        $user = $userModel->find($userId);

        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pengguna tidak ditemukan.']);
        }

        if (password_verify(base64_encode(hash('sha384', $oldPassword, true)), user()->password_hash) === false) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password lama tidak benar.']);
        }

        if ($newPassword !== $confirmPassword) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password baru dan konfirmasi password tidak cocok.']);
        }

        $hashedPassword = base64_encode(hash('sha384', $newPassword, true));
        $data = [
            'password_hash' => password_hash($hashedPassword, PASSWORD_BCRYPT),
        ];

        if ($userModel->update($userId, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Password successfully updated.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update password.']);
        }
    }
    private function checkResponse($result, $body, $url, $type)
    {
        $bb = new BatchingBridgingModel();

        if (!isset($result['metadata']['code']) || $result['metadata']['code'] != '200') {
            $bb->where("trans_id = '" . $body['kodebooking'] . "' and tipe = '" . $type . "'")->delete();
            $bb->insert([
                'no_registration' => $body['norm'],
                'trans_id' => $body['kodebooking'],
                'url' => $url,
                'method' => 'POST',
                'parameter' => json_encode($body),
                'result' => json_encode($result),
                // 'STATUS'=>$result['metadata']['code'],
                'created_date' => Time::now(),
                'modified_date' => Time::now(),
                'tipe' => $type
            ]);
            $pv = new PasienVisitationModel();
            $pv->where('trans_id', $body['kodebooking'])->set('statusantrean', $type)->update();
        } else {
            $bb->where("trans_id = '" . $body['kodebooking'] . "' and tipe = '" . $type . "'")->delete();
            $bb->insert([
                'no_registration' => $body['norm'],
                'trans_id' => $body['kodebooking'],
                'url' => $url,
                'method' => 'POST',
                'parameter' => json_encode($body),
                'result' => json_encode($result),
                'status' => $result['metadata']['code'],
                'created_date' => Time::now(),
                'modified_date' => Time::now(),
                'tipe' => $type
            ]);
        }
    }
    public function batchingBridging()
    {
        $db = db_connect();
        $tipe = 1;
        $data = $db->query("select * from batching_bridging where tipe = '$tipe' 
        and trans_id not in (select trans_id from PASIEN_VISITATION where PASIEN_VISITATION.VISIT_DATE >='2025-03-01' and WAY_ID = 13)
        and created_date >= '2025-03-01'
        order by created_date")->getResultArray();

        foreach ($data as $key => $value) {
            $value = $this->lowerKey($value);
            // return json_encode($postdata);
            $postdata = ($value['parameter']);
            $postdata = json_decode($postdata, true);
            $headers = $this->AuthBridging();
            $url = $value['url'];
            $method = $value['method'];
            $url = str_replace("-dev", "", $url);
            $url = str_replace("_dev", "", $url);
            $url = str_replace("//", "/", $url);
            if ($tipe == 1) {
                $postdata['pasienbaru'] = (int)$postdata['pasienbaru'];
                $postdata['kodedokter'] = (int)$postdata['kodedokter'];
                $postdata['jeniskunjungan'] = (int)$postdata['jeniskunjungan'];
                $postdata['estimasidilayani'] = (int)$postdata['estimasidilayani'];
                $postdata['sisakuotajkn'] = (int)$postdata['sisakuotajkn'];
                $postdata['kuotajkn'] = (int)$postdata['kuotajkn'];
                $postdata['sisakuotanonjkn'] = (int)$postdata['sisakuotanonjkn'];
                $postdata['kuotanonjkn'] = (int)$postdata['kuotanonjkn'];
                $postdata['angkaantrean'] = (int)$postdata['angkaantrean'];
            }
            $kodebooking = $postdata['kodebooking'];
            $norm = $postdata['norm'];
            // $angkaantrean = $postdata['angkaantrean'];
            $postdata = json_encode($postdata);
            // dd($postdata);
            // $method = 'POST';
            array_push($headers, "Content-length: " . strlen($postdata));
            $result = $this->SendBridging($url, $method, $postdata, $headers);
            // return json_encode($result);
            // dd("update BATCHING_BRIDGING
            //               set 
            //               result = '" . json_encode($result) . "'
            //               where tipe = '" . $value['tipe'] . "' and trans_id = '" . $value['trans_id'] . "';");
            // $trans_id = $value['trans_id'];
            if ($result['metadata']['code'] == '200') {
                // $this->checkResponse($result, $postdata, $url, '2' . $value['tipe']);
                // $db = db_connect();
                $bb = new BatchingBridgingModel();

                // $bb->where("trans_id = '" . $kodebooking . "' and tipe = '" . $tipe . "'")->delete();
                $bb->insert([
                    'no_registration' => $norm,
                    'trans_id' => $kodebooking,
                    'url' => $url,
                    'method' => 'POST',
                    'parameter' => ($postdata),
                    'result' => json_encode($result),
                    'status' => 1,
                    'created_date' => $value['created_date'],
                    'modified_date' => Time::now(),
                    'tipe' => $tipe
                ]);
                // $db->query("update BATCHING_BRIDGING
                //           set status = 1,
                //           result = '" . json_encode(value: $result) . "'
                //           where tipe = '" . $value['tipe'] . "' and trans_id = '" . $value['trans_id'] . "';");
            } else {
                // $db = db_connect();
                $bb = new BatchingBridgingModel();

                // $bb->where("trans_id = '" . $kodebooking . "' and tipe = '" . $tipe . "'")->delete();
                $datas = [
                    'no_registration' => $norm,
                    'trans_id' => $kodebooking,
                    'url' => $url,
                    'method' => 'POST',
                    'parameter' => ($postdata),
                    'result' => json_encode($result),
                    'status' => 0,
                    'created_date' => $value['created_date'],
                    'modified_date' => Time::now(),
                    'tipe' => $tipe
                ];
                $bb->insert($datas);

                // return json_encode($datas);
                // $db->query("update BATCHING_BRIDGING
                //           set 
                //           result = '" . json_encode($result) . "'
                //           where tipe = '" . $value['tipe'] . "' and trans_id = '" . $value['trans_id'] . "';");
            }
        }

        return json_encode("selesai");
    }
}
