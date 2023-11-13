<?php

namespace App\Controllers\Admin;

use App\Models\AgamaModel;
use App\Models\AntrianPoliModel;
use App\Models\BloodModel;
use App\Models\CaraKeluarModel;
use App\Models\ClassModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicDoctorModel;
use App\Models\ClinicModel;
use App\Models\CoverageModel;
use App\Models\PasienVisitationModel;
use App\Models\DoctorScheduleModel;
use App\Models\EducationModel;
use App\Models\FamilyModel;
use App\Models\InasisFaskesModel;
use App\Models\InasisPoliModel;
use App\Models\IsattendedsModel;
use App\Models\JenisPesertaModel;
use App\Models\JobModel;
use App\Models\KalurahanModel;
use App\Models\KecamatanModel;
use App\Models\KotaModel;
use App\Models\MaritalModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienModel;
use App\Models\PayorModel;
use App\Models\ProvinceModel;
use App\Models\ProvinsiModel;
use App\Models\SexModel;
use App\Models\StatusPasienModel;
use App\Models\StatusPesertaModel;
use App\Models\VisitReasonModel;
use App\Models\VisitWayModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;

class Admin extends \App\Controllers\BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        // return $this->rajal();

        // dd(!is_null(user()->employee_id) && user()->employee_id != '');
        if (!is_null(user()->employee_id) && user()->employee_id != '') {
            return $this->rajal();
        } else {
            return $this->dashboard();
        }
    }
    public function dashboard()
    {
        $this->session->set('top_menu', 'dashboard');
        $this->session->set('sub_menu', '');

        // $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        // $data['notifications']       = $notifications;
        // $systemnotifications         = $this->notification_model->getUnreadNotification();
        // $data['systemnotifications'] = $systemnotifications;
        $Current_year                = date('Y');
        $Next_year                   = date("Y");
        $current_date                = date('Y-m-d');
        $data['title']               = 'Dashboard';
        $Current_start_date          = date('01');
        $Current_date                = date('d');
        $Current_month               = date('m');
        $month_collection            = 0;
        $month_expense               = 0;
        $total_opd_patients          = 0;
        $total_ipd_patients          = 0;
        $ar[0]                       = 01;
        $ar[1]                       = 12;
        $year_str_month              = $Current_year . '-' . $ar[0] . '-01';
        $year_end_month              = date("Y-m-t", strtotime($Next_year . '-' . $ar[1] . '-01'));
        //======================Current Month Collection ==============================
        $first_day_this_month = date('Y-m-01');
        // dd(in_groups('superadmin'));
        // $tot_roles            = $this->role_model->get();
        // foreach ($tot_roles as $key => $value) {
        //     if ($value["id"] != 1) {
        //         $count_roles[$value["name"]] = $this->role_model->count_roles($value["id"]);
        //     }
        // }
        $pv = new PasienVisitationModel();
        $selectpv = $pv->selectpv();
        $start = strtotime('first day of january this year');
        $start = date('Y-m-d', $start);
        $end = strtotime('today');
        $end = date('Y-m-d');

        $topXRanap = $pv->topXRanap($start, $end);
        $topXRanap = json_decode(json_encode($topXRanap), true);
        $topXRajal = $pv->topXRajal($start, $end);
        $topXRajal = json_decode(json_encode($topXRajal), true);
        // dd($topXRanap);

        $jenisPasien = $this->jenisPasien();

        $status = array();

        $kunjRS = 0;
        $kunjInap = 0;
        $kunjUGD = 0;
        $kunjJalan = 0;

        foreach ($selectpv as $key => $value) {
            if ($selectpv[$key]['ISRJ'] != 0 && $selectpv[$key]['CLINIC_ID'] != 'P012') {
                $kunjJalan = $kunjJalan + $selectpv[$key]['JML'];
            } else if ($selectpv[$key]['ISRJ'] == 0 && $selectpv[$key]['CLINIC_ID'] != 'P012') {
                $kunjInap = $kunjInap + $selectpv[$key]['JML'];
            }
            if ($selectpv[$key]['CLINIC_ID'] == 'P012') {
                $kunjUGD = $kunjUGD + $selectpv[$key]['JML'];
            }
            $kunjRS = $kunjRS + $selectpv[$key]['JML'];

            if (isset($status[$selectpv[$key]['STATUS_PASIEN_ID']]['JML'])) {
                $status[$selectpv[$key]['STATUS_PASIEN_ID']]['JML'] = $status[$selectpv[$key]['STATUS_PASIEN_ID']]['JML'] + $selectpv[$key]['JML'];
            } else {
                $status[$selectpv[$key]['STATUS_PASIEN_ID']]['JML'] = $selectpv[$key]['JML'];
            }
            foreach ($status as $key => $value) {
                foreach ($jenisPasien as $key1 => $value1) {
                    if ($key == $jenisPasien[$key1]['status_pasien_id']) {
                        $status[$key]['name'] = $jenisPasien[$key1]['name_of_status_pasien'];
                        break;
                    } else {
                        $status[$key]['name'] = '';
                    }
                }
            }
        }

        $kunjungan = $pv->getKunjungan();
        $kunjNew = array();
        foreach ($kunjungan as $key => $value) {
            $kunjNew[$kunjungan[$key]['MONTH']][$kunjungan[$key]['NAME_OF_CLINIC']] = $kunjungan[$key]['JML'];
        }
        // dd($kunjNew);

        $umur = $pv->getUmur();
        $totalRI = 0;
        $totalRJ = 0;
        $total = 0;

        foreach ($umur as $key => $value) {
            if (!isset($umurNew[$umur[$key]['DISPLAY']]['1'])) {
                $umurNew[$umur[$key]['DISPLAY']]['1'] = 0;
            }
            if (!isset($umurNew[$umur[$key]['DISPLAY']]['0'])) {
                $umurNew[$umur[$key]['DISPLAY']]['0'] = 0;
            }
            if ($umur[$key]['kunj'] == '1') {
                $totalRJ = $totalRJ + $umur[$key]['jml'];
            } else {
                $totalRI = $totalRI + $umur[$key]['jml'];
            }
            $total = $total + $umur[$key]['jml'];

            $umurNew[$umur[$key]['DISPLAY']][$umur[$key]['kunj']] = $umur[$key]['jml'];
        }

        $schedule = new DoctorScheduleModel();
        $dokter = $schedule->getSchedule();
        $dokterNew = [];
        foreach ($dokter as $key => $value) {
            $dokterNew[$dokter[$key]['NAME_OF_CLINIC']][$dokter[$key]['DAY_ID']] = (isset($dokterNew[$dokter[$key]['NAME_OF_CLINIC']][$dokter[$key]['DAY_ID']]) ? isset($dokterNew[$dokter[$key]['NAME_OF_CLINIC']][$dokter[$key]['DAY_ID']]) . ' & ' : '') . $dokter[$key]['FULLNAME'];
            $dokterNew[$dokter[$key]['NAME_OF_CLINIC']][$dokter[$key]['DAY_ID']] = $dokter[$key]['FULLNAME'];
        }

        foreach ($dokterNew as $key => $value) {
            for ($i = 1; $i < 8; $i++) {
                if (!isset($dokterNew[$key][$i])) {
                    $dokterNew[$key][$i] = '';
                }
            }
        }
        ksort($dokterNew);

        $classRoom = new ClassRoomModel();
        $kamar = $classRoom->getKamar();
        $class = new ClassModel();
        $kelas = $class->findAll();
        foreach ($kamar as $key => $value) {
            foreach ($kelas as $key1 => $value1) {
                if ($kelas[$key1]['CLASS_ID'] == $kamar[$key]['class_id']) {
                    $kamar[$key]['class_id'] = $kelas[$key1]['NAME_OF_CLASS'];
                    break;
                }
            }
        }
        $antrian = new AntrianPoliModel();
        $poli = $antrian->getAntrian();

        $kunjPoli = $pv->getKunjunganPoli();
        $kunjPoliNew = array();
        $x = -1;
        $kunjPoliNew[$x]['date'] = 0;
        foreach ($kunjPoli as $key => $value) {
            if ($kunjPoliNew[$x]['date'] != $kunjPoli[$key]['YEAR'] . "-" . $kunjPoli[$key]['MONTH'] . "-" . $kunjPoli[$key]['DAY']) {
                $x = $x + 1;
                $kunjPoliNew[$x]['date'] = $kunjPoli[$key]['YEAR'] . "-" . $kunjPoli[$key]['MONTH'] . "-" . $kunjPoli[$key]['DAY'];
            }
            $kunjPoliNew[$x][$kunjPoli[$key]['NAME_OF_CLINIC']] = $kunjPoli[$key]['JML'];
        }
        unset($kunjPoliNew[-1]);


        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // dd(user());


        // $role                        = $this->customlib->getStaffRole();
        // $role_id                     = json_decode($role)->id;
        // $staffid                     = $this->customlib->getStaffID();
        // $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        // $data['notifications']       = $notifications;
        // $systemnotifications         = $this->notification_model->getUnreadNotification();
        // $data['systemnotifications'] = $systemnotifications;
        $Current_year                = date('Y');
        $Next_year                   = date("Y");
        $current_date                = date('Y-m-d');
        $data['title']               = 'Dashboard';
        $Current_start_date          = date('01');
        $Current_date                = date('d');
        $Current_month               = date('m');
        $month_collection            = 0;
        $month_expense               = 0;
        $total_opd_patients          = 0;
        $total_ipd_patients          = 0;
        $ar[0]                       = 01;
        $ar[1]                       = 12;
        $year_str_month              = $Current_year . '-' . $ar[0] . '-01';
        $year_end_month              = date("Y-m-t", strtotime($Next_year . '-' . $ar[1] . '-01'));
        //======================Current Month Collection ==============================
        $first_day_this_month = date('Y-m-01');
        // $tot_roles            = $this->role_model->get();
        // foreach ($tot_roles as $key => $value) {
        //     if ($value["id"] != 1) {
        //         $count_roles[$value["name"]] = $this->role_model->count_roles($value["id"]);
        //     }
        // }
        // $data["roles"]       = $count_roles;
        // $expense             = $this->expense_model->getTotalExpenseBwdate(date('Y-m-01'), date('Y-m-t'));
        // $data["expense"]     = $expense;
        $start_month         = strtotime($year_str_month);
        $start               = strtotime($year_str_month);
        $end                 = strtotime($year_end_month);
        $coll_month          = array();
        $s                   = array();
        $ex                  = array();
        $total_month         = array();
        $start_session_month = strtotime($year_str_month);

        return view('admin/dashboard', [
            'dokter' => $dokterNew,
            'kunjJalan' => $kunjJalan,
            'kunjInap' => $kunjInap,
            'kunjUGD' => $kunjUGD,
            'kunjRS' => $kunjRS,
            'status' => $status,
            'topXRanap' => $topXRanap,
            'topXRajal' => $topXRajal,
            'kunjungan' => $kunjNew,
            'umur' => $umurNew,
            'totalUmurRI' => $totalRI,
            'totalUmurRJ' => $totalRJ,
            'totalUmur' => $total,
            'kamar' => $kamar,
            'poli' => $poli,
            'kunjPoli' => $kunjPoliNew,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp
        ]);
    }

    public function dashboardrajal()
    {
        $this->session->set('top_menu', 'dashboard');
        $this->session->set('sub_menu', '');

        // $notifications               = $this->notification_model->getUnreadStaffNotification($staffid, $role_id);
        // $data['notifications']       = $notifications;
        // $systemnotifications         = $this->notification_model->getUnreadNotification();
        // $data['systemnotifications'] = $systemnotifications;
        $Current_year                = date('Y');
        $Next_year                   = date("Y");
        $current_date                = date('Y-m-d');
        $data['title']               = 'Dashboard';
        $Current_start_date          = date('01');
        $Current_date                = date('d');
        $Current_month               = date('m');
        $month_collection            = 0;
        $month_expense               = 0;
        $total_opd_patients          = 0;
        $total_ipd_patients          = 0;
        $ar[0]                       = 01;
        $ar[1]                       = 12;
        $year_str_month              = $Current_year . '-' . $ar[0] . '-01';
        $year_end_month              = date("Y-m-t", strtotime($Next_year . '-' . $ar[1] . '-01'));
        //======================Current Month Collection ==============================
        $first_day_this_month = date('Y-m-01');
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $db = db_connect('default');
        $builder = $db->query('web_D01_1_PoliHarian');
        $rKHarian = $builder->getResultArray();

        $builder = $db->query('web_D01_2_PoliBulanan');
        $rKBulanan = $builder->getResultArray();

        $builder = $db->query('web_D12_Pasien_Perdaerah');
        $rPasienDaerah = $builder->getResultArray();

        $builder = $db->query('web_D13_Pasien_Perumur');
        $rPasienUmur = $builder->getResultArray();

        $builder = $db->query('web_D18_Rajal_Perstatus');
        $rRajalBayar = $builder->getResultArray();

        $builder = $db->query('web_D16_Grafik_Dokter');
        $rGrafikDokter = $builder->getResultArray();

        $builder = $db->query('web_D02_PelayananPoli');
        $rTerlayani = $builder->getResultArray();



        return view('admin/dashboardRajal', [
            'rKHarian' => $rKHarian,
            'rKBulanan' => $rKBulanan,
            'rPasienDaerah' => $rPasienDaerah,
            'rPasienUmur' => $rPasienUmur,
            'rRajalBayar' => $rRajalBayar,
            'rGrafikDokter' => $rGrafikDokter,
            'rTerlayani' => $rTerlayani,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp
        ]);
    }


    public function search()
    {

        $rules = [
            'search_text'    => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        //parameter
        $coverageModel = new CoverageModel();
        $coverage = $this->lowerKey($coverageModel->findAll());

        $statusModel = new StatusPesertaModel();
        $status = $this->lowerKey($statusModel->findAll());

        $jenisModel = new JenisPesertaModel();
        $jenis = $this->lowerKey($jenisModel->findAll());

        $kelasModel = new ClassModel();
        $kelas = $this->lowerKey($kelasModel->findAll());

        $kalurahanModel = new KalurahanModel();
        $kalurahan = $this->lowerKey($kalurahanModel->findAll());

        $kecamatanModel = new KecamatanModel();
        $kecamatan = $this->lowerKey($kecamatanModel->findAll());

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->findAll());

        $provModel = new ProvinceModel();
        $prov = $this->lowerKey($provModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $payorModel = new PayorModel();
        $payor = $this->lowerKey($payorModel->findAll());

        $educationModel = new EducationModel();
        $education = $this->lowerKey($educationModel->findAll());

        $maritalModel = new MaritalModel();
        $marital = $this->lowerKey($maritalModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $jobModel = new JobModel();
        $job = $this->lowerKey($jobModel->findAll());

        $bloodModel = new BloodModel();
        $blood = $this->lowerKey($bloodModel->findAll());

        $familyModel = new FamilyModel();
        $family = $this->lowerKey($familyModel->findAll());

        $genderModel = new SexModel();
        $gender = $this->lowerKey($genderModel->findAll());



        return view('admin/search', [
            'search_text' => $this->request->getPost('search_text'),
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'coverage' => $coverage,
            'status' => $status,
            'jenis' => $jenis,
            'kelas' => $kelas,
            'kalurahan' => $kalurahan,
            'kecamatan' => $kecamatan,
            'kota' => $kota,
            'prov' => $prov,
            'statusPasien' => $statusPasien,
            'payor' => $payor,
            'education' => $education,
            'marital' => $marital,
            'agama' => $agama,
            'job' => $job,
            'blood' => $blood,
            'family' => $family,
            'gender' => $gender
        ]);
    }

    public function getpatientdatatable()
    {
        $rules = [
            'search_text'    => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $search_text = $this->request->getPost('search_text');
        $pasienmodel = new PasienModel();
        $dt_response = $pasienmodel->getPasienList($search_text);
        $dt_data     = array();
        $info        = array();
        $data        = array();
        $url         = array();
        $info_data   = array('Rawat Jalan', 'Rawat Inap', 'Radiologi', 'Lab', 'Farmasi', 'Operasi');
        $info_url    = array();
        if (!empty($dt_response)) {
            foreach ($dt_response as $key => $value) {
                $row = array();
                $id = $dt_response[$key]['NO_REGISTRATION'];
                if (false) { //if ($value->is_active == 'yes') {


                    $info_url[0] = base_url() . 'admin/patient/profile/' . $id;
                    $info_url[1] = base_url() . 'admin/patient/ipdprofile/' . $id;
                    $info_url[2] = base_url() . 'admin/radio/getTestReportBatch';
                    $info_url[3] = base_url() . 'admin/pathology/getTestReportBatch';
                    $info_url[4] = base_url() . 'admin/pharmacy/bill';

                    for ($i = 0; $i < sizeof($info_url); $i++) {
                        $data[$i] = $info_data[$i];
                        $url[$i]  = $info_url[$i];
                    }
                    $result[$key]['info'] = $data;
                    $result[$key]['url']  = $url;
                }

                $date1 = date_create(substr($dt_response[$key]['DATE_OF_BIRTH'], 0, 10));
                $date2 = date_create(date('Y-m-d'));

                $diff = date_diff($date1, $date2);
                $age = $diff->y;
                $month = $diff->m;
                $day = $diff->d;


                $action = '<button type="button" class="btn btn-primary waves-effect waves-light" onclick="addVisitPatient(\'' . $id . '\')">Tambah</button>';

                $action = '<div class="btn-group" role="group">';
                $action .= '<button id="btnGroupVerticalDrop' . $id . '" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Pilih <i class="mdi mdi-chevron-down"></i>
                                                </button>';

                $action .= '<div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">';
                $action .= '<a onclick="addVisitPatient(\'' . $id . '\')" class="dropdown-item" href="#">Tambah Rawat Jalan</a>';
                $action .= '<a onclick="addRanap(\'' . $id . '\')" class="dropdown-item" href="#">Tambah Rawat Inap</a>';
                $action .= '<a onclick=\'getpatientData("' . $id . '")\' class="dropdown-item" href="#">Histori Pasien</a>';
                $action .= '<a onclick=\'editBiodataPasien("' . $id . '")\' class="dropdown-item" href="#">Edit Biodata</a>';
                $action .= "</div>";
                $first_action = "<a href='#' onclick='getpatientData(\"" . $id . "\")'  class='btn btn-default btn-xs'  data-toggle='modal' title=''>";
                // $checkbox     = "<input  class='chk2 enable_delete' type='checkbox' name='patient[]' value='" . $id . "'>";
                $checkbox = $id;

                //==============================
                $row[] = $checkbox;
                // $row[] = $first_action . $this->composePatientName($dt_response[$key]['NAME_OF_PASIEN'], $id) . "</a>";
                $row[] = $first_action . $dt_response[$key]['NAME_OF_PASIEN'] . "</a>";
                $row[] = $this->getPatientAge($age, $month, $day);
                if ($dt_response[$key]['GENDER'] == '1') {
                    $row[] = 'Laki-laki';
                } else {
                    $row[] = 'Perempuan';
                }
                if (empty($dt_response[$key]['PHONE_NUMBER'])) {
                    $dt_response[$key]['PHONE_NUMBER'] = ' - ';
                }
                if (empty($dt_response[$key]['MOBILE'])) {
                    $dt_response[$key]['MOBILE'] = ' - ';
                }
                $row[] = $dt_response[$key]['PHONE_NUMBER'] . " / " . $dt_response[$key]['MOBILE'];
                $row[] = '';
                $row[] = $dt_response[$key]['CONTACT_ADDRESS'];
                // if (false) { //if ($value->is_dead == 'yes') {
                //     $row[] = lang('yes');
                // } else {
                //     $row[] = lang('no');
                // }

                //====================
                if (!empty($fields)) {
                    foreach ($fields as $fields_key => $fields_value) {
                        $display_field = $value->{"$fields_value->name"};
                        if ($fields_value->type == "link") {
                            $display_field = "<a href=" . $value->{"$fields_value->name"} . " target='_blank'>" . $value->{"$fields_value->name"} . "</a>";
                        }
                        $row[] = $display_field;
                    }
                }
                $row[]     = $action;
                $dt_data[] = $row;
            }
        }
        $json_data = array(

            "data"            => $dt_data,
        );
        echo json_encode($json_data);
    }

    private function rajalTemplate($giTipe, $title)
    {
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        //parameter
        $coverageModel = new CoverageModel();
        $coverage = $this->lowerKey($coverageModel->findAll());

        $statusModel = new StatusPesertaModel();
        $status = $this->lowerKey($statusModel->findAll());

        $jenisModel = new JenisPesertaModel();
        $jenis = $this->lowerKey($jenisModel->findAll());

        $kelasModel = new ClassModel();
        $kelas = $this->lowerKey($kelasModel->findAll());

        $kalurahanModel = new KalurahanModel();
        $kalurahan = $this->lowerKey($kalurahanModel->findAll());

        $kecamatanModel = new KecamatanModel();
        $kecamatan = $this->lowerKey($kecamatanModel->findAll());

        $kotaModel = new KotaModel();
        $kota = $this->lowerKey($kotaModel->findAll());

        $provModel = new ProvinceModel();
        $prov = $this->lowerKey($provModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $payorModel = new PayorModel();
        $payor = $this->lowerKey($payorModel->findAll());

        $educationModel = new EducationModel();
        $education = $this->lowerKey($educationModel->findAll());

        $maritalModel = new MaritalModel();
        $marital = $this->lowerKey($maritalModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $jobModel = new JobModel();
        $job = $this->lowerKey($jobModel->findAll());

        $bloodModel = new BloodModel();
        $blood = $this->lowerKey($bloodModel->findAll());

        $familyModel = new FamilyModel();
        $family = $this->lowerKey($familyModel->findAll());

        $genderModel = new SexModel();
        $gender = $this->lowerKey($genderModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5)")->findAll());

        $scheduleModel = new DoctorScheduleModel();
        $schedule = $this->lowerKey($scheduleModel->getSchedule());

        $wayModel = new VisitWayModel();
        $way = $this->lowerKey($wayModel->findAll());

        $reasonModel = new VisitReasonModel();
        $reason = $this->lowerKey($reasonModel->findAll());

        // dd($reasonModel);

        $isattendedModel = new IsattendedsModel();
        $isattended = $this->lowerKey($isattendedModel->findAll());

        $inasisPoliModel = new InasisPoliModel();
        $inasisPoli = $this->lowerKey($inasisPoliModel->findAll());

        $inasisFaskesModel = new InasisFaskesModel();
        $inasisFaskes = $this->lowerKey($inasisFaskesModel->findAll());

        // $diagnosaModel = new DiagnosaModel();
        // $diagnosa = $this->lowerKey($diagnosaModel->findAll());



        $dokter = array();
        $dpjp = array();
        $clinicPermission = array();

        $userEmployee = user()->employee_id;

        $cdModel = new ClinicDoctorModel();
        $clinicDoctor = $this->lowerKey($cdModel->where('employee_id', $userEmployee)->findAll());



        $ckModel = new CaraKeluarModel();
        $caraKeluar = $this->lowerKey($ckModel->findAll());


        foreach ($clinic as $key => $value) {
            $selectDokter = array();

            foreach ($schedule as $key1 => $value1) {
                if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
                    $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
                }
            }
            $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
            unset($selectDokter);
        }

        if (!is_null($userEmployee)) {
            foreach ($schedule as $key => $value) {
                if ($schedule[$key]['dpjp'] != '' && !is_null($schedule[$key]['dpjp'])) {
                    $dpjp[$schedule[$key]['employee_id']] = $schedule[$key]['dpjp'];
                }
            }
            foreach ($clinicDoctor as $key => $value) {
                if ($clinicDoctor[$key]['employee_id'] == $userEmployee) {
                    $clinicPermission[$clinicDoctor[$key]['clinic_id']]['clinic_id'] = $clinicDoctor[$key]['clinic_id'];
                    $clinicPermission[$clinicDoctor[$key]['clinic_id']]['name_of_clinic'] = $clinicDoctor[$key]['name_of_clinic'];
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($clinic[$ckey]['clinic_id'] == $clinicDoctor[$key]['clinic_id']) {
                            $clinicPermission[$clinicDoctor[$key]['clinic_id']]['stype_id'] = $clinic[$ckey]['stype_id'];
                        }
                    }
                }
            }

            // unset($clinic);
            foreach ($clinicPermission as $key => $value) {
                unset($clinic);
            }
            $i = 0;
            foreach ($clinicPermission as $key => $value) {
                $i++;
                $clinic[$i] = $clinicPermission[$key];
            }
        }







        return view('admin/patient/search', [
            'giTipe' => $giTipe,
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'dokter' => $dokter,
            'coverage' => $coverage,
            'status' => $status,
            'jenis' => $jenis,
            'kelas' => $kelas,
            'kalurahan' => $kalurahan,
            'kecamatan' => $kecamatan,
            'kota' => $kota,
            'prov' => $prov,
            'statusPasien' => $statusPasien,
            'payor' => $payor,
            'education' => $education,
            'marital' => $marital,
            'agama' => $agama,
            'job' => $job,
            'blood' => $blood,
            'family' => $family,
            'gender' => $gender,
            'way' => $way,
            'reason' => $reason,
            'isattended' => $isattended,
            'inasisPoli' => $inasisPoli,
            'inasisFaskes' => $inasisFaskes,
            // 'diagnosa' => $diagnosa,
            'dpjp' => $dpjp,
            'caraKeluar' => $caraKeluar
        ]);
    }
    public function rajal()
    {
        $session = session();
        $sessionData = ['gsPoli' => ''];
        $session->set($sessionData);
        $giTipe = 1;

        $title = 'Rawat Jalan';

        return $this->rajalTemplate($giTipe, $title);
    }
}
