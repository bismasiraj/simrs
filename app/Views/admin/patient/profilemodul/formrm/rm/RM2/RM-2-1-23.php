<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <title>ASSESMEN GERIATRI RAWAT INAP</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RMJ 2.11</h6>
        <form action="" autocomplete="off">
            <h4 style="text-align: center; font-family:'Times New Roman';"><b>REKAM MEDIS RAWAT INAP</b></h4>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px; font-family:'Times New Roman'">
                    <td>
                        <div class="row">
                            <div class="col-md-3" style="text-align:center">
                                <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                                <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                            </div>
                            <div class="col">
                                <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                                <p>Semanggi RT 02/20 Pasar Kliwon Surakarta<br>
                                    Telp. ( 0271 ) 633894 Fax: 0271- 630229 <br>
                                    Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 style="text-align:center; margin-top:0px"><b>ASSESMEN GERIATRI RAWAT INAP</b></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label for="V_01" class="col-sm-auto col-form-label"><b>Tanggal :</b></label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="V_01" name="V_01">
                            </div>
                            <div class="col-sm-1"></div>
                            <label for="V_02" class="col-sm-1 col-form-label"><b>Jam :</b></label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row" style="text-align:justify">
                <div class="col">
                    <p>
                        <b>Assesment dilakukan pada pasien lanjut usia (≥60 tahun) dan dirawat dengan
                            diagnosis lebih dari satu mencangkup Sindrom Geriatri, yaitu :
                        </b>
                    </p>
                </div>
            </div>
            <table class="table table-bordered border-black">
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_01" name="T_01" value="1">
                            <label class="form-check-label" for="T_01">Demensia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_02" name="T_02" value="1">
                            <label class="form-check-label" for="T_02">Delirium</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_03" name="T_03" value="1">
                            <label class="form-check-label" for="T_03">Inkonintensia urin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_04" name="T_04" value="1">
                            <label class="form-check-label" for="T_04">Inkontinensia alvi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_05" name="T_05" value="1">
                            <label class="form-check-label" for="T_05">Riwayat jatuh</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_06" name="T_06" value="1">
                            <label class="form-check-label" for="T_06">Gangguan gait (berjalan)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_07" name="T_07" value="1">
                            <label class="form-check-label" for="T_07">Gangguan tidur</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_08" name="T_08" value="1">
                            <label class="form-check-label" for="T_08">Gangguan dengar </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_09" name="T_09" value="1">
                            <label class="form-check-label" for="T_09">Gangguan lihat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_010" name="T_010" value="1">
                            <label class="form-check-label" for="T_010">Osteopenia</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_011" name="T_011" value="1">
                            <label class="form-check-label" for="T_011">Malnutrisi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_012" name="T_012" value="1">
                            <label class="form-check-label" for="T_012">Gangguan makan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_013" name="T_013" value="1">
                            <label class="form-check-label" for="T_013">Ulkus dekubitus</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_014" name="T_014" value="1">
                            <label class="form-check-label" for="T_014">Riwayat pingsan</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_015" name="T_015" value="1">
                            <label class="form-check-label" for="T_015">Pandangan bergoyang (dizziness)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_016" name="T_016" value="1">
                            <label class="form-check-label" for="T_016">Polifarmasi (>5 obat rutin)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_017" name="T_017" value="1">
                            <label class="form-check-label" for="T_017">Self neglect (tidak ada yang mendampingi)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_018" name="T_018" value="1">
                            <label class="form-check-label" for="T_018">Elder abusa (kekerasan pada lansia)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_019" name="T_019" value="1">
                            <label class="form-check-label" for="T_019">Frality (ringkih)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_020" name="T_020" value="1">
                            <label class="form-check-label" for="T_020">Hipotermi dan hipertermi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_021" name="T_021" value="1">
                            <label class="form-check-label" for="T_021">Dehidrasi dan gangguan elektrolit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="T_022" name="T_022" value="1">
                            <label class="form-check-label" for="T_022">Iatrogenesis (penggnaan NGT, kateter, dll)</label>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <i><b>A. STATUS FUNGSIONAL (INDEKS ADL BARTHEL)</b></i>
            </div>
            <table class="table table-bordered border-black">
                <tr style="text-align: center;">
                    <td>Faktor Ketergantungan</td>
                    <td style="width: 15%;">Skor</td>
                    <td>Faktor Ketergantungan</td>
                    <td style="width: 15%;">Skor</td>
                </tr>
                <tr>
                    <td>1. Pesonal hyigiene</td>
                    <td><input type="text" class="form-control" id="V_03" name="V_03"></td>
                    <td>6. Memakai pakaian</td>
                    <td><input type="text" class="form-control" id="V_04" name="V_04"></td>
                </tr>
                <tr>
                    <td>2. Mandi</td>
                    <td><input type="text" class="form-control" id="V_05" name="V_05"></td>
                    <td>7. Kontrol BAK</td>
                    <td><input type="text" class="form-control" id="V_06" name="V_06"></td>
                </tr>
                <tr>
                    <td>3. Makan</td>
                    <td><input type="text" class="form-control" id="V_07" name="V_07"></td>
                    <td>8. Kontrol BAB</td>
                    <td><input type="text" class="form-control" id="V_08" name="V_08"></td>
                </tr>
                <tr>
                    <td>4. Toileting </td>
                    <td><input type="text" class="form-control" id="V_09" name="V_09"></td>
                    <td>9. Ambulasi menggunakan kruk</td>
                    <td><input type="text" class="form-control" id="V_10" name="V_10"></td>
                </tr>
                <tr>
                    <td>5. Menaiki tangga</td>
                    <td><input type="text" class="form-control" id="V_11" name="V_11"></td>
                    <td>10. Transfer kursi - tempat tidur</td>
                    <td><input type="text" class="form-control" id="V_12" name="V_12"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <label for="V_13" class="col-sm-8 col-form-label">Skor Total :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="V_13" name="V_13">
                            </div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="row">
                            <label for="V_14" class="col-sm-8 col-form-label">Kriteria :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="V_14" name="V_14">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row mb-1">
                <b>Kriteria :</b>
                <div class="col-md-3">
                    <p>
                        Mandiri<br>
                        Ketergantungan ringan<br>
                        Ketergantungan sedang<br>
                        Ketergantungan berat<br>
                        Total<br>
                    </p>
                </div>
                <div class="col">
                    <p>
                        : 20<br>
                        : 12 - 19<br>
                        : 9 - 11<br>
                        : 5 - 8<br>
                        : 0 - 4<br>
                    </p>
                </div>
            </div>
            <div class="row">
                <i><b>B. SKRINING RESIKO DEKUBITUS (SKALA NORTON)</b></i>
            </div>
            <table class="table table-bordered border-black mb-0" style="text-align: center;">
                <tr>
                    <td><b>PENILAIAN</b></td>
                    <td style="width:15%"><b>4</b></td>
                    <td style="width:15%"><b>3</b></td>
                    <td style="width:15%"><b>2</b></td>
                    <td style="width:15%"><b>1</b></td>
                    <td style="width:15%"><b>SKOR</b></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Kondisi fisik</td>
                    <td>Baik</td>
                    <td>Sedang</td>
                    <td>Buruk</td>
                    <td>Sangat buruk</td>
                    <td>
                        <select class="form-select number" type="number" name="T_023" id="T_023" onchange="myFunction()">
                            <option selected>Pilih</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Status mental</td>
                    <td>Sadar</td>
                    <td>Apatis</td>
                    <td>Bingung</td>
                    <td>Stupor</td>
                    <td>
                        <select class="form-select number" type="number" name="T_024" id="T_024" onchange="myFunction()">
                            <option selected>Pilih</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Aktivitas</td>
                    <td>Jalan sendiri</td>
                    <td>Jalan dengan bantuan</td>
                    <td>Kursi roda</td>
                    <td>Di tempat tidur</td>
                    <td>
                        <select class="form-select number" type="number" name="T_025" id="T_025" onchange="myFunction()">
                            <option selected>Pilih</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Mobilitas</td>
                    <td>Bebas bergerak</td>
                    <td>Agak terbatas</td>
                    <td>Sangat terbatas</td>
                    <td>Tidak mampu bergerak</td>
                    <td>
                        <select class="form-select number" type="number" name="T_026" id="T_026" onchange="myFunction()">
                            <option selected>Pilih</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">Inkontinensia</td>
                    <td>Kontinen</td>
                    <td>Kadang inkontinensia urin</td>
                    <td>Selalu inkontinensia urin</td>
                    <td>Inkontinensia urin dan alvi</td>
                    <td>
                        <select class="form-select number" type="number" name="T_027" id="T_027" onchange="myFunction()">
                            <option selected>Pilih</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"><b>TOTAL SKOR</b></td>
                    <td>
                        <input class="form-control" type="number" name="T_028" id="T_028" readonly>
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <div class="col-md-2">Keterangan :</div>
                <div class="col-md-2">
                    <P>
                        Skor 16 - 20<br>
                        Skor 12 - 15<br>
                        Skor > 12<br>
                    </P>
                </div>
                <div class="col">
                    <p>
                        Tidak ada resiko terjadi luka dekubitus<br>
                        Rentan terjadi luka dekubitus<br>
                        Resiko tinggi terjadi luka dekubitus
                    </p>
                </div>
            </div>
            <div class="row">
                <i><b>C. PENAPISAN DEPRESI</b></i>
            </div>
            <div class="row">
                <div class="col">
                    Untuk setiap pertanyaan di bawah ini, penjelasan mana yang paling dekat dengan perasaan yang anda rasakan bulan lalu ?
                </div>
            </div>
            <table class="table table-bordered border-black mb-0">
                <tr style="text-align:center; vertical-align:middle">
                    <td>Jenis Kegiatan</td>
                    <td style="width:10%">Setiap waktu</td>
                    <td style="width:10%">Sering sekali</td>
                    <td style="width:10%">Kadang-Kadang</td>
                    <td style="width:10%">Jarang sekali</td>
                    <td style="width:10%">Tidak pernah</td>
                </tr>
                <tr>
                    <td>
                        a. Berapa seringkah bulan yang lalu, kesehatan anda menghalangi kegiatan anda (mis. Mengunjungi teman dll)
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_029" id="T_029_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_029" id="T_029_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_029" id="T_029_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_029" id="T_029_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_029" id="T_029_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        b. Berapa seringkah bulan lalu anda merasa gugup?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_030" id="T_030_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_030" id="T_030_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_030" id="T_030_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_030" id="T_030_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_030" id="T_030_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        c. Berapa seringkah bulan lalu anda merasa tenang dan damai?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_031" id="T_031_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_031" id="T_031_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_031" id="T_031_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_031" id="T_031_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_031" id="T_031_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        d. Berapa seringkah bulan lalu anda merasa sedih sekali?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_032" id="T_032_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_032" id="T_032_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_032" id="T_032_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_032" id="T_032_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_032" id="T_032_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        e. Berapa seringkah bulan lalu anda merasa bahagia?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_033" id="T_033_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_033" id="T_033_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_033" id="T_033_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_033" id="T_033_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_033" id="T_033_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        f. Berapa seringkah bulan lalu anda terasa begitu sedih sampai merasa tak ada sesuatupun yang mungkin menghiburnya ?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_034" id="T_034_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_034" id="T_034_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_034" id="T_034_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_034" id="T_034_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_034" id="T_034_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        g. Selama bulan lalu, berapa seringnya perasaan depresi anda menganggu kerja anda sehari-hari
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_035" id="T_035_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_035" id="T_035_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_035" id="T_035_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_035" id="T_035_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_035" id="T_035_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        h. Selama bulan lalu, berapa sering anda merasa tak ada lagi sesuatu yang anda harapkan lagi
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_036" id="T_036_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_036" id="T_036_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_036" id="T_036_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_036" id="T_036_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_036" id="T_036_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        i. Selama bulan lalu, berapa sering anda merasa tidak diperhatikan keluarga?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_037" id="T_037_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_037" id="T_037_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_037" id="T_037_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_037" id="T_037_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_037" id="T_037_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        j. Berapa sering selama bulan lalu anda merasa ingin menangis saja?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_038" id="T_038_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_038" id="T_038_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_038" id="T_038_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_038" id="T_038_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_038" id="T_038_4" value="4">
                    </td>
                </tr>
                <tr>
                    <td>
                        k. Selama bulan lalu, berapa sering anda merasa bahwa hidup ini sudah tak ada gunanya lagi?
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_039" id="T_039_0" value="0">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_039" id="T_039_1" value="1">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_039" id="T_039_2" value="2">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_039" id="T_039_3" value="3">
                    </td>
                    <td style="text-align:center; vertical-align:middle">
                        <input class="form-check-input" type="radio" name="T_039" id="T_039_4" value="4">
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <div class="col">
                    Jawaban setiap waktu atau sering sekali harus mengarah kecurigaan adanya depresi (kecuali jawaban c dan e).
                </div>
            </div>
            <div class="row">
                <i><b>D. PENGKAJIAN STATUS MENTAL GERONTIK (diisi jika pasien sadar / compos mentis)</b></i>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <p>
                        Identifikasi tingkat kerusakan intelektual dengan menggunakan <i><b>Short Portable Mental Status Questionnaire (SPMSQ)</b></i>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Instruksi : ajukan pertanyaan 1-10 pada daftar ini dan catat semua jawaban. Catat jumlah kesalahan total berdasarkan 10 pertanyaan
                </div>
            </div>
            <table class="table table-bordered border-black mb-1" style="text-align:center;">
                <tr>
                    <td style="width:5%"><b>NO</b></td>
                    <td><b>PERTANYAAN</b></td>
                    <td style="width:10%"><b>BENAR</b></td>
                    <td style="width:10%"><b>SALAH</b></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td style="text-align:left;">Tanggal berapa hari ini?</td>
                    <td><input class="form-check-input" type="radio" name="T_040" id="T_040_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_040" id="T_040_1" value="1"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td style="text-align:left;">Hari apa sekarang ini?</td>
                    <td><input class="form-check-input" type="radio" name="T_041" id="T_041_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_041" id="T_041_1" value="1"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td style="text-align:left;">Apa nama tempat ini?</td>
                    <td><input class="form-check-input" type="radio" name="T_042" id="T_042_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_042" id="T_042_1" value="1"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td style="text-align:left;">
                        a. Berapa no. Telp anda?<br>
                        b. Dimana alamat anda (tanyakan bila tidak memiliki telp)?
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" name="T_043" id="T_043_0" value="0"><br>
                        <input class="form-check-input" type="radio" name="T_044" id="T_044_0" value="0">
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" name="T_043" id="T_043_1" value="1"><br>
                        <input class="form-check-input" type="radio" name="T_044" id="T_044_1" value="1">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td style="text-align:left;">Berapa umur anda?</td>
                    <td><input class="form-check-input" type="radio" name="T_045" id="T_045_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_045" id="T_045_1" value="1"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td style="text-align:left;">Kapan anda lahir? (min.tahun lahir)</td>
                    <td><input class="form-check-input" type="radio" name="T_046" id="T_046_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_046" id="T_046_1" value="1"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td style="text-align:left;">Siapa presiden Indonesia sekarang?</td>
                    <td><input class="form-check-input" type="radio" name="T_047" id="T_047_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_047" id="T_047_1" value="1"></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td style="text-align:left;">Siapa presiden sebelumnya?</td>
                    <td><input class="form-check-input" type="radio" name="T_048" id="T_048_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_048" id="T_048_1" value="1"></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td style="text-align:left;">Siapa nama kecil ibu anda?</td>
                    <td><input class="form-check-input" type="radio" name="T_049" id="T_049_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_049" id="T_049_1" value="1"></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td style="text-align:left;">Kurangi 3 angka dari 20, dan pengurangan 3 dari setiap angka baru, semua secara menurun</td>
                    <td><input class="form-check-input" type="radio" name="T_050" id="T_050_0" value="0"></td>
                    <td><input class="form-check-input" type="radio" name="T_050" id="T_050_1" value="1"></td>
                </tr>
                <tr>
                    <td colspan="2"><b>TOTAL SKOR</b></td>
                    <td><input class="form-control" type="number" id="T_051" name="T_051"></td>
                    <td><input class="form-control" type="number" id="T_052" name="T_052"></td>
                </tr>
            </table>
            <div class="row">
                <div class="col"><b>Keterangan : </b></div>
            </div>
            <div class="row mb-0">
                <div class="col-md-3">
                    <p>
                        1. Kesalahan 0 - 3<br>
                        2. Kesalahan 4 - 5<br>
                        3. Kesalahan 6 - 8<br>
                        4. Kesalahan 9 - 10
                    </p>
                </div>
                <div class="col">
                    <p>
                        : Fungsi intelektual utuh<br>
                        : Kerusakan intelektual ringan<br>
                        : Kerusakan intelektual sedang<br>
                        : Kerusakan intelektual berat
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    Jika ditemukan kerusakan intelektual sedang - berat, maka edukasi diberikan kepada keluarga atau penanggung jawab.
                </div>
            </div>
            <div class="row">
                <i><b>E. SKRINING NUTRISI (MNA / MINI NUTRITIONAL ASSESMENT)</b></i>
            </div>
            <table class="table table-bordered border-black mb-0" style="text-align:center">
                <tr>
                    <td style="width:5%"><b>NO</b></td>
                    <td><b>PERTANYAAN</b></td>
                    <td style="width:15%"><b>SKOR</b></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td style="text-align:left">
                        <p>
                            Apakah ada penurunan asupan makanan dalam jangka waktu 3 bulan karena kehilangan nafsu makan, masalah pencernaan, kesulitan menelan atau mengunyah?<br>
                            0 = nafsu makan sangat berkurang<br>
                            1 = nafsu makan sedikit berkurang (sedang)<br>
                            2 = nafsu makan biasa saja
                        </p>
                    </td>
                    <td style="vertical-align:middle">
                        <select class="form-select number" type="number" name="T_053" id="T_053" onchange="myFunction1()">
                            <option selected>Pilih</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td style="text-align:left">
                        <p>
                            Penurunan berat badan dalam 3 bulan terakhir<br>
                            0 = penurunan BB >3 kg<br>
                            1 = tidak tahu<br>
                            2 = penurunan BB 1 - 3 kg<br>
                            3 = tidak ada penurunan BB
                        </p>
                    </td>
                    <td style="vertical-align:middle">
                        <select class="form-select number" type="number" name="T_054" id="T_054" onchange="myFunction1()">
                            <option selected>Pilih</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td style="text-align:left">
                        <p>
                            Mobilitas :<br>
                            0 = harus berbaring di tempat tidur atau menggunakan kursi roda<br>
                            1 = bisa turun dari tempat tidur / kursi roda tetapi tidak bisa keluar rumah<br>
                            2 = bisa keluar rumah
                        </p>
                    </td>
                    <td style="vertical-align:middle">
                        <select class="form-select number" type="number" name="T_055" id="T_055" onchange="myFunction1()">
                            <option selected>Pilih</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td style="text-align:left">
                        <p>
                            Menderita stres psikologis / penyakit akut dalam 3 bulan terakhir?<br>
                            0 = ya<br>
                            2 = tidak
                        </p>
                    </td>
                    <td style="vertical-align:middle">
                        <select class="form-select number" type="number" name="T_056" id="T_056" onchange="myFunction1()">
                            <option selected>Pilih</option>
                            <option value="0">0</option>
                            <option value="2">2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td style="text-align:left">
                        <p>
                            Masalah neuropsikologis<br>
                            0 = demensia berat atau depresi berat<br>
                            1 = demensia ringan<br>
                            2 = tidak ada masalah psikologis
                        </p>
                    </td>
                    <td style="vertical-align:middle">
                        <select class="form-select number" type="number" name="T_057" id="T_057" onchange="myFunction1()">
                            <option selected>Pilih</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td style="text-align:left">
                        <p>
                            Indeks massa tubuh (IMT) : BB (kg) / TB (m2)<br>
                            0 = IMT < 19<br>
                                1 = IMT 19 - < 21<br>
                                    2 = IMT 21 - < 23<br>
                                        3 = IMT 23 atau lebih
                        </p>
                    </td>
                    <td style="vertical-align:middle">
                        <select class="form-select number" type="number" name="T_058" id="T_058" onchange="myFunction1()">
                            <option selected>Pilih</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>TOTAL SKOR</b></td>
                    <td>
                        <input class="form-control" type="number" name="T_059" id="T_059" readonly>
                    </td>
                </tr>
            </table>
            <div class="row mb-3">
                <div class="col">
                    <p>
                        • Skor penapisan ( subtotal maksimum 14 poin)<br>
                        • Skor ≥ 12 : normal, tidak beresiko, tidak perlu melengkapi form pengkajin<br>
                        • Skor ≤ 11 : kemungkinan malnutrisi, lanjutkan pengkajian oleh petugas gizi klinik
                    </p>
                </div>
            </div>
            <div class="row" style="text-align:center">
                <b>SKALA RESIKO JATUH FORSE MORSE</b>
            </div>
            <table class="table table-bordered border-black mb-0">
                <tr style="text-align:center; vertical-align:middle">
                    <td style="width:5%" rowspan="2"><b>No</b></td>
                    <td style="width:25%" rowspan="2"><b>Resiko</b></td>
                    <td style="width:auto" rowspan="2"><b>Skala</b></td>
                    <td style="width:auto" rowspan="2"><b>Nilai</b></td>
                    <td style="width:auto">
                        <b>Hari/ tgl:</b>
                        <input type="date" name="V_15" id="V_15" style="width:120px">
                    </td>
                    <td style="width:auto">
                        <b>Hari/ tgl:</b>
                        <input type="date" name="V_16" id="V_16" style="width:120px">
                    </td>
                    <td style="width:auto">
                        <b>Hari/ tgl:</b>
                        <input type="date" name="V_17" id="V_17" style="width:120px">
                    </td>
                    <td style="width:auto">
                        <b>Hari/ tgl:</b>
                        <input type="date" name="V_18" id="V_18" style="width:120px">
                    </td>
                </tr>
                <tr style="text-align:center">
                    <td><b>Skor</b></td>
                    <td><b>Skor</b></td>
                    <td><b>Skor</b></td>
                    <td><b>Skor</b></td>
                </tr>
                <tr>
                    <td rowspan="2">1</td>
                    <td>Riwayat jatuh : apakah pernah jatuh dalam 3 bulan terakhir?</td>
                    <td>Tidak</td>
                    <td>0</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ya</td>
                    <td>25</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td rowspan="2">2</td>
                    <td>Diagnosa sekunder: apakah memiliki lebih dari satu penyakit?</td>
                    <td>Tidak</td>
                    <td>0</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ya</td>
                    <td>15</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td rowspan="4">3</td>
                    <td><b>Alat bantu jalan</b></td>
                    <td></td>
                    <td></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Bed rest/ dibantu perawat</td>
                    <td></td>
                    <td>0</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Kruk/tongkat/walker</td>
                    <td></td>
                    <td>15</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Berpegangan pada benda-benda di sekitar (kursi, meja, lemari)</td>
                    <td></td>
                    <td>30</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td rowspan="2">4</td>
                    <td>Terapi inta vena : apakah saat ini terpasang infuse?</td>
                    <td>Tidak</td>
                    <td>0</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Ya</td>
                    <td>20</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td rowspan="4">5</td>
                    <td><b>Gaya berjalan/ cara pindah</b></td>
                    <td></td>
                    <td></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Normal/ bed rest/ immobile</td>
                    <td></td>
                    <td>0</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Lemah (tidak bertenaga)</td>
                    <td></td>
                    <td>10</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Gangguan/tidak normal (pincang /diseret)</td>
                    <td></td>
                    <td>20</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td rowspan="3">6</td>
                    <td><b>Status mental</b></td>
                    <td></td>
                    <td></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Menyadari kondisi dirinya</td>
                    <td></td>
                    <td>0</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td>Mengalami keterbatasan daya ingat</td>
                    <td></td>
                    <td>15</td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center">Jumlah skor Forse Morse</td>
                    <td></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                    <td style="vertical-align:middle"></td>
                </tr>
            </table>
            <div class="row mb-5">
                <div class="col">
                    <div class="row">
                        <div class="col">Tingkat resiko ditentukan dengan cara:</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2" style="text-align:right">
                            Skor 0-24 : <br>
                            25-44 : <br>
                            ≥45 : <br>
                        </div>
                        <div class="col">
                            Resiko Rendah<br>
                            Resiko Sedang<br>
                            Resiko tinggi (memakai gelang Orange)<br>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="text-align:center">
                    <label for="V_19">Dokter / Perawat :</label><br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas><br>
                    <input type="hidden" name="TTD" id="TTD">
                    ( <input type="text" id="V_19" name="V_19" style="width:200px"> )
                </div>
            </div>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px; font-family:'Times New Roman'">
                    <td>
                        <div class="row">
                            <div class="col-md-3" style="text-align:center">
                                <img src="\img\logo_PKU.png" alt="" style="width:90px"><br>
                                <p>SEHAT AMANAH<br>Tanggungjawab-Islami</p>
                            </div>
                            <div class="col">
                                <h4><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h4>
                                <p>Semanggi RT 02/20 Pasar Kliwon Surakarta<br>
                                    Telp. ( 0271 ) 633894 Fax: 0271- 630229 <br>
                                    Jawa Tengah 57117
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="container" style="height:150px; border: 1px solid black; border-radius:5px">
                                    <h5 style="text-align:center; margin-top:60px">Label Identitas Pasien</h5>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4 style="text-align:center; margin-bottom:5px"><b>REKAPITULASI ASESMEN</b></h4>
                        <div class="row">
                            <label for="V_20" class="col-sm-auto col-form-label">Rekapitulasi Asesmen dibuat tanggal :</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="V_20" name="V_20">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                I. DIAGNOSIS (NO. ICIDH)
                                <textarea class="form-control" name="V_21" id="V_21" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                II. IMPAIRMENT (NO. ICIDH)
                                <textarea class="form-control" name="V_22" id="V_22" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                III. DISABILITY (NO. ICIDH)
                                <textarea class="form-control" name="V_23" id="V_23" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                IV. HANDICAP (NO. ICIDH)
                                <textarea class="form-control" name="V_24" id="V_24" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                V. REKOMENDASI
                                <textarea class="form-control" name="V_25" id="V_25" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col" style="text-align:center">
                                Ketua Tim,<br>
                                <button class="btn btn-outline-success" type="button" onclick="clearCanvas1()">Clear Signature</button><br>
                                <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_1" id="TTD_1"><br>
                                ( <input type="text" id="V_26" name="V_26" style="width:250px; text-align: center;"> )<br>
                                Nama dan tanda tangan
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col">
                    <p>
                        <i>
                            Keterangan :<br>
                            ICD : International Classification of Diseases X, 1994<br>
                            ICIDH : International Classification of Impairment, Disability and Handicaps (WHO), 1980
                        </i>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <script>
        function myFunction() {
            var sum = 0;
            $('select.number').each(function() {
                sum += Number($(this).val());
            });
            $('#T_028').val(sum);
        };
    </script>
    <script>
        function myFunction1() {
            var sum = 0;
            $('select.number').each(function() {
                sum += Number($(this).val());
            });
            $('#T_059').val(sum);
        };
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

        function clearCanvas() {
            context.clearRect(0, 0, canvas.width, canvas.height);
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

        function clearCanvas1() {
            context1.clearRect(0, 0, canvas1.width, canvas1.height);
        }

        function saveSignatureData1() {
            const canvasData1 = canvas1.toDataURL('image/png');

            canvasDataInput1.value = canvasData1;
        }
    </script>
</body>

</html>