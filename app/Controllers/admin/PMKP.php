<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\DietInapModel;
use App\Models\PmkpModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use DateTime;

use function PHPUnit\Framework\throwException;

class PMKP extends \App\Controllers\BaseController
{


    public function renderData()
    {
        $db = db_connect();
        $request = service('request');
        $formData = $request->getPOST();

        $data = $this->lowerKey($db->query("
        select  
        VISIT_ID,
        thename,
        NO_REGISTRATION,
        TA.employee_id,
        ta.keluar_id ,
        clinic.name_of_clinic,
        ta.CLASS_ROOM_ID,
        ta.BED_ID,
        employee_all.fullname,
        CASE WHEN TA.AGEYEAR > 0 THEN CAST(TA.AGEYEAR AS VARCHAR (2)) + ' th '
        else ' ' end +  CASE WHEN TA.AGEMONTH > 0 THEN CAST(TA.AGEMONTH AS VARCHAR (2)) + ' bl '
        else ' ' end + CASE WHEN TA.AGEDAY > 0 THEN CAST(TA.AGEDAY AS VARCHAR (2)) + ' hr '
        else ' ' end   as umur,
        TA.EXIT_DATE,
        TA.TREAT_DATE,
        TA.clinic_id,
        clinic.name_of_clinic
        from TREATMENT_AKOMODASI TA
        left outer join clinic on clinic.clinic_id = ta.clinic_id
        left outer join EMPLOYEE_ALL on employee_all.EMPLOYEE_ID = TA.employee_ID
        where 
        1=1
        and TA.class_room_id is not null
        and TA.keluar_id is not null
        and TA.bed_id is not null
        and TA.no_registration like '%" . $formData['norm'] . "%'
        and TA.thename like '%" . $formData['nama'] . "%'
        and clinic.name_of_clinic like '" . $formData['klinik'] . "%'

        AND TA.keluar_id = 0
            

        ")->getResultArray() ?? []);

        $formulir = $this->lowerKey($db->query("
        SELECT INDICATORS.INDICATOR_ID, INDICATORS.INDICATORS FROM INDICATORS
        LEFT JOIN INDICATOR_TYPE_CLINIC ON INDICATORS.INDIC_TYPE = INDICATOR_TYPE_CLINIC.INDIC_TYPE
        LEFT JOIN CLINIC ON INDICATOR_TYPE_CLINIC.CLINIC_ID = CLINIC.CLINIC_ID
        WHERE CLINIC.NAME_OF_CLINIC LIKE '" . $formData['klinik'] . "%'
            
        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data,
            'formulir' => $formulir
        ]);
    }
    public function renderDataRalan()
    {
        $db = db_connect();
        $request = service('request');
        $formData = $request->getPOST();
        $date = new DateTime($formData['mulai']);
        $date = $date->format('Y-m-d H:i:s.v');
        $data = $this->lowerKey($db->query("
        select 
        diantar_oleh as thename,
        NO_REGISTRATION,
        visitor_address as alamat,
        pv.employee_id,
        keluar_id ,
        clinic.name_of_clinic,
        pv.CLASS_ROOM_ID,
        pv.BED_ID,
        employee_all.fullname,
        CASE WHEN pv.AGEYEAR > 0 THEN CAST(pv.AGEYEAR AS VARCHAR (2)) + ' th '
        else ' ' end +  CASE WHEN pv.AGEMONTH > 0 THEN CAST(pv.AGEMONTH AS VARCHAR (2)) + ' bl '
        else ' ' end + CASE WHEN pv.AGEDAY > 0 THEN CAST(pv.AGEDAY AS VARCHAR (2)) + ' hr '
        else ' ' end   as umur
        from pv
        left outer join clinic on clinic.clinic_id = pv.clinic_id
        left outer join EMPLOYEE_ALL on employee_all.EMPLOYEE_ID = pv.employee_ID
        where 1=1
        and clinic.name_of_clinic like '" . $formData['klinik'] . "%'
        and pv.employee_id like '" . $formData['dokter'] . "%'
        and pv.NO_REGISTRATION like '%" . $formData['norm'] . "%'
        and convert(date,pv.visit_date) = convert(date,'" . $date . "')
            

        ")->getResultArray() ?? []);


        $formulir = $this->lowerKey($db->query("
        SELECT INDICATORS.INDICATOR_ID, INDICATORS.INDICATORS FROM INDICATORS
        LEFT JOIN INDICATOR_TYPE_CLINIC ON INDICATORS.INDIC_TYPE = INDICATOR_TYPE_CLINIC.INDIC_TYPE
        LEFT JOIN CLINIC ON INDICATOR_TYPE_CLINIC.CLINIC_ID = CLINIC.CLINIC_ID
        WHERE CLINIC.NAME_OF_CLINIC LIKE '" . $formData['klinik'] . "%'
        group by INDICATORS.INDICATOR_ID, INDICATORS.INDICATORS
            
        ")->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data,
            'formulir' => $formulir
        ]);
    }

    public function getForm()
    {
        $request = service('request');
        $formData = $request->getPOST();
        $db = db_connect();


        if ($formData['isrj'] == 'true') {
            $date = new DateTime($formData['mulai']);
            $date = $date->format('Y-m-d H:i:s.v');
            $data_formulir = $this->lowerKey($db->query("
            select 
            diantar_oleh as thename,
            pv.NO_REGISTRATION,
            visitor_address as alamat,
            pv.employee_id,
            keluar_id ,
            clinic.clinic_id,
            clinic.name_of_clinic,
            pv.CLASS_ROOM_ID,
            pv.BED_ID,
            employee_all.fullname,
            CASE WHEN pv.AGEYEAR > 0 THEN CAST(pv.AGEYEAR AS VARCHAR (2)) + ' th '
            else ' ' end +  CASE WHEN pv.AGEMONTH > 0 THEN CAST(pv.AGEMONTH AS VARCHAR (2)) + ' bl '
            else ' ' end + CASE WHEN pv.AGEDAY > 0 THEN CAST(pv.AGEDAY AS VARCHAR (2)) + ' hr '
            else ' ' end   as umur,
            INDICATORS.INDICATORS, INDICATORS.INDICATOR_ID, INDICATORS.INDIC_TYPE,
            COALESCE(INDICATOR_PMKP.RESULT, 0) AS checked
            from pv
            left outer join clinic on clinic.clinic_id = pv.clinic_id
            left outer join INDICATOR_TYPE_CLINIC on clinic.clinic_id =INDICATOR_TYPE_CLINIC.CLINIC_ID
            left join INDICATORS on INDICATOR_TYPE_CLINIC.INDIC_TYPE = INDICATORS.INDIC_TYPE
            left outer join EMPLOYEE_ALL on employee_all.EMPLOYEE_ID = pv.employee_ID
            left outer join INDICATOR_PMKP on INDICATORS.INDICATOR_ID = INDICATOR_PMKP.INDICATOR_ID AND INDICATOR_PMKP.CLINIC_ID = clinic.CLINIC_ID AND pv.NO_REGISTRATION = INDICATOR_PMKP.NO_REGISTRATION
            where  
            clinic.name_of_clinic like '" . $formData['klinik'] . "%'
            and convert(date,pv.visit_date) = convert(date,'" . $date . "')

            order by THENAME asc
            ")->getResultArray() ?? []);
        } else {

            $data_formulir = $this->lowerKey($db->query("
            select  
            TA.THENAME, TA.employee_id, TA.no_registration, TA.CLINIC_ID, 
            INDICATORS.INDICATORS, INDICATORS.INDICATOR_ID, INDICATORS.INDIC_TYPE, clinic.name_of_clinic,
            COALESCE(INDICATOR_PMKP.RESULT, 0) AS checked
            from TREATMENT_AKOMODASI TA
            left outer join clinic on clinic.clinic_id = ta.clinic_id
            left outer join INDICATOR_TYPE_CLINIC on clinic.clinic_id =INDICATOR_TYPE_CLINIC.CLINIC_ID
            left join INDICATORS on INDICATOR_TYPE_CLINIC.INDIC_TYPE = INDICATORS.INDIC_TYPE
            left outer join EMPLOYEE_ALL on employee_all.EMPLOYEE_ID = TA.employee_ID
            left outer join INDICATOR_PMKP on INDICATORS.INDICATOR_ID = INDICATOR_PMKP.INDICATOR_ID AND INDICATOR_PMKP.CLINIC_ID = clinic.CLINIC_ID AND TA.NO_REGISTRATION = INDICATOR_PMKP.NO_REGISTRATION
            where 
            1=1
            and TA.class_room_id is not null
            and TA.keluar_id is not null
            and TA.bed_id is not null
            and clinic.name_of_clinic like '" . $formData['klinik'] . "%'
            AND TA.keluar_id = 0

            order by TA.THENAME asc
            ")->getResultArray() ?? []);
        }



        $result = [];

        foreach ($data_formulir as $index => $entry) {
            $name = $entry['thename'];
            $clinic_id = $entry['clinic_id'];
            $employee_id = $entry['employee_id'];
            $no_registration = $entry['no_registration'];
            $checked = $entry['checked'];
            $indicator = $entry['indicators'];
            $indicator_type = $entry['indic_type'];
            $indicator_id = $entry['indicator_id'];

            if (!isset($result[$no_registration])) {
                $result[$no_registration] = [
                    'name' => $name,
                    'clinic_id' => $clinic_id,
                    'employee_id' => $employee_id,
                    'no_registration' => $no_registration,
                    'indicators' => []
                ];
            }

            if ($indicator) {
                $result[$no_registration]['indicators'][] = [
                    'indicator_type' => $indicator_type,
                    'indicator_id' => $indicator_id,
                    'indicators' => $indicator,
                    'checked' => $checked
                ];
            }
        }



        $result = array_values($result);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $result
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


            $model = new PmkpModel();
            $date = date("Y-m-d H:i:s");

            $dataInsert = [];
            if (isset($formData->data_pmkp) && is_array($formData->data_pmkp)) {
                foreach ($formData->data_pmkp as $key => $data) {
                    $data_indicator = implode(', ', array_map(function ($item) {
                        return "'" . $item . "'";
                    }, $data->indicators));

                    if (!empty($data->indicators)) {
                        $data_formulir = $this->lowerKey($db->query("
                            SELECT *,
                            CASE 
                                WHEN id.indicator_id IN ($data_indicator) THEN 1 
                                ELSE 0 
                            END AS checked
                            FROM INDICATORS id
                            LEFT OUTER JOIN INDICATOR_TYPE_CLINIC ON id.indic_type = INDICATOR_TYPE_CLINIC.indic_type
                            WHERE INDICATOR_TYPE_CLINIC.clinic_id = '" . $data->clinic_id . "'
                        ")->getResultArray() ?? []);

                        $dataExist = $this->lowerKey($db->query("
                            select * from INDICATOR_PMKP
                            where NO_REGISTRATION = '" . $data->no_registration . "' and clinic_id = '" . $data->clinic_id . "'
                        ")->getRowArray() ?? []);

                        if (!empty($dataExist)) {
                            $date_treat = $dataExist['treat_date'] ?? null;
                            $model->where('no_registration', $dataExist['no_registration'])->where('clinic_id', $dataExist['clinic_id'])->delete();
                        }

                        foreach ($data_formulir as $formulir) {
                            // $dataInsert = [];
                            $dataInsert = [
                                'no_registration' => $data->no_registration,
                                'clinic_id' => $data->clinic_id,
                                'treat_date' => !empty($dataExist) ? $date_treat : $date,
                                'indicator_id' => $formulir['indicator_id'],
                                'result' => $formulir['checked'],
                                'thename' => $data->thename,
                                'employee_id' => $data->employee_id,
                                'modified_date' => $date,
                                'modified_by' => user()->username
                            ];
                            $insertBatch = $model->insert($dataInsert);
                            if ($insertBatch === false) {
                                $error = $db->error();
                                throw new \Exception('Update failed: ' . $error['message']);
                            }
                        }
                    } else {
                        $error = $db->error();
                        throw new \Exception('Data harus diisi');
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

    public function getDataAnalisis()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        if (isset($formData->bulan)) {
            if (preg_match('/^(\d{4})-(\d{2})$/', $formData->bulan, $matches)) {
                $year = (int)$matches[1];
                $month = (int)$matches[2];
            }
        }
        $query = "
                SELECT 
                    INDICATORS.INDICATOR_ID,
                    INDICATORS.INDICATORS AS indicator_name,
                    INDICATORS.TARGET AS target,
                    INDICATORS.STANDAR AS standar,
                    COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) AS ya,
                    COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) <> 1 THEN 1 END) AS tidak,
                    CASE 
                        WHEN COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) + COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) <> 1 THEN 1 END) = 0 
                        THEN 0 
                        ELSE 
                            ROUND(
                                (COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) * 100.0 / 
                                (COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) + COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) <> 1 THEN 1 END))),
                                2
                            )
                    END AS capaian
                FROM 
                    INDICATORS
                INNER JOIN 
                    INDICATOR_TYPE_CLINIC ON INDICATORS.INDIC_TYPE = INDICATOR_TYPE_CLINIC.INDIC_TYPE
                INNER JOIN 
                    CLINIC ON INDICATOR_TYPE_CLINIC.CLINIC_ID = CLINIC.CLINIC_ID
                LEFT JOIN 
                    INDICATOR_PMKP ON INDICATORS.INDICATOR_ID = INDICATOR_PMKP.INDICATOR_ID 
                    AND CLINIC.CLINIC_ID = INDICATOR_PMKP.CLINIC_ID
                
            ";
        if ($formData->kategori == 1) {
            $query .= " AND YEAR(INDICATOR_PMKP.treat_date) = '" . $year . "' AND MONTH(INDICATOR_PMKP.treat_date) = '" . $month . "'";
        } else if ($formData->kategori == 2) {
            $query .= " AND YEAR(INDICATOR_PMKP.treat_date) = '" . $formData->tahun . "'";
        }
        $query .= "
                WHERE 
                    CLINIC.NAME_OF_CLINIC LIKE '" . $formData->name_of_clinic . "%'
                GROUP BY 
                    INDICATORS.INDICATOR_ID, INDICATORS.INDICATORS,INDICATORS.TARGET,INDICATORS.STANDAR
                ORDER BY 
                    INDICATORS.INDICATOR_ID;
            ";

        $data = $this->lowerKey($db->query($query)->getResultArray() ?? []);


        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data
        ]);
    }

    public function getDataStatistik()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        if (empty($formData->bulan) && $formData->kategori != 3) {
            return $this->response->setJSON([
                'message' => 'input bulan harus diisi',
                'respon'  => false,
            ]);
        }
        if (isset($formData->kategori) && $formData->kategori == 1) {
            if (preg_match('/^(\d{4})-(\d{2})$/', $formData->bulan, $matches)) {
                $year = (int)$matches[1];
                $month = (int)$matches[2];
            }
            $data = $this->lowerKey($db->query("
                WITH DateRange AS (
                    SELECT 
                        CAST(DATEADD(DAY, number, EOMONTH(DATEFROMPARTS('" . $year . "', '" . $month . "', 1), -1)) AS DATE) AS Day
                    FROM 
                        master..spt_values
                    WHERE 
                        type = 'P' 
                        AND number < DAY(EOMONTH(DATEFROMPARTS('" . $year . "', '" . $month . "', 1))) + 1
                )
                SELECT 
                    CASE 
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) THEN 'Minggu ke 1'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 1 THEN 'Minggu ke 2'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 2 THEN 'Minggu ke 3'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 3 THEN 'Minggu ke 4'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 4 THEN 'Minggu ke 5'
                        ELSE 'Other Weeks'
                    END AS label_name,
                    COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) AS ya,
                    COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0) AS tidak,
                    COUNT(ip.result) AS total_results,
                    CASE 
                        WHEN (COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) + 
                            COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0)) = 0 THEN 0
                        ELSE 
                            ROUND(
                                CAST(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) AS FLOAT) / 
                                (SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) + 
                                SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END)) * 100, 
                                2
                            )
                    END AS capaian
                FROM 
                    DateRange dr
                LEFT JOIN 
                    INDICATOR_PMKP ip ON CAST(ip.treat_date AS DATE) = dr.Day AND ip.indicator_id LIKE '" . $formData->indicator_id . "%' 
                LEFT JOIN 
                    CLINIC ON ip.clinic_id = clinic.clinic_id
                WHERE 
                    MONTH(dr.Day) = '" . $month . "' AND YEAR(dr.Day) = '" . $year . "' 
                    AND clinic.name_of_clinic LIKE '" . $formData->name_of_clinic . "%' OR clinic.clinic_id IS NULL
                GROUP BY 
                    CASE 
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) THEN 'Minggu ke 1'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 1 THEN 'Minggu ke 2'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 2 THEN 'Minggu ke 3'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 3 THEN 'Minggu ke 4'
                        WHEN DATEPART(WEEK, dr.Day) = DATEPART(WEEK, DATEFROMPARTS('" . $year . "', '" . $month . "', 1)) + 4 THEN 'Minggu ke 5'
                        ELSE 'Other Weeks'
                    END
                ORDER BY 
                    MIN(dr.Day);


            ")->getResultArray() ?? []);
        } else if (isset($formData->kategori) && $formData->kategori == 2) {
            if (preg_match('/^(\d{4})-(\d{2})$/', $formData->bulan, $matches)) {
                $year = (int)$matches[1];
                $month = (int)$matches[2];
            }
            $data = $this->lowerKey($db->query("
               WITH DateRange AS (
                    SELECT 
                        CAST(DATEADD(DAY, number, EOMONTH(DATEFROMPARTS('" . $year . "', '" . $month . "', 1), -1)) AS DATE) AS Day
                    FROM 
                        master..spt_values
                    WHERE 
                        type = 'P' 
                        AND number < DAY(EOMONTH(DATEFROMPARTS('" . $year . "', '" . $month . "', 1))) + 1
                )
                SELECT 
                    RIGHT('0' + CAST(DAY(dr.Day) AS VARCHAR(2)), 2) AS label_name,
                    COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) AS ya,
                    COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0) AS tidak,
                    CASE 
                        WHEN (SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN ip.result = 0 OR ip.result IS NULL THEN 1 ELSE 0 END)) = 0 THEN 0
                        ELSE 
                            ROUND(
                                CAST(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) AS FLOAT) / 
                                (SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN ip.result = 0 OR ip.result IS NULL THEN 1 ELSE 0 END)) * 100, 
                                2
                            )
                    END AS capaian
                FROM 
                    DateRange dr
                LEFT JOIN 
                    INDICATOR_PMKP ip ON CAST(ip.treat_date AS DATE) = dr.Day AND ip.indicator_id LIKE '" . $formData->indicator_id . "%'
                LEFT JOIN 
                    CLINIC ON ip.clinic_id = clinic.clinic_id AND (clinic.name_of_clinic LIKE '" . $formData->name_of_clinic . "%' OR clinic.clinic_id IS NULL)
                WHERE 
                    MONTH(dr.Day) = '" . $month . "' AND 
                    YEAR(dr.Day) = '" . $year . "'
                GROUP BY 
                    DAY(dr.Day)
                ORDER BY 
                    DAY(dr.Day);


            ")->getResultArray() ?? []);
        } else if (isset($formData->kategori) && $formData->kategori == 3) {

            $data = $this->lowerKey($db->query("
            WITH DateRange AS (
                    SELECT 
                        MONTH(DATEADD(MONTH, number, DATEFROMPARTS('" . $formData->tahun . "', 1, 1))) AS MonthNumber,
                        EOMONTH(DATEADD(MONTH, number, DATEFROMPARTS('" . $formData->tahun . "', 1, 1))) AS MonthEnd
                    FROM 
                        master..spt_values
                    WHERE 
                        type = 'P' 
                        AND number < 12  -- Generate for each month of the year
                ),
                Days AS (
                    SELECT 
                        CAST(DATEADD(DAY, number, MonthEnd) AS DATE) AS Day,
                        MonthNumber
                    FROM 
                        DateRange
                    CROSS JOIN 
                        master..spt_values
                    WHERE 
                        type = 'P' 
                        AND number < DAY(MonthEnd) + 1
                        AND YEAR(DATEADD(DAY, number, MonthEnd)) = '" . $formData->tahun . "'  -- Ensure only '" . $formData->tahun . "' dates
                )
                SELECT 
                    CASE 
                        WHEN MONTH(d.Day) = 1 THEN 'Januari'
                        WHEN MONTH(d.Day) = 2 THEN 'Februari'
                        WHEN MONTH(d.Day) = 3 THEN 'Maret'
                        WHEN MONTH(d.Day) = 4 THEN 'April'
                        WHEN MONTH(d.Day) = 5 THEN 'Mei'
                        WHEN MONTH(d.Day) = 6 THEN 'Juni'
                        WHEN MONTH(d.Day) = 7 THEN 'Juli'
                        WHEN MONTH(d.Day) = 8 THEN 'Agustus'
                        WHEN MONTH(d.Day) = 9 THEN 'September'
                        WHEN MONTH(d.Day) = 10 THEN 'Oktober'
                        WHEN MONTH(d.Day) = 11 THEN 'November'
                        WHEN MONTH(d.Day) = 12 THEN 'Desember'
                    END AS label_name,  
                    COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) AS ya,
                    COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0) AS tidak,
                    COUNT(ip.result) AS total_results,
                    CASE 
                        WHEN (COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) + 
                            COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0)) = 0 THEN 0
                        ELSE 
                            ROUND(
                                CAST(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) AS FLOAT) / 
                                (COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) + 
                                COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0)) * 100, 
                                2
                            )
                    END AS capaian
                FROM 
                    Days d
                LEFT JOIN 
                    INDICATOR_PMKP ip ON CAST(ip.treat_date AS DATE) = d.Day AND ip.indicator_id LIKE '" . $formData->indicator_id . "%' 
                LEFT JOIN 
                    CLINIC ON ip.clinic_id = clinic.clinic_id 
                WHERE 
                    clinic.name_of_clinic LIKE '" . $formData->name_of_clinic . "%' OR clinic.clinic_id IS NULL
                GROUP BY 
                    MONTH(d.Day)   
                ORDER BY 
                    MONTH(d.Day);


            ")->getResultArray() ?? []);
        }

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => $data
        ]);
    }

    public function getDataCetak()
    {
        $db = db_connect();
        $request = service('request');
        $formData = $request->getJSON();
        $kategori = '';
        if (empty($formData->bulan) && $formData->kategori == 1) {
            return $this->response->setJSON([
                'message' => 'input bulan harus diisi',
                'respon'  => false,
            ]);
        }
        if (isset($formData->bulan)) {
            if (preg_match('/^(\d{4})-(\d{2})$/', $formData->bulan, $matches)) {
                $year = (int)$matches[1];
                $month = (int)$matches[2];
            }
        }

        if (isset($formData->kategori) && $formData->kategori == 1) {
            $kategori = 'Bulan ' . $this->convertMonth($month);
            $grafik = $this->lowerKey($db->query("
              WITH DateRange AS (
                SELECT 
                    CAST(DATEADD(DAY, number, EOMONTH(DATEFROMPARTS('" . $year . "', '" . $month . "', 1), -1)) AS DATE) AS Day
                FROM 
                    master..spt_values
                WHERE 
                    type = 'P' 
                    AND number < DAY(EOMONTH(DATEFROMPARTS('" . $year . "', '" . $month . "', 1))) + 1
            )
            SELECT 
                RIGHT('0' + CAST(DAY(dr.Day) AS VARCHAR(2)), 2) AS label_name,
                COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) AS ya,
                COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0) AS tidak,
                CASE 
                    WHEN (SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN ip.result = 0 OR ip.result IS NULL THEN 1 ELSE 0 END)) = 0 THEN 0
                    ELSE 
                        ROUND(
                            CAST(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) AS FLOAT) / 
                            (SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN ip.result = 0 OR ip.result IS NULL THEN 1 ELSE 0 END)) * 100, 
                            2
                        )
                END AS capaian
            FROM 
                DateRange dr
            LEFT JOIN 
                INDICATOR_PMKP ip ON CAST(ip.treat_date AS DATE) = dr.Day
            LEFT JOIN 
                CLINIC ON ip.clinic_id = clinic.clinic_id AND (clinic.name_of_clinic LIKE '" . $formData->name_of_clinic . "%' OR clinic.clinic_id IS NULL)
            WHERE 
                MONTH(dr.Day) = '" . $month . "' AND 
                YEAR(dr.Day) = '" . $year . "'
            GROUP BY 
                DAY(dr.Day)
            ORDER BY 
                DAY(dr.Day);


            ")->getResultArray() ?? []);
        } else if (isset($formData->kategori) && $formData->kategori == 2) {
            $kategori = 'Tahun ' . $formData->tahun;
            $grafik = $this->lowerKey($db->query("
            WITH DateRange AS (
                    SELECT 
                        MONTH(DATEADD(MONTH, number, DATEFROMPARTS('" . $formData->tahun . "', 1, 1))) AS MonthNumber,
                        EOMONTH(DATEADD(MONTH, number, DATEFROMPARTS('" . $formData->tahun . "', 1, 1))) AS MonthEnd
                    FROM 
                        master..spt_values
                    WHERE 
                        type = 'P' 
                        AND number < 12  -- Generate for each month of the year
                ),
                Days AS (
                    SELECT 
                        CAST(DATEADD(DAY, number, MonthEnd) AS DATE) AS Day,
                        MonthNumber
                    FROM 
                        DateRange
                    CROSS JOIN 
                        master..spt_values
                    WHERE 
                        type = 'P' 
                        AND number < DAY(MonthEnd) + 1
                        AND YEAR(DATEADD(DAY, number, MonthEnd)) = '" . $formData->tahun . "'  -- Ensure only '" . $formData->tahun . "' dates
                )
                SELECT 
                    CASE 
                        WHEN MONTH(d.Day) = 1 THEN 'Januari'
                        WHEN MONTH(d.Day) = 2 THEN 'Februari'
                        WHEN MONTH(d.Day) = 3 THEN 'Maret'
                        WHEN MONTH(d.Day) = 4 THEN 'April'
                        WHEN MONTH(d.Day) = 5 THEN 'Mei'
                        WHEN MONTH(d.Day) = 6 THEN 'Juni'
                        WHEN MONTH(d.Day) = 7 THEN 'Juli'
                        WHEN MONTH(d.Day) = 8 THEN 'Agustus'
                        WHEN MONTH(d.Day) = 9 THEN 'September'
                        WHEN MONTH(d.Day) = 10 THEN 'Oktober'
                        WHEN MONTH(d.Day) = 11 THEN 'November'
                        WHEN MONTH(d.Day) = 12 THEN 'Desember'
                    END AS label_name,  
                    COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) AS ya,
                    COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0) AS tidak,
                    COUNT(ip.result) AS total_results,
                    CASE 
                        WHEN (COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) + 
                            COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0)) = 0 THEN 0
                        ELSE 
                            ROUND(
                                CAST(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END) AS FLOAT) / 
                                (COALESCE(SUM(CASE WHEN ip.result = 1 THEN 1 ELSE 0 END), 0) + 
                                COALESCE(SUM(CASE WHEN ip.result = 0 THEN 1 ELSE 0 END), 0)) * 100, 
                                2
                            )
                    END AS capaian
                FROM 
                    Days d
                LEFT JOIN 
                    INDICATOR_PMKP ip ON CAST(ip.treat_date AS DATE) = d.Day
                LEFT JOIN 
                    CLINIC ON ip.clinic_id = clinic.clinic_id 
                WHERE 
                    clinic.name_of_clinic LIKE '" . $formData->name_of_clinic . "%' OR clinic.clinic_id IS NULL
                GROUP BY 
                    MONTH(d.Day)   
                ORDER BY 
                    MONTH(d.Day);


            ")->getResultArray() ?? []);
        }

        $query = "
                SELECT 
                    INDICATORS.INDICATOR_ID,
                    INDICATORS.INDICATORS AS indicator_name,
                    INDICATORS.TARGET AS target,
                    INDICATORS.STANDAR AS standar,
                    COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) AS ya,
                    COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) <> 1 THEN 1 END) AS tidak,
                    CASE 
                        WHEN COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) + COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) <> 1 THEN 1 END) = 0 
                        THEN 0 
                        ELSE 
                            ROUND(
                                (COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) * 100.0 / 
                                (COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) = 1 THEN 1 END) + COUNT(CASE WHEN COALESCE(INDICATOR_PMKP.RESULT, 0) <> 1 THEN 1 END))),
                                2
                            )
                    END AS capaian
                FROM 
                    INDICATORS
                INNER JOIN 
                    INDICATOR_TYPE_CLINIC ON INDICATORS.INDIC_TYPE = INDICATOR_TYPE_CLINIC.INDIC_TYPE
                INNER JOIN 
                    CLINIC ON INDICATOR_TYPE_CLINIC.CLINIC_ID = CLINIC.CLINIC_ID
                LEFT JOIN 
                    INDICATOR_PMKP ON INDICATORS.INDICATOR_ID = INDICATOR_PMKP.INDICATOR_ID 
                    AND CLINIC.CLINIC_ID = INDICATOR_PMKP.CLINIC_ID

            ";
        if ($formData->kategori == 1) {
            $query .= " AND YEAR(INDICATOR_PMKP.treat_date) = '" . $year . "' AND MONTH(INDICATOR_PMKP.treat_date) = '" . $month . "'";
        } else if ($formData->kategori == 2) {
            $query .= " AND YEAR(INDICATOR_PMKP.treat_date) = '" . $formData->tahun . "'";
        }
        $query .= "
                WHERE 
                    CLINIC.NAME_OF_CLINIC LIKE '" . $formData->name_of_clinic . "%'
                GROUP BY 
                    INDICATORS.INDICATOR_ID, INDICATORS.INDICATORS,INDICATORS.TARGET,INDICATORS.STANDAR
                ORDER BY 
                    INDICATORS.INDICATOR_ID;
            ";

        $analisis = $this->lowerKey($db->query($query)->getResultArray() ?? []);

        $kopprint = $this->lowerKey($db->query("SELECT name_of_org_unit, contact_address from ORGANIZATIONUNIT")->getRowArray() ?? []);


        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data' => [
                'organization' => $kopprint,
                'analisis' => $analisis,
                'grafik' => $grafik,
                'name_of_clinic' => $formData->name_of_clinic,
                'kategori' => $kategori
            ]
        ]);
    }

    public function cetak($dataJson)
    {
        $db = db_connect();
        $data_raw = json_decode(base64_decode($dataJson));
        $data = $data_raw->data;

        return view("admin/patient/cetak/pmkp-cetak.php", [
            'title' => 'Cetak PMKP',
            'organization' => $data->organization,
            'analisis' => $data->analisis,
            'grafik' => $data->grafik,
            'name_of_clinic' => $data->name_of_clinic,
            'kategori' => $data->kategori
        ]);
    }

    public function convertMonth($month)
    {
        switch ($month) {
            case '01':
                return 'Januari';
                break;
            case '02':
                return 'Februari';
                break;
            case '03':
                return 'Maret';
                break;
            case '04':
                return 'April';
                break;
            case '05':
                return 'Mei';
                break;
            case '06':
                return 'Juni';
                break;
            case '07':
                return 'Juli';
                break;
            case '08':
                return 'Agustus';
                break;
            case '09':
                return 'September';
                break;
            case '10':
                return 'Oktober';
                break;
            case '11':
                return 'November';
                break;
            case '12':
                return 'Desember';
                break;
            default:
                return 'Bulan tidak valid';
                break;
        }
    }
}
