<?php
// echo "<pre>";
// var_dump($neurosensoris);
// die();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="<?= base_url('assets/libs/qrcode/qrcode.min.js') ?>"></script>

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

        .border-collide {
            margin-right: -.5px;
            /* Adjust margin to make borders overlap */
            margin-bottom: -.5px;
            /* Adjust margin to make borders overlap */
        }

        .border-custom {
            border-bottom: .5px solid #dee2e6;
            border-right: .5px solid #dee2e6;
            border-left: .5px solid #dee2e6;
            border-top: none;
            box-sizing: border-box;
        }

        .border-custom:first-child {
            border-right: .5px solid #dee2e6;
            border-left: .5px solid #dee2e6;
            border-bottom: none;
            border-top: .5px solid #dee2e6;
            box-sizing: border-box;
        }

        .border-custom:last-child {
            border-right: .5px solid #dee2e6;
            border-left: .5px solid #dee2e6;
            border-top: none;
            border-bottom: .5px solid #dee2e6;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">

        <!-- template header -->
        <?= view("admin/patient/profilemodul/formrm/rm/template_header.php"); ?>
        <!-- end of template header -->

        <div class="row">
            <h5 class="text-start">Anamnesa</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Autoanamnase</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['anamnesis']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Alloanamnase</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['alo_anamnesis']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Penyakit Sekarang</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_penyakit_sekarang']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Riwayat Penyakit Dahulu</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_penyakit_dahulu']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Alergi (Non Obat)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_alergi_nonobat']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Riwayat Penyakit Keluarga</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_penyakit_keluarga']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Riwayat Alergi (Obat)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['riwayat_alergi_obat']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Riwayat & Gaya Hidup</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" width="50%">
                        <b>Alkohol</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['riwayat_alkohol']) ? @$val['riwayat_alkohol'] : '<i>-- data tidak tersedia --</i>'; ?></p>
                    </td>
                    <td class="p-1" width="50%">
                        <b>Merokok</b>
                        <p class="m-0 mt-1 p-0"><?= !empty(@$val['riwayat_merokok']) ? @$val['riwayat_merokok'] : '<i>-- data tidak tersedia --</i>'; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php if (count($apgarData) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Apgar Score</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" width="25%"></td>
                        <?php foreach ($apgarWaktu as $key => $waktu) : ?>
                            <th class="p-1" width="25%"><?= $waktu['p_description'] ?></th>
                        <?php endforeach ?>
                    </tr>
                    <?php $totalSkor = 0; ?>
                    <?php foreach ($apgarData as $key => $row) : ?>
                        <tr>
                            <th class="p-1" width="25%"><?= $row['parameter_desc'] ?></th>
                            <td class="p-1" width="25%"><?= '(' . $row['value_score_1'] . ') ' . $row['menit_1'] ?></td>
                            <td class="p-1" width="25%"><?= '(' . $row['value_score_5'] . ') ' . $row['menit_5'] ?></td>
                            <td class="p-1" width="25%"><?= '(' . $row['value_score_10'] . ') ' . $row['menit_10'] ?></td>
                        </tr>
                        <?php $totalSkor += $row['value_score_1'] + $row['value_score_5'] + $row['value_score_10']; ?>
                    <?php endforeach ?>
                    <tr>
                        <th class="p-1" width="25%">Total Skor</th>
                        <th class="p-1 text-center" width="75%" colspan="3"><?= $totalSkor ?></th>
                    </tr>
                </tbody>
            </table>
        <?php
        } ?>
        <table class="table table-bordered mt-4">
            <tbody>
                <tr class="d-flex">
                    <td class="p-1 col-3">
                        <b>Tekanan Darah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tensi_bawah']; ?> mmHg</p>
                    </td>
                    <td class="p-1 col-3">
                        <b>Denyut Nadi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['nadi']; ?> x/m</p>
                    </td>
                    <td class="p-1 col-3">
                        <b>Suhu Tubuh</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['suhu']; ?> ℃</p>
                    </td>
                    <td class="p-1 col-3">
                        <b>Respiration Rate</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['respiration']; ?> x/m</p>
                    </td>
                </tr>
                <tr class="d-flex">
                    <td class="p-1 col-3">
                        <b>Berat Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['berat']; ?> kg</p>
                    </td>
                    <td class="p-1 col-3">
                        <b>Tinggi Badan</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['tinggi']; ?> cm</p>
                    </td>
                    <td class="p-1 col-3">
                        <b>SpO2</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['spo2']; ?></p>
                    </td>
                    <td class="p-1 col-3">
                        <b>BMI</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['imt']; ?></p>
                    </td>
                </tr>
                <?php if (count($neonatus)) {
                ?><tr class="d-flex">
                        <td class="p-1 col-3">
                            <b>Kesan Umum</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['keadaan_umum']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Pergerakan</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['pergerakan']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Warna Kulit</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['warna_kulit']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Turgor</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['turgur']; ?></p>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="p-1 col-3">
                            <b>Tonus</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['tonus']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Suara</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['suara']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Reflek Moro</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['reflek_moro']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Reflek Mengisap</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['reflek_menghisap']; ?></p>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="p-1 col-3">
                            <b>Memegang</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['memegang']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Tonus Leher</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['tonus_leher']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Lingkar Kepala</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['lingkar_kepala']; ?></p>
                        </td>
                        <td class="p-1 col-3">
                            <b>Lingkar Dada</b>
                            <p class="m-0 mt-1 p-0"><?= @$neonatus['lingkar_dada']; ?></p>
                        </td>
                    </tr><?php
                        } ?>
            </tbody>
        </table>
        <?php if (count($nutrition) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Skrining Gizi</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Kategori Usia</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['age_cat'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>BB</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['weight'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>TB</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['height'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>IMT</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['imt'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Step 1|Skor IMT</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['step1_score_imt'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Step 2|Skor Penurunan BB</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['step2_score_wightloss'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Step 3|Skor Efek Penyakit Akut</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['step3_score_acute_disease'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Step 4|Resiko Malnutrisi Keseluruhan</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['step4_score_malnutrition'] ?></p>
                </div>
                <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Step 5|Management Guidelines</b>
                    <p class="m-0 mt-1 p-0"> <?php echo @$nutrition['step5'] ?></p>
                </div>
            </div>
        <?php
        } ?>

        <?php if (!empty($val['gcs_desc'])) { ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1">
                            <b><i>GCS / Tingkat Kesadaran</i></b>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>GCS E / Respon Membuka Mata :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$val['gcs_e'] . '] ' . @$val['gsc_e_desc']; ?>.</span>
                                    <b>GCS V / Respon Verbal Terbaik :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$val['gcs_v'] . '] ' . @$val['gsc_v_desc']; ?>.</span>
                                    <b>GCS M / Respon Motorik Terbaik :</b> <span
                                        class="m-0 mt-1 p-0"><?= '[' . @$val['gcs_m'] . '] ' . @$val['gsc_m_desc']; ?>.</span>
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col-auto">
                                    <b>Score GCS : </b>
                                    <span class="m-0 mt-1 p-0"><?= @$val['gcs_desc']; ?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">
                            <b>Keadaan Umum</b>
                            <p class="m-0 mt-1 p-0"><?= !empty(@$val['namadiagnosa']) ? @$val['namadiagnosa'] : '-'; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="p1">Skala Nyeri</th>
                    <th class="p1">Resiko Jatuh</th>
                </tr>
                <tr>
                    <td class="p-1" style="width: 50%;">
                        <p class="m-0 mt-1 p-0"><?= @$val['pain_score']; ?></p>
                    </td>
                    <td class="p-1" style="width: 50%;">
                        <p class="m-0 mt-1 p-0"><?= @$val['fall_score']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="p1" colspan="2">Triase</th>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <p class="m-0 mt-1 p-0"><?= @$val['ats_tipe']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php if (count($hipertensi) > 0) {
        ?>
            <div class="d-flex flex-wrap mb-3">
                <div class="p-2" style="width: 50%; border: .5px solid #dee2e6; border-right:none; box-sizing:border-box;">
                    <b>Luka Operasi</b> <br>
                    <b>Deskripsi Nyeri</b> <br>
                    <b>Hipo/Hipertermi</b>
                </div>
                <div style="width: 50%;">
                    <?php foreach ($hipertensi as $key => $hiper) : ?>
                        <div class="d-flex  border-custom">
                            <div style="width: 100%;" class="p-1">
                                <b><?= $hiper['parameter_desc'] ?></b>
                                <p class="m-0 mt-1 p-0"><?= @$hiper['value_desc']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php
        } ?>


        <?php if (count($activity) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Aktivitas Dan Latihan</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="p-1" width="25%">
                            <b>Faktor Ketergantungan</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['tensi_bawah']; ?></p>
                        </td>
                        <td class="p-1" width="25%">
                            <b>Nilai</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['nadi']; ?></p>
                        </td>
                        <td class="p-1" width="25%">
                            <b>Faktor Ketergantungan</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['tensi_bawah']; ?></p>
                        </td>
                        <td class="p-1" width="25%">
                            <b>Nilai</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['nadi']; ?></p>
                        </td>
                    </tr>
                    <?php foreach ($activity as $key => $act) : ?>

                        <?php
                        // jika key pada data adalah ganjil
                        if (($key + 1) % 2 != 0) {
                            // jika data bukan data terakhir 
                            if ($key + 1 != count($activity)) {
                                echo '<tr>';
                                echo '<td class="p-1" style="width: 25%;">'
                                    . '<p class="m-0 mt-0 p-0">' . $act['parameter_desc'] . '</p>' .
                                    '</td>';
                                echo '<td class="p-1" style="width: 25%;">'
                                    . '<p class="m-0 mt-0 p-0">' . '[' . $act['value_score'] . '] ' . $act['value_desc'] . '</p>' .
                                    '</td>';
                            } else {
                                echo '<tr>';
                                echo '<td class="p-1" style="width: 25%;">'
                                    . '<p class="m-0 mt-0 p-0">' . $act['parameter_desc'] . '</p>' .
                                    '</td>';
                                echo '<td class="p-1" colspan="2" style="width: 25%;">'
                                    . '<p class="m-0 mt-0 p-0">' . '[' . $act['value_score'] . '] '  . $act['value_desc'] . '</p>' .
                                    '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<td class="p-1" style="width: 25%;">'
                                . '<p class="m-0 mt-0 p-0">' . $act['parameter_desc'] . '</p>' .
                                '</td>';
                            echo '<td class="p-1" style="width: 25%;">'
                                . '<p class="m-0 mt-0 p-0">' . '[' . $act['value_score'] . '] ' . $act['value_desc'] . '</p>' .
                                '</td>';
                            echo "<tr>";
                        }
                        ?>
                    <?php endforeach ?>
                    <?php if (isset($activity[0])) {
                    ?>
                        <tr>
                            <th colspan="4">Total Skor <?= $activity[0]['total_dependency'] ?></th>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        <?php
        } ?>


        <?php if (count($spiritual) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Psikologi Spiritual</h5>
            </div>

            <table class="table table-bordered">
                <tbody>
                    <tr class="d-flex">
                        <td class="p-1 col-4">
                            <b>Kondisi Pasien</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['tensi_bawah']; ?></p>
                        </td>
                        <td class="p-1 col-4">
                            <b>Hubungan dengan Keluarga</b>
                            <p class="m-0 mt-1 p-0"><?= @$spiritual['hubungan_keluarga']; ?></p>
                        </td>
                        <td class="p-1 col-4">
                            <b>Permintaan Khusus</b>
                            <p class="m-0 mt-1 p-0"><?= @$spiritual['permintaan_khusus']; ?></p>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="p-1 col-4">
                            <b>Agama</b>
                            <p class="m-0 mt-1 p-0"><?= @$spiritual['nama_agama']; ?></p>
                        </td>
                        <td class="p-1 col-4">
                            <b>Hambatan Sosial/Budaya/Ekonomi</b>
                            <p class="m-0 mt-1 p-0"><?= @$spiritual['hambatan_sosial']; ?></p>
                        </td>
                        <td class="p-1 col-4">
                            <b>Larangan Keyakinan</b>
                            <p class="m-0 mt-1 p-0"><?= @$spiritual['larangan_keyakinan']; ?></p>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="p-1 col-4">
                            <b>Mitos Budaya Setempat</b>
                            <p class="m-0 mt-1 p-0"><?= @$spiritual['mitos_budaya']; ?></p>
                        </td>
                        <td class="p-1 col-4"></td>
                        <td class="p-1 col-4"></td>
                    </tr>
                </tbody>
            </table>
        <?php
        } ?>
        <?php if (count($integumen) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Integumen & Muskulo Skeletal</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($integumen as $key => $integu) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $integu['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$integu['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>
        <?php if (count($sosialekonomi) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Sosial Ekonomi</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($sosialekonomi as $key => $sosec) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $sosec['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$sosec['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($neurosensoris) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Asesmen Neurosensoris</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($neurosensoris as $key => $neuro) : ?>
                    <div class="col-3 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $neuro['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$neuro['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
                <!--  <div class="col-9 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>GCS</b><br>
                    <b>E :</b><br> <span class="m-0 mt-1 p-0"><?= '[' . @$val['gcs_e'] . '] ' . @$val['gsc_e_desc']; ?></span><br>
                    <b>V :</b><br> <span class="m-0 mt-1 p-0"><?= '[' . @$val['gcs_v'] . '] ' . @$val['gsc_v_desc']; ?></span><br>
                    <b>M :</b><br> <span class="m-0 mt-1 p-0"><?= '[' . @$val['gcs_m'] . '] ' . @$val['gsc_m_desc']; ?></span><br>

                    <b>Score pGCS : </b>
                    <span class="m-0 mt-1 p-0"><?= @$val['gcs_desc']; ?></span>
                </div> -->
            </div>
        <?php
        } ?>

        <?php if (count($circulation) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Asesmen Sirkulasi</h5>
            </div>

            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($circulation as $key => $circu) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $circu['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$circu['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($pencernaan) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Pencernaan</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($pencernaan as $key => $cernaan) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $cernaan['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$cernaan['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>
        <?php if (count($pernapasan) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Pernapasan</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($pernapasan as $key => $napas) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $napas['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$napas['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($perkemihan) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Perkemihan</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($perkemihan as $key => $kemih) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $kemih['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$kemih['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($reproduksi) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Seksual/Reproduksi</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                    <b>Jenis Kelamin</b>
                    <p class="m-0 mt-1 p-0"><?= @$info['name_of_gender']; ?></p>
                </div>
                <?php foreach ($reproduksi as $key => $repro) : ?>
                    <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $repro['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= @$repro['value_desc']; ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($thtdanmata) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">THT/Mata</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($thtdanmata as $key => $tht) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $tht['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$tht['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($pediatri) > 0) {
        ?>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <?php
                        if (isset($pediatri[0])) {
                            $pediatri = $pediatri[0];
                        }
                        ?>
                        <td class="p-1" width="33.3%">
                            <b>Lama Kehamilan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['lema_kehamilan']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Komplikasi</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['komplikasi']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Masalah Neonatus</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['masalah_neonatus']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" width="33.3%">
                            <b>Masalah Maternal</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['masalah_maternal']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Riwayat Imunisasi</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['riwayat_imunisasi']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Umur Saat Tengkurap</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['usia_tengkurap']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" width="33.3%">
                            <b>Umur Saat Duduk</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['usia_duduk']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Umur Saat Mengoceh</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['usia_mengoceh']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Umur Saat Berdiri</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['usia_berdiri']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" width="33.3%">
                            <b>Umur Saat Bicara</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['usia_berbicara']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Umur Saat Berjalan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['usia_berjalan']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>ASI/Formula</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['asi']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" width="33.3%">
                            <b>Makanan Tambahan</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['makanan_tambahan']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Pengasuh</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['pengasuh']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Pembawaan Umum</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['pembawaan']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" width="33.3%">
                            <b>Tempramen</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['tempramen']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Kebiasaan Perilaku Unik</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['kebiasaan_unik']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%">
                            <b>Gangguan Tumbuh Kembang</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['tumbuh_kembang']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1" width="66.7%" colspan="2">
                            <b>Resiko terjadi penyakit yang dapat dicegah dengan imunisasi</b>
                            <p class="m-0 mt-1 p-0"><?= @$pediatri['resiko_penyakit']; ?></p>
                        </td>
                        <td class="p-1" width="33.3%"></td>
                    </tr>
                </tbody>
            </table>
        <?php
        } ?>

        <?php if (count($tidurdanistirahat) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Tidur Dan Istirahat</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($tidurdanistirahat as $key => $tidur) : ?>
                    <div class="col-4 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $tidur['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$tidur['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>

        <?php if (count($dekubitus) > 0) {
        ?>
            <div class="row">
                <h5 class="text-start">Dekubitus</h5>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <?php foreach ($dekubitus as $key => $deku) : ?>
                    <div class="col-6 p-1 border-collide" style="border: .5px solid #dee2e6; box-sizing:border-box;">
                        <b><?= $deku['parameter_desc'] ?></b>
                        <p class="m-0 mt-1 p-0"><?= (@$deku['value_desc']); ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        <?php
        } ?>




        <div class="row">
            <h5 class="text-start">Diagnosis Keperawatan</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Nama Diagnosis</b>
                        <p class="m-0 mt-1 p-0"></p>
                    </td>
                </tr>
                <?php foreach ($diag as $key => $value) {
                ?>
                    <tr>
                        <td class="p-1">
                            <b><?= $value['diag_notes']; ?></b>
                            <p class="m-0 mt-1 p-0"></p>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-4 text-center">
                <div>Sampangan, <?= tanggal_indo(date('Y-m-d')); ?></div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <div></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                <div></div>
                <br>
                <div class="mb-2">Perawat yang mengkaji</div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <div></div>
                <br>
                <div class="mb-2">Penerima Penjelasan</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" align="center">
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
                <p class="p-0 m-0 py-1" id="qrcode_name">(<?= @$val['petugas_name']; ?>)</p>
                <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4" align="center">
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
                <p class="p-0 m-0 py-1" id="qrcode_name1">(<?= @$val['nama']; ?>)</p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script>
    let val = <?= json_encode($val); ?>;
    let sign = <?= json_encode($sign); ?>;

    sign = JSON.parse(sign)
</script>
<script>
    $.each(sign, function(key, value) {
        if (value.user_type == 1 && value.isvalid == 1) {
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: value.sign_path,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
            $("#qrcode_name").html(`(${value.fullname??value.user_id})`)
        } else if (value.user_type == 2 && value.isvalid == 1) {
            var qrcode1 = new QRCode(document.getElementById("qrcode1"), {
                text: value.sign_path,
                width: 150,
                height: 150,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H // High error correction
            });
            $("#qrcode_name1").html(`(<?= @$visit['diantar_oleh']; ?>)`)
        }
    })
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