<?php

namespace App\Controllers\Admin;

use App\Controllers\Vclaim;
use App\Models\AgamaModel;
use App\Models\AntrianFarmasiModel;
use App\Models\Assessment\ApgarDetailModel;
use App\Models\Assessment\DiagnosaPerawatModel;
use App\Models\Assessment\PasienTransferModel;
use App\Models\Assessment\TreatmentPerawatModel;
use App\Models\AssessmentModel;
use App\Models\BloodModel;
use App\Models\CaraKeluarModel;
use App\Models\ClassModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicDoctorModel;
use App\Models\ClinicModel;
use App\Models\ClinicTypeModel;
use App\Models\CoverageModel;
use App\Models\DiagnosaCategoryModel;
use App\Models\DiagnosaModel;
use App\Models\DocsSignedModel;
use App\Models\DoctorScheduleModel;
use App\Models\EducationModel;
use App\Models\EklaimModel;
use App\Models\EmployeeAllModel;
use App\Models\ExaminationDetailModel;
use App\Models\ExaminationModel;
use App\Models\FamilyModel;
use App\Models\FollowUpModel;
use App\Models\GoodGfModel;
use App\Models\HandoverModel;
use App\Models\PasienHistoryModel;
use App\Models\TreatDocsModel;
use CodeIgniter\Files\File;
use App\Models\GenerateIdModel;
use App\Models\GoodsModel;
use App\Models\GrouperModel;
use App\Models\HandoverDetailModel;
use App\Models\InasisFaskesModel;
use App\Models\InasisKontrolModel;
use App\Models\InasisPoliModel;
use App\Models\InasisPoloModel;
use App\Models\InasisRujukanModel;
use App\Models\IsattendedsModel;
use App\Models\JenisPesertaModel;
use App\Models\JobModel;
use App\Models\KalurahanModel;
use App\Models\KecamatanModel;
use App\Models\KotaModel;
use App\Models\MaritalModel;
use App\Models\MeasurementModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosaModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienModel;
use App\Models\PasienPenunjangModel;
use App\Models\PasienPrescriptionModel;
use App\Models\PasienProceduresModel;
use App\Models\PasienVisitationModel;
use App\Models\PayorModel;
use App\Models\ProvinceModel;
use App\Models\RegulationTypeModel;
use App\Models\ResultTypeModel;
use App\Models\RujukanModel;
use App\Models\SexModel;
use App\Models\SignaModel;
use App\Models\StatusPasienModel;
use App\Models\StatusPesertaModel;
use App\Models\SubsidiModel;
use App\Models\SufferModel;
use App\Models\TarifAltModel;
use App\Models\TreatmentAkomodasiModel;
use App\Models\TreatmentBillModel;
use App\Models\TreatmentObatModel;
use App\Models\TreatResultModel;
use App\Models\TreatTarifModel;
use App\Models\VisitReasonModel;
use App\Models\VisitWayModel;
use CodeIgniter\Database\RawSql;
use CodeIgniter\I18n\Time;
use LZCompressor\LZString;

class Patient extends \App\Controllers\BaseController
{
    protected $session;
    public function __construct() {}
    // public function index()
    // {

    //     $this->session = \Config\Services::session();
    //     $this->session->start();
    // }
    function clearCache()
    {
        $cache = \Config\Services::cache(); // Get the cache service
        $cache->clean(); // Clear all cached items
        return "done";
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
        $kalurahan = $this->lowerKey($kalurahanModel->where("kal_id in (select kal_id from pasien group by kal_id)")->findAll());

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

        $ckModel = new CaraKeluarModel();
        $caraKeluar = $this->lowerKey($ckModel->findAll());

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
        // dd($userEmployee);

        $cdModel = new ClinicDoctorModel();
        $clinicDoctor = $this->lowerKey($cdModel->where('employee_id', $userEmployee)->findAll());
        $clinicInap = array();


        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel->findAll());



        foreach ($clinic as $key => $value) {
            $selectDokter = array();

            foreach ($schedule as $key1 => $value1) {
                if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
                    $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
                }
            }
            $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
            unset($selectDokter);
            if ($value['stype_id'] == '3') {
                $clinicInap[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
            }
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
                            foreach ($cvalue as $ckey2 => $cvalue2) {
                                $clinicPermission[$clinicDoctor[$key]['clinic_id']][$ckey2] = $cvalue2;
                                $clinicPermission[$clinicDoctor[$key]['clinic_id']]['stype_id'] = $clinic[$ckey]['stype_id'];
                                // dd($clinicPermission);
                            }
                        }
                    }
                }
            }

            foreach ($clinicPermission as $key => $value) {
                unset($clinic);
            }

            $i = 0;
            foreach ($clinicPermission as $key => $value) {
                $i++;
                $clinic[$i] = $clinicPermission[$key];
            }
        }
        // dd($dpjp);

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
            'caraKeluar' => $caraKeluar,
            // 'diagnosa' => $diagnosa,
            'dpjp' => $dpjp,
            'clinicInap' => $clinicInap,
            'clinicType' => $clinicType
        ]);
    }
    private function searchingTemplate($giTipe, $title)
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


        $classRoomModel = new ClassRoomModel();
        $classRoom = $this->lowerKey($classRoomModel->findAll());

        $kalurahanModel = new KalurahanModel();
        $kalurahan = $this->lowerKey($kalurahanModel->where("kal_id in (select kal_id from pasien group by kal_id)")->findAll());

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
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5,$giTipe)")->findAll());

        $scheduleModel = new ClinicDoctorModel();
        $schedule = $this->lowerKey($scheduleModel->getSchedule());

        $wayModel = new VisitWayModel();
        $way = $this->lowerKey($wayModel->findAll());

        $reasonModel = new VisitReasonModel();
        $reason = $this->lowerKey($reasonModel->findAll());

        $isattendedModel = new IsattendedsModel();
        $isattended = $this->lowerKey($isattendedModel->findAll());

        $inasisPoliModel = new InasisPoliModel();
        $inasisPoli = $this->lowerKey($inasisPoliModel->findAll());

        $inasisFaskesModel = new InasisFaskesModel();
        $inasisFaskes = $this->lowerKey($inasisFaskesModel->findAll());

        $ckModel = new CaraKeluarModel();
        $caraKeluar = $this->lowerKey($ckModel->findAll());

        // $diagnosaModel = new DiagnosaModel();
        // $diagnosa = $this->lowerKey($diagnosaModel->findAll());


        $dokter = array();
        $dpjp = array();
        $clinicInap = array();


        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel->findAll());

        // dd($schedule);

        $clinicInap = array_filter($clinic, function ($value) {
            return $value['stype_id'] == '3';
        });
        $clinicInap = array_column($clinicInap, 'name_of_clinic', 'clinic_id');

        // foreach ($clinic as $key => $value) {
        //     $selectDokter = array();

        //     foreach ($schedule as $key1 => $value1) {
        //         if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
        //             $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
        //         }
        //     }
        //     $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
        //     unset($selectDokter);
        //     if ($value['stype_id'] == '3') {
        //         $clinicInap[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
        //     }
        // }
        foreach ($clinic as $clinicItem) {
            $selectDokter = array_filter($schedule, function ($scheduleItem) use ($clinicItem) {
                return $clinicItem['clinic_id'] == $scheduleItem['clinic_id'];
            });
            $selectDokter = array_column($selectDokter, 'fullname', 'employee_id');
            $dokter[$clinicItem['clinic_id']] = $selectDokter;
        }
        $selectDokter = array_filter($schedule, function ($scheduleItem) use ($clinicItem) {
            return 'A00' == $scheduleItem['clinic_id'];
        });
        $selectDokter = array_column($selectDokter, 'fullname', 'employee_id');
        $dokter[$clinicItem['clinic_id']] = $selectDokter;


        foreach ($schedule as $key => $value) {
            if ($schedule[$key]['dpjp'] != '' && !is_null($schedule[$key]['dpjp'])) {
                $dpjp[$schedule[$key]['employee_id']][$schedule[$key]['dpjp']] = $schedule[$key]['sspractitioner_id'];
            }
        }

        asort($clinicInap);

        // dd($dpjp);


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
            'classRoom' => $classRoom,
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
            'caraKeluar' => $caraKeluar,
            'clinicInap' => $clinicInap,
            'clinicType' => $clinicType
        ]);
    }
    public function getpatientDetails()
    {
        $id = $this->request->getPost("id");
        $pasienmodel = new PasienModel();
        $pasien = $pasienmodel->getPasien($id);
        $result = array();

        $result = $this->lowerKey($pasien[0]);

        // foreach ($pasien[0] as $key => $value) {
        //     $result[strtolower($key)] = $value;
        // }
        // array_change_key_case($result, CASE_LOWER);
        // dd($result);
        $date1 = date_create(substr($result['date_of_birth'], 0, 10));
        $date2 = date_create(date('Y-m-d'));

        $diff = date_diff($date1, $date2);
        $age = $diff->y;
        $month = $diff->m;
        $day = $diff->d;
        $result['patient_age'] = $this->getPatientAge($age, $month, $day);
        echo json_encode($result);
    }
    public function patientvisit()
    {
        // $body = $this->request->getBody();
        $id = $this->request->getPost('id');
        // return json_encode($body);
        // $id = $body['id'];
        $pv = new PasienVisitationModel();

        $data["opd_data"] = $pv->getKunjunganPasien($id);
        // $data["opd_data"]        = $this->patient_model->getopdvisitreportdata($id);
        // $data["ipd_data"]        = $this->patient_model->getipdvisitreportdata($id);
        // $data["pharmacy_data"]   = $this->patient_model->getPatientPharmacyVisitDetails($id);
        // $data["radiology_data"]  = $this->patient_model->getPatientRadiologyVisitDetails($id);
        // $data["blood_bank_data"] = $this->patient_model->getPatientBloodBankVisitDetails($id);
        // $data["ambulance_data"]  = $this->patient_model->getPatientAmbulanceVisitDetails($id);
        // $data['pathology_data']  = $this->report_model->getAllpathologybillRecord($id);

        $page = view("admin/patient/_patientvisit", $data);
        echo json_encode($page);
    }
    public function update()
    {
        // return $this->request->getPost('nama');
        // if (!$this->request->is('post')) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }
        $rules = [
            'nama' => 'required|string',
            'no_registration' => 'required|integer',
            'pasien_id' => 'required|max_length[16]|min_length[16]',
            'class_id' => 'required',
            'placebirth' => 'required',
            'datebirth' => 'required|valid_date[Y-m-d]',
            'address' => 'required',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'kalurahan' => 'required|integer',
            'phone' => 'permit_empty|integer',
            'mobile' => 'required|integer',
            'status' => 'required',
            'edukasi' => 'required',
            'pekerjaan' => 'required',
            'goldar' => 'required',
            'agama' => 'required',
            'perkawinan' => 'required',
            'gender' => 'required',
            'kk_no' => 'permit_empty|integer',
            'tmt' => 'permit_empty|valid_date[Y-m-d]',
            'tat' => 'permit_empty|valid_date[Y-m-d]'
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
            return json_encode($array);
        }


        $nama = $this->request->getPost('nama');
        $no_registration = $this->request->getPost('no_registration');
        $pasien_id = $this->request->getPost('pasien_id');
        $class_id = $this->request->getPost('class_id');
        $placebirth = $this->request->getPost('placebirth');
        $datebirth = $this->request->getPost('datebirth');
        $description = $this->request->getPost('description');
        $address = $this->request->getPost('address');
        $rt = $this->request->getPost('rt');
        $rw = $this->request->getPost('rw');
        $kalurahan = $this->request->getPost('kalurahan');
        $phone = $this->request->getPost('phone');
        $mobile = $this->request->getPost('mobile');
        $status = $this->request->getPost('status');
        $payor = $this->request->getPost('payor');
        $ayah = $this->request->getPost('ayah');
        $ibu = $this->request->getPost('ibu');
        $sutri = $this->request->getPost('sutri');
        $edukasi = $this->request->getPost('edukasi');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $goldar = $this->request->getPost('goldar');
        $agama = $this->request->getPost('agama');
        $perkawinan = $this->request->getPost('perkawinan');
        $gender = $this->request->getPost('gender');
        $pisa = $this->request->getPost('pisa');
        $family = $this->request->getPost('family');
        $kk_no = $this->request->getPost('kk_no');
        $tmt = $this->request->getPost('tmt');
        $tat = $this->request->getPost('tat');
        $father = $this->request->getPost('ayah');
        $mother = $this->request->getPost('ibu');
        $spouse = $this->request->getPost('sutri');


        // return json_encode($kalurahan);


        $data = [
            'name_of_pasien' => $nama,
            'no_registration' => $no_registration,
            'pasien_id' => $pasien_id,
            'class_id' => $class_id,
            'place_of_birth' => $placebirth,
            'date_of_birth' => $datebirth,
            'description' => $description,
            'contact_address' => $address,
            'rt' => $rt,
            'rw' => $rw,
            'kal_id' => $kalurahan,
            'phone_number' => $phone,
            'mobile' => $mobile,
            'status_pasien_id' => $status,
            'payor_id' => $payor,
            'father' => $ayah,
            'mother' => $ibu,
            'spouse' => $sutri,
            'education_type_code' => $edukasi,
            'job_id' => $pekerjaan,
            'blood_type_id' => $goldar,
            'kode_agama' => $agama,
            'maritalstatusid' => $perkawinan,
            'gender' => $gender,
            'coverage_id' => $pisa,
            'family_status_id' => $family,
            'kk_no' => $kk_no,
            'tmt' => $tmt,
            'tat' => $tat,
            'father' => $father,
            'mother' => $mother,
            'spouse' => $spouse
        ];
        // $data = json_encode($data);

        // return $data;


        $pasienModel = new PasienModel();

        $pasienModel->update($no_registration, $data);
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => 'update berhasil');
        echo json_encode($array);
    }
    /*
This Function is used to Add Patient
 */
    public function deleteById()
    {

        $request = service('request');
        $formData = $request->getJSON(true);
        $id = $formData['id'];
        $docs_type = $formData['docs_type'];
        $visit_id = $formData['visit_id'];
        $trans_id = $formData['trans_id'];
        $no_registration = $formData['no_registration'];

        try {
            $model = $this->getSignModel($docs_type);
            $data = [
                $model->primaryKey => 'x' . $id,
                'trans_id' => 'x' . $trans_id,
                'visit_id' => 'x' . $visit_id,
                'no_registration' => 'x' . $no_registration,
                'modified_by' => user()->username,
                'modified_date' => new RawSql("getdate()")
            ];


            $model->update($id, $data);
            // $model->delete($id);

            $signModel = new DocsSignedModel();
            $data = [
                $model->primaryKey => 'x' . $id
            ];
            $signModel->update($id, $data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'message' => 'Data deleted successfully.',
                'response' => true
            ]);
        }


        return $this->response->setJSON([
            'message' => 'Data deleted successfully.',
            'response' => true
        ]);
    }
    public function addpatient()
    {
        // return $this->request->getPost('nama');
        // if (!$this->request->is('post') && $this->validate(['file' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,1024]'])) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }


        // return json_encode($norm);
        $rules = [
            'nama' => 'required|string',
            // 'no_registration' => 'required|integer',
            'pasien_id' => 'required|max_length[16]|min_length[16]',
            'class_id' => 'required',
            'placebirth' => 'required',
            'datebirth' => 'required|valid_date[Y-m-d]',
            'address' => 'required',
            'kalurahan' => 'required|integer',
            'mobile' => 'required|integer',
            'status' => 'required',
            'goldar' => 'required',
            'gender' => 'required',
            'kk_no' => 'permit_empty|integer',
            'tmt' => 'permit_empty|valid_date[Y-m-d]',
            'tat' => 'permit_empty|valid_date[Y-m-d]',
            // 'file' => 'permit_empty|uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,1024]'
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
            return json_encode($array);
        }

        $no_registration = $this->request->getPost('no_registration');
        if (!isset($no_registration) || $no_registration == '') {
            $p = new PasienModel();
            $no_registration = $p->getNorm();
        }
        // return json_encode($no_registration);

        $nama = $this->request->getPost('nama');
        $pasien_id = $this->request->getPost('pasien_id');
        $class_id = $this->request->getPost('class_id');
        $placebirth = $this->request->getPost('placebirth');
        $datebirth = $this->request->getPost('datebirth');
        $description = $this->request->getPost('description');
        $address = $this->request->getPost('address');
        $rt = $this->request->getPost('rt');
        $rw = $this->request->getPost('rw');
        $kalurahan = $this->request->getPost('kalurahan');
        $phone = $this->request->getPost('phone');
        $mobile = $this->request->getPost('mobile');
        $status = $this->request->getPost('status');
        $payor = $this->request->getPost('payor');
        $ayah = $this->request->getPost('ayah');
        $ibu = $this->request->getPost('ibu');
        $sutri = $this->request->getPost('sutri');
        $edukasi = $this->request->getPost('edukasi');
        $pekerjaan = $this->request->getPost('pekerjaan');
        $goldar = $this->request->getPost('goldar');
        $agama = $this->request->getPost('agama');
        $perkawinan = $this->request->getPost('perkawinan');
        $gender = $this->request->getPost('gender');
        $pisa = $this->request->getPost('pisa');
        $family = $this->request->getPost('family');
        $kk_no = $this->request->getPost('kk_no');
        $tmt = $this->request->getPost('tmt');
        $tat = $this->request->getPost('tat');
        $father = $this->request->getPost('ayah');
        $mother = $this->request->getPost('ibu');
        $spouse = $this->request->getPost('sutri');
        $file = $this->request->getFile('file');
        $sspasien_id = $this->request->getPost('sspasien_id');


        $orgunitcode = '3372238';

        // return json_encode();

        // return json_encode(base64_encode(file_get_contents($file->getTempName())));

        // if (!$file->hasMoved()) {
        //     $filepath = $this->imageloc . 'uploads/' . $file->store();

        //     // $data = ['uploaded_fileinfo' => base64_encode(file_get_contents($filepath))];

        //     // return json_encode($data);
        // }

        // $data = ['errors' => 'The file has already been moved.'];

        // return json_encode($file);

        // $db = db_connect('default');
        // $db->simpleQuery("update pasien set ttd = " . file_get_contents($filepath) . " where no_registration = '846202'");


        // return json_encode(base64_encode(file_get_contents($filepath)));

        $data = [
            'org_unit_code' => $orgunitcode,
            'name_of_pasien' => $nama,
            'no_registration' => $no_registration,
            'pasien_id' => $pasien_id,
            'class_id' => $class_id,
            'place_of_birth' => $placebirth,
            'date_of_birth' => $datebirth,
            'description' => $description,
            'contact_address' => $address,
            'rt' => $rt,
            'rw' => $rw,
            'kal_id' => $kalurahan,
            'phone_number' => $phone,
            'mobile' => $mobile,
            'status_pasien_id' => $status,
            'payor_id' => $payor,
            'father' => $father,
            'mother' => $mother,
            'spouse' => $spouse,
            'education_type_code' => $edukasi,
            'job_id' => $pekerjaan,
            'blood_type_id' => $goldar,
            'kode_agama' => $agama,
            'maritalstatusid' => $perkawinan,
            'gender' => $gender,
            'coverage_id' => $pisa,
            'family_status_id' => $family,
            'kk_no' => $kk_no,
            'tmt' => $tmt,
            'tat' => $tat,
            'sspasien_id' => $sspasien_id,
            'father' => $father,
            'mother' => $mother,
            'spouse' => $spouse
        ];




        $pasienModel = new PasienModel();

        $pasienModel->save($data);

        $uploadFolder = 'uploads/doc/P000' . $no_registration;

        if (!is_dir($uploadFolder)) {
            mkdir(
                $uploadFolder,
                0777,
                true
            );
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $no_registration . $file->getName();
            $file->move($uploadFolder, $newName);

            // You can store the file path in the database if needed
            $filePath = $uploadFolder . '/' . $newName;
            $docModel = new TreatDocsModel();
            $docData = [
                'org_unit_code' => $orgunitcode,
                'doc_id' => $no_registration,
                'doc_ke' => 1,
                'docfiles' => $newName,
                'upload_by' => user()->username,
                'modified_by' => user()->username,
                'doc_type' => 1,
                'clinic_id' => 'P000'
            ];
            $docModel->save($docData);

            // Additional logic based on your application's needs

            // return redirect()->to(base_url($filePath));
        }




        // return json_encode('asd');



        // header("Content-type: image/jpeg");
        // echo file_get_contents($filepath);

        // $pasienModel->save($data);

        // return json_encode(base64_encode($data['ttd']));
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => 'tambah pasien berhasil', 'data' => $data);
        echo json_encode($array);
    }
    public function deletePatient()
    {
        $id = $this->request->getPost('delid');
        if (!empty($id)) {
            $p = new PasienModel();

            $p->where('no_registration', strval($id))->delete();
            $array = array('status' => 'success', 'error' => '', 'message' => lang('Word.delete_message'));
        } else {
            $array = array('status' => 'fail', 'error' => '', 'message' => '');
        }
        echo json_encode($array);
    }
    public function search()
    {
        $title = 'Pendaftaran';
        $giTipe = 0;
        return $this->searchingTemplate($giTipe, $title);
    }
    public function getopddatatable($searchtype = null)
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $nama = $this->request->getPost('nama');
        $kode = $this->request->getPost('norm');
        $alamat = $this->request->getPost('address');
        $poli = $this->request->getPost('klinik');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $sudah = '%';
        $dokter = $this->request->getPost('dokter');
        $nokartu = $this->request->getPost('nokartu');
        $statuspasien = $this->request->getPost('statuspasien');

        if (is_null($statuspasien) || $statuspasien == '') {
            $statuspasien = '%';
        }
        if (is_null($nama) || $nama == '') {
            $nama = '%';
        }
        if (is_null($kode) || $kode == '') {
            $kode = '%';
        }
        if (is_null($alamat) || $alamat == '') {
            $alamat = '%';
        }
        if (is_null($poli) || $poli == '') {
            $poli = '%';
        }
        if (is_null($sudah) || $sudah == '') {
            $sudah = '%';
        }
        if (is_null($dokter) || $dokter == '') {
            $dokter = '%';
        }
        if (is_null($nokartu) || $nokartu == '') {
            $nokartu = '%';
        }

        $nama = $kode;
        $nokartu = $kode;


        if ($poli == 'P013' || $poli == 'P016' || $poli == 'P015') {
            $pv = new PasienPenunjangModel();

            // $kunjungan = $this->lowerKey($pv->getKunjunganPenunjang($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu));
            $kunjungan = $this->lowerKey($pv->getKunjunganPenunjang($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu));
        } else {
            $pv = new PasienVisitationModel();

            $kunjungan = $this->lowerKey($pv->getKunjunganPoli($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu, $statuspasien));
        }



        // colecting parameter
        $wayModel = new VisitWayModel();
        $way = $this->lowerKey($wayModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $sexModel = new SexModel();
        $sex = $this->lowerKey($sexModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());

        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());

        $classRoomModel = new ClassRoomModel();
        $classRoom = $this->lowerKey($classRoomModel->findAll());

        $dt_data     = array();
        if (!empty($kunjungan)) {
            usort($kunjungan, function ($a, $b) {
                return strcmp($a['ticket_no'], $b['ticket_no']);
            });

            foreach ($kunjungan as $key => $value) {
                $kunjungan[$key]['way'] = '';
                $kunjungan[$key]['name_of_status_pasien'] = '';
                $kunjungan[$key]['name_of_gender'] = '';
                $kunjungan[$key]['nama_agama'] = '';
                $kunjungan[$key]['name_of_clinic'] = '';
                $kunjungan[$key]['name_of_clinic_from'] = '';
                $kunjungan[$key]['fullname'] = '';
                $kunjungan[$key]['name_of_class'] = '';
                $kunjungan[$key]['name_of_class_plafond'] = '';
                foreach ($way as $key1 => $value1) {
                    if ($kunjungan[$key]['way_id'] == $way[$key1]['way_id']) {
                        $kunjungan[$key]['way'] = $way[$key1]['way'];
                    }
                }
                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['name_of_status_pasien'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($sex as $key1 => $value1) {
                    if ($kunjungan[$key]['gender'] == $sex[$key1]['gender']) {
                        $kunjungan[$key]['name_of_gender'] = $sex[$key1]['name_of_gender'];
                    }
                }
                foreach ($agama as $key1 => $value1) {
                    if ($kunjungan[$key]['kode_agama'] == $agama[$key1]['kode_agama']) {
                        $kunjungan[$key]['nama_agama'] = $agama[$key1]['nama_agama'];
                    }
                }
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                    }
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                $kunjungan[$key]['name_of_class_room'] = '';
                if (!is_null($kunjungan[$key]['class_room_id']) && ($kunjungan[$key]['class_room_id'] != '')) {
                    // dd($value['class_room_id']);
                    foreach ($classRoom as $key1 => $value1) {
                        if ($kunjungan[$key]['class_room_id'] == $classRoom[$key1]['class_room_id']) {
                            $kunjungan[$key]['name_of_class_room'] = $classRoom[$key1]['name_of_class'];
                            break;
                        }
                    }
                }
                $kunjungan[$key]['fullname'] = '';
                $kunjungan[$key]['fullname_from'] = '';
                foreach ($employee as $key1 => $value1) {
                    if ($employee[$key1]['employee_id'] == @$kunjungan[$key]['employee_id']) {
                        $kunjungan[$key]['fullname'] = $employee[$key1]['fullname'];
                    }
                    if ($employee[$key1]['employee_id'] == @$kunjungan[$key]['employee_id_from']) {
                        $kunjungan[$key]['fullname_from'] = $employee[$key1]['fullname'];
                    }
                    if ($employee[$key1]['employee_id'] == @$kunjungan[$key]['employee_inap']) {
                        $kunjungan[$key]['fullname_inap'] = $employee[$key1]['fullname'];
                    }
                }
                $kunjungan[$key]['name_of_class'] = '';
                $kunjungan[$key]['name_of_class_plafond'] = '';
                foreach ($class as $key1 => $value1) {
                    if ($kunjungan[$key]['class_id'] == @$class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class'] = $class[$key1]['name_of_class'];
                    }
                    if ($kunjungan[$key]['class_id_plafond'] == @$class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class_plafond'] = $class[$key1]['name_of_class'];
                    }
                }
                $locked = '';

                if (@$kunjungan[$key]['locked'] == '1') {
                    $locked = 'Valid Lock';
                } elseif (@$kunjungan[$key]['locked'] == '2') {
                    $locked = 'Close';
                } elseif (@$kunjungan[$key]['locked'] == '5') {
                    $locked = 'Close Billing';
                } else {
                    $locked = 'Open';
                }

                if (!is_null(@$kunjungan[$key]['rm_in_date'])) {
                    $kunjungan[$key]['rm_in_date'] = '<br>DRM - Kembali';
                } else {
                    $kunjungan[$key]['rm_in_date'] = '';
                }

                $id = $kunjungan[$key]['no_registration'];
                $info_data   = array('Rawat Jalan', 'Rawat Inap', 'Radiologi', 'Lab', 'Farmasi', 'Operasi');
                $info_url    = array();

                $info_url[0] = base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'];
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

                $row = array();

                $ranap = '';
                if (!is_null($kunjungan[$key]['class_room_id']) && ($kunjungan[$key]['class_room_id'] != '')) {
                    $ranap = '<h5 class="text-danger">RAWAT INAP - ' . $kunjungan[$key]['name_of_class_room'] . '</h5>';
                }
                $action = '<button type="button" name="panggil" onclick=\'panggilPasien("' . $kunjungan[$key]['visit_id'] . '", "' . $kunjungan[$key]['ticket_no'] . '", "' . $kunjungan[$key]['trans_id'] . '", "' . $kunjungan[$key]['no_registration'] . '")\' class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-bullhorn"></i> Panggil</button>';

                if ($poli == 'P013') {
                    $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/profilepenunjang/' . $kunjungan[$key]['visit_id'] . "/" . base64_encode(json_encode($kunjungan[$key])) . "' style='text-align: left !important'>";
                } else {
                    $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'] . "' style='text-align: left !important'>";
                }


                //==============================
                $row[] = $kunjungan[$key]['ticket_no'];
                if (@$kunjungan[$key]['status_panggil'] == '1' || @$kunjungan[$key]['isattended'] == '1') {
                    if (@$kunjungan[$key]['tbc'] > 0) {
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "<i class=\"fa fa-check-circle\"></i></a><p class=\"bg-warning\">Terindikasi TBC</p>";
                    } else {
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "<i class=\"fa fa-check-circle\"></i></a>";
                    }
                } else {
                    if (@$kunjungan[$key]['tbc'] > 0) {
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "</a><span id=\"antrian{$kunjungan[$key]['visit_id']}\"></span><p class=\"bg-warning\">Terindikasi TBC</p>";
                    } else {
                        // $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "</a><span id=\"antrian{$kunjungan[$key]['visit_id']}\"></span>";
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "</a>";
                    }
                }
                $row2 =  substr($kunjungan[$key]['visit_date'], 8, 2) . "/" . substr($kunjungan[$key]['visit_date'], 5, 2) . "/" . substr($kunjungan[$key]['visit_date'], 0, 4) . " " . substr($kunjungan[$key]['visit_date'], 11, 5) . "<br>" . substr(@$kunjungan[$key]['tgl_lahir'], 8, 2) . "/" . substr(@$kunjungan[$key]['tgl_lahir'], 5, 2) . "/" . substr(@$kunjungan[$key]['tgl_lahir'], 0, 4);
                if ($poli == 'P013' || $poli == 'P016' || $poli == 'P015')
                    $row2 .= '<br><i>Pemeriksaan: <b>' . html_entity_decode(@$kunjungan[$key]['laboratorium']) . '</b></i>';
                if ($poli == 'P012') {
                    if (@$kunjungan[$key]['patient_category_id'] == 1)
                        $row2 .= '<br><span class="bg-success"><i><b>Tidak Emergency</b></i></span>';
                    else if (@$kunjungan[$key]['patient_category_id'] == 2)
                        $row2 .= '<br><span class="bg-danger"><i><b>False Emergency</b></i></span>';
                    else if (@$kunjungan[$key]['patient_category_id'] == 3)
                        $row2 .= '<br><span class="bg-danger"><i><b>Emergency</b></i></span>';
                }
                $row[] = $row2;
                $row[] = $kunjungan[$key]['name_of_status_pasien'] . "/" . $kunjungan[$key]['name_of_gender'] . "/" . $kunjungan[$key]['nama_agama'] . "<br>" . $ranap;
                $row[] = "<b>" . $kunjungan[$key]['name_of_clinic'] . "</b><br><b>" . $kunjungan[$key]['fullname'] . "</b><br>" . $kunjungan[$key]['name_of_class'];

                $row[] = $kunjungan[$key]['no_skp'] . "<br>No. Rujukan : " . $kunjungan[$key]['norujukan'] . " Tgl : " . substr($kunjungan[$key]['tanggal_rujukan'], 8, 2) . "/" . substr($kunjungan[$key]['tanggal_rujukan'], 5, 2) . "/" . substr($kunjungan[$key]['tanggal_rujukan'], 0, 4)
                    . "<br>NIK: " . $kunjungan[$key]['npk'];
                $row[] = $kunjungan[$key]['name_of_clinic_from'] . "<br>" . $kunjungan[$key]['name_of_class_plafond'] . "<br>" . $locked . "<br>" . $kunjungan[$key]['isattended'];
                $row[] = $action;
                $dt_data[] = $row;
            }
        }
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);
    }

    public function getoperationdatatable($searchtype = null)
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $pv = new PasienVisitationModel();

        $nama = $this->request->getPost('nama');
        $kode = $this->request->getPost('norm');
        $alamat = $this->request->getPost('address');
        $poli = $this->request->getPost('klinik');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $sudah = '%';
        $dokter = $this->request->getPost('dokter');
        $nokartu = $this->request->getPost('nokartu');

        if (is_null($nama) || $nama == '') {
            $nama = '%';
        }
        if (is_null($kode) || $kode == '') {
            $kode = '%';
        }
        if (is_null($alamat) || $alamat == '') {
            $alamat = '%';
        }
        if (is_null($poli) || $poli == '') {
            $poli = '%';
        }
        if (is_null($sudah) || $sudah == '') {
            $sudah = '%';
        }
        if (is_null($dokter) || $dokter == '') {
            $dokter = '%';
        }
        if (is_null($nokartu) || $nokartu == '') {
            $nokartu = '%';
        }

        $nama = $kode;
        // return json_encode([
        //     $nama,
        //     $kode, 
        //     $alamat,
        //     $poli,
        //     $mulai,
        //     $akhir,
        //     $sudah,
        //     $dokter,
        //     $nokartu
        // ]);
        $kunjungan = $this->lowerKey($pv->getKunjunganOperasi($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu));

        // $sql = "DECLARE	@return_value int

        //     EXEC	@return_value = [dbo].[SP_SEARCHKUNJUNGANRIAKOM_FORM]
        //             @X = N'100',
        //             @NAMA = N'%$nama%',
        //             @KODE = N'%$kode%',
        //             @ALAMAT = N'%$alamat%',
        //             @POLI = N'%$poli%',
        //             @MULAI = N'$mulai',
        //             @AKHIR = N'$akhir',
        //             @KELUAR = N'%',
        //             @SUDAH = N'%$sudah%',
        //             @DOKTER = N'%$dokter%',
        //             @NOKARTU = N'%$nokartu%'

        //     SELECT	'Return Value' = @return_value";

        // return json_encode($sql);

        // colecting parameter
        $tarifModel = new TreatTarifModel();
        $tarif = $this->lowerKey($tarifModel->where("LEFT(tarif_id,2) = '13'")->select("tarif_name, tarif_id")->findAll());


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {


                $row = array();
                //====================================
                // $action = "<div class='rowoptionview rowview-mt-19'>";
                // $action .= "<a href=" . base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'] . " target='_blank' class='btn btn-default btn-xs' style='width: 100%;' data-toggle='tooltip' title='" . lang('Word.show') . "'><i class='fa fa-reorder' aria-hidden='true'></i></a>";
                // $action .= "</div'>";
                $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/profilepenunjang/' . $kunjungan[$key]['visit_id'] . "/" . base64_encode(json_encode($kunjungan[$key])) . "' style='text-align: left !important'>";
                //==============================
                // echo $key;
                $row[] = '<h4 style="margin: auto;
                padding: 20px;padding-left: 10px;">' . (string)((int)$key + 1) . ". </h4>";
                $row[] = $first_action . "" . $kunjungan[$key]['name_of_pasien'] . " - " . $kunjungan[$key]['no_registration'] . "</a>";
                $row[] = $kunjungan[$key]['ageyear'] . "th " . $kunjungan[$key]['agemonth'] . "bln " . $kunjungan[$key]['ageday'] . "hr";
                $row[] = $kunjungan[$key]['name_of_clinic'];
                $row[] = substr($kunjungan[$key]['treat_date'], 8, 2) . "/" . substr($kunjungan[$key]['treat_date'], 5, 2) . "/" . substr($kunjungan[$key]['treat_date'], 0, 4) . " " . substr($kunjungan[$key]['treat_date'], 11, 2) . "-" . substr($kunjungan[$key]['treat_date'], 14, 2);
                // $row[] = $kunjungan[$key]['tarif_id'];
                $tarifid = $kunjungan[$key]['tarif_id'];
                $row[] = array_column(array_filter($tarif, function ($value) use ($tarifid) {
                    return $value['tarif_id'] == $tarifid;
                }), 'tarif_name');
                $row[] = "<b>" . $kunjungan[$key]['dr_opr'] . "</b>";
                $row[] = '';
                $dt_data[] = $row;
            }
        }
        // return 'json_encode($kunjungan)';
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);
    }
    public function getcasemixdatatable($searchtype = null)
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $nama = $this->request->getPost('nama');
        $kode = $this->request->getPost('norm');
        $alamat = $this->request->getPost('address');
        $poli = $this->request->getPost('klinik');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $sudah = '%';
        $dokter = $this->request->getPost('dokter');
        $nokartu = $this->request->getPost('nokartu');
        $statuspasien = $this->request->getPost('statuspasien');

        if (is_null($statuspasien) || $statuspasien == '') {
            $statuspasien = '%';
        }
        if (is_null($nama) || $nama == '') {
            $nama = '%';
        }
        if (is_null($kode) || $kode == '') {
            $kode = '%';
        }
        if (is_null($alamat) || $alamat == '') {
            $alamat = '%';
        }
        if (is_null($poli) || $poli == '') {
            $poli = '%';
        }
        if (is_null($sudah) || $sudah == '') {
            $sudah = '%';
        }
        if (is_null($dokter) || $dokter == '') {
            $dokter = '%';
        }
        if (is_null($nokartu) || $nokartu == '') {
            $nokartu = '%';
        }

        $nama = $kode;
        $nokartu = $kode;


        if (false) {
            $pv = new PasienPenunjangModel();

            // $kunjungan = $this->lowerKey($pv->getKunjunganPenunjang($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu));
            $kunjungan = $this->lowerKey($pv->getKunjunganPenunjang($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu));
        } else {
            $pv = new PasienVisitationModel();

            $kunjungan = $this->lowerKey($pv->getKunjunganCasemix($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu, $statuspasien));
        }



        // colecting parameter
        $wayModel = new VisitWayModel();
        $way = $this->lowerKey($wayModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $sexModel = new SexModel();
        $sex = $this->lowerKey($sexModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());

        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());

        $classRoomModel = new ClassRoomModel();
        $classRoom = $this->lowerKey($classRoomModel->findAll());

        $dt_data     = array();
        if (!empty($kunjungan)) {
            usort($kunjungan, function ($a, $b) {
                return strcmp($a['ticket_no'], $b['ticket_no']);
            });

            foreach ($kunjungan as $key => $value) {
                $kunjungan[$key]['way'] = '';
                $kunjungan[$key]['name_of_status_pasien'] = '';
                $kunjungan[$key]['name_of_gender'] = '';
                $kunjungan[$key]['nama_agama'] = '';
                $kunjungan[$key]['name_of_clinic'] = '';
                $kunjungan[$key]['name_of_clinic_from'] = '';
                $kunjungan[$key]['fullname'] = '';
                $kunjungan[$key]['name_of_class'] = '';
                $kunjungan[$key]['name_of_class_plafond'] = '';
                foreach ($way as $key1 => $value1) {
                    if ($kunjungan[$key]['way_id'] == $way[$key1]['way_id']) {
                        $kunjungan[$key]['way'] = $way[$key1]['way'];
                    }
                }
                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['name_of_status_pasien'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($sex as $key1 => $value1) {
                    if ($kunjungan[$key]['gender'] == $sex[$key1]['gender']) {
                        $kunjungan[$key]['name_of_gender'] = $sex[$key1]['name_of_gender'];
                    }
                }
                foreach ($agama as $key1 => $value1) {
                    if ($kunjungan[$key]['kode_agama'] == $agama[$key1]['kode_agama']) {
                        $kunjungan[$key]['nama_agama'] = $agama[$key1]['nama_agama'];
                    }
                }
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                    }
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                $kunjungan[$key]['name_of_class_room'] = '';
                if (!is_null($kunjungan[$key]['class_room_id']) && ($kunjungan[$key]['class_room_id'] != '')) {
                    // dd($value['class_room_id']);
                    foreach ($classRoom as $key1 => $value1) {
                        if ($kunjungan[$key]['class_room_id'] == $classRoom[$key1]['class_room_id']) {
                            $kunjungan[$key]['name_of_class_room'] = $classRoom[$key1]['name_of_class'];
                            break;
                        }
                    }
                }
                $kunjungan[$key]['fullname'] = '';
                $kunjungan[$key]['fullname_from'] = '';
                foreach ($employee as $key1 => $value1) {
                    if ($employee[$key1]['employee_id'] == @$kunjungan[$key]['employee_id']) {
                        $kunjungan[$key]['fullname'] = $employee[$key1]['fullname'];
                    }
                    if ($employee[$key1]['employee_id'] == @$kunjungan[$key]['employee_id_from']) {
                        $kunjungan[$key]['fullname_from'] = $employee[$key1]['fullname'];
                    }
                    if ($employee[$key1]['employee_id'] == @$kunjungan[$key]['employee_inap']) {
                        $kunjungan[$key]['fullname_inap'] = $employee[$key1]['fullname'];
                    }
                }
                $kunjungan[$key]['name_of_class'] = '';
                $kunjungan[$key]['name_of_class_plafond'] = '';
                foreach ($class as $key1 => $value1) {
                    if ($kunjungan[$key]['class_id'] == @$class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class'] = $class[$key1]['name_of_class'];
                    }
                    if ($kunjungan[$key]['class_id_plafond'] == @$class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class_plafond'] = $class[$key1]['name_of_class'];
                    }
                }
                $locked = '';

                if (@$kunjungan[$key]['locked'] == '1') {
                    $locked = 'Valid Lock';
                } elseif (@$kunjungan[$key]['locked'] == '2') {
                    $locked = 'Close';
                } elseif (@$kunjungan[$key]['locked'] == '5') {
                    $locked = 'Close Billing';
                } else {
                    $locked = 'Open';
                }

                if (!is_null(@$kunjungan[$key]['rm_in_date'])) {
                    $kunjungan[$key]['rm_in_date'] = '<br>DRM - Kembali';
                } else {
                    $kunjungan[$key]['rm_in_date'] = '';
                }

                $id = $kunjungan[$key]['no_registration'];
                $info_data   = array('Rawat Jalan', 'Rawat Inap', 'Radiologi', 'Lab', 'Farmasi', 'Operasi');
                $info_url    = array();

                $info_url[0] = base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'];
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

                $row = array();

                $ranap = '';
                if (!is_null($kunjungan[$key]['class_room_id']) && ($kunjungan[$key]['class_room_id'] != '')) {
                    $ranap = '<h5 class="text-danger">RAWAT INAP - ' . $kunjungan[$key]['name_of_class_room'] . '</h5>';
                }
                $action = '<button type="button" name="panggil" onclick=\'panggilPasien("' . $kunjungan[$key]['visit_id'] . '", "' . $kunjungan[$key]['ticket_no'] . '", "' . $kunjungan[$key]['trans_id'] . '", "' . $kunjungan[$key]['no_registration'] . '")\' class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-bullhorn"></i> Panggil</button>';

                if (!is_null($kunjungan[$key]['class_room_id']) && ($kunjungan[$key]['class_room_id'] != '')) {
                    $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/profileranap/' . $kunjungan[$key]['visit_id'] . "/" . base64_encode(json_encode($kunjungan[$key])) . "/" . $this->get_bodyid() . "' style='text-align: left !important'>";
                } else {
                    $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'] . "/" . base64_encode(json_encode($kunjungan[$key])) . "' style='text-align: left !important'>";
                }


                //==============================
                $tgl = substr($kunjungan[$key]['visit_date'], 8, 2) . "/" . substr($kunjungan[$key]['visit_date'], 5, 2) . "/" . substr($kunjungan[$key]['visit_date'], 0, 4) . " " . substr($kunjungan[$key]['visit_date'], 11, 5);
                if (!is_null($kunjungan[$key]['class_room_id']) && ($kunjungan[$key]['class_room_id'] != '')) {
                    $tgl = $tgl . " - " . substr($kunjungan[$key]['exit_date'], 8, 2) . "/" . substr($kunjungan[$key]['exit_date'], 5, 2) . "/" . substr($kunjungan[$key]['exit_date'], 0, 4) . " " . substr($kunjungan[$key]['exit_date'], 11, 5);
                }
                $row2 =  $tgl;
                if ($poli == 'P013' || $poli == 'P016' || $poli == 'P015')
                    $row2 .= '<br><i>Pemeriksaan: <b>' . html_entity_decode(@$kunjungan[$key]['laboratorium']) . '</b></i>';
                if ($poli == 'P012') {
                    if (@$kunjungan[$key]['patient_category_id'] == 1)
                        $row2 .= '<br><span class="bg-success"><i><b>Tidak Emergency</b></i></span>';
                    else if (@$kunjungan[$key]['patient_category_id'] == 2)
                        $row2 .= '<br><span class="bg-danger"><i><b>False Emergency</b></i></span>';
                    else if (@$kunjungan[$key]['patient_category_id'] == 3)
                        $row2 .= '<br><span class="bg-danger"><i><b>Emergency</b></i></span>';
                }
                $row[] = $row2;
                $row[] = $kunjungan[$key]['no_skp'];
                if (@$kunjungan[$key]['status_panggil'] == '1' || @$kunjungan[$key]['isattended'] == '1') {
                    if (@$kunjungan[$key]['tbc'] > 0) {
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "<i class=\"fa fa-check-circle\"></i></a><p class=\"bg-warning\">Terindikasi TBC</p>";
                    } else {
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "<i class=\"fa fa-check-circle\"></i></a>";
                    }
                } else {
                    if (@$kunjungan[$key]['tbc'] > 0) {
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "</a><span id=\"antrian{$kunjungan[$key]['visit_id']}\"></span><p class=\"bg-warning\">Terindikasi TBC</p>";
                    } else {
                        // $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "</a><span id=\"antrian{$kunjungan[$key]['visit_id']}\"></span>";
                        $row[] = $first_action . "" . $kunjungan[$key]['diantar_oleh'] . " - " . $kunjungan[$key]['no_registration'] . "</a>";
                    }
                }
                $row[] = $kunjungan[$key]['name_of_status_pasien'] . "/" . $kunjungan[$key]['name_of_gender'] . "/" . $kunjungan[$key]['nama_agama'] . "<br>" . $ranap;
                $row[] = "<b>" . $kunjungan[$key]['name_of_clinic'] . "</b><br><b>" . $kunjungan[$key]['fullname'] . "</b><br>" . $kunjungan[$key]['name_of_class'];

                $row[] = "<br>No. Rujukan : " . $kunjungan[$key]['norujukan'] . " Tgl : " . substr($kunjungan[$key]['tanggal_rujukan'], 8, 2) . "/" . substr($kunjungan[$key]['tanggal_rujukan'], 5, 2) . "/" . substr($kunjungan[$key]['tanggal_rujukan'], 0, 4)
                    . "<br>NIK: " . $kunjungan[$key]['npk'];
                $row[] = $kunjungan[$key]['name_of_clinic_from'] . "<br>" . $kunjungan[$key]['name_of_class_plafond'] . "<br>" . $locked . "<br>" . $kunjungan[$key]['isattended'];
                $row[] = "";
                $dt_data[] = $row;
            }
        }
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);
    }

    public function cekData()
    {
        $giTipe = $this->request->getPost("giTipe");
        $nama = $this->request->getPost('nama');
        $kode = '085892';
        $alamat = $this->request->getPost('address');
        $poli = $this->request->getPost('klinik');
        $mulai = '2025-03-09';
        $akhir = '2025-03-10';
        $sudah = '%';
        $dokter = $this->request->getPost('dokter');
        $nokartu = $this->request->getPost('nokartu');
        $keluar = $this->request->getPost('keluar_id');
        $x = 25;

        if (is_null($nama) || $nama == '') {
            $nama = '%';
        }
        if (is_null($kode) || $kode == '') {
            $kode = '%';
        }
        if (is_null($alamat) || $alamat == '') {
            $alamat = '%';
        }
        if (is_null($poli) || $poli == '') {
            $poli = '%';
        }
        if (is_null($sudah) || $sudah == '') {
            $sudah = '%';
        }
        if (is_null($dokter) || $dokter == '') {
            $dokter = '%';
        }
        if (is_null($nokartu) || $nokartu == '') {
            $nokartu = '%';
        }
        $pv = new PasienPenunjangModel();
        $kunjungan = $this->lowerKey($pv->getKunjunganPenunjang($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu));
        dd($kunjungan);
    }

    public function getipddatatable()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $ta = new TreatmentAkomodasiModel();

        $giTipe = $this->request->getPost("giTipe");
        $nama = $this->request->getPost('nama');
        $kode = $this->request->getPost('norm');
        $alamat = $this->request->getPost('address');
        $poli = $this->request->getPost('klinik');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $sudah = '%';
        $dokter = $this->request->getPost('dokter');
        $nokartu = $this->request->getPost('nokartu');
        $keluar = $this->request->getPost('keluar_id');
        $x = 100;

        if (is_null($nama) || $nama == '') {
            $nama = '%';
        }
        if (is_null($kode) || $kode == '') {
            $kode = '%';
        }
        if (is_null($alamat) || $alamat == '') {
            $alamat = '%';
        }
        if (is_null($poli) || $poli == '') {
            $poli = '%';
        }
        if (is_null($sudah) || $sudah == '') {
            $sudah = '%';
        }
        if (is_null($dokter) || $dokter == '') {
            $dokter = '%';
        }
        if (is_null($nokartu) || $nokartu == '') {
            $nokartu = '%';
        }

        if ($giTipe == 22) {
            $kunjungan = $this->lowerKey($ta->getPasienRanapBidan($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu, $keluar, $x));
        } else {
            $kunjungan = $this->lowerKey($ta->getPasienRanap($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu, $keluar, $x));
        }
        // return json_encode($kunjungan);

        // colecting parameter
        $wayModel = new VisitWayModel();
        $way = $this->lowerKey($wayModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $sexModel = new SexModel();
        $sex = $this->lowerKey($sexModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());

        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());

        $ck = new CaraKeluarModel();
        $caraKeluar = $this->lowerKey($ck->findAll());

        $payorModel = new PayorModel();
        $payor = $this->lowerKey($payorModel->findAll());

        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel);


        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {
                $kunjungan[$key]['way'] = null;
                $kunjungan[$key]['name_of_status_pasien'] = null;
                $kunjungan[$key]['name_of_gender'] = null;
                $kunjungan[$key]['nama_agama'] = null;
                $kunjungan[$key]['name_of_clinic'] = null;
                $kunjungan[$key]['name_of_clinic_from'] = null;
                $kunjungan[$key]['fullname'] = null;
                $kunjungan[$key]['cara_keluar'] = null;
                $kunjungan[$key]['name_of_class'] = null;
                $kunjungan[$key]['cara_keluar'] = null;
                $kunjungan[$key]['name_of_class_plafond'] = null;
                $kunjungan[$key]['payor'] = null;

                $kunjungan[$key]['way'] = '';
                foreach ($way as $key1 => $value1) {
                    if ($kunjungan[$key]['way_id'] == $way[$key1]['way_id']) {
                        $kunjungan[$key]['way'] = $way[$key1]['way'];
                    }
                }
                $kunjungan[$key]['name_of_status_pasien'] = '';
                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['name_of_status_pasien'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                $kunjungan[$key]['name_of_gender'] = '';
                foreach ($sex as $key1 => $value1) {
                    if ($kunjungan[$key]['gender'] == $sex[$key1]['gender']) {
                        $kunjungan[$key]['name_of_gender'] = $sex[$key1]['name_of_gender'];
                    }
                }
                $kunjungan[$key]['nama_agama'] = '';
                foreach ($agama as $key1 => $value1) {
                    if ($kunjungan[$key]['kode_agama'] == $agama[$key1]['kode_agama']) {
                        $kunjungan[$key]['nama_agama'] = $agama[$key1]['nama_agama'];
                    }
                }
                $kunjungan[$key]['name_of_clinic'] = '';
                $kunjungan[$key]['name_of_clinic_from'] = '';
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                    }
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                // return json_encode($employee);
                $kunjungan[$key]['fullname'] = '';
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['fullname'] = $employee[$key1]['fullname'];
                    }
                }
                $kunjungan[$key]['cara_keluar'] = '';
                foreach ($caraKeluar as $key1 => $value1) {
                    if ($kunjungan[$key]['keluar_id'] == $caraKeluar[$key1]['keluar_id']) {
                        $kunjungan[$key]['cara_keluar'] = $caraKeluar[$key1]['cara_keluar'];
                    }
                }
                $kunjungan[$key]['name_of_class'] = '';
                $kunjungan[$key]['name_of_class_plafond'] = '';
                foreach ($class as $key1 => $value1) {
                    if ($kunjungan[$key]['class_id'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class'] = $class[$key1]['name_of_class'];
                    }
                    if ($kunjungan[$key]['class_id_plafond'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class_plafond'] = $class[$key1]['name_of_class'];
                    }
                }
                $kunjungan[$key]['payor'] = '';
                foreach ($payor as $key1 => $value1) {
                    if ($kunjungan[$key]['payor_id'] == $payor[$key1]['payor_id']) {
                        $kunjungan[$key]['payor'] = $payor[$key1]['payor'];
                    }
                }
                // if ($kunjungan[$key]['locked'] == '1') {
                //     $kunjungan[$key]['locked'] == 'Valid Lock';
                // } elseif ($kunjungan[$key]['locked'] == '2') {
                //     $kunjungan[$key]['locked'] == 'Close';
                // } elseif ($kunjungan[$key]['locked'] == '5') {
                //     $kunjungan[$key]['locked'] == 'Close Billing';
                // } elseif ($kunjungan[$key]['locked'] == '0') {
                //     $kunjungan[$key]['locked'] == 'Open';
                // }

                // if (!is_null($kunjungan[$key]['rm_in_date'])) {
                //     $kunjungan[$key]['rm_in_date'] = '<br>DRM - Kembali';
                // } else {
                //     $kunjungan[$key]['rm_in_date'] = '';
                // }


                $row = array();
                //====================================
                $action = "<div class='rowoptionview rowview-mt-19'>";
                $action .= "<a href=" . base_url() . 'admin/patient/redirectProfileRanap/' . $kunjungan[$key]['visit_id'] . " target='_blank' class='btn btn-default btn-xs' style='width: 100%;' data-toggle='tooltip' title='" . lang('Word.show') . "'><i class='fa fa-reorder' aria-hidden='true'></i></a>";
                $action .= "</div'>";
                $first_action = "<button  onclick=\"listSesi('" . $kunjungan[$key]['trans_id'] . "','" . $kunjungan[$key]['visit_id'] . "','" . $kunjungan[$key]['no_registration'] . "', '" . base64_encode(json_encode($kunjungan[$key])) . "')\" class=\"btn btn-primary\">";
                // $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/redirectProfileRanap/' . $kunjungan[$key]['visit_id'] . "/" . base64_encode(json_encode($kunjungan[$key])) . "' style='text-align: left !important'>";
                //==============================
                // $row[] = '<p style="margin: auto;
                // width: 50%;
                // text-align: left;
                // padding: 10px;">' . ($key + 1) . ".</p>";
                // $visit_date = substr(date('Y-m-d H:i', strtotime('1900-01-01 + ' . ($kunjungan[$key]['visit_date'] - 2) . ' days')), 0, 16);
                $visit_date = $kunjungan[$key]['visit_date'];
                // return json_encode($kunjungan);
                $row[] = $key + 1;
                $row[] = substr($visit_date, 8, 2) . "/" . substr($visit_date, 5, 2) . "/" . substr($visit_date, 0, 4) . " " . substr($visit_date, 11, 2) . ":" . substr($visit_date, 14, 2);
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $first_action . "" . $kunjungan[$key]['name_of_pasien'] . "" . "</a>"; // . $action;
                $row[] = $kunjungan[$key]['contact_address'] .  "<br>No. Jaminan: " . $kunjungan[$key]['pasien_id'] . "<br>No. SEP: " . $kunjungan[$key]['no_skpinap'];
                $row[] = $kunjungan[$key]['name_of_status_pasien'] . "<br>" . $kunjungan[$key]['name_of_gender'] . "<br>" . $kunjungan[$key]['nama_agama'];
                $row[] = $kunjungan[$key]['name_of_clinic'] .  "<br>Nomor Bed:" . $kunjungan[$key]['bed_id'] . "<br>" . $kunjungan[$key]['fullname'] . "<br>Phone1:" . $kunjungan[$key]['phone_number'] . "<br>Phone2:" . $kunjungan[$key]['mobile'];
                $row[] = $kunjungan[$key]['name_of_clinic_from'] .  "<br>" . $kunjungan[$key]['cara_keluar'] .  "<br><b>Tgl Masuk</b>: " . substr($visit_date, 8, 2) . "/" . substr($visit_date, 5, 2) . "/" . substr($visit_date, 0, 4) . " " . substr($visit_date, 11, 2) . ":" . substr($visit_date, 14, 2);
                // $row[] = $kunjungan[$key]['name_of_clinic_from'] .  "<br>" . $kunjungan[$key]['cara_keluar'] .  "<br><b>Tgl Masuk</b>: " .  . "<br>" . substr($kunjungan[$key]['treat_date'], 0, 16);
                // $row[] = $kunjungan[$key]['rm_in_date'];
                $row[] = substr($kunjungan[$key]['date_of_birth'], 0, 10) . "<br>" . $kunjungan[$key]['ageyear'] . "th " . $kunjungan[$key]['agemonth'] . "bl " . $kunjungan[$key]['ageday'] . "hr";
                $row[] = 'Kelas Rawat: ' . $kunjungan[$key]['name_of_class'] . "<br>" . 'Hak Kelas: ' . $kunjungan[$key]['name_of_class_plafond'];
                $row[] = $kunjungan[$key]['consul_type'];
                $dt_data[] = $row;
            }
        }
        // return 'json_encode($kunjungan)';
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);

        // return json_encode($kunjungan);
    }
    public function backupgetipddatatable()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $ta = new TreatmentAkomodasiModel();

        $giTipe = $this->request->getPost("giTipe");
        $nama = $this->request->getPost('nama');
        $kode = $this->request->getPost('norm');
        $alamat = $this->request->getPost('address');
        $poli = $this->request->getPost('klinik');
        $mulai = $this->request->getPost('mulai');
        $akhir = $this->request->getPost('akhir');
        $sudah = '%';
        $dokter = $this->request->getPost('dokter');
        $nokartu = $this->request->getPost('nokartu');
        $keluar = $this->request->getPost('keluar_id');
        $x = 100;

        if (is_null($nama) || $nama == '') {
            $nama = '%';
        }
        if (is_null($kode) || $kode == '') {
            $kode = '%';
        }
        if (is_null($alamat) || $alamat == '') {
            $alamat = '%';
        }
        if (is_null($poli) || $poli == '') {
            $poli = '%';
        }
        if (is_null($sudah) || $sudah == '') {
            $sudah = '%';
        }
        if (is_null($dokter) || $dokter == '') {
            $dokter = '%';
        }
        if (is_null($nokartu) || $nokartu == '') {
            $nokartu = '%';
        }

        if ($giTipe == 22) {
            $kunjungan = $this->lowerKey($ta->getPasienRanapBidan($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu, $keluar, $x));
        } else {
            $kunjungan = $this->lowerKey($ta->getPasienRanap($nama, $kode, $alamat, $poli, $mulai, $akhir, $sudah, $dokter, $nokartu, $keluar, $x));
        }
        // return json_encode($kunjungan);

        // colecting parameter
        $wayModel = new VisitWayModel();
        $way = $this->lowerKey($wayModel->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $sexModel = new SexModel();
        $sex = $this->lowerKey($sexModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());

        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());

        $ck = new CaraKeluarModel();
        $caraKeluar = $this->lowerKey($ck->findAll());

        $payorModel = new PayorModel();
        $payor = $this->lowerKey($payorModel->findAll());

        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel);


        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {
                $kunjungan[$key]['way'] = null;
                $kunjungan[$key]['name_of_status_pasien'] = null;
                $kunjungan[$key]['name_of_gender'] = null;
                $kunjungan[$key]['nama_agama'] = null;
                $kunjungan[$key]['name_of_clinic'] = null;
                $kunjungan[$key]['name_of_clinic_from'] = null;
                $kunjungan[$key]['fullname'] = null;
                $kunjungan[$key]['cara_keluar'] = null;
                $kunjungan[$key]['name_of_class'] = null;
                $kunjungan[$key]['cara_keluar'] = null;
                $kunjungan[$key]['name_of_class_plafond'] = null;
                $kunjungan[$key]['payor'] = null;

                $kunjungan[$key]['way'] = '';
                foreach ($way as $key1 => $value1) {
                    if ($kunjungan[$key]['way_id'] == $way[$key1]['way_id']) {
                        $kunjungan[$key]['way'] = $way[$key1]['way'];
                    }
                }
                $kunjungan[$key]['name_of_status_pasien'] = '';
                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['name_of_status_pasien'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                $kunjungan[$key]['name_of_gender'] = '';
                foreach ($sex as $key1 => $value1) {
                    if ($kunjungan[$key]['gender'] == $sex[$key1]['gender']) {
                        $kunjungan[$key]['name_of_gender'] = $sex[$key1]['name_of_gender'];
                    }
                }
                $kunjungan[$key]['nama_agama'] = '';
                foreach ($agama as $key1 => $value1) {
                    if ($kunjungan[$key]['kode_agama'] == $agama[$key1]['kode_agama']) {
                        $kunjungan[$key]['nama_agama'] = $agama[$key1]['nama_agama'];
                    }
                }
                $kunjungan[$key]['name_of_clinic'] = '';
                $kunjungan[$key]['name_of_clinic_from'] = '';
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                    }
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['name_of_clinic_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                // return json_encode($employee);
                $kunjungan[$key]['fullname'] = '';
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['fullname'] = $employee[$key1]['fullname'];
                    }
                }
                $kunjungan[$key]['cara_keluar'] = '';
                foreach ($caraKeluar as $key1 => $value1) {
                    if ($kunjungan[$key]['keluar_id'] == $caraKeluar[$key1]['keluar_id']) {
                        $kunjungan[$key]['cara_keluar'] = $caraKeluar[$key1]['cara_keluar'];
                    }
                }
                $kunjungan[$key]['name_of_class'] = '';
                $kunjungan[$key]['name_of_class_plafond'] = '';
                foreach ($class as $key1 => $value1) {
                    if ($kunjungan[$key]['class_id'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class'] = $class[$key1]['name_of_class'];
                    }
                    if ($kunjungan[$key]['class_id_plafond'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['name_of_class_plafond'] = $class[$key1]['name_of_class'];
                    }
                }
                $kunjungan[$key]['payor'] = '';
                foreach ($payor as $key1 => $value1) {
                    if ($kunjungan[$key]['payor_id'] == $payor[$key1]['payor_id']) {
                        $kunjungan[$key]['payor'] = $payor[$key1]['payor'];
                    }
                }
                // if ($kunjungan[$key]['locked'] == '1') {
                //     $kunjungan[$key]['locked'] == 'Valid Lock';
                // } elseif ($kunjungan[$key]['locked'] == '2') {
                //     $kunjungan[$key]['locked'] == 'Close';
                // } elseif ($kunjungan[$key]['locked'] == '5') {
                //     $kunjungan[$key]['locked'] == 'Close Billing';
                // } elseif ($kunjungan[$key]['locked'] == '0') {
                //     $kunjungan[$key]['locked'] == 'Open';
                // }

                // if (!is_null($kunjungan[$key]['rm_in_date'])) {
                //     $kunjungan[$key]['rm_in_date'] = '<br>DRM - Kembali';
                // } else {
                //     $kunjungan[$key]['rm_in_date'] = '';
                // }


                $row = array();
                //====================================
                $action = "<div class='rowoptionview rowview-mt-19'>";
                $action .= "<a href=" . base_url() . 'admin/patient/redirectProfileRanap/' . $kunjungan[$key]['visit_id'] . " target='_blank' class='btn btn-default btn-xs' style='width: 100%;' data-toggle='tooltip' title='" . lang('Word.show') . "'><i class='fa fa-reorder' aria-hidden='true'></i></a>";
                $action .= "</div'>";
                $first_action = "<button  onclick=\"listSesi('" . $kunjungan[$key]['trans_id'] . "','" . $kunjungan[$key]['visit_id'] . "','" . $kunjungan[$key]['no_registration'] . "', '" . base64_encode(json_encode($kunjungan[$key])) . "')\" class=\"btn btn-primary\">";
                // $first_action = "<a target='_blank' href='" . base_url() . 'admin/patient/redirectProfileRanap/' . $kunjungan[$key]['visit_id'] . "/" . base64_encode(json_encode($kunjungan[$key])) . "' style='text-align: left !important'>";
                //==============================
                // $row[] = '<p style="margin: auto;
                // width: 50%;
                // text-align: left;
                // padding: 10px;">' . ($key + 1) . ".</p>";
                $visit_date = substr(date('Y-m-d H:i', strtotime('1900-01-01 + ' . ($kunjungan[$key]['visit_date'] - 2) . ' days')), 0, 16);
                $row[] = $key;
                $row[] = substr($visit_date, 8, 2) . "/" . substr($visit_date, 5, 2) . "/" . substr($visit_date, 0, 4) . " " . substr($visit_date, 11, 2) . ":" . substr($visit_date, 14, 2);
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $first_action . "" . $kunjungan[$key]['name_of_pasien'] . "" . "</a>"; // . $action;
                $row[] = $kunjungan[$key]['contact_address'] .  "<br>No. Jaminan: " . $kunjungan[$key]['pasien_id'] . "<br>No. SEP: " . $kunjungan[$key]['no_skpinap'];
                $row[] = $kunjungan[$key]['name_of_status_pasien'] . "<br>" . $kunjungan[$key]['gender'] . "<br>" . $kunjungan[$key]['kode_agama'];
                $row[] = $kunjungan[$key]['class_room'] .  "<br>" . $kunjungan[$key]['fullname'] . "<br>Phone1:" . $kunjungan[$key]['phone_number'] . "<br>Phone2:" . $kunjungan[$key]['mobile'];
                $row[] = $kunjungan[$key]['name_of_clinic_from'] .  "<br>" . $kunjungan[$key]['cara_keluar'] .  "<br><b>Tgl Masuk</b>: " . substr($visit_date, 8, 2) . "/" . substr($visit_date, 5, 2) . "/" . substr($visit_date, 0, 4) . " " . substr($visit_date, 11, 2) . ":" . substr($visit_date, 14, 2) . "<br>" . substr($kunjungan[$key]['treat_date'], 8, 2) . "/" . substr($kunjungan[$key]['treat_date'], 5, 2) . "/" . substr($kunjungan[$key]['treat_date'], 0, 4) . " " . substr($kunjungan[$key]['treat_date'], 11, 2) . "-" . substr($kunjungan[$key]['treat_date'], 14, 2);
                // $row[] = $kunjungan[$key]['name_of_clinic_from'] .  "<br>" . $kunjungan[$key]['cara_keluar'] .  "<br><b>Tgl Masuk</b>: " .  . "<br>" . substr($kunjungan[$key]['treat_date'], 0, 16);
                // $row[] = $kunjungan[$key]['rm_in_date'];
                $row[] = substr($kunjungan[$key]['date_of_birth'], 0, 10) . "<br>" . $kunjungan[$key]['ageyear'] . "th " . $kunjungan[$key]['agemonth'] . "bl " . $kunjungan[$key]['ageday'] . "hr";
                $row[] = $kunjungan[$key]['payor'] . "<br>" . $kunjungan[$key]['name_of_class'] . "<br>" . $kunjungan[$key]['name_of_class_plafond'];
                $row[] = $kunjungan[$key]['consul_type'];
                $dt_data[] = $row;
            }
        }
        // return 'json_encode($kunjungan)';
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);

        // return json_encode($kunjungan);
    }
    public function getPatientListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $p = new PasienModel();
            $result = $this->lowerKey($p->getPatientListfilter($search_term));
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['no_registration'], "text" => $value['name_of_pasien'] . " (" . $value['no_registration'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getDiagnosisListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        $clinic = $this->request->getPost("clinic");

        if (isset($clinic) && $clinic == 'gizi') {
            if (isset($search_term) && $search_term != '') {
                $p = new DiagnosaModel();
                $result = $this->lowerKey($p->getDiagnosaGizi($search_term));
                $data   = array();
                if (!empty($result)) {
                    foreach ($result as $value) {
                        $data[] = array("id" => $value['diagnosa_id'], "text" => $value['name_of_diagnosa'] . " (" . $value['diagnosa_id'] . ")");
                    }
                }

                echo json_encode($data);
            }
        } else {
            if (isset($search_term) && $search_term != '') {
                $p = new DiagnosaModel();
                $result = $this->lowerKey($p->getDiagnosa($search_term));
                $data   = array();
                if (!empty($result)) {
                    foreach ($result as $value) {
                        $data[] = array("id" => $value['diagnosa_id'], "text" => $value['name_of_diagnosa'] . " (" . $value['diagnosa_id'] . ")");
                    }
                }
                echo json_encode($data);
            }
        }
    }
    public function getDiagnosisPerawatListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $p = new DiagnosaPerawatModel();
            $result = $this->lowerKey($p->getDiagnosa($search_term));
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['diagnosan_id'], "text" => $value['diagnosan_name'] . " (" . $value['diagnosan_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getProcedureListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $p = new DiagnosaModel();
            $result = $this->lowerKey($p->getProcedures($search_term));
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['diagnosa_id'], "text" => $value['name_of_diagnosa'] . " (" . $value['diagnosa_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getObatNameListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $model = new GoodsModel();
            $result = $this->lowerKey($model->like('name', $search_term)->findAll());
            $data   = array();
            $data[] = array("id" => '%', "text" => "Semua (%)");
            $data[] = array("id" => $search_term, "text" => $search_term . " ()");
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['name'], "text" => $value['name'] . " (" . $value['brand_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getObatIdListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $model = new GoodsModel();
            $result = $this->lowerKey($model->like('name', $search_term)->findAll());
            $data   = array();
            // $data[] = array("id" => '%', "text" => "Semua (%)");
            // $data[] = array("id" => $search_term, "text" => $search_term . " ()");
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['brand_id'], "text" => $value['name'] . " (" . $value['brand_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getObatListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        $employee_id = $this->request->getPost('employeeId');
        if (isset($search_term) && $search_term != '') {
            $model = new GoodsModel();
            // $customObat = $this->lowerKeyOne($model->find('00000'));
            // $customObat['name'] = $search_term;
            // $result = $this->lowerKey($model->like('name', $search_term)->findAll());
            // $result = $this->lowerKey($model->getObatAlkesDokter($search_term, $employee_id));
            $result = $this->lowerKey($model->getObatDokter($search_term, $employee_id));
            $data   = array();
            // $data[] = array("id" => '%', "text" => "Semua (%)");
            // $data[] = array("id" => json_encode($customObat), "text" => $search_term . "");
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => json_encode($value), "text" => $value['name'] . " (" . $value['brand_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getObatListAjaxRacik()
    {
        $search_term = $this->request->getPost("searchTerm");
        $employee_id = $this->request->getPost('employeeId');
        if (isset($search_term) && $search_term != '') {
            $model = new GoodsModel();
            // $customObat = $this->lowerKeyOne($model->find('00000'));
            // $customObat['name'] = $search_term;
            // $result = $this->lowerKey($model->like('name', $search_term)->findAll());
            // $result = $this->lowerKey($model->getObatAlkesDokter($search_term, $employee_id));
            $result = $this->lowerKey($model->getObatDokterRacik($search_term, $employee_id));
            $data   = array();
            // $data[] = array("id" => '%', "text" => "Semua (%)");
            // $data[] = array("id" => json_encode($customObat), "text" => $search_term . "");
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => json_encode($value), "text" => $value['name'] . " (" . $value['brand_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getObatAlkesListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        $employee_id = $this->request->getPost('employeeId');
        if (isset($search_term) && $search_term != '') {
            $model = new GoodsModel();
            // $customObat = $this->lowerKeyOne($model->find('00000'));
            // $customObat['name'] = $search_term;
            // $result = $this->lowerKey($model->like('name', $search_term)->findAll());
            $result = $this->lowerKey($model->getObatAlkesDokter($search_term, $employee_id));
            $data   = array();
            // $data[] = array("id" => '%', "text" => "Semua (%)");
            // $data[] = array("id" => json_encode($customObat), "text" => $search_term . "");
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => json_encode($value), "text" => $value['name'] . " (" . $value['brand_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getObatAllListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        $employee_id = $this->request->getPost('employeeId');
        if (isset($search_term) && $search_term != '') {
            $model = new GoodsModel();
            // $customObat = $this->lowerKeyOne($model->find('00000'));
            // $customObat['name'] = $search_term;
            // $result = $this->lowerKey($model->like('name', $search_term)->findAll());
            $result = $this->lowerKey($model->getObatAll($search_term, $employee_id));
            $data   = array();
            // $data[] = array("id" => '%', "text" => "Semua (%)");
            // $data[] = array("id" => json_encode($customObat), "text" => $search_term . "");
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => json_encode($value), "text" => $value['name'] . " (" . $value['brand_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getDokterListAjax()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $p = new EmployeeAllModel();
            $result = $this->lowerKey($p->like('fullname', $search_term)->whereIn('object_category_id', ['20', '21'])->findAll());
            $data   = array();
            $data[] = array("id" => '%', "text" => "Semua (%)");

            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['fullname'], "text" => $value['fullname'] . " (" . $value['employee_id'] . ")");
                }
            }
            echo json_encode($data);
        }
    }

    public function getVisit()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();

        $visitIdKonsul = $body['visitIdKonsul'];

        $pv = new PasienVisitationModel();
        $select = $pv->find($visitIdKonsul);

        return json_encode($select);
    }
    public function addvisit()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        // return json_encode($norm);
        $rules = [
            'clinic_id' => 'required',
            'employee_id' => 'required',
            'kddpjp' => 'permit_empty|integer',
            'class_id' => 'required',
            'class_id_plafond' => 'required',
            'status_pasien_id' => 'required',
            'visit_date' => 'required',
            'booked_date' => 'required',
            'kdpoli_eks' => 'required',
            'isnew' => 'required',
            'cob' => 'required',
            'description' => 'permit_empty',
            'no_skp' => 'permit_empty',
            'no_skpinap' => 'permit_empty',
            'way_id' => 'required',
            'reason_id' => 'required',
            'isattended' => 'permit_empty',
            'asalrujukan' => 'permit_empty',
            'norujukan' => 'permit_empty',
            'kdpoli' => 'permit_empty',
            'tanggal_rujukan' => 'permit_empty',
            'ppkrujukan' => 'permit_empty',
            'diag_awal' => 'permit_empty',
            'conclusion' => 'permit_empty',
            'diagnosa_id' => 'permit_empty',
            'kdpolifrom' => 'permit_empty',
            'tujuankunj' => 'permit_empty',
            'kdpenunjang' => 'permit_empty',
            'flagprocedure' => 'permit_empty',
            'assesmentpel' => 'permit_empty',
            'edit_sep' => 'permit_empty',
            'specimenno' => 'permit_empty',
            'class_room_id' => '',
            'keluar_id' => '',
            'responsible' => '',
            'in_date' => '',
            'exit_date' => '',
            'no_registration' => 'required|integer',
            'diantar_oleh' => 'required',
            'visitor_address' => 'required',
            'org_unit_code' => 'required|integer',
            'tgl_lahir' => 'required',
            'gender' => 'required',
            'payor_id' => 'required',
            'clinic_id_from' => 'required',
            'pasien_id' => 'permit_empty|integer',
            'karyawan' => 'permit_empty',
            'family_status_id' => 'permit_empty',
            'account_id' => 'permit_empty',
            'coverage_Id' => 'permit_empty',
            'ageday' => 'required',
            'agemonth' => 'required',
            'ageyear' => 'required',
            'kode_agama' => 'required',
            'aktif' => 'required',
        ];

        // if (!$this->validate($rules)) {
        //     $validation = \Config\Services::validation();
        //     $errors = $validation->getErrors();
        //     $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
        //     return json_encode($array);
        // }


        // $p = new PasienModel();
        // $no_registration = $p->getNorm();

        $trans_id = $this->request->getPost('trans_id');
        $visit_id = $this->request->getPost('visit_id');
        $ticket_no = $this->request->getPost('ticket_no');
        $clinic_id = $this->request->getPost('clinic_id');
        $employee_id = $this->request->getPost('employee_id');
        $isrj = $this->request->getPost('isrj');
        $kddpjp = $this->request->getPost('kddpjp');
        $class_id = $this->request->getPost('class_id');
        $class_id_plafond = $this->request->getPost('class_id_plafond');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $visit_date = str_replace("T", " ", $this->request->getPost('visit_date'));
        $booked_date =  str_replace("T", " ", $this->request->getPost('booked_date'));
        $kdpoli_eks = $this->request->getPost('kdpoli_eks');
        $isnew = $this->request->getPost('isnew');
        $cob = $this->request->getPost('cob');
        $description = $this->request->getPost('description');
        $no_skp = $this->request->getPost('no_skp');
        $no_skpinap = $this->request->getPost('no_skpinap');
        $way_id = $this->request->getPost('way_id');
        $reason_id = $this->request->getPost('reason_id');
        $isattended = $this->request->getPost('isattended');
        $asalrujukan = $this->request->getPost('asalrujukan');
        $norujukan = $this->request->getPost('norujukan');
        $kdpoli = $this->request->getPost('kdpoli');
        $tanggal_rujukan =  str_replace("T", " ", $this->request->getPost('tanggal_rujukan'));
        $ppkrujukan = $this->request->getPost('ppkrujukan');
        $diag_awal = $this->request->getPost('diag_awal');
        $conclusion = $this->request->getPost('conclusion');
        $diagnosa_id = $this->request->getPost('diagnosa_id');
        $kdpolifrom = $this->request->getPost('kdpolifrom');
        $tujuankunj = $this->request->getPost('tujuankunj');
        $kdpenunjang = $this->request->getPost('kdpenunjang');
        $flagprocedure = $this->request->getPost('flagprocedure');
        $assesmentpel = $this->request->getPost('assesmentpel');
        $edit_sep = $this->request->getPost('edit_sep');
        $specimenno = $this->request->getPost('specimenno');
        $class_room_id = $this->request->getPost('class_room_id');
        $keluar_id = $this->request->getPost('keluar_id');
        $responsible = $this->request->getPost('responsible');
        $in_date = $this->request->getPost('in_date');
        $exit_date = $this->request->getPost('exit_date');
        $no_registration = $this->request->getPost('no_registration');
        $diantar_oleh = $this->request->getPost('diantar_oleh');
        $visitor_address = $this->request->getPost('visitor_address');
        $org_unit_code = $this->request->getPost('org_unit_code');
        $tgl_lahir = $this->request->getPost('tgl_lahir');
        $gender = $this->request->getPost('gender');
        $payor_id = $this->request->getPost('payor_id');
        $clinic_id_from = $this->request->getPost('clinic_id_from');
        $class_id_plafond = $this->request->getPost('class_id_plafond');
        $pasien_id = $this->request->getPost('pasien_id');
        $karyawan = $this->request->getPost('karyawan');
        $family_status_id = $this->request->getPost('family_status_id');
        $account_id = $this->request->getPost('account_id');
        $coverage_Id = $this->request->getPost('coverage_Id');
        $ageday = $this->request->getPost('ageday');
        $agemonth = $this->request->getPost('agemonth');
        $ageyear = $this->request->getPost('ageyear');
        $kode_agama = $this->request->getPost('kode_agama');
        $aktif = $this->request->getPost('aktif');
        $backcharge = $this->request->getPost('backcharge');
        $tujuankunj = $this->request->getPost('tujuankunj');
        $flagprocedure = $this->request->getPost('flagprocedure');
        $kdpenunjang = $this->request->getPost('kdpenunjang');
        $assesmentpel = $this->request->getPost('assesmentpel');
        $valid_rm_date = $this->request->getPost('valid_rm_date');
        $penjamin = $this->request->getPost('penjamin');
        $lokasilaka = $this->request->getPost('lokasilaka');
        $ispertarif = $this->request->getPost('ispertarif');
        $temptrans = $this->request->getPost('temptrans');
        $delete_sep = $this->request->getPost('delete_sep');
        $ssencounter_id = $this->request->getPost('ssencounter_id');
        $statusantrean = $this->request->getPost('statusantrean');



        // return json_encode($generateId);


        $pv = new PasienVisitationModel();
        $flag = 'edit';
        if (!isset($visit_id) || $visit_id == null) {
            $generatePv = $this->lowerKey($pv->generateId($clinic_id, $no_registration));


            $visit_id = $generatePv[0]['visit_id'];
            if (!isset($trans_id) || $trans_id == null)
                $trans_id = $generatePv[0]['trans_id'];
            $ticket_no = $generatePv[0]['ticket_no'];
            $ssencounter_id = $generatePv[0]['ssencounter_id'];
            $flag = 'tambah';
        }
        // return json_encode($generatePv);


        // return json_encode($kalurahan);


        $data = [
            'clinic_id' => $clinic_id,
            'employee_id' => $employee_id,
            'kddpjp' => $kddpjp,
            'class_id' => $class_id,
            'class_id_plafond' => $class_id_plafond,
            'status_pasien_id' => $status_pasien_id,
            'visit_date' => $visit_date,
            'booked_date' => $booked_date,
            'kdpoli_eks' => $kdpoli_eks,
            'isnew' => $isnew,
            'cob' => $cob,
            'description' => $description,
            'no_skp' => $no_skp,
            'no_skpinap' => $no_skpinap,
            'way_id' => $way_id,
            'reason_id' => $reason_id,
            'isattended' => 8,
            'asalrujukan' => $asalrujukan,
            'norujukan' => $norujukan,
            'kdpoli' => $kdpoli,
            'tanggal_rujukan' => $tanggal_rujukan,
            'ppkrujukan' => $ppkrujukan,
            'diag_awal' => $diag_awal,
            'conclusion' => $conclusion,
            'diagnosa_id' => $diagnosa_id,
            'kdpolifrom' => $kdpolifrom,
            'tujuankunj' => $tujuankunj,
            'kdpenunjang' => $kdpenunjang,
            'flagprocedure' => $flagprocedure,
            'assesmentpel' => $assesmentpel,
            'edit_sep' => $edit_sep,
            'specimenno' => $specimenno,
            'class_room_id' => $class_room_id,
            'keluar_id' => $keluar_id,
            'responsible' => $responsible,
            'in_date' => $in_date,
            'exit_date' => $exit_date,
            'no_registration' => $no_registration,
            'diantar_oleh' => $diantar_oleh,
            'visitor_address' => $visitor_address,
            'org_unit_code' => $org_unit_code,
            'tgl_lahir' => $tgl_lahir,
            'gender' => $gender,
            'payor_id' => $payor_id,
            'clinic_id_from' => $clinic_id_from,
            'class_id_plafond' => $class_id_plafond,
            'pasien_id' => $pasien_id,
            'karyawan' => $karyawan,
            'family_status_id' => $family_status_id,
            'account_id' => $account_id,
            'coverage_Id' => $coverage_Id,
            'ageday' => $ageday < 0 ? 0 : $ageday,
            'agemonth' => $agemonth < 0 ? 0 : $agemonth,
            'ageyear' => $ageyear < 0 ? 0 : $ageyear,
            'kode_agama' => $kode_agama,
            'aktif' => $aktif,
            'visit_id' => $visit_id,
            'trans_id' => $trans_id,
            'ticket_no' => $ticket_no,
            'backcharge' => $backcharge,
            'valid_rm_date' => $valid_rm_date,
            'penjamin' => $penjamin,
            'lokasilaka' => $lokasilaka,
            'ispertarif' => $ispertarif,
            'temptrans' => $temptrans,
            'delete_sep' => $delete_sep,
            'isrj' => $isrj,
            'ssencounter_id' => $ssencounter_id,
            'statusantrean' => $statusantrean
        ];
        // $data = json_encode($data);

        // return $data;



        $pv->save($data);

        $generateId = $this->generateId($clinic_id, $no_registration);

        // $c = new ClinicModel();
        // $clinicSelect = $c->select("stype_id")->find($data['clinic_id']);
        // $liTipe = $clinicSelect['stype_id'];
        // // return json_encode($liTipe);

        // if ($clinic_id == 'P041' || $clinic_id == 'P061') {
        //     $ttarif = $this->cekTindakanTarif(14);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        //     $ttarif = $this->cekTindakanTarif(1);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        // } else if ($clinic_id == 'P012') {
        //     $ttarif = $this->cekTindakanTarif(13);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        // } else if ($clinic_id == 'P011' || $clinic_id == 'P017' || $clinic_id == 'P029') {
        //     $ttarif = $this->cekTindakanTarif(1);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        // } else if ($clinic_id == 'MCU01') {
        //     $ttarif = $this->cekTindakanTarif(15);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        //     $ttarif = $this->cekTindakanTarif(1);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        // } else if ($liTipe == '2') {
        //     $ttarif = $this->cekTindakanTarif(2);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        // } else {
        //     $ttarif = $this->cekTindakanTarif(11);
        //     // return json_encode($ttarif);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        //     $ttarif = $this->cekTindakanTarif(1);
        //     $this->saveTarifDaftar($data, $ttarif, $this->generateIdTgl());
        // }

        // $lsBaru = $this->cek_baru_lama_rs($data['no_registration'], $data['visit_date']);

        // if ($lsBaru == '1' && $liTipe != '2') {
        //     $cekTarifBaru = $this->cek_tindakan_tarif_baru($lsBaru);
        //     $this->saveTarifDaftar($data, $cekTarifBaru, $this->generateIdTgl());
        // }


        // IF LSKLINIK =  'P041'  or LSKLINIK = 'P061' THEN 
        // 																					save_tarif_daftar(cek_tindakan_tarif(14),lsNota)
        // 																					save_tarif_daftar(cek_tindakan_tarif(1),lsNota)
        // 																				ELSEif LSKLINIK = 'P012' THEN
        // 																					save_tarif_daftar(cek_tindakan_tarif(13),lsNota)
        // 																				ELSEif LSKLINIK = 'P011' OR LSKLINIK = 'P017' OR LSKLINIK = 'P029' THEN
        // 																					save_tarif_daftar(cek_tindakan_tarif(1),lsNota)
        // 																				ELSEif LSKLINIK = 'MCU01' THEN
        // 																					save_tarif_daftar(cek_tindakan_tarif(15),lsNota)												
        // 																					save_tarif_daftar(cek_tindakan_tarif(1),lsNota)	
        // 																				elseif litipe = 2 then 
        // 																						save_tarif_daftar(cek_tindakan_tarif(2),lsNota)	
        // 																				else
        // 																					save_tarif_daftar(cek_tindakan_tarif(11),lsNota) 
        // 																					save_tarif_daftar(cek_tindakan_tarif(1),lsNota) 
        // 																				end if

        $array   = array('status' => 'success', 'error' => '', 'message' => $flag . ' kunjungan pasien berhasil', 'visit_id' => $visit_id, 'data' => $data);
        echo json_encode($array);
    }

    public function deletevisit()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $visit_id = $this->request->getPost('visit_id');

        $pv = new PasienVisitationModel();
        $pv->delete($visit_id);

        $array   = array('status' => 'success', 'error' => '', 'message' => 'delete kunjungan pasien berhasil', 'visit_id' => $visit_id);
        echo json_encode($array);
    }

    public function insertSep()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $klsRawat = $body['klsRawat'];

        return json_encode($body['klsRawat']['klsRawatHak']);
    }

    public function postingPanggilPasien()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];

        $db = db_connect();
        $db->query("UPDATE ANTRIAN_POLI SET STATUS_PANGGIL = 1,TANGGAL_PANGGIL = GETDATE()
                where visit_id = '$visit';");
        $db->query("UPDATE PASIEN_VISITATION SET ISATTENDED = 1
                where visit_id = '$visit';");
        return json_encode("Berhasil panggil pasien");
    }
    public function profile($id)
    {
        $org = new OrganizationunitModel();
        // $model = model(EmployeeAllModel::class)->select('fullname')->findAll();
        // return json_encode(user()->getFullname());
        // $session_id = $org->generateId();
        $session_id = $id . user()->username;

        // return $session_id;
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        // $pv = base64_decode($pv);
        // $pv = json_decode($pv, true);
        // if (!isset($pv['status_pasien_id'])) {
        // }
        $model = new PasienVisitationModel();
        $pv = $model->where("visit_id", $id)->first();
        $pv = $this->lowerKeyOne($pv);



        // return $pv['visit_id'];

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $statusPasienModel = new StatusPasienModel();
        // $statusPasien = $this->lowerKey($statusPasienModel->findAll());
        $statusPasien = $this->getStatusPasien();


        // $followupModel = new FollowUpModel();
        // $followup = $this->lowerKey($followupModel->findAll());
        $followup = $this->getFollowUp();

        // $genderModel = new SexModel();
        // $gender = $this->lowerKey($genderModel->findAll());
        $gender = $this->getGender();



        // $clinicModel = new ClinicModel();
        // $clinic = $this->lowerKey($clinicModel->select("clinic_id, name_of_clinic, stype_id, clinic_type, other_id, account_id, kdpoli, sslocation_id")
        //     ->where("stype_id in (1,2,3,5)")->findAll());

        $clinic = $this->getClinicModel();

        // $scheduleModel = new DoctorScheduleModel();
        // $schedule = $this->lowerKey($scheduleModel->getSchedule());



        // $employeeModel = new EmployeeAllModel();
        // $employee = $this->lowerKey($employeeModel->getEmployee());
        $employee = $this->getEmployee();


        // $wayModel = new VisitWayModel();
        // $way = $this->lowerKey($wayModel->findAll());

        // $reasonModel = new VisitReasonModel();
        // $reason = $this->lowerKey($reasonModel->findAll());
        $reason = $this->getReason();

        // $isattendedModel = new IsattendedsModel();
        // $isattended = $this->lowerKey($isattendedModel->findAll());
        $isattended = $this->getIsattended();

        // $inasisPoliModel = new InasisPoliModel();
        // $inasisPoli = $this->lowerKey($inasisPoliModel
        //     ->select("kdpoli, nmpoli")
        //     ->findAll());
        $inasisPoli = $this->getInasisPoli();

        $inasisFaskesModel = new InasisFaskesModel();
        $inasisFaskes = $this->lowerKey($inasisFaskesModel
            ->select("kdprovider, nmprovider")
            ->findAll());

        // $sufferModel = new SufferModel();
        // $suffer = $this->lowerKey($sufferModel->findAll());
        $suffer = $this->getSuffer();

        $diagCatModel = new DiagnosaCategoryModel();
        $diagCat = $this->lowerKey($diagCatModel->findAll());
        $diagCat = $this->getDiagCat();


        $dokter = array();
        $dpjp = array();


        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel->findAll());

        // dd($employee);

        // $pv = new PasienVisitationModel();
        // $visit = $this->lowerKey($pv->find($id));
        $visit = $pv;
        $visit['session_id'] = $session_id;
        if (isset($pv['no_registration'])) {
            $pmodel = new PasienModel();
            $p = $pmodel->select("isnull(mobile,phone_number) as phone_number")->where("no_registration", $pv['no_registration'])->first();
            if (isset($p['phone_number']))
                $visit['phone_number'] = $p['phone_number'];
        }
        $db = db_connect();
        $checkLock = $db->query("select locked from pasien_visitation where visit_id = '" . $visit['visit_id'] . "'")->getFirstRow('array');
        $visit['locked'] = @$checkLock['locked'];
        // return json_encode($visit['gender']);


        $visit['fullname_inap'] = '';
        $visit['fullname_from'] = '';

        if (is_null($visit['status_pasien_id']))
            $visit['status_pasien_id'] = '1';
        foreach ($statusPasien as $key => $value) {
            if ($statusPasien[$key]['status_pasien_id'] == $visit['status_pasien_id']) {
                $visit['name_of_status_pasien'] = $statusPasien[$key]['name_of_status_pasien'];
            }
        }
        foreach ($employee as $key => $value) {
            if ($employee[$key]['employee_id'] == @$visit['employee_id']) {
                @$visit['fullname'] = $employee[$key]['fullname'];
            }
            if ($employee[$key]['employee_id'] == @$visit['employee_id_from']) {
                $visit['fullname_from'] = $employee[$key]['fullname'];
            }
            if ($employee[$key]['employee_id'] == @$visit['employee_inap']) {
                $visit['fullname_inap'] = $employee[$key]['fullname'];
            }
        }
        if (!isset($visit['fullname'])) {
            @$visit['fullname'] = '';
        }
        foreach ($clinic as $key => $value) {
            if ($clinic[$key]['clinic_id'] == $visit['clinic_id']) {
                $visit['name_of_clinic'] = $clinic[$key]['name_of_clinic'];
            }
        }
        $clinicAll = $clinic;


        $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
        SPECIALIST_TYPE st
        inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        foreach ($specialist as $key => $value) {
            $visit['specialist_type_id'] = $value['specialist_type_id'];
        }
        if (!isset($visit['specialist_type_id'])) {
            $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
            SPECIALIST_TYPE st
            inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
            inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
            where c.CLINIC_ID = 'P001';")->getResultArray());
            foreach ($specialist as $key => $value) {
                $visit['specialist_type_id'] = $value['specialist_type_id'];
            }
        }
        if (!isset($visit['specialist_type_id'])) {
            $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
                employee_all st
                where st.employee_id = '" . $visit['employee_id'] . "';")->getResultArray());
            foreach ($specialist as $key => $value) {
                $visit['specialist_type_id'] = $value['specialist_type_id'];
            }
        }
        if (!isset($visit['specialist_type_id'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data spesialis tidak ditemukan. Silahkan hubungi pihak Admin.');
        }
        $mapAssessment = $this->lowerKey($db->query("select m.*, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID;")->getResultArray());
        // $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        // inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        // inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        // inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        // where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        // return json_encode($mapAssessment);
        if ($mapAssessment == []) {
            $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, '' as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
                inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
                inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
                inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
                where c.CLINIC_ID = 'P001';")->getResultArray());
        }


        usort($mapAssessment, fn($a, $b) => $a['theorder'] <=> $b['theorder']);

        if (!isset($visit['name_of_clinic'])) {
            $visit['name_of_clinic'] = '';
        }
        $visit['gendername'] = '';
        foreach ($gender as $key => $value) {
            if ($gender[$key]['gender'] == $visit['gender']) {
                $visit['gendername'] = $gender[$key]['name_of_gender'];
            }
        }
        $visit['age'] = $visit['ageyear'] . 'th ' . $visit['agemonth'] . 'bln ' . $visit['ageday'] . 'hr';

        $visitDate = substr($visit['visit_date'], 0, 10);
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['visit_date'] = $visitDate;
        $visitDate = substr($visit['exit_date'], 0, 10);
        $visit['exit_datetime'] = $visit['exit_date'];
        $visit['exit_date'] = $visitDate;

        $examModel = new ExaminationModel();
        $exam = $this->lowerKey($examModel->where('no_registration', $visit['no_registration'])->where('visit_id', $visit['visit_id'])->orderBy('examination_date asc')->findAll());
        $examDetailModel = new ExaminationDetailModel();
        $examDetail = $this->lowerKey($examDetailModel->where('no_registration', $visit['no_registration'])->where('visit_id', $visit['visit_id'])->orderBy('examination_date asc')->findAll());

        // $exam = [];

        // $pdModel = new PasienDiagnosaModel();
        // $pasienDiagnosa = $this->lowerKey($pdModel->where('no_registration', $visit['no_registration'])->orderBy('date_of_diagnosa desc')->findAll());
        $pasienDiagnosa = [];
        // $irModel = new InasisRujukanModel();
        // $nmprovider = $irModel->select('nmprovider')->find($pasienDiagnosa[0]['dirujukke']);
        // $pasienDiagnosa['nmprovider'] = $nmprovider['nmprovider'];

        $userEmployee = user()->employee_id;

        // if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) {
        //     $visit['isrj'] = '0';
        // } else {
        // }
        $visit['isrj'] = '1';

        if ($visit['isrj'] == '0') {
            $classRoomModel = new ClassRoomModel();
            $classRoom = $this->lowerKey($classRoomModel->findAll());
            dd($classRoom);
            foreach ($classRoom as $key => $value) {
                if ($visit['class_room_id'] == $classRoom[$key]['class_room_id']) {
                    $visit['name_of_class_room'] = $classRoom[$key]['name_of_class'];
                    break;
                }
            }
        }
        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());

        foreach ($class as $key1 => $value1) {
            if ($visit['class_id'] == $class[$key1]['class_id']) {
                $visit['name_of_class'] = $class[$key1]['name_of_class'];
            }
            if ($visit['class_id_plafond'] == $class[$key1]['class_id']) {
                $visit['name_of_class_plafond'] = $class[$key1]['name_of_class'];
            }
        }
        // dd(($visit['class_room_id'] == ''));

        $scheduleModel = new ClinicDoctorModel();
        $schedule = $this->lowerKey($scheduleModel->where('employee_id', $visit['employee_id'])->findAll());
        // dd($schedule);
        // dd($clinic);

        $clinicPermission = [];

        if (!is_null($userEmployee)) {
            foreach ($schedule as $key => $value) {
                // if ($schedule[$key]['dpjp'] != '' && !is_null($schedule[$key]['dpjp'])) {
                //     $dpjp[$schedule[$key]['employee_id']] = $schedule[$key]['dpjp'];
                // }
                if ($schedule[$key]['employee_id'] == $userEmployee) {
                    $clinicPermission[$schedule[$key]['clinic_id']]['clinic_id'] = $schedule[$key]['clinic_id'];
                    $clinicPermission[$schedule[$key]['clinic_id']]['name_of_clinic'] = $schedule[$key]['name_of_clinic'];
                    foreach ($clinic as $ckey => $cvalue) {
                        if ($clinic[$ckey]['clinic_id'] == $schedule[$key]['clinic_id']) {
                            foreach ($cvalue as $ckey2 => $cvalue2) {
                                $clinicPermission[$schedule[$key]['clinic_id']][$ckey2] = $cvalue2;
                            }
                        }
                    }
                }
            }

            // dd($clinicPermission);
            foreach ($clinicPermission as $key => $value) {
                unset($clinic);
            }
            // unset($clinic);

            $i = 0;
            foreach ($clinicPermission as $key => $value) {
                $clinic[$i] = $clinicPermission[$key];
                $i++;
            }
        }
        // dd($employee);
        foreach ($employee as $key => $value) {
            if ($employee[$key]['employee_id'] == $visit['employee_id']) {
                $visit['sspractitioner_id'] = $value['sspractitioner_id'];
                $visit['sspractitioner_name'] = $value['fullname'];
            }
        }

        $assessmentParam = array();

        $db = db_connect();
        $aParent = $db->query("select parent_id, parent_parameter from assessment_parameter_parent order by PARENT_PARAMETER")->getResultArray();
        $aType = $this->lowerKey($db->query("select * from assessment_parameter_type where p_type not in ('GEN0017', 'exOPRS006') order by P_DESCRIPTION")->getResultArray());
        $aParameter = $this->lowerKey($db->query("select * from assessment_parameter where p_type not in ('GEN0017', 'exOPRS006')")->getResultArray());
        $aValue = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type not in ('GEN0017', 'exOPRS006')")->getResultArray());

        $mappingAssessment = $this->lowerKey($db->query("select * from mapping_assessment where clinic_id ='" . $visit['clinic_id'] . "'")->getResultArray());

        usort($aParent, fn($a, $b) => $a['parent_parameter'] <=> $b['parent_parameter']);
        usort($aType, fn($a, $b) => $a['p_description'] <=> $b['p_description']);

        asort($employee);
        $empNew = [];
        foreach ($employee as $key => $value) {
            // dd($value);
            $empNew[] = $value;
        }
        foreach ($visit as $key => $value) {
            $visit[$key] = str_replace("\r", "", $visit[$key]);
            $visit[$key] = str_replace("\n", "", $visit[$key]);
            $visit[$key] = str_replace("'", "", $visit[$key]);
            $visit[$key] = str_replace("`", "", $visit[$key]);
        }

        if (isset($visit['name_of_pasien'])) {
            unset($visit['name_of_pasien']);
        }
        if (isset($visit['contact_address'])) {
            unset($visit['contact_address']);
        }
        $visit['platform'] = 'profile';

        $phModel = new PasienHistoryModel();
        $history = $this->lowerKey($phModel->whereIn("value_id", ["G0090201", "G0090202"])->where("no_registration", $visit['no_registration'])->findAll());
        $visit['alergi_obat'] = "";
        $visit['alergi_non'] = "";
        if (!is_null($history)) {
            if (count($history) > 0) {
                foreach ($history as $keyh => $valueh) {
                    if ($valueh['value_id'] == "G0090201")
                        $visit['alergi_obat'] = $valueh['histories'];
                    if ($valueh['value_id'] == "G0090202")
                        $visit['alergi_non'] = $valueh['histories'];
                }
            }
        }

        // dd($visit);



        return view('admin/patient/profile', [
            'title' => '',
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'clinicAll' => $clinicAll,
            'schedule' => $schedule,
            'statusPasien' => $statusPasien,
            'reason' => $reason,
            'isattended' => $isattended,
            'inasisPoli' => $inasisPoli,
            'inasisFaskes' => $inasisFaskes,
            'followup' => $followup,
            'visit' => $visit,
            'exam' => $exam,
            'examDetail' => $examDetail,
            'pd' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat,
            'employee' => $empNew,
            'aParent' => $aParent,
            'aType' => $aType,
            'aParameter' => $aParameter,
            'aValue' => $aValue,
            'mappingAssessment' => $mappingAssessment,
            'mapAssessment' => $mapAssessment,
            'clinicType' => $clinicType
        ]);
    }
    public function redirectProfileRanap($id, $ta, $session_id = null, $isnew = false)
    {
        $taold = $ta;
        $ta = base64_decode($ta);
        $ta = json_decode($ta, true);

        $pv = new PasienVisitationModel();
        $visit = $this->lowerKey($pv->find($id));

        if (count($visit) == 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }



        // $visit = $ta;
        unset($ta['visit_date']);
        if (!empty($ta) && is_array($ta)) {
            foreach ($ta as $key => $value) {
                $visit[$key] = $value;
            }
        }
        $db = db_connect();
        $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
        SPECIALIST_TYPE st
        inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        where ct.clinic_type = ISNULL('" . $ta['clinic_type'] . "','0');")->getResultArray());
        foreach ($specialist as $key => $value) {
            $visit['specialist_type_id'] = $value['specialist_type_id'];
        }
        // return json_encode($ta['employee_id']);
        if (!isset($visit['specialist_type_id'])) {
            $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
                employee_all st
                where st.employee_id = '" . $ta['employee_id'] . "';")->getResultArray());
            foreach ($specialist as $key => $value) {
                $visit['specialist_type_id'] = $value['specialist_type_id'];
            }
        }
        if (!isset($visit['specialist_type_id'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data spesialis tidak ditemukan. Silahkan hubungi pihak Admin.');
        }
        if ($isnew) {
            // return $session_id;
            $ageYear = $visit['ageyear'];
            $ageMonth = $visit['agemonth'];
            $ageDay = $visit['ageday'];
            $vstatusid = 0;
            if ($ageYear == 0 && $ageMonth == 0 && $ageDay <= 28) {
                $vstatusid = 5;
            } else if ($ageYear >= 18) {
                $vstatusid = 1;
                // $("#armvs_status_id").prop("selectedIndex", 1);
            } else {
                $vstatusid = 4;
                // $("#armvs_status_id").prop("selectedIndex", 2);
            }
            if ($visit['specialist_type_id'] == '1.05') {
                $vstatusid = 10;
            }
            $dataexam = [
                'body_id' => $session_id,
                'account_id' => 3,
                'examination_date' => date('Y-m-d H:i:s'),
                'org_unit_code' => $visit['org_unit_code'],
                'no_registration' => $visit['no_registration'],
                'visit_id' => $visit['visit_id'],
                'clinic_id' => $visit['clinic_id'],
                'employee_id' => $visit['employee_inap'],
                'class_room_id' => $visit['class_room_id'],
                'bed_id' => $visit['bed_id'],
                'in_date' => $visit['in_date'],
                'exit_date' => $visit['exit_date'],
                'keluar_id' => $visit['keluar_id'],
                'modified_from' => $visit['clinic_id'],
                'status_pasien_id' => $visit['status_pasien_id'],
                'ageyear' => $visit['ageyear'],
                'agemonth' => $visit['agemonth'],
                'ageday' => $visit['ageday'],
                'thename' => $visit['diantar_oleh'],
                'theaddress' => $visit['visitor_address'],
                'vs_status_id' => $vstatusid,
                'theid' => $visit['pasien_id'],
                'isrj' => 0,
                'gender' => $visit['gender'],
                'doctor' => @$visit['fullname'],
                'kal_id' => $visit['kal_id'],
                'petugas_id' => user()->username,
                'petugas_type' => user()->getOneRoles(),
                'petugas' => user()->getFullname(),
                'modified_by' => user()->username
            ];

            $ex = new ExaminationModel();
            $ex->save($dataexam);

            $exd = new ExaminationDetailModel();

            $dataToDuplicate = $exd->where('trans_id', @$visit['trans_id']) // Filter by visit_id
                ->where('(TEMPERATURE is not null or TENSION_UPPER is not null or TENSION_BELOW is not null or nadi is not null
                    or nafas is not null or weight is not null or height is not null)') // Filter by body_id
                ->orderBy("examination_date desc")
                ->first(); // Fetch all rows matching the conditions
            if (!is_null($dataToDuplicate)) {
                if (count($dataToDuplicate) > 0) {
                    $dataToDuplicate = $this->lowerKeyOne($dataToDuplicate);
                    // return json_encode(($dataToDuplicate));
                    // Step 2: Prepare the data with the new body_id
                    $dataToDuplicate['body_id'] = $session_id;  // Change body_id to '124'
                    $dataToDuplicate['document_id'] = $session_id;  // Change body_id to '124'
                    $dataToDuplicate['modified_by'] = user()->username;  // Change body_id to '124'
                    // Step 3: Insert the new data into the table
                    $exd->save($dataToDuplicate);
                }
            }
        }

        return redirect()->to(base_url() . 'admin/patient/profileranap' . '/' . $id . '/' . $taold . '/' . $session_id);
    }
    public function profileranap($id, $ta, $session_id = null)
    {
        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];


        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        // $ta = base64_decode($ta);
        // $ta = json_decode($ta, true);

        $taDb = new TreatmentAkomodasiModel();
        $ta = $taDb->getDataRanapByVisitId($id);

        $ta = $this->lowerKey($ta);

        $statusPasien = $this->getStatusPasien();



        $followup = $this->getFollowUp();
        $gender = $this->getGender();
        $clinic = $this->getClinicModel();
        $clinicAll = $clinic;

        // return json_encode($clinicAl)


        $reason = $this->getReason();
        $employee = $this->getEmployee();
        $isattended = $this->getIsattended();

        $inasisPoli = $this->getInasisPoli();

        $inasisFaskesModel = new InasisFaskesModel();
        $inasisFaskes = $this->lowerKey($inasisFaskesModel
            ->select("kdprovider, nmprovider")
            ->findAll());


        $suffer = $this->getSuffer();

        $diagCat = $this->getDiagCat();

        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel->findAll());

        $agamaModel = new AgamaModel();
        $agama = $this->lowerKey($agamaModel->findAll());

        $dokter = array();
        $dpjp = array();

        $pv = new PasienVisitationModel();
        $visit = $this->lowerKey($pv->find($id));
        $class_id = $visit['class_id'];
        $class_id_plafond = $visit['class_id_plafond'];

        if (isset($visit['locked'])) {
            if (is_null($visit['locked'])) {
                $visit['locked'] = 0;
            }
        }
        // $visit = $ta;
        unset($ta['visit_date']);
        // dd($visit);
        if (!empty($ta) && is_array($ta)) {
            foreach ($ta as $key => $value) {
                $visit[$key] = $value;
            }
        }
        $visit['class_id'] = $class_id;
        $visit['class_id_plafond'] = $class_id_plafond;
        if (isset($visit['no_registration']) && !isset($visit['phone_number'])) {
            $pmodel = new PasienModel();
            $p = $pmodel->select("isnull(mobile,phone_number) as phone_number")->where("no_registration", $visit['no_registration'])->first();
            if (isset($p['phone_number']))
                $visit['phone_number'] = $p['phone_number'];
        }
        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());

        foreach ($class as $key1 => $value1) {
            if ($visit['class_id'] == $class[$key1]['class_id']) {
                $visit['name_of_class'] = $class[$key1]['name_of_class'];
            }
            if ($visit['class_id_plafond'] == $class[$key1]['class_id']) {
                $visit['name_of_class_plafond'] = $class[$key1]['name_of_class'];
            }
        }

        // dd($visit);
        $db = db_connect();
        $checkLock = $db->query("select locked from pasien_visitation where visit_id = '" . $visit['visit_id'] . "'")->getFirstRow('array');
        $visit['locked'] = @$checkLock['locked'];
        // return json_encode($visit['class_room_id']);

        $visit['fullname_inap'] = '';
        $visit['fullname_from'] = '';
        if (is_null($visit['status_pasien_id']))
            $visit['status_pasien_id'] = '1';
        foreach ($statusPasien as $key => $value) {
            if ($statusPasien[$key]['status_pasien_id'] == $visit['status_pasien_id']) {
                $visit['name_of_status_pasien'] = $statusPasien[$key]['name_of_status_pasien'];
            }
        }
        foreach ($employee as $key => $value) {
            if ($employee[$key]['employee_id'] == $visit['employee_id']) {
                @$visit['fullname'] = $employee[$key]['fullname'];
            }
            if ($employee[$key]['employee_id'] == $visit['employee_id_from']) {
                $visit['fullname_from'] = $employee[$key]['fullname'];
            }
            if ($employee[$key]['employee_id'] == $visit['employee_inap']) {
                $visit['fullname_inap'] = $employee[$key]['fullname'];
            }
        }
        foreach ($clinic as $key => $value) {
            if ($clinic[$key]['clinic_id'] == $visit['clinic_id']) {
                $visit['name_of_clinic'] = $clinic[$key]['name_of_clinic'];
            }
        }
        foreach ($agama as $key1 => $value1) {
            if ($visit['kode_agama'] == $agama[$key1]['kode_agama']) {
                $visit['nama_agama'] = $agama[$key1]['nama_agama'];
            }
        }
        $db = db_connect();
        $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
        SPECIALIST_TYPE st
        inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        where ct.clinic_type = ISNULL('" . @$ta['clinic_type'] . "','0');")->getResultArray());
        foreach ($specialist as $key => $value) {
            $visit['specialist_type_id'] = $value['specialist_type_id'];
        }
        // return json_encode($ta['employee_id']);
        if (!isset($visit['specialist_type_id'])) {
            $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
                employee_all st
                where st.employee_id = '" . $ta['employee_id'] . "';")->getResultArray());
            foreach ($specialist as $key => $value) {
                $visit['specialist_type_id'] = $value['specialist_type_id'];
            }
        }
        if (!isset($visit['specialist_type_id'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data spesialis tidak ditemukan. Silahkan hubungi pihak Admin.');
        }

        $mapAssessment = $this->lowerKey($db->query("select m.*, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        where (st.specialist_type_id = '{$visit['specialist_type_id']}' or st.specialist_type_id = '1.00')
        ;")->getResultArray());
        // $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        // inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        // inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        // inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        // where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        // return json_encode($mapAssessment);
        if ($mapAssessment == []) {
            $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, '' as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
                inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
                inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
                inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
                where c.CLINIC_ID = 'P001';")->getResultArray());
        }

        usort($mapAssessment, fn($a, $b) => $a['theorder'] <=> $b['theorder']);

        foreach ($gender as $key => $value) {
            if ($gender[$key]['gender'] == $visit['gender']) {
                $visit['gendername'] = $gender[$key]['name_of_gender'];
            }
        }
        $visit['age'] = $visit['ageyear'] . 'th ' . $visit['agemonth'] . 'bln ' . $visit['ageday'] . 'hr';


        $visitDate = substr($visit['visit_date'], 0, 16);
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['visit_date'] = $visitDate;
        $visitDate = substr($visit['exit_date'], 0, 16);
        $visit['exit_datetime'] = $visit['exit_date'];
        $visit['exit_date'] = $visitDate;

        $examModel = new ExaminationModel();
        $exam = $this->lowerKey($examModel->where('no_registration', $visit['no_registration'])->orderBy('examination_date asc')->findAll());
        $examDetailModel = new ExaminationDetailModel();
        $examDetail = $this->lowerKey($examDetailModel->where('no_registration', $visit['no_registration'])->orderBy('examination_date asc')->findAll());

        // $exam = [];
        // $examDetail = [];

        $pdModel = new PasienDiagnosaModel();
        $pasienDiagnosa = $this->lowerKey($pdModel->where('no_registration', $visit['no_registration'])->orderBy('date_of_diagnosa desc')->findAll());
        // $pasienDiagnosa = [];

        // if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) {
        //     $visit['isrj'] = '0';
        // } else {
        //     $visit['isrj'] = '1';
        // }
        $visit['isrj'] = '0';

        if ($visit['isrj'] == '0') {
            $classRoomModel = new ClassRoomModel();
            $classRoom = $this->lowerKey($classRoomModel->findAll());
            // dd($classRoom);
            foreach ($classRoom as $key => $value) {
                if ($visit['class_room_id'] == $classRoom[$key]['class_room_id']) {
                    $visit['name_of_class_room'] = $classRoom[$key]['name_of_class'];
                    break;
                }
            }
        }

        $scheduleModel = new ClinicDoctorModel();
        $schedule = $this->lowerKey($scheduleModel->where('employee_id', $visit['employee_id'])->findAll());

        $clinicPermission = [];

        $userEmployee = user()->employee_id;

        // $db = db_connect();
        // $aParent = $db->query("select parent_id, parent_parameter from assessment_parameter_parent order by PARENT_PARAMETER")->getResultArray();
        // $aType = $this->lowerKey($db->query("select * from assessment_parameter_type where p_type like 'GEN%' order by P_DESCRIPTION")->getResultArray());
        // $aParameter = $this->lowerKey($db->query("select * from assessment_parameter where p_type like 'GEN%'")->getResultArray());
        // $aValue = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type like 'GEN%'")->getResultArray());
        $db = db_connect();
        $aParent = $db->query("select parent_id, parent_parameter from assessment_parameter_parent order by PARENT_PARAMETER")->getResultArray();
        $aType = $this->lowerKey($db->query("select * from assessment_parameter_type where p_type not in ('GEN0017', 'exOPRS006') order by P_DESCRIPTION")->getResultArray());
        $aParameter = $this->lowerKey($db->query("select * from assessment_parameter where p_type not in ('GEN0017', 'exOPRS006')")->getResultArray());
        $aValue = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type not in ('GEN0017', 'exOPRS006')")->getResultArray());
        $mappingAssessment = $this->lowerKey($db->query("select * from mapping_assessment where clinic_id ='" . $visit['clinic_id'] . "'")->getResultArray());

        usort($aParent, fn($a, $b) => $a['parent_parameter'] <=> $b['parent_parameter']);
        usort($aType, fn($a, $b) => $a['p_description'] <=> $b['p_description']);
        // dd($visit);

        // dd(json_encode($clinic));
        // $aTypeClinic = $this->lowerKey($db->query("select * from assessment_access_clinic where clinic_id = '".."'"))

        // return json_encode($mappingAssessment);
        asort($employee);
        $empNew = [];
        foreach ($employee as $key => $value) {
            // dd($value);
            $empNew[] = $value;
        }
        $visit['session_id'] = $session_id;
        $visit['platform'] = 'profileranap';


        foreach ($visit as $key => $value) {
            $visit[$key] = str_replace("\r", "", $visit[$key]);
            $visit[$key] = str_replace("\n", "", $visit[$key]);
            $visit[$key] = str_replace("'", "", $visit[$key]);
            $visit[$key] = str_replace("`", "", $visit[$key]);
        }


        if (isset($visit['name_of_pasien'])) {
            unset($visit['name_of_pasien']);
        }
        if (isset($visit['contact_address'])) {
            unset($visit['contact_address']);
        }
        if (is_null($visit['locked'])) {
            $visit['locked'] = '0';
        }
        $phModel = new PasienHistoryModel();
        $history = $this->lowerKey($phModel->whereIn("value_id", ["G0090201", "G0090202"])->where("no_registration", $visit['no_registration'])->findAll());
        $visit['alergi_obat'] = "";
        $visit['alergi_non'] = "";
        if (!is_null($history)) {
            if (count($history) > 0) {
                foreach ($history as $keyh => $valueh) {
                    if ($valueh['value_id'] == "G0090201")
                        $visit['alergi_obat'] = $valueh['histories'];
                    if ($valueh['value_id'] == "G0090202")
                        $visit['alergi_non'] = $valueh['histories'];
                }
            }
        }
        return view('admin/patient/profile', [
            'title' => 'Profile Pasien',
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'clinicAll' => $clinicAll,
            'dokter' => $dokter,
            // 'coverage' => $coverage,
            // 'status' => $status,
            // 'jenis' => $jenis,
            // 'kelas' => $kelas,
            // 'kalurahan' => $kalurahan,
            // 'kecamatan' => $kecamatan,
            // 'kota' => $kota,
            // 'prov' => $prov,
            'statusPasien' => $statusPasien,
            'followup' => $followup,
            // 'payor' => $payor,
            // 'education' => $education,
            // 'marital' => $marital,
            // 'agama' => $agama,
            // 'job' => $job,
            // 'blood' => $blood,
            // 'family' => $family,
            'gender' => $gender,
            // 'way' => $way,
            'reason' => $reason,
            'isattended' => $isattended,
            'inasisPoli' => $inasisPoli,
            'inasisFaskes' => $inasisFaskes,
            // 'diagnosa' => $diagnosa,
            'dpjp' => $dpjp,
            'visit' => $visit,
            'exam' => $exam,
            'examDetail' => $examDetail,
            'pd' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat,
            'schedule' => $schedule,
            'employee' => $empNew,
            'aParent' => $aParent,
            'aType' => $aType,
            'aParameter' => $aParameter,
            'aValue' => $aValue,
            'mappingAssessment' => $mappingAssessment,
            'mapAssessment' => $mapAssessment,
            'clinicType' => $clinicType
        ]);
    }
    public function profilepenunjang($id, $ta)
    {

        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];

        $session_id = $org->generateId();

        // dd(user()->getEmployeeData());

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $ta = base64_decode($ta);
        $ta = json_decode($ta, true);

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        $followupModel = new FollowUpModel();
        $followup = $this->lowerKey($followupModel->findAll());

        $genderModel = new SexModel();
        $gender = $this->lowerKey($genderModel->findAll());

        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5,6)")->findAll());
        $clinicAll = $clinic;

        $reasonModel = new VisitReasonModel();
        $reason = $this->lowerKey($reasonModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());

        $isattendedModel = new IsattendedsModel();
        $isattended = $this->lowerKey($isattendedModel->findAll());

        $inasisPoliModel = new InasisPoliModel();
        $inasisPoli = $this->lowerKey($inasisPoliModel->findAll());

        $inasisFaskesModel = new InasisFaskesModel();
        $inasisFaskes = $this->lowerKey($inasisFaskesModel->findAll());

        $sufferModel = new SufferModel();
        $suffer = $this->lowerKey($sufferModel->findAll());

        $diagCatModel = new DiagnosaCategoryModel();
        $diagCat = $this->lowerKey($diagCatModel->findAll());


        $clinicTypeModel = new ClinicTypeModel();
        $clinicType = $this->lowerKey($clinicTypeModel->findAll());

        $dokter = array();
        $dpjp = array();



        $pv = new PasienVisitationModel();
        $visit = $this->lowerKey($pv->find($id));
        $visit['session_id'] = $session_id;
        if (isset($visit['locked'])) {
            if (is_null($visit['locked'])) {
                $visit['locked'] = 0;
            }
        }
        if (isset($visit['no_registration']) && !isset($visit['phone_number'])) {
            $pmodel = new PasienModel();
            $p = $pmodel->select("isnull(mobile,phone_number) as phone_number")->where("no_registration", $visit['no_registration'])->first();
            if (isset($p['phone_number']))
                $visit['phone_number'] = $p['phone_number'];
        }

        // $visit = $ta;
        unset($ta['visit_date']);
        if (!empty($ta) && is_array($ta)) {
            foreach ($ta as $key => $value) {
                $visit[$key] = $value;
            }
        }

        $visit['fullname_inap'] = '';
        $visit['fullname_from'] = '';
        if (is_null($visit['status_pasien_id']))
            $visit['status_pasien_id'] = '1';

        // $visit['name_of_status_pasien'] = array_column(array_filter($statusPasien, function ($value) use ($visit) {
        //     return $value['status_pasien_id'] == $visit['status_pasien_id'];
        // }), "name_of_status_pasien");
        foreach ($statusPasien as $key => $value) {
            if ($statusPasien[$key]['status_pasien_id'] == $visit['status_pasien_id']) {
                $visit['name_of_status_pasien'] = $statusPasien[$key]['name_of_status_pasien'];
            }
        }
        // @$visit['fullname'] = array_column(array_filter($employee, function ($value) use ($visit) {
        //     return $value['employee_id'] == $visit['employee_id'];
        // }), "fullname")[0];

        // $visit['fullname_from'] = array_column(array_filter($employee, function ($value) use ($visit) {
        //     return $value['employee_id'] == $visit['employee_id_from'];
        // }), "fullname_from")[0];
        // $visit['fullname_inap'] = array_column(array_filter($employee, function ($value) use ($visit) {
        //     return $value['employee_id'] == $visit['employee_inap'];
        // }), "fullname")[0];

        foreach ($employee as $key => $value) {

            if ($employee[$key]['employee_id'] == $visit['employee_id']) {
                @$visit['fullname'] = $employee[$key]['fullname'];
            }
            if ($employee[$key]['employee_id'] == $visit['employee_id_from']) {
                $visit['fullname_from'] = $employee[$key]['fullname'];
            }
            if ($employee[$key]['employee_id'] == $visit['employee_inap']) {
                $visit['fullname_inap'] = $employee[$key]['fullname'];
            }
        }
        // $visit['name_of_clinic'] = array_column(array_filter($clinic, function ($value) use ($visit) {
        //     return $value['clinic_id'] = $visit['clinic_id'];
        // }), "name_of_clinic");
        foreach ($clinic as $key => $value) {
            if ($clinic[$key]['clinic_id'] == $visit['clinic_id']) {
                $visit['name_of_clinic'] = $clinic[$key]['name_of_clinic'];
            }
        }

        $db = db_connect();
        // $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
        // SPECIALIST_TYPE st
        // inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        // inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        // where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
        SPECIALIST_TYPE st
        inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        foreach ($specialist as $key => $value) {
            $visit['specialist_type_id'] = $value['specialist_type_id'];
        }
        if (!isset($visit['specialist_type_id'])) {
            $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
            SPECIALIST_TYPE st
            inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
            inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
            where c.CLINIC_ID = 'P001';")->getResultArray());
            foreach ($specialist as $key => $value) {
                $visit['specialist_type_id'] = $value['specialist_type_id'];
            }
        }
        if (!isset($visit['specialist_type_id'])) {
            $specialist = $this->lowerKey($db->query("select st.specialist_type_id from 
                employee_all st
                where st.employee_id = '" . $visit['employee_id'] . "';")->getResultArray());
            foreach ($specialist as $key => $value) {
                $visit['specialist_type_id'] = $value['specialist_type_id'];
            }
        }
        if (!isset($visit['specialist_type_id'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data spesialis tidak ditemukan. Silahkan hubungi pihak Admin.');
        }

        $mapAssessment = $this->lowerKey($db->query("select m.*, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        where st.specialist_type_id = '{$visit['specialist_type_id']}'
        ;")->getResultArray());
        // $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, case when '" . $visit['clinic_id'] . "' is null then '' else st.specialist_type end as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
        // inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
        // inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
        // inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
        // where c.CLINIC_ID = ISNULL('" . $visit['clinic_id'] . "','P001');")->getResultArray());
        // return json_encode($mapAssessment);
        if ($mapAssessment == []) {
            $mapAssessment = $this->lowerKey($db->query("select m.*, st.specialist_type_id, '' as specialist_type from MAPPING_ASSESSMENT_SPECIALIST m
                inner join SPECIALIST_TYPE st on m.SPECIALIST_TYPE_ID = st.SPECIALIST_TYPE_ID
                inner join CLINIC_TYPE ct on ct.SPESIALISTIK = st.SPECIALIST_TYPE_ID
                inner join clinic c on c.CLINIC_TYPE = ct.CLINIC_TYPE
                where c.CLINIC_ID = 'P001';")->getResultArray());
        }

        usort($mapAssessment, fn($a, $b) => $a['theorder'] <=> $b['theorder']);
        // dd($mapAssessment);

        foreach ($gender as $key => $value) {
            if ($gender[$key]['gender'] == $visit['gender']) {
                $visit['gendername'] = $gender[$key]['name_of_gender'];
            }
        }
        $visit['age'] = $visit['ageyear'] . 'th ' . $visit['agemonth'] . 'bln ' . $visit['ageday'] . 'hr';


        $visitDate = substr($visit['visit_date'], 0, 10);
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['visit_date'] = $visitDate;
        $visitDate = substr($visit['exit_date'], 0, 10);
        $visit['exit_datetime'] = $visit['exit_date'];
        $visit['exit_date'] = $visitDate;

        // $examModel = new ExaminationModel();
        // $exam = $this->lowerKey($examModel->where('no_registration', $visit['no_registration'])->orderBy('examination_date asc')->findAll());
        $exam = [];
        $examDetail = [];

        // $pdModel = new PasienDiagnosaModel();
        // $pasienDiagnosa = $this->lowerKey($pdModel->where('no_registration', $visit['no_registration'])->orderBy('date_of_diagnosa desc')->findAll());
        $pasienDiagnosa = [];

        if (!is_null($visit['class_room_id']) && ($visit['class_room_id'] != '')) {
            $visit['isrj'] = '0';
        } else {
            $visit['isrj'] = '1';
        }

        if ($visit['isrj'] == '0') {
            $classRoomModel = new ClassRoomModel();
            $classRoom = $this->lowerKey($classRoomModel->findAll());
            // dd($classRoom);
            foreach ($classRoom as $key => $value) {
                if ($visit['class_room_id'] == $classRoom[$key]['class_room_id']) {
                    $visit['name_of_class'] = $classRoom[$key]['name_of_class'];
                    break;
                }
            }
        }

        $scheduleModel = new ClinicDoctorModel();
        $schedule = $this->lowerKey($scheduleModel->where('employee_id', $visit['employee_id'])->findAll());

        $clinicPermission = [];

        $userEmployee = user()->employee_id;

        // $db = db_connect();
        // $aParent = $db->query("select parent_id, parent_parameter from assessment_parameter_parent order by PARENT_PARAMETER")->getResultArray();
        // $aType = $this->lowerKey($db->query("select * from assessment_parameter_type where p_type like 'GEN%' order by P_DESCRIPTION")->getResultArray());
        // $aParameter = $this->lowerKey($db->query("select * from assessment_parameter where p_type like 'GEN%'")->getResultArray());
        // $aValue = $this->lowerKey($db->query("select * from assessment_parameter_value where p_type like 'GEN%'")->getResultArray());
        $db = db_connect();
        $aParent = $db->query("select parent_id, parent_parameter from assessment_parameter_parent order by PARENT_PARAMETER")->getResultArray();
        $aType = $this->lowerKey($db->query("select * from assessment_parameter_type order by P_DESCRIPTION")->getResultArray());
        $aParameter = $this->lowerKey($db->query("select * from assessment_parameter")->getResultArray());
        $aValue = $this->lowerKey($db->query("select * from assessment_parameter_value")->getResultArray());
        $mappingAssessment = $this->lowerKey($db->query("select * from mapping_assessment where clinic_id ='" . $visit['clinic_id'] . "'")->getResultArray());

        usort($aParent, fn($a, $b) => $a['parent_parameter'] <=> $b['parent_parameter']);
        usort($aType, fn($a, $b) => $a['p_description'] <=> $b['p_description']);
        // $aTypeClinic = $this->lowerKey($db->query("select * from assessment_access_clinic where clinic_id = '".."'"))
        $visit['visitor_address'] = str_replace("\r\n", "", $visit['visitor_address']);
        $visit['diantar_oleh'] = str_replace("'", "", $visit['diantar_oleh']);
        $visit['diantar_oleh'] = str_replace("\r\n", "", $visit['diantar_oleh']);
        if (isset($visit['name_of_pasien'])) {
            unset($visit['name_of_pasien']);
        }
        if (isset($visit['contact_address'])) {
            unset($visit['contact_address']);
        }
        // unset($visit['description']);
        // dd($visit['description']);

        $visit['description'] = '';
        $visit['visitor_address'] = '';
        // return json_encode($visit);
        $db = db_connect();
        $checkLock = $db->query("select locked from pasien_visitation where visit_id = '" . $visit['visit_id'] . "'")->getFirstRow('array');
        $visit['locked'] = @$checkLock['locked'];

        if (is_null($visit['locked']))
            $visit['locked'] = 0;

        $visit['platform'] = 'profilepenunjang';
        // dd($visit['locked']);
        $phModel = new PasienHistoryModel();
        $history = $this->lowerKey($phModel->whereIn("value_id", ["G0090201", "G0090202"])->where("no_registration", $visit['no_registration'])->findAll());
        $visit['alergi_obat'] = "";
        $visit['alergi_non'] = "";
        if (!is_null($history)) {
            if (count($history) > 0) {
                foreach ($history as $keyh => $valueh) {
                    if ($valueh['value_id'] == "G0090201")
                        $visit['alergi_obat'] = $valueh['histories'];
                    if ($valueh['value_id'] == "G0090202")
                        $visit['alergi_non'] = $valueh['histories'];
                }
            }
        }
        return view('admin/patient/profile', [
            'title' => 'Profile Pasien',
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp,
            'clinic' => $clinic,
            'clinicAll' => $clinicAll,
            'dokter' => $dokter,
            // 'coverage' => $coverage,
            // 'status' => $status,
            // 'jenis' => $jenis,
            // 'kelas' => $kelas,
            // 'kalurahan' => $kalurahan,
            // 'kecamatan' => $kecamatan,
            // 'kota' => $kota,
            // 'prov' => $prov,
            'statusPasien' => $statusPasien,
            'followup' => $followup,
            // 'payor' => $payor,
            // 'education' => $education,
            // 'marital' => $marital,
            // 'agama' => $agama,
            // 'job' => $job,
            // 'blood' => $blood,
            // 'family' => $family,
            'gender' => $gender,
            // 'way' => $way,
            'reason' => $reason,
            'isattended' => $isattended,
            'inasisPoli' => $inasisPoli,
            'inasisFaskes' => $inasisFaskes,
            // 'diagnosa' => $diagnosa,
            'dpjp' => $dpjp,
            'visit' => $visit,
            'exam' => $exam,
            'examDetail' => $examDetail,
            'pd' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat,
            'schedule' => $schedule,
            'employee' => $employee,
            'aParent' => $aParent,
            'aType' => $aType,
            'aParameter' => $aParameter,
            'aValue' => $aValue,
            'mappingAssessment' => $mappingAssessment,
            'mapAssessment' => $mapAssessment,
            'gsPoli' => 'P002',
            'clinicType' => $clinicType
        ]);
    }

    public function addExam()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return $this->request->is('put');


        // return json_encode($norm);
        $rules = [
            'bed_id' => 'permit_empty|integer',
            'keluar_id' => 'permit_empty|integer',
            'status_pasien_id' => 'permit_empty|integer',
            'ageyear' => 'permit_empty|integer',
            'agemonth' => 'permit_empty|integer',
            'ageday' => 'permit_empty|integer',
            'saturasi' => 'permit_empty|integer',
            'kesadaran' => 'permit_empty|integer',
            'isvalid' => 'permit_empty|integer',
            'temperature' => 'permit_empty|integer',
            'tension_upper' => 'permit_empty|integer',
            'tension_below' => 'permit_empty|integer',
            'nadi' => 'permit_empty|integer',
            'nafas' => 'permit_empty|integer',
            'weight' => 'permit_empty|integer',
            'height' => 'permit_empty|integer',
            'arm_diameter' => 'permit_empty|integer',
        ];



        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
            return json_encode($array);
        }


        $petugas = $this->request->getPost('petugas');
        $examination_date = $this->request->getPost('examination_date');
        $weight = $this->request->getPost('weight');
        $height = $this->request->getPost('height');
        $temperature = $this->request->getPost('temperature');
        $nadi = $this->request->getPost('nadi');
        $tension_upper = $this->request->getPost('tension_upper');
        $tension_below = $this->request->getPost('tension_below');
        $saturasi = $this->request->getPost('saturasi');
        $nafas = $this->request->getPost('nafas');
        $arm_diameter = $this->request->getPost('arm_diameter');
        $anamnase = $this->request->getPost('anamnase');
        $pemeriksaan = $this->request->getPost('pemeriksaan');
        $teraphy_desc = $this->request->getPost('teraphy_desc');
        $description = $this->request->getPost('description');
        $clinic_id = $this->request->getPost('clinic_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $bed_id = $this->request->getPost('bed_id');
        $keluar_id = $this->request->getPost('keluar_id');
        $employee_id = $this->request->getPost('employee_id');
        $no_registration = $this->request->getPost('no_registration');
        $visit_id = $this->request->getPost('visit_id');
        $org_unit_code = $this->request->getPost('org_unit_code');
        $doctor = $this->request->getPost('doctor');
        $kal_id = $this->request->getPost('kal_id');
        $theid = $this->request->getPost('theid');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isrj = $this->request->getPost('isrj');
        $gender = $this->request->getPost('gender');
        $ageyear = $this->request->getPost('ageyear');
        $agemonth = $this->request->getPost('agemonth');
        $ageday = $this->request->getPost('ageday');

        if (is_null($bed_id) || empty($bed_id) || $bed_id == '') {
            $bed_id = 0;
        }
        if (is_null($keluar_id) || empty($keluar_id) || $keluar_id == '') {
            $keluar_id = 0;
        }
        if (is_null($status_pasien_id) || empty($status_pasien_id) || $status_pasien_id == '') {
            $status_pasien_id = 0;
        }
        if (is_null($ageyear) || empty($ageyear) || $ageyear == '') {
            $ageyear = 0;
        }
        if (is_null($agemonth) || empty($agemonth) || $agemonth = '') {
            $agemonth = 0;
        }
        if (is_null($ageday) || empty($ageday) || $ageday == '') {
            $ageday = 0;
        }
        if (is_null($saturasi) || empty($saturasi) || $saturasi == '') {
            $saturasi = 0;
        }
        if (is_null($temperature) || empty($temperature) || $temperature == '') {
            $temperature = 0;
        }
        if (is_null($tension_upper) || empty($tension_upper) || $tension_upper == '') {
            $tension_upper = 0;
        }
        if (is_null($tension_below) || empty($tension_below) || $tension_below == '') {
            $tension_below = 0;
        }
        if (is_null($nadi) || empty($nadi) || $nadi == '') {
            $nadi = 0;
        }
        if (is_null($nafas) || empty($nafas) || $nafas == '') {
            $nafas = 0;
        }
        if (is_null($weight) || empty($weight) || $weight == '') {
            $weight = 0;
        }
        if (is_null($height) || empty($height) || $height == '') {
            $height = 0;
        }
        if (is_null($arm_diameter) || empty($arm_diameter) || $arm_diameter == '') {
            $arm_diameter = 0;
        }




        $examModel = new ExaminationModel();


        $orgModel = new OrganizationunitModel();
        $id = $orgModel->generateId();
        // dd($id);


        // return json_encode($kalurahan);


        $data = [
            'org_unit_code' => $org_unit_code,
            'visit_id' => $visit_id,
            'no_registration' => $no_registration,
            'body_id' => $id,
            'petugas' => $petugas,
            'examination_date' => $examination_date,
            'weight' => $weight,
            'height' => $height,
            'temperature' => $temperature,
            'nadi' => $nadi,
            'tension_upper' => $tension_upper,
            'tension_below' => $tension_below,
            'saturasi' => $saturasi,
            'nafas' => $nafas,
            'arm_diameter' => $arm_diameter,
            'anamnase' => $anamnase,
            'pemeriksaan' => $pemeriksaan,
            'teraphy_desc' => $teraphy_desc,
            'description' => $description,
            'clinic_id' => $clinic_id,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'keluar_id' => $keluar_id,
            'employee_id' => $employee_id,
            'doctor' => $doctor,
            'kal_id' => $kal_id,
            'theid' => $theid,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'status_pasien_id' => $status_pasien_id,
            'isrj' => $isrj,
            'gender' => $gender,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
        ];


        $examModel->insert($data);
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => 'tambah pemeriksaan fisik berhasil');
        echo json_encode($array);
    }

    public function editExam()
    {
        // dd($this->request->is('post'));
        // echo '<pre>';
        // var_dump($_POST['body_id']);
        // die();
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return $this->request->is('put');


        // return json_encode($norm);
        $rules = [
            'bed_id' => 'permit_empty|decimal',
            'keluar_id' => 'permit_empty|decimal',
            'status_pasien_id' => 'permit_empty|decimal',
            'ageyear' => 'permit_empty|decimal',
            'agemonth' => 'permit_empty|decimal',
            'ageday' => 'permit_empty|decimal',
            'saturasi' => 'permit_empty|decimal',
            'kesadaran' => 'permit_empty|decimal',
            'isvalid' => 'permit_empty|decimal',
            'temperature' => 'permit_empty|decimal',
            'tension_upper' => 'permit_empty|decimal',
            'tension_below' => 'permit_empty|decimal',
            'nadi' => 'permit_empty|decimal',
            'nafas' => 'permit_empty|decimal',
            'weight' => 'permit_empty|decimal',
            'height' => 'permit_empty|decimal',
            'arm_diameter' => 'permit_empty|decimal',
        ];



        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
            return json_encode($array);
        }


        $petugas = $this->request->getPost('petugas');
        $examination_date = $this->request->getPost('examination_date');
        $weight = $this->request->getPost('weight');
        $height = $this->request->getPost('height');
        $temperature = $this->request->getPost('temperature');
        $nadi = $this->request->getPost('nadi');
        $tension_upper = $this->request->getPost('tension_upper');
        $tension_below = $this->request->getPost('tension_below');
        $saturasi = $this->request->getPost('saturasi');
        $nafas = $this->request->getPost('nafas');
        $arm_diameter = $this->request->getPost('arm_diameter');
        $anamnase = $this->request->getPost('anamnase');
        $oxygen_usage = $this->request->getPost('oxygen_usage');
        $pemeriksaan = $this->request->getPost('pemeriksaan');
        $teraphy_desc = $this->request->getPost('teraphy_desc');
        $description = $this->request->getPost('description');
        $clinic_id = $this->request->getPost('clinic_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $bed_id = $this->request->getPost('bed_id');
        $keluar_id = $this->request->getPost('keluar_id');
        $employee_id = $this->request->getPost('employee_id');
        $no_registration = $this->request->getPost('no_registration');
        $visit_id = $this->request->getPost('visit_id');
        $org_unit_code = $this->request->getPost('org_unit_code');
        $doctor = $this->request->getPost('doctor');
        $kal_id = $this->request->getPost('kal_id');
        $theid = $this->request->getPost('theid');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isrj = $this->request->getPost('isrj');
        $gender = $this->request->getPost('gender');
        $ageyear = $this->request->getPost('ageyear');
        $agemonth = $this->request->getPost('agemonth');
        $ageday = $this->request->getPost('ageday');
        $instruction = $this->request->getPost('instruction');

        if (is_null($bed_id) || empty($bed_id) || $bed_id == '') {
            $bed_id = 0;
        }
        if (is_null($keluar_id) || empty($keluar_id) || $keluar_id == '') {
            $keluar_id = 0;
        }
        if (is_null($status_pasien_id) || empty($status_pasien_id) || $status_pasien_id == '') {
            $status_pasien_id = 0;
        }
        if (is_null($ageyear) || empty($ageyear) || $ageyear == '') {
            $ageyear = 0;
        }
        if (is_null($agemonth) || empty($agemonth) || $agemonth = '') {
            $agemonth = 0;
        }
        if (is_null($ageday) || empty($ageday) || $ageday == '') {
            $ageday = 0;
        }
        if (is_null($saturasi) || empty($saturasi) || $saturasi == '') {
            $saturasi = 0;
        }
        if (is_null($temperature) || empty($temperature) || $temperature == '') {
            $temperature = 0;
        }
        if (is_null($tension_upper) || empty($tension_upper) || $tension_upper == '') {
            $tension_upper = 0;
        }
        if (is_null($tension_below) || empty($tension_below) || $tension_below == '') {
            $tension_below = 0;
        }
        if (is_null($nadi) || empty($nadi) || $nadi == '') {
            $nadi = 0;
        }
        if (is_null($nafas) || empty($nafas) || $nafas == '') {
            $nafas = 0;
        }
        if (is_null($weight) || empty($weight) || $weight == '') {
            $weight = 0;
        }
        if (is_null($height) || empty($height) || $height == '') {
            $height = 0;
        }
        if (is_null($arm_diameter) || empty($arm_diameter) || $arm_diameter == '') {
            $arm_diameter = 0;
        }




        $examModel = new ExaminationModel();



        // $id = '20230917232244537';
        // dd($id);


        // return json_encode($kalurahan);
        $id = $this->request->getPost('body_id');

        // echo '<pre>';
        // var_dump($_POST['body_id']);
        // var_dump($id);
        // die();



        $orgModel = new OrganizationunitModel();
        if ($id == '' || is_null($id)) {
            $orgModel = new OrganizationunitModel();
            $id = $orgModel->generateId();
            $data = [
                'org_unit_code' => $org_unit_code,
                'visit_id' => $visit_id,
                'no_registration' => $no_registration,
                'body_id' => $id,
                'petugas' => $petugas,
                // 'examination_date' => $examination_date,
                'weight' => (float)$weight,
                'height' => (float)$height,
                'temperature' => (float)$temperature,
                'nadi' => (float)$nadi,
                'tension_upper' => (float)$tension_upper,
                'tension_below' => (float)$tension_below,
                'saturasi' => (float)$saturasi,
                'nafas' => (float)$nafas,
                'arm_diameter' => (float)$arm_diameter,
                'anamnase' => $anamnase,
                'oxygen_usage' => (float)$oxygen_usage,
                'pemeriksaan' => $pemeriksaan,
                'teraphy_desc' => $teraphy_desc,
                'description' => $description,
                'clinic_id' => $clinic_id,
                'class_room_id' => $class_room_id,
                'bed_id' => $bed_id,
                'keluar_id' => $keluar_id,
                'employee_id' => $employee_id,
                'doctor' => $doctor,
                'kal_id' => $kal_id,
                'theid' => $theid,
                'thename' => $thename,
                'theaddress' => $theaddress,
                'status_pasien_id' => $status_pasien_id,
                'isrj' => $isrj,
                'gender' => $gender,
                'ageyear' => $ageyear,
                'agemonth' => $agemonth,
                'ageday' => $ageday,
                'instruction' => $instruction
            ];
            $result = $examModel->insert($data);
            // echo '<pre>';
            // echo "insert <br>";
            // var_dump($result);
            // die();
            $message = "tambah pemeriksaan fisik berhasil";
            $type = 'insert';
        } else {
            $data = [
                'org_unit_code' => $org_unit_code,
                'visit_id' => $visit_id,
                'no_registration' => $no_registration,
                'body_id' => $id,
                'petugas' => $petugas,
                // 'examination_date' => $examination_date, havin
                'weight' => (float)$weight,
                'height' => (float)$height,
                'temperature' => (float)$temperature,
                'nadi' => (float)$nadi,
                'tension_upper' => (float)$tension_upper,
                'tension_below' => (float)$tension_below,
                'saturasi' => (float)$saturasi,
                'nafas' => (float)$nafas,
                'arm_diameter' => (float)$arm_diameter,
                'anamnase' => $anamnase,
                'oxygen_usage' => (float)$oxygen_usage,
                'pemeriksaan' => $pemeriksaan,
                'teraphy_desc' => $teraphy_desc,
                'description' => $description,
                'clinic_id' => $clinic_id,
                'class_room_id' => $class_room_id,
                'bed_id' => $bed_id,
                'keluar_id' => $keluar_id,
                'employee_id' => $employee_id,
                'doctor' => $doctor,
                'kal_id' => $kal_id,
                'theid' => $theid,
                'thename' => $thename,
                'theaddress' => $theaddress,
                'status_pasien_id' => $status_pasien_id,
                'isrj' => $isrj,
                'gender' => $gender,
                'ageyear' => $ageyear,
                'agemonth' => $agemonth,
                'ageday' => $ageday,
                'instruction' => $instruction
            ];
            $result = $examModel->update($id, $data);
            // echo '<pre>';
            // echo "update <br>";
            // var_dump($result);
            // die();
            $message = "Update berhasil";
            $type = "update";
        }
        // return $result;
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => $message, 'data' => $data, 'type' => $type);
        echo json_encode($array);
    }

    public function assessmentIgd()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return $this->request->is('put');


        // return json_encode($norm);
        $rules = [
            'bed_id' => 'permit_empty|decimal',
            'keluar_id' => 'permit_empty|decimal',
            'status_pasien_id' => 'permit_empty|decimal',
            'ageyear' => 'permit_empty|decimal',
            'agemonth' => 'permit_empty|decimal',
            'ageday' => 'permit_empty|decimal',
            'saturasi' => 'permit_empty|decimal',
            'kesadaran' => 'permit_empty|decimal',
            'isvalid' => 'permit_empty|decimal',
            'temperature' => 'permit_empty|decimal',
            'tension_upper' => 'permit_empty|decimal',
            'tension_below' => 'permit_empty|decimal',
            'nadi' => 'permit_empty|decimal',
            'nafas' => 'permit_empty|decimal',
            'weight' => 'permit_empty|decimal',
            'height' => 'permit_empty|decimal',
            'arm_diameter' => 'permit_empty|decimal',
        ];



        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            $errors = $validation->getErrors();
            $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
            return json_encode($array);
        }



        $clinic_id = $this->request->getPost('clinic_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $keluar_id = $this->request->getPost('keluar_id');
        $employee_id = $this->request->getPost('employee_id');
        $no_registration = $this->request->getPost('no_registration');
        $visit_id = $this->request->getPost('visit_id');
        $org_unit_code = $this->request->getPost('org_unit_code');
        $doctor = $this->request->getPost('doctor');
        $kal_id = $this->request->getPost('kal_id');
        $theid = $this->request->getPost('theid');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isrj = $this->request->getPost('isrj');
        $gender = $this->request->getPost('gender');
        $ageyear = $this->request->getPost('ageyear');
        $agemonth = $this->request->getPost('agemonth');
        $ageday = $this->request->getPost('ageday');
        $body_id = $this->request->getPost('body_id');
        $modified_by = $this->request->getPost('modified_by');
        $pasien_diagnosa_id = $this->request->getPost('pasien_diagnosa_id');
        $assessment_type = $this->request->getPost('assessment_type');
        $examination_date = $this->request->getPost('examination_date');
        $t_01 = $this->request->getPost('t_01');
        $v_01 = $this->request->getPost('v_01');
        $t_02 = $this->request->getPost('t_02');
        $t_04 = $this->request->getPost('t_04');
        $riwayat_alergi = $this->request->getPost('riwayat_alergi');
        $v_02 = $this->request->getPost('v_02');
        $v_03 = $this->request->getPost('v_03');
        $alloanamnesis_contact = $this->request->getPost('alloanamnesis_contact');
        $alloanamnesis_hub = $this->request->getPost('alloanamnesis_hub');
        $anamnase = $this->request->getPost('anamnase');
        $diagnosa_history = $this->request->getPost('diagnosa_history');
        $riwayat_obat = $this->request->getPost('riwayat_obat');
        $tension_upper = $this->request->getPost('tension_upper');
        $tension_below = $this->request->getPost('tension_below');
        $nadi = $this->request->getPost('nadi');
        $nafas = $this->request->getPost('nafas');
        $saturasi = $this->request->getPost('saturasi');
        $temperature = $this->request->getPost('temperature');
        $t_012 = $this->request->getPost('t_012');
        $weight = $this->request->getPost('weight');
        $height = $this->request->getPost('height');
        $pemeriksaan = $this->request->getPost('pemeriksaan');
        $lokalis = $this->request->getPost('lokalis');
        $v_33 = $this->request->getPost('v_33');
        $v_34 = $this->request->getPost('v_34');
        $v_35 = $this->request->getPost('v_35');
        $diagnosa_desc = $this->request->getPost('diagnosa_desc');
        $v_36 = $this->request->getPost('v_36');
        $v_37 = $this->request->getPost('v_37');
        $instruction = $this->request->getPost('instruction');
        $description = $this->request->getPost('description');
        $t_010 = $this->request->getPost('t_010');
        $t_011 = $this->request->getPost('t_011');
        $dirujuk = $this->request->getPost('dirujuk');
        $v_31 = $this->request->getPost('v_31');
        $teraphy_desc = $this->request->getPost('teraphy_desc');
        $diagnosa_kerja = $this->request->getPost('diagnosa_kerja');
        $education_date = $this->request->getPost('education_date');
        $v_39 = $this->request->getPost('v_39');
        $v_40 = $this->request->getPost('v_40');
        $petugas = $this->request->getPost('petugas');

        if (is_null($keluar_id) || empty($keluar_id) || $keluar_id == '') {
            $keluar_id = 0;
        }
        if (is_null($status_pasien_id) || empty($status_pasien_id) || $status_pasien_id == '') {
            $status_pasien_id = 0;
        }
        if (is_null($ageyear) || empty($ageyear) || $ageyear == '') {
            $ageyear = 0;
        }
        if (is_null($agemonth) || empty($agemonth) || $agemonth = '') {
            $agemonth = 0;
        }
        if (is_null($ageday) || empty($ageday) || $ageday == '') {
            $ageday = 0;
        }
        if (is_null($saturasi) || empty($saturasi) || $saturasi == '') {
            $saturasi = 0;
        }
        if (is_null($temperature) || empty($temperature) || $temperature == '') {
            $temperature = 0;
        }
        if (is_null($tension_upper) || empty($tension_upper) || $tension_upper == '') {
            $tension_upper = 0;
        }
        if (is_null($tension_below) || empty($tension_below) || $tension_below == '') {
            $tension_below = 0;
        }
        if (is_null($nadi) || empty($nadi) || $nadi == '') {
            $nadi = 0;
        }
        if (is_null($nafas) || empty($nafas) || $nafas == '') {
            $nafas = 0;
        }
        if (is_null($weight) || empty($weight) || $weight == '') {
            $weight = 0;
        }
        if (is_null($height) || empty($height) || $height == '') {
            $height = 0;
        }



        $examModel = new AssessmentModel();



        // $id = '20230917232244537';
        // dd($id);


        // return json_encode($kalurahan);
        $id = $this->request->getPost('body_id');





        $orgModel = new OrganizationunitModel();
        if ($id == '' || is_null($id)) {
            $orgModel = new OrganizationunitModel();
            $id = $orgModel->generateId();
            $data = [
                'clinic_id' => $clinic_id,
                'class_room_id' => $class_room_id,
                'keluar_id' => $keluar_id,
                'employee_id' => $employee_id,
                'no_registration' => $no_registration,
                'visit_id' => $visit_id,
                'org_unit_code' => $org_unit_code,
                'doctor' => $doctor,
                'kal_id' => $kal_id,
                'theid' => $theid,
                'thename' => $thename,
                'theaddress' => $theaddress,
                'status_pasien_id' => $status_pasien_id,
                'isrj' => $isrj,
                'gender' => $gender,
                'ageyear' => $ageyear,
                'agemonth' => $agemonth,
                'ageday' => $ageday,
                'body_id' => $id,
                'modified_by' => $modified_by,
                'pasien_diagnosa_id' => $pasien_diagnosa_id,
                'assessment_type' => $assessment_type,
                'examination_date' => $examination_date,
                't_01' => $t_01,
                'v_01' => $v_01,
                't_02' => $t_02,
                't_04' => $t_04,
                'riwayat_alergi' => $riwayat_alergi,
                'v_02' => $v_02,
                'v_03' => $v_03,
                'alloanamnesis_contact' => $alloanamnesis_contact,
                'alloanamnesis_hub' => $alloanamnesis_hub,
                'anamnase' => $anamnase,
                'diagnosa_history' => $diagnosa_history,
                'riwayat_obat' => $riwayat_obat,
                'tension_upper' => (float)$tension_upper,
                'tension_below' => (float)$tension_below,
                'nadi' => (float)$nadi,
                'nafas' => (float)$nafas,
                'saturasi' => (float)$saturasi,
                'temperature' => (float)$temperature,
                't_012' => $t_012,
                'weight' => (float)$weight,
                'height' => (float)$height,
                'pemeriksaan' => (float)$pemeriksaan,
                'lokalis' => $lokalis,
                'v_33' => $v_33,
                'v_34' => $v_34,
                'v_35' => $v_35,
                'diagnosa_desc' => $diagnosa_desc,
                'v_36' => $v_36,
                'v_37' => $v_37,
                'instruction' => $instruction,
                'description' => $description,
                't_010' => $t_010,
                't_011' => $t_011,
                'dirujuk' => $dirujuk,
                'v_31' => $v_31,
                'teraphy_desc' => $teraphy_desc,
                'diagnosa_kerja' => $diagnosa_kerja,
                'education_date' => $education_date,
                'v_39' => $v_39,
                'v_40' => $v_40,
                'petugas' => $petugas
            ];
            $result = $examModel->insert($data);
            $message = "tambah pemeriksaan fisik berhasil";
            $type = 'insert';
        } else {
            $data = [
                'clinic_id' => $clinic_id,
                'class_room_id' => $class_room_id,
                'keluar_id' => $keluar_id,
                'employee_id' => $employee_id,
                'no_registration' => $no_registration,
                'visit_id' => $visit_id,
                'org_unit_code' => $org_unit_code,
                'doctor' => $doctor,
                'kal_id' => $kal_id,
                'theid' => $theid,
                'thename' => $thename,
                'theaddress' => $theaddress,
                'status_pasien_id' => $status_pasien_id,
                'isrj' => $isrj,
                'gender' => $gender,
                'ageyear' => $ageyear,
                'agemonth' => $agemonth,
                'ageday' => $ageday,
                'body_id' => $id,
                'modified_by' => $modified_by,
                'pasien_diagnosa_id' => $pasien_diagnosa_id,
                'assessment_type' => $assessment_type,
                'examination_date' => $examination_date,
                't_01' => $t_01,
                'v_01' => $v_01,
                't_02' => $t_02,
                't_04' => $t_04,
                'riwayat_alergi' => $riwayat_alergi,
                'v_02' => $v_02,
                'v_03' => $v_03,
                'alloanamnesis_contact' => $alloanamnesis_contact,
                'alloanamnesis_hub' => $alloanamnesis_hub,
                'anamnase' => $anamnase,
                'diagnosa_history' => $diagnosa_history,
                'riwayat_obat' => $riwayat_obat,
                'tension_upper' => (float)$tension_upper,
                'tension_below' => (float)$tension_below,
                'nadi' => (float)$nadi,
                'nafas' => (float)$nafas,
                'saturasi' => (float)$saturasi,
                'temperature' => (float)$temperature,
                't_012' => $t_012,
                'weight' => (float)$weight,
                'height' => (float)$height,
                'pemeriksaan' => (float)$pemeriksaan,
                'lokalis' => $lokalis,
                'v_33' => $v_33,
                'v_34' => $v_34,
                'v_35' => $v_35,
                'diagnosa_desc' => $diagnosa_desc,
                'v_36' => $v_36,
                'v_37' => $v_37,
                'instruction' => $instruction,
                'description' => $description,
                't_010' => $t_010,
                't_011' => $t_011,
                'dirujuk' => $dirujuk,
                'v_31' => $v_31,
                'teraphy_desc' => $teraphy_desc,
                'diagnosa_kerja' => $diagnosa_kerja,
                'education_date' => $education_date,
                'v_39' => $v_39,
                'v_40' => $v_40,
                'petugas' => $petugas
            ];
            $result = $examModel->update($id, $data);
            $message = "Update berhasil";
            $type = "update";
        }
        // return $result;
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => $message, 'data' => $data, 'type' => $type);
        echo json_encode($array);
    }

    public function getPPKRujukan()
    {
        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $rujukanModel = new InasisFaskesModel();
            $result = $this->lowerKey($rujukanModel->select('top(20) *')->like('kdprovider', '%' . $search_term . '%')->orLike('nmprovider', '%' . $search_term . '%')->findALl());
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['kdprovider'], "text" => $value['nmprovider'] . " (" . $value['kdprovider'] . ")");
                }
            } else {
                $vclaim = new Vclaim();
                $result = $vclaim->getFaskes($search_term);
                $result = $result['response']['faskes'];
                if (!empty($result)) {
                    foreach ($result as $value) {
                        $data[] = array("id" => $value['kode'], "text" => $value['nama'] . " (" . $value['kode'] . ")");
                    }
                }
            }
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function getDataFillRekamMedis()
    {
        $visit_id = $this->request->getPost('visit_id');
        $no_registration = $this->request->getPost('no_registration');

        $p = new PasienModel();
        $pasien = $this->lowerKey($p->find($no_registration));
        $alergi = $pasien['medical_notes'];

        $db = db_connect();
        // $data = $db->query("select  STUFF(
        //     (SELECT ',' +  display_tarif from laborat_type lt  inner join  pasien_laborat on 
        // treatment_desc like '%'+display_tarif+'%' and pasien_laborat.visit_id  = '$visit_id' and display_tarif <> ''
        // group by display_tarif
        //      FOR XML PATH (''))
        //     , 1, 1, '') as hasillab
        //     from ORGANIZATIONUNIT;");

        //         $dataro = $db->query("select  STUFF(
        //             (SELECT ',' +  treatment_desc from  pasien_radiologi where 
        //              pasien_radiologi.visit_id  = '$visit_id'
        // group by treatment_desc
        //              FOR XML PATH (''))
        //             ,1, 2, '')
        //             from ORGANIZATIONUNIT;");

        $data['alergi'] = $alergi;

        $datafarmasi = $db->query("select  STUFF(
            (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
             treatment_obat.visit_id  = '$visit_id' 
             and DESCRIPTION <> '%jasa%'
                group by description ,isnull(description2,'')
             FOR XML PATH (''))
            ,1, 2, '') as datafarmasi
            from ORGANIZATIONUNIT");

        return json_encode($datafarmasi);
        $hasillab = $data['hasillab'];
    }

    public function getHistoryRekamMedis()
    {
        $no_registration = $this->request->getPost('no_registration');
        $visit_id = $this->request->getPost('visit_id');

        $pd = new PasienDiagnosaModel();
        $pdData = $pd->notLike('visit_id', $visit_id)->where('no_registration', $no_registration)->orderBy('date_of_diagnosa desc')->findAll();
        $pasienDiagnosa = $this->lowerKey($pdData);

        return json_encode($pasienDiagnosa);
    }

    public function addrekammedis()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return $this->request->is('put');


        // return json_encode($norm);
        // $rules = [
        //     'bed_id' => 'permit_empty|integer',
        //     'keluar_id' => 'permit_empty|integer',
        //     'status_pasien_id' => 'permit_empty|integer',
        //     'ageyear' => 'permit_empty|integer',
        //     'agemonth' => 'permit_empty|integer',
        //     'ageday' => 'permit_empty|integer',
        //     'saturasi' => 'permit_empty|integer',
        //     'kesadaran' => 'permit_empty|integer',
        //     'isvalid' => 'permit_empty|integer',
        //     'temperature' => 'permit_empty|integer',
        //     'tension_upper' => 'permit_empty|integer',
        //     'tension_below' => 'permit_empty|integer',
        //     'nadi' => 'permit_empty|integer',
        //     'nafas' => 'permit_empty|integer',
        //     'weight' => 'permit_empty|integer',
        //     'height' => 'permit_empty|integer',
        //     'arm_diameter' => 'permit_empty|integer',
        // ];



        // if (!$this->validate($rules)) {
        //     $validation = \Config\Services::validation();
        //     $errors = $validation->getErrors();
        //     $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
        //     return json_encode($array);
        // }


        $org_unit_code = $this->request->getPost('org_unit_code');
        $no_registration = $this->request->getPost('no_registration');
        $date_of_diagnosa = $this->request->getPost('date_of_diagnosa');
        $report_date = $this->request->getPost('report_date');
        $diagnosa_desc_06 = $this->request->getPost('diagnosa_desc_06');
        $theid = $this->request->getPost('theid');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isrj = $this->request->getPost('isrj');
        $gender = $this->request->getPost('gender');
        $ageyear = $this->request->getPost('ageyear');
        $agemonth = $this->request->getPost('agemonth');
        $ageday = $this->request->getPost('ageday');
        $kal_id = $this->request->getPost('kal_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $spesialistik = $this->request->getPost('spesialistik');
        $employee_id = $this->request->getPost('employee_id');
        $doctor = $this->request->getPost('doctor');
        $class_room_id = $this->request->getPost('class_room_id');
        $bed_id = $this->request->getPost('bed_id');
        $result_id = $this->request->getPost('result_id');
        $keluar_id = $this->request->getPost('keluar_id');
        $in_date = $this->request->getPost('in_date');
        $exit_date = $this->request->getPost('exit_date');
        $modified_by = $this->request->getPost('modified_by');
        $nosep = $this->request->getPost('nosep');
        $nokartu = $this->request->getPost('nokartu');
        $tglsep = $this->request->getPost('tglsep');
        $visit_id = $this->request->getPost('visit_id');
        $id = $this->request->getPost('pasien_diagnosa_id');
        $teraphy_desc = $this->request->getPost('teraphy_desc');
        $pemeriksaan = $this->request->getPost('pemeriksaan');
        $anamnase = $this->request->getPost('anamnase');
        $description = $this->request->getPost('description');
        $diagnosa_desc_05 = $this->request->getPost('diagnosa_desc_05');
        $diagnosa_desc_06 = $this->request->getPost('diagnosa_desc_06');
        $anamnase = $this->request->getPost('anamnase');
        $pemeriksaan = $this->request->getPost('pemeriksaan');
        $pemeriksaan_02 = $this->request->getPost('pemeriksaan_02');
        $pemeriksaan_03 = $this->request->getPost('pemeriksaan_03');
        $pemeriksaan_05 = $this->request->getPost('pemeriksaan_05');
        $teraphy_desc = $this->request->getPost('teraphy_desc');
        $instruction = $this->request->getPost('instruction');
        $morfologi_neoplasma = $this->request->getPost('morfologi_neoplasma');
        $disability = $this->request->getPost('disability');
        $rencanatl = $this->request->getPost('rencanatl');
        $dirujukke = $this->request->getPost('dirujukke');
        $tgl_kontrol = $this->request->getPost('tgl_kontrol');
        $kdpoli_kontrol = $this->request->getPost('kdpoli_kontrol');
        $procedure_05 = $this->request->getPost('procedure_05');
        $suffer_type = $this->request->getPost('suffer_type');
        $diag_id = $this->request->getPost('diag_id');
        $diag_cat = $this->request->getPost('diag_cat');
        $diag_name = $this->request->getPost('diag_name');

        $proc_id = $this->request->getPost('proc_id');
        $proc_cat = $this->request->getPost('proc_cat');
        $proc_name = $this->request->getPost('proc_name');

        $dpjp = $this->request->getPost('kddpjp');


        // dd(json_encode($diag_id[0]));
        $pv = new PasienVisitationModel();
        $kunjungan = $this->lowerKeyOne($pv->find($visit_id));
        $p = new PasienModel();
        $pasien = $this->lowerKeyOne($p->find($no_registration));
        $ea = new EmployeeAllModel();
        $employee = $this->lowerKeyOne($ea->find($employee_id));


        $ssjson = '{
                        "resourceType": "Bundle",
                        "type": "transaction",
                        "entry": [
                        ]
                    }';
        $ssjson = json_decode($ssjson, true);

        $pd = new PasienDiagnosaModel();


        if ($id == '') {
            $orgModel = new OrganizationunitModel();
            $id = $orgModel->generateId();
            $mesej = 'tambah';
        } else {
            $mesej = 'update';
        }
        // dd($id);


        // return json_encode($description);


        $data = [
            'org_unit_code' => $org_unit_code,
            'no_registration' => $no_registration,
            'visit_id' => $visit_id,
            'date_of_diagnosa' => $date_of_diagnosa,
            'report_date' => $report_date,
            'diagnosa_desc_06' => $diagnosa_desc_06,
            'theid' => $theid,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'status_pasien_id' => $status_pasien_id,
            'isrj' => $isrj,
            'gender' => $gender,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
            'kal_id' => $kal_id,
            'clinic_id' => $clinic_id,
            'spesialistik' => $spesialistik,
            'employee_id' => $employee_id,
            'doctor' => $doctor,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'result_id' => $result_id,
            'keluar_id' => $keluar_id,
            'in_date' => $in_date,
            'exit_date' => $exit_date,
            // 'modified_date' => $modified_date,
            'modified_by' => $modified_by,
            'nosep' => $nosep,
            'nokartu' => $nokartu,
            'tglsep' => $tglsep,
            'visit_id' => $visit_id,
            'pasien_diagnosa_id' => $id,
            'teraphy_desc' => $teraphy_desc,
            'pemeriksaan' => $pemeriksaan,
            'anamnase' => $anamnase,
            'description' => $description,
            'diagnosa_desc_05' => $diagnosa_desc_05,
            'diagnosa_desc_06' => $diagnosa_desc_06,
            'anamnase' => $anamnase,
            'pemeriksaan' => $pemeriksaan,
            'pemeriksaan_02' => $pemeriksaan_02,
            'pemeriksaan_03' => $pemeriksaan_03,
            'pemeriksaan_05' => $pemeriksaan_05,
            'teraphy_desc' => $teraphy_desc,
            'instruction' => $instruction,
            'morfologi_neoplasma' => $morfologi_neoplasma,
            'disability' => $disability,
            'rencanatl' => $rencanatl,
            'dirujukke' => $dirujukke,
            'tglkontrol' => $tgl_kontrol,
            'kdpoli_kontrol' => $kdpoli_kontrol,
            'procedure_05' => $procedure_05,
            // 'suffer_type' => $suffer_type,
            'modified_by' => user_id()
        ];





        if ($mesej == 'tambah') {
            // $mesej = 'tambah';
            $pd->insert($data);
        } else {
            // return json_encode($data);
            $pd->save($data);
        }

        if (!empty($diag_id)) {
            $pds = new PasienDiagnosasModel();
            $pds->where('pasien_diagnosa_id', $id)->delete();

            foreach ($diag_id as $key => $value) {
                $dataDiag = [];
                $dataDiag['pasien_diagnosa_id'] = $id;
                $dataDiag['diagnosa_id'] = $diag_id[$key];
                $dataDiag['diagnosa_name'] = $diag_name[$key];
                $dataDiag['diag_cat'] = $diag_cat[$key];
                $dataDiag['suffer_type'] = $suffer_type[$key];
                $dataDiag['modified_by'] = user_id();
                $dataDiag['sscondition_id'] = new RawSql('newid()');

                $pds->insert($dataDiag);
            }
        }
        if (!empty($proc_id)) {
            $pcs = new PasienProceduresModel();
            $pcs->where('pasien_diagnosa_id', $id)->delete();

            foreach ($proc_id as $key => $value) {
                $dataProc = [];
                $dataProc['pasien_diagnosa_id'] = $id;
                $dataProc['diagnosa_id'] = $proc_id[$key];
                $dataProc['diagnosa_name'] = $proc_name[$key];
                $dataProc['modified_by'] = user_id();

                $pcs->insert($dataProc);
            }
        }


        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => $mesej . ' riwayat rekam medis berhasil', 'data' => $data);
        echo json_encode($array);
    }
    public function getKontrol()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }


        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $visit = $body['visit'];
        $nosurat = $body['nosurat'];

        $model = new InasisKontrolModel();

        $select = $model->where("visit_id", $visit)->find();
    }
    public function postKontrol()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $nosep = $body['nosep'];
        $dpjp = $body['kddpjp'];
        $tgl_kontrol = $body['tgl_kontrol'];
        $clinic_id = $body['clinic_id'];
        $noSkdp = $body['noSkdp'];
        $noSpri = $body['noSpri'];
        $noKartu = $body['noKartu'];
        // $noSuratKontrol = $body['noSkdp'];
        $employee = $body['employee_id'];
        $visit = $body['visit_id'];
        $jenisSurat = $body['jenisKontrol'];

        if ($dpjp == '') {
            $empModel = new EmployeeAllModel();
            $query = $empModel->select('dpjp')->find($employee);
            $dpjp = $query['dpjp'];
        }

        $noSuratKontrol = ($jenisSurat == 1) ? $noSkdp : $noSpri;



        $cModel = new ClinicModel();
        $query = $cModel->select("kdpoli, name_of_clinic")->where('clinic_id', $clinic_id)->find($clinic_id);
        // return json_encode($query);
        $kdpoli = $query['kdpoli'];
        $name_clinic = $query['name_of_clinic'];

        $ws_data = [];
        if ($noSuratKontrol != '') {
            $method = 'PUT';
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/';
            if ($jenisSurat == 1) {
                $url .= 'Update';
                $ws_data['noSuratKontrol'] = $noSuratKontrol;
            } else {
                $url .= 'UpdateSPRI';
                $ws_data['noSPRI'] = $noSuratKontrol;
            }
        } else {
            $method = 'POST';
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/';
            if ($jenisSurat == 1) {
                $url .= 'insert';
            } else {
                $url .= 'InsertSPRI';
            }
        }
        if ($jenisSurat == 1) {
            $ws_data['noSEP'] = $nosep;
        } else {
            $ws_data['noKartu'] = $noKartu;
        }
        $ws_data['kodeDokter'] = $dpjp;
        $ws_data['poliKontrol'] = $kdpoli;
        $ws_data['tglRencanaKontrol'] = $tgl_kontrol;
        $ws_data['user'] = user_id();



        $request['request'] = $ws_data;
        $postdata = json_encode($request);
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;

        if (isset($response['metaData']['code'])) {
            if ($response['metaData']['code'] == '200') {
                $inasisKontrol = new InasisKontrolModel();
                if ($jenisSurat == 1) {
                    $noSuratKontrol = $response['response']['noSuratKontrol'];
                } else {
                    $noSuratKontrol = $response['response']['noSPRI'];
                }
                $data = [
                    'visit_id' => $visit,
                    'nosep' => $nosep,
                    'surattype' => $jenisSurat,
                    'nosuratkontrol' => $noSuratKontrol,
                    'tglrenckontrol' => $tgl_kontrol,
                    'polikontrol_kdpoli' => $kdpoli,
                    'polikontrol_nmpoli' => $name_clinic,
                    'kodedokter' => $dpjp,
                    'modified_by' => user_id(),
                    'responpost' => json_encode($response),
                ];
                $inasisKontrol->save($data);
            }
        }

        return json_encode($response);
    }
    public function deleteKontrol()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $noSuratKontrol = $body['noSuratKontrol'];

        $ws_data = [];
        if ($noSuratKontrol == '') {
            return '';
        } else {
            $method = 'DELETE';
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/Delete';
        }
        $ws_data['noSuratKontrol'] = $noSuratKontrol;
        $ws_data['user'] = user_id();
        $request['request']['t_suratkontrol'] = $ws_data;
        $postdata = json_encode($request);
        // return $postdata;
        $posting = $this->sendVclaim($url, $method, $postdata);
        $response = $posting;

        if (isset($response['metaData']['code'])) {
            if ($response['metaData']['code'] == '200') {
                $inasisKontrol = new InasisKontrolModel();
                $inasisKontrol->delete($noSuratKontrol);
            }
        }

        return json_encode($response);
    }
    public function postRujukan()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $nosep = $body['nosep'];
        $norujukan = $body['norujukan'];
        $tglRujukan = $body['tglRujukan'];
        $tglRencanaKunjungan = $body['tglRencanaKunjungan'];
        $ppkdirujuk = $body['ppkdirujuk'];
        $jnsPelayanan = $body['jnsPelayanan'];
        $catatan = $body['catatan'];
        // $diagRujukan = $body['diagRujukan'];
        $tipeRujukan = $body['tipeRujukan'];
        // $clinic_id = $body['poliRujukan'];
        $poliRujukanName = $body['nmPoliRujukan'];
        $visit = $body['visit'];
        $ppkdirujukName = $body['ppkdirujukName'];
        $diagRujukanName = $body['diagRujukanName'];
        $sex = $body['sex'];
        $nama = $body['nama'];
        $nokartu = $body['nokartu'];
        $nomr = $body['nomr'];
        $status_pasien_id = $body['status_pasien_id'];
        $transfer = $body['formtransfer'];
        $given = $body['given'];
        $needs = $body['needs'];

        // return json_encode($transfer);

        $cModel = new ClinicModel();
        // $query = $cModel->select("kdpoli, name_of_clinic")->where('clinic_id', $clinic_id)->find($clinic_id);
        // return json_encode($query);
        // $poliRujukan = $query['kdpoli'];
        // $poliRujukanName = $query['name_of_clinic'];

        $inasisRujukan = new InasisRujukanModel();


        if (false) {
            // if ($status_pasien_id == '18') {


            $ws_data = [];
            if ($norujukan != '') {
                $method = 'PUT';
                $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/2.0/';
                $url .= 'Update';
                $ws_data['noRujukan'] = $norujukan;
            } else {
                $method = 'POST';
                $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/2.0/';
                $url .= 'insert';
                $ws_data['noSep'] = $nosep;
            }
            $ws_data['tglRujukan'] = $tglRujukan;
            $ws_data['tglRencanaKunjungan'] = $tglRencanaKunjungan;
            $ws_data['ppkDirujuk'] = $ppkdirujuk;
            $ws_data['jnsPelayanan'] = $jnsPelayanan;
            $ws_data['catatan'] = $catatan;
            // $ws_data['diagRujukan'] = $diagRujukan;
            $ws_data['tipeRujukan'] = $tipeRujukan;
            $ws_data['poliRujukan'] = $poliRujukan;
            $ws_data['user'] = user_id();



            $request['request']['t_rujukan'] = $ws_data;
            $postdata = json_encode($request);

            // return $postdata;
            // $posting = $this->sendVclaim($url, $method, $postdata);
            // $response = $posting;
            // $posting = ' {
            //             "metaData": {
            //                 "code": "200",
            //                 "message": "OK"
            //             },
            //             "response": {
            //                 "rujukan": {
            //                 "AsalRujukan": {
            //                     "kode": "0301R001d",
            //                     "nama": "RSUP DR M JAMIL PADANG"
            //                 },
            //                 "diagnosa": {
            //                     "kode": "A15",
            //                     "nama": "A15 - Respiratory tuberculosis, bacteriologically and histologically confirmed"
            //                 },
            //                 "noRujukan": "0301R0010321B000012",
            //                 "peserta": {
            //                     "asuransi": "-",
            //                     "hakKelas": null,
            //                     "jnsPeserta": "PBI (APBD)",
            //                     "kelamin": "Laki-Laki",
            //                     "nama": "FADLAN LISMI AZIZ",
            //                     "noKartu": "0001329783085",
            //                     "noMr": "00754610",
            //                     "tglLahir": "2006-02-20"
            //                 },
            //                 "poliTujuan": {
            //                     "kode": "",
            //                     "nama": ""
            //                 },
            //                 "tglBerlakuKunjungan": "2021-06-16",
            //                 "tglRencanaKunjungan": "2021-03-19",
            //                 "tglRujukan": "2021-03-18",
            //                 "tujuanRujukan": {
            //                     "kode": "03010402",
            //                     "nama": "PEGAMBIRAN"
            //                 }
            //                 }
            //             }
            //             }';
            $response = json_decode($postdata, true);

            if (isset($response['metaData']['code'])) {
                if ($response['metaData']['code'] == '200') {
                    $norujukan = $response['response']['rujukan']['noRujukan'];

                    $data = [
                        'visit_id' => $visit,
                        'nosep' => $nosep,
                        'tglsep' => $tglRujukan,
                        'tglrujukan' => $tglRencanaKunjungan,
                        'tiperujukan' => $tipeRujukan,
                        'kdjnspelayanan' => $jnsPelayanan,
                        'catatan' => $catatan,
                        // 'kddiag' => $diagRujukan,
                        'nmdiag' => $diagRujukanName,
                        // 'polirujukan_kdpoli' => $poliRujukan,
                        'polirujukan_nmpoli' => $poliRujukanName,
                        'provrujukan_kdprovider' => $ppkdirujuk,
                        'provrujukan_nmprovider' => $ppkdirujukName,
                        'nokunjungan' => $norujukan,
                        'sex' => $sex,
                        'nama' => $nama,
                        'nokartu' => $nokartu,
                        'nomr' => $nomr,
                        'modified_by' => user_id(),
                    ];
                    if ($method == 'PUT') {
                        $data['responput'] = json_encode($response);
                    } else {

                        $data['responpost'] = json_encode($response);
                    }
                    if ($jnsPelayanan == '1') {
                        $data['jnspelayanan'] = 'Rawat Jalan';
                    } else {
                        $data['jnspelayanan'] = 'Rawat Inap';
                    }
                    $inasisRujukan->save($data);
                }
            }
        } else {
            $orgunit = new OrganizationunitModel();
            if ($norujukan == '' || is_null($norujukan)) {
                $norujukan = $orgunit->generateId();
            }
            $data = [
                'visit_id' => $visit,
                'nosep' => $nosep,
                'tglsep' => $tglRujukan,
                'tglrujukan' => $tglRencanaKunjungan,
                'tiperujukan' => $tipeRujukan,
                'kdjnspelayanan' => $jnsPelayanan,
                'catatan' => $catatan,
                'nmdiag' => $diagRujukanName,
                // 'polirujukan_kdpoli' => $poliRujukan,
                'polirujukan_nmpoli' => $poliRujukanName,
                'provrujukan_kdprovider' => $ppkdirujuk,
                'provrujukan_nmprovider' => $ppkdirujukName,
                'nokunjungan' => $norujukan,
                'sex' => $sex,
                'nama' => $nama,
                'nokartu' => $nokartu,
                'nomr' => $nomr,
                'modified_by' => user_id(),
                'given' => $given,
                'needs' => $needs
            ];
            // if ($method == 'PUT') {
            //     $data['responput'] = json_encode($response);
            // } else {

            //     $data['responpost'] = json_encode($response);
            // }
            if ($jnsPelayanan == '1') {
                $data['jnspelayanan'] = 'Rawat Jalan';
            } else {
                $data['jnspelayanan'] = 'Rawat Inap';
            }
            $inasisRujukan->save($data);
        }

        $transfer['org_id'] = $ppkdirujuk;
        $transfer['org_name'] = $ppkdirujukName;
        $transfer['clinic_id_to'] = $poliRujukanName;
        $transfer['examination_date'] = str_replace("T", " ", $transfer['examination_date']);

        $pt = new PasienTransferModel();
        $pt->save($transfer);

        $response['metaData']['code'] = '200';
        $response['response'] = $norujukan;
        return json_encode($response);
    }

    public function deleteRujukan()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $noRujukan = $body['noRujukan'];
        $visit = $body['visit_id'];

        $ws_data = [];
        if ($noRujukan == '') {
            return json_encode($noRujukan);
        } else {
            $method = 'DELETE';
            $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/Rujukan/delete';
        }
        $ws_data['noRujukan'] = $noRujukan;
        $ws_data['user'] = user_id();
        $request['request']['t_rujukan'] = $ws_data;
        $postdata = json_encode($request);
        // $posting = $this->sendVclaim($url, $method, $postdata);
        // $response = $posting;

        //     $posting = '{
        //    "metaData": {
        //       "code": "200",
        //       "message": "OK"
        //    },
        //    "response": 0301R0011117B000014 
        // }';
        $response['metaData']['code'] = "200";
        $response['metaData']['message'] = "OK";
        $response['response'] = "0301R0011117B000014";

        if (isset($response['metaData']['code'])) {
            if ($response['metaData']['code'] == '200') {
                $inasisRujukan = new InasisRujukanModel();
                $inasisRujukan->delete($noRujukan);
            }
        }
        return json_encode($response);
    }
    public function getRujukan()
    {
        // Check if the request method is POST
        if (!$this->request->is('post')) {
            return $this->response
                ->setStatusCode(200) // Method Not Allowed
                ->setJSON(['error' => 'Invalid request method. POST required.']);
        }

        // Get and decode the request body
        $body = $this->request->getBody();
        $bodyArray = json_decode($body, true);

        // Handle case where json_decode fails
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response
                ->setStatusCode(200) // Bad Request
                ->setJSON(['error' => 'Invalid JSON format']);
        }

        // Ensure 'visit' key is present in the body
        if (!isset($bodyArray['visit'])) {
            return $this->response
                ->setStatusCode(200) // Bad Request
                ->setJSON(['error' => 'Missing visit key']);
        }

        $visit = $bodyArray['visit'];

        try {
            // Instantiate the model and perform the query
            $irModel = new InasisRujukanModel();
            $result = $this->lowerKey($irModel->where('visit_id', $visit)->find());

            // Return JSON encoded result
            if (empty($result)) {
                return $this->response
                    ->setStatusCode(200) // Not Found
                    ->setJSON([]);
            } else {
                $clinic = new ClinicModel();
                $selectclinic = $this->lowerKey($clinic->where("kdpoli", $result[0]['polirujukan_kdpoli'])->find());
                if (!is_array($selectclinic)) {
                    return $this->response
                        ->setStatusCode(200) // Not Found
                        ->setJSON([]);
                }
                // return json_encode($selectclinic);
                $result[0]['clinic_id'] = $selectclinic[0]['clinic_id'];
                return json_encode($result[0]);
                return $this->response
                    ->setStatusCode(200) // OK
                    ->setJSON($result[0]);
            }
        } catch (\Exception $e) {
            // Log the exception and return a user-friendly error message
            // Consider using a logger to record the exception details
            error_log($e->getMessage());
            return $this->response
                ->setStatusCode(200) // Internal Server Error
                ->setJSON(['error' => 'An error occurred while processing your request']);
        }
    }

    public function getSkdp()
    {

        $url = 'https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/RencanaKontrol/ListRencanaKontrol/Bulan/10/Tahun/2023/Nokartu/0001827118427/filter/2';

        $postdata = '';
        // return $postdata;
        $posting = $this->sendVclaim($url, 'GET', $postdata);
        $response = $posting;


        return json_encode($response);
    }



    public function getDiagnosas()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $id = $body['id'];

        // return json_encode($id);

        $pds = new PasienDiagnosasModel();

        $select = $this->lowerKey($pds->where('pasien_diagnosa_id', $id)->orderBy('diag_cat')->findAll());

        return json_encode($select);
    }

    public function getProcedures()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $id = $body['id'];

        // return json_encode($id);

        $pds = new PasienProceduresModel();

        $select = $this->lowerKey($pds->where('pasien_diagnosa_id', $id)->findAll());

        return json_encode($select);
    }

    public function getBillPoli()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $nomor = $body['nomor'];
        $ke = $body['ke'];
        $mulai = $body['mulai'];
        $akhir = $body['akhir'];
        $lunas = $body['lunas'];
        $klinik = $body['klinik'];
        $rj = $body['rj'];
        $status = $body['status'];
        $nota = $body['nota'];
        $trans = $body['trans'];



        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5)")->findAll());

        $scheduleModel = new DoctorScheduleModel();
        $schedule = $this->lowerKey($scheduleModel->getSchedule());




        $tb = new TreatmentBillModel();
        $tbselect = $this->lowerKey($tb->getBill($nomor, $ke, $mulai, $akhir, $lunas, $klinik, $rj, $status, $nota, $trans));
        $tbselect = $this->sortByValue($tbselect, 'treat_date');

        // $ages = array_column($tbselect, 'treat_date');

        // return json_encode($ages);

        // $ages = [];
        // foreach ($tbselect as $key => $value) {
        //     $ages[] = $tbselect[$key]['treat_date'];
        // }
        // return json_encode($ages);
        // $ages = array_column($tbselect, 'treat_date');
        // return json_encode($ages);
        // return json_encode($tbselect);
        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        foreach ($tbselect as $key => $value) {
            foreach ($clinic as $key1 => $value1) {
                if ($clinic[$key1]['clinic_id'] == $tbselect[$key]['clinic_id']) {
                    $tbselect[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                }
            }
            foreach ($statusPasien as $key1 => $value) {
                if ($statusPasien[$key1]['status_pasien_id'] == $tbselect[$key]['status_pasien_id']) {
                    $tbselect[$key]['name_of_status_pasien'] = $statusPasien[$key1]['name_of_status_pasien'];
                }
            }
        }

        return json_encode($tbselect);
    }

    public function getMrPasien()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $nomor = $body['nomor'];



        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5)")->findAll());

        $scheduleModel = new DoctorScheduleModel();
        $schedule = $this->lowerKey($scheduleModel->getSchedule());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());




        $tb = new PasienDiagnosaModel();
        $tbselect = $this->lowerKey($tb->select('top(20) *')->where('no_registration', $nomor)->orderBy('date_of_diagnosa desc')->findAll());

        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());

        foreach ($tbselect as $key => $value) {
            foreach ($employee as $key1 => $value) {
                if ($employee[$key1]['employee_id'] == $tbselect[$key]['employee_id']) {
                    $tbselect[$key]['fullname'] = $employee[$key1]['fullname'];
                }
            }
            foreach ($clinic as $key1 => $value1) {
                if ($clinic[$key1]['clinic_id'] == $tbselect[$key]['clinic_id']) {
                    $tbselect[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                }
            }
        }

        return json_encode($tbselect);
    }

    public function getTreatResult()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $nomor = $body['nomor'];
        $visit = $body['visit'];
        $tarif_id = $body['tarif_id'];



        $model = new ResultTypeModel();
        $resultType = $this->lowerKey($model->findAll());




        $tb = new TreatResultModel();
        $tbselect = $this->lowerKey($tb->getTreatResult($nomor, $visit, $tarif_id));

        foreach ($tbselect as $key => $value) {
            foreach ($resultType as $key1 => $value) {
                if ($resultType[$key1]['result_type'] == $tbselect[$key]['result_type']) {
                    $tbselect[$key]['result_name'] = $resultType[$key1]['results'];
                }
            }
            foreach ($resultType as $key1 => $value) {
                if ($resultType[$key1]['result_type'] == $tbselect[$key]['result_type']) {
                    $tbselect[$key]['result_symbol'] = $resultType[$key1]['symbol'];
                }
            }
        }

        return json_encode($tbselect);
    }
    public function getTreatResultList()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $nomor = $body['nomor'];
        $visit = $body['visit'];
        $clinic_id = $body['clinic_id'] ?? null;



        $model = new ResultTypeModel();
        $resultType = $this->lowerKey($model->findAll());


        $tb = new TreatResultModel();
        $tbselect = $this->lowerKey($tb->getTreatResultList($nomor, $visit, $clinic_id));


        foreach ($tbselect as $key => $value) {
            foreach ($resultType as $key1 => $value) {
                if ($resultType[$key1]['result_type'] == $tbselect[$key]['result_type']) {
                    $tbselect[$key]['result_name'] = $resultType[$key1]['results'];
                }
            }
            foreach ($resultType as $key1 => $value) {
                if ($resultType[$key1]['result_type'] == $tbselect[$key]['result_type']) {
                    $tbselect[$key]['result_symbol'] = $resultType[$key1]['symbol'];
                }
            }
        }

        return json_encode($tbselect);
    }

    public function getHasilLab()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $nomor = $body['nomor'];
        $visit = $body['visit'];

        $nomor = '453284';

        $db = db_connect('sharelis');
        $builder = $db->table('HASIL_PEMERIKSAANV2 hp')->join('HLISV2 hl', ' hl.NO_NOTA = hp.NO_NOTA ', 'inner')
            ->where('no_rm', $nomor)
            ->where('hl.periksa_tgl between dateadd(month,-4, getdate()) and dateadd(minute,1439, getdate())')
            ->select(' hp.NO_NOTA, hp.NO_LAB, hp.PARAMETER_ID, hp.PARAMETER_NAME, 
        hp.HASIL, hp.SATUAN, hp.NILAI_RUJUKAN, hp.METODE,
        hl.NO_RM,hl.nama,hl.tgl_lahir,hl.sex,hl.alamat,cast(hl.PERIKSA_TGL as date) as PERIKSA_TGL
        ,hp.description')
            ->groupBy('hp.NO_NOTA, hp.NO_LAB, hp.PARAMETER_ID, hp.PARAMETER_NAME, 
        hp.HASIL, hp.SATUAN, hp.NILAI_RUJUKAN, hp.METODE,
        hl.NO_RM,hl.nama,hl.tgl_lahir,hl.sex,hl.alamat,cast(hl.PERIKSA_TGL as date),hp.description')
            ->orderBy('hp.parameter_id');
        $query = $builder->get();
        $result = $query->getResultArray();
        $result = $this->lowerKey($result);

        $headerKey = [];

        foreach ($result as $key => $value) {
            $headerKey[$value['periksa_tgl']] = '<i class="far fa-caret-square-down"></i> (' . $value['periksa_tgl'] . ")";
        }

        $dt = '';

        foreach ($headerKey as $key => $value) {
            $dt = $dt . '<div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#labResult' . $key . '" aria-expanded="true" aria-controls="labResult' . $key . '">
                                    ' . $value . '
                                </button>
                            </h2>
                            <div id="labResult' . $key . '" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted">
                                    <table id="labTable" class="table table-bordered table-hover">
                                        <thead class="table-primary" style="text-align: center;">
                                            <tr>
                                                <th class="text-center" style="width: 4%;">No.</th class="text-center">
                                                <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
                                                <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
                                                <th class="text-center" colspan="5" style="width: 50%;">Aturan Minum</th class="text-center">
                                            </tr>
                                        </thead>
                                        <tbody id="viewlab' . $key . '">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>';
            //     $dt = $dt . "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#accordion' href='#" . $key . "'>" . $value . "</a></h4></div><div id='" . $key . "' class='panel-collapse collapse'><div class='panel-body'>";
            //     $dt = $dt . '<table  class="table table-borderedcustom table-bordered table-hover">
            //     <thead style="text-align: center;">
            //     <tr>
            //         <th class="text-center" rowspan="2" style="width: 30%;">Nama Test</th class="text-center">
            //         <th class="text-center" rowspan="2" style="width: 10%;">Hasil</th class="text-center">
            //         <th class="text-center" rowspan="2" style="width: 10%;">Satuan</th class="text-center">
            //         <th class="text-center" rowspan="2" style="width: auto;">Nilai Rujukan</th class="text-center">
            //         <th class="text-center" rowspan="2" style="width: 30%;">Catatan</th class="text-center">
            //         <th class="text-center" rowspan="2" style="width: auto;"></th class="text-center">
            //     </tr>
            //     </thead>
            //     <tbody id="viewlab' . $key . '">

            //     </tbody>

            // </table>';
            //     $dt = $dt . '</div></div></div>';
        }
        $data['result'] = $result;
        $data['headerKey'] = $dt;

        return json_encode($data);
    }

    public function getResep()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $visitId = $body['visit_id'];
        $nomor = $body['nomor'];
        $soldStatus = $body['sold_status'];

        if ($soldStatus == 0) {
            $gf = new GoodGfModel();
            $select = $this->lowerKey($gf->getHistoryObatResep($nomor, $soldStatus, $visitId));
        } else {
            $to = new TreatmentObatModel();
            $select = $this->lowerKey($to->getHistoryObatResep($nomor, $soldStatus));
        }
        // $to = new TreatmentObatModel();
        // $select = $this->lowerKey($to->getHistoryObatResep($nomor, $soldStatus));

        // $select = $this->lowerKey($to->getObatResep($visitId));

        $obat = [];
        $historyObat = [];
        $visitHistory = [];

        $db = new ClinicModel();
        $clinic = $this->lowerKey($db->findAll());
        $db = new EmployeeAllModel();
        $employee = $this->lowerKey($db->getEmployee());

        // return json_encode($select);


        foreach ($select as $key => $value) {
            $select[$key]['fullname'] = '';
            foreach ($employee as $key1 => $value1) {
                if ($employee[$key1]['employee_id'] == $select[$key]['employee_id']) {
                    $select[$key]['fullname'] = $employee[$key1]['fullname'];
                    // break;
                }
            }
            $select[$key]['name_of_clinic'] = '';
            foreach ($clinic as $key1 => $value1) {
                if ($clinic[$key1]['clinic_id'] == $select[$key]['clinic_id_from']) {
                    $select[$key]['name_of_clinic'] = $clinic[$key1]['name_of_clinic'];
                    // break;
                }
            }
            if ($select[$key]['visit_id'] == $visitId) {
                $obat[] = $select[$key];
            } else {
                $historyObat[] = $select[$key];
                $visitHistory[$select[$key]['visit_id']] = ' | ' . substr($select[$key]['treat_date'], 0, 10) . " | " . $select[$key]['fullname'] . '  | ' . $select[$key]['name_of_clinic'] . ' | ';
            }
            // if ($select[$key]['isrj'] == 1) {
            // }
        }

        $dt = '';

        foreach ($visitHistory as $key => $value) {
            $dt = $dt . '<div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#historyPresc' . $key . '" aria-expanded="true" aria-controls="historyPresc' . $key . '">
                                    ' . $value . '
                                </button>
                            </h2>
                            <div id="historyPresc' . $key . '" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted">
                                    <form id="formbody' . $key . '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                                        <table id="eresepTable' . $key . '" class="table table-hover table-prescription" style="display: block;">
                                                <thead class="table-primary" style="text-align: center;">
                                                    <tr>
                                                        <th class="text-center" style="width: 5%;">
                                                            <div class="form-check mb-3">
                                                                <input id="historyNonRacikCheckAll' . $key . '" type="checkbox" class="form-check-input" onchange="checkAllHistoryInsideId({formid : \'eresepTable' . $key . '\', id: this.id})">
                                                                <label for="historyCheckAll' . $key . '" class="form-check-label" for="educationintegration">Semua</label>
                                                            </div>
                                                        </th class="text-center">
                                                        <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
                                                        <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
                                                        <th class="text-center" colspan="3" style="width: 30%;">Signa</th class="text-center">
                                                        <!-- <th class="text-center" style="width: 12,5%;"></th class="text-center"> -->
                                                        <!-- <th class="text-center" style="width: 12,5%;"></th class="text-center"> -->
                                                    </tr>
                                                </thead>
                                                <tbody id="nrbody' . $key . '">
                                                </tbody>
                                            </table>
                                            <div id="rbody' . $key . '" class="table-responsive">
                                            </div>
                                        <div class="panel-footer text-end mb-4">
                                            <button type="button" id="btnCopyResep' . $key . '" name="copyresep" data-loading-text="prcessing" class="btn btn-secondary spppoli-to-hide" onclick="copyResep(\'historyPresc' . $key . '\')"><i class="fa fa-check-circle"></i> <span>Copy</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
            // foreach ($visitHistory as $key => $value) {
            //     $dt = $dt . '<div class="accordion-item">
            //                     <h2 class="accordion-header" id="headingOne">
            //                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#historyPresc' . $key . '" aria-expanded="true" aria-controls="historyPresc' . $key . '">
            //                             ' . $value . '
            //                         </button>
            //                     </h2>
            //                     <div id="historyPresc' . $key . '" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            //                         <div class="accordion-body text-muted">
            //                             <form id="formbody' . $key . '" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
            //                                 <table id="eresepTable" class="table table-hover table-prescription" style="display: block;">
            //                                     <thead class="table-primary" style="text-align: center;">
            //                                         <tr>
            //                                             <th class="text-center" style="width: 4%;">No.</th class="text-center">
            //                                             <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
            //                                             <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
            //                                             <th class="text-center" colspan="5" style="width: 30%;">Aturan Minum</th class="text-center">
            //                                             <th class="text-center" style="width: 12,5%;"></th class="text-center">
            //                                             <th class="text-center" style="width: 12,5%;"></th class="text-center">
            //                                         </tr>
            //                                     </thead>
            //                                     <tbody id="ereseploadingspace">

            //                                     </tbody>
            //                                 </table>
            //                                 <div id="body' . $key . '">
            //                                 </div>
            //                                 <div class="panel-footer text-end mb-4">
            //                                     <button type="button" id="btnCopyResep' . $key . '" name="copyresep" data-loading-text="prcessing" class="btn btn-secondary" onclick="copyResep(\'body' . $key . '\')"><i class="fa fa-check-circle"></i> <span>Copy</span></button>
            //                                 </div>
            //                             </form>
            //                         </div>
            //                     </div>
            //                 </div>';

            //     $dt = $dt . "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#accordion' href='#" . $key . "'>" . $value . "</a></h4></div><div id='" . $key . "' class='panel-collapse collapse'><div class='panel-body'>";
            //     $dt = $dt . '<table id="eresepTable" class="table table-bordered table-hover">
            //     <thead class="table-primary" style="text-align: center;">
            //         <tr>
            //             <th class="text-center" style="width: 4%;">No.</th class="text-center">
            //             <th class="text-center" style="width: 30%;">Nama Obat</th class="text-center">
            //             <th class="text-center" colspan="2" style="width: 10%;">Jumlah</th class="text-center">
            //             <th class="text-center" colspan="5" style="width: 50%;">Aturan Minum</th class="text-center">
            //         </tr>
            //     </thead>
            //     <tbody id="body' . $key . '">

            //     </tbody>

            // </table>';
            //     $dt = $dt . '</div></div></div>';
        }



        $measureModel = new MeasurementModel();
        $measure = $this->lowerKey($measureModel->findAll());

        $regulateModel = new RegulationTypeModel();
        $regulation = $this->lowerKey($regulateModel->findAll());

        $signaModel = new SignaModel();
        $signa = $this->lowerKey($signaModel->findAll());
        // $signa = $this->lowerKey($signaModel->where('signa_type = 2')->where("isactive = '1'")->findAll());

        $data = [];
        $data['obat'] = $obat;
        $data['historyObat'] = $historyObat;
        $data['visitHistory'] = $dt;
        $data['measurement'] = $measure;
        $data['regulation'] = $regulation;
        $data['signa'] = $signa;

        $resepNo = [];

        if (!empty($obat)) {
            foreach ($obat as $key => $value) {
                if (!in_array($value['resep_no'], $resepNo))
                    $resepNo[] = $value['resep_no'];
            }
            $data['resepNo'] = $resepNo;
        }

        // return json_encode($data);
        return $this->response->setJSON($data);
    }
    public function copyResep()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $billId = $body['billId'];
        $noresep = $body['noresep'];
        $visit_id = $body['visit_id'];
        $trans_id = $body['trans_id'];
        $clinic_id = $body['clinicId'];
        $class_room_id = @$body['classRoomId'];
        $session_id = $body['sessionId'];

        $strinbill = str_replace(['[', ']'], ['', ''], str_replace('"', "'", json_encode($billId)));

        if (($class_room_id == '' || is_null($class_room_id)) && ($clinic_id != 'P012')) {
            $model = new TreatmentObatModel();
            $checkResep = $model->where("nota_no", $session_id)->select('resep_no')->first();

            if (isset($checkResep['resep_no'])) {
                $response['status'] = 'error';
                $response['message'] = 'Copy Resep tidak bisa dilakukan karena anda sudah membuat resep pada sesi ini. Silahkan edit resep untuk menambahkan obat.';
                $response['data'] = $checkResep['resep_no'];
                return $this->response->setJSON($response);
            }
        }

        // return json_encode($strinbill);

        $db = db_connect();
        $sql = "
                INSERT INTO treatment_obat
                SELECT
                    ORG_UNIT_CODE,
                    LEFT(REPLACE(REPLACE(REPLACE(CONVERT(varchar, GETDATE(), 121), '-', ''), ':', ''), ' ', ''), 14) + RIGHT(NEWID(), 4) AS bill_id,
                    NO_REGISTRATION,
                    ? AS visit_id,
                    TARIF_ID,
                    CLASS_ID,
                    ? AS CLINIC_ID,
                    ? AS CLINIC_ID_FROM,
                    TREATMENT,
                    GETDATE(),
                    0,
                    MEASURE_ID,
                    DESCRIPTION,
                    ? AS NORESEP,
                    DOSE_PRESC,
                    SOLD_STATUS,
                    RACIKAN,
                    CLASS_ROOM_ID,
                    KELUAR_ID,
                    BED_ID,
                    ? AS EMPLOYEE_ID,
                    DESCRIPTION2,
                    BRAND_ID,
                    ? AS DOCTOR,
                    EXIT_DATE,
                    ? AS EMPLOYEE_ID_FROM,
                    ? AS DOCTOR_FROM,
                    status_pasien_id,
                    THENAME,
                    THEADDRESS,
                    THEID,
                    NULL,
                    ISRJ,
                    AGEYEAR,
                    AGEMONTH,
                    AGEDAY,
                    GENDER,
                    KARYAWAN,
                    ? AS MODIFIED_BY,
                    GETDATE(),
                    MODIFIED_FROM,
                    NUMER,
                    ? AS SESSION_ID,
                    MEASURE_ID2,
                    POTONGAN,
                    BAYAR,
                    RETUR,
                    TARIF_TYPE,
                    PPNVALUE,
                    0,
                    KOREKSI,
                    0,
                    DISKON,
                    SELL_PRICE,
                    ACCOUNT_ID,
                    subsidi,
                    PROFESI,
                    EMBALACE,
                    DISCOUNT,
                    0,
                    PPN,
                    ITER,
                    PAYOR_ID,
                    STATUS_OBAT,
                    SUBSIDISAT,
                    MARGIN,
                    POKOK_JUAL,
                    PRINTQ,
                    PRINTED_BY,
                    STOCK_AVAILABLE,
                    STATUS_TARIF,
                    PACKAGE_ID,
                    MODULE_ID,
                    profession,
                    THEORDER,
                    CORRECTION_ID,
                    CORRECTION_BY,
                    CASHIER,
                    islunas,
                    PAY_METHOD_ID,
                    PAYMENT_DATE,
                    ISCETAK,
                    print_date,
                    DOSE,
                    JML_BKS,
                    ORIG_DOSE,
                    RESEP_KE,
                    ITER_KE,
                    KUITANSI_ID,
                    PEMBULATAN,
                    KAL_ID,
                    INVOICE_ID,
                    SERVICE_TIME,
                    TAKEN_TIME,
                    modified_datesys,
                    ? AS TRANS_ID,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    NOSEP,
                    FUND_ID,
                    ATURANMINUM2,
                    REKONSTATUS_ID,
                    EDUCATION_ID,
                    TAKEPILL_DATE,
                    STOKDARI,
                    C,
                    CIF,
                    ED,
                    DOSE1,
                    DOSE2,
                    SIGNA_1,
                    SIGNA_2,
                    SIGNA_3,
                    SIGNA_4,
                    SIGNA_5,
                    measure_dosis,
                    body_id
                FROM treatment_obat
                WHERE bill_id IN ($strinbill)
                ";

        // Binding array
        $bindings = [
            $visit_id,                   // ?
            $clinic_id,                  // ?
            $clinic_id,                  // ?
            $noresep,                    // ?
            user()->employee_id,         // ?
            user()->getFullname(),       // ?
            user()->employee_id,         // ?
            user()->getFullname(),       // ?
            user()->username,            // ?
            $session_id,                 // ?
            $trans_id                    // ?
        ];

        // Jalankan query dengan binding
        $db->query($sql, $bindings);

        $response['status'] = 'success';
        $response['message'] = 'Copy Resep berhasil';
        $response['data'] = $noresep;

        return json_encode($noresep);
    }
    public function getAssessmentIgd()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $visitId = $body['visit_id'];

        $db = new AssessmentModel();
        $select = $this->lowerKey($db->where('visit_id', $visitId)->orderBy('examination_date')->findAll());



        return json_encode($select);
    }
    public function generateResep()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $norm = $body['norm'];
        $tgl = $body['tgl'];
        $clinicId = $body['clinicId'];
        $isrj = $body['isrj'];

        // return $isrj;


        $model = new GenerateIdModel();
        $result = ($model->generateResep($norm, $tgl, $clinicId, $isrj));

        echo json_encode($result);
    }
    public function getAlergi()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);

        // return json_encode($body);

        $nomor = $body['nomor'];

        $p = new PasienModel();
        $select = $this->lowerKey($p->select("medecine_notes")->find((string)$nomor));


        return json_encode($select['medecine_notes']);
    }
    public function getTarif()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $search_term = $this->request->getPost("searchTerm");
        $clinic_id = $this->request->getPost("klinik");
        // $clinic_id = '%';
        $class_id = $this->request->getPost("kelas");
        // $class_id = '%';
        if (isset($search_term) && $search_term != '') {
            // $search_term = $search_term;
            $ttModel = new TreatTarifModel();
            $result = $this->lowerKey($ttModel->getTarif($clinic_id, $class_id, $search_term));
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $value['amount'] = !empty($value['amount']) ? $value['amount'] : 0;
                    $data[] = array("id" => json_encode($value), "text" => $value['tarif_name'] . " (Rp. " . number_format($value['amount'], 2, ",", ".") . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getTarifPerawat()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $search_term = $this->request->getPost("searchTerm");
        $clinic_id = $this->request->getPost("klinik");
        // $clinic_id = '%';
        $class_id = $this->request->getPost("kelas");
        // $class_id = '%';
        if (isset($search_term) && $search_term != '') {
            // $search_term = $search_term;
            $ttModel = new TreatTarifModel();
            $result = $this->lowerKey($ttModel->getTarifPerawat($clinic_id, $class_id, $search_term));
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => json_encode($value), "text" => $value['tarif_name'] . " (Rp. " . number_format($value['amount'], 2, ",", ".") . ")");
                }
            }
            echo json_encode($data);
        }
    }
    public function getDokterRad()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $search_term = $this->request->getPost("searchTerm");

        if (isset($search_term) && $search_term != '') {
            $result =
                $db->query(
                    "
                    SELECT EMPLOYEE_ID,FULLNAME 
                    from EMPLOYEE_ALL  
                    WHERE employee_id in (select employee_id from doctor_schedule where clinic_id = 'P016')
                    AND FULLNAME LIKE '" . $search_term . "%'
                    Order by fullname;
                    "
                )->getResultArray();

            $result = $this->lowerKey($result);
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array("id" => $value['employee_id'], "text" => $value['fullname']);
                }
            }

            echo json_encode($data);
        }
    }
    public function getTemplateExpertise()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $search_term = $this->request->getPost("searchTerm");
        $employee_id = user()->employee_id;
        if (isset($search_term) && $search_term != '') {
            $result =
                $db->query(
                    "
                   SELECT top(10) RADIOLOGI_BACAAN_ID,
                    RADIOLOGI_BACAAN_TYPE, 
                    RADIOLOGI_BACAANTYPE, 
                    EMPLOYEE_ID, 
                    TREATMENT, 
                    HASIL_BACA, KESAN
                    FROM RADIOLOGI_TEMPLATE
                    WHERE EMPLOYEE_ID = '$employee_id'
                    AND TREATMENT LIKE '" . $search_term . "%'
                    "
                )->getResultArray();

            $result = $this->lowerKey($result);
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array(
                        "id" => $value['radiologi_bacaan_id'],
                        "text" => $value['treatment'],
                        "hasil_baca" => $value['hasil_baca'],
                        "kesimpulan" => $value['kesan'],
                    );
                }
            }

            echo json_encode($data);
        }
    }
    public function getDietaryHabit()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $result =
                $db->query(
                    "
                    select top(10) * from ASSESSMENT_NUTRITION_HABIT
                    WHERE dietary_habit LIKE '" . $search_term . "%'
                    "
                )->getResultArray();

            $result = $this->lowerKey($result);
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array(
                        "id" => $value['habit_id'],
                        "text" => $value['dietary_habit'],
                    );
                }
            }

            echo json_encode($data);
        }
    }

    public function getAgeRange()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $db = db_connect();

        $search_term = $this->request->getPost("searchTerm");
        if (isset($search_term) && $search_term != '') {
            $result =
                $db->query(
                    "
                    select age_range, display from AGE_RANGE 
                     WHERE display LIKE '%" . $search_term . "%'
                    "
                )->getResultArray();

            $result = $this->lowerKey($result);
            $data   = array();
            if (!empty($result)) {
                foreach ($result as $value) {
                    $data[] = array(
                        "id" => $value['age_range'],
                        "text" => $value['display'],
                    );
                }
            }

            echo json_encode($data);
        }
    }
    public function getDiskon()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $status = $body['status'];
        $tarif = $body['tarif'];

        $subsidiModel = new SubsidiModel();
        $select = $subsidiModel->where('status_pasien_id', $status)
            ->where('tarif_id', $tarif)
            ->groupBy('status_pasien_id, tarif_id')
            ->select('sum(percentage) as percentage, sum(subsidi) as subsidi')->findAll();
        $percentage = $select[0]['percentage'];
        $subsidi = $body['subsidi'];

        (is_null($subsidi)) ? $subsidi = 0 : $subsidi = $subsidi;
        (is_null($percentage)) ? $percentage = 0 : $percentage = $percentage;

        if ($subsidi == 0) {
            return json_encode($percentage);
        } else {
            return json_encode($subsidi);
        }
    }
    public function getPotongan()
    {
        // if (!$this->request->is('post')) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }
        // $body = $this->request->getBody();
        // $body = json_decode($body, true);

        // $status = $body['status'];
        // $tarif = $body['tarif'];


        // $ttModel = new TreatTarifModel();
        // $select = $ttModel->like('upper(tarif_name)', 'POTONGAN%')
        //     ->select('tarif_type, tarif_id, tarif_name')->findAll();

        // $potongan = $select[0];
        // return json_encode($potongan);
    }
    public function getPlafond()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $classPlafond = $body['classPlafond'];
        $tarifName = $body['tarifName'];
        $isCito = $body['isCito'];

        $ttModel = new TreatTarifModel();
        $select = $ttModel->select('top(1) sum(amount) as amount')
            ->join('tarif_comp', 'treat_tarif.tarif_id = tarif_comp.tarif_id', 'inner')
            ->where('treat_tarif.class_id', $classPlafond)
            ->where('iscito', $isCito)
            ->where("upper(ltrim(rtrim(treat_tarif.tarif_name))) like upper(ltrim(rtrim(left('$tarifName', 
        case charindex('(', '$tarifName',1)
           when 0  then len('$tarifName')
           else charindex('.', '$tarifName',1)-1
         end )))) +'%'")
            ->findAll();
        if (!empty($select)) {
            return json_encode($select[0]['amount']);
        } else {
            return json_encode(0);
        }
    }

    public function addBill()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }




        $bill_id = $this->request->getPost('bill_id');
        $trans_id = $this->request->getPost('trans_id');
        $no_registration = $this->request->getPost('no_registration');
        $theorder = $this->request->getPost('theorder');
        $visit_id = $this->request->getPost('visit_id');
        $org_unit_code = $this->request->getPost('org_unit_code');
        $class_id_plafond = $this->request->getPost('class_id_plafond');
        $payor_id = $this->request->getPost('payor_id');
        $karyawan = $this->request->getPost('karyawan');
        $theid = $this->request->getPost('theid');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $isRJ = $this->request->getPost('isRJ');
        $gender = $this->request->getPost('gender');
        $ageyear = $this->request->getPost('ageyear');
        $agemonth = $this->request->getPost('agemonth');
        $ageday = $this->request->getPost('ageday');
        $kal_id = $this->request->getPost('kal_id');
        $karyawan = $this->request->getPost('karyawan');
        $class_room_id = $this->request->getPost('class_room_id');
        $bed_id = $this->request->getPost('bed_id');
        $employee_id_from = $this->request->getPost('employee_id_from');
        $doctor_from = $this->request->getPost('doctor_from');
        $clinic_id = $this->request->getPost('clinic_id');
        $clinic_id_from = $this->request->getPost('clinic_id_from');
        $status_pasien_id = $this->request->getPost('status_pasien_id');
        $treat_date = $this->request->getPost('treat_date');
        $exit_date = $this->request->getPost('exit_date');
        $cashier = $this->request->getPost('cashier');
        $modified_from = $this->request->getPost('modified_from');
        $islunas = $this->request->getPost('islunas');
        $measure_id = $this->request->getPost('measure_id');
        $tarif_id = $this->request->getPost('tarif_id');
        $treatment = $this->request->getPost('treatment');
        $employee_id = $this->request->getPost('employee_id');
        $sell_price = $this->request->getPost('sell_price');
        $quantity = $this->request->getPost('quantity');
        $amount_paid = $this->request->getPost('amount_paid');
        $discount = $this->request->getPost('discount');
        $subsidisat = $this->request->getPost('subsidisat');
        $amount = $this->request->getPost('amount');
        $tagihan = $this->request->getPost('tagihan');
        $subsidi = $this->request->getPost('subsidi');
        $profesi = $this->request->getPost('profesi');
        $tarif_type = $this->request->getPost('tarif_type');
        $class_id = $this->request->getPost('class_id');
        $amount_plafond = $this->request->getPost('amount_plafond');
        $amount_paid_plafond = $this->request->getPost('amount_paid_plafond');
        $class_id_plafond = $this->request->getPost('class_id_plafond');
        $treatment_plafond = $this->request->getPost('treatment_plafond');
        $nota_no = $this->request->getPost('nota_no');

        // echo $treat_date;


        $eaModel = new EmployeeAllModel();
        $doctor = $eaModel->select('fullname')->find($employee_id);



        if (is_null($sell_price) || empty($sell_price) || $sell_price == '') {
            $sell_price = 0;
        }
        if (is_null($quantity) || empty($quantity) || $quantity == '') {
            $quantity = 0;
        }
        if (is_null($amount_paid) || empty($amount_paid) || $amount_paid == '') {
            $amount_paid = 0;
        }
        if (is_null($discount) || empty($discount) || $discount == '') {
            $discount = 0;
        }
        if (is_null($subsidisat) || empty($subsidisat) || $subsidisat == '') {
            $subsidisat = 0;
        }
        if (is_null($amount) || empty($amount) || $amount == '') {
            $amount = 0;
        }
        if (is_null($tagihan) || empty($tagihan) || $tagihan == '') {
            $tagihan = 0;
        }
        if (is_null($subsidi) || empty($subsidi) || $subsidi == '') {
            $subsidi = 0;
        }
        if (is_null($profesi) || empty($profesi) || $profesi == '') {
            $profesi = 0;
        }


        if (is_null($amount_plafond) || empty($amount_plafond) || $amount_plafond == '') {
            $amount_plafond = 0;
        }
        if (is_null($amount_paid_plafond) || empty($amount_paid_plafond) || $amount_paid_plafond == '') {
            $amount_paid_plafond = 0;
        }





        $tbModel = new TreatmentBillModel();


        $orgModel = new OrganizationunitModel();

        $isnew = true;
        if ($bill_id == null || $bill_id == '') {
            $id = $orgModel->generateId();
            $isnew = false;
        } else {
            $id = $bill_id;
            $isnew = true;
        }

        if (is_null($nota_no)) {
            $nota_no = $orgModel->generateId();
        }


        // return json_encode($kalurahan);


        $data = [
            'bill_id' => $id,
            'trans_id' => $trans_id,
            'nota_no' => $nota_no,
            'no_registration' => $no_registration,
            'theorder' => $theorder,
            'visit_id' => $visit_id,
            'org_unit_code' => $org_unit_code,
            'class_id_plafond' => $class_id_plafond,
            'payor_id' => $payor_id,
            'karyawan' => $karyawan,
            'theid' => $theid,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'status_pasien_id' => $status_pasien_id,
            'isRJ' => $isRJ,
            'gender' => $gender,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
            'kal_id' => $kal_id,
            'karyawan' => $karyawan,
            'class_room_id' => $class_room_id,
            'bed_id' => $bed_id,
            'employee_id_from' => $employee_id_from,
            'doctor_from' => $doctor_from,
            'clinic_id' => $clinic_id,
            'clinic_id_from' => $clinic_id_from,
            'status_pasien_id' => $status_pasien_id,
            'treat_date' => $treat_date,
            'exit_date' => $exit_date,
            'cashier' => $cashier,
            'modified_from' => $modified_from,
            'islunas' => $islunas,
            'measure_id' => $measure_id,
            'tarif_id' => $tarif_id,
            'treatment' => $treatment,
            'employee_id' => $employee_id,
            'sell_price' => $sell_price,
            'quantity' => $quantity,
            'amount_paid' => $amount_paid,
            'discount' => $discount,
            'subsidisat' => $subsidisat,
            'amount' => $amount,
            'tagihan' => $tagihan,
            'subsidi' => $subsidi,
            'profesi' => $profesi,
            'tarif_type' => $tarif_type,
            'class_id' => $class_id,
            'amount_plafond' => $amount_plafond,
            'amount_paid_plafond' => $amount_paid_plafond,
            'class_id_plafond' => $class_id_plafond,
            'treatment_plafond' => $treatment_plafond,
            'doctor' => $doctor
        ];

        // return json_encode($data);
        $tbModel->save($data);
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => 'tambah tindakan berhasil', 'billId' => $id, 'data' => $data);
        echo json_encode($array);
    }
    public function addBillCharge()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $bill_id = @$body['bill_id']; //$this->request->getPost('bill_id');
        $trans_id = @$body['trans_id']; //$this->request->getPost('trans_id');
        $no_registration = @$body['no_registration']; //$this->request->getPost('no_registration');
        $theorder = @$body['theorder']; //$this->request->getPost('theorder');
        $visit_id = @$body['visit_id']; //$this->request->getPost('visit_id');
        $org_unit_code = @$body['org_unit_code']; //$this->request->getPost('org_unit_code');
        $payor_id = @$body['payor_id']; //$this->request->getPost('payor_id');
        $karyawan = @$body['karyawan']; //$this->request->getPost('karyawan');
        $theid = @$body['theid']; //$this->request->getPost('theid');
        $thename = @$body['thename']; //$this->request->getPost('thename');
        $theaddress = @$body['theaddress']; //$this->request->getPost('theaddress');
        $isrj = @$body['isrj']; //$this->request->getPost('isRJ');
        $gender = @$body['gender']; //$this->request->getPost('gender');
        $ageyear = @$body['ageyear']; //$this->request->getPost('ageyear');
        $agemonth = @$body['agemonth']; //$this->request->getPost('agemonth');
        $ageday = @$body['ageday']; //$this->request->getPost('ageday');
        $kal_id = @$body['kal_id']; //$this->request->getPost('kal_id');
        $karyawan = @$body['karyawan']; //$this->request->getPost('karyawan');
        $class_room_id = @$body['class_room_id']; //$this->request->getPost('class_room_id');
        $bed_id = @$body['bed_id']; //$this->request->getPost('bed_id');
        $employee_id_from = @$body['employee_id_from']; //$this->request->getPost('employee_id_from');
        $doctor_from = @$body['doctor_from']; //$this->request->getPost('doctor_from');
        $clinic_id = @$body['clinic_id']; //$this->request->getPost('clinic_id');
        $clinic_id_from = @$body['clinic_id_from']; //$this->request->getPost('clinic_id_from');
        $status_pasien_id = @$body['status_pasien_id']; //$this->request->getPost('status_pasien_id');
        $treat_date = @$body['treat_date']; //$this->request->getPost('treat_date');
        $exit_date = @$body['exit_date']; //$this->request->getPost('exit_date');
        $cashier = @$body['cashier']; //$this->request->getPost('cashier');
        $modified_from = @$body['modified_from']; //$this->request->getPost('modified_from');
        $islunas = @$body['islunas']; //$this->request->getPost('islunas');
        $measure_id = @$body['measure_id']; //$this->request->getPost('measure_id');
        $tarif_id = @$body['tarif_id']; //$this->request->getPost('tarif_id');
        $treatment = @$body['treatment']; //$this->request->getPost('treatment');
        $employee_id = @$body['employee_id']; //$this->request->getPost('employee_id');
        $sell_price = @$body['sell_price'] ?? 0; //$this->request->getPost('sell_price');
        $quantity = @$body['quantity'] ?? 0; //$this->request->getPost('quantity');
        $amount_paid = @$body['amount_paid'] ?? 0; //$this->request->getPost('amount_paid');
        $discount = @$body['discount']; //$this->request->getPost('discount');
        $subsidisat = @$body['subsidisat'] ?? 0; //$this->request->getPost('subsidisat');
        $amount = @$body['amount'] ?? 0; //$this->request->getPost('amount');
        $tagihan = @$body['tagihan'] ?? 0; //$this->request->getPost('tagihan');
        $subsidi = @$body['subsidi'] ?? 0; //$this->request->getPost('subsidi');
        $profesi = @$body['profesi'] ?? 0; //$this->request->getPost('profesi');
        $tarif_type = @$body['tarif_type']; //$this->request->getPost('tarif_type');
        $class_id = @$body['class_id']; //$this->request->getPost('class_id');
        $amount_plafond = @$body['amount_plafond']; //$this->request->getPost('amount_plafond');
        $amount_paid_plafond = @$body['amount_paid_plafond']; //$this->request->getPost('amount_paid_plafond');
        $class_id_plafond = @$body['class_id_plafond']; //$this->request->getPost('class_id_plafond');
        $treatment_plafond = @$body['treatment_plafond']; //$this->request->getPost('treatment_plafond');
        $nota_no = @$body['nota_no']; //$this->request->getPost('nota_no');
        $body_id = @$body['body_id']; //$this->request->getPost('nota_no');
        $diagnosa_desc = @$body['diagnosa_desc']; //$this->request->getPost('diagnosa_desc');     Far baru 14/12 9:54
        $indication_desc = @$body['indication_desc']; //$this->request->getPost('indication_desc');     Far baru 14/12 9:54



        // echo $treat_date;



        $eaModel = new EmployeeAllModel();
        $doctor = $eaModel->select('fullname')->find($employee_id);
        if (isset($doctor))
            $doctor = @$doctor['fullname'];
        else
            $doctor = '';




        if (is_null($sell_price) || empty($sell_price) || $sell_price == '') {
            $sell_price = 0;
        }
        if (is_null($quantity) || empty($quantity) || $quantity == '') {
            $quantity = 0;
        }
        if (is_null($amount_paid) || empty($amount_paid) || $amount_paid == '') {
            $amount_paid = 0;
        }
        if (is_null($discount) || empty($discount) || $discount == '') {
            $discount = 0;
        }
        if (is_null($subsidisat) || empty($subsidisat) || $subsidisat == '') {
            $subsidisat = 0;
        }
        if (is_null($amount) || empty($amount) || $amount == '') {
            $amount = 0;
        }
        if (is_null($tagihan) || empty($tagihan) || $tagihan == '') {
            $tagihan = 0;
        }
        if (is_null($subsidi) || empty($subsidi) || $subsidi == '') {
            $subsidi = 0;
        }
        if (is_null($profesi) || empty($profesi) || $profesi == '') {
            $profesi = 0;
        }
        if (is_null($sell_price) || empty($sell_price) || $sell_price == '') {
            $profesi = 0;
        }


        if (is_null($amount_plafond) || empty($amount_plafond) || $amount_plafond == '') {
            $amount_plafond = 0;
        }
        if (is_null($amount_paid_plafond) || empty($amount_paid_plafond) || $amount_paid_plafond == '') {
            $amount_paid_plafond = 0;
        }





        $tbModel = new TreatmentBillModel();


        $orgModel = new OrganizationunitModel();

        $isnew = true;
        if ($bill_id == null || $bill_id == '') {
            $id = $orgModel->generateId();
            $isnew = false;
        } else {
            $id = $bill_id;
            $isnew = true;
        }

        // return json_encode($bill_id);

        if (is_null($nota_no)) {
            $nota_no = $orgModel->generateId();
        }


        if (in_array($clinic_id, [
            'P016',
            'P013',
            'P015'
        ])) {
            $penunjangModel = new PasienPenunjangModel();
            $getresep = $penunjangModel->select("nota_no")
                // ->where("valid_user is not null")
                ->find($nota_no);

            if (!isset($getresep['nota_no'])) {
                $data = [
                    'org_unit_code' => $org_unit_code,
                    'visit_id' => $visit_id,
                    'trans_id' => $trans_id,
                    'nota_no' => $nota_no,
                    'no_registration' => $no_registration,
                    'bill_id' => $id,
                    'clinic_id' => $clinic_id,
                    'validation' => 0,
                    'terlayani' => 0,
                    'iscito' => 0,
                    'employee_id' => $employee_id,
                    'treat_date' => str_replace("T", " ", $treat_date),
                    'thename' => $thename,
                    'theaddress' => $theaddress,
                    'theid' => $theid,
                    'isrj' => $isrj,
                    'ageyear' => $ageyear,
                    'agemonth' => $agemonth,
                    'ageday' => $ageday,
                    'status_pasien_id' => $status_pasien_id,
                    'gender' => $gender,
                    'doctor' => $doctor,
                    'class_room_id' => $class_room_id,
                    'perujuk' => $employee_id,
                    'modified_by' => user()->username,
                    'modified_from' => $modified_from,
                    'modified_date' => new RawSql("getdate()")
                ];
                // return json_encode($data);

                $penunjangModel->save($data);
            }
        }


        $data = [
            'bill_id' => $id,
            'trans_id' => $trans_id,
            'nota_no' => $nota_no,
            'no_registration' => $no_registration,
            'theorder' => $theorder,
            'visit_id' => $visit_id,
            'org_unit_code' => $org_unit_code,
            'class_id_plafond' => $class_id_plafond,
            'payor_id' => $payor_id,
            'karyawan' => $karyawan,
            'theid' => $theid,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'status_pasien_id' => $status_pasien_id,
            'isRJ' => $isrj,
            'gender' => $gender,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
            'kal_id' => $kal_id,
            'karyawan' => $karyawan,
            'class_room_id' => $class_room_id,
            // 'bed_id' => $bed_id,
            'employee_id_from' => $employee_id_from,
            'doctor_from' => $doctor_from,
            'clinic_id' => $clinic_id,
            'clinic_id_from' => $clinic_id_from,
            'status_pasien_id' => $status_pasien_id,
            'treat_date' => str_replace("T", " ", $treat_date),
            'exit_date' => $exit_date,
            'cashier' => $cashier,
            'modified_from' => $modified_from,
            'islunas' => $islunas,
            'measure_id' => $measure_id,
            'tarif_id' => $tarif_id,
            'treatment' => $treatment,
            'employee_id' => $employee_id,
            'sell_price' => $sell_price,
            'quantity' => $quantity,
            'amount_paid' => $amount_paid,
            'discount' => $discount,
            'subsidisat' => $subsidisat,
            'amount' => $amount,
            'tagihan' => $tagihan,
            'subsidi' => $subsidi,
            'profesi' => $profesi,
            'tarif_type' => $tarif_type,
            'class_id' => $class_id,
            'amount_plafond' => $amount_plafond,
            'amount_paid_plafond' => $amount_paid_plafond,
            'class_id_plafond' => $class_id_plafond,
            'treatment_plafond' => $treatment_plafond,
            'doctor' => $doctor,
            'body_id' => $body_id,
            'diagnosa_desc' => $diagnosa_desc,
            'indication_desc' => $indication_desc,
            'modified_date' => new RawSql("getdate()"),
            'modified_by' => user()->username
        ];

        $tbModel->save($data);

        $array   = array('status' => 'success', 'error' => '', 'message' => 'tambah tindakan berhasil', 'billId' => $id, 'data' => $data);
        echo json_encode($array);
    }


    public function delBill($bill_id = '')
    {
        if ($bill_id != '') {
            $tb = new TreatmentBillModel();
            $result = $tb->delete($bill_id);

            if ($result) {
                $array   = array('status' => 'success', 'error' => '', 'message' => 'delete berhasil');
                echo json_encode($array);
            } else {
                $array   = array('status' => 'failure', 'error' => '', 'message' => 'delete gagal');
                echo json_encode($array);
            }
        } else {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'delete berhasil');
            echo json_encode($array);
        }
    }
    public function delBillPerawat($bill_id)
    {
        $tb = new TreatmentPerawatModel();
        $result = $tb->delete($bill_id);
        $tb = new TreatmentBillModel();
        $result = $tb->delete($bill_id);

        if ($result) {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'delete berhasil');
            echo json_encode($array);
        } else {
            $array   = array('status' => 'failure', 'error' => '', 'message' => 'delete gagal');
            echo json_encode($array);
        }
    }
    public function rajal()
    {
        $session = session();
        $sessionData = ['gsPoli' => ''];
        $session->set($sessionData);
        $giTipe = 1;

        $title = 'Pelayanan';
        return $this->rajalTemplate($giTipe, $title);
    }

    public function ranap()
    {
        $session = session();
        $sessionData = ['gsPoli' => ''];
        $session->set($sessionData);
        $giTipe = 3;

        $title = 'Rawat Inap';

        return $this->searchingTemplate($giTipe, $title);
    }
    public function bidan()
    {
        $session = session();
        $sessionData = ['gsPoli' => 'P004'];
        $session->set($sessionData);
        $giTipe = 22;

        $title = 'Kebidanan';

        return $this->searchingTemplate($giTipe, $title);
    }

    public function laboratorium()
    {
        $session = session();
        $sessionData = ['gsPoli' => 'P013'];
        $session->set($sessionData);
        $giTipe = 2;

        $title = 'Laboratorium';

        return $this->searchingTemplate($giTipe, $title);
    }
    public function radiologi()
    {
        $session = session();
        $sessionData = ['gsPoli' => 'P016'];
        $session->set($sessionData);
        $giTipe = 2;

        $title = 'Radiologi';

        return $this->searchingTemplate($giTipe, $title);
    }
    public function hemodialisa()
    {

        $session = session();
        $sessionData = ['gsPoli' => 'P023'];
        $session->set($sessionData);
        $giTipe = 2;

        $title = 'Haemodialisa';

        return $this->searchingTemplate($giTipe, $title);
    }
    public function farmasi()
    {
        $title = 'Farmasi';
        $giTipe = 73;

        $session = session();
        $sessionData = ['gsPoli' => ''];
        $session->set($sessionData);

        return $this->searchingTemplate($giTipe, $title);
    }
    public function bill()
    {
        $title = 'Billing';
        $giTipe = 50;

        $session = session();
        $sessionData = ['gsPoli' => ''];
        $session->set($sessionData);

        return $this->searchingTemplate($giTipe, $title);
    }
    public function unitgawatdarurat()
    {
        $title = 'Unit Gawat Darurat';
        $giTipe = 5;

        $session = session();
        $sessionData = ['gsPoli' => 'P012'];
        $session->set($sessionData);

        return $this->searchingTemplate($giTipe, $title);
    }
    public function kamaroperasi()
    {
        $title = 'Kamar Operasi';
        $giTipe = 6;

        $session = session();
        $sessionData = ['gsPoli' => 'P002'];
        $session->set($sessionData);

        return $this->searchingTemplate($giTipe, $title);
    }
    public function vk()
    {
        $title = 'VK';
        $giTipe = 6;

        $session = session();
        $sessionData = ['gsPoli' => 'P002'];
        $session->set($sessionData);

        return $this->searchingTemplate($giTipe, $title);
    }
    public function casemix()
    {
        $title = 'CASEMIX';
        $giTipe = 7;

        $session = session();
        $sessionData = ['gsPoli' => ''];
        $session->set($sessionData);

        return $this->searchingTemplate($giTipe, $title);
    }

    public function closeBillPoli()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $trans_id = @$body['trans_id'];
        $visit_id = @$body['visit_id'];
        $no_registration = @$body['no_registration'];
        $isrj = @$body['isrj'];

        $db = db_connect();
        // if ($isrj == '1') {
        //     $db->query("update pasien_visitation
        //     set locked = 2, lengkap_rj = 1
        //     where trans_id = '$trans_id'");
        // } else {
        //     $db->query("update pasien_visitation
        //     set locked = 2, lengkap_ri = 1
        //     where trans_id = '$trans_id'");
        //     $db->query("update treatment_akomodasi
        //     set islunas = 2
        //     where trans_id = '$trans_id'");
        // }
        // $db->query("update treatment_bill
        //     set islunas = 2, spppoli = newid(), spppolidate = getdate(), spppoliuser = '" . user()->username . "'
        //     where trans_id = '$trans_id' and brand_id is null");
        return $this->response->setJSON([
            'metadata' => 200,
            'response' => "Berhasil update"
        ]);
    }

    public function addPrescR()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $visit = (string)$this->request->getPost('visit');
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);

        // return json_encode($visit);


        $org_unit_code = $this->request->getPost('org_unit_code');
        $jml_bks = $this->request->getPost('jml_bks');
        $dose = $this->request->getPost('dose');
        $orig_dose = $this->request->getPost('orig_dose');
        $resep_ke = $this->request->getPost('resep_ke');
        $description = $this->request->getPost('description');
        $brand_id = $this->request->getPost('brand_id');
        $measure_id = $this->request->getPost('measure_id');
        $measure_id2 = $this->request->getPost('measure_id2');
        $racikan = $this->request->getPost('racikan');
        $doctor = $this->request->getPost('doctor');
        $employee_id = $this->request->getPost('employee_id');
        $employee_id_from = $this->request->getPost('employee_id_from');
        $doctor_from = $this->request->getPost('doctor_from');
        $status_obat = $this->request->getPost('status_obat');
        $tarif_id = $this->request->getPost('tarif_id');
        $treatment = $this->request->getPost('treatment');
        $tarif_type = $this->request->getPost('tarif_type');
        $amount = $this->request->getPost('amount');
        $sell_price = $this->request->getPost('sell_price');
        $tagihan = $this->request->getPost('tagihan');
        $subsidi = $this->request->getPost('subsidi');
        $subsidisat = $this->request->getPost('subsidisat');
        $margin = $this->request->getPost('margin');
        $ppn = $this->request->getPost('ppn');
        $ppnvalue = $this->request->getPost('ppnvalue');
        $discount = $this->request->getPost('discount');
        $diskon = $this->request->getPost('diskon');
        $profession = $this->request->getPost('profession');
        $profesi = $this->request->getPost('profesi');
        $amount_paid = $this->request->getPost('amount_paid');
        $description2 = $this->request->getPost('description2');
        $dose_presc = $this->request->getPost('dose_presc');
        $quantity = $this->request->getPost('quantity');
        $numer = $this->request->getPost('numer');
        $resep_no = $this->request->getPost('resep_no');
        $nota_no = $this->request->getPost('nota_no');
        $treat_date = $this->request->getPost('treat_date');
        $bill_id = $this->request->getPost('bill_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $clinic_id_from = $this->request->getPost('clinic_id_from');
        $visit_id = $this->request->getPost('visit_id');
        $no_registration = $this->request->getPost('no_registration');
        $trans_id = $this->request->getPost('trans_id');
        $modified_from = $this->request->getPost('modified_from');
        $modified_date = $this->request->getPost('modified_date');
        $isrj = $this->request->getPost('isrj');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $theid = $this->request->getPost('theid');
        $moduleId = $this->request->getPost('module_id');
        $dose1 = $this->request->getPost('dose1');
        $dose2 = $this->request->getPost('dose2');
        $theorder = $this->request->getPost('theorder');
        $soldstatus = $this->request->getPost('sold_status');
        $measure_dosis = $this->request->getPost('measure_dosis');
        $body_id = $this->request->getPost('body_id');
        $status_tarif = $this->request->getPost('status_tarif');
        $sold_status = $this->request->getPost('sold_status');
        $status_pasien_id = $this->request->getPost('status_pasien_id');

        $result = [];

        // return json_encode($measure_dosis);

        if (!is_null($org_unit_code)) {
            if (count($org_unit_code) > 0) {

                $pasienPrescription = new PasienPrescriptionModel();
                $getresep = $pasienPrescription->select("resep_no")
                    ->where("valid_user is not null")
                    ->find($resep_no[0]);
                if (!isset($getresep['resep_no'])) {
                    $data = [
                        'org_unit_code' => $org_unit_code[0],
                        'no_registration' => $no_registration[0],
                        'visit_id' => $visit_id[0],
                        'trans_id' => $trans_id[0],
                        'resep_no' => $resep_no[0],
                        'nota_no' => $nota_no[0],
                        'treat_date' => $treat_date[0],
                        'sold_status' => $soldstatus[0],
                        'start_date' => $treat_date[0],
                        'iter' => 1,
                        'clinic_id' => $clinic_id[0],
                        'terlayani' => 0,
                        'employee_id' => $employee_id[0],
                        'description' => $description[0],
                        'modified_date' => $modified_date[0],
                        'modified_by' => user()->username,
                        'modified_from' => $modified_from[0],
                        'thename' => $thename[0],
                        'theaddress' => $theaddress[0],
                        'theid' => $theid[0],
                        'isrj' => $isrj[0],
                        'ageyear' => $visit['ageyear'],
                        'agemonth' => $visit['agemonth'],
                        'ageday' => $visit['ageday'],
                        'status_pasien_id' => $status_pasien_id[0],
                        'payor_id' => $visit['payor_id'],
                        'doctor' => $doctor[0],
                        'class_room_id' => $class_room_id[0],
                        'bed_id' => $visit['ageday'],
                        'keluar_id' => $visit['ageday'],
                    ];
                    // return json_encode($data);
                    $pasienPrescription->save($data);


                    $model = new TreatmentObatModel();
                    $modelgf = new GoodGfModel();

                    $berhasil = [];

                    // return json_encode($soldstatus);
                    $isracik = false;
                    foreach ($org_unit_code as $key => $value) {
                        if ($soldstatus[$key] != 0 && !is_null($org_unit_code[$key]) && $org_unit_code[$key] != '') {
                            $data = [
                                'org_unit_code' => $org_unit_code[$key],
                                'jml_bks' => (int)$jml_bks[$key],
                                'dose' => (float)$dose[$key],
                                'orig_dose' => (float)$orig_dose[$key],
                                'resep_ke' => $resep_ke[$key],
                                'description' => @$description[$key],
                                'brand_id' => @$brand_id[$key],
                                'measure_id' => @$measure_id[$key],
                                'measure_id2' => @$measure_id2[$key],
                                'racikan' => (int)$racikan[$key],
                                'doctor' => @$doctor[$key],
                                'employee_id' => @$employee_id[$key],
                                'employee_id_from' => @$employee_id_from[$key],
                                'doctor_from' => @$doctor_from[$key],
                                // 'status_obat' => $status_obat[$key],
                                'tarif_id' => @$tarif_id[$key],
                                'treatment' => @$treatment[$key],
                                'tarif_type' => @$tarif_type[$key],
                                'amount' => (float)$amount[$key],
                                'sell_price' => (float)$sell_price[$key],
                                'tagihan' => (float)$tagihan[$key],
                                'subsidi' => (float)$subsidi[$key],
                                'subsidisat' => (float)$subsidisat[$key],
                                'margin' => (float)$margin[$key],
                                'ppn' => (float)$ppn[$key],
                                'ppnvalue' => (float)$ppnvalue[$key],
                                'discount' => (float)$discount[$key],
                                'diskon' => (float)$diskon[$key],
                                // 'profession' => $profession[$key],
                                // 'profesi' => $profesi[$key],
                                'amount_paid' => (float)$amount_paid[$key],
                                'description2' => $description2[$key],
                                'dose_presc' => (float)$dose_presc[$key],
                                'quantity' => (float)$quantity[$key],
                                'numer' => (int)$numer[$key],
                                'resep_no' => @$resep_no[$key],
                                'nota_no' => @$nota_no[$key],
                                'treat_date' => $treat_date[$key],
                                'bill_id' => $bill_id[$key],
                                'class_room_id' => @$class_room_id[$key],
                                'clinic_id' => @$clinic_id[$key],
                                'clinic_id_from' => @$clinic_id_from[$key],
                                'visit_id' => $visit_id[$key],
                                'no_registration' => $no_registration[$key],
                                'trans_id' => $trans_id[$key],
                                'modified_from' => $modified_from[$key],
                                'modified_date' => $modified_date[$key],
                                'isrj' => (float)$isrj[$key],
                                'thename' => $thename[$key],
                                'theaddress' => $theaddress[$key],
                                'theid' => $theid[$key],
                                'dose1' => (float)$dose1[$key],
                                'dose2' => (float)$dose2[$key],
                                'module_id' => $moduleId[$key] ?? null,
                                'theorder' => (int)$theorder[$key],
                                'body_id' => $body_id[$key],
                                'status_tarif' => $status_tarif[$key],
                                'sold_status' => $sold_status[$key],
                                'status_pasien_id' => $status_pasien_id[$key]
                            ];
                            if ((int)$racikan[$key] == 1 && isset($measure_dosis[$key])) {
                                $data['measure_dosis'] = $measure_dosis[$key];
                            }
                            if ($racikan[$key] == 1) {
                                $isracik = true;
                            }
                            if ($org_unit_code[$key] != "" && !is_null($org_unit_code[$key])) {
                                $model->save($data, true);
                                $result[] = $data;
                            }
                        } else {
                            if (!is_null($org_unit_code[$key]) && $org_unit_code[$key] != '') {
                                $data = [
                                    'org_unit_code' => $org_unit_code[$key],
                                    'jml_bks' => (int)$jml_bks[$key],
                                    'dose' => (float)$dose[$key],
                                    'orig_dose' => (float)$orig_dose[$key],
                                    'resep_ke' => $resep_ke[$key],
                                    'description' => $description[$key],
                                    'brand_id' => $brand_id[$key],
                                    'measure_id' => $measure_id[$key],
                                    'measure_id2' => $measure_id2[$key],
                                    'racikan' => (int)$racikan[$key],
                                    'doctor' => $doctor[$key],
                                    'employee_id' => $employee_id[$key],
                                    'employee_id_from' => $employee_id_from[$key],
                                    'doctor_from' => $doctor_from[$key],
                                    // 'status_obat' => $status_obat[$key],
                                    'tarif_id' => $tarif_id[$key],
                                    'treatment' => $treatment[$key],
                                    'tarif_type' => $tarif_type[$key],
                                    'amount' => (float)$amount[$key],
                                    'sell_price' => (float)$sell_price[$key],
                                    'tagihan' => (float)$tagihan[$key],
                                    'subsidi' => (float)$subsidi[$key],
                                    'subsidisat' => (float)$subsidisat[$key],
                                    'margin' => (float)$margin[$key],
                                    'ppn' => (float)$ppn[$key],
                                    'ppnvalue' => (float)$ppnvalue[$key],
                                    'discount' => (float)$discount[$key],
                                    'diskon' => (float)$diskon[$key],
                                    // 'profession' => $profession[$key],
                                    // 'profesi' => $profesi[$key],
                                    'amount_paid' => (float)$amount_paid[$key],
                                    'description2' => $description2[$key],
                                    'dose_presc' => (float)$dose_presc[$key],
                                    'quantity' => (float)$quantity[$key],
                                    'numer' => (int)$numer[$key],
                                    'resep_no' => $resep_no[$key],
                                    'nota_no' => $nota_no[$key],
                                    'treat_date' => $treat_date[$key],
                                    'bill_id' => $bill_id[$key],
                                    'class_room_id' => $class_room_id[$key],
                                    'clinic_id' => $clinic_id[$key],
                                    'clinic_id_from' => $clinic_id_from[$key],
                                    'visit_id' => $visit_id[$key],
                                    'no_registration' => $no_registration[$key],
                                    'trans_id' => $trans_id[$key],
                                    'modified_from' => $modified_from[$key],
                                    'modified_date' => $modified_date[$key],
                                    'isrj' => (float)$isrj[$key],
                                    'thename' => $thename[$key],
                                    'theaddress' => $theaddress[$key],
                                    'theid' => $theid[$key],
                                    'dose1' => (float)$dose1[$key],
                                    'dose2' => (float)$dose2[$key],
                                    'module_id' => $moduleId[$key],
                                    'theorder' => (int)$theorder[$key],
                                    'sold_status' => $soldstatus[$key]
                                ];
                                $dataalkes = [
                                    'org_unit_code' => $org_unit_code[$key],
                                    'size_goods' => (float)$dose[$key],
                                    'brand_name' => $description[$key],
                                    'brand_id' => $brand_id[$key],
                                    'measure_dosis' => $measure_id[$key],
                                    'measure_id2' => $measure_id2[$key],
                                    'measure_id3' => $measure_id2[$key],
                                    'distribution_type' => (int)$numer[$key] == 4 ? 3 : (int)$racikan[$key],
                                    'price' => (float)$amount[$key],
                                    'order_price' => (float)$sell_price[$key],
                                    'discount' => (float)$subsidi[$key],
                                    'discount2' => (float)$discount[$key],
                                    'corrections' => $description2[$key],
                                    'diminta' => (float)$dose_presc[$key],
                                    'quantity' => (float)$quantity[$key],
                                    'condition' => (int)$numer[$key],
                                    'invoice_id' => $resep_no[$key],
                                    'po' => $nota_no[$key],
                                    'allocated_date' => $treat_date[$key],
                                    'item_id' => $bill_id[$key],
                                    'org_id' => $clinic_id[$key],
                                    'org_unit_from' => $clinic_id_from[$key],
                                    'company_id' => $no_registration[$key],
                                    'retur_id' => $trans_id[$key],
                                    'rooms_id' => $visit['clinic_id'],
                                    'allocated_from' => $thename[$key],
                                    'doc_no' => $theid[$key],
                                    'isoutlet' => $soldstatus[$key],
                                    'from_rooms_id' => $clinic_id[$key] == $modified_from[$key] ? $clinic_id_from[$key] : $clinic_id[$key],
                                    'discountoff' => 0,
                                    'dijual' => (float)$quantity[$key],
                                    'invoice_id2' => $employee_id[$key] . $doctor[$key],
                                    'month_id' => new rawsql("month('{$treat_date[$key]}')"),
                                    'year_id' => new rawsql("year('{$treat_date[$key]}')"),
                                    'correction_doc' => substr($tarif_id[$key] . $treatment[$key], 0, 50),
                                    'stock_opname' => 0,
                                    'stok_awal' => 0,
                                    'stock_lalu' => 0,
                                    'stock_koreksi' => 0,
                                    'diterima' => 0,
                                    'distribusi' => 0,
                                    'dihapus' => 0,
                                    'diretur' => 0,
                                    'batch_no' => $visit_id[$key]
                                ];

                                $modelgf->save($dataalkes, true);

                                $result[] = $data;
                            }
                        }
                    }
                    if (count($org_unit_code) > 0) {
                        if ($isrj[0] == '1') {
                            $antrianFarmasi = new AntrianFarmasiModel();
                            if ($isracik) {
                                $loket = $clinic_id[0] . "F";
                            } else {
                                $loket = $clinic_id[0] . "E";
                            }
                            $select = $antrianFarmasi->select("isnull(max(no_urut),0)+1 as nourut")
                                ->where("year(tanggal_daftar) = year('{$treat_date[0]}') and month(tanggal_daftar) = month('{$treat_date[0]}') and day(tanggal_daftar) = DAY('{$treat_date[0]}') ")->first();
                            $no_urut = @$select['nourut'];

                            // select isnull(max(no_urut),0) into :liurutmax from antrian_FARMASI where 
                            // year(getdate()) = year(tanggal_daftar) and month(getdate()) = month(tanggal_daftar)
                            // and day(getdate()) = DAY(tanggal_daftar) 
                            $dataantrian = [
                                'q_id' => $resep_no[0],
                                'no_urut' => $no_urut,
                                'tanggal_daftar' => $treat_date[0],
                                'loket' => $loket,
                                'status_panggil' => 0,
                                'no_registration' => $no_registration[0],
                                'thename' => $thename[0],
                                'visit_id' => $visit_id[0],
                            ];
                            $antrianFarmasi->save($dataantrian);
                        }
                    }
                    $array   = array('status' => 'success', 'error' => '', 'message' => 'Berhasil simpan data', 'data' => $result);
                    return json_encode($array);
                } else {
                    $array   = array('status' => 'fail', 'error' => '', 'message' => 'Data ini sudah terkunci, tidak bisa mengubah data lagi', 'data' => $result);
                    return json_encode($array);
                }
            }
        } else {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'Berhasil hapus resep', 'data' => $result);
            return json_encode($array);
        }
    }
    public function checkStockGoods()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $brand_id = $body['brand_id'];

        $db = db_connect();
        $select = $db->query("select 
                        rooms_id AS ROOMS_ID,

                        --G.ROOMS_ID ,
                        goods.brand_id,
                        goods.NAME,

                        sum(
                        case 
                        WHEN G.DISTRIBUTION_TYPE IN (100) and ( G.ROOMS_ID  LIKE rooms_id  and G.ROOMS_ID=G.FROM_ROOMS_ID) AND (G.STOCK_OPNAME IS NOT NULL) THEN G.STOCK_OPNAME      --sum(STOK_AWAL) 
                        ELSE NULL
                        END  ) as stokopname,


                        -- kalo ada stok opnmae pada akhir periode ini, tidak boleh dihitung, karena akan dignakan untuk stok awal periode
                        -- berikutnya. Periode saat ini hanya mengacu pada stok awal pada periode ini juga
                        --awal
                        sum(
                        case 
                        WHEN G.DISTRIBUTION_TYPE IN (104) and ( G.ROOMS_ID  LIKE rooms_id  and G.ROOMS_ID=G.FROM_ROOMS_ID) THEN ISNULL(G.STOK_AWAL,0)--sum(STOK_AWAL) 
                        ELSE 0
                        END  ) as awal,

                        --========================  MASUUUK  dari Eksternal ==================================
                        -- bapb
                        (--BAPB
                        sum(
                        case 
                        WHEN G.DISTRIBUTION_TYPE IN (5,6,7,8) and ( G.ROOMS_ID  LIKE rooms_id ) THEN ISNULL(G.DITERIMA,0)--sum(STOK_AWAL) 
                        ELSE 0
                        END  ) 
                        +
                        sum(
                        case 
                        WHEN G.DISTRIBUTION_TYPE IN (101) and G.ISOUTLET = 26 and ( G.ROOMS_ID  LIKE rooms_id ) THEN(-1* ISNULL(G.STOCK_KOREKSI,0) + ISNULL(G.DITERIMA,0) )--sum(STOK_AWAL) 
                        ELSE 0
                        END  ) --<<< KOREKSI BAPB = 26
                            
                        ) -- BAPBBB 
                        as bapb,--bapb, terima bonus, terima dari dokter, dll dari luar RS

                        --========================  Masuk internal  ==================================
                        ( ---DISTRIBUSIII
                        SUM(
                        case 
                        --WHEN G.DISTRIBUTION_TYPE IN (5,6,7,8,9,10) AND (G.ROOMS_ID  LIKE rooms_id ) THEN  ISNULL(DITERIMA,0)--SUM(DITERIMA) 
                        WHEN G.DISTRIBUTION_TYPE IN (9,10) AND (G.ROOMS_ID  LIKE rooms_id ) THEN  ISNULL(G.DITERIMA,0)--SUM(DITERIMA) 
                        ELSE 0
                        END --as distribusi dan maintenance,
                        
                        ) 
                        +
                        SUM(
                        case 
                        --WHEN G.DISTRIBUTION_TYPE IN (5,6,7,8,9,10) AND (G.ROOMS_ID  LIKE rooms_id ) THEN  ISNULL(DITERIMA,0)--SUM(DITERIMA) 
                        WHEN G.DISTRIBUTION_TYPE IN (101) and G.ISOUTLET in( 21,22) AND (G.ROOMS_ID  LIKE rooms_id ) THEN ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DITERIMA,0))--SUM(DITERIMA) 
                        ELSE 0
                        END --as MUTASI IN,
                        
                        ) --<<< KOREKSI Mutasi IN !!! dan MUTASI OUT

                        ) ---DISTRIBUSI 
                        
                        as masuk,
                        --=====================================================================
                        (
                        sum(
                        CASE 
                        WHEN G.DISTRIBUTION_TYPE IN (12) AND (G.ROOMS_ID LIKE rooms_id)   THEN ISNULL(G.DIRETUR,0)
                        ELSE 0
                        END  -- as returkegudang, --retur internal
                        ) 
                        +
                        sum(
                        CASE 
                        WHEN G.DISTRIBUTION_TYPE IN (101) AND G.ISOUTLET = 23 AND (G.ROOMS_ID LIKE rooms_id)   THEN  ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DIRETUR,0))
                        ELSE 0
                        END  -- as returkegudang, retur internal
                        ) --- <<<< KOREKSIII !!!

                        )
                        
                        as masukRetInt,--MUTASI 
                        --===================================================================

                        ( -- RETUR PENJUALAN
                        SUM
                        (  
                        CASE 
                        WHEN G.DISTRIBUTION_TYPE IN (4) AND ( G.ROOMS_ID LIKE rooms_id) THEN abs( ISNULL(G.DIJUAL,0)) --SUM(DITERIMA)  --dari retur penjualan obat
                        ELSE 0
                        END 
                        )

                        + 

                        SUM
                        (  
                        CASE 
                        WHEN G.DISTRIBUTION_TYPE IN (101) AND G.ISOUTLET = 25 AND ( G.ROOMS_ID LIKE rooms_id ) THEN ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + abs( ISNULL(G.DIJUAL,0))) --SUM(DITERIMA)  --dari retur penjualan obat
                        ELSE 0
                        END 
                        ) --<<< KOREKSI !!! retur penjualan
                            
                        ) masukRetTrx , --as terimatrx,
                        
                        


                        --================== barang keluar internal  ====================
                        (--- keluar internal
                        sum
                        (
                        CASE 
                        WHEN (G.DISTRIBUTION_TYPE IN (10,12)) and (G.FROM_ROOMS_ID  LIKE rooms_id) THEN ( ISNULL(G.DISTRIBUSI,0) + ISNULL(G.DIRETUR,0) )--( ISNULL(DITERIMA,0) + ISNULL(DIRETUR,0) )--SUM(DITERIMA + DIRETUR)  -- retur pembelian --keluar
                        ELSE 0
                        END    
                        ) 
                        +

                        sum
                        (
                        CASE 
                        WHEN (G.DISTRIBUTION_TYPE IN (101)) AND G.ISOUTLET IN (23)  AND (G.FROM_ROOMS_ID  LIKE rooms_id) THEN  ( ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DISTRIBUSI,0) ) + ( (-1*ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DIRETUR,0)) )--( ISNULL(DITERIMA,0) + ISNULL(DIRETUR,0) )--SUM(DITERIMA + DIRETUR)  -- retur pembelian --keluar
                        ELSE 0
                        END    
                        ) --<<<<< KOREKSI !!!! --RETUR INTERNAL

                        )--keluar internal

                        as KELUAR_DIST,



                        -- =============== keluar esternal ===========================
                        (--keluar ext
                        sum
                        (
                        CASE 
                        WHEN (G.DISTRIBUTION_TYPE IN (11,13,14)) and ( FROM_ROOMS_ID  LIKE rooms_id) THEN  ( ISNULL(G.DIHAPUS,0) + ISNULL(G.DIRETUR,0) )--(sum(DIHAPUS) +  SUM(DIRETUR))  -- retur pembelian --keluar
                        --WHEN (G.DISTRIBUTION_TYPE IN (11,13,14)) and FROM_ROOMS_ID  LIKE rooms_id THEN  ( ISNULL(DIHAPUS,0) +  ISNULL(DIRETUR,0) )--(sum(DIHAPUS) +  SUM(DIRETUR))  -- retur pembelian --keluar
                        ELSE 0
                        END  --as KELUARRETUR,--RETUR
                        ) 
                        +
                        
                        sum
                        (
                        CASE 
                        WHEN (G.DISTRIBUTION_TYPE IN (101)) AND G.ISOUTLET IN (24,27) and (G.FROM_ROOMS_ID  LIKE rooms_id) THEN  ( ((-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DIHAPUS,0)) + ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DIRETUR,0) ))--(sum(DIHAPUS) +  SUM(DIRETUR))  -- retur pembelian --keluar
                        --WHEN (G.DISTRIBUTION_TYPE IN (11,13,14)) and FROM_ROOMS_ID  LIKE rooms_id THEN  ( ISNULL(DIHAPUS,0) +  ISNULL(DIRETUR,0) )--(sum(DIHAPUS) +  SUM(DIRETUR))  -- retur pembelian --keluar
                        ELSE 0
                        END  --as KELUARRETUR,--RETUR -MUTASI OUT
                        ) --<<<<<< koreksi !!!

                        )--keluar ex
                        
                        as KELUARRETUR,

                        (--keluar
                        sum(
                        CASE 
                        WHEN (G.DISTRIBUTION_TYPE IN (0,1,2,3,15,16)) AND ( G.ROOMS_ID LIKE rooms_id )   THEN  ISNULL(G.DIJUAL,0) --SUM(DIJUAL)  -- retur pembelian --keluar  
                        ELSE 0
                        END -- as  keluartrx -- new 12082018 15 16 : pemakaian BHP dan gizi
                        )
                        +
                        sum(
                        CASE 
                        WHEN (G.DISTRIBUTION_TYPE IN (101)) AND G.ISOUTLET IN (20)  AND ( G.ROOMS_ID LIKE rooms_id )  THEN ((-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(G.DIJUAL,0)) --SUM(DIJUAL)  -- retur pembelian --keluar  
                        ELSE 0
                        END -- as  --<<< KOREKSI
                        )   
                        ) --keluar 
                        as keluar,


                        ---<<<<<<<<<<<<<<<<<<<<< AFTER STOK OPNAME TRANS >>>>>>>>>>>>>>>>>>>>>>>>>>>-----------------
                        --============================================================================================
                        ISNULL(
                        CASE WHEN   ( SUM(CASE WHEN G.DISTRIBUTION_TYPE IN (100) and ( G.ROOMS_ID  LIKE rooms_id  and G.ROOMS_ID=G.FROM_ROOMS_ID) AND ( G.STOCK_OPNAME IS NOT NULL)THEN G.STOCK_OPNAME ELSE NULL END) IS NOT NULL )  THEN-- apabila ada SO, baru hituing aktifitas sesudah SO
                                        (--0
                                                sum(--1

                                                    (--2
                                                    --awal
                                                    CASE
                                                    WHEN G.DISTRIBUTION_TYPE IN (104) and ( G.ROOMS_ID  LIKE rooms_id  and G.ROOMS_ID=G.FROM_ROOMS_ID) AND G.ALLOCATED_DATE >=  DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN ISNULL(G.STOK_AWAL,0)--sum(STOK_AWAL) 
                                                    ELSE 0
                                                    END 
                                                    --as awal, -- 100 STOK OPNAME NGGAK DIITUNG KRN JD STOK AWAL DIBULA BERIKUTNYA

                                                    +


                                                    CASE 
                                                    WHEN G.DISTRIBUTION_TYPE IN (5,6,7,8,9,10) AND (G.ROOMS_ID LIKE rooms_id)  AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) --DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN  ISNULL(G.DITERIMA,0)--SUM(DITERIMA) 
                                                    ELSE 0
                                                    END  --as terimabapb, -- PENERIMAAN BARANG DR DOKTER

                        
                                                    +

                                                    CASE 
                                                    WHEN G.DISTRIBUTION_TYPE IN (12) AND (G.ROOMS_ID LIKE rooms_id)  AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) --DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) 
                                                    THEN ISNULL(G.DIRETUR,0)
                                                    ELSE 0
                                                    END 

                                                    +

                                                    CASE 
                                                    WHEN G.DISTRIBUTION_TYPE IN (4) AND (G.ROOMS_ID LIKE rooms_id)  AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN abs( ISNULL(DIJUAL,0)) --SUM(DITERIMA)  --dari retur penjualan obat
                                                    ELSE 0
                                                    END  --as terimatrx,
                                                    +
                                                    --============== KOREKSI MUTASI IN ======================
                                                    case 
                                                        --WHEN G.DISTRIBUTION_TYPE IN (5,6,7,8,9,10) AND (G.ROOMS_ID  LIKE rooms_id ) THEN  ISNULL(DITERIMA,0)--SUM(DITERIMA) 
                                                        WHEN G.DISTRIBUTION_TYPE IN (101) and G.ISOUTLET in( 21,22) AND (G.ROOMS_ID  LIKE rooms_id ) AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                        THEN ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(DITERIMA,0))--SUM(DITERIMA) 
                                                        ELSE 0
                                                        END --as MUTASI IN,
                        
                                                        )--2
                                                    )--1

                                                    -

                                                    --================== barang keluar ====================
                                            SUM(--1
                                                (--2
                                                    CASE 
                                                    WHEN (G.DISTRIBUTION_TYPE IN (10,12)) and (G.FROM_ROOMS_ID   LIKE rooms_id ) AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN ( ISNULL(DISTRIBUSI,0) + ISNULL(DIRETUR,0) )--( ISNULL(DITERIMA,0) + ISNULL(DIRETUR,0) )--SUM(DITERIMA + DIRETUR)  -- retur pembelian --keluar
                                                    ELSE 0
                                                    END -- as KELUAR_DIST,--MUTASI (10)--RETUR INTERNAL(12) 

                                                    +

                                                    CASE 
                                                    WHEN (G.DISTRIBUTION_TYPE IN (3,11,13,14)) and (G.FROM_ROOMS_ID  LIKE rooms_id) AND G.ALLOCATED_DATE >=DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN  ( ISNULL(DIHAPUS,0) +  ISNULL(DIRETUR,0) )--(sum(DIHAPUS) +  SUM(DIRETUR))  -- retur pembelian --keluar
                                                    ELSE 0
                                                    END  --as KELUARRETUR,--RETUR --as KELUARRETUR,--RETUR --RETUR KE SUPPLIER (13), RETUR KE SUPLLIER UTK MAINTENANNCE (14) 
                                                    +

                                                    CASE 
                                                    WHEN (G.DISTRIBUTION_TYPE IN (0,1,2,3,15,16)) AND (G.ROOMS_ID LIKE rooms_id)  AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN  ISNULL(DIJUAL,0) --SUM(DIJUAL)  -- retur pembelian --keluar
                                                    ELSE 0
                                                    END -- as  keluartrx -- new 12082018 15 16 : pemakaian BHP dan gizi, 0: NON RACIKAN, RACIKAN, DLL
                                                    +
                                                    --======================KOREKSI  MUTASI OUT =============================
                                                    CASE 
                                                    WHEN (G.DISTRIBUTION_TYPE IN (101)) AND G.ISOUTLET IN (24,27) and ( FROM_ROOMS_ID  LIKE rooms_id)  AND G.ALLOCATED_DATE >= DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0)
                                                    THEN  ( ((-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(DIHAPUS,0)) + ( (-1* ISNULL(G.STOCK_KOREKSI,0)) + ISNULL(DIRETUR,0) ))
                                                    
                                                    ELSE 0
                                                    END  --as KELUARRETUR,--RETUR -MUTASI OUT nggak jadi disini tapi = mutasi in --diterima
                                                    )--2
                                                ) --1
                                            ) --0

                                        END ,0)		
                                        AS AFTERSO
                                

                            
                        FROM  GOODS   		
                        ,GOOD_GF G	

                        where GOODS.BRAND_ID = G.BRAND_ID AND 
                        (G.BRAND_ID LIKE'$brand_id' OR G.BRAND_NAME LIKE'$brand_id') and
                        ( G.ROOMS_ID LIKE '33') AND 
                        YEAR(G.ALLOCATED_DATE) = year(getdate()) 
                        AND MONTH(G.ALLOCATED_DATE) =month(getdate()) AND 
                            GOODS.ISACTIVE=1 
                        
                        GROUP BY
                        rooms_id,
                        GOODS.BRAND_ID,
                        goods.name

                        ORDER BY GOODS.NAME ASC")->getRow(0, 'array');
        if (!is_null($select)) {
            $val = $this->lowerKey($select);
            $val['stokopname'] = 0;
            $jml = $val['awal'] + $val['bapb'] +  $val['masukrettrx']
                - $val['keluarretur'] - $val['keluar'];
        } else {
            $jml = 0;
        }
        return json_encode($jml);
    }
    public function deletePresc()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $id = $body['bill'];

        // return json_encode($id);

        $model = new TreatmentObatModel();
        $result = $model->where('bill_id', $id)->delete($id);

        if ($result) {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'delete berhasil');
            echo json_encode($array);
        } else {
            $array   = array('status' => 'failure', 'error' => '', 'message' => 'delete gagal');
            echo json_encode($array);
        }
    }
    public function deleteRacikan()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $resepKe = $body['resepKe'];
        $resepNo = $body['resepNo'];

        // return json_encode($id);

        $model = new TreatmentObatModel();
        $result = $model->where('resep_ke', $resepKe)->where('resep_no', $resepNo)->delete();

        if ($result) {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'delete racikan berhasil', 'resepNo' => $resepNo, 'resepKe' => $resepKe);
            echo json_encode($array);
        } else {
            $array   = array('status' => 'failure', 'error' => '', 'message' => 'delete gagal');
            echo json_encode($array);
        }
    }
    public function stopOdd()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $resep_no = $body['resep_no'];
        $resep_ke = $body['resep_ke'];

        // return json_encode($id);

        $db = db_connect();
        $result = $db->query("update treatment_obat set status_tarif = 0 where resep_no = '$resep_no' and resep_ke = '$resep_ke'");

        // $model = new TreatmentObatModel();
        // $data = [
        //     'status_tarif' => 1
        // ];
        // $result = $model->where("resep_no", $resep_no)->where("resep_ke", $resep_ke)
        //     ->set($data)->update();

        if ($result) {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'Stop ODD Berhasil', 'data' => $body);
            echo json_encode($array);
        } else {
            $array   = array('status' => 'failure', 'error' => '', 'message' => 'Stop ODD Gagal');
            echo json_encode($array);
        }
    }
    public function stopOddAll()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $resep_no = $body['resep_no'];
        $visit_id = $body['visit_id'];

        // return json_encode($id);

        $db = db_connect();
        $result = $db->query("update treatment_obat set status_tarif = 0 where resep_no like '$resep_no' and visit_id = '$visit_id'");

        // $model = new TreatmentObatModel();
        // $data = [
        //     'status_tarif' => 1
        // ];
        // $result = $model->where("resep_no", $resep_no)->where("resep_ke", $resep_ke)
        //     ->set($data)->update();

        if ($result) {
            $array   = array('status' => 'success', 'error' => '', 'message' => 'Stop ODD Berhasil', 'data' => $body);
            echo json_encode($array);
        } else {
            $array   = array('status' => 'failure', 'error' => '', 'message' => 'Stop ODD Gagal');
            echo json_encode($array);
        }
    }
    public function editPresc()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return $this->request->is('put');


        // return json_encode($norm);
        // $rules = [
        //     'bed_id' => 'permit_empty|integer',
        //     'keluar_id' => 'permit_empty|integer',
        //     'status_pasien_id' => 'permit_empty|integer',
        //     'ageyear' => 'permit_empty|integer',
        //     'agemonth' => 'permit_empty|integer',
        //     'ageday' => 'permit_empty|integer',
        //     'saturasi' => 'permit_empty|integer',
        //     'kesadaran' => 'permit_empty|integer',
        //     'isvalid' => 'permit_empty|integer',
        //     'temperature' => 'permit_empty|integer',
        //     'tension_upper' => 'permit_empty|integer',
        //     'tension_below' => 'permit_empty|integer',
        //     'nadi' => 'permit_empty|integer',
        //     'nafas' => 'permit_empty|integer',
        //     'weight' => 'permit_empty|integer',
        //     'height' => 'permit_empty|integer',
        //     'arm_diameter' => 'permit_empty|integer',
        // ];



        // if (!$this->validate($rules)) {
        //     $validation = \Config\Services::validation();
        //     $errors = $validation->getErrors();
        //     $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
        //     return json_encode($array);
        // }


        $org_unit_code = $this->request->getPost('org_unit_code');
        $jml_bks = $this->request->getPost('jml_bks');
        $dose = $this->request->getPost('dose');
        $orig_dose = $this->request->getPost('orig_dose');
        $resep_ke = $this->request->getPost('resep_ke');
        $description = $this->request->getPost('description');
        $brand_id = $this->request->getPost('brand_id');
        $measure_id = $this->request->getPost('measure_id');
        $measure_id2 = $this->request->getPost('measure_id2');
        $racikan = $this->request->getPost('racikan');
        $doctor = $this->request->getPost('doctor');
        $employee_id = $this->request->getPost('employee_id');
        $employee_id_from = $this->request->getPost('employee_id_from');
        $doctor_from = $this->request->getPost('doctor_from');
        // $status_obat = $this->request->getPost('status_obat');
        $tarif_id = $this->request->getPost('tarif_id');
        $treatment = $this->request->getPost('treatment');
        $tarif_type = $this->request->getPost('tarif_type');
        $amount = $this->request->getPost('amount');
        $sell_price = $this->request->getPost('sell_price');
        $tagihan = $this->request->getPost('tagihan');
        $subsidi = $this->request->getPost('subsidi');
        $subsidisat = $this->request->getPost('subsidisat');
        $margin = $this->request->getPost('margin');
        $ppn = $this->request->getPost('ppn');
        $ppnvalue = $this->request->getPost('ppnvalue');
        $discount = $this->request->getPost('discount');
        $diskon = $this->request->getPost('diskon');
        $profession = $this->request->getPost('profession');
        $profesi = $this->request->getPost('profesi');
        $amount_paid = $this->request->getPost('amount_paid');
        $description2 = $this->request->getPost('description2');
        $dose_presc = $this->request->getPost('dose_presc');
        $quantity = $this->request->getPost('quantity');
        $numer = $this->request->getPost('numer');
        $resep_no = $this->request->getPost('resep_no');
        $nota_no = $this->request->getPost('nota_no');
        $treat_date = $this->request->getPost('treat_date');
        $bill_id = $this->request->getPost('bill_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $clinic_id_from = $this->request->getPost('clinic_id_from');
        $visit_id = $this->request->getPost('visit_id');
        $no_registration = $this->request->getPost('no_registration');
        $trans_id = $this->request->getPost('trans_id');
        $modified_from = $this->request->getPost('modified_from');
        $modified_date = $this->request->getPost('modified_date');
        $isrj = $this->request->getPost('isrj');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $theid = $this->request->getPost('theid');
        $islunas = $this->request->getPost('islunas');


        $model = new TreatmentObatModel();

        $result = [];


        foreach ($bill_id as $key => $value) {
            $data = [
                'org_unit_code' => $org_unit_code[$key],
                'jml_bks' => (float)$jml_bks[$key],
                'dose' => (float)$dose[$key],
                'orig_dose' => (float)$orig_dose[$key],
                'resep_ke' => (int)$resep_ke[$key],
                'description' => $description[$key],
                'brand_id' => $brand_id[$key],
                'measure_id' => $measure_id[$key],
                'measure_id2' => $measure_id2[$key],
                'racikan' => $racikan[$key],
                'doctor' => $doctor[$key],
                'employee_id' => $employee_id[$key],
                'employee_id_from' => $employee_id_from[$key],
                'doctor_from' => $doctor_from[$key],
                // 'status_obat' => $status_obat[$key],
                'tarif_id' => $tarif_id[$key],
                'treatment' => $treatment[$key],
                'tarif_type' => $tarif_type[$key],
                'amount' => (float)$amount[$key],
                'sell_price' => (float)$sell_price[$key],
                'tagihan' => (float)$tagihan[$key],
                'subsidi' => (float)$subsidi[$key],
                'subsidisat' => (float)$subsidisat[$key],
                'margin' => (float)$margin[$key],
                'ppn' => (float)$ppn[$key],
                'ppnvalue' => (float)$ppnvalue[$key],
                'discount' => (float)$discount[$key],
                'diskon' => (float)$diskon[$key],
                'profession' => (float)$profession[$key],
                'profesi' => (float)$profesi[$key],
                'amount_paid' => (float)$amount_paid[$key],
                'description2' => $description2[$key],
                'dose_presc' => (float)$dose_presc[$key],
                'quantity' => (float)$quantity[$key],
                'numer' => (int)$numer[$key],
                'resep_no' => $resep_no[$key],
                'nota_no' => $nota_no[$key],
                'treat_date' => $treat_date[$key],
                'class_room_id' => $class_room_id[$key],
                'clinic_id' => $clinic_id[$key],
                'clinic_id_from' => $clinic_id_from[$key],
                'visit_id' => $visit_id[$key],
                'no_registration' => $no_registration[$key],
                'trans_id' => $trans_id[$key],
                'modified_from' => $modified_from[$key],
                'modified_date' => $modified_date[$key],
                'isrj' => $isrj[$key],
                'thename' => $thename[$key],
                'theaddress' => $theaddress[$key],
                'theid' => $theid[$key],
                'islunas' => $islunas[$key],
                'bill_id' => $bill_id[$key]
            ];


            $result = $model->update($bill_id, $data);

            if ($result) {
                $returnData[] = $data;
            }
        }





        // return json_encode($data);

        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $alfa_no = substr(str_shuffle($str_result), 0, 5);
        $array   = array('status' => 'success', 'error' => '', 'message' => 'edit obat non racikan berhasil', 'data' => $returnData);
        echo json_encode($array);
    }
    public function editPrescR()
    {
        // dd($this->request->is('post'));
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return $this->request->is('put');


        // return json_encode($norm);
        // $rules = [
        //     'bed_id' => 'permit_empty|integer',
        //     'keluar_id' => 'permit_empty|integer',
        //     'status_pasien_id' => 'permit_empty|integer',
        //     'ageyear' => 'permit_empty|integer',
        //     'agemonth' => 'permit_empty|integer',
        //     'ageday' => 'permit_empty|integer',
        //     'saturasi' => 'permit_empty|integer',
        //     'kesadaran' => 'permit_empty|integer',
        //     'isvalid' => 'permit_empty|integer',
        //     'temperature' => 'permit_empty|integer',
        //     'tension_upper' => 'permit_empty|integer',
        //     'tension_below' => 'permit_empty|integer',
        //     'nadi' => 'permit_empty|integer',
        //     'nafas' => 'permit_empty|integer',
        //     'weight' => 'permit_empty|integer',
        //     'height' => 'permit_empty|integer',
        //     'arm_diameter' => 'permit_empty|integer',
        // ];



        // if (!$this->validate($rules)) {
        //     $validation = \Config\Services::validation();
        //     $errors = $validation->getErrors();
        //     $array   = array('status' => 'fail', 'error' => $errors, 'message' => 'update gagal');
        //     return json_encode($array);
        // }


        $org_unit_code = $this->request->getPost('org_unit_code');
        $jml_bks = $this->request->getPost('jml_bks');
        $dose = $this->request->getPost('dose');
        $orig_dose = $this->request->getPost('orig_dose');
        $resep_ke = $this->request->getPost('resep_ke');
        $description = $this->request->getPost('description');
        $brand_id = $this->request->getPost('brand_id');
        $measure_id = $this->request->getPost('measure_id');
        $measure_id2 = $this->request->getPost('measure_id2');
        $racikan = $this->request->getPost('racikan');
        $doctor = $this->request->getPost('doctor');
        $employee_id = $this->request->getPost('employee_id');
        $employee_id_from = $this->request->getPost('employee_id_from');
        $doctor_from = $this->request->getPost('doctor_from');
        // $status_obat = $this->request->getPost('status_obat');
        $tarif_id = $this->request->getPost('tarif_id');
        $treatment = $this->request->getPost('treatment');
        $tarif_type = $this->request->getPost('tarif_type');
        $amount = $this->request->getPost('amount');
        $sell_price = $this->request->getPost('sell_price');
        $tagihan = $this->request->getPost('tagihan');
        $subsidi = $this->request->getPost('subsidi');
        $subsidisat = $this->request->getPost('subsidisat');
        $margin = $this->request->getPost('margin');
        $ppn = $this->request->getPost('ppn');
        $ppnvalue = $this->request->getPost('ppnvalue');
        $discount = $this->request->getPost('discount');
        $diskon = $this->request->getPost('diskon');
        $profession = $this->request->getPost('profession');
        $profesi = $this->request->getPost('profesi');
        $amount_paid = $this->request->getPost('amount_paid');
        $description2 = $this->request->getPost('description2');
        $dose_presc = $this->request->getPost('dose_presc');
        $quantity = $this->request->getPost('quantity');
        $numer = $this->request->getPost('numer');
        $resep_no = $this->request->getPost('resep_no');
        $nota_no = $this->request->getPost('nota_no');
        $treat_date = $this->request->getPost('treat_date');
        $bill_id = $this->request->getPost('bill_id');
        $class_room_id = $this->request->getPost('class_room_id');
        $clinic_id = $this->request->getPost('clinic_id');
        $clinic_id_from = $this->request->getPost('clinic_id_from');
        $visit_id = $this->request->getPost('visit_id');
        $no_registration = $this->request->getPost('no_registration');
        $trans_id = $this->request->getPost('trans_id');
        $modified_from = $this->request->getPost('modified_from');
        $modified_date = $this->request->getPost('modified_date');
        $isrj = $this->request->getPost('isrj');
        $thename = $this->request->getPost('thename');
        $theaddress = $this->request->getPost('theaddress');
        $theid = $this->request->getPost('theid');
        $moduleId = $this->request->getPost('module_id');
        $dose1 = $this->request->getPost('dose1');
        $dose2 = $this->request->getPost('dose2');
        $theorder = $this->request->getPost('theorder');

        // return json_encode($discount);


        $model = new TreatmentObatModel();

        $result = [];


        foreach ($bill_id as $key => $value) {
            $data = [
                'org_unit_code' => $org_unit_code[$key],
                'jml_bks' => (int)$jml_bks,
                'dose' => (float)$dose[$key],
                'orig_dose' => (float)$orig_dose[$key],
                'resep_ke' => $resep_ke[$key],
                'description' => $description[$key],
                'brand_id' => $brand_id[$key],
                'measure_id' => $measure_id[$key],
                'measure_id2' => $measure_id2[$key],
                'racikan' => $racikan[$key],
                'doctor' => $doctor[$key],
                'employee_id' => $employee_id[$key],
                'employee_id_from' => $employee_id_from[$key],
                'doctor_from' => $doctor_from[$key],
                // 'status_obat' => $status_obat[$key],
                'tarif_id' => $tarif_id[$key],
                'treatment' => $treatment[$key],
                'tarif_type' => $tarif_type[$key],
                'amount' => $amount[$key],
                'sell_price' => $sell_price[$key],
                'tagihan' => $tagihan[$key],
                'subsidi' => $subsidi[$key],
                'subsidisat' => $subsidisat[$key],
                'margin' => $margin[$key],
                'ppn' => $ppn[$key],
                'ppnvalue' => $ppnvalue[$key],
                'discount' => $discount[$key],
                'diskon' => $diskon[$key],
                'profession' => $profession[$key],
                'profesi' => $profesi[$key],
                'amount_paid' => $amount_paid[$key],
                'description2' => $description2,
                'dose_presc' => $dose_presc[$key],
                'quantity' => $quantity[$key],
                'numer' => $numer[$key],
                'resep_no' => $resep_no[$key],
                'nota_no' => $nota_no[$key],
                'treat_date' => $treat_date[$key],
                'bill_id' => $bill_id[$key],
                'class_room_id' => $class_room_id[$key],
                'clinic_id' => $clinic_id[$key],
                'clinic_id_from' => $clinic_id_from[$key],
                'visit_id' => $visit_id[$key],
                'no_registration' => $no_registration[$key],
                'trans_id' => $trans_id[$key],
                'modified_from' => $modified_from[$key],
                'modified_date' => $modified_date[$key],
                'isrj' => $isrj[$key],
                'thename' => $thename[$key],
                'theaddress' => $theaddress[$key],
                'theid' => $theid[$key],
                'dose1' => (float)$dose1[$key],
                'dose2' => (float)$dose2[$key],
                'module_id' => $moduleId,
                'theorder' => $theorder[$key]
            ];

            // return json_encode($data);
            $result = $model->save($data);

            if ($result) {
                $returnData[] = $data;
            }
        }





        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        $array   = array('status' => 'success', 'error' => '', 'message' => 'edit obat non racikan berhasil', 'data' => $returnData);
        echo json_encode($array);
    }
    public function getPasienRanapRoom()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $clinic_id = $body['clinic_id'];
        $class_room_id = $body['class_room_id'];

        $ta = new TreatmentAkomodasiModel();
        $kunjungan = $this->lowerKey($ta->getPasienRanap('%', '%', '%', $clinic_id, '2000-01-01', '2100-01-01', '%', '%', '%', 0, 100));

        return json_encode($kunjungan);
    }
    public function getHandOver()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $model = new HandoverModel();
        $modelDetail = new HandoverDetailModel();

        $select = $model
            // ->where("received_by is not null and received_by <> ''")
            ->findAll();
        $selectDetail = [];
        if (count($select) > 0) {
            $select = $this->lowerKey($select);
            $where = '';
            foreach ($select as $key => $value) {
                $where .= "'{$value['body_id']}' ,";
            }
            if (strlen($where) > 1) {
                $where = substr($where, 0, strlen($where) - 1);
                $selectDetail = $modelDetail->where("body_id in ($where)")->findAll();
                if (count($selectDetail) > 0) {
                    $selectDetail = $this->lowerKey($selectDetail);
                }
            }
        }
        $data['handover'] = $select;
        $data['handoverDetail'] = $selectDetail;

        return json_encode($data);
    }
    public function saveHandover()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        $orgModel = new OrganizationunitModel();
        $org = $this->lowerKeyOne($orgModel->first());

        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $body['modified_by'] = user()->username;
        $body['org_unit_code'] = $org['org_unit_code'];
        $clinic_id = $body['clinic_id'];
        $body_id = $body['body_id'];
        $handover_by = $body['handover_by'];
        $handover_date = $body['handover_date'];
        $handover_sign = $body['handover_sign'];
        $received_by = $body['received_by'];
        $received_date = $body['received_date'];
        $received_sign = $body['received_sign'];
        $clinic_id = $body['clinic_id'];
        $class_room_id = $body['class_room_id'];
        $data = $body['data'];


        $model = new HandoverModel();
        $model->save($body);

        $array = [];

        foreach ($data as $key => $value) {
            $array[] = [
                "org_unit_code" => $org['org_unit_code'],
                "body_id" => $body_id,
                "visit_id" => $value,
                "modified_by" => user()->username
            ];
        }

        $modelDetail = new HandoverDetailModel();
        $modelDetail->where("body_id", $body_id)->delete();
        $modelDetail->insertBatch($array);


        return json_encode($array);
    }
    public function gizi()
    {
        $db = db_connect();

        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];
        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5,6)")->findAll());
        // dd(user()->getEmployeeData());

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();


        $data_diet_type = $this->lowerKey($db->query("
        select * from diet_type
        ")->getResultArray() ?? []);


        $diet_type = [];

        $diet_type = array_column($data_diet_type, 'dtype_id');

        $data_diet_warning = $this->lowerKey($db->query("
        select * from diet_warning
        ")->getResultArray() ?? []);

        $diet_warning  = [];
        $diet_warning = array_column($data_diet_warning, 'diet_warning');

        $title = 'Gizi';
        return view('admin/patient/gizi', [
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_time,
            'clinic' => $clinic,
            'diet_type' => $diet_type,
            'diet_warning' => $diet_warning,
        ]);
        // $session = session();
        // $sessionData = ['gsPoli' => ''];
        // $session->set($sessionData);
        // $giTipe = 3;

        // $title = 'Gizi';

        // return $this->searchingTemplate($giTipe, $title);
    }
    public function pmkp()
    {
        $db = db_connect();

        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];
        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5,6)")->findAll());
        // dd(user()->getEmployeeData());
        $scheduleModel = new DoctorScheduleModel();
        $schedule = $this->lowerKey(
            $scheduleModel->join('employee_all ea', 'doctor_schedule.employee_id = ea.employee_id')
                ->join('clinic c', 'c.clinic_id = doctor_schedule.clinic_id')
                ->select("replace(fullname,'''','') as FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id")
                ->where('day_id is not null')
                // ->where('start_time > dateadd(day,-1,getdate())')
                ->where('START_TIME < GETDATE()')
                ->groupBy('FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id')
                ->orderBy('day_id')->findAll()
        );
        // echo '<pre>';
        // var_dump($schedule);
        // die();
        $dokter = array();

        foreach ($clinic as $key => $value) {
            $selectDokter = array();

            foreach ($schedule as $key1 => $value1) {
                if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
                    $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
                }
            }
            $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
            unset($selectDokter);
            if ($value['stype_id'] == '3') {
                $clinicInap[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
            }
        }

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $title = 'Peningkatan Mutu dan Keselamatan Pasien';
        return view('admin/patient/pmkp', [
            'title' => $title,
            'orgunit' => $orgunit,
            'img_time' => $img_time,
            'clinic' => $clinic,
            'dokter' => $dokter,
        ]);
    }
    public function users()
    {
        $db = db_connect();

        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];
        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5,6)")->findAll());
        // dd(user()->getEmployeeData());
        $scheduleModel = new DoctorScheduleModel();
        $schedule = $this->lowerKey(
            $scheduleModel->join('employee_all ea', 'doctor_schedule.employee_id = ea.employee_id')
                ->join('clinic c', 'c.clinic_id = doctor_schedule.clinic_id')
                ->select("replace(fullname,'''','') as FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id")
                ->where('day_id is not null')
                // ->where('start_time > dateadd(day,-1,getdate())')
                ->where('START_TIME < GETDATE()')
                ->groupBy('FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id')
                ->orderBy('day_id')->findAll()
        );

        $dokter = array();

        foreach ($clinic as $key => $value) {
            $selectDokter = array();

            foreach ($schedule as $key1 => $value1) {
                if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
                    $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
                }
            }
            $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
            unset($selectDokter);
            if ($value['stype_id'] == '3') {
                $clinicInap[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
            }
        }

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $title = 'Users Permissions';
        return view('admin/patient/users', [
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp
        ]);
    }
    public function getClinicDoctors()
    {
        $model = new ClinicDoctorModel();
        $select = $model->select("employee_id, clinic_id")->findAll();

        return $this->response->setJSON($select);
    }
    public function auth_group()
    {
        $db = db_connect();

        $org = new OrganizationunitModel();
        $orgunitAll = $org->findAll();
        $orgunit = $orgunitAll[0];
        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->where("stype_id in (1,2,3,5,6)")->findAll());
        // dd(user()->getEmployeeData());
        $scheduleModel = new DoctorScheduleModel();
        $schedule = $this->lowerKey(
            $scheduleModel->join('employee_all ea', 'doctor_schedule.employee_id = ea.employee_id')
                ->join('clinic c', 'c.clinic_id = doctor_schedule.clinic_id')
                ->select("replace(fullname,'''','') as FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id")
                ->where('day_id is not null')
                // ->where('start_time > dateadd(day,-1,getdate())')
                ->where('START_TIME < GETDATE()')
                ->groupBy('FULLNAME, ea.EMPLOYEE_ID, c.CLINIC_ID, c.NAME_OF_CLINIC, DAY_ID, ea.dpjp, ea.specialist_type_id')
                ->orderBy('day_id')->findAll()
        );

        $dokter = array();

        foreach ($clinic as $key => $value) {
            $selectDokter = array();

            foreach ($schedule as $key1 => $value1) {
                if ($clinic[$key]['clinic_id'] == $schedule[$key1]['clinic_id']) {
                    $selectDokter[$schedule[$key1]['employee_id']] = $schedule[$key1]['fullname'];
                }
            }
            $dokter[$clinic[$key]['clinic_id']] = $selectDokter;
            unset($selectDokter);
            if ($value['stype_id'] == '3') {
                $clinicInap[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
            }
        }

        $img_time = new Time('now');
        $img_timestamp = $img_time->getTimestamp();

        $title = 'Users Permissions';
        return view('admin/patient/auth_group', [
            'orgunit' => $orgunit,
            'img_time' => $img_timestamp
        ]);
    }
}
