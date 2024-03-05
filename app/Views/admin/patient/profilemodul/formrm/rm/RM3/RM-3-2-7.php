<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 3.2.7 dx perawat - diagnosa gangguan nyeri</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 3.2.7</b></h5>

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
            <h5 style="text-align: center;"><b>DIAGNOSA GANGGUAN NYERI</b></h5>

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
                            <div class="mb-1"><b>Nyeri Akut / Kronis </b><br>berhubungan dengan kelemahan fisik</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_01">
                                <label class="form-check-label" for="t_01"> Fisik</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_02">
                                    <label class="form-check-label" for="t_02">Obstruksi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_03">
                                    <label class="form-check-label" for="t_03">Peradangan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_04">
                                    <label class="form-check-label" for="t_04">Trauma</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_05">
                                    <label class="form-check-label" for="t_05">Luka </label>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_06">
                                <label class="form-check-label" for="t_06">Biologi</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_07">
                                    <label class="form-check-label" for="t_07">Infeksi</label>
                                    <input type="text" id="v_06" name="v_06" style="width: 100px">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_08">
                                    <label class="form-check-label" for="t_08">Sengatan / gigitan binatang</label>
                                    <input type="text" id="v_07" name="v_07" style="width: 100px">
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_09">
                                <label class="form-check-label" for="t_09">Psikoilogis</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_010">
                                    <label class="form-check-label" for="t_010">Piskosomatis</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_011">
                                    <label class="form-check-label" for="t_011">Kimia</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="t_012">
                                        <label class="form-check-label" for="t_012">Zat Kimia</label>
                                        <input type="text" id="v_08" name="v_08" style="width: 100px">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1">Pasien tidak mengeluh nyeri setelah dilakukan<br>tindakan keperawatan selama <input type="text" id="v_09" name="v_09" style="width: 50px"> 24 jam.</div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_013">
                                <label class="form-check-label" for="t_013">Mengungkapkan rasa nyeri berkurang sampai dengan tidak ada nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_014">
                                <label class="form-check-label" for="t_014">Skala nyeri 1 – 3</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_015">
                                <label class="form-check-label" for="t_015">Tekanan darah dalam rentang normal dewasa : (sistol 110 – 130 dan diastole 70 – 90 mmHg) Anak : (sistol 90 -110 dan diastol 50 -70 mmHg)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_016">
                                <label class="form-check-label" for="t_016"> Nadi dalam rentang normal Dewasa : (55 – 90 x/menit) Anak : (70- 150 x/menit)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_017">
                                <label class="form-check-label" for="t_017"> Neonates : (100 – 180 x/menit)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_018">
                                <label class="form-check-label" for="t_018"> Respirasi rentang normal Dewasa : (16 – 20 x/menit) Anak : (20 – 40 x/menit) Neonates : (30 – 40 x/menit) </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_019">
                                <label class="form-check-label" for="t_019">Mengenali datangnya nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_020">
                                <label class="form-check-label" for="t_020">Mengenali penyebab nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_021">
                                <label class="form-check-label" for="t_021">Mengenali tanda – tanda nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_022">
                                <label class="form-check-label" for="t_022">Dapat melakukan hubungan interpersonal</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_023">
                                <label class="form-check-label" for="t_023">Dapat melakukan / menangani nyeri dengan disktraksi maupun relaksasi</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_024">
                                    <label class="form-check-label" for="t_024">Otot rilex (tidak tegang)</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1"><b>Manajemen Nyeri</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_025" id="t_025_efektif">
                                <label class="form-check-label" for="t_025_efektif">Kaji respon klien terhadap nyeri.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_026" id="t_026_tidak">
                                <label class="form-check-label" for="t_026_tidak">Observasi tanda – tanda vital tiap 4 jam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_027" id="t_027_tidak">
                                <label class="form-check-label" for="t_027_tidak">Kaji lokasi, nyeri, karakteristik dan tipe sakit
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_028" id="t_028_tidak">
                                <label class="form-check-label" for="t_028_tidak">Atur posisi sesuai dengan kondisi pasien</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_029" id="t_029_tidak">
                                <label class="form-check-label" for="t_029_tidak">Atasi nyeri sesuai skala nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_030" id="t_030_tidak">
                                <label class="form-check-label" for="t_030_tidak">Ciptakan lingkungan yang nyaman</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_031" id="t_031_tidak">
                                <label class="form-check-label" for="t_031_tidak">Batasi aktifitas pasien untuk mengurangi nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_032" id="t_032_tidak">
                                <label class="form-check-label" for="t_032_tidak">Laporkan dokter bila mengatasi nyeri tidak berhasil</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_033" id="t_033_syok">
                                    <label class="form-check-label" for="t_033_syok">Kolaborasi dengan keluarga untuk mengatasi nyeri</label>
                                </div>
                            </div>

                            <div class="mb-1"><b>Pendidikan Kesehatan tentang Nyeri</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_034" id="t_034_tidak">
                                <label class="form-check-label" for="t_034_tidak">Definisi nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_035" id="t_035_tidak">
                                <label class="form-check-label" for="t_035_tidak">Penyebab nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_036" id="t_036_tidak">
                                <label class="form-check-label" for="t_036_tidak">Tanda gejala nyeri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_037" id="t_037_tidak">
                                <label class="form-check-label" for="t_037_tidak"> Penanganan nyeri dengan non farmakologi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_038" id="t_038_tidak">
                                <label class="form-check-label" for="t_038_tidak">Penangangan nyeri dengan obat / farmakologi</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_039" id="t_039_syok">
                                    <label class="form-check-label" for="t_039_syok">Komplikasi nyeri</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1" style="text-align: center;">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                                <br><input type="text" name="v_10" id="v_10" style="width: 130px" placeholder="Nama">
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