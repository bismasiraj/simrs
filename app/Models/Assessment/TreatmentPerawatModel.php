<?php

namespace App\Models\Assessment;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class TreatmentPerawatModel extends Model
{
    protected $table      = 'treatment_perawat';
    protected $primaryKey = 'bill_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $allowedFields = [
        'org_unit_code',
        'bill_id',
        'no_registration',
        'visit_id',
        'tarif_id',
        'class_id',
        'clinic_id',
        'clinic_id_from',
        'treatment',
        'treat_date',
        'amount',
        'quantity',
        // 'measure_id',
        'pokok_jual',
        'ppn',
        'margin',
        'subsidi',
        'embalace',
        'profesi',
        'discount',
        'pay_method_id',
        'payment_date',
        'islunas',
        'duedate_angsuran',
        'description',
        'kuitansi_id',
        'nota_no',
        'iscetak',
        'print_date',
        // 'resep_no',
        // 'resep_ke',
        // 'dose',
        // 'orig_dose',
        // 'dose_presc',
        // 'iter',
        // 'iter_ke',
        // 'sold_status',
        // 'racikan',
        'class_room_id',
        'keluar_id',
        'bed_id',
        'perda_id',
        'employee_id',
        'description2',
        'modified_by',
        'modified_date',
        'modified_from',
        // 'brand_id',
        'doctor',
        // 'jml_bks',
        'exit_date',
        'fa_v',
        'task_id',
        'employee_id_from',
        'doctor_from',
        'status_pasien_id',
        'amount_paid',
        'thename',
        'theaddress',
        'theid',
        'serial_nb',
        'treatment_plafond',
        'amount_plafond',
        'amount_paid_plafond',
        'class_id_plafond',
        'payor_id',
        'pembulatan',
        'isrj',
        'ageyear',
        'agemonth',
        'ageday',
        'gender',
        'kal_id',
        // 'correction_id',
        'correction_by',
        'karyawan',
        'account_id',
        'sell_price',
        'diskon',
        'invoice_id',
        // 'numer',
        // 'measure_id2',
        'potongan',
        'bayar',
        'retur',
        'tarif_type',
        'ppnvalue',
        'tagihan',
        'koreksi',
        'status_obat',
        'subsidisat',
        'printq',
        'printed_by',
        'stock_available',
        'status_tarif',
        'clinic_type',
        'package_id',
        'module_id',
        'profession',
        'theorder',
        'cashier',
        'trans_id',
        'nosep',
        'pasien_id',
        'total_tagihan',
        'tarif_id_plafond',
        'treatment_type'
    ];


    public function getBill($nomor, $ke, $mulai, $akhir, $lunas, $klinik, $rj, $status, $nota, $trans)
    {
        $sql = "SP_TAGIHANPASIEN_NOTATRANS;1 @NOMOR = '$nomor', @KE = '$ke', @MULAI = '$mulai', @AKHIR = '$akhir', @LUNAS = '$lunas', @KLINIK = '$klinik', @RJ = '$rj', @status = '$status', @NOTA = '$nota', @TRANS = '$trans'";
        // return $sql;
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getharian($mulai, $akhir, $status, $rj)
    {
        $sql = "SP_EIS_TRANSAKSI;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getbulanan($mulai, $akhir, $status, $rj)
    {
        $sql = "SP_EIS_TRANSAKSITAHUN;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function gettglpoli($mulai, $akhir, $poli, $rj)
    {
        $sql = "SP_EIS_PENERIMAANPOLI;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getjenis($mulai, $akhir, $status, $rj)
    {
        $sql = "SP_EIS_PENERIMAANSTATUS;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getjenisdetil($mulai, $akhir, $status, $rj)
    {
        $sql = "SP_EIS_PENERIMAANSTATUS_DETIL;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getpolidetil($mulai, $akhir, $poli, $rj)
    {
        $sql = "SP_EIS_PENERIMAANPOLI_DETIL;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getpembayaran($mulai, $akhir, $tarif, $rj)
    {
        $sql = "SP_EIS_TRANSAKSIBAYAR;1 @MULAI = '$mulai', @AKHIR = '$akhir', @TARIF = '$tarif', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getpembayaranrinci($mulai, $akhir, $tarif, $rj)
    {
        $sql = "SP_EIS_TRANSAKSIBAYAR_DETIL;1 @MULAI = '$mulai', @AKHIR = '$akhir', @TARIF = '$tarif', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getsetoran($mulai, $akhir, $kasir, $rj)
    {
        $sql = "SP_EIS_TRANSAKSIKASIR;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KASIR = '$kasir', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getsetoranrinci($mulai, $akhir, $kasir, $rj)
    {
        $sql = "SP_EIS_TRANSAKSIKASIR_DETIL;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KASIR = '$kasir', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
}
