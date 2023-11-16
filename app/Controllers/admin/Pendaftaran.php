<?php

namespace App\Controllers\Admin;

use App\Models\AgamaModel;
use App\Models\AssessmentModel;
use App\Models\BloodModel;
use App\Models\CaraKeluarModel;
use App\Models\ClassModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicDoctorModel;
use App\Models\ClinicModel;
use App\Models\CoverageModel;
use App\Models\DiagnosaCategoryModel;
use App\Models\DiagnosaModel;
use App\Models\DoctorScheduleModel;
use App\Models\EducationModel;
use App\Models\EklaimModel;
use App\Models\EmployeeAllModel;
use App\Models\ExaminationModel;
use App\Models\FamilyModel;
use App\Models\GenerateIdModel;
use App\Models\GoodsModel;
use App\Models\GrouperModel;
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
use CodeIgniter\I18n\Time;
use LZCompressor\LZString;

class Pendaftaran extends \App\Controllers\BaseController
{

    public function getSinglePV()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $visit = $body['visit'];

        $pv = new PasienVisitationModel();
        $result = $this->lowerKey($pv->find($visit));

        return json_encode($result);
    }
    public function getBedInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect('default');
        $builder = $db->query("  SELECT c.name_of_clinic,
                    CLASS_ROOM.name_of_class as classroomname,
                    cl.name_of_class,   
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
         CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) capasity,
                    ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) terisi,
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
         CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) - ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) sisa

      
                FROM CLASS_ROOM ,CLINIC C  ,CLASS CL
                WHERE CLASS_ROOM_ID <> '0' 
                and CLASS_ROOM.isactive LIKE '1'
                AND CL.CLASS_ID= CLASS_ROOM.CLASS_ID
                AND CAST(CL.OTHER_ID AS VARCHAR(10)) LIKE '%'
                AND ( CLASS_ROOM.CLINIC_ID LIKE '%' or  CLASS_ROOM.NAME_OF_CLASS like '%' or
                    C.NAME_OF_CLINIC like '%')   AND C.CLINIC_ID = CLASS_ROOM.CLINIC_ID
            ");
        $bedInfo = $builder->getResultArray();

        $data = [];
        foreach ($bedInfo as $key => $value) {
            $row = [];
            $row[] = $value["name_of_clinic"];
            $row[] = $value["classroomname"];
            $row[] = $value["name_of_class"];
            $row[] = $value["capasity"];
            $row[] = $value["sisa"];
            $row[] = '<button id="asd" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right">Pilih <i class="fas fa-angle-double-right"></i></button>';
            $data[] = $row;
        }

        return json_encode($data);
    }
    public function gethistoryrajaldatatable()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $pv = new PasienVisitationModel();


        $body = $this->request->getBody();
        $body = json_decode($body, true);


        $kode = $body['norm'];


        // return json_encode($nama);
        $kunjungan = $this->lowerKey($pv->where('no_registration', $kode)->orderBy('visit_date desc')->findAll());


        $statusPasienModel = new StatusPasienModel();
        $statusPasien = $this->lowerKey($statusPasienModel->findAll());


        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->findAll());

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->findAll());

        $classModel = new ClassModel();
        $class = $this->lowerKey($classModel->findAll());


        // dd($kunjungan);
        $dt_data     = array();
        if (!empty($kunjungan)) {
            foreach ($kunjungan as $key => $value) {

                foreach ($statusPasien as $key1 => $value1) {
                    if ($kunjungan[$key]['status_pasien_id'] == $statusPasien[$key1]['status_pasien_id']) {
                        $kunjungan[$key]['status_pasien_id'] = $statusPasien[$key1]['name_of_status_pasien'];
                    }
                }
                foreach ($clinic as $key1 => $value1) {
                    if ($kunjungan[$key]['clinic_id'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['clinic_id'] = $clinic[$key1]['name_of_clinic'];
                    }
                    if ($kunjungan[$key]['clinic_id_from'] == $clinic[$key1]['clinic_id']) {
                        $kunjungan[$key]['clinic_id_from'] = $clinic[$key1]['name_of_clinic'];
                    }
                }
                foreach ($employee as $key1 => $value1) {
                    if ($kunjungan[$key]['employee_id'] == $employee[$key1]['employee_id']) {
                        $kunjungan[$key]['employee_id'] = $employee[$key1]['fullname'];
                    }
                }
                foreach ($class as $key1 => $value1) {
                    if ($kunjungan[$key]['class_id'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['class_id'] = $class[$key1]['name_of_class'];
                    }
                    if ($kunjungan[$key]['class_id_plafond'] == $class[$key1]['class_id']) {
                        $kunjungan[$key]['class_id_plafond'] = $class[$key1]['name_of_class'];
                    }
                }
                if ($kunjungan[$key]['locked'] == '1') {
                    $kunjungan[$key]['locked'] == 'Valid Lock';
                } elseif ($kunjungan[$key]['locked'] == '2') {
                    $kunjungan[$key]['locked'] == 'Close';
                } elseif ($kunjungan[$key]['locked'] == '5') {
                    $kunjungan[$key]['locked'] == 'Close Billing';
                } else {
                    $kunjungan[$key]['locked'] == 'Open';
                }

                if (!is_null($kunjungan[$key]['rm_in_date'])) {
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


                // $action = "<a href='#' onclick='getpatientData(\"" . $id . "\")' class='btn btn-default btn-xs pull-right'  data-toggle='modal' title='" . lang('show') . "'><i class='fa fa-reorder'></i></a>";
                $pvJson = ($kunjungan[$key]);
                $action = '<button type="button" class="btn btn-primary waves-effect waves-light" onclick="nextFormRanap(\'' . $pvJson["visit_id"] . '\')">Pilih</button>';

                $row = array();
                $first_action = "<a target='_blank' href=" . base_url() . 'admin/patient/profile/' . $kunjungan[$key]['visit_id'] . " style='text-align: left !important'>";
                //==============================
                $row[] = $kunjungan[$key]['no_registration'];
                $row[] = $kunjungan[$key]['diantar_oleh'];
                $row[] = substr($kunjungan[$key]['visit_date'], 0, 10); // . "<br>" . $kunjungan[$key]['ageyear'] . "th " . $kunjungan[$key]['agemonth'] . "bl " . $kunjungan[$key]['ageday'] . "hr";
                $row[] = $kunjungan[$key]['status_pasien_id'];
                $row[] = "<b>" . $kunjungan[$key]['clinic_id'] . "</b><br><b>" . $kunjungan[$key]['employee_id'] . "</b>";
                $row[] = $kunjungan[$key]['no_skp'] . "<br>No. Rujukan : " . $kunjungan[$key]['norujukan'] . " Tgl : " . substr($kunjungan[$key]['tanggal_rujukan'], 0, 10);
                $row[] = $kunjungan[$key]['clinic_id_from'] . "<br>" . $kunjungan[$key]['class_id_plafond'] . "<br>" . $kunjungan[$key]['locked'];
                $row[] = $action;
                $dt_data[] = $row;
            }
        }
        // return 'json_encode($kunjungan)';
        $json_data = array(
            "data"            => $dt_data,
        );
        return json_encode($json_data);
    }
}
