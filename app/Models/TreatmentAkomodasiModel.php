<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class TreatmentAkomodasiModel extends Model
{
    protected $table      = 'treatment_akomodasi';
    protected $primaryKey = 'bill_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    // protected $allowedFields = ['name', 'email'];


    public function getRanap($id)
    {
        $sql = "SP_SEARCHKUNJUNGANRIAKOM_BPJS_NOKARTU;1 @NAMA = '%', @KODE = '$id', @ALAMAT = '%', @POLI = '%'', @SUDAH = '':SUDAH'', @DOKTER = '%'', @KELUAR = :KELUAR, @MULAI = :MULAI, @AKHIR = :AKHIR, @X = :X, @NOKARTU = :NOKARTU";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }

    public function getPasienRanap($nama = null, $kode = null, $alamat = null, $poli = null, $mulai = null, $akhir = null, $sudah = null, $dokter = null, $nokartu = null, $keluar = null, $x)
    {
        $sql = "SP_SEARCHKUNJUNGANRIAKOM_BPJS_NOKARTU;1 @NAMA = '%$nama%', @KODE = '%$kode%', @ALAMAT = '%$alamat%', @POLI = '%$poli%', @SUDAH = '$sudah', @DOKTER = '%$dokter%', @KELUAR = '$keluar', @MULAI = '$mulai', @AKHIR = '$akhir', @X = '$x', @NOKARTU = '%$nokartu%'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getregistermasuk($mulai, $akhir, $status, $rj, $poli)
    {
        $sql = "SP_EIS_Register_MASUK;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj', @POLI = '$poli'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getregisterkeluar($mulai, $akhir, $status, $rj, $poli)
    {
        $sql = "SP_EIS_Register_PINDAH;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj', @POLI = '$poli'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getregistermelahirkan($mulai, $akhir, $status, $rj, $poli)
    {
        $sql = "SP_EIS_Register_melahirkan;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj', @POLI = '$poli'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmkunjunganranap($mulai, $akhir, $kal, $rw, $poli, $status, $baru, $lb, $ub, $nomor, $tindak)
    {
        $sql = "SP_EIS_KUNJUNGAN_RI;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KAL = '$kal', @RW = '$rw', @POLI = '$poli', @STATUS = '$status', @BARU = '$baru', @LB = '$lb', @UB = '$ub', @NOMOR = '$nomor', @TINDAK = '$tindak'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmkunjunganranaprl($mulai, $akhir, $kal, $rw, $poli, $status, $baru, $lb, $ub, $nomor, $tindak)
    {
        $sql = "SP_EIS_KUNJUNGAN_RIRL;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KAL = '$kal', @RW = '$rw', @POLI = '$poli', @STATUS = '$status', @BARU = '$baru', @LB = '$lb', @UB = '$ub', @NOMOR = '$nomor', @TINDAK = '$tindak'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmtopxranap($mulai, $akhir, $poli, $status, $rj, $x)
    {
        $sql = "SP_EIS_TOPX_RANAP;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @STATUS = '$status', @RJ = '$rj', @X = $x";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmindexranap($mulai, $akhir, $poli, $status, $rj)
    {
        $sql = "SP_EIS_SENSUS_PENYAKIT_RANAP;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @STATUS = '$status', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
}
