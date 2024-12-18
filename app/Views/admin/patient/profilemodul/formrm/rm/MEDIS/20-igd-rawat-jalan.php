<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">


    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <link href="<?= base_url() ?>css/jquery.signature.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>js/jquery.signature.js"></script>
    <script src="<?= base_url(); ?>assets/libs/qrcode/qrcode.js"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>

    <style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #FFF;
        opacity: 1;
    }

    .form-control,
    .input-group-text {
        background-color: #fff;
        border: 1px solid #fff;
        font-size: 12px;
    }

    @page {
        size: A4;
    }

    body {
        width: 21cm;
        height: 29.7cm;
        margin: 0;
        font-size: 12px;
    }

    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: .3rem;
        font-weight: 500;
        line-height: 1.2;
    }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">

        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header.php"); ?>
        <!-- end of template header -->

        <div class="row">
            <h5 class="text-start">Subjektif (S)</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Keluhan Utama (Autoanamnesis)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['anamnesis']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Penyakit Sekarang</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_penyakit_sekarang']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Penyakit Dahulu</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_penyakit_dahulu']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Riwayat Penyakit Keluarga</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_penyakit_keluarga']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Alergi (Non Obat)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_alergi_nonobat']; ?></p>
                        <b>Riwayat Alergi (Obat)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_alergi_obat']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Obat Yang Dikonsumsi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_obat_dikonsumsi']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Riwayat Kehamilan dan Persalinan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_kehamilan']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Diet</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_diet']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Imunisasi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_imunisasi']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="p-1">
                        <b>Riwayat Kebiasaan (Negatif)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_alkohol']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Obyektif (O)</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4" class="p-1"><b>Vital Sign</b></td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Tekanan Darah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tensi_bawah']; ?> mmHg</p>
                    </td>
                    <td class="p-1">
                        <b>Denyut Nadi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['nadi']; ?> x/m</p>
                    </td>
                    <td class="p-1">
                        <b>Suhu Tubuh</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['suhu']; ?> ?</p>
                    </td>
                    <td class="p-1">
                        <b>Respiration Rate</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['respiration']; ?> x/m</p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Berat Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['berat']; ?> kg</p>
                    </td>
                    <td class="p-1">
                        <b>Tinggi Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tinggi']; ?> cm</p>
                    </td>
                    <td class="p-1">
                        <b>SpO2</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['spo2']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>BMI</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['imt']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php  if (!empty($val['gcs_desc']) && is_array($val['gcs_desc'])) { ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b><i>pGCS / Tingkat Kesadaran Anak</i></b>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>pGCS E / Respon Membuka Mata :</b> <span
                                    class="m-0 mt-1 p-0"><?= '['.@$val['gcs_e'].'] '. @$val['gsc_e_desc']; ?>.</span>
                                <b>pGCS V / Respon Verbal Terbaik :</b> <span
                                    class="m-0 mt-1 p-0"><?= '['.@$val['gcs_v'].'] '. @$val['gsc_v_desc']; ?>.</span>
                                <b>pGCS M / Respon Motorik Terbaik :</b> <span
                                    class="m-0 mt-1 p-0"><?= '['.@$val['gcs_m'].'] '. @$val['gsc_m_desc']; ?>.</span>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>Score pGCS : </b>
                                <span class="m-0 mt-1 p-0"><?= @$val['gcs_desc']; ?></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Keadaan Umum</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['namadiagnosa']) ? @$val['namadiagnosa']:'-'; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php } ?>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" style="width: 50%;">
                        <b>Skala Nyeri</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pain_score'] == '0' ? 'Tidak ada nyeri' : ''; ?></p>
                    </td>
                    <td class="p-1" style="width: 50%;">
                        <b>Resiko Jatuh</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['fall_score'] == '0' ? 'Tidak ada resiko jatuh' : ''; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php if ($visit['specialist_type_id'] === "1.12"): ?>
        <table class="table table-bordered" id="statusDermatologiShow">
            <tbody>
                <tr>
                    <td colspan="4" class="fw-bold">Status Dermatologik</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <b class="col-12">I. Inspeksi</b>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="fw-bold">Lokasi</td>
                                    <td class="fw-bold">UKK</td>
                                    <td class="fw-bold">Distribusi</td>
                                    <td class="fw-bold">Konfigurasi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= @$val['kulit']['sd_ins_location'] ?></td>
                                    <td><?= @$val['kulit']['sd_ins_ukk'] ?></td>
                                    <td><?= @$val['kulit']['sd_ins_distribution'] ?></td>
                                    <td><?= @$val['kulit']['sd_ins_configuration'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <b class="col-12">Palpasi</b>
                            <span class="col-12"><?= @$val['kulit']['sd_palpation'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">Lain-Lain</b>
                            <span class="col-12"><?= @$val['kulit']['sd_others'] ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <b class="col-12">Status Venerologik</b>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <b class="col-12">Inspeksi</b>
                            <span class="col-12"><?= @$val['kulit']['sv_inspection'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <b class="col-12">Palpasi</b>
                            <span class="col-12"><?= @$val['kulit']['sv_palpation'] ?></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php endif; ?>
        <?php 
        if ($visit['specialist_type_id'] === "1.16"):?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Var/NRS</th>
                    <th>Pupil Kiri</th>
                    <th>Pupil kanan</th>
                </tr>
                <tr>
                    <td><?= @$val['saraf']['vas_nrs']?></td>
                    <td>
                        <b>Diameter :</b><?= @$val['saraf']['left_diameter']?>
                        <br><b>Refleks Cahaya :</b><?= @$val['saraf']['left_light_reflex']?>
                        <br><b>Kornea:</b><?= @$val['saraf']['left_cornea']?>
                        <br><b>Isokor Anisokor :</b><?= @$val['saraf']['left_isokor_anisokor']?>
                    </td>
                    <td>
                        <b>Diameter :</b><?= @$val['saraf']['right_diameter']?>
                        <br><b>Refleks Cahaya :</b><?= @$val['saraf']['right_light_reflex']?>
                        <br><b>Kornea:</b><?= @$val['saraf']['right_cornea']?>
                        <br><b>Isokor Anisokor :</b><?= @$val['saraf']['right_isokor_anisokor']?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Leher</th>
                    <th>Gerak</th>
                    <th>Kekuatan</th>
                </tr>
                <tr>
                    <td>
                        <b>Kaku kuduk :</b><?= @$val['saraf']['stiff_neck']?>
                        <br><b>Meningeal Sign :</b><?= @$val['saraf']['meningeal_sign']?>
                        <br><b>Brudzinki I-IV :</b><?= @$val['saraf']['brudzinki_i_iv']?>
                        <br><b>Kernig Sign:</b><?= @$val['saraf']['kernig_sign']?>
                        <br><b>Dolls eye phenomena :</b><?= @$val['saraf']['dolls_eye_phenomenon']?>
                        <br><b>Vertebra :</b><?= @$val['saraf']['vertebra']?>
                        <br><b>Extremity :</b><?= @$val['saraf']['extremity']?>
                    </td>
                    <td>
                        <b>Gerak Atas Kiri :</b><?= @$val['saraf']['motion_upper_left']?>
                        <br><b>Gerak Atas Kanan :</b><?= @$val['saraf']['motion_upper_right']?>
                        <br><b>Gerak Bawah Kiri :</b><?= @$val['saraf']['motion_lower_left']?>
                        <br><b>Gerak Bawah Kanan :</b><?= @$val['saraf']['motion_lower_right']?>
                    </td>
                    <td>
                        <b>Kekuatan Atas Kiri :</b><?= @$val['saraf']['strength_upper_left']?>
                        <br><b>Kekuatan Atas Kanan :</b><?= @$val['saraf']['strength_upper_right']?>
                        <br><b>Kekuatan Bawah Kiri:</b><?= @$val['saraf']['strength_lower_left']?>
                        <br><b>Kekuatan Bawah Kanan :</b><?= @$val['saraf']['strength_lower_right']?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php endif;?>

        <table class="table table-bordered">
            <tbody>
                <?php
                    // check jika data lokalis ada atau tidak
                    if(!empty($lokalis2)){
                        // jika ada maka lakukan perulangan untuk menampilkan data
                        foreach ($lokalis2 as $key => $value) {
                            // jika data lokalis memiliki value score = 2 maka tampilkan
                            if ($value['value_score'] == 2) {
                                // jika key pada data adalah ganjil
                                if(($key+1) %2 != 0){
                                    // jika data bukan data terakhir 
                                    if($key+1 != count($lokalis2)){
                                        echo '<tr>';
                                        echo '<td class="p-1" style="width: 50%;">'
                                        .'<b>'.$value['nama_lokalis']. '</b>'. '<p class="m-0 mt-0 p-0">'.$value['value_detail'].'</p>'.
                                        '</td>';
                                    }else{
                                        echo '<tr>';
                                        echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                        .'<b>'.$value['nama_lokalis']. '</b>'. '<p class="m-0 mt-0 p-0">'.$value['value_detail'].'</p>'.
                                        '</td>';
                                        echo '</tr>';
                                    }
                                }else{
                                    echo '<td class="p-1" style="width: 50%;">'
                                    .'<b>'.$value['nama_lokalis']. '</b>'.'<p class="m-0 mt-0 p-0">'.$value['value_detail'].'</p>'.
                                    '</td>';
                                    echo "<tr>";
                                }
                            }
                             
                        }
                    }
                    ?>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <?php
                if(!empty($lokalis)){
                    foreach ($lokalis as $key => $value) {
                        if ($value['value_score'] == 3) {
                            $filepath = WRITEPATH . 'uploads/signatures/' . $value['value_detail'];
                            
                            if (file_exists($filepath)) {
                                $filedata = file_get_contents($filepath);
                                $filedata64 = base64_encode($filedata);
                                $selectlokalis[$key]['filedata64'] = $filedata64;
                                
                                echo '<tr>';
                                echo '<th>'.$value['nama_lokalis'].'</th>';
                                echo '<td style="width: 50%;">';
                                echo '<img class="mt-3" src="data:image/jpeg;base64,' . $filedata64 . '" width="400px">';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>

        <?php 
        if ($visit['specialist_type_id'] === "1.10"):?>
        <?php
            if (!empty($val['mata']) && is_array($val['mata'])) {
            $result = [];
            foreach ($val['mata'] as $item) {
                $nama_lokalis = str_replace(["DEXTRA", "SINISTRA"], "", $item['nama_lokalis']); 
                $nama_lokalis = trim($nama_lokalis); 
                $value_info = $item['value_info'];
                $value_detail = $item['value_detail'];

                if (isset($result[$nama_lokalis])) {
                    $result[$nama_lokalis][$value_info] = $value_detail;
                } else {
                    $result[$nama_lokalis] = [
                        "SINISTRA" => $value_info === "SINISTRA" ? $value_detail : null,
                        "nama_lokalis" => $nama_lokalis,
                        "DEXTRA" => $value_info === "DEXTRA" ? $value_detail : null
                    ];
                }
            }

            $resultChunks = array_chunk($result, ceil(count($result) / 2), true);
            echo "<div style='display: flex; gap: auto;'>";

            foreach ($resultChunks as $chunk) {
                echo "<div style='flex: 1;'>";
                echo "<table border='1' class='table table-bordered'>";
                echo "<tr><td class='fw-bold'>Oculus Dextra</td><td class='fw-bold text-center'>Keterangan</td><td class='fw-bold'>Oculus Sinistra</td></tr>";
                foreach ($chunk as $row) {
                    echo "<tr>";
                    echo "<td>" . ($row['DEXTRA'] ?? '') . "</td>";
                    echo "<td class='text-center'>{$row['nama_lokalis']}</td>";
                    echo "<td>" . ($row['SINISTRA'] ?? '') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            
            echo "</div>";
        }
        ?>

        <?php endif;?>
        <?php  if (!empty($val['pemeriksaan']) && is_array($val['pemeriksaan'])) { ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Catatan Obyektif</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['pemeriksaan']) ? @$val['pemeriksaan']:'-'; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php } ?>
        <?php  if (!empty($val['ats_tipe']) && is_array($val['ats_tipe'])) { ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Triage</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['ats_tipe']) ? @$val['ats_tipe'] : '-'; ?></p>
                    </td>
                </tr>
                <?php if(!empty($val['ats_tipe'])): ?>
                <tr>
                    <td class="p-1">
                        <b><?= @$val['ats_tipe']; ?></b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['ats_item']) ? @$val['ats_item']:'-'; ?></p>
                    </td>
                </tr>
                <?php endif;?>
                <?php if (!empty($val['hamil']) && ($val['hamil'] === "Hamil")): ?>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Hamil</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['hamil']) ? @$val['hamil']:'-'; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Umur Kehamilan</b>
                        <p class="m-0 mt-1 p-0"></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>G</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['hamil_g']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>P</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['hamil_p']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>A</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['hamil_a']; ?></p>
                    </td>
                </tr>
                <?php endif;?>
            </tbody>
        </table>
        <?php } ?>


        <div class="row">
            <h4 class="text-start">Assessment (A)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Diagnosis (ICD-10)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['icd10']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Permasalahan Medis</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['masalah_medis']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Penyebab Cidera / Keracunan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['penyebab_cidera']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Planning (P)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Target / Sasaran Terapi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['sasaran']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Laboratorium</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['laboratorium']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Radiologi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['radiologi']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Farmakoterapi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['farmakologia']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Procedure</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['prosedur']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Catatan Procedure</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Standing Order</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['standing_order']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Rencana Tindak Lanjut</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Rencana Tindak Lanjut</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['rencana_tl']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Kontrol</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['kontrol']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Edukasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapi kepada:</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['edukasi_pasien']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Semarang, <?= tanggal_indo(date('Y-m-d')); ?></div>
                <br>
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
                <p class="p-0 m-0 py-1">(<?= @$val['dokter']; ?>)</p>
                <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <br><br>
                <div>Penerima Penjelasan</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
                <p class="p-0 m-0 py-1">(<?= @$val['nama']; ?>)</p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: '<?= @$val['dpjp']; ?>',
    width: 150,
    height: 150,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H // High error correction
});
</script>
<script>
var qrcode = new QRCode(document.getElementById("qrcode1"), {
    text: '<?= @$val['nama']; ?>',
    width: 150,
    height: 150,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H // High error correction
});
</script>

<style>
@media print {
    @page {
        margin: none;
        scale: 85;
    }

    .container {
        width: 210mm;
        /* Sesuaikan dengan lebar kertas A4 */
    }
}
</style>
<script type="text/javascript">
// window.print();
</script>

</html>