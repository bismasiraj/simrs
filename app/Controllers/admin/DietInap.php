<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\DietInapModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use DateTime;

use function PHPUnit\Framework\throwException;

class DietInap extends \App\Controllers\BaseController
{
    public function renderData()
    {
        $db = db_connect();
        $request = service('request');
        $formData = $request->getPOST();

        $date = new DateTime($formData['akhir']);

        $date_after = clone $date;
        $date_after->modify('+1 day');

        $date = $date->format('Y-m-d H:i:s.v');
        $date_after = $date_after->format('Y-m-d H:i:s.v');


        $data = $this->lowerKey($db->query("
        select  
        VISIT_ID,
        thename,
        TA.NO_REGISTRATION,
        TA.employee_id,
        ta.keluar_id ,
        clinic.name_of_clinic,
		b.NAME_OF_BUILDING,
        ta.CLASS_ROOM_ID,
		CLASS_ROOM.NAME_OF_CLASS,
        ta.BED_ID,
        employee_all.fullname,
        CASE WHEN TA.AGEYEAR > 0 THEN CAST(TA.AGEYEAR AS VARCHAR (2)) + ' th '
        else ' ' end +  CASE WHEN TA.AGEMONTH > 0 THEN CAST(TA.AGEMONTH AS VARCHAR (2)) + ' bl '
        else ' ' end + CASE WHEN TA.AGEDAY > 0 THEN CAST(TA.AGEDAY AS VARCHAR (2)) + ' hr '
        else ' ' end   as umur,
        TA.EXIT_DATE,
        TA.TREAT_DATE,
        clinic.name_of_clinic
        from TREATMENT_AKOMODASI TA
        left outer join clinic on clinic.clinic_id = ta.clinic_id and clinic.STYPE_ID = '3'
        left outer join EMPLOYEE_ALL on employee_all.EMPLOYEE_ID = TA.employee_ID
		left outer join buildings b on clinic.BUILDING_ID = b.BUILDINGS_ID
		left outer join CLASS_ROOM on ta.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
        where 
        1=1
        and TA.class_room_id is not null
        and TA.keluar_id is not null
        and TA.bed_id is not null
        and clinic.name_of_clinic like '" . $formData['klinik'] . "%'

        AND (
            (TA.keluar_id = 0) 
            OR 
            --(TA.keluar_id = 1 AND CAST(TA.EXIT_DATE AS DATE) BETWEEN '" . $date . "' AND '" . $date_after . "')
            (TA.keluar_id = 1 AND CAST(TA.EXIT_DATE AS DATE) >= '" . $date . "' AND CAST(TA.TREAT_DATE AS DATE) <= '" . $date . "')
        )

		ORDER BY NAME_OF_BUILDING, CLINIC.NAME_OF_CLINIC ASC

        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data
        ]);
    }

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $data = $this->lowerKey($db->query("
        SELECT DIET_INAP.*,pasien.date_of_birth from DIET_INAP 
        inner join pasien on diet_inap.no_registration = pasien.no_registration
        WHERE VISIT_ID IN ('" . implode("', '", $formData->visit_id) . "') AND CAST(DIET_DATE AS DATE) = '$formData->date'
        order by MODIFIED_DATE desc

        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data
        ]);
    }

    public function getDataBentuk()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $data = $this->lowerKey($db->query("
        select * from diet_type
        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data
        ]);
    }

    public function insertData()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin();
        $formData = $request->getJSON();

        $date = date("Y-m-d H:i:s");


        try {


            $model = new DietInapModel();
            $date = date("Y-m-d H:i:s");


            if (isset($formData->gizi) && is_array($formData->gizi)) {
                $dataInsert = [];
                foreach ($formData->gizi as $key => $data) {
                    if (!empty($data->dtypedesc_malam) || !empty($data->dtypedesc_pagi) || !empty($data->dtypedesc_siang)) {

                        $visit = $this->lowerKey($db->query("
                        SELECT org_unit_code, visit_id, no_registration, clinic_id, diantar_oleh as thename, 
                        visitor_address as theaddress, isrj, ageyear, agemonth, ageday, gender, 
                        employee_id, class_room_id, bed_id, keluar_id, kal_id 
                        FROM PASIEN_VISITATION
                        where visit_id = '" . $data->visit_id . "' ")->getRowArray() ?? []);

                        $existData = $this->lowerKey($db->query("
                        SELECT *
                        FROM DIET_INAP
                        where visit_id = '" . $data->visit_id . "' AND CAST(DIET_DATE AS DATE) = '" . $formData->date . "'")->getRowArray() ?? []);


                        $dataInsert = [
                            "org_unit_code" => $visit['org_unit_code'],
                            "visit_id" => $visit['visit_id'],
                            "no_registration" => $visit['no_registration'],
                            "clinic_id" => $visit['clinic_id'],
                            "diet_date" => $formData->date,
                            "order_date" => $date,
                            "thename" => $visit['thename'],
                            "theaddress" => $visit['theaddress'],
                            "isrj" => $visit['isrj'],
                            "ageyear" => $visit['ageyear'],
                            "agemonth" => $visit['agemonth'],
                            "ageday" => $visit['ageday'],
                            "gender" => $visit['gender'],
                            "employee_id" => $visit['employee_id'],
                            "class_room_id" => $visit['class_room_id'],
                            "bed_id" => $visit['bed_id'],
                            "keluar_id" => $visit['keluar_id'],
                            "kal_id" => $visit['kal_id'],
                            "modified_date" => $date,
                            "modified_by" => user()->username,
                            "diet_time" => $date,
                            "dmineral_id" => null,
                            "dtypes_id" => null,
                            "dtype_pagi" => $data->dtypedesc_pagi,
                            "dtype_siang" => $data->dtypedesc_siang,
                            "dtype_malam" => $data->dtypedesc_malam,
                            "dtype_iddesc" => $data->mineral_pagi,
                            "dtype_siangdesc" => $data->mineral_siang,
                            "dtype_malamdesc" => $data->mineral_malam,
                            "pantangan_pagi" => $data->pantangan_pagi,
                            "pantangan_siang" => $data->pantangan_siang,
                            "pantangan_malam" => $data->pantangan_malam,
                            "penunggu_pagi" => $data->ekstra_pagi,
                            "penunggu_siang" => $data->ekstra_siang,
                            "penunggu_malam" => $data->ekstra_malam
                        ];

                        if (empty($existData)) {
                            $dataInsert["dtype_id"] =  $this->get_bodyid();
                            $insert = $model->insert($dataInsert);
                            if (!$insert) {
                                $error = $model->error();
                                throw new \Exception('Insert failed: ' . $error['message']);
                            }
                        } else {

                            $dataInsert["dtype_id"] = $existData['dtype_id'];

                            $update = $model->where('dtype_id', $existData['dtype_id'])
                                ->where('visit_id', $existData['visit_id'])
                                ->where('diet_date', $existData['diet_date'])
                                ->set($dataInsert)
                                ->update();

                            if (!$update) {
                                $error = $model->error();
                                throw new \Exception('Update failed: ' . $error['message']);
                            }
                        }
                    }
                }
                $db->transCommit();

                return $this->response->setJSON([
                    'message' => 'Save data successfully.',
                    'status' => true,
                    'data' => $dataInsert
                ]);
            }
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Failed to process data: ' . $e->getMessage(), 'status' => false]);
        }
    }

    public function cetakAll($shift, $date, $clinic, $dataJson)
    {
        $db = db_connect();

        $data = json_decode(base64_decode($dataJson));

        $dataValue = [];
        foreach ($data as $row) {
            $class_room = $this->lowerKey($db->query("
            select name_of_class from class_room where class_room_id = '" . $row->class_room_id . "'
            ")->getRowArray() ?? []);


            switch ($shift) {
                case 'pagi':
                    $dataValue[] = [
                        'name_of_pasien' => $row->thename,
                        'name_of_class' => $class_room['name_of_class'],
                        'date_of_birth' => $row->date_of_birth,
                        'no_registration' => $row->no_registration,
                        'bentuk' => $row->dtype_pagi,
                        'jenis' => $row->pantangan_pagi,
                        'mineral' => $row->dtype_iddesc,
                        'extra' => $row->penunggu_pagi,
                    ];
                    break;
                case 'siang':
                    $dataValue[] = [
                        'name_of_pasien' => $row->thename,
                        'name_of_class' => $class_room['name_of_class'],
                        'date_of_birth' => $row->date_of_birth,
                        'no_registration' => $row->no_registration,
                        'bentuk' => $row->dtype_siang,
                        'jenis' => $row->pantangan_siang,
                        'mineral' => $row->dtype_siangdesc,
                        'extra' => $row->penunggu_siang,
                    ];
                    break;
                case 'malam':
                    $dataValue[] = [
                        'name_of_pasien' => $row->thename,
                        'name_of_class' => $class_room['name_of_class'],
                        'date_of_birth' => $row->date_of_birth,
                        'no_registration' => $row->no_registration,
                        'bentuk' => $row->dtype_malam,
                        'jenis' => $row->pantangan_malam,
                        'mineral' => $row->dtype_malamdesc,
                        'extra' => $row->penunggu_malam,
                    ];
                    break;
            }
        }


        return view("admin/patient/cetak/order-gizi-all.php", [
            "value" => $dataValue,
            "date" => $date,
            "shift" => $shift,
            "clinic_name" => $clinic,
            'title' => 'Cetak Order Gizi',
        ]);
    }
    public function cetak($shift, $date, $clinic, $dataJson)
    {
        $db = db_connect();

        $data = json_decode(base64_decode($dataJson));

        $class_room = $this->lowerKey($db->query("
        select name_of_class from class_room where class_room_id = '" . $data->class_room_id . "'
        ")->getRowArray() ?? []);

        $dataValue = [];
        switch ($shift) {
            case 'pagi':
                $dataValue = [
                    'name_of_pasien' => $data->thename,
                    'date_of_birth' => $data->date_of_birth,
                    'no_registration' => $data->no_registration,
                    'bentuk' => $data->dtype_pagi,
                    'jenis' => $data->pantangan_pagi,
                    'mineral' => $data->dtype_iddesc,
                    'extra' => $data->penunggu_pagi,
                ];
                break;
            case 'siang':
                $dataValue = [
                    'name_of_pasien' => $data->thename,
                    'date_of_birth' => $data->date_of_birth,
                    'no_registration' => $data->no_registration,
                    'bentuk' => $data->dtype_siang,
                    'jenis' => $data->pantangan_siang,
                    'mineral' => $data->dtype_siangdesc,
                    'extra' => $data->penunggu_siang,
                ];
                break;
            case 'malam':
                $dataValue = [
                    'name_of_pasien' => $data->thename,
                    'date_of_birth' => $data->date_of_birth,
                    'no_registration' => $data->no_registration,
                    'bentuk' => $data->dtype_malam,
                    'jenis' => $data->pantangan_malam,
                    'mineral' => $data->dtype_malamdesc,
                    'extra' => $data->penunggu_malam,
                ];
                break;
        }

        return view("admin/patient/cetak/order-gizi.php", [
            "data" => $dataValue,
            "date" => $date,
            "shift" => $shift,
            "clinic_name" => $clinic,
            "name_of_class" => $class_room['name_of_class'],
            'title' => 'Cetak Order Gizi',
        ]);
    }


    public function generate()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin();
        $formData = $request->getJSON();
        $date = new DateTime($formData->date);
        $today = new DateTime();
        $tomorrow = new DateTime('+1 day');
        $model = new DietInapModel();
        $data = json_decode(json_encode($formData->data), true);

        try {
            $error = $model->error();
            if (!empty($formData->data)) {
                if ($date->format('Y-m-d') === $today->format('Y-m-d')) {
                    $insertBatch = [];
                    $updateBatch = [];

                    foreach ($data as $key => $value) {
                        $existData = $this->lowerKey($db->query("
                        SELECT *
                        FROM DIET_INAP
                        where visit_id = '" . $value['visit_id'] . "' AND CAST(DIET_DATE AS DATE) = '" . $tomorrow->format('Y-m-d') . "'")->getRowArray() ?? []);

                        $value['diet_date'] = $tomorrow->format('Y-m-d H:i:s');
                        $value['diet_time'] = $tomorrow->format('Y-m-d H:i:s');
                        $value['modified_by'] = user()->username;
                        $value['modified_date'] = $today->format('Y-m-d H:i:s');
                        $value['order_date'] = $tomorrow->format('Y-m-d H:i:s');
                        $value['valid_date_pagi'] = $existData['valid_date_pagi'] ?? null;
                        $value['valid_pasien_pagi'] = $existData['valid_pasien_pagi'] ?? null;
                        $value['valid_date_siang'] = $existData['valid_date_siang'] ?? null;
                        $value['valid_pasien_siang'] = $existData['valid_pasien_siang'] ?? null;
                        $value['valid_date_malam'] = $existData['valid_date_malam'] ?? null;
                        $value['valid_pasien_malam'] = $existData['valid_pasien_malam'] ?? null;
                        $value['valid_user_pagi'] = $existData['valid_user_pagi'] ?? null;
                        $value['valid_user_siang'] = $existData['valid_user_siang'] ?? null;
                        $value['valid_user_malam'] = $existData['valid_user_malam'] ?? null;

                        if (!empty($existData)) {
                            $value['dtype_id'] = $existData['dtype_id'];
                            $updateBatch[] = $value;
                        } else {
                            $value['dtype_id'] = $this->get_bodyid();
                            $insertBatch[] = $value;
                        }
                    }

                    if (!empty($updateBatch)) {
                        $model->updateBatch($updateBatch, 'dtype_id');
                    }


                    if (!empty($insertBatch)) {
                        $model->insertBatch($insertBatch);
                    }

                    $db->transCommit();
                    return $this->response->setJSON([
                        'message' => 'Berhasil Generate Data',
                        'status' => true
                    ]);
                } else {
                    throw new \Exception('Gagal Melakukan Generate, Data Harus Hari ini Tanggal ' . $today->format('d-m-Y'));
                }
            } else {
                throw new \Exception('Gagal Melakukan Generate, Data Tanggal ' . $date->format('d-m-Y') . ' Tidak Tersedia');
            }
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Error : ' . $e->getMessage(), 'status' => false]);
        }
    }

    public function validasi()
    {
        $db = db_connect();
        $request = service('request');
        $db->transBegin();
        $formData = $request->getJSON();

        $model = new DietInapModel();
        $data = json_decode($formData);


        $existData = $this->lowerKey($db->query("
        SELECT *
        FROM DIET_INAP
        where visit_id = '" . $data->visit_id . "' AND CAST(DIET_DATE AS DATE) = '" . $data->date . "'")->getRowArray() ?? []);


        $date = date("Y-m-d H:i:s");
        $dataUpdate = [];

        $dataUpdate["valid_date_pagi"]    = $data->pagi  ? $date : null;
        $dataUpdate["valid_pasien_pagi"]  = $data->pagi  ? $data->data : null;
        $dataUpdate["valid_user_pagi"]    = $data->pagi  ? user()->username : null;
        $dataUpdate["valid_date_siang"]   = $data->siang ? $date : null;
        $dataUpdate["valid_pasien_siang"] = $data->siang ? $data->data : null;
        $dataUpdate["valid_user_siang"]   = $data->siang ? user()->username : null;
        $dataUpdate["valid_date_malam"]   = $data->malam ? $date : null;
        $dataUpdate["valid_pasien_malam"] = $data->malam ? $data->data : null;
        $dataUpdate["valid_user_malam"]   = $data->malam ? user()->username : null;


        $update = $model->where('dtype_id', $existData['dtype_id'])
            ->where('visit_id', $existData['visit_id'])
            ->where('diet_date', $existData['diet_date'])
            ->set($dataUpdate)
            ->update();

        if ($update) {
            $db->transCommit();
            return $this->response->setJSON([
                'message' => 'Berhasil Validasi Data',
                'status' => true,
                'data' => $dataUpdate
            ]);
        } else {
            $db->transRollback();
            return $this->response->setJSON([
                'message' => 'Gagal Validasi Data',
                'status' => false,
                'data' => $dataUpdate
            ]);
        }
    }

    public function sensus($date, $bangsal)
    {
        $db = db_connect();
        $date = base64_decode(json_decode($date));
        $date = new DateTime($date);

        $date_after = clone $date;
        $date_after->modify('+1 day');

        $date = $date->format('Y-m-d H:i:s.v');
        $date_after = $date_after->format('Y-m-d H:i:s.v');


        $data = $this->lowerKey($db->query("
        select  
        TA.VISIT_ID,
        TA.thename,
        TA.NO_REGISTRATION,
        TA.employee_id,
        ta.keluar_id,
        ta.gender,
        clinic.name_of_clinic,
		b.NAME_OF_BUILDING,
        ta.CLASS_ROOM_ID,
		CLASS_ROOM.NAME_OF_CLASS,
        ta.BED_ID,
        employee_all.fullname,
        CASE WHEN TA.AGEYEAR > 0 THEN CAST(TA.AGEYEAR AS VARCHAR (2)) + ' th '
        else ' ' end +  CASE WHEN TA.AGEMONTH > 0 THEN CAST(TA.AGEMONTH AS VARCHAR (2)) + ' bl '
        else ' ' end + CASE WHEN TA.AGEDAY > 0 THEN CAST(TA.AGEDAY AS VARCHAR (2)) + ' hr '
        else ' ' end   as umur,
        TA.EXIT_DATE,
        TA.TREAT_DATE,
        clinic.name_of_clinic
		
        from TREATMENT_AKOMODASI TA
        left outer join clinic on clinic.clinic_id = ta.clinic_id and clinic.STYPE_ID = '3'
        left outer join EMPLOYEE_ALL on employee_all.EMPLOYEE_ID = TA.employee_ID
		left outer join buildings b on clinic.BUILDING_ID = b.BUILDINGS_ID
		left outer join CLASS_ROOM on ta.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
        
        where 
        1=1
        and TA.class_room_id is not null
        and TA.keluar_id is not null
        and TA.bed_id is not null
        and clinic.name_of_clinic like '" . $bangsal . "%'

        AND (
            (TA.keluar_id = 0) 
            OR 
            --(TA.keluar_id = 1 AND CAST(TA.EXIT_DATE AS DATE) BETWEEN '" . $date . "' AND '" . $date_after . "')
            (TA.keluar_id = 1 AND CAST(TA.EXIT_DATE AS DATE) >= '" . $date . "' AND CAST(TA.TREAT_DATE AS DATE) <= '" . $date . "')
        )


		ORDER BY NAME_OF_BUILDING, CLINIC.NAME_OF_CLINIC ASC

        ")->getResultArray() ?? []);
        $visitId = array_map(function ($data) {
            return $data['visit_id'];
        }, $data);

        $dataGizi = $this->lowerKey($db->query("
        SELECT 
        DIET_INAP.visit_id,
        DIET_INAP.dtype_pagi,
		DIET_INAP.dtype_siang,
		DIET_INAP.dtype_malam,
		DIET_INAP.pantangan_pagi,
		DIET_INAP.pantangan_siang,
		DIET_INAP.pantangan_malam,
		DIET_INAP.VALID_PASIEN_PAGI,
		DIET_INAP.VALID_PASIEN_SIANG,
		DIET_INAP.VALID_PASIEN_MALAM
        from DIET_INAP 
        WHERE VISIT_ID IN ('" . implode("', '", $visitId) . "') AND CAST(DIET_DATE AS DATE) = '$date'
        order by MODIFIED_DATE desc

        ")->getResultArray() ?? []);

        $queryAlergi = $this->lowerKey($db->query("
        select visit_id, food_alergy from ASSESSMENT_NUTRITION
        where visit_id IN ('" . implode("', '", $visitId) . "')
        order by EXAMINATION_DATE desc
        ")->getResultArray() ?? []);

        foreach ($queryAlergi as $row) {
            $visitId = $row['visit_id'];
            $foodAlergy = $row['food_alergy'] ?? '-';

            if ($foodAlergy && $foodAlergy !== '-') {
                $groupedData[$visitId][] = $foodAlergy;
            }
        }

        $dataAlergi = [];

        foreach ($groupedData as $visitId => $foods) {

            if (empty($foods)) {
                $foods[] = '-';
            }

            $dataAlergi[] = [
                "visit_id" => $visitId,
                "food_alergy" => implode(', ', array_unique($foods))
            ];
        }

        $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);

        return view("admin/patient/cetak/sensus-gizi.php", [
            "data" => $data,
            "data_gizi" => $dataGizi,
            "data_alergi" => $dataAlergi,
            "organization" => $selectorganization,
            'title' => 'Sensus Harian Gizi',
        ]);
    }
}
