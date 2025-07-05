<?php

namespace App\Models\Eklaim;

use CodeIgniter\Model;

class EklaimObstetriDeliveryModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert a single delivery entry
     */
    public function insertDelivery($data)
    {
        return $this->db->table('EKLAIM_OBSTETRI_DELIVERY')->insert($data);
    }

    /**
     * Insert multiple delivery entries (batch)
     */
    public function insertBatchDelivery($deliveryList)
    {
        return $this->db->table('EKLAIM_OBSTETRI_DELIVERY')->insertBatch($deliveryList);
    }

    /**
     * Optional: Delete existing deliveries for a given TRANS_ID + NOSEP_KLAIM before insert (to avoid duplicates)
     */
    public function deleteByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_OBSTETRI_DELIVERY')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->delete();
    }
    public function getByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_OBSTETRI_DELIVERY')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->get()
            ->getResultArray();
    }

    // ✅ Get all rows by TRANS_ID (multi klaim per visit)
    public function getAllByTransId($trans_id)
    {
        return $this->db->table('EKLAIM_OBSTETRI_DELIVERY')
            ->where('TRANS_ID', $trans_id)
            ->get()
            ->getResultArray();
    }

    // ✅ Check if row exists
    public function exists($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_OBSTETRI_DELIVERY')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->countAllResults() > 0;
    }
}
