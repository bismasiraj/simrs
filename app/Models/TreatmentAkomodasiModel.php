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
    protected $allowedFields = [
        'class_room_id',
        'treat_date',
        'exit_date',
        'quantity',
        'measure_id',
        'amount',
        'amount_paid',
        'islunas',
        'modified_from',
        'employee_id',
        'doctor',
        'employee_id_from',
        'doctor_from',
        'visit_id',
        'no_registration',
        'bill_id',
        'subsidi',
        'org_unit_code',
        'clinic_id',
        'treatment',
        'description',
        'tarif_id',
        'bed_id',
        'keluar_id',
        'nota_no',
        'clinic_id_from',
        'sold_status',
        'status_pasien_id',
        'thename',
        'theaddress',
        'theid',
        'class_id',
        'isrj',
        'payor_id',
        'ageyear',
        'agemonth',
        'ageday',
        'gender',
        'kal_id',
        'discount',
        'karyawan',
        'account_id',
        'sell_price',
        'diskon',
        'tagihan',
        'koreksi',
        'potongan',
        'bayar',
        'retur',
        'ppnvalue',
        'tarif_type',
        'subsidisat',
        'printq',
        'printed_by',
        'clinic_type',
        'package_id',
        'module_id',
        'theorder',
        'cashier',
        'no_skpinap',
        'pasien_id',
        'respon',
        'mapping_sep',
        'trans_id',
        'sppkasir',
        'sppbill',
        'spppoli'
    ];


    public function getRanap($id)
    {
        $sql = "SP_SEARCHKUNJUNGANRIAKOM_BPJS_NOKARTU;1 @NAMA = '%', @KODE = '$id', @ALAMAT = '%', @POLI = '%'', @SUDAH = '':SUDAH'', @DOKTER = '%'', @KELUAR = :KELUAR, @MULAI = :MULAI, @AKHIR = :AKHIR, @X = :X, @NOKARTU = :NOKARTU";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }

    public function getPasienRanap($nama = null, $kode = null, $alamat = null, $poli = null, $mulai = null, $akhir = null, $sudah = null, $dokter = null, $nokartu = null, $keluar = null, $x)
    {
        $sql = "SP_SEARCHKUNJUNGANRIAKOM_BPJS_NOKARTU_NEWFILTER;1 @NAMA = '%$nama%', @KODE = '%$kode%', @ALAMAT = '%$alamat%', @POLI = '%$poli%', @SUDAH = '$sudah', @DOKTER = '$dokter', @KELUAR = '$keluar', @MULAI = '$mulai', @AKHIR = '$akhir', @X = '$x', @NOKARTU = '%$nokartu%'";
        // $sql = "SP_SEARCHKUNJUNGANRIAKOM_BPJS_NOKARTU;1 @NAMA = '%$nama%', @KODE = '%$kode%', @ALAMAT = '%$alamat%', @POLI = '%$poli%', @SUDAH = '$sudah', @DOKTER = '$dokter', @KELUAR = '$keluar', @MULAI = '$mulai', @AKHIR = '$akhir', @X = '$x', @NOKARTU = '%$nokartu%'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getPasienRanapBidan($nama = null, $kode = null, $alamat = null, $poli = null, $mulai = null, $akhir = null, $sudah = null, $dokter = null, $nokartu = null, $keluar = null, $x)
    {
        $sql = "SP_SEARCHKUNJUNGANRIAKOM_BPJS_BIDAN;1 @NAMA = '%$nama%', @KODE = '%$kode%', @ALAMAT = '%$alamat%', @POLI = '%$poli%', @SUDAH = '$sudah', @DOKTER = '%$dokter%', @KELUAR = '$keluar', @MULAI = '$mulai', @AKHIR = '$akhir', @X = '$x', @NOKARTU = '%$nokartu%'";
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
        $sql = "SP_EIS_Register_KELUAR;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj', @POLI = '$poli'";
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
        $sql = "SP_EIS_KUNJUNGAN_RI;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KAL = '$kal', @RW = '$rw', @POLI = '$poli', @STATUS = '$status', @BARU = '$baru', @LB = '$lb', @UB = '$ub', @NOMOR = '$nomor', @TINDAK = '$tindak', @KLAS = '%'";
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
    public function getAkomodasi($nomor, $visit)
    {
        $builder = $this->select("*")->where('no_registration', $nomor)->where('visit_id', $visit)
            ->where('class_room_id is not null')->where("keluar_id is not null")->orderBy('treat_date asc');
        return $builder->findAll();
    }
    public function selectSep($visit)
    {
        $sql = " select p.pasien_id as noKartu , 
                cast(convert(varchar(10),visit_date,120)as datetime) as tglSep, 
                :gsPcareUN as ppkPelayanan,  
                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then '1' else '2' end  jnsPelayanan ,  
                //kelas RJ/RI
                //cs.other_id as klsRawat, //--21 May 2019

                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then //jika RI then
                    //cs.other_id
                    cs.other_id
                else
                    '3' //kelas 3
                end    as klsRawat, 
                
                            
                p.no_registration as noMr,  
                // asalrujukan as asalRujukan, 
                //--------------------- rujukan --------------------------------------------------------------------------
                case   when ( ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' ) and p.no_skp is not null then //saat RI, kalo ada SEP RJ, maka faskesnya  = unit iut sendiri
                    2
                else 
                    asalrujukan 
                end   as asalRujukan, // - new 20 May 2019 
                
                cast(convert(varchar(10),tanggal_rujukan,120)as datetime) as tglRujukan,  
                // norujukan as noRujukan,  -- new 20 May 2019
                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then
                    isnull(p.no_skp,noRujukan)
                else 
                    noRujukan 
                end   as noRujukan,
                //--------------------------------------------------------------------
                

                // ppkRujukan as ppkRujukan, 
                //<< 25 sept 2019, SEP RI kalo ada SEP RJ, maka akan digunakan dengan faskes = RS tersebut 
                case   when ( ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' ) and p.no_skp is not null then //saat RI, kalo ada SEP RJ, maka dia jadi no rujukan, otherwise no rujukannya
                        :gsPcareUN  // isnull(p.no_skp,noRujukan)
                else 
                        ppkRujukan
                end  as   ppkRujukan, //<< 25 sept 2019 NEW, SEP RI kalo ada SEP RJ, maka akan digunakan dengan faskes = RS tersebut
                


                case  when ( p.description is null )or (p.description = '') then '-' else p.description end  as catatan,  
                diag_Awal as diagAwal,  
                // ps.other_id as tujuan,  
                //-------------------------- tujuan -----------------------------------------
                case when rujukan_id = 500  then //kujungan pertama, //501 //post ranap //<<<<<<<<<<<<<<<<<< ini bedanya
                    p.kdpoli
                when class_room_id is not null then ''
                else
                    ps.kdpoli  
                end as tujuan,

                isnull(kdpoli_eks,'0') as eksekutif,  
                isnull(cob,'0') as cob,   
                isnull(p.BACKCHARGE,'0') as katarak, 
                case reason_id when 3 then '1' else '0' end as lakaLantas, 
                case penjamin when 0 then '' else isnull(penjamin,'') end as penjamin,  
                cast(convert(varchar(10),valid_rm_date,120)as datetime) as tglKejadian,  
                isnull(delete_sep,'-') as keterangan,
                
                //new 21 May 2019
                // isnull(ispertarif,'0') as suplesi,  
                case when reason_id = 3 and (no_skp is not null or no_skpinap is null ) then
                    isnull(ispertarif,'0')
                else
                    '0'
                end as suplesi,  


                //new 21 May 2019. Kalo suplesi centang , maka no suplesi  = no SEP
                //case ispertarif when '1' then isnull(p.no_skp,p.no_skpinap) else '' end as noSepSuplesi, 
                case when no_skp is null and no_skpinap is null then
                    ''
                when no_skpinap is not null and isperTarif='1' and reason_id = 3  then
                    no_skpinap
                when no_skpinap is  null and no_skp is not null and isperTarif='1'  and reason_id = 3 then //hanya jika kecelakaan
                    no_skp
                else
                    ''
                end as noSepSuplesi, 


                    
                isnull( (select kdprov from inasis_get_kecamatan where kode = p.lokasiLaka),'')  as kdPropinsi,  
                isnull( (select kdkab from inasis_get_kecamatan where kode = p.lokasiLaka),'')   as kdKabupaten, 
                isnull(p.lokasiLaka,'') as kdKecamatan , 
                // isnull(edit_sep,'000000') as noSurat,
                // no SKDP  -- new 16 May 2019
                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then
                    case when  p.specimenno is null or ltrim(p.specimenno) = '' then edit_sep else ltrim(p.specimenno)  end
                else 
                    edit_sep
                end   as noSurat,
                // isnull((select dpjp from employee_all where employee_id = p.employee_id),'10970')  as kdDPJP,
                //setting DPJP --new 20 May 2019
                //-------------------------------------------------------------------------------------------------------------------
                CASE  when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then 
                        (select dpjp from employee_all where employee_id = p.employee_inap)
                        
                //when p.edit_sep is null then ''
                else
                    
                    isnull(kdDPJP, (select dpjp from employee_all where employee_id =  p.employee_id)	)	
                end   as kdDPJP,

                isnull(pa.mobile,pa.phone_number) as noTelp,  
                //--------------------------------------------------------------------------------------------------------------
                p.modified_by as user1,
                temptrans as nolp,
                tujuankunj,
                replace(isnull(flagprocedure,''),'99','') flagprocedure,
                replace(isnull(kdpenunjang,''),'99','') kdpenunjang,
                replace(isnull(assesmentpel,''),'99','') assesmentpel
                INTO :ls_1, :ldtTgl1, :ls_3, :ls_4, :ls_5, :ls_6, :ls_7, :ldtTgl2,  :ls_9, :ls_10, 
                        :ls_11, :ls_12, :ls_13, :ls_14, :ls_15, :ls_16, :ls_17, :ls_18, :ldtTgl3, :ls_20, :ls_21,:ls_22, :ls_23, :ls_24 , :ls_25 , :ls_26  , :ls_27, :ls_28, :ls_29, :ls_30, :ls_31, :ls_32, :ls_33, :ls_34
                from  pasien_visitation p, pasien pa, clinic ps, class cs
                where p.no_registration = pa.no_registration  and p.org_unit_code = pa.org_unit_code   
                and ps.clinic_id  = p.clinic_id  and cs.class_id= p.class_id
                and visit_id ='$visit'";
    }
    public function getDataRanapByVisitId($visit_id)
    {
        $sql = "SELECT top(1)
                        (p.name_of_pasien) AS NAME_OF_PASIEN,   
                        tb.NO_REGISTRATION,   
                        tb.ORG_UNIT_CODE,  
                        (P.Date_of_birth) AS DATE_OF_BIRTH,   
                        (p.CONTACT_ADDRESS) AS CONTACT_ADDRESS,   
                        (p.PHONE_NUMBER) as PHONE_NUMBER,   
                        (p.MOBILE) as MOBILE,   
                        (p.KAL_ID) as KALURAHAN,
                        (tb.clinic_id) as clinic_id,
                        (tb.clinic_id_FROM) as clinic_id_from,
                        (c.name_of_clinic) AS NAME_OF_CLINIC,    
                        (isnull(left(tb.doctor,30), '-')) as fullname,
                        (tb.employee_id) AS EMPLOYEE_ID,
                        (tb.employee_id_from) AS employee_id_from,
                        (tb.EMPLOYEE_ID) as employee_inap,
                        (tb.treat_date) as booked_Date,
                        --DATEFROMPARTS (left(tb.visit_id,4), substring(tb.visit_id,5,2), substring(tb.visit_id,7,2)) as visit_date,
                        -- DATETIMEFROMPARTS ( left(tb.visit_id,4), substring(tb.visit_id,5,2), substring(tb.visit_id,7,2), substring(tb.visit_id,9,2), substring(tb.visit_id,11,2), substring(tb.visit_id,13,2), substring(tb.visit_id,15,2) )  as visit_date,
                        --  DATEDIFF(DAY,-2,MIN(tb.treat_date)) as visit_date,
                        (tb.treat_date) as visit_date,
                        tb.visit_id,
                        (p.name_of_pasien ) as diantar_oleh,
                        (p.contact_address) as visitor_address,
                        ( tb.class_room_id) AS CLASS_ROOM_ID, 
                        ( tb.bed_id) AS bed_id,
                        ( tb.keluar_id) AS KELUAR_ID,
                        (tb.treat_date) AS TREAT_DATE,
                        (TB.exit_date) AS EXIT_DATE,
                        (tb.status_pasien_id) AS STATUS_PASIEN_ID,
                        (class_room.name_of_class) AS CLASS_ROOM, 
                        (P.KK_NO) as PASIEN_ID, --new, 13 june 2017
                        p.PASIEN_ID  as npk, 
                        (isnull(p.gender,1)) as gender, 
                        (tb.payor_id) AS PAYOR_ID,
                        (tb.class_id) AS CLASS_ID, 
                        case when islunas = '2' then 'Rawat Inap Selesai  | ' 
                        when islunas = '1' then 'Rawat Inap Lock | ' else '' end +
                        case when isnull(STATUS_TARIF,'0') = '1' then 'Farmasi Selesai |' 
                        else '' end  as responsible, --JIKA 2, MASIH DIANGGAP HANYA OPEN DAN CLIOSE,TTP 1 VALID LOCK
                        (tb.ACCOUNT_ID) AS ACCOUNT_ID, 
                        (tb.KARYAWAN) AS KARYAWAN, 
                        (abs(tb.ageyear)) AS AGEYEAR,
                        (abs(tb.agemonth)) AS AGEMONTH,
                        (abs(tb.ageday)) AS AGEDAY,
                        (tb.no_skpinap) AS NO_SKPINAP,
                        (p.KODE_AGAMA) AS KODE_AGAMA,
                        (tb.mapping_sep) AS MAPPING_SEP,
                        tb.TRANS_ID,
                            '' as radiologi,
                                
                                '' as laboratorium   ,
                                tb.CLINIC_TYPE,
                                pk.CONSUL_TYPE
                    
                    
                FROM treatment_akomodasi tb
                    left outer join clinic c on tb.clinic_id = c.clinic_id
                    left outer join   employee_all ea on  ea.employee_id = tb.employee_id
                    left outer join class_room on tb.class_room_id = class_room.class_room_id
                    left outer join PASIEN_KONSULAN pk on tb.VISIT_ID = pk.VISIT_ID
                    , pasien p
                    where tb.visit_id = '$visit_id'
                        and p.NO_REGISTRATION = tb.NO_REGISTRATION
                        and p.ORG_UNIT_CODE = tb.ORG_UNIT_CODE
                        
                order by (tb.treat_date) desc";
        $result = $this->db->query(new RawSql($sql));
        return $result->getFirstRow();
    }
}
