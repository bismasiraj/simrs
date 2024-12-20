<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class TreatmentBillModel extends Model
{
    protected $table      = 'treatment_bill';
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
        'no_registration',
        'visit_id',
        'tarif_name',
        'treat_date',
        'iscetak',
        'sell_price',
        'kal_id',
        'amount_paid',
        'amount_plafond',
        'amount_paid_plafond',
        'discount',
        'subsidisat',

        'isrj',
        'pembulatan',
        'amount',
        'tagihan',
        'diskon',
        'potongan',
        'subsidi',
        'bayar',
        'retur',
        'ppn',
        'koreksi',
        'embalace',
        'quantity',
        'tarif_type',
        'ppnvalue',
        'pokok_jual',
        'margin',
        'racikan',
        'exit_date',
        'description',
        'clinic_id_from',
        'employee_id_from',
        'class_room_id',
        'keluar_id',

        'account_id',
        'task_id',
        'cashier',
        'modified_by',
        'modified_date',
        'modified_from',
        'printed_by',
        'print_date',
        'printq',
        'trans_id',
        'spppoli',
        'sppbill',
        'sppkasir',
        'ageday',
        'agemonth',
        'ageyear',
        'bed_id',
        'brand_id',
        'pay_method_id',
        'class_id',
        'class_id_plafond',
        'clinic_id',
        'correction_by',
        'correction_id',
        'description2',
        'doctor_from',
        'employee_id',
        'gender',
        'info',
        'invoice_id',
        'iscito',
        'karyawan',
        'bill_id',
        'kuitansi_id',
        'visit_id',
        'islunas',
        'module_id',
        'doctor',
        'nota_no',
        'org_unit_code',
        'package_id',
        'payor_id',
        'profesi',
        'resep_no',
        'sekarang',
        'sold_status',
        'sppbilldate',
        'spppolidate',
        'status_obat',
        'status_pasien_id',
        'measure_id',
        'tarif_id',
        'tarif_id_plafond',
        'tc1',
        'tc2',
        'payment_date',
        'the_order',
        'theaddress',
        'theid',
        'thename',
        'theorder',
        'tipetarif',
        'treatment',
        'treatment_plafond',
        'diagnosa_desc',
        'indication_desc',
    ];


    public function getBill($nomor, $ke, $mulai, $akhir, $lunas, $klinik, $rj, $status, $nota, $trans, $start = null, $end = null)
    {
        $sql = "SP_TAGIHANPASIEN_NOTATRANS;1 @NOMOR = '$nomor', @KE = '$ke', @MULAI = '$mulai', @AKHIR = '$akhir', @LUNAS = '$lunas', @KLINIK = '$klinik', @RJ = '$rj', @status = '$status', @NOTA = '$nota', @TRANS = '$trans'";

        $result = $this->db->query(new RawSql($sql));

        $data = $result->getResultArray();

        if ($start !== null && $end !== null) {
            $data = array_filter($data, function ($row) use ($start, $end) {
                $treatDate = $row['TREAT_DATE'];
                return ($treatDate >= $start && $treatDate <= $end);
            });
        }

        return $data;
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
