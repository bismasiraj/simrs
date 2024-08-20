<?php

namespace App\Controllers\Admin;;

use App\Controllers\BaseController;
use App\Models\AskepIntervensiModel;
use App\Models\AskepModel;
use App\Models\AskepSlkiluaranModel;
use App\Models\askepSlkiModel;

class Askep extends \App\Controllers\BaseController
{
    public function getData()
    {
        $formData = $this->request->getJSON();
        $db = db_connect();
        $getAskepSdkiModel = new AskepModel();
        $dataAskepSdki = $getAskepSdkiModel->where('document_id', $formData->id)->findAll() ?? [];
        $dataAskepSdki = $this->lowerKey($dataAskepSdki);

        $date = isset($formData->date) ? $formData->date : '';
        $dateSiki = isset($formData->dateSiki) ? $formData->dateSiki : '';

        $queryAskepSdkiPenyebab = $this->lowerKey($db->query("SELECT
                                                            ASKEP_SDKI.DIAGNOSAN_ID AS diag_id
                                                            , 'Penyebab'
                                                            AS child_parent
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME AS diag_name
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY_ID AS diag_val_id
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY AS diag_val_name
                                                            , ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE AS type
                                                            , MAX(
                                                                CASE WHEN ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE = ASKEP_ETIOLOGY_TYPE.ETIOLOGY_TYPE THEN ASKEP_ETIOLOGY_TYPE.ETIOLOGYTYPE ELSE ''
                                                                END
                                                            ) AS type_name
                                                            , MAX(
                                                                CASE WHEN ASKEP_SDKI_DETAIL.DETAIL_ID IS NOT NULL THEN 1 ELSE 0 END
                                                            ) AS checked FROM ASKEP_SDKI INNER JOIN ASKEP_SDKI_ETIOLOGY ON ASKEP_SDKI.DIAGNOSAN_ID = ASKEP_SDKI_ETIOLOGY
                                                            .DIAGNOSAN_ID INNER JOIN ASKEP_ETIOLOGY_TYPE ON ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE = ASKEP_ETIOLOGY_TYPE
                                                            .ETIOLOGY_TYPE INNER JOIN ASKEP_CATEGORY ON ASKEP_SDKI.ASKEP_CAT = ASKEP_CATEGORY.ASKEP_CAT LEFT JOIN ASKEP_SDKI_DETAIL ON ASKEP_SDKI_ETIOLOGY
                                                            .DIAGNOSAN_ETIOLOGY_ID = ASKEP_SDKI_DETAIL.DETAIL_ID AND ASKEP_SDKI_DETAIL.DOCUMENT_ID = '$formData->id'
                                                            WHERE ASKEP_SDKI.DIAGNOSAN_ID = '$formData->diag_id'
                                                            GROUP BY ASKEP_SDKI.DIAGNOSAN_ID
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY_ID
                                                            , ASKEP_SDKI_ETIOLOGY.ETIOLOGY_TYPE
                                                            , ASKEP_SDKI_ETIOLOGY.DIAGNOSAN_ETIOLOGY;")->getResultArray());

        $queryAskepSdkiGejala = $this->lowerKey($db->query("SELECT
                                                            ASKEP_SDKI_symptom.DIAGNOSAN_ID AS diag_id
                                                            , 'Gejala'
                                                            AS child_parent
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME AS diag_name
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOM_TYPE AS type
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOMTYPE AS type_name
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID AS diag_val_id
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM AS diag_val_name
                                                            , MAX(
                                                                CASE WHEN ASKEP_SDKI_DETAIL.DETAIL_ID IS NOT NULL THEN 1 ELSE 0 END
                                                            ) AS checked FROM ASKEP_SDKI_symptom INNER JOIN ASKEP_SYMPTOM_TYPE ON ASKEP_SDKI_symptom.SYMPTOM_TYPE = ASKEP_SYMPTOM_TYPE
                                                            .SYMPTOM_TYPE INNER JOIN ASKEP_SDKI ON ASKEP_SDKI_symptom.DIAGNOSAN_ID = ASKEP_SDKI
                                                            .DIAGNOSAN_ID LEFT JOIN ASKEP_SDKI_DETAIL ON ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID = ASKEP_SDKI_DETAIL.DETAIL_ID AND ASKEP_SDKI_DETAIL
                                                            .DOCUMENT_ID = '$formData->id'
                                                            WHERE ASKEP_SDKI_symptom.DIAGNOSAN_ID = '$formData->diag_id'
                                                            GROUP BY ASKEP_SDKI_symptom.DIAGNOSAN_ID
                                                            , ASKEP_SDKI.DIAGNOSAN_NAME
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOM_TYPE
                                                            , ASKEP_SYMPTOM_TYPE.SYMPTOMTYPE
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM_ID
                                                            , ASKEP_SDKI_symptom.DIAGNOSAN_SYMPTOM;")->getResultArray());

        $queryAskepSlkiTopDate = $db->query("SELECT TOP 1  RESULT_DATE
                                            FROM ASKEP_SDKI_LUARAN_RESULTS
                                            WHERE document_id = '$formData->id'
                                            ORDER BY RESULT_DATE DESC")->getRowArray()['RESULT_DATE'] ?? null;


        $queryAskepSlki = $db->query("SELECT 
                                        ASKEP_SDKI_LUARAN.DIAGNOSAN_ID AS diag_id,
                                        ASKEP_SDKI_LUARAN.LUARAN_NAME AS diag_name,
                                        ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE AS type,
                                        ASKEP_RELATIONAL_TYPE.RELATIONALTYPE AS type_name,
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID AS diag_val_id,
                                        ASKEP_SLKI_KRITERIA.P_TYPE AS p_type,
                                        ASKEP_SLKI_KRITERIA.KRITERIA AS diag_val_name,
                                        MAX(CASE 
                                            WHEN DATEPART(YEAR, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(YEAR, '$date')
                                            AND DATEPART(MONTH, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(MONTH, '$date')
                                            AND DATEPART(DAY, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(DAY, '$date')
                                            AND DATEPART(HOUR, ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE) = DATEPART(HOUR, '$date')
                                            THEN ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE
                                            ELSE ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE
                                        END) AS RESULT_DATE,
                                        MAX(CASE 
                                            WHEN ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE IS NOT NULL 
                                            THEN 1 
                                            ELSE 0 
                                        END) AS checked
                                    FROM 
                                        ASKEP_SDKI_LUARAN
                                        INNER JOIN ASKEP_RELATIONAL_TYPE 
                                            ON ASKEP_SDKI_LUARAN.RELATIONAL_TYPE = ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE
                                        INNER JOIN ASKEP_SLKI_KRITERIA 
                                            ON ASKEP_SDKI_LUARAN.LUARAN_ID = ASKEP_SLKI_KRITERIA.LUARAN_ID 
                                        LEFT JOIN ASKEP_SDKI_LUARAN_RESULTS 
                                            ON ASKEP_SLKI_KRITERIA.KRITERIA_ID = ASKEP_SDKI_LUARAN_RESULTS.KRITERIA_ID
                                            AND ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE = 
                                                COALESCE(
                                                    (SELECT TOP 1 RESULT_DATE
                                                    FROM ASKEP_SDKI_LUARAN_RESULTS
                                                    WHERE document_id = '$formData->id'
                                                    AND DATEPART(YEAR, RESULT_DATE) = DATEPART(YEAR, '$date')
                                                    AND DATEPART(MONTH, RESULT_DATE) = DATEPART(MONTH, '$date')
                                                    AND DATEPART(DAY, RESULT_DATE) = DATEPART(DAY, '$date')
                                                    AND DATEPART(HOUR, RESULT_DATE) = DATEPART(HOUR, '$date')
                                                    ORDER BY RESULT_DATE DESC),
                                                    (SELECT TOP 1 RESULT_DATE
                                                    FROM ASKEP_SDKI_LUARAN_RESULTS
                                                    WHERE document_id = '$formData->id'
                                                    ORDER BY RESULT_DATE DESC)
                                                )
                                    WHERE 
                                        ASKEP_SDKI_LUARAN.DIAGNOSAN_ID = '$formData->diag_id'
                                    GROUP BY 
                                        ASKEP_SDKI_LUARAN.DIAGNOSAN_ID,
                                        ASKEP_SDKI_LUARAN.LUARAN_NAME,
                                        ASKEP_RELATIONAL_TYPE.RELATIONAL_TYPE,
                                        ASKEP_RELATIONAL_TYPE.RELATIONALTYPE,
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID,
                                        ASKEP_SLKI_KRITERIA.KRITERIA,
                                        ASKEP_SLKI_KRITERIA.P_TYPE;")->getResultArray();



        if (empty($queryAskepSlki)) {
            $queryAskepSlkiEmpty = $db->query("
                        select KRITERIA_ID AS diag_val_id from ASKEP_SDKI_LUARAN 
                        INNER JOIN ASKEP_SLKI_KRITERIA ON ASKEP_SDKI_LUARAN.LUARAN_ID = ASKEP_SLKI_KRITERIA.LUARAN_ID
                        WHERE ASKEP_SDKI_LUARAN.DIAGNOSAN_ID = '$formData->diag_id' ORDER BY diag_val_id")->getResultArray();
            $criteriaIds = array_column($queryAskepSlkiEmpty, 'diag_val_id');
            $criteriaIds = array_map('intval', $criteriaIds);
        } else {
            $criteriaIds = array_column($queryAskepSlki, 'diag_val_id');
            $criteriaIds = array_map('intval', $criteriaIds);
        }

        $queryDropdown = $db->query("SELECT 
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID,
                                        ASKEP_SLKI_KRITERIA.P_TYPE,
                                        ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID,  
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_ID,     
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE,
                                        COALESCE(MAX(
                                            CASE 
                                                WHEN ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASKEP_SDKI_LUARAN_RESULTS.PARAMETER_ID
                                                    AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = ASKEP_SDKI_LUARAN_RESULTS.VALUE_ID
                                                    AND ASSESSMENT_PARAMETER_VALUE.VALUE_DESC = ASKEP_SDKI_LUARAN_RESULTS.VALUE_DESC
                                                    AND ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE = ASKEP_SDKI_LUARAN_RESULTS.VALUE_SCORE
                                                    AND ASKEP_SLKI_KRITERIA.KRITERIA_ID = ASKEP_SDKI_LUARAN_RESULTS.KRITERIA_ID
                                                THEN 1 
                                                ELSE 0 
                                            END
                                        ), 0) AS selected
                                    FROM 
                                        ASKEP_SLKI_KRITERIA
                                        INNER JOIN ASSESSMENT_PARAMETER_VALUE 
                                            ON ASKEP_SLKI_KRITERIA.P_TYPE = ASSESSMENT_PARAMETER_VALUE.P_TYPE 
                                            AND ASKEP_SLKI_KRITERIA.PARAMETER_ID = ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID
                                        INNER JOIN ASKEP_SDKI_LUARAN 
                                            ON ASKEP_SLKI_KRITERIA.LUARAN_ID = ASKEP_SDKI_LUARAN.LUARAN_ID
                                        LEFT JOIN ASKEP_SDKI_LUARAN_RESULTS 
                                            ON ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID = ASKEP_SDKI_LUARAN_RESULTS.PARAMETER_ID
                                            AND ASSESSMENT_PARAMETER_VALUE.VALUE_ID = ASKEP_SDKI_LUARAN_RESULTS.VALUE_ID
                                            AND ASSESSMENT_PARAMETER_VALUE.VALUE_DESC = ASKEP_SDKI_LUARAN_RESULTS.VALUE_DESC
                                            AND ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE = ASKEP_SDKI_LUARAN_RESULTS.VALUE_SCORE
                                            AND ASKEP_SDKI_LUARAN_RESULTS.DOCUMENT_ID = '$formData->id'
                                            AND ASKEP_SDKI_LUARAN_RESULTS.RESULT_DATE = 
                                                COALESCE(
                                                    (
                                                        SELECT TOP 1 RESULT_DATE
                                                        FROM ASKEP_SDKI_LUARAN_RESULTS
                                                        WHERE DOCUMENT_ID = '$formData->id'
                                                        AND DATEPART(YEAR, RESULT_DATE) = DATEPART(YEAR, '$date')
                                                        AND DATEPART(MONTH, RESULT_DATE) = DATEPART(MONTH, '$date')
                                                        AND DATEPART(DAY, RESULT_DATE) = DATEPART(DAY, '$date')
                                                        AND DATEPART(HOUR, RESULT_DATE) = DATEPART(HOUR, '$date')
                                                        ORDER BY RESULT_DATE DESC
                                                    ),
                                                    (
                                                        SELECT TOP 1 RESULT_DATE
                                                        FROM ASKEP_SDKI_LUARAN_RESULTS
                                                        WHERE DOCUMENT_ID = '$formData->id'
                                                        ORDER BY RESULT_DATE DESC
                                                    )
                                                )
                                    WHERE 
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID IN (" . implode(',', $criteriaIds) . ")  AND ASKEP_SLKI_KRITERIA.LUARAN_ID = 'L.01001'
                                    GROUP BY 
                                        ASKEP_SLKI_KRITERIA.KRITERIA_ID,
                                        ASKEP_SLKI_KRITERIA.P_TYPE,
                                        ASSESSMENT_PARAMETER_VALUE.PARAMETER_ID,
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_ID,     
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_DESC,
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE
                                    ORDER BY 
                                        ASSESSMENT_PARAMETER_VALUE.VALUE_SCORE ASC;")->getResultArray();

        $slkiData = [];
        foreach ($queryAskepSlki as $slki) {
            $diag_val_id = $slki['diag_val_id'];
            if (!isset($slkiData[$diag_val_id])) {
                $slkiData[$diag_val_id] = [
                    'result_date' => $slki['RESULT_DATE'],
                    'diag_id' => $slki['diag_id'],
                    'diag_name' => $slki['diag_name'],
                    'type' => $slki['type'],
                    'type_name' => $slki['type_name'],
                    'diag_val_id' => $slki['diag_val_id'],
                    'diag_val_name' => $slki['diag_val_name'],
                    'p_type' => $slki['p_type'],
                    'checked' => $slki['checked'], 'selected' => []
                ];
            }
        }

        foreach ($queryDropdown as $dropdown) {
            $diag_val_id = $dropdown['KRITERIA_ID'];
            if (isset($slkiData[$diag_val_id])) {
                $slkiData[$diag_val_id]['selected'][] = [
                    'kriteria_id' => $dropdown['KRITERIA_ID'],
                    'p_type' => $dropdown['P_TYPE'],
                    'value_desc' => $dropdown['VALUE_DESC'],
                    'value_score' => $dropdown['VALUE_SCORE'],
                    'selected' => $dropdown['selected'],
                    'parameter_id' => $dropdown['PARAMETER_ID'],
                    'value_id' => $dropdown['VALUE_ID']
                ];
            }
        }

        $queryAskepSikiTopDate = $db->query("SELECT TOP 1  INTERVENSI_DATE
                                            FROM ASKEP_SDKI_INTERVENSI_RESULTS
                                            WHERE document_id = '$formData->id'
                                            ORDER BY INTERVENSI_DATE DESC")->getRowArray()['INTERVENSI_DATE'] ?? null;

        $queryAskepSiki = $db->query("SELECT 
                                        ASKEP_SIKI.INTERVENSI_ID AS DIAG_ID,
                                        ASKEP_SIKI.INTERVENSI_NAME AS DIAG_NAME,
                                        ASKEP_SIKI_TYPE.SIKI_TYPE AS TYPE,
                                        ASKEP_SIKI_TYPE.SIKITYPE AS TYPE_NAME,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN_ID AS DIAG_VAL_ID,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN AS DIAG_VAL_NAME,
                                        MAX(CASE 
                                            WHEN DATEPART(YEAR, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(YEAR, '$dateSiki')
                                            AND DATEPART(MONTH, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(MONTH, '$dateSiki')
                                            AND DATEPART(DAY, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(DAY, '$dateSiki')
                                            AND DATEPART(HOUR, ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE) = DATEPART(HOUR, '$dateSiki')
                                            THEN ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE
                                            ELSE ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE
                                        END) AS RESULT_DATE,
                                        MAX(CASE 
                                            WHEN ASKEP_SDKI_INTERVENSI_RESULTS.TINDAKAN_ID IS NOT NULL 
                                            THEN 1 
                                            ELSE 0 
                                        END) AS checked
                                    FROM 
                                        ASKEP_SIKI
                                        INNER JOIN ASKEP_SIKI_TINDAKAN 
                                            ON ASKEP_SIKI.INTERVENSI_ID = ASKEP_SIKI_TINDAKAN.INTERVENSI_ID
                                        INNER JOIN ASKEP_SIKI_TYPE 
                                            ON ASKEP_SIKI_TINDAKAN.SIKI_TYPE = ASKEP_SIKI_TYPE.SIKI_TYPE
                                        LEFT JOIN ASKEP_SDKI_INTERVENSI_RESULTS 
                                            ON ASKEP_SIKI_TINDAKAN.TINDAKAN_ID = ASKEP_SDKI_INTERVENSI_RESULTS.TINDAKAN_ID
                                            AND ASKEP_SDKI_INTERVENSI_RESULTS.DOCUMENT_ID = '$formData->id'
                                            AND ASKEP_SDKI_INTERVENSI_RESULTS.INTERVENSI_DATE = 
                                                COALESCE(
                                                    (SELECT TOP 1 INTERVENSI_DATE
                                                    FROM ASKEP_SDKI_INTERVENSI_RESULTS
                                                    WHERE DOCUMENT_ID = '$formData->id'
                                                    AND DATEPART(YEAR, INTERVENSI_DATE) = DATEPART(YEAR, '$dateSiki')
                                                    AND DATEPART(MONTH, INTERVENSI_DATE) = DATEPART(MONTH, '$dateSiki')
                                                    AND DATEPART(DAY, INTERVENSI_DATE) = DATEPART(DAY, '$dateSiki')
                                                    AND DATEPART(HOUR, INTERVENSI_DATE) = DATEPART(HOUR, '$dateSiki')
                                                    ORDER BY INTERVENSI_DATE DESC),
                                                    (SELECT TOP 1 INTERVENSI_DATE
                                                    FROM ASKEP_SDKI_INTERVENSI_RESULTS
                                                    WHERE DOCUMENT_ID = '$formData->id'
                                                    ORDER BY INTERVENSI_DATE DESC)
                                                )
                                    WHERE 
                                        ASKEP_SIKI.INTERVENSI_ID IN ('1.01014', '1.01011')
                                    GROUP BY 
                                        ASKEP_SIKI.INTERVENSI_ID,
                                        ASKEP_SIKI.INTERVENSI_NAME,
                                        ASKEP_SIKI_TYPE.SIKI_TYPE,
                                        ASKEP_SIKI_TYPE.SIKITYPE,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN_ID,
                                        ASKEP_SIKI_TINDAKAN.TINDAKAN;

                            ")->getResultArray();

        $slkiData = array_values($slkiData);
        $sdkiPenyebab = $this->lowerKey($queryAskepSdkiPenyebab);
        $sdkiGejala = $this->lowerKey($queryAskepSdkiGejala);
        $queryAskepSiki = $this->lowerKey($queryAskepSiki);
        $hasData = !empty($sdkiPenyebab);
        $resultDateSlki = $queryAskepSlkiTopDate ?? Null;
        $resultDateSiki = $queryAskepSikiTopDate ?? Null;


        $responseData = [
            'sdki' => [
                'penyebab' => $sdkiPenyebab ?? [],
                'Gejala' => $sdkiGejala ?? [],
            ],
            'slki' => [
                'date' => $resultDateSlki,
                'data' => $slkiData
            ],
            'siki' => [
                'diag_id' => $queryAskepSdkiPenyebab[0]['diag_id'],
                'date' => $resultDateSiki,
                'data' => $queryAskepSiki
            ]
        ];
        $formattedResponseData = $this->lowerKey($responseData);
        return $this->response->setStatusCode(200)->setJSON([
            'message' => $hasData ? 'Data retrieved successfully.' : 'No data found.', 'respon' => $hasData, 'document_id' => isset($formData->id) ? $formData->id : null, 'value' => $formattedResponseData
        ]);
    }

    public function saveSdki()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $model = new AskepModel();
        $db = db_connect();

        try {
            $db->transStart();

            if (empty($formData['org_unit_code']) || empty($formData['visit_id']) || empty($formData['trans_id']) || empty($formData['document_id'])) {
                throw new \Exception('Missing required form data.');
            }

            $deleteStatus = $model->where('document_id', $formData['document_id'])->delete();
            log_message('debug', 'Delete status: ' . ($deleteStatus ? 'Success' : 'Failed'));

            $insertData = [];

            foreach ($formData as $key => $value) {
                if (preg_match('/^detail_id_/', $key)) {
                    $bodyId = $this->get_bodyid();
                    $diagIdKey = str_replace('detail_id_', 'diagnosan_id_', $key);
                    $detailTypeKey = str_replace('detail_id_', 'detail_type_', $key);
                    $examination_date  = str_replace('T', ' ', $formData['examination_date']);

                    $record = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'visit_id' => $formData['visit_id'] ?? null,
                        'trans_id' => $formData['trans_id'] ?? null,
                        'document_id' => $formData['document_id'] ?? null,
                        'body_id' => $bodyId,
                        'examination_date' => $examination_date ?? null,
                        'modified_date' => date("Y-m-d H:i") ?? null,
                        'modified_by' =>  user()->username ?? null,
                        'detail_id' => $value,
                        'diagnosan_id' => $formData[$diagIdKey] ?? null,
                        'detail_type' => $formData[$detailTypeKey] ?? null,
                    ];

                    $insertData[] = $record;
                }
            }

            if (!empty($insertData)) {
                $insertResult = $model->insertBatch($insertData);

                if (!$insertResult) {
                    throw new \Exception('Failed to insert batch of records. SQL Error: ' . $db->error()['message']);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'message' => 'Data processed successfully',
                'respon' => true
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Transaction failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'message' => 'Error: ' . $e->getMessage(),
                'respon' => false
            ]);
        }
    }

    public function saveSlki()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $modelSkli = new AskepSlkiluaranModel();
        $db = db_connect();

        try {
            $db->transStart();


            if (empty($formData['org_unit_code']) || empty($formData['visit_id']) || empty($formData['trans_id']) || empty($formData['document_id'])) {
                throw new \Exception('Missing required form data.');
            }

            $resultDateFormatted = str_replace('T', ' ', $formData['result_date']);

            $deleteStatus = $modelSkli->where('document_id', $formData['document_id'])
                ->where('result_date', $resultDateFormatted)
                ->delete();

            log_message('debug', 'Delete status: ' . ($deleteStatus ? 'Success' : 'Failed'));

            $insertData = [];

            foreach ($formData as $key => $value) {
                if (preg_match('/^detail_id_/', $key)) {
                    $bodyId = $this->get_bodyid();
                    $diagIdKey = str_replace('detail_id_', 'diagnosan_id_', $key);
                    $detailTypeKey = str_replace('detail_id_', 'detail_type_', $key);
                    $valueScoreKey = str_replace('detail_id_', 'value_score_', $key);
                    $valueDescKey = str_replace('detail_id_', 'value_desc_', $key);
                    $p_type = str_replace('detail_id_', 'p_type_', $key);
                    $parameter_id = str_replace('detail_id_', 'parameter_id_', $key);
                    $valueIdKey = str_replace('detail_id_', 'value_id_', $key);

                    $formatted_date = str_replace('T', ' ', $formData['result_date']);
                    $record = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'visit_id' => $formData['visit_id'] ?? null,
                        'trans_id' => $formData['trans_id'] ?? null,
                        'document_id' => $formData['document_id'] ?? null,
                        'body_id' => $bodyId,
                        'diagnosan_id' => $formData[$diagIdKey] ?? null,
                        'luaran_id' => $formData[$detailTypeKey] ?? null,
                        'kriteria_id' => $value ?? null,
                        'p_type' => $formData[$p_type] ?? null,
                        'parameter_id' => $formData[$parameter_id] ?? null,
                        'value_id' => $formData[$valueIdKey] ?? null,
                        'value_score' => $formData[$valueScoreKey] ?? null,
                        'value_desc' => $formData[$valueDescKey] ?? null,
                        'result_date' => $formatted_date,
                        'modified_date' => date("Y-m-d H:i"),
                        'modified_by' => user()->username ?? null,

                    ];

                    $insertData[] = $record;
                }
            }

            if (!empty($insertData)) {
                $insertResult = $modelSkli->insertBatch($insertData);

                if (!$insertResult) {
                    throw new \Exception('Failed to insert batch of records. SQL Error: ' . $db->error()['message']);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'message' => 'Data processed successfully',
                'respon' => true
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Transaction failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'message' => 'Error: ' . $e->getMessage(),
                'respon' => false
            ]);
        }
    }

    public function saveSiki()
    {
        $request = service('request');
        $formData = $request->getJSON(true);

        $modelSkli = new AskepIntervensiModel();
        $db = db_connect();

        try {
            $db->transStart();


            if (empty($formData['org_unit_code']) || empty($formData['visit_id']) || empty($formData['trans_id']) || empty($formData['document_id'])) {
                throw new \Exception('Missing required form data.');
            }

            $resultDateFormatted = str_replace('T', ' ', $formData['result_date']);

            $deleteStatus = $modelSkli->where('document_id', $formData['document_id'])
                ->where('intervensi_date', $resultDateFormatted)
                ->delete();

            log_message('debug', 'Delete status: ' . ($deleteStatus ? 'Success' : 'Failed'));

            $insertData = [];

            foreach ($formData as $key => $value) {
                if (preg_match('/^detail_id_/', $key)) {
                    $bodyId = $this->get_bodyid();
                    $diagIdKey = str_replace('detail_id_', 'diagnosan_id_', $key);
                    $detailTypeKey = str_replace('detail_id_', 'detail_type_', $key);

                    $formatted_date = str_replace('T', ' ', $formData['result_date']);
                    $record = [
                        'org_unit_code' => $formData['org_unit_code'] ?? null,
                        'visit_id' => $formData['visit_id'] ?? null,
                        'trans_id' => $formData['trans_id'] ?? null,
                        'document_id' => $formData['document_id'] ?? null,
                        'body_id' => $bodyId,
                        'diagnosan_id' => $formData[$diagIdKey] ?? null,
                        'intervensi_id' => $formData[$detailTypeKey] ?? null,
                        'tindakan_id' => $value ?? null,
                        'intervensi_date' => $formatted_date,
                        'modified_date' => date("Y-m-d H:i"),
                        'modified_by' => user()->username ?? null,

                    ];

                    $insertData[] = $record;
                }
            }

            if (!empty($insertData)) {
                $insertResult = $modelSkli->insertBatch($insertData);

                if (!$insertResult) {
                    throw new \Exception('Failed to insert batch of records. SQL Error: ' . $db->error()['message']);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'message' => 'Data processed successfully',
                'respon' => true
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Transaction failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'message' => 'Error: ' . $e->getMessage(),
                'respon' => false
            ]);
        }
    }
}
