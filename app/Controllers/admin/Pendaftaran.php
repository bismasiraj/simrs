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

        $employeeModel = new EmployeeAllModel();
        $employee = $this->lowerKey($employeeModel->getEmployee());


        $visit = $body['visit'];

        $pv = new PasienVisitationModel();
        $result = $this->lowerKey($pv->find($visit));

        foreach ($employee as $key2 => $value2) {
            if ($value2['employee_id'] == $result['employee_id']) {
                $result['fullname'] = $value2['fullname'];
            }
        }

        return json_encode($result);
    }
    public function getBangsalInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect('default');
        $builder = $db->query("  SELECT class_room.*, c.name_of_clinic,
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
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) sisa,
                    tt.tarif_id,
                    tt.amount_paid,
                    tt.tarif_name

      
                FROM CLASS_ROOM ,CLINIC C  ,CLASS CL, treat_tarif tt
                WHERE CLASS_ROOM_ID <> '0' 
                and CLASS_ROOM.isactive LIKE '1'
                AND CL.CLASS_ID= CLASS_ROOM.CLASS_ID
                AND CAST(CL.OTHER_ID AS VARCHAR(10)) LIKE '%'
                AND ( CLASS_ROOM.CLINIC_ID LIKE '%' or  CLASS_ROOM.NAME_OF_CLASS like '%' or
                    C.NAME_OF_CLINIC like '%')   AND C.CLINIC_ID = CLASS_ROOM.CLINIC_ID
                AND CLASS_ROOM.TARIF_ID = tt.TARIF_ID
            ");
        $bedInfo = $builder->getResultArray();
        $bedInfo = $this->lowerKey($bedInfo);

        $data = [];
        $i = 0;
        foreach ($bedInfo as $key => $value) {
            $bedJson = json_encode($value);
            $row = [];
            $row[] = $value["name_of_clinic"];
            $row[] = $value["classroomname"];
            $row[] = $value["name_of_class"];
            $row[] = $value["capasity"];
            $row[] = $value["sisa"];
            $row[] = '<button id="asd" onclick="pilihBed(\'bed' . $i . '\')" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"> <i class="fas fa-angle-double-right"></i></button><div style="display: none;" id="bed' . $i . '">' . $bedJson . '</div>';
            $data[] = $row;
            $i++;
        }
        $result = [];
        $result['data'] = $data;
        $result['classRoom'] = $bedInfo;

        return json_encode($result);
    }
    public function getBedInfo()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = db_connect('default');
        $builder = $db->query("SELECT BEDS.BED_ID,   
            BEDS.CLASS_ROOM_ID,   
            BEDS.ORG_UNIT_CODE  
        FROM BEDS  
        WHERE  
            BEDS.BED_ID not in  (SELECT BED_ID FROM treatment_akomodasi WHERE 
            CLASS_ROOM_ID = beds.CLASS_ROOM_ID and class_room_id is not null 
            -- AND KELUAR_ID in (0,35) 
            AND KELUAR_ID in (0) --new 30 jan 2020
            AND ORG_UNIT_CODE = beds.ORG_UNIT_CODE)   
            ");
        $bedInfo = $builder->getResultArray();
        $bedInfo = $this->lowerKey($bedInfo);


        return json_encode($bedInfo);
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

    public function postAddAkomodasi()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $body = $this->request->getBody();
        $body = json_decode($body, true);

        $class_room_id = $body['class_room_id'];
        $treat_date = $body['treat_date'];
        $exit_date = $body['exit_date'];
        $quantity = $body['quantity'];
        $measure_id = $body['measure_id'];
        $amount = $body['amount'];
        $amount_paid = $body['amount_paid'];
        $payment_date = $body['payment_date'];
        $islunas = $body['islunas'];
        $modified_from = $body['modified_from'];
        $iscetak = $body['iscetak'];
        $print_date = $body['print_date'];
        $employee_id = $body['employee_id'];
        $doctor = $body['doctor'];
        $employee_id_from = $body['employee_id_from'];
        $doctor_from = $body['doctor_from'];
        $visit_id = $body['visit_id'];
        $no_registration = $body['no_registration'];
        $bill_id = $body['bill_id'];
        $subsidi = $body['subsidi'];
        $org_unit_code = $body['org_unit_code'];
        $clinic_id = $body['clinic_id'];
        $treatment = $body['treatment'];
        $description = $body['description'];
        $tarif_id = $body['tarif_id'];
        $bed_id = $body['bed_id'];
        $keluar_id = $body['keluar_id'];
        $nota_no = $body['nota_no'];
        $clinic_id_from = $body['clinic_id_from'];
        $sold_status = $body['sold_status'];
        $status_pasien_id = $body['status_pasien_id'];
        $thename = $body['thename'];
        $theaddress = $body['theaddress'];
        $theid = $body['theid'];
        $class_id = $body['class_id'];
        $class_id_plafond = $body['class_id_plafond'];
        $amount_plafond = $body['amount_plafond'];
        $treatment_plafond = $body['treatment_plafond'];
        $amount_paid_plafond = $body['amount_paid_plafond'];
        $pembulatan = $body['pembulatan'];
        $isrj = $body['isrj'];
        $payor_id = $body['payor_id'];
        $ageyear = $body['ageyear'];
        $agemonth = $body['agemonth'];
        $ageday = $body['ageday'];
        $gender = $body['gender'];
        $kal_id = $body['kal_id'];
        $discount = $body['discount'];
        $karyawan = $body['karyawan'];
        $account_id = $body['account_id'];
        $sell_price = $body['sell_price'];
        $diskon = $body['diskon'];
        $invoice_id = $body['invoice_id'];
        $tagihan = $body['tagihan'];
        $koreksi = $body['koreksi'];
        $potongan = $body['potongan'];
        $bayar = $body['bayar'];
        $retur = $body['retur'];
        $ppnvalue = $body['ppnvalue'];
        $tarif_type = $body['tarif_type'];
        $subsidisat = $body['subsidisat'];
        $printq = $body['printq'];
        $printed_by = $body['printed_by'];
        $clinic_type = $body['clinic_type'];
        $package_id = $body['package_id'];
        $module_id = $body['module_id'];
        $theorder = $body['theorder'];
        $cashier = $body['cashier'];
        $no_skpinap = $body['no_skpinap'];
        $pasien_id = $body['pasien_id'];
        $respon = $body['respon'];
        $mapping_sep = $body['mapping_sep'];
        $trans_id = $body['trans_id'];
        $sppkasir = $body['sppkasir'];
        $sppbill = $body['sppbill'];
        $spppoli = $body['spppoli'];

        if (is_null($bill_id) || strlen($bill_id) == 0) {
            $orgModel = new OrganizationunitModel();
            $bill_id = $orgModel->generateId();
        }

        if (is_null($nota_no) || strlen($nota_no) == 0) {
            $orgModel = new OrganizationunitModel();
            $nota_no = $orgModel->generateId();
        }

        $data = [
            'class_room_id' => $class_room_id,
            'treat_date' => $treat_date,
            'exit_date' => $exit_date,
            'quantity' => $quantity,
            'measure_id' => $measure_id,
            'amount' => $amount,
            'amount_paid' => $amount_paid,
            'payment_date' => $payment_date,
            'islunas' => $islunas,
            'modified_from' => $modified_from,
            'iscetak' => $iscetak,
            'print_date' => $print_date,
            'employee_id' => $employee_id,
            'doctor' => $doctor,
            'employee_id_from' => $employee_id_from,
            'doctor_from' => $doctor_from,
            'visit_id' => $visit_id,
            'no_registration' => $no_registration,
            'bill_id' => $bill_id,
            'subsidi' => $subsidi,
            'org_unit_code' => $org_unit_code,
            'clinic_id' => $clinic_id,
            'treatment' => $treatment,
            'description' => $description,
            'tarif_id' => $tarif_id,
            'bed_id' => $bed_id,
            'keluar_id' => $keluar_id,
            'nota_no' => $nota_no,
            'clinic_id_from' => $clinic_id_from,
            'sold_status' => $sold_status,
            'status_pasien_id' => $status_pasien_id,
            'thename' => $thename,
            'theaddress' => $theaddress,
            'theid' => $theid,
            'class_id' => $class_id,
            'class_id_plafond' => $class_id_plafond,
            'amount_plafond' => $amount_plafond,
            'treatment_plafond' => $treatment_plafond,
            'amount_paid_plafond' => $amount_paid_plafond,
            'pembulatan' => $pembulatan,
            'isrj' => $isrj,
            'payor_id' => $payor_id,
            'ageyear' => $ageyear,
            'agemonth' => $agemonth,
            'ageday' => $ageday,
            'gender' => $gender,
            'kal_id' => $kal_id,
            'discount' => $discount,
            'karyawan' => $karyawan,
            'account_id' => $account_id,
            'sell_price' => $sell_price,
            'diskon' => $diskon,
            'invoice_id' => $invoice_id,
            'tagihan' => $tagihan,
            'koreksi' => $koreksi,
            'potongan' => $potongan,
            'bayar' => $bayar,
            'retur' => $retur,
            'ppnvalue' => $ppnvalue,
            'tarif_type' => $tarif_type,
            'subsidisat' => $subsidisat,
            'printq' => $printq,
            'printed_by' => $printed_by,
            'clinic_type' => $clinic_type,
            'package_id' => $package_id,
            'module_id' => $module_id,
            'theorder' => $theorder,
            'cashier' => $cashier,
            'no_skpinap' => $no_skpinap,
            'pasien_id' => $pasien_id,
            'respon' => $respon,
            'mapping_sep' => $mapping_sep,
            'trans_id' => $trans_id,
            'sppkasir' => $sppkasir,
            'sppbill' => $sppbill,
            'spppoli' => $spppoli,
        ];

        $taModel = new TreatmentAkomodasiModel();
        $taModel->save($data);

        return ($data);
    }
}
