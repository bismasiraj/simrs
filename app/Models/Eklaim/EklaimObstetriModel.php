<?php

namespace App\Models\Eklaim;

use CodeIgniter\Model;

class EklaimObstetriModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrUpdateObstetri($data)
    {
        $sql = "
        MERGE INTO EKLAIM_OBSTETRI AS target
        USING (SELECT ? AS TRANS_ID, ? AS NOSEP_KLAIM) AS source
        ON target.TRANS_ID = source.TRANS_ID AND target.NOSEP_KLAIM = source.NOSEP_KLAIM
        WHEN MATCHED THEN
            UPDATE SET
                USIA_KEHAMILAN = ?, 
                GRAVIDA = ?, 
                PARTUS = ?, 
                ABORTUS = ?, 
                ONSET_KONTRAKSI = ?
        WHEN NOT MATCHED THEN
            INSERT (
                TRANS_ID, NOSEP_KLAIM, 
                USIA_KEHAMILAN, GRAVIDA, PARTUS, ABORTUS, ONSET_KONTRAKSI
            )
            VALUES (?, ?, ?, ?, ?, ?, ?);";

        $params = [
            // USING
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],

            // UPDATE SET
            $data['USIA_KEHAMILAN'],
            $data['GRAVIDA'],
            $data['PARTUS'],
            $data['ABORTUS'],
            $data['ONSET_KONTRAKSI'],

            // INSERT VALUES
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],
            $data['USIA_KEHAMILAN'],
            $data['GRAVIDA'],
            $data['PARTUS'],
            $data['ABORTUS'],
            $data['ONSET_KONTRAKSI'],
        ];

        return $this->db->query($sql, $params);
    }


    public function getByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_OBSTETRI')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->get()
            ->getRowArray();
    }

    // ✅ Get all rows by TRANS_ID (multi klaim per visit)
    public function getAllByTransId($trans_id)
    {
        return $this->db->table('EKLAIM_OBSTETRI')
            ->where('TRANS_ID', $trans_id)
            ->get()
            ->getResultArray();
    }

    // ✅ Check if row exists
    public function exists($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_OBSTETRI')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->countAllResults() > 0;
    }
}
