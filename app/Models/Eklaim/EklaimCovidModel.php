<?php

namespace App\Models\Eklaim;

use CodeIgniter\Model;

class EklaimCovidModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrUpdateCovidData($data)
    {
        $sql = "
        MERGE INTO EKLAIM_COVID AS target
        USING (SELECT ? AS TRANS_ID, ? AS NOSEP_KLAIM) AS source
        ON target.TRANS_ID = source.TRANS_ID AND target.NOSEP_KLAIM = source.NOSEP_KLAIM
        WHEN MATCHED THEN
            UPDATE SET
                COVID_STATUS_CD = ?, CC_IND = ?, RS_DARURAT_IND = ?, CO_INSIDENSE_IND = ?,
                TOPUP_RAWAT_GROSS = ?, TOPUP_RAWAT_FACTOR = ?, TOPUP_RAWAT = ?, TOPUP_JENAZAH = ?,
                ISOMAN_IND = ?, BAYI_LAHIR_STATUS_CD = ?, TERAPI_KONVALESEN = ?,

                EPISODES7 = ?, EPISODES8 = ?, EPISODES9 = ?, EPISODES10 = ?, EPISODES11 = ?, EPISODES12 = ?,

                LAB_ASAM_LAKTAT = ?, LAB_PROCALCITONIN = ?, LAB_CRP = ?, LAB_KULTUR = ?,
                LAB_D_DIMER = ?, LAB_PT = ?, LAB_APTT = ?, LAB_WAKTU_PENDARAHAN = ?,
                LAB_ANTI_HIV = ?, LAB_ANALISA_GAS = ?, LAB_ALBUMIN = ?, RAD_THORAX_AP_PA = ?

        WHEN NOT MATCHED THEN
            INSERT (
                TRANS_ID, NOSEP_KLAIM,
                COVID_STATUS_CD, CC_IND, RS_DARURAT_IND, CO_INSIDENSE_IND,
                TOPUP_RAWAT_GROSS, TOPUP_RAWAT_FACTOR, TOPUP_RAWAT, TOPUP_JENAZAH,
                ISOMAN_IND, BAYI_LAHIR_STATUS_CD, TERAPI_KONVALESEN,

                EPISODES7, EPISODES8, EPISODES9, EPISODES10, EPISODES11, EPISODES12,

                LAB_ASAM_LAKTAT, LAB_PROCALCITONIN, LAB_CRP, LAB_KULTUR,
                LAB_D_DIMER, LAB_PT, LAB_APTT, LAB_WAKTU_PENDARAHAN,
                LAB_ANTI_HIV, LAB_ANALISA_GAS, LAB_ALBUMIN, RAD_THORAX_AP_PA
            )
            VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?,
                ?, ?, ?, ?,
                ?, ?, ?, ?
            );";

        $params = [
            // USING
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],

            // UPDATE
            $data['COVID_STATUS_CD'],
            $data['CC_IND'],
            $data['RS_DARURAT_IND'],
            $data['CO_INSIDENSE_IND'],
            $data['TOPUP_RAWAT_GROSS'],
            $data['TOPUP_RAWAT_FACTOR'],
            $data['TOPUP_RAWAT'],
            $data['TOPUP_JENAZAH'],
            $data['ISOMAN_IND'],
            $data['BAYI_LAHIR_STATUS_CD'],
            $data['TERAPI_KONVALESEN'],

            $data['EPISODES7'],
            $data['EPISODES8'],
            $data['EPISODES9'],
            $data['EPISODES10'],
            $data['EPISODES11'],
            $data['EPISODES12'],

            $data['LAB_ASAM_LAKTAT'],
            $data['LAB_PROCALCITONIN'],
            $data['LAB_CRP'],
            $data['LAB_KULTUR'],
            $data['LAB_D_DIMER'],
            $data['LAB_PT'],
            $data['LAB_APTT'],
            $data['LAB_WAKTU_PENDARAHAN'],
            $data['LAB_ANTI_HIV'],
            $data['LAB_ANALISA_GAS'],
            $data['LAB_ALBUMIN'],
            $data['RAD_THORAX_AP_PA'],

            // INSERT
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],
            $data['COVID_STATUS_CD'],
            $data['CC_IND'],
            $data['RS_DARURAT_IND'],
            $data['CO_INSIDENSE_IND'],
            $data['TOPUP_RAWAT_GROSS'],
            $data['TOPUP_RAWAT_FACTOR'],
            $data['TOPUP_RAWAT'],
            $data['TOPUP_JENAZAH'],
            $data['ISOMAN_IND'],
            $data['BAYI_LAHIR_STATUS_CD'],
            $data['TERAPI_KONVALESEN'],

            $data['EPISODES7'],
            $data['EPISODES8'],
            $data['EPISODES9'],
            $data['EPISODES10'],
            $data['EPISODES11'],
            $data['EPISODES12'],

            $data['LAB_ASAM_LAKTAT'],
            $data['LAB_PROCALCITONIN'],
            $data['LAB_CRP'],
            $data['LAB_KULTUR'],
            $data['LAB_D_DIMER'],
            $data['LAB_PT'],
            $data['LAB_APTT'],
            $data['LAB_WAKTU_PENDARAHAN'],
            $data['LAB_ANTI_HIV'],
            $data['LAB_ANALISA_GAS'],
            $data['LAB_ALBUMIN'],
            $data['RAD_THORAX_AP_PA']
        ];

        return $this->db->query($sql, $params);
    }
    public function getByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_COVID')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->get()
            ->getRowArray();
    }

    // ✅ Get all rows by TRANS_ID (multi klaim per visit)
    public function getAllByTransId($trans_id)
    {
        return $this->db->table('EKLAIM_COVID')
            ->where('TRANS_ID', $trans_id)
            ->get()
            ->getResultArray();
    }

    // ✅ Check if row exists
    public function exists($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_COVID')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->countAllResults() > 0;
    }
}
