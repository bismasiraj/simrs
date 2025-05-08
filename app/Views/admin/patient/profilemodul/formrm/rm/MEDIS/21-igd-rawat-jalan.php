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
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
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
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3><?= $val['name_of_org_unit']; ?></h3>
                <!-- <h3>Surakarta</h3> -->
                <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
                <p><?= $val['contact_address']; ?>, Fax : <?= $val['fax']; ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
        </div>
        <div class="row">
            <h4 class="text-center"><?= $title; ?></h4>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Nomor RM</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['no_rm']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Nama Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['nama']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Jenis Kelamin</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['jeniskel']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Tanggal Lahir (Usia)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['date_of_birth'] . ' (' . @$val['umur'] . ')'; ?></p>

                    </td>
                    <td class="p-1" colspan="2">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['alamat']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['dokter']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['departmen']; ?></p>
                    </td class="p-1">
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0"><?= $dt->format('Y-m-d H:i:s'); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
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
                        <p class="m-0 mt-1 p-0"><?= @$val['suhu']; ?> ℃</p>
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
                                <b>pGCS E / Respon Membuka Mata :</b> <span class="m-0 mt-1 p-0"><?= @$val['gcs_e']; ?>.</span>
                                <b>pGCS V / Respon Verbal Terbaik :</b> <span class="m-0 mt-1 p-0"><?= @$val['gcs_v']; ?>.</span>
                                <b>pGCS M / Respon Motorik Terbaik :</b> <span class="m-0 mt-1 p-0"><?= @$val['gcs_m']; ?>.</span>
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-auto">
                                <b>Score pGCS : </b>
                                <span class="m-0 mt-1 p-0"><?= @$val['gcs']; ?></span>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Keadaan Umum</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['namadiagnosa'] ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Skala Nyeri</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pain_score']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Resiko Jatuh</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['fall_score']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Kepala</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_kepala']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Mata</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_mata']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Hidung</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_hidung']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Telinga</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_telinga']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Mulut</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_mulut']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Gigi</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_gigi']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Leher</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_leher']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Jantung</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_jantung']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Paru-paru</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_paru']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" width="45%">
                        <b>Herpar</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_hepar']; ?></p>
                    </td>
                    <td class="p-1" width="55%">
                        <b>Lien</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_lien']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Ginjal</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_ginjal']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- <table class="table table-bordered"><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
                <tbody>
                    <tr>
                        <td style="height: 30px"  class="p-1">
                            <b>Thorax</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['pf_thorax']; ?></p>
                        </td>
                        <td><img class="mt-3" src="<?= base_url('assets/img/asesmen/dalam/thorax.png') ?>" width="400px"></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered"><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
                <tbody>
                    <tr>
                        <td style="height: 30px"  class="p-1">
                            <b>Abdomen</b>
                            <p class="m-0 mt-1 p-0"><?= @$val['gambar_perut']; ?></p>
                        </td>
                        <td><img class="mt-3" src="<?= base_url('assets/img/asesmen/dalam/abdomen.png') ?>" width="400px"></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr class="fw-bold">
                        <td>Gambar Laki-laki</td>
                        <td style="width: 50%;">
                            <img class="mt-3" src="<?= base_url('assets/img/asesmen/bedah/male.jpg') ?>" width="400px">
                        </td>
                        
                    </tr>
                    <tr>
                    <td>Gambar Perempuan</td>
                        <td>
                            <img class="mt-3" src="<?= base_url('assets/img/asesmen/bedah/female.jpg') ?>" width="400px">
                        </td>
                    </tr>
                </tbody>
            </table> -->

        <table class="table table-bordered">
            <tbody>
                <?php
                if (!empty($lokalis)) {
                    foreach ($lokalis as $key => $value) {
                        if ($value['value_score'] == 3) {
                            $filepath = WRITEPATH . 'uploads/lokalis/' . $value['value_detail'];

                            if (file_exists($filepath)) {
                                $filedata = file_get_contents($filepath);
                                $filedata64 = base64_encode($filedata);
                                $selectlokalis[$key]['filedata64'] = $filedata64;

                                echo '<tr>';
                                echo '<th>' . $value['nama_lokalis'] . '</th>';
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

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" rowspan="2">
                        <b>Genitalia</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_genitais']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Ekstemitas Atas</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_ekstermitas_atas']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Ekstemitas Bawah</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['pf_extermintas_bawah']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Catatan Obyektif</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['teraphy_desc']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1">
                        <b>Triage</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['ats_tipe'] ?></p>
                    </td>
                </tr>
                <?php if (!empty($val['ats_tipe'])) : ?>
                    <tr>
                        <td class="p-1">
                            <b><?= @$val['ats_tipe']; ?></b>
                            <p class="m-0 mt-1 p-0"><?= @$val['ats_item'] ?></p>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Hamil</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['hamil']; ?></p>
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
            </tbody>
        </table>

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
                        <p class="m-0 mt-1 p-0"><?= @$val['tindaklanjut']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Sampangan, <?= date('d-m-Y'); ?></div>
                <br>
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
                <p class="p-0 m-0 py-1">(<?= @$val['dokter']; ?>)</p>
                <i>dicetak pada tanggal <?= date('d-m-Y H:i'); ?></i>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
<!-- <script>
    $(document).ready(function() {
        $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
        $("#no_registration").val("<?= $visit['no_registration']; ?>")
        $("#visit_id").val("<?= $visit['visit_id']; ?>")
        $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
        $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
        $("#in_date").val("<?= $visit['in_date']; ?>")
        $("#exit_date").val("<?= $visit['exit_date']; ?>")
        $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        ?>
        $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#employee_id").val("<?= $visit['employee_id']; ?>")
        $("#description").val("<?= $visit['description']; ?>")
        $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#modified_by").val("<?= user()->username; ?>")
        $("#modified_from").val("<?= $visit['clinic_id']; ?>")
        $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
        $("#ageyear").val("<?= $visit['ageyear']; ?>")
        $("#agemonth").val("<?= $visit['agemonth']; ?>")
        $("#ageday").val("<?= $visit['ageday']; ?>")
        $("#thename").val("<?= $visit['diantar_oleh']; ?>")
        $("#theaddress").val("<?= $visit['visitor_address']; ?>")
        $("#theid").val("<?= $visit['pasien_id']; ?>")
        $("#isrj").val("<?= $visit['isrj']; ?>")
        $("#gender").val("<?= $visit['gender']; ?>")
        $("#doctor").val("<?= $visit['employee_id']; ?>")
        $("#kal_id").val("<?= $visit['kal_id']; ?>")
        $("#petugas_id").val("<?= user()->username; ?>")
        $("#petugas").val("<?= user()->fullname; ?>")
        $("#account_id").val("<?= $visit['account_id']; ?>")
    })
    $("#btnSimpan").on("click", function() {
        saveSignatureData()
        saveSignatureData1()
        console.log($("#TTD").val())
        $("#form").submit()
    })
    $("#btnEdit").on("click", function() {
        $("input").prop("disabled", false);
        $("textarea").prop("disabled", false);

    })
</script> -->
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
    window.print();
</script>

</html>