<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;

class TreatmentObatModel extends Model
{
    protected $table      = 'treatment_obat';
    protected $primaryKey = 'bill_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'org_unit_code',
        'jml_bks',
        'dose',
        'orig_dose',
        'resep_ke',
        'description',
        'brand_id',
        'measure_id',
        'measure_id2',
        'racikan',
        'doctor',
        'employee_id',
        'employee_id_from',
        'doctor_from',
        'status_obat',
        'tarif_id',
        'treatment',
        'tarif_type',
        'amount',
        'sell_price',
        'tagihan',
        'subsidi',
        'subsidisat',
        'margin',
        'ppn',
        'ppnvalue',
        'discount',
        'diskon',
        'profession',
        'profesi',
        'amount_paid',
        'description2',
        'dose_presc',
        'quantity',
        'numer',
        'resep_no',
        'nota_no',
        'treat_date',
        'bill_id',
        'class_room_id',
        'clinic_id',
        'clinic_id_from',
        'visit_id',
        'no_registration',
        'trans_id',
        'modified_from',
        'modified_date',
        'isrj',
        'thename',
        'theaddress',
        'theid',
        'module_id',
        'dose1',
        'dose2',
        'theorder',
        'sold_status'
        // 'org_unit_code',
        // 'jml_bks',
        // 'dose',
        // 'orig_dose',
        // 'resep_ke',
        // 'description',
        // 'brand_id',
        // 'measure_id',
        // 'measure_id2',
        // 'racikan',
        // 'doctor',
        // 'employee_id',
        // 'employee_id_from',
        // 'doctor_from',
        // 'status_obat',
        // 'tarif_id',
        // 'treatment',
        // 'tarif_type',
        // 'amount',
        // 'sell_price',
        // 'tagihan',
        // 'subsidi',
        // 'subsidisat',
        // 'margin',
        // 'ppn',
        // 'ppnvalue',
        // 'discount',
        // 'diskon',
        // 'profession',
        // 'profesi',
        // 'amount_paid',
        // 'description2',
        // 'dose_presc',
        // 'quantity',
        // 'numer',
        // 'resep_no',
        // 'nota_no',
        // 'treat_date',
        // 'bill_id',
        // 'class_room_id',
        // 'clinic_id',
        // 'clinic_id_from',
        // 'visit_id',
        // 'no_registration',
        // 'trans_id',
        // 'modified_from',
        // 'modified_date',
        // 'isrj',
        // 'thename',
        // 'theaddress',
        // 'theid',
        // 'dose1',
        // 'dose2',
        // 'module_id',
        // 'theorder'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';

    public function getObatResep($visitId)
    {
        $select = $this->select("treatment_obat.no_registration,   
        treatment_obat.visit_id, 
        treatment_obat.bill_id, 
        treatment_obat.employee_id, 
        treatment_obat.doctor,
        51 as task_id,
        treatment_obat.employee_id_from, 
        treatment_obat.doctor_from,
        treatment_obat.tarif_id, 
        convert(varchar,TREAT_DATE,20) as treat_date,  
        treatment_obat.exit_date, 
        isnull(amount,0.0) amount,  
        isnull(amount_paid,0.0) amount_paid,  
        isnull(quantity,0.0) quantity,   
        isnull(subsidi,0.0) subsidi, 
        treatment_obat.measure_id,    
        treatment_obat.pay_method_id, 
        treatment_obat.payment_date, 
        treatment_obat.islunas,   
        treatment_obat.description,  
        treatment_obat.modified_by, 
        treatment_obat.modified_date, 
        treatment_obat.modified_from, 
        treatment_obat.clinic_id,  
        treatment_obat.iscetak,
        treatment_obat.print_date,  
        treatment_obat.treatment,
        treatment_obat.org_unit_code,
        treatment_obat.class_room_id,
        treatment_obat.brand_id, 
        treatment_obat.dose ,
        isnull(jml_bks,0.0) jml_bks ,
        isnull(dose_presc,0.0) dose_presc ,
        isnull(orig_dose,0.0) orig_dose ,
        treatment_obat.resep_ke ,
        treatment_obat.iter ,
        treatment_obat.iter_ke ,
        treatment_obat.nota_no, 
        treatment_obat.bed_id,
        treatment_obat.kuitansi_id,
        treatment_obat.clinic_id_from, 
        treatment_obat.sold_status,
        treatment_obat.keluar_id,  
        getdate() as sekarang, 
        treatment_obat.resep_no,
        isnull(margin,0.0) margin,
        isnull(discount,0.0) discount,
        treatment_obat.pokok_jual,
        isnull(embalace,0.0) embalace,
        isnull(profesi,0.0) profesi,
        isnull(ppn,0.0) ppn,
        treatment_obat.description2, 
          treatment_obat.racikan, 
          treatment_obat.status_pasien_id, 
          treatment_obat.thename, 
          treatment_obat.theaddress, 
          treatment_obat.theid,
          treatment_obat.class_id,
          0 as class_id_plafond,
          0 as amount_plafond, 
          '' as treatment_plafond,
          0 as amount_paid_plafond,
          isnull(pembulatan,0.0) pembulatan, 
          treatment_obat.isrj,
          treatment_obat.ageyear,
          treatment_obat.agemonth,
          treatment_obat.ageday,
          treatment_obat.payor_id, 
          treatment_obat.gender, 
          treatment_obat.kal_id,
          treatment_obat.correction_id, 
          treatment_obat.correction_by,
          treatment_obat.karyawan,
          ISNULL(diskon,0.0) diskon,
          isnull(sell_price,0.0) sell_price,
          treatment_obat.account_id,
          treatment_obat.tarif_type,
          treatment_obat.invoice_id, 
          '0' as iscito,
          treatment_obat.numer,
          ISNULL(potongan,0.0) potongan,
          ISNULL(bayar,0.0) bayar,
          ISNULL(retur,0.0) retur,
          ISNULL(ppnvalue,0.0) ppnvalue,
          ISNULL(tagihan,0.0) tagihan,
          treatment_obat.koreksi,
          '' as info,
          treatment_obat.status_obat,
          ISNULL(subsidisat,0.0) as subsidisat,
          treatment_obat.printq,
          treatment_obat.printed_by,
          treatment_obat.package_id,
          treatment_obat.module_id,
          isnull(profession,0.0) profession,
          treatment_obat.theorder,
          treatment_obat.cashier,
          treatment_obat.stock_available ,
          treatment_obat.trans_id,
          treatment_obat.spppoli, 
          treatment_obat.sppbill, 
          treatment_obat.sppkasir,
          treatment_obat.spppolidate,
          treatment_obat.spppoliuser,
          treatment_obat.measure_id2,
          treatment_obat.nosep,
          treatment_obat.aturanminum2, 
          treatment_obat.rekonstatus_id, 
          treatment_obat.education_id,
          treatment_obat.takepill_date,
          treatment_obat.ed,
          isnull(treatment_obat.dose1,0) as dose1,
          isnull(treatment_obat.dose2,0) as dose2")
            ->where('visit_id', $visitId)
            ->orderBy('resep_no,resep_ke, theorder, treat_date')
            ->findAll();
        return $select;
    }
    public function getHistoryObatResep($nomor, $soldStatus)
    {
        $select = $this->select("treatment_obat.no_registration,   
        treatment_obat.visit_id, 
        treatment_obat.bill_id, 
        treatment_obat.employee_id, 
        treatment_obat.doctor,
        51 as task_id,
        treatment_obat.employee_id_from, 
        treatment_obat.doctor_from,
        treatment_obat.tarif_id, 
        convert(varchar,TREAT_DATE,20) as treat_date,  
        treatment_obat.exit_date, 
        isnull(amount,0.0) amount,  
        isnull(amount_paid,0.0) amount_paid,  
        isnull(quantity,0.0) quantity,   
        isnull(subsidi,0.0) subsidi, 
        treatment_obat.measure_id,    
        treatment_obat.pay_method_id, 
        treatment_obat.payment_date, 
        treatment_obat.islunas,   
        treatment_obat.description,  
        treatment_obat.modified_by, 
        treatment_obat.modified_date, 
        treatment_obat.modified_from, 
        treatment_obat.clinic_id,  
        treatment_obat.iscetak,
        treatment_obat.print_date,  
        treatment_obat.treatment,
        treatment_obat.org_unit_code,
        treatment_obat.class_room_id,
        treatment_obat.brand_id, 
        treatment_obat.dose ,
        isnull(jml_bks,0.0) jml_bks ,
        isnull(dose_presc,0.0) dose_presc ,
        isnull(orig_dose,0.0) orig_dose ,
        treatment_obat.resep_ke ,
        treatment_obat.iter ,
        treatment_obat.iter_ke ,
        treatment_obat.nota_no, 
        treatment_obat.bed_id,
        treatment_obat.kuitansi_id,
        treatment_obat.clinic_id_from, 
        treatment_obat.sold_status,
        treatment_obat.keluar_id,  
        getdate() as sekarang, 
        treatment_obat.resep_no,
        isnull(margin,0.0) margin,
        isnull(discount,0.0) discount,
        treatment_obat.pokok_jual,
        isnull(embalace,0.0) embalace,
        isnull(profesi,0.0) profesi,
        isnull(ppn,0.0) ppn,
        treatment_obat.description2, 
          treatment_obat.racikan, 
          treatment_obat.status_pasien_id, 
          treatment_obat.thename, 
          treatment_obat.theaddress, 
          treatment_obat.theid,
          treatment_obat.class_id,
          0 as class_id_plafond,
          0 as amount_plafond, 
          '' as treatment_plafond,
          0 as amount_paid_plafond,
          isnull(pembulatan,0.0) pembulatan, 
          treatment_obat.isrj,
          treatment_obat.ageyear,
          treatment_obat.agemonth,
          treatment_obat.ageday,
          treatment_obat.payor_id, 
          treatment_obat.gender, 
          treatment_obat.kal_id,
          treatment_obat.correction_id, 
          treatment_obat.correction_by,
          treatment_obat.karyawan,
          ISNULL(diskon,0.0) diskon,
          isnull(sell_price,0.0) sell_price,
          treatment_obat.account_id,
          treatment_obat.tarif_type,
          treatment_obat.invoice_id, 
          '0' as iscito,
          treatment_obat.numer,
          ISNULL(potongan,0.0) potongan,
          ISNULL(bayar,0.0) bayar,
          ISNULL(retur,0.0) retur,
          ISNULL(ppnvalue,0.0) ppnvalue,
          ISNULL(tagihan,0.0) tagihan,
          treatment_obat.koreksi,
          '' as info,
          treatment_obat.status_obat,
          ISNULL(subsidisat,0.0) as subsidisat,
          treatment_obat.printq,
          treatment_obat.printed_by,
          treatment_obat.package_id,
          treatment_obat.module_id,
          isnull(profession,0.0) profession,
          treatment_obat.theorder,
          treatment_obat.cashier,
          treatment_obat.stock_available ,
          treatment_obat.trans_id,
          treatment_obat.spppoli, 
          treatment_obat.sppbill, 
          treatment_obat.sppkasir,
          treatment_obat.spppolidate,
          treatment_obat.spppoliuser,
          treatment_obat.measure_id2,
          treatment_obat.nosep,
          treatment_obat.aturanminum2, 
          treatment_obat.rekonstatus_id, 
          treatment_obat.education_id,
          treatment_obat.takepill_date,
          treatment_obat.ed,
          isnull(treatment_obat.dose1,0) as dose1,
          isnull(treatment_obat.dose2,0) as dose2")
            ->where('no_registration', $nomor)
            ->where('sold_status', $soldStatus)
            ->where("treat_date > dateadd(month,-3,getdate())")
            ->orderBy('resep_no,resep_ke, theorder, treat_date')
            ->findAll();
        return $select;
    }

    public function generateResep($norm, $tgl, $clinicId, $isrj)
    {
        $hasil = '';
        $sql = "SET NOCOUNT ON 
            DECLARE
        @theID varchar(50)

        EXEC    [SP_RESEP]
                @NOMOR = N'$norm',
                @tgl = N'$tgl',
                @POLI = N'$clinicId',
                @RJ = N'$isrj',
                @theID = '$hasil' OUTPUT

        SELECT  @theID as N'@theID'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }

    public function getNotaRinci($mulai, $akhir, $status, $rj, $clinic, $shift)
    {
        $sql = "SP_EIS_REKAPOBATSTATUS;1 @STATUS = '$status', @MULAI = '$mulai', @AKHIR = '$akhir', @RJ = '$rj', @klinik = '$clinic', @shift = '$shift'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getPemakaian($mulai, $akhir, $status, $rj, $clinic, $shift)
    {
        $sql = "SP_EIS_REKAPOBATSTATUSRESEP;1 @STATUS = '$status', @MULAI = '$mulai', @AKHIR = '$akhir', @RJ = '$rj', @klinik = '$clinic', @shift = '$shift'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getPelayanan($mulai, $akhir, $status, $rj, $clinic)
    {
        $sql = "SP_EIS_REKAPgeneric;1 @STATUS = '$status', @MULAI = '$mulai', @AKHIR = '$akhir', @RJ = '$rj', @POLI = '$clinic'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getObatAlkes($mulai, $akhir, $clinic, $barang, $dokter, $rj)
    {
        $sql = "SP_EIS_REKAPOBATSTATUSBARU;1 @MULAI = '$mulai', @AKHIR = '$akhir', @klinik = '$clinic', @barang = '$barang', @dokter = '$dokter', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        //dw_1.retrieve(sKet.mulai,sKet.akhir,iiklinik,isNama,'%',lsrj)
    }
    public function getObatAlkesRinci($namabarang, $tgl, $clinic, $rj)
    {
        return $this->join('clinic c', 'c.clinic_id = treatment_obat.clinic_id', 'inner')
            ->where('brand_id is not null')
            ->where("convert(date,treatment_obat.treat_date,102) = dateadd(hour,0,'" . $tgl . "')")
            ->like('description', $namabarang)
            ->like('c.clinic_id', $clinic)
            ->like('isrj', $rj)
            ->orderBy('thename')
            ->select("treatment_obat.thename AS NAMA
            , treatment_obat.no_registration AS NO_CM
            , quantity as jml
            , treatment_obat.RETUR AS RETUR
            , treatment_obat.SELL_PRICE AS HARGA_SATUAN
            , treatment_obat.DISCOUNT AS DISKON
            , treatment_obat.CLINIC_ID AS ID_KLINIK
            , treatment_obat.DOCTOR AS DOKTER
            , c.NAME_OF_CLINIC AS NAMA_KLINIK
            , treatment_obat.AMOUNT_PAID AS TOTAL")->findAll();
    }
    public function getPsikotropikaObat($barang, $mulai, $akhir, $generik, $isrj, $islayan, $poli, $dokter)
    {
        $sql = "SP_PSIKOTROPIKAOBAT;1 @BARANG = '$barang', @MULAI = '$mulai', @AKHIR = '$akhir', @GENERIK = '$generik', @isrj = '$isrj', @islayan = '$islayan', @poli = '$poli',@dokter = '$dokter'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        //dw_1.retrieve(sKet.mulai,sKet.akhir,iiklinik,isNama,'%',lsrj)
    }
    public function getPsikotropikaDokter($barang, $mulai, $akhir, $generik, $isrj, $islayan, $poli, $dokter, $gentype)
    {
        $sql = "SP_PSIKOTROPIKADOKTER;1 @BARANG = '$barang', @MULAI = '$mulai', @AKHIR = '$akhir', @GENERIK = '$generik', @isrj = '$isrj', @islayan = '$islayan', @poli = '$poli',@dokter = '$dokter', @GENtype = '$gentype'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        //@BARANG = $BARANG, @DOKTER = $DOKTER, @GENERIK = $GENERIK, @MULAI = $MULAI, @AKHIR = $AKHIR, @GENtype = $GENtype, @isrj = $isrj, @islayan = $islayan, @poli = $poli
    }
    public function getPsikotropika($barang, $mulai, $akhir, $generik, $isrj, $islayan, $poli, $dokter, $gentype)
    {
        $sql = "SP_PSIKOTROPIKA;1 @BARANG = '$barang', @MULAI = '$mulai', @AKHIR = '$akhir', @GENERIK = '$generik', @isrj = '$isrj', @islayan = '$islayan', @poli = '$poli',@dokter = '$dokter', @GENtype = '$gentype'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        //@BARANG = $BARANG, @DOKTER = $DOKTER, @GENERIK = $GENERIK, @MULAI = $MULAI, @AKHIR = $AKHIR, @GENtype = $GENtype, @isrj = $isrj, @islayan = $islayan, @poli = $poli
    }
    public function getRekapPsikotropika($barang, $mulai, $akhir, $room, $uu)
    {
        $sql = "SP_PSIKOTROPIKAGF;1 @MULAI = '$mulai', @AKHIR = '$akhir', @ROOM = '$room', @BARANG = '$barang', @UU = '$uu'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        //@BARANG = $BARANG, @DOKTER = $DOKTER, @GENERIK = $GENERIK, @MULAI = $MULAI, @AKHIR = $AKHIR, @GENtype = $GENtype, @isrj = $isrj, @islayan = $islayan, @poli = $poli
    }
    public function getKartuBarang($BRAND, $ROOM, $STATUS, $BLN1, $BLN2, $TH)
    {
        $sql = "SP_EIS_STOCKKB_PERPETUAL;1 @BRAND = '$BRAND', @ROOM = '$ROOM', @STATUS = '$STATUS', @BLN1 = '$BLN1', @BLN2 = '$BLN2', @TH = '$TH'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        //@BARANG = $BARANG, @DOKTER = $DOKTER, @GENERIK = $GENERIK, @MULAI = $MULAI, @AKHIR = $AKHIR, @GENtype = $GENtype, @isrj = $isrj, @islayan = $islayan, @poli = $poli
    }
    public function getPersediaan($BRAND, $ROOM, $STATUS, $BLN, $TH, $ALKES, $DANA, $MULAI, $AKHIR)
    {
        $sql = "SP_STOCK_BARU_ADAKOREKSI_PERPETUAL;1 @BRAND = '$BRAND', @ROOM = '$ROOM', @STATUS = '$STATUS', @BLN = '$BLN', @TH = '$TH', @ALKES = '$ALKES', @DANA = '$DANA',@MULAI='$MULAI',@AKHIR ='$AKHIR'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
        // SP_STOCK_BARU_ADAKOREKSI_PERPETUAL;1 @BRAND = :BRAND, @ROOM = :ROOM, @STATUS = :STATUS, @BLN = :BLN, @TH = :TH, @ALKES = :ALKES, @DANA = :DANA,@MULAI=:MULAI,@AKHIR =:AKHIR
    }
}
