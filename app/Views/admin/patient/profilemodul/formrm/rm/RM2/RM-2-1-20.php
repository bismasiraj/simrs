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
    <title>ASESMEN PASIEN KEMOTERAPI</title>
</head>

<body>
    <div class="container">
        <h6 style="text-align:right">RM.2.1.20</h6>
        <form action="" autocomplete="off" style="font-family:'Times New Roman'; vertical-align:middle">
            <h4 style="text-align: center"><b>REKAM MEDIS RAWAT INAP</b></h4>
            <table class="table table-bordered border-black">
                <tr>
                    <td colspan="3">
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
                    <td colspan="3">
                        <h4 style="text-align:center; margin-top:0px"><b>ASESMEN PASIEN KEMOTERAPI</b></h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Beri tanda checklist (√) pada kolom yang anda anggap sesuai</td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <label for="V_01" class="col-sm-auto col-form-label">Tanggal :</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="V_01" name="V_01">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <label for="V_02" class="col-sm-auto col-form-label">Jam :</label>
                            <div class="col-sm-6">
                                <input type="time" class="form-control" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <label for="V_03" class="col-sm-auto col-form-label">DPJP :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="V_03" name="V_03">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="V_04" class="col-sm-auto col-form-label">Kemoterapi ke Siklus ke:</label>
                    </td>
                    <td colspan="2">
                        <input type="text" class="form-control" id="V_04" name="V_04">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="V_05" class="col-sm-auto col-form-label">Diagnosa:</label>
                    </td>
                    <td colspan="2">
                        <input type="text" class="form-control" id="V_05" name="V_05">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">ANAMNESIS DAN PEMERIKSAAN FISIK</div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_06" class="col-sm-auto col-form-label">1. Keluhan utama:</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_06" name="V_06">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_07" class="col-sm-auto col-form-label">2. Riwayat khemoterapi sebelumnya: </label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_07" name="V_07">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_08" class="col-sm-auto col-form-label">3. Riwayat operasi:</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_08" name="V_08">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_09" class="col-sm-auto col-form-label">4. Riwayat penyakit dahulu (keluarga):</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_09" name="V_09">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="V_10" class="col-sm-auto col-form-label">5. Riwayat alergi obat:</label>
                            <div class="col">
                                <input type="text" class="form-control" id="V_10" name="V_10">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">6. Pemeriksaan Fisik</div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <div class="col-md-3">Keadaan umum</div>
                                <div class="col">:
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_01" id="T_01_0" value="0">
                                        <label class="form-check-label" for="T_01_0">baik</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_01" id="T_01_1" value="1">
                                        <label class="form-check-label" for="T_01_1">sedang</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_01" id="T_01_2" value="2">
                                        <label class="form-check-label" for="T_01_2">buruk</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_01" id="T_01_3" value="3">
                                        <label class="form-check-label" for="T_01_3">Lain-lain</label>
                                        <input type="text" id="V_11" name="V_11" style="width:130px">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-3">Tekanan darah</div>
                                <div class="col">
                                    : <input type="text" id="V_12" name="V_12" style="width:70px"> /
                                    <input type="text" id="V_13" name="V_13" style="width:70px"> mmHg
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-3">Nadi</div>
                                <div class="col">:
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_0" value="0">
                                        <label class="form-check-label" for="T_02_0">reguler</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_02" id="T_02_1" value="1">
                                        <label class="form-check-label" for="T_02_1">irreguler</label>
                                    </div>
                                    frekuensi: <input type="text" id="V_14" name="V_14" style="width:70px"> x/m
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-3">Respirasi</div>
                                <div class="col">:
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_03" id="T_03_0" value="0">
                                        <label class="form-check-label" for="T_03_0">normal</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="radio" name="T_03" id="T_03_1" value="1">
                                        <label class="form-check-label" for="T_03_1">dyspnea</label>
                                    </div>
                                    frekuensi: <input type="text" id="V_15" name="V_15" style="width:70px"> x/m
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-2">
                            <div class="col">RISIKO JATUH</div>
                        </div>
                        <table class="table table-bordered border-black mb-0">
                            <tr style="text-align:center">
                                <td colspan="2">ASESMEN FAKTOR RISIKO DEWASA</td>
                                <td style="width:10%">Nilai</td>
                                <td style="width:12%">Skor</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Riwayat jatuh tidak termasuk kecelakaan kerja dan lalu lintas</td>
                                <td style="width:40%">Tidak</td>
                                <td style="text-align:center">0</td>
                                <td rowspan="2" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_04" id="T_04" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="0">0</option>
                                        <option value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Ya</td>
                                <td style="text-align:center">25</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Diagnosis sekunder</td>
                                <td style="width:40%">Tidak</td>
                                <td style="text-align:center">0</td>
                                <td rowspan="2" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_05" id="T_05" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="0">0</option>
                                        <option value="15">15</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Ya</td>
                                <td style="text-align:center">15</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Menggunakan alat bantu</td>
                                <td>Tidak ada/ Bedrest/ Dibantu perawat</td>
                                <td style="text-align:center">0</td>
                                <td rowspan="3" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_06" id="T_06" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="0">0</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kruk/ tongkat</td>
                                <td style="text-align:center">15</td>
                            </tr>
                            <tr>
                                <td>Alat sekitar, misal: dinding, kursi, meja (perabot)</td>
                                <td style="text-align:center">30</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Gaya berjalan</td>
                                <td>Normal/ Bedrest/ kursi roda</td>
                                <td style="text-align:center">0</td>
                                <td rowspan="3" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_07" id="T_07" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="0">0</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Lemah</td>
                                <td style="text-align:center">10</td>
                            </tr>
                            <tr>
                                <td>Terganggu</td>
                                <td style="text-align:center">20</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Status mental</td>
                                <td style="width:40%">Menyadari kemampuan</td>
                                <td style="text-align:center">0</td>
                                <td rowspan="2" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_08" id="T_08" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="0">0</option>
                                        <option value="20">20</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Dimensia (lupa)/ agitasi/ konfius (gelisah)</td>
                                <td style="text-align:center">20</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Menggunakan infus/ heparin (pengencer darah)</td>
                                <td style="width:40%">Tidak</td>
                                <td style="text-align:center">0</td>
                                <td rowspan="2" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_09" id="T_09" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="0">0</option>
                                        <option value="20">20</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Ya</td>
                                <td style="text-align:center">20</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Medikasi</td>
                                <td style="width:40%">Sedatif</td>
                                <td style="text-align:center">10</td>
                                <td rowspan="2" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_010" id="T_010" onchange="myFunction()">
                                        <option selected>Pilih</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Post anestesi umum atau regional dalam 24 jam terakhir</td>
                                <td style="text-align:center">20</td>
                            </tr>
                            <tr>
                                <td colspan="2">TOTAL SKOR</td>
                                <td style="text-align:center">170</td>
                                <td style="text-align:center">
                                    <input class="form-control" type="number" name="T_011" id="T_011" readonly>
                                </td>
                            </tr>
                        </table>
                        <div class="row mb-3">
                            <div class="col">Kategori :
                                <div class="form-check form-check-inline col-md-2">
                                    <input class="form-check-input" type="radio" name="T_012" id="T_012_0" value="0">
                                    <label class="form-check-label" for="T_012_0">Rendah, skor: 0-24</label>
                                </div>
                                <div class="form-check form-check-inline col-md-2">
                                    <input class="form-check-input" type="radio" name="T_012" id="T_012_1" value="1">
                                    <label class="form-check-label" for="T_012_1">Sedang, skor:25-44</label>
                                </div>
                                <div class="form-check form-check-inline col-md-2">
                                    <input class="form-check-input" type="radio" name="T_012" id="T_012_2" value="2">
                                    <label class="form-check-label" for="T_012_2">Tinggi, skor: ≥ 45</label>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered border-black mb-0">
                            <tr style="text-align:center">
                                <td colspan="2">ASESMEN FAKTOR RISIKO ANAK (Usia 0 - 14 Tahun )</td>
                                <td style="width:10%">Nilai</td>
                                <td style="width:12%">Skor</td>
                            </tr>
                            <tr>
                                <td rowspan="4">Usia</td>
                                <td style="width:45%">
                                    < 3 tahun </td>
                                <td style="text-align:center">4</td>
                                <td rowspan="4" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_013" id="T_013" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>3 - 7 tahun</td>
                                <td style="text-align:center">3</td>
                            </tr>
                            <tr>
                                <td>7 - 13 tahun</td>
                                <td style="text-align:center">2</td>
                            </tr>
                            <tr>
                                <td>> 13 tahun</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Jenis kelamin</td>
                                <td>Laki-laki</td>
                                <td style="text-align:center">2</td>
                                <td rowspan="2" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_014" id="T_014" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Perempuan</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td rowspan="4">Diagnosa</td>
                                <td>Diagnosa neurologi</td>
                                <td style="text-align:center">4</td>
                                <td rowspan="4" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_015" id="T_015" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Perubahan oksigenasi (respiratorik, dehidrasi, anemia, anoreksia, sinkop, pusing)</td>
                                <td style="text-align:center">3</td>
                            </tr>
                            <tr>
                                <td>Gangguan perilaku/ psikiatri</td>
                                <td style="text-align:center">2</td>
                            </tr>
                            <tr>
                                <td>Diagnosa lain</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Gangguan kognitif</td>
                                <td>Tidak menyadari keterbatasan dirinya</td>
                                <td style="text-align:center">3</td>
                                <td rowspan="3" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_016" id="T_016" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Lupakan keterbatasan</td>
                                <td style="text-align:center">2</td>
                            </tr>
                            <tr>
                                <td>Orientasi baik terhadap diri sendiri</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td rowspan="4">Faktor Lingkungan</td>
                                <td>Riwayat jatuh dari tempat tidur</td>
                                <td style="text-align:center">4</td>
                                <td rowspan="4" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_017" id="T_017" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Alat bantu/ diletakkan ditempat tidur (perabot)</td>
                                <td style="text-align:center">3</td>
                            </tr>
                            <tr>
                                <td>Diletakkan di tempat tidur</td>
                                <td style="text-align:center">2</td>
                            </tr>
                            <tr>
                                <td>Area di luar rumah sakit</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Respon terhadap pembedahan/ sedasi/ anestesi</td>
                                <td>Dalam 24 jam</td>
                                <td style="text-align:center">3</td>
                                <td rowspan="3" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_018" id="T_018" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Dalam 48 jam</td>
                                <td style="text-align:center">2</td>
                            </tr>
                            <tr>
                                <td>Kurang 48 jam atau tidak menjalani pembedahan</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Penggunaan medika mentosa</td>
                                <td>Multipel: sedatif, barbiturat, fenotiazin, antidepresan, pencahar, diuretik, narkotik</td>
                                <td style="text-align:center">3</td>
                                <td rowspan="3" style="text-align:center">
                                    <select class="form-select number" type="number" name="T_019" id="T_019" onchange="myFunction1()">
                                        <option selected>Pilih</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Penggunaan salah satu di atas</td>
                                <td style="text-align:center">2</td>
                            </tr>
                            <tr>
                                <td>Medikasi lain/ tidak ada medikasi</td>
                                <td style="text-align:center">1</td>
                            </tr>
                            <tr>
                                <td colspan="2">TOTAL SKOR</td>
                                <td style="text-align:center"></td>
                                <td style="text-align:center">
                                    <input class="form-control" type="number" name="T_020" id="T_020" readonly>
                                </td>
                            </tr>
                        </table>
                        <div class="row mb-3">
                            <div class="col">Kategori :
                                <div class="form-check form-check-inline col-md-2">
                                    <input class="form-check-input" type="radio" name="T_021" id="T_021_0" value="0">
                                    <label class="form-check-label" for="T_021_0">Rendah, skor: 0-24</label>
                                </div>
                                <div class="form-check form-check-inline col-md-2">
                                    <input class="form-check-input" type="radio" name="T_021" id="T_021_1" value="1">
                                    <label class="form-check-label" for="T_021_1">Sedang, skor:25-44</label>
                                </div>
                                <div class="form-check form-check-inline col-md-2">
                                    <input class="form-check-input" type="radio" name="T_021" id="T_021_2" value="2">
                                    <label class="form-check-label" for="T_021_2">Tinggi, skor: ≥ 45</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-2">
                            <div class="col">ASESMEN NYERI</div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-auto">Nyeri:</div>
                                <div class="col-md-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_022" id="T_022_0" value="0">
                                        <label class="form-check-label" for="T_022_0">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_022" id="T_022_1" value="1">
                                        <label class="form-check-label" for="T_022_1">Ya</label>
                                    </div>
                                </div>
                                <label for="V_16" class="col-sm-auto col-form-label">Bila ya, :</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="V_16" name="V_16">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-auto mt-2">Deskripsi nyeri:</div>
                                <div class="col">
                                    <table class="table table-bordered border-black mt-3" style="width:80%">
                                        <tr>
                                            <td style="width:7%">P</td>
                                            <td>
                                                <input type="text" class="form-control" id="V_17" name="V_17">
                                            </td>
                                            <td>Karakteristik nyeri</td>
                                        </tr>
                                        <tr>
                                            <td>Q</td>
                                            <td>
                                                <input type="text" class="form-control" id="V_18" name="V_18">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_023" id="T_023_0" value="0">
                                                    <label class="form-check-label" for="T_023_0">Tidak nyeri &nbsp;&nbsp;&nbsp; Skor : 0</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>R</td>
                                            <td>
                                                <input type="text" class="form-control" id="V_19" name="V_19">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_023" id="T_023_1" value="1">
                                                    <label class="form-check-label" for="T_023_1">Nyeri ringan &nbsp;&nbsp;&nbsp; Skor : 1-3</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td>
                                                <input type="text" class="form-control" id="V_20" name="V_20">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_023" id="T_023_2" value="2">
                                                    <label class="form-check-label" for="T_023_2">Nyeri sedang &nbsp;&nbsp;&nbsp; Skor : 4-6</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>T</td>
                                            <td>
                                                <input type="text" class="form-control" id="V_21" name="V_21">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_023" id="T_023_3" value="3">
                                                    <label class="form-check-label" for="T_023_3">Nyeri berat &nbsp;&nbsp;&nbsp; Skor : 7-10</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>
                                        Skala nyeri untuk pasien dewasa dan pasien sadar menggunakan <i>numeric scale,</i>
                                        untuk pasien dengan penurunan kesadaran dan anak < 9 tahun menggunakan <i>wong baker skale</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-2">
                            <div class="col">ASESMEN NUTRISI</div>
                        </div>
                        <div class="row">
                            <div class="col">a. Assesmen Nutrisi Pasien Dewasa <i>(Malnutrition Universal Scoring Tool)</i></div>
                        </div>
                        <div class="container">
                            <table class="table table-bordered border-black" style="width:90%">
                                <tr>
                                    <td style="text-align: center;">PENILAIAN</td>
                                    <td style="text-align: center; width:13%">SKOR</td>
                                    <td rowspan="5">
                                        Risiko malnutrisi :<br>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_024" id="T_024_0" value="0">
                                            <label class="form-check-label" for="T_024_0">Risiko rendah skor: 0</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_024" id="T_024_1" value="1">
                                            <label class="form-check-label" for="T_024_1">Risiko sedang skor: 1</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_024" id="T_024_2" value="2">
                                            <label class="form-check-label" for="T_024_2">Risiko tinggi skor: ≥2</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>IMT</td>
                                    <td>
                                        <select class="form-select number" type="number" name="T_025" id="T_025" onchange="myFunction2()">
                                            <option selected>Pilih</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Persentase kehilangan BB yang tidak diharapkan</td>
                                    <td>
                                        <select class="form-select number" type="number" name="T_026" id="T_026" onchange="myFunction2()">
                                            <option selected>Pilih</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Efek dari penyakit yang diderita</td>
                                    <td>
                                        <select class="form-select number" type="number" name="T_027" id="T_027" onchange="myFunction2()">
                                            <option selected>Pilih</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Skor</td>
                                    <td>
                                        <input class="form-control" type="number" name="T_028" id="T_028" readonly>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col">b. Assesmen Nutrisi Pasien anak</i></div>
                        </div>
                        <div class="container">
                            <table class="table table-bordered border-black" style="width:85%">
                                <tr>
                                    <td style="text-align: center;">Umur 0 - 60 bulan</td>
                                    <td style="text-align: center;" colspan="2">Umur 61 bulan - 18 tahun</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_029" id="T_029_0" value="0">
                                            <label class="form-check-label" for="T_029_0">Gizi buruk skor <-3 SD</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_030" id="T_030_0" value="0">
                                            <label class="form-check-label" for="T_030_0">Sangat kurus</label>
                                        </div>
                                    </td>
                                    <td>Skor: < -3 SD</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_029" id="T_029_1" value="1">
                                            <label class="form-check-label" for="T_029_1">Gizi kurang skor -3 SD s/d< -2S SD</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_030" id="T_030_1" value="1">
                                            <label class="form-check-label" for="T_030_1">Kurus</label>
                                        </div>
                                    </td>
                                    <td>Skor: -3 SD s/d <-2 SD</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_029" id="T_029_2" value="2">
                                            <label class="form-check-label" for="T_029_2">Gizi baik skor -2 SD s/d 2SD</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_030" id="T_030_2" value="2">
                                            <label class="form-check-label" for="T_030_2">Normal</label>
                                        </div>
                                    </td>
                                    <td>Skor: -2 SD s/d 1 Sd</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_029" id="T_029_3" value="3">
                                            <label class="form-check-label" for="T_029_3">Gizi lebih skor > 2 SD</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_030" id="T_030_3" value="3">
                                            <label class="form-check-label" for="T_030_3">Gemuk</label>
                                        </div>
                                    </td>
                                    <td>Skor: > 1 SD s/d 2 SD</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="T_030" id="T_030_4" value="4">
                                            <label class="form-check-label" for="T_030_4">Obesitas</label>
                                        </div>
                                    </td>
                                    <td>Skor: > 2 SD</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row mb-2">
                            <div class="col">PENGKAJIAN KHUSUS KEMOTERAPI</div>
                        </div>
                        <div class="row">
                            <div class="col">a. Tampilan menurut skala Karnofsky</div>
                        </div>
                        <table class="table table-bordered border-black mb-0" style="width:90%">
                            <tr>
                                <td>NILAI SKALA KARNOFSKY</td>
                                <td>KETERANGAN</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_031" id="T_031_0" value="0">
                                        <label class="form-check-label" for="T_031_0">90-100</label>
                                    </div>
                                </td>
                                <td>Aktivitas normal</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_031" id="T_031_1" value="1">
                                        <label class="form-check-label" for="T_031_1">70-80</label>
                                    </div>
                                </td>
                                <td>Ada keluhan tetapi masih aktif dan dapat mengurus diri sendiri</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_031" id="T_031_2" value="2">
                                        <label class="form-check-label" for="T_031_2">50-60</label>
                                    </div>
                                </td>
                                <td>Cukup aktif, namun kadang memerlukan bantuan</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_031" id="T_031_3" value="3">
                                        <label class="form-check-label" for="T_031_3">30-40</label>
                                    </div>
                                </td>
                                <td>Kurang aktif, perlu rawatan</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_031" id="T_031_4" value="4">
                                        <label class="form-check-label" for="T_031_4">10-20</label>
                                    </div>
                                </td>
                                <td>Tidak dapat meninggalkan tempat tidur, perlu rawat di rumah sakit</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="T_031" id="T_031_5" value="5">
                                        <label class="form-check-label" for="T_031_5">0-10</label>
                                    </div>
                                </td>
                                <td>Tidak sadar</td>
                            </tr>
                        </table>
                        <div class="row mb-3">
                            <div class="col">Pasien dapat dilakukan kemoterapi bila skala Karnofsky > 60</div>
                        </div>
                        <div class="row">
                            <div class="col">b. Sistem integumen</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_032" id="T_032" value="1">
                                        <label class="form-check-label" for="T_032">Bengkak</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_033" id="T_033" value="1">
                                        <label class="form-check-label" for="T_033">Flebitis</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_034" id="T_034" value="1">
                                        <label class="form-check-label" for="T_034">Ulkus</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_035" id="T_035" value="1">
                                        <label class="form-check-label" for="T_035">Kemerahan</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_036" id="T_036" value="1">
                                        <label class="form-check-label" for="T_036">Pigmentasi kulit</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_037" id="T_037" value="1">
                                        <label class="form-check-label" for="T_037">Perdarahan gusi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_038" id="T_038" value="1">
                                        <label class="form-check-label" for="T_038">Stomatitis</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_039" id="T_039" value="1">
                                        <label class="form-check-label" for="T_039">Gatal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">c. Sistem gastrointestinal</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_040" id="T_040" value="1">
                                        <label class="form-check-label" for="T_040">Mual dan muntah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_041" id="T_041" value="1">
                                        <label class="form-check-label" for="T_041">Diare</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_042" id="T_042" value="1">
                                        <label class="form-check-label" for="T_042">Konstipasi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_043" id="T_043" value="1">
                                        <label class="form-check-label" for="T_043">Anorexia</label>
                                    </div>
                                </div>
                                <div class="col">
                                    Frekuensi: <input type="text" id="V_22" name="V_22" style="width:90px">&nbsp;&nbsp;&nbsp;
                                    mulai : <input type="text" id="V_23" name="V_23" style="width:90px">&nbsp;&nbsp;&nbsp;
                                    durasi : <input type="text" id="V_24" name="V_24" style="width:90px"> berat/ ringan *
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_044" id="T_044" value="1">
                                        <label class="form-check-label" for="T_044">Jaundice</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_045" id="T_045" value="1">
                                        <label class="form-check-label" for="T_045">Nyeri abdomen kuadran atas kanan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_046" id="T_046" value="1">
                                        <label class="form-check-label" for="T_046">Anorexia</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">d. Sistem hematopoeic</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_047" id="T_047" value="1">
                                        <label class="form-check-label" for="T_047">Infeksi</label>
                                    </div>
                                    Anemia :
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_048" id="T_048" value="1">
                                        <label class="form-check-label" for="T_048">Batuk produktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_049" id="T_049" value="1">
                                        <label class="form-check-label" for="T_049">Pucat</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_050" id="T_050" value="1">
                                        <label class="form-check-label" for="T_050">Vertigo</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_051" id="T_051" value="1">
                                        <label class="form-check-label" for="T_051">Trombositopenia</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_052" id="T_052" value="1">
                                        <label class="form-check-label" for="T_052">Kapiler melambat</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_053" id="T_053" value="1">
                                        <label class="form-check-label" for="T_053">Lemah</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">e. Sistem respiratorik dan kardiovaskuler</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_054" id="T_054" value="1">
                                        <label class="form-check-label" for="T_054">Oedem</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_055" id="T_055" value="1">
                                        <label class="form-check-label" for="T_055">Dispneu</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_056" id="T_056" value="1">
                                        <label class="form-check-label" for="T_056">Ronkhi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_057" id="T_057" value="1">
                                        <label class="form-check-label" for="T_057">Hasil ECG :</label>
                                        <input type="text" id="V_25" name="V_25" style="width:90px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">f. Sistem neuromuskular</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_058" id="T_058" value="1">
                                        <label class="form-check-label" for="T_058">Parestesia</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_059" id="T_059" value="1">
                                        <label class="form-check-label" for="T_059">Lemah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_060" id="T_060" value="1">
                                        <label class="form-check-label" for="T_060">Menyeret kaki</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_061" id="T_061" value="1">
                                        <label class="form-check-label" for="T_061">Gangguan pendengaran</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_062" id="T_062" value="1">
                                        <label class="form-check-label" for="T_062">Gangguan mobilitas</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">g. Sistem genitourinaria</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col-md-2">BAK
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_063" id="T_063" value="1">
                                        <label class="form-check-label" for="T_063">Hematuri</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_064" id="T_064" value="1">
                                        <label class="form-check-label" for="T_064">Oliguri</label>
                                    </div>
                                </div>
                                <div class="col">
                                    Frekuensi: <input type="text" id="V_26" name="V_26" style="width:90px">&nbsp;&nbsp;&nbsp;
                                    Bau: <input type="text" id="V_27" name="V_27" style="width:90px">&nbsp;&nbsp;&nbsp;
                                    Warna: <input type="text" id="V_28" name="V_28" style="width:90px">&nbsp;&nbsp;&nbsp;
                                    Kekeruhan: <input type="text" id="V_29" name="V_29" style="width:90px">&nbsp;&nbsp;&nbsp;
                                    <br><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="T_065" id="T_065" value="1">
                                        <label class="form-check-label" for="T_065">Anuri</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">h. Psikologis</div>
                        </div>
                        <div class="container mb-1">
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline col-md-4">
                                        <input class="form-check-input" type="checkbox" name="T_066" id="T_066" value="1">
                                        <label class="form-check-label" for="T_066">Takut terhadap terapi/ tindakan / lingkungan</label>
                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_067" id="T_067" value="1">
                                        <label class="form-check-label" for="T_067">Cemas</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_068" id="T_068" value="1">
                                        <label class="form-check-label" for="T_068">Marah / tegang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_069" id="T_069" value="1">
                                        <label class="form-check-label" for="T_069">Sedih </label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_070" id="T_070" value="1">
                                        <label class="form-check-label" for="T_070">Menangis</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_071" id="T_071" value="1">
                                        <label class="form-check-label" for="T_071">Senang </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_072" id="T_072" value="1">
                                        <label class="form-check-label" for="T_072">Tidak mampu menahan diri</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_073" id="T_073" value="1">
                                        <label class="form-check-label" for="T_073">Rendah diri</label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_074" id="T_074" value="1">
                                        <label class="form-check-label" for="T_074">Gelisah </label>
                                    </div>
                                    <div class="form-check form-check-inline col-md-2">
                                        <input class="form-check-input" type="checkbox" name="T_075" id="T_075" value="1">
                                        <label class="form-check-label" for="T_075">Tenang </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="T_076" id="T_076" value="1">
                                        <label class="form-check-label" for="T_076">Mudah tersinggung</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">PEMERIKSAAN PENUNJANG (Laboratorium, radiologi, lain- lain):</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="V_30" id="V_30" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">DIAGNOSA KEPERAWATAN</div>
                        </div>
                        <div class="container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_077" id="T_077" value="1">
                                <label class="form-check-label" for="T_077">Kecemasan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_078" id="T_078" value="1">
                                <label class="form-check-label" for="T_078">Resiko terjadi infeksi berhubungan dengan neutropenia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_079" id="T_079" value="1">
                                <label class="form-check-label" for="T_079">Resiko perlukaan berhubungan dengan trombositopenia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_080" id="T_080" value="1">
                                <label class="form-check-label" for="T_080">Resiko cedera vaskuler </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_081" id="T_081" value="1">
                                <label class="form-check-label" for="T_081">Resiko gangguan perfusi jaringan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_082" id="T_082" value="1">
                                <label class="form-check-label" for="T_082">Resiko gangguan keseimbangan cairan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_083" id="T_083" value="1">
                                <label class="form-check-label" for="T_083">Resiko gangguan integritas mukosa mulut</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_084" id="T_084" value="1">
                                <label class="form-check-label" for="T_084">Resiko gangguan rasa nyaman akibat stomatitis</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_085" id="T_085" value="1">
                                <label class="form-check-label" for="T_085">Resiko gangguan komunikasi verbal akibat nyeri di mulut</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_086" id="T_086" value="1">
                                <label class="form-check-label" for="T_086">Resiko gangguan integritas kulit perineum akibat diare</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_087" id="T_087" value="1">
                                <label class="form-check-label" for="T_087">Resiko gangguan citra diri akibat alopesia</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_088" id="T_088" value="1">
                                <label class="form-check-label" for="T_088">Resiko disfungsi seksual akibat kemoterapi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="T_089" id="T_089" value="1">
                                <label class="form-check-label" for="T_089">Resiko ekstravasasi</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">INTERVENSI KEPERAWATAN(Rekapitulasi pre, intra dan post khemoterapi)</div>
                        </div>
                        <div class="container">
                            <table class="table table-bordered border-black">
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_090" id="T_090" value="1">
                                            <label class="form-check-label" for="T_090">Observasi tanda-tanda infeksi</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_091" id="T_091" value="1">
                                            <label class="form-check-label" for="T_091">Kaji pengetahuan pasien tentang infeksi</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_092" id="T_092" value="1">
                                            <label class="form-check-label" for="T_092">Kaji penyebab mual dan muntah</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_093" id="T_093" value="1">
                                            <label class="form-check-label" for="T_093">Jaga kebersihan klien</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_094" id="T_094" value="1">
                                            <label class="form-check-label" for="T_094">Berikan perawatan oral</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_095" id="T_095" value="1">
                                            <label class="form-check-label" for="T_095">Kaji tingkat kecemasan </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_096" id="T_096" value="1">
                                            <label class="form-check-label" for="T_096">Kaji penyebab kecemasan</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_097" id="T_097" value="1">
                                            <label class="form-check-label" for="T_097">Kaji persepsi klien</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_098" id="T_098" value="1">
                                            <label class="form-check-label" for="T_098">Beri informasi tentang diagnosis, tindakan, dan prognosis</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_099" id="T_099" value="1">
                                            <label class="form-check-label" for="T_099">Libatkan keluarga untuk menemani</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_100" id="T_100" value="1">
                                            <label class="form-check-label" for="T_100">Lakukan perawatan luka</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_101" id="T_101" value="1">
                                            <label class="form-check-label" for="T_101">Pertahankan lingkungan aseptik</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_102" id="T_102" value="1">
                                            <label class="form-check-label" for="T_102">Anjurkan klien untuk melaporkan nyeri yang dialami (lokasi, intensitas, kualitas, skala, waktu)</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_103" id="T_103" value="1">
                                            <label class="form-check-label" for="T_103">Anjurkan klien untuk melakukan manajemen nyeri konvensional</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_104" id="T_104" value="1">
                                            <label class="form-check-label" for="T_104">Kolaborasi dengan dokter untuk pengobatan nyeri</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="T_105" id="T_105" value="1">
                                            <label class="form-check-label" for="T_105">Observasi tanda-tanda ekstravasasi</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="row">
                            <div class="col">DIAGNOSA MEDIS :</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea class="form-control" name="V_31" id="V_31" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="row mb-5">
                <div class="col"></div>
                <div class="col-md-4" style="text-align:center">
                    Yang melakukan pengkajian<br>
                    <button class="btn btn-outline-success" type="button" onclick="clearCanvas()">Clear Signature</button><br>
                    <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                    <input type="hidden" name="TTD" id="TTD"><br>
                    ( <input type="text" id="V_32" name="V_32" style="width:200px; text-align: center;"> )
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
            $('#T_011').val(sum);
        };
    </script>
    <script>
        function myFunction1() {
            var sum = 0;
            $('select.number').each(function() {
                sum += Number($(this).val());
            });
            $('#T_020').val(sum);
        };
    </script>
    <script>
        function myFunction2() {
            var sum = 0;
            $('select.number').each(function() {
                sum += Number($(this).val());
            });
            $('#T_028').val(sum);
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
</body>

</html>