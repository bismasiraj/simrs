<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\Assessment\NutritionModel;
use App\Models\FoodRecallModel;
use App\Models\GiziModel;
use App\Models\InterventionModel;
use App\Models\PasienDiagnosasModel;
use App\Models\SkriningNutritionModel;
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
        SELECT TOP(1) WEIGHT, HEIGHT, AGEYEAR,EXAMINATION_DETAIL.EXAMINATION_DATE 
        FROM EXAMINATION_DETAIL 
        LEFT JOIN EXAMINATION_INFO ON EXAMINATION_DETAIL.DOCUMENT_ID = EXAMINATION_INFO.PASIEN_DIAGNOSA_ID
        WHERE EXAMINATION_DETAIL.visit_id = '" . $formData->visit_id . "' ORDER BY EXAMINATION_DETAIL.EXAMINATION_DATE DESC");
        $results = $this->lowerKey($query->getRowArray() ?? []);

        $riwayat_alergi = $db->query("select histories from pasien_history where NO_REGISTRATION = '" . $formData->no_registration . "' and VALUE_ID = 'G0090101'");
        $riwayat_alergi = $this->lowerKey($riwayat_alergi->getRowArray() ?? []);

        $biokimia = $this->lowerKey($db->query("
                    SELECT H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, hasil
                    FROM sharelis.dbo.hasillis h 
                    LEFT OUTER JOIN sharelis.dbo.kirimlis k ON h.norm COLLATE database_default = k.no_pasien COLLATE database_default AND H.kode_kunjungan = K.Kode_Kunjungan 
                    WHERE 
                    1=1
                    AND No_Pasien = '" . $formData->no_registration . "'
                    GROUP BY H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name,hasil
                    ORDER BY tarif_id
                    ")->getResultArray() ?? []);
        $biokomia_teks = "";

        foreach ($biokimia as $row) {

            $tarif_name = htmlspecialchars($row['tarif_name'], ENT_QUOTES, 'UTF-8');
            $hasil = htmlspecialchars($row['hasil'], ENT_QUOTES, 'UTF-8');


            $biokomia_teks .= $tarif_name . " (Hasil: " . $hasil . "), ";
        }

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
            'biokimia' => $biokomia_teks,
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
        SELECT TOP(1) ASSESSMENT_NUTRITION.*, EXAMINATION_INFO.weight, EXAMINATION_INFO.height, ageyear,ASSESSMENT_NUTRITION_HABIT.DIETARY_HABIT  FROM ASSESSMENT_NUTRITION
        LEFT JOIN EXAMINATION_INFO ON ASSESSMENT_NUTRITION.VISIT_ID = EXAMINATION_INFO.VISIT_ID
        LEFT JOIN ASSESSMENT_NUTRITION_HABIT ON ASSESSMENT_NUTRITION.pola_makan = ASSESSMENT_NUTRITION_HABIT.habit_id
        WHERE ASSESSMENT_NUTRITION.visit_id ='" . $formData->visit_id . "' AND ASSESSMENT_NUTRITION.BODY_ID = '" . $formData->body_id . "'
        ORDER BY EXAMINATION_INFO.EXAMINATION_DATE DESC");

        $results = $this->lowerKey($query->getRowArray() ?? []);

        $riwayat_alergi = $db->query("select histories from pasien_history where NO_REGISTRATION = '" . $formData->no_registration . "' and VALUE_ID = 'G0090101'");
        $riwayat_alergi = $this->lowerKey($riwayat_alergi->getRowArray() ?? []);
        $biokimia = $this->lowerKey($db->query("
                    SELECT H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name, hasil
                    FROM sharelis.dbo.hasillis h 
                    LEFT OUTER JOIN sharelis.dbo.kirimlis k ON h.norm COLLATE database_default = k.no_pasien COLLATE database_default AND H.kode_kunjungan = K.Kode_Kunjungan 
                    WHERE 
                    1=1
                    AND No_Pasien = '" . $formData->no_registration . "'
                    GROUP BY H.nolab_lis, H.kode_kunjungan, tarif_id, h.tarif_name,hasil
                    ORDER BY tarif_id
                    ")->getResultArray() ?? []);
        $biokomia_teks = "";

        foreach ($biokimia as $row) {

            $tarif_name = htmlspecialchars($row['tarif_name'], ENT_QUOTES, 'UTF-8');
            $hasil = htmlspecialchars($row['hasil'], ENT_QUOTES, 'UTF-8');


            $biokomia_teks .= $tarif_name . " (Hasil: " . $hasil . "), ";
        }

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
            'biokimia' => $biokomia_teks,
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
        SELECT TOP(1) ASSESSMENT_NUTRITION.*, ageyear,ASSESSMENT_NUTRITION_HABIT.DIETARY_HABIT  FROM ASSESSMENT_NUTRITION
        LEFT JOIN EXAMINATION_INFO ON ASSESSMENT_NUTRITION.VISIT_ID = EXAMINATION_INFO.VISIT_ID
        LEFT JOIN ASSESSMENT_NUTRITION_HABIT ON ASSESSMENT_NUTRITION.pola_makan = ASSESSMENT_NUTRITION_HABIT.habit_id
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
            $data['p_type'] = explode('-', $data['age_category'])[0];
            $data['age_category'] = explode('-', $data['age_category'])[1];

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
            $data['p_type'] = explode('-', $data['age_category'])[0];
            $data['age_category'] = explode('-', $data['age_category'])[1];
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
        $db = db_connect();
        $db->transStart();
        try {
            $formData = $this->request->getJSON();
            $data = [];

            if (empty($formData->meal_name)) {
                return $this->response->setJSON([
                    'message' => 'Nama Masakan tidak boleh kosong.',
                    'respon'  => false,
                ]);
            }

            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }
            $data['recall_id'] = $this->get_bodyid();
            $data['modified_by'] = user()->username;
            $model = new FoodRecallModel();

            $query = $db->query("
            select * from recipes where RECIPE_ID = '" . $data['meal_name'] . "'
            ");

            $results = $this->lowerKey($query->getRowArray() ?? []);


            if (empty($results)) {
                $dataRecipe = $this->lowerKey($db->query("select top 1 * from recipes where RECIPE = '" . $data['meal_name'] . "' order by modified_date desc")->getRowArray() ?? []);

                if (empty($dataRecipe)) {
                    $id = $this->get_bodyid();
                    $insertRecipe = $db->query("INSERT INTO recipes (org_unit_code, RECIPE_ID, RECIPE, modified_date, modified_by) VALUES ('" . $data['org_unit_code'] . "','" . $id . "','" . strtolower($data['meal_name']) . "', '" . date("Y-m-d H:i:s") . "', '" . user()->username . "')");
                    if (!$insertRecipe) {
                        throw new \Exception('Insert Data Recipes is Failed');
                    }
                } else {
                    $data['meal_name'] = $dataRecipe['recipe'];
                }
            } else {
                $data['meal_name'] = $results['recipe'];
            }

            $insert = $model->insert($data);

            // if ($insert == false) {
            //     throw new \Exception('Insert Data Food Recall is Failed');
            // }
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

    public function editFoodRecall()
    {
        try {
            $db = db_connect();
            $db->transStart();
            $formData = $this->request->getJSON();
            $data = [];

            if (empty($formData->meal_name)) {
                return $this->response->setJSON([
                    'message' => 'Nama Masakan tidak boleh kosong.',
                    'respon'  => false,
                ]);
            }
            foreach ($formData as $key => $value) {
                if (!is_array($value) && $value !== null && $value !== '') {
                    $data[strtolower($key)] = $value;
                }
            }
            $date = \DateTime::createFromFormat('d-m-Y H:i', $data['recall_date']);

            $data['modified_by'] = user()->username;
            $data['recall_date'] = $date->format('Y-m-d H:i:s');

            $model = new FoodRecallModel();

            $existingEntry = $this->lowerKey($model->where('visit_id', $formData->visit_id)->where('recall_id', $formData->recall_id)->first() ?? []);
            if (!empty($existingEntry)) {

                $query = $db->query("select * from recipes where RECIPE_ID = '" . $data['meal_name'] . "'");

                $results = $this->lowerKey($query->getRowArray() ?? []);

                if (empty($results)) {
                    $dataRecipe = $this->lowerKey($db->query("select top 1 * from recipes where RECIPE = '" . $data['meal_name'] . "' order by modified_date desc")->getRowArray() ?? []);

                    if (empty($dataRecipe)) {
                        $id = $this->get_bodyid();
                        $insertRecipe = $db->query("INSERT INTO recipes (org_unit_code, RECIPE_ID, RECIPE, modified_date, modified_by) VALUES ('" . $data['org_unit_code'] . "','" . $id . "','" . strtolower($data['meal_name']) . "', '" . date("Y-m-d H:i:s") . "', '" . user()->username . "')");

                        if (!$insertRecipe) {
                            throw new \Exception('Insert Data Recipes is Failed');
                        }
                    } else {
                        $data['meal_name'] = $dataRecipe['recipe'];
                    }
                } else {
                    $data['meal_name'] = $results['recipe'];
                }

                $update = $model->where('recall_id', $existingEntry['recall_id'])
                    ->set($data)
                    ->update();

                if (!$update) {
                    echo '<pre>';
                    var_dump($model->error());
                    die();
                }

                $db->transCommit();
            }
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

            $date = \DateTime::createFromFormat('d-m-Y H:i', $data['intervention_date']);

            $data['modified_by'] = user()->username;
            $data['intervention_description'] = implode(", ", $formData->intervention_description);
            $data['intervention_date'] = $date->format('Y-m-d H:i:s');
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






    // SKRINING GIZI


    public function getDataSkrining()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }


        $query = $db->query("
        SELECT *
        FROM ASSESSMENT_SCREENING_NUTRITION 
        WHERE visit_id = '" . $formData->visit_id . "' AND no_registration = '" . $formData->no_registration . "' ORDER BY EXAMINATION_DATE DESC");
        $results = $this->lowerKey($query->getResultArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
        ]);
    }

    public function getSkriningById()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();
        if (!isset($formData->visit_id)) {
            return $this->response->setJSON([]);
        }


        $query = $db->query("
        SELECT *
        FROM ASSESSMENT_SCREENING_NUTRITION 
        WHERE visit_id = '" . $formData->visit_id . "' AND no_registration = '" . $formData->no_registration . "' AND body_id = '" . $formData->body_id . "'  ORDER BY EXAMINATION_DATE DESC");
        $results = $this->lowerKey($query->getRowArray() ?? []);

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
        ]);
    }

    public function insertSkrining()
    {
        $db = db_connect();
        $db->transStart();
        $formData = $this->request->getJSON();
        $data = [];
        $date = date("Y-m-d H:i:s");


        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == '')) {
                $data[strtolower($key)] = $value;
            }
        }
        $data['examination_date'] = $date;
        $data['modified_date'] = $date;
        $data['petugas_id'] = user()->username;
        $data['modified_by'] = user()->username;
        $data['document_id'] = null;
        $data['body_id'] = $this->get_bodyid();

        $getColumn = $this->lowerKey($db->query("SELECT COLUMN_NAME FROM ASSESSMENT_PARAMETER WHERE P_TYPE = '" . $data['p_type'] . "'")->getResultArray() ?? []);
        $getColumn = array_map(function ($item) {
            return strtolower($item['column_name']);
        }, $getColumn);

        $total_score = 0;
        foreach ($getColumn as $key => $val) {
            if (isset($data[$val]) && is_numeric($data[$val])) {
                $total_score += $data[$val];
            }
        }

        $score_desc = $this->getScoreDesc($data['p_type'], $total_score);

        $data['total_score'] = $total_score;
        $data['score_desc'] = $score_desc;


        try {

            $model = new SkriningNutritionModel();

            $insert = $model->insert($data);

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

    public function updateSkrining()
    {
        $db = db_connect();
        $db->transStart();
        $formData = $this->request->getJSON();
        $data = [];
        $date = date("Y-m-d H:i:s");


        foreach ($formData as $key => $value) {
            ${$key} = $value;
            if (!(is_null(${$key}) || ${$key} == '')) {
                $data[strtolower($key)] = $value;
            }
        }

        $getColumn = $this->lowerKey($db->query("SELECT COLUMN_NAME FROM ASSESSMENT_PARAMETER WHERE P_TYPE = '" . $data['p_type'] . "'")->getResultArray() ?? []);
        $getColumn = array_map(function ($item) {
            return strtolower($item['column_name']);
        }, $getColumn);

        $total_score = 0;
        foreach ($getColumn as $key => $val) {
            if (isset($data[$val]) && is_numeric($data[$val])) {
                $total_score += $data[$val];
            }
        }

        $score_desc = $this->getScoreDesc($data['p_type'], $total_score);

        $data['total_score'] = $total_score;
        $data['score_desc'] = $score_desc;


        try {

            $model = new SkriningNutritionModel();
            $dataExist = $this->lowerKey($model->where('body_id', $data['body_id'])->first() ?? []);

            $data['modified_date'] = $date;
            $data['petugas_id'] = user()->username;
            $data['modified_by'] = user()->username;
            $data['special_diagnose'] = $data['special_diagnose'] ?? null;
            $data['step1_score_imt'] = $data['step1_score_imt'] ?? null;
            $data['step2_score_wightloss'] = $data['step2_score_wightloss'] ?? null;
            $data['step3_score_acute_disease'] = $data['step3_score_acute_disease'] ?? null;
            $data['step4_score_malnutrition'] = $data['step4_score_malnutrition'] ?? null;
            $data['step5_score'] = $data['step5_score'] ?? null;
            $data['step6_score'] = $data['step6_score'] ?? null;

            $model->set($data)
                ->where('body_id', $data['body_id'])
                ->update();

            $db->transComplete();
            return $this->response->setJSON([
                'message' => 'Sukses mengupdate data.',
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


    public function delete()
    {
        $request = service('request');
        $formData = $request->getJSON();

        $db = db_connect();
        $db->transBegin();

        if (!$formData->body_id) {
            return $this->response->setJSON(['message' => 'Error : body_id is missing', 'respon' => false]);
        }

        try {
            $model = new SkriningNutritionModel();

            $deleted = $model->where('body_id', $formData->body_id)
                ->delete();

            if (!$deleted) {
                throw new \Exception('Failed to delete data.');
            }

            $db->transCommit();

            return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON(['message' => 'Error : ' . $e->getMessage(), 'respon' => false]);
        }
    }


    private function getScoreDesc($p_type, $score)
    {
        $description = '';
        switch ($p_type) {
            case 'GIZ0601':
                $description = $score == 0 ? 'rendah' : ($score >= 1 && $score <= 3 ? 'sedang' : ($score >= 4 && $score <= 5 ? 'tinggi' : '-'));
                break;
            case 'GIZ0602':
                $description = $score >= 2 ? 'Berisiko malnutrisi' : 'Tidak berisiko malnutrisi';
                break;
            case 'GIZ0603':
                $description = $score >= 12 ? 'Normal / tidak berisiko, tidak membutuhkan pengkajian lebih lanjut' : 'mungkin malnutrisi, membutuhkan pengkajian lebih lanjut';
                break;
        }
        return $description;
    }
    public function getRecipes()
    {
        $db = db_connect();

        $query = $db->query("select recipe_id as id, recipe as text from recipes order by text asc")->getResultArray();

        $results = $this->lowerKey($query ?? []);
        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results
        ]);
    }
    public function getIngredient()
    {
        $request = service('request');
        $formData = $request->getJSON();
        $db = db_connect();

        $query = $db->query("
            SELECT GN.NAME + ' ' + CAST(RI.QUANTITY AS VARCHAR(10)) + ' ' + MEASUREMENT AS full_description, 
            RI.QUANTITY AS gramasi, M.MEASUREMENT AS urt_bahan
            FROM GOODS_NUTRITION GN
            JOIN RECIPES_INGRADIENT RI ON GN.BRAND_ID = RI.BRAND_ID
            JOIN MEASUREMENT M ON RI.MEASURE_ID = M.MEASURE_ID
            WHERE RI.RECIPE_ID = '" . $formData->recipe_id . "'
        ");

        $results = $query->getResultArray() ?? [];

        // Extract the 'full_description' from each row and implode them
        $data = implode(',', array_column($results, 'full_description')) ?? '-';
        $gramasi = array_sum(array_column($results, 'gramasi')) ?? 0;

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => [
                'nama_bahan'    =>  $data,
                'urt_bahan'      => !empty($results[0]['urt_bahan']) ? $results[0]['urt_bahan'] : '-',
                'gramasi'       => $gramasi,
            ],
        ]);
    }
}
