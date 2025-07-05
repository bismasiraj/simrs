<?php

namespace App\Models\Eklaim;

use CodeIgniter\Model;

class EklaimTarifRsModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertOrUpdateTarifRS($data)
    {
        $sql = "
        MERGE INTO EKLAIM_TARIF_RS AS target
        USING (SELECT ? AS TRANS_ID, ? AS NOSEP_KLAIM) AS source
        ON target.TRANS_ID = source.TRANS_ID AND target.NOSEP_KLAIM = source.NOSEP_KLAIM
        WHEN MATCHED THEN
            UPDATE SET
                PROSEDUR_NON_BEDAH = ?, PROSEDUR_BEDAH = ?, KONSULTASI = ?, TENAGA_AHLI = ?, KEPERAWATAN = ?,
                PENUNJANG = ?, RADIOLOGI = ?, LABORATORIUM = ?, PELAYANAN_DARAH = ?, REHABILITASI = ?,
                KAMAR = ?, RAWAT_INTENSIF = ?, OBAT = ?, OBAT_KRONIS = ?, OBAT_KEMOTERAPI = ?,
                ALKES = ?, BMHP = ?, SEWA_ALAT = ?
        WHEN NOT MATCHED THEN
            INSERT (
                TRANS_ID, NOSEP_KLAIM,
                PROSEDUR_NON_BEDAH, PROSEDUR_BEDAH, KONSULTASI, TENAGA_AHLI, KEPERAWATAN,
                PENUNJANG, RADIOLOGI, LABORATORIUM, PELAYANAN_DARAH, REHABILITASI,
                KAMAR, RAWAT_INTENSIF, OBAT, OBAT_KRONIS, OBAT_KEMOTERAPI,
                ALKES, BMHP, SEWA_ALAT
            )
            VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            );";

        $params = [
            // USING
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],

            // UPDATE
            $data['PROSEDUR_NON_BEDAH'],
            $data['PROSEDUR_BEDAH'],
            $data['KONSULTASI'],
            $data['TENAGA_AHLI'],
            $data['KEPERAWATAN'],
            $data['PENUNJANG'],
            $data['RADIOLOGI'],
            $data['LABORATORIUM'],
            $data['PELAYANAN_DARAH'],
            $data['REHABILITASI'],
            $data['KAMAR'],
            $data['RAWAT_INTENSIF'],
            $data['OBAT'],
            $data['OBAT_KRONIS'],
            $data['OBAT_KEMOTERAPI'],
            $data['ALKES'],
            $data['BMHP'],
            $data['SEWA_ALAT'],

            // INSERT
            $data['TRANS_ID'],
            $data['NOSEP_KLAIM'],
            $data['PROSEDUR_NON_BEDAH'],
            $data['PROSEDUR_BEDAH'],
            $data['KONSULTASI'],
            $data['TENAGA_AHLI'],
            $data['KEPERAWATAN'],
            $data['PENUNJANG'],
            $data['RADIOLOGI'],
            $data['LABORATORIUM'],
            $data['PELAYANAN_DARAH'],
            $data['REHABILITASI'],
            $data['KAMAR'],
            $data['RAWAT_INTENSIF'],
            $data['OBAT'],
            $data['OBAT_KRONIS'],
            $data['OBAT_KEMOTERAPI'],
            $data['ALKES'],
            $data['BMHP'],
            $data['SEWA_ALAT']
        ];

        return $this->db->query($sql, $params);
    }

    public function getByTransAndNosep($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_TARIF_RS')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->get()
            ->getRowArray();
    }

    // ✅ Get all rows by TRANS_ID (multi klaim per visit)
    public function getAllByTransId($trans_id)
    {
        return $this->db->table('EKLAIM_TARIF_RS')
            ->where('TRANS_ID', $trans_id)
            ->get()
            ->getResultArray();
    }

    // ✅ Check if row exists
    public function exists($trans_id, $nosep_klaim)
    {
        return $this->db->table('EKLAIM_TARIF_RS')
            ->where('TRANS_ID', $trans_id)
            ->where('NOSEP_KLAIM', $nosep_klaim)
            ->countAllResults() > 0;
    }
}
