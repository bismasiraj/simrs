<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assessment Keperawatan Rawat Inap Pasien Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <a href="<?= base_url('pku/halamanform2') ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i></a>
        <div class="row align-items-center">
            <p class="text-end">RM 5</p>
        </div>
        <form action="" method="">
            <table class="table table-bordered mb-3" style="border: 1px;">
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-3" align='middle'>
                                <img class="mt-2" src="<?= base_url('uploads/pku.png') ?>" width="90px">
                                <p style="font-size: 12px;">SEhat-aMANah-<br>tanGGungjawab-Islami</p>
                            </div>
                            <div class="col-6">
                                <h5><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h5>
                                <h6><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta</b></h6>
                                <p>Telp 0271-633894 Fax. : 0271-630229
                                    <br>Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-3">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center"><strong>ASESMEN KEPERAWATAN RAWAT INAP PASIEN ANAK</strong></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <span>Alergi</span>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" class="form-check-input" id="T_01_1" name="T_01" value="1">
                                <label for="T_01_1" class="form-check-label">Tidak ada</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" class="form-check-input" id="T_01_2" name="T_01" value="2">
                                <label for="T_01_2" class="form-check-label">Ya, jelaskan</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="V_01" name="V_01">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <span>Masuk rawat inap tinggal :</span>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="V_02" name="V_02">
                            </div>
                            <div class="col-md-3">
                                <span>Jam :</span>
                            </div>
                            <div class="col-md-3">
                                <input type="time" class="form-control" id="V_03" name="V_03">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Keluhan Utama :</strong>
                        <br>
                        <textarea name="V_04" id="V_04" class="form-control" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Riwayat Penyakit Sekarang :</strong>
                        <br>
                        <textarea name="V_05" id="V_05" class="form-control" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Riwayat Penyakit Dahulu :</strong>
                        <br>
                        <textarea name="V_06" id="V_06" class="form-control" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong>Riwayat Imunisasi :</strong>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_02_1" name="T_02" value="1">
                                    <label class="form-check-label" for="T_02_1">Lengkap</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_02_2" name="T_02" value="2">
                                    <label class="form-check-label" for="T_02_2">Tidak Imunisasi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_02_3" name="T_02" value="3">
                                    <label class="form-check-label" for="T_02_3">Tidak Lengkap, sebutkan :</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="V_07" name="V_07">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Riwayat Tumbuh Kembang (umur 0-6 tahun) :</strong>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_03_1" name="T_03" value="1">
                                    <label class="form-check-label" for="T_03_1">Sesuai tingkat perkembangan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_03_2" name="T_03" value="2">
                                    <label class="form-check-label" for="T_03_2">Tidak sesuai, sebutkan :</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="V_08" name="V_08">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>A. Skrining Gizi</strong>
                        <div class="container mt-2">
                            <div class="row align-items-center">

                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup"></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">TB/PB</div>
                                        </div>
                                        <input type="text" class="form-control" id="T_04" name="T_04" size="1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Cm</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup"></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">BB</div>
                                        </div>
                                        <input type="text" class="form-control" id="T_05" name="T_05" size="1">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup"></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">IMT</div>
                                        </div>
                                        <input type="text" class="form-control" id="T_06" name="T_06" size="1">
                                    </div>
                                </div>


                                <table class="table table-bordered mt-2" style="border: 1px;">
                                    <tr>
                                        <td rowspan="5" class="text-center" style="vertical-align: middle;">
                                            <span>Anak<br>0-60 bulan</span>
                                        </td>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_07_1" name="T_07" value="1">
                                            <label for="T_07_1" class="form-check-label">Gizi buruk <-3 SD</label>
                                        </td>
                                        <td rowspan="5" class="text-center" style="vertical-align: middle;">
                                            <span>Anak<br>61 bulan - 18 tahun</span>
                                        </td>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_08_1" name="T_08" value="1">
                                            <label for="T_08_1" class="form-check-label">Sangat kurus <-3 SD</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_07_2" name="T_07" value="2">
                                            <label for="T_07_2" class="form-check-label">Gizi kurang -3 s/d -2 SD</label>
                                        </td>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_08_2" name="T_08" value="2">
                                            <label for="T_08_2" class="form-check-label">Kurus -3 s/d < -2 SD</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_07_3" name="T_07" value="3">
                                            <label for="T_07_3" class="form-check-label">Gizi baik skor -2 SD s/d 2 SD</label>
                                        </td>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_08_3" name="T_08" value="3">
                                            <label for="T_08_3" class="form-check-label">Normal -2 s/d 1 SD</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_07_4" name="T_07" value="4">
                                            <label for="T_07_4" class="form-check-label">Gizi lebih skor >2 SD</label>
                                        </td>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_08_4" name="T_08" value="4">
                                            <label for="T_08_4" class="form-check-label">Gemuk >1 s/d 2 SD</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="radio" class="form-check-input" id="T_08_5" name="T_08" value="5">
                                            <label for="T_08_5" class="form-check-label">Obesitas >SD</label>
                                        </td>
                                    </tr>
                                </table>
                                <span>Bila skor < -2 SD dan> 2 SD, wajib lapor DPJP untuk konsul kepada ahli gizi</span>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>B. Skrining Nyeri</strong>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <strong>Apakah pasien merasakan nyeri :</strong>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_09_1" name="T_09" value="1">
                                    <label class="form-check-label" for="T_09_1">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_09_2" name="T_09" value="2">
                                    <label class="form-check-label" for="T_09_2">Ya, bila ya lanjutkan penilaian :</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_09" name="V_09">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <strong>Onset :</strong>
                            </div>
                            <div class="col-md-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_010_1" name="T_010" value="1">
                                    <label class="form-check-label" for="T_010_1">Akut</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_010_2" name="T_010" value="2">
                                    <label class="form-check-label" for="T_010_2">Kronik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_010_3" name="T_010" value="3">
                                    <label class="form-check-label" for="T_010_3">Asesmen Nyeri dengan :</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="V_09" name="V_09">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center" style="margin-left: 150px;">
                            <div class="col-md-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">P :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_10" name="V_10">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Q :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_11" name="V_11">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_12" name="V_12">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">S :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_13" name="V_13">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">T :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_14" name="V_14">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        Asesmen ulang nyeri tiap :
                        <br>
                        <input class="form-check-input" type="radio" id="T_011_1" name="T_011" value="1">
                        <label for="T_011_1" class="form-check-label">Nyeri ringan tiap 8 jam</label>
                        <br>
                        <input class="form-check-input" type="radio" id="T_011_2" name="T_011" value="2">
                        <label for="T_011_2" class="form-check-label">Nyeri sedang tiap 4 jam</label>
                        <br>
                        <input class="form-check-input" type="radio" id="T_011_3" name="T_011" value="3">
                        <label for="T_011_3" class="form-check-label">Nyeri berat tiap 1 jam</label>
                    </td>
                    <td width="70%">
                        Penatalaksanaan Nyeri :
                        <br>
                        <input class="form-check-input" type="radio" id="T_012_1" name="T_012" value="1">
                        <label for="T_012_1" class="form-check-label">Skala nyeri ringan penatalaksanaan dilakukan oleh perawat, bila tidak teratasi dilaporkan DPJP</label>
                        <br>
                        <input class="form-check-input" type="radio" id="T_012_2" name="T_012" value="2">
                        <label for="T_012_2" class="form-check-label">Skala nyeri sedang sampai berat penatalaksanaan dilakukan oleh DPJP, bila tidak teratasi<br>dalam kurun waktu 3x24 jam DPJP wajib konsul pada Tim nyeri</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col">
                                <strong>C. Resiko Jatuh</strong>
                            </div>
                            <div class="col">
                                <label for="V_15">Skor:</label>
                                <input type="text" class="form-control" id="V_15" name="V_15">
                            </div>
                            <div class="col">
                                <label for="V_16">Kategori</label>
                                <input type="text" class="form-control" id="V_16" name="V_16">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>D. Psikologi</strong>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <span>Pasien dalam kondisi :</span>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_013_1" name="T_013" value="1">
                                    <label class="form-check-label" for="T_013_1">Baik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_013_2" name="T_013" value="2">
                                    <label class="form-check-label" for="T_013_2">Depresi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_013_3" name="T_013" value="3">
                                    <label class="form-check-label" for="T_013_3">Khawatir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_013_4" name="T_013" value="4">
                                    <label class="form-check-label" for="T_013_4">Sulit/suka melawan perintah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_013_5" name="T_013" value="5">
                                    <label class="form-check-label" for="T_013_5">Berpotensi menyakiti diri atau orang</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="col-md-4">
                                <span>Hubungan dengan anggota keluarga :</span>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_014_1" name="T_014" value="1">
                                    <label class="form-check-label" for="T_014_1">Baik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_014_2" name="T_014" value="2">
                                    <label class="form-check-label" for="T_014_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="col-md-4">
                                <span>Keinginan khusus pasien :</span>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_015_1" name="T_015" value="1">
                                    <label class="form-check-label" for="T_015_1">Tidak ingin dijenguk</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_015_2" name="T_015" value="2">
                                    <label class="form-check-label" for="T_015_2">Tidak ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_015_3" name="T_015" value="3">
                                    <label class="form-check-label" for="T_015_3">Ingin dirawat perawat sesuai jenis kelamin</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_015_4" name="T_015" value="4">
                                    <label class="form-check-label" for="T_015_4">Lain – lain :</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="V_17" name="V_17">
                            </div>
                        </div>
                        <span>Hambatan sosial, budaya, dan ekonomi dalam penyembuhan penyakit :</span>
                        <div class="row align-items-center mt-2">
                            <div class="col-md-4">
                                Larangan dari keyakinan yang dianut :
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_016_1" name="T_016" value="1">
                                    <label class="form-check-label" for="T_016_1">Tidak ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_016_2" name="T_016" value="2">
                                    <label class="form-check-label" for="T_016_2">Ada, sebutkan:</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_18" name="V_18">
                            </div>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="col-md-4">
                                Mitos budaya setempat :
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_017_1" name="T_017" value="1">
                                    <label class="form-check-label" for="T_017_1">Tidak ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_017_2" name="T_017" value="2">
                                    <label class="form-check-label" for="T_017_2">Ada, sebutkan:</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_19" name="V_19">
                            </div>
                        </div>
                        <strong>E. Kebutuhan Cairan</strong>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Minum :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_20" name="V_20">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">cc/h</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <span>Perasaan haus berlebihan : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_018_1" name="T_018" value="1">
                                    <label class="form-check-label" for="T_018_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_018_2" name="T_018" value="2">
                                    <label class="form-check-label" for="T_018_2">Tidak</label>
                                </div>
                                <span>Oedema :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_019_1" name="T_019" value="1">
                                    <label class="form-check-label" for="T_019_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_019_2" name="T_019" value="2">
                                    <label class="form-check-label" for="T_019_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Mukosa mulut :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_020_1" name="T_020" value="1">
                                    <label class="form-check-label" for="T_020_1">Kering</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_020_2" name="T_020" value="2">
                                    <label class="form-check-label" for="T_020_2">Normal</label>
                                </div>
                                <span>Turgor kulit :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_021_1" name="T_021" value="1">
                                    <label class="form-check-label" for="T_021_1">Baik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_021_2" name="T_021" value="2">
                                    <label class="form-check-label" for="T_021_2">Sedang</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_021_3" name="T_021" value="3">
                                    <label class="form-check-label" for="T_021_3">Buruk</label>
                                </div>
                            </div>
                        </div>
                        <strong>F.Kebutuhan Elimiunasi</strong>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Frekwensi BAK</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_022" name="T_022" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">x/h</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Jumlah</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_24" name="T_24" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">cc</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Keluhan :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_21" name="V_21" size="10">
                                </div>
                            </div>

                        </div>

                        <div class="row align-items-center mb-2">
                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Frekwensi BAB</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_23" name="T_23" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">x/h</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Warna</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_22" name="V_22" size="5">
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Bau</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_23" name="V_23" size="5">
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Konsistensi</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_24" name="V_24" size="5">
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Terakhir BAB</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_25" name="V_25" size="5">
                                </div>
                            </div>
                        </div>
                        <strong>G. Kebutuhan Persepsi Sensori</strong>
                        <div class="row align-items-center">
                            <div class="col">
                                <span>Penglihatan : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_025_1" name="T_025" value="1">
                                    <label class="form-check-label" for="T_025_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_025_2" name="T_025" value="2">
                                    <label class="form-check-label" for="T_025_2">Tidak</label>
                                </div>
                                <span>Pendengaran :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_026_1" name="T_026" value="1">
                                    <label class="form-check-label" for="T_026_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_026_2" name="T_026" value="2">
                                    <label class="form-check-label" for="T_026_2">Tidak</label>
                                </div>
                                <span>Penciuman :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_027_1" name="T_027" value="1">
                                    <label class="form-check-label" for="T_027_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_027_2" name="T_027" value="2">
                                    <label class="form-check-label" for="T_027_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Pengecapan : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_028_1" name="T_028" value="1">
                                    <label class="form-check-label" for="T_028_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_028_2" name="T_028" value="2">
                                    <label class="form-check-label" for="T_028_2">Tidak</label>
                                </div>
                                <span>Perabaan :</span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_029_1" name="T_029" value="1">
                                    <label class="form-check-label" for="T_029_1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_029_2" name="T_029" value="2">
                                    <label class="form-check-label" for="T_029_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <strong>H. Kebutuhan Komunikasi</strong>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Berbicara : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_030_1" name="T_030" value="1">
                                    <label class="form-check-label" for="T_030_1">Lancar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_030_2" name="T_030" value="2">
                                    <label class="form-check-label" for="T_030_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Pembicaraan : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_031_1" name="T_031" value="1">
                                    <label class="form-check-label" for="T_031_1">Lancar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_031_2" name="T_031" value="2">
                                    <label class="form-check-label" for="T_031_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Disoreintasi : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_032_1" name="T_032" value="1">
                                    <label class="form-check-label" for="T_032_1">Lancar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_032_2" name="T_032" value="2">
                                    <label class="form-check-label" for="T_032_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Menarik diri : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_033_1" name="T_033" value="1">
                                    <label class="form-check-label" for="T_033_1">Lancar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_033_2" name="T_033" value="2">
                                    <label class="form-check-label" for="T_033_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <span>Apatis : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_034_1" name="T_034" value="1">
                                    <label class="form-check-label" for="T_034_1">Lancar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_034_2" name="T_034" value="2">
                                    <label class="form-check-label" for="T_034_2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <strong>I. Kebutuhan Spiritual</strong>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <span>Kegiatan sehari-hari yang dilakukan :</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="V_26" name="V_26">
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-md-4">
                                <span>Membutuhkan bantuan dalam beribadah :</span>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="form-chek-input" id="T_035_1" name="T_035" value="1">
                                <label for="T_035_1" class="form-check-label">Ya</label>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" class="form-chek-input" id="T_035_2" name="T_035" value="2">
                                <label for="T_035_2" class="form-check-label">Tidak, jika ya dalam bentuk:</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="V_27" name="V_27">
                            </div>
                        </div>
                        <strong>J. Kebutuhan istiraht</strong>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <span>Jumlah jam tidur</span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="T_036" name="T_036">
                            </div>
                            <div class="col-md-1">
                                <span>jam</span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <span>Penggunaan obat tidur</span>
                            </div>
                            <div class="col-md-1">
                                <input type="radio" class="form-chek-input" id="T_037_1" name="T_037" value="1">
                                <label for="T_037_1" class="form-check-label">Tidak</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-chek-input" id="T_037_2" name="T_037" value="2">
                                <label for="T_037_2" class="form-check-label">Ya, jika ya jenisnya:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="V_28" name="V_28">
                            </div>
                        </div>
                        <strong>K. Keadaan Umum</strong>
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <span>Kesadaran :</span>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="V_29" name="V_29">
                            </div>
                            <div class="col-md-2">
                                <span>GCS</span>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">E :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_30" name="V_30" size="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">M :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_31" name="V_31" size="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">V :</div>
                                    </div>
                                    <input type="text" class="form-control" id="V_32" name="V_32" size="1">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center ">
                            <div class="col-md-9">
                                <span>Kondisi Umum : </span>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_1" name="T_038" value="1">
                                    <label class="form-check-label" for="T_038_1">Baik</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_2" name="T_038" value="2">
                                    <label class="form-check-label" for="T_038_2">Tampak sakit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_2" name="T_038" value="3">
                                    <label class="form-check-label" for="T_038_3">Sesak</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_2" name="T_038" value="4">
                                    <label class="form-check-label" for="T_038_4">Pucat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_2" name="T_038" value="5">
                                    <label class="form-check-label" for="T_038_5">Lemah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_2" name="T_038" value="6">
                                    <label class="form-check-label" for="T_038_6">Kejang</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="T_038_2" name="T_038" value="7">
                                    <label class="form-check-label" for="T_038_7">Lainnya:</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" id="V_34" name="V_34">
                            </div>
                        </div>
                        <div class="row align-items-center">

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">TD</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_39" name="T_39" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">/</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_40" name="T_40" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">mmHg</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">N</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_41" name="T_41" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">x/menit</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">S</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_42" name="T_42" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">°C</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_43" name="T_43" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">x/menit</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-auto">
                                <label class="sr-only" for="inlineFormInputGroup"></label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">SpO2</div>
                                    </div>
                                    <input type="text" class="form-control" id="T_44" name="T_44" size="1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>L. Pemeriksaan Fisik</strong>
                        <div class="row align-items-center md-2" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Kepala</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_045_1" name="T_045" value="1">
                                <label for="T_045_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_045_2" name="T_045" value="2">
                                <label for="T_045_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_35" name="V_35">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Mata</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_046_1" name="T_046" value="1">
                                <label for="T_046_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_046_2" name="T_046" value="2">
                                <label for="T_046_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_36" name="V_36">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Telinga</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_047_1" name="T_047" value="1">
                                <label for="T_047_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_047_2" name="T_047" value="2">
                                <label for="T_047_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_37" name="V_37">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Hidung</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_048_1" name="T_048" value="1">
                                <label for="T_048_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_048_2" name="T_048" value="2">
                                <label for="T_048_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_38" name="V_38">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Tenggorok</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_049_1" name="T_049" value="1">
                                <label for="T_049_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_049_2" name="T_049" value="2">
                                <label for="T_049_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_39" name="V_39">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Leher</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_050_1" name="T_050" value="1">
                                <label for="T_050_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_050_2" name="T_050" value="2">
                                <label for="T_050_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_40" name="V_40">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Dada</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_051_1" name="T_051" value="1">
                                <label for="T_051_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_051_2" name="T_051" value="2">
                                <label for="T_051_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_41" name="V_41">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Jantung</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_052_1" name="T_052" value="1">
                                <label for="T_052_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_052_2" name="T_052" value="2">
                                <label for="T_052_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_42" name="V_42">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Paru-paru</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_053_1" name="T_053" value="1">
                                <label for="T_053_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_053_2" name="T_053" value="2">
                                <label for="T_053_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_43" name="V_43">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Perut</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_054_1" name="T_054" value="1">
                                <label for="T_054_1" class="form-check-label">Normal</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_054_2" name="T_054" value="2">
                                <label for="T_054_2" class="from-check-label">Kelainan</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_44" name="V_44">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Anggota gerak atas</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_055_1" name="T_055" value="1">
                                <label for="T_055_1" class="form-check-label">Oedema</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_055_2" name="T_055" value="2">
                                <label for="T_055_2" class="from-check-label">Tidak Oedema</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_45" name="V_45">
                            </div>
                        </div>
                        <div class="row align-items-center" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <span>Anggota gerak bawah</span>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_056_1" name="T_056" value="1">
                                <label for="T_056_1" class="form-check-label">Oedema</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" class="form-check-input" id="T_056_2" name="T_056" value="2">
                                <label for="T_056_2" class="from-check-label">Tidak Oedema</label>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_46" name="V_46">
                            </div>
                        </div>
                        <strong>M. Alat Yang Terpasang</strong>
                        <div class="row align-items-center">
                            <div class="col" style="margin-left: 20px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_057_1" name="T_057" value="1">
                                    <label class="form-check-label" for="T_057_1">O2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_058_1" name="T_058" value="1">
                                    <label class="form-check-label" for="T_058_1">Infus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_059_1" name="T_059" value="1">
                                    <label class="form-check-label" for="T_059_1">DC</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_060_1" name="T_060" value="1">
                                    <label class="form-check-label" for="T_060_1">NGT</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="T_061_1" name="T_061" value="1">
                                    <label class="form-check-label" for="T_061_1">Lainnya:</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="V_47" name="V_47">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="text-end">
                <div class="row">
                    <div class="col" style="margin-right: 40px;">
                        <p>
                            Surakarta,
                            <input type="text" id="V_48" name="V_48">
                        </p>
                    </div>
                </div>
                <p style="margin-right: 70px;">Perawat yang mengkaji</p>
                <div class="row">
                    <div class="col">
                        <label>Dinas:</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="T_062" id="T_062_1" value="1">
                            <label class="form-check-label" for="T_062_1">Pagi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="T_062" id="T_062_2" value="2">
                            <label class="form-check-label" for="T_062_2">Sore</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="T_062" id="T_062_3" value="3">
                            <label class="form-check-label" for="T_062_3">Malam</label>
                        </div>
                        <label>Jam:</label>
                        <input type="time">
                    </div>
                </div>
                <div class="mb-3" style="margin-right: 70px;">
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD">
                </div>
                <div class="mb-3" style="margin-right: 50px;">
                    <input type="text" id="V_49" name="V_49">
                </div>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    var i = 30;
    var canvas = 2;
    var TTD = 2;

    function addrow1(tableID) {

        i1 = i + 1;
        i2 = i + 2;
        i3 = i + 3;
        canvas1 = canvas + 1;
        TTD1 = TTD + 1

        $("#" + tableID).append($("<tr >")
            .append($("<td>").html('<input type="date" class="form-control" id="V_' + i + '" name="V_' + i + '" >'))
            .append($("<td>").html('<textarea class="form-control" name="V_' + i1 + '" id="V_' + i1 + '" rows="5" ></textarea>'))
            .append($("<td>").html('<textarea class="form-control" name="V_' + i2 + '" id="V_' + i2 + '" rows="5" ></textarea>'))
            .append($("<td class='text-center'>").html('<canvas width="150" height="90" style="border:1px solid #000;" id="canvas' + canvas1 + '"></canvas><input type="hidden" class="form-control" id="TTD_' + TTD1 + '"><br><input type="text" class="form-control"  id="V_' + i3 + '" name="V_' + i3 + '"></div>'))
        )

        i += 4;


    }
</script>
<script>
    var canvas = document.getElementById('canvas');
    const canvasDataInput = document.getElementById('TTD');
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
    const canvasDataInput1 = document.getElementById('TTD_1');
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
<script>
    var canvas2 = document.getElementById('canvas2');
    const canvasDataInput2 = document.getElementById('TTD_2');
    var context2 = canvas2.getContext('2d');
    var drawing = false;

    canvas2.addEventListener('mousedown', startDrawing);
    canvas2.addEventListener('mousemove', draw);
    canvas2.addEventListener('mouseup', stopDrawing);
    canvas2.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context2.lineWidth = 2;
        context2.lineCap = 'round';
        context2.strokeStyle = '#000';

        context2.lineTo(e.clientX - canvas2.getBoundingClientRect().left, e.clientY - canvas2.getBoundingClientRect().top);
        context2.stroke();
        context2.beginPath();
        context2.moveTo(e.clientX - canvas2.getBoundingClientRect().left, e.clientY - canvas2.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context2.beginPath();
    }

    function saveSignatureData2() {
        const canvasData2 = canvas2.toDataURL('image/png');

        canvasDataInput2.value = canvasData2;
    }
</script>
<script>
    var canvas3 = document.getElementById('canvas3');
    const canvasDataInput3 = document.getElementById('TTD_3');
    var context3 = canvas3.getContext('2d');
    var drawing = false;

    canvas3.addEventListener('mousedown', startDrawing);
    canvas3.addEventListener('mousemove', draw);
    canvas3.addEventListener('mouseup', stopDrawing);
    canvas3.addEventListener('mouseout', stopDrawing);

    function startDrawing(e) {
        drawing = true;
        draw(e);
    }

    function draw(e) {
        if (!drawing) return;

        context3.lineWidth = 2;
        context3.lineCap = 'round';
        context3.strokeStyle = '#000';

        context3.lineTo(e.clientX - canvas3.getBoundingClientRect().left, e.clientY - canvas3.getBoundingClientRect().top);
        context3.stroke();
        context3.beginPath();
        context3.moveTo(e.clientX - canvas3.getBoundingClientRect().left, e.clientY - canvas3.getBoundingClientRect().top);
    }

    function stopDrawing() {
        drawing = false;
        context3.beginPath();
    }

    function saveSignatureData3() {
        const canvasData3 = canvas3.toDataURL('image/png');

        canvasDataInput3.value = canvasData3;
    }
</script>

</html>