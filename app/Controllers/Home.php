<?php

namespace App\Controllers;

use App\Models\AssessmentModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\GenerateIdModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use App\Models\UserLoginModel;
use CodeIgniter\I18n\Time;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;

class Home extends BaseController
{
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
    public function homebase()
    {
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

        $select = $users->select('password_hash')->where('username', 'heny')->findAll();
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
            $user              = new User([
                'password' => $value['password'],
                'email' => $value['username'] . '@exindo.com',
                'username' => $value['username']
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
}
