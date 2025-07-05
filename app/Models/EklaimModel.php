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
        'tgl_masuk',
        'tgl_keluar',
        'jnsrawat',
        'klsrawat',
        'adl_sub_acute',
        'adl_chronic',
        'icu_indikator',
        'icu_los',
        'ventilator_hour',
        'birthweight',
        'discharge_status',
        'diagnosanya',
        'procedurenya',
        'tarif_poli_eks',
        'dokter',
        'kodetarif',
        'payor_id',
        'payor_cd',
        'cob_cd',
        'coder_nik',
        'modified_date',
        'modified_by',
        'request_01',
        'respon_01',
        'klaim_status',
        'add_payment_amt',
        'hospital_admission_id',
        'cara_masuk',
        'ventilator',
        'upgrade_class_payor',
        'sistole',
        'diastole',
        'diagnosa_inagrouper',
        'procedure_inagrouper',
        'bayi_lahir_status_cd',
        'dializer_single_use',
        'kantong_darah',
        'claim_value'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'modified_date';
    protected $updatedField  = 'modified_date';


    function insertOrUpdateClaim($dataClaim)
    {
        $sql = "
        MERGE INTO eklaim_klaim AS target
        USING (SELECT 
            ? AS trans_id, ? AS nosep_klaim
        ) AS source
        ON target.trans_id = source.trans_id AND target.nosep_klaim = source.nosep_klaim
        WHEN MATCHED THEN 
            UPDATE SET 
                visit_id = ?, nomr = ?, nosep = ?, nosep_inap = ?, tgl_masuk = ?, tgl_keluar = ?, 
                jnsrawat = ?, klsrawat = ?, adl_sub_acute = ?, adl_chronic = ?, icu_indikator = ?, 
                icu_los = ?, ventilator_hour = ?, birthweight = ?, discharge_status = ?, tarif_poli_eks = ?, 
                dokter = ?, kodetarif = ?, payor_id = ?, payor_cd = ?, cob_cd = ?, coder_nik = ?, 
                modified_by = ?, request_01 = ?, cara_masuk = ?, sistole = ?, diastole = ?, 
                dializer_single_use = ?, kantong_darah = ?, modified_date = getdate()
        WHEN NOT MATCHED THEN 
            INSERT (
                trans_id, visit_id, nomr, nosep, nosep_inap, nosep_klaim, tgl_masuk, tgl_keluar, 
                jnsrawat, klsrawat, adl_sub_acute, adl_chronic, icu_indikator, icu_los, 
                ventilator_hour, birthweight, discharge_status, tarif_poli_eks, dokter, kodetarif, 
                payor_id, payor_cd, cob_cd, coder_nik, modified_by, request_01, cara_masuk, 
                sistole, diastole, dializer_single_use, kantong_darah
            )
            VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            );";

        $values = [
            $dataClaim['trans_id'],
            $dataClaim['nosep_klaim'], // for USING
            $dataClaim['visit_id'],
            $dataClaim['nomr'],
            $dataClaim['nosep'],
            $dataClaim['nosep_inap'],
            $dataClaim['tgl_masuk'],
            $dataClaim['tgl_keluar'],
            $dataClaim['jnsrawat'],
            $dataClaim['klsrawat'],
            $dataClaim['adl_sub_acute'],
            $dataClaim['adl_chronic'],
            $dataClaim['icu_indikator'],
            $dataClaim['icu_los'],
            $dataClaim['ventilator_hour'],
            $dataClaim['birthweight'],
            $dataClaim['discharge_status'],
            $dataClaim['tarif_poli_eks'],
            $dataClaim['dokter'],
            $dataClaim['kodetarif'],
            $dataClaim['payor_id'],
            $dataClaim['payor_cd'],
            $dataClaim['cob_cd'],
            $dataClaim['coder_nik'],
            $dataClaim['modified_by'],
            $dataClaim['request_01'],
            $dataClaim['cara_masuk'],
            $dataClaim['sistole'],
            $dataClaim['diastole'],
            $dataClaim['dializer_single_use'],
            $dataClaim['kantong_darah'],
            // values for INSERT
            $dataClaim['trans_id'],
            $dataClaim['visit_id'],
            $dataClaim['nomr'],
            $dataClaim['nosep'],
            $dataClaim['nosep_inap'],
            $dataClaim['nosep_klaim'],
            $dataClaim['tgl_masuk'],
            $dataClaim['tgl_keluar'],
            $dataClaim['jnsrawat'],
            $dataClaim['klsrawat'],
            $dataClaim['adl_sub_acute'],
            $dataClaim['adl_chronic'],
            $dataClaim['icu_indikator'],
            $dataClaim['icu_los'],
            $dataClaim['ventilator_hour'],
            $dataClaim['birthweight'],
            $dataClaim['discharge_status'],
            $dataClaim['tarif_poli_eks'],
            $dataClaim['dokter'],
            $dataClaim['kodetarif'],
            $dataClaim['payor_id'],
            $dataClaim['payor_cd'],
            $dataClaim['cob_cd'],
            $dataClaim['coder_nik'],
            $dataClaim['modified_by'],
            $dataClaim['request_01'],
            $dataClaim['cara_masuk'],
            $dataClaim['sistole'],
            $dataClaim['diastole'],
            $dataClaim['dializer_single_use'],
            $dataClaim['kantong_darah']
        ];

        $db = db_connect();

        return $this->db->query($sql, $values);
    }
}
