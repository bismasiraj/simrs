<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\CairanModel;
use App\Models\AskepModel;
use App\Models\AskepSlkiluaranModel;
use App\Models\PasienPenunjangModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Cairan extends \App\Controllers\BaseController
{

    public function getData()
    {
        $request = service('request');
        $formData = $request->getJSON();

        if (!isset($formData->id)) {
            return $this->response->setJSON([]);
        }

        $model = new CairanModel();
        $db = db_connect();

        $sql = $model->where('visit_id', $formData->id);

        if (!empty($formData->startDate) && !empty($formData->endDate)) {
            $sql->where('examination_date >=', $formData->startDate)
                ->where('examination_date <=', $formData->endDate);
        }
        $sql->orderBy('examination_date', 'DESC');
        $results = $this->lowerKey($sql->findAll());

        $exam = $this->lowerKey($db->query("SELECT TOP 1 weight, examination_date,temperature,
                                            temperature,tension_upper,oxygen_usage,nafas,nadi,nadi
                                            FROM EXAMINATION_DETAIL
                                            WHERE visit_id = '$formData->id'
                                            ORDER BY EXAMINATION_DATE DESC;")->getResultArray());

        $exam = $exam ? $exam[0] : [];

        return $this->response->setJSON([
            'message' => 'Data retrieved successfully.',
            'respon'  => true,
            'data'    => $results,
            'exam'    => $exam
        ]);
    }

    public function getCategory()
    {
        $db = db_connect();

        $category = $this->lowerKey($db->query("SELECT * from ASSESSMENT_FLUID_category")->getResultArray());

        if (empty($category)) {
            return $this->response->setJSON([
                'message' => 'Data Kosong',
                'respon' => false
            ]);
        } else {
            return $this->response->setJSON([
                'message' => 'Sucess',
                'respon' => true,
                'value' => ['data' => $category]
            ]);
        }
    }


    public function insertData()
    {
        $model = new CairanModel();
        $json = $this->request->getJSON(true);

        if (!empty($json) && is_array($json)) {
            $data = [];

            foreach ($json as $key => $value) {
                if ($key === 'botle_amount' || $key === 'fluid_amount') {
                    $data[$key] = (int) $value;
                } else {
                    $data[$key] = $value;
                }
            }
            $data['modified_date'] = date('Y-m-d H:i:s');
            $data['modified_by'] = user()->username;

            try {
                $existingRecord = $model->where('body_id', $data['body_id'])->first();
                $existingRecord = $existingRecord ? $this->lowerKey($existingRecord) : null;

                if ($existingRecord) {
                    if (!$model->delete($existingRecord['body_id'])) {
                        return $this->response->setJSON([
                            'message' => 'Gagal menghapus data lama.',
                            'respon'  => false
                        ]);
                    }
                }

                if ($model->insert($data)) {
                    return $this->response->setJSON([
                        'message' => 'Data berhasil disimpan.',
                        'respon'  => true,
                        'data'    => $data
                    ]);
                } else {
                    return $this->response->setJSON([
                        'message' => 'Gagal menyimpan data.',
                        'respon'  => false
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'message' => 'Error: ' . $e->getMessage(),
                    'respon'  => false
                ]);
            }
        }

        return $this->response->setJSON([
            'message' => 'Tidak ada data yang diterima.',
            'respon'  => false
        ]);
    }

    public function deleteData()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        if (!$formData['body_id']) {
            return ['success' => false, 'message' => 'Missing visit_id or body_id'];
        }

        $model = new CairanModel();

        $deleted = $model->where('body_id', $formData['body_id'])
            ->delete();


        $deleted;
        return $this->response->setJSON(['message' => 'Data delete successfully.', 'respon' => true]);
    }
}
