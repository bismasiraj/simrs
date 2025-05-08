<?php

namespace App\Models;

use CodeIgniter\Model;

class EklaimModel extends Model
{
    protected $table      = 'eklaim_klaim';
    protected $primaryKey = 'nosep_klaim';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'trans_id',
        'visit_id',
        'nomr',
        'nosep',
        'nosep_inap',
        'nosep_klaim',
        'nokartu',
        'namapasien',
        'tgllahir',
        'gender',
        'tgl_masuk',
        'tgl_keluar',
        'jnsrawat',
        'klsrawat',
        'adl_sub_acute',
        'adl_chronic',
        'icu_indikator',
        'icu_los',
        'ventilator_hour',
        'upgrade_class_id',
        'upgrade_class_class',
        'upgrade_class_los',
        'add_payment_pct',
        'birthweight',
        'discharge_status',
        'diagnosanya',
        'procedurenya',
        'proc_nonbedah',
        'proc_bedah',
        'konsultasi',
        'tenaga_ahli',
        'keperawatan',
        'penunjang',
        'radiologi',
        'laboratorium',
        'pelayanandarah',
        'rehabilitasi',
        'kamar',
        'rawat_intensif',
        'obat',
        'obatkronis',
        'obatkemoterapi',
        'alkes',
        'bmhp',
        'sewa_alat',
        'tarif_poli_eks',
        'dokter',
        'kodetarif',
        'payor_id',
        'payor_cd',
        'cob_cd',
        'coder_nik',
        'modified_by',
        'request_01',
        'request_02',
        'request_03',
        'request_04',
        'respon_01',
        'respon_02',
        'respon_03',
        'respon_04',
        'cara_masuk',
        'ventilator',
        'upgrade_class_payor',
        'sistole',
        'diastole',
        'diagnosa_inagrouper',
        'procedure_inagrouper',
        'pemulasaran_jenazah',
        'kantong_jenazah',
        'peti_jenazah',
        'plastik_erat',
        'desinfektan_jenazah',
        'covid19_status_cd',
        'nomor_kartu_t',
        'covid19_cc_ind',
        'covid19_rs_darurat_ind',
        'covid19_co_insidense_ind',
        'covid19_penunjang_pengurang',
        'terapi_konvalesen',
        'isoman_ind',
        'bayi_lahir_status_cd',
        'dializer_single_use',
        'kantong_darah',
        'apgar',
        'persalinan',
        'add_payment_amt',
        'claim_value',
        'klaim_status',
        'claim_final',
        'claim_finalby'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';
}
