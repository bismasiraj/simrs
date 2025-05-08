<?php

namespace App\Controllers\Admin;

use App\Controllers\SatuSehat;
use App\Models\CaraKeluarModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicModel;
use App\Models\CompanyModel;
use App\Models\DiagnosaModel;
use App\Models\DistributionTypeModel;
use App\Models\DoctorScheduleModel;
use App\Models\EmployeeAllModel;
use App\Models\FollowUpModel;
use App\Models\InasisFaskesModel;
use App\Models\IsattendedsModel;
use App\Models\KalurahanModel;
use App\Models\KotaModel;
use App\Models\MeasurementModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienVisitationModel;
use App\Models\RegulationTypeModel;
use App\Models\RujukanModel;
use App\Models\SatuSehatModel;
use App\Models\SexModel;
use App\Models\ShiftDaysModel;
use App\Models\StatusPasienModel;
use App\Models\SufferModel;
use App\Models\TreatmentAkomodasiModel;
use App\Models\TreatmentBillModel;
use App\Models\TreatmentObatModel;
use App\Models\TreatTarifModel;
use App\Models\UserLoginModel;
use CodeIgniter\I18n\Time;
use DateInterval;

use function PHPUnit\Framework\isNull;

class Report extends \App\Controllers\BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->session->set(['selectedMenu' => '']);
    }
    public function getOrgCode()
    {
        $org = new OrganizationunitModel();
        $orgAll = $org->findAll();
        return $orgAll[0];
    }
    public function getImgTime()
    {
        $img_time = new Time('now');
        return $img_time->getTimestamp();
    }
    public function getTimestampInv($dateintv)
    {
        $seconds = ($dateintv->format("%s"))
            + ($dateintv->format("%i") * 60)
            + ($dateintv->format("%h") * 60 * 60)
            + ($dateintv->format("%d") * 60 * 60 * 24)
            + ($dateintv->format("%m") * 60 * 60 * 24 * 30)
            + ($dateintv->format("%y") * 60 * 60 * 24 * 365);
        return $seconds;
    }

    public function getClinic($stype)
    {
        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', $stype)->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', $stype)->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }
        return $clinic;
    }

    public function getShift()
    {
        $model = new ShiftDaysModel();
        $shift = $this->lowerKey($model->findAll());
        return $shift;
    }
    public function getRegulation()
    {
        $model = new RegulationTypeModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }
    public function getMeasurement()
    {
        $model = new MeasurementModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }
    public function getCompany()
    {
        $model = new CompanyModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }
    public function getDistribution()
    {
        $model = new DistributionTypeModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }

    public function getSex()
    {
        $sexModel = new SexModel();
        return $this->lowerKey($sexModel->findAll());
    }
    public function getKasir()
    {
        $kasir = new UserLoginModel();
        return $this->lowerKey($kasir->getKasir());
    }
    public function getKeluar()
    {
        $statusPasien = new CaraKeluarModel();
        return $this->lowerKey($statusPasien->findAll());
    }
    public function getStatusPasien()
    {
        $statusPasien = new StatusPasienModel();
        return $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());
    }
    public function getEmployee()
    {
        $employee = new EmployeeAllModel();
        return $this->lowerKey($employee->findAll());
    }
    public function getPembayaran()
    {
        $ttModel = new TreatTarifModel();
        return $this->lowerKey($ttModel->whereIn("tarif_type", ['100', '200', '300', '400', '401', '500', '501', '600', '700', '800', '801', '802', '803', '900'])
            ->whereNotIn('treat_id', ['0002', '0003', '110001', '120001', '120002'])
            ->findAll());
    }
    public function getIsnew()
    {
        return ['Lama', 'Baru'];
    }

    public function getKota($kotaList)
    {
        $kotaModel = new KotaModel();
        return $this->lowerKey($kotaModel->whereIn('province_code', $kotaList)->findAll());
    }
    public function getSuffer()
    {
        $sufferModel = new SufferModel();
        $suffer = $this->lowerKey($sufferModel->findAll());
        return $suffer;
    }


    public function rl_2()
    {
        $giTipe = 7;
        $title = 'RL 2 Ketenagaan';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <td class="p-1">Tahun</td>
                    <td class="p-1">No</td>
                    <td class="p-1">Kualifikasi Pendidikan</td>
                    <td class="p-1">Keadaan Laki-Laki</td>
                    <td class="p-1">Keadaan Perempuan</td>
                    <td class="p-1">Kebutuhan Laki-Laki</td>
                    <td class="p-1">Kebutuhan Perempuan</td>
                    <td class="p-1">Kekurangan Laki-Laki</td>
                    <td class="p-1">Kekurangan Perempuan</td>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,


            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_2post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("SELECT 	ec.display,
                                            ec.description,
                                            oc.name_of_object_category , 
                                            count(ea.employee_id) as jml ,
                                            case when isnull(ea.gender,1) =  1 then 'Laki laki '
                                            else 'Perempuan' end as gender,
                                            oc.NAME_OF_OBJECT_CATEGORY
                                            from education_category ec 
                                            left outer join object_category oc  on   ec.object_category_id = oc.object_category_id  and oc.isorang = 40
                                            left outer join employee_all ea on  ea.education_type_code  = ec.education_category
                                            group by 
                                            oc.name_of_object_category,ec.display,ec.description, 	oc.object_category_id,isnull(ea.gender,1)
                                            order by oc.object_category_id
                                                ")->getResultArray());

        $groupedData = [];

        foreach ($data as $item) {
            $category = $item['name_of_object_category'];
            if (!isset($groupedData[$category])) {
                $groupedData[$category] = [
                    'description' => $item['description'],
                    'items' => []
                ];
            }


            $groupedData[$category]['items'][] = $item;
        }

        $dt_data     = array();
        if (!empty($groupedData)) {
            foreach ($groupedData as $key => $value) {
                $row[] = $key;

                foreach ($value['items'] as $item) {
                    $row = [];

                    $row[] = 2024;
                    $row[] = $item['display'];
                    $row[] = $item['description'];

                    if (strtolower(trim($item['gender'])) === 'laki laki') {
                        $row[] = $item['jml'];
                        $row[] = 0;
                    } elseif (strtolower(trim($item['gender'])) === 'perempuan') {
                        $row[] = 0;
                        $row[] = $item['jml'];
                    } else {
                        $row[] = 0;
                        $row[] = 0;
                    }

                    $row = array_merge($row, array_fill(0, 4, 0));

                    $dt_data[] = $row;
                }
            }
        }





        // return json_encode($kunjungan);


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_1()
    {
        $giTipe = 7;
        $title = 'RL 3.1 KEGIATAN PELAYANAN RAWAT INAP';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <td class="p-1">Tahun</td>
                    <td class="p-1">No</td>
                    <td class="p-1">Pelayanan</td>
                    <td class="p-1">Pasien Awal Tahun</td>
                    <td class="p-1">Pasien Masuk</td>
                    <td class="p-1">Pasien Keluar Hidup</td>
                    <td class="p-1">Mati &lt; 48 jam</td>
                    <td class="p-1">Mati &gt;= 48 jam</td>
                    <td class="p-1">Jumlah Lama Dirawat</td>
                    <td class="p-1">Pasien Akhir Tahun</td>
                    <td class="p-1">Jumlah Hari Perawatan</td>
                    <td class="p-1">VVIP</td>
                    <td class="p-1">VIP</td>
                    <td class="p-1">I</td>
                    <td class="p-1">II</td>
                    <td class="p-1">III</td>
                    <td class="p-1">Kelas Khusus</td>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_1post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                 SET @status = '%';



                                                    SELECT 
                                                        c.clinictype,
                                                        
                                                        isnull((select count(bill_id) from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir) and ta.clinic_type = c.clinic_type  AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') ),0)as masuk,
                                                        isnull((select count(bill_id) from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.exit_date >= dateadd(hour,0,@mulai) and ta.exit_date < dateadd(hour,24,@akhir) and keluar_id <> 0 and ta.clinic_type = c.clinic_type AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B')  and ta.keluar_id not in (0,3,4) ),0) as hidup,
                                                        isnull((select count(bill_id) from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.exit_date >= dateadd(hour,0,@mulai) and ta.exit_date < dateadd(hour,24,@akhir) and keluar_id <> 0 and ta.clinic_type = c.clinic_type AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status  and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B')and ta.keluar_id  in (3) ),0) as matik48,
                                                        isnull((select count(bill_id) from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.exit_date >= dateadd(hour,0,@mulai) and ta.exit_date < dateadd(hour,24,@akhir) and keluar_id <> 0 and ta.clinic_type = c.clinic_type AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B')  and ta.keluar_id  in (4) ),0) as matil48,
                                                        isnull((select count(bill_id) from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') and ta.treat_date < @mulai and (ta.keluar_id = 0 or ta.exit_date >= @mulai) and ta.clinic_type = c.clinic_type AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status  ),0) as awal ,
                                                        isnull((select sum(datediff(day,ta.treat_date, ta.exit_date)) from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.exit_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir) and ta.keluar_id <> 0 and ta.clinic_type = c.clinic_type and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)as lama,

                                                isnull((select sum( 1 + datediff(day, case  when ta.treat_date <  dateadd(hour,0,@mulai) then @mulai 
                                                                                                    when  ta.treat_date >=  dateadd(hour,0,@mulai) then ta.treat_date   end, 
                                                                                            case	when ta.exit_date >= dateadd(hour,24,@akhir) then @akhir 
                                                                                                    when ta.exit_date < dateadd(hour,24,@akhir) and ta.exit_date >= dateadd(hour,0,@mulai) then ta.exit_date 
                                                                                                    when ta.exit_date is null then @akhir 
                                                                                                    when ta.exit_date < @mulai then @akhir  
                                                                                                    when ta.exit_date is  null and ta.keluar_id = 0 then @akhir
                                                                                                    end ) ) 
                                                            from treatment_akomodasi ta where ta.CLASS_ROOM_ID in (select class_room_id from class_room) and ta.treat_date is not null and ((ta.treat_date >= dateadd(hour,0,@mulai) and ta.treat_date < dateadd(hour,24,@akhir)) 
                                                                    or(ta.treat_date >= dateadd(hour,0,@mulai) and ta.treat_date < dateadd(hour,24,@akhir) ) or( ta.exit_date >=dateadd(hour,0,@mulai) and ta.treat_date < dateadd(hour,24,@akhir))     
                                                                    or (ta.treat_date <= dateadd(hour,0,@mulai) and keluar_id = 0 ) or (ta.treat_date < dateadd(hour,0,@mulai) and ta.exit_date > = dateadd(hour,0,@mulai)) ) 
                                                                    and ta.clinic_type = c.clinic_type and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	
                                                        as hari,

                                                /*hari rawat VVIP*/
                                                isnull((select sum( 1 + datediff(day, case when ta.treat_date < @mulai then @mulai when  ta.treat_date >= @mulai then ta.treat_date   end, 
                                                case when ta.exit_date > @akhir  then @akhir when ta.exit_date <= @akhir and ta.exit_date >=@mulai then ta.exit_date 
                                                when ta.exit_date is null then @akhir when ta.exit_date < @mulai then @akhir  
                                                when ta.exit_date is not null and ta.keluar_id = 0 then @akhir end ) ) 
                                                from treatment_akomodasi ta where ta.treat_date is not null and ta.class_id = 8
                                                and ((ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir)) or (ta.treat_date <= @mulai and keluar_id = 0 )) 
                                                and  ta.clinic_type = c.clinic_type and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	as harivvip,

                                                /*hari rawat VIP*/
                                                isnull((select sum( 1 + datediff(day, case when ta.treat_date < @mulai then @mulai when  ta.treat_date >= @mulai then ta.treat_date   end, 
                                                case when ta.exit_date > @akhir  then @akhir when ta.exit_date <= @akhir and ta.exit_date >=@mulai then ta.exit_date 
                                                when ta.exit_date is null then @akhir when ta.exit_date < @mulai then @akhir  
                                                when ta.exit_date is not null and ta.keluar_id = 0 then @akhir end ) ) 
                                                from treatment_akomodasi ta where ta.treat_date is not null and ta.class_id in (6,7)
                                                and ((ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir)) or (ta.treat_date <= @mulai and keluar_id = 0 )) 
                                                and  ta.clinic_type = c.clinic_type and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	as harivip,

                                                /*hari rawat Kls 1*/
                                                isnull((select sum( 1 + datediff(day, case when ta.treat_date < @mulai then @mulai when  ta.treat_date >= @mulai then ta.treat_date   end, 
                                                case when ta.exit_date > @akhir  then @akhir when ta.exit_date <= @akhir and ta.exit_date >=@mulai then ta.exit_date 
                                                when ta.exit_date is null then @akhir when ta.exit_date < @mulai then @akhir  
                                                when ta.exit_date is not null and ta.keluar_id = 0 then @akhir end ) ) 
                                                from treatment_akomodasi ta where ta.treat_date is not null and ta.class_id = 2
                                                and ((ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir)) or (ta.treat_date <= @mulai and keluar_id = 0 )) 
                                                and  ta.clinic_type = c.clinic_type  and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	as harik1,

                                                /*hari rawat Kls 2*/
                                                isnull((select sum( 1 + datediff(day, case when ta.treat_date < @mulai then @mulai when  ta.treat_date >= @mulai then ta.treat_date   end, 
                                                case when ta.exit_date > @akhir  then @akhir when ta.exit_date <= @akhir and ta.exit_date >=@mulai then ta.exit_date 
                                                when ta.exit_date is null then @akhir when ta.exit_date < @mulai then @akhir  
                                                when ta.exit_date is not null and ta.keluar_id = 0 then @akhir end ) ) 
                                                from treatment_akomodasi ta where ta.treat_date is not null and ta.class_id = 3
                                                and ((ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir)) or (ta.treat_date <= @mulai and keluar_id = 0 )) 
                                                and  ta.clinic_type = c.clinic_type and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	as harik2,

                                                /*hari rawat Kls 3*/
                                                isnull((select sum( 1 + datediff(day, case when ta.treat_date < @mulai then @mulai when  ta.treat_date >= @mulai then ta.treat_date   end, 
                                                case when ta.exit_date > @akhir  then @akhir when ta.exit_date <= @akhir and ta.exit_date >=@mulai then ta.exit_date 
                                                when ta.exit_date is null then @akhir when ta.exit_date < @mulai then @akhir  
                                                when ta.exit_date is not null and ta.keluar_id = 0 then @akhir end ) ) 
                                                from treatment_akomodasi ta where ta.treat_date is not null and ta.class_id = 4
                                                and ((ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir)) or (ta.treat_date <= @mulai and keluar_id = 0 )) 
                                                and  ta.clinic_type = c.clinic_type  and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	as harik3,

                                                /*hari rawat non kelas diatas*/
                                                isnull((select sum( 1 + datediff(day, case when ta.treat_date < @mulai then @mulai when  ta.treat_date >= @mulai then ta.treat_date   end, 
                                                case when ta.exit_date > @akhir  then @akhir when ta.exit_date <= @akhir and ta.exit_date >=@mulai then ta.exit_date 
                                                when ta.exit_date is null then @akhir when ta.exit_date < @mulai then @akhir  
                                                when ta.exit_date is not null and ta.keluar_id = 0 then @akhir end ) ) 
                                                from treatment_akomodasi ta where ta.treat_date is not null and ta.class_id not in (6,7,8,2,3,4)
                                                and ((ta.treat_date between dateadd(hour,0,@mulai) and dateadd(hour,24,@akhir)) or (ta.treat_date <= @mulai and keluar_id = 0 )) 
                                                and  ta.clinic_type = c.clinic_type  and ta.SOLD_STATUS <> 9  and TA.CLINIC_ID NOT IN ('IDKR08B','IDKR09B') AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status ),0)	as harinon,
                                                        --isnull(( select tt_vip +tt_vvip + tt_1 +tt_2 +tt_3  from organizationunit),1)  as beds
                                                    isnull(( select SUM(FA_V)  from CLINIC),1)  as beds,
                                                    isnull((select count(bill_id) from treatment_akomodasi ta where ta.exit_date >= dateadd(hour,0,@mulai) and ta.exit_date < dateadd(hour,24,@akhir) and keluar_id <> 0 and ta.clinic_type = c.clinic_type AND CAST(ta.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @status  and datediff(day,ta.treat_date,ta.exit_date) = 0 ),0) as harisama

                                                FROM  clinic_type  c
                                                where clinic_type <> '0'

                                                order by c.clinic_type
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = '';
                $row[] = $index + 1;
                $row[] = $rows['clinictype'];
                $row[] = $rows['awal'];
                $row[] = $rows['masuk'];
                $row[] = $rows['hidup'];
                $row[] = $rows['matik48'];
                $row[] = $rows['matil48'];
                $row[] = $rows['lama'];
                $row[] = $rows['awal'] + $rows['masuk'] - $rows['hidup'] - $rows['matik48'] - $rows['matil48'];
                $row[] = $rows['hari'];
                $row[] = $rows['harivvip'];
                $row[] = $rows['harivip'];
                $row[] = $rows['harik1'];
                $row[] = $rows['harik2'];
                $row[] = $rows['harik3'];
                $row[] = $rows['harinon'];


                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_3()
    {
        $giTipe = 7;
        $title = 'RL 3.3 PELAYANAN GIGI MULUT';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                        <th class="p-1" style="width: 10px;">Tahun</th>
                        <th class="p-1">No</th>
                        <th class="p-1">Jenis Kegiatan</th>
                        <th class="p-1">Jumlah</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_3post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                SELECT  
                                                        t.treat_id, 
                                                        t.TREATMENT, 
                                                        ISNULL(
                                                            (SELECT COUNT(tb.bill_id)  
                                                            FROM TREATMENT_BILL tb 
                                                            WHERE tb.treat_date BETWEEN DATEADD(HOUR, 0, @mulai) AND DATEADD(HOUR, 24, @akhir)  
                                                            AND CAST(tb.status_pasien_id AS VARCHAR(3)) LIKE '%'  
                                                            AND tb.isrj LIKE '%' 
                                                            AND tb.tarif_id IN (SELECT tarif_id FROM treat_tarif WHERE LEFT(treat_id, 2) = 15 AND treat_id = t.treat_id)
                                                            ), 0) AS tarif,
                                                        (SELECT MIN(tb.treat_date) 
                                                        FROM TREATMENT_BILL tb 
                                                        WHERE tb.treat_date BETWEEN DATEADD(HOUR, 0, @mulai) AND DATEADD(HOUR, 24, @akhir)  
                                                        AND tb.tarif_id IN (SELECT tarif_id FROM treat_tarif WHERE LEFT(treat_id, 2) = 15 AND treat_id = t.treat_id)
                                                        ) AS treat_date 
                                                    FROM  
                                                        TREATMENT t 
                                                    WHERE 
                                                        LEFT(t.treat_id, 2) = 15  
                                                    GROUP BY 
                                                        t.treat_id, t.TREATMENT  
                                                    ORDER BY 
                                                        t.treat_id;
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';

                $row[] = $index + 1;
                $row[] = $rows['treatment'];
                $row[] = $rows['tarif'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_6()
    {
        $giTipe = 7;
        $title = 'RL 3.6 KEGIATAN PEMBEDAHAN';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Total</th>
                    <th class="p-1">Khusus</th>
                    <th class="p-1">Besar</th>
                    <th class="p-1">Sedang</th>
                    <th class="p-1">Kecil</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_6post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                SELECT 
                                                    t.display,
                                                    tl.level_id,
                                                    tl.treat_level,
                                                    ISNULL((SELECT COUNT(VACTINATION_ID) 
                                                            FROM PASIEN_OPERASI TB 
                                                            WHERE TB.ANESTESI_TYPE IN (
                                                                SELECT operation_type  
                                                                FROM OPERATION_TYPE tt 
                                                                WHERE tt.treat_id = t.treat_id 
                                                                AND tt.level_id = tl.level_id
                                                            ) 
                                                            AND TB.START_OPERATION BETWEEN DATEADD(HOUR, 0, @MULAI) 
                                                            AND DATEADD(HOUR, 24, @AKHIR)  
                                                            AND CAST(TB.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE @STATUS), 0) AS jml,
                                                    TB.START_OPERATION AS start_operation,
                                                    '' AS rlid
                                                    
                                                FROM 
                                                    treatment t
                                                JOIN 
                                                    treat_level tl ON t.treat_type LIKE '13' 
                                                LEFT JOIN 
                                                    PASIEN_OPERASI TB ON TB.ANESTESI_TYPE IN (
                                                        SELECT operation_type  
                                                        FROM OPERATION_TYPE tt 
                                                        WHERE tt.treat_id = t.treat_id 
                                                        AND tt.level_id = tl.level_id
                                                    )
                                                WHERE 
                                                    tl.level_id < 30;
                                                ")->getResultArray());

        $groupedData = [];
        $grandTotal = $grandKhusus = $grandBesar = $grandSedang = $grandKecil = 0;

        foreach ($data as $row) {
            $year = !empty($row['start_operation']) ? date('Y', strtotime($row['start_operation'])) : '';
            $groupedData[$year][$row['display']][] = $row;
        }



        $dt_data     = array();
        if (!empty($groupedData)) {
            $index = 0;

            foreach ($groupedData as $year => $displays) {
                foreach ($displays as $display => $group) {
                    $index++;

                    $total = $khusus = $besar = $sedang = $kecil = 0;

                    foreach ($group as $row) {
                        $total += $row['jml'];
                        switch ($row['level_id']) {
                            case '5':
                                $khusus += $row['jml'];
                                break;
                            case '4':
                                $besar += $row['jml'];
                                break;
                            case '3':
                                $sedang += $row['jml'];
                                break;
                            case '2':
                                $kecil += $row['jml'];
                                break;
                        }
                    }

                    $grandTotal += $total;
                    $grandKhusus += $khusus;
                    $grandBesar += $besar;
                    $grandSedang += $sedang;
                    $grandKecil += $kecil;
                    $row = [];
                    $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';
                    $row[] = $index;
                    $row[] = $display;
                    $row[] = $total;
                    $row[] = $khusus;
                    $row[] = $besar;
                    $row[] = $sedang;
                    $row[] = $kecil;

                    $dt_data[] = $row;
                }
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_7()
    {
        $giTipe = 7;
        $title = 'RL 3.7 KEGIATAN RADIOLOGI';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Jumlah</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_7post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                               select t.display,
                                                t.treatment,
                                                isnull (( select count(bill_id) from treatment_bill tb where TB.TREAT_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR)  AND 
                                                CAST(TB.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and   Tb.ISRJ LIKE '%' AND  TB.tarif_id in 
                                                (select tarif_id from treat_tarif tt where tt.treat_id = t.treat_id) ),0)	 as jml,
                                                (SELECT MIN(tb.treat_date) 
                                                        FROM TREATMENT_BILL tb 
                                                        WHERE tb.treat_date BETWEEN DATEADD(HOUR, 0, @mulai) AND DATEADD(HOUR, 24, @akhir)  
                                                        AND tb.tarif_id IN (SELECT tarif_id FROM treat_tarif tt WHERE tt.treat_id = t.treat_id)
                                                        ) AS treat_date
                                                from treatment t where treat_type = '08'
                                                order by t.display,t.treat_id
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';

                $row[] = $index + 1;
                $row[] = $rows['treatment'];
                $row[] = $rows['jml'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_8()
    {
        $giTipe = 7;
        $title = 'RL 3.8 KEGIATAN LABORATORIUM';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Jumlah</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_8post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                               select t.display,
                                                t.treatment,
                                                isnull (( select count(bill_id) from treatment_bill tb where TB.TREAT_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR)  AND 
                                                CAST(TB.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and   Tb.ISRJ LIKE '%' AND  TB.tarif_id in 
                                                (select tarif_id from treat_tarif tt where tt.treat_id = t.treat_id) ),0)as jml,
                                                (SELECT MIN(tb.treat_date) 
                                                    FROM TREATMENT_BILL tb 
                                                    WHERE tb.treat_date BETWEEN DATEADD(HOUR, 0, @mulai) AND DATEADD(HOUR, 24, @akhir)  
                                                     AND tb.tarif_id IN (SELECT tarif_id FROM treat_tarif tt WHERE tt.treat_id = t.treat_id)
                                                    ) AS treat_date
                                                from treatment t where treat_type = '23'
                                                order by t.display,t.treat_id
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';

                $row[] = $index + 1;
                $row[] = $rows['treatment'];
                $row[] = $rows['jml'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_9()
    {
        $giTipe = 7;
        $title = 'RL 3.9 REHABILITASI MEDIK';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Jumlah</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_9post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                select t.display,
                                                t.treatment,
                                                isnull (( select count(bill_id) from treatment_bill tb where TB.TREAT_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR)  AND 
                                                CAST(TB.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and   Tb.ISRJ LIKE '%' AND  TB.tarif_id in 
                                                (select tarif_id from treat_tarif tt where tt.treat_id = t.treat_id) ),0)	 as jml,
                                                    LEFT(T.DISPLAY,1) AS MAIN,
                                                    (SELECT MIN(tb.treat_date) 
                                                    FROM TREATMENT_BILL tb 
                                                    WHERE tb.treat_date BETWEEN DATEADD(HOUR, 0, @mulai) AND DATEADD(HOUR, 24, @akhir)  
                                                     AND tb.tarif_id IN (SELECT tarif_id FROM treat_tarif tt WHERE tt.treat_id = t.treat_id)
                                                    ) AS treat_date
                                                    from treatment t where treat_type = '16'
                                                    order by t.display,t.treat_id
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';

                $row[] = $index + 1;
                $row[] = $rows['treatment'];
                $row[] = $rows['jml'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_10()
    {
        $giTipe = 7;
        $title = 'RL 3.10 PELAYANAN KHUSUS';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Jumlah</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_10post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                select t.display,
                                                    t.treatment,
                                                    isnull (( select count(bill_id) from treatment_bill tb where TB.TREAT_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR)  AND 
                                                            CAST(TB.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and   Tb.ISRJ LIKE '%' AND  TB.tarif_id in 
                                                                (select tarif_id from treat_tarif tt where tt.treat_id = t.treat_id) ),0)	 as jml,

                                                    LEFT(T.DISPLAY,1) AS MAIN 
                                                from treatment t where treat_type = '35'
                                                order by t.treat_id
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';

                $row[] = $index + 1;
                $row[] = $rows['treatment'];
                $row[] = $rows['jml'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_11()
    {
        $giTipe = 7;
        $title = 'RL 3.11 KESEHATAN JIWA';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1">Tahun</th>
                    <th class="p-1">No</th>
                    <th class="p-1">Jenis Kegiatan</th>
                    <th class="p-1">Jumlah</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_11post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                               select t.display,
                                                    t.treatment,
                                                    isnull (( select count(bill_id) from treatment_bill tb where TB.TREAT_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR)  AND 
                                                            CAST(TB.STATUS_PASIEN_ID AS VARCHAR(3)) LIKE '%'  and   Tb.ISRJ LIKE '%' AND  TB.tarif_id in 
                                                                (select tarif_id from treat_tarif tt where tt.treat_id = t.treat_id) ),0)	 as jml,

                                                    LEFT(T.DISPLAY,1) AS MAIN 
                                                from treatment t where treat_type = '04'
                                                order by t.treat_id
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';

                $row[] = $index + 1;
                $row[] = $rows['treatment'];
                $row[] = $rows['jml'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_13()
    {
        $giTipe = 7;
        $title = 'RL 3.13 PENGADAAN OBAT';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center">Tahun</th>
                    <th class="p-1 align-middle text-center">Golongan Obat</th>
                    <th class="p-1 align-middle text-center">Jumlah Item Obat</th>
                    <th class="p-1 align-middle text-center">Jumlah Item Obat Tersedia Di Rumah Sakit</th>
                    <th class="p-1 align-middle text-center">Jumlah Item Obat Formularium Tersedia Di Rumah Sakit</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_13post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                               select   gt.generic ,
                                                                g.isactive,
                                                                g.isgeneric,  
                                                                g.isformularium, 
                                                                count(g.brand_id) as ada
                                                    from  generic_type gt,goods g 
                                                where g.isgeneric = gt.isgeneric
                                                    group by gt.generic,g.isgeneric, g.isformularium,g.isactive
                                                ")->getResultArray());


        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';
                $row[] = $rows['generic'];
                $row[] = $rows['ada'];
                $row[] = $rows['isactive'];
                $row[] = $rows['isformularium'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_14()
    {
        $giTipe = 7;
        $title = 'RL 3.14 KEGIATAN RUJUKAN';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center">Tahun</th>
                    <th class="p-1 align-middle text-center">No</th>
                    <th class="p-1 align-middle text-center">Jenis Spesialisasi</th>
                    <th class="p-1 align-middle text-center">Rujukan_Diterina dari Puskesmas</th>
                    <th class="p-1 align-middle text-center">Rujukan_Diterima dari fasilitas kesehatan lain</th>
                    <th class="p-1 align-middle text-center">Rujukan_Diterima dari RS lain</th>
                    <th class="p-1 align-middle text-center">Rujukan_Dikembalikan ke puskesmas</th>
                    <th class="p-1 align-middle text-center">Rujukan_Dikembalikan ke fasilitas faskes Lain</th>
                    <th class="p-1 align-middle text-center">Rujukan_Dikembalikan ke RS Asal</th>
                    <th class="p-1 align-middle text-center">Dirujuk Pasien Rujukan</th>
                    <th class="p-1 align-middle text-center">Dirujuk_Pasien Datang Sendiri</th>
                    <th class="p-1 align-middle text-center">Dirujuk Diterima Kembali</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_14post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                               select 
                                                    ct.clinic_type,
                                                    CT.CLINICTYPE,
                                                    pv.rujukan_id,
                                                    pv.follow_up,
                                                    ISNULL(count(pv.VISIT_ID),0) as jml 
                                                    
                                                    FROM clinic_type ct 
                                                    left outer join PASIEN_VISITATION PV on    PV.visit_date >= DATEADD(HOUR,0,@mulai)
                                                    AND PV.VISIT_DATE < DATEADD(HOUR,24,@akhir) 
                                                    AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC C WHERE C.CLINIC_TYPE = CT.CLINIC_TYPE ) 
                                                    WHERE CT.CLINIC_TYPE > 0
                                                    group by 
                                                    ct.clinic_type,
                                                    CT.CLINICTYPE,
                                                    pv.rujukan_id,
                                                    pv.follow_up
                                                    order by ct.clinic_type
                                                ")->getResultArray());
        $groupedData = [];

        foreach ($data as $current) {
            $key = $current['clinic_type'];

            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    "clinic_type" => $key,
                    "clinictype" => $current['clinictype'],
                    "totalJml" => 0,
                    "sub" => []
                ];
            }

            $groupedData[$key]['sub'][] = [
                "follow_up" => $current['follow_up'],
                "jml" => $current['jml'],
                "rujukan_id" => $current['rujukan_id']
            ];

            $groupedData[$key]['totalJml'] += $current['jml'];
        }
        $result = array_values($groupedData);


        $dt_data     = array();
        if (!empty($result)) {
            foreach ($result as $index => $rows) {
                $row = [];
                $row[] = !empty($rows['treat_date']) ? date('Y', strtotime($rows['treat_date'])) : '';
                $row[] = $index + 1;
                $row[] = $rows['clinictype'];
                $jumlahKolom4 = 0;
                $jumlahKolom5 = 0;
                $jumlahKolom6 = 0;
                $jumlahKolom7 = 0;
                $jumlahKolom8 = 0;
                $jumlahKolom9 = 0;
                $jumlahKolom10 = 0;
                $jumlahKolom11 = 0;

                foreach ($rows['sub'] as $subRow) {
                    if ($subRow['rujukan_id'] === "3" && $subRow['follow_up'] === "0") {
                        $jumlahKolom4 += $subRow['jml'] ?? 0;
                    }

                    if (!in_array($subRow['rujukan_id'], ["1", "3", "4", "5"])) {
                        $jumlahKolom5 += $subRow['jml'] ?? 0;
                    }

                    if (in_array($subRow['rujukan_id'], ["4", "5"])) {
                        $jumlahKolom6 += $subRow['jml'] ?? 0;
                    }

                    if ($subRow['follow_up'] == "9") {
                        $jumlahKolom7 += $subRow['jml'] ?? 0;
                    }

                    if (in_array($subRow['follow_up'], ["3", "8"])) {
                        $jumlahKolom8 += $subRow['jml'] ?? 0;
                    }

                    if ($subRow['follow_up'] == "7") {
                        $jumlahKolom9 += $subRow['jml'] ?? 0;
                    }

                    if ($subRow['follow_up'] == "2") {
                        $jumlahKolom10 += $subRow['jml'] ?? 0;
                    }

                    if ($subRow['rujukan_id'] == "1" && $subRow['follow_up'] != "0") {
                        $jumlahKolom11 += $subRow['jml'] ?? 0;
                    }
                }
                $row[] = $jumlahKolom4;
                $row[] = $jumlahKolom5;
                $row[] = $jumlahKolom6;
                $row[] = $jumlahKolom7;
                $row[] = $jumlahKolom8;
                $row[] = $jumlahKolom9;
                $row[] = $jumlahKolom10;
                $row[] = $jumlahKolom11;
                $row[] = 0;
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_3_15()
    {
        $giTipe = 7;
        $title = 'RL 3.15 CARA BAYAR';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center" rowspan="2">No</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Cara Pembayaran</th>
                    <th class="p-1 align-middle text-center" colspan="2">Pasien Rawat Inap</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Jumlah Pasien Rawat Jalan</th>
                    <th class="p-1 align-middle text-center" colspan="3">Jumlah Pasien Rawat Jalan</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center">Jumlah Pasien Keluar</th>
                    <th class="p-1 align-middle text-center">Jumlah Lama Dirawat</th>
                    <th class="p-1 align-middle text-center">Laboratorium</th>
                    <th class="p-1 align-middle text-center">Radiologi</th>
                    <th class="p-1 align-middle text-center">Lain-Lain</th>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_3_15post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                select pm.display,
                                                    pm.paymethod,
                                                        isnull(( select count(visit_id) from pasien_visitation pv where pv.exit_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) and
                                                                class_id_plafond  = pm.pay_method_id and keluar_id not in (0,32,33)   ),0) as PASIEN_ranap,
                                                        isnull(( select sum (datediff(day,in_date,exit_date)) from  pasien_visitation pv where pv.exit_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) and
                                                                class_id_plafond  = pm.pay_method_id and keluar_id not in (0,32,33)   ),0) as hari_RAWAT,
                                                isnull(( select count(visit_id) from pasien_visitation pv where pv.visit_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) and
                                                                class_id_plafond  = pm.pay_method_id and class_room_id is null   ),0) as PASIEN_ralan,
                                                isnull(( select count(visit_id) from pasien_visitation pv where pv.visit_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) and
                                                                class_id_plafond  = pm.pay_method_id and clinic_id = 'p012'   and class_room_id is null  ),0) as lab,
                                                isnull(( select count(visit_id) from pasien_visitation pv where pv.visit_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) and
                                                                class_id_plafond  = pm.pay_method_id and clinic_id = 'p016'   and class_room_id is null  ),0) as ro,
                                                isnull(( select count(visit_id) from pasien_visitation pv where pv.visit_DATE BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) and
                                                                class_id_plafond  = pm.pay_method_id and clinic_id not in ('p016', 'p012') and class_room_id is null ),0) as lain
                                                from payment_method pm
                                                where pm.display <> '2.3' order by pm.display ASC,  pm.paymethod ASC;
                                                ")->getResultArray());




        $dt_data     = array();
        if (!empty($data)) {
            foreach ($data as $index => $rows) {
                $row = [];
                $row[] = $rows['display'];
                $row[] = $rows['paymethod'];
                $row[] = $rows['pasien_ranap'];
                $row[] = $rows['hari_rawat'];
                $row[] = $rows['pasien_ralan'];
                $row[] = $rows['lab'];
                $row[] = $rows['ro'];
                $row[] = $rows['lain'];
                $dt_data[] = $row;
            }
        }


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_4_A()
    {
        $giTipe = 26;
        $title = 'RL 4-A DATA KEADAAN MORBIDITAS PASIEN RAWAT INAP RUMAH SAKIT';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center" rowspan="3">No</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No.DTD</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No. Daftar Terperinci</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Golongan Sebab-Sebab Sakit</th>
                    <th class="p-1 align-middle text-center" colspan="18">Pasien Keluar (Hidup - Mati) Menurut Golongan Umur</th>
                    <th class="p-1 align-middle text-center" colspan="3">Pasien Keluar (Hidup - Mati) Menurut Sex</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Jumlah Pasien Keluar Mati</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center" colspan="2">0 - 6 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2">7 - 28 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2"> < 1 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">1 - 4 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">5 - 14 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">15 - 24 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">25 - 44 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">45 - 64 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">>= 65 Tahun</th>
                    <th class="p-1 align-middle text-center" rowspan="2">L</th>
                    <th class="p-1 align-middle text-center" rowspan="2">P</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Jml</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>

                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_4_Apost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                SELECT isnull(D.OTHER_ID,d.OTHER_ID) AS ICD10
                                                    ,cast(d.dtd as varchar(200)) as dAFTARTERINCI
                                                                    ,D.english_diagnosa AS GOLONGAN_SAKIT
                                                                ,D.OTHER_ID AS NODTD	
                                                                ,1 as JML 
                                                                ,AR.age_range--A.AGE_RANGE
                                                                ,AR.DISPLAY as DISPLAYUMUR--A.DISPLAY
                                                                ,DATEDIFF(DAY,P.DATE_OF_BIRTH,PD.DATE_OF_DIAGNOSA) UMURHARI
                                                                ,AGEYEAR
                                                                ,AGEMONTH
                                                                ,AGEDAY
                                                                ,PD.STATUS_PASIEN_ID
                                                                ,ISRJ
                                                                ,PD.GENDER
                                                                ,PD.SUFFER_TYPE
                                                            
                                                                ,ISNULL(D.ISMENULAR,'0') AS MENULAR
                                                                ,ISNULL(D.ISSURVEYLANS,'0') AS SURVEYLANS
                                                                ,null as RW
                                                                ,null as ISACTIVE
                                                                ,PD.CLINIC_ID
                                                                ,PD.ORG_UNIT_CODE
                                                                ,MONTH(REPORT_DATE) AS BLN
                                                                ,YEAR(REPORT_DATE) AS TH
                                                                ,DAY(REPORT_DATE) AS HARI
                                                            
                                                                ,pd.result_id
                                                                    ,TT.RESULTS KONDISI -- KELUAR MATI KODE NNYA 2 DAN 3


                                                            FROM  DIAGNOSA D LEFT outer JOIN PASIEN_DIAGNOSA PD ON
                                                                    D.DIAGNOSA_ID = PD.DIAGNOSA_ID and
                                                                    d.other_id is not null		
                                                                    LEFT OUTER JOIN PASIEN P ON PD.NO_REGISTRATION = P.NO_REGISTRATION
                                                                    LEFT OUTER JOIN TREATMENT_RESULTS TT ON PD.RESULT_ID = TT.RESULT_ID
                                                                    LEFT OUTER JOIN AGE_RANGE AR ON  DATEDIFF(DAY,P.DATE_OF_BIRTH,PD.DATE_OF_DIAGNOSA)  BETWEEN  AR.LOWER_BOUND AND AR.UPPER_BOUND
                                                            WHERE PD.AGEYEAR >=0 AND PD.AGEYEAR IS NOT NULL and
                                                            PD.DATE_OF_DIAGNOSA BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) AND
                                                                    pd.class_room_id is not null 
                                                    
                                                                order by D.DIAGNOSA_ID
                                                ")->getResultArray());

        $groupedData = [];
        foreach ($data as $row) {
            $daftarterinci = $row['daftarterinci'];
            $gender = $row['gender'];
            $ageyear = $row['ageyear'];
            $result_id = $row['result_id'];

            if ($ageyear <= 0) {
                $ageGroup = '0_6_HR';
            } elseif ($ageyear <= 1) {
                $ageGroup = '7_28_HR';
            } elseif ($ageyear < 1) {
                $ageGroup = '<1_TH';
            } elseif ($ageyear <= 4) {
                $ageGroup = '1_4_TH';
            } elseif ($ageyear <= 14) {
                $ageGroup = '5_14_TH';
            } elseif ($ageyear <= 24) {
                $ageGroup = '15_24_TH';
            } elseif ($ageyear <= 44) {
                $ageGroup = '25_44_TH';
            } elseif ($ageyear <= 64) {
                $ageGroup = '45_64_TH';
            } else {
                $ageGroup = '>=65_TH';
            }

            if (!isset($groupedData[$daftarterinci][$ageGroup])) {
                $groupedData[$daftarterinci][$ageGroup] = [
                    'icd10' => $row['icd10'],
                    'nodtd' => $row['nodtd'],
                    'golongan_sakit' => $row['golongan_sakit'],
                    'L' => 0,
                    'P' => 0,
                    'mati' => 0,
                ];
            }

            if ($gender == '1') {
                $groupedData[$daftarterinci][$ageGroup]['L'] += $row['jml'];
            } else {
                $groupedData[$daftarterinci][$ageGroup]['P'] += $row['jml'];
            }

            if ($result_id == 2 || $result_id == 3) {
                $groupedData[$daftarterinci][$ageGroup]['mati'] += $row['jml'];
            }
        }


        $dt_data     = array();
        if (!empty($groupedData)) {
            foreach ($groupedData as $daftarterinci => $ageGroups) {
                $totalL = 0;
                $totalP = 0;
                $totalMati = 0;
                $index = 1;


                foreach ($ageGroups as $key => $value) {
                    $totalL += is_numeric($value['L']) ? $value['L'] : 0;
                    $totalP += is_numeric($value['P']) ? $value['P'] : 0;
                    $totalMati += is_numeric($value['mati']) ? $value['mati'] : 0;

                    $row = [];
                    $row[] = $index++;
                    $row[] = $value['nodtd'];
                    $row[] = $daftarterinci;
                    $row[] = $value['golongan_sakit'];

                    for ($i = 0; $i < 9; $i++) {
                        $ageLabel = ['0_6_HR', '7_28_HR', '<1_TH', '1_4_TH', '5_14_TH', '15_24_TH', '25_44_TH', '45_64_TH', '>=65_TH'][$i];
                        $row[] = ($key == $ageLabel) ? ($value['L'] ?? 0) : 0;
                        $row[] = ($key == $ageLabel) ? ($value['P'] ?? 0) : 0;
                    }

                    $row[] = $totalL;
                    $row[] = $totalP;
                    $row[] = $totalL + $totalP;
                    $row[] = $totalMati;
                    $dt_data[] = $row;
                }
            }
        }

        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center" rowspan="3">No</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No.DTD</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No. Daftar Terperinci</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Golongan Sebab-Sebab Sakit</th>
                    <th class="p-1 align-middle text-center" colspan="18">Pasien Keluar (Hidup - Mati) Menurut Golongan Umur</th>
                    <th class="p-1 align-middle text-center" colspan="3">Pasien Keluar (Hidup - Mati) Menurut Sex</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Jumlah Pasien Keluar Mati</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center" colspan="2">0 - 6 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2">7 - 28 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2"> < 1 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">1 - 4 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">5 - 14 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">15 - 24 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">25 - 44 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">45 - 64 Tahun</th>
                    <th class="p-1 align-middle text-center" colspan="2">>= 65 Tahun</th>
                    <th class="p-1 align-middle text-center" rowspan="2">L</th>
                    <th class="p-1 align-middle text-center" rowspan="2">P</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Jml</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>

                </tr>';

        $json_data = array(
            "body"            => $dt_data,
            "header"        => $header
        );
        echo json_encode($json_data);
    }
    public function rl_4_B()
    {
        $giTipe = 7;
        $title = 'RL 4-B DATA KEADAAN MORBIDITAS PASIEN RAWAT JALAN RUMAH SAKIT';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1, 2, 3, 5])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }


        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center" rowspan="3">No</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No.DTD</th>
                    <th class="p-1 align-middle text-center" rowspan="3">No. Daftar Terperinci</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Golongan Sebab-Sebab Sakit</th>
                    <th class="p-1 align-middle text-center" colspan="18">Kasus Baru Menurut Golongan Umur</th>
                    <th class="p-1 align-middle text-center" colspan="3">Kasus baru Menurut Sex</th>
                    <th class="p-1 align-middle text-center" rowspan="3">Jumlah Kunjungan</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center" colspan="2">0 - 6 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2">7 - 28 HR</th>
                    <th class="p-1 align-middle text-center" colspan="2">
                        < 1 TH</th>
                    <th class="p-1 align-middle text-center" colspan="2">1 - 4 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">5 - 14 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">15 - 24 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">25 - 44 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">45 - 64 th</th>
                    <th class="p-1 align-middle text-center" colspan="2">>= 65 th</th>
                    <th class="p-1 align-middle text-center" rowspan="2">L</th>
                    <th class="p-1 align-middle text-center" rowspan="2">P</th>
                    <th class="p-1 align-middle text-center" rowspan="2">Jml</th>
                </tr>
                <tr>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>
                    <th class="p-1 align-middle text-center">L</th>
                    <th class="p-1 align-middle text-center">P</th>

                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_4_Bpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("DECLARE @mulai DATETIME;
                                                DECLARE @akhir DATETIME;
                                                DECLARE @status VARCHAR(50);
                                                SET @mulai = CONVERT(DATETIME, '$mulai', 120);
                                                SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
                                                SELECT         isnull(D.OTHER_ID,d.OTHER_ID) AS ICD10
                                                    ,cast(d.dtd as varchar(200)) as dAFTARTERINCI
                                                                    ,D.english_diagnosa AS GOLONGAN_SAKIT
                                                                ,D.OTHER_ID AS NODTD	
                                                                ,1 as JML 
                                                                ,AR.age_range--A.AGE_RANGE
                                                                ,AR.DISPLAY as DISPLAYUMUR--A.DISPLAY
                                                                ,DATEDIFF(DAY,P.DATE_OF_BIRTH,PD.DATE_OF_DIAGNOSA) UMURHARI
                                                                ,AGEYEAR
                                                                ,AGEMONTH
                                                                ,AGEDAY
                                                                ,PD.STATUS_PASIEN_ID
                                                                ,ISRJ
                                                                ,PD.GENDER
                                                                ,PD.SUFFER_TYPE
                                                                ,st.SUFFER
                                                            
                                                                ,ISNULL(D.ISMENULAR,'0') AS MENULAR
                                                                ,ISNULL(D.ISSURVEYLANS,'0') AS SURVEYLANS
                                                                ,null as RW
                                                                ,null as ISACTIVE
                                                                ,PD.CLINIC_ID
                                                                ,PD.ORG_UNIT_CODE
                                                                ,MONTH(REPORT_DATE) AS BLN
                                                                ,YEAR(REPORT_DATE) AS TH
                                                                ,DAY(REPORT_DATE) AS HARI
                                                            
                                                                ,pd.result_id
                                                                    


                                                            FROM  DIAGNOSA D LEFT outer JOIN PASIEN_DIAGNOSA PD ON
                                                                    D.DIAGNOSA_ID = PD.DIAGNOSA_ID and
                                                                    d.other_id is not null		
                                                                    LEFT OUTER JOIN PASIEN P ON PD.NO_REGISTRATION = P.NO_REGISTRATION
                                                                left outer join SUFFER_TYPE st on st.SUFFER_TYPE =pd.SUFFER_TYPE 
                                                                    LEFT OUTER JOIN AGE_RANGE AR ON  DATEDIFF(DAY,P.DATE_OF_BIRTH,PD.DATE_OF_DIAGNOSA)  BETWEEN  AR.LOWER_BOUND AND AR.UPPER_BOUND
                                                            WHERE PD.AGEYEAR >=0 AND PD.AGEYEAR IS NOT NULL and

                                                            PD.DATE_OF_DIAGNOSA BETWEEN DATEADD(HOUR,0,@MULAI) AND DATEADD(HOUR,24,@AKHIR) AND
                                                                    pd.class_room_id is  null 

                                                                order by pd.DIAGNOSA_ID
                                                ")->getResultArray());

        $groupedData = [];
        $totalVisits = 0;

        foreach ($data as $row) {
            $daftarterinci = $row['daftarterinci'];
            $gender = $row['gender'];
            $ageyear = $row['ageyear'];
            $result_id = $row['result_id'];
            $suffer_type = @$row['suffer_type'];

            if ($ageyear <= 0) {
                $ageGroup = '0_6_HR';
            } elseif ($ageyear <= 1) {
                $ageGroup = '7_28_HR';
            } elseif ($ageyear < 1) {
                $ageGroup = '<1_TH';
            } elseif ($ageyear <= 4) {
                $ageGroup = '1_4_TH';
            } elseif ($ageyear <= 14) {
                $ageGroup = '5_14_TH';
            } elseif ($ageyear <= 24) {
                $ageGroup = '15_24_TH';
            } elseif ($ageyear <= 44) {
                $ageGroup = '25_44_TH';
            } elseif ($ageyear <= 64) {
                $ageGroup = '45_64_TH';
            } else {
                $ageGroup = '>=65_TH';
            }

            if (!isset($groupedData[$daftarterinci][$ageGroup])) {
                $groupedData[$daftarterinci][$ageGroup] = [
                    'icd10' => $row['icd10'],
                    'nodtd' => $row['nodtd'],
                    'golongan_sakit' => $row['golongan_sakit'],
                    'L' => 0,
                    'P' => 0,
                    'mati' => 0,
                ];
            }

            if ($gender == '1' && ($suffer_type == 0 || $suffer_type == 1)) {
                $groupedData[$daftarterinci][$ageGroup]['L'] += $row['jml'];
            } elseif ($gender == '2' && ($suffer_type == 0 || $suffer_type == 1)) {
                $groupedData[$daftarterinci][$ageGroup]['P'] += $row['jml'];
            }

            $totalVisits += $row['jml'];
        }


        $dt_data     = array();
        if (!empty($groupedData)) {
            foreach ($groupedData as $daftarterinci => $ageGroups) {
                $totalL = 0;
                $totalP = 0;
                $totalMati = 0;
                $index = 1;


                foreach ($ageGroups as $key => $value) {
                    $totalL += is_numeric($value['L']) ? $value['L'] : 0;
                    $totalP += is_numeric($value['P']) ? $value['P'] : 0;
                    $totalMati += is_numeric($value['mati']) ? $value['mati'] : 0;

                    $row = [];
                    $row[] = $index++;
                    $row[] = $value['nodtd'];
                    $row[] = $daftarterinci;
                    $row[] = $value['golongan_sakit'];

                    for ($i = 0; $i < 9; $i++) {
                        $ageLabel = ['0_6_HR', '7_28_HR', '<1_TH', '1_4_TH', '5_14_TH', '15_24_TH', '25_44_TH', '45_64_TH', '>=65_TH'][$i];
                        $row[] = ($key == $ageLabel) ? ($value['L'] ?? 0) : 0;
                        $row[] = ($key == $ageLabel) ? ($value['P'] ?? 0) : 0;
                    }

                    $row[] = $totalL;
                    $row[] = $totalP;
                    $row[] = $totalL + $totalP;
                    $row[] = $totalVisits;
                    $dt_data[] = $row;
                }
            }
        }



        // return json_encode($kunjungan);


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
}
