<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>RM 3.2.3 dx perawat - diagnosa gangguan mobilitas fisik</title>
</head>

<body>
    <form>
        <div class="container mt-3">

            <br>
            <h5 style="text-align: right;"><b>RM 3.2.3</b></h5>

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
            <h5 style="text-align: center;"><b>DIAGNOSA MOBILITAS FISIK</b></h5>

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
                            <div class="mb-1"><b>Gangguan Mobilitas</b><br>berhubungan dengan :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_01">
                                <label class="form-check-label" for="t_01">Kerusakan neuromuskuler</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_02">
                                <label class="form-check-label" for="t_02">Pengobatan</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_03">
                                <label class="form-check-label" for="t_03">Terapi pembatasan gerak;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_04">
                                <label class="form-check-label" for="t_04">Kurang pengetahuan tentang kegunaan pergerakan fisik;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_05">
                                <label class="form-check-label" for="t_05">IMT di atas 75 tahun percentimeter sesuai dengan usia;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_06">
                                <label class="form-check-label" for="t_06">Kerusakan persepsi sensori;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_07">
                                <label class="form-check-label" for="t_07">Tidak nyaman, nyeri;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_08">
                                <label class="form-check-label" for="t_08">Kerusakan musculoskeletal dan neuromuskuler.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_09">
                                <label class="form-check-label" for="t_09">Intoleransi aktifitas / penuranan kekuatan dan stamina;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_010">
                                <label class="form-check-label" for="t_010">Depresi mood atau cemas;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_011">
                                <label class="form-check-label" for="t_011">Kerusakan kognitif;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_012">
                                <label class="form-check-label" for="t_012">Penurunan kekuatan otot, control dan atau massa;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_013">
                                <label class="form-check-label" for="t_013">Keengganan untuk gerak;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_014">
                                <label class="form-check-label" for="t_014">Gaya hidup yang menetap;</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_015">
                                    <label class="form-check-label" for="t_015">Malnutrisi selektif atau umum;</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1">Setelah dilakukan tindakan keperawatan selama <br><input type="text" id="v_06" name="v_06" style="width: 50px"> 24 jam. Gangguan mobilitas fisik pasien <br>teratasi dengan kriteria hasil :</div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_016">
                                <label class="form-check-label" for="t_016">Aktifitas fisik pasien meningkat;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_017">
                                <label class="form-check-label" for="t_017">Mangerti tujuan dari peningkatan mobilitas;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="t_018">
                                <label class="form-check-label" for="t_018">Pasien dapat mengungkapkan perasaan, kekuatan dan kemampuan berpindah;</label>
                            </div>
                            <div class="mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="t_019">
                                    <label class="form-check-label" for="t_019">Pasien dapat memperagakan penggunaan alat bantu untuk mobilitasi;</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1"><b>Terapi Latihan : Ambulation</b></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_020" id="t_020_glukosa">
                                <label class="form-check-label" for="t_020_glukosa">Monitor vital sign sebelum / sesudah latihan dan lihat respon pasien saat latihan.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_021" id="t_021_efektif">
                                <label class="form-check-label" for="t_021_efektif">Konsultasi dengan terapi fisik tentang rencana ambulasi sesuai dengan kebutuhan;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_022" id="t_022_efektif">
                                <label class="form-check-label" for="t_022_efektif">Bantu klien menggunakan tongkat saat berjalan dan cegah terhadap cedera;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_023" id="t_023_efektif">
                                <label class="form-check-label" for="t_023_efektif">Ajarkan pasien atau tenaga kesehatan lain tentang tehnik ambulasi;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_024" id="t_024_tidak">
                                <label class="form-check-label" for="t_024_tidak">Kaji kemampuan pasien dalam mobilisasi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_025" id="t_025_tidak">
                                <label class="form-check-label" for="t_025_tidak">Latih pasien dalam pemenuhan kebutuhan ADLs secara mandiri sesuai kemampuan;</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_026" id="t_026_tidak">
                                <label class="form-check-label" for="t_026_tidak">Damping dan bantu pasien saat mobilisasi dan bantu penuhi kebutuhan ADLs.</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="t_027" id="t_027_tidak">
                                <label class="form-check-label" for="t_027_tidak">Berikan alat bantu jika pasien memerlukan;</label>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="t_028" id="t_028_syok">
                                    <label class="form-check-label" for="t_028_syok">Ajarkan pasien bagaimana cara mengubah posisi dan berikan bantuan jika diperlukan;</label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mb-1" style="text-align: center;">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                                <br><input type="text" name="v_07" id="v_07" style="width: 130px" placeholder="Nama">
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