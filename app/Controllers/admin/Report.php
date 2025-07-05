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


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            // 'dokter' => $dokter,
            'status' => $status,
            'header' => $header
            // 'visitStatus' => $visitStatus
        ]);
    }
    public function registerpolipost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $pv = new PasienVisitationModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $employeusers = user()->employee_id ?? '%';

        $kunjungan = $this->lowerKey($pv->getregisterpoli($mulai, $akhir, $status_pasien_id, '0', $clinic_id,  $employeusers));

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


        $json_data = array(
            "body"            => $dt_data
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
                        <th>Diagnosa</th>
                        <th>Asal Rujukan</th>
                        <th>No.Rujukan</th>
                        <th>Tgl Rujukan</th>
                        <th>Diagnosa Awal</th>
                    </tr>';

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function registermasukpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $pv = new TreatmentAkomodasiModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($pv->getregistermasuk($mulai, $akhir, $status_pasien_id, '1', $clinic_id));

        $employeusers = user()->employee_id;

        if (!empty($employeusers)) {
            $kunjungan = array_filter($kunjungan, function ($row) use ($employeusers) {
                return isset($row['employee_id']) && $row['employee_id'] == $employeusers;
            });
        }



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

        $json_data = array(
            "body"            => $dt_data
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


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            // 'dokter' => $dokter,
            'status' => $status,
            'header' => $header
            // 'visitStatus' => $visitStatus
        ]);
    }


    public function registerkeluarpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $pv = new TreatmentAkomodasiModel();

        $clinic_id = $this->request->getPost('clinic_id');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');


        $kunjungan = $this->lowerKey($pv->getregisterkeluar($mulai, $akhir, $status_pasien_id, '1', $clinic_id));

        $employeusers = user()->employee_id;

        if (!empty($employeusers)) {
            $kunjungan = array_filter($kunjungan, function ($row) use ($employeusers) {
                return isset($row['employee_id']) && $row['employee_id'] == $employeusers;
            });
        }


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
        $dt_data   = array();
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

        $json_data = array(
            "body"            => $dt_data
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function registerpindahpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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


        $json_data = array(
            "body"            => $dt_data,
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


        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Melahirkan</th>
                        <th>No.CM</th>
                        <th>Keterangan</th>
                    </tr>';
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function registermelahirkanpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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

        $json_data = array(
            "body"            => $dt_data
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'sex' => $sex,
            'isnew' => $isnew,
            'kota' => $kota,
            'header' => $header
        ]);
    }

    public function rmkunjunganpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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

        $json_data = array(
            "body"            => $dt_data
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function rmkunjunganranappost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
                } else {
                    $row[] = '-';
                    $row[] = '-';
                    $row[] = '-';
                    $row[] = '-';
                    $row[] = '-';
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
            $row[] = '-';
            $row[] = '-';
            $row[] = '-';
            $row[] = '-';
            $row[] = '-';
            $row[] = '-';
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



        $json_data = array(
            "body"            => $dt_data,
            'footer' => $footer
        );
        echo json_encode($json_data);
    }

    public function rmkunjunganranapstatus()
    {
        $giTipe = 7;
        $title = 'Laporan Kunjungan Rawat Inap Per Jenis Pelayanan';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $status = $this->getStatusPasien();

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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function rmkunjunganranapstatuspost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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



        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'header' => $header
        ]);
    }

    public function rmkunjunganklinikpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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

        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'header' => $header
        ]);
    }

    public function rmkunjunganstatuspost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function rmkunjunganugdpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Jenis Penyakit</th>
                        <th>Kode ICD X</th>
                        <th>Jumlah Kasus</th>
                        <th>%</th>
                    </tr>';
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'x' => 10,
            'header' => $header,
        ]);
    }

    public function rmtopxrajalpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Jenis Penyakit</th>
                        <th>Kode ICD X</th>
                        <th>Jumlah Kasus</th>
                        <th>%</th>
                    </tr>';
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            'clinic' => $clinic,
            'x' => 10,
            'header' => $header,
        ]);
    }

    public function rmtopxranappost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data
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

        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th>Jenis Penyakit</th>
                        <th>Kode ICD X</th>
                        <th>Jumlah Kasus</th>
                        <th>%</th>
                    </tr>';
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'status' => $status,
            // 'clinic' => $clinic,
            'x' => 10,
            'header' => $header
        ]);
    }

    public function rmtopxugdpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'diagnosa' => '1',
            'header' => $header
        ]);
    }
    public function rmindexrajalpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'diagnosa' => '1',
            'header' => $header
        ]);
    }
    public function rmindexranappost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status,
            'header' => $header
        ]);
    }
    public function finharianpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status,
            'header' => $header
        ]);
    }
    public function finbulananpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status,
            'header' => $header
        ]);
    }
    public function finjenispost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'clinic' => $clinic,
            'header' => $header,
        ]);
    }
    public function fintglpolipost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'clinic' => $clinic,
            'header' => $header,
        ]);
    }
    public function finpolitglpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'clinic' => $clinic,
            'header' => $header,
        ]);
    }
    public function finpolipost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status,
            'header' => $header
        ]);
    }
    public function finjenistglpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'status' => $status,
            'header' => $header
        ]);
    }
    public function finjenisrincipost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        $header = [];
        $header = '<tr>
                        <th style="width: 500px;">Nama Transaksi</th>
                        <th>Jumlah</th>
                    </tr>';

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'treatTarif' => $treatTarif,
            'header' => $header,
        ]);
    }

    public function finpembayarantglpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data
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

        $header = [];
        $header = '<tr>
                        <th style="width: 500px;">Nama Transaksi</th>
                        <th>Jumlah</th>
                    </tr>';

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'treatTarif' => $treatTarif,
            'header' => $header
        ]);
    }

    public function finpembayarantrxpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'treatTarif' => $treatTarif,
            'header' => $header,
        ]);
    }

    public function finpembayaranrincipost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'shift' => '1',
            'kasir' => $kasir,
            'header' => $header,
        ]);
    }
    public function finsetorpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'shift' => '1',
            'kasir' => $kasir,
            'header' => $header,
        ]);
    }
    public function finsetorrincipost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th style="padding-right: 20px;">Tanggal Kunjung</th>
                        <th style="padding-right: 20px;">Waktu Datang</th>
                        <th style="padding-right: 20px;">Waktu Keluar</th>
                        <th style="padding-right: 20px;">Nama</th>
                        <th style="padding-right: 20px;">Kode Booking</th>
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


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'tipeantrol' => '1',
            'header' => $header,
        ]);
    }
    public function foantrolpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $model = new TreatmentBillModel();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $tipeantrol = $this->request->getPost('tipeantrol');

        $db = db_connect();
        $sql = $db->query("select bb.trans_id, pv.DIANTAR_OLEH, NAME_OF_CLINIC,tipe,convert(char(8), dateadd(hour,7,mintime), 108) mintime,convert(char(8), dateadd(hour,7,maxtime), 108) maxtime, time1, time2, time3, time4, time5, time6, time7,
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
                $row[] = $kunjungan[$key]['diantar_oleh'] . '<button onclick="getListTask(\'' . $kunjungan[$key]['trans_id'] . '\',\'' . $kunjungan[$key]['no_registration'] . '\')">getlist</button>';
                $row[] = $kunjungan[$key]['trans_id'];
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
            // return json_encode($avg12);
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
            $row[] = '';
            $dt_data[] = $row;
        }
        $json_data = array(
            "body" => $dt_data,
            "data" => $kunjungan
        );
        echo json_encode($json_data);
    }


    public function foantroltimestamp()
    {
        $giTipe = 7;
        $title = 'Laporan Antrian Online by Timestamp';

        $orgunit = $this->getOrgCode();

        $selectedMenu = ['fin'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_timestamp = $this->getImgTime();
        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th style="padding-right: 20px;">Tanggal Kunjung</th>
                        <th style="padding-right: 20px;">Waktu Datang</th>
                        <th style="padding-right: 20px;">Waktu Keluar</th>
                        <th style="padding-right: 20px;">Nama</th>
                        <th style="padding-right: 20px;">Kode Booking</th>
                        <th style="padding-right: 20px;">Poli</th>
                        <th style="padding-right: 20px;">No MR</th>
                        <th style="padding-right: 20px;">Status Pasien</th>
                        <th style="padding-right: 20px;">DPJP</th>
                        <th style="padding-right: 20px;">Tipe Akhir</th>
                        <th style="padding-right: 20px;">Task ID 1</th>
                        <th style="padding-right: 20px;">Task ID 2</th>
                        <th style="padding-right: 20px;">Task ID 3</th>
                        <th style="padding-right: 20px;">Task ID 4</th>
                        <th style="padding-right: 20px;">Task ID 5</th>
                        <th style="padding-right: 20px;">Task ID 6</th>
                        <th style="padding-right: 20px;">Task ID 7</th>
                    </tr>';


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'tipeantrol' => '1',
            'header' => $header,
        ]);
    }
    public function foantroltimestamppost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        (select trans_id,no_registration,max(tipe) tipe,max(case when tipe = '21' then dateadd(hour,7,waktu) else null end) as mintime,
        max(dateadd(hour,7,waktu)) maxtime,
        max(case when tipe = '21' then dateadd(hour,7,waktu) else null end) as time1,
        max(case when tipe = '22' then dateadd(hour,7,waktu) else null end) as time2,
        max(case when tipe = '23' then dateadd(hour,7,waktu) else null end) as time3,
        max(case when tipe = '24' then dateadd(hour,7,waktu) else null end) as time4,
        max(case when tipe = '25' then dateadd(hour,7,waktu) else null end) as time5,
        max(case when tipe = '26' then dateadd(hour,7,waktu) else null end) as time6,
        max(case when tipe = '27' then dateadd(hour,7,waktu) else null end) as time7
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

                $i++;
                $row = [];
                $row[] = $i;
                $row[] = substr($kunjungan[$key]['visit_date'], 0, 16);
                $row[] = $kunjungan[$key]['mintime'];
                $row[] = $kunjungan[$key]['maxtime'];
                $row[] = $kunjungan[$key]['diantar_oleh'] . '<button onclick="getListTask(\'' . $kunjungan[$key]['trans_id'] . '\',\'' . $kunjungan[$key]['no_registration'] . '\')">getlist</button>';
                $row[] = $kunjungan[$key]['trans_id'];
                $row[] = $kunjungan[$key]['name_of_clinic'];
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['name_of_status_pasien'];
                $row[] = $kunjungan[$key]['fullname'];
                $row[] = $kunjungan[$key]['tipe'];
                $row[] = $kunjungan[$key]['time1'];
                $row[] = $kunjungan[$key]['time2'];
                $row[] = $kunjungan[$key]['time3'];
                $row[] = $kunjungan[$key]['time4'];
                $row[] = $kunjungan[$key]['time5'];
                $row[] = $kunjungan[$key]['time6'];
                $row[] = $kunjungan[$key]['time7'];

                $dt_data[] = $row;
            }
        }
        $json_data = array(
            "body" => $dt_data,
            "data" => $kunjungan
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


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'shiftdays' => $shift,
            'clinic' => $clinic,
            'status' => $status,
            'header' => $header
        ]);
    }

    public function aptrekapnotapost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            // 'shiftdays' => $shift,
            'clinic' => $clinic,
            'status' => $status,
            'header' => $header
        ]);
    }
    public function aptrekapobatpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
        $json_data = array(
            "body"            => $dt_data,
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

        $header = '<tr>
            <th style="padding: 20px">Status Pasien</th>
            <th style="padding: 20px">Jumlah Lembar R/</th>
            <th style="padding: 20px">Total R/</th>
            <th style="padding: 20px">Alkes</th>
            <th style="padding: 20px">Total Generik</th>
            <th style="padding: 20px">Total Non Gen</th>
            <th style="padding: 20px">Total Form</th>
            <th style="padding: 20px">Total Non Form</th>
            <th style="padding: 20px">Total Non Racik</th>
            <th style="padding: 20px">Total Racikan</th>';

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'custom' => $custom,
            'clinic' => $clinic,
            'status' => $status,
            'customTitle' => $customTitle,
            'header' => $header,
        ]);
    }

    public function aptrekappelayananpost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
                        <th style="padding: 20px">Status Pasien</th>
                        <th style="padding: 20px">Jumlah Lembar R/</th>
                        <th style="padding: 20px">Total R/ Terlayani</th>
                        <th style="padding: 20px">Total R/ TT</th>
                        <th style="padding: 20px">Total R/</th>
                        <th style="padding: 20px">Generik Terlayani</th>
                        <th style="padding: 20px">Generik TT</th>
                        <th style="padding: 20px">Total Generik</th>
                        <th style="padding: 20px">Non Gen Terlayani</th>
                        <th style="padding: 20px">Non Gen TT</th>
                        <th style="padding: 20px">Total Non Gen</th>
                        <th style="padding: 20px">Alkes</th>
                        <th style="padding: 20px">Non Form Telrayani</th>
                        <th style="padding: 20px">Non Form TT</th>
                        <th style="padding: 20px">Total Non Form</th>
                        <th style="padding: 20px">Form Terlayani</th>
                        <th style="padding: 20px">Form TT</th>
                        <th style="padding: 20px">Total Form</th>
                        <th style="padding: 20px">Non Racik Terlayani</th>
                        <th style="padding: 20px">Non Racik TT</th>
                        <th style="padding: 20px">Total Non Racik</th>
                        <th style="padding: 20px">Racikan Terlayani</th>
                        <th style="padding: 20px">Racikan TT</th>
                        <th style="padding: 20px">Total Racikan</th>
                    </tr>';
        } else {
            $header = '<tr>
            <th style="padding: 20px">Status Pasien</th>
            <th style="padding: 20px">Jumlah Lembar R/</th>
            <th style="padding: 20px">Total R/</th>
            <th style="padding: 20px">Alkes</th>
            <th style="padding: 20px">Total Generik</th>
            <th style="padding: 20px">Total Non Gen</th>
            <th style="padding: 20px">Total Form</th>
            <th style="padding: 20px">Total Non Form</th>
            <th style="padding: 20px">Total Non Racik</th>
            <th style="padding: 20px">Total Racikan</th>';
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
        $header = [];
        $header = '<tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Nama Obat/Alkes</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>';

        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'isrj' => $isrj,
            'itemName' => '1',
            'clinic' => $clinic,
            'status' => $status,
            'header' => $header,
        ]);
    }
    public function aptobatalkespost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
                        <th style="padding: 20px">Tanggal</th>
                        <th style="padding: 20px">Kode</th>
                        <th style="padding: 20px">Nama Obat/Alkes</th>
                        <th style="padding: 20px">Jumlah</th>
                        <th style="padding: 20px">Satuan</th>
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
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
    public function satuSehat()
    {
        $giTipe = 7;
        $title = 'Status Posting Satu Sehat';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $selectedMenu = ['office'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();



        $header = [];
        $header = '<tr>
                        <th>No</th>
                        <th style="padding-right: 20px;">Tanggal Kunjung</th>
                        <th style="padding-right: 20px;">No RM</th>
                        <th style="padding-right: 20px;">Result</th>
                        <th style="padding-right: 20px;">Status</th>
                        <th style="padding-right: 20px;">Tipe</th>
                    </tr>';


        return view('admin\report\register', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            // 'tipeantrol' => '1',
            'header' => $header,
        ]);
    }

    public function satuSehatPost()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $ss = new SatuSehatModel();
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');



        $kunjungan = $this->lowerKey($ss->where("created_date between '$mulai' and dateadd(day,1,'$akhir')")->findAll());



        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {




                $row = array();
                $row[] = $key + 1;
                $row[] = $value['waktu'];
                $row[] = $kunjungan[$key]['no_registration'];

                $row[] = $kunjungan[$key]['result'];
                $row[] = $kunjungan[$key]['status'];
                $row[] = $kunjungan[$key]['tipe'];


                $dt_data[] = $row;
            }
        }

        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_1_1()
    {
        $giTipe = 7;
        $title = 'RL 1.1 Data Dasar Rumah Sakit';
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
        $db = db_connect();

        $kop = $this->lowerKey(
            $db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array')
        );

        $header = [];
        $header = '<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>';
        return view('admin\report\rl-report', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'kop' => $kop,


            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }
    public function rl_1_1post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("SELECT  ORGANIZATIONUNIT.ORG_UNIT_CODE ,
                                                                ORGANIZATIONUNIT.NAME_OF_ORG_UNIT ,
                                                                ORGANIZATIONUNIT.CONTACT_ADDRESS ,
                                                                ORGANIZATIONUNIT.KAL_ID ,
                                                                ORGANIZATIONUNIT.PHONE ,
                                                                ORGANIZATIONUNIT.POSTAL_CODE ,
                                                                ORGANIZATIONUNIT.DISPLAY ,
                                                                ORGANIZATIONUNIT.OBJECT_CATEGORY_ID ,
                                                                ORGANIZATIONUNIT.HIRARKI_ID ,
                                                                ORGANIZATIONUNIT.OTHER_CODE ,
                                                                ORGANIZATIONUNIT.EMPLOYEE_ID ,
                                                                ORGANIZATIONUNIT.ORG_TYPE ,
                                                                ORGANIZATIONUNIT.CLASS_ID ,
                                                                ORGANIZATIONUNIT.BY_ID ,
                                                                ORGANIZATIONUNIT.PENETAP_ID ,
                                                                ORGANIZATIONUNIT.email,
                                                                ORGANIZATIONUNIT.SK ,
                                                                ORGANIZATIONUNIT.FAX ,
                                                                ORGANIZATIONUNIT.DIRECT_PARENT ,
                                                                ORGANIZATIONUNIT.MAIN_PARENT ,
                                                                ORGANIZATIONUNIT.WHOLE_PARENT ,
                                                                ORGANIZATIONUNIT.MODIFIED_DATE ,
                                                                ORGANIZATIONUNIT.MODIFIED_BY ,
                                                                ORGANIZATIONUNIT.MODIFIED_FROM,
                                                                ORGANIZATIONUNIT.WEBSITE,
                                                                    ORGANIZATIONUNIT.ACCREDITATION,
                                                                ORGANIZATIONUNIT.ACCREDIT_STATUS,
                                                                ORGANIZATIONUNIT.SK_STATUS  ,
                                                                 ORGANIZATIONUNIT.KODE_KOTA,
                                                                 ORGANIZATIONUNIT.kota,

                                                        organizationunit.REGISTRATION_DATE ,
                                                        organizationunit.LUAS_TANAH,
                                                        organizationunit.LUAS_BANGUNAN ,
                                                        organizationunit.SK_MASA,
                                                        organizationunit.ACCREDITATION_DATE ,
                                                        organizationunit.TT_VVIP ,
                                                        organizationunit.TT_VIP ,
                                                        organizationunit.TT_1 ,
                                                        organizationunit.TT_2,
                                                        organizationunit.TT_3,
                                                        --organizationunit.TT_non,
                                                        organizationunit.DR_SPA ,
                                                        organizationunit.DR_SPOG ,
                                                        organizationunit.dr_sppd ,
                                                        organizationunit.dr_spb ,
                                                        organizationunit.dr_sprad ,
                                                        organizationunit.dr_sprm ,
                                                        organizationunit.dr_span ,
                                                        organizationunit.dr_spjp,
                                                        organizationunit.dr_spm ,
                                                        organizationunit.dr_sptht,
                                                        organizationunit.dr_spkj ,
                                                        organizationunit.dr_um,
                                                        organizationunit.drg ,
                                                        organizationunit.drg_sp ,
                                                        organizationunit.prwt,
                                                        organizationunit.bdn,
                                                        organizationunit.far,
                                                        organizationunit.tkes ,
                                                        organizationunit.tNONkes,
                                                        organizationunit.sk_date
                                                                FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

        $resultToJson =  [
            [
                "no" => "1.",
                "name" => "No. Kode Rumah Sakit",
                "data" => isset($data['org_unit_code']) ? $data['org_unit_code'] : null
            ],
            [
                "no" => "2.",
                "name" => "Tanggal Registrasi",
                "data" => isset($data['registration_date']) ? $data['registration_date'] : null
            ],
            [
                "no" => "3.",
                "name" => "Nama Rumah Sakit",
                "data" => isset($data['name_of_org_unit']) ? $data['org_type'] : null
            ],
            [
                "no" => "4.",
                "name" => "Jenis Rumah Sakit",
                "data" => isset($data['org_type']) ? $data['org_type'] : null
            ],
            [
                "no" => "5.",
                "name" => "Kelas Rumah Sakit",
                "data" => isset($data['class_id']) ? $data['class_id'] : null
            ],
            [
                "no" => "6.",
                "name" => "Nama Direktur",
                "data" => isset($data['direct_parent']) ? $data['direct_parent'] : null
            ],
            [
                "no" => "7.",
                "name" => "Penyelenggara",
                "data" => isset($data['name_of_org_unit']) ? $data['name_of_org_unit'] : null
            ],
            [
                "no" => "8.",
                "name" => "Alamat / Lokasi",
                "data" => isset($data['contact_address']) ? $data['contact_address'] : null
            ],
            [
                "no" => "8.1.",
                "name" => "Kota/Kab",
                "data" => isset($data['kota']) ? $data['kota'] : null
            ],
            [
                "no" => "8.2.",
                "name" => "Kode Pos",
                "data" => isset($data['postal_code']) ? $data['postal_code'] : null
            ],
            [
                "no" => "8.3.",
                "name" => "Telepon",
                "data" => isset($data['phone']) ? $data['phone'] : null
            ],
            [
                "no" => "8.4.",
                "name" => "Fax",
                "data" => isset($data['fax']) ? $data['fax'] : null
            ],
            [
                "no" => "8.5.",
                "name" => "e-Mail",
                "data" => isset($data['email']) ? $data['email'] : null
            ],
            [
                "no" => "8.6.",
                "name" => "No. telp bagian",
                "data" => isset($data['phone']) ? $data['phone'] : null
            ],
            [
                "no" => "8.7.",
                "name" => "Website",
                "data" => isset($data['website']) ? $data['website'] : null
            ],
            [
                "no" => "9.",
                "name" => "Luas Rumah Sakit",
                "data" => ""
            ],
            [
                "no" => "9.1.",
                "name" => "Luas Tanah",
                "data" => isset($data['luas_tanah']) ? $data['luas_tanah'] : null
            ],
            [
                "no" => "9.2.",
                "name" => "Luas Bangunan",
                "data" => isset($data['luas_bangunan']) ? $data['luas_bangunan'] : null
            ],
            [
                "no" => "10.",
                "name" => "Surat izin/penetapan",
                "data" => ""
            ],
            [
                "no" => "10.1.",
                "name" => "No. SK",
                "data" => isset($data['sk']) ? $data['sk'] : null
            ],
            [
                "no" => "10.2.",
                "name" => "Tanggal",
                "data" => isset($data['sk_date']) ? $data['sk_date'] : null
            ],
            [
                "no" => "10.3.",
                "name" => "Oleh",
                "data" => isset($data['luas_bangunan']) ? $data['luas_bangunan'] : null
            ],
            [
                "no" => "10.4.",
                "name" => "Status SK",
                "data" => ""
            ],
            [
                "no" => "10.5.",
                "name" => "Berlaku hingga",
                "data" => isset($data['sk_masa']) ? $data['sk_masa'] : null
            ],
            [
                "no" => "11.",
                "name" => "Status Penyelenggaraan Swasta",
                "data" => ""
            ],
            [
                "no" => "12.",
                "name" => "Akreditasi",
                "data" => ""
            ],
            [
                "no" => "12.1.",
                "name" => "Pentahapan",
                "data" => match (@$data['accreditation']) {
                    0 => 'Belum diidentifikasi',
                    1 => '5 Pelayanan',
                    2 => '12 Pelayanan',
                    3 => '16 Pelayanan',
                    default => 'Tidak diketahui',
                },
            ],
            [
                "no" => "12.2.",
                "name" => "Status",
                "data" => match (@$data['accredit_status']) {
                    0 => 'Belum diidentifikasi',
                    1 => 'Penuh',
                    2 => 'Bersyarat',
                    3 => 'Gagal',
                    4 => 'Belum',
                    default => '',
                },
            ],
            [
                "no" => "12.3.",
                "name" => "Tanggal",
                "data" => isset($data['accreditation_date']) ? $data['accreditation_date'] : null
            ],
            [
                "no" => "13.",
                "name" => "Tempat Tidur",
                "data" => ""
            ],
            [
                "no" => "13.1.",
                "name" => "Kls VVIP",
                "data" => isset($data['tt_vvip']) ? $data['tt_vvip'] : null
            ],
            [
                "no" => "13.2.",
                "name" => "Kls VIP",
                "data" => isset($data['tt_vip']) ? $data['tt_vip'] : null
            ],
            [
                "no" => "13.3.",
                "name" => "Kls I",
                "data" => isset($data['tt_1']) ? $data['tt_1'] : null
            ],
            [
                "no" => "13.4.",
                "name" => "Kls II",
                "data" => isset($data['tt_2']) ? $data['tt_2'] : null
            ],
            [
                "no" => "13.5.",
                "name" => "Kls III",
                "data" => isset($data['tt_3']) ? $data['tt_3'] : null
            ],
            [
                "no" => "13.6.",
                "name" => "Non Kelas",
                "data" => ""
            ],
            [
                "no" => "14.",
                "name" => "Tenaga Medis",
                "data" => ""
            ],
            [
                "no" => "14.1.",
                "name" => "Dokter Sp.A",
                "data" => isset($data['dr_spa']) ? $data['dr_spa'] : null
            ],
            [
                "no" => "14.2.",
                "name" => "Dokter Sp.OG",
                "data" => isset($data['dr_spog']) ? $data['dr_spog'] : null
            ],
            [
                "no" => "14.3.",
                "name" => "Dokter Sp.PD",
                "data" => isset($data['dr_sppd']) ? $data['dr_sppd'] : null
            ],
            [
                "no" => "14.4.",
                "name" => "Dokter Sp.B",
                "data" => isset($data['dr_spb']) ? $data['dr_spb'] : null
            ],
            [
                "no" => "14.5.",
                "name" => "Dokter Sp.Rad",
                "data" => isset($data['dr_sprad']) ? $data['dr_sprad'] : null
            ],
            [
                "no" => "14.6.",
                "name" => "Dokter Sp.RM",
                "data" => isset($data['dr_sprm']) ? $data['dr_sprm'] : null
            ],
            [
                "no" => "14.7.",
                "name" => "Dokter Sp.An",
                "data" => isset($data['dr_span']) ? $data['dr_span'] : null
            ],
            [
                "no" => "14.8.",
                "name" => "Dokter Sp.JP",
                "data" => isset($data['dr_spjp']) ? $data['dr_spjp'] : null
            ],
            [
                "no" => "14.9.",
                "name" => "Dokter Sp.M",
                "data" => isset($data['dr_spm']) ? $data['dr_spm'] : null
            ],
            [
                "no" => "14.10.",
                "name" => "Dokter Sp.THT",
                "data" => isset($data['dr_sptht']) ? $data['dr_sptht'] : null
            ],
            [
                "no" => "14.11.",
                "name" => "Dokter Sp.KJ",
                "data" => isset($data['dr_spkj']) ? $data['dr_spkj'] : null
            ],
            [
                "no" => "14.12.",
                "name" => "Dokter Umum",
                "data" => isset($data['dr_um']) ? $data['dr_um'] : null
            ],
            [
                "no" => "14.13.",
                "name" => "Dokter Gigi",
                "data" => isset($data['drg']) ? $data['drg'] : null
            ],
            [
                "no" => "14.14.",
                "name" => "Dokter Gigi Sps",
                "data" => isset($data['drg_sp']) ? $data['drg_sp'] : null
            ],
            [
                "no" => "14.15.",
                "name" => "Perawat",
                "data" => isset($data['prwt']) ? $data['prwt'] : null
            ],
            [
                "no" => "14.16.",
                "name" => "Bidan",
                "data" => isset($data['bdn']) ? $data['bdn'] : null
            ],
            [
                "no" => "14.17.",
                "name" => "Farmasi",
                "data" => isset($data['far']) ? $data['far'] : null
            ],
            [
                "no" => "14.18.",
                "name" => "Tenaga Kes Lain",
                "data" => isset($data['tkes']) ? $data['tkes'] : null
            ],
            [
                "no" => "15.",
                "name" => "Tenaga non Kesehatan",
                "data" => isset($data['tnonkes']) ? $data['tnonkes'] : null
            ],

        ];

        $dt_data     = array();
        if (!empty($resultToJson)) {
            foreach ($resultToJson as $index => $rows) {
                $row = [];

                $row[] = $rows['no'];
                $row[] = $rows['name'];
                $row[] = $rows['data'];



                $dt_data[] = $row;
            }
        }

        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
    }
    public function rl_1_3()
    {
        $giTipe = 7;
        $title = 'RL 1.3 Tempat Tidur';
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
                    <th class="p-1">Jenis Pelayanan</th>
                    <th class="p-1">Total</th>
                    <th class="p-1">VVIP</th>
                    <th class="p-1">VIP</th>
                    <th class="p-1">Kls 1</th>
                    <th class="p-1">Kls 2</th>
                    <th class="p-1">Kls 3</th>
                    <th class="p-1">Kls Khusus</th>
                </tr>';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
    public function rl_1_3post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        // var_dump($mulai);

        $data = $this->lowerKey($db->query("SELECT 
                                                c.CLINICTYPE,
                                                cr.capacity,
                                                cr.class_id ,
                                                class.NAME_OF_CLASS
                                                from clinic_type  c  left outer join clinic cl on cl.clinic_type = c.clinic_type  and cl.stype_id = 3
                                                left outer join 	class_room cr on cr.clinic_id = cl.clinic_id
                                                left outer join class on class.class_id = cr.Class_ID
                                                ")->getResultArray());

        $groupedData = [];
        foreach ($data as $item) {
            $clinicType = $item['clinictype'];
            if (!isset($groupedData[$clinicType])) {
                $groupedData[$clinicType] = [
                    'jenis_pelayanan' => $clinicType,
                    'total' => 0,
                    'vvip' => 0,
                    'vip' => 0,
                    'kls_1' => 0,
                    'kls_2' => 0,
                    'kls_3' => 0,
                    'kls_khusus' => 0,
                ];
            }

            $groupedData[$clinicType]['total']++;
            switch ($item['class_id']) {
                case 6: // KLAS VIP
                    $groupedData[$clinicType]['vip']++;
                    break;
                case 1: // Utama

                case 2: // Kelas I
                    $groupedData[$clinicType]['kls_1']++;
                    break;
                case 3: // Kelas II
                    $groupedData[$clinicType]['kls_2']++;
                    break;
                case 4: // Kelas III
                    $groupedData[$clinicType]['kls_3']++;
                    break;
                case 0: // Rawat Jalan
                case 5: // KLAS III B
                case 7: // KLAS VIP 1
                    $groupedData[$clinicType]['vvip']++;
                    break;
                case 8: // KLAS Super VIP
                    $groupedData[$clinicType]['kls_khusus']++;
                    break;

                case 9: // ICU
                case 11: // UMUM
                    $groupedData[$clinicType]['kelas_lain']++;
                    break;
            }
        }
        $dt_data     = array();
        if (!empty($groupedData)) {
            foreach ($groupedData as $key => $value) {
                $row = [];

                $row[] = 2024;
                $row[] = $value['jenis_pelayanan'];
                $row[] = $value['total'];
                $row[] = $value['vvip'];
                $row[] = $value['vip'];
                $row[] = $value['kls_1'];
                $row[] = $value['kls_2'];
                $row[] = $value['kls_3'];
                $row[] = $value['kls_khusus'];

                $dt_data[] = $row;
            }
        }

        // return json_encode($kunjungan);


        $json_data = array(
            "body"            => $dt_data
        );
        echo json_encode($json_data);
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();

        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();

        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();

        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();

        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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
    public function rFarmaiRekapitulasiDrugDoctor()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PEMAKAIAN OBAT/ALKES PER DOKTER';
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];
        $db = db_connect();

        $selectedMenu = ['rm'];
        $sessionData = ['selectedMenu' => $selectedMenu];
        $this->session->set($sessionData);

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $userEmployee = user()->employee_id;
        $clinicModel = new ClinicModel();
        if (is_null($userEmployee)) {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [73])->findAll());
        } else {
            $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', [73])->where("clinic_id in (select clinic_id from doctor_schedule where employee_id = '$userEmployee')")->findAll());
        }
        $goods = $this->lowerKey($db->query("SELECT BRAND_ID as isalkes ,name as thealkes from goods where ISACTIVE = 1")->getResultArray());
        $employee_all = $this->lowerKey($db->query("SELECT employee_id as id , fullname as text from employee_all where OBJECT_CATEGORY_ID = 20 and NONACTIVE = 0")->getResultArray());

        $sexModel = new SexModel();
        $sex  = $this->lowerKey($sexModel->findAll());

        $statusPasien = new StatusPasienModel();
        $status = $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());

        $isnew = ['Lama', 'Baru'];

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->where('province_code', '17')->findAll());


        $header = [];
        $header = '<tr>
                    <th class="p-1 align-middle text-center">No</th>
                    <th class="p-1 align-middle text-center">Dokter</th>
                    <th class="p-1 align-middle text-center">Nama Obat</th>
                    <th class="p-1 align-middle text-center">Jumlah Obat</th>
                </tr>
                ';

        $isrj = ['0', '1'];
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'isrj' => $isrj,
            // 'status' => $status,
            'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            // 'header' => $header
            // 'dokterfill' => '1',
            'goods' => $goods,
            'employee_allDoctor' => $employee_all,
            // 'fillTop'=>'1',
            'header' => $header



        ]);
    }

    public function rFarmaiRekapitulasiDrugDoctorpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $clinic = $this->request->getPost('clinic_id');
        $isrj = $this->request->getPost('isrj');
        $goods = $this->request->getPost('goods');
        $doctor = $this->request->getPost('employee_allDoctor');


        $query = "
       	DECLARE @mulai DATETIME;
        DECLARE @akhir DATETIME;
        DECLARE @top INT;
        DECLARE @klinik NVARCHAR(50);
        DECLARE @isrj NVARCHAR(50);
        DECLARE @obat NVARCHAR(50);
        DECLARE @dokter NVARCHAR(50);

        SET @mulai = CONVERT(DATETIME, '$mulai', 120);
        SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
   
        SET @klinik = '$clinic';
        SET @isrj = '$isrj';
        SET @obat = '$goods';
        SET @dokter = '$doctor';

        SELECT	T.brand_id,
                t.description, 
                sum(t.quantity) as jml,		  
                CAST(SUM(t.quantity) AS NVARCHAR) + ' ' + ISNULL(M.MEASUREMENT, '') AS jml_obat,
                t.employee_id,
                ea.fullname,
                M.MEASUREMENT,
        sum(t.amount_paid) as total,
        t.isrj
            FROM treatment_obat t LEFT OUTER JOIN MEASUREMENT M ON T.MEASURE_ID = M.MEASURE_ID,
            employee_all ea 
        where brand_id is not null and
                t.treat_date between dateadd(hour,0,@mulai) and dateadd(minute,1439,@akhir) 
                and (EA.fullname like @dokter or EA.EMPLOYEE_ID LIKE @DOKTER) 
                and ea.employee_id = t.EMPLOYEE_ID
                And t.CLINIC_ID like @klinik   
                and (t.BRAND_ID like @obat or t.description like @obat)    
                and  t.ISRJ like @isrj
                
        group by  t.isrj ,
        t.EMPLOYEE_ID
        ,ea.fullname,BRAND_ID, 
        t.DESCRIPTION, M.MEASUREMENT
        ";

        $data = $this->lowerKey($db->query($query)->getResultArray());

        $dt_data = [];
        $index = 1;
        // var_dump($data);
        // exit();


        foreach ($data as $value) {
            $row = [];
            $row[] = $index++;
            $row[] = $value['fullname'];
            $row[] = $value['description'];
            $row[] = $value['jml_obat'];


            $dt_data[] = $row;
        }

        $json_data = array(
            "body" => $dt_data
        );
        echo json_encode($json_data);
    }

    // Dasboard poli
    // =============================================================================

    public function pjbList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER PENJAMIN';
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
                        <th class="p-1"  rowspan="2">Penjamin</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                        <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pjbListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            SELECT 
                    ISNULL(p.payertype, 'PENJAMIN LAIN-LAIN') AS PAYERTYPE,
                    COUNT(visit_id) AS total, 
                    SUM(CASE WHEN class_room_id IS NULL and isattended = 1 THEN 1 else 0 END) AS isrj, 
                    SUM(CASE WHEN class_room_id IS NOT NULL and isattended = 1  THEN 1  else 0 END) AS isranap, 
                    SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                    SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi 
                FROM pasien_visitation
                LEFT JOIN payor_type p ON pasien_visitation.status_pasien_id IN 
                    (SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type)
                WHERE 
                    visit_date BETWEEN @mulai AND @akhir  
                    AND clinic_id IN (SELECT clinic_id FROM clinic WHERE STYPE_ID = 1)
                GROUP BY 
                    ISNULL(p.payertype, 'PENJAMIN LAIN-LAIN')
                ORDER BY 
                 PAYERTYPE DESC;
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'isrj' => 0,
                'isranap' => 0,
                'isrj_isranap' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['payertype'];
                $row[] = $rows['total'];
                $row[] = $rows['isrj'];
                $row[] = $rows['isranap'];
                $row[] = $rows['isrj'] + $rows['isranap'];
                $row[] = $rows['belum_dilayani'];
                $row[] = 0;
                $row[] = $rows['belum_konfirmasi'];

                $totalKeseluruhan['total'] += (int)$rows['total'];
                $totalKeseluruhan['isrj'] += (int)$rows['isrj'];
                $totalKeseluruhan['isranap'] += (int)$rows['isranap'];
                $totalKeseluruhan['isrj_isranap'] += (int)$rows['isrj'] + (int)$rows['isranap'];
                $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                $totalKeseluruhan['batal'] += 0;
                $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['isrj'],
                $totalKeseluruhan['isranap'],
                $totalKeseluruhan['isrj_isranap'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function ppkList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER KLINIK';
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
                        <th class="p-1"  rowspan="2">Poliklinik</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" colspan="2">Rujukan</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                       <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                        <th class="p-1">Langsung</th>
                        <th class="p-1">Konsultan</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',

            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppkListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            
            SELECT 
                        c.name_of_clinic,
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL and isattended = 1 THEN 1 else 0 END) AS isrj, 
                        SUM(CASE WHEN class_room_id IS NOT NULL and isattended = 1  THEN 1  else 0 END) AS isranap, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN class_room_id IS NULL  AND CLINIC_ID_FROM = 'P000' and isattended = 1 THEN 1 ELSE 0 END) AS rjlive, 
                         SUM(CASE WHEN class_room_id IS NULL AND CLINIC_ID_FROM <> 'P000' and isattended = 1 THEN 1 ELSE 0 END) AS rjkonsul, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi 
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN payor_type p ON pasien_visitation.status_pasien_id IN 
                        (SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type)
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND c.clinic_id IN (SELECT clinic_id FROM clinic WHERE STYPE_ID = 1)
                    GROUP BY 
                        c.name_of_clinic
                    ORDER BY
                        c.name_of_clinic ASC

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'isrj' => 0,
                'isranap' => 0,
                'isrj_isranap' => 0,
                'belum_dilayani' => 0,
                'rjlive' => 0,
                'rjkonsul' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['name_of_clinic'];
                $row[] = $rows['total'];
                $row[] = $rows['isrj'];
                $row[] = $rows['isranap'];
                $row[] = $rows['isrj'] + $rows['isranap'];
                $row[] = $rows['rjlive'];
                $row[] = $rows['rjkonsul'];
                $row[] = $rows['belum_dilayani'];
                $row[] = 0;
                $row[] = $rows['belum_konfirmasi'];

                $totalKeseluruhan['total'] += (int)$rows['total'];
                $totalKeseluruhan['isrj'] += (int)$rows['isrj'];
                $totalKeseluruhan['isranap'] += (int)$rows['isranap'];
                $totalKeseluruhan['isrj_isranap'] += (int)$rows['isrj'] + (int)$rows['isranap'];
                $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                $totalKeseluruhan['rjlive'] += (int)$rows['rjlive'];
                $totalKeseluruhan['rjkonsul'] += (int)$rows['rjkonsul'];
                $totalKeseluruhan['batal'] += 0;
                $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['isrj'],
                $totalKeseluruhan['isranap'],
                $totalKeseluruhan['isrj_isranap'],
                $totalKeseluruhan['rjlive'],
                $totalKeseluruhan['rjkonsul'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function pkbList()
    {
        $giTipe = 7;
        $title = 'DATA PENGUNJUNG RS PER klinik';
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
                        <th class="p-1"  >Poliklinik</th>
                        <th class="p-1" >Umum</th>
                        <th class="p-1" >BPJS</th>
                        <th class="p-1" >Asuransi</th>
                        <th class="p-1" >Jumlah</th>
                    </tr>
                   

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',

            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pkbListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            SELECT 
                C.NAME_OF_CLINIC,
                COUNT(visit_id) AS total_pasien,
                SUM(CASE WHEN COALESCE(p.payor_type, 0) = 2 THEN 1 ELSE 0 END) AS bpjs, 
                SUM(CASE WHEN COALESCE(p.payor_type, 0) = 1 THEN 1 ELSE 0 END) AS umum, 
                SUM(CASE WHEN COALESCE(p.payor_type, 0) = 4 THEN 1 ELSE 0 END) AS asuransi,
                SUM(CASE WHEN COALESCE(p.payor_type, 0) NOT IN (1,2,4) THEN 1 ELSE 0 END) AS lainnya
            FROM pasien_visitation 
            LEFT JOIN CLINIC C ON C.CLINIC_ID = pasien_visitation.CLINIC_ID
            LEFT JOIN payor_type p ON pasien_visitation.status_pasien_id IN 
                (SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type)
            WHERE 
                visit_date BETWEEN @mulai AND @akhir
                AND C.STYPE_ID IN (1,10)
            GROUP BY 
                C.NAME_OF_CLINIC
            ORDER BY 
                C.NAME_OF_CLINIC ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'umum' => 0,
                'bpjs' => 0,
                'asuransi' => 0,
                'total' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['name_of_clinic'];
                $row[] = $rows['umum'];
                $row[] = $rows['bpjs'];
                $row[] = $rows['asuransi'];
                $row[] = $rows['umum'] + $rows['bpjs'] + $rows['asuransi'];

                $totalKeseluruhan['umum'] += (int)$rows['umum'];
                $totalKeseluruhan['bpjs'] += (int)$rows['bpjs'];
                $totalKeseluruhan['asuransi'] += (int)$rows['asuransi'];
                $totalKeseluruhan['total'] += (int)$rows['umum'] + (int)$rows['bpjs'] + (int)$rows['asuransi'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['umum'],
                $totalKeseluruhan['bpjs'],
                $totalKeseluruhan['asuransi'],
                $totalKeseluruhan['total']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER KLINIK PER DOKTER';
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
                        <th class="p-1"  rowspan="2">Poliklinik-Dokter</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                        <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',

            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
            WITH ClinicData AS (
                    SELECT 
                        c.name_of_clinic,
                        '' AS fullname, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        1 AS is_clinic_header
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND c.clinic_id IN (SELECT clinic_id FROM clinic WHERE STYPE_ID = 1)
                        AND stype_id in (1,10)
                    GROUP BY c.name_of_clinic
                ),
                DoctorData AS (
                    SELECT 
                        c.name_of_clinic,
                        COALESCE(ea.fullname, '-') AS fullname, -- Nama dokter
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        0 AS is_clinic_header
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND c.clinic_id IN (SELECT clinic_id FROM clinic WHERE STYPE_ID = 1)
                        AND stype_id in (1,10)
                    GROUP BY c.name_of_clinic, ea.fullname
                )

                SELECT * FROM (
                    SELECT * FROM ClinicData
                    UNION ALL
                    SELECT * FROM DoctorData
                ) AS CombinedData
                ORDER BY name_of_clinic ASC, is_clinic_header DESC, fullname ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'pulang' => 0,
                'ranap' => 0,
                'terlayani' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = !empty($rows['fullname'])
                    ? htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8')
                    : '<b><center>' . htmlspecialchars($rows['name_of_clinic'], ENT_QUOTES, 'UTF-8') . '</center></b>';

                $row[] = $rows['total'];
                $row[] = $rows['pulang'];
                $row[] = $rows['ranap'];
                $row[] = $rows['terlayani'];
                $row[] = $rows['belum_dilayani'];
                $row[] = $rows['batal'];
                $row[] = $rows['belum_konfirmasi'];

                if ((int)$rows['is_clinic_header'] === 1) {
                    $totalKeseluruhan['total'] += (int)$rows['total'];
                    $totalKeseluruhan['pulang'] += (int)$rows['pulang'];
                    $totalKeseluruhan['ranap'] += (int)$rows['ranap'];
                    $totalKeseluruhan['terlayani'] += (int)$rows['terlayani'];
                    $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                    $totalKeseluruhan['batal'] += (int)$rows['batal'];
                    $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];
                }

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['pulang'],
                $totalKeseluruhan['ranap'],
                $totalKeseluruhan['terlayani'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function dppList()
    {
        $giTipe = 7;
        $title = 'DATA PASIEN DOKTER PER PENJAMIN';
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
                        <th class="p-1"  rowspan="2">Penjaminan</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                     <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',

            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function dppListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
            WITH FullnameData AS (
                    SELECT 
                        ea.fullname, 
                        '' AS payertype, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        1 AS is_fullname_header
                    FROM pasien_visitation
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND ea.fullname IS NOT NULL 
                        and clinic_id in (select clinic_id from clinic where stype_id in (1,10) )
                    GROUP BY ea.fullname
                ),
                PayertypeData AS (
                    SELECT 
                        ea.fullname, -- Nama dokter
                        COALESCE(pt.payertype, '-') AS payertype, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        0 AS is_fullname_header
                    FROM pasien_visitation
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    LEFT JOIN payor_type pt ON pasien_visitation.status_pasien_id IN 
                        (SELECT status_pasien_id FROM status_pasien WHERE payor_type = pt.payor_type)
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND ea.fullname IS NOT NULL 
                        and clinic_id in (select clinic_id from clinic where stype_id in (1,10) )
                    GROUP BY ea.fullname, pt.payertype
                )

                SELECT * FROM (
                    SELECT * FROM FullnameData
                    UNION ALL
                    SELECT * FROM PayertypeData
                ) AS CombinedData
                ORDER BY fullname ASC, is_fullname_header DESC, payertype ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'pulang' => 0,
                'ranap' => 0,
                'terlayani' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = !empty($rows['payertype'])
                    ? htmlspecialchars($rows['payertype'], ENT_QUOTES, 'UTF-8')
                    : '<b><center>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</center></b>';

                $row[] = $rows['total'];
                $row[] = $rows['pulang'];
                $row[] = $rows['ranap'];
                $row[] = $rows['terlayani'];
                $row[] = $rows['belum_dilayani'];
                $row[] = $rows['batal'];
                $row[] = $rows['belum_konfirmasi'];

                if ((int)$rows['is_fullname_header'] === 1) {
                    $totalKeseluruhan['total'] += (int)$rows['total'];
                    $totalKeseluruhan['pulang'] += (int)$rows['pulang'];
                    $totalKeseluruhan['ranap'] += (int)$rows['ranap'];
                    $totalKeseluruhan['terlayani'] += (int)$rows['terlayani'];
                    $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                    $totalKeseluruhan['batal'] += (int)$rows['batal'];
                    $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];
                }


                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['pulang'],
                $totalKeseluruhan['ranap'],
                $totalKeseluruhan['terlayani'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function rpdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER KLINIK PER DOKTER DAN CARA BAYAR';
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
                        <th class="p-1"  rowspan="2">Penjaminan</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                       <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',

            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function rpdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
           WITH ClinicData AS (
                    -- Data utama per Klinik
                    SELECT 
                        c.name_of_clinic AS clinic_name,
                        NULL AS fullname,
                        NULL AS payertype,
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        0 AS urutan
                    FROM pasien_visitation

                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    WHERE visit_date BETWEEN @mulai AND @akhir  
                        AND c.STYPE_ID = 1
                    GROUP BY c.name_of_clinic
                ),
                FullnameData AS (
                    -- Data fullname per Klinik
                    SELECT 
                        c.name_of_clinic AS clinic_name,
                        COALESCE(ea.fullname, '-') AS fullname,
                        NULL AS payertype,
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        1 AS urutan
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = pasien_visitation.EMPLOYEE_ID
                    WHERE visit_date BETWEEN @mulai AND @akhir  
                        AND c.STYPE_ID = 1
                    GROUP BY c.name_of_clinic, ea.fullname
                    HAVING COUNT(visit_id) > 0 
                ),
                PayertypeData AS (
                    -- Data payertype per Fullname
                    SELECT 
                        c.name_of_clinic AS clinic_name,
                        COALESCE(ea.fullname, '-') AS fullname,
                        COALESCE(pt.payertype, 'TANPA PAYERTYPE') AS payertype, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        2 AS urutan
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = pasien_visitation.EMPLOYEE_ID
                    LEFT JOIN status_pasien sp ON pasien_visitation.status_pasien_id = sp.status_pasien_id
                    LEFT JOIN payor_type pt ON sp.payor_type = pt.payor_type
                    WHERE visit_date BETWEEN @mulai AND @akhir  
                        AND c.STYPE_ID = 1
                    GROUP BY c.name_of_clinic, ea.fullname, pt.payertype
                    HAVING COUNT(visit_id) > 0 
                )

                SELECT 
                    clinic_name,
                    fullname,
                    payertype,
                    total, pulang, ranap, terlayani, belum_dilayani, belum_konfirmasi, batal,urutan
                FROM (
                    SELECT * FROM ClinicData
                    UNION ALL
                    SELECT * FROM FullnameData
                    UNION ALL
                    SELECT * FROM PayertypeData
                ) AS CombinedData
                ORDER BY clinic_name ASC, fullname ASC, urutan ASC;


        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total_row = [
                'total' => 0,
                'pulang' => 0,
                'ranap' => 0,
                'terlayani' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = !empty($rows['payertype'])
                    ? htmlspecialchars($rows['payertype'], ENT_QUOTES, 'UTF-8')
                    : (!empty($rows['fullname'])
                        ? (
                            $rows['urutan'] == 2
                            ? '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>'
                            : ($rows['urutan'] == 1
                                ? '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>'
                                : '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>')
                        )
                        : '<b><center>' . htmlspecialchars($rows['clinic_name'], ENT_QUOTES, 'UTF-8') . '</center></b>'
                    );

                $row[] = $rows['total'];
                $row[] = $rows['pulang'];
                $row[] = $rows['ranap'];
                $row[] = $rows['terlayani'];
                $row[] = $rows['belum_dilayani'];
                $row[] = $rows['batal'];
                $row[] = $rows['belum_konfirmasi'];

                if ((int)$rows['urutan'] === 0) {
                    $total_row['total'] += $rows['total'];
                    $total_row['pulang'] += $rows['pulang'];
                    $total_row['ranap'] += $rows['ranap'];
                    $total_row['terlayani'] += $rows['terlayani'];
                    $total_row['belum_dilayani'] += $rows['belum_dilayani'];
                    $total_row['batal'] += $rows['batal'];
                    $total_row['belum_konfirmasi'] += $rows['belum_konfirmasi'];
                }

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>Total</center></b>',
                $total_row['total'],
                $total_row['pulang'],
                $total_row['ranap'],
                $total_row['terlayani'],
                $total_row['belum_dilayani'],
                $total_row['batal'],
                $total_row['belum_konfirmasi']
            ];
        }

        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }



    public function rvpList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER KLINIK PER DOKTER DAN CARA BAYAR';
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
                        <th class="p-1"  rowspan="2">Penjaminan</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                        <th class="p-1">Pulang</th>
                        <th class="p-1">Ranap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
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


    // Dasboard Rawat Inap
    // =============================================================================

    public function pasienCaraBayarInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER PENJAMIN';
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
                        <th class="p-1">Penjamin</th>
                        <th class="p-1">Jumlah</th>
                        <th class="p-1">Sembuh</th>
                        <th class="p-1">Dirujuk</th>
                        <th class="p-1">Meninggal < 48 Jam</th>
                        <th class="p-1">Meninggal > 48 Jam</th>
                        <th class="p-1">APS</th>
                        <th class="p-1">Lari</th>
                        <th class="p-1">Rawat Jalan</th>
               
                    </tr>
                    
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pasienCaraBayarInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            
           SELECT 
                    SUM(CASE WHEN pv.keluar_id = 1 THEN 1 ELSE 0 END) AS sembuh,
                    SUM(CASE WHEN pv.keluar_id = 2 THEN 1 ELSE 0 END) AS rujuk,
                    SUM(CASE WHEN pv.keluar_id = 3 THEN 1 ELSE 0 END) AS meninggal3,
                    SUM(CASE WHEN pv.keluar_id = 4 THEN 1 ELSE 0 END) AS meninggal4,
                    SUM(CASE WHEN pv.keluar_id = 5 THEN 1 ELSE 0 END) AS aps,
                    SUM(CASE WHEN pv.keluar_id = 6 THEN 1 ELSE 0 END) AS lari,
                    SUM(CASE WHEN pv.keluar_id = 7 THEN 1 ELSE 0 END) AS rj,
                    SUM(CASE WHEN pv.keluar_id = 35 THEN 1 ELSE 0 END) AS prsadmin,
                    p.payertype,
                    CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                    COUNT(pv.visit_id) AS jml
                FROM pv
                LEFT JOIN clinic c 
                    ON pv.class_room_id IN (
                        SELECT class_room_id FROM class_room cr WHERE cr.CLINIC_ID = c.clinic_id
                    )
                LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = pv.EMPLOYEE_inap
                LEFT JOIN payor_type p 
                    ON pv.status_pasien_id IN (
                        SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type
                    )
                WHERE 
                    pv.EXIT_DATE >= DATEADD(HOUR, 0, @mulai) 
                    AND pv.EXIT_DATE < DATEADD(HOUR, 24, @akhir)
                    AND c.stype_id IN (3)
                    AND pv.keluar_id NOT IN (0, 32, 33, 34)
                    AND pv.class_room_id IS NOT NULL
                    AND pv.keluar_id IS NOT NULL
                    AND pv.bed_id IS NOT NULL
                GROUP BY 
                    p.payertype,
                    CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END
                ORDER BY 
                    p.payertype DESC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total = [
                'jml' => 0,
                'sembuh' => 0,
                'rujuk' => 0,
                'meninggal3' => 0,
                'meninggal4' => 0,
                'aps' => 0,
                'lari' => 0,
                'rj' => 0,
                'prsadmin' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['payertype'];
                $row[] = $rows['jml'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['aps'];
                $row[] = $rows['lari'];
                $row[] = $rows['rj'];
                $row[] = $rows['prsadmin'];

                $total['jml'] += (int)$rows['jml'];
                $total['sembuh'] += (int)$rows['sembuh'];
                $total['rujuk'] += (int)$rows['rujuk'];
                $total['meninggal3'] += (int)$rows['meninggal3'];
                $total['meninggal4'] += (int)$rows['meninggal4'];
                $total['aps'] += (int)$rows['aps'];
                $total['lari'] += (int)$rows['lari'];
                $total['rj'] += (int)$rows['rj'];
                $total['prsadmin'] += (int)$rows['prsadmin'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['sembuh'],
                $total['rujuk'],
                $total['meninggal3'],
                $total['meninggal4'],
                $total['aps'],
                $total['lari'],
                $total['rj'],
                $total['prsadmin']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function pperBangsalInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER BANGSAL';
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
                        <th class="p-1">Bangsal</th>
                        <th class="p-1">Jumlah</th>
                        <th class="p-1">Sembuh</th>
                        <th class="p-1">Dirujuk</th>
                        <th class="p-1">Meninggal < 48 Jam</th>
                        <th class="p-1">Meninggal > 48 Jam</th>
                        <th class="p-1">APS</th>
                        <th class="p-1">Lari</th>
                        <th class="p-1">Rawat Jalan</th>
               
                    </tr>
                
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pperBangsalInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            
          SELECT 
                    SUM(CASE WHEN pv.keluar_id = 1 THEN 1 ELSE 0 END) AS sembuh,
                    SUM(CASE WHEN pv.keluar_id = 2 THEN 1 ELSE 0 END) AS rujuk,
                    SUM(CASE WHEN pv.keluar_id = 3 THEN 1 ELSE 0 END) AS meninggal3,
                    SUM(CASE WHEN pv.keluar_id = 4 THEN 1 ELSE 0 END) AS meninggal4,
                    SUM(CASE WHEN pv.keluar_id = 5 THEN 1 ELSE 0 END) AS aps,
                    SUM(CASE WHEN pv.keluar_id = 6 THEN 1 ELSE 0 END) AS lari,
                    SUM(CASE WHEN pv.keluar_id = 7 THEN 1 ELSE 0 END) AS rj,
                    SUM(CASE WHEN pv.keluar_id = 35 THEN 1 ELSE 0 END) AS prsadmin,
                    c.name_of_clinic,
                    CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                    COUNT(pv.visit_id) AS jml
                FROM pv
                LEFT JOIN clinic c 
                    ON pv.class_room_id IN (
                        SELECT class_room_id FROM class_room cr WHERE cr.CLINIC_ID = c.clinic_id
                    )
                LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = pv.EMPLOYEE_inap
                LEFT JOIN payor_type p 
                    ON pv.status_pasien_id IN (
                        SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type
                    )
                WHERE 
                    pv.EXIT_DATE >= DATEADD(HOUR, 0, @mulai) 
                    AND pv.EXIT_DATE < DATEADD(HOUR, 24, @akhir)
                    AND c.stype_id IN (3)
                    AND pv.keluar_id NOT IN (0, 32, 33, 34)
                    AND pv.class_room_id IS NOT NULL
                    AND pv.keluar_id IS NOT NULL
                    AND pv.bed_id IS NOT NULL
                GROUP BY 
                    c.name_of_clinic,
                    CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END
                ORDER BY 
                c.name_of_clinic DESC;


        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total = [
                'jml' => 0,
                'sembuh' => 0,
                'rujuk' => 0,
                'meninggal3' => 0,
                'meninggal4' => 0,
                'aps' => 0,
                'lari' => 0,
                'rj' => 0,
                'prsadmin' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['name_of_clinic'];
                $row[] = $rows['jml'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['aps'];
                $row[] = $rows['lari'];
                $row[] = $rows['rj'];
                $row[] = $rows['prsadmin'];

                $total['jml'] += (int)$rows['jml'];
                $total['sembuh'] += (int)$rows['sembuh'];
                $total['rujuk'] += (int)$rows['rujuk'];
                $total['meninggal3'] += (int)$rows['meninggal3'];
                $total['meninggal4'] += (int)$rows['meninggal4'];
                $total['aps'] += (int)$rows['aps'];
                $total['lari'] += (int)$rows['lari'];
                $total['rj'] += (int)$rows['rj'];
                $total['prsadmin'] += (int)$rows['prsadmin'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['sembuh'],
                $total['rujuk'],
                $total['meninggal3'],
                $total['meninggal4'],
                $total['aps'],
                $total['lari'],
                $total['rj'],
                $total['prsadmin']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function bangsalpayInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER BANGSAL PER PENJAMIN';
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
                        <th class="p-1">Bangsal</th>
                        <th class="p-1">Jumlah</th>
                        <th class="p-1">Sembuh</th>
                        <th class="p-1">Dirujuk</th>
                        <th class="p-1">Meninggal < 48 Jam</th>
                        <th class="p-1">Meninggal > 48 Jam</th>
                        <th class="p-1">APS</th>
                        <th class="p-1">Lari</th>
                        <th class="p-1">Rawat Jalan</th>
               
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function bangsalpayInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
           WITH KlinikGroup AS (
                    SELECT 
                        c.name_of_clinic,
                        p.payertype,
                        CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                        SUM(CASE WHEN pv.keluar_id = 1 THEN 1 ELSE 0 END) AS sembuh,
                        SUM(CASE WHEN pv.keluar_id = 2 THEN 1 ELSE 0 END) AS rujuk,
                        SUM(CASE WHEN pv.keluar_id = 3 THEN 1 ELSE 0 END) AS meninggal3,
                        SUM(CASE WHEN pv.keluar_id = 4 THEN 1 ELSE 0 END) AS meninggal4,
                        SUM(CASE WHEN pv.keluar_id = 5 THEN 1 ELSE 0 END) AS aps,
                        SUM(CASE WHEN pv.keluar_id = 6 THEN 1 ELSE 0 END) AS lari,
                        SUM(CASE WHEN pv.keluar_id = 7 THEN 1 ELSE 0 END) AS rj,
                        SUM(CASE WHEN pv.keluar_id = 35 THEN 1 ELSE 0 END) AS prsadmin,
                        COUNT(pv.visit_id) AS jml
                    FROM pv
                    LEFT JOIN clinic c 
                        ON pv.class_room_id IN (
                            SELECT class_room_id FROM class_room cr WHERE cr.CLINIC_ID = c.clinic_id
                        )
                    LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = pv.EMPLOYEE_inap
                    LEFT JOIN payor_type p 
                        ON pv.status_pasien_id IN (
                            SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type
                        )
                    WHERE 
                        pv.EXIT_DATE >= DATEADD(HOUR, 0, @mulai) 
                        AND pv.EXIT_DATE < DATEADD(HOUR, 24, @akhir)
                        AND c.stype_id IN (3)
                        AND pv.keluar_id NOT IN (0, 32, 33, 34)
                        AND pv.class_room_id IS NOT NULL
                        AND pv.keluar_id IS NOT NULL
                        AND pv.bed_id IS NOT NULL
                    GROUP BY 
                        c.name_of_clinic, p.payertype, CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END
                )

                SELECT 
                    1 AS nomor,
                    name_of_clinic,
                    NULL AS payertype,
                    isrj,
                    SUM(sembuh) AS sembuh,
                    SUM(rujuk) AS rujuk,
                    SUM(meninggal3) AS meninggal3,
                    SUM(meninggal4) AS meninggal4,
                    SUM(aps) AS aps,
                    SUM(lari) AS lari,
                    SUM(rj) AS rj,
                    SUM(prsadmin) AS prsadmin,
                    SUM(jml) AS jml
                FROM KlinikGroup
                GROUP BY name_of_clinic, isrj

                UNION ALL

                SELECT 
                    2 AS nomor,
                    name_of_clinic,
                    payertype,
                    isrj,
                    sembuh,
                    rujuk,
                    meninggal3,
                    meninggal4,
                    aps,
                    lari,
                    rj,
                    prsadmin,
                    jml
                FROM KlinikGroup

                ORDER BY name_of_clinic, nomor ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total = [
                'jml' => 0,
                'sembuh' => 0,
                'rujuk' => 0,
                'meninggal3' => 0,
                'meninggal4' => 0,
                'aps' => 0,
                'lari' => 0,
                'rj' => 0,
                'prsadmin' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $label = $rows['payertype'] ?? '<b>' . $rows['name_of_clinic'] . '</b>';
                $row[] = $label;

                $row[] = $rows['jml'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['aps'];
                $row[] = $rows['lari'];
                $row[] = $rows['rj'];
                $row[] = $rows['prsadmin'];

                if ($rows['nomor'] == 1) {
                    $total['jml'] += (int)$rows['jml'];
                    $total['sembuh'] += (int)$rows['sembuh'];
                    $total['rujuk'] += (int)$rows['rujuk'];
                    $total['meninggal3'] += (int)$rows['meninggal3'];
                    $total['meninggal4'] += (int)$rows['meninggal4'];
                    $total['aps'] += (int)$rows['aps'];
                    $total['lari'] += (int)$rows['lari'];
                    $total['rj'] += (int)$rows['rj'];
                    $total['prsadmin'] += (int)$rows['prsadmin'];
                }
                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['sembuh'],
                $total['rujuk'],
                $total['meninggal3'],
                $total['meninggal4'],
                $total['aps'],
                $total['lari'],
                $total['rj'],
                $total['prsadmin']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppdInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER BANGSAL PER DPJP';
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
        $header = '
                     <tr>
                         <th class="p-1">Bangsal / DPJP</th>
                        <th class="p-1">Jumlah</th>
                        <th class="p-1">Sembuh</th>
                        <th class="p-1">Dirujuk</th>
                        <th class="p-1">Meninggal < 48 Jam</th>
                        <th class="p-1">Meninggal > 48 Jam</th>
                        <th class="p-1">APS</th>
                        <th class="p-1">Lari</th>
                        <th class="p-1">Rawat Jalan</th>
               
                    </tr>
                   
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppdInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
           WITH fullnameGroup AS (
                SELECT 
                    c.name_of_clinic,
                    EA.FULLNAME,
                    KELUAR_ID AS isattended,
                    CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                    SUM(CASE WHEN pv.keluar_id = 1 THEN 1 ELSE 0 END) AS sembuh,
                    SUM(CASE WHEN pv.keluar_id = 2 THEN 1 ELSE 0 END) AS rujuk,
                    SUM(CASE WHEN pv.keluar_id = 3 THEN 1 ELSE 0 END) AS meninggal3,
                    SUM(CASE WHEN pv.keluar_id = 4 THEN 1 ELSE 0 END) AS meninggal4,
                    SUM(CASE WHEN pv.keluar_id = 5 THEN 1 ELSE 0 END) AS aps,
                    SUM(CASE WHEN pv.keluar_id = 6 THEN 1 ELSE 0 END) AS lari,
                    SUM(CASE WHEN pv.keluar_id = 7 THEN 1 ELSE 0 END) AS rj,
                    SUM(CASE WHEN pv.keluar_id = 35 THEN 1 ELSE 0 END) AS prsadmin,
                    COUNT(visit_id) AS jml 
                FROM pv
                LEFT OUTER JOIN clinic c ON pv.class_room_id IN (
                    SELECT class_room_id 
                    FROM class_room cr 
                    WHERE cr.CLINIC_ID = c.clinic_id
                )
                LEFT OUTER JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = pv.EMPLOYEE_inap
                LEFT OUTER JOIN payor_type p ON pv.status_pasien_id IN (
                    SELECT status_pasien_id 
                    FROM status_pasien 
                    WHERE payor_type = p.payor_type
                )
                WHERE pv.EXIT_DATE >= DATEADD(hour, 0, @mulai) 
                AND pv.EXIT_DATE < DATEADD(hour, 24, @akhir)
                AND c.stype_id IN (3) 
                AND keluar_id NOT IN (0, 32, 33, 34)
                AND pv.class_room_id IS NOT NULL
                AND pv.keluar_id IS NOT NULL
                AND pv.bed_id IS NOT NULL
                GROUP BY c.name_of_clinic, EA.FULLNAME, keluar_id, CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END
            )
            SELECT 
                1 AS nomor,
                fullname,
                NULL AS name_of_clinic,
                isrj,
                SUM(sembuh) AS sembuh,
                SUM(rujuk) AS rujuk,
                SUM(meninggal3) AS meninggal3,
                SUM(meninggal4) AS meninggal4,
                SUM(aps) AS aps,
                SUM(lari) AS lari,
                SUM(rj) AS rj,
                SUM(prsadmin) AS prsadmin,
                SUM(jml) AS jml
            FROM fullnameGroup
            GROUP BY fullname, isrj

            UNION ALL

            SELECT 
                2 AS nomor,
                fullname,
                name_of_clinic,
                isrj,
                sembuh,
                rujuk,
                meninggal3,
                meninggal4,
                aps,
                lari,
                rj,
                prsadmin,
                jml
            FROM fullnameGroup

            ORDER BY fullname, nomor ASC;
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total = [
                'jml' => 0,
                'sembuh' => 0,
                'rujuk' => 0,
                'meninggal3' => 0,
                'meninggal4' => 0,
                'aps' => 0,
                'lari' => 0,
                'rj' => 0,
                'prsadmin' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $label = $rows['name_of_clinic'] ?? '<b>' . $rows['fullname'] . '</b>';
                $row[] = $label;

                $row[] = $rows['jml'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['aps'];
                $row[] = $rows['lari'];
                $row[] = $rows['rj'];
                $row[] = $rows['prsadmin'];

                if ($rows['nomor'] == 1) {
                    $total['jml'] += (int)$rows['jml'];
                    $total['sembuh'] += (int)$rows['sembuh'];
                    $total['rujuk'] += (int)$rows['rujuk'];
                    $total['meninggal3'] += (int)$rows['meninggal3'];
                    $total['meninggal4'] += (int)$rows['meninggal4'];
                    $total['aps'] += (int)$rows['aps'];
                    $total['lari'] += (int)$rows['lari'];
                    $total['rj'] += (int)$rows['rj'];
                    $total['prsadmin'] += (int)$rows['prsadmin'];
                }
                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['sembuh'],
                $total['rujuk'],
                $total['meninggal3'],
                $total['meninggal4'],
                $total['aps'],
                $total['lari'],
                $total['rj'],
                $total['prsadmin']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function dppInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER DPJP PER BAYAR';
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
        $header = '
                        <tr>
                            <th class="p-1">Bangsal / DPJP</th>
                        <th class="p-1">Jumlah</th>
                        <th class="p-1">Sembuh</th>
                        <th class="p-1">Dirujuk</th>
                        <th class="p-1">Meninggal < 48 Jam</th>
                        <th class="p-1">Meninggal > 48 Jam</th>
                        <th class="p-1">APS</th>
                        <th class="p-1">Lari</th>
                        <th class="p-1">Rawat Jalan</th>
                
                    </tr>
                    
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function dppInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
           WITH fullnameGroup AS (
                SELECT 
                    p.payertype,
                    EA.FULLNAME,
                    KELUAR_ID AS isattended,
                    CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                    SUM(CASE WHEN pv.keluar_id = 1 THEN 1 ELSE 0 END) AS sembuh,
                    SUM(CASE WHEN pv.keluar_id = 2 THEN 1 ELSE 0 END) AS rujuk,
                    SUM(CASE WHEN pv.keluar_id = 3 THEN 1 ELSE 0 END) AS meninggal3,
                    SUM(CASE WHEN pv.keluar_id = 4 THEN 1 ELSE 0 END) AS meninggal4,
                    SUM(CASE WHEN pv.keluar_id = 5 THEN 1 ELSE 0 END) AS aps,
                    SUM(CASE WHEN pv.keluar_id = 6 THEN 1 ELSE 0 END) AS lari,
                    SUM(CASE WHEN pv.keluar_id = 7 THEN 1 ELSE 0 END) AS rj,
                    SUM(CASE WHEN pv.keluar_id = 35 THEN 1 ELSE 0 END) AS prsadmin,
                    COUNT(visit_id) AS jml 
                FROM pv
                LEFT OUTER JOIN clinic c ON pv.class_room_id IN (
                    SELECT class_room_id 
                    FROM class_room cr 
                    WHERE cr.CLINIC_ID = c.clinic_id
                )
                LEFT OUTER JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = pv.EMPLOYEE_inap
                LEFT OUTER JOIN payor_type p ON pv.status_pasien_id IN (
                    SELECT status_pasien_id 
                    FROM status_pasien 
                    WHERE payor_type = p.payor_type
                )
                WHERE pv.EXIT_DATE >= DATEADD(hour, 0, @mulai) 
                AND pv.EXIT_DATE < DATEADD(hour, 24, @akhir)
                AND c.stype_id IN (3) 
                AND keluar_id NOT IN (0, 32, 33, 34)
                AND pv.class_room_id IS NOT NULL
                AND pv.keluar_id IS NOT NULL
                AND pv.bed_id IS NOT NULL
                GROUP BY p.payertype, EA.FULLNAME, keluar_id, CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END
            )
            SELECT 
                1 AS nomor,
                fullname,
                NULL AS payertype,
                isrj,
                SUM(sembuh) AS sembuh,
                SUM(rujuk) AS rujuk,
                SUM(meninggal3) AS meninggal3,
                SUM(meninggal4) AS meninggal4,
                SUM(aps) AS aps,
                SUM(lari) AS lari,
                SUM(rj) AS rj,
                SUM(prsadmin) AS prsadmin,
                SUM(jml) AS jml
            FROM fullnameGroup
            GROUP BY fullname, isrj

            UNION ALL

            SELECT 
                2 AS nomor,
                fullname,
                payertype,
                isrj,
                sembuh,
                rujuk,
                meninggal3,
                meninggal4,
                aps,
                lari,
                rj,
                prsadmin,
                jml
            FROM fullnameGroup

            ORDER BY fullname, nomor ASC;


        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total = [
                'jml' => 0,
                'sembuh' => 0,
                'rujuk' => 0,
                'meninggal3' => 0,
                'meninggal4' => 0,
                'aps' => 0,
                'lari' => 0,
                'rj' => 0,
                'prsadmin' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $label = $rows['payertype'] ?? '<b>' . $rows['fullname'] . '</b>';
                $row[] = $label;

                $row[] = $rows['jml'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['aps'];
                $row[] = $rows['lari'];
                $row[] = $rows['rj'];
                $row[] = $rows['prsadmin'];

                if ($rows['nomor'] == 1) {
                    $total['jml'] += (int)$rows['jml'];
                    $total['sembuh'] += (int)$rows['sembuh'];
                    $total['rujuk'] += (int)$rows['rujuk'];
                    $total['meninggal3'] += (int)$rows['meninggal3'];
                    $total['meninggal4'] += (int)$rows['meninggal4'];
                    $total['aps'] += (int)$rows['aps'];
                    $total['lari'] += (int)$rows['lari'];
                    $total['rj'] += (int)$rows['rj'];
                    $total['prsadmin'] += (int)$rows['prsadmin'];
                }
                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['sembuh'],
                $total['rujuk'],
                $total['meninggal3'],
                $total['meninggal4'],
                $total['aps'],
                $total['lari'],
                $total['rj'],
                $total['prsadmin']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function rpdInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER BANGSAL PER DPJP PER BAYAR';
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
        $header = '
                    <tr>
                        <th class="p-1">Bangsal / DPJP</th>
                    <th class="p-1">Jumlah</th>
                    <th class="p-1">Sembuh</th>
                    <th class="p-1">Dirujuk</th>
                    <th class="p-1">Meninggal < 48 Jam</th>
                    <th class="p-1">Meninggal > 48 Jam</th>
                    <th class="p-1">APS</th>
                    <th class="p-1">Lari</th>
                    <th class="p-1">Rawat Jalan</th>

                </tr>
                
            ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function rpdInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
          WITH fullnameGroup AS (
                    SELECT 
                        p.payertype,
                        EA.FULLNAME,
                        c.name_of_clinic,
                        CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                        SUM(CASE WHEN pv.keluar_id = 1 THEN 1 ELSE 0 END) AS sembuh,
                        SUM(CASE WHEN pv.keluar_id = 2 THEN 1 ELSE 0 END) AS rujuk,
                        SUM(CASE WHEN pv.keluar_id = 3 THEN 1 ELSE 0 END) AS meninggal3,
                        SUM(CASE WHEN pv.keluar_id = 4 THEN 1 ELSE 0 END) AS meninggal4,
                        SUM(CASE WHEN pv.keluar_id = 5 THEN 1 ELSE 0 END) AS aps,
                        SUM(CASE WHEN pv.keluar_id = 6 THEN 1 ELSE 0 END) AS lari,
                        SUM(CASE WHEN pv.keluar_id = 7 THEN 1 ELSE 0 END) AS rj,
                        SUM(CASE WHEN pv.keluar_id = 35 THEN 1 ELSE 0 END) AS prsadmin,
                        COUNT(visit_id) AS jml 
                    FROM pv
                    LEFT JOIN clinic c ON pv.class_room_id IN (
                        SELECT class_room_id 
                        FROM class_room cr 
                        WHERE cr.CLINIC_ID = c.clinic_id
                    )
                    LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = pv.EMPLOYEE_inap
                    LEFT JOIN payor_type p ON pv.status_pasien_id IN (
                        SELECT status_pasien_id 
                        FROM status_pasien 
                        WHERE payor_type = p.payor_type
                    )
                    WHERE pv.EXIT_DATE >= @mulai 
                        AND pv.EXIT_DATE <= @akhir
                        AND c.stype_id IN (3) 
                        AND keluar_id NOT IN (0, 32, 33, 34)
                        AND pv.class_room_id IS NOT NULL
                        AND pv.keluar_id IS NOT NULL
                        AND pv.bed_id IS NOT NULL
                    GROUP BY p.payertype, EA.FULLNAME, c.name_of_clinic, 
                            CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END
                ),

                detailPerPayertype AS (
                    SELECT 
                        3 AS nomor,
                        name_of_clinic,
                        FULLNAME,
                        payertype,
                        isrj,
                        sembuh,
                        rujuk,
                        meninggal3,
                        meninggal4,
                        aps,
                        lari,
                        rj,
                        prsadmin,
                        jml
                    FROM fullnameGroup
                ),

                rekapPerFullname AS (
                    SELECT 
                        2 AS nomor,
                        name_of_clinic,
                        FULLNAME,
                        NULL AS payertype,
                        isrj,
                        SUM(sembuh) AS sembuh,
                        SUM(rujuk) AS rujuk,
                        SUM(meninggal3) AS meninggal3,
                        SUM(meninggal4) AS meninggal4,
                        SUM(aps) AS aps,
                        SUM(lari) AS lari,
                        SUM(rj) AS rj,
                        SUM(prsadmin) AS prsadmin,
                        SUM(jml) AS jml
                    FROM detailPerPayertype
                    GROUP BY name_of_clinic, FULLNAME, isrj
                )

                SELECT 
                    1 AS nomor,
                    name_of_clinic,
                    NULL AS FULLNAME,
                    NULL AS payertype,
                    isrj,
                    SUM(sembuh) AS sembuh,
                    SUM(rujuk) AS rujuk,
                    SUM(meninggal3) AS meninggal3,
                    SUM(meninggal4) AS meninggal4,
                    SUM(aps) AS aps,
                    SUM(lari) AS lari,
                    SUM(rj) AS rj,
                    SUM(prsadmin) AS prsadmin,
                    SUM(jml) AS jml
                FROM fullnameGroup
                GROUP BY name_of_clinic, isrj

                UNION ALL

                SELECT * FROM rekapPerFullname

                UNION ALL

                SELECT * FROM detailPerPayertype

                ORDER BY name_of_clinic, fullname, payertype, nomor;


        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total = [
                'jml' => 0,
                'sembuh' => 0,
                'rujuk' => 0,
                'meninggal3' => 0,
                'meninggal4' => 0,
                'aps' => 0,
                'lari' => 0,
                'rj' => 0,
                'prsadmin' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                if ($rows['nomor'] == 1) {
                    $label =  '<b><center>' . $rows['name_of_clinic'] . '<center></b>';
                } else  if ($rows['nomor'] == 2) {
                    $label =  '<b>' . $rows['fullname'] . '</b>';
                } else {
                    $label = $rows['payertype'] ?? '<b>' . $rows['fullname'] . '</b>';
                }


                $row[] = $label;

                $row[] = $rows['jml'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['aps'];
                $row[] = $rows['lari'];
                $row[] = $rows['rj'];
                $row[] = $rows['prsadmin'];

                if ($rows['nomor'] == 1) {
                    $total['jml'] += (int)$rows['jml'];
                    $total['sembuh'] += (int)$rows['sembuh'];
                    $total['rujuk'] += (int)$rows['rujuk'];
                    $total['meninggal3'] += (int)$rows['meninggal3'];
                    $total['meninggal4'] += (int)$rows['meninggal4'];
                    $total['aps'] += (int)$rows['aps'];
                    $total['lari'] += (int)$rows['lari'];
                    $total['rj'] += (int)$rows['rj'];
                    $total['prsadmin'] += (int)$rows['prsadmin'];
                }
                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['sembuh'],
                $total['rujuk'],
                $total['meninggal3'],
                $total['meninggal4'],
                $total['aps'],
                $total['lari'],
                $total['rj'],
                $total['prsadmin']
            ];
        }

        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppjkInapList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PULANG PER BANGSAL';
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
                        <th class="p-1" rowspan="2">Bangsal</th>
                        <th class="p-1" colspan="3">Jumlah</th>
                        <th class="p-1" colspan="3">Sembuh</th>
                        <th class="p-1" colspan="3">Dirujuk</th>
                        <th class="p-1" colspan="3">Meninggal < 48 Jam</th>
                        <th class="p-1" colspan="3">Meninggal > 48 Jam</th>
                        <th class="p-1" colspan="3">APS</th>
                        <th class="p-1" colspan="3">Lari</th>
                        <th class="p-1" colspan="3">Rawat Jalan</th>
                        <th class="p-1" colspan="3">Proses Adminitrasi</th>
                    </tr>
                    <tr>
                         <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                         <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                          <th class="p-1">Total</th>
                        <th class="p-1">Lk</th>
                        <th class="p-1">Pr</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppjkInapListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect();
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';

        WITH KlinikGroup AS (
                SELECT 
                    c.name_of_clinic,
                    CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                    SUM(CASE WHEN pv.keluar_id = 1 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS sembuhLK,
                    SUM(CASE WHEN pv.keluar_id = 1 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS sembuhPR,
                    SUM(CASE WHEN pv.keluar_id = 2 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS rujukLK,
                    SUM(CASE WHEN pv.keluar_id = 2 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS rujukPR,
                    SUM(CASE WHEN pv.keluar_id = 3 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS meninggal3LK,
                    SUM(CASE WHEN pv.keluar_id = 3 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS meninggal3PR,
                    SUM(CASE WHEN pv.keluar_id = 4 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS meninggal4LK,
                    SUM(CASE WHEN pv.keluar_id = 4 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS meninggal4PR,
                    SUM(CASE WHEN pv.keluar_id = 5 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS apsLK,
                    SUM(CASE WHEN pv.keluar_id = 5 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS apsPR,
                    SUM(CASE WHEN pv.keluar_id = 6 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS lariLK,
                    SUM(CASE WHEN pv.keluar_id = 6 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS lariPR,
                    SUM(CASE WHEN pv.keluar_id = 7 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS rjLK,
                    SUM(CASE WHEN pv.keluar_id = 7 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS rjPR,
                    SUM(CASE WHEN pv.keluar_id = 35 AND ISNULL(pv.gender,1) = 1 THEN 1 ELSE 0 END) AS prsadminLK,
                    SUM(CASE WHEN pv.keluar_id = 35 AND ISNULL(pv.gender,1) = 2 THEN 1 ELSE 0 END) AS prsadminPR,
                    COUNT(CASE WHEN pv.gender = 1 THEN 1 END) AS jmlLK,
                    COUNT(CASE WHEN pv.gender = 2 THEN 1 END) AS jmlPR
                FROM pv
                LEFT JOIN clinic c 
                    ON pv.class_room_id IN (
                        SELECT class_room_id FROM class_room cr WHERE cr.CLINIC_ID = c.clinic_id
                    )
                WHERE 
                    pv.EXIT_DATE >= DATEADD(HOUR, 0, @mulai) 
                    AND pv.EXIT_DATE < DATEADD(HOUR, 24, @akhir)
                    AND c.stype_id IN (3)
                    AND pv.keluar_id NOT IN (0, 32, 33, 34)
                    AND pv.class_room_id IS NOT NULL
                    AND pv.keluar_id IS NOT NULL
                    AND pv.bed_id IS NOT NULL
                GROUP BY 
                    c.name_of_clinic, CASE WHEN pv.class_room_id IS NULL THEN 1 ELSE 0 END
            )

            SELECT 
                1 AS nomor,
                name_of_clinic,
                isrj,
                sembuhLK,
                sembuhPR,
                (sembuhLK + sembuhPR) AS sembuh,
                rujukLK,
                rujukPR,
                (rujukLK + rujukPR) AS rujuk,
                meninggal3LK,
                meninggal3PR,
                (meninggal3LK + meninggal3PR) AS meninggal3,
                meninggal4LK,
                meninggal4PR,
                (meninggal4LK + meninggal4PR) AS meninggal4,
                apsLK,
                apsPR,
                (apsLK + apsPR) AS aps,
                lariLK,
                lariPR,
                (lariLK + lariPR) AS lari,
                rjLK,
                rjPR,
                (rjLK + rjPR) AS rj,
                prsadminLK,
                prsadminPR,
                (prsadminLK + prsadminPR) AS prsadmin,
                jmlLK ,
                jmlPR,
                (jmlLK + jmlPR) AS jml
            FROM KlinikGroup
            ORDER BY name_of_clinic, nomor ASC;
        ")->getResultArray());

        $dt_data = [];
        $total = [
            'jml' => 0,
            'jmlLK' => 0,
            'jmlPR' => 0,
            'sembuh' => 0,
            'sembuhLK' => 0,
            'sembuhPR' => 0,
            'rujuk' => 0,
            'rujukLK' => 0,
            'rujukPR' => 0,
            'meninggal3' => 0,
            'meninggal3LK' => 0,
            'meninggal3PR' => 0,
            'meninggal4' => 0,
            'meninggal4LK' => 0,
            'meninggal4PR' => 0,
            'aps' => 0,
            'apsLK' => 0,
            'apsPR' => 0,
            'lari' => 0,
            'lariLK' => 0,
            'lariPR' => 0,
            'rj' => 0,
            'rjLK' => 0,
            'rjPR' => 0,
            'prsadmin' => 0,
            'prsadminLK' => 0,
            'prsadminPR' => 0
        ];

        if (!empty($data)) {
            foreach ($data as $rows) {
                $row = [];
                $label =  '<b><center>' . $rows['name_of_clinic'] . '<center></b>';
                $row[] = $label;

                $row[] = $rows['jml'];
                $row[] = $rows['jmllk'];
                $row[] = $rows['jmlpr'];
                $row[] = $rows['sembuh'];
                $row[] = $rows['sembuhlk'];
                $row[] = $rows['sembuhpr'];
                $row[] = $rows['rujuk'];
                $row[] = $rows['rujuklk'];
                $row[] = $rows['rujukpr'];
                $row[] = $rows['meninggal3'];
                $row[] = $rows['meninggal3lk'];
                $row[] = $rows['meninggal3pr'];
                $row[] = $rows['meninggal4'];
                $row[] = $rows['meninggal4lk'];
                $row[] = $rows['meninggal4pr'];
                $row[] = $rows['aps'];
                $row[] = $rows['apslk'];
                $row[] = $rows['apspr'];
                $row[] = $rows['lari'];
                $row[] = $rows['larilk'];
                $row[] = $rows['laripr'];
                $row[] = $rows['rj'];
                $row[] = $rows['rjlk'];
                $row[] = $rows['rjpr'];
                $row[] = $rows['prsadmin'];
                $row[] = $rows['prsadminlk'];
                $row[] = $rows['prsadminpr'];

                $total['jml'] += (int)$rows['jml'];
                $total['jmlLK'] += (int)$rows['jmllk'];
                $total['jmlPR'] += (int)$rows['jmlpr'];
                $total['sembuh'] += (int)$rows['sembuh'];
                $total['sembuhLK'] += (int)$rows['sembuhlk'];
                $total['sembuhPR'] += (int)$rows['sembuhpr'];
                $total['rujuk'] += (int)$rows['rujuk'];
                $total['rujukLK'] += (int)$rows['rujuklk'];
                $total['rujukPR'] += (int)$rows['rujukpr'];
                $total['meninggal3'] += (int)$rows['meninggal3'];
                $total['meninggal3LK'] += (int)$rows['meninggal3lk'];
                $total['meninggal3PR'] += (int)$rows['meninggal3pr'];
                $total['meninggal4'] += (int)$rows['meninggal4'];
                $total['meninggal4LK'] += (int)$rows['meninggal4lk'];
                $total['meninggal4PR'] += (int)$rows['meninggal4pr'];
                $total['aps'] += (int)$rows['aps'];
                $total['apsLK'] += (int)$rows['apslk'];
                $total['apsPR'] += (int)$rows['apspr'];
                $total['lari'] += (int)$rows['lari'];
                $total['lariLK'] += (int)$rows['larilk'];
                $total['lariPR'] += (int)$rows['laripr'];
                $total['rj'] += (int)$rows['rj'];
                $total['rjLK'] += (int)$rows['rjlk'];
                $total['rjPR'] += (int)$rows['rjpr'];
                $total['prsadmin'] += (int)$rows['prsadmin'];
                $total['prsadminLK'] += (int)$rows['prsadminlk'];
                $total['prsadminPR'] += (int)$rows['prsadminpr'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $total['jml'],
                $total['jmlLK'],
                $total['jmlPR'],
                $total['sembuh'],
                $total['sembuhLK'],
                $total['sembuhPR'],
                $total['rujuk'],
                $total['rujukLK'],
                $total['rujukPR'],
                $total['meninggal3'],
                $total['meninggal3LK'],
                $total['meninggal3PR'],
                $total['meninggal4'],
                $total['meninggal4LK'],
                $total['meninggal4PR'],
                $total['aps'],
                $total['apsLK'],
                $total['apsPR'],
                $total['lari'],
                $total['lariLK'],
                $total['lariPR'],
                $total['rj'],
                $total['rjLK'],
                $total['rjPR'],
                $total['prsadmin'],
                $total['prsadminLK'],
                $total['prsadminPR']
            ];
        }

        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    // Dasboard IGD
    // =============================================================================

    public function pjbigdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER PENJAMIN';
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
                        <th class="p-1"  rowspan="2">Penjamin</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                        <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pjbigdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            SELECT 
                    ISNULL(p.payertype, 'PENJAMIN LAIN-LAIN') AS PAYERTYPE,
                    COUNT(visit_id) AS total, 
                    SUM(CASE WHEN class_room_id IS NULL and isattended = 1 THEN 1 else 0 END) AS isrj, 
                    SUM(CASE WHEN class_room_id IS NOT NULL and isattended = 1  THEN 1  else 0 END) AS isranap, 
                    SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                    SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi 
                FROM pasien_visitation
                LEFT JOIN payor_type p ON pasien_visitation.status_pasien_id IN 
                    (SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type)
                WHERE 
                    visit_date BETWEEN @mulai AND @akhir  
                    AND CLINIC_ID IN ('P012')
                GROUP BY 
                    ISNULL(p.payertype, 'PENJAMIN LAIN-LAIN')
                ORDER BY 
                 PAYERTYPE DESC;
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'isrj' => 0,
                'isranap' => 0,
                'isrj_isranap' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['payertype'];
                $row[] = $rows['total'];
                $row[] = $rows['isrj'];
                $row[] = $rows['isranap'];
                $row[] = $rows['isrj'] + $rows['isranap'];
                $row[] = $rows['belum_dilayani'];
                $row[] = 0;
                $row[] = $rows['belum_konfirmasi'];

                $totalKeseluruhan['total'] += (int)$rows['total'];
                $totalKeseluruhan['isrj'] += (int)$rows['isrj'];
                $totalKeseluruhan['isranap'] += (int)$rows['isranap'];
                $totalKeseluruhan['isrj_isranap'] += (int)$rows['isrj'] + (int)$rows['isranap'];
                $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                $totalKeseluruhan['batal'] += 0;
                $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['isrj'],
                $totalKeseluruhan['isranap'],
                $totalKeseluruhan['isrj_isranap'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function ppkigdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER KLINIK';
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
                        <th class="p-1"  rowspan="2">Poliklinik</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                            <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppkigdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            SELECT 
                        c.name_of_clinic,
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL and isattended = 1 THEN 1 else 0 END) AS isrj, 
                        SUM(CASE WHEN class_room_id IS NOT NULL and isattended = 1  THEN 1  else 0 END) AS isranap, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi 
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN payor_type p ON pasien_visitation.status_pasien_id IN 
                        (SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type)
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND c.clinic_id IN ('P012')
                    GROUP BY 
                        c.name_of_clinic
                    ORDER BY
                        c.name_of_clinic ASC

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'isrj' => 0,
                'isranap' => 0,
                'isrj_isranap' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['name_of_clinic'];
                $row[] = $rows['total'];
                $row[] = $rows['isrj'];
                $row[] = $rows['isranap'];
                $row[] = $rows['isrj'] + $rows['isranap'];
                $row[] = $rows['belum_dilayani'];
                $row[] = 0;
                $row[] = $rows['belum_konfirmasi'];

                $totalKeseluruhan['total'] += (int)$rows['total'];
                $totalKeseluruhan['isrj'] += (int)$rows['isrj'];
                $totalKeseluruhan['isranap'] += (int)$rows['isranap'];
                $totalKeseluruhan['isrj_isranap'] += (int)$rows['isrj'] + (int)$rows['isranap'];
                $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                $totalKeseluruhan['batal'] += 0;
                $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['isrj'],
                $totalKeseluruhan['isranap'],
                $totalKeseluruhan['isrj_isranap'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function pkbigdList()
    {
        $giTipe = 7;
        $title = 'DATA PENGUNJUNG IRD';
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
                        <th class="p-1"  >Pelayanan</th>
                        <th class="p-1" >Umum</th>
                        <th class="p-1" >BPJS</th>
                        <th class="p-1" >Asuransi</th>
                        <th class="p-1" >Kerjasama</th>
                        <th class="p-1" >Lainnya</th>
                        <th class="p-1" >Jumlah</th>
                    </tr>
                   

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pkbigdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            SELECT 
                C.NAME_OF_CLINIC,
                COUNT(visit_id) AS total_pasien,
                SUM(CASE WHEN COALESCE(p.payor_type, 0) = 2 THEN 1 ELSE 0 END) AS bpjs, 
                SUM(CASE WHEN COALESCE(p.payor_type, 0) = 1 THEN 1 ELSE 0 END) AS umum, 
                SUM(CASE WHEN COALESCE(p.payor_type, 0) = 4 THEN 1 ELSE 0 END) AS asuransi,
				SUM(CASE WHEN COALESCE(p.payor_type, 0) = 3 THEN 1 ELSE 0 END) AS kerjasama,
                SUM(CASE WHEN COALESCE(p.payor_type, 0) NOT IN (1,2,4) THEN 1 ELSE 0 END) AS lainnya
            FROM pasien_visitation 
            LEFT JOIN CLINIC C ON C.CLINIC_ID = pasien_visitation.CLINIC_ID
            LEFT JOIN payor_type p ON pasien_visitation.status_pasien_id IN 
                (SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type)
            WHERE 
                visit_date BETWEEN @mulai AND @akhir
                AND C.CLINIC_ID IN ('P012')
            GROUP BY 
                C.NAME_OF_CLINIC
            ORDER BY 
                C.NAME_OF_CLINIC ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'umum' => 0,
                'bpjs' => 0,
                'asuransi' => 0,
                'kerjasama' => 0,
                'lainnya' => 0,
                'total' => 0

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['name_of_clinic'];
                $row[] = $rows['umum'];
                $row[] = $rows['bpjs'];
                $row[] = $rows['asuransi'];
                $row[] = $rows['kerjasama'];
                $row[] = $rows['lainnya'];
                $row[] = $rows['umum'] + $rows['bpjs'] + $rows['asuransi'] + $rows['kerjasama'] + $rows['lainnya'];

                $totalKeseluruhan['umum'] += (int)$rows['umum'];
                $totalKeseluruhan['bpjs'] += (int)$rows['bpjs'];
                $totalKeseluruhan['asuransi'] += (int)$rows['asuransi'];
                $totalKeseluruhan['kerjasama'] += (int)$rows['kerjasama'];
                $totalKeseluruhan['lainnya'] += (int)$rows['lainnya'];
                $totalKeseluruhan['total'] += (int)$rows['umum'] + (int)$rows['bpjs'] + (int)$rows['asuransi'] + (int)$rows['kerjasama'] + (int)$rows['lainnya'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['umum'],
                $totalKeseluruhan['bpjs'],
                $totalKeseluruhan['asuransi'],
                $totalKeseluruhan['kerjasama'],
                $totalKeseluruhan['lainnya'],
                $totalKeseluruhan['total']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppdigdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN IRD PER DOKTER';
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
                        <th class="p-1"  rowspan="2">Poliklinik-Dokter</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                           <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppdigdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
             WITH ClinicData AS (
                    SELECT 
                        c.name_of_clinic,
                        '' AS fullname, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        1 AS is_clinic_header
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                         AND c.CLINIC_ID IN ('P012')
                     -- AND stype_id in (1,10)
                    GROUP BY c.name_of_clinic
                ),
                DoctorData AS (
                    SELECT 
                        c.name_of_clinic,
                        COALESCE(ea.fullname, '-') AS fullname, -- Nama dokter
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        0 AS is_clinic_header
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND c.clinic_id IN ('P012')
                        --AND stype_id in (1,10)
                    GROUP BY c.name_of_clinic, ea.fullname
                )

                SELECT * FROM (
                    SELECT * FROM ClinicData
                    UNION ALL
                    SELECT * FROM DoctorData
                ) AS CombinedData
                ORDER BY name_of_clinic ASC, is_clinic_header DESC, fullname ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'pulang' => 0,
                'ranap' => 0,
                'terlayani' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = !empty($rows['fullname'])
                    ? htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8')
                    : '<b><center>' . htmlspecialchars($rows['name_of_clinic'], ENT_QUOTES, 'UTF-8') . '</center></b>';

                $row[] = $rows['total'];
                $row[] = $rows['pulang'];
                $row[] = $rows['ranap'];
                $row[] = $rows['terlayani'];
                $row[] = $rows['belum_dilayani'];
                $row[] = $rows['batal'];
                $row[] = $rows['belum_konfirmasi'];

                if ((int)$rows['is_clinic_header'] === 1) {
                    $totalKeseluruhan['total'] += (int)$rows['total'];
                    $totalKeseluruhan['pulang'] += (int)$rows['pulang'];
                    $totalKeseluruhan['ranap'] += (int)$rows['ranap'];
                    $totalKeseluruhan['terlayani'] += (int)$rows['terlayani'];
                    $totalKeseluruhan['belum_dilayani'] += (int)$rows['belum_dilayani'];
                    $totalKeseluruhan['batal'] += (int)$rows['batal'];
                    $totalKeseluruhan['belum_konfirmasi'] += (int)$rows['belum_konfirmasi'];
                }

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['pulang'],
                $totalKeseluruhan['ranap'],
                $totalKeseluruhan['terlayani'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function dppigdList()
    {
        $giTipe = 7;
        $title = 'DATA PASIEN DOKTER PER PENJAMIN';
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
                        <th class="p-1"  rowspan="2">Penjaminan</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                          <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function dppigdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
            WITH FullnameData AS (
                    SELECT 
                        ea.fullname, 
                        '' AS payertype, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        1 AS is_fullname_header
                    FROM pasien_visitation
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND ea.fullname IS NOT NULL 
                        and clinic_id in ('P012')
                    GROUP BY ea.fullname
                ),
                PayertypeData AS (
                    SELECT 
                        ea.fullname, -- Nama dokter
                        COALESCE(pt.payertype, '-') AS payertype, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        0 AS is_fullname_header
                    FROM pasien_visitation
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    LEFT JOIN payor_type pt ON pasien_visitation.status_pasien_id IN 
                        (SELECT status_pasien_id FROM status_pasien WHERE payor_type = pt.payor_type)
                    WHERE 
                        visit_date BETWEEN @mulai AND @akhir  
                        AND ea.fullname IS NOT NULL 
                        and clinic_id in ('P012')
                    GROUP BY ea.fullname, pt.payertype
                )

                SELECT * FROM (
                    SELECT * FROM FullnameData
                    UNION ALL
                    SELECT * FROM PayertypeData
                ) AS CombinedData
                ORDER BY fullname ASC, is_fullname_header DESC, payertype ASC;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'pulang' => 0,
                'ranap' => 0,
                'terlayani' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = (!empty($rows['payertype']) && $rows['payertype'] !== '-')
                    ? htmlspecialchars($rows['payertype'], ENT_QUOTES, 'UTF-8')
                    : ((isset($rows['is_fullname_header']) && $rows['is_fullname_header'] == 1)
                        ? '<b><center>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</center></b>'
                        : '');

                $row[] = $rows['total'];
                $row[] = $rows['pulang'];
                $row[] = $rows['ranap'];
                $row[] = $rows['terlayani'];
                $row[] = $rows['belum_dilayani'];
                $row[] = $rows['batal'];
                $row[] = $rows['belum_konfirmasi'];

                if ((int)$rows['is_fullname_header'] === 1) {
                    $totalKeseluruhan['total'] += $rows['total'];
                    $totalKeseluruhan['pulang'] += $rows['pulang'];
                    $totalKeseluruhan['ranap'] += $rows['ranap'];
                    $totalKeseluruhan['terlayani'] += $rows['terlayani'];
                    $totalKeseluruhan['belum_dilayani'] += $rows['belum_dilayani'];
                    $totalKeseluruhan['batal'] += $rows['batal'];
                    $totalKeseluruhan['belum_konfirmasi'] += $rows['belum_konfirmasi'];
                }

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['pulang'],
                $totalKeseluruhan['ranap'],
                $totalKeseluruhan['terlayani'],
                $totalKeseluruhan['belum_dilayani'],
                $totalKeseluruhan['batal'],
                $totalKeseluruhan['belum_konfirmasi']
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function rpdigdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN IRD PER DOKTER DAN CARA BAYAR';
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
                        <th class="p-1"  rowspan="2">Penjaminan</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                         <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function rpdigdListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = '$mulai 00:00:00';
            SET @akhir = '$akhir 23:59:59';
    
         WITH ClinicData AS (
                    -- Data utama per Klinik
                    SELECT 
                        c.name_of_clinic AS clinic_name,
                        NULL AS fullname,
                        NULL AS payertype,
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        0 AS urutan
                    FROM pasien_visitation

                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    WHERE visit_date BETWEEN @mulai AND @akhir  
                        AND c.CLINIC_ID IN ('P012')
                    GROUP BY c.name_of_clinic
                ),
                FullnameData AS (
                    -- Data fullname per Klinik
                    SELECT 
                        c.name_of_clinic AS clinic_name,
                        COALESCE(ea.fullname, '-') AS fullname,
                        NULL AS payertype,
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        1 AS urutan
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = pasien_visitation.EMPLOYEE_ID
                    WHERE visit_date BETWEEN @mulai AND @akhir  
                       AND c.CLINIC_ID IN ('P012')
                    GROUP BY c.name_of_clinic, ea.fullname
                    HAVING COUNT(visit_id) > 0 
                ),
                PayertypeData AS (
                    -- Data payertype per Fullname
                    SELECT 
                        c.name_of_clinic AS clinic_name,
                        COALESCE(ea.fullname, '-') AS fullname,
                        COALESCE(pt.payertype, '') AS payertype, 
                        COUNT(visit_id) AS total, 
                        SUM(CASE WHEN class_room_id IS NULL AND isattended = 1 THEN 1 ELSE 0 END) AS pulang, 
                        SUM(CASE WHEN class_room_id IS NOT NULL AND isattended = 1 THEN 1 ELSE 0 END) AS ranap, 
                        SUM(CASE WHEN isattended = 1 THEN 1 ELSE 0 END) AS terlayani, 
                        SUM(CASE WHEN isattended = 0 THEN 1 ELSE 0 END) AS belum_dilayani, 
                        SUM(CASE WHEN isattended IN (8,9) THEN 1 ELSE 0 END) AS belum_konfirmasi, 
                        0 AS batal,
                        2 AS urutan
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL ea ON ea.EMPLOYEE_ID = pasien_visitation.EMPLOYEE_ID
                    LEFT JOIN status_pasien sp ON pasien_visitation.status_pasien_id = sp.status_pasien_id
                    LEFT JOIN payor_type pt ON sp.payor_type = pt.payor_type
                    WHERE visit_date BETWEEN @mulai AND @akhir  
                      AND c.CLINIC_ID IN ('P012')
                    GROUP BY c.name_of_clinic, ea.fullname, pt.payertype
                    HAVING COUNT(visit_id) > 0 
                )

                SELECT 
                    clinic_name,
                    fullname,
                    payertype,
                    total, pulang, ranap, terlayani, belum_dilayani, belum_konfirmasi, batal,urutan
                FROM (
                    SELECT * FROM ClinicData
                    UNION ALL
                    SELECT * FROM FullnameData
                    UNION ALL
                    SELECT * FROM PayertypeData
                ) AS CombinedData
                ORDER BY clinic_name ASC, fullname ASC, urutan ASC;


        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $total_row = [
                'total' => 0,
                'pulang' => 0,
                'ranap' => 0,
                'terlayani' => 0,
                'belum_dilayani' => 0,
                'batal' => 0,
                'belum_konfirmasi' => 0
            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = isset($rows['payertype']) && $rows['payertype'] !== null
                    ? htmlspecialchars($rows['payertype'], ENT_QUOTES, 'UTF-8')
                    : (
                        !empty($rows['fullname'])
                        ? '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>'
                        : '<b><center>' . htmlspecialchars($rows['clinic_name'], ENT_QUOTES, 'UTF-8') . '</center></b>'
                    );


                $row[] = $rows['total'];
                $row[] = $rows['pulang'];
                $row[] = $rows['ranap'];
                $row[] = $rows['terlayani'];
                $row[] = $rows['belum_dilayani'];
                $row[] = $rows['batal'];
                $row[] = $rows['belum_konfirmasi'];

                if ((int)$rows['urutan'] === 0) {
                    $total_row['total'] += $rows['total'];
                    $total_row['pulang'] += $rows['pulang'];
                    $total_row['ranap'] += $rows['ranap'];
                    $total_row['terlayani'] += $rows['terlayani'];
                    $total_row['belum_dilayani'] += $rows['belum_dilayani'];
                    $total_row['batal'] += $rows['batal'];
                    $total_row['belum_konfirmasi'] += $rows['belum_konfirmasi'];
                }

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>Total</center></b>',
                $total_row['total'],
                $total_row['pulang'],
                $total_row['ranap'],
                $total_row['terlayani'],
                $total_row['belum_dilayani'],
                $total_row['batal'],
                $total_row['belum_konfirmasi']
            ];
        }

        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function rvpigdList()
    {
        $giTipe = 7;
        $title = 'REKAPITULASI PASIEN PER KLINIK PER DOKTER DAN CARA BAYAR';
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
                        <th class="p-1"  rowspan="2">Penjaminan</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                        <th class="p-1" rowspan="2">Belum Dilayani</th>
                        <th class="p-1" rowspan="2">Batal</th>
                        <th class="p-1" rowspan="2">Belum Konfirm</th>
                    </tr>
                    <tr>
                           <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rawat Inap</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }



    // Dasboard BIll
    // =============================================================================

    public function pkBillList()
    {
        $giTipe = 7;
        $title = 'REKAP PENERIMAAN TUNAI PER KASIR';
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
                        <th class="p-1">Tanggal</th>
                        <th class="p-1">Klinik</th>
                        <th class="p-1">Total</th>
                    </tr>
                   
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pkBillListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            DECLARE @cashier NVARCHAR(50);
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
            SET @cashier = '' ; 

                    
            WITH data_grouped AS (
                    SELECT 
                        CONVERT(DATE, ta.TREAT_DATE) AS treat_date,
                        c.name_of_clinic,
                        ISNULL(ea.fullname, ta.cashier) AS fullname,  -- pakai cashier jika fullname kosong
                        SUM(ta.bayar) AS bayar
                    FROM 
                        treatment_bayar ta
                    JOIN 
                        CLINIC c ON ta.CLINIC_ID = c.CLINIC_ID
                    LEFT JOIN 
                        user_login ul ON ta.cashier = ul.username
                    LEFT JOIN 
                        employee_all ea ON ea.employee_id = ul.employee_id
                    WHERE 
                        ta.TREAT_DATE BETWEEN @mulai AND @akhir
                        AND (@cashier = '' OR ta.cashier = @cashier)
                    GROUP BY 
                        CONVERT(DATE, ta.TREAT_DATE),
                        c.name_of_clinic,
                        ISNULL(ea.fullname, ta.cashier)
                ),
                subtotal AS (
                    SELECT 
                        fullname,
                        SUM(bayar) AS total_bayar
                    FROM data_grouped
                    GROUP BY fullname
                ),
                detail_numbered AS (
                    SELECT 
                        dg.fullname,
                        dg.treat_date,
                        dg.name_of_clinic,
                        dg.bayar
                    FROM data_grouped dg
                )
                SELECT 
                    1 AS nomor,
                    s.fullname,
                    NULL AS treat_date,
                    NULL AS name_of_clinic,
                    s.total_bayar AS bayar
                FROM subtotal s

                UNION ALL

                SELECT 
                    2 AS nomor,
                    d.fullname,
                    d.treat_date,
                    d.name_of_clinic,
                    d.bayar
                FROM detail_numbered d

                ORDER BY fullname, nomor, treat_date, name_of_clinic;


        ")->getResultArray());


        $dt_data = [];
        if (!empty($data)) {
            $dt_data = [];

            foreach ($data as $rows) {
                $row = [];

                if ($rows['nomor'] == 1) {
                    $row[] = '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>';
                    $row[] = '';
                    $row[] = '<b>' . number_format((float) $rows['bayar'], 0, ',', '.') . '</b>';
                } elseif ($rows['nomor'] == 2) {
                    $row[] = $rows['treat_date'];
                    $row[] = $rows['name_of_clinic'];
                    $row[] = number_format($rows['bayar'], 0, ',', '.');
                }

                $dt_data[] = $row;
            }
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function pdBillList()
    {
        $giTipe = 7;
        $title = 'REKAP PENERIMAAN TUNAI PER KASIR';
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
                        <th class="p-1">Tanggal</th>
                        <th class="p-1">Nama Pasien</th>
                        <th class="p-1">No.RM</th>
                        <th class="p-1">Cara Bayar</th>
                        <th class="p-1">Pelayanan</th>
                        <th class="p-1">Transaksi</th>
                        <th class="p-1">Nilai</th>
                    </tr>
                   

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pdBillListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            DECLARE @cashier NVARCHAR(50);
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
            SET @cashier = '';

          
            WITH data_grouped AS (
                SELECT 
                    CONVERT(DATE, ta.TREAT_DATE) AS treat_date,
                    ta.no_registration,
                    c.name_of_clinic,
                    ISNULL(ea.fullname, ta.cashier) AS fullname,
                    SUM(ta.bayar) AS bayar,
                    pt.payertype,
                    ta.thename,
                    CASE 
                    WHEN ta.ISRJ = 1 THEN 'Rawat Jalan'
                        WHEN ta.ISRJ = 0 THEN 'Rawat Inap'
                        ELSE 'Tidak Diketahui'
                    END AS jenis_rawat
                FROM treatment_bayar ta
                JOIN CLINIC c ON ta.CLINIC_ID = c.CLINIC_ID
                LEFT JOIN user_login ul ON ta.cashier = ul.username
                LEFT JOIN employee_all ea ON ul.employee_id = ea.employee_id
                LEFT JOIN status_pasien sp ON ta.status_pasien_id = sp.status_pasien_id
                LEFT JOIN payor_type pt ON sp.payor_type = pt.payor_type
                WHERE ta.TREAT_DATE BETWEEN @mulai AND @akhir
                AND (@cashier = '' OR ta.cashier = @cashier)
                GROUP BY 
                    CONVERT(DATE, ta.TREAT_DATE),
                    c.name_of_clinic,
                    ta.no_registration,
                    c.name_of_clinic,
                    ISNULL(ea.fullname, ta.cashier),
                    ta.thename,
                    ta.isrj,
                    pt.payertype

            ),
            subtotal AS (
                SELECT 
                    fullname,
                    SUM(bayar) AS total_bayar
                FROM data_grouped
                GROUP BY fullname
            )
           SELECT 
                1 AS nomor,
                s.fullname,
                  NULL AS treat_date,
                NULL AS thename,
                NULL AS name_of_clinic,
                NULL AS no_registration,
                NULL AS jenis_rawat,
                NULL AS payertype,
                s.total_bayar AS bayar
            FROM subtotal s


            UNION ALL

            SELECT 
                2 AS nomor,
                dg.fullname,
                dg.treat_date,
                dg.thename,
                dg.name_of_clinic,
                dg.no_registration,
                dg.jenis_rawat,
                dg.payertype,
                dg.bayar
            FROM data_grouped dg

            ORDER BY fullname, nomor, treat_date, name_of_clinic;


        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $dt_data = [];

            foreach ($data as $rows) {
                $row = [];

                if ($rows['nomor'] == 1) {
                    $row[] = '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '<b>' . number_format((float) $rows['bayar'], 0, ',', '.') . '</b>';
                } elseif ($rows['nomor'] == 2) {
                    $row[] = $rows['treat_date'];
                    $row[] = $rows['thename'];
                    $row[] = $rows['no_registration'];
                    $row[] = $rows['payertype'];
                    $row[] = $rows['name_of_clinic'];
                    $row[] = $rows['jenis_rawat'];
                    $row[] = number_format($rows['bayar'], 0, ',', '.');
                }

                $dt_data[] = $row;
            }
        }

        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function skBillList()
    {
        $giTipe = 7;
        $title = 'REKAP SETORAN TUNAI PER KASIR';
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
                    <th class="p-1">Tanggal</th>
                    <th class="p-1">Klinik</th>
                    <th class="p-1">Penerimaan Tunai</th>
                    <th class="p-1">Nilai Setoran</th>
                </tr>';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function skBillListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            DECLARE @cashier NVARCHAR(50);
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
            SET @cashier = '' ; 

                    
           WITH data_grouped AS (
                SELECT 
                    CONVERT(DATE, ta.TREAT_DATE) AS treat_date,
                    c.name_of_clinic,
                    ISNULL(ea.fullname, ta.cashier) AS fullname,  
                    SUM(ta.bayar) AS bayar,
                    SUM(CASE WHEN ta.SPPKASIR IS NOT NULL THEN ta.bayar ELSE 0 END) AS setoran
                FROM 
                    treatment_bayar ta
                JOIN 
                    CLINIC c ON ta.CLINIC_ID = c.CLINIC_ID
                LEFT JOIN 
                    user_login ul ON ta.cashier = ul.username
                LEFT JOIN 
                    employee_all ea ON ea.employee_id = ul.employee_id
                WHERE 
                    ta.TREAT_DATE BETWEEN @mulai AND @akhir
                    AND (@cashier = '' OR ta.cashier = @cashier)
                GROUP BY 
                    CONVERT(DATE, ta.TREAT_DATE),
                    c.name_of_clinic,
                    ISNULL(ea.fullname, ta.cashier)
            ),
            subtotal AS (
                SELECT 
                    fullname,
                    SUM(bayar) AS total_bayar,
                    SUM(setoran) AS total_setoran
                FROM data_grouped
                GROUP BY fullname
            ),
            detail_numbered AS (
                SELECT 
                    dg.fullname,
                    dg.treat_date,
                    dg.name_of_clinic,
                    dg.bayar,
                    dg.setoran
                FROM data_grouped dg
            )
            SELECT 
                1 AS nomor,
                s.fullname,
                NULL AS treat_date,
                NULL AS name_of_clinic,
                s.total_bayar AS bayar,
                s.total_setoran AS setoran
            FROM subtotal s

            UNION ALL

            SELECT 
                2 AS nomor,
                d.fullname,
                d.treat_date,
                d.name_of_clinic,
                d.bayar,
                d.setoran
            FROM detail_numbered d

            ORDER BY fullname, nomor, treat_date, name_of_clinic;


        ")->getResultArray());


        $dt_data = [];
        if (!empty($data)) {
            $dt_data = [];

            foreach ($data as $rows) {
                $row = [];

                if ($rows['nomor'] == 1) {
                    $row[] = '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>';
                    $row[] = '';
                    $row[] = '<b>' . number_format((float) $rows['bayar'], 0, ',', '.') . '</b>';
                    $row[] = '<b>' . number_format((float) $rows['setoran'], 0, ',', '.') . '</b>';
                } elseif ($rows['nomor'] == 2) {
                    $row[] = $rows['treat_date'];
                    $row[] = $rows['name_of_clinic'];
                    $row[] = number_format($rows['bayar'], 0, ',', '.');
                    $row[] = number_format($rows['setoran'], 0, ',', '.');
                }

                $dt_data[] = $row;
            }
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function sdBillList()
    {
        $giTipe = 7;
        $title = 'DETAIL SETORAN TUNAI PER KASIR';
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
                    <th class="p-1">Tanggal</th>
                    <th class="p-1">Nama Pasien</th>
                    <th class="p-1">No.RM</th>
                    <th class="p-1">Cara Bayar</th>
                    <th class="p-1">Pelayanan</th>
                    <th class="p-1">Transaksi</th>
                    <th class="p-1">Nilai Tunai</th>
                    <th class="p-1">Nilai Setoran</th>
                </tr>';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function sdBillListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            DECLARE @cashier NVARCHAR(50);
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
            SET @cashier = '' ; 

         
            WITH data_grouped AS (
                SELECT 
                    CONVERT(DATE, ta.TREAT_DATE) AS treat_date,
                    ta.no_registration,
                    c.name_of_clinic,
                    ISNULL(ea.fullname, ta.cashier) AS fullname,
                    SUM(ta.bayar) AS bayar,
					SUM(CASE WHEN ta.SPPKASIR IS NOT NULL THEN ta.bayar ELSE 0 END) AS setoran,
                    pt.payertype,
                    ta.thename,
                    CASE 
                    WHEN ta.ISRJ = 1 THEN 'Rawat Jalan'
                        WHEN ta.ISRJ = 0 THEN 'Rawat Inap'
                        ELSE 'Tidak Diketahui'
                    END AS jenis_rawat
                FROM treatment_bayar ta
                JOIN CLINIC c ON ta.CLINIC_ID = c.CLINIC_ID
                LEFT JOIN user_login ul ON ta.cashier = ul.username
                LEFT JOIN employee_all ea ON ul.employee_id = ea.employee_id
                LEFT JOIN status_pasien sp ON ta.status_pasien_id = sp.status_pasien_id
                LEFT JOIN payor_type pt ON sp.payor_type = pt.payor_type
                WHERE ta.TREAT_DATE BETWEEN @mulai AND @akhir
                AND (@cashier = '' OR ta.cashier = @cashier)
                GROUP BY 
                    CONVERT(DATE, ta.TREAT_DATE),
                    c.name_of_clinic,
                    ta.no_registration,
                    c.name_of_clinic,
                    ISNULL(ea.fullname, ta.cashier),
                    ta.thename,
                    ta.isrj,
                    pt.payertype

            ),
            subtotal AS (
                SELECT 
                    fullname,
                    SUM(bayar) AS total_bayar,
                    SUM(setoran) AS total_setoran
                FROM data_grouped
                GROUP BY fullname
            )
           SELECT 
                1 AS nomor,
                s.fullname,
                  NULL AS treat_date,
                NULL AS thename,
                NULL AS name_of_clinic,
                NULL AS no_registration,
                NULL AS jenis_rawat,
                NULL AS payertype,
                s.total_bayar AS bayar,
                s.total_setoran AS setoran
            FROM subtotal s

            UNION ALL

            SELECT 
                2 AS nomor,
                dg.fullname,
                dg.treat_date,
                dg.thename,
                dg.name_of_clinic,
                dg.no_registration,
                dg.jenis_rawat,
                dg.payertype,
                dg.bayar,
				dg.setoran
            FROM data_grouped dg

            ORDER BY fullname, nomor, treat_date, name_of_clinic;
        ")->getResultArray());


        $dt_data = [];
        if (!empty($data)) {

            $dt_data = [];

            foreach ($data as $rows) {
                $row = [];

                if ($rows['nomor'] == 1) {
                    $row[] = '<b>' . htmlspecialchars($rows['fullname'], ENT_QUOTES, 'UTF-8') . '</b>';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '';
                    $row[] = '<b>' . number_format((float) $rows['bayar'], 0, ',', '.') . '</b>';
                    $row[] = '<b>' . number_format((float) $rows['setoran'], 0, ',', '.') . '</b>';
                } elseif ($rows['nomor'] == 2) {
                    $row[] = $rows['treat_date'];
                    $row[] = $rows['thename'];
                    $row[] = $rows['no_registration'];
                    $row[] = $rows['payertype'];
                    $row[] = $rows['name_of_clinic'];
                    $row[] = $rows['jenis_rawat'];
                    $row[] = number_format($rows['bayar'], 0, ',', '.');
                    $row[] = number_format($rows['setoran'], 0, ',', '.');
                }

                $dt_data[] = $row;
            }
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }



    // Laporan Grafik
    // =============================================================================

    public function pjbChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS';
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
                        <th class="p-1">STATUS BAYAR</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pjbChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            WITH KUNJUNGAN_UNIK AS (
                SELECT DISTINCT
                    P.NO_REGISTRATION,
                    CAST(PV.VISIT_DATE AS DATE) AS TANGGAL_KUNJUNGAN,
                    CAST(P.REGISTRATION_DATE AS DATE) AS TANGGAL_REGISTRASI,
                    ISNULL(PT.PAYERTYPE, 'PENJAMIN LAIN-LAIN') AS PAYERTYPE
                FROM 
                    PASIEN P
                INNER JOIN 
                    PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                LEFT JOIN 
                    STATUS_PASIEN SP ON P.STATUS_PASIEN_ID = SP.STATUS_PASIEN_ID
                LEFT JOIN 
                    PAYOR_TYPE PT ON SP.PAYOR_TYPE = PT.PAYOR_TYPE
                WHERE 
                    PV.VISIT_DATE BETWEEN @mulai AND @akhir
                    AND PV.NO_REGISTRATION <> '000000'
                    AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
            )

            SELECT 
                PAYERTYPE,
                COUNT(CASE WHEN TANGGAL_KUNJUNGAN = TANGGAL_REGISTRASI THEN 1 END) AS baru,
                COUNT(CASE WHEN TANGGAL_KUNJUNGAN <> TANGGAL_REGISTRASI THEN 1 END) AS lama,
                COUNT(*) AS total
            FROM 
                KUNJUNGAN_UNIK
            GROUP BY 
                PAYERTYPE
            ORDER BY 
                total DESC;
               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['payertype'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppkChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS BERDASARKAN DAERAH';
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
                        <th class="p-1">KOTA/KAB</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppkChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);

            WITH KUNJUNGAN_UNIK AS (
                    SELECT DISTINCT
                        CAST(PV.VISIT_DATE AS DATE) AS TANGGAL_KUNJUNGAN,
                        CAST(P.REGISTRATION_DATE AS DATE) AS TANGGAL_REGISTRASI,
                        ISNULL(K.NAMA_KOTA, ' ') AS NAMA_KOTA,
                        P.NO_REGISTRATION
                    FROM 
                        PASIEN P
                    LEFT JOIN KALURAHAN KAL ON P.KAL_ID = KAL.KAL_ID
                    LEFT JOIN KECAMATAN KEC ON KAL.KEC_ID = KEC.KEC_ID
                    LEFT JOIN KOTA K ON KEC.KODE_KOTA = K.KODE_KOTA
                    INNER JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                    WHERE 
                        PV.VISIT_DATE BETWEEN @mulai AND @akhir
                        AND PV.NO_REGISTRATION <> '000000'
                        AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
                )

                SELECT 
                    NAMA_KOTA,
                    COUNT(CASE WHEN TANGGAL_KUNJUNGAN = TANGGAL_REGISTRASI THEN 1 END) AS BARU,
                    COUNT(CASE WHEN TANGGAL_KUNJUNGAN <> TANGGAL_REGISTRASI THEN 1 END) AS LAMA,
                    COUNT(*) AS TOTAL
                FROM 
                    KUNJUNGAN_UNIK
                GROUP BY 
                    NAMA_KOTA
                ORDER BY 
                    NAMA_KOTA;

                
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['nama_kota'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function pkbChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS PER KELOMPOK UMUR';
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
                        <th class="p-1">KELOMPOK UMUR</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function pkbChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
           
            WITH KUNJUNGAN_UMUR AS (
                    SELECT DISTINCT
                        AR.DISPLAY,
                        CAST(P.REGISTRATION_DATE AS DATE) AS TGL_REGISTRASI,
                        CAST(PV.VISIT_DATE AS DATE) AS TGL_KUNJUNGAN,
                        P.NO_REGISTRATION
                    FROM 
                        PASIEN P
                    JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                    JOIN AGE_RANGE AR ON 
                        ISNULL(DATEDIFF(DAY, P.DATE_OF_BIRTH, PV.VISIT_DATE), 0) BETWEEN AR.LOWER_BOUND AND AR.UPPER_BOUND
                    WHERE 
                        PV.VISIT_DATE BETWEEN @mulai AND @akhir
                        AND PV.NO_REGISTRATION <> '000000'
                        AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
                )

                SELECT 
                    DISPLAY,
                    COUNT(CASE WHEN TGL_KUNJUNGAN = TGL_REGISTRASI THEN 1 END) AS BARU,
                    COUNT(CASE WHEN TGL_KUNJUNGAN <> TGL_REGISTRASI THEN 1 END) AS LAMA,
                    COUNT(*) AS TOTAL
                FROM 
                    KUNJUNGAN_UMUR
                GROUP BY 
                    DISPLAY
                ORDER BY 
                    TOTAL DESC;
               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['display'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppdChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS PER JENIS KELAMIN';
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
                        <th class="p-1">JENIS KELAMIN</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppdChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
          WITH KUNJUNGAN_SEX AS (
            SELECT 
                    ISNULL(S.NAME_OF_GENDER, ' ') AS NAME_OF_GENDER,
                    CAST(P.REGISTRATION_DATE AS DATE) AS TGL_REGISTRASI,
                    CAST(PV.VISIT_DATE AS DATE) AS TGL_KUNJUNGAN,
                    P.NO_REGISTRATION
                FROM 
                    PASIEN P
                JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                LEFT JOIN SEX S ON P.GENDER = S.GENDER
                WHERE 
                    PV.VISIT_DATE BETWEEN @mulai AND @akhir
                    AND PV.NO_REGISTRATION <> '000000'
                    AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
            )

            SELECT 
                NAME_OF_GENDER,
                COUNT(CASE WHEN TGL_KUNJUNGAN = TGL_REGISTRASI THEN 1 END) AS BARU,
                COUNT(CASE WHEN TGL_KUNJUNGAN <> TGL_REGISTRASI THEN 1 END) AS LAMA,
                COUNT(*) AS TOTAL
            FROM 
                KUNJUNGAN_SEX
            GROUP BY 
                NAME_OF_GENDER
            ORDER BY 
                NAME_OF_GENDER;

               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['name_of_gender'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function dppChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS PER BAHASA';
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
                        <th class="p-1">KELOMPOK BAHASA</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function dppChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
             WITH KUNJUNGAN_NATIONALITY AS (
                    SELECT 
                        N.NATIONALITY AS display,
                        CAST(P.REGISTRATION_DATE AS DATE) AS TGL_REGISTRASI,
                        CAST(PV.VISIT_DATE AS DATE) AS TGL_KUNJUNGAN,
                        P.NO_REGISTRATION
                    FROM 
                        PASIEN P
                    JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                    JOIN NATIONALITY N ON P.NATION_ID = N.NATION_ID
                    WHERE 
                        PV.VISIT_DATE BETWEEN @mulai AND @akhir
                        AND PV.NO_REGISTRATION <> '000000'
                        AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
                )

                SELECT 
                    display,
                    COUNT(CASE WHEN TGL_KUNJUNGAN = TGL_REGISTRASI THEN 1 END) AS BARU,
                    COUNT(CASE WHEN TGL_KUNJUNGAN <> TGL_REGISTRASI THEN 1 END) AS LAMA,
                    COUNT(*) AS TOTAL
                FROM 
                    KUNJUNGAN_NATIONALITY
                GROUP BY 
                    display
                ORDER BY 
                    TOTAL DESC;
               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['display'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function ppaChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS PER AGAMA';
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
                        <th class="p-1">KELOMPOK AGAMA</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppaChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
          
            WITH KUNJUNGAN_AGAMA AS (
                SELECT 
                    A.NAMA_AGAMA AS display,
                    CAST(P.REGISTRATION_DATE AS DATE) AS TGL_REGISTRASI,
                    CAST(PV.VISIT_DATE AS DATE) AS TGL_KUNJUNGAN,
                    P.NO_REGISTRATION
                FROM 
                    PASIEN P
                JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                JOIN AGAMA A ON P.KODE_AGAMA = A.KODE_AGAMA
                WHERE 
                    PV.VISIT_DATE BETWEEN @mulai AND @akhir
                    AND PV.NO_REGISTRATION <> '000000'
                    AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
            )

            SELECT 
                display,
                COUNT(CASE WHEN TGL_KUNJUNGAN = TGL_REGISTRASI THEN 1 END) AS BARU,
                COUNT(CASE WHEN TGL_KUNJUNGAN <> TGL_REGISTRASI THEN 1 END) AS LAMA,
                COUNT(*) AS TOTAL
            FROM 
                KUNJUNGAN_AGAMA
            GROUP BY 
                display
            ORDER BY 
                TOTAL DESC;
               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['display'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function ppkerChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS PER PEKERJAAN';
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
                        <th class="p-1">KELOMPOK PEKERJAAN</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppkerChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
           WITH KUNJUNGAN_JOB AS (
                SELECT 
                    JC.NAME_OF_JOB AS display,
                    CAST(P.REGISTRATION_DATE AS DATE) AS TGL_REGISTRASI,
                    CAST(PV.VISIT_DATE AS DATE) AS TGL_KUNJUNGAN,
                    P.NO_REGISTRATION
                FROM 
                    PASIEN P
                JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                LEFT JOIN JOB_CATEGORY JC ON ISNULL(P.JOB_ID, 10) = JC.JOB_ID
                WHERE 
                    PV.VISIT_DATE BETWEEN @mulai AND @akhir
                    AND PV.NO_REGISTRATION <> '000000'
                    AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
            )

            SELECT 
                display,
                COUNT(CASE WHEN TGL_KUNJUNGAN = TGL_REGISTRASI THEN 1 END) AS BARU,
                COUNT(CASE WHEN TGL_KUNJUNGAN <> TGL_REGISTRASI THEN 1 END) AS LAMA,
                COUNT(*) AS TOTAL
            FROM 
                KUNJUNGAN_JOB
            GROUP BY 
                display
            ORDER BY 
                TOTAL DESC;

               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['display'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }

    public function ppdiChartList()
    {
        $giTipe = 7;
        $title = 'GRAFIK PENGUNJUNG RS PER PENDIDIKAN';
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
                        <th class="p-1">KELOMPOK PENDIDIKAN</th>
                        <th class="p-1">Baru </th>
                        <th class="p-1">Lama</th>
                        <th class="p-1">Jumlah</th>
                    </tr>
                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report-chart', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function ppdiChartListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
           WITH KUNJUNGAN_EDUCATION AS (
                SELECT 
                    ed.NAME_OF_EDU_TYPE AS display,
                    CAST(p.REGISTRATION_DATE AS DATE) AS TGL_REGISTRASI,
                    CAST(pv.VISIT_DATE AS DATE) AS TGL_KUNJUNGAN,
                    p.NO_REGISTRATION
                FROM 
                    PASIEN P
                JOIN PASIEN_VISITATION PV ON P.NO_REGISTRATION = PV.NO_REGISTRATION
                LEFT JOIN EDUCATION_TYPE ed ON ISNULL(P.EDUCATION_TYPE_CODE, 9) = ed.EDUCATION_TYPE_CODE
                WHERE 
                    pv.VISIT_DATE BETWEEN @mulai AND @akhir
                    AND pv.NO_REGISTRATION <> '000000'
                    AND PV.CLINIC_ID IN (SELECT CLINIC_ID FROM CLINIC WHERE STYPE_ID IN (1,5))
            )

            SELECT 
                display,
                COUNT(CASE WHEN TGL_KUNJUNGAN = TGL_REGISTRASI THEN 1 END) AS BARU,
                COUNT(CASE WHEN TGL_KUNJUNGAN <> TGL_REGISTRASI THEN 1 END) AS LAMA,
                COUNT(*) AS TOTAL
            FROM 
                KUNJUNGAN_EDUCATION
            GROUP BY 
                display
            ORDER BY 
                TOTAL DESC;

               
        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'baru' => 0,
                'lama' => 0,

            ];

            foreach ($data as $rows) {
                $row = [];
                $row[] = $rows['display'];
                $row[] = $rows['baru'];
                $row[] = $rows['lama'];
                $row[] = $rows['lama'] + $rows['baru'];

                $totalKeseluruhan['baru'] += (int)$rows['baru'];
                $totalKeseluruhan['lama'] += (int)$rows['lama'];
                $totalKeseluruhan['total'] += (int)$rows['lama'] + (int)$rows['baru'];

                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['baru'],
                $totalKeseluruhan['lama'],
                $totalKeseluruhan['total'],
            ];
        }


        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }


    public function lpppList()
    {
        $giTipe = 7;
        $title = 'LAPORAN PASIEN PER PELAYANAN';
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
                        <th class="p-1"  rowspan="2">Penjamin</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                    </tr>
                    <tr>
                        <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rujukan</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header
        ]);
    }

    public function lpppListpost()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            WITH DataKunjungan AS (
                    SELECT 
                        CASE 
                            WHEN c.STYPE_ID = 1 THEN 'Poliklinik Rawat Jalan'
                            WHEN c.STYPE_ID = 5 THEN 'Unit Gawat Darurat' 
                            ELSE '' 
                        END AS instalasi,
                        EA.FULLNAME,
                        p.payertype,
                        isattended,
                        CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                        CASE 
                            WHEN clinic_id_from = 'P000' THEN '0'
                            WHEN WAY_ID = 16 THEN '0'
                            ELSE '1' 
                        END AS rujukan
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    LEFT JOIN payor_type p 
                        ON status_pasien_id IN (
                            SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type
                        )
                    WHERE visit_date >= DATEADD(HOUR, 0, @mulai) 
                    AND visit_date < DATEADD(HOUR, 24, @akhir)
                    AND c.stype_id IN (1,5)
                ),
                GroupKunjungan AS (
                    SELECT 
                        instalasi,
                        FULLNAME,
                        payertype,
                        COUNT(*) AS jml,
                        MAX(isattended) AS isattended,
                        MAX(isrj) AS isrj,
                        MAX(rujukan) AS rujukan
                    FROM DataKunjungan
                    GROUP BY instalasi, FULLNAME, payertype
                ),
                DetailPayer AS (
                    SELECT 
                        3 AS nomor,
                        instalasi,
                        FULLNAME,
                        payertype,
                        MAX(isattended) AS isattended,
                        MAX(isrj) AS isrj,
                        MAX(rujukan) AS rujukan,
                        SUM(jml) AS jml
                    FROM GroupKunjungan
                    GROUP BY instalasi, FULLNAME, payertype
                ),
                Detail AS (
                    SELECT 
                        2 AS nomor,
                        instalasi,
                        FULLNAME,
                        NULL AS payertype,
                        NULL AS isattended,
                        MAX(isrj) AS isrj,
                        MAX(rujukan) AS rujukan,
                        SUM(jml) AS jml
                    FROM DetailPayer
                    GROUP BY instalasi, FULLNAME
                ),
                Rekap AS (
                    SELECT 
                        1 AS nomor,
                        instalasi,
                        NULL AS FULLNAME,
                        NULL AS payertype,
                        NULL AS isattended,
                        NULL AS isrj,
                        NULL AS rujukan,
                        SUM(jml) AS jml
                    FROM Detail
                    GROUP BY instalasi
                )

                SELECT nomor, instalasi, FULLNAME, payertype, isattended, isrj, rujukan, jml
                FROM Rekap

                UNION ALL

                SELECT nomor, instalasi, FULLNAME, payertype, isattended, isrj, rujukan, jml
                FROM Detail

                UNION ALL

                SELECT nomor, instalasi, FULLNAME, payertype, isattended, isrj, rujukan, jml
                FROM DetailPayer

                ORDER BY instalasi, FULLNAME, payertype;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'isrj' => 0,
                'rujukan' => 0,
                'isrj_isranap' => 0
            ];

            foreach ($data as $rows) {
                $row = [];

                if ($rows['nomor'] == 1) {
                    $row[] = '<b>' . $rows['instalasi'] . '</b>';
                } elseif ($rows['nomor'] == 2) {
                    $row[] = '&nbsp;' . $rows['fullname'];
                } elseif ($rows['nomor'] == 3) {
                    $row[] = '&nbsp;&nbsp;' . $rows['payertype'];
                } else {
                    $row[] = '-';
                }

                $row[] = $rows['jml'];
                $row[] = $rows['isrj'];
                $row[] = $rows['rujukan'];
                $row[] = $rows['jml'];
                if ($rows['nomor'] == 1) {
                    $totalKeseluruhan['total'] += (int)$rows['jml'];
                    $totalKeseluruhan['isrj'] += (int)$rows['isrj'];
                    $totalKeseluruhan['rujukan'] += (int)$rows['rujukan'];
                    $totalKeseluruhan['isrj_isranap'] += (int)$rows['jml'];
                }


                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['isrj'],
                $totalKeseluruhan['rujukan'],
                $totalKeseluruhan['isrj_isranap'],
            ];
        }



        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }



    public function lpppList1()
    {
        $giTipe = 7;
        $title = 'LAPORAN PASIEN PER PELAYANAN';
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

        $menu = [
            ['label' => 'Active', 'url' => '#', 'active' => true, 'disabled' => false],
            ['label' => 'Link 1', 'url' => '#', 'active' => false, 'disabled' => false],
            ['label' => 'Link 2', 'url' => '#', 'active' => false, 'disabled' => false],
            ['label' => 'Disabled', 'url' => '#', 'active' => false, 'disabled' => true]
        ];



        $header = [];
        $header = '<tr>
                        <th class="p-1"  rowspan="2">Penjamin</th>
                        <th class="p-1" rowspan="2">Terdaftar</th>
                        <th class="p-1" colspan="3">Terlayani</th>
                    </tr>
                    <tr>
                        <th class="p-1">Rawat Jalan</th>
                        <th class="p-1">Rujukan</th>
                        <th class="p-1">Total</th>
                    </tr>

                ';
        $db = db_connect();
        $kop = $this->lowerKey($db->query("SELECT org_unit_code,sk,kecamatan,kelurahan,kota,name_of_org_unit,contact_address FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
        return view('admin\report\rl-report1copy', [
            'kop' => $kop,
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'btn_sub' => true,
            'mulai' => true,
            'akhir' => true,
            'filterlenght' => '-1',
            // 'status' => $status,
            // 'clinic' => $clinic,
            // 'sex' => $sex,
            // 'isnew' => $isnew,
            // 'kota' => $kota,
            'header' => $header,
            'menu' => $menu
        ]);
    }

    public function lpppList1post()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');

        $data = $this->lowerKey($db->query("
            DECLARE @mulai DATETIME;
            DECLARE @akhir DATETIME;
            SET @mulai = CONVERT(DATETIME, '$mulai 00:00:00', 120);
            SET @akhir = CONVERT(DATETIME, '$akhir 23:59:59', 120);
    
            WITH DataKunjungan AS (
                    SELECT 
                        CASE 
                            WHEN c.STYPE_ID = 1 THEN 'Poliklinik Rawat Jalan'
                            WHEN c.STYPE_ID = 5 THEN 'Unit Gawat Darurat' 
                            ELSE '' 
                        END AS instalasi,
                        EA.FULLNAME,
                        p.payertype,
                        isattended,
                        CASE WHEN class_room_id IS NULL THEN 1 ELSE 0 END AS isrj,
                        CASE 
                            WHEN clinic_id_from = 'P000' THEN '0'
                            WHEN WAY_ID = 16 THEN '0'
                            ELSE '1' 
                        END AS rujukan
                    FROM pasien_visitation
                    LEFT JOIN clinic c ON pasien_visitation.clinic_id = c.clinic_id
                    LEFT JOIN EMPLOYEE_ALL EA ON EA.EMPLOYEE_ID = PASIEN_VISITATION.EMPLOYEE_ID
                    LEFT JOIN payor_type p 
                        ON status_pasien_id IN (
                            SELECT status_pasien_id FROM status_pasien WHERE payor_type = p.payor_type
                        )
                    WHERE visit_date >= DATEADD(HOUR, 0, @mulai) 
                    AND visit_date < DATEADD(HOUR, 24, @akhir)
                    AND c.stype_id IN (1,5)
                ),
                GroupKunjungan AS (
                    SELECT 
                        instalasi,
                        FULLNAME,
                        payertype,
                        COUNT(*) AS jml,
                        MAX(isattended) AS isattended,
                        MAX(isrj) AS isrj,
                        MAX(rujukan) AS rujukan
                    FROM DataKunjungan
                    GROUP BY instalasi, FULLNAME, payertype
                ),
                DetailPayer AS (
                    SELECT 
                        3 AS nomor,
                        instalasi,
                        FULLNAME,
                        payertype,
                        MAX(isattended) AS isattended,
                        MAX(isrj) AS isrj,
                        MAX(rujukan) AS rujukan,
                        SUM(jml) AS jml
                    FROM GroupKunjungan
                    GROUP BY instalasi, FULLNAME, payertype
                ),
                Detail AS (
                    SELECT 
                        2 AS nomor,
                        instalasi,
                        FULLNAME,
                        NULL AS payertype,
                        NULL AS isattended,
                        MAX(isrj) AS isrj,
                        MAX(rujukan) AS rujukan,
                        SUM(jml) AS jml
                    FROM DetailPayer
                    GROUP BY instalasi, FULLNAME
                ),
                Rekap AS (
                    SELECT 
                        1 AS nomor,
                        instalasi,
                        NULL AS FULLNAME,
                        NULL AS payertype,
                        NULL AS isattended,
                        NULL AS isrj,
                        NULL AS rujukan,
                        SUM(jml) AS jml
                    FROM Detail
                    GROUP BY instalasi
                )

                SELECT nomor, instalasi, FULLNAME, payertype, isattended, isrj, rujukan, jml
                FROM Rekap

                UNION ALL

                SELECT nomor, instalasi, FULLNAME, payertype, isattended, isrj, rujukan, jml
                FROM Detail

                UNION ALL

                SELECT nomor, instalasi, FULLNAME, payertype, isattended, isrj, rujukan, jml
                FROM DetailPayer

                ORDER BY instalasi, FULLNAME, payertype;

        ")->getResultArray());

        $dt_data = [];

        if (!empty($data)) {
            $totalKeseluruhan = [
                'total' => 0,
                'isrj' => 0,
                'rujukan' => 0,
                'isrj_isranap' => 0
            ];

            foreach ($data as $rows) {
                $row = [];

                if ($rows['nomor'] == 1) {
                    $row[] = '<b>' . $rows['instalasi'] . '</b>';
                } elseif ($rows['nomor'] == 2) {
                    $row[] = '&nbsp;' . $rows['fullname'];
                } elseif ($rows['nomor'] == 3) {
                    $row[] = '&nbsp;&nbsp;' . $rows['payertype'];
                } else {
                    $row[] = '-';
                }

                $row[] = $rows['jml'];
                $row[] = $rows['isrj'];
                $row[] = $rows['rujukan'];
                $row[] = $rows['jml'];
                if ($rows['nomor'] == 1) {
                    $totalKeseluruhan['total'] += (int)$rows['jml'];
                    $totalKeseluruhan['isrj'] += (int)$rows['isrj'];
                    $totalKeseluruhan['rujukan'] += (int)$rows['rujukan'];
                    $totalKeseluruhan['isrj_isranap'] += (int)$rows['jml'];
                }


                $dt_data[] = $row;
            }

            $dt_data[] = [
                '<b><center>TOTAL</center></b>',
                $totalKeseluruhan['total'],
                $totalKeseluruhan['isrj'],
                $totalKeseluruhan['rujukan'],
                $totalKeseluruhan['isrj_isranap'],
            ];
        }



        $json_data = [
            "body" => $dt_data
        ];
        echo json_encode($json_data);
    }
}
