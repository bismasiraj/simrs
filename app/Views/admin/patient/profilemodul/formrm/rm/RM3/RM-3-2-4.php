<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 3.2.4 dx perawat - diagnosa gangguan pertukaran gas</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 3.2.4</b></h5>

            <br><br>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>Sehat-Amanah <br>Tanggungjawab-Islami</label>
                            </div>
                        </td>
                        <td>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>


            <br>
            <h5 style="text-align: center;"><b>DIAGNOSA PERTUKARAN GAS</b></h5>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>DPJP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_01" id="v_01" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>PPJP</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_02" id="v_02" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>RUANG</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_03" id="v_03" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label>KELAS</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="v_04" id="v_04" style="width: 350px" autocomplete="off">
                    </div>
                </div>
            </div>


            <br><br>
            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>

                    <tr>
                        <td style="text-align: center;"><b>Tgl/Jam <br>No.Dx</b></td>
                        <td style="text-align: center;"><b>Diagnosa<br>Keperawatan</b></td>
                        <td style="text-align: center;"><b>NOC</b></td>
                        <td style="text-align: center;"><b>NIC</b></td>
                        <td style="text-align: center;"><b>Nama/<br>Ttd</b></td>
                    </tr>

                    <tr>
                        <td>1. <input type="date" id="v_05" name="v_05" style="width: 110px"></td>
                        <td>
                            <div class="mb-1"><b>Gangguan Pertukaran Gas </b>berhubungan dengan :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_01" id="t_01">
                                <label class="form-check-label" for="t_01">Ketidakseimbangan Perfusi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_02" id="t_02">
                                <label class="form-check-label" for="t_02">Ventilasi</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_03" id="t_03">
                                    <label class="form-check-label" for="t_03">Perubahan membrane kapiler alveolar.</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1">Setelah dilakukan tindakan keperawatan <br>selama <input type="text" id="" name="" style="width: 50px"> 24 jam.<br> dengan kriteria hasil :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_04">
                                <label class="form-check-label" for="t_04"> Keseimbangan asal basa (AGD) dan elektrolit :</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_05">
                                    <label class="form-check-label" for="t_05"> PH : 7.35 – 7.45</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_06">
                                    <label class="form-check-label" for="t_06"> PCO2 : 35 – 45</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_07">
                                    <label class="form-check-label" for="t_07"> HCO3 : 19 – 22</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_08">
                                    <label class="form-check-label" for="t_08"> BE : + 2.5</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_09">
                                    <label class="form-check-label" for="t_09"> Na : 135 – 145 mEeq/L</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_010">
                                    <label class="form-check-label" for="t_010"> K : 3.5 – 5.0 mEq/L</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_011">
                                    <label class="form-check-label" for="t_011"> CI : 95 – 105 mEq/L</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_012">
                                    <label class="form-check-label" for="t_012"> Ca : 9 – 11 mEq/L</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_013">
                                <label class="form-check-label" for="t_013"> Ventilasi adequat :</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_014">
                                    <label class="form-check-label" for="t_014"> Spo2 : 85 – 100%</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_015">
                                    <label class="form-check-label" for="t_015"> RR : 16 – 18 x/menit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_016">
                                    <label class="form-check-label" for="t_016"> Dan oksigenasi adequat</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_017">
                                <label class="form-check-label" for="t_017"> Vital Sign dalam batas normal :</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_018">
                                    <label class="form-check-label" for="t_018"> TD : 110/70 – 130/90 mmHg</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_019">
                                    <label class="form-check-label" for="t_019"> HR : 60 – 100 x/menit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_020">
                                    <label class="form-check-label" for="t_020"> Suhu : 36 – 37,50C</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_021">
                                <label class="form-check-label" for="t_021"> Batuk efektif dan suara nafas bersih</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_022">
                                    <label class="form-check-label" for="t_022"> Tidak ada sianosis dan dyspnea (mampu mengeluarkan sputum, mampu bernafas dengan mudah)</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1"><b>Manajemen Jalan Nafas</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_023" id="t_023_glukosa">
                                <label class="form-check-label" for="t_023_glukosa"> Buka jalan nafas, dengan teknik chin lift atau jaw trust bila perlu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_024" id="t_024_efektif">
                                <label class="form-check-label" for="t_024_efektif"> Posisikan pasien untuk memaksimalkan vebtilasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_025" id="t_025_efektif">
                                <label class="form-check-label" for="t_025_efektif"> Indentifikasi pasien perlunya pemasangan alat jalan nafas buatan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_026" id="t_026_efektif">
                                <label class="form-check-label" for="t_026_efektif"> Pasang mayo bila perlu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_027" id="t_027_tidak">
                                <label class="form-check-label" for="t_027_tidak"> Lakukan fisioterapi dada bila perlu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_028" id="t_028_tidak">
                                <label class="form-check-label" for="t_028_tidak"> Keluarkan secret degan batuk atau suction</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_029" id="t_029_tidak">
                                <label class="form-check-label" for="t_029_tidak"> Auskultasi suara nafas, catat adanya suara tambahan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_030" id="t_030_tidak">
                                <label class="form-check-label" for="t_030_tidak"> Lakukan suction pada mayo</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_031" id="t_031_tidak">
                                <label class="form-check-label" for="t_031_tidak"> Berikan bronchodilator bila perlu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_032" id="t_032_tidak">
                                <label class="form-check-label" for="t_032_tidak"> Berikan pelembab udara</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_033" id="t_033_tidak">
                                <label class="form-check-label" for="t_033_tidak"> Atur intake untuk cairan mengoptimalkan keseimbangan</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_034" id="t_034_syok">
                                    <label class="form-check-label" for="t_034_syok"> Monitor respirasi dan status O2.</label>
                                </div>
                            </div>

                            <div class="mb-1"><b>Monitoring Pernafasan</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_035" id="t_035_efektif">
                                <label class="form-check-label" for="t_035_efektif"> Monitor rata – rata, kedalaman, irama, dan usaha respirasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_036" id="t_036_tidak">
                                <label class="form-check-label" for="t_036_tidak">Catat pergerakan dada, amati kesimetrisan, penggunaan otot tambahan, retraksi otot supraventrikulair, dan intercostae</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_037" id="t_037_tidak">
                                <label class="form-check-label" for="t_037_tidak">Monitor suara nafas seperti dengkur</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_038" id="t_038_tidak">
                                <label class="form-check-label" for="t_038_tidak"> Monitor pola nafas : bradipnoe, takipnoe, kusmaul, hiperventilasi, cheyne strokes, biot.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_039" id="t_039_tidak">
                                <label class="form-check-label" for="t_039_tidak"> Catat lokasi trachea</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_040" id="t_040_tidak">
                                <label class="form-check-label" for="t_040_tidak">Monitor kelelahan otot diagfragma</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_041" id="t_041_tidak">
                                <label class="form-check-label" for="t_041_tidak"> Auskultasi suara nafas, catat area penurunan / tidak adanya ventilasi dan suara tambahan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_042" id="t_042_tidak">
                                <label class="form-check-label" for="t_042_tidak"> Tentukan kebutuhan suction dengan mengauskutasi crackles dan ronkhi paa jalan nafas utama</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_043" id="t_043_syok">
                                    <label class="form-check-label" for="t_043_syok">Auskultasi suara paru setelah tindakan untuk mengetahui hasilnya.</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1" style="text-align: center;">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                                <br><input type="text" name="v_68" id="v_68" style="width: 130px" placeholder="Nama">
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </form>
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
</body>

</html>