<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Assesment Early Warning Scoring System Dewasa</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>

</head>

<body>

    <div class="container mt-5">
        <a href="<?= base_url('pku/halamanform2') ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i></a>
        <form action="<?= site_url('#') ?>" method="post" autocomplete="off">
            <?php csrf_field(); ?>
            <h6 align="right">RM 3.3</h6>
            <table class="table table-bordered mb-0" style="border: 1px solid black">
                <tr>
                    <td align="center">
                        <img class="mt-2" src="<?= base_url('uploads/pku.png') ?>" width="90px">
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
                        <h5 class="text-center">EARLY WARNING SCORING SYSTEM (DEWASA)</h5>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered mb-0 mt-0 fw-bold" style="border: 1px solid black">
                <tr>
                    <td colspan="2" width="60%">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <strong><label>Tanggal</label></strong>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="date" name="v_01" id="v_01">
                            </div>
                        </div>
                    </td>
                    <td width="25%"></td>
                    <td width="15%" class="text-center"><strong>SKOR</strong></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <label>Jam</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control" type="time" name="v_02" id="v_02">
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="7" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Laju Respirasi / menit </td>
                    <td class="bg-info">
                        <= 5 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_0" value="0">
                    </td>
                    <td class="text-center bg-info">BLUE</td>
                </tr>
                <tr>
                    <td>6-8</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td>9-11</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>12-20</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>21-24</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>25-34</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td class="bg-info"> >= 35</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_0" value="0">
                    </td>
                    <td class="text-center bg-info">BLUE</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td rowspan="5" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Saturasi<br><br><br><br><br><br><br>Suplemen 02</td>
                    <td> >= 96</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>94-95</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>92-93</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>= 91</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td>%</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td rowspan="7" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Tekanan darah sistolik (mmHg)</td>
                    <td>>= 221 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_0" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td>181-220</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>111-130</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>101-100</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>91-100</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>71-90</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td class="bg-info">
                        <= 70</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_0" value="0">
                    </td>
                    <td class="text-center bg-info">BLUE</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td rowspan="7" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Laju Jantung /menit</td>
                    <td class="bg-info">≥ 141 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_0" value="0">
                    </td>
                    <td class="text-center bg-info">BLUE</td>
                </tr>
                <tr>
                    <td>131-140</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_3" value="3">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>111-130 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>91-110</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>51-90</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_0" value="0">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>41-50</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_1" value="1">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td class="bg-info">
                        <= 40</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_0" value="0">
                    </td>
                    <td class="text-center bg-info">BLUE</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td rowspan="3" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Kesadaran</td>
                    <td>Sadar </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_05" id="t_05_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>Nyeri/verbal</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_05" id="t_05_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td class="bg-info">Unrespon </td>
                    <td class="bg-info"></td>
                    <td class="bg-info"></td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td rowspan="5" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Suhu (°C)</td>
                    <td>
                        <= 35</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td>35.1-36</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>36.1-38</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>
                        < 38.1-39</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>>=39</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>

                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td colspan="2" class="text-center">TOTAL SKOR</td>
                    <td>

                    </td>
                    <td>
                        <input class="form-control" type="text" name="t_07" id="t_07" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td rowspan="3" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Parameter tambahan yang mendukung</td>
                    <td>Sadar </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="text" name="t_08" id="t_08">
                    </td>
                    <td class="text-center">GDS</td>
                </tr>
                <tr>
                    <td>Skor Nyeri</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <div class="container">
                            <input type="range" id="t_09" name="t_09" min="0" max="10" list="markers" value="0" style="width: 100%;" />
                            <datalist id="markers">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </datalist>
                        </div>
                    </td>
                    <td class="text-center">NPS</td>
                </tr>
                <tr>
                    <td>Unrespon</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="text" name="t_010" id="t_010">
                    </td>
                    <td class="text-center">Urin output</td>
                </tr>
            </table>
            <table class="table table-bordered mb-2 mt-0" style="border: 1px solid black">
                <tr class="bg-success">
                    <td>
                        <h6>SKOR 0 </h6>
                    </td>
                    <td>
                        <strong>
                            Kondisipasienstabildan sesuaidenganperawatan di bangsalumum. Monitoring dan evaluasi pasien per 8 jam
                        </strong>
                    </td>
                </tr>
                <tr class="bg-secondary">
                    <td>
                        <h6>SKOR 1-4 </h6>
                    </td>
                    <td>
                        <strong>
                            Assessment segeraolehperawat senior, responsegera, maks 5 menit, eskalasiperawatandanfrekuensi monitoring per 4-6 jam, Jikadiperlukan assessment olehdokterjagabangsal
                        </strong>
                    </td>
                </tr>
                <tr class="bg-warning">
                    <td>
                        <h6>Skor 5-6atau skor 3pada
                            1 parameter
                        </h6>
                    </td>
                    <td>
                        <strong>
                            Assessment segera oleh dokter jaga (respon segera, maks 5 menit), konsultasi DPJP dan spesialis terkait, eksalasi perawatan dan monitoring tiap jam, pertimbangkan perawatan dengan monitoring yang sesuai.
                        </strong>
                    </td>
                </tr>
                <tr class="bg-danger">
                    <td>
                        <h6>Skor 7 / Lebih / 1 Parameter Kriteria Blue (Resiko Tinggi)</h6>
                    </td>
                    <td>
                        <strong>
                            Resusitasi dan monitoring secara kontinyu oleh dokter jaga dan perawat senior, Aktivasi code blue kegawatanmedis, respon Tim Code Blue Sekunder segera, maksimal 10 menit, Informasikan dan konsultasikan ke DPJP.
                        </strong>
                    </td>
                </tr>
                <tr class="bg-info">
                    <td>
                        <h6>Henti Napas/Jantung</h6>
                    </td>
                    <td>
                        <strong>
                            Lakukan RJP olehpetugas/tim primer, aktivasi code blue henti jantung, respon Tim Code Blue Sekundersegera, maksimal 5 menit, informasikandankonsultasikan DPJP.
                        </strong>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>