<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\Assessment\NutritionModel;
use App\Models\FoodRecallModel;
use App\Models\GiziModel;
use App\Models\InterventionModel;
use App\Models\PasienDiagnosasModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\RawSql;
use Exception;

class Gizi extends \App\Controllers\BaseController
{

    public function getAsuhanGizi()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }


        $query = $db->query("
        SELECT TOP(1) WEIGHT, HEIGHT, AGEYEAR, EXAMINATION_DATE 
        FROM EXAMINATION_INFO 
        WHERE visit_id = '" . $formData->visit_id . "' ORDER BY EXAMINATION_DATE DESC");
        $results = $this->lowerKey($query->getRowArray() ?? []);

        $biokimia = $db->query("select tarif_name,hasil from sharelis.dbo.hasillis where KODE_KUNJUNGAN =  '" . $formData->visit_id . "'");
        $biokimia = $this->lowerKey($biokimia->getRowArray() ?? []);

        $riwayat_alergi = $db->query("select histories from pasien_history where NO_REGISTRATION = '" . $formData->no_registration . "' and VALUE_ID = 'G0090101'");
        $riwayat_alergi = $this->lowerKey($riwayat_alergi->getRowArray() ?? []);
        $biokimia = $this->lowerKey($db->query("SELECT
                    tb.treatment
                     from treatment_bill tb, pasien p,clinic c, status_pasien s,class k
                    where tb.no_registration = p.no_registration
                    and tb.clinic_id ='P013' 
                    and tb.trans_id ='" . $formData->trans_id . "'
                    and c.clinic_id = tb.CLINIC_ID_FROM
                    and tb.CLASS_ID =k.CLASS_ID
                    and tb.status_pasien_id = s.STATUS_PASIEN_ID
                    AND tb.no_registration = '" . $formData->no_registration . "'
                    and tb.bill_id not in (select kode from sharelis.dbo.kirimlis)
                    ORDER BY tb.treat_date")->getResultArray() ?? []);

        $biokimia = array_column($biokimia, 'treatment');
        $biokimia = implode(", ", $biokimia);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
            'biokimia' => $biokimia,
            'alergi' => $riwayat_alergi
        ]);
    }
    public function getGiziByID()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $query = $db->query("
        SELECT TOP(1) ASSESSMENT_NUTRITION.*, weight, height, ageyear,AGE_RANGE.DISPLAY as age_display,ASSESSMENT_NUTRITION_HABIT.DIETARY_HABIT  FROM ASSESSMENT_NUTRITION
        LEFT JOIN EXAMINATION_INFO ON ASSESSMENT_NUTRITION.VISIT_ID = EXAMINATION_INFO.VISIT_ID
        LEFT JOIN ASSESSMENT_NUTRITION_HABIT ON ASSESSMENT_NUTRITION.pola_makan = ASSESSMENT_NUTRITION_HABIT.habit_id
        LEFT JOIN AGE_RANGE ON ASSESSMENT_NUTRITION.age_category = AGE_RANGE.age_range
        WHERE ASSESSMENT_NUTRITION.visit_id ='" . $formData->visit_id . "' AND ASSESSMENT_NUTRITION.BODY_ID = '" . $formData->body_id . "'
        ORDER BY EXAMINATION_INFO.EXAMINATION_DATE DESC");

        $results = $this->lowerKey($query->getRowArray() ?? []);

        $biokimia = $db->query("select tarif_name,hasil from sharelis.dbo.hasillis where KODE_KUNJUNGAN =  '" . $formData->visit_id . "'");
        $biokimia = $this->lowerKey($biokimia->getRowArray() ?? []);

        $riwayat_alergi = $db->query("select histories from pasien_history where NO_REGISTRATION = '" . $formData->no_registration . "' and VALUE_ID = 'G0090101'");
        $riwayat_alergi = $this->lowerKey($riwayat_alergi->getRowArray() ?? []);
        // $biokimia = [
        //     "ASAM URAT" => "5.1",
        //     "CHOLESTEROL" => "222",
        //     "ELEKTROLIT (Na, K, Ca)" => "100"
        // ];
        $biokimia = array_map(function ($key, $value) {
            return $key . ': ' . $value;
        }, array_keys($biokimia), $biokimia);

        // Join the formatted strings with newline characters
        $biokimia = implode(", ", $biokimia);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
            'biokimia' => $biokimia,
            'alergi' => $riwayat_alergi
        ]);
    }
    public function getAgeRange()
    {
        $db = db_connect();

        $query = $db->query(
            "
            select * from AGE_RANGE
            "
        )->getResultArray();

        $results = $this->lowerKey($query ?? []);

        return $this->response->setJSON([
            'respon'  => true,
            'data'    => $results
        ]);
    }

    public function getDataGizi()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $model = new GiziModel();

        $results = $this->lowerKey($model->where('visit_id', $formData->visit_id)->findAll() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }

    public function getAssessmentServices()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->document_id)) {
            return $this->response->setJSON([]);
        }

        $modelDiagnosa = new PasienDiagnosasModel();
        $modelFoodRecall = new FoodRecallModel();
        $modelIntervensi = new InterventionModel();

        $dataDiagnosa = $this->lowerKey($modelDiagnosa->where('pasien_diagnosa_id', $formData->document_id)->findAll() ?? []);
        $dataFoodRecall = $this->lowerKey($modelFoodRecall->where('visit_id', $formData->visit_id)->where('document_id', $formData->document_id)->findAll() ?? []);
        $dataIntervensi = $this->lowerKey($modelIntervensi->where('visit_id', $formData->visit_id)->where('document_id', $formData->document_id)->findAll() ?? []);

        $data = [
            'diagnosa' => $dataDiagnosa,
            'recall' => $dataFoodRecall,
            'intervensi' => $dataIntervensi
        ];
        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $data
        ]);
    }

    public function getDataDiagnosaGizi()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->document_id)) {
            return $this->response->setJSON([]);
        }

        $model = new PasienDiagnosasModel();

        $results = $this->lowerKey($model->where('pasien_diagnosa_id', $formData->document_id)->findAll() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }
    public function getDataFoodRecall()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $model = new FoodRecallModel();

        $results = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('document_id', $formData->document_id)->findAll() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }
    public function getDataIntervensi()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $model = new InterventionModel();

        $results = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('document_id', $formData->document_id)->findAll() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }

    public function getFoodRecallByID()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $model = new FoodRecallModel();

        $results = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('recall_id', $formData->recall_id)->first() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }

    public function getIntervensiByID()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $model = new InterventionModel();

        $results = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('body_id', $formData->body_id)->first() ?? []);

        $results['intervention_description'] = explode(', ', $results['intervention_description']);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }
    public function getMonitoring()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }

        $model = new InterventionModel();

        $resultsIntervensi = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('body_id', $formData->body_id)->first() ?? []);


        $query = $db->query("
        SELECT TOP(1) ASSESSMENT_NUTRITION.*, weight, height, ageyear,AGE_RANGE.DISPLAY as age_display,ASSESSMENT_NUTRITION_HABIT.DIETARY_HABIT  FROM ASSESSMENT_NUTRITION
        LEFT JOIN EXAMINATION_INFO ON ASSESSMENT_NUTRITION.VISIT_ID = EXAMINATION_INFO.VISIT_ID
        LEFT JOIN ASSESSMENT_NUTRITION_HABIT ON ASSESSMENT_NUTRITION.pola_makan = ASSESSMENT_NUTRITION_HABIT.habit_id
        LEFT JOIN AGE_RANGE ON ASSESSMENT_NUTRITION.age_category = AGE_RANGE.age_range
        WHERE ASSESSMENT_NUTRITION.visit_id ='" . $formData->visit_id . "' AND ASSESSMENT_NUTRITION.BODY_ID = '" . $resultsIntervensi['document_id'] . "'
        ORDER BY EXAMINATION_INFO.EXAMINATION_DATE DESC");

        $results = $this->lowerKey($query->getRowArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => [
                'gizi' => $results,
                'intervensi' => $resultsIntervensi
            ]
        ]);
    }


    public function insertAsuhanGizi()
    {
        try {
            $db = db_connect();
            $db->transStart();
            $formData = $this->request->getJSON();
            $data = [];
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }

            $polaMakanExist = $this->lowerKey($db->query(
                "
                SELECT * FROM ASSESSMENT_NUTRITION_HABIT
                WHERE HABIT_ID = '" . $data['pola_makan'] . "'
                "
            )->getRowArray() ?? []);

            if (empty($polaMakanExist)) {
                $lastId = $db->query("select top 1 HABIT_ID from ASSESSMENT_NUTRITION_HABIT order by HABIT_ID desc")->getRowArray()['HABIT_ID'];
                $queryHabit = $db->query("INSERT INTO ASSESSMENT_NUTRITION_HABIT (HABIT_ID, DIETARY_HABIT) VALUES ('" . $lastId + 1 . "','" . strtolower($data['pola_makan']) . "')");
                $data['pola_makan'] = $lastId + 1;
            }
            $data['body_id'] = $this->get_bodyid();
            $data['document_id'] = $this->get_bodyid();
            $data['modified_by'] = user()->username;

            $model = new GiziModel();

            $model->insert($data);

            $db->transCommit();
            return $this->response->setJSON([
                'message' => 'Sukses mengirim data.',
                'respon'  => true,
                'result' => $data
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function duplikatAsuhanGizi()
    {
        try {
            $formData = $this->request->getJSON();
            // $data = [];
            // foreach ($formData as $key => $value) {
            //     if (!is_array($value) && $value !== null && $value !== '') {
            //         $data[strtolower($key)] = $value;
            //     }
            // }
            // $data['body_id'] = $this->get_bodyid();
            // $data['document_id'] = $this->get_bodyid();
            // $data['modified_by'] = user()->username;

            $model = new GiziModel();
            $existingEntry = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('body_id', $formData->body_id)->first() ?? []);
            $data = $existingEntry;
            $data['body_id'] = $this->get_bodyid();
            $data['document_id'] = $this->get_bodyid();
            $data['modified_by'] = user()->username;
            $data['modified_date'] = date("Y-m-d H:i:s");
            // echo '<pre>';
            // var_dump($data);
            // die();
            $model->insert($data);

            return $this->response->setJSON([
                'message' => 'Sukses duplikasi data.',
                'respon'  => true,
                'result' => $data
            ]);
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat duplikasi data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function editAsuhanGizi()
    {
        try {
            $db = db_connect();
            $db->transStart();
            $formData = $this->request->getJSON();
            $data = [];
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }

            $polaMakanExist = $this->lowerKey($db->query(
                "
                SELECT * FROM ASSESSMENT_NUTRITION_HABIT
                WHERE HABIT_ID = '" . $data['pola_makan'] . "'
                "
            )->getRowArray() ?? []);

            if (empty($polaMakanExist)) {
                $lastId = $db->query("select top 1 HABIT_ID from ASSESSMENT_NUTRITION_HABIT order by HABIT_ID desc")->getRowArray()['HABIT_ID'];
                $queryHabit = $db->query("INSERT INTO ASSESSMENT_NUTRITION_HABIT (HABIT_ID, DIETARY_HABIT) VALUES ('" . $lastId + 1 . "','" . strtolower($data['pola_makan']) . "')");
                $data['pola_makan'] = $lastId + 1;
            }
            $data['modified_by'] = user()->username;

            $model = new GiziModel();

            $existingEntry = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('body_id', $formData->body_id)->first() ?? []);

            if (!empty($existingEntry)) {
                $update = $model->where('body_id', $existingEntry['body_id'])
                    ->set($data)
                    ->update();
            }
            $db->transCommit();
            return $this->response->setJSON([
                'message' => 'Sukses mengupdate data.',
                'respon'  => true,
                'result' => $data
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function insertFoodRecall()
    {
        try {
            $formData = $this->request->getJSON();
            $data = [];
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }
            $data['recall_id'] = $this->get_bodyid();
            $data['modified_by'] = user()->username;
            $model = new FoodRecallModel();

            $model->insert($data);

            return $this->response->setJSON([
                'message' => 'Sukses mengirim data.',
                'respon'  => true,
                'result' => $data
            ]);
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function editFoodRecall()
    {
        try {
            $formData = $this->request->getJSON();
            $data = [];
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }
            $data['modified_by'] = user()->username;

            $model = new FoodRecallModel();

            $existingEntry = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('recall_id', $formData->recall_id)->first() ?? []);
            if (!empty($existingEntry)) {
                $update = $model->where('recall_id', $existingEntry['recall_id'])
                    ->set($data)
                    ->update();
            }

            return $this->response->setJSON([
                'message' => 'Sukses mengirim data.',
                'respon'  => true,
                'result' => $data
            ]);
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }



    public function deleteGizi()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (empty($formData['body_id'])) {
            return $this->response->setJSON([
                'message' => 'Missing body_id.',
                'respon'  => false
            ]);
        }

        $model = new GiziModel();
        $modelFoodRecall = new FoodRecallModel();
        $modelIntervensi = new InterventionModel();
        $modelDiagnosas = new PasienDiagnosasModel();

        $db = \Config\Database::connect();
        $db->transStart();

        try {

            $deletedFoodRecall = $modelFoodRecall->where('document_id', $formData['body_id'])->delete();
            $deletedIntervensi = $modelIntervensi->where('document_id', $formData['body_id'])->delete();
            $deletedDiagnosas = $modelDiagnosas->where('pasien_diagnosa_id', $formData['body_id'])->delete();
            $deleted = $model->where('body_id', $formData['body_id'])->delete();

            if (!$deletedFoodRecall || !$deletedIntervensi || !$deletedDiagnosas || !$deleted) {
                throw new \Exception('Data delete failed.');
            }


            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed.');
            }

            $db->transComplete();
            return $this->response->setJSON([
                'message' => 'Data deleted successfully.',
                'respon'  => true
            ]);
        } catch (\Exception $e) {

            $db->transRollback();

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function deleteFoodRecall()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (empty($formData['recall_id'])) {
            return $this->response->setJSON([
                'message' => 'Missing recall_id.',
                'respon'  => false
            ]);
        }

        $model = new FoodRecallModel();

        $db = \Config\Database::connect();
        $db->transStart();

        try {

            $deleted = $model->where('recall_id', $formData['recall_id'])->delete();

            if (!$deleted) {
                throw new \Exception('Data delete failed.');
            }

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed.');
            }

            return $this->response->setJSON([
                'message' => 'Data deleted successfully.',
                'respon'  => true
            ]);
        } catch (\Exception $e) {

            $db->transRollback();

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }


    public function insertDiagnosaGizi()
    {

        $db = db_connect();
        $db->transStart();
        try {
            $formData = $this->request->getJSON();

            if (isset($formData->diagnosa) && !empty($formData->diagnosa)) {
                $pds = new PasienDiagnosasModel();
                $diagnosaData = [];

                $pds->where('pasien_diagnosa_id', $formData->diagnosa[0]->pasien_diagnosa_id)->delete();

                foreach ($formData->diagnosa as $diagnosis) {
                    if (isset($diagnosis->pasien_diagnosa_id)) {
                        $diagnosaData[] = [
                            'pasien_diagnosa_id' => $diagnosis->pasien_diagnosa_id,
                            'diagnosa_id' => $diagnosis->diag_id,
                            'diagnosa_name' => $diagnosis->diag_name,
                            'diag_cat' => $diagnosis->diag_cat,
                            'suffer_type' => $diagnosis->suffer_type,
                            'modified_by' => user()->username,
                            'sscondition_id' => new RawSql('newid()'),
                        ];
                    } else {
                        throw new Exception('Invalid diagnosis data format.');
                    }
                }

                if (!empty($diagnosaData)) {
                    $insert = $pds->insertBatch($diagnosaData);
                }
            }
            $db->transComplete();
            return $this->response->setJSON([
                'message' => 'Sukses mengirim data.',
                'respon'  => true,
            ]);
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());
            $db->transRollback();
            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function insertHasilIntervensi()
    {
        try {
            $formData = $this->request->getJSON();
            $data = [];
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }

            $data['modified_by'] = user()->username;
            $data['body_id'] = $this->get_bodyid();
            $model = new InterventionModel();

            $data['intervention_description'] = implode(", ", $formData->intervention_description);

            $insert = $model->insert($data);

            return $this->response->setJSON([
                'message' => 'Sukses mengirim data.',
                'respon'  => true,
                'result' => $data
            ]);
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function editIntervensi()
    {
        try {
            $formData = $this->request->getJSON();
            $data = [];
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }
            $data['modified_by'] = user()->username;
            $data['intervention_description'] = implode(", ", $formData->intervention_description);
            $model = new InterventionModel();

            $existingEntry = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('body_id', $formData->body_id)->first() ?? []);

            if (!empty($existingEntry)) {
                $update = $model->where('body_id', $existingEntry['body_id'])
                    ->set($data)
                    ->update();
            }

            return $this->response->setJSON([
                'message' => 'Sukses mengirim data.',
                'respon'  => true,
                'result' => $data,
                'document_id' => $existingEntry['document_id']
            ]);
        } catch (\Exception $e) {

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat memproses data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function deleteIntervensi()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (empty($formData['body_id'])) {
            return $this->response->setJSON([
                'message' => 'Missing body_id.',
                'respon'  => false
            ]);
        }

        $model = new InterventionModel();

        $db = \Config\Database::connect();
        $db->transStart();

        try {

            $deleted = $model->where('body_id', $formData['body_id'])->delete();

            if (!$deleted) {
                throw new \Exception('Data delete failed.');
            }

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed.');
            }

            return $this->response->setJSON([
                'message' => 'Data deleted successfully.',
                'respon'  => true
            ]);
        } catch (\Exception $e) {

            $db->transRollback();

            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'respon'  => false,
                'error'   => $e->getMessage()
            ]);
        }
    }
}
