<?php

namespace App\Models\Eklaim;

use CodeIgniter\Model;

class EklaimUpgradeClassModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrUpdateUpgradeClass($data)
    {
        $sql = "
        MERGE INTO EKLAIM_UPGRADECLASS AS target
        USING (SELECT ? AS TRANS_ID, ? AS NOSEP_KLAIM) AS source
        ON target.TRANS_ID = source.TRANS_ID AND target.NOSEP_KLAIM = source.NOSEP_KLAIM
        WHEN MATCHED THEN
            UPDATE SET
                UPGRADE_CLASS_IND = ?, 
                UPGRADE_CLASS_CLASS = ?, 
                UPGRADE_CLASS_LOS = ?, 
                UPGRADE_CLASS_PAYOR = ?, 
                ADD_PAYMENT_PCT = ?, 
                ADD_PAYMENT_AMT = ?
        WHEN NOT MATCHED THEN
            INSERT (
                TRANS_ID, NOSEP_KLAIM,
                UPGRADE_CLASS_IND, UPGRADE_CLASS_CLASS, UPGRADE_CLASS_LOS, 
                UPGRADE_CLASS_PAYOR, ADD_PAYMENT_PCT, ADD_PAYMENT_AMT
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $params = [
            // USING
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],

            // UPDATE
            $data['UPGRADE_CLASS_IND'],
            $data['UPGRADE_CLASS_CLASS'],
            $data['UPGRADE_CLASS_LOS'],
            $data['UPGRADE_CLASS_PAYOR'],
            $data['ADD_PAYMENT_PCT'],
            $data['ADD_PAYMENT_AMT'],

            // INSERT
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],
            $data['UPGRADE_CLASS_IND'],
            $data['UPGRADE_CLASS_CLASS'],
            $data['UPGRADE_CLASS_LOS'],
            $data['UPGRADE_CLASS_PAYOR'],
            $data['ADD_PAYMENT_PCT'],
            $data['ADD_PAYMENT_AMT']
        ];

        return $this->db->query($sql, $params);
    }
    public function getByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_UPGRADECLASS')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->get()
            ->getRowArray();
    }

    // ✅ Get all rows by TRANS_ID (multi klaim per visit)
    public function getAllByTransId($trans_id)
    {
        return $this->db->table('EKLAIM_UPGRADECLASS')
            ->where('TRANS_ID', $trans_id)
            ->get()
            ->getResultArray();
    }

    // ✅ Check if row exists
    public function exists($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_UPGRADECLASS')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->countAllResults() > 0;
    }
}
