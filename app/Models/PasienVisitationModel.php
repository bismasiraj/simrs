<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class PasienVisitationModel extends Model
{
    protected $table      = 'pasien_visitation';
    protected $primaryKey = 'visit_id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'clinic_id',
        'employee_id',
        'kddpjp',
        'class_id',
        'class_id_plafond',
        'status_pasien_id',
        'visit_date',
        'booked_date',
        'kdpoli_eks',
        'isnew',
        'cob',
        'description',
        'no_skp',
        'no_skpinap',
        'way_id',
        'reason_id',
        'isattended',
        'asalrujukan',
        'norujukan',
        'kdpoli',
        'tanggal_rujukan',
        'ppkrujukan',
        'diag_awal',
        'conclusion',
        'diagnosa_id',
        'kdpolifrom',
        'tujuankunj',
        'kdpenunjang',
        'flagprocedure',
        'assesmentpel',
        'edit_sep',
        'specimenno',
        'class_room_id',
        'keluar_id',
        'responsible',
        'in_date',
        'exit_date',
        'no_registration',
        'diantar_oleh',
        'visitor_address',
        'org_unit_code',
        'tgl_lahir',
        'gender',
        'payor_id',
        'clinic_id_from',
        'class_id_plafond',
        'pasien_id',
        'karyawan',
        'family_status_id',
        'account_id',
        'coverage_Id',
        'ageday',
        'agemonth',
        'ageyear',
        'kode_agama',
        'aktif',
        'visit_id',
        'trans_id',
        'ticket_no'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function selectpv()
    {
        $builder = $this->select(" count(VISIT_ID) as JML,
        YEAR(VISIT_DATE) as YEAR,
        MONTH(VISIT_DATE) as MONTH,
        DAY(VISIT_DATE) as DAY,
        c.CLINIC_ID,
        case when class_room_id is not null then '0'
              else '1' end as ISRJ,
        STATUS_PASIEN_ID")
            ->join('clinic c', 'pasien_visitation.clinic_id = c.clinic_id', 'left')
            ->where('visit_date > \'2023-01-01\'')
            ->where('visit_date < getdate()')
            ->groupBy([
                'YEAR(VISIT_DATE)',
                'MONTH(VISIT_DATE)',
                'DAY(VISIT_DATE)',
                'c.CLINIC_ID',
                'STATUS_PASIEN_ID',
                'class_room_id'
            ]);
        return $builder->findAll();
    }

    public function getKunjungan()
    {
        $builder = $this->join('clinic c', 'pasien_visitation.clinic_id = c.clinic_id', 'inner')
            ->select("
        count(visit_id) as JML,
        RIGHT(MONTH(pasien_visitation.VISIT_DATE)+100, 2) MONTH,
        c.NAME_OF_CLINIC,
        c.CLINIC_ID")
            ->where('VISIT_DATE > CAST(CONVERT(VARCHAR(10),DATEADD(day, 0, \'2022-01-01\'),112) AS DATETIME)')
            ->where('c.Stype_id = 1')
            ->groupBy([
                'YEAR(VISIT_DATE)',
                'MONTH(VISIT_DATE)',
                'DAY(visit_date)',
                'c.NAME_OF_CLINIC',
                'c.CLINIC_ID'
            ])
            ->orderBy('
            MONTH(pasien_visitation.VISIT_DATE),
            c.NAME_OF_CLINIC');
        return $builder->findAll();
    }

    public function getUmur()
    {
        $umur = $this->db->query("select DISPLAY,
        count(case when class_room_id is null then 1
        else 0 end) as jml ,
        case when class_room_id is not null then '0'
        else '1' end as kunj
        from pasien_visitation PV , AGE_RANGE,PASIEN P
        where VISIT_DATE > CAST(CONVERT(VARCHAR(10),DATEADD(month, -1, '2022-01-01'),112) AS DATETIME)
      AND PV.NO_REGISTRATION = P.NO_REGISTRATION
      AND ISNULL(DATEDIFF(DAY,DATE_OF_BIRTH ,VISIT_DATE),0) >= LOWER_BOUND
      and ISNULL(DATEDIFF(DAY,DATE_OF_BIRTH ,VISIT_DATE),0) <= UPPER_BOUND

        group by DISPLAY,case when class_room_id is null then 1
        else 0 end,
        case when class_room_id is not  null then '0'
        else '1' end
        order by DISPLAY,kunj desc");
        return $umur->getResultArray();
    }

    public function topXRanap($start, $end)
    {
        $sql = "SP_EIS_TOPX_ranap;1 @MULAI = '$start', @AKHIR = '$end',
        @STATUS = '%', @RJ = '%', @POLI = '%',@X = '10'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function topXRajal($start, $end)
    {
        $sql = "dbo.SP_EIS_TOPX_ralan;1 @MULAI = '$start', @AKHIR = '$end',
        @STATUS = '%', @RJ = '%', @POLI = '%',@X = '10'";
        // return $sql;
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }

    public function getKunjunganPoli($nama = null, $kode = null, $alamat = null, $poli = null, $mulai = null, $akhir = null, $sudah = null, $dokter = null, $nokartu = null)
    {

        if (is_null($nama)) {
            $builder = $this->join('clinic c', 'pasien_visitation.clinic_id = c.clinic_id', 'inner')
                ->where('VISIT_DATE > CAST(CONVERT(VARCHAR(10),DATEADD(month, -1, GETDATE()),112) AS DATETIME)')
                ->where('c.stype_id', '1')
                ->groupBy('YEAR(VISIT_DATE),
                    MONTH(VISIT_DATE),
                    DAY(visit_date),
                    c.NAME_OF_CLINIC,
                    c.CLINIC_ID')
                ->orderBy('YEAR(VISIT_DATE),
                    MONTH(VISIT_DATE),
                    DAY(visit_date),
                    c.NAME_OF_CLINIC')
                ->select('count(visit_id) as JML,
                    YEAR(VISIT_DATE) as YEAR,
                    RIGHT(MONTH(VISIT_DATE)+100, 2) MONTH,
                    RIGHT(DAY(VISIT_DATE)+100, 2) DAY,
                    c.NAME_OF_CLINIC,
                    c.CLINIC_ID');

            return $builder->findAll();
        } else {


            /* UNTUK WATES MENGGUNAKAN ISVALID DARI TREAT RESULT:
            isnull ((select count (RESULT_ID) from treat_results r where r.isvalid = '1' and r.visit_id = pv.visit_id),0)   as radiologi , */


            $db = db_connect('default');
            $builder = $db->table('pv');
            $builder = $builder->select("CASE PV.NO_REGISTRATION WHEN '000000'THEN PV.DIANTAR_OLEH ELSE PV.NAME_OF_PASIEN END AS NAME_OF_PASIEN,   
            PV.NO_REGISTRATION,    
            PV.ORG_UNIT_CODE,
            pV.DATE_OF_BIRTH AS date_of_birth, 
            PV.CONTACT_ADDRESS  ,
            PV.PHONE_NUMBER AS PHONE_NUMBER,   
            PV.MOBILE AS MOBILE,   
            pv.KAL_ID ,
            PV.PLACE_OF_BIRTH AS PLACE_OF_BIRTH,
            null as KALURAHAN,
            pv.clinic_id,
            PV.name_of_clinic,
            pv.clinic_id_from,     
            PV.fullname,
            pv.employee_id,
            pv.employee_id_from,
            pv.booked_Date,
            pv.visit_date,
            pv.visit_id,
            pv.isattended,
            pv.diantar_oleh,
            pv.visitor_address, --untuk pasien umum
            pv.address_of_rujukan,
            pv.rujukan_id,
            pv.payor_id,
            pv.reason_id, 
            pv.STATUS_PASIEN_ID,
            pv.class_room_id, 
           -- bed_id,
           -- keluar_id,
           -- in_date,
          --  exit_date,
          -- pv.employee_inap
            0 urutan,
            NULL as NPK,
            pV.pasien_id, 
            pv.ticket_no, 
            PV.gender, 
            pv.class_id, 
            pv.responsible_id, 
            pv.responsible,
            PV.ACCOUNT_ID, 
            PV.KARYAWAN, 
            PV.DESCRIPTION, 
            pv.class_id_plafond, 
            pv.COVERAGE_ID,
            NULL AS mother,
            NULL AS father, 
            NULL AS spouse,
            pv.patient_category_id, 
            pv.way_id,
            pv.follow_up,
            pv.isnew,
            pv.family_status_id,
            PV.KK_NO ,
            pv.ageyear,
            pv.agemonth,
            pv.ageday,
            pv.diagnosa,
            pv.NO_SKP,
            pv.NO_SKPINAP,
            pv.TANGGAL_RUJUKAN,
            pV.KODE_AGAMA,
            pv.PPKRUJUKAN,
            pv.NORUJUKAN,
            pv.DIAG_AWAL,
            PV.LOKASILAKA,
            PV.MAPPING_SEP, -- NEW 20 JULY 2017
            PV.TRANS_ID, -- NEEW 20 feb 2018
            PV.CALL_DATE, --NEW 10042018
            PV.CALL_DATES,
            PV.CALL_TIMES,
            PV.SERVED_DATE,
            PV.SERVED_INAP,
            isnull ((null),0)   as radiologi ,
            pv.diagnosa as  laboratorium,
            PV.LOCKED,
            pv.RM_OUT_DATE,
            pv.RESEND_RM_DATE,
            pv.RM_IN_DATE,
              pv.diagnosa")
                ->where("(
                ((isnull(PV.DIANTAR_OLEH,'') like '%$nama%' ) or pv.name_of_pasien like '%$nama%') or
                (PV.NO_REGISTRATION like '%$kode%' or isnull(PV.DIANTAR_OLEH,'') like '%$kode%' ) or  
                ( isnull(PV.KK_NO,'') like '%$nokartu%' ) 
                or  ( isnull(pv.NO_SKP,'') like '%$nokartu%' )
            )
               and ISNULL(pV.contact_address,'') like '%$alamat%'  and
               (PV.name_of_clinic like '%$poli%' or pv.clinic_id like '%$poli%') and
               ( isnull(PV.fullname,'') like '%$dokter%' or isnull(pv.employee_id,'') like '%$dokter%' )
                and CAST(CONVERT(VARCHAR(10), VISIT_DATE,102) AS DATETIME) >= CAST(CONVERT(VARCHAR(10), '2019-10-01',102) AS DATETIME) AND
                left(pv.ORG_UNIT_CODE,1) <> 'x'
                and isnull(pv.LOCKED,'') like '%$sudah%' and
                PV.visit_date between dateadd(hour,-3,'$mulai') and dateadd(hour,24,'$akhir')")
                ->orderBy('pv.clinic_id,pv.ticket_no');
            $builder = $builder->get();
            return $builder->getResultArray();
        }
    }

    public function getKunjunganPasien($id)
    {
        $builder = $this->join('clinic c', 'pasien_visitation.clinic_id = c.clinic_id', 'inner')
            ->join('employee_all ea', 'pasien_visitation.employee_id = ea.employee_id')
            ->join('employee_all e', 'pasien_visitation.kddpjp = e.dpjp')
            ->join('status_pasien sp', 'pasien_visitation.status_pasien_id = sp.status_pasien_id')
            ->join('class cl', 'pasien_visitation.class_id = cl.class_id')
            ->join('class_room cr', 'pasien_visitation.class_room_id = cr.class_room_id', 'left')
            ->join('cara_keluar ck', 'pasien_visitation.keluar_id = ck.keluar_id', 'left')
            ->where('no_registration', $id)
            ->orderBy("visit_date desc")
            ->select('visit_id, trans_id, convert(varchar, visit_date, 105) as visit_date, ea.fullname, c.name_of_clinic, sp.name_of_status_pasien, no_skp, cl.name_of_class, exit_date, e.fullname as fullnameranap, cr.name_of_class as name_of_class_room, ck.cara_keluar, no_skpinap, in_date');
        return $builder->findAll();
    }
    public function generateId($selectPoli, $no_registration)
    {
        $builder = $this->select(" top (1) convert(varchar, getdate(), 112)+'$selectPoli'+'$no_registration' as visit_id,
        '$no_registration' + convert(varchar, getdate(), 112) +right(newid(),4) as trans_id,
        ISNULL((SELECT MAX(TICKET_NO) FROM PASIEN_VISITATION WHERE CLINIC_ID = '$selectPoli' AND  convert(varchar, visit_date, 23) = convert(varchar, getdate(), 23)  ),0)+1 as ticket_no");
        return $builder->findAll();
    }

    public function getregisterpoli($mulai, $akhir, $status, $rj, $poli, $kal)
    {
        $sql = ".SP_EIS_Register_poli;1 @MULAI = '$mulai', @AKHIR = '$akhir', @STATUS = '$status', @RJ = '$rj', @POLI = '$poli', @kal = '$kal'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmkunjungan($mulai, $akhir, $kal, $rw, $poli, $status, $baru, $lb, $ub, $nomor, $tindak)
    {
        $sql = "SP_EIS_KUNJUNGAN;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KAL = '$kal', @RW = '$rw', @POLI = '$poli', @STATUS = '$status', @BARU = '$baru', @LB = '$lb', @UB = '$ub', @NOMOR = '$nomor', @TINDAK = '$tindak'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmkunjunganpoli($mulai, $akhir, $kal, $rw, $poli, $status, $baru, $lb, $ub, $nomor, $tindak)
    {
        $sql = "SP_EIS_KUNJUNGANPOLI;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KAL = '$kal', @RW = '$rw', @POLI = '$poli', @STATUS = '$status', @BARU = '$baru', @LB = '$lb', @UB = '$ub', @NOMOR = '$nomor', @TINDAK = '$tindak'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmkunjunganstatus($mulai, $akhir, $kal, $rw, $poli, $status, $baru, $lb, $ub, $nomor, $tindak)
    {
        $sql = "SP_EIS_KUNJUNGANSTATUS;1 @MULAI = '$mulai', @AKHIR = '$akhir', @KAL = '$kal', @RW = '$rw', @POLI = '$poli', @STATUS = '$status', @BARU = '$baru', @LB = '$lb', @UB = '$ub', @NOMOR = '$nomor', @TINDAK = '$tindak'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmugd($mulai, $akhir, $poli, $status)
    {
        $sql = "SP_EIS_PELAYANAN_UGD;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @STATUS = '$status'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmtopxrajal($mulai, $akhir, $poli, $status, $rj, $x)
    {
        $sql = "SP_EIS_TOPX_RALAN;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @STATUS = '$status', @RJ = '$rj', @X = $x";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmtopxugd($mulai, $akhir, $poli, $status, $rj, $x)
    {
        $sql = "SP_EIS_TOPX_UGD;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @STATUS = '$status', @RJ = '$rj', @X = $x";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function getrmindexrajal($mulai, $akhir, $poli, $status, $rj)
    {
        $sql = "SP_EIS_SENSUS_PENYAKIT_RAJAL;1 @MULAI = '$mulai', @AKHIR = '$akhir', @POLI = '$poli', @STATUS = '$status', @RJ = '$rj'";
        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
    public function selectSep($visit)
    {
        $sql = " select p.pasien_id as noKartu , 
                cast(convert(varchar(10),visit_date,120)as datetime) as tglSep, 
                p.org_unit_code as ppkPelayanan,  
                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then '1' else '2' end  jnsPelayanan ,  

                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then 
                    cs.other_id
                else
                    '3' 
                end    as klsRawat, 
                cs.kdkelasv as klsRawatNaik,
                
                            
                p.no_registration as noMr,  
                case   when ( ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' ) and p.no_skp is not null then --saat RI, kalo ada SEP RJ, maka faskesnya  = unit iut sendiri
                    2
                else 
                    asalrujukan 
                end   as asalRujukan,
                
                cast(convert(varchar(10),tanggal_rujukan,120)as datetime) as tglRujukan,  
                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then
                    isnull(p.no_skp,noRujukan)
                else 
                    noRujukan 
                end   as noRujukan,
                

                case   when ( ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' ) and p.no_skp is not null then --saat RI, kalo ada SEP RJ, maka dia jadi no rujukan, otherwise no rujukannya
                        p.org_unit_code
                else 
                        ppkRujukan
                end  as   ppkRujukan,
                


                case  when ( p.description is null )or (p.description = '') then '-' else p.description end  as catatan,  
                diag_Awal as diagAwal,  
                case when rujukan_id = 500  then
                    p.kdpoli
                when class_room_id is not null then ''
                else
                    ps.kdpoli  
                end as tujuan,

                isnull(kdpoli_eks,'0') as eksekutif,
                isnull(cob,'0') as cob,
                isnull(p.BACKCHARGE,'0') as katarak, 
                case reason_id when 3 then '1' else '0' end as lakaLantas,
                temptrans as noLP,
                case penjamin when 0 then '' else isnull(penjamin,'') end as penjamin,  
                cast(convert(varchar(10),valid_rm_date,120)as datetime) as tglKejadian,
                isnull(delete_sep,'-') as keterangan,
                
                case when reason_id = 3 and (no_skp is not null or no_skpinap is null ) then
                    isnull(ispertarif,'0')
                else
                    '0'
                end as suplesi,  


                case when no_skp is null and no_skpinap is null then
                    ''
                when no_skpinap is not null and isperTarif='1' and reason_id = 3  then
                    no_skpinap
                when no_skpinap is  null and no_skp is not null and isperTarif='1'  and reason_id = 3 then --hanya jika kecelakaan
                    no_skp
                else
                    ''
                end as noSepSuplesi, 
                    
                isnull( (select kdprov from inasis_get_kecamatan where kode = p.lokasiLaka),'')  as kdPropinsi,  
                isnull( (select kdkab from inasis_get_kecamatan where kode = p.lokasiLaka),'')   as kdKabupaten, 
                isnull(p.lokasiLaka,'') as kdKecamatan, 
                case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then
                    case when  p.specimenno is null or ltrim(p.specimenno) = '' then edit_sep else ltrim(p.specimenno)  end
                else 
                    edit_sep
                end as noSurat,
                CASE  when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then 
                        (select dpjp from employee_all where employee_id = p.employee_inap)
                        
                else
                    
                    isnull(kdDPJP, (select dpjp from employee_all where employee_id =  p.employee_id)	)	
                end   as kdDPJP,

                isnull(pa.mobile,pa.phone_number) as noTelp,  
                p.modified_by as user1,
                tujuankunj as tujuanKunj,
                replace(isnull(flagprocedure,''),'99','') flagProcedure,
                replace(isnull(kdpenunjang,''),'99','') kdPenunjang,
                replace(isnull(assesmentpel,''),'99','') assesmentPel,
                KDDPJP as kodeDPJP,
                case when (case   when ((len(class_room_id)> 0) and (in_date is not null )) or isrj='0' then '1' else '2' end ) <> '1' then kddpjp else '' end as dpjpLayan,
                no_skp,
                no_skpinap
                from  pasien_visitation p, pasien pa, clinic ps, class cs
                where p.no_registration = pa.no_registration  and p.org_unit_code = pa.org_unit_code   
                and ps.clinic_id  = p.clinic_id  and cs.class_id= p.class_id
                and visit_id ='$visit'";

        $result = $this->db->query(new RawSql($sql));
        return $result->getResultArray();
    }
}
