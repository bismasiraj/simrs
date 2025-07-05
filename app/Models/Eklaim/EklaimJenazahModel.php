<?php

namespace App\Models\Eklaim;

use CodeIgniter\Model;

class EklaimJenazahModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrUpdateJenazah($data)
    {
        $sql = "
        MERGE INTO EKLAIM_JENAZAH AS target
        USING (SELECT ? AS TRANS_ID, ? AS NOSEP_KLAIM) AS source
        ON target.TRANS_ID = source.TRANS_ID AND target.NOSEP_KLAIM = source.NOSEP_KLAIM
        WHEN MATCHED THEN
            UPDATE SET
                PEMULASARAAN = ?,
                KANTONG = ?,
                PETI = ?,
                PLASTIK = ?,
                DESINFEKTAN = ?,
                MOBIL = ?,
                DESINFEKTAN_MOBIL = ?
        WHEN NOT MATCHED THEN
            INSERT (
                TRANS_ID, NOSEP_KLAIM,
                PEMULASARAAN, KANTONG, PETI, PLASTIK,
                DESINFEKTAN, MOBIL, DESINFEKTAN_MOBIL
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $params = [
            // for USING clause
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],

            // for UPDATE clause
            $data['PEMULASARAAN'],
            $data['KANTONG'],
            $data['PETI'],
            $data['PLASTIK'],
            $data['DESINFEKTAN'],
            $data['MOBIL'],
            $data['DESINFEKTAN_MOBIL'],

            // for INSERT clause
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],
            $data['PEMULASARAAN'],
            $data['KANTONG'],
            $data['PETI'],
            $data['PLASTIK'],
            $data['DESINFEKTAN'],
            $data['MOBIL'],
            $data['DESINFEKTAN_MOBIL']
        ];

        return $this->db->query($sql, $params);
    }
    public function getByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_JENAZAH')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->get()
            ->getRowArray();
    }

    // ✅ Get all rows by TRANS_ID (multi klaim per visit)
    public function getAllByTransId($trans_id)
    {
        return $this->db->table('EKLAIM_JENAZAH')
            ->where('TRANS_ID', $trans_id)
            ->get()
            ->getResultArray();
    }

    // ✅ Check if row exists
    public function exists($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_JENAZAH')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->countAllResults() > 0;
    }
}
