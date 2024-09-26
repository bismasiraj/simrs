<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>ASESMEN KEPERAWATAN RAWAT INAP PASIEN DEWASA</title>
</head>

<body>
    <form action="" autocomplete="off" style="vertical-align:middle; font-family:'Times New Roman'">
        <div class="container">
            <h6 style="text-align:right"><b>RM5.1</b></h6>
            <table class="table table-bordered border-black">
                <tr style="vertical-align:middle; margin:0px">
                    <td colspan="2">
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
                    <td colspan="2" style="text-align:center">
                        <h5><b>ASESMEN KEPERAWATAN RAWAT INAP PASIEN DEWASA</b></h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-3">Alergi</div>
                            <div class="col-4">
                                : <input class="form-check-input" type="radio" name="T_0" id="T_0_0" value="0">
                                <label class="form-check-label" for="T_0_0">Tidak Ada</label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="T_0" id="T_0_1" value="1">
                                <label class="form-check-label" for="T_0_1">Ya, Jelaskan</label>
                                <input type="text" id="V_01" name="V_01" style="width: 250px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <label for="V_01" class="col-sm-3 col-form-label">Masuk rawat inap tanggal </label>
                            <div class="col-auto">:</div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="V_01" name="V_01">
                            </div>
                            <label for="V_02" class="col-sm-1 col-form-label">Jam :</label>
                            <div class="col-sm-2">
                                <input type="time" class="form-control" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <label for="V_0" class="col-sm-auto col-form-label"><b>Keluhan Utama :</b></label>
                            <div class="col">
                                <textarea class="form-control" name="V_0" id="V_0" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <label for="V_0" class="col-sm-auto col-form-label"><b>Riwayat Penyakit Sekarang :</b></label>
                            <div class="col">
                                <textarea class="form-control" name="V_0" id="V_0" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row mb-1">
                            <label for="V_0" class="col-sm-auto col-form-label"><b>Riwayat Penyakit Dahulu :</b></label>
                            <div class="col">
                                <textarea class="form-control" name="V_0" id="V_0" rows="2"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col"><b>A. Skrining Gizi</b></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col">Asesmen Nutrisi Pasien Dewasa <i>(Malnutrition Universal Screening Tool)</i></div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-3">
                                    <label for="V_">TB :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 70px;"> Cm
                                </div>
                                <div class="col-3">
                                    <label for="V_">BB :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 70px;"> Kg
                                </div>
                                <div class="col-3">
                                    <label for="V_">LLA :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 70px;"> Cm
                                </div>
                            </div>
                            <table class="table table-bordered border-black">
                                <tr>
                                    <td style="text-align: center;"><b>PENILAIAN</b></td>
                                    <td style="text-align: center;"><b>SKOR</b></td>
                                    <td rowspan="5">
                                        <div class="row">
                                            <div class="col">Risiko Malnutrisi:</div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_0" value="0">
                                                    <label class="form-check-label" for="T_0_0">Risiko rendah, skor : 0</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_1" value="1">
                                                    <label class="form-check-label" for="T_0_1">Risiko sedang, skor: 1</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_2" value="2">
                                                    <label class="form-check-label" for="T_0_2">Risiko tinggi, skor: ≥2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>IMT</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Presentase Kehilangan BB yang tidak diharapkan</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Efek dari penyakit yang diderita</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total Skor</td>
                                    <td></td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col">Bila risiko malnutrisi sedang (skor 1) dan tinggi (skor ≥ 2) DPJP wajib konsul kepada ahli gizi</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col"><b>B. Skrining Nyeri</b></div>
                        </div>
                        <div class="container">
                            <div class="row mb-1">
                                <div class="col">
                                    Apakah pasien merasakan nyeri :
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_0" id="T_0_0" value="0">
                                        <label class="form-check-label" for="T_0_0">Tidak</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_0" id="T_0_1" value="1">
                                        <label class="form-check-label" for="T_0_1">Ya, bila ya lanjutkan penilaian : </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-4">
                                    Onset :
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_0" id="T_0_0" value="0">
                                        <label class="form-check-label" for="T_0_0">Akut</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="T_0" id="T_0_1" value="1">
                                        <label class="form-check-label" for="T_0_1">Kronik</label>
                                    </div>
                                </div>
                                <div class="col">Asesmen Nyeri dengan :</div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <label for="V_">P :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 100px;">
                                </div>
                                <div class="col-2">
                                    <label for="V_">Q :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 100px;">
                                </div>
                                <div class="col-2">
                                    <label for="V_">R :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 100px;">
                                </div>
                                <div class="col-2">
                                    <label for="V_">S :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 100px;">
                                </div>
                                <div class="col-2">
                                    <label for="V_">T :</label>
                                    <input type="text" id="V_0" name="V_0" style="width: 100px;">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col">
                                Asesmen ulang nyeri tiap :
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_0" value="0">
                                    <label class="form-check-label" for="T_0_0">Nyeri ringan tiap 8 jam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_1" value="1">
                                    <label class="form-check-label" for="T_0_1">Nyeri sedang tiap 4 jam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_2" value="2">
                                    <label class="form-check-label" for="T_0_2">Nyeri berat tiap 1 jam</label>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col">
                                Penatalaksanaan Nyeri :
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_0" value="0">
                                    <label class="form-check-label" for="T_0_0">Skala nyeri ringan penatalaksanaan dilakukan oleh perawat, bila tidak teratasi dilaporkan DPJP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_1" value="1">
                                    <label class="form-check-label" for="T_0_1">Skala nyeri sedang , dilaporkan DPJP</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_0" id="T_0_2" value="2">
                                    <label class="form-check-label" for="T_0_2">Skala nyeri berat ≥ 7 lapor pada DPJP, mengusulkan konsul pada tim nyeri</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-2"><b>C. Risiko Jatuh</b></div>
                            <div class="col-3">
                                <label for="V_">Skor : </label>
                                <input type="text" id="V_0" name="V_0" style="width: 200px;">
                            </div>
                            <div class="col">
                                <label for="V_">Kategori : </label>
                                <input type="text" id="V_0" name="V_0" style="width: 200px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <div class="col"><b>D. Skrining Fungsional - Indeks Barthel</b></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</body>

</html>