<?php

namespace App\Controllers\Admin\reklaim;

use App\Controllers\BaseController;
use App\Models\BabyModel;
use App\Models\ExaminationDetailModel;
use App\Models\FisioterapiDetailModel;
use App\Models\FisioterapiModel;
use App\Models\FisioterapiScheduleModel;
use App\Models\PasienVisitationModel;

class CetakReklaim extends \App\Controllers\BaseController
{
    public function getPvHeader($visit_id)
    {
        $model = new PasienVisitationModel();
        $pv = $model->where("visit_id", $visit_id)->first();
        $visit = $this->lowerKeyOne($pv);
        $db = db_connect();
        $classPlafond = $db->query("select name_of_class from class where class_id = '" . $visit['class_id_plafond'] . "'")->getFirstRow("array");
        $class = $db->query("select name_of_class from class where class_id = '" . $visit['class_id'] . "'")->getFirstRow("array");
        $gender = $this->getGender();
        $visit['gendername'] = '';
        foreach ($gender as $key => $value) {
            if ($gender[$key]['gender'] == $visit['gender']) {
                $visit['gendername'] = $gender[$key]['name_of_gender'];
            }
        }
        $visit['name_of_class_plafond'] = $classPlafond['name_of_class'];
        $visit['name_of_class'] = $class['name_of_class'];
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['visit_datetime'] = $visit['visit_date'];
        $visit['age'] = $visit['ageyear'] . "th " . $visit['agemonth'] . "bl " . $visit['ageday'] . "hr";

        return $visit;
    }
    public function validateReport()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();

        $check = $this->lowerKey($db->query("SELECT isnull(no_skpinap,no_skp) as no_sep, VISIT_ID from 
                      PASIEN_VISITATION where visit_id = '" . $formData->visit_id . "'  ")
            ->getRowArray() ?? []);

        $nosep = isset($check) && !empty($check) ? $check['no_sep'] : "";

        if (!empty($nosep)) {
            $result = true;
        } else {
            $result = false;
        }

        return $this->response->setJSON([
            'message' => 'Validation Result',
            'respon' => $result,
            'value' => ['data' => $check]
        ]);
    }

    public function showImage($filename)
    {
        $filePath = '\\\\192.168.110.241\\Users\\Public\\Pictures\\' . $filename;

        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404)->setBody('File not found.');
        }

        $mimeType = mime_content_type($filePath);
        return $this->response->setHeader('Content-Type', $mimeType)->setBody(file_get_contents($filePath));
    }


    public function cetakAllGrouping($visit)
    {
        if ($this->request->is('get')) {
            $db = db_connect();

            $decoded_visit = $this->decodeVisit($visit);
            $type = $this->request->getGet('type');
            $view = $this->request->getGet('result');
            $startLab = $this->request->getGet('start');
            $endLab = $this->request->getGet('end');
            $filterObat = $this->request->getGet('obat');
            $resultFilter = $this->request->getGet('data');

            $kopprintData = $this->getKopprintDataE($db);

            $hasilResultRad = [];
            $radiologi = [];
            $queryTreatmenBill = [];
            $queryValidatorTreatmenBill = [];

            $queryTreatmenBillResep = [];
            $kirimlisData = [];
            $laboratorium = [];
            $visitation = [];
            $resumeMediis = [];
            $resume_medisSS = [];
            $ats = [];

            $cetaksuratKetDiagE = [];

            $skdp = [];
            $cetakPerintahInapE = [];

            $cetakSepAll = [];
            $cppt = [];
            $treatname = [];
            $anotomiandPato = [];
            $igdTriase = [];
            $persalinan = [];
            $oprasi = [];
            $anestesi = [];
            $fisio = [];
            $tbc = [];
            $fileLaborat = [];
            $penmedis = [];
            $radFile = [];
            if ($view === "RIF") {
                if ($type === null) {
                    // Fetch all data
                    $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
                    $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                    $radFile = $this->getRadiologiFileData($db, $hasilResultRad);
                    $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                    $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                    // $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id']);

                    $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                    $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                    $fileLaborat = $this->renderFileLaborat($decoded_visit);

                    $penmedis = $this->cetakPenMedis($decoded_visit);

                    // dd($laboratorium);
                    $visitation = $this->getVisitationDataE($db, $decoded_visit['visit_id']);
                    $resumeMediis = $this->resume_medisE($decoded_visit);
                    $resume_medisSS = $this->resume_medisSS($decoded_visit);

                    $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit);

                    $skdp = $this->cetakskdpE($db, $decoded_visit);
                    $cetakPerintahInapE = $this->cetakPerintahInapE($decoded_visit);
                    $fisio = $this->cetakFisio($db, $decoded_visit);

                    $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit);
                    $treatname = $this->tratnameE($db);
                    $anotomiandPato = $this->patomiandanaE($decoded_visit['visit_id']);
                    $igdTriase = $this->igdTriaseE($decoded_visit['visit_id'], $decoded_visit['session_id']);
                    $persalinan = $this->persalinanE($visit);
                    $oprasi = $this->operasiE($visit);
                    $anestesi = $this->anesthesiE($visit);
                    $fisio = $this->fisioE($visit);
                    $tbc = $this->cetaktbc($decoded_visit);
                    $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], null, null, $decoded_visit['no_registration']);
                } else {

                    if ($type === "SEP") {
                        $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep

                    }

                    if ($type === "SRI") {
                        $cetakPerintahInapE = $this->cetakPerintahInapE($decoded_visit);
                    }
                    if ($type === "SKD")
                        $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit); //spri

                    if ($type === "TRIASE") {
                        $resumeMediis = $this->resume_medisE($decoded_visit);
                    }

                    if ($type === "ResumeMedis") {
                        $resume_medisSS = $this->resume_medisSS($decoded_visit);
                    }

                    if ($type === "Persalinan") {
                        $persalinan = $this->persalinanE($visit);
                    }


                    if ($type === "OPRS") {
                        $oprasi = $this->operasiE($visit);
                    }
                    if ($type === "FISIO1") {
                        $fisio = $this->cetakFisio($db, $decoded_visit);
                    }
                    if ($type === "FISIO2") {
                        $fisio = $this->cetakFisio($db, $decoded_visit);
                    }
                    if ($type === "FISIO3") {
                        $fisio = $this->cetakFisio($db, $decoded_visit);
                    }

                    if ($type === "Anestesi") {
                        $anestesi = $this->anesthesiE($visit);
                    }

                    if ($type === "TBC") {
                        $tbc = $this->cetaktbc($decoded_visit);
                    }

                    if ($type === "PNJG") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
                        $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                        $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                        $fileLaborat = $this->renderFileLaborat($decoded_visit);
                        $penmedis = $this->cetakPenMedis($decoded_visit);
                        $radFile = $this->getRadiologiFileData($db, $hasilResultRad);
                    }
                    if ($type === "LAB") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                        $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                    }


                    if ($type === "INV") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-inv.php");
                    }


                    if ($type === "REK") {
                        $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], null, null, $decoded_visit['no_registration']);
                        //     $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, 
                        //     // $decoded_visit['visit_id']
                        //     '202504060728310260FA6'
                        //     , null, null, 
                        //     '087860'
                        //     // $decoded_visit['no_registration']
                        // );
                    }
                }
            } else if ($view === "RJF") {

                if ($type === null) {
                    $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep
                    $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit);
                    $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
                    $skdp = $this->cetakskdpE($db, $decoded_visit);
                    $resumeMediis = $this->resume_medisE($decoded_visit);
                    $cppt = $this->cetakCppt($db, $decoded_visit);
                    $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                    $radFile = $this->getRadiologiFileData($db, $hasilResultRad);
                    $fisio = $this->cetakFisio($db, $decoded_visit);
                    $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                    $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                    $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                    $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter);
                    $fileLaborat = $this->renderFileLaborat($decoded_visit);
                    $penmedis = $this->cetakPenMedis($decoded_visit);


                    $tbc = $this->cetaktbc($decoded_visit);
                    $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], null, null, $decoded_visit['no_registration']);
                } else {
                    if ($type === "SEP") {
                        $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep
                    }
                    if ($type === "TRIASE") {
                        $resumeMediis = $this->resume_medisE($decoded_visit);
                    }
                    if ($type === "SRK") {
                        $skdp = $this->cetakskdpE($db, $decoded_visit);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-kontrol1.php");
                    }
                    if ($type === "CPPT") {
                        $cppt = $this->cetakCppt($db, $decoded_visit);
                        // dd($cppt);
                    }
                    if ($type === "SRI") {
                        $cetakPerintahInapE = $this->cetakPerintahInapE($decoded_visit);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
                    }
                    if ($type === "SKD") {
                        $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit); //spri
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-diag.php");
                    }

                    if ($type === "CPPT") {
                        $cppt = $this->cetakCppt($db, $decoded_visit); //spri
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-diag.php");
                    }
                    if ($type === "PNJG") {
                        $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
                        $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                        $radFile = $this->getRadiologiFileData($db, $hasilResultRad);
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                        $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                        $fileLaborat = $this->renderFileLaborat($decoded_visit);
                        $penmedis = $this->cetakPenMedis($decoded_visit);
                    }
                    if ($type === "FISIO1") {
                        $fisio = $this->cetakFisio($db, $decoded_visit);
                    }
                    if ($type === "FISIO2") {
                        $fisio = $this->cetakFisio($db, $decoded_visit);
                    }
                    if ($type === "FISIO3") {
                        $fisio = $this->cetakFisio($db, $decoded_visit);
                    }

                    if ($type === "TBC") {
                        $tbc = $this->cetaktbc($decoded_visit);
                    }

                    if ($type === "LAB") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                        $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                    }

                    if ($type === "INV") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                    }
                    if ($type === "REK") {
                        $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], null, null, $decoded_visit['no_registration']);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
                    }
                }
            } else if ($view === "RJI") { //igd
                if ($type === null) {
                    $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep
                    $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit); //spri
                    $resumeMediis = $this->resume_medisE($decoded_visit);
                    $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
                    $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                    $radFile = $this->getRadiologiFileData($db, $hasilResultRad);
                    $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                    $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                    $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                    $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                    $fileLaborat = $this->renderFileLaborat($decoded_visit);
                    $penmedis = $this->cetakPenMedis($decoded_visit);


                    $fisio = $this->fisioE($visit);

                    $tbc = $this->cetaktbc($decoded_visit);
                    $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], null, null, $decoded_visit['no_registration']);
                } else {
                    if ($type === "SEP") {
                        $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep
                    }
                    if ($type === "SKD") {
                        $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit); //spri
                    }
                    if ($type === "ATS") {
                        $ats = $this->getTriage($decoded_visit);
                    }
                    if ($type === "TRIASE") {
                        $resumeMediis = $this->resume_medisE($decoded_visit);
                    }


                    if ($type === "TBC") {
                        $tbc = $this->cetaktbc($decoded_visit);
                    }


                    if ($type === "PNJG") {
                        $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']);
                        $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                        $radFile = $this->getRadiologiFileData($db, $hasilResultRad);
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                        $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                        $fisio = $this->fisioE($visit);
                        $fileLaborat = $this->renderFileLaborat($decoded_visit);
                        $penmedis = $this->cetakPenMedis($decoded_visit);
                    }
                    if ($type === "LAB") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                        $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                        $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter); // New function
                    }

                    if ($type === "REK") {
                        $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], null, null, $decoded_visit['no_registration']);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
                    }
                    if ($type === "INV") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], null, $decoded_visit['no_registration']);
                    }
                }
            } else if ($view === "KRON") { // kronis new 

                if ($type === null) {
                    $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep
                    $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], $view, $filterObat, $decoded_visit['no_registration']);
                    $cetaksuratKetDiagE = $this->cetaksuratKetDiagE($decoded_visit); //spri
                    $skdp = $this->cetakskdpE($db, $decoded_visit);
                    $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                    $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                    $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], $view, $decoded_visit['no_registration']);
                    $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
                    $laboratorium = $this->laboratorium_cetakKronisFilter($decoded_visit, $resultFilter);
                } else {
                    if ($type === "SEP") {
                        $cetakSepAll = $this->cetakSepAllE($db, $decoded_visit); //sep
                    }

                    if ($type === "SRK") {
                        $skdp = $this->cetakskdpE($db, $decoded_visit);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-kontrol1.php");
                    }
                    if ($type === "REK") {
                        $queryTreatmenBillResep = $this->getTreatmentBillResepE($db, $decoded_visit['visit_id'], $view, $filterObat, $decoded_visit['no_registration']);
                        // echo view("admin/patient/profilemodul/formrm/reklaim/cetak-klaim-ranap.php");
                    }
                    if ($type === "HPL") {
                        $laboratorium = $this->laboratorium_cetakKronisFilter($decoded_visit, $resultFilter);
                    }
                    if ($type === "HPR") {
                        $hasilResultRad = $this->getHasilResultRadE($db, $decoded_visit['visit_id']); // New function
                        $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
                    }

                    if ($type === "INV") {
                        $queryValidatorTreatmenBill = $this->getValidatorTreatmentBillE($db, $decoded_visit);
                        // dd("masuk");
                        $queryTreatmenBill = $this->getTreatmentBillE($db, $decoded_visit['trans_id'], $view, $decoded_visit['no_registration']);
                    }
                }
            } else if ($view === "Lab") {
                $laboratorium = $this->laboratorium_cetak_all($decoded_visit, $resultFilter);
            }

            // dd($fisio);
            // dd($resume_medisSS);
            $data = [
                "visit" => $decoded_visit,
                'radiologi_cetak' => $radiologi,
                'lab' => $laboratorium,
                'kop' => $kopprintData,
                'treatment_bill' => $queryTreatmenBill,
                'valid_bill' => $queryValidatorTreatmenBill,
                'resep' => $queryTreatmenBillResep,
                'resumeMedis' => $resumeMediis,
                'resumeMediss' => $resume_medisSS,
                'sketdiag' => $cetaksuratKetDiagE,
                'sep' => $cetakSepAll,
                'get_treat' => $treatname,
                'skdp' => $skdp,
                'type' => $type,
                'anotomi' => $anotomiandPato,
                'triaseIgd' => $igdTriase,
                'persalinan' => $persalinan,
                'oprasi' => $oprasi,
                'anestesi' => $anestesi,
                'ats' => $ats,
                'fisio' => $fisio,
                'view' => $view,
                'pplg' => $cetakPerintahInapE,
                'tbc' => $tbc,
                'filelab' => $fileLaborat,
                'penMedis' => $penmedis,
                'radFiles' => $radFile,
                'cppt' => $cppt
            ];

            return view("admin/patient/profilemodul/formrm/reklaim/cetak-all-data.php", $data);
            // if($view === "RIF")
            // elseif ($view === "RJF") {
            //     return view("admin/patient/profilemodul/formrm/reklaim/cetak-all-poli.php", $data);
            // }elseif ($view === "RJI") {
            //         return view("admin/patient/profilemodul/formrm/reklaim/cetak-all-igd.php", $data);
            // }else{
            //     return view("admin/patient/profilemodul/formrm/reklaim/cetak-all.php", $data);

            // }

            // return $this->response->setJSON($data);
        }
    }

    private function getKopprintDataE($db)
    {
        return $this->lowerKey(
            $db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array')
        );
    }
    private function getTriage($visit)
    {
        if (!is_array($visit) || !isset($visit['visit_id'])) {
            return json_encode(['error' => 'Invalid visit data']);
        }

        $visitId = $visit['visit_id'];
        $db      = db_connect();

        $triage = $this->lowerKey(
            $db->query(
                "SELECT *
                FROM assessment_indicator
                WHERE visit_id = ?
                AND p_type IN (
                    SELECT p_type
                    FROM assessment_parameter_type
                    WHERE parent_id IN ('004','010')
                )",
                [$visitId]
            )->getResultArray()
        );

        if (empty($triage)) {
            return json_encode(['error' => 'No triage data found']);
        }

        $pTypes      = array_unique(array_column($triage, 'p_type'));   // ex: ['TRA0001','TRA0002']
        $pTypeInSql  = "'" . implode("','", $pTypes) . "'";

        if (!in_array('GEN0008', $pTypes)) $pTypeInSql .= ",'GEN0008'";

        $aParent = $this->lowerKey(
            $db->query(
                "SELECT *
                FROM assessment_parameter_parent
                WHERE parent_id IN ('004','010')"
            )->getResultArray()
        );

        $aType = $this->lowerKey(
            $db->query(
                "SELECT *
                FROM assessment_parameter_type
                WHERE p_type IN ($pTypeInSql)"
            )->getResultArray()
        );

        $aParameter = $this->lowerKey(
            $db->query(
                "SELECT *
                FROM assessment_parameter
                WHERE p_type IN ($pTypeInSql)"
            )->getResultArray()
        );

        $aValue = $this->lowerKey(
            $db->query(
                "SELECT *
                FROM assessment_parameter_value
                WHERE p_type IN ($pTypeInSql,'GEN0007')"
            )->getResultArray()
        );

        $bodyIds         = array_map(fn($t) => "'" . $t['body_id'] . "'", $triage);
        $triageDetilRaw  = $this->lowerKey(
            $db->query(
                "SELECT *
                FROM assessment_triase_detail
                WHERE body_id IN (" . implode(',', $bodyIds) . ")"
            )->getResultArray()
        );

        $detilByBody = [];
        foreach ($triageDetilRaw as $d) {
            $detilByBody[$d['body_id']][] = $d;
        }

        $triageWithDetil = array_map(function ($t) use ($detilByBody) {
            $t['detail'] = $detilByBody[$t['body_id']] ?? [];
            return $t;
        }, $triage);

        return json_encode([
            'triage'      => $triageWithDetil,
            'aType'       => $aType,
            'aParameter'  => $aParameter,
            'aValue'      => $aValue,
            'aParent'     => $aParent
        ]);
    }



    private function getHasilResultRadE($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query("SELECT * FROM TREAT_RESULTS WHERE VISIT_ID = ?", [$visit_id])->getResultArray()
        );
    }

    private function getRadiologiDataE($db, $hasilResultRad)
    {
        $resultIds = array_column($hasilResultRad, 'result_id');
        if (empty($resultIds)) {
            return [];
        }

        $resultIdsString = implode("','", $resultIds);
        $radiologiData = $this->lowerKey(
            $db->query(
                "SELECT TREAT_RESULTS.ORG_UNIT_CODE, TREAT_RESULTS.RESULT_ID, TREAT_RESULTS.VISIT_ID, TREAT_RESULTS.NO_REGISTRATION, 
                    TREAT_RESULTS.TARIF_ID, TREAT_RESULTS.TARIF_NAME, TREAT_RESULTS.EMPLOYEE_ID, TREAT_RESULTS.EMPLOYEE_ID_FROM,
                    TB.treat_date as pickup_date , TREAT_RESULTS.RESULT_VALUE, TREAT_RESULTS.THENAME, TREAT_RESULTS.THEADDRESS, 
                    TREAT_RESULTS.AGEYEAR, TREAT_RESULTS.AGEMONTH, TREAT_RESULTS.AGEDAY, TB.nota_no, TREAT_RESULTS.GENDER, 
                    TREAT_RESULTS.KAL_ID, TREAT_RESULTS.BOUND_ID, TREAT_RESULTS.MEASURE_ID, TB.DOCTOR_FROM, TREAT_RESULTS.DOCTOR, 
                    TREAT_RESULTS.EMPLOYEE_ID, C.NAME_OF_CLINIC, TREAT_RESULTS.PRINT_DATE, TREAT_RESULTS.PRINTED_BY, 
                    TREAT_RESULTS.PRINTQ, TREAT_RESULTS.description, TREAT_RESULTS.CONCLUSION, TREAT_RESULTS.THEID, 
                    TREAT_RESULTS.NOSEP, TREAT_RESULTS.isvalid, TREAT_RESULTS.valid_date, TREAT_RESULTS.iskritis, 
                    TB.DIAGNOSA_DESC, TB.INDICATION_DESC 
                FROM TREAT_RESULTS 
                INNER JOIN TREATMENT_BILL TB ON TREAT_RESULTS.BILL_ID = TB.BILL_ID 
                INNER JOIN clinic c ON c.clinic_id = tb.clinic_id_from 
                WHERE TREAT_RESULTS.RESULT_ID IN ('$resultIdsString') 
                  AND TREAT_RESULTS.CLINIC_ID = 'P016' 
                ORDER BY TREAT_RESULTS.REAGENT_ID, TREAT_RESULTS.BOUND_ID"
            )->getResultArray()
        );

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        $ttdDir = $this->imageloc . "uploads/dokter/";

        foreach ($radiologiData as &$row) {
            $ttdBase64 = null;
            $employeeId = $row['employee_id'] ?? '';

            if (!empty($employeeId)) {
                foreach ($allowedExtensions as $ext) {
                    $filePath = $ttdDir . $employeeId . '.' . $ext;
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }
            $namaDokter = $this->lowerKey(
                $db->query("SELECT FULLNAME FROM EMPLOYEE_ALL WHERE EMPLOYEE_ID = '$employeeId'")
                    ->getRow()
            );
            $row['ttd_dok_name'] = $namaDokter['fullname'] ?? '';

            $row['ttd_dok'] = $ttdBase64;
        }

        return $radiologiData;
    }



    private function getRadiologiFileData($db, $hasilResultRad)
    {
        $resultIds = array_column($hasilResultRad, 'result_id');
        if (empty($resultIds)) {
            return [];
        }

        $resultIdsString = implode("','", array_map('addslashes', $resultIds));

        $results = $this->lowerKey(
            $db->query("
              SELECT 
                    TR.RESULT_ID, TR.VISIT_ID, TR.NO_REGISTRATION, TR.TARIF_ID, TR.TARIF_NAME, 
                   TR.PICKUP_DATE, TR.RESULT_VALUE, TR.THENAME, 
                    TR.nota_no, TR.GENDER, 
                   TR.DOCTOR, C.NAME_OF_CLINIC,  TR.description, 
                    TR.CONCLUSION, TR.THEID, TR.NOSEP,
                    TB.DIAGNOSA_DESC, TB.INDICATION_DESC, TB.BILL_ID, TR.CLINIC_ID,
					TR.treat_image, TR.file_a, TR.file_b, TR.file_c, TR.file_d
                FROM TREAT_RESULTS TR
                INNER JOIN TREATMENT_BILL TB ON TR.BILL_ID = TB.BILL_ID
                JOIN CLINIC C ON TR.CLINIC_ID = C.CLINIC_ID
                WHERE TR.RESULT_ID IN ('$resultIdsString')
                  AND TR.CLINIC_ID = 'P016'
                ORDER BY TR.REAGENT_ID, TR.BOUND_ID
            ")->getResultArray()
        );

        $finalData = [];

        foreach ($results as $result) {
            $relativePath = !empty($result['treat_image']) ? strstr($result['treat_image'], 'uploads') : '';
            $result['treat_image'] = $relativePath ? $this->convertToBase64($relativePath) : '';
            $result['file_a'] = !empty($result['file_a']) ? $this->convertToBase64($result['file_a']) : '';
            $result['file_b'] = !empty($result['file_b']) ? $this->convertToBase64($result['file_b']) : '';
            $result['file_c'] = !empty($result['file_c']) ? $this->convertToBase64($result['file_c']) : '';
            $result['file_d'] = !empty($result['file_d']) ? $this->convertToBase64($result['file_d']) : '';

            $finalData[] = [
                'result' => $result,
            ];
        }

        // foreach ($treatments as $row) {
        //     $bill_id = $row['bill_id'];
        //     $clinic_id = $row['clinic_id'];

        //     $result = $this->lowerKey(
        //         $db->query("
        //             SELECT 
        //                 result_value, conclusion, specimen_id, result_id, treat_image, isvalid, iskritis, tarif_name, diagnosa_desc, indication_desc, doctor, 
        //                 file_a, file_b, file_c, file_d
        //             FROM TREAT_RESULTS
        //             WHERE BILL_ID = :bill_id: AND CLINIC_ID = :clinic_id:
        //               AND BILL_ID IN (SELECT BILL_ID FROM TREATMENT_BILL)
        //         ", ['bill_id' => $bill_id, 'clinic_id' => $clinic_id])->getRowArray()
        //     );

        //     if (!empty($result)) {
        //         $relativePath = !empty($result['treat_image']) ? strstr($result['treat_image'], 'uploads') : '';
        //         $result['treat_image'] = $relativePath ? $this->convertToBase64($relativePath) : '';
        //         $result['file_a'] = !empty($result['file_a']) ? $this->convertToBase64($result['file_a']) : '';
        //         $result['file_b'] = !empty($result['file_b']) ? $this->convertToBase64($result['file_b']) : '';
        //         $result['file_c'] = !empty($result['file_c']) ? $this->convertToBase64($result['file_c']) : '';
        //         $result['file_d'] = !empty($result['file_d']) ? $this->convertToBase64($result['file_d']) : '';

        //         $finalData[] = [
        //             'bill'   => $row,
        //             'result' => $result,
        //         ];
        //     }
        // }

        return [
            'data'   => $finalData,
            'respon' => true
        ];
    }
    private function cetakFisio($db, $formData)
    {

        // $formData['visit_id'] = '2024052721452002230C3';
        $model = new FisioterapiModel();
        $modelSchedule = new FisioterapiScheduleModel();
        $modelDetail = new FisioterapiDetailModel();

        $data = $this->lowerKey(
            $model->where('visit_id', $formData['visit_id'])
                ->orderBy('vactination_date', 'DESC')
                ->findAll()
        );

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        $ttdDir = $this->imageloc . "uploads/dokter/";
        $ttdDirPasien = $this->imageloc . "uploads/signatures/";

        foreach ($data as &$pasien1) {
            $ttdBase64 = null;
            $ttdBase64Pasien = null;

            $employeeId = $pasien1['employee_id'] ?? null;
            $no_rmId = $pasien1['no_registration'] ?? null;

            if (!empty($employeeId)) {
                foreach ($allowedExtensions as $ext) {
                    $filePath = $ttdDir . $employeeId . '.' . $ext;
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }

            if (!empty($no_rmId)) {
                foreach ($allowedExtensions as $extPasien) {
                    $pattern = $ttdDirPasien . $no_rmId . '*.' . $extPasien;
                    $files = glob($pattern);

                    if (!empty($files)) {
                        $filePathPasien = $files[0];
                        if (file_exists($filePathPasien)) {
                            $fileDataPasien = file_get_contents($filePathPasien);
                            $mimeTypePasien = mime_content_type($filePathPasien);
                            $ttdBase64Pasien = 'data:' . $mimeTypePasien . ';base64,' . base64_encode($fileDataPasien);
                            break;
                        }
                    }
                }
            }

            $pasien1['ttd_dok'] = $ttdBase64;
            $pasien1['ttd_pasien'] = $ttdBase64Pasien;
        }
        unset($pasien1);



        $dataSchedule = [];
        foreach ($data as $key => $row) {
            $dataSchedule[$row['vactination_id']] = $this->lowerKey($modelSchedule
                ->where('visit_id', $formData['visit_id'])
                ->where('document_id', $row['vactination_id'])
                ->orderBy('start_date', 'ASC')
                ->orderBy('treatment_program', 'ASC')
                ->findAll() ?? []);
        } // baru havin 26 09

        $dataDetail = $this->lowerKey(
            $modelDetail->where('visit_id', $formData['visit_id'])
                ->orderBy('vactination_date', 'DESC')
                ->findAll()
        );

        $diagnosa = $this->lowerKey($db->query("SELECT 
                                         pd.VISIT_ID, 
                                            pd.ANAMNASE,
                                            pds.DIAG_CAT, 
                                            d.NAME_OF_DIAGNOSA as diagnosa_name
                                    FROM PASIEN_DIAGNOSA pd
                                    LEFT JOIN PASIEN_DIAGNOSAS pds 
                                        ON pd.PASIEN_DIAGNOSA_ID = pds.PASIEN_DIAGNOSA_ID
                                    LEFT JOIN DIAGNOSA d
                                        ON pds.diagnosa_id = d.diagnosa_id
                                    WHERE     pds.diag_cat IN ('1', '17') 
                                        AND d.diagnosa_id = pds.DIAGNOSA_ID
                                    AND pd.visit_id = '" . $formData['visit_id'] . "'
                                ORDER BY pd.date_of_diagnosa DESC;
            ")->getResultArray());

        $clinic = $this->lowerKey($db->query("SELECT 
                                                c.NAME_OF_CLINIC, 
                                                pv.VISIT_ID,
                                                pv.clinic_id
                                            FROM CLINIC c
                                            JOIN PASIEN_VISITATION pv ON c.clinic_id = pv.clinic_id
                                            WHERE c.clinic_id = pv.clinic_id
                                            AND pv.visit_id = '" . $formData['visit_id'] . "'
                                        ")->getRowArray());
        $employee =  $this->lowerKey($db->query("SELECT FULLNAME,EMPLOYEE_ID FROM EMPLOYEE_ALL where OBJECT_CATEGORY_ID = '20' AND SPECIALIST_TYPE_ID is Not Null
                                            ")->getResultArray());



        $pain = $this->lowerKey($db->query("select * from ASSESSMENT_PAIN_DETAIL where visit_id = '" . $formData['visit_id'] . "' and parameter_id = '01'
            ")->getResultArray() ?? []);

        $pain = array_map(function ($item) {
            return $item['value_desc'];
        }, $pain);

        $pain = implode(", ", $pain);


        $kopprint = $this->lowerKey($db->query("SELECT * from ORGANIZATIONUNIT")->getRowArray());

        $success = !empty($data);

        return [
            'success' => $success,
            'value'   => [
                'fisioterapi' => $data,
                'diagnosa' => $diagnosa,
                'kop' => $kopprint,
                'fioterapi_detail' => $dataDetail,
                'fisioterapi_schedule' => $dataSchedule,
                'monitoring_nyeri' => $pain,
                'clinic_cover' => $clinic,
                'employee' => $employee
            ],
        ];
    }

    private function convertToBase64($imageName)
    {
        if (!empty($imageName)) {
            $imagePath = $this->imageloc . $imageName;
            if (file_exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                $mimeType = mime_content_type($imagePath);
                return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
            }
        }
        return null;
    }


    private function getTreatmentBillE($db, $visit_id, $view = null, $no_registration)
    {
        $extraCondition = ($view !== null) ? "AND tb.NUMER = 2" : "";
        // $extraCondition = "";
        return $this->lowerKey(
            $db->query(
                "SELECT 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
                    tb.doctor,
                    tb.thename,
					tb.sell_price,
                    tb.CLINIC_ID,
					tb.QUANTITY * tb.sell_price as subtotal,
					tb.QUANTITY,
                    tt.TARIF_ID AS tarif_id_tt,
                    tt.ORG_UNIT_CODE AS org_unit_code_tt,
                    tt.TARIF_NAME AS tarif_name_tt,
                    cm.CASEMIX_ID,
                    cm.CASEMIX, 
                    tb.brand_id,
                    tb.description
                FROM 
                    TREATMENT_BILL tb
                JOIN 
                    TREAT_Tarif tt ON tb.ORG_UNIT_CODE = tt.ORG_UNIT_CODE 
                                AND tb.TARIF_ID = tt.TARIF_ID
                JOIN 
                    CASEMIX cm ON tt.CASEMIX_ID = cm.CASEMIX_ID
                WHERE 
                    tb.trans_id = ?
                    AND tb.no_registration = ?
                    AND tb.QUANTITY <> 0 AND (isnull(tb.status_pasien_id, '18') = '18' or isnull(tb.status_pasien_id, '18') = '0')
                    and quantity <> 0
                    and tb.no_registration not like 'x%'
                     $extraCondition
                GROUP BY 
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
					tb.QUANTITY,
                    tb.CLINIC_ID,
					tb.sell_price,
                    tb.doctor,
                    tb.thename,
                    tt.TARIF_ID,
                    tt.ORG_UNIT_CODE,
                    tt.TARIF_NAME,
                    cm.CASEMIX_ID,
                    cm.CASEMIX,
                    tb.brand_id,
                    tb.description",

                [$visit_id, $no_registration]
            )->getResultArray()
        );
    }

    private function getValidatorTreatmentBillE($db, $visit, $view = null)
    {
        $result = $this->lowerKey($db->query(
            "SELECT TOP 1 
                COALESCE(ea.fullname, LEFT(cashier, 6) + '*') + ' | ' + 
                CONVERT(VARCHAR(20), treat_date, 120) AS validUser, 
                ea.fullname,
                ea.employee_id
            FROM treatment_bayar 
            LEFT JOIN user_login ul ON cashier = username
            LEFT JOIN employee_all ea ON ea.employee_id = ul.employee_id
            WHERE trans_id = ? 
            and status_pasien_id = '18'
            AND no_registration = ? 
            ORDER BY treat_date DESC;",
            [$visit['trans_id'], $visit['no_registration']]
        )->getRowArray() ?? []);

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

        $ttdPasienBase64 = null;
        $ttdPasienDir = $this->imageloc . "uploads/signatures/";
        $noReg = $visit['no_registration'] ?? '';

        if (!empty($noReg)) {
            foreach ($allowedExtensions as $ext) {
                $pattern = $ttdPasienDir . '*' . $noReg . '*.' . $ext;
                $files = glob($pattern);
                if (!empty($files)) {
                    $filePath = $files[0];
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdPasienBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }
        }

        $ttdDokterBase64 = null;
        $ttdDokterDir = $this->imageloc . "uploads/dokter/";
        $employeeId = $result['employee_id'] ?? '';

        if (!empty($employeeId)) {
            foreach ($allowedExtensions as $ext) {
                $pattern = $ttdDokterDir . '*' . $employeeId . '*.' . $ext;
                $files = glob($pattern);
                if (!empty($files)) {
                    $filePath = $files[0];
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdDokterBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }
        }

        $result['ttd_pasien'] = $ttdPasienBase64;
        $result['ttd_dok'] = $ttdDokterBase64;

        return $result;
    }




    private function getTreatmentBillResepE($db, $visit_id, $view = null, $filter = null, $no_regis = null)
    {

        $query = "SELECT 
                    tb.resep_ke,
                    tb.VISIT_ID,
                    tb.TARIF_ID,
                    tb.ORG_UNIT_CODE,
                    tb.NO_REGISTRATION,
                    tb.BILL_ID,
                    tb.doctor,
                   tb.doctor_from,
                    tb.thename,
                    tb.resep_no,
                    tb.treatment,
                    tb.description,
                    tb.description2,
                    tb.QUANTITY,
                    FORMAT(tb.TREAT_DATE, 'dd-MM-yyyy HH:mm') AS TREAT_DATE
                FROM 
                    TREATMENT_OBAT tb
                WHERE 
                	  tb.QUANTITY <> 0 AND
                ";

        $params = [];
        if ($no_regis !== null) {
            $query .= " tb.NO_REGISTRATION = ? ";
            $params[] = $no_regis;
        }
        if ($visit_id !== null) {
            $query .= "AND tb.VISIT_ID = ? ";
            $params[] = $visit_id;
        }

        if ($view !== null) {
            $query .= " AND tb.NUMER = 2";
        }

        if ($filter !== null && $filter !== "semua") {
            $query .= " AND tb.DESCRIPTION = ?";
            $params[] = $filter;
        }

        return $this->lowerKey($db->query($query, $params)->getResultArray());
    }


    private function getKirimlisDataE($db, $queryTreatmenBill)
    {
        $filteredBills = array_filter($queryTreatmenBill, function ($item) {
            return $item['clinic_id'] === "P013";
        });
        $billIds = array_column($filteredBills, 'bill_id');

        if (empty($billIds)) {
            return [];
        }

        $billIdString = implode("','", $billIds);

        return $this->lowerKey(
            $db->query(
                "SELECT kode, kode_kunjungan
                 FROM sharelis.dbo.kirimlis 
                 WHERE kode IN ('$billIdString')
                 GROUP BY kode, kode_kunjungan"
            )->getResultArray()
        );
    }

    private function getLaboratoriumDataE($db, $kirimlisData, $decoded_visit, $start = null, $end = null)
    {

        $kode_kunjungan = array_column($kirimlisData, 'kode_kunjungan');
        $visit_date = $decoded_visit['visit_date'] ?? date('Y-m-d');

        $start = $start ?? null;
        $end = $end ?? null;

        if (empty($start) || empty($end)) {
            $start_date = date('Y-m-d', strtotime($visit_date)) . " 00:00:00";
            $end_date = date('Y-m-d H:i:s');
        } else {
            $start_date = date('Y-m-d', strtotime($start)) . " 00:00:01";
            $end_date = date('Y-m-d', strtotime($end)) . " 23:59:59";
        }
        // var_dump($end_date);

        if (empty($kode_kunjungan)) {
            return [];
        }

        $kode_kunjunganString = implode("','", $kode_kunjungan);
        $laboratSql = $this->lowerKey(
            $db->query(
                "SELECT 
                        H.nolab_lis, 
                        H.kode_kunjungan, 
                        H.tarif_id, 
                        H.tarif_name, 
                        H.kel_pemeriksaan, 
                        H.urut_bound, 
                        H.PARAMETER_NAME, 
                        H.hasil, 
                        H.satuan, 
                        H.NILAI_RUJUKAN, 
                        H.METODE_PERIKSA, 
                        NULL AS kode, 
                        H.reg_date AS tgl_hasil, 
                        H.norm, 
                        K.nama, 
                        K.alamat, 
                        K.date_of_birth, 
                        K.cara_bayar_name, 
                        K.pengirim_name, 
                        K.ruang_name, 
                        K.kelas_name, 
                        K.Tgl_Periksa, 
                        H.flag_hl,
                        K.diagnosa_desc,
                        k.indication_desc
                    FROM 
                        sharelis.dbo.hasillis H
                    LEFT OUTER JOIN 
                        sharelis.dbo.kirimlis K 
                        ON H.norm COLLATE database_default = K.no_pasien COLLATE database_default 
                        AND H.kode_kunjungan = K.Kode_Kunjungan
                    WHERE 
                        H.kode_kunjungan IN ('$kode_kunjunganString')
                        AND H.reg_date BETWEEN '$start_date' 
                        AND COALESCE('$end_date', GETDATE())
                    GROUP BY 
                        H.nolab_lis, 
                        H.kode_kunjungan, 
                        H.tarif_id, 
                        H.tarif_name, 
                        H.kel_pemeriksaan, 
                        H.urut_bound, 
                        H.PARAMETER_NAME, 
                        H.hasil, 
                        H.satuan, 
                        H.NILAI_RUJUKAN, 
                        H.METODE_PERIKSA, 
                        K.Tgl_Periksa, 
                        H.reg_date, 
                        H.norm, 
                        K.nama, 
                        K.alamat, 
                        K.date_of_birth, 
                        K.cara_bayar_name, 
                        K.pengirim_name, 
                        K.ruang_name, 
                        K.kelas_name, 
                        H.flag_hl,
                        K.diagnosa_desc,
                        k.indication_desc
                    ORDER BY 
                        H.kode_kunjungan;
                    "
            )->getResultArray()
        );


        $doctor = $this->lowerKey($db->query("SELECT fullname from EMPLOYEE_ALL where NONACTIVE= 0 and employee_id in (select employee_id from DOCTOR_SCHEDULE where clinic_id ='P013')")->getRowArray());
        $username_valid = $this->lowerKey($db->query("SELECT users.username,
                                            isnull(EMPLOYEE_ALL.fullname, users.username) as fullname
                                        FROM 
                                            USERS
                                        left outer JOIN 
                                            EMPLOYEE_ALL 
                                            ON USERS.employee_id = EMPLOYEE_ALL.employee_id
                                            WHERE users.username = '" . user()->username . "'  
                                            
                                ")->getRowArray());

        $datefollowup = $this->lowerKey($db->query("SELECT examination_date FROM PASIEN_TRANSFER where VISIT_ID = '" . $decoded_visit['visit_id'] . "' AND NO_REGISTRATION = '" . $decoded_visit['no_registration'] . "' 
        AND ISINTERNAL = 4  ORDER BY EXAMINATION_DATE DESC
                            ")->getRowArray());


        $visit = $decoded_visit;

        if ($username_valid) {
            $visit['valid_users_p'] = $username_valid['fullname'];
        }

        if ($doctor) {
            $visit['doctor_responsible'] = $doctor['fullname'];
        }

        if ($datefollowup) {
            $visit['tgl_follow_up'] = $datefollowup['examination_date'];
        }
        return ([
            'visit' => $visit,
            'data' => $laboratSql
        ]);
    }

    private function getVisitationDataE($db, $visit_id)
    {
        return $this->lowerKey(
            $db->query(
                "SELECT * FROM PASIEN_VISITATION WHERE VISIT_ID = ?",
                [$visit_id]
            )->getResultArray()
        );
    }

    private function resume_medisE($visit, $vactination_id = null, $title = "Asesmen Medis")
    {

        if ($this->request->is('get')) {
            // $visit = base64_decode($visit);
            // $visit = json_decode($visit, true);
            $db = db_connect();


            $id_diag = $db->query("SELECT pasien_diagnosa_id FROM PASIEN_DIAGNOSA WHERE VISIT_ID = '" . $visit['visit_id'] . "' and isrj = 1 ORDER BY date_of_diagnosa DESC")->getRowArray();
            $vactination_id = isset($id_diag['pasien_diagnosa_id']) ? $id_diag['pasien_diagnosa_id'] : "";

            // return json_encode($vactination_id);

            $specialist_type_id = $visit['specialist_type_id'];


            $select = $this->lowerKey($db->query("SELECT 
            pd.NO_REGISTRATION as no_RM,
            pd.valid_user,
            pd.valid_pasien,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            pd.DIAG_CAT,
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end as jeniskel,
            p.CONTACT_ADDRESS as alamat,
            pd.DOCTOR as dpjp,
            c.name_of_clinic as departmen,
            class.NAME_OF_CLASS as kelas,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID as bed,
            pd.IN_DATE as tanggal_masuk,
            convert(varchar,P.DATE_OF_BIRTH,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
            gcs.GCS_E,
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE as gcs,
            gcs.GCS_DESC,
            max(case when apv.PARAMETER_ID = '01' and apv.VALUE_SCORE = GCS_E then apv.VALUE_DESC else '' end ) as GSC_E_DESC,
            max(case when apv.PARAMETER_ID = '03' and apv.VALUE_SCORE = GCS_M then apv.VALUE_DESC else '' end ) as GSC_M_DESC,
            max(case when apv.PARAMETER_ID = '02' and apv.VALUE_SCORE = GCS_V then apv.VALUE_DESC else '' end ) as GSC_V_DESC,
            pd.DIAGNOSA_ID as icd10,
            pd.DIAGNOSA_DESC as namadiagnosa,
            case when pd.ANAMNASE = '' or pd.ANAMNASE is null then pd.ALLOANAMNASE else pd.ANAMNASE end as anamnesis,
            case when pd.ANAMNASE = '' or pd.ANAMNASE is null then 0 else 1 end as isautoanamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090201'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090101'  then histories else '' end ) as riwayat_penyakit_keluarga,
            max(case when PH.value_id = 'G0090301'  then histories else '' end ) as riwayat_alkohol,
            max(case when PH.value_id = 'G0090302'  then histories else '' end ) as riwayat_merokok,
            max(case when PH.value_id = 'G0090303'  then histories else '' end ) as riwayat_diet,
            max(case when PH.value_id = 'G0090401'  then histories else '' end ) as riwayat_obat_dikonsumsi,
            max(case when PH.value_id = 'G0090402'  then histories else '' end ) as riwayat_kehamilan,
            max(case when PH.value_id = 'G0090403'  then histories else '' end ) as riwayat_imunisasi,
            MAX(CASE WHEN EDU.INFORMATION_RECEIVER = '1' THEN 'Penerima Pasien' + ' materi edukasi : '   + edu.education_material
            else 'Kerabat Pasien dengan nama : ' + edu.family_name + ' materi edukasi : ' + edu.education_material  end ) as edukasi_pasien,
            igt.nama as tindaklanjut,
            pd.TGLKONTROL as tanggal_kontrol,   
            eid.WEIGHT as berat,
            eid.HEIGHT as tinggi,
            eid.TENSION_UPPER as tensi_atas,
            eid.TENSION_BELOW as tensi_bawah,
            eid.nadi,
            eid.TEMPERATURE AS Suhu,
            eid.NAFAS as respiration,
            eid.SATURASI AS SPO2,
            case when eid.height = 0 then 0 else
            EId.WEIGHT/ ( (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EID.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) end AS IMT,
            isnull((select top(1) case when P_TYPE = 'ASES019' then
                        case when TOTAL_SCORE >= 0 and TOTAL_SCORE <= 24 then 'Tidak Ada Resiko'
                        when TOTAL_SCORE >= 24 and TOTAL_SCORE <= 50 then 'Risiko Rendah' 
                        when TOTAL_SCORE > 50 then 'Risiko Tinggi'
                        else 'Tidak ada Risiko' end
                    else 
                    case
                        when TOTAL_SCORE >= 7 and TOTAL_SCORE <= 11 then 'Risiko Rendah' 
                        when TOTAL_SCORE > 11 then 'Risiko Tinggi'
                        else 'Tidak ada Risiko' end
                    end as fall_risk from ASSESSMENT_FALL_RISK
            where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID order by EXAMINATION_DATE desc) ,'Tidak ada Risiko') as FALL_SCORE,
            isnull((select top(1) '['+ cast(av.value_score as varchar(500)) +'] ' + av.VALUE_DESC  from ASSESSMENT_PAIN_MONITORING apm
                    inner join ASSESSMENT_PAIN_DETAIL apd on apm.BODY_ID = apd.BODY_ID
                    inner join ASSESSMENT_PARAMETER_VALUE  av on apd.VALUE_ID = av.VALUE_ID
                    where 
                    apd.PARAMETER_ID = '05' and
                    document_id = pd.pasien_diagnosa_id) ,'') as PAIN_SCORE,
            PD.DIAGNOSA_ID,
            PD.MEDICAL_PROBLEM AS MASALAH_MEDIS,
            'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
            PD.HURT AS PENYEBAB_CIDERA,
        
            pd.INSTRUCTION AS SASARAN,
            CASE 
                WHEN ei.pemeriksaan = '0' THEN 'Baik'
                WHEN ei.pemeriksaan = '1' THEN 'Sedang'
                WHEN ei.pemeriksaan = '2' THEN 'Buruk'
                ELSE 'Tidak Diketahui' 
            END AS keadaanumum,


            PD.INSTRUCTION AS PROSEDUR,
            PD.STANDING_ORDER AS STANDING_ORDER,
            PD.DOCTOR AS DOKTER,
            '' kontrol,
			 isnull((select top(1) case when total_score = 5 then 'ATS V' 
			 when total_score = 4 then 'ATS IV'
			 when total_score = 3 then 'ATS III'
			 when TOTAL_SCORE = 2 then 'ATS II'
			 when total_score = 1 then 'ATS I' end
			 from ASSESSMENT_indicator
            where DOCUMENT_ID = pd.pasien_diagnosa_id order by EXAMINATION_DATE desc) ,'') as ATS_Tipe,

			 ATS_ITEM = STUFF(
             (SELECT ',' + value_desc
              FROM ASSESSMENT_INDICATOR_DETAIL aid
			  WHERE aid.BODY_ID in (select BODY_ID from ASSESSMENT_INDICATOR 
					where DOCUMENT_ID = pd.pasien_diagnosa_id)
              FOR XML PATH (''))
             , 1, 1, '') ,
			max(  case when arp.PREGNANT = '1' then 'Hamil'
			  else 'Tidak Hamil' end ) as hamil,
			  max(arp.g) as hamil_G,
			   max(arp.p) as hamil_p,
			    max(arp.a) as hamil_a,
                st.specialist_type,
                pd.class_room_id,
                pd.isrj,
                pd.clinic_id,
                pd.visit_id,
                pd.specialist_type_id,
                pd.date_of_diagnosa

            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_INFO ei on ei.body_id = pd.BODY_ID
            left outer join EXAMINATION_DETAIL eid on eid.body_id = pd.BODY_ID
            left outer join (
					SELECT TOP 1 
						GCS_E, GCS_M, GCS_V, GCS_SCORE,gcs_desc ,DOCUMENT_ID ,P_TYPE
					FROM ASSESSMENT_GCS 
					WHERE DOCUMENT_ID = '$vactination_id'
					ORDER BY EXAMINATION_DATE DESC
				) AS gcs on pd.PASIEN_DIAGNOSA_ID = gcs.DOCUMENT_ID
            left outer join ASSESSMENT_EDUCATION_FORMULIR EDU on pd.PASIEN_DIAGNOSA_ID = EDU.DOCUMENT_ID
			left outer join INASIS_GET_TINDAKLANJUT igt on pd.RENCANATL = igt.KODE
			left outer join ASSESSMENT_REPRODUCTION arp on pd.PASIEN_DIAGNOSA_ID = arp.DOCUMENT_ID
            LEFT OUTER JOIN ASSESSMENT_PARAMETER_VALUE apv ON gcs.P_TYPE = apv.P_TYPE
            left outer join specialist_type st on st.specialist_type_id = pd.specialist_type_id
           , pasien p 
            where 
            pd.PASIEN_DIAGNOSA_ID = '$vactination_id'
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.alloanamnase,
            pd.DIAG_CAT,
            pd.NO_REGISTRATION, 
            p.NAME_OF_PASIEN, 
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end, 
            p.CONTACT_ADDRESS,
            pd.DOCTOR, 
            c.name_of_clinic, 
            class.NAME_OF_CLASS,  
            cr.NAME_OF_CLASS,  
            pd.BED_ID,  
            pd.IN_DATE,
            pd.ANAMNASE, 
            pd.DESCRIPTION,
            eid.WEIGHT,
            eid.HEIGHT, 
            eid.TENSION_UPPER, 
            eid.TENSION_BELOW, 
            eid.nadi,
            eid.NAFAS, 
            eid.SATURASI,
            eid.TEMPERATURE,
            convert(varchar,P.date_of_birth,105),
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR',
            gcs.GCS_E, 
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE, 
            gcs.GCS_DESC,
            igt.nama,
            pd.TGLKONTROL,
            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            EID.WEIGHT, 
            EID.HEIGHT,
            ei.INSTRUCTION,
             ei.pemeriksaan,
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR,
            pd.valid_user,
            pd.valid_pasien,
            st.specialist_type,
            pd.class_room_id,
            pd.isrj,
            pd.clinic_id,
            pd.visit_id,
            pd.specialist_type_id,
            pd.date_of_diagnosa")->getRow(0, "array"));
            if (!isset($select['visit_id'])) {
                return [];
            }

            foreach ($select as $key => $value) {
                if ($value == '') {
                    $select[$key] = null;
                }
            }
            $visit = $this->getPvHeader($select['visit_id']);
            $specialist_type_id = $select['specialist_type_id'];
            $visit['specialist_type_id'] = $specialist_type_id;
            $query = "SELECT  STUFF(
             (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
			  treatment_obat.body_id  = '$vactination_id' 
			  and DESCRIPTION <> '%jasa%' 
                group by description ,isnull(description2,'')
              FOR XML PATH (''))
             ,1, 2, '') terapi
			 from ORGANIZATIONUNIT ;";
            $farmako = $this->lowerKeyOne($db->query($query)->getResultArray());
            // return json_encode($query);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));

            $selectlokalis = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = ? and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = ? AND assessment_lokalis.VALUE_SCORE = 3
                order by mas.theorder",
                [$specialist_type_id, $vactination_id]
            )->getResultArray());

            $selectlokalis2 = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = ? and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = ? AND assessment_lokalis.VALUE_SCORE = 2
                order by mas.theorder",
                [$specialist_type_id, $vactination_id]
            )->getResultArray());



            $lab = $db->query("SELECT REPLACE(replace( STUFF(
                (SELECT ';' +  ' Pemeriksaan : ' + tr.treatment + '  '
                from TREATMENT_BILL tr where
                -- tr.TRANS_ID = 'trans_id'  and
                tr.VISIT_ID= ?  and
                tr.CLINIC_ID = 'P013' 	 
                order by tr.TREATMENT
                FOR XML PATH (''))
                , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksalab
                from ORGANIZATIONUNIT
            ", [$visit['visit_id']])->getRowArray();

            $rad = $db->query("SELECT REPLACE(replace( STUFF(
                (SELECT ';' +  ' Pemeriksaan : ' + tr.treatment + '  '
                from TREATMENT_BILL tr where
                -- tr.TRANS_ID = 'trans_id'  and
                tr.VISIT_ID= ?  and
                tr.CLINIC_ID = 'P016' 	 
                order by tr.TREATMENT
                FOR XML PATH (''))
                , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksarad
                from ORGANIZATIONUNIT
            ", [$visit['visit_id']])->getRowArray();

            $tindakLanjut = $this->lowerKey($db->query("SELECT 
                            CASE 
                                WHEN ISINTERNAL = 2 THEN 'DIRUJUK'
                                WHEN ISINTERNAL = 3 THEN 'DI RUJUK KE UNIT LAIN (KONSUL)'
                                WHEN ISINTERNAL = 4 THEN 'PERAWATAN JALAN (KONTROL)'
                                WHEN ISINTERNAL = 5 THEN 'RAWAT INAP'
                                WHEN ISINTERNAL = 10 THEN 'TRANSFER INTERNAL'
                                WHEN ISINTERNAL = 11 THEN 'Pengobatan Selesai'
                                ELSE ''
                            END AS tindak_lanjut
                        FROM PASIEN_TRANSFER
                        WHERE visit_id = ?
                        AND ISINTERNAL <> 11;", [$visit['visit_id']])->getRowArray());

            $farma = $db->query("SELECT STUFF(
                                    (SELECT CHAR(10) + description + 
                                            ' qty: ' + CAST(CAST(quantity AS INT) AS VARCHAR) + 
                                            ' ( ' + ISNULL(description2, '') + ' ) '  
                                    FROM treatment_obat 
                                    WHERE treatment_obat.visit_id = ? 
                                    AND DESCRIPTION NOT LIKE '%jasa%' 
                                    and sold_status in ('1','5','7')
                                    AND quantity > 0
                                    GROUP BY description, ISNULL(description2, ''), quantity
                                    FOR XML PATH (''))
                                    , 1, 2, ''
                                ) AS terapi
                                FROM ORGANIZATIONUNIT;

                        ", [$visit['visit_id']])->getRowArray();
            if ($specialist_type_id === "1.12") {
                $kulit = $db->query(
                    "SELECT top (1)  sd_ins_location,sd_ins_ukk,sd_ins_distribution,sd_ins_configuration,
                                sd_palpation,sd_others,sv_inspection,sv_palpation from ASSESSMENT_DERMATOVENEROLOGI where 
                                VISIT_ID =? order by EXAMINATION_DATE desc",
                    [$visit['visit_id']]
                )->getRowArray();
            } else if ($specialist_type_id === "1.16") {
                $saraf = $db->query(
                    "SELECT top (1) document_id,no_registration as no_reg_neuro,examination_date,
                                    vas_nrs,left_diameter,left_light_reflex,left_cornea,left_isokor_anisokor,
                                    right_diameter,right_light_reflex,right_cornea,right_isokor_anisokor,stiff_neck,
                                    meningeal_sign,brudzinki_i_iv,kernig_sign,dolls_eye_phenomenon,vertebra,extremity,
                                    motion_upper_left,motion_upper_right,motion_lower_left,motion_lower_right,strength_upper_left,
                                    strength_upper_right,strength_lower_left,strength_lower_right,physiological_reflex_upper_left,
                                    physiological_reflex_upper_right,physiological_reflex_lower_left,physiological_reflex_lower_right,
                                    pathologycal_reflex_upper_left,pathologycal_reflex_upper_right,pathologycal_reflex_lower_left,
                                    pathologycal_reflex_lower_right,clonus,sensibility FROM ASSESSMENT_NEUROLOGY where VISIT_ID = ? order by EXAMINATION_DATE desc",
                    [$visit['visit_id']]
                )->getRowArray();
            } else if ($specialist_type_id = "1.10") {
                $mata = $this->lowerKey($db->query(
                    "SELECT 
                        assessment_lokalis.*, 
                        ASSESSMENT_PARAMETER_VALUE.VALUE_DESC AS nama_lokalis 
                    FROM 
                        assessment_lokalis
                    INNER JOIN 
                        ASSESSMENT_PARAMETER_VALUE 
                    ON 
                        assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                    WHERE 
                        body_id = '$vactination_id' 
                        AND assessment_lokalis.VALUE_SCORE IN (4, 5)
                    ORDER BY 
                        assessment_lokalis.VALUE_SCORE ASC;"
                )->getResultArray());
            }


            if ($lab) {
                $select['laboratorium'] = $lab['periksalab'];
            }
            if ($rad) {
                $select['radiologi'] = $rad['periksarad'];
            }
            if ($farma) {
                $select['farmakologia'] = $farma['terapi'];
            }
            if ($tindakLanjut) {
                $select['rencana_tl'] = $tindakLanjut['tindak_lanjut'];
            }
            if (@$kulit) {
                $select['kulit'] = $kulit;
            }
            if (@$saraf) {
                $select['saraf'] = $saraf;
            }

            if (@$mata) {
                $select['mata'] = $mata;
            }


            $selectinfo = $visit;

            $sign = $this->checkSignDocs($vactination_id, 2);
            switch (@$select['specialist_type']) {
                case 'SARAF':
                    $specialistType = 'NEUROLOGI';
                    break;
                // case 'PENYAKIT DALAM':
                //     $specialistType = 'REHABILITASI MEDIS';
                //     break;
                default:
                    $specialistType = @$select['specialist_type'];
                    break;
            }
            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    ATURANMINUM2 AS SIGNATURA,
                    MAX(TREAT_DATE) AS tanggal_selesai,
                    MIN(TREAT_DATE) AS tanggal_mulai

                FROM PASIEN_PRESCRIPTION_DETAIL
                WHERE VISIT_ID = '" . $visit['visit_id'] . "'
                GROUP BY DESCRIPTION, ATURANMINUM2, TREAT_DATE
                "
            )->getResultArray());
            // dd($sign);

            $visit["fullname"] = $select['dpjp'];
            $visit['class_room_id'] = $select['class_room_id'];
            $visit['isrj'] = $select['isrj'];
            $visit['clinic_id'] = $select['clinic_id'];
            $visit['name_of_clinic'] = $select['departmen'] . " (UMUM)";
            $title = 'ASESMEN MEDIS IGD';
            if (@$select['diag_cat'] != '1')
                if ($visit['isrj'] == '0') {
                    $title = 'ASESMEN MEDIS ' . $specialistType . ' RAWAT INAP';
                } else {
                    $title = 'ASESMEN MEDIS ' . $specialistType . ' RAWAT JALAN';
                }

            // dd($select);
            if ($visit['clinic_id'] == 'P012') {
                $title = 'ASESMEN MEDIS IGD';
            }
            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "lokalis" => $selectlokalis,
                "lokalis2" => $selectlokalis2,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "sign" => $sign,
                "farmako" => $farmako,
                "recipe" => $selectrecipe
            ]);
        }
    }

    private function cetakskdpE($db, $visit)
    {

        $check = $this->lowerKey($db->query("SELECT CLINIC_ID, EMPLOYEE_ID, BODY_ID FROM PASIEN_TRANSFER where
                                            VISIT_ID = '" . $visit['visit_id'] . "' ORDER BY EXAMINATION_DATE ASC   
            ")->getRowArray() ?? []);

        $pasien1 = $this->lowerKey($db->query("SELECT 
                                            INASIS_KONTROL.VISIT_ID,   
                                            INASIS_KONTROL.NOSEP,  
                                            INASIS_KONTROL.TGLRENCKONTROL,  
                                            INASIS_KONTROL.POLIKONTROL_KDPOLI,   
                                            INASIS_KONTROL.POLIKONTROL_NMPOLI,  
                                            INASIS_KONTROL.KODEDOKTER,
                                            INASIS_KONTROL.MODIFIED_BY,   
                                            INASIS_KONTROL.MODIFIED_DATE,   
                                            INASIS_KONTROL.RESPONPOST,   
                                            INASIS_KONTROL.RESPONPUT,   
                                            INASIS_KONTROL.RESPONDEL,
                                            INASIS_KONTROL.NOSURATKONTROL,
                                            INASIS_KONTROL.SURATTYPE,
                                            pv.pasien_id,
                                            pv.diantar_oleh,
                                            CONVERT(VARCHAR, DATE_OF_BIRTH, 105) AS date_of_birth,
                                            d.name_of_diagnosa,
                                            o.name_of_org_unit,
                                            ea.employee_id,
                                            ea.fullname,
                                            INASIS_KONTROL.no_registration,
                                            pv.KDDPJP,

                                            farmakoterapi = REPLACE(REPLACE(STUFF( 
                                                (SELECT '-' + DESCRIPTION + CHAR(13) + CHAR(10)
                                                FROM treatment_OBAT tb2
                                                WHERE tb2.visit_id = inasis_kontrol.visit_id
                                                AND SOLD_STATUS IN (1,5,6,7)  
                                                AND tb2.BRAND_ID IS NOT NULL
                                                GROUP BY description
                                                FOR XML PATH (''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 1, ''), 
                                                '&#x0D', ''), '-', ''),

                                            (
                                                (SELECT TOP(1) teraphy_desc 
                                                FROM examination_info ei 
                                                WHERE ei.visit_id = inasis_kontrol.visit_id 
                                                AND ei.petugas_type = '11' order by examination_date desc) 
                                            ) AS diagnya,

                                            pt.notes

                                        FROM INASIS_KONTROL 
                                        INNER JOIN pasien_visitation pv ON INASIS_KONTROL.VISIT_ID = pv.visit_id
                                        INNER JOIN pasien p ON pv.no_registration = p.no_registration 
                                        INNER JOIN employee_all ea ON inasis_kontrol.KODEDOKTER = ea.employee_id
                                        INNER JOIN organizationunit o ON pv.org_unit_code = o.org_unit_code
                                        LEFT JOIN diagnosa d ON pv.diag_awal = d.diagnosa_id
                                        LEFT JOIN pasien_transfer pt ON INASIS_KONTROL.VISIT_ID = pt.visit_id  

                                        WHERE INASIS_KONTROL.SURATTYPE = '1'
                                        AND INASIS_KONTROL.VISIT_ID = '" . $visit['visit_id'] . "'
                                        ORDER BY INASIS_KONTROL.MODIFIED_DATE DESC;
        ")->getRowArray() ?? []);

        if (!empty($pasien1)) {
            $employeeId = $pasien1['employee_id'] ?? '';
            $ttdBase64 = null;
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $ttdDir = $this->imageloc . "uploads/dokter/";

            if (!empty($employeeId)) {
                foreach ($allowedExtensions as $ext) {
                    $filePath = $ttdDir . $employeeId . '.' . $ext;
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }

            $pasien1['ttd_dok'] = $ttdBase64;
        }

        $signsep = $this->checkSignDocs(@$check['body_id'], 11);


        return [
            'pasien' => $pasien1,
            'signsep'   => $signsep
        ];
    }
    private function cetakCppt($db, $visit)
    {
        if ($visit['class_room_id'] == '' || is_null($visit['class_room_id'])) {
            $select = $this->lowerKey($db->query(
                "
                select 
                case ei.account_id when 1 then 'Asesmen Medis'
                when 2 then 'Asesmen Keperawatan'
                when 3 then 'CPPT SOAP'
                when 4 then 'CPPT SBAR'
                when 6 then 'CPPT Gizi' end as dokumen,
                ei.account_id,
                convert(varchar, ei.examination_date, 100) as examination_date ,
                case when ei.petugas_type = '11' then 'D'
                when ei.petugas_type = '13' then 'P'
                when ea2.OBJECT_CATEGORY_ID = '21' then 'P'
                when ea2.OBJECT_CATEGORY_ID = '22' then 'Far'
                when ea2.OBJECT_CATEGORY_ID = '23' then 'B'
                    when ea2.OBJECT_CATEGORY_ID = '24' then 'G'
                    when ea2.OBJECT_CATEGORY_ID = '25' then 'Fis'
                    else '' end as kode_ppa,
                    case when ea2.FULLNAME is null then ed.modified_by else ea2.fullname end as nama_ppa ,
                    ei.ANAMNASE as Subyectif,
                    'BB : ' + cast(isnull(WEIGHT, 0.0) as varchar(10))  + 'Kg , ' +'TB : ' + cast(isnull(HEIGHT, 0.0) as varchar(10)) + ' cm , ' +
                'Tensi : '+ cast(isnull(TENSION_UPPER, 0.0) as varchar(10)) + ' / ' + cast(isnull(TENSION_BELOW, 0.0) as varchar(10)) + ' mmHg , ' + 
                'Nadi : ' + cast(isnull(nadi, 0.0) as varchar(10)) + ' /mnt , ' + 'RR : ' + cast(isnull(NAFAS, 0.0) as varchar(10)) + ' /mnt , ' + ' SpO2 : ' + 
                cast(isnull(saturasi, 0.0) as varchar(10)) + ' % ' 
                + ' Keadaan Umum : ' + isnull(ei.ALO_ANAMNASE, '')  as obyektif,
                    ei.teraphy_desc as asesmen,
                    ei.instruction as  planning,
                    ed.examination_date as tanggal_dibuat,
                    ei.valid_date as tanggal_konfirm,
                    case when ei.valid_user is null or ei.valid_user = '' then '' else isnull(ea.fullname, ed.modified_by) end as konfirm_oleh

                from 
                EXAMINATION_INFO ei
                left join examination_detail ed on ed.body_id = ei.body_id
                left outer join employee_all ea on ei.employee_id = ea.employee_id
                left outer join users u on ei.modified_by = u.username
                left outer join employee_all ea2 on u.employee_id = ea2.employee_id
                where
                ei.visit_id  = '" . $visit['visit_id'] . "'
                and ei.NO_REGISTRATION = '" . $visit['no_registration'] . "'
                and ei.petugas_type = '11'
                and ei.account_id = '3'
                order by ei.examination_date desc
            "
            )->getResultArray() ?? []);
        } else {
            $select = [];
        }

        return $select;
    }
    private function cetakSepAllE($db, $visit)
    {
        $pasien = $this->lowerKey($db->query("
            SELECT 
                PASIEN_VISITATION.NO_REGISTRATION,   
                PASIEN_VISITATION.VISIT_ID,   
                PASIEN_VISITATION.STATUS_PASIEN_ID,   
                PASIEN_VISITATION.VISIT_DATE,   
                PASIEN_VISITATION.CLINIC_ID,   
                PASIEN_VISITATION.EMPLOYEE_ID,
                PASIEN_VISITATION.VISIT_DATE,
                PASIEN.NAME_OF_PASIEN, 
                PASIEN.CONTACT_ADDRESS,
                PASIEN.DATE_OF_BIRTH,
                PASIEN.GENDER,
                PASIEN_VISITATION.RUJUKAN_ID,
                ISNULL(PASIEN_VISITATION.no_skpinap, PASIEN_VISITATION.no_skp) AS NO_SKP,
                PASIEN.PASIEN_ID,
                PASIEN.KK_NO,
                PASIEN_VISITATION.CLASS_ID,
                PASIEN_VISITATION.ADDRESS_OF_RUJUKAN,
                PASIEN_VISITATION.RUJUKAN_ID,
                PASIEN_VISITATION.KELUAR_ID,
                PASIEN_VISITATION.DESCRIPTION,
                PASIEN_VISITATION.ACCOUNT_ID,
                PASIEN.COVERAGE_ID,
                PASIEN_VISITATION.IN_DATE, 
                PASIEN_VISITATION.DIAG_AWAL, 
                PASIEN_VISITATION.CONCLUSION, 
                PASIEN_VISITATION.COB,
                PASIEN_VISITATION.ASALRUJUKAN,
                PASIEN_VISITATION.PPKRUJUKAN,
                RIGHT(1000 + PASIEN_VISITATION.TICKET_NO, 3) AS URUTAN,
                CLINIC.NAME_OF_CLINIC,
                INASIS_GET_FASKES.NMPROVIDER
            FROM PASIEN_VISITATION
            LEFT OUTER JOIN ROOMS ON PASIEN_VISITATION.CLINIC_ID = ROOMS.BUILDINGS_ID  
            LEFT JOIN CLINIC ON PASIEN_VISITATION.CLINIC_ID = CLINIC.CLINIC_ID
            LEFT OUTER JOIN INASIS_GET_FASKES ON INASIS_GET_FASKES.KDPROVIDER = PASIEN_VISITATION.PPKRUJUKAN
            JOIN PASIEN ON PASIEN.NO_REGISTRATION = PASIEN_VISITATION.NO_REGISTRATION
            WHERE PASIEN_VISITATION.NO_REGISTRATION = '" . $visit['no_registration'] . "'
            AND PASIEN_VISITATION.VISIT_ID = '" . $visit['visit_id'] . "'
        ")->getFirstRow('array') ?? []);


        // Ambil data tambahan untuk dataSep
        $data1 = $this->lowerKey($db->query("
            SELECT 
                p.COVERAGE_ID,   
                CASE 
                    WHEN pv.TUJUANKUNJ = '0' THEN 'Rujukan Pertama'
                    WHEN pv.TUJUANKUNJ = '1' THEN 'Prosedur'
                    WHEN pv.TUJUANKUNJ = '2' THEN 'Konsul Dokter'
                    ELSE 'Lainnya' 
                END AS TUJUANKUNJ_DESC,
                ijp.NMJNSPESERTA 
            FROM PASIEN_VISITATION pv
            JOIN PASIEN p ON pv.NO_REGISTRATION = p.NO_REGISTRATION
            LEFT JOIN INASIS_JENIS_PESERTA ijp ON p.FAMILY_STATUS_ID = ijp.KDJNSPESERTA
            WHERE pv.VISIT_ID = '" . $visit['visit_id'] . "'
        ")->getRowArray() ?? []);

        $data['json'] = array_merge($visit, $pasien);
        $data['dataSep'] = $data1; // Sekarang hanya berisi $data1

        return $data;
    }


    private function tratnameE($db)
    {
        $sql = $this->lowerKey($db->query('select TARIF_ID, TARIF_NAME from TREAT_TARIF')->getResultArray());

        return $sql;
    }

    private function decodeVisit($visit)
    {
        if (is_null($visit) || empty($visit)) {
            exit('Nilai Url tidak benar (null atau kosong)');
        }

        $decoded_visit = base64_decode($visit, true);

        if ($decoded_visit === false) {
            exit('Nilai Url tidak benar (gagal decode base64)');
        }

        $json = json_decode($decoded_visit, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            exit('Nilai Url tidak benar (gagal decode JSON)');
        }

        return $json;
    }



    private function patomiandanaE($visit_id)
    {
        $db = db_connect();

        $queryPenunjang = $db->query(
            "SELECT file_image FROM pasien_penunjang WHERE VISIT_ID = ? AND CLINIC_ID = 'P013'",
            [$visit_id]
        )->getResultArray();

        $queryTreatResult = $db->query(
            "SELECT treat_image AS file_image FROM TREAT_RESULTS WHERE CLINIC_ID IN ('P016', 'P023') AND VISIT_ID = ?",
            [$visit_id]
        )->getResultArray();

        $result = array_merge($queryPenunjang, $queryTreatResult);
        return $this->lowerKey($result);
    }

    private function igdTriaseE($visit_id, $session_id)
    {

        $db = db_connect();
        $result = $this->lowerKey($db->query(
            "SELECT 
                        isnull((select top(1) 
                            case 
                                when total_score = 5 then 'ATS V' 
                                when total_score = 4 then 'ATS IV'
                                when total_score = 3 then 'ATS III'
                                when total_score = 2 then 'ATS II'
                                when total_score = 1 then 'ATS I' 
                            end 
                        from ASSESSMENT_INDICATOR
                        where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID 
                        order by EXAMINATION_DATE desc), '') as ATS_Tipe,
                        
                        STUFF(
                            (SELECT ','+CHAR(13)+CHAR(10)  + value_desc
                            FROM assessment_triase_detail aid
                            WHERE aid.BODY_ID IN (
                                select BODY_ID 
                                from ASSESSMENT_INDICATOR 
                                where DOCUMENT_ID = pd.PASIEN_DIAGNOSA_ID)
                            FOR XML PATH ('')
                            ), 1, 1, '') as ATS_ITEM
                    FROM 
                        pasien_diagnosa pd
                    LEFT OUTER JOIN ASSESSMENT_INDICATOR ai 
                        ON pd.PASIEN_DIAGNOSA_ID = ai.DOCUMENT_ID
                    WHERE 
                        pd.PASIEN_DIAGNOSA_ID = ?
                        AND pd.VISIT_ID = ?
                    GROUP BY 
                        pd.PASIEN_DIAGNOSA_ID;",
            [$session_id, $visit_id]
        )->getResultArray());

        // return $this->lowerKey($result ? $result[0]: [] );

        return ([
            "val" => $result ? $result[0] : [],
        ]);
    }


    public function persalinanE($visit)
    {

        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $row = $db->query("SELECT TOP(1) DOCUMENT_ID, VISIT_ID FROM BABY WHERE DOCUMENT_ID IS NOT NULL AND VISIT_ID = '{$visit['visit_id']}'")->getRowArray();
            $vactination_id = $row['DOCUMENT_ID'] ?? null;
            $visit_ids = $row['VISIT_ID'] ?? $visit['visit_id'];

            $data = $db->query("select examination_date from assessment_obstetric where VISIT_ID = '" . $visit['visit_id'] . "' and body_id = '$vactination_id'")->getRow(0, "array");
            $ikhtisar = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN003', $visit['visit_id'], $vactination_id);
            $laporanPersalinan = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN002', $visit['visit_id'], $vactination_id);
            $perdarahan = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN004', $visit['visit_id'], $vactination_id);
            $placenta = $this->query_assessment_column_style_body_id('assessment_obstetric', 'KBDN005', $visit['visit_id'], $vactination_id);

            $examModel = new ExaminationDetailModel();

            $babyModel = new BabyModel();
            $baby = [];
            if (!is_null($vactination_id)) {
                $baby = $babyModel->select("
                org_unit_code,
                visit_id,
                baby_id,
                babyno,
                inspection_date,
                baby_ke,
                no_registration,
                date_of_birth,
                partus,
                indication,
                birth,
                birth_con,
                gender,
                resusitasi,
                movement,
                skincolor,
                turgor,
                tonus,
                sound,
                mororeflex,
                suckingreflex,
                holding,
                necktone,
                headcircumference,
                chestcircumference,
                valid_date,
                valid_user,
                valid_pasien
                ")->where("document_id", $vactination_id)->findAll();
            }
            // var_dump($baby);


            if (count($baby) > 0) {
                $whereIn = '';
                foreach ($baby as $key => $value) {
                    $whereIn .= "'" . $value['baby_id'] . "',";
                }
                $whereIn = substr($whereIn, 0, -1);


                $exambaby = $examModel->select("*")
                    ->where("document_id in ($whereIn)")->findAll();

                $exambaby = $this->lowerKey($exambaby);

                $apgar = $this->lowerKey($db->query("select * from assessment_indicator where document_id in ($whereIn) and p_type in (select p_type from assessment_parameter_type where PARENT_ID = '005')")->getResultArray());

                if (count($apgar) > 0) {
                    $whereInApgar = '';
                    foreach ($apgar as $key => $value) {
                        $whereInApgar .= "'" . $value['body_id'] . "',";
                    }
                    $whereInApgar = substr($whereInApgar, 0, -1);
                }

                $apgarWaktu = $this->lowerKey($db->query(
                    "
                   SELECT * FROM ASSESSMENT_PARAMETER_type WHERE p_type in ('ASES032','ASES033', 'ASES034')
                    "
                )->getResultArray() ?? []);
                $apgarData = $this->lowerKey($db->query("
                SELECT 
                    aad.BODY_ID,
                    ap.PARAMETER_DESC,
                    ap.PARAMETER_ID,
            
                    MAX(CASE 
                        WHEN aad.P_TYPE = 'ASES032' AND aad.PARAMETER_ID = ap.PARAMETER_ID 
                        THEN aad.VALUE_DESC ELSE '' END) AS menit_1,
            
                    MAX(CASE 
                        WHEN aad.P_TYPE = 'ASES033' AND aad.PARAMETER_ID = ap.PARAMETER_ID 
                        THEN aad.VALUE_DESC ELSE '' END) AS menit_5,
            
                    MAX(CASE 
                        WHEN aad.P_TYPE = 'ASES034' AND aad.PARAMETER_ID = ap.PARAMETER_ID 
                        THEN aad.VALUE_DESC ELSE '' END) AS menit_10,
            
                    MAX(CASE 
                        WHEN aad.P_TYPE = 'ASES032' AND aad.PARAMETER_ID = ap.PARAMETER_ID 
                        THEN aad.VALUE_SCORE ELSE NULL END) AS value_score_1,
            
                    MAX(CASE 
                        WHEN aad.P_TYPE = 'ASES033' AND aad.PARAMETER_ID = ap.PARAMETER_ID 
                        THEN aad.VALUE_SCORE ELSE NULL END) AS value_score_5,
            
                    MAX(CASE 
                        WHEN aad.P_TYPE = 'ASES034' AND aad.PARAMETER_ID = ap.PARAMETER_ID 
                        THEN aad.VALUE_SCORE ELSE NULL END) AS value_score_10
            
                    FROM 
                        ASSESSMENT_APGAR_DETAIL aad
                    LEFT JOIN 
                        ASSESSMENT_PARAMETER ap ON aad.PARAMETER_ID = ap.PARAMETER_ID
                    WHERE 
                        aad.body_id in ($whereInApgar)
                        AND aad.VISIT_ID = '{$visit_ids}'
                        AND ap.P_TYPE IN ('ASES032', 'ASES033', 'ASES034')
                    GROUP BY 
                        BODY_ID,ap.PARAMETER_DESC, ap.PARAMETER_ID
            ")->getResultArray() ?? []);
            }

            $selectinfo = $visit;
            $title = "Laporan Persalinan";
            $val = [];
            $sign = $this->checkSignDocs($vactination_id, 12);
            // dd($baby);
            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRowArray() ?? []);
            return  [
                "visit" => $visit,
                "title" => $title,
                "info" => $selectinfo,
                "ikhtisar" => $ikhtisar,
                "laporanPersalinan" => $laporanPersalinan,
                "perdarahan" => $perdarahan,
                "organization" => $selectorganization,
                "placenta" => $placenta,
                "sign" => $sign,
                "apgarWaktu" => @$apgarWaktu ?? [],
                "apgarData" => @$apgarData ?? [],
                "apgar" => @$apgar ?? [],
                'baby' => @$baby,
                'exambaby' => @$exambaby,
                "val" => $data
            ];
        }
    }


    private function operasiE($visit, $vactination_id = null)
    {
        $title = "Laporan Pembedahan";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $select = $this->lowerKey($db->query("SELECT TOP 1 
                                                PASIEN_OPERASI.*, 
                                                ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as tipe_operasi
                                            FROM 
                                                PASIEN_OPERASI
                                            left outer JOIN 
                                                ASSESSMENT_PARAMETER_VALUE ON PASIEN_OPERASI.SURGERY_TYPE = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                                            WHERE 
                                                PASIEN_OPERASI.visit_id ='" . $visit['visit_id'] . "'  AND BILL_ID IS NOT NULL 
                                            AND BILL_ID <> '' 
                                            ORDER BY 
                                                PASIEN_OPERASI.START_OPERATION DESC; 
            ")->getRowArray() ?? []);


            $vactination_id = isset($select) && !empty($select) ? $select['vactination_id'] : "";


            $operation_team = $this->lowerKey($db->query("
            SELECT DOCTOR, TASK from OPERATION_TEAM 
            INNER JOIN OPERATION_TASK ON OPERATION_TEAM.TASK_ID = OPERATION_TASK.TASK_ID
            WHERE OPERATION_ID = '" . $vactination_id . "' ORDER BY OPERATION_TASK.TASK_ID ASC
            ")->getResultArray() ?? []);

            $diagnosas = $this->lowerKey($db->query("SELECT ISNULL(DIAGNOSA_NAME,DIAGNOSA_DESC) as diagnosa_name,diag_cat,suffer_type.suffer from PASIEN_DIAGNOSAS 
            inner join suffer_type on pasien_diagnosas.suffer_type = suffer_type.suffer_type
            where pasien_diagnosa_id = '" . $vactination_id . "' and diag_cat IN('13','14','15')
            ")->getResultArray() ?? []);

            if (!empty($select)) {
                $employeeId = $select['employee_id'] ?? '';
                $ttdBase64 = null;
                $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
                $ttdDir = $this->imageloc . "uploads/dokter/";

                if (!empty($employeeId)) {
                    foreach ($allowedExtensions as $ext) {
                        $filePath = $ttdDir . $employeeId . '.' . $ext;
                        if (file_exists($filePath)) {
                            $fileData = file_get_contents($filePath);
                            $mimeType = mime_content_type($filePath);
                            $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                            break;
                        }
                    }
                }

                $select['ttd_dok'] = $ttdBase64;
            }


            if (!empty($select)) {
                $ttdPasienBase64 = null;
                $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
                $ttdDir = $this->imageloc . "uploads/signatures/";
                $noReg = $visit['no_registration'] ?? '';

                if (!empty($noReg)) {
                    foreach ($allowedExtensions as $ext) {
                        $pattern = $ttdDir . '*' . $noReg . '*.' . $ext;
                        $files = glob($pattern);
                        if (!empty($files)) {
                            $filePath = $files[0];
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdPasienBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }

                $select['ttd_pasien'] = $ttdPasienBase64;
            }


            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                'operation_team' => $operation_team,
                'diagnosas' => $diagnosas,
            ]);
        }
    }


    private function fisioE($visit, $vactination_id = null)
    {
        $title = "";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();

            $select = $this->lowerKey($db->query("SELECT * FROM 
                                                pasien_fisioterapi_detail
                                            WHERE NO_REGISTRATION ='" . $visit['no_registration'] . "' 
                                            ORDER BY 
                                                vactination_date DESC; 
            ")->getRowArray() ?? []);

            $diagnosa = $this->lowerKey($db->query("SELECT 
                                         pd.VISIT_ID, 
                                            pd.ANAMNASE,
                                            pds.DIAG_CAT, 
                                            d.NAME_OF_DIAGNOSA as diagnosa_name
                                    FROM PASIEN_DIAGNOSA pd
                                    LEFT JOIN PASIEN_DIAGNOSAS pds 
                                        ON pd.PASIEN_DIAGNOSA_ID = pds.PASIEN_DIAGNOSA_ID
                                    LEFT JOIN DIAGNOSA d
                                        ON pds.diagnosa_id = d.diagnosa_id
                                    WHERE     pds.diag_cat IN ('1', '17') 
                                        AND d.diagnosa_id = pds.DIAGNOSA_ID
                                    AND pd.visit_id = '" . $visit['visit_id'] . "'
                                ORDER BY pd.date_of_diagnosa DESC;
                    ")->getResultArray());

            $clinic = $this->lowerKey($db->query("SELECT 
                            c.NAME_OF_CLINIC, 
                            pv.VISIT_ID,
                            pv.clinic_id
                        FROM CLINIC c
                        JOIN PASIEN_VISITATION pv ON c.clinic_id = pv.clinic_id
                        WHERE c.clinic_id = pv.clinic_id
                        AND pv.visit_id = '" . $visit['visit_id'] . "'
            ")->getRowArray());

            if (!empty($select)) {
                $employeeId = $select['employee_id'] ?? '';
                $ttdBase64 = null;
                $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
                $ttdDir = $this->imageloc . "uploads/dokter/";

                if (!empty($employeeId)) {
                    foreach ($allowedExtensions as $ext) {
                        $filePath = $ttdDir . $employeeId . '.' . $ext;
                        if (file_exists($filePath)) {
                            $fileData = file_get_contents($filePath);
                            $mimeType = mime_content_type($filePath);
                            $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                            break;
                        }
                    }
                }

                $select['ttd_dok'] = $ttdBase64;
            }

            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                'diag' => $diagnosa,
                'clinic' => $clinic
            ]);
        }
    }

    private function anesthesiE($visit, $vactination_id = null)
    {
        $title = "Laporan Anestesi Lengkap";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $visit_id = $visit['visit_id'];

            $oprasi = $this->lowerKey($db->query("SELECT Top (1) * FROM PASIEN_OPERASI where VISIT_ID = '$visit_id'  AND BILL_ID IS NOT NULL 
                                                AND BILL_ID <> ''  order by START_OPERATION DESC")->getRowArray() ?? []);
            $vactination_id = isset($oprasi) && !empty($oprasi) ? $oprasi['vactination_id'] : "";


            $query = $this->lowerKey($db->query(
                "SELECT TOP 1 *,
                        ASSESSMENT_ANESTHESIA.org_unit_code as org_unit_code,
                        ASSESSMENT_ANESTHESIA.visit_id as visit_id,
                        ASSESSMENT_ANESTHESIA.trans_id as trans_id,
                        ASSESSMENT_ANESTHESIA.body_id as body_id,
                        ASSESSMENT_ANESTHESIA.document_id as document_id,
                        ASSESSMENT_ANESTHESIA.examination_date as examination_date,
                        ASSESSMENT_ANESTHESIA.modified_date as modified_date,
                        pasien_operasi.VACTINATION_id
                    FROM ASSESSMENT_ANESTHESIA
                    LEFT JOIN ASSESSMENT_ANESTHESIA_POST 
                        ON ASSESSMENT_ANESTHESIA.DOCUMENT_ID = ASSESSMENT_ANESTHESIA_POST.DOCUMENT_ID
                    LEFT JOIN ASSESSMENT_ANESTHESI_CHECKLIST 
                        ON ASSESSMENT_ANESTHESIA.DOCUMENT_ID = ASSESSMENT_ANESTHESI_CHECKLIST.DOCUMENT_ID
                    LEFT JOIN pasien_operasi 
                        ON ASSESSMENT_ANESTHESIA.document_id = pasien_operasi.vactination_id
                    WHERE pasien_operasi.VISIT_ID = '$visit_id' 
                    AND ASSESSMENT_ANESTHESIA.start_operation IS NOT NULL
                    ORDER BY pasien_operasi.start_operation DESC;
                "
            )->getRowArray() ?? []);

            $aldrete_score = $this->lowerKey($db->query(
                "
                select 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID, 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC
                from ASSESSMENT_ANESTHESIA_RECOVERY 
                inner join ASSESSMENT_PARAMETER on ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID AND ASSESSMENT_PARAMETER.P_TYPE = 'oprs023'
                where DOCUMENT_ID = '" . $vactination_id . "' and ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'oprs023'
                group by 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID,
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC

                "
            )->getResultArray() ?? []);

            $steward_score = $this->lowerKey($db->query(
                "
                select 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID, 
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC
                from ASSESSMENT_ANESTHESIA_RECOVERY 
                inner join ASSESSMENT_PARAMETER on ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID = ASSESSMENT_PARAMETER.PARAMETER_ID AND ASSESSMENT_PARAMETER.P_TYPE = 'oprs025'
                where DOCUMENT_ID = '" . $vactination_id . "' and ASSESSMENT_ANESTHESIA_RECOVERY.P_TYPE = 'oprs025'
                group by 
                    ASSESSMENT_ANESTHESIA_RECOVERY.BODY_ID,
                    ASSESSMENT_ANESTHESIA_RECOVERY.PARAMETER_ID,
                    ASSESSMENT_PARAMETER.PARAMETER_DESC,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_SCORE,
                    ASSESSMENT_ANESTHESIA_RECOVERY.VALUE_DESC

                "
            )->getResultArray() ?? []);

            $bromage_score = $this->lowerKey($db->query(
                "
                select value_desc, value_score from ASSESSMENT_ANESTHESIA_RECOVERY where DOCUMENT_ID =  '" . $vactination_id . "' and P_TYPE = 'oprs024'
                "
            )->getResultArray() ?? []);

            $infusion   = $this->filtering_array($vactination_id, 'OPRS029');
            $general    = $this->filtering_array($vactination_id, 'OPRS030');
            $regional   = $this->filtering_array($vactination_id, 'OPRS033');
            $ventilasi  = $this->filtering_array($vactination_id, 'OPRS031');
            $jalan_napas  = $this->filtering_array($vactination_id, 'OPRS032');

            $instruksi_post = $this->lowerKey($db->query(
                "
               SELECT 
                    AOP.*,
                    PV1.VALUE_DESC AS POSITION,
                    PV2.VALUE_DESC AS FASTING_UNTIL
                FROM 
                    ASSESSMENT_OPERATION_POST AOP
                INNER JOIN 
                    ASSESSMENT_PARAMETER_VALUE PV1 
                    ON AOP.POSITION = PV1.VALUE_ID
                INNER JOIN 
                    ASSESSMENT_PARAMETER_VALUE PV2 
                    ON AOP.FASTING_UNTIL = PV2.VALUE_ID
                WHERE 
                    AOP.document_id =  '" . $vactination_id . "'

                "
            )->getRowArray() ?? []);



            $cairan_masuk = $this->lowerKey($db->query("
                SELECT 
                    TREATMENT_OBAT.visit_id,
                    TREATMENT_OBAT.treat_date AS date,
                    goods.name AS name,
                    TREATMENT_OBAT.QUANTITY AS quantity
                FROM 
                    TREATMENT_OBAT 
                INNER JOIN 
                    goods ON TREATMENT_OBAT.BRAND_ID = goods.BRAND_ID 
                WHERE 
                    TREATMENT_OBAT.CLINIC_ID = 'P002' 
                    AND ISALKES = 19
                    AND TREATMENT_OBAT.visit_id = '" . $visit['visit_id'] . "'

                UNION ALL

                SELECT 
                    br.visit_id,
                    br.REQUEST_DATE AS date,
                    but.usagetype AS name,
                    br.BLOOD_QUANTITY AS quantity
                FROM 
                    BLOOD_REQUEST br
                LEFT JOIN 
                    BLOOD_USAGE_TYPE but ON br.blood_usage_type = but.usage_type
                WHERE 
                    br.visit_id = '" . $visit['visit_id'] . "';

            ")->getResultArray() ?? []);

            $cairan = $this->lowerKey($db->query("
                select examination_date,value_desc,fluid_amount,
                MAX(CASE 
                WHEN fluid_type IN('G0230301', 'G0230302') 
                THEN 1 
                ELSE 0 
                END) AS cairan_masuk 
                from assessment_fluid_balance
                inner join assessment_parameter_value on assessment_fluid_balance.P_TYPE = assessment_parameter_value.p_type AND assessment_parameter_value.VALUE_ID = assessment_fluid_balance.FLUID_TYPE
                where assessment_fluid_balance.P_TYPE = 'GEN0023' AND VISIT_ID = '" . $visit['visit_id'] . "'
                group by examination_date, value_desc, fluid_amount
            ")->getResultArray() ?? []);

            $asParameter  =  $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_PARAMETER WHERE P_TYPE  LIKE 'OPRS%' ORDER BY P_TYPE")->getResultArray() ?? []);
            $asParameterVal  =  $this->lowerKey($db->query("SELECT * FROM ASSESSMENT_PARAMETER_VALUE WHERE P_TYPE  LIKE 'OPRS%' ORDER BY P_TYPE")->getResultArray() ?? []);

            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array') ?? []);
            $aldrete_score_group = [];
            $steward_score_group = [];

            foreach ($aldrete_score as $item) {
                $bodyId = $item['body_id'];
                if (!isset($aldrete_score_group[$bodyId])) {
                    $aldrete_score_group[$bodyId] = [];
                }

                $aldrete_score_group[$bodyId][] = $item;
            }
            foreach ($steward_score as $item) {
                $bodyId = $item['body_id'];
                if (!isset($steward_score_group[$bodyId])) {
                    $steward_score_group[$bodyId] = [];
                }

                $steward_score_group[$bodyId][] = $item;
            }


            $operasi = $this->lowerKey($db->query("
            SELECT NO_REGISTRATION, EMPLOYEE_ID, DOCTOR FROM pasien_operasi  WHERE vactination_id = '" . $vactination_id . "'")->getRowArray() ?? []);

            $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

            $ttdPasienBase64 = null;
            $ttdPasienDir = $this->imageloc . "uploads/signatures/";
            $noReg = $visit['no_registration'] ?? '';

            if (!empty($noReg)) {
                foreach ($allowedExtensions as $ext) {
                    $pattern = $ttdPasienDir . '*' . $noReg . '*.' . $ext;
                    $files = glob($pattern);
                    if (!empty($files)) {
                        $filePath = $files[0];
                        if (file_exists($filePath)) {
                            $fileData = file_get_contents($filePath);
                            $mimeType = mime_content_type($filePath);
                            $ttdPasienBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                            break;
                        }
                    }
                }
            }
            if (!empty($operasi)) {
                $ttdDokterBase64 = null;
                $ttdDokterDir = $this->imageloc . "uploads/dokter/";
                $employeeId = $operasi['employee_id'] ?? '';

                if (!empty($employeeId)) {
                    foreach ($allowedExtensions as $ext) {
                        $pattern = $ttdDokterDir . '*' . $employeeId . '*.' . $ext;
                        $files = glob($pattern);
                        if (!empty($files)) {
                            $filePath = $files[0];
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdDokterBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }

                $visit['ttd_pasien'] = $ttdPasienBase64;
                $visit['ttd_dok'] = $ttdDokterBase64;
                $visit['ttd_dokter_name'] = $operasi['doctor'];
            }

            // $visit['ttd_dok'] = $ttdBase64;
            // $visit['ttd_pasien'] = $ttdPasienBase64;
            return ([
                "visit" => $visit,
                'title' => $title,
                "val" => $query,
                "infusion" => $infusion,
                "general" => $general,
                "regional" => $regional,
                "ventilasi" => $ventilasi,
                "jalan_napas" => $jalan_napas,
                "general_entry_type" => $this->getEntryType($general),
                "ventilasi_entry_type" => $this->getEntryType($ventilasi),
                "jalan_napas_entry_type" => $this->getEntryType($jalan_napas),
                "regional_entry_type" => $this->getEntryType($regional),
                "instruksi_post" => $instruksi_post,
                "organization" => $selectorganization,
                "cairan_masuk" => $cairan_masuk,
                "cairan" => $cairan,
                "aldrete_score" => $aldrete_score_group,
                "steward_score" => $steward_score_group,
                "bromage_score" => $bromage_score,
                'a_param' => $asParameter,
                'a_paramVal' => $asParameterVal
            ]);
        }
    }


    public function ConvertValue($arr_before, $arr_after, $p_type)
    {
        $arr_after = [];
        foreach ($arr_before as $key => $value) {
            if (preg_match('/^OP\d{6}$/', $value)) {
                $result = $this->query_getDescValue($value, $p_type);
                if ($result) {
                    $parameterDesc = $result['PARAMETER_DESC'] ?? '-';
                    $valueDesc = $result['VALUE_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $valueDesc;
                }
            } else {
                $result = $this->query_getDesc($key, $p_type);
                if ($result) {
                    $parameterDesc = $result['PARAMETER_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $value;
                } else {
                    $result2 = $this->query_getDesc2($key, $p_type);
                    $parameterDesc = $result2['PARAMETER_DESC'] ?? '-';
                    $arr_after[$parameterDesc] = $result2['VALUE_DESC'] ?? '-';
                }
            }
        }

        return $arr_after;
    }

    public function query_convertValue($value_id)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT VALUE_DESC FROM ASSESSMENT_PARAMETER_VALUE WHERE VALUE_ID = '" . $value_id . "'
        ");

        $result = $query->getRowArray();

        return $result;
    }
    public function query_getDescValue($value_id, $p_type)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT
                ASSESSMENT_PARAMETER.PARAMETER_DESC,
                ASSESSMENT_PARAMETER_VALUE.VALUE_DESC 
            FROM ASSESSMENT_PARAMETER
            INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_PARAMETER.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID 
            WHERE ASSESSMENT_PARAMETER.P_TYPE = '" . $p_type . "' AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = '" . $db->escapeString($value_id) . "'
        ");

        $result = $query->getRowArray();

        return $result;
    }
    public function query_getDesc($column_name, $p_type)
    {
        $db = db_connect();

        $query = $db->query("
            SELECT PARAMETER_DESC FROM ASSESSMENT_PARAMETER WHERE P_TYPE = '" . $p_type . "' AND COLUMN_NAME =  '" . $db->escapeString($column_name) . "'
        ");

        $result = $query->getRowArray();

        return $result;
    }

    public function query_getDesc2($column_name, $p_type)
    {
        $db = db_connect();

        // $query = $db->query("
        //     SELECT VALUE_DESC FROM ASSESSMENT_PARAMETER_VALUE WHERE P_TYPE = '" . $p_type . "' AND VALUE_INFO =  '" . $db->escapeString($column_name) . "'
        // ");

        $query = $db->query("
            SELECT ASSESSMENT_PARAMETER.PARAMETER_DESC, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC  FROM ASSESSMENT_PARAMETER
            INNER JOIN ASSESSMENT_PARAMETER_VALUE ON ASSESSMENT_PARAMETER.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID AND ASSESSMENT_PARAMETER.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE
            WHERE ASSESSMENT_PARAMETER.P_TYPE = '" . $p_type . "' AND  ASSESSMENT_PARAMETER_VALUE.VALUE_INFO = '" . $db->escapeString($column_name) . "'    
        
        ");

        $result = $query->getRowArray();
        return $result;
    }

    private function getEntryType2($arr)
    {
        // digunakan untuk mengambil entry type = 2 dan ambil keys nya
        $filtered = array_filter($arr, function ($entry) {
            return isset($entry[0]['entry_type']) && $entry[0]['entry_type'] == 2;
        });
        $entryType2 = [];
        foreach ($filtered as $key => $entries) {
            $entryType2[$key] = $entries[0];
        }
        $keys = array_keys($filtered);
        return [
            'keys' => $keys,
            'entries' => $entryType2
        ];
    }
    private function getEntryType($arr)
    {
        // digunakan untuk mengambil entry type = 2 dan ambil keys nya
        $filtered = array_filter($arr, function ($entry) {
            return isset($entry[0]['entry_type']) && !in_array($entry[0]['entry_type'], ['3', '7']);
        });
        $entryType2 = [];
        foreach ($filtered as $key => $entries) {
            $entryType2[$key] = $entries[0];
        }
        $keys = array_keys($filtered);
        return [
            'keys' => $keys,
            'entries' => $entryType2
        ];
    }

    private function filtering_array($document_id, $p_type)
    {
        // digunakan untuk memfilter data berdasarkan parameter id
        $db = db_connect();
        $arr = $this->lowerKey($db->query(
            "
            select 
            assessment_parameter.PARAMETER_DESC,assessment_parameter.ENTRY_TYPE, ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER_VALUE.P_TYPE, assessment_anesthesia_recovery.VALUE_ID,ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,ASSESSMENT_PARAMETER_VALUE.VALUE_INFO,
            MAX(CASE 
            WHEN assessment_anesthesia_recovery.VALUE_ID =  assessment_parameter_value.VALUE_ID 
            THEN 1 
            ELSE 0 
            END) AS checked
            from assessment_anesthesia_recovery 
            LEFT JOIN assessment_parameter 
            ON assessment_anesthesia_recovery.PARAMETER_ID = assessment_parameter.PARAMETER_ID and assessment_anesthesia_recovery.P_TYPE = '$p_type'
            AND assessment_anesthesia_recovery.DOCUMENT_ID = '$document_id' 
            left join assessment_parameter_value on assessment_parameter.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID AND ASSESSMENT_PARAMETER_VALUE.P_TYPE = '$p_type'
            where assessment_parameter.p_Type = '$p_type'
            group by assessment_parameter.PARAMETER_DESC,assessment_parameter.ENTRY_TYPE, ASSESSMENT_PARAMETER.PARAMETER_ID, ASSESSMENT_PARAMETER_VALUE.P_TYPE, assessment_anesthesia_recovery.VALUE_ID,ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,ASSESSMENT_PARAMETER_VALUE.VALUE_INFO
            order by PARAMETER_ID asc

            "
        )->getResultArray() ?? []);

        $arr = array_reduce($arr, function ($result, $item) {
            $desc = $item['parameter_desc'];
            if (!isset($result[$desc])) {
                $result[$desc] = [];
            }
            $result[$desc][] = $item;
            return $result;
        }, []);

        return $arr;
    }


    private function gakepakeresume_medisSS($visit, $vactination_id = null)
    {
        // dd($vactination_id);
        $title = "Resume Medis";
        if ($this->request->is('get')) {
            $db = db_connect();
            $id_diag = $db->query("SELECT TOP (1) pasien_diagnosa_id FROM PASIEN_DIAGNOSA WHERE VISIT_ID = '" . $visit['visit_id'] . "' ORDER BY IN_DATE DESC")->getRowArray();
            $vactination_id = isset($id_diag['pasien_diagnosa_id']) ? $id_diag['pasien_diagnosa_id'] : "";

            // var_dump($vactination_id);
            // exit();

            $select = $this->lowerKey($db->query("SELECT 
                                    pd.NO_REGISTRATION AS no_RM,
                                    p.NAME_OF_PASIEN AS nama,
                                    pd.PASIEN_DIAGNOSA_ID,
                                    pd.BODY_ID,
                                    CASE 
                                        WHEN p.gender = '1' THEN 'Laki-laki'
                                        ELSE 'Perempuan' 
                                    END AS jeniskel,
                                    p.CONTACT_ADDRESS AS alamat,
                                    pd.DOCTOR AS dpjp,
                                    c.name_of_clinic AS departemen,
                                    class.NAME_OF_CLASS AS kelas,
                                    cr.NAME_OF_CLASS AS bangsal,
                                    pd.BED_ID AS bed,
                                    pd.IN_DATE AS tanggal_masuk,
                                    CONVERT(VARCHAR, p.DATE_OF_BIRTH, 105) AS date_of_birth,
                                    CAST(pd.AGEYEAR AS VARCHAR(2)) + ' th ' + 
                                    CAST(pd.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
                                    CAST(pd.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
                                    gcs.GCS_E,
                                    gcs.GCS_M,
                                    gcs.GCS_V, 
                                    gcs.GCS_SCORE AS gcs,
                                    pd.DIAGNOSA_ID AS icd10,
                                    pd.DIAGNOSA_DESC AS namadiagnosa,
                                    pd.DIAGNOSA_DESC_DISCHARGE AS namadiagnosapulang,
                                    pd.ANAMNASE AS anamnesis,
                                    pd.DESCRIPTION AS riwayat_penyakit_sekarang,
                                    MAX(CASE WHEN ph.value_id = 'G0090102' THEN ph.histories ELSE '' END) AS riwayat_penyakit_dahulu,
                                    MAX(CASE WHEN ph.value_id = 'G0090201' THEN ph.histories ELSE '' END) AS riwayat_alergi_obat,
                                    MAX(CASE WHEN ph.value_id = 'G0090202' THEN ph.histories ELSE '' END) AS riwayat_alergi_nonobat,
                                    MAX(CASE WHEN ph.value_id = 'G0090101' THEN ph.histories ELSE '' END) AS riwayat_penyakit_keluarga,
                                    MAX(CASE WHEN ph.value_id = 'G0090301' THEN ph.histories ELSE '' END) AS riwayat_alkohol,
                                    MAX(CASE WHEN ph.value_id = 'G0090302' THEN ph.histories ELSE '' END) AS riwayat_merokok,
                                    MAX(CASE WHEN ph.value_id = 'G0090303' THEN ph.histories ELSE '' END) AS riwayat_diet,
                                    MAX(CASE WHEN ph.value_id = 'G0090401' THEN ph.histories ELSE '' END) AS riwayat_obat_dikonsumsi,
                                    MAX(CASE WHEN ph.value_id = 'G0090402' THEN ph.histories ELSE '' END) AS riwayat_kehamilan,
                                    MAX(CASE WHEN ph.value_id = 'G0090403' THEN ph.histories ELSE '' END) AS riwayat_imunisasi,
                                    ei.WEIGHT AS berat,
                                    ei.HEIGHT AS tinggi,
                                    ei.TENSION_UPPER AS tensi_atas,
                                    ei.TENSION_BELOW AS tensi_bawah,
                                    ei.nadi,
                                    ei.TEMPERATURE AS Suhu,
                                    ei.NAFAS AS respiration,
                                    ei.SATURASI AS SPO2,
                                    -- Perbaikan perhitungan IMT
                                    CASE 
                                        WHEN ei.HEIGHT > 0 THEN ei.WEIGHT / (POWER(CAST(ei.HEIGHT AS DECIMAL(5,2)) / 100, 2)) 
                                        ELSE NULL 
                                    END AS IMT,
                                    ISNULL(
                                        (SELECT TOP 1 total_score FROM ASSESSMENT_FALL_RISK 
                                        WHERE DOCUMENT_ID = pd.BODY_ID ORDER BY EXAMINATION_DATE DESC), '') 
                                    AS FALL_SCORE,
                                    ISNULL(
                                        (SELECT TOP 1 total_score FROM ASSESSMENT_PAIN_MONITORING 
                                        WHERE DOCUMENT_ID = pd.BODY_ID ORDER BY EXAMINATION_DATE DESC), '') 
                                    AS PAIN_SCORE,
                                    MAX(CASE WHEN alo.value_id = 'G0020103' THEN alo.VALUE_DESC ELSE '' END) AS PF_KEPALA,
                                    MAX(CASE WHEN alo.value_id = 'G0020203' THEN alo.VALUE_DESC ELSE '' END) AS PF_MATA,
                                    MAX(CASE WHEN alo.value_id = 'G0020403' THEN alo.VALUE_DESC ELSE '' END) AS PF_HIDUNG,
                                    MAX(CASE WHEN alo.value_id = 'G0020303' THEN alo.VALUE_DESC ELSE '' END) AS PF_TELINGA,
                                    MAX(CASE WHEN alo.value_id = 'G0020503' THEN alo.VALUE_DESC ELSE '' END) AS PF_MULUT,
                                    MAX(CASE WHEN alo.value_id = 'G0020603' THEN alo.VALUE_DESC ELSE '' END) AS PF_LEHER,
                                    MAX(CASE WHEN alo.value_id = 'G0021403' THEN alo.VALUE_DESC ELSE '' END) AS PF_GIGI,
                                    MAX(CASE WHEN alo.value_id = 'G0020703' THEN alo.VALUE_DESC ELSE '' END) AS PF_THORAX,
                                    MAX(CASE WHEN alo.value_id = 'G0020703' THEN alo.VALUE_INFO ELSE '' END) AS LINK_THORAX,
                                    MAX(CASE WHEN alo.value_id = 'G0020803' THEN alo.VALUE_DESC ELSE '' END) AS PF_JANTUNG,
                                    MAX(CASE WHEN alo.value_id = 'G0020903' THEN alo.VALUE_DESC ELSE '' END) AS PF_PARU,
                                    MAX(CASE WHEN alo.value_id = 'G0021003' THEN alo.VALUE_DESC ELSE '' END) AS PF_PERUT,
                                    MAX(CASE WHEN alo.value_id = 'G0021003' THEN alo.VALUE_INFO ELSE '' END) AS GAMBAR_PERUT,
                                    MAX(CASE WHEN alo.value_id = 'G0021803' THEN alo.VALUE_DESC ELSE '' END) AS PF_HEPAR,
                                    MAX(CASE WHEN alo.value_id = 'G0021903' THEN alo.VALUE_DESC ELSE '' END) AS PF_LIEN,
                                    MAX(CASE WHEN alo.value_id = 'G0021303' THEN alo.VALUE_DESC ELSE '' END) AS PF_GINJAL,
                                    MAX(CASE WHEN alo.value_id = 'G0021703' THEN alo.VALUE_DESC ELSE '' END) AS PF_GENITALIS,
                                    MAX(CASE WHEN alo.value_id = 'G0021503' THEN alo.VALUE_DESC ELSE '' END) AS PF_EKSTREMITAS_ATAS,
                                    MAX(CASE WHEN alo.value_id = 'G0021603' THEN alo.VALUE_DESC ELSE '' END) AS PF_EKSTREMITAS_BAWAH,
                                    pd.MEDICAL_PROBLEM AS MASALAH_MEDIS,
                                    'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
                                    pd.HURT AS PENYEBAB_CIDERA,
                                    pd.THERAPY_TARGET AS SASARAN,
                                    pd.LAB_RESULT AS LABORATORIUM,
                                    pd.RO_RESULT AS RADIOLOGI,
                                    pd.TERAPHY_DESC AS FARMAKOLOGIA,
                                    pd.INSTRUCTION AS PROSEDUR,
                                    pd.STANDING_ORDER AS STANDING_ORDER,
                                    pd.DOCTOR AS DOKTER
                                FROM pasien_diagnosa pd
                                LEFT JOIN clinic c ON pd.clinic_id = c.clinic_id
                                LEFT JOIN CLASS_ROOM cr ON cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
                                LEFT JOIN class ON class.CLASS_ID = cr.CLASS_ID
                                LEFT JOIN PASIEN_HISTORY ph ON ph.NO_REGISTRATION = pd.NO_REGISTRATION
                                LEFT JOIN EXAMINATION_DETAIL ei ON ei.body_id = pd.BODY_ID
                                LEFT JOIN ASSESSMENT_LOKALIS alo ON pd.BODY_ID = alo.DOCUMENT_ID
                                LEFT JOIN ASSESSMENT_GCS gcs ON pd.BODY_ID = gcs.DOCUMENT_ID
                                JOIN pasien p ON pd.NO_REGISTRATION = p.NO_REGISTRATION
                                WHERE pd.PASIEN_DIAGNOSA_ID = '$vactination_id'
                                AND pd.VISIT_ID = '" . $visit['visit_id'] . "'
                                GROUP BY 
                                    pd.NO_REGISTRATION, p.NAME_OF_PASIEN, p.gender, p.CONTACT_ADDRESS, pd.DOCTOR, 
                                    c.name_of_clinic, class.NAME_OF_CLASS, cr.NAME_OF_CLASS, pd.BED_ID, pd.IN_DATE,
                                    p.DATE_OF_BIRTH, pd.AGEYEAR, pd.AGEMONTH, pd.AGEDAY,
                                    ei.WEIGHT, ei.HEIGHT, ei.TENSION_UPPER, ei.TENSION_BELOW, ei.nadi, ei.TEMPERATURE,
                                    ei.NAFAS, ei.SATURASI, gcs.GCS_E, gcs.GCS_M, gcs.GCS_V, gcs.GCS_SCORE, pd.DIAGNOSA_ID,
                                    pd.ANAMNASE, pd.DESCRIPTION,pd.PASIEN_DIAGNOSA_ID,pd.BODY_ID,pd.DIAGNOSA_DESC,
                                    pd.DIAGNOSA_DESC_DISCHARGE,pd.MEDICAL_PROBLEM, pd.HURT,pd.THERAPY_TARGET,pd.LAB_RESULT,
                                    pd.TERAPHY_DESC,pd.RO_RESULT,pd.INSTRUCTION,pd.STANDING_ORDER
                                ")->getRow(0, "array"));

            $selectlokalis2 = $this->lowerKey($db->query(
                "SELECT assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                where VISIT_ID = '" . $visit['visit_id'] . "' AND assessment_lokalis.VALUE_SCORE = 2"
            )->getResultArray());

            $farma = $db->query("SELECT STUFF(
                        (SELECT CHAR(13) + CHAR(10) + description + 
                                ' qty: ' + CAST(CAST(quantity AS INT) AS VARCHAR) + 
                                ' (' + ISNULL(description2, '') + ')'
                        FROM treatment_obat 
                        WHERE treatment_obat.visit_id = ? 
                        AND SOLD_STATUS IN (1,  6, 7)
                        AND BRAND_ID IS NOT NULL
                        AND DESCRIPTION NOT LIKE '%jasa%' 
                        AND quantity > 0
                        GROUP BY description, ISNULL(description2, ''), quantity
                        FOR XML PATH (''), TYPE).value('.', 'NVARCHAR(MAX)')
                    , 1, 2, '') AS terapi
                    FROM ORGANIZATIONUNIT;
                ", [$visit['visit_id']])->getRowArray();

            $farmaTime = $db->query("SELECT 
                                    STRING_AGG(CONVERT(VARCHAR, TREAT_DATE, 105), CHAR(13) + CHAR(10)) AS terapi_date
                                FROM treatment_obat
                    WHERE treatment_obat.visit_id = ? 
                    AND SOLD_STATUS IN (1, 6, 7)
                    AND BRAND_ID IS NOT NULL
                    AND DESCRIPTION NOT LIKE '%jasa%' 
                    AND quantity > 0
                ", [$visit['visit_id']])->getRowArray();


            $obatPulang = $db->query("SELECT STUFF(
                (SELECT CHAR(13) + CHAR(10) + description + 
                        ' qty: ' + CAST(CAST(quantity AS INT) AS VARCHAR) + 
                        ' (' + ISNULL(description2, '') + ')'
                FROM treatment_obat 
                WHERE treatment_obat.visit_id = ? 
                AND SOLD_STATUS IN (5)
                AND BRAND_ID IS NOT NULL
                AND DESCRIPTION NOT LIKE '%jasa%' 
                AND quantity > 0
                GROUP BY description, ISNULL(description2, ''), quantity
                FOR XML PATH (''), TYPE).value('.', 'NVARCHAR(MAX)')
            , 1, 2, '') AS terapi
            FROM ORGANIZATIONUNIT;
            ", [$visit['visit_id']])->getRowArray();


            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA,
                    MAX(TREAT_DATE) AS tanggal_selesai,
                    MIN(TREAT_DATE) AS tanggal_mulai

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '1'
                GROUP BY DESCRIPTION, DESCRIPTION2, TREAT_DATE
                "
            )->getResultArray());
            $selectrecipedischarge = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA,
                    MAX(TREAT_DATE) AS tanggal_selesai,
                    MIN(TREAT_DATE) AS tanggal_mulai

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '5'
                GROUP BY DESCRIPTION, DESCRIPTION2, TREAT_DATE
                "
            )->getResultArray());

            if ($farma) {
                $select['farmakologia_val'] = $farma['terapi'];
            }

            if ($farmaTime) {
                $select['farmakologia_date'] = $farmaTime['terapi_date'];
            }
            if ($obatPulang) {
                $select['farmakologia_pulang'] = $obatPulang['terapi'];
            }


            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $selectinfo = $visit;

            $sign = $this->checkSignDocs($vactination_id, 2);

            return [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe,
                "recipeDischarge" => $selectrecipedischarge,
                "sign" => $sign
            ];
        }
    }

    public function resume_medisSS($visit, $vactination_id = null)
    {
        // dd($vactination_id);
        $title = "Resume Medis";
        if (true) {
            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT top(1)
            pd.NO_REGISTRATION as no_RM,
            p.NAME_OF_PASIEN as nama,
            pd.PASIEN_DIAGNOSA_ID,
            pd.BODY_ID,
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end as jeniskel,
            p.CONTACT_ADDRESS as alamat,
            pd.DOCTOR as dpjp,
            c.name_of_clinic as departemen,
            class.NAME_OF_CLASS as kelas,
            cr.NAME_OF_CLASS as bangsal,
            pd.BED_ID as bed,
            pd.IN_DATE as tanggal_masuk,
            convert(varchar,P.DATE_OF_BIRTH,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' AS UMUR,
            gcs.GCS_E,
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE as gcs,
            pd.DIAGNOSA_ID as icd10,
            pd.DIAGNOSA_DESC as namadiagnosa,
            pd.DIAGNOSA_DESC_DISCHARGE as namadiagnosapulang,
            pd.ANAMNASE as anamnesis,
            pd.ALLOANAMNASE as alloanamnesis,
            pd.DESCRIPTION as riwayat_penyakit_sekarang,
            
            max(case when PH.value_id = 'G0090102'  then histories else '' end ) as riwayat_penyakit_dahulu,
            max(case when PH.value_id = 'G0090201'  then histories else '' end) as riwayat_alergi_obat,
            max(case when PH.value_id = 'G0090202'  then histories else '' end ) as riwayat_alergi_nonobat,
            max(case when PH.value_id = 'G0090101'  then histories else '' end ) as riwayat_penyakit_keluarga,
            max(case when PH.value_id = 'G0090301'  then histories else '' end ) as riwayat_alkohol,
            max(case when PH.value_id = 'G0090302'  then histories else '' end ) as riwayat_merokok,
            max(case when PH.value_id = 'G0090303'  then histories else '' end ) as riwayat_diet,
            max(case when PH.value_id = 'G0090401'  then histories else '' end ) as riwayat_obat_dikonsumsi,
            max(case when PH.value_id = 'G0090402'  then histories else '' end ) as riwayat_kehamilan,
            max(case when PH.value_id = 'G0090403'  then histories else '' end ) as riwayat_imunisasi,
            ei.WEIGHT as berat,
            ei.HEIGHT as tinggi,
            ei.TENSION_UPPER as tensi_atas,
            ei.TENSION_BELOW as tensi_bawah,
            ei.nadi,
            ei.TEMPERATURE AS Suhu,
            ei.NAFAS as respiration,
            ei.SATURASI AS SPO2,
            case when ei.HEIGHT <> 0 and ei.HEIGHT is not null then EI.WEIGHT/ ( (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) ) *  (CAST( EI.HEIGHT AS DECIMAL (5,2)) / CAST( 100 AS DECIMAL (5,2)) )  ) else 0 end AS IMT,
            isnull((select top(1) total_score from ASSESSMENT_FALL_RISK
            where DOCUMENT_ID = pd.BODY_ID order by EXAMINATION_DATE desc) ,'') as FALL_SCORE,
            isnull((select top(1) total_score from ASSESSMENT_PAIN_MONITORING
            where DOCUMENT_ID = pd.BODY_ID order by EXAMINATION_DATE desc) ,'') as PAIN_SCORE,
            max(case when ALO.value_id = 'G0020103'  then ALO.VALUE_DESC else '' end) as PF_KEPALA,
            max(case when ALO.value_id = 'G0020203'  then ALO.VALUE_DESC else '' end) as PF_MATA,
            max(case when ALO.value_id = 'G0020403'  then ALO.VALUE_DESC else '' end) as PF_HIDUNG,
            max(case when ALO.value_id = 'G0020303'  then ALO.VALUE_DESC else '' end) as PF_TELINGA,
            max(case when ALO.value_id = 'G0020503'  then ALO.VALUE_DESC else '' end) as PF_MULUT,
            max(case when ALO.value_id = 'G0020603'  then ALO.VALUE_DESC else '' end) as pf_LEHER,
            max(case when ALO.value_id = 'G0021403'  then ALO.VALUE_DESC else '' end) as PF_GIGI,
            max(case when ALO.value_id = 'G0020703'  then ALO.VALUE_DESC else '' end) as PF_THORAX,
            max(case when ALO.value_id = 'G0020703'  then ALO.VALUE_INFO else '' end) as LINK_THORAX,
            max(case when ALO.value_id = 'G0020803'  then ALO.VALUE_DESC else '' end) as PF_JANTUNG,
            max(case when ALO.value_id = 'G0020903'  then ALO.VALUE_DESC else '' end) as PF_PARU,
            max(case when ALO.value_id = 'G0021003'  then ALO.VALUE_DESC else '' end) as PF_PERUT,
            max(case when ALO.value_id = 'G0021003'  then ALO.VALUE_INFO else '' end) as GAMBAR_PERUT,
            max(case when ALO.value_id = 'G0021803'  then ALO.VALUE_DESC else '' end) as PF_hepar,
            max(case when ALO.value_id = 'G0021903'  then ALO.VALUE_DESC else '' end) as PF_lien,
            max(case when ALO.value_id = 'G0021303'  then ALO.VALUE_DESC else '' end) as PF_GINJAL,
            max(case when ALO.value_id = 'G0021703'  then ALO.VALUE_DESC else '' end) as PF_GENITAIS,
            max(case when ALO.value_id = 'G0021503'  then ALO.VALUE_DESC else '' end) as PF_EKSTERMITAS_ATAS,
            max(case when ALO.value_id = 'G0021603'  then ALO.VALUE_DESC else '' end) as PF_EXTERMINTAS_BAWAH,
            PD.DIAGNOSA_ID,
            PD.MEDICAL_PROBLEM AS MASALAH_MEDIS,
            'MASALAH_PERAWAT' AS MASALAH_PERAWAT,
            PD.HURT AS PENYEBAB_CIDERA,
            PD.THERAPY_TARGET AS SASARAN,
            PD.LAB_RESULT AS LABORATORIUM,
            PD.RO_RESULT AS RADIOLOGI,
            PD.TERAPHY_DESC AS FARMAKOLOGIA,
            PD.INSTRUCTION AS PROSEDUR,
            PD.STANDING_ORDER AS STANDING_ORDER,
            PD.DOCTOR AS DOKTER,
            PD.PROCEDURE_DESC,
            PD.PROCEDURE_DESC_DISCHARGE,
            PD.DISCHARGE_WAY,
            PD.DISCHARGE_CONDITION,
            specialist_type.specialist_type
            from pasien_diagnosa pd left outer join  clinic c on pd.clinic_id = c.clinic_id
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pd.CLASS_ROOM_ID
            left outer join class on class.CLASS_ID = cr.CLASS_ID
            left outer join PASIEN_HISTORY ph on ph.NO_REGISTRATION = pd.NO_REGISTRATION
            left outer join EXAMINATION_DETAIL ei on ei.body_id = pd.BODY_ID
            LEFT OUTER JOIN ASSESSMENT_LOKALIS ALO ON PD.BODY_ID = ALO.DOCUMENT_ID
            left outer join specialist_type on specialist_type.specialist_type_id = '" . $visit['specialist_type_id'] . "'
            left outer join ASSESSMENT_GCS gcs on pd.BODY_ID = gcs.DOCUMENT_ID,
            pasien p 
            where 
            pd.diag_cat = '1'
            and PD.VISIT_ID = '" . $visit['visit_id'] .
                "' -- 
            and pd.NO_REGISTRATION = p.NO_REGISTRATION
            
            group by 
            pd.PASIEN_DIAGNOSA_ID,
            pd.body_id,
            pd.NO_REGISTRATION, 
            p.NAME_OF_PASIEN, 
            case when p.gender = '1' then 'Laki-laki'
            else 'Perempuan' end, 
            p.CONTACT_ADDRESS,
            pd.DOCTOR, 
            c.name_of_clinic, 
            class.NAME_OF_CLASS,  
            cr.NAME_OF_CLASS,  
            pd.BED_ID,  
            pd.IN_DATE,
            pd.ANAMNASE, 
            pd.DESCRIPTION,
            ei.WEIGHT,
            ei.HEIGHT, 
            ei.TENSION_UPPER, 
            ei.TENSION_BELOW, 
            ei.nadi,
            ei.NAFAS, 
            ei.SATURASI,
            ei.TEMPERATURE,
            convert(varchar,P.date_of_birth,105),
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR',
            gcs.GCS_E, 
            gcs.GCS_m,
            gcs.GCS_V, 
            gcs.GCS_SCORE, 
            pd.ALLOANAMNASE,
            pd.DIAGNOSA_ID,
            pd.DIAGNOSA_DESC,
            pd.DIAGNOSA_DESC_DISCHARGE,
            PD.DIAGNOSA_ID,
            PD.HURT, 
            PD.MEDICAL_PROBLEM, 
            THERAPY_TARGET,
            PD.LAB_RESULT, 
            PD.RO_RESULT,
            PD.TERAPHY_DESC, 
            PD.INSTRUCTION, 
            PD.STANDING_ORDER, 
            PD.DOCTOR,
            PD.PROCEDURE_DESC,
            PD.PROCEDURE_DESC_DISCHARGE,
            PD.DISCHARGE_WAY,
            PD.DISCHARGE_CONDITION,
            specialist_type.specialist_type,
            pd.date_of_diagnosa 
            
            order by pd.date_of_diagnosa desc")->getRow(0, "array"));
            // dd($select);
            $vactination_id = @$select['pasien_diagnosa_id'];
            $select['gcs_display'] = $this->getGCSDisplay(@$select['gcs']);


            $selectlokalis2 = $this->lowerKey($db->query(
                "
                select assessment_lokalis.*, ASSESSMENT_PARAMETER_VALUE.VALUE_DESC as nama_lokalis from assessment_lokalis
                INNER JOIN ASSESSMENT_PARAMETER_VALUE ON assessment_lokalis.VALUE_ID = ASSESSMENT_PARAMETER_VALUE.VALUE_ID
                inner join MAPPING_ASSESSMENT_SPECIALIST MAS ON MAS.SPECIALIST_TYPE_ID = '1.00' and ASSESSMENT_LOKALIS.VALUE_ID = MAS.DOC_ID
                where body_id = '$vactination_id' AND assessment_lokalis.VALUE_SCORE = 2
                order by mas.theorder"
            )->getResultArray());
            $selectrecipe = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '7'
                GROUP BY DESCRIPTION, DESCRIPTION2
                "
            )->getResultArray());
            $selectrecipedischarge = $this->lowerKey($db->query(
                "
                SELECT
                    DESCRIPTION AS RESEP,
                    DESCRIPTION2 AS SIGNATURA

                FROM treatment_obat
                WHERE VISIT_ID = '{$visit['visit_id']}'
                and sold_status = '5'
                GROUP BY DESCRIPTION, DESCRIPTION2
                "
            )->getResultArray());
            $hasilResultRad = $this->getHasilResultRadE($db, $visit['visit_id']);
            $radiologi = $this->getRadiologiDataE($db, $hasilResultRad);
            $queryTreatmenBill = $this->getTreatmentBillE($db, $visit['trans_id'], null, $visit['no_registration']);
            $kirimlisData = $this->getKirimlisDataE($db, $queryTreatmenBill); // New function
            // return $queryTreatmenBill;
            $laboratorium = $this->getLaboratoriumDataE($db, $kirimlisData, $visit); // New function

            $visit_id = $visit['visit_id'];
            $trans_id = $visit['trans_id'];


            $db = db_connect();
            $procbedah = $db->query("select TARIF_ID as treatment From PASIEN_OPERASI where trans_id = '$trans_id' and terlayani <> '4'")->getResultArray();
            $procnonbedah = $db->query("select treatment from treatment_bill tb inner join treat_tarif tt on tt.tarif_id = tb.tarif_id where tb.trans_id = '$trans_id' and tt.casemix_id = 1")->getResultArray();


            $selectorganization = $this->lowerKey($db->query("SELECT * FROM ORGANIZATIONUNIT")->getRow(0, 'array'));
            $selectinfo = $visit;

            $sign = $this->checkSignDocs(@$select['pasien_diagnosa_id'], 2);

            // dd($sign);
            return [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "organization" => $selectorganization,
                "info" => $selectinfo,
                "lokalis2" => $selectlokalis2,
                "recipe" => $selectrecipe,
                "recipeDischarge" => $selectrecipedischarge,
                "procbedah" => $procbedah,
                "procnonbedah" => $procnonbedah,
                'radiologi_cetak' => $radiologi,
                'get_treat' => [],
                'lab' => $laboratorium,
                "sign" => $sign
            ];
        }
    }

    private function getGCSDisplay($totalScore)
    {
        $gcsArray = ['-', 'Composmentis', 'Apatis', 'Delirium', 'Samnolen', 'Sopor', 'Coma'];
        $conclutionScore = 0;
        if ($totalScore >= 3 && $totalScore <= 8)
            $conclutionScore = 6;
        else if ($totalScore > 8 && $totalScore <= 12)
            $conclutionScore = 5;
        else if ($totalScore > 12 && $totalScore <= 14)
            $conclutionScore = 4;
        else if ($totalScore > 14 && $totalScore <= 15)
            $conclutionScore = 1;

        return $gcsArray[$conclutionScore];
        // else if (totalScore > 16 && totalScore <= 18)
        //     conclutionScore = 2
        // else if (totalScore > 18 && totalScore <= 20)
        //     conclutionScore = 1

        // var e = ($("#GEN001101" + bodyId).val() === null) ? 0 : $("#GEN001101" + bodyId).val();
        // var v = ($("#GEN001102" + bodyId).val() === null) ? 0 : $("#GEN001102" + bodyId).val();
        // var m = ($("#GEN001103" + bodyId).val() === null) ? 0 : $("#GEN001103" + bodyId).val();

        // if (parseInt(v) == 0) {

        //     $('#GCS_SCORE' + bodyId).val(0)
        //     $('#GCS_DESC' + bodyId).val(0)
        // } else {
        //     var totalScore = parseInt(e) + parseInt(m) + parseInt(v)
        //     var conclutionScore = 0
        //     if (totalScore >= 3 && totalScore <= 8)
        //         conclutionScore = 6
        //     else if (totalScore > 8 && totalScore <= 12)
        //         conclutionScore = 5
        //     else if (totalScore > 12 && totalScore <= 14)
        //         conclutionScore = 4
        //     else if (totalScore > 14 && totalScore <= 15)
        //         conclutionScore = 1
        //     // else if (totalScore > 16 && totalScore <= 18)
        //     //     conclutionScore = 2
        //     // else if (totalScore > 18 && totalScore <= 20)
        //     //     conclutionScore = 1

        //     $('#GCS_SCORE' + bodyId).val(totalScore)
        //     $('#GCS_DESC' + bodyId).val(conclutionScore)
        // }
    }
    private function cetaksuratKetDiagE($visit)
    {

        $db = db_connect();

        $select = $this->lowerKey($db->query("SELECT
                        pv.DIANTAR_OLEH,
                        cast(pv.AGEYEAR as varchar(3)) + 'th '+ cast(pv.AGEMONTH as varchar(3)) + 'bl ' + cast(pv.AGEDAY as varchar(3)) + 'hr' usia,
                        pv.GENDER,
                        pv.VISITOR_ADDRESS,
                        pv.VISIT_date,
                        pd.TERAPHY_DESC,
                        '' keterangan, 
                        '' tindakan,
                        farmakoterapi = replace (replace( STUFF( (SELECT '-' + DESCRIPTION  + char(13)+char(10)
                        FROM treatment_OBAT tb2
                        WHERE tb2.visit_id = pv.visit_id
                        and SOLD_STATUS in (1,5,6,7)  and tb2.BRAND_ID is not null
                        group by description
                        FOR XML PATH (''))
                        , 1, 1, '')  ,'&#x0D','') ,'-',''),
                        getdate() as valid_user
       
                FROM pasien_visitation pv 
                left outer join EXAMINATION_INFO pD on pv.VISIT_ID = pD.VISIT_ID
                where  pv.visit_id = '" . $visit['visit_id'] . "' 
				and pd.petugas_type = '11';")->getRowArray() ?? []);

        if (!empty($select)) {
            $employeeId = $visit['employee_id'] ?? '';
            $ttdBase64 = null;
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $ttdDir = $this->imageloc . "uploads/dokter/";

            if (!empty($employeeId)) {
                foreach ($allowedExtensions as $ext) {
                    $filePath = $ttdDir . $employeeId . '.' . $ext;
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }

            $select['ttd_dok'] = $ttdBase64;
        }

        return [
            "val" => $select
        ];
    }

    private function cetakPerintahInapE($visit)
    {
        $title = "Surat Perintah Rawat Inap";
        if ($this->request->is('get')) {

            $db = db_connect();
            $select = $this->lowerKey($db->query("SELECT
            INASIS_KONTROL.NOSEP,  
            INASIS_KONTROL.TGLRENCKONTROL AS TGL_KONTROL_SELANJUTNYA,  
            INASIS_KONTROL.POLIKONTROL_KDPOLI,   
            INASIS_KONTROL.POLIKONTROL_NMPOLI,  
            INASIS_KONTROL.KODEDOKTER,
            INASIS_KONTROL.MODIFIED_BY,   
            INASIS_KONTROL.MODIFIED_DATE,   
            INASIS_KONTROL.NOSURATKONTROL,
            INASIS_KONTROL.SURATTYPE,
            PD.THEID as NO_bpjS,
            PD.THENAME as nama,
            pd.THEADDRESS as alamat,
            CASE WHEN pd.GENDER = '1' THEN 'Laki-Laki'
            else 'Perempuan' end as jeniskel,
            PD.NO_REGISTRATION AS NO_RM, 
            convert(varchar,PV.tgl_lahir,105) as date_of_birth,
            CAST(PD.AGEYEAR AS VARCHAR(2)) + ' th ' + CAST(PD.AGEMONTH AS VARCHAR(2)) + ' BL ' + 
            CAST(PD.AGEDAY AS VARCHAR(2)) + ' HR' as UMUR,
            Pd.DIAGNOSA_DESC as diagnosis,
            PD.DIAGNOSA_ID as kode_diagnosa,
            pd.TERAPHY_DESC as farmakologi,
            igt.nama as alasan_kontrol,
            inasis_kontrol.DOCTOR as dpjp,
            pd.IN_DATE as tgl_masuk,
            cr.NAME_OF_CLASS,
            pd.BED_ID no_tt,
            c.NAME_OF_CLASS as kelas,
            st.SPECIALIST_TYPE as department,
            PD.INSTRUCTION as INTRUKSI,
            INASIS_KONTROL.valid_user,
            INASIS_KONTROL.valid_pasien,
            INASIS_KONTROL.valid_date,
            pt.notes,
            ea.fullname,
            ea.EMPLOYEE_ID,
            clinic.name_of_clinic,
            pt.other_notes
            
            from PASIEN_TRANSFER pt inner join
            INASIS_KONTROL on pt.DOCUMENT_ID = INASIS_KONTROL.NOSKDP_RS 
            inner join  pasien_visitation pv on inasis_kontrol.visit_id = pv.visit_id 
            inner join pasien_DIAGNOSA pD on INASIS_KONTROL.VISIT_ID = pD.VISIT_ID
            left outer join INASIS_GET_TINDAKLANJUT igt on  isnull(rencanatl,1) = igt.kode
            left outer join CLASS_ROOM cr on cr.CLASS_ROOM_ID = pv.CLASS_ROOM_ID
            left outer join class c on c.CLASS_ID = cr.CLASS_ID
            left outer join SPECIALIST_TYPE st on st.SPECIALIST_TYPE_ID = pd.SPESIALISTIK
            left outer join employee_all ea on ea.employee_id = pt.employee_id
            left outer join clinic on clinic.clinic_id = '{$visit['clinic_id']}'
            where  pt.visit_id = '" . $visit['visit_id'] . "' 
            and surattype = '2' order by pd.pasien_diagnosa_id desc")->getRowArray());

            // dd($select);

            $employeeId = $select['employee_id'] ?? '';
            $ttdBase64 = null;
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

            $ttdDir =  $this->imageloc . "uploads/dokter/";

            if (!empty($employeeId)) {
                foreach ($allowedExtensions as $ext) {
                    $filePath = $ttdDir . $employeeId . '.' . $ext;
                    if (file_exists($filePath)) {
                        $fileData = file_get_contents($filePath);
                        $mimeType = mime_content_type($filePath);
                        $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                        break;
                    }
                }
            }


            return  [
                "visit" => $visit,
                'title' => $title,
                "val" => $select,
                "ttd_dok" => $ttdBase64
            ];
        }
    }

    public function filterObat()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();


        $check = $this->lowerKey($db->query("SELECT DESCRIPTION,TREATMENT FROM TREATMENT_OBAT 
                        WHERE NO_REGISTRATION = ?  
                        AND brand_id IS NOT NULL 
                        AND NUMER = 2", [$formData->no_regis])
            ->getResultArray() ?? []);

        return $this->response->setJSON([
            'value' => $check
        ]);
    }

    public function labRequestHasilSelect()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
        $getDataHasilLis = $this->lowerKey($db->query("SELECT 
                                                        h.kode_kunjungan,
                                                        k.No_Pasien,
                                                        h.nolab_lis,
														k.tarif_name as tarif_names,
                                                        MAX(h.reg_date) AS reg_date  
                                                    FROM 
                                                        sharelis.dbo.kirimlis k
                                                    JOIN 
                                                        sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
                                                    WHERE 
                                                        k.No_Pasien = ?
                                                        AND k.KODE IN 
														(SELECT BILL_ID FROM TREATMENT_BILL 
															WHERE NO_REGISTRATION = ? AND 
															TRANS_ID = ?)
                                                    GROUP BY 
                                                        h.kode_kunjungan,  
                                                        k.No_Pasien,  
														k.tarif_name,
                                                        h.nolab_lis
                                                        ", [$formData->no_regis, $formData->no_regis, $formData->trans_id])->getResultArray());

        return $this->response->setJSON([
            'value' => $getDataHasilLis
        ]);
    }


    public function laboratorium_cetakKronisFilter($visit, $data = null)
    {
        $title = "HASIL PEMERIKSAAN LABORATORIUM";
        if ($this->request->is('get')) {
            $data = base64_decode($data);
            $data = json_decode($data, true);

            $db = db_connect();
            $kopprintData = $this->getKopprintDataE($db);

            $getDataHasilLis = $this->lowerKey($db->query("
                SELECT 
                    h.kode_kunjungan
                FROM 
                    sharelis.dbo.kirimlis k
                JOIN 
                    sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
                JOIN TREATMENT_BILL tb on k.kode = tb.BILL_ID
                WHERE 
                    k.No_Pasien = ?
                    AND
                    tb.trans_id = ?
                GROUP BY 
                    h.kode_kunjungan;
            ", [$visit['no_registration'], $visit['trans_id']])->getResultArray());

            if (empty($data) || $data === "semua") {
                $data = array_column($getDataHasilLis, 'kode_kunjungan');
            }

            if (!empty($data)) {
                $placeholders = implode(',', array_fill(0, count($data), '?'));
            } else {
                return [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData,
                    'dataTablesLab' => []
                ];
            }

            $dataTables = $this->lowerKey($db->query("
                SELECT H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, kel_pemeriksaan, urut_bound, h.TGL_HASIL_SELESAI, h.Catatan, h.Rekomendasi,
                    PARAMETER_NAME, hasil, satuan, NILAI_RUJUKAN, METODE_PERIKSA, null as kode,
                    reg_date AS tgl_hasil, norm, k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, 
                    k.pengirim_name, k.ruang_name, k.kelas_name, k.Tgl_Periksa, h.flag_hl, k.diagnosa_desc, h.valid_user, h.valid_date, k.indication_desc
                FROM sharelis.dbo.hasillis h
                LEFT JOIN sharelis.dbo.kirimlis k ON h.norm COLLATE database_default = k.no_pasien COLLATE database_default 
                    AND H.kode_kunjungan = K.Kode_Kunjungan
                WHERE H.kode_kunjungan IN ($placeholders)
                ORDER BY urut_bound, kode_kunjungan, tarif_id
            ", $data)->getResultArray());

            $doctor = $this->lowerKey($db->query("SELECT fullname from EMPLOYEE_ALL where NONACTIVE= 0 and employee_id in (select employee_id from DOCTOR_SCHEDULE where clinic_id ='P013')")->getRowArray());

            if ($doctor) {
                $visit['doctor_responsible'] = $doctor['fullname'];
            }

            $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $ttdDir = $this->imageloc . "uploads/dokter/";
            $groupedData = [];
            foreach ($dataTables as &$row) {
                $ttdBase64 = null;
                $validUser = $row['valid_user'] ?? '';

                if (!empty($validUser)) {
                    $dokterValidasi = $this->lowerKey($db->query("
                        SELECT employee_id 
                        FROM EMPLOYEE_ALL 
                        WHERE NONACTIVE = 0 AND fullname LIKE ?
                    ", ['%' . $validUser . '%'])->getRowArray());

                    if ($dokterValidasi && isset($dokterValidasi['employee_id'])) {
                        $employeeId = $dokterValidasi['employee_id'];

                        foreach ($allowedExtensions as $ext) {
                            $filePath = $ttdDir . $employeeId . '.' . $ext;
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }

                $row['ttd_dokter_validasi'] = $ttdBase64;

                $kode = $row['kode_kunjungan'];
                if (!isset($groupedData[$kode])) {
                    $groupedData[$kode] = [];
                }
                $groupedData[$kode][] = $row;
            }

            return [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData,
                'dataTablesLab' => $groupedData
            ];
        }
    }

    public function laboratorium_cetak_all($visit, $data = null)
    {
        $title = "HASIL PEMERIKSAAN LABORATORIUM";
        if ($this->request->is('get')) {
            $data = base64_decode($data);
            $data = json_decode($data, true);

            $db = db_connect();
            $kopprintData = $this->getKopprintDataE($db);

            $getDataHasilLis = $this->lowerKey($db->query("SELECT 
                    --h.kode_kunjungan
                   	h.NOLAB_LIS,
					h.PENGIRIM,
					h.valid_user
                FROM 
                    sharelis.dbo.kirimlis k
                JOIN 
                    sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.kode_kunjungan
                JOIN TREATMENT_BILL tb on k.kode = tb.BILL_ID
                WHERE 
                    k.No_Pasien = ?
                    AND
                    tb.trans_id = ?
                GROUP BY 
                    --h.kode_kunjungan
                   	h.NOLAB_LIS,
					h.PENGIRIM,
					h.valid_user;
            ", [$visit['no_registration'], $visit['trans_id']])->getResultArray());

            if (empty($data) || $data === "semua") {
                $data = array_column($getDataHasilLis, 'nolab_lis');
            }

            if (!empty($data)) {
                $placeholders = implode(',', array_fill(0, count($data), '?'));
            } else {
                return [
                    "visit" => $visit,
                    'title' => $title,
                    'kop' => $kopprintData,
                    'dataTablesLab' => []
                ];
            }

            $dataTables = $this->lowerKey($db->query("SELECT
                    h.nolab_lis, h.kode_kunjungan, h.tarif_id, h.tarif_name, h.kel_pemeriksaan,
                    h.urut_bound, h.TGL_HASIL_SELESAI, h.Catatan, h.Rekomendasi, h.PARAMETER_NAME,
                    h.hasil, h.satuan, h.NILAI_RUJUKAN, h.METODE_PERIKSA, NULL as kode,
                    h.reg_date AS tgl_hasil, h.norm,
                    k.nama, k.alamat, k.date_of_birth, k.cara_bayar_name, k.pengirim_name,
                    k.ruang_name, k.kelas_name, k.Tgl_Periksa, h.flag_hl,
                    k.diagnosa_desc, h.valid_user, h.valid_date, k.indication_desc
                FROM sharelis.dbo.hasillis h
                OUTER APPLY (
                    SELECT TOP 1 *
                    FROM sharelis.dbo.kirimlis k
                    WHERE k.no_pasien COLLATE database_default = h.norm COLLATE database_default
                    AND k.Kode_Kunjungan = h.kode_kunjungan
                    ORDER BY k.Tgl_Periksa DESC
                ) k
                WHERE h.nolab_lis IN ($placeholders)
                ORDER BY h.urut_bound, h.kode_kunjungan, h.tarif_id;
            ", $data)->getResultArray());

            $doctor = $this->lowerKey($db->query("SELECT fullname from EMPLOYEE_ALL where NONACTIVE= 0 and employee_id in (select employee_id from DOCTOR_SCHEDULE where clinic_id ='P013')")->getRowArray());

            if ($doctor) {
                $visit['doctor_responsible'] = $doctor['fullname'];
            }

            $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $ttdDir = $this->imageloc . "uploads/dokter/";
            $groupedData = [];
            foreach ($dataTables as &$row) {
                $ttdBase64 = null;
                $validUser = $row['valid_user'] ?? '';

                if (!empty($validUser)) {
                    $dokterValidasi = $this->lowerKey($db->query("
                        SELECT employee_id 
                        FROM EMPLOYEE_ALL 
                        WHERE NONACTIVE = 0 AND fullname LIKE ?
                    ", ['%' . $validUser . '%'])->getRowArray());

                    if ($dokterValidasi && isset($dokterValidasi['employee_id'])) {
                        $employeeId = $dokterValidasi['employee_id'];

                        foreach ($allowedExtensions as $ext) {
                            $filePath = $ttdDir . $employeeId . '.' . $ext;
                            if (file_exists($filePath)) {
                                $fileData = file_get_contents($filePath);
                                $mimeType = mime_content_type($filePath);
                                $ttdBase64 = 'data:' . $mimeType . ';base64,' . base64_encode($fileData);
                                break;
                            }
                        }
                    }
                }

                $row['ttd_dokter_validasi'] = $ttdBase64;

                $key = $row['nolab_lis'] . '|' . $row['pengirim_name'] . '|' . $row['valid_user'];

                if (!isset($groupedData[$key])) {

                    $groupedData[$key] = [
                        'nolab_lis' => $row['nolab_lis'],
                        'pengirim' => $row['pengirim_name'],
                        'valid_user' => $row['valid_user'],
                        // 'ttd_dokter_validasi' => $row['ttd_dokter_validasi'],
                        'items' => []
                    ];
                }

                $groupedData[$key]['items'][] = $row;
            }


            return [
                "visit" => $visit,
                'title' => $title,
                'kop' => $kopprintData,
                'dataTablesLab' => $groupedData
            ];
        }
    }


    private function cetaktbc($visit)
    {

        $db = db_connect();
        $getDataHasilLis = $this->lowerKey($db->query("SELECT * FROM assessment_tbc WHERE trans_id = ? 
                                                        ", [$visit['trans_id']])->getRowArray() ?? []);

        return [
            "data" => $getDataHasilLis,

        ];
    }

    private function renderFileLaborat($visit)
    {
        $noPasien = $visit['no_registration'];
        // $noPasien = '014361';
        $db = db_connect();

        $kirimLis = $db->query("
           SELECT 
                k.nolab_lis,
                MAX(k.No_Pasien) AS No_Pasien,
                MAX(k.Kode_Kunjungan) AS kode_kunjungan,
                MAX(k.tarif_name) AS tarif_names,
                MAX(k.Tgl_Periksa) AS tgl_periksa,
                'KIRIMLIS' AS source
            FROM 
                sharelis.dbo.kirimlis k
            LEFT JOIN 
                sharelis.dbo.hasillis h ON k.Kode_Kunjungan = h.Kode_Kunjungan
            WHERE 
                k.No_Pasien = ?
            GROUP BY 
                k.nolab_lis;

            
        ", [$noPasien])->getResultArray();

        $penunjang = $db->query("
            SELECT 
                PP.BILL_ID AS kode_kunjungan, PP.NO_REGISTRATION AS No_Pasien, 
                PP.nOTA_NO AS nolab_lis, TB.TREATMENT AS tarif_names,
                PP.TREAT_date AS tgl_periksa, 'PENUNJANG' AS source
            FROM PASIEN_PENUNJANG PP
            JOIN TREATMENT_BILL TB ON TB.BILL_ID = PP.BILL_ID
            WHERE PP.NO_REGISTRATION = ? AND PP.file_image IS NOT NULL
        ", [$noPasien])->getResultArray();



        $allData = array_merge($kirimLis, $penunjang);

        $result = [];

        foreach ($allData as $row) {
            $kodeKunjungan = $row['nolab_lis'];

            if ($row['source'] === 'KIRIMLIS') {
                $serverPath = "\\\\192.168.100.99\\rujukan\\$kodeKunjungan\\";
                // $serverPath = $this->imageloc ."rujukan\\{$kodeKunjungan}\\";
                if (is_dir($serverPath)) {
                    $files = glob($serverPath . "*.{pdf,jpg,jpeg,png}", GLOB_BRACE);
                    foreach ($files as $file) {
                        $result[] = array_merge($row, ['file_name' => basename($file)]);
                    }
                }
            } else {
                $result[] = array_merge($row, ['file_name' => $row['tarif_names']]);
            }
        }


        $dataTables = [];

        foreach ($result as $row) {
            $folder = $row['kode_kunjungan'];
            $folderKirim = $row['nolab_lis'];
            $fileName = $row['file_name'];

            if ($row['source'] === 'KIRIMLIS') {
                $filePath = "\\\\192.168.100.99\\rujukan\\{$folderKirim}\\{$fileName}";
                // $filePath = $this->imageloc . "rujukan/{$folderKirim}/{$fileName}";

            } else {
                $filePath = $this->imageloc . "uploads/lab/{$folder}/{$fileName}";
            }

            $fileInfo = [
                'file_image_base64' => null,
                'file_url' => null,
                'file_name' => $fileName,
                'kode_kunjungan' => $folder,
                'source' => $row['source'],
            ];

            if (file_exists($filePath)) {
                $fileInfo['file_image_base64'] = "data:" . mime_content_type($filePath) . ";base64," . base64_encode(file_get_contents($filePath));
                $fileInfo['file_url'] = $filePath;
            }

            $dataTables[] = $fileInfo;
        }


        return ["data" => $dataTables];
    }


    private function cetakPenMedis($visit)
    {
        $db = db_connect();
        $finalData = [];

        $sqlTreat = "
            SELECT tarif_id, bill_id
            FROM TREATMENT_BILL 
            WHERE VISIT_ID = :visit_id: 
            AND (
                TREATMENT LIKE '%USG%' 
                OR TREATMENT LIKE '%EKG%' 
                OR TREATMENT LIKE '%ECG%'
            ) AND clinic_id <> 'P016'
        ";

        $treatments = $this->lowerKey(
            $db->query($sqlTreat, ['visit_id' => $visit['visit_id']])->getResultArray() ?? []
        );

        foreach ($treatments as $row) {
            $tarif_id = $row['tarif_id'];
            $bill_id  = $row['bill_id'];

            $result = $this->lowerKey(
                $db->query("
                    SELECT * 
                    FROM TREAT_RESULTS 
                    WHERE BILL_ID = :bill_id: AND TARIF_ID = :tarif_id:
                    AND (
                        TARIF_NAME LIKE '%USG%' 
                        OR TARIF_NAME LIKE '%EKG%' 
                        OR TARIF_NAME LIKE '%ECG%'
                    )
                ", ['bill_id' => $bill_id, 'tarif_id' => $tarif_id])->getResultArray() ?? []
            );

            if (!empty($result)) {
                $treat_bound = $this->lowerKey(
                    $db->query("
                            SELECT reagent_id, description 
                            FROM TREAT_BOUND_DIAGNOSA 
                            WHERE tarif_id = :tarif_id:
                    ", ['tarif_id' => $tarif_id])->getResultArray() ?? []
                );

                $finalData[] = [
                    'bill'   => $row,
                    'bound'  => $treat_bound,
                    'result' => $result,
                ];
            }
        }

        return [
            'data' => $finalData
        ];
    }


    public function getdateexit()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
    
        $result = $db->query(
            "SELECT EXAMINATION_DATE 
             FROM PASIEN_TRANSFER 
             WHERE NO_REGISTRATION = ? AND TRANS_ID = ? 
             ORDER BY EXAMINATION_DATE DESC",
            [$formData->no_regis, $formData->trans_id]
        )->getRowArray();
    
        $query = $this->lowerKey($result);
    
        return $this->response->setJSON([
            'value' => $query,
            'status' => $query ? true : false
        ]);
    }
    
}