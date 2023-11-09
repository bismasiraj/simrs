<?php

namespace App\Controllers\Admin;

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
    private function getOrgCode()
    {
        $org = new OrganizationunitModel();
        $orgAll = $org->findAll();
        return $orgAll[0];
    }
    private function getImgTime()
    {
        $img_time = new Time('now');
        return $img_time->getTimestamp();
    }
    private function getTimestampInv($dateintv)
    {
        $seconds = ($dateintv->format("%s"))
            + ($dateintv->format("%i") * 60)
            + ($dateintv->format("%h") * 60 * 60)
            + ($dateintv->format("%d") * 60 * 60 * 24)
            + ($dateintv->format("%m") * 60 * 60 * 24 * 30)
            + ($dateintv->format("%y") * 60 * 60 * 24 * 365);
        return $seconds;
    }

    private function getClinic($stype)
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

    private function getShift()
    {
        $model = new ShiftDaysModel();
        $shift = $this->lowerKey($model->findAll());
        return $shift;
    }
    private function getRegulation()
    {
        $model = new RegulationTypeModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }
    private function getMeasurement()
    {
        $model = new MeasurementModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }
    private function getCompany()
    {
        $model = new CompanyModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }
    private function getDistribution()
    {
        $model = new DistributionTypeModel();
        $select = $this->lowerKey($model->findAll());
        return $select;
    }

    private function getSex()
    {
        $sexModel = new SexModel();
        return $this->lowerKey($sexModel->findAll());
    }
    private function getKasir()
    {
        $kasir = new UserLoginModel();
        return $this->lowerKey($kasir->getKasir());
    }
    private function getKeluar()
    {
        $statusPasien = new CaraKeluarModel();
        return $this->lowerKey($statusPasien->findAll());
    }
    private function getStatusPasien()
    {
        $statusPasien = new StatusPasienModel();
        return $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());
    }
    private function getEmployee()
    {
        $employee = new EmployeeAllModel();
        return $this->lowerKey($employee->findAll());
    }
    private function getPembayaran()
    {
        $ttModel = new TreatTarifModel();
        return $this->lowerKey($ttModel->whereIn("tarif_type", ['100', '200', '300', '400', '401', '500', '501', '600', '700', '800', '801', '802', '803', '900'])
            ->whereNotIn('treat_id', ['0002', '0003', '110001', '120001', '120002'])
            ->findAll());
    }
    private function getIsnew()
    {
        return ['Lama', 'Baru'];
    }

    private function getKota($kotaList)
    {
        $kotaModel = new KotaModel();
        return $this->lowerKey($kotaModel->whereIn('province_code', $kotaList)->findAll());
    }
    private function getSuffer()
    {
        $sufferModel = new SufferModel();
        $suffer = $this->lowerKey($sufferModel->findAll());
        return $suffer;
    }
    public function registerpoli()
    {
        $giTipe = 7;
        $title = 'Register Poli';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['register'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        // return json_encode($selectedMenu);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [1])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        // $vs = new IsattendedsModel();
        // $visitStatus = $this->lowerKey($vs->findAll());

        // $scheduleModel = new DoctorScheduleModel();
        // $schedule = $this->lowerKey($scheduleModel->getSchedule());

        // $dokter = array();


        // foreach ($clinic as $key => $value) {
        //     $selectDokter = array();

        //     foreach ($schedule as $key1 => $value1) {
        //         if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
        //             $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
        //         }
        //     }
        //     $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
        //     unset($selectDokter);
        // }


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            // 'dokter' => $dokter,
            'status' => $status,
            // 'visitStatus' => $visitStatus
        ]);
    }
    public function registerpolipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getregisterpoli($mulai, $akhir, $status_pasien_id, '1', $clinic_id, '%'));



        // colecting parameter
        $faskesModel = new InasisFaskesModel();
        $faskes = $this->lowerKey($faskesModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->findAll());

        $followupModel = new FollowUpModel();
        $followup = $this->lowerKey($followupModel->findAll());


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {


                foreach ($value as $key1 => $value1) {

                    if ($value1 == '' || is_null($value1)) {
                        $kunjungan[$key][$key1] = '-';
                    }
                }

                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['status_pasien_id'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['employee_id'] = $employee[$key1]['fullname'];
                    }
                }
                foreach ($faskes as $key1 => $value1) {
                    if ($kunjungan[$key]['ppkrujukan'] == $faskes[$key1]['kdprovider']) {
                        $kunjungan[$key]['ppkrujukan'] = $faskes[$key1]['nmprovider'];
                    }
                }
                foreach ($followup as $key1 => $value1) {
                    if ($kunjungan[$key]['follow_up'] == $followup[$key1]['follow_up']) {
                        $kunjungan[$key]['follow_up'] = $followup[$key1]['followup'];
                    }
                }




                $row = array();
                $row[] = $key + 1;
                $row[] = substr($kunjungan[$key]['tanggal'], 0, 10);
                $row[] = $kunjungan[$key]['name_of_clinic'];

                if ($kunjungan[$key]['isnew'] == '1') {
                    $row[] = $kunjungan[$key]['no_registration'];
                } else {
                    $row[] = '';
                }
                if ($kunjungan[$key]['isnew'] == '0') {
                    $row[] = $kunjungan[$key]['no_registration'];
                } else {
                    $row[] = '';
                }
                $row[] = $kunjungan[$key]['nama'];
                if ($kunjungan[$key]['kelamin'] == '1') {
                    $row[] = $kunjungan[$key]['umur'];
                    $row[] = '';
                } else {
                    $row[] = '';
                    $row[] = $kunjungan[$key]['umur'];
                }

                $row[] = $kunjungan[$key]['alamat'];
                $row[] = $kunjungan[$key]['kal_id'];
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = $kunjungan[$key]['pasien_id'];
                $row[] = $kunjungan[$key]['no_skp'];
                $row[] = $kunjungan[$key]['employee_id'];
                $row[] = $kunjungan[$key]['diagnosa_id'];
                $row[] = $kunjungan[$key]['diagnosa_id'];
                $row[] = $kunjungan[$key]['ppkrujukan'];
                $row[] = $kunjungan[$key]['norujukan'];
                $row[] = $kunjungan[$key]['tanggal_rujukan'];
                $row[] = $kunjungan[$key]['diag_awal'] . '-' . $kunjungan[$key]['conclusion'];
                if ($kunjungan[$key]['suffer_type'] == 1) {
                    $row[] = 'BARU';
                } else {
                    $row[] = 'LAMA';
                }
                $row[] = $kunjungan[$key]['follow_up'];

                $dt_data[] = $row;
            }
        }
        // return json_encode($kunjungan);

        $header = [];
        $header = '<tr">
        <th rowspan="2">No</th>
        <th rowspan="2">Tanggal Kunjungan</th>
        <th rowspan="2">Pelayanan</th>
        <th colspan="2">No RM</th>
        <th rowspan="2">Nama</th>
        <th colspan="2">Umur</th>
        <th rowspan="2">Alamat</th>
        <th rowspan="2">Kelurahan</th>
        <th rowspan="2">Status Bayar</th>
        <th rowspan="2">No Kartu</th>
        <th rowspan="2">No SEP</th>
        <th rowspan="2">Dokter</th>
        <th colspan="2">Diagnosa</th>
        <th rowspan="2">Asal Rujukan</th>
        <th rowspan="2">No. Rujukan</th>
        <th rowspan="2">Tgl Rujukan</th>
        <th rowspan="2">Diagnosa Awal</th>
        <th rowspan="2">Kasus</th>
        <th rowspan="2">Dirujuk Ke</th>
        </tr>
        <tr">
            <th>Baru</th>
            <th>Lama</th>
            <th>Laki</th>
            <th>Perempuan</th>
            <th>ICD X</th>
            <th>Nama</th>
        </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        return json_encode($json_data);
    }

    public function registermasuk()
    {
        $giTipe = 7;
        $title = 'Register Pasien Masuk Rawat Inap';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['register'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'status' => $status,
        ]);
    }

    public function registermasukpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getregistermasuk($mulai, $akhir, $status_pasien_id, '1', $clinic_id));



        // colecting parameter
        $faskesModel = new InasisFaskesModel();
        $faskes = $this->lowerKey($faskesModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->findAll());

        $kalModel = new KalurahanModel();
        $kalurahan = $this->lowerKey($kalModel->findAll());

        $diagModel = new DiagnosaModel();


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {


                foreach ($value as $key1 => $value1) {

                    if ($value1 == '' || is_null($value1)) {
                        $kunjungan[$key][$key1] = '-';
                    }
                }

                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['status_pasien_id'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_inap'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['employee_inap'] = $employee[$key1]['fullname'];
                    }
                }
                foreach ($faskes as $key1 => $value1) {
                    if ($kunjungan[$key]['ppkrujukan'] == $faskes[$key1]['kdprovider']) {
                        $kunjungan[$key]['ppkrujukan'] = $faskes[$key1]['nmprovider'];
                    }
                }
                foreach ($kalurahan as $key1 => $value1) {
                    if ($kunjungan[$key]['kal_id'] == $kalurahan[$key1]['kal_id']) {
                        $kunjungan[$key]['kal_id'] = $kalurahan[$key1]['kalurahan'];
                    }
                }

                $diagid = $kunjungan[$key]['diagnosa_id'];


                $diagnosa = $this->lowerKey($diagModel->where('diagnosa_id', $kunjungan[$key]['diagnosa_id'])->findAll());
                foreach ($diagnosa as $key1 => $value1) {
                    if ($kunjungan[$key]['diagnosa_id'] == $diagnosa[$key1]['diagnosa_id']) {
                        $kunjungan[$key]['diagnosa_id'] = $diagnosa[$key1]['name_of_diagnosa'];
                    }
                }
                // return json_encode($kunjungan);
                // $kunjungan[$key]['name_of_diagnosa'] = $diagnosa['NAME_OF_DIAGNOSA'];



                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['tgl'];
                $row[] = $kunjungan[$key]['diantar_oleh'];

                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['kelamin'];

                $row[] = $kunjungan[$key]['umur'];
                $row[] = $kunjungan[$key]['visitor_address'];
                $row[] = $kunjungan[$key]['kal_id'];
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = $kunjungan[$key]['pasien_id'];
                $row[] = $kunjungan[$key]['no_skpinap'];
                $row[] = $kunjungan[$key]['name_of_class'];
                $row[] = $kunjungan[$key]['employee_inap'];
                $row[] = $diagid;
                $row[] = $kunjungan[$key]['diagnosa_id'];
                // dd($kunjungan[$key]['diagnosa_id']);
                // $row[] = $kunjungan[$key]['name_of_diagnosa'];
                $row[] = $kunjungan[$key]['ppkrujukan'];
                $row[] = $kunjungan[$key]['norujukan'];
                $row[] = $kunjungan[$key]['tanggal_rujukan'];
                $row[] = $kunjungan[$key]['diag_awal'] . ' - ' . $kunjungan[$key]['conclusion'];


                $dt_data[] = $row;
            }
        }
        // return json_encode($kunjungan);

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>No.CM</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Kecamatan</th>
                        <th>Status Bayar</th>
                        <th>No.Kartu</th>
                        <th>No.SEP</th>
                        <th>Bangsal</th>
                        <th>Dokter</th>
                        <th colspan="2">Diagnosa</th>
                        <th>Asal Rujukan</th>
                        <th>No.Rujukan</th>
                        <th>Tgl Rujukan</th>
                        <th>Diagnosa Awal</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        return json_encode($json_data);
    }

    public function registerkeluar()
    {
        $giTipe = 7;
        $title = 'Register Pasien Keluar Rawat Inap';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['register'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'status' => $status,
        ]);
    }

    public function registerkeluarpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getregisterkeluar($mulai, $akhir, $status_pasien_id, '1', $clinic_id));



        // colecting parameter
        $faskesModel = new InasisFaskesModel();
        $faskes = $this->lowerKey($faskesModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->findAll());

        // $kalModel = new KalurahanModel();
        // $kalurahan = $this->lowerKey($kalModel->findAll());

        $crModel = new ClassRoomModel();
        $classRoom = $this->lowerKey($crModel->findAll());

        // $diagModel = new DiagnosaModel();


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {


                foreach ($value as $key1 => $value1) {

                    if ($value1 == '' || is_null($value1)) {
                        $kunjungan[$key][$key1] = '-';
                    }
                }

                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['status_pasien_id'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['employee_id'] = $employee[$key1]['fullname'];
                    }
                }
                foreach ($faskes as $key1 => $value1) {
                    if ($kunjungan[$key]['ppkrujukan'] == $faskes[$key1]['kdprovider']) {
                        $kunjungan[$key]['ppkrujukan'] = $faskes[$key1]['nmprovider'];
                    }
                }
                foreach ($classRoom as $key1 => $value1) {
                    if ($kunjungan[$key]['class_room_id'] == $classRoom[$key1]['class_room_id']) {
                        $kunjungan[$key]['class_room_id'] = $classRoom[$key1]['name_of_class'];
                    }
                }


                // // $diagid = $kunjungan[$key]['diagnosa_id'];


                // // $diagnosa = $this->lowerKey($diagModel->where('diagnosa_id', $kunjungan[$key]['diagnosa_id'])->findAll());
                // // foreach ($diagnosa as $key1 => $value1) {
                // //     if ($kunjungan[$key]['diagnosa_id'] == $diagnosa[$key1]['diagnosa_id']) {
                // //         $kunjungan[$key]['diagnosa_id'] = $diagnosa[$key1]['name_of_diagnosa'];
                // //     }
                // // }
                // // return json_encode($kunjungan);
                // // $kunjungan[$key]['name_of_diagnosa'] = $diagnosa['NAME_OF_DIAGNOSA'];



                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['th'] . " - " . $kunjungan[$key]['bln'] . " - " . $kunjungan[$key]['hr'];
                $row[] = $kunjungan[$key]['diantar_oleh'];

                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['kelamin'];

                $row[] = $kunjungan[$key]['umur'];
                $row[] = $kunjungan[$key]['visitor_address'];
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = $kunjungan[$key]['pasien_id'];
                $row[] = $kunjungan[$key]['no_skpinap'];
                $row[] = $kunjungan[$key]['class_room_id'];
                $row[] = $kunjungan[$key]['employee_id'];
                $row[] = $kunjungan[$key]['description'];
                $row[] = $kunjungan[$key]['keluar_id'];
                $row[] = $kunjungan[$key]['ppkrujukan'];
                $row[] = $kunjungan[$key]['norujukan'];
                $row[] = $kunjungan[$key]['tanggal_rujukan'];
                $row[] = $kunjungan[$key]['diag_awal'] . ' - ' . $kunjungan[$key]['conclusion'];


                $dt_data[] = $row;
            }
        }

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>No.CM</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Status Bayar</th>
                        <th>No.Kartu</th>
                        <th>No.SEP</th>
                        <th>Bangsal</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Cara Keluar</th>
                        <th>Asal Rujukan</th>
                        <th>No.Rujukan</th>
                        <th>Tgl Rujukan</th>
                        <th>Diagnosa Awal</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        echo json_encode($json_data);
    }

    public function registerpindah()
    {
        $giTipe = 7;
        $title = 'Register Pasien Pindah Rawat Inap';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['register'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'status' => $status,
        ]);
    }

    public function registerpindahpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getregisterkeluar($mulai, $akhir, $status_pasien_id, '1', $clinic_id));



        // colecting parameter
        $faskesModel = new InasisFaskesModel();
        $faskes = $this->lowerKey($faskesModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->findAll());

        // $kalModel = new KalurahanModel();
        // $kalurahan = $this->lowerKey($kalModel->findAll());

        $crModel = new ClassRoomModel();
        $classRoom = $this->lowerKey($crModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $keluarModel = new CaraKeluarModel();
        $keluar = $this->lowerKey($keluarModel->findAll());


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {


                foreach ($value as $key1 => $value1) {

                    if ($value1 == '' || is_null($value1)) {
                        $kunjungan[$key][$key1] = '-';
                    }
                }

                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['status_pasien_id'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['employee_id'] = $employee[$key1]['fullname'];
                    }
                }
                foreach ($faskes as $key1 => $value1) {
                    if ($kunjungan[$key]['ppkrujukan'] == $faskes[$key1]['kdprovider']) {
                        $kunjungan[$key]['ppkrujukan'] = $faskes[$key1]['nmprovider'];
                    }
                }
                foreach ($classRoom as $key1 => $value1) {
                    if ($kunjungan[$key]['class_room_id'] == $classRoom[$key1]['class_room_id']) {
                        $kunjungan[$key]['class_room_id'] = $classRoom[$key1]['name_of_class'];
                    }
                }
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['clinic_id_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                foreach ($keluar as $key1 => $value1) {
                    if ($kunjungan[$key]['keluar_id'] == $keluar[$key1]['keluar_id']) {
                        $kunjungan[$key]['keluar_id'] = $keluar[$key1]['cara_keluar'];
                    }
                }


                // // $diagid = $kunjungan[$key]['diagnosa_id'];


                // // $diagnosa = $this->lowerKey($diagModel->where('diagnosa_id', $kunjungan[$key]['diagnosa_id'])->findAll());
                // // foreach ($diagnosa as $key1 => $value1) {
                // //     if ($kunjungan[$key]['diagnosa_id'] == $diagnosa[$key1]['diagnosa_id']) {
                // //         $kunjungan[$key]['diagnosa_id'] = $diagnosa[$key1]['name_of_diagnosa'];
                // //     }
                // // }
                // // return json_encode($kunjungan);
                // // $kunjungan[$key]['name_of_diagnosa'] = $diagnosa['NAME_OF_DIAGNOSA'];



                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['th'] . " - " . $kunjungan[$key]['bln'] . " - " . $kunjungan[$key]['hr'];
                $row[] = $kunjungan[$key]['diantar_oleh'];

                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['kelamin'];

                $row[] = $kunjungan[$key]['umur'];
                $row[] = $kunjungan[$key]['visitor_address'];
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = $kunjungan[$key]['pasien_id'];
                $row[] = $kunjungan[$key]['no_skpinap'];
                $row[] = $kunjungan[$key]['clinic_id_from'];
                $row[] = $kunjungan[$key]['class_room_id'];
                $row[] = $kunjungan[$key]['employee_id'];
                $row[] = $kunjungan[$key]['diagnosa_id'] . " - " . $kunjungan[$key]['description'];
                $row[] = $kunjungan[$key]['keluar_id'];
                $row[] = $kunjungan[$key]['ppkrujukan'];
                $row[] = $kunjungan[$key]['norujukan'];
                $row[] = $kunjungan[$key]['tanggal_rujukan'];
                $row[] = $kunjungan[$key]['diag_awal'] . ' - ' . $kunjungan[$key]['conclusion'];


                $dt_data[] = $row;
            }
        }

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>No.CM</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Status Bayar</th>
                        <th>No.Kartu</th>
                        <th>No.SEP</th>
                        <th>Dari Bangsal</th>
                        <th>Ke Bangsal</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Cara Keluar</th>
                        <th>Asal Rujukan</th>
                        <th>No.Rujukan</th>
                        <th>Tgl Rujukan</th>
                        <th>Diagnosa Awal</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        echo json_encode($json_data);
    }

    public function registermelahirkan()
    {
        $giTipe = 7;
        $title = 'Register Pasien Melahirkan';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['register'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->where('stype_id', '3')->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status
        ]);
    }
    public function registermelahirkanpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getregistermelahirkan($mulai, $akhir, $status_pasien_id, '1', '%'));



        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {


                foreach ($value as $key1 => $value1) {

                    if ($value1 == '' || is_null($value1)) {
                        $kunjungan[$key][$key1] = '-';
                    }
                }


                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['name_of_pasien'];
                $row[] = $kunjungan[$key]['th'] . " - " . $kunjungan[$key]['bln'] . " - " . $kunjungan[$key]['hr'];

                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['description'];


                $dt_data[] = $row;
            }
        }

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Melahirkan</th>
                        <th>No.CM</th>
                        <th>Keterangan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        echo json_encode($json_data);
    }
    public function rmkunjungan()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan Rumah Sakit';
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


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'sex' => $sex,
            'isnew' => $isnew,
            'kota' => $kota
        ]);
    }
    public function rmkunjunganpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $sex = $this->request->getPost('sex');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getrmkunjungan($mulai, $akhir, $kota, '%', $clinic_id, $status_pasien_id, $isnew, '0', '1000000', '%', '%'));



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $pbj = 0;
            $plj = 0;
            $ptj = 0;
            $wbj = 0;
            $wlj = 0;
            $wtj = 0;
            $btj = 0;
            $ltj = 0;
            $tj = 0;
            $pbi = 0;
            $pli = 0;
            $pti = 0;
            $wbi = 0;
            $wli = 0;
            $wti = 0;
            $bti = 0;
            $lti = 0;
            $ti = 0;
            foreach ($kunjungan as $key => $value) {


                if ($value['jk'] == '1' && $value['baru'] == '1' && $value['isrj'] == '1')
                    $pbj += $value['jml'];
                if ($value['jk'] == '1' && $value['baru'] == '0' && $value['isrj'] == '1')
                    $plj += $value['jml'];
                if ($value['jk'] == '1' && $value['isrj'] == '1')
                    $ptj += $value['jml'];
                if ($value['jk'] == '2' && $value['baru'] == '1' && $value['isrj'] == '1')
                    $wbj += $value['jml'];
                if ($value['jk'] == '2' && $value['baru'] == '0' && $value['isrj'] == '1')
                    $wlj += $value['jml'];
                if ($value['jk'] == '2' && $value['isrj'] == '1')
                    $wtj += $value['jml'];
                if ($value['baru'] == '1' && $value['isrj'] == '1')
                    $btj += $value['jml'];
                if ($value['baru'] == '0' && $value['isrj'] == '1')
                    $ltj += $value['jml'];
                if ($value['isrj'] == '1')
                    $tj += $value['jml'];
                if ($value['jk'] == '1' && $value['baru'] == '1' && $value['isrj'] == '0')
                    $pbi += $value['jml'];
                if ($value['jk'] == '1' && $value['baru'] == '0' && $value['isrj'] == '0')
                    $pli += $value['jml'];
                if ($value['jk'] == '1' && $value['isrj'] == '0')
                    $pti += $value['jml'];
                if ($value['jk'] == '2' && $value['baru'] == '1' && $value['isrj'] == '0')
                    $wbi += $value['jml'];
                if ($value['jk'] == '2' && $value['baru'] == '0' && $value['isrj'] == '0')
                    $wli += $value['jml'];
                if ($value['jk'] == '2' && $value['isrj'] == '0')
                    $wti += $value['jml'];
                if ($value['baru'] == '1' && $value['isrj'] == '0')
                    $bti += $value['jml'];
                if ($value['baru'] == '1' && $value['isrj'] == '0')
                    $lti += $value['jml'];
                if ($value['isrj'] == '0')
                    $ti += $value['jml'];
            }
            $row = array();
            $row[] = 'Rawat Jalan';
            $row[] = $pbj;
            $row[] = $plj;
            $row[] = $ptj;
            $row[] = $wbj;
            $row[] = $wlj;
            $row[] = $wtj;
            $row[] = $btj;
            $row[] = $ltj;
            $row[] = $tj;
            $dt_data[] = $row;

            $row = array();
            $row[] = 'Rawat Inap';
            $row[] = $pbi;
            $row[] = $pli;
            $row[] = $pti;
            $row[] = $wbi;
            $row[] = $wli;
            $row[] = $wti;
            $row[] = $bti;
            $row[] = $lti;
            $row[] = $ti;
            $dt_data[] = $row;
        }

        $header = [];
        $header = '<tr>
                        <th rowspan="2" style="width: 300px;">Aktivitas</th>
                        <th colspan="3">Pria</th>
                        <th colspan="3">Wanita</th>
                        <th colspan="2">Total</th>
                        <th rowspan="2"  style="width: 100px;">Total</th>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Baru</th>
                        <th style="width: 100px;">Ulang</th>
                        <th style="width: 100px;">Total</th>
                        <th style="width: 100px;">Baru</th>
                        <th style="width: 100px;">Ulang</th>
                        <th style="width: 100px;">Total</th>
                        <th style="width: 100px;">Baru</th>
                        <th style="width: 100px;">Ulang</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        echo json_encode($json_data);
    }

    public function rmkunjunganranap()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan Rawat Inap';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
        ]);
    }
    public function rmkunjunganranappost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $mulaidate = date_create(strval($mulai));
        $akhirdate = date_create(strval($akhir));



        $kunjungan = $this->lowerKey($pv->getrmkunjunganranap($mulai, $akhir, '%', '%', '%', $status_pasien_id, '%', '0', '1000000', '%', '%'));



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $totalTT = $totalAwal = $totalMasuk = $totalHidup = $totalMatik48 = $totalMatil48 = $totalKeluar = $totalLama = $totalAkhir = $totalHari = 0;
            $datediff = intval(date_diff($mulaidate, $akhirdate)->format("%d"));

            // return json_encode($kunjungan);
            foreach ($kunjungan as $key => $value) {
                $keluarAll = $kunjungan[$key]['hidup'] + $kunjungan[$key]['matik48'] + $kunjungan[$key]['matil48'];
                $totalKeluar += $keluarAll;
                $totalTT += $kunjungan[$key]['tt'];
                $totalAwal += $kunjungan[$key]['awal'];
                $totalMasuk += $kunjungan[$key]['masuk'];
                $totalHidup += $kunjungan[$key]['hidup'];
                $totalMatik48 += $kunjungan[$key]['matik48'];
                $totalMatil48 += $kunjungan[$key]['matil48'];
                $totalLama += $kunjungan[$key]['lama'];
                $totalAkhir += $kunjungan[$key]['awal'] + $kunjungan[$key]['masuk'] - $keluarAll;
                $totalHari += $kunjungan[$key]['hari'] - $keluarAll + $kunjungan[$key]['harisama'];
            }
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $kunjungan[$key]['name_of_clinic'];
                $row[] = $kunjungan[$key]['tt'];
                $row[] = $kunjungan[$key]['awal'];
                $row[] = $kunjungan[$key]['masuk'];
                $row[] = $kunjungan[$key]['hidup'];
                $row[] = $kunjungan[$key]['matik48'];
                $row[] = $kunjungan[$key]['matil48'];
                $keluarAll = $kunjungan[$key]['hidup'] + $kunjungan[$key]['matik48'] + $kunjungan[$key]['matil48'];
                $row[] = $keluarAll;
                $row[] = $kunjungan[$key]['lama'];
                $row[] = $kunjungan[$key]['awal'] + $kunjungan[$key]['masuk'] - $keluarAll;
                $hp = $kunjungan[$key]['hari'] - $keluarAll + $kunjungan[$key]['harisama'];
                $row[] = $hp;
                if ($kunjungan[$key]['tt'] != 0 && !empty($value['tt']) && !is_null($value['tt']))
                    $row[] = number_format(floatval($hp   /  ($kunjungan[$key]['tt']  *  (1 + ($datediff))) * 100), 2); //bor
                else
                    $row[] = 0;
                if ($keluarAll != 0) {
                    $row[] = number_format(floatval($kunjungan[$key]['lama'] / $keluarAll), 2); //los
                    $row[] = number_format(floatval((($kunjungan[$key]['tt']  *  (1 + $datediff))  -  $kunjungan[$key]['hari']) / $keluarAll), 2); //toi
                    if ($kunjungan[$key]['tt'] != 0)
                        $row[] = number_format(floatval($keluarAll / $kunjungan[$key]['tt'] * 365 / (1 + $datediff)), 2); //bto
                    $row[] = number_format(floatval(($kunjungan[$key]['matik48'] / $totalKeluar) * 1000), 2);
                    $row[] = number_format(floatval((($kunjungan[$key]['matik48'] + $kunjungan[$key]['matil48']) / $keluarAll) * 1000), 2);
                }
                $dt_data[] = $row;
            }
            $row = array();

            $row[] = 'TOTAL';
            $row[] = $totalTT;
            $row[] = $totalAwal;
            $row[] = $totalMasuk;
            $row[] = $totalHidup;
            $row[] = $totalMatik48;
            $row[] = $totalMatil48;
            $row[] = $totalKeluar;
            $row[] = $totalLama;
            $row[] = $totalAkhir;
            $row[] = $totalHari;
            $dt_data[] = $row;

            $borAll = number_format(floatval($totalHari   /  ($totalTT  *  (1 + $datediff)) * 100), 2);

            if ($totalKeluar != 0) {
                $losAll =  number_format(floatval($totalLama / $totalKeluar), 2);
                $toiAll = number_format(floatval((($totalTT  *  (1 + $datediff))  -  $totalHari) / $totalKeluar), 2);
                $btoAll = number_format(floatval($totalKeluar / intval($kunjungan[0]['beds']) * 365 / (1 + $datediff)), 2);
                $ndrAll = number_format(floatval($totalMatik48 / $totalKeluar * 1000), 2);
                $gdrAll = number_format(floatval(($totalMatik48 +  $totalMatil48) /  $totalKeluar * 1000), 2);
            } else {

                $losAll = '-';
                $toiAll = '-';
                $btoAll = '-';
                $ndrAll = '-';
                $gdrAll = '-';
            }
            $row = array();
            $footer[] = $row;
            $row = array();
            $row[] = 'BOR';
            $row[] = $borAll;
            $row[] = '%';
            $footer[] = $row;

            $row = array();
            $row[] = 'LOS';
            $row[] = $losAll;
            $row[] = 'Hari';
            $footer[] = $row;

            $row = array();
            $row[] = 'TOI';
            $row[] = $toiAll;
            $row[] = 'Hari';
            $footer[] = $row;

            $row = array();
            $row[] = 'BTO';
            $row[] = $btoAll;
            $row[] = 'Hari';
            $footer[] = $row;

            $row = array();
            $row[] = 'NDR';
            $row[] = $ndrAll;
            $footer[] = $row;

            $row = array();
            $row[] = 'GDR';
            $row[] = $gdrAll;
            $footer[] = $row;
        }

        $header = [];
        $header = '<tr>
                        <th style="padding: 20px" rowspan="2">Bangsal</th>
                        <th style="padding: 20px" rowspan="2">Kapasitas sesuai SK</th>
                        <th style="padding: 20px" rowspan="2">Pasien Awal</th>
                        <th style="padding: 20px" rowspan="2">Paisen Masuk</th>
                        <th style="padding: 20px" colspan="4">Keluar</th>
                        <th style="padding: 20px" rowspan="2">Lama Dirawat</th>
                        <th style="padding: 20px" rowspan="2">Pasien Akhir</th>
                        <th style="padding: 20px" rowspan="2">Hari Perawatan</th>
                        <th style="padding: 20px" rowspan="2">BOR</th>
                        <th style="padding: 20px" rowspan="2">LOS</th>
                        <th style="padding: 20px" rowspan="2">TOI</th>
                        <th style="padding: 20px" rowspan="2">BTO</th>
                        <th style="padding: 20px" rowspan="2">NDR</th>
                        <th style="padding: 20px" rowspan="2">GDR</th>
                    </tr>
                    <tr>
                        <th style="padding: 20px">Hidup</th>
                        <th style="padding: 20px">Mati < 48</th>
                        <th style="padding: 20px">Mati > 48</th>
                        <th style="padding: 20px">Total Keluar</th>
                    </tr>';


        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function rmkunjunganranapstatus()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan Rawat Inap';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
        ]);
    }
    public function rmkunjunganranapstatuspost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $mulaidate = date_create(strval($mulai));
        $akhirdate = date_create(strval($akhir));



        $kunjungan = $this->lowerKey($pv->getrmkunjunganranaprl($mulai, $akhir, '%', '%', '%', $status_pasien_id, '%', '0', '1000000', '%', '%'));



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $totalTT = $totalAwal = $totalMasuk = $totalHidup = $totalMatik48 = $totalMatil48 = $totalKeluar = $totalLama = $totalAkhir = $totalHari = 0;
            $datediff = intval(date_diff($mulaidate, $akhirdate)->format("%d"));


            foreach ($kunjungan as $key => $value) {
                $keluarAll = $kunjungan[$key]['hidup'] + $kunjungan[$key]['matik48'] + $kunjungan[$key]['matil48'];
                $totalKeluar += $keluarAll;
                $totalTT += $kunjungan[$key]['tt'];
                $totalAwal += $kunjungan[$key]['awal'];
                $totalMasuk += $kunjungan[$key]['masuk'];
                $totalHidup += $kunjungan[$key]['hidup'];
                $totalMatik48 += $kunjungan[$key]['matik48'];
                $totalMatil48 += $kunjungan[$key]['matil48'];
                $totalLama += $kunjungan[$key]['lama'];
                $totalAkhir += $kunjungan[$key]['awal'] + $kunjungan[$key]['masuk'] - $keluarAll;
                $totalHari += $kunjungan[$key]['hari'] - $keluarAll + $kunjungan[$key]['harisama'];


                $row = array();
                $row[] = $kunjungan[$key]['clinictype'];
                $row[] = $kunjungan[$key]['tt'];
                $row[] = $kunjungan[$key]['awal'];
                $row[] = $kunjungan[$key]['masuk'];
                $row[] = $kunjungan[$key]['hidup'];
                $row[] = $kunjungan[$key]['matik48'];
                $row[] = $kunjungan[$key]['matil48'];
                $keluarAll = $kunjungan[$key]['hidup'] + $kunjungan[$key]['matik48'] + $kunjungan[$key]['matil48'];
                $row[] = $keluarAll;
                $row[] = $kunjungan[$key]['lama'];
                $row[] = $kunjungan[$key]['awal'] + $kunjungan[$key]['masuk'] - $keluarAll;
                $hp = $kunjungan[$key]['hari'] - $keluarAll + $kunjungan[$key]['harisama'];
                $row[] = $hp;
                // if ($kunjungan[$key]['tt'])
                //     $row[] = number_format(floatval($hp   /  ($kunjungan[$key]['tt']  *  (1 + ($datediff))) * 100), 2); //bor
                // else
                //     $row[] = 0;
                // if ($keluarAll != 0) {
                //     $row[] = number_format(floatval($kunjungan[$key]['lama'] / $keluarAll), 2); //los
                //     $row[] = number_format(floatval((($kunjungan[$key]['tt']  *  (1 + $datediff))  -  $kunjungan[$key]['hari']) / $keluarAll), 2); //toi
                //     $row[] = number_format(floatval($keluarAll / $kunjungan[$key]['tt'] * 365 / (1 + $datediff)), 2); //bto
                //     $row[] = number_format(floatval(($kunjungan[$key]['matik48'] / $totalKeluar) * 1000), 2);
                //     $row[] = number_format(floatval((($kunjungan[$key]['matik48'] + $kunjungan[$key]['matil48']) / $keluarAll) * 1000), 2);
                // }
                $dt_data[] = $row;
            }
            $row = array();

            $row[] = 'TOTAL';
            $row[] = $totalTT;
            $row[] = $totalAwal;
            $row[] = $totalMasuk;
            $row[] = $totalHidup;
            $row[] = $totalMatik48;
            $row[] = $totalMatil48;
            $row[] = $totalKeluar;
            $row[] = $totalLama;
            $row[] = $totalAkhir;
            $row[] = $totalHari;
            $dt_data[] = $row;

            if ($totalTT != 0)
                $borAll = number_format(floatval($totalHari   /  ($totalTT  *  (1 + $datediff)) * 100), 2);
            else
                $borAll = "-";

            if ($totalKeluar != 0) {
                $losAll =  number_format(floatval($totalLama / $totalKeluar), 2);
                $toiAll = number_format(floatval((($totalTT  *  (1 + $datediff))  -  $totalHari) / $totalKeluar), 2);
                $btoAll = number_format(floatval($totalKeluar / intval($kunjungan[0]['beds']) * 365 / (1 + $datediff)), 2);
                $ndrAll = number_format(floatval($totalMatik48 / $totalKeluar * 1000), 2);
                $gdrAll = number_format(floatval(($totalMatik48 +  $totalMatil48) /  $totalKeluar * 1000), 2);
            } else {

                $losAll = '-';
                $toiAll = '-';
                $btoAll = '-';
                $ndrAll = '-';
                $gdrAll = '-';
            }
            $row = array();
            $footer[] = $row;
            $row = array();
            $row[] = 'BOR';
            $row[] = $borAll;
            $row[] = '%';
            $footer[] = $row;

            $row = array();
            $row[] = 'LOS';
            $row[] = $losAll;
            $row[] = 'Hari';
            $footer[] = $row;

            $row = array();
            $row[] = 'TOI';
            $row[] = $toiAll;
            $row[] = 'Hari';
            $footer[] = $row;

            $row = array();
            $row[] = 'BTO';
            $row[] = $btoAll;
            $row[] = 'Hari';
            $footer[] = $row;

            $row = array();
            $row[] = 'NDR';
            $row[] = $ndrAll;
            $footer[] = $row;

            $row = array();
            $row[] = 'GDR';
            $row[] = $gdrAll;
            $footer[] = $row;
        }

        $header = [];
        $header = '<tr>
                        <th style="padding: 20px" rowspan="2">Bangsal</th>
                        <th style="padding: 20px" rowspan="2">Kapasitas sesuai SK</th>
                        <th style="padding: 20px" rowspan="2">Pasien Awal</th>
                        <th style="padding: 20px" rowspan="2">Paisen Masuk</th>
                        <th style="padding: 20px" colspan="4">Keluar</th>
                        <th style="padding: 20px" rowspan="2">Lama Dirawat</th>
                        <th style="padding: 20px" rowspan="2">Pasien Akhir</th>
                        <th style="padding: 20px" rowspan="2">Hari Perawatan</th>
                    </tr>
                    <tr>
                        <th style="padding: 20px">Hidup</th>
                        <th style="padding: 20px">Mati < 48</th>
                        <th style="padding: 20px">Mati > 48</th>
                        <th style="padding: 20px">Total Keluar</th>
                    </tr>';


        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function rmkunjunganklinik()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan Rawat Jalan Per Klinik';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();
        $clinic = $this->getClinic([1]);

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic
        ]);
    }
    public function rmkunjunganklinikpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getrmkunjunganpoli($mulai, $akhir, '%', '%', $clinic_id, $status_pasien_id, '%', '0', '1000000', '%', '%'));
        $clinic = $this->getClinic([1, 2, 3, 5]);

        // return json_encode($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            $kunjgroup = [];
            foreach ($kunjungan as $key => $value) {
                if (empty($kunjgroup[$value['clinic_id']]['pbj']))
                    $kunjgroup[$value['clinic_id']]['pbj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['plj']))
                    $kunjgroup[$value['clinic_id']]['plj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['ptj']))
                    $kunjgroup[$value['clinic_id']]['ptj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['wbj']))
                    $kunjgroup[$value['clinic_id']]['wbj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['wlj']))
                    $kunjgroup[$value['clinic_id']]['wlj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['wtj']))
                    $kunjgroup[$value['clinic_id']]['wtj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['btj']))
                    $kunjgroup[$value['clinic_id']]['btj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['ltj']))
                    $kunjgroup[$value['clinic_id']]['ltj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['tj']))
                    $kunjgroup[$value['clinic_id']]['tj'] = 0;
                if (empty($kunjgroup[$value['clinic_id']]['no']))
                    $kunjgroup[$value['clinic_id']]['no'] = 0;

                if ($value['jk'] == '1' && $value['baru'] == '1')
                    $kunjgroup[$value['clinic_id']]['pbj'] += $value['jml'];
                if ($value['jk'] == '1' && $value['baru'] == '0')
                    $kunjgroup[$value['clinic_id']]['plj'] += $value['jml'];
                if ($value['jk'] == '1')
                    $kunjgroup[$value['clinic_id']]['ptj'] += $value['jml'];
                if ($value['jk'] == '2' && $value['baru'] == '1')
                    $kunjgroup[$value['clinic_id']]['wbj'] += $value['jml'];
                if ($value['jk'] == '2' && $value['baru'] == '0')
                    $kunjgroup[$value['clinic_id']]['wlj'] += $value['jml'];
                if ($value['jk'] == '2')
                    $kunjgroup[$value['clinic_id']]['wtj'] += $value['jml'];
                if ($value['baru'] == '1')
                    $kunjgroup[$value['clinic_id']]['btj'] += $value['jml'];
                if ($value['baru'] == '0')
                    $kunjgroup[$value['clinic_id']]['ltj'] += $value['jml'];
                if (true)
                    $kunjgroup[$value['clinic_id']]['tj'] += $value['jml'];
                //if (dilayani <>'1' or isnull(dilayani),jml,0) 
                if ($value['dilayani'] != '1' || is_null($value['dilayani']))
                    $kunjgroup[$value['clinic_id']]['no'] += $value['jml'];
            }
            asort($kunjgroup);
            $dt_data = [];
            $pbj = 0;
            $plj = 0;
            $ptj = 0;
            $wbj = 0;
            $wlj = 0;
            $wtj = 0;
            $btj = 0;
            $ltj = 0;
            $tj = 0;
            $no = 0;
            foreach ($kunjgroup as $key => $value) {
                foreach ($clinic as $key1 => $value1) {
                    // return json_encode($clinic[$key1]['clinic_id']);
                    $row = [];
                    if ($clinic[$key1]['clinic_id'] == $key) {
                        $row[] = $clinic[$key1]['name_of_clinic'];
                        break;
                    }
                }
                $pbj += $kunjgroup[$key]['pbj'];
                $plj += $kunjgroup[$key]['plj'];
                $ptj += $kunjgroup[$key]['ptj'];
                $wbj += $kunjgroup[$key]['wbj'];
                $wlj += $kunjgroup[$key]['wlj'];
                $wtj += $kunjgroup[$key]['wtj'];
                $btj += $kunjgroup[$key]['btj'];
                $ltj += $kunjgroup[$key]['ltj'];
                $tj += $kunjgroup[$key]['tj'];
                $no += $kunjgroup[$key]['no'];

                $row[] = $kunjgroup[$key]['pbj'];
                $row[] = $kunjgroup[$key]['plj'];
                $row[] = $kunjgroup[$key]['ptj'];
                $row[] = $kunjgroup[$key]['wbj'];
                $row[] = $kunjgroup[$key]['wlj'];
                $row[] = $kunjgroup[$key]['wtj'];
                $row[] = $kunjgroup[$key]['btj'];
                $row[] = $kunjgroup[$key]['ltj'];
                $row[] = $kunjgroup[$key]['tj'];
                $row[] = $kunjgroup[$key]['no'];

                $dt_data[] = $row;
            }

            $row = [];
            $row[] = 'TOTAL';
            $row[] = $pbj;
            $row[] = $plj;
            $row[] = $ptj;
            $row[] = $wbj;
            $row[] = $wlj;
            $row[] = $wtj;
            $row[] = $btj;
            $row[] = $ltj;
            $row[] = $tj;
            $row[] = $no;
            $dt_data[] = $row;
        }

        $header = [];
        $header = '<tr>
                        <th rowspan="2" style="width: 300px;">Pelayanan</th>
                        <th colspan="3">Pria</th>
                        <th colspan="3">Wanita</th>
                        <th colspan="2">Total</th>
                        <th rowspan="2"  style="width: 100px;">Total</th>
                        <th rowspan="2"  style="width: 100px;">Belum Dilayani</th>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Baru</th>
                        <th style="width: 100px;">Ulang</th>
                        <th style="width: 100px;">Total</th>
                        <th style="width: 100px;">Baru</th>
                        <th style="width: 100px;">Ulang</th>
                        <th style="width: 100px;">Total</th>
                        <th style="width: 100px;">Baru</th>
                        <th style="width: 100px;">Ulang</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            'footer' => []
        );
        echo json_encode($json_data);
    }
    public function rmkunjunganstatus()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan Rawat Jalan Per Status';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();
        $clinic = $this->getClinic([1]);

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic
        ]);
    }
    public function rmkunjunganstatuspost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getrmkunjunganstatus($mulai, $akhir, '%', '%', $clinic_id, $status_pasien_id, '%', '0', '1000000', '%', '%'));
        $clinic = $this->getClinic([1, 2, 3, 5]);
        $status = $this->getStatusPasien();

        // return json_encode($kunjungan);
        $dt_data     = array();
        $sumUmum = $sumBpjs = $sumNakes = $sumInhealth = $sumKerjasama = $sumPln = $sumGratis = $sumLain = $sum = 0;
        if (!empty($kunjungan)) {
            $kunjgroup = [];
            foreach ($kunjungan as $key => $value) {
                if (empty($kunjgroup[$value['clinic_id']][$value['status_pasien_id']]))
                    $kunjgroup[$value['clinic_id']][$value['status_pasien_id']] = $value['jml'];
                else
                    $kunjgroup[$value['clinic_id']][$value['status_pasien_id']] += $value['jml'];
            }
            // asort($kunjgroup);
            // return json_encode($kunjgroup);
            $dt_data = [];
            foreach ($kunjgroup as $key => $value) {
                foreach ($clinic as $key1 => $value1) {
                    // return json_encode($clinic[$key1]['clinic_id']);
                    $row = [];
                    if ($clinic[$key1]['clinic_id'] == $key) {
                        $row[] = $clinic[$key1]['name_of_clinic'];
                        break;
                    }
                }
                if (empty($kunjgroup[$key]['1'])) {
                    $row[] = 0;
                } else {
                    $row[] = $kunjgroup[$key]['1'];
                    $sumUmum += $kunjgroup[$key]['1'];
                }
                if (empty($kunjgroup[$key]['18']))
                    $row[] = 0;
                else {
                    $row[] = $kunjgroup[$key]['18'];
                    $sumBpjs += $kunjgroup[$key]['18'];
                }
                if (empty($kunjgroup[$key]['26']))
                    $row[] = 0;
                else {
                    $row[] = $kunjgroup[$key]['26'];
                    $sumNakes += $kunjgroup[$key]['26'];
                }
                if (empty($kunjgroup[$key]['24']))
                    $row[] = 0;
                else {
                    $row[] = $kunjgroup[$key]['24'];
                    $sumInhealth += $kunjgroup[$key]['24'];
                }

                //kelompok jamkesmas
                $jamkesmas = 0;
                if (empty($kunjgroup[$key]['4']))
                    $jamkesmas += 0;
                else
                    $jamkesmas += $kunjgroup[$key]['4'];
                if (empty($kunjgroup[$key]['21']))
                    $jamkesmas += 0;
                else
                    $jamkesmas += $kunjgroup[$key]['21'];
                if (empty($kunjgroup[$key]['22']))
                    $jamkesmas += 0;
                else
                    $jamkesmas += $kunjgroup[$key]['22'];
                $sumKerjasama += $jamkesmas;
                $row[] = $jamkesmas;
                //end kelompok jamkesmas

                if (empty($kunjgroup[$key]['30']))
                    $row[] = 0;
                else {
                    $row[] = $kunjgroup[$key]['30'];
                    $sumPln += $kunjgroup[$key]['30'];
                }
                if (empty($kunjgroup[$key]['25']))
                    $row[] = 0;
                else {
                    $row[] = $kunjgroup[$key]['25'];
                    $sumGratis += $kunjgroup[$key]['25'];
                }
                $lain = 0;
                $total = 0;
                foreach ($value as $key1 => $value1) {
                    if (!in_array($kunjgroup[$key][$key1], array('1', '18', '26', '24', '4', '21', '22', '30', '25'))) {
                        $lain += $value1;
                    } else {
                        $lain += 0;
                    }
                    $total += $value1;
                }

                $row[] =  $lain;
                $sumLain += $lain;


                $row[] =  $total;


                $dt_data[] = $row;
            }
            sort($dt_data);

            $row = [];
            $row[] = 'TOTAL';
            $row[] = $sumUmum;
            $row[] = $sumBpjs;
            $row[] = $sumNakes;
            $row[] = $sumInhealth;
            $row[] = $sumKerjasama;
            $row[] = $sumPln;
            $row[] = $sumGratis;
            $row[] = $sumLain;
            $row[] = $sumUmum + $sumBpjs + $sumNakes = $sumInhealth + $sumKerjasama + $sumPln + $sumGratis + $sumLain;

            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>CLINIC</th>
                        <th>Umum</th>
                        <th>BPJS</th>
                        <th>BPJS Naker</th>
                        <th>Inhealth</th>
                        <th>Kerjasama</th>
                        <th>PLN</th>
                        <th>Gratis</th>
                        <th>Lain-lain</th>
                        <th>Jumlah</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            'footer' => []
        );
        echo json_encode($json_data);
    }

    public function rmkunjunganugd()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan UGD';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
        ]);
    }
    public function rmkunjunganugdpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $sex = $this->request->getPost('sex');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getrmugd($mulai, $akhir, 'P012', $status_pasien_id));




        $dt_data     = array();
        if (!empty($kunjungan)) {
            $suffer = $this->getSuffer();
            foreach ($kunjungan as $key => $value) {
                $row = array();
                foreach ($suffer as $key1 => $value1) {
                    if ($suffer[$key1]['suffer_type'] == $kunjungan[$key]['kasus']) {
                        $row[] = $suffer[$key1]['suffer'];
                        break;
                    }
                }
                $row[] = $kunjungan[$key]['rujukan'];
                $row[] = $kunjungan[$key]['nonrujuk'];
                $row[] = $kunjungan[$key]['dirawat'];
                $row[] = $kunjungan[$key]['dirujuk'];
                $row[] = $kunjungan[$key]['sembuh'];
                $row[] = $kunjungan[$key]['mati'];
                $dt_data[] = $row;
            }
        }
        sort($dt_data);
        $header = [];
        $header = '<tr>
                        <th rowspan="2">Kasus</th>
                        <th colspan="2">Total Pasien</th>
                        <th colspan="3">Tindak Lanjut</th>
                        <th rowspan="2">Mati Sebelum Dirawat</th>
                    </tr>
                    <tr>
                        <th>Rujukan</th>
                        <th>Non Rujukan</th>
                        <th>Dirawat</th>
                        <th>Dirujuk</th>
                        <th>Dipulangkan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header
        );
        echo json_encode($json_data);
    }
    public function rmtopxrajal()
    {
        $giTipe = 7;
        $title = 'Top X Diagnosa Rawat Jalan';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();
        $clinic = $this->getClinic([1]);

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'x' => 10
        ]);
    }
    public function rmtopxrajalpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $jml = $this->request->getPost('jml');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $topx = $this->request->getPost('topx');



        $kunjungan = $this->lowerKey($pv->getrmtopxrajal($mulai, $akhir, $clinic_id, $status_pasien_id, '1', $topx));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $total = 0;
            foreach ($kunjungan as $key => $value) {
                $total += $kunjungan[$key]['jml'];
            }
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['name_of_diagnosa'];
                $row[] = $kunjungan[$key]['diagnosa_id'];
                $row[] = $kunjungan[$key]['jml'];
                $row[] = number_format(floatval($kunjungan[$key]['jml'] / $kunjungan[$key]['total']) * 100, 2);
                $dt_data[] = $row;
            }
            $row = array();
            $row[] = '';
            $row[] = 'Lain-lain';
            $row[] = '';
            $row[] = $kunjungan[$key]['total'] - $total;
            $row[] = number_format(floatval(($kunjungan[$key]['total'] - $total) / $kunjungan[$key]['total']) * 100, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Jenis Penyakit</th>
                        <th rowspan="2">Kode ICD X</th>
                        <th rowspan="2">Jumlah Kasus</th>
                        <th rowspan="2">%</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function rmtopxranap()
    {
        $giTipe = 7;
        $title = 'Top X Diagnosa Rawat Inap';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();
        $clinic = $this->getClinic([3]);

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'x' => 10
        ]);
    }
    public function rmtopxranappost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $jml = $this->request->getPost('jml');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $topx = $this->request->getPost('topx');



        $kunjungan = $this->lowerKey($pv->getrmtopxranap($mulai, $akhir, $clinic_id, $status_pasien_id, '0', $topx));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $total = 0;
            foreach ($kunjungan as $key => $value) {
                $total += $kunjungan[$key]['jml'];
            }
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['name_of_diagnosa'];
                $row[] = $kunjungan[$key]['diagnosa_id'];
                $row[] = $kunjungan[$key]['jml'];
                $row[] = number_format(floatval($kunjungan[$key]['jml'] / $kunjungan[$key]['total']) * 100, 2);
                $dt_data[] = $row;
            }
            $row = array();
            $row[] = '';
            $row[] = 'Lain-lain';
            $row[] = '';
            $row[] = $kunjungan[$key]['total'] - $total;
            $row[] = number_format(floatval(($kunjungan[$key]['total'] - $total) / $kunjungan[$key]['total']) * 100, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Jenis Penyakit</th>
                        <th rowspan="2">Kode ICD X</th>
                        <th rowspan="2">Jumlah Kasus</th>
                        <th rowspan="2">%</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function rmtopxugd()
    {
        $giTipe = 7;
        $title = 'Top X Diagnosa Unit Gawat Darurat';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();
        // $clinic = $this->getClinic([3]);

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            // 'clinic' => $clinic,
            'x' => 10
        ]);
    }
    public function rmtopxugdpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $jml = $this->request->getPost('jml');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $topx = $this->request->getPost('topx');



        $kunjungan = $this->lowerKey($pv->getrmtopxugd($mulai, $akhir, 'P012', $status_pasien_id, '0', $topx));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $total = 0;
            foreach ($kunjungan as $key => $value) {
                $total += $kunjungan[$key]['jml'];
            }
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['name_of_diagnosa'];
                $row[] = $kunjungan[$key]['diagnosa_id'];
                $row[] = $kunjungan[$key]['jml'];
                $row[] = number_format(floatval($kunjungan[$key]['jml'] / $kunjungan[$key]['total']) * 100, 2);
                $dt_data[] = $row;
            }
            $row = array();
            $row[] = '';
            $row[] = 'Lain-lain';
            $row[] = '';
            $row[] = $kunjungan[$key]['total'] - $total;
            $row[] = number_format(floatval(($kunjungan[$key]['total'] - $total) / $kunjungan[$key]['total']) * 100, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Jenis Penyakit</th>
                        <th rowspan="2">Kode ICD X</th>
                        <th rowspan="2">Jumlah Kasus</th>
                        <th rowspan="2">%</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function rmindexrajal()
    {
        $giTipe = 7;
        $title = 'Kartu Index Penyakit Rajal';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'diagnosa' => '1',
        ]);
    }
    public function rmindexrajalpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $jml = $this->request->getPost('jml');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $topx = $this->request->getPost('topx');
        $diagnosa = $this->request->getPost('diag_id');
        if ($diagnosa == '' || is_null($diagnosa))
            $diagnosa = '%';

        $employeeModel = new EmployeeAllModel();

        $kunjungan = $this->lowerKey($pv->getrmindexrajal($mulai, $akhir, $diagnosa, '%', '1'));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {


            $doctorlist = [];
            foreach ($kunjungan as $key => $value) {
                $doctorlist[] = $kunjungan[$key]['employee_id'];
            }
            $employeeList = $this->lowerKey($employeeModel->whereIn('employee_id', $doctorlist)->findAll());
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['thename'];
                if ($kunjungan[$key]['gender'] == '1')
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['gender'] != '1')
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] < 29)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] > 28 && $kunjungan[$key]['umur'] < 365)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 365 && $kunjungan[$key]['umur'] < 1824)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 1824 && $kunjungan[$key]['umur'] < 5474)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 5474 && $kunjungan[$key]['umur'] < 9124)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 9124 && $kunjungan[$key]['umur'] < 16425)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 16425 && $kunjungan[$key]['umur'] < 23724)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 23724)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';

                $row[] = $kunjungan[$key]['visit_date'];

                foreach ($employeeList as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employeeList[$key1]['employee_id'])
                        $row[] = $employeeList[$key1]['fullname'];
                }

                $row[] = $kunjungan[$key]['kal_id'];



                $dt_data[] = $row;
            }
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">No. CM</th>
                        <th rowspan="2">Nama</th>
                        <th colspan="2">Jender</th>
                        <th colspan="8">Kelompok Umur</th>
                        <th rowspan="2">Tanggal Perawatan</th>
                        <th rowspan="2">Dokter</th>
                        <th rowspan="2">Kota / Kab</th>
                    </tr>
                    <tr>
                        <th>Laki</th>
                        <th>Perempuan</th>
                        <th>0 - 28 Hr</th>
                        <th>
                            < 1 Th</th>
                        <th>1 - 4 Th</th>
                        <th>5 - 14 Th</th>
                        <th>15 - 24 Th</th>
                        <th>25 - 44 Th</th>
                        <th>45 - 64 Th</th>
                        <th>>= 65 Th</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function rmindexranap()
    {
        $giTipe = 7;
        $title = 'Kartu Index Penyakit Rajal';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'diagnosa' => '1',
        ]);
    }
    public function rmindexranappost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new TreatmentAkomodasiModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isnew = $this->request->getPost('isnew');
        $kota = $this->request->getPost('kota');
        $clinic_id = $this->request->getPost('clinic_id');
        $jml = $this->request->getPost('jml');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $topx = $this->request->getPost('topx');
        $diagnosa = $this->request->getPost('diag_id');
        if ($diagnosa == '' || is_null($diagnosa))
            $diagnosa = '%';

        $employeeModel = new EmployeeAllModel();

        $kunjungan = $this->lowerKey($pv->getrmindexranap($mulai, $akhir, $diagnosa, '%', '0'));
        // return json_encode($kunjungan);

        $keluar = $this->getKeluar();


        $dt_data     = array();
        if (!empty($kunjungan)) {


            $doctorlist = [];
            foreach ($kunjungan as $key => $value) {
                $doctorlist[] = $kunjungan[$key]['employee_id'];
            }
            $employeeList = $this->lowerKey($employeeModel->whereIn('employee_id', $doctorlist)->findAll());
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['thename'];
                if ($kunjungan[$key]['gender'] == '1')
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['gender'] != '1')
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] < 29)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] > 28 && $kunjungan[$key]['umur'] < 365)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 365 && $kunjungan[$key]['umur'] < 1824)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 1824 && $kunjungan[$key]['umur'] < 5474)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 5474 && $kunjungan[$key]['umur'] < 9124)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 9124 && $kunjungan[$key]['umur'] < 16425)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 16425 && $kunjungan[$key]['umur'] < 23724)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                if ($kunjungan[$key]['umur'] >= 23724)
                    $row[] = '<i class="fa fa-check" aria-hidden="true"></i>';
                else
                    $row[] = '';
                $row[] = substr($kunjungan[$key]['in_date'], 0, 10);
                $row[] = substr($kunjungan[$key]['exit_date'], 0, 10);

                $mulaidate = date_create(strval($kunjungan[$key]['in_date']));
                $akhirdate = date_create(strval($kunjungan[$key]['exit_date']));
                $datediff = intval(date_diff(($mulaidate), $akhirdate)->format("%d"));
                $row[] = $datediff;
                foreach ($keluar as $key1 => $value1) {
                    if ($kunjungan[$key]['keluar_id'] == $keluar[$key1]['keluar_id'])
                        $row[] = $keluar[$key1]['cara_keluar'];
                }


                foreach ($employeeList as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employeeList[$key1]['employee_id'])
                        $row[] = $employeeList[$key1]['fullname'];
                }

                $row[] = $kunjungan[$key]['kal_id'];



                $dt_data[] = $row;
            }
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">No. CM</th>
                        <th rowspan="2">Nama</th>
                        <th colspan="2">Jender</th>
                        <th colspan="8">Kelompok Umur</th>
                        <th rowspan="2">Tanggal Masuk</th>
                        <th rowspan="2">Tanggal Keluar</th>
                        <th rowspan="2">Lama</th>
                        <th rowspan="2">Keadaan Keluar</th>
                        <th rowspan="2">Dokter</th>
                        <th rowspan="2">Kota / Kab</th>
                    </tr>
                    <tr>
                        <th>Laki</th>
                        <th>Perempuan</th>
                        <th>0 - 28 Hr</th>
                        <th>
                            < 1 Th</th>
                        <th>1 - 4 Th</th>
                        <th>5 - 14 Th</th>
                        <th>15 - 24 Th</th>
                        <th>25 - 44 Th</th>
                        <th>45 - 64 Th</th>
                        <th>>= 65 Th</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function finharian()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Harian';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status
        ]);
    }
    public function finharianpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $status = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');


        $kunjungan = $this->lowerKey($model->getharian($mulai, $akhir, $status, $isrj));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {


            $jml = $subsidi = $pot = $retur = $bayar = $total = 0;
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = substr($kunjungan[$key]['tgl'], 0, 10);
                $row[] = number_format($kunjungan[$key]['jml'], 2);
                $row[] = number_format($kunjungan[$key]['subsidi'], 2);
                $row[] = number_format($kunjungan[$key]['pot'], 2);
                $row[] = number_format($kunjungan[$key]['retur'], 2);
                $row[] = number_format($kunjungan[$key]['bayar'], 2);
                $row[] = number_format($kunjungan[$key]['jml'] - ($kunjungan[$key]['subsidi'] + $kunjungan[$key]['pot']) - $kunjungan[$key]['bayar'] + $kunjungan[$key]['retur'], 2);

                $jml += $kunjungan[$key]['jml'];
                $subsidi += $kunjungan[$key]['subsidi'];
                $pot += $kunjungan[$key]['pot'];
                $retur += $kunjungan[$key]['retur'];
                $bayar += $kunjungan[$key]['bayar'];
                $total += $kunjungan[$key]['jml'] - ($kunjungan[$key]['subsidi'] + $kunjungan[$key]['pot']) - $kunjungan[$key]['bayar'] + $kunjungan[$key]['retur'];




                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = 'Total Nilai Transaksi';
            $row[] = number_format($jml, 2);
            $row[] = number_format($subsidi, 2);
            $row[] = number_format($pot, 2);
            $row[] = number_format($retur, 2);
            $row[] = number_format($bayar, 2);
            $row[] = number_format($total, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Tagihan</th>
                        <th>Subsidi</th>
                        <th>Potongan</th>
                        <th>Retur</th>
                        <th>Pembayaran</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function finbulanan()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Bulanan';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status
        ]);
    }
    public function finbulananpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $status = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $kunjungan = $this->lowerKey($model->getbulanan($mulai, $akhir, $status, $isrj));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['tahun']][$kunjungan[$key]['bulan']]['jml'] = $kunjungan[$key]['jml'];
                $kunjbaru[$kunjungan[$key]['tahun']][$kunjungan[$key]['bulan']]['subsidi'] = $kunjungan[$key]['subsidi'];
                $kunjbaru[$kunjungan[$key]['tahun']][$kunjungan[$key]['bulan']]['pot'] = $kunjungan[$key]['pot'];
                $kunjbaru[$kunjungan[$key]['tahun']][$kunjungan[$key]['bulan']]['retur'] = $kunjungan[$key]['retur'];
                $kunjbaru[$kunjungan[$key]['tahun']][$kunjungan[$key]['bulan']]['bayar'] = $kunjungan[$key]['bayar'];
                $kunjbaru[$kunjungan[$key]['tahun']][$kunjungan[$key]['bulan']]['total'] = $kunjungan[$key]['jml'] - ($kunjungan[$key]['subsidi'] + $kunjungan[$key]['pot']) - $kunjungan[$key]['bayar'] + $kunjungan[$key]['retur'];
            }

            $sumjml = $sumsubsidi = $sumpot = $sumretur = $sumbayar = $sumtotal = 0;
            // return json_encode($kunjbaru);
            $i = 0;
            foreach ($kunjbaru as $key => $value) {
                $jml = $subsidi = $pot = $retur = $bayar = $total = 0;
                foreach ($value as $key1 => $value1) {
                    $i++;
                    // return json_encode($key);
                    $row = array();
                    $row[] = $i;
                    foreach ($bulan as $bulankey => $valuekey) {
                        if (($bulankey + 1) == $key1)
                            $row[] = $bulan[$bulankey];
                    }
                    $row[] = number_format($kunjbaru[$key][$key1]['jml'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['subsidi'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['pot'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['retur'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['bayar'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['jml'] - ($kunjbaru[$key][$key1]['subsidi'] + $kunjbaru[$key][$key1]['pot']) - $kunjbaru[$key][$key1]['bayar'] + $kunjbaru[$key][$key1]['retur'], 2);

                    $jml += $kunjbaru[$key][$key1]['jml'];
                    $subsidi += $kunjbaru[$key][$key1]['subsidi'];
                    $pot += $kunjbaru[$key][$key1]['pot'];
                    $retur += $kunjbaru[$key][$key1]['retur'];
                    $bayar += $kunjbaru[$key][$key1]['bayar'];
                    $total += $kunjbaru[$key][$key1]['jml'] - ($kunjbaru[$key][$key1]['subsidi'] + $kunjbaru[$key][$key1]['pot']) - $kunjbaru[$key][$key1]['bayar'] + $kunjbaru[$key][$key1]['retur'];
                    $dt_data[] = $row;
                }

                $sumjml += $jml;
                $sumsubsidi += $subsidi;
                $sumpot += $pot;
                $sumretur += $retur;
                $sumbayar += $bayar;
                $sumtotal += $total;


                $row = [];
                $row[] = '';
                $row[] = 'Total Tahun ' . $key;
                $row[] = number_format($jml, 2);
                $row[] = number_format($subsidi, 2);
                $row[] = number_format($pot, 2);
                $row[] = number_format($retur, 2);
                $row[] = number_format($bayar, 2);
                $row[] = number_format($total, 2);
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = 'Total Nilai Transaksi ' . $key;
            $row[] = number_format($sumjml, 2);
            $row[] = number_format($sumsubsidi, 2);
            $row[] = number_format($sumpot, 2);
            $row[] = number_format($sumretur, 2);
            $row[] = number_format($sumbayar, 2);
            $row[] = number_format($sumtotal, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tagihan</th>
                        <th>Subsidi</th>
                        <th>Potongan</th>
                        <th>Retur</th>
                        <th>Pembayaran</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function finjenis()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Keuangan Per Jenis';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status
        ]);
    }
    public function finjenispost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $status = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');


        $kunjungan = $this->lowerKey($model->getjenis($mulai, $akhir, $status, $isrj));
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {


            $jml = $jmltest = $jmltagihan = $jmlsubsidi = $pelunasan = $retur = $total = 0;
            foreach ($kunjungan as $key => $value) {
                $row = array();
                $row[] = $key + 1;
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = number_format($kunjungan[$key]['jml'], 2);
                $row[] = number_format($kunjungan[$key]['jmltest'], 2);
                $row[] = number_format($kunjungan[$key]['jmltagihan'], 2);
                $row[] = number_format($kunjungan[$key]['jmlsubsidi'] + $kunjungan[$key]['jmldiskon'] + $kunjungan[$key]['jmlpotongan'], 2);
                $row[] = number_format($kunjungan[$key]['jmlbayar'], 2);
                $row[] = number_format($kunjungan[$key]['jmlretur'], 2);
                $row[] = number_format($kunjungan[$key]['jmltagihan'] - ($kunjungan[$key]['jmldiskon'] + $kunjungan[$key]['jmlpotongan'] + $kunjungan[$key]['jmlsubsidi']) - $kunjungan[$key]['jmlbayar'] + $kunjungan[$key]['jmlretur'], 2);

                $jml += ($kunjungan[$key]['jml']);
                $jmltest += ($kunjungan[$key]['jmltest']);
                $jmltagihan += ($kunjungan[$key]['jmltagihan']);
                $jmlsubsidi += ($kunjungan[$key]['jmlsubsidi'] + $kunjungan[$key]['jmldiskon'] + $kunjungan[$key]['jmlpotongan']);
                $pelunasan += ($kunjungan[$key]['jmlbayar']);
                $retur += ($kunjungan[$key]['jmlretur']);
                $total += ($kunjungan[$key]['jmltagihan'] - ($kunjungan[$key]['jmldiskon'] + $kunjungan[$key]['jmlpotongan'] + $kunjungan[$key]['jmlsubsidi']) - $kunjungan[$key]['jmlbayar'] + $kunjungan[$key]['jmlretur']);




                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = 'Sub Total';
            $row[] = number_format($jml, 2);
            $row[] = number_format($jmltest, 2);
            $row[] = number_format($jmltagihan, 2);
            $row[] = number_format($jmlsubsidi, 2);
            $row[] = number_format($pelunasan, 2);
            $row[] = number_format($retur, 2);
            $row[] = number_format($total, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Tagihan</th>
                        <th>Subsidi</th>
                        <th>Potongan</th>
                        <th>Retur</th>
                        <th>Pembayaran</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function fintglpoli()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Tanggal - Poli';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $clinic = $this->getClinic([0, 1, 2, 3, 4, 5, 6, 72, 73, 50]);


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'clinic' => $clinic
        ]);
    }
    public function fintglpolipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $kunjungan = $this->lowerKey($model->gettglpoli($mulai, $akhir, $clinic_id, $isrj));



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['jml'] = 0;
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['subsidi'] = 0;
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['pot'] = 0;
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['retur'] = 0;
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['bayar'] = 0;
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['total'] = 0;
            }
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['jml'] += $kunjungan[$key]['jml'];
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['subsidi'] += $kunjungan[$key]['subsidi'];
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['pot'] += $kunjungan[$key]['pot'];
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['retur'] += $kunjungan[$key]['retur'];
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['bayar'] += $kunjungan[$key]['bayar'];
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$kunjungan[$key]['name_of_clinic']]['total'] += $kunjungan[$key]['jml'] - ($kunjungan[$key]['subsidi'] + $kunjungan[$key]['pot']) - $kunjungan[$key]['bayar'] + $kunjungan[$key]['retur'];
            }
            ksort($kunjbaru);
            // return json_encode($kunjbaru);

            $sumjml = $sumsubsidi = $sumpot = $sumretur = $sumbayar = $sumtotal = 0;
            // return json_encode($kunjbaru);
            $i = 0;
            foreach ($kunjbaru as $key => $value) {
                $jml = $subsidi = $pot = $retur = $bayar = $total = 0;


                $row = [];
                // $row[] = '';
                $row[] = "<h4 style='color: red;'>" . $key . "</h4>";
                // $row[] = number_format($jml, 2);
                // $row[] = number_format($subsidi, 2);
                // $row[] = number_format($pot, 2);
                // $row[] = number_format($retur, 2);
                // $row[] = number_format($bayar, 2);
                // $row[] = number_format($total, 2);
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                foreach ($kunjsementara as $key1 => $value1) {
                    $row = [];
                    $row[] = '';

                    $row[] = $key1;
                    $row[] = number_format($kunjbaru[$key][$key1]['jml'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['subsidi'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['pot'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['retur'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['bayar'], 2);
                    $row[] = number_format($kunjbaru[$key][$key1]['jml'] - ($kunjbaru[$key][$key1]['subsidi'] + $kunjbaru[$key][$key1]['pot']) - $kunjbaru[$key][$key1]['bayar'] + $kunjbaru[$key][$key1]['retur'], 2);
                    $jml += $kunjbaru[$key][$key1]['jml'];
                    $subsidi += $kunjbaru[$key][$key1]['subsidi'];
                    $pot += $kunjbaru[$key][$key1]['pot'];
                    $retur += $kunjbaru[$key][$key1]['retur'];
                    $bayar += $kunjbaru[$key][$key1]['bayar'];
                    $total += $kunjbaru[$key][$key1]['jml'] - ($kunjbaru[$key][$key1]['subsidi'] + $kunjbaru[$key][$key1]['pot']) - $kunjbaru[$key][$key1]['bayar'] + $kunjbaru[$key][$key1]['retur'];
                    $dt_data[] = $row;
                }
                $row = [];
                $row[] = '<h5 style="color: blue">Total Per Tanggal - ' . $key . "</h5>";
                $row[] = '';
                $row[] = '<h5 style="color: blue"> ' . number_format($jml, 2) . "</h5>";
                $row[] = '<h5 style="color: blue"> ' . number_format($subsidi, 2) . "</h5>";
                $row[] = '<h5 style="color: blue"> ' . number_format($pot, 2) . "</h5>";
                $row[] = '<h5 style="color: blue"> ' . number_format($retur, 2) . "</h5>";
                $row[] = '<h5 style="color: blue"> ' . number_format($bayar, 2) . "</h5>";
                $row[] = '<h5 style="color: blue"> ' . number_format($total, 2) . "</h5>";
                $dt_data[] = $row;

                $sumjml += $jml;
                $sumsubsidi += $subsidi;
                $sumpot += $pot;
                $sumretur += $retur;
                $sumbayar += $bayar;
                $sumtotal += $total;
            }
            $row = [];
            // $row[] = '';
            $row[] = '<h4 style="color: red">Total Nilai Transaksi </h4>';
            $row[] = '<h4 style="color: red">' . number_format($sumjml, 2) . "</h4>";
            $row[] = '<h4 style="color: red">' . number_format($sumsubsidi, 2) . "</h4>";
            $row[] = '<h4 style="color: red">' . number_format($sumpot, 2) . "</h4>";
            $row[] = '<h4 style="color: red">' . number_format($sumretur, 2) . "</h4>";
            $row[] = '<h4 style="color: red">' . number_format($sumbayar, 2) . "</h4>";
            $row[] = '<h4 style="color: red">' . number_format($sumtotal, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th colspan="2">Pelayanan</th>
                        <th>Tagihan</th>
                        <th>Subsidi</th>
                        <th>Potongan</th>
                        <th>Retur</th>
                        <th>Pembayaran</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function finpolitgl()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Poli - Tanggal';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $clinic = $this->getClinic([0, 1, 2, 3, 4, 5, 6, 72, 73, 50]);


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'clinic' => $clinic
        ]);
    }
    public function finpolitglpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');

        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $kunjungan = $this->lowerKey($model->gettglpoli($mulai, $akhir, $clinic_id, $isrj));



        $dt_data     = array();
        if (!empty($kunjungan)) {
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['jml'] = 0;
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['subsidi'] = 0;
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['pot'] = 0;
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['retur'] = 0;
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['bayar'] = 0;
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['total'] = 0;
            }
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['jml'] += $kunjungan[$key]['jml'];
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['subsidi'] += $kunjungan[$key]['subsidi'];
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['pot'] += $kunjungan[$key]['pot'];
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['retur'] += $kunjungan[$key]['retur'];
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['bayar'] += $kunjungan[$key]['bayar'];
                $kunjbaru[($kunjungan[$key]['name_of_clinic'])][substr($kunjungan[$key]['tgl'], 0, 10)]['total'] += $kunjungan[$key]['jml'] - ($kunjungan[$key]['subsidi'] + $kunjungan[$key]['pot']) - $kunjungan[$key]['bayar'] + $kunjungan[$key]['retur'];
            }
            ksort($kunjbaru);
            // return json_encode($kunjbaru);

            $sumjml = $sumsubsidi = $sumpot = $sumretur = $sumbayar = $sumtotal = 0;
            // return json_encode($kunjbaru);
            $i = 0;
            foreach ($kunjbaru as $key => $value) {
                $jml = $subsidi = $pot = $retur = $bayar = $total = 0;


                $row = [];
                // $row[] = '';
                $row[] = $key;
                // $row[] = number_format($jml, 2);
                // $row[] = number_format($subsidi, 2);
                // $row[] = number_format($pot, 2);
                // $row[] = number_format($retur, 2);
                // $row[] = number_format($bayar, 2);
                // $row[] = number_format($total, 2);
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                foreach ($kunjsementara as $key1 => $value1) {
                    $row = [];
                    $row[] = '';

                    $row[] = $key1;
                    $row[] = number_format($kunjsementara[$key1]['jml'], 2);
                    $row[] = number_format($kunjsementara[$key1]['subsidi'], 2);
                    $row[] = number_format($kunjsementara[$key1]['pot'], 2);
                    $row[] = number_format($kunjsementara[$key1]['retur'], 2);
                    $row[] = number_format($kunjsementara[$key1]['bayar'], 2);
                    $row[] = number_format($kunjsementara[$key1]['jml'] - ($kunjsementara[$key1]['subsidi'] + $kunjsementara[$key1]['pot']) - $kunjsementara[$key1]['bayar'] + $kunjsementara[$key1]['retur'], 2);
                    $jml += $kunjsementara[$key1]['jml'];
                    $subsidi += $kunjsementara[$key1]['subsidi'];
                    $pot += $kunjsementara[$key1]['pot'];
                    $retur += $kunjsementara[$key1]['retur'];
                    $bayar += $kunjsementara[$key1]['bayar'];
                    $total += $kunjsementara[$key1]['jml'] - ($kunjsementara[$key1]['subsidi'] + $kunjsementara[$key1]['pot']) - $kunjsementara[$key1]['bayar'] + $kunjsementara[$key1]['retur'];
                    $dt_data[] = $row;
                }
                $row = [];
                $row[] = 'Total Per Poli - ' . $key;
                $row[] = '';
                $row[] = number_format($jml, 2);
                $row[] = number_format($subsidi, 2);
                $row[] = number_format($pot, 2);
                $row[] = number_format($retur, 2);
                $row[] = number_format($bayar, 2);
                $row[] = number_format($total, 2);
                $dt_data[] = $row;

                $sumjml += $jml;
                $sumsubsidi += $subsidi;
                $sumpot += $pot;
                $sumretur += $retur;
                $sumbayar += $bayar;
                $sumtotal += $total;
            }
            $row = [];
            // $row[] = '';
            $row[] = 'Total Nilai Transaksi ';
            $row[] = number_format($sumjml, 2);
            $row[] = number_format($sumsubsidi, 2);
            $row[] = number_format($sumpot, 2);
            $row[] = number_format($sumretur, 2);
            $row[] = number_format($sumbayar, 2);
            $row[] = number_format($sumtotal, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th colspan="2">Pelayanan</th>
                        <th>Tagihan</th>
                        <th>Subsidi</th>
                        <th>Potongan</th>
                        <th>Retur</th>
                        <th>Pembayaran</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }
    public function finpoli()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Keuangan Poli Rinci';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $clinic = $this->getClinic([0, 1, 2, 3, 4, 5, 6, 72, 73, 50]);


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'clinic' => $clinic
        ]);
    }
    public function finpolipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');


        $kunjungan = $this->lowerKey($model->getpolidetil($mulai, $akhir, $clinic_id, $isrj));
        // return json_encode($kunjungan);




        $dt_data     = array();
        if (!empty($kunjungan)) {
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['name_of_clinic']][substr($kunjungan[$key]['tgl'], 0, 10)][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);
            // return json_encode($kunjbaru);

            $sumjml = $sumsubsidi = $sumpot = $sumretur = $sumbayar = $sumtotal = 0;
            // return json_encode($kunjbaru);
            $i = 0;
            foreach ($kunjbaru as $key => $value) {
                $jml = $subsidi = $pot = $retur = $bayar = $total = 0;


                $row = [];
                // $row[] = '';
                $row[] = $key;
                // $row[] = number_format($jml, 2);
                // $row[] = number_format($subsidi, 2);
                // $row[] = number_format($pot, 2);
                // $row[] = number_format($retur, 2);
                // $row[] = number_format($bayar, 2);
                // $row[] = number_format($total, 2);
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                // return json_encode($kunjsementara);
                foreach ($kunjsementara as $key1 => $value1) {
                    foreach ($value1 as $key2 => $value2) {
                        $i++;
                        $row = [];
                        $row[] = $i;
                        $row[] = $key1;
                        $row[] = $kunjsementara[$key1][$key2]['nomr'];
                        $row[] = $kunjsementara[$key1][$key2]['nama'];
                        $row[] = $kunjsementara[$key1][$key2]['nokartu'];
                        $row[] = $kunjsementara[$key1][$key2]['umur'];
                        $row[] = $kunjsementara[$key1][$key2]['alamat'];
                        $row[] = $kunjsementara[$key1][$key2]['namatindakan'];
                        $row[] = number_format($kunjsementara[$key1][$key2]['jml'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['subsidi'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['pot'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['retur'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['bayar'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jml'] - ($kunjsementara[$key1][$key2]['subsidi'] + $kunjsementara[$key1][$key2]['pot']) - $kunjsementara[$key1][$key2]['bayar'] + $kunjsementara[$key1][$key2]['retur'], 2);
                        $jml += $kunjsementara[$key1][$key2]['jml'];
                        $subsidi += $kunjsementara[$key1][$key2]['subsidi'];
                        $pot += $kunjsementara[$key1][$key2]['pot'];
                        $retur += $kunjsementara[$key1][$key2]['retur'];
                        $bayar += $kunjsementara[$key1][$key2]['bayar'];
                        $total += $kunjsementara[$key1][$key2]['jml'] - ($kunjsementara[$key1][$key2]['subsidi'] + $kunjsementara[$key1][$key2]['pot']) - $kunjsementara[$key1][$key2]['bayar'] + $kunjsementara[$key1][$key2]['retur'];
                        $dt_data[] = $row;
                    }
                }
                $row = [];
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = 'Total ' . $key;
                $row[] = number_format($jml, 2);
                $row[] = number_format($subsidi, 2);
                $row[] = number_format($pot, 2);
                $row[] = number_format($retur, 2);
                $row[] = number_format($bayar, 2);
                $row[] = number_format($total, 2);
                $dt_data[] = $row;

                $sumjml += $jml;
                $sumsubsidi += $subsidi;
                $sumpot += $pot;
                $sumretur += $retur;
                $sumbayar += $bayar;
                $sumtotal += $total;
            }
            $row = [];
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = 'Total Nilai Transaksi ';
            $row[] = number_format($sumjml, 2);
            $row[] = number_format($sumsubsidi, 2);
            $row[] = number_format($sumpot, 2);
            $row[] = number_format($sumretur, 2);
            $row[] = number_format($sumbayar, 2);
            $row[] = number_format($sumtotal, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No CM</th>
                        <th>Nama</th>
                        <th>No. Jaminan</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                        <th>Tagihan</th>
                        <th>Subsidi</th>
                        <th>Potongan</th>
                        <th>Retur</th>
                        <th>Pembayaran</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function finjenistgl()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Keuangan Jenis-Tgl';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status
        ]);
    }
    public function finjenistglpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');


        $kunjungan = $this->lowerKey($model->getjenis($mulai, $akhir, $status_pasien_id, $isrj));

        $status = $this->getStatusPasien();
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['status_pasien_id']][substr($kunjungan[$key]['tgl'], 0, 10)][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);


            $i = 0;
            $jml = $jmltest = $jmltagihan = $jmlsubsidi = $pelunasan = $retur = $total = 0;
            $sumjml = 0;
            $sumjmltest = 0;
            $sumjmltagihan = 0;
            $sumjmlsubsidi = 0;
            $sumpelunasan = 0;
            $sumretur = 0;
            $sumtotal = 0;
            foreach ($kunjbaru as $key => $value) {
                $jml = $jmltest = $jmltagihan = $jmlsubsidi = $pelunasan = $retur = $total = 0;

                $row = [];
                // $row[] = '';
                foreach ($status as $skey => $svalue) {
                    if ($status[$skey]['status_pasien_id'] == $key) {
                        $row[] = $status[$skey]['name_of_status_pasien'];
                    }
                }
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                // return json_encode($kunjsementara);
                foreach ($kunjsementara as $key1 => $value1) {

                    foreach ($value1 as $key2 => $value2) {
                        $i++;
                        $row = [];
                        $row[] = $i;
                        $row[] = $key1;
                        $row[] = number_format($kunjsementara[$key1][$key2]['jml'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmltest'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmltagihan'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmlsubsidi'] + $kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmlbayar'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmlretur'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmltagihan'] - ($kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'] + $kunjsementara[$key1][$key2]['jmlsubsidi']) - $kunjsementara[$key1][$key2]['jmlbayar'] + $kunjsementara[$key1][$key2]['jmlretur'], 2);
                        $dt_data[] = $row;

                        $jml += ($kunjsementara[$key1][$key2]['jml']);
                        $jmltest += ($kunjsementara[$key1][$key2]['jmltest']);
                        $jmltagihan += ($kunjsementara[$key1][$key2]['jmltagihan']);
                        $jmlsubsidi += ($kunjsementara[$key1][$key2]['jmlsubsidi'] + $kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan']);
                        $pelunasan += ($kunjsementara[$key1][$key2]['jmlbayar']);
                        $retur += ($kunjsementara[$key1][$key2]['jmlretur']);
                        $total += ($kunjsementara[$key1][$key2]['jmltagihan'] - ($kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'] + $kunjsementara[$key1][$key2]['jmlsubsidi']) - $kunjsementara[$key1][$key2]['jmlbayar'] + $kunjsementara[$key1][$key2]['jmlretur']);



                        $sumjml += $jml;
                        $sumjmltest += $jmltest;
                        $sumjmltagihan += $jmltagihan;
                        $sumjmlsubsidi += $jmlsubsidi;
                        $sumpelunasan += $pelunasan;
                        $sumretur += $retur;
                        $sumtotal += $total;
                    }
                }



                $row = [];
                $row[] = '';
                $row[] = 'Sub Total';
                $row[] = number_format($jml, 2);
                $row[] = number_format($jmltest, 2);
                $row[] = number_format($jmltagihan, 2);
                $row[] = number_format($jmlsubsidi, 2);
                $row[] = number_format($pelunasan, 2);
                $row[] = number_format($retur, 2);
                $row[] = number_format($total, 2);
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = 'Total';
            $row[] = number_format($sumjml, 2);
            $row[] = number_format($sumjmltest, 2);
            $row[] = number_format($sumjmltagihan, 2);
            $row[] = number_format($sumjmlsubsidi, 2);
            $row[] = number_format($sumpelunasan, 2);
            $row[] = number_format($sumretur, 2);
            $row[] = number_format($sumtotal, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jml Pasien</th>
                        <th>Jml Tindakan</th>
                        <th>Tagihan</th>
                        <th>Subsidi/Diskon/Pot</th>
                        <th>Pelunasan/Angs/Deposit</th>
                        <th>Retur Bayar</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function finjenisrinci()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Per Jenis Pasien';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status
        ]);
    }
    public function finjenisrincipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        // $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');


        $kunjungan = $this->lowerKey($model->getjenis($mulai, $akhir, $status_pasien_id, $isrj));

        $status = $this->getStatusPasien();
        // return json_encode($kunjungan);



        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['status_pasien_id']][substr($kunjungan[$key]['tgl'], 0, 10)][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);


            $i = 0;
            $jml = $jmltest = $jmltagihan = $jmlsubsidi = $pelunasan = $retur = $total = 0;
            $sumjml = 0;
            $sumjmltest = 0;
            $sumjmltagihan = 0;
            $sumjmlsubsidi = 0;
            $sumpelunasan = 0;
            $sumretur = 0;
            $sumtotal = 0;
            foreach ($kunjbaru as $key => $value) {
                $jml = $jmltest = $jmltagihan = $jmlsubsidi = $pelunasan = $retur = $total = 0;
                $statuskey = '';
                $row = [];
                $row[] = '';
                foreach ($status as $skey => $svalue) {
                    if ($status[$skey]['status_pasien_id'] == $key) {
                        $statuskey = $status[$skey]['name_of_status_pasien'];
                        $row[] = "<h4 style='color: red'>" . $statuskey . "</h4>";
                    }
                }
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                // return json_encode($kunjsementara);
                foreach ($kunjsementara as $key1 => $value1) {
                    $row = [];
                    $row[] = "";
                    $row[] = "<h5 style='color: blue'>" . $key1 . "</h5>";
                    $dt_data[] = $row;

                    $tgljml = 0;
                    $tgljmltest = 0;
                    $tgljmltagihan = 0;
                    $tgljmlsubsidi = 0;
                    $tglpelunasan = 0;
                    $tglretur = 0;
                    $tgltotal = 0;
                    foreach ($value1 as $key2 => $value2) {
                        $i++;
                        $row = [];
                        $row[] = $i;
                        $row[] = $key1;
                        $row[] = number_format($kunjsementara[$key1][$key2]['jml'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmltest'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmltagihan'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmlsubsidi'] + $kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmlbayar'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmlretur'], 2);
                        $row[] = number_format($kunjsementara[$key1][$key2]['jmltagihan'] - ($kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'] + $kunjsementara[$key1][$key2]['jmlsubsidi']) - $kunjsementara[$key1][$key2]['jmlbayar'] + $kunjsementara[$key1][$key2]['jmlretur'], 2);
                        $dt_data[] = $row;

                        $tgljml += ($kunjsementara[$key1][$key2]['jml']);
                        $tgljmltest += ($kunjsementara[$key1][$key2]['jmltest']);
                        $tgljmltagihan += ($kunjsementara[$key1][$key2]['jmltagihan']);
                        $tgljmlsubsidi += ($kunjsementara[$key1][$key2]['jmlsubsidi'] + $kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan']);
                        $tglpelunasan += ($kunjsementara[$key1][$key2]['jmlbayar']);
                        $tglretur += ($kunjsementara[$key1][$key2]['jmlretur']);
                        $tgltotal += ($kunjsementara[$key1][$key2]['jmltagihan'] - ($kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'] + $kunjsementara[$key1][$key2]['jmlsubsidi']) - $kunjsementara[$key1][$key2]['jmlbayar'] + $kunjsementara[$key1][$key2]['jmlretur']);

                        $jml += ($kunjsementara[$key1][$key2]['jml']);
                        $jmltest += ($kunjsementara[$key1][$key2]['jmltest']);
                        $jmltagihan += ($kunjsementara[$key1][$key2]['jmltagihan']);
                        $jmlsubsidi += ($kunjsementara[$key1][$key2]['jmlsubsidi'] + $kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan']);
                        $pelunasan += ($kunjsementara[$key1][$key2]['jmlbayar']);
                        $retur += ($kunjsementara[$key1][$key2]['jmlretur']);
                        $total += ($kunjsementara[$key1][$key2]['jmltagihan'] - ($kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'] + $kunjsementara[$key1][$key2]['jmlsubsidi']) - $kunjsementara[$key1][$key2]['jmlbayar'] + $kunjsementara[$key1][$key2]['jmlretur']);

                        $sumjml += ($kunjsementara[$key1][$key2]['jml']);
                        $sumjmltest += ($kunjsementara[$key1][$key2]['jmltest']);
                        $sumjmltagihan += ($kunjsementara[$key1][$key2]['jmltagihan']);
                        $sumjmlsubsidi += ($kunjsementara[$key1][$key2]['jmlsubsidi'] + $kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan']);
                        $sumpelunasan += ($kunjsementara[$key1][$key2]['jmlbayar']);
                        $sumretur += ($kunjsementara[$key1][$key2]['jmlretur']);
                        $sumtotal += ($kunjsementara[$key1][$key2]['jmltagihan'] - ($kunjsementara[$key1][$key2]['jmldiskon'] + $kunjsementara[$key1][$key2]['jmlpotongan'] + $kunjsementara[$key1][$key2]['jmlsubsidi']) - $kunjsementara[$key1][$key2]['jmlbayar'] + $kunjsementara[$key1][$key2]['jmlretur']);
                    }
                    $row = [];
                    $row[] = '';
                    $row[] = 'Sub Total ' . $key1;
                    $row[] = number_format($tgljml, 2);
                    $row[] = number_format($tgljmltest, 2);
                    $row[] = number_format($tgljmltagihan, 2);
                    $row[] = number_format($tgljmlsubsidi, 2);
                    $row[] = number_format($tglpelunasan, 2);
                    $row[] = number_format($tglretur, 2);
                    $row[] = number_format($tgltotal, 2);
                    $dt_data[] = $row;
                }



                $row = [];
                $row[] = '';
                $row[] = 'Sub Total' . $statuskey;
                $row[] = number_format($jml, 2);
                $row[] = number_format($jmltest, 2);
                $row[] = number_format($jmltagihan, 2);
                $row[] = number_format($jmlsubsidi, 2);
                $row[] = number_format($pelunasan, 2);
                $row[] = number_format($retur, 2);
                $row[] = number_format($total, 2);
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = 'Total';
            $row[] = number_format($sumjml, 2);
            $row[] = number_format($sumjmltest, 2);
            $row[] = number_format($sumjmltagihan, 2);
            $row[] = number_format($sumjmlsubsidi, 2);
            $row[] = number_format($sumpelunasan, 2);
            $row[] = number_format($sumretur, 2);
            $row[] = number_format($sumtotal, 2);
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jml Pasien</th>
                        <th>Jml Tindakan</th>
                        <th>Tagihan</th>
                        <th>Subsidi/Diskon/Pot</th>
                        <th>Pelunasan/Angs/Deposit</th>
                        <th>Retur Bayar</th>
                        <th>Total Tagihan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
            // 'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function finpembayarantgl()
    {
        $giTipe = 7;
        $title = 'Rekap Pembayaran Per Tanggal';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $treatTarif = $this->getPembayaran();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'treatTarif' => $treatTarif
        ]);
    }

    public function finpembayarantglpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $tarif_id = $this->request->getPost('tarif_id');


        $kunjungan = $this->lowerKey($model->getpembayaran($mulai, $akhir, $tarif_id, $isrj));




        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[substr($kunjungan[$key]['tgl'], 0, 10)][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);


            foreach ($kunjbaru as $key => $value) {
                $row = [];
                $row[] = "<h4 style='color: red'>" . $key . "</h4>";;
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                // return json_encode($kunjsementara);
                foreach ($kunjsementara as $key1 => $value1) {
                    $row = [];
                    $row[] = $kunjsementara[$key1]['namatindakan'];
                    if (in_array($kunjsementara[$key1]['tarif_type'], ['200', '300', '600']))
                        $row[] = number_format($kunjsementara[$key1]['bayar'], 2);
                    else if (in_array($kunjsementara[$key1]['tarif_type'], ['900', '100']))
                        $row[] = number_format($kunjsementara[$key1]['subsidi'], 2);
                    else if (in_array($kunjsementara[$key1]['tarif_type'], ['400']))
                        $row[] = number_format($kunjsementara[$key1]['pot'], 2);
                    else if (in_array($kunjsementara[$key1]['tarif_type'], ['500']))
                        $row[] = number_format($kunjsementara[$key1]['retur'], 2);
                    else
                        $row[] = 0;
                    $dt_data[] = $row;
                }
            }
        }
        $header = [];
        $header = '<tr>
                        <th style="width: 500px;">Nama Transaksi</th>
                        <th>Jumlah</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function finpembayarantrx()
    {
        $giTipe = 7;
        $title = 'Rekap Pembayaran Per TRX';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $treatTarif = $this->getPembayaran();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'treatTarif' => $treatTarif
        ]);
    }

    public function finpembayarantrxpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $tarif_id = $this->request->getPost('tarif_id');


        $kunjungan = $this->lowerKey($model->getpembayaran($mulai, $akhir, $tarif_id, $isrj));




        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['namatindakan']][$kunjungan[$key]['tgl']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $total = 0;
            foreach ($kunjbaru as $key => $value) {
                $row = [];
                $row[] = "<h4 style='color: red'>" . $key . "</h4>";;
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                // return json_encode($kunjsementara);
                $subtotal = 0;
                foreach ($kunjsementara as $key1 => $value1) {
                    foreach ($value1 as $key2 => $value2) {
                        $row = [];
                        $row[] = substr($kunjsementara[$key1][$key2]['tgl'], 0, 10);
                        $amount = 0;
                        if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['200', '300', '600']))
                            $amount = $kunjsementara[$key1][$key2]['bayar'];
                        else if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['900', '100']))
                            $amount = $kunjsementara[$key1][$key2]['subsidi'];

                        else if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['400']))
                            $amount = $kunjsementara[$key1][$key2]['pot'];
                        else if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['500']))
                            $amount = $kunjsementara[$key1][$key2]['retur'];

                        $row[] = number_format($amount, 2);
                        $dt_data[] = $row;
                        $subtotal += $amount;
                        $total += $amount;
                    }
                }
                $row = [];
                $row[] = "<h5 style='color: blue'>Sub Total</h5>";
                $row[] = "<h4 style='color: blue'>" . number_format($subtotal, 2) . "</h4>";
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = "<h4 style='color: red'>Total</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($total, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th style="width: 500px;">Nama Transaksi</th>
                        <th>Jumlah</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function finpembayaranrinci()
    {
        $giTipe = 7;
        $title = 'Rekap Pembayaran Rinci';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $treatTarif = $this->getPembayaran();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'treatTarif' => $treatTarif
        ]);
    }

    public function finpembayaranrincipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $tarif_id = $this->request->getPost('tarif_id');


        $kunjungan = $this->lowerKey($model->getpembayaranrinci($mulai, $akhir, $tarif_id, $isrj));




        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['namatindakan']][$kunjungan[$key]['tgl']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            $total = 0;
            foreach ($kunjbaru as $key => $value) {
                $row = [];
                $row[] = '';
                $row[] = "<h4 style='color: red'>" . $key . "</h4>";;
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                ksort($kunjsementara);
                // return json_encode($kunjsementara);
                $subtotal = 0;
                foreach ($kunjsementara as $key1 => $value1) {
                    $subsubtotal = 0;
                    $row = [];
                    $row[] = '';
                    $row[] = "<h5 style='color: blue'>" . substr($key1, 0, 10) . "</h5>";;
                    $dt_data[] = $row;
                    foreach ($value1 as $key2 => $value2) {
                        $i++;
                        $row = [];
                        $row[] = $i;
                        $row[] = substr($kunjsementara[$key1][$key2]['tgl'], 0, 10);
                        $row[] = $kunjsementara[$key1][$key2]['nomr'];
                        $row[] = $kunjsementara[$key1][$key2]['nama'];
                        $row[] = $kunjsementara[$key1][$key2]['nokartu'];
                        $row[] = $kunjsementara[$key1][$key2]['th'] . "th " . $kunjsementara[$key1][$key2]['bln'] . "bln " . $kunjsementara[$key1][$key2]['hr'] . "hr ";
                        $row[] = $kunjsementara[$key1][$key2]['alamat'];
                        if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['200', '300', '600']))
                            $amount = $kunjsementara[$key1][$key2]['bayar'];
                        else if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['900', '100']))
                            $amount = $kunjsementara[$key1][$key2]['subsidi'];

                        else if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['400']))
                            $amount = $kunjsementara[$key1][$key2]['pot'];
                        else if (in_array($kunjsementara[$key1][$key2]['tarif_type'], ['500']))
                            $amount = $kunjsementara[$key1][$key2]['retur'];

                        $row[] = number_format($amount, 2);
                        $row[] = $kunjsementara[$key1][$key2]['spp'];
                        $row[] = $kunjsementara[$key1][$key2]['karyawan'];
                        $row[] = $kunjsementara[$key1][$key2]['name_of_clinic'];


                        $dt_data[] = $row;
                        $subsubtotal += $amount;
                        $subtotal += $amount;
                        $total += $amount;
                    }
                    $row = [];
                    $row[] = '';
                    $row[] = "<h6 style='color: green'>Sub Total</h6>";
                    $row[] = "<h6 style='color: green'>" . number_format($subsubtotal, 2) . "</h6>";
                    $dt_data[] = $row;
                }
                $row = [];
                $row[] = '';
                $row[] = "<h5 style='color: blue'>Sub Total</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subtotal, 2) . "</h5>";
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = "<h4 style='color: red'>Total</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($total, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No CM</th>
                        <th>Nama</th>
                        <th>No.Jaminan</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>No. Setoran</th>
                        <th>Kasir</th>
                        <th>Poli</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }

    public function finsetor()
    {
        $giTipe = 7;
        $title = 'Rekap Transaksi Kasir';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $kasir = $this->getKasir();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'shift' => '1',
            'kasir' => $kasir
        ]);
    }
    public function finsetorpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $kasir = $this->request->getPost('kasir');
        $shift = $this->request->getPost('shift');


        $mulaidate = date_create(strval($mulai));
        $akhirdate = date_create(strval($mulai));

        if ($shift == '1') {
            date_add($mulaidate, date_interval_create_from_date_string("8 hours"));
            date_add($akhirdate, date_interval_create_from_date_string("14 hours"));
        } else if ($shift == '2') {
            date_add($mulaidate, date_interval_create_from_date_string("14 hours 1 seconds"));
            date_add($akhirdate, date_interval_create_from_date_string("20 hours"));
        } else if ($shift == '3') {
            date_add($mulaidate, date_interval_create_from_date_string("20 hours 1 seconds"));
            date_add($akhirdate, date_interval_create_from_date_string("1 day 8 hours"));
        }

        $mulaistring = date_format($mulaidate, "Y-m-d H:i:s");
        $akhirstring = date_format($akhirdate, "Y-m-d H:i:s");

        // return json_encode($akhirstring);


        $kunjungan = $this->lowerKey($model->getsetoran($mulaistring, $akhirstring, $kasir, $isrj));



        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['tgl']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            $total = 0;
            $sumsubsidi = 0;
            $sumpot = 0;
            $sumretur = 0;
            $sumbayar = 0;
            $sumspsubsidi = 0;
            $sumsppot = 0;
            $sumspretur = 0;
            $sumspbayar = 0;
            foreach ($kunjbaru as $key => $value) {
                $row = [];
                $row[] = '';
                $row[] = "<h4 style='color: red'>" . substr($key, 0, 10) . "</h4>";;
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                // ksort($kunjsementara);
                // return json_encode($kunjsementara);
                $subtotal = 0;
                $subsubsidi = 0;
                $subpot = 0;
                $subretur = 0;
                $subbayar = 0;
                $subspsubsidi = 0;
                $subsppot = 0;
                $subspretur = 0;
                $subspbayar = 0;

                foreach ($kunjsementara as $key1 => $value1) {
                    $subsidi = 0;
                    $pot = 0;
                    $retur = 0;
                    $bayar = 0;
                    $spsubsidi = 0;
                    $sppot = 0;
                    $spretur = 0;
                    $spbayar = 0;
                    $i++;
                    $row = [];
                    $row[] = $i;
                    $row[] = $kunjsementara[$key1]['cashier'];
                    $row[] = substr($kunjsementara[$key1]['tgltrans'], 0, 16);
                    $row[] = $kunjsementara[$key1]['namatindakan'];
                    $row[] = number_format($kunjsementara[$key1]['subsidi'], 2);
                    $subsidi = $kunjsementara[$key1]['subsidi'];
                    if ($kunjsementara[$key1]['sppkasir'] != '' && !is_null($kunjsementara[$key1]['sppkasir'])) {
                        $row[] = number_format($kunjsementara[$key1]['subsidi'], 2);
                        $spsubsidi = $kunjsementara[$key1]['subsidi'];
                    } else
                        $row[] = 0;
                    $row[] = number_format($kunjsementara[$key1]['pot'], 2);
                    $pot = $kunjsementara[$key1]['pot'];
                    if ($kunjsementara[$key1]['sppkasir'] != '' && !is_null($kunjsementara[$key1]['sppkasir'])) {
                        $row[] = number_format($kunjsementara[$key1]['pot'], 2);
                        $sppot = $kunjsementara[$key1]['pot'];
                    } else
                        $row[] = 0;
                    $row[] = number_format($kunjsementara[$key1]['retur'], 2);
                    $retur = $kunjsementara[$key1]['retur'];
                    if ($kunjsementara[$key1]['sppkasir'] != '' && !is_null($kunjsementara[$key1]['sppkasir'])) {
                        $row[] = number_format($kunjsementara[$key1]['retur'], 2);
                        $spretur = $kunjsementara[$key1]['retur'];
                    } else
                        $row[] = 0;
                    $row[] = number_format($kunjsementara[$key1]['bayar'], 2);
                    $bayar = $kunjsementara[$key1]['bayar'];
                    if ($kunjsementara[$key1]['sppkasir'] != '' && !is_null($kunjsementara[$key1]['sppkasir'])) {
                        $row[] = number_format($kunjsementara[$key1]['bayar'], 2);
                        $spbayar = $kunjsementara[$key1]['bayar'];
                    } else
                        $row[] = 0;
                    $row[] = $kunjsementara[$key1]['sppkasir'];
                    $row[] = substr($kunjsementara[$key1]['sppkasirdate'], 0, 16);

                    $dt_data[] = $row;

                    $subsubsidi += $subsidi;
                    $subpot += $pot;
                    $subretur += $retur;
                    $subbayar += $bayar;
                    $subspsubsidi += $spsubsidi;
                    $subsppot += $sppot;
                    $subspretur += $spretur;
                    $subspbayar += $spbayar;

                    $sumsubsidi += $subsidi;
                    $sumpot += $pot;
                    $sumretur += $retur;
                    $sumbayar += $bayar;
                    $sumspsubsidi += $spsubsidi;
                    $sumsppot += $sppot;
                    $sumspretur += $spretur;
                    $sumspbayar += $spbayar;
                }
                $row = [];
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = "<h5 style='color: blue'>Sub Total</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subsubsidi, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subspsubsidi, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subpot, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subsppot, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subretur, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subspretur, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subbayar, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subspbayar, 2) . "</h5>";
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = "<h4 style='color: red'>Total</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumsubsidi, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumspsubsidi, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumpot, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumsppot, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumretur, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumspretur, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumbayar, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumspbayar, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kasir</th>
                        <th rowspan="2">Tgl Transaksi</th>
                        <th rowspan="2">Nama Tindakan</th>
                        <th colspan="2">Subsidi</th>
                        <th colspan="2">Potongan</th>
                        <th colspan="2">Retur</th>
                        <th colspan="2">Pembayaran</th>
                        <th colspan="2">Bukti Pengakuan/Setoran</th>
                    </tr>
                    <tr>
                        <th>Ditransaksikan</th>
                        <th>Sudah Diakui</th>
                        <th>Ditransaksikan</th>
                        <th>Sudah Diakui</th>
                        <th>Ditransaksikan</th>
                        <th>Sudah Diakui</th>
                        <th>Ditransaksikan</th>
                        <th>Sudah Diakui</th>
                        <th>Nomer</th>
                        <th>Tanggal</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function finsetorrinci()
    {
        $giTipe = 7;
        $title = 'Rincian Transaksi Kasir';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $kasir = $this->getKasir();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'shift' => '1',
            'kasir' => $kasir
        ]);
    }
    public function finsetorrincipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $kasir = $this->request->getPost('kasir');
        $shift = $this->request->getPost('shift');


        $mulaidate = date_create(strval($mulai));
        $akhirdate = date_create(strval($mulai));

        if ($shift == '1') {
            date_add($mulaidate, date_interval_create_from_date_string("8 hours"));
            date_add($akhirdate, date_interval_create_from_date_string("14 hours"));
        } else if ($shift == '2') {
            date_add($mulaidate, date_interval_create_from_date_string("14 hours 1 seconds"));
            date_add($akhirdate, date_interval_create_from_date_string("20 hours"));
        } else if ($shift == '3') {
            date_add($mulaidate, date_interval_create_from_date_string("20 hours 1 seconds"));
            date_add($akhirdate, date_interval_create_from_date_string("1 day 8 hours"));
        }

        $mulaistring = date_format($mulaidate, "Y-m-d H:i:s");
        $akhirstring = date_format($akhirdate, "Y-m-d H:i:s");

        // return json_encode($akhirstring);


        $kunjungan = $this->lowerKey($model->getsetoranrinci($mulaistring, $akhirstring, $kasir, $isrj));



        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['tgl']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            $total = 0;
            $sumsubsidi = 0;
            $sumpot = 0;
            $sumretur = 0;
            $sumbayar = 0;
            $sumspsubsidi = 0;
            $sumsppot = 0;
            $sumspretur = 0;
            $sumspbayar = 0;
            foreach ($kunjbaru as $key => $value) {
                $row = [];
                $row[] = '';
                $row[] = "<h4 style='color: red'>" . substr($key, 0, 10) . "</h4>";;
                $dt_data[] = $row;
                $kunjsementara = $kunjbaru[$key];
                // ksort($kunjsementara);
                // return json_encode($kunjsementara);
                $subtotal = 0;
                $subsubsidi = 0;
                $subpot = 0;
                $subretur = 0;
                $subbayar = 0;
                $subspsubsidi = 0;
                $subsppot = 0;
                $subspretur = 0;
                $subspbayar = 0;

                foreach ($kunjsementara as $key1 => $value1) {
                    $subsidi = 0;
                    $pot = 0;
                    $retur = 0;
                    $bayar = 0;
                    $spsubsidi = 0;
                    $sppot = 0;
                    $spretur = 0;
                    $spbayar = 0;
                    $i++;
                    $row = [];
                    $row[] = $i;
                    $row[] = $kunjsementara[$key1]['cashier'];
                    $row[] = substr($kunjsementara[$key1]['tgltrans'], 0, 16);
                    $row[] = $kunjsementara[$key1]['nomr'];
                    $row[] = $kunjsementara[$key1]['nama'];
                    $row[] = $kunjsementara[$key1]['nokartu'] ?? ' - ';
                    $row[] = $kunjsementara[$key1]['umur'] ?? ' - ';
                    $row[] = $kunjsementara[$key1]['alamat'];
                    $row[] = $kunjsementara[$key1]['namatindakan'];
                    $row[] = number_format($kunjsementara[$key1]['subsidi'], 2);
                    $subsidi = $kunjsementara[$key1]['subsidi'];
                    $row[] = number_format($kunjsementara[$key1]['pot'], 2);
                    $pot = $kunjsementara[$key1]['pot'];
                    $row[] = number_format($kunjsementara[$key1]['retur'], 2);
                    $retur = $kunjsementara[$key1]['retur'];
                    $row[] = number_format($kunjsementara[$key1]['bayar'], 2);
                    $bayar = $kunjsementara[$key1]['bayar'];
                    $row[] = $kunjsementara[$key1]['sppkasir'];
                    $row[] = substr($kunjsementara[$key1]['sppkasirdate'], 0, 16);

                    $dt_data[] = $row;

                    $subsubsidi += $subsidi;
                    $subpot += $pot;
                    $subretur += $retur;
                    $subbayar += $bayar;

                    $sumsubsidi += $subsidi;
                    $sumpot += $pot;
                    $sumretur += $retur;
                    $sumbayar += $bayar;
                }
                $row = [];
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = "<h5 style='color: blue'>Sub Total</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subsubsidi, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subpot, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subretur, 2) . "</h5>";
                $row[] = "<h5 style='color: blue'>" . number_format($subbayar, 2) . "</h5>";
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = "<h4 style='color: red'>Total</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumsubsidi, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumpot, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumretur, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($sumbayar, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kasir</th>
                        <th rowspan="2">Tgl Transaksi</th>
                        <th rowspan="2">No CM/MR</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">No. Jaminan</th>
                        <th rowspan="2">Umur</th>
                        <th rowspan="2">Alamat</th>
                        <th rowspan="2">Nama Tindakan</th>
                        <th rowspan="2">Subsidi</th>
                        <th rowspan="2">Potongan</th>
                        <th rowspan="2">Retur</th>
                        <th rowspan="2">Pembayaran</th>
                        <th colspan="2">Bukti Pengakuan/Setoran</th>
                    </tr>
                    <tr>
                        <th>Nomer</th>
                        <th>Tanggal</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }

    public function foantrol()
    {
        $giTipe = 7;
        $title = 'Laporan Antrian Online';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'tipeantrol' => '1',
        ]);
    }
    public function foantrolpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $tipeantrol = $this->request->getPost('tipeantrol');

        $db = db_connect();
        $sql = $db->query("select bb.trans_id, pv.DIANTAR_OLEH, NAME_OF_CLINIC,tipe,convert(char(8), mintime, 108) mintime,convert(char(8), maxtime, 108) maxtime, time1, time2, time3, time4, time5, time6, time7,
        sp.name_of_status_pasien,
        pv.no_registration,
        ea.fullname,
        pv.visit_date,
        convert(varchar(5),DateDiff(s, time1, time2)/3600)+':'+convert(varchar(5),DateDiff(s, time1, time2)%3600/60)+':'+convert(varchar(5),(DateDiff(s, time1, time2)%60)) time12,
        convert(varchar(5),DateDiff(s, time2, time3)/3600)+':'+convert(varchar(5),DateDiff(s, time2, time3)%3600/60)+':'+convert(varchar(5),(DateDiff(s, time2, time3)%60)) time23,
        convert(varchar(5),DateDiff(s, time3, time4)/3600)+':'+convert(varchar(5),DateDiff(s, time3, time4)%3600/60)+':'+convert(varchar(5),(DateDiff(s, time3, time4)%60)) time34,
        convert(varchar(5),DateDiff(s, time4, time5)/3600)+':'+convert(varchar(5),DateDiff(s, time4, time5)%3600/60)+':'+convert(varchar(5),(DateDiff(s, time4, time5)%60)) time45,
        convert(varchar(5),DateDiff(s, time5, time6)/3600)+':'+convert(varchar(5),DateDiff(s, time5, time6)%3600/60)+':'+convert(varchar(5),(DateDiff(s, time5, time6)%60)) time56,
        convert(varchar(5),DateDiff(s, time6, time7)/3600)+':'+convert(varchar(5),DateDiff(s, time6, time7)%3600/60)+':'+convert(varchar(5),(DateDiff(s, time6, time7)%60)) time67
        from
        (select trans_id,no_registration,max(tipe) tipe,max(case when tipe = '21' then waktu else null end) as mintime,
        max(waktu) maxtime,
        max(case when tipe = '21' then waktu else null end) as time1,
        max(case when tipe = '22' then waktu else null end) as time2,
        max(case when tipe = '23' then waktu else null end) as time3,
        max(case when tipe = '24' then waktu else null end) as time4,
        max(case when tipe = '25' then waktu else null end) as time5,
        max(case when tipe = '26' then waktu else null end) as time6,
        max(case when tipe = '27' then waktu else null end) as time7
        from BATCHING_BRIDGING
        where MODIFIED_DATE between ('$mulai') and DATEADD(day,1,('$akhir'))
        group by trans_id, NO_REGISTRATION) bb 
        inner join PASIEN_VISITATION pv on
        pv.trans_id = bb.TRANS_ID and pv.CLINIC_ID_FROM = 'P000'
        inner join status_pasien sp on pv.status_pasien_id = sp.status_pasien_id
        inner join clinic c on c.CLINIC_ID = pv.CLINIC_ID
        inner join employee_all ea on pv.employee_id = ea.employee_id
        where tipe like '$tipeantrol'
        and tipe like '2%'
        and visit_date between ('$mulai') and DATEADD(day,1,('$akhir'))");


        $kunjungan = $this->lowerKey($sql->getResultArray());

        // return json_encode(($kunjungan[56]['time6']) == '');

        $dt_data     = array();
        $i = 0;
        $sum12 = [];
        $sum23 = [];
        $sum34 = [];
        $sum45 = [];
        $sum56 = [];
        $sum67 = [];
        $complete = 0;
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {
                $time1 = date_create(strval($kunjungan[$key]['time1']));
                $time2 = date_create(strval($kunjungan[$key]['time2']));
                $time12 = (date_diff(($time1), $time2));
                if ($this->getTimestampInv($time12) != 0) {
                    $sum12[] = $this->getTimestampInv($time12);
                }

                $time2 = date_create(strval($kunjungan[$key]['time2']));
                $time3 = date_create(strval($kunjungan[$key]['time3']));
                $time23 = (date_diff(($time2), $time3));
                if ($this->getTimestampInv($time23) != 0) {
                    $sum23[] = $this->getTimestampInv($time23);
                }

                $time3 = date_create(strval($kunjungan[$key]['time3']));
                $time4 = date_create(strval($kunjungan[$key]['time4']));
                $time34 = (date_diff(($time3), $time4));
                if ($this->getTimestampInv($time34) != 0) {
                    $sum34[] = $this->getTimestampInv($time34);
                }

                if (($kunjungan[$key]['time5']) != '' && $kunjungan[$key]['time4'] != '') {
                    $time4 = date_create(strval($kunjungan[$key]['time4']));
                    $time5 = date_create(strval($kunjungan[$key]['time5']));
                    $time45 = (date_diff(($time4), $time5));
                    if ($this->getTimestampInv($time45) != 0) {
                        $sum45[] = $this->getTimestampInv($time45);
                        $complete++;
                    }
                }

                if (($kunjungan[$key]['time5']) != '' && $kunjungan[$key]['time6'] != '') {
                    $time5 = date_create(strval($kunjungan[$key]['time5']));
                    $time6 = date_create(strval($kunjungan[$key]['time6']));
                    $time56 = (date_diff(($time5), $time6));
                    if ($this->getTimestampInv($time56) != 0) {
                        $sum56[] = $this->getTimestampInv($time56);
                    }
                }

                if ($kunjungan[$key]['time6'] != '' && $kunjungan[$key]['time7'] != '') {
                    $time6 = date_create(strval($kunjungan[$key]['time6']));
                    $time7 = date_create(strval($kunjungan[$key]['time7']));
                    $time67 = (date_diff(($time6), $time7));
                    if ($this->getTimestampInv($time67) != 0) {
                        $sum67[] = $this->getTimestampInv($time67);
                        $complete++;
                    }
                }


                $i++;
                $row = [];
                $row[] = $i;
                $row[] = substr($kunjungan[$key]['visit_date'], 0, 16);
                $row[] = $kunjungan[$key]['mintime'];
                $row[] = $kunjungan[$key]['maxtime'];
                $row[] = $kunjungan[$key]['diantar_oleh'];
                $row[] = $kunjungan[$key]['name_of_clinic'];
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['name_of_status_pasien'];
                $row[] = $kunjungan[$key]['fullname'];
                $row[] = $kunjungan[$key]['tipe'];
                $row[] = $time12->format('%H:%I:%S') ?? '';
                $row[] = $time23->format('%H:%I:%S') ?? '';
                $row[] = $time34->format('%H:%I:%S') ?? '';
                $row[] = (($kunjungan[$key]['time5']) != '' && $kunjungan[$key]['time4'] != '') ? $time45->format('%H:%I:%S') ?? '' : '-';
                $row[] = (($kunjungan[$key]['time5']) != '' && $kunjungan[$key]['time6'] != '') ? $time56->format('%H:%I:%S') ?? '' : '-';
                $row[] = ($kunjungan[$key]['time6'] != '' && $kunjungan[$key]['time7'] != '') ? $time67->format('%H:%I:%S') ?? '' : '-';

                $dt_data[] = $row;
            }

            $avg12 = array_sum($sum12) / count($sum12);
            $avg23 = (!empty($sum23)) ? array_sum($sum23) / count($sum23) : 0;
            $avg34 = (!empty($sum34)) ? array_sum($sum34) / count($sum34) : 0;
            $avg45 = (!empty($sum45)) ? array_sum($sum45) / count($sum45) : 0;
            $avg56 = (!empty($sum56)) ? array_sum($sum56) / count($sum56) : 0;
            $avg67 = (!empty($sum67)) ? array_sum($sum67) / count($sum67) : 0;
            $sumall = [
                $avg12,
                $avg23,
                $avg34,
                $avg45,
                $avg56,
                $avg67
            ];
            $avgall = (!empty($sumall)) ? array_sum($sumall) / count($sumall) : 0;

            $totalKunj = count($kunjungan);


            // return json_encode(date('H:i:s', (int)$avg12));

            $row = [];
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '<h4>Rata-rata Waktu: </h4>';
            $row[] = "<h4>" . date('H:i:s', (int)$avg12) . "</h4>";
            $row[] = "<h4>" . date('H:i:s', (int)$avg23) . "</h4>";
            $row[] = "<h4>" . date('H:i:s', (int)$avg34) . "</h4>";
            $row[] = "<h4>" . date('H:i:s', (int)$avg45) . "</h4>";
            $row[] = "<h4>" . date('H:i:s', (int)$avg56) . "</h4>";
            $row[] = "<h4>" . date('H:i:s', (int)$avg67) . "</h4>";

            $dt_data[] = $row;

            $row = [];
            $row[] = '';
            $row[] = '<h4>Waktu Tunggu Total: </h4>';
            $row[] = "<h4>" . date('H:i:s', (int)$avgall) . "</h4>";
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $dt_data[] = $row;

            $row = [];
            $row[] = '';
            $row[] = '<h4>Jumlah Data: </h4>';
            $row[] = "<h4>" . $totalKunj . "</h4>";
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $dt_data[] = $row;

            $row = [];
            $row[] = '';
            $row[] = '<h4>Data Lengkap: </h4>';
            $row[] = "<h4>" . $complete . "</h4>";
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $dt_data[] = $row;

            $row = [];
            $row[] = '';
            $row[] = '<h4>Data Belum Lengkap: </h4>';
            $row[] = "<h4>" . ($totalKunj - $complete) . "</h4>";
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $dt_data[] = $row;

            $row = [];
            $row[] = '';
            $row[] = '<h4>Quality Rate: </h4>';
            $row[] = "<h4>" . number_format($complete / $totalKunj * 100, 2) . "%</h4>";
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th style="padding-right: 20px;">Tanggal Kunjung</th>
                        <th style="padding-right: 20px;">Waktu Datang</th>
                        <th style="padding-right: 20px;">Waktu Keluar</th>
                        <th style="padding-right: 20px;">Nama</th>
                        <th style="padding-right: 20px;">Poli</th>
                        <th style="padding-right: 20px;">No MR</th>
                        <th style="padding-right: 20px;">Status Pasien</th>
                        <th style="padding-right: 20px;">DPJP</th>
                        <th style="padding-right: 20px;">Tipe Akhir</th>
                        <th style="padding-right: 20px;">Waktu Tunggu Admisi</th>
                        <th style="padding-right: 20px;">Waktu Layan Admisi</th>
                        <th style="padding-right: 20px;">Waktu Tunggu Poli</th>
                        <th style="padding-right: 20px;">Waktu Layan Poli</th>
                        <th style="padding-right: 20px;">Waktu Tunggu Farmasi</th>
                        <th style="padding-right: 20px;">Waktu Layan Farmasi</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptrekapnota()
    {
        $giTipe = 7;
        $title = 'Rekap Nota Obat';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        $shift = $this->getShift();

        $clinic = $this->getClinic([71, 73]);
        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'shiftdays' => $shift,
            'clinic' => $clinic,
            'status' => $status
        ]);
    }
    public function aptrekapnotapost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $shift = $this->request->getPost('shift');


        // $mulaidate = date_create(strval($mulai));
        // $akhirdate = date_create(strval($mulai));

        // if ($shift == '1') {
        //     date_add($mulaidate, date_interval_create_from_date_string("8 hours"));
        //     date_add($akhirdate, date_interval_create_from_date_string("14 hours"));
        // } else if ($shift == '2') {
        //     date_add($mulaidate, date_interval_create_from_date_string("14 hours 1 seconds"));
        //     date_add($akhirdate, date_interval_create_from_date_string("20 hours"));
        // } else if ($shift == '3') {
        //     date_add($mulaidate, date_interval_create_from_date_string("20 hours 1 seconds"));
        //     date_add($akhirdate, date_interval_create_from_date_string("1 day 8 hours"));
        // }

        // $mulaistring = date_format($mulaidate, "Y-m-d H:i:s");
        // $akhirstring = date_format($akhirdate, "Y-m-d H:i:s");

        // return json_encode($akhirstring);


        $kunjungan = $this->lowerKey($model->getNotaRinci($mulai, $akhir, $status_pasien_id, $isrj, $clinic_id, $shift));



        $dt_data     = array();
        if (!empty($kunjungan)) {

            $i = 0;
            $umum = $bpjs = $kerjasama = $retur = $subsidi = $total = 0;
            foreach ($kunjungan as $key => $value) {
                $i++;
                $row = [];
                $row[] = $i;
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['thename'];
                $row[] = $kunjungan[$key]['resep_no'];
                $row[] = $kunjungan[$key]['name_of_clinic'];
                $row[] = $kunjungan[$key]['name_of_status_pasien'];
                $row[] = number_format($kunjungan[$key]['tumum'], 2);
                $umum += $kunjungan[$key]['tumum'];
                $row[] = number_format($kunjungan[$key]['tbpjs'], 2);
                $bpjs += $kunjungan[$key]['tbpjs'];
                $row[] = number_format($kunjungan[$key]['tkerjasama'], 2);
                $kerjasama += $kunjungan[$key]['tkerjasama'];
                $row[] = number_format($kunjungan[$key]['retur'], 2);
                $retur += $kunjungan[$key]['retur'];
                $row[] = number_format($kunjungan[$key]['subsidi'], 2);
                $subsidi += $kunjungan[$key]['subsidi'];
                $row[] = number_format($kunjungan[$key]['total'], 2);
                $total += $kunjungan[$key]['total'];
                $row[] = $kunjungan[$key]['shift_kerja'];
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = "<h4 style='color: red'>Total</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($umum, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($bpjs, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($kerjasama, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($retur, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($subsidi, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($total, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">No CM/MR</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">No. Resep</th>
                        <th rowspan="2">Asal Resep</th>
                        <th rowspan="2">Status Pasien</th>
                        <th colspan="3">Tagihan</th>
                        <th rowspan="2">Retur</th>
                        <th rowspan="2">Subsidi</th>
                        <th rowspan="2">Total Akhir</th>
                        <th rowspan="2">shift</th>
                    </tr>
                    <tr>
                        <th>Umum</th>
                        <th>Bpjs</th>
                        <th>Kerjasama</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptrekapobat()
    {
        $giTipe = 7;
        $title = 'Rekap Pemakaian Obat';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        // $shift = $this->getShift();

        $clinic = $this->getClinic([71, 73]);
        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            // 'shiftdays' => $shift,
            'clinic' => $clinic,
            'status' => $status
        ]);
    }
    public function aptrekapobatpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $shift = $this->request->getPost('shift');



        $kunjungan = $this->lowerKey($model->getPemakaian($mulai, $akhir, $status_pasien_id, $isrj, $clinic_id, '%'));



        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['description']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            $jmlall = $subsidiall = $totalall = 0;

            foreach ($kunjbaru as $key => $value) {
                $i++;
                $row = [];
                $jml = $subsidi = $total = 0;

                foreach ($value as $key1 => $value1) {
                    // return json_encode($kunjbaru[$key][$key1]['satuan']);
                    $jmlnya = $value[$key1]['jml'];
                    $hrgsatuan = $value[$key1]['harga_satuan'];
                    $subsidinya = $value[$key1]['subsidi'];
                    $jml += $jmlnya;
                    $subsidi += $subsidinya;
                    $total += ($jmlnya * $hrgsatuan) - $subsidinya;
                    $jmlall += $jmlnya;
                    $subsidiall += $subsidinya;
                    $totalall += ($jmlnya * $hrgsatuan) - $subsidinya;
                }

                $row[] = $key;
                $row[] = number_format($jml, 2);
                $row[] = ($kunjbaru[$key][$key1]['satuan']);
                $row[] = number_format($kunjbaru[$key][$key1]['harga_satuan'], 2);
                $row[] = number_format($subsidi, 2);
                $row[] = number_format($total, 2);
                $row[] = ($kunjbaru[$key][$key1]['shift_kerja']);
                $dt_data[] = $row;
            }
            $row = [];
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = "<h4 style='color: red'>Total</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($subsidiall, 2) . "</h4>";
            $row[] = "<h4 style='color: red'>" . number_format($totalall, 2) . "</h4>";
            $dt_data[] = $row;
        }
        $header = [];
        $header = '<tr>
                        <th rowspan="2">Nama Obat</th>
                        <th rowspan="2">Jumlah</th>
                        <th rowspan="2">Satuan</th>
                        <th rowspan="2">Harga Satuan</th>
                        <th rowspan="2">Subsidi</th>
                        <th rowspan="2">Total Akhir</th>
                        <th rowspan="2">Shift</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }

    public function aptrekappelayanan()
    {
        $giTipe = 7;
        $title = 'Rekap Pemakaian Obat';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        // $shift = $this->getShift();

        $clinic = $this->getClinic([71, 73]);
        $status = $this->getStatusPasien();
        $custom = ['Ringkas', 'Detil'];
        $customTitle = 'Laporan';


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'custom' => $custom,
            'clinic' => $clinic,
            'status' => $status,
            'customTitle' => $customTitle
        ]);
    }

    public function aptrekappelayananpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $custom = $this->request->getPost('custom');



        $kunjungan = $this->lowerKey($model->getPelayanan($mulai, $akhir, $status_pasien_id, $isrj, $clinic_id));


        $status = $this->getStatusPasien();
        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['status_pasien_id']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;

            $sumjml = 0;
            $sumterlayanires = 0;
            $sumttres = 0;
            $sumtotalres = 0;
            $sumterlayanig = 0;
            $sumttg = 0;
            $sumtotalg = 0;
            $sumterlayaning = 0;
            $sumttng = 0;
            $sumtotalng = 0;
            $sumalkes = 0;
            $sumterlayaninf = 0;
            $sumttnf = 0;
            $sumtotalnf = 0;
            $sumterlayanif = 0;
            $sumttf = 0;
            $sumtotalf = 0;
            $sumterlayaninr = 0;
            $sumttnr = 0;
            $sumtotalnr = 0;
            $sumterlayanir = 0;
            $sumttr = 0;
            $sumtotalr = 0;

            foreach ($kunjbaru as $key => $value) {
                $i++;
                $row = [];
                $terlayanires = 0;
                $ttres = 0;
                $totalres = 0;
                $terlayanig = 0;
                $ttg = 0;
                $totalg = 0;
                $terlayaning = 0;
                $ttng = 0;
                $totalng = 0;
                $alkes = 0;
                $terlayaninf = 0;
                $ttnf = 0;
                $totalnf = 0;
                $terlayanif = 0;
                $ttf = 0;
                $totalf = 0;
                $terlayaninr = 0;
                $ttnr = 0;
                $totalnr = 0;
                $terlayanir = 0;
                $ttr = 0;
                $totalr = 0;
                foreach ($value as $key1 => $value1) {
                    if ($custom == 2) {
                    }
                    $quantity = $value[$key1]['quantity'];
                    $ty = ($value[$key1]['isalkes'] != 1  && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $tt = ($value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;
                    $genty = (in_array($value[$key1]['isgeneric'], ['1', '2']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $gentt = (in_array($value[$key1]['isgeneric'], ['1', '2']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;
                    $ngty = (in_array($value[$key1]['isgeneric'], ['3', '4']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $ngtt = (in_array($value[$key1]['isgeneric'], ['3', '4']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;
                    $alk = ($value[$key1]['isalkes'] == 1) ? $value[$key1]['jml'] : 0;
                    $formty = (in_array($value[$key1]['isgeneric'], ['1', '4']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $formtt = (in_array($value[$key1]['isgeneric'], ['1', '4']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;
                    $nonty = ($value[$key1]['racikan'] != '1' && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $nontt = ($value[$key1]['racikan'] != '1' && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;
                    $racty = ($value[$key1]['racikan'] == '1' && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $ractt = ($value[$key1]['racikan'] == '1' && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;
                    $formularium_t = (in_array($value[$key1]['isgeneric'], ['2', '3']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] > 0) ? $value[$key1]['jml'] : 0;
                    $formularium_tt = (in_array($value[$key1]['isgeneric'], ['2', '3']) && $value[$key1]['isalkes'] != 1 && $value[$key1]['quantity'] == 0) ? $value[$key1]['jml'] : 0;

                    $terlayanires += $ty + $alk;
                    $ttres += $tt;
                    $totalres += $tt + $ty + $alk;
                    $terlayanig += $genty;
                    $ttg += $gentt;
                    $totalg += $gentt + $genty;
                    $terlayaning += $ngty;
                    $ttng += $ngtt;
                    $totalng += $ngty + $ngtt;
                    $alkes += $alk;
                    $terlayaninf += $formty;
                    $ttnf += $formtt;
                    $totalnf += $formty + $formtt;
                    $terlayanif += $formularium_t;
                    $ttf += $formularium_tt;
                    $totalf += $formularium_t + $formularium_tt;
                    $terlayaninr += $nonty + $alk;
                    $ttnr += $nontt + $alk;
                    $totalnr += $nonty + $nontt + $alk;
                    $terlayanir += $racty;
                    $ttr += $ractt;
                    $totalr += $racty + $ractt;

                    $sumterlayanires += $ty + $alk;
                    $sumttres += $tt;
                    $sumtotalres += $tt + $ty + $alk;
                    $sumterlayanig += $genty;
                    $sumttg += $gentt;
                    $sumtotalg += $gentt + $genty;
                    $sumterlayaning += $ngty;
                    $sumttng += $ngtt;
                    $sumtotalng += $ngty + $ngtt;
                    $sumalkes += $alk;
                    $sumterlayaninf += $formty;
                    $sumttnf += $formtt;
                    $sumtotalnf += $formty + $formtt;
                    $sumterlayanif += $formularium_t;
                    $sumttf += $formularium_tt;
                    $sumtotalf += $formularium_t + $formularium_tt;
                    $sumterlayaninr += $nonty + $alk;
                    $sumttnr += $nontt + $alk;
                    $sumtotalnr += $nonty + $nontt + $alk;
                    $sumterlayanir += $racty;
                    $sumttr += $ractt;
                    $sumtotalr += $racty + $ractt;
                }
                $namastatus = '';
                foreach ($status as $skey => $svalue) {
                    if ($key == $status[$skey]['status_pasien_id']) {
                        $namastatus = $status[$skey]['name_of_status_pasien'];
                        break;
                    }
                }
                if ($custom == 1) {
                    $row[] = $namastatus;
                    $row[] = $kunjbaru[$key][$key1]['rsp'];
                    $row[] = $terlayanires;
                    $row[] = $ttres;
                    $row[] = $totalres;
                    $row[] = $terlayanig;
                    $row[] = $ttg;
                    $row[] = $totalg;
                    $row[] = $terlayaning;
                    $row[] = $ttng;
                    $row[] = $totalng;
                    $row[] = $alkes;
                    $row[] = $terlayaninf;
                    $row[] = $ttnf;
                    $row[] = $totalnf;
                    $row[] = $terlayanif;
                    $row[] = $ttf;
                    $row[] = $totalf;
                    $row[] = $terlayaninr;
                    $row[] = $ttnr;
                    $row[] = $totalnr;
                    $row[] = $terlayanir;
                    $row[] = $ttr;
                    $row[] = $totalr;
                    $dt_data[] = $row;
                } else {
                    $row = [];
                    $row[] = $namastatus;
                    $row[] = $kunjbaru[$key][$key1]['rsp'];
                    $row[] = $totalres;
                    $row[] = $alkes;
                    $row[] = $totalg;
                    $row[] = $totalng;
                    $row[] = $totalf;
                    $row[] = $totalnf;
                    $row[] = $totalnr;
                    $row[] = $totalr;
                    $dt_data[] = $row;
                }
            }
            if ($custom == 1) {
                $row = [];
                $row[] = "<h4 style='color: red'>Total</h4>";
                $row[] = "<h4 style='color: red'>" . $kunjbaru[$key][$key1]['resepall'] . "</h4>";;
                $row[] = "<h4 style='color: red'>" . $sumterlayanires . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttres . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalres . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumterlayanig . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttg . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalg . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumterlayaning . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttng . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalng . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumalkes . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumterlayaninf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttnf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalnf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumterlayanif . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumterlayaninr . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttnr . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalnr . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumterlayanir . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumttr . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalr . "</h4>";
                $dt_data[] = $row;
            } else {
                $row = [];
                $row[] = "<h4 style='color: red'>Total</h4>";
                $row[] = "<h4 style='color: red'>" . $kunjbaru[$key][$key1]['resepall'] . "</h4>";;
                $row[] = "<h4 style='color: red'>" . $sumtotalres . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumalkes . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalg . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalng . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalnf . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalnr . "</h4>";
                $row[] = "<h4 style='color: red'>" . $sumtotalr . "</h4>";
                $dt_data[] = $row;
            }
        }
        $header = [];
        if ($custom == 1) {
            $header = '<tr>
                        <th style="padding: 20px" rowspan="2">Status Pasien</th>
                        <th style="padding: 20px" rowspan="2">Jumlah Lembar R/</th>
                        <th style="padding: 20px" rowspan="2">Total R/ Terlayani</th>
                        <th style="padding: 20px" rowspan="2">Total R/ TT</th>
                        <th style="padding: 20px" rowspan="2">Total R/</th>
                        <th style="padding: 20px" rowspan="2">Generik Terlayani</th>
                        <th style="padding: 20px" rowspan="2">Generik TT</th>
                        <th style="padding: 20px" rowspan="2">Total Generik</th>
                        <th style="padding: 20px" rowspan="2">Non Gen Terlayani</th>
                        <th style="padding: 20px" rowspan="2">Non Gen TT</th>
                        <th style="padding: 20px" rowspan="2">Total Non Gen</th>
                        <th style="padding: 20px" rowspan="2">Alkes</th>
                        <th style="padding: 20px" rowspan="2">Non Form Telrayani</th>
                        <th style="padding: 20px" rowspan="2">Non Form TT</th>
                        <th style="padding: 20px" rowspan="2">Total Non Form</th>
                        <th style="padding: 20px" rowspan="2">Form Terlayani</th>
                        <th style="padding: 20px" rowspan="2">Form TT</th>
                        <th style="padding: 20px" rowspan="2">Total Form</th>
                        <th style="padding: 20px" rowspan="2">Non Racik Terlayani</th>
                        <th style="padding: 20px" rowspan="2">Non Racik TT</th>
                        <th style="padding: 20px" rowspan="2">Total Non Racik</th>
                        <th style="padding: 20px" rowspan="2">Racikan Terlayani</th>
                        <th style="padding: 20px" rowspan="2">Racikan TT</th>
                        <th style="padding: 20px" rowspan="2">Total Racikan</th>
                    </tr>';
        } else {
            $header = '<tr>
            <th style="padding: 20px" rowspan="2">Status Pasien</th>
            <th style="padding: 20px" rowspan="2">Jumlah Lembar R/</th>
            <th style="padding: 20px" rowspan="2">Total R/</th>
            <th style="padding: 20px" rowspan="2">Alkes</th>
            <th style="padding: 20px" rowspan="2">Total Generik</th>
            <th style="padding: 20px" rowspan="2">Total Non Gen</th>
            <th style="padding: 20px" rowspan="2">Total Form</th>
            <th style="padding: 20px" rowspan="2">Total Non Form</th>
            <th style="padding: 20px" rowspan="2">Total Non Racik</th>
            <th style="padding: 20px" rowspan="2">Total Racikan</th>';
        }
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }

    public function aptobatalkes()
    {
        $giTipe = 7;
        $title = 'Rekap Pemakaian Obat';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        // $shift = $this->getShift();

        $clinic = $this->getClinic([71, 73]);
        $status = $this->getStatusPasien();


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'itemName' => '1',
            'clinic' => $clinic,
            'status' => $status
        ]);
    }
    public function aptobatalkespost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $namaobat = $this->request->getPost('nama_obat');

        if ($namaobat == '') {
            $namaobat = '%';
        }



        $kunjungan = $this->lowerKey($model->getObatAlkes($mulai, $akhir, $clinic_id, $namaobat, '%', $isrj));

        // return json_encode($kunjungan);

        $dt_data     = array();
        if (!empty($kunjungan)) {

            // $kunjbaru = [];
            // foreach ($kunjungan as $key => $value) {
            //     $kunjbaru[$kunjungan[$key]['description']][$key] = $kunjungan[$key];
            // }
            // ksort($kunjbaru);

            $i = 0;
            // $jmlall = $subsidiall = $totalall = 0;

            foreach ($kunjungan as $key => $value) {
                $i++;
                $row = [];

                $row[] = $kunjungan[$key]['tgl'];
                $row[] = ($kunjungan[$key]['brand_id']);
                $row[] = ($kunjungan[$key]['description']);
                $row[] = number_format($kunjungan[$key]['jml'], 2);
                $row[] = ($kunjungan[$key]['measurement']);
                $row[] = '<button type="button" onclick="rinciObatAlkes(\'' . $i . '\',\'' . $kunjungan[$key]['description'] . '\',\'' . $kunjungan[$key]['tgl'] . '\')" id="rinci' . $i . '" name="rincian" value="' . $kunjungan[$key]['brand_id'] . '" class="btn btn-primary btn-sm pull-right" autocomplete="off"><i class="fa fa-search"></i> Rincian</button>';
                $dt_data[] = $row;
            }
        }
        $header = [];
        $header = '<tr>
                        <th style="padding: 20px" rowspan="2">Tanggal</th>
                        <th style="padding: 20px" rowspan="2">Kode</th>
                        <th style="padding: 20px" rowspan="2">Nama Obat/Alkes</th>
                        <th style="padding: 20px" rowspan="2">Jumlah</th>
                        <th style="padding: 20px" rowspan="2">Satuan</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptobatalkesrincipost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $namaobat = $body['description'];
        $tgl = $body['tgl'];
        $clinic = $body['clinic'];
        $rj = $body['isrj'];

        // return json_encode($body);


        if ($namaobat == '') {
            $namaobat = '%';
        }



        $kunjungan = $this->lowerKey($model->getObatAlkesRinci($namaobat, $tgl, $clinic, $rj));

        // return json_encode($kunjungan);

        $dt_data     = array();
        if (!empty($kunjungan)) {

            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['no_cm']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;

            foreach ($kunjbaru as $key => $value) {

                $jml = 0;
                $retur = 0;
                foreach ($value as $key1 => $value1) {
                    $jml += $value1['jml'];
                    $retur += $value1['retur'];
                }



                $i++;
                $row = [];
                $row[] = $i;
                $row[] = $value[$key1]['nama'];
                $row[] = $value[$key1]['no_cm'];
                $row[] = number_format($jml, 2);
                $row[] = number_format($retur, 2);
                $row[] = $value[$key1]['dokter'];
                $row[] = $value[$key1]['nama_klinik'];
                $dt_data[] = $row;
            }
        }
        $header = [];
        $header = '<tr>
                        <th style="padding: 20px" rowspan="2">No</th>
                        <th style="padding: 20px" rowspan="2">Nama Pasien</th>
                        <th style="padding: 20px" rowspan="2">No CM</th>
                        <th style="padding: 20px" rowspan="2">Jumlah</th>
                        <th style="padding: 20px" rowspan="2">Retur</th>
                        <th style="padding: 20px" rowspan="2">Dokter</th>
                        <th style="padding: 20px" rowspan="2">Klinik</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptpsikotropika()
    {
        $giTipe = 7;
        $title = 'LAPORAN REKAP PENGGUNAAN PSIKOTROPIKA';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        // $shift = $this->getShift();

        $clinic = $this->getClinic([71, 73]);
        $status = $this->getStatusPasien();

        $regulation = $this->getRegulation();


        $custom = ['Laporan Rekap Obat', 'Laporan Rekap Dokter', 'Laporan Detil'];
        $customTitle = 'Laporan';




        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj, //
            'itemName' => '1', //
            'clinic' => $clinic, //
            'status' => $status, //
            'regulation' => $regulation,
            'custom' => $custom,
            'customTitle' => $customTitle,
            'dokterfill' => '1'
        ]);
    }
    public function aptpsikotropikapost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $poli = $this->request->getPost('clinic_id');
        $barang = $this->request->getPost('nama_obat');
        $dokter = $this->request->getPost('dokter');
        $generik = $this->request->getPost('regulation');
        $custom = $this->request->getPost('custom');

        if ($barang == '') {
            $barang = '%';
        }
        if ($dokter == '') {
            $dokter = '%';
        }

        if ($custom == 0) {
            $kunjungan = $this->lowerKey($model->getPsikotropikaObat($barang, $mulai, $akhir, $generik, $isrj, '%', $poli, $dokter));
        } else if ($custom == 1) {
            $kunjungan = $this->lowerKey($model->getPsikotropikaDokter($barang, $mulai, $akhir, $generik, $isrj, '%', $poli, $dokter, '%'));
            $regulation = $this->getRegulation();
        } else if ($custom == 2) {
            $kunjungan = $this->lowerKey($model->getPsikotropika($barang, $mulai, $akhir, $generik, $isrj, '%', $poli, $dokter, '%'));
            $regulation = $this->getRegulation();
        }


        // return json_encode($kunjungan);

        $dt_data     = array();
        if (!empty($kunjungan)) {
            $satuan = $this->getMeasurement();
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                if ($custom == 0)
                    $kunjbaru[$kunjungan[$key]['namaobat']][$key] = $kunjungan[$key];
                else if ($custom == 1 || $custom == 2)
                    $kunjbaru[$kunjungan[$key]['regulate_id']][$kunjungan[$key]['brand_id']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            // $jmlall = $subsidiall = $totalall = 0;

            foreach ($kunjbaru as $key => $value) {
                if ($custom == 0) {
                    foreach ($value as $key1 => $value1) {
                        $row = [];
                        $i++;

                        $row[] = $i;
                        $row[] = ($value1['namaobat']);
                        $row[] = number_format($value[$key1]['jml'], 2);
                        foreach ($satuan as $mkey => $mvalue) {
                            if ($satuan[$mkey]['measure_id'] == $value[$key1]['measure_id'])
                                $row[] = $satuan[$mkey]['measurement'];
                        }
                        // $row[] = ($value[$key1]['measure_id']);
                        $dt_data[] = $row;
                    }
                } else if ($custom == 1 || $custom == 2) {
                    $total = 0;

                    foreach ($value as $key1 => $value1) {
                        ksort($value);
                        $row = [];
                        $row[] = '';
                        $row = [];
                        foreach ($regulation as $rkey => $rvalue) {
                            if ($regulation[$rkey]['regulate_id'] == $key)
                                $row[] = "<h4 style='color: red;'>" . $regulation[$rkey]['regulation_type'] . "</h4>";
                        }
                        if ($custom == 2) {
                            foreach ($value1 as $key2 => $value2) {
                                $row[] = "<h4 style='color: red;'>" . strtoupper($value2['description']) . "</h4>";;
                                break;
                            }
                        }
                        $dt_data[] = $row;
                        $total = 0;
                        foreach ($value1 as $key2 => $value2) {
                            $row = [];
                            $i++;
                            // return json_encode($value2);
                            $row[] = $value2['thename'];
                            $row[] = $value2['theaddres'];
                            $row[] = substr($value2['tanggal'], 0, 10);
                            $row[] = number_format($value2['jml'], 2);
                            $row[] = ($value2['doctor']);
                            $row[] = $value2['myaddress'] ?? 'RSUD M Yunus Bengkulu';
                            $total += $value2['jml'];
                            // return json_encode($satuan[1]['measure_id']);
                            // foreach ($satuan as $mkey => $mvalue) {
                            //     if ($satuan[$mkey]['measure_id'] == $value2['measure_id']) {
                            //         $row[] = $satuan[$mkey]['measurement'];
                            //         break;
                            //     }
                            // }
                            $dt_data[] = $row;
                        }
                        $row = [];
                        $row[] = '';
                        $row[] = "<h5 style='color: blue;'>Total</h5>";
                        $row[] = '';
                        $row[] = number_format($total, 2);


                        // foreach ($satuan as $mkey => $mvalue) {
                        //     if ($satuan[$mkey]['measure_id'] == $value2['measure_id']) {
                        //         $row[] = $satuan[$mkey]['measurement'];
                        //         break;
                        //     }
                        // }
                        $dt_data[] = $row;
                    }
                }
            }
        }

        if ($custom == 1) {
            $header = [];
            $header = '<tr>
                        <th style="padding: 20px">No</th>
                        <th style="padding: 20px">Tgl Pelayanan</th>
                        <th style="padding: 20px">Nama Obat</th>
                        <th style="padding: 20px">Dokter</th>
                        <th colspan="2" style="padding: 20px">Jumlah Obat</th>
                    </tr>';
        } else if ($custom == 0) {

            $header = [];
            $header = '<tr>
                        <th style="padding: 20px">No</th>
                        <th style="padding: 20px">Nama Obat/Alkes</th>
                        <th style="padding: 20px">Jumlah</th>
                        <th style="padding: 20px">Satuan</th>
                    </tr>';
        } else if ($custom == 2) {

            $header = [];
            $header = '<tr>
                        <th style="padding: 20px">Nama Pasien</th>
                        <th style="padding: 20px">Alamat Pasien</th>
                        <th style="padding: 20px">Tgl Diberikan</th>
                        <th style="padding: 20px">Jumlah</th>
                        <th style="padding: 20px">Nama Dokter</th>
                        <th style="padding: 20px">Alamat Dokter</th>
                    </tr>';
        }
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptrekappsikotropika()
    {
        $giTipe = 7;
        $title = 'LAPORAN REKAP PENGGUNAAN';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        // $shift = $this->getShift();

        $clinic = $this->getClinic([70, 73]);
        // $status = $this->getStatusPasien();

        $regulation = $this->getRegulation();


        // $custom = ['Laporan Rekap Obat', 'Laporan Rekap Dokter', 'Laporan Detil'];
        // $customTitle = 'Laporan';




        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            // 'isrj' => $isrj, //
            'itemName' => '1', //
            'clinic' => $clinic, //
            // 'status' => $status, //
            'regulation' => $regulation,
            // 'custom' => $custom,
            // 'customTitle' => $customTitle,
            // 'dokterfill' => '1'
        ]);
    }
    public function aptrekappsikotropikapost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $isrj = $this->request->getPost('isrj');
        $clinic_id = $this->request->getPost('clinic_id');
        $namaobat = $this->request->getPost('nama_obat');
        $uu = $this->request->getPost('regulation');

        if ($namaobat == '') {
            $namaobat = '%';
        }



        $kunjungan = $this->lowerKey($model->getRekapPsikotropika($namaobat, $mulai, $akhir, $clinic_id, $uu));

        // return json_encode($kunjungan);

        $dt_data     = array();
        if (!empty($kunjungan)) {
            $regulation = $this->getRegulation();
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['regulate_id']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            // $jmlall = $subsidiall = $totalall = 0;

            foreach ($kunjbaru as $key => $value) {
                $row = [];
                $row[] = '';
                foreach ($regulation as $rkey => $rvalue) {
                    if ($regulation[$rkey]['regulate_id'] == $key) {
                        $row[] = "<h4 style='color: red'>" . $rvalue['regulation_type'] . "</h4>";
                        break;
                    }
                }
                $dt_data[] = $row;

                foreach ($value as $key1 => $value1) {
                    $i++;
                    $row = [];
                    $row[] = $i;
                    $row[] = $value1['brand_name'];
                    $row[] = $value1['measure_id'];
                    $stockawal = $value1['stock_awal'] ?? 0;
                    $row[] = $stockawal;
                    $terima = $value1['penerimaan'];
                    $row[] = number_format($terima, 2) ?? 0;
                    $pemakaian = ($value1['dijual'] ?? 0) + ($value1['dihapus'] ?? 0) + ($value1['distribusi'] ?? 0);
                    $row[] = number_format($pemakaian, 2);
                    $retur = $value1['retur'] ?? 0;
                    $row[] = number_format($retur, 2);
                    $persediaan = $stockawal + $terima;
                    $sisa = $persediaan - ($pemakaian + $retur);
                    $row[] = number_format($sisa, 2);
                    $total_nilai = $value1['harga'] ?? 0;
                    $row[] = number_format($total_nilai, 2);
                    $diminta = $value1['diminta'];
                    $row[] = number_format($diminta, 2);
                    $row[] = number_format($value1['harga'], 2);
                    $row[] = number_format($persediaan, 2);
                    $dt_data[] = $row;
                }
            }
        }
        $header = [];
        $header = '<tr>
                        <th style="padding-right: 20px" rowspan="2">No</th>
                        <th style="padding-right: 20px" rowspan="2">Nama Obat</th>
                        <th style="padding-right: 20px" rowspan="2">Satuan</th>
                        <th style="padding-right: 20px" rowspan="2">Stock Awal</th>
                        <th style="padding-right: 20px" rowspan="2">Jumlah Pemasukan</th>
                        <th style="padding-right: 20px" rowspan="2">Jumlah Pengeluaran</th>
                        <th style="padding-right: 20px" rowspan="2">Retur</th>
                        <th style="padding-right: 20px" colspan="2">Sisa Stock</th>
                        <th style="padding-right: 20px" rowspan="2">Permintaan</th>
                        <th style="padding-right: 20px" rowspan="2">Harga Netto</th>
                        <th style="padding-right: 20px" rowspan="2">Persediaan</th>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <th>Nilai</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptpembelian()
    {
        $giTipe = 7;
        $title = 'LAPORAN REKAP PENGGUNAAN';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];

        // $shift = $this->getShift();

        $clinic = $this->getClinic([70, 73]);
        // $status = $this->getStatusPasien();

        $regulation = $this->getRegulation();


        // $custom = ['Laporan Rekap Obat', 'Laporan Rekap Dokter', 'Laporan Detil'];
        // $customTitle = 'Laporan';




        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            // 'isrj' => $isrj, //
            'itemName' => '1', //
            'clinic' => $clinic, //
            // 'status' => $status, //
            'regulation' => $regulation,
            // 'custom' => $custom,
            // 'customTitle' => $customTitle,
            // 'dokterfill' => '1'
        ]);
    }
    public function aptkartubarang()
    {
        $giTipe = 7;
        $title = 'Kartu Stock Barang Perpetual Berbasis BAPB';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $currentYear = date("Y");
        for ($i = 0; $i <= 5; $i++) {
            $tahun[$currentYear - $i] = $currentYear - $i;
        }


        // $shift = $this->getShift();

        $clinic = $this->getClinic([1, 2, 3, 5, 70, 71, 73, 75, 76, 54]);
        // $status = $this->getStatusPasien();

        $regulation = $this->getRegulation();


        // $custom = ['Laporan Rekap Obat', 'Laporan Rekap Dokter', 'Laporan Detil'];
        $customTitle = 'Periode';




        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'mulai' => '0',
            'akhir' => '0',
            // 'isrj' => $isrj, //
            'itemId' => '1', //
            'clinic' => $clinic, //
            // 'status' => $status, //
            // 'regulation' => $regulation,
            'custom' => $bulan,
            'customTitle' => $customTitle,
            'custom1' => $tahun,
            'customTitle1' => 'Tahun',
            'mulai' => '0',
            'akhir' => '0'
            // 'dokterfill' => '1'
        ]);
    }
    public function aptkartubarangpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $brand = $this->request->getPost('brand_id');
        $bulan = $this->request->getPost('custom');
        $bulan++;
        $tahun = $this->request->getPost('custom1');




        $kunjungan = $this->lowerKey($model->getKartuBarang($brand, $clinic_id, '%', $bulan, $bulan, $tahun));

        // return json_encode($kunjungan);

        $dt_data     = array();
        if (!empty($kunjungan)) {
            $clinic = $this->getClinic([1, 2, 3, 5, 70, 71, 73, 75, 76, 54]);
            $company = $this->getCompany();
            $dist = $this->getDistribution();
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['brand_id']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            // $jmlall = $subsidiall = $totalall = 0;

            foreach ($kunjbaru as $key => $value) {
                $so = 0;
                $beforesocum = 0;
                $aftersocum = 0;
                $sisacum = 0;
                $sisa = 0;

                foreach ($value as $key1 => $value1) {
                    $so1 = $value1['stokopname'];
                    if ($so1 > $so) {
                        $so = $so1;
                    }
                }
                foreach ($value as $key1 => $value1) {
                    // return json_encode($value1);
                    $allocatedDate = date_create(strval($value1['allocated_date']));
                    $soDate = date_create(strval($value1['stockopnamedate']));
                    // if( distribution_type= 104,awal , if(distribution_type=100, stokopname ,0))
                    $awalan = ($value1['distribution_type'] == 104) ? $value1['awal'] : (($value1['distribution_type'] == 100) ? $value1['stokopname'] : 0);
                    // if(allocated_date <  stockopnamedate , (awalan +( terimabapb + terima + terimaret + terima_trx )  - (keluar_dist + keluarretur+ keluartrx  ) +  if(distribution_type = 101,  (   (-1* dikoreksi ) +koreksimutasiinout),0)),0)
                    $beforeso = ($allocatedDate < $soDate) ? ($awalan + ($value1['terima_bapb'] + $value1['terima'] + $value1['terimatrx']) - ($value1['keluar_dist'] + $value1['keluarretur'] + $value1['keluartrx']) + ($value1['distribution_type'] == 101) ? ((-1 * $value1['dikoreksi']) + $value1['koreksimutasiinout']) : 0) : 0;
                    $beforesocum += $beforeso;
                    // if(allocated_date >= stockopnamedate, (awalan +( terimabapb + terima + terimaret + terima_trx )  - (keluar_dist + keluarretur+ keluartrx  ) +  if(distribution_type = 101,  (   (-1* dikoreksi ) +koreksimutasiinout),0)),0)
                    $afterso = ($allocatedDate >= $soDate) ? ($awalan + ($value1['terimabapb'] + $value1['terima'] + $value1['terimatrx']) - ($value1['keluar_dist'] + $value1['keluarretur'] + $value1['keluartrx']) + ($value1['distribution_type'] == 101) ? ((-1 * $value1['dikoreksi']) + $value1['koreksimutasiinout']) : 0) : 0;
                    $aftersocum += $afterso;
                    $sisa = (($value1['distribution_type'] == 100 && !is_null($value1['stokopname'])) ? $value1['stokopname'] : ((is_null($so)) ? $sisacum : (($allocatedDate < $soDate) ? $beforeso : $afterso)));
                    $sisacum += $sisa;
                }



                foreach ($value as $key1 => $value1) {
                    // return json_encode($value1);
                    $i++;
                    $row = [];
                    $row[] = substr($value1['allocated_date'], 2);
                    $jenis = ($value1['distribution_type'] == 101 && $value['dikoreksi'] > 0) ?
                        ('Semula : ' . $value1['dikoreksi'] . " Mutasi In/Out: " . $value1["koreksimutasiinout"]) : (($value1['distribution_type'] == 100 && $value['dikoreksi'] > 0) ?
                            ('Selisih :' . $value1['dikoreksi'] . " ket: " . $value1['koreksi'])
                            : (($value1['distribution_type'] == 104 && $value1['dikoreksi'] > 0) ?
                                "Selisih : " . $value1['dikoreksi'] . " Ket: " . $value1['koreksi']
                                : ''));
                    // if( distribution_type =101 and dikoreksi>0,koreksi + ' Semula : '+ string(dikoreksi,'#,##0;[RED](#,##0)') + ' Mutasi In/Out: '+  string(koreksimutasiinout,'#,##0;[RED](#,##0)' ),if(distribution_type=100 and dikoreksi>0,'Selisih :'+  string(dikoreksi,'#,##0;[RED](#,##0)') + ' ket: '+  koreksi ,if(distribution_type=104 and dikoreksi>0,'Selisih :'+  string(dikoreksi,'#,##0;[RED](#,##0)') + ' ket: '+  koreksi,'')) )
                    $row[] = "<p>" . $value1['doc_no'] . "</p>" . "<p>" . $jenis . "</p>" . "<p>" . $value1['pbf'] . "</p>";
                    $persediaan = ($value1['distribution_type'] == 104) ? $value1['awal'] : (($value1['distribution_type'] == 100) ? ($value1['stokopname'] ?? 0) : 0);
                    // if( distribution_type= 104,awal , if(distribution_type=100, stokopname ,0))
                    $row[] = $persediaan;
                    $masuk = abs($value1['terimabapb'] + $value1['terimaret'] + $value1['terimatrx'] + ($value1['distribution_type'] == 101) ? ($value1['koreksimutasiinout']) : 0);
                    // abs(terimabapb +terima + terimaret + terima_trx + if(distribution_type = 101, koreksimutasiinout,0) ) 
                    $row[] = $masuk;
                    // abs( keluar_dist + keluarretur + keluartrx + if ( distribution_type =101, (dikoreksi ),0) )
                    $keluar = abs($value1['keluar_dist'] + $value1['keluarretur'] + $value1['keluartrx'] + ($value1['distribution_type'] == 101) ? $value1['dikoreksi'] : 0);
                    $row[] = $keluar;
                    //  if(distribution_type =100 and (not isnull( stokopname )), stokopname , if(isnull(so),cumulativeSum( sisa for group 1 ),if(allocated_date < stockopnamedate,cumulativeSum(beforeso for group 1 ),cumulativeSum(afterso for group 1 ) ) ))
                    $allocatedDate = date_create(strval($value1['allocated_date']));
                    $soDate = date_create(strval($value1['stockopnamedate']));
                    $sisa = ($value1['distribution_type'] == 100 && !is_null($value1['stokopname'])) ? $value1['stokopname'] : ((is_null($so)) ? $sisacum : (($allocatedDate < $soDate) ? $beforesocum : $aftersocum));
                    $row[] = $sisa;
                    foreach ($dist as  $dkey => $dvalue) {
                        if ($dist[$dkey]['distribution_type'] == ($value1['distribution_type'])) {
                            $row[] = $dist[$dkey]['distributiontype'];
                            break;
                        }
                    }
                    $dartuj = '';
                    $pbf = '';
                    $tujuan = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value1['tujuan']) {
                            $tujuan = $cvalue['name_of_clinic'];
                        }
                    }
                    foreach ($company as $comkey => $comvalue) {
                        if ($comvalue['company_id'] == $value1['pbf']) {
                            $pbf = $comvalue['company_name'];
                        }
                    }
                    $row[] = "<p>" . $pbf . "</p>" . "<p>" . $tujuan . "</p>";
                    $dt_data[] = $row;
                }
            }
        }
        $header = [];
        $header = '<tr>
                        <th style="padding-right: 20px" rowspan="2">Tanggal</th>
                        <th style="padding-right: 20px" rowspan="2">No.Dokumen/No.Resep</th>
                        <th style="padding-right: 20px" rowspan="2">Persediaan Awal</th>
                        <th style="padding-right: 20px" colspan="3">Banyaknya</th>
                        <th style="padding-right: 20px" rowspan="2">Jenis Distribusi</th>
                        <th style="padding-right: 20px" rowspan="2">Dari / Untuk</th>
                    </tr>
                    <tr>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Sisa</th>
                    </tr>';
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function aptpersediaan()
    {
        $giTipe = 7;
        $title = 'Laporan Persediaan Barang Perpetual Berbasis BAPB';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['apt'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $isrj = ['0', '1'];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $currentYear = date("Y");
        for ($i = 0; $i <= 5; $i++) {
            $tahun[$currentYear - $i] = $currentYear - $i;
        }


        // $shift = $this->getShift();

        $clinic = $this->getClinic([1, 2, 3, 5, 70, 71, 73, 75, 76, 54]);
        // $status = $this->getStatusPasien();

        $regulation = $this->getRegulation();


        // $custom = ['Laporan Rekap Obat', 'Laporan Rekap Dokter', 'Laporan Detil'];
        $customTitle = 'Periode';

        $custom2 = ['Tampilkan', 'Tidak'];
        $custom3 = ['detil', "ringkas"];
        $custom4 = [
            "%" => "Semua",
            "0" => "Obat Umum",
            "1" => "Obat BPJS"
        ];




        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'mulai' => '0',
            'akhir' => '0',
            // 'isrj' => $isrj, //
            'clinic' => $clinic, //
            // 'status' => $status, //
            'itemName' => '1',
            'custom' => $bulan,
            'customTitle' => $customTitle,
            'custom1' => $tahun,
            'customTitle1' => 'Tahun',
            'custom2' => $custom2,
            'customTitle2' => 'Tampilkan Stock 0',
            'custom3' => $custom3,
            'customTitle3' => 'Form Detil',
            'custom4' => $custom4,
            'customTitle4' => 'Kategori Obat'
        ]);
    }
    public function aptpersediaanpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = date_add(date_create(), date_interval_create_from_date_string("-3650 days"))->format("Y-m-d");
        $akhir = date_add(date_create(), date_interval_create_from_date_string("0 days"))->format("Y-m-d");
        $clinic_id = $this->request->getPost('clinic_id');
        $namaobat = $this->request->getPost('nama_obat');
        $bulan = $this->request->getPost('custom');
        $tahun = $this->request->getPost('custom1');
        $filter = $this->request->getPost('custom2');
        $isRingkas = $this->request->getPost('custom3');
        $kategori = $this->request->getPost('custom4');


        if ($namaobat == '') {
            $namaobat = '%';
        }



        $kunjungan = $this->lowerKey($model->getPersediaan($namaobat, $clinic_id, '%', $bulan, $tahun, '%', $kategori, $mulai, $akhir));

        // return json_encode($kunjungan);

        $dt_data     = array();
        if (!empty($kunjungan)) {
            $measurement = $this->getMeasurement();
            $company = $this->getCompany();
            $kunjbaru = [];
            foreach ($kunjungan as $key => $value) {
                $kunjbaru[$kunjungan[$key]['brand_id']][$key] = $kunjungan[$key];
            }
            ksort($kunjbaru);

            $i = 0;
            $totalall = 0;

            $row = [];
            $row[] = '(1)';
            $row[] = '(2)';
            $row[] = '(3)';
            $row[] = '(4)';
            $row[] = '(5)';
            $row[] = '(6)';
            if ($isRingkas == '0') {
                $row[] = '(7)';
                $row[] = '(8)';
                $row[] = '(9 = 6 + 7 - 8)';
                $row[] = '(10)';
                $row[] = '(11)';
                $row[] = '(12)';
                $row[] = '(13 = 11 x 12)';
                $row[] = '(14)';
            }
            $dt_data[] = $row;

            foreach ($kunjbaru as $key => $value) {
                // $row = [];
                // $row[] = '';
                // foreach ($regulation as $rkey => $rvalue) {
                //     if ($regulation[$rkey]['regulate_id'] == $key) {
                //         $row[] = "<h4 style='color: red'>" . $rvalue['regulation_type'] . "</h4>";
                //         break;
                //     }
                // }
                // $dt_data[] = $row;

                foreach ($value as $key1 => $value1) {
                    $i++;
                    $row = [];

                    $awal = $value1['awal'];

                    // if( ROOM ='%', bapb  ,bapb+masuk+ masukretint+masukrettrx  )
                    $masuk = ($clinic_id == '%') ? ($value1['bapb']) : (($value1['bapb'] + $value1['masuk'] + $value1['masukretint'] + $value1['masukrettrx']));

                    // if(room='%',keluar- masukrettrx ,(keluar_dist + keluar + keluarretur ) )
                    $keluar = ($clinic_id == '%') ? ($value1['keluar'] - $value1['masukrettrx']) : (($value1['keluar_dist'] + $value1['keluar'] + $value1['keluarretur']));

                    // if(ROOM='%', (awal + bapb), (awal +bapb+masuk+ masukretint + masukrettrx)) - (if(room='%', keluar -  masukrettrx ,(keluar +keluarretur+ keluar_dist ) ))
                    $sisa = ($clinic_id == '%') ? $awal + $value1['bapb'] : $awal + $masuk - $keluar;

                    // if( isnull(afterso),0, afterso 
                    $koreksi = $value1['afterso'] ?? 0;

                    // if( isnull(stokopname), if(ROOM='%', (awal + bapb), (awal +bapb+masuk+ masukretint + masukrettrx)) - (if(room='%', keluar- masukRetTrx,(keluar +keluarretur+ keluar_dist- afterso))), stokopname + if(isnull(afterso),0,afterso) )
                    $stock = (is_null($value1['stokopname'])) ? $masuk - $keluar + (($clinic_id == '%') ? 0 : $koreksi) : $value1['stokopname'] + $koreksi;

                    $totalall += $value1['harga'] * $stock;



                    if ($isRingkas == '0') {
                        $row[] = $i;
                        $row[] = $value1['name'];
                        $row[] = $value1['brand_id'];
                        foreach ($measurement as $mkey => $mvalue) {
                            if ($measurement[$mkey]['measure_id'] == $value1['measure_id']) {
                                $row[] = $mvalue['measurement'];
                                break;
                            }
                        }
                        foreach ($company as $ckey => $cvalue) {
                            if ($cvalue['company_id'] == $value1['company_id']) {
                                $row[] = $cvalue['company_name'];
                                break;
                            }
                        }
                        $row[] = number_format($awal, 2) ?? 0;;
                        $row[] = number_format($masuk, 2);
                        $row[] = number_format($keluar, 2);
                        $row[] = number_format($sisa, 2);
                        $row[] = number_format($koreksi, 2);
                        $row[] = $stock;
                        $row[] = number_format($value1['harga'], 2) ?? 0;
                        $row[] = number_format($value1['harga'] * $stock, 2) ?? 0;
                        $row[] = substr($value1['expiry_date'], 0, 10);
                    } else {
                        $row[] = $i;
                        $row[] = $value1['name'];
                        $row[] = $value1['brand_id'];
                        $row[] = number_format($value1['harga'], 2) ?? 0;
                        $row[] = substr($value1['expiry_date'], 0, 10);
                        $row[] = number_format($value1['harga'] * $stock, 2) ?? 0;
                    }
                    $dt_data[] = $row;
                }
            }
            if ($isRingkas == '0') {
                $row = [];
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = 'Total:';
                $row[] = number_format($totalall, 2);
                $dt_data[] = $row;
            }
        }
        $header = [];
        if ($isRingkas == '0') {
            $header = '<tr>
                        <th style="padding-right: 20px" rowspan="2">No</th>
                        <th style="padding-right: 20px" rowspan="2">Jenis Barang / Uraian</th>
                        <th style="padding-right: 20px" rowspan="2">Kode</th>
                        <th style="padding-right: 20px" rowspan="2">Satuan</th>
                        <th style="padding-right: 20px" rowspan="2">Supplier</th>
                        <th style="padding-right: 20px" rowspan="2">Persediaan Awal</th>
                        <th style="padding-right: 20px" colspan="5">Barang-barang</th>
                        <th style="padding-right: 20px" rowspan="2">Harga Satuan</th>
                        <th style="padding-right: 20px" rowspan="2">Jumlah Nilai Persediaan</th>
                        <th style="padding-right: 20px" rowspan="2">Tanggal Kadaluarsa</th>
                    </tr>
                    <tr>
                        <th style="padding-right: 20px">Masuk</th>
                        <th style="padding-right: 20px">Keluar</th>
                        <th style="padding-right: 20px">Sisa</th>
                        <th style="padding-right: 20px">Koreksi</th>
                        <th style="padding-right: 20px">Stock</th>
                    </tr>';
        } else {
            $header = '<tr>
                        <th style="padding-right: 20px">No</th>
                        <th style="padding-right: 20px">Uraian / Jenis Barang</th>
                        <th style="padding-right: 20px">Kode</th>
                        <th style="padding-right: 20px">Harga</th>
                        <th style="padding-right: 20px">Tanggal Kadaluarsa</th>
                        <th style="padding-right: 20px">Stok</th>
                    </tr>';
        }
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
    public function adminlog()
    {
        $giTipe = 7;
        $title = 'Log Pasien';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['admin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();

        $custom = ['Log Pasien', 'Log Kunjungan', 'Log Tindakan', 'Log Obat', 'Log Diagnosis', 'Log Ekspertise', 'Log Akomodasi', 'Login User'];





        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'customtext' => 1,
            'customtextTitle' => 'No RM Pasien',
            'customtext1' => 1,
            'customtext1Title' => 'User Login',
            'customtext2' => 1,
            'customtext2Title' => 'Tarif/Obat',
            'custom' => $custom,
            'customTitle' => 'Laporan'

        ]);
    }

    public function adminlogpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model = new TreatmentObatModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $laporan = $this->request->getPost('custom');
        $norm = $this->request->getPost('customtext');
        $user = $this->request->getPost('customtext1');
        $filter = $this->request->getPost('customtext2');


        if ($norm == '') {
            $norm = '%';
        } else {
            $norm = '%' . $norm . '%';
        }
        if ($user == '') {
            $user = '%';
        } else {
            $user = '%' . $user . '%';
        }
        // $user = '%' . $user . '%';
        if ($filter == '') {
            $filter = '%';
        } else {
            $filter = '%' . $filter . '%';
        }
        // return $laporan;
        $db = db_connect('logdb');
        if ($laporan == '0') {
            $builder = $db->table('log_pasien');
            $builder = $builder->select('top(100) log_user,
        log_time,
        log_computer,
        NO_REGISTRATION,
        NAME_OF_PASIEN,
        CONTACT_ADDRESS,
        DATE_OF_BIRTH,
        GENDER,
        kk_no,
        pasien_id')->where("log_time >= dateadd(hour,0,'$mulai') and log_time < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("log_user like '$user'");

            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '1') {
            $builder = $db->table('log_pasien_visitation');
            $builder = $builder->select('top(100) log_user,
        log_time,
        log_computer,
        NO_REGISTRATION,
        diantar_oleh,
        clinic_id,
        employee_id,
        visit_date,
        status_pasien_id,
        pasien_id')->where("visit_date >= dateadd(hour,0,'$mulai') and visit_date < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("log_user like '$user'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '2') {
            $builder = $db->table('LOG_treatment_bill');
            $builder = $builder->select('top(100) log_user,
            log_time,
            log_computer,
            NO_REGISTRATION,
            thename,
            clinic_id,
            employee_id,
            treat_date,
            status_pasien_id,
            theid,
                treatment,
                tarif_id,
                quantity,
                tagihan')->where("treat_date >= dateadd(hour,0,'$mulai') and treat_date < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("no_registration like '$user'")
                ->where("treatment like '$filter'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '3') {
            $builder = $db->table('LOG_treatment_obat');
            $builder = $builder->select('top(100) log_user,
            log_time,
            log_computer,
            NO_REGISTRATION,
            thename,
            clinic_id,
            employee_id,
            treat_date,
            status_pasien_id,
                resep_no as theid,
            description as treatment,
            tarif_id,
            quantity,
            tagihan')->where("treat_date >= dateadd(hour,0,'$mulai') and treat_date < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("no_registration like '$user'")
                ->where("treatment like '$filter'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '4') {
            $builder = $db->table('LOG_pasien_diagnosa');
            $builder = $builder->select('top(100)  log_user,
            log_time,
            log_computer,
            NO_REGISTRATION,
            thename,
            clinic_id,
            employee_id,
            date_of_diagnosa treat_date,
            status_pasien_id,
                theid,
            diagnosa_desc ,
            diagnosa_id ,
            anamnase,
            pemeriksaan,
            description')->where("date_of_diagnosa >= dateadd(hour,0,'$mulai') and date_of_diagnosa < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("no_registration like '$user'")
                ->where("isnull(diagnosa_desc,'') like '$filter'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '5') {
            $builder = $db->table('LOG_treat_results');
            $builder = $builder->select('top(100) log_user,
            log_time,
            log_computer,
            NO_REGISTRATION,
            thename,
            clinic_id,
            employee_id,
                pickup_date  treat_date,
                    status_pasien_id,
                theid,
            tarif_name treatment,
            result_value')->where("pickup_date >= dateadd(hour,0,'$mulai') and pickup_date < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("no_registration like '$user'")
                ->where("tarif_name like '$filter'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '6') {
            $builder = $db->table('LOG_treatment_akomodasi');
            $builder = $builder->select('top(100) log_user,
            log_time,
            log_computer,
            NO_REGISTRATION,
            thename,
            clinic_id,
            employee_id,
            treat_date,
            status_pasien_id,
                    theid,
                treatment,
                tarif_id,
                quantity,
                tagihan')->where("treat_date >= dateadd(hour,0,'$mulai') and treat_date < dateadd(hour,23,'$akhir') ")
                ->where("no_registration like '$norm'")
                ->where("no_registration like '$user'")
                ->where("treatment like '$filter'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        } else if ($laporan == '7') {
            $builder = $db->table('LOG_login');
            $builder = $builder->select('top(100) log_user,
            log_time,
            log_computer,
            clinic_id,
            case when log_type = \'1\' then \'Login\'
                    when log_type = \'2\' then \'Logout\'
                    else log_type end  as log_type')->where("log_time >= dateadd(hour,0,'$mulai') and log_time < dateadd(hour,23,'$akhir') ")
                ->where("log_user like '$user'");
            $result = $this->lowerKey($builder->get()->getResultArray());
        }



        $dt_data     = array();
        if (!empty($result)) {

            $kunjbaru = $result;

            if ($laporan == '0') {
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['name_of_pasien'];
                    $row[] = $kunjbaru[$key]['contact_address'];
                    $row[] = $kunjbaru[$key]['date_of_birth'];
                    if ($kunjbaru[$key]['gender'] == '1') {
                        $row[] = 'Laki-laki';
                    } else {
                        $row[] = 'Perempuan';
                    }
                    $row[] = $kunjbaru[$key]['pasien_id'];
                    $row[] = $kunjbaru[$key]['kk_no'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '1') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['diantar_oleh'];
                    foreach ($status as $skey => $svalue) {
                        if ($svalue['status_pasien_id'] == $value['status_pasien_id']) {
                            $row[] = $status[$skey]['name_of_status_pasien'];
                            break;
                        }
                    }
                    $row[] = $kunjbaru[$key]['visit_date'];
                    $nmclinic = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value['clinic_id']) {
                            $nmclinic = $clinic[$ckey]['name_of_clinic'];
                            break;
                        }
                    }
                    $row[] = $nmclinic;

                    $nmdokter = '';

                    foreach ($employee as $ekey => $evalue) {
                        if ($evalue['employee_id'] == $value['employee_id']) {
                            $nmdokter = $evalue['fullname'];
                            break;
                        }
                    }
                    $row[] = $nmdokter;
                    $row[] = $kunjbaru[$key]['pasien_id'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '2') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['thename'];
                    $row[] = $kunjbaru[$key]['treat_date'];
                    $row[] = $kunjbaru[$key]['treatment'];
                    $row[] = number_format((float)$kunjbaru[$key]['quantity'], 2);
                    $row[] = number_format((float)$kunjbaru[$key]['tagihan'], 2);
                    $nmclinic = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value['clinic_id']) {
                            $nmclinic = $clinic[$ckey]['name_of_clinic'];
                            break;
                        }
                    }
                    $row[] = $nmclinic;

                    $nmdokter = '';

                    foreach ($employee as $ekey => $evalue) {
                        if ($evalue['employee_id'] == $value['employee_id']) {
                            $nmdokter = $evalue['fullname'];
                            break;
                        }
                    }
                    $row[] = $nmdokter;
                    foreach ($status as $skey => $svalue) {
                        if ($svalue['status_pasien_id'] == $value['status_pasien_id']) {
                            $row[] = $status[$skey]['name_of_status_pasien'];
                            break;
                        }
                    }

                    $row[] = $kunjbaru[$key]['theid'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '3') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['thename'];
                    $row[] = $kunjbaru[$key]['theid'];
                    $row[] = $kunjbaru[$key]['treat_date'];
                    $row[] = $kunjbaru[$key]['treatment'];
                    $row[] = number_format((float)$kunjbaru[$key]['quantity'], 2);
                    $row[] = number_format((float)$kunjbaru[$key]['tagihan'], 2);
                    $nmclinic = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value['clinic_id']) {
                            $nmclinic = $clinic[$ckey]['name_of_clinic'];
                            break;
                        }
                    }
                    $row[] = $nmclinic;

                    $nmdokter = '';

                    foreach ($employee as $ekey => $evalue) {
                        if ($evalue['employee_id'] == $value['employee_id']) {
                            $nmdokter = $evalue['fullname'];
                            break;
                        }
                    }
                    $row[] = $nmdokter;
                    foreach ($status as $skey => $svalue) {
                        if ($svalue['status_pasien_id'] == $value['status_pasien_id']) {
                            $row[] = $status[$skey]['name_of_status_pasien'];
                            break;
                        }
                    }

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '4') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['thename'];
                    $row[] = $kunjbaru[$key]['treat_date'];
                    $row[] = $kunjbaru[$key]['diagnosa_id'];
                    $row[] = $kunjbaru[$key]['diagnosa_desc'];
                    $row[] = $kunjbaru[$key]['description'];
                    $row[] = $kunjbaru[$key]['anamnase'];
                    $row[] = $kunjbaru[$key]['pemeriksaan'];

                    $nmclinic = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value['clinic_id']) {
                            $nmclinic = $clinic[$ckey]['name_of_clinic'];
                            break;
                        }
                    }
                    $row[] = $nmclinic;

                    $nmdokter = '';

                    foreach ($employee as $ekey => $evalue) {
                        if ($evalue['employee_id'] == $value['employee_id']) {
                            $nmdokter = $evalue['fullname'];
                            break;
                        }
                    }
                    $row[] = $nmdokter;
                    foreach ($status as $skey => $svalue) {
                        if ($svalue['status_pasien_id'] == $value['status_pasien_id']) {
                            $row[] = $status[$skey]['name_of_status_pasien'];
                            break;
                        }
                    }
                    $row[] = $kunjbaru[$key]['theid'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '5') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['thename'];
                    $row[] = $kunjbaru[$key]['treat_date'];
                    $row[] = $kunjbaru[$key]['treatment'];
                    $row[] = $kunjbaru[$key]['result_value'];

                    $nmdokter = '';

                    foreach ($employee as $ekey => $evalue) {
                        if ($evalue['employee_id'] == $value['employee_id']) {
                            $nmdokter = $evalue['fullname'];
                            break;
                        }
                    }
                    $row[] = $nmdokter;
                    foreach ($status as $skey => $svalue) {
                        if ($svalue['status_pasien_id'] == $value['status_pasien_id']) {
                            $row[] = $status[$skey]['name_of_status_pasien'];
                            break;
                        }
                    }
                    $row[] = $kunjbaru[$key]['theid'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '6') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $norm = $kunjbaru[$key]['no_registration'];
                    $row[] = "$norm";
                    $row[] = $kunjbaru[$key]['thename'];
                    $row[] = $kunjbaru[$key]['treat_date'];
                    $row[] = $kunjbaru[$key]['treatment'];
                    $row[] = number_format((float)$kunjbaru[$key]['quantity'], 2);
                    $row[] = number_format((float)$kunjbaru[$key]['tagihan'], 2);

                    $nmclinic = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value['clinic_id']) {
                            $nmclinic = $clinic[$ckey]['name_of_clinic'];
                            break;
                        }
                    }
                    $row[] = $nmclinic;

                    $nmdokter = '';

                    foreach ($employee as $ekey => $evalue) {
                        if ($evalue['employee_id'] == $value['employee_id']) {
                            $nmdokter = $evalue['fullname'];
                            break;
                        }
                    }
                    $row[] = $nmdokter;
                    foreach ($status as $skey => $svalue) {
                        if ($svalue['status_pasien_id'] == $value['status_pasien_id']) {
                            $row[] = $status[$skey]['name_of_status_pasien'];
                            break;
                        }
                    }
                    $row[] = $kunjbaru[$key]['theid'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            } else if ($laporan == '7') {
                $model = new ClinicModel();
                $clinic = $this->lowerKey($model->findAll());
                $status = $this->getStatusPasien();
                $employee = $this->getEmployee();
                foreach ($kunjbaru as $key => $value) {
                    $row = [];
                    $row[] = $kunjbaru[$key]['log_user'];
                    $row[] = $kunjbaru[$key]['log_time'];
                    $row[] = $kunjbaru[$key]['log_computer'];
                    $nmclinic = '';
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($cvalue['clinic_id'] == $value['clinic_id']) {
                            $nmclinic = $clinic[$ckey]['name_of_clinic'];
                            break;
                        }
                    }
                    $row[] = $nmclinic;

                    $row[] = $kunjbaru[$key]['log_type'];

                    $dt_data[] = $row;

                    if ($key == 100) {
                        break;
                    }
                }
            }
        }
        $header = [];
        if ($laporan == '0') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">Alamat</th>
                        <th style="padding-right: 20px">Tanggal Lahir</th>
                        <th style="padding-right: 20px">Jenis Kelamin</th>
                        <th style="padding-right: 20px">NIK</th>
                        <th style="padding-right: 20px">No BPJS</th>
                    </tr>';
        } else if ($laporan == '1') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">Status Pasien</th>
                        <th style="padding-right: 20px">Tanggal Kunjungan</th>
                        <th style="padding-right: 20px">Klinik</th>
                        <th style="padding-right: 20px">Dokter</th>
                        <th style="padding-right: 20px">No BPJS</th>
                    </tr>';
        } else if ($laporan == '2') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">Tanggal Tindakan</th>
                        <th style="padding-right: 20px">Nama Tindakan/Tarif</th>
                        <th style="padding-right: 20px">Jumlah</th>
                        <th style="padding-right: 20px">Tagihan</th>
                        <th style="padding-right: 20px">Klinik</th>
                        <th style="padding-right: 20px">Dokter</th>
                        <th style="padding-right: 20px">Status Pasien</th>
                        <th style="padding-right: 20px">No BPJS</th>
                    </tr>';
        } else if ($laporan == '3') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">No Resep</th>
                        <th style="padding-right: 20px">Tanggal Tindakan</th>
                        <th style="padding-right: 20px">Nama Obat / Barang</th>
                        <th style="padding-right: 20px">Jumlah</th>
                        <th style="padding-right: 20px">Tagihan</th>
                        <th style="padding-right: 20px">Depo</th>
                        <th style="padding-right: 20px">Dokter</th>
                        <th style="padding-right: 20px">Status Pasien</th>
                    </tr>';
        } else if ($laporan == '4') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">Tanggal Diagnosis</th>
                        <th style="padding-right: 20px">ICD 10</th>
                        <th style="padding-right: 20px">Diagnosis</th>
                        <th style="padding-right: 20px">Keterangan Diagnosis</th>
                        <th style="padding-right: 20px">Anamnesis</th>
                        <th style="padding-right: 20px">Pemeriksaan</th>
                        <th style="padding-right: 20px">Klinik/Bangsal</th>
                        <th style="padding-right: 20px">Dokter</th>
                        <th style="padding-right: 20px">Status Pasien</th>
                        <th style="padding-right: 20px">No BPJS</th>
                    </tr>';
        } else if ($laporan == '5') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">Tanggal Ekspertise</th>
                        <th style="padding-right: 20px">Nama Tindakan / Tarif</th>
                        <th style="padding-right: 20px">Hasil Ekspertise</th>
                        <th style="padding-right: 20px">Dokter</th>
                        <th style="padding-right: 20px">Status Pasien</th>
                        <th style="padding-right: 20px">No BPJS</th>
                    </tr>';
        } else if ($laporan == '6') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">No MR Pasien</th>
                        <th style="padding-right: 20px">Nama Pasien</th>
                        <th style="padding-right: 20px">Tanggal Tindakan</th>
                        <th style="padding-right: 20px">Nama Tindakan / Tarif</th>
                        <th style="padding-right: 20px">Jumlah</th>
                        <th style="padding-right: 20px">Tagihan</th>
                        <th style="padding-right: 20px">Klinik/Bangsal</th>
                        <th style="padding-right: 20px">Dokter</th>
                        <th style="padding-right: 20px">Status Pasien</th>
                        <th style="padding-right: 20px">No BPJS</th>
                    </tr>';
        } else if ($laporan == '7') {
            $header = '<tr>
                        <th style="padding-right: 20px">User Login</th>
                        <th style="padding-right: 20px">Tanggal Update</th>
                        <th style="padding-right: 20px">Nama Komputer</th>
                        <th style="padding-right: 20px">Klinik/Bangsal</th>
                        <th style="padding-right: 20px">Aktifitas</th>
                    </tr>';
        }
        $json_data = array(
            "body"            => $dt_data,
            'header' => $header,
        );
        echo json_encode($json_data);
    }
}
