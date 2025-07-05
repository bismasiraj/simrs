<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>DISCHARD PLANNING</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>

    <div class="container-fluid mt-5">
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RM 3.4</h6>
            <table class="table table-bordered mb-0" style="border: 1px solid black">
                <tr>
                    <td align="center">
                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                        <p class="mt-2">Sehat-Amanah <br> Tanggung Jawab-Islami</p>
                    </td>
                    <td>
                        <h5 class="mt-4">RS. PKU MUHAMMADIYAH SAMPANGAN</h5>
                        <p>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta <br> Telp 0271-633894 Fax. : 0271-630229 <br> Jawa Tengah 57117</p>
                    </td>
                    <td>
                        <div class="col-md-12 align-items-center">
                            <div class="container mt-1" style="border:1px solid black; padding-top:70px; height:160px; border-radius: 10px">
                                <p class="text-center">Label Identitas Pasien</p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h5 class="text-center">DISCHARD PLANNING</h5>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mb-0 mt-0" style="border: 1px solid black">
                <tr>
                    <td colspan="2" width="70%">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <strong><label>Tanggal</label></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="v_01" id="v_01">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <strong><label>Jam</label></strong>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="time" name="v_02" id="v_02">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td width="30%">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <strong><label>DPJP</label></strong>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_03" id="v_03">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mb-0 mt-0" style="border: 1px solid black">
                <tr>
                    <th width="80%">Kriteria pasien dengan pemulangan rumit (kritis), Jika ragu diskusikan dengan DPJP</th>
                    <th width="10%" class="text-center">Ya</th>
                    <th width="10%" class="text-center">Tidak</th>
                </tr>
                <tr>
                    <td>
                        <li>Usia ≥65 tahun dengan dimensia</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_01_1" name="t_01" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_01_0" name="t_01" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Tinggal sendirian tanpa dukungan sosial secara langsung</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_02_1" name="t_02" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_02_0" name="t_02" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Stroke, serangan jantung, PPOK, gagal jantung kongestif, emfisema, dimensia, alzeimer, AIDS, atau penyakit dengan potensi mengancam nyawa lainnya</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_03_1" name="t_03" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_03_0" name="t_03" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Pasien besaral dari panti jompo</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_04_1" name="t_04" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_04_0" name="t_04" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Alamat tidak diketahui</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_05_1" name="t_05" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_05_0" name="t_05" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Tunawisma</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_06_1" name="t_06" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_06_0" name="t_06" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Dirawat kembali dalam 30 hari dengan kasus yang sama</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_07_1" name="t_07" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_07_0" name="t_07" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Percobaan bunuh diri</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_08_1" name="t_08" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_08_0" name="t_08" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Pasien tidak dikenal/tidak ada identitas</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_09_1" name="t_09" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_09_0" name="t_09" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Korban dari kasus kriminal</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_010_1" name="t_010" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_010_0" name="t_010" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Trauma multiple</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_011_1" name="t_011" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_011_0" name="t_011" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Kepala keluarga tidak bekerja/tidak ada asuransi</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_012_1" name="t_012" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_012_0" name="t_012" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>BBL anak pertama</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_013_1" name="t_013" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_013_0" name="t_013" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>BBLR</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_014_1" name="t_014" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_014_0" name="t_014" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Bayi gemeli</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_015_1" name="t_015" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_015_0" name="t_015" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Neonatus level II</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_016_1" name="t_016" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_016_0" name="t_016" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Pasien dirawat di NICU, PICU</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_017_1" name="t_017" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_017_0" name="t_017" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Pasien dengan kesulitan mobilitas gerak</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_018_1" name="t_018" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_018_0" name="t_018" value="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <li>Status gizi risiko malnutrisi sedang dan malnutrisi berat</li>
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_019_1" name="t_019" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_019_0" name="t_019" value="0">
                    </td>
                </tr>
                <tr>
                    <td><i>Jika ada salah satu atau lebih jawaban pada ya diatas maka termasuk pemulangan rumit</i></td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_020_1" name="t_020" value="1">
                    </td>
                    <td class="text-center" style="vertical-align:middle">
                        <input class="form-check-input" type="radio" id="t_020_0" name="t_020" value="0">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6>EDUKASI KESEHATAN</h6>
                        - Jadwal kontrol <br>
                        - Pemeriksaan laboratorium lanjutan<br>
                        - Pengertian dan pemahaman efek samping obat <br>
                        - Obat-obatan alternative <br>
                        - Pencegahan terhadap kekambuhan lainnya <br>
                        - Pengobatan / oat-obatan yang sdah diresepkan untuk dilanjutkan di rumah
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6>PERAWATAN DI RUMAH</h6>
                        -Kenali tanda dan gejala yang perlu dilaporkan <br>
                        -Pengobatan yang dapat dilakukan di rumah sebelum ke rumah sakit
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6>DIIT</h6>
                        -Anjuran pola makan <br>
                        -Batasan makanan
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6>RINCIAN PEMULANGAN</h6>
                        -Tanggal pemulangan <br>
                        -Pendamping <br>
                        -Transportasi yang digunakan <br>
                        -Keadaan umum saat pemulangan
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <h6>MANAGEMEN DISCHARGE</h6>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Bantuan perawatan yang dibutuhkan setelah pulang <br>
                        -Panti/ Rumah singgah <br>
                        -Dokter keluarga / Dokter praktek <br>
                        -Rumah sakit <br>
                        -Puskesmas <br>
                        -Rehabilitasi Rawat jalan <br>
                        -Home care Rs <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        Instruksi Rencana Pemulangan Pasien ini telah dijelaskan kepada pasien dan atau keluarga. <br>
                        Telah dibaca dan dimengerti :
                        <br>
                        <br>
                        <br>
                        <div class="row align-items-enter">
                            <div class="col-md-6 text-center">
                                <p>Profesi Pemberi Asuhan</p>
                                <br>
                                <canvas id="canvas" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd" name="ttd">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_04" name="v_04">
                                </div>
                                <p>TTD dan Nama Terang</p>
                            </div>
                            <div class="col-md-6 text-center align-items-center">
                                <p>Pasien / Keluarga</p>
                                <br>
                                <canvas id="canvas1" width="200" height="100" style="border:1px solid #000;"></canvas>
                                <input type="hidden" id="ttd_1" name="ttd_1">
                                <br>
                                <br>
                                <div class="col-sm-6 mx-auto">
                                    <input type="text" class="form-control" id="v_05" name="v_05">
                                </div>
                                <p>TTD dan Nama Terang</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mb-5 mt-0" style="border: 1px solid black">
                <tr>
                    <td width="50%">Pemulangan ke :</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_021_1" name="t_021" value="1">
                            <label for="t_021_1">Rumah pribadi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_021_2" name="t_021" value="2">
                            <label for="t_021_2">Rumah kelompok</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_021_3" name="t_021" value="3">
                            <label for="t_021_3">Pusat rehabilitasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_021_4" name="t_021" value="4">
                            <label for="t_021_4">Panti jompo</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_021" id="t_021_5" value="5">
                                    <label for="t_021_5">Lainnya</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_06" id="v_06">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Apakah ada pengasuh? <br><br> Jika Ya, hubungan pengasuh :</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_022_1" name="t_022" value="1">
                            <label for="t_022_1"> Ada</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_022_0" name="t_022" value="0">
                            <label for="t_022_0">Tidak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_023" name="t_023" value="1">
                            <label for="t_023">Suami/ istri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_024" name="t_024" value="1">
                            <label for="t_024">Wali</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_025" name="t_025" value="1">
                            <label for="t_025">Saudara laki-laki/ perempuan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_026" name="t_026" value="1">
                            <label for="t_026">Keluarga lain</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_027" name="t_027" value="1">
                            <label for="t_027">Teman</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_028" name="t_028" value="1">
                            <label for="t_028">Tetangga</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="t_029" id="t_029" value="1">
                                    <label for="t_029">Lainnya</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_07" id="v_07">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Kontak support keluarga :</td>
                    <td>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_08" id="v_08">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Hubungan</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_09" id="v_09">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label>Hp/Telpon</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_10" id="v_10">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td> Apakah ada sarana transportasi : <br> <br>Jenis transportasi yang dibutuhkan :</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_030_1" name="t_030" value="1">
                            <label for="t_030_1">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_030_0" name="t_030" value="0">
                            <label for="t_030_0">Tidak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_031_1" name="t_031" value="1">
                            <label for="t_031_1">Ambulance</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_031_2" name="t_031" value="2">
                            <label for="t_031_2">Mobil</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Peralatan yang diperlukan :</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_032" name="t_032" value="1">
                            <label for="t_032">Kursi roda</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_033" name="t_033" value="1">
                            <label for="t_033">Walker</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_034" name="t_034" value="1">
                            <label for="t_034">Tongkat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_035" name="t_035" value="1">
                            <label for="t_035">Kaos kaki pelindung</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_036" name="t_036" value="1">
                            <label for="t_036">Toilet duduk</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_037" name="t_037" value="1">
                            <label for="t_037">Pagar pengaman</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="t_038" name="t_038" value="1">
                            <label for="t_038">Jalur landau</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="t_039" id="t_039" value="1">
                                    <label for="t_039">Lainnya</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_11" id="v_11">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td> Tingkat aktivitas/ status mental :</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_1" name="t_040" value="1">
                            <label for="t_040_1">Mandiri</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_2" name="t_040" value="2">
                            <label for="t_040_2">Bantuan minimal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_3" name="t_040" value="3">
                            <label for="t_040_3">Sadar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_4" name="t_040" value="4">
                            <label for="t_040_4">Kooperatif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_5" name="t_040" value="5">
                            <label for="t_040_5">Agitasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_6" name="t_040" value="6">
                            <label for="t_040_6">Tidak bisa gerak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_7" name="t_040" value="7">
                            <label for="t_040_7">Bantuan penuh</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_8" name="t_040" value="8">
                            <label for="t_040_8">Terorientasikan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_040_9" name="t_040" value="9">
                            <label for="t_040_9">Bingung</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td> Apakah pasien aman/ mampu kembali ke rumah?</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_041_1" name="t_041" value="1">
                            <label for="t_041_1">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_041_0" name="t_041" value="0">
                            <label for="t_041_0">Tidak</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td> Perencanaan keuangan :</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_042_1" name="t_042" value="1">
                            <label for="t_042_1">BPJS Kesehatan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="t_042_2" name="t_042" value="2">
                            <label for="t_042_2">Bayar Sendiri</label>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_042" id="t_042_3" value="3">
                                    <label for="t_042_3">Asuransi lain</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_12" id="v_12">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="t_042" id="t_042_4" value="4">
                                    <label for="t_042_4">Lain-lain</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="v_13" id="v_13">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

<script>
    var canvas = document.getElementById('canvas');
    const canvasDataInput = document.getElementById('ttd');
    var context = canvas.getContext('2d');

    var drawing = false;

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context.lineWidth = 2;
        context.lineCap = 'round';
        context.strokeStyle = '#000';

        // Draw a line
        context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context.beginPath();
    }

    function saveSignatureData() {
        const canvasData = canvas.toDataURL('image/png');
        canvasDataInput.value = canvasData;
    }
</script>

<script>
    var canvas1 = document.getElementById('canvas1');
    const canvasDataInput1 = document.getElementById('ttd_1');
    var context1 = canvas1.getContext('2d');
    var drawing = false;

    canvas1.addEventListener('mousedown', startDrawing);
    canvas1.addEventListener('mousemove', draw);
    canvas1.addEventListener('mouseup', stopDrawing);
    canvas1.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context1.lineWidth = 2;
        context1.lineCap = 'round';
        context1.strokeStyle = '#000';

        context1.lineTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
        context1.stroke();
        context1.beginPath();
        context1.moveTo(e.clientX - canvas1.getBoundingClientRect().left, e.clientY - canvas1.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context1.beginPath();
    }

    function saveSignatureData1() {
        const canvasData1 = canvas1.toDataURL('image/png');

        canvasDataInput1.value = canvasData1;
    }
</script>

</html>