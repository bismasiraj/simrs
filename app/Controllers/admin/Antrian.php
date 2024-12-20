<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\OrganizationunitModel;
use CodeIgniter\I18n\Time;

class Antrian extends \App\Controllers\BaseController
{
    public function get_send()
    {
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];
        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $title = 'Manajemen Antrian';
        return view('admin/patient/manajemen-antrian', [
            'title' => $title,
            'img_time' => $img_timestamp,
            'orgunit' => $orgunit,

        ]);
    }

    public function getData()
    {
        $db = db_connect();
        $getData = $this->lowerKey($db->query("select * from ANTRIAN_DISPLAY ORDER BY display_id ASC")->getResultArray());

        $getPoli = $this->lowerKey($db->query("select clinic_id,name_of_clinic from clinic where stype_id = 1")->getResultArray());
        $getDockterAll = $this->lowerKey($db->query("SELECT EMPLOYEE_all.EMPLOYEE_ID,   
                                                            EMPLOYEE_ALL.FULLNAME,
                                                            employee_all.taspen as employee_code,
                                                             DOCTOR_SCHEDULE.CLINIC_ID
                                                        FROM DOCTOR_SCHEDULE,   
                                                            EMPLOYEE_ALL  ,DAYS_NUMBER DN ,days
                                                        WHERE ( DOCTOR_SCHEDULE.EMPLOYEE_ID = EMPLOYEE_ALL.EMPLOYEE_ID )  and  
                                                            convert(date,the_day) = convert(date,getdate()) and DOCTOR_SCHEDULE.DAY_ID = days.DAY_ID and 
                                                    days.DAY_NAME = dn.NAMA_HARI ")->getResultArray());



        if (empty($getData)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Success',
                'respon' => true,
                'value' => [
                    'data' => $getData,
                    'poli' => $getPoli,
                    'doctor' => $getDockterAll
                ]
            ]);
        }
    }

    public function updateAntrian()
    {
        $db = db_connect();

        $request = service('request');
        $requestData = $request->getJSON();
        // var_dump($requestData);

        if (!$requestData || !isset($requestData->display_id)) {
            return $this->response->setStatusCode(400, 'Invalid input data');
        }


        $builder = $db->table('antrian_display');
        $existingIp = $builder->where('display_id !=', $requestData->display_id)
            ->where('display_ip', $requestData->display_ip)
            ->where('display_ip !=', '')
            ->where('display_ip IS NOT NULL')
            ->get()
            ->getRow(0, 'array');

        if ($existingIp) {
            return $this->response->setJSON([
                'message' => 'IP address sudah ada',
                'respon' => false
            ]);
            // return $this->response->setStatusCode(400, 'IP address already in use');
        }
        $builder->set([
            'clinic_id'     => $requestData->clinic_id,
            'display_ip'    => $requestData->display_ip,
            'fullname'      => $requestData->fullname,
            'employee_id'   => $requestData->employee_id,
            'employee_code' => $requestData->employee_code,
            'name_of_clinic' => $requestData->name_of_clinic,
            'modified_date' => date('Y-m-d H:i:s'),
            'modified_by' => user()->username
        ]);
        $builder->where('display_id', $requestData->display_id);

        $success = $builder->update();


        if ($success) {
            return $this->response->setJSON([
                'message' => 'Update successful',
                'respon' => true
            ]);
            // return $this->response->setStatusCode(200, 'Update successful');
        } else {
            return $this->response->setJSON([
                'message' => 'Update failed',
                'respon' => false
            ]);
            // return $this->response->setStatusCode(500, 'Update failed');
        }
    }

    public function indexDisplay()
    {
        return view('antrian/index');
    }

    public function getDataDisplay()
    {

        $request = service('request');
        $requestData = $request->getJSON();

        // var_dump($requestData);

        $db = db_connect();

        $data = $this->lowerKey($db->query("SELECT 
                            ap.tanggal_panggil AS tanggal_panggil, 
                            ap.status_panggil AS status_panggil,
                            ap.NO_REGISTRATION AS no_registration, 
                            ap.THENAME AS thename, 
                            ap.Id As id,
                            ap.visit_id,
                            ad.EMPLOYEE_CODE + RIGHT(CAST(100 + ap.no_urut AS VARCHAR(3)), 2) AS no_tiket,
                            ad.CLINIC_ID AS clinic_id, 
                            ad.NAME_OF_CLINIC AS name_of_clinic, 
                            ad.FULLNAME AS fullname, 
                            ad.DISPLAY_ROOM AS display_room
                        FROM ANTRIAN_POLI ap, antrian_display ad
                        WHERE ad.CLINIC_ID = ap.loket
                        AND ad.EMPLOYEE_ID = ap.employee_id
                        AND ap.status_panggil = 1
                        AND ap.loket = '$requestData->poli'
                        AND ap.employee_id = '$requestData->employee'
                        AND CONVERT(DATE, ap.tanggal_daftar) = CONVERT(DATE, GETDATE())
                        AND CONVERT(DATE, ap.tanggal_panggil) = CONVERT(DATE, GETDATE())
                        ORDER BY ap.tanggal_panggil")->getResultArray());

        $dataTerlayani = $this->lowerKey($db->query("SELECT org_unit_code,
                                            isnull ((select count(visit_id) from antrian_poli apl where apl.employee_id = '$requestData->employee'
                                            and year(apl.tanggal_daftar) = year(getdate()) 
                                            and month(apl.tanggal_daftar) = month(getdate()) 
                                            and day(apl.tanggal_daftar) = day(getdate()) ),0) as jml_pasien,

                                            isnull((select count(visit_id) from antrian_poli apl where apl.loket = '$requestData->poli'
                                            and year(apl.tanggal_daftar) = year(getdate()) 
                                            and month(apl.tanggal_daftar) = month(getdate()) 
                                            and day(apl.tanggal_daftar) = day(getdate())
                                            and status_panggil = 2 ),0) as jml_TERlayanI 
                                            from ORGANIZATIONUNIT")->getResultArray());
        $dataTerlayani = $dataTerlayani[0] ?? null;



        $data = [
            'data' => $data,
            'terlayani' => $dataTerlayani
        ];


        if (empty($data)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Success',
                'respon' => true,
                'value' => $data
            ]);
        }
    }

    public function getPoliAndEmployeeDisplay()
    {
        $db = db_connect();

        $poli = $this->lowerKey($db->query("SELECT clinic_id,name_of_clinic from clinic where stype_id = 1")->getResultArray());
        $employe = $this->lowerKey($db->query("SELECT EMPLOYEE_all.EMPLOYEE_ID,   
                                                    EMPLOYEE_ALL.FULLNAME,
                                                    employee_all.taspen as employee_code,
                                                    DOCTOR_SCHEDULE.CLINIC_ID
                                                FROM DOCTOR_SCHEDULE,   
                                                    EMPLOYEE_ALL  ,DAYS_NUMBER DN ,days
                                                WHERE ( DOCTOR_SCHEDULE.EMPLOYEE_ID = EMPLOYEE_ALL.EMPLOYEE_ID )  and  
                                                    convert(date,the_day) = convert(date,getdate()) and DOCTOR_SCHEDULE.DAY_ID = days.DAY_ID and 
                                            days.DAY_NAME = dn.NAMA_HARI")->getResultArray());


        return $this->response->setJSON([
            'message' => 'Success',
            'respon' => true,
            'value' => ['data' => ['poli' => $poli, 'employe' => $employe]]
        ]);
    }

    public function getDataIp()
    {
        $db = db_connect();

        $hostname = gethostname();
        $ipAddress = gethostbyname($hostname);
        $localIp = $ipAddress;

        $ip = $this->request->getIPAddress();

        $ip_address2 = $this->request->getServer('HTTP_CLIENT_IP')
            ?? $this->request->getServer('HTTP_X_FORWARDED_FOR');

        $system32Path = getenv('WINDIR') . '\\System32';
        $ipConfigCommand = $system32Path . '\\ipconfig';

        $ipconfigOutput = shell_exec($ipConfigCommand);
        $localIPs = $this->parseLocalIPs($ipconfigOutput);

        $localIPs = $localIPs ? $localIPs[0] : [];



        $getData = $this->lowerKey($db->query("SELECT * from ANTRIAN_DISPLAY ORDER BY display_id ASC")->getResultArray());

        $videoDir = FCPATH . 'assets/vidio/';
        $videoFiles = [];
        if (is_dir($videoDir)) {
            $files = scandir($videoDir);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'mp4') {
                    $videoFiles[] = $file;
                }
            }
        }

        $result = [
            'data' => $getData,
            'vidio' => $videoFiles,
            'ip' => $localIp,
            'baru' => $ip,
            'ip_i' => $ip_address2,
            'all_local_ips' => $localIPs // Tambahkan IP lokal ke hasil
        ];

        if (empty($result)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Success',
                'respon' => true,
                'value' => $result
            ]);
        }
    }

    private function parseLocalIPs($ipconfigOutput)
    {
        $lines = explode("\n", $ipconfigOutput);
        $localIPs = [];

        foreach ($lines as $line) {
            if (strpos($line, 'IPv4 Address') !== false) {
                $parts = explode(':', $line);
                if (isset($parts[1])) {
                    $localIPs[] = trim($parts[1]);
                }
            }
        }

        return $localIPs;
    }

    public function updateStatusPanggilan()
    {

        $db = db_connect();
        $request = service('request');
        $requestData = $request->getJSON();

        if (!isset($requestData->visit_id) || !isset($requestData->id)) {
            return $this->response->setJSON([
                'message' => 'Data visit_id atau id tidak lengkap',
                'respon' => false
            ])->setStatusCode(400);
        }

        $builder = $db->table('antrian_poli');
        $existingRecord = $builder->where('visit_id', $requestData->visit_id)
            ->where('id', $requestData->id)
            ->get()
            ->getRow(0, 'array');


        if (!$existingRecord) {
            return $this->response->setJSON([
                'message' => 'Data tidak ditemukan atau sudah digunakan IP lain',
                'respon' => false
            ])->setStatusCode(404);
        }

        $builder->set([
            'status_panggil' => 2,
            'modified_by' => user()->username
        ]);

        $builder->where('visit_id', $requestData->visit_id)
            ->where('id', $requestData->id);

        // var_dump("hasil",$builder);



        $success = $builder->update();

        if ($success) {
            return $this->response->setJSON([
                'message' => 'Update successful',
                'respon' => true
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'message' => 'Update failed',
                'respon' => false
            ])->setStatusCode(500);
        }
    }

    public function pendaftaranDisplay()
    {
        return view('antrian/pendaftaran');
    }

    public function getDataPendaftaranDisplay()
    {
        $db = db_connect();
        $data = $this->lowerKey($db->query("SELECT *from antrian_pendaftaran
                                        where  convert(date,tanggal_daftar) = convert(date,getdate())
                                        and status_panggil = 1 order by tanggal_panggil ASC")->getResultArray());

        $display = $this->lowerKey($db->query("SELECT right(display_room,1) as loket , right(cast(1000 + isnull(max(no_urut),0) as varchar(4)),3) as no_antrian
                                                from   ANTRIAN_DISPLAY ad left outer join antrian_pendaftaran ap  on 
                                                ap.loket = right(display_room,1)  
                                                and convert(date, tanggal_daftar) = convert(date,getdate())
                                                and status_panggil = 2
                                                where  
                                                ad.DISPLAY_ROOM  like 'loket pendaftaran%'
                                                group by right(display_room,1)")->getResultArray());


        $data = [
            'data' => $data,
            'display' => $display
        ];
        if (empty($data)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Success',
                'respon' => true,
                'value' => $data
            ]);
        }
    }


    public function updateStatusPendaftaranPanggilan()
    {

        $db = db_connect();
        $request = service('request');
        $requestData = $request->getJSON();

        if (!isset($requestData->id)) {
            return $this->response->setJSON([
                'message' => 'Data visit_id atau id tidak lengkap',
                'respon' => false
            ])->setStatusCode(400);
        }

        $builder = $db->table('antrian_pendaftaran');
        $existingRecord = $builder->where('id', $requestData->id)
            ->get()
            ->getRow(0, 'array');


        if (!$existingRecord) {
            return $this->response->setJSON([
                'message' => 'Data tidak ditemukan atau sudah digunakan IP lain',
                'respon' => false
            ])->setStatusCode(404);
        }

        $builder->set([
            'status_panggil' => 2,
        ]);

        $builder->where('id', $requestData->id);

        // var_dump("hasil",$builder);



        $success = $builder->update();

        if ($success) {
            return $this->response->setJSON([
                'message' => 'Update successful',
                'respon' => true
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'message' => 'Update failed',
                'respon' => false
            ])->setStatusCode(500);
        }
    }
}
