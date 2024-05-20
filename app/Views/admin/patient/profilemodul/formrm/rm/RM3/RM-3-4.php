<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>DIAGNOSA DEFISIT PERAWATAN DIRI</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
                        <h5 class="text-center">EARLY WARNING SCORING SYSTEM (ANAK)</h5>
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
                    <td rowspan="4" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Laju Respirasi / menit</td>
                    <td class="bg-info"> > 25 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td>21-25 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>12-20 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td> ˂ 12</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_01" id="t_01_3" value="3">
                    </td>
                    <td class="text-center">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="4" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Saturasi <br><br><br><br><br> Suplemen O2</td>
                    <td>> 95</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>92-95 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td class="bg-info">˂ 92</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_02" id="t_02_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
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
                    <td rowspan="4" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Suhu(°C)</td>
                    <td class="bg-info">> 37.7 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td>37.3 – 37.7</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>36.1 – 37.2 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td class="bg-info">˂ 36</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_03" id="t_03_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="5" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Tekanan darah Sistolik (mmHg)</td>
                    <td class="bg-info">> 160 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td>151-160 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>141-150 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>90-140</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td class="bg-info">˂ 90</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_04" id="t_04_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="4" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Tekanan darah Diastolik (mmHg)</td>
                    <td class="bg-info">> 110 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_05" id="t_05_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td>101-160 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_05" id="t_05_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>90-100 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_05" id="t_05_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>˂ 90</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_05" id="t_05_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="6" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Laju Jantung /menit</td>
                    <td class="bg-info">> 120 </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td>111-120 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td>101-110 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_1" value="1">
                    </td>
                    <td class="text-center">1</td>
                </tr>
                <tr>
                    <td>61-100 </td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_0" value="0">
                    </td>
                    <td class="text-center">0</td>
                </tr>
                <tr>
                    <td>50-60</td>
                    <td class="text-center" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_2" value="2">
                    </td>
                    <td class="text-center">2</td>
                </tr>
                <tr>
                    <td class="bg-info">˂ 50</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_06" id="t_06_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="2" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Kesadaran</td>
                    <td class="">Sadar </td>
                    <td class="text-center " style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_07" id="t_07_0" value="0">
                    </td>
                    <td class="text-center ">0</td>
                </tr>
                <tr>
                    <td class="bg-info">Nyeri/ verbal Unrespon</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_07" id="t_07_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="2" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Nyeri (tidak termasuk his)</td>
                    <td class="">Normal </td>
                    <td class="text-center " style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_08" id="t_08_0" value="0">
                    </td>
                    <td class="text-center ">0</td>
                </tr>
                <tr>
                    <td class="">Abnormal </td>
                    <td class="text-center " style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_08" id="t_08_3" value="3">
                    </td>
                    <td class="text-center ">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="2" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Discharge /Lokia</td>
                    <td class="">Normal </td>
                    <td class="text-center " style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_09" id="t_09_0" value="0">
                    </td>
                    <td class="text-center ">0</td>
                </tr>
                <tr>
                    <td class="bg-info">Abnormal </td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_09" id="t_09_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td rowspan="2" class="bg-warning text-center" width="15%" style="vertical-align: middle;">Proteinuria (perhari)</td>
                    <td class="">+</td>
                    <td class="text-center " style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_010" id="t_010_2" value="2">
                    </td>
                    <td class="text-center ">2</td>
                </tr>
                <tr>
                    <td class="bg-info">++</td>
                    <td class="text-center bg-info" style="vertical-align: middle;">
                        <input type="radio" class="form-check-input" name="t_010" id="t_010_3" value="3">
                    </td>
                    <td class="text-center bg-info">3</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">TOTAL SKOR</td>
                    <td></td>
                    <td>
                        <input class="form-control" type="text" name="t_011" id="t_011" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">SKALA NYERI (0 - 10)</td>
                    <td colspan="2">
                        <div class="container">
                            <input type="range" id="t_012" name="t_012" min="0" max="10" list="markers" value="0" style="width: 100%;" />
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
                </tr>
                <table class="table table-bordered mb-2 mt-0 fw-bold" style="border: 1px solid black">
                    <tr>
                        <td class="text-center" style="background-color: yellowgreen; width:25%; vertical-align: middle;">
                            Skor 0
                        </td>
                        <td>
                            Kondisi pasien stabil dan sesuai dengan perawatan di bangsal umum, Frekuensi monitoring per 4-6 jam </td>
                    </tr>
                    <tr>
                        <td class="text-center" style="background-color: yellow; vertical-align: middle;">Skor 1-4 </td>
                        <td>
                            Assessment segera oleh perawat senior, respon segera, maks 5 menit, eskalasi perawatan dan frekuensi monitoring per 4-6 jam, Jika diperlukan assessment oleh dokter jaga bangsal
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center bg-warning" style="vertical-align: middle;">
                            Skor 5-6
                        </td>
                        <td>
                            Assessment segera oleh dokter jaga (respon segera, maks 5 menit), konsultasi DPJP dan spesialis terkait, eksalasi perawatan dan monitoring tiap jam, pertimbangkan perawatan dengan monitoring yang sesuai. </td>
                    </tr>
                    <tr>
                        <td class="text-center bg-danger" style="vertical-align: middle;">
                            Skor 7 Atau Lebih
                        </td>
                        <td>
                            Resusitasi dan monitoring secara kontinyu oleh dokter jaga dan perawat senior, Aktivasi code blue kegawatan medis, respon Tim Code Blue Sekunder segera, maksimal 10 menit, Informasikan dan konsultasikan ke DPJP. </td>
                    </tr>
                    <tr>
                        <td class="text-center bg-primary" style="vertical-align: middle;">
                            Henti Napas/Jantung
                        </td>
                        <td>
                            Lakukan RJP oleh petugas/tim primer, aktivasi code blue henti jantung, respon Tim Code Blue Sekunder segera, maksimal 5 menit, informasikan dan konsultasikan DPJP. </td>
                    </tr>
                </table>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>