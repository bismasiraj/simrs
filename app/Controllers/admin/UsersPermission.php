<?php


namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use DateTime;

use function PHPUnit\Framework\throwException;

class UsersPermission extends \App\Controllers\BaseController
{
    public function index()
    {
        //
    }


    public function getDataUsers()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $page = isset($formData->page) ? (int)$formData->page : 1;
        $limit = isset($formData->limit) ? (int)$formData->limit : 15;
        $search = isset($formData->search) ? $formData->search : '';

        $offset = ($page - 1) * $limit;

        $data = $this->lowerKey($db->query("SELECT 
                                                USERS.employee_id, 
                                                USERS.email, 
                                                users.id,
                                                users.username,
                                                isnull(EMPLOYEE_ALL.fullname, users.username) as fullname
                                            FROM 
                                                USERS
                                            left outer JOIN 
                                                EMPLOYEE_ALL 
                                                ON USERS.employee_id = EMPLOYEE_ALL.employee_id
                                                WHERE FULLNAME LIKE  '%$search%'  OR USERS.email LIKE '%$search%'
                                            ORDER BY 
                                                fullname ASC
                                            OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY")->getResultArray() ?? []);

        $totalData = $db->query("SELECT COUNT(*) AS total FROM USERS  INNER JOIN 
                                                EMPLOYEE_ALL 
                                                ON USERS.employee_id = EMPLOYEE_ALL.employee_id  WHERE FULLNAME LIKE  '%$search%' OR USERS.email LIKE '%$search%'")->getRow()->total;

        $totalPages = floor($totalData / $limit);

        $result = [
            'page' => $page,
            'total_pages' => $totalPages,
            'count_data' => $totalData,
            'data' => $data,
        ];

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'value' => $result,
        ]);
    }


    public function getUsers()
    {

        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $page = isset($formData->page) ? (int)$formData->page : 1;
        $limit = isset($formData->limit) ? (int)$formData->limit : 15;

        $offset = ($page - 1) * $limit;

        $data = $this->lowerKey($db->query("SELECT 
                                                USERS.employee_id, 
                                                USERS.email, 
                                                users.id,
                                                users.username,
                                                isnull(EMPLOYEE_ALL.fullname, users.username) as fullname
                                            FROM 
                                                USERS
                                            LEFT JOIN 
                                                EMPLOYEE_ALL 
                                                ON USERS.employee_id = EMPLOYEE_ALL.employee_id
                                            ORDER BY 
                                                fullname ASC
                                            OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY")->getResultArray() ?? []);

        $totalData = $db->query("SELECT COUNT(*) AS total FROM USERS  INNER JOIN 
                                    EMPLOYEE_ALL 
                                    ON USERS.employee_id = EMPLOYEE_ALL.employee_id")->getRow()->total;

        $totalPages = floor($totalData / $limit);

        $result = [
            'page' => $page,
            'total_pages' => $totalPages,
            'count_data' => $totalData,
            'data' => $data,
        ];

        $dataAllEmploye = $this->lowerKey($db->query("SELECT 
                                            agu.*, 
                                            e.EMPLOYEE_ID, 
                                            ag.description AS group_name,
                                            ag.name
                                        FROM 
                                            auth_groups_users agu
                                        LEFT JOIN 
                                            EMPLOYEE_ALL e 
                                            ON agu.user_id = CAST(e.EMPLOYEE_ID AS VARCHAR(50)) 
                                            AND ISNUMERIC(e.EMPLOYEE_ID) = 1
                                        INNER JOIN 
                                            AUTH_GROUPS ag 
                                            ON agu.group_id = ag.id
        ")->getResultArray() ?? []);

        $dataOptions = $this->lowerKey($db->query("SELECT * From AUTH_GROUPS 
        ")->getResultArray() ?? []);


        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'value' => $result,
            'dataSend' => $dataAllEmploye,
            'select' => $dataOptions
        ]);
    }

    public function getUsersEmploye()
    {
        $db = db_connect();

        $dataAllEmploye = $this->lowerKey($db->query("SELECT 
                                            agu.*, 
                                            e.EMPLOYEE_ID, 
                                            ag.description AS group_name,
                                            ag.name
                                        FROM 
                                            auth_groups_users agu
                                        LEFT JOIN 
                                            EMPLOYEE_ALL e 
                                            ON agu.user_id = CAST(e.EMPLOYEE_ID AS VARCHAR(50)) 
                                            AND ISNUMERIC(e.EMPLOYEE_ID) = 1
                                        INNER JOIN 
                                            AUTH_GROUPS ag 
                                            ON agu.group_id = ag.id
        ")->getResultArray() ?? []);


        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'dataSend' => $dataAllEmploye,
        ]);
    }

    public function saveData()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();

        if (!isset($formData->group_id) || !isset($formData->user_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Group ID dan User ID wajib diisi.',
            ])->setStatusCode(400);
        }

        $groupId = $formData->group_id;
        $userId = $formData->user_id;

        cache()->delete("{$groupId}_users");
        cache()->delete("{$userId}_groups");
        cache()->delete("{$userId}_permissions");

        $query = $db->table('auth_groups_users')
            ->select('*')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->get();

        if ($query->getNumRows() > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data dengan Group ID dan User ID ini sudah ada.',
            ])->setStatusCode(409);
        }

        $data = [
            'group_id' => $groupId,
            'user_id'  => $userId,
        ];

        try {
            $db->table('auth_groups_users')->insert($data);

            return $this->response->setJSON([
                'id' => $userId,
                'status' => 'success',
                'message' => 'Data berhasil disimpan.',
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();

        if (!isset($formData->group_id) || !isset($formData->user_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Group ID dan User ID wajib diisi.',
            ])->setStatusCode(400);
        }

        $groupId = $formData->group_id;
        $userId = $formData->user_id;

        $query = $db->table('auth_groups_users')
            ->select('*')
            ->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->get();

        if ($query->getNumRows() === 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data dengan Group ID dan User ID ini tidak ditemukan.',
            ])->setStatusCode(404);
        }

        try {
            $db->table('auth_groups_users')
                ->where('group_id', $groupId)
                ->where('user_id', $userId)
                ->delete();

            return $this->response->setJSON([
                'id' => $userId,
                'status' => 'success',
                'message' => 'Data berhasil dihapus.',
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
            ])->setStatusCode(500);
        }
    }
    // =======================================

    public function getDataGroupeAuth()
    {

        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $page = isset($formData->page) ? (int)$formData->page : 1;
        $limit = isset($formData->limit) ? (int)$formData->limit : 15;

        $offset = ($page - 1) * $limit;

        $data = $this->lowerKey($db->query("SELECT 
                                                *
                                            FROM 
                                                auth_groups
                                            ORDER BY 
                                                id ASC
                                            OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY")->getResultArray() ?? []);

        $totalData = $db->query("SELECT COUNT(*) AS total FROM auth_groups")->getRow()->total;

        $totalPages = floor($totalData / $limit);

        $result = [
            'page' => $page,
            'total_pages' => $totalPages,
            'count_data' => $totalData,
            'data' => $data,
        ];

        $dataAuthPermisson = $this->lowerKey($db->query("SELECT 
                                                            ag.id AS group_id,
                                                            ag.name AS group_name,
                                                            ap.description ,
                                                            ap.id AS permission_id,
                                                            ap.name AS permission_name,
                                                            agp.c,
                                                            agp.r,
                                                            agp.u,
                                                            agp.d
                                                        FROM 
                                                            auth_groups_permissions agp
                                                        JOIN 
                                                            auth_groups ag ON agp.group_id = ag.id
                                                        JOIN 
                                                            auth_permissions ap ON agp.permission_id = ap.id
                                                            ORDER BY agp.permission_id ")->getResultArray() ?? []);

        $dataOptions = $this->lowerKey($db->query("SELECT * From auth_permissions")->getResultArray() ?? []);


        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'value' => $result,
            'dataSend' => $dataAuthPermisson,
            'select' => $dataOptions
        ]);
    }

    public function getDataGroupe()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $page = isset($formData->page) ? (int)$formData->page : 1;
        $limit = isset($formData->limit) ? (int)$formData->limit : 15;
        $search = isset($formData->search) ? $formData->search : '';

        $offset = ($page - 1) * $limit;

        $data = $this->lowerKey($db->query("SELECT * FROM 
                                                auth_groups
                                                WHERE description LIKE  '%$search%'  OR name LIKE '%$search%'
                                            ORDER BY 
                                                id ASC
                                            OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY")->getResultArray() ?? []);

        $totalData = $db->query("SELECT COUNT(*) AS total FROM auth_groups  
                                                  WHERE description LIKE  '%$search%' OR name LIKE '%$search%'")->getRow()->total;

        $totalPages = floor($totalData / $limit);

        $result = [
            'page' => $page,
            'total_pages' => $totalPages,
            'count_data' => $totalData,
            'data' => $data,
        ];

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'value' => $result,
        ]);
    }


    public function saveDataAuthGroupe()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();

        if (!isset($formData->group_id) || !isset($formData->id) || !isset($formData->permission)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Group ID dan User ID wajib diisi.',
            ])->setStatusCode(400);
        }

        $groupId = $formData->group_id;
        $id = $formData->id;
        $permission = $formData->permission;

        $data = [
            'group_id' => $groupId,
            'permission_id' => $id,
            'c' => $permission->c,
            'r' => $permission->r,
            'u' => $permission->u,
            'd' => $permission->d,
        ];

        try {
            $existingRecord = $db->table('auth_groups_permissions')
                ->select('*')
                ->where('group_id', $groupId)
                ->where('permission_id', $id)
                ->get()
                ->getRow();

            if ($existingRecord) {
                $db->table('auth_groups_permissions')
                    ->where('group_id', $groupId)
                    ->where('permission_id', $id)
                    ->update($data);

                return $this->response->setJSON([
                    'id' => $groupId,
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui.',
                ])->setStatusCode(200);
            } else {
                $db->table('auth_groups_permissions')->insert($data);

                return $this->response->setJSON([
                    'id' => $groupId,
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan.',
                ])->setStatusCode(200);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ])->setStatusCode(500);
        }
    }



    public function getAuthGroupes()
    {
        $db = db_connect();

        $dataAllEmploye = $this->lowerKey($db->query("SELECT 
                                                            ag.id AS group_id,
                                                            ag.name AS group_name,
                                                            ap.description ,
                                                            ap.id AS permission_id,
                                                            ap.name AS permission_name,
                                                            agp.c,
                                                            agp.r,
                                                            agp.u,
                                                            agp.d
                                                        FROM 
                                                            auth_groups_permissions agp
                                                        JOIN 
                                                            auth_groups ag ON agp.group_id = ag.id
                                                        JOIN 
                                                            auth_permissions ap ON agp.permission_id = ap.id
                                                            ORDER BY agp.permission_id 
        ")->getResultArray() ?? []);


        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'dataSend' => $dataAllEmploye,
        ]);
    }

    public function deleteDataAuthGroupe()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();

        if (!isset($formData->group_id) || !isset($formData->id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Group ID dan User ID wajib diisi.',
            ])->setStatusCode(400);
        }

        $groupId = $formData->group_id;
        $permission_id = $formData->id;

        $query = $db->table('auth_groups_permissions')
            ->select('*')
            ->where('group_id', $groupId)
            ->where('permission_id', $permission_id)
            ->get();

        $result = $query->getRow();

        if (!$result) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data dengan Group ID dan User ID ini tidak ditemukan.',
            ])->setStatusCode(404);
        }

        try {
            $db->table('auth_groups_permissions')
                ->where('group_id', $groupId)
                ->where('permission_id', $permission_id)
                ->delete();

            return $this->response->setJSON([
                'id' => $groupId,
                'status' => 'success',
                'message' => 'Data berhasil dihapus.',
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
