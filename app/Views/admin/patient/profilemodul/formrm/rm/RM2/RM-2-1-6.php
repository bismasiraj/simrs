<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assessment Saraf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
</head>

<body>
    <div class="container">
        <a href="<?= base_url('pku/halamanform2') ?>" class="btn btn-success mt-3"><i class="bi bi-arrow-left"></i></a>
        <div class="row align-items-center">
            <p class="text-end">RM.2.1.6</p>
            <h6 class="text-center">REKAM MEDIS RAWAT INAP</h6>
        </div>
        <form action="" method="">
            <table class="table table-bordered" style="border: 1px;">
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-3" align='middle'>
                                <img src="<?= base_url('uploads/pku.png') ?>" alt="Gambar" width="90px">
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
                    <td>
                        <h6 style="text-align: center;">ASESMEN MEDIS PASIEN SARAF</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align: center;">Diisi oleh Dokter</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-3">
                                <label for="V_01">Tanggal:</label>
                                <input type="date" id="V_01" name="V_01">
                            </div>
                            <div class="col-5"></div>
                            <div class="col-3">
                                <label for="V_02">Jam:</label>
                                <input type="time" id="V_02" name="V_02">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-12">
                                <p><strong>ANAMNESIS:</strong></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_Autoanamnesis" value="1">
                                    <label class="form-check-label" for="T_01_Autoanamnesis">Autoanamnesis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="T_01" id="T_01_Alloanamnesis" value="2">
                                    <label class="form-check-label" for="T_01_Alloanamnesis">Alloanamnesis</label>
                                </div>
                                <span style="margin-left:10px;">dengan:</span>
                                <input type="text" name="V_03" id="V_03" style="width: 120px;">
                                <span style="margin-left: 10px;">Hubungan dengan Pasien:</span>
                                <input type="text" name="V_04" id="V_03" style="width: 222px;">
                            </div>
                        </div>

                        <div class="mt-3">
                            <ul>
                                <li class="row align-items-center">
                                    <label for="V_05" class="col-3 col-form-label">Keluhan Utama:</label>
                                    <div class="col-9">
                                        <input type="text" id="V_05" name="V_05" style="width: 656px;">
                                    </div>
                                </li>
                                <li class="row align-items-center">
                                    <label for="V_06" class="col-3 col-form-label">Riwayat Penyakit Sekarang:</label>
                                    <div class="col-9">
                                        <input type="text" id="V_06" name="V_06" style="width: 656px;">
                                    </div>
                                </li>
                                <li class="row align-items-center">
                                    <label for="V_07" class="col-3 col-form-label">Alloanamesis dengan:</label>
                                    <div class="col-3">
                                        <input type="text" id="V_07" name="V_07">
                                    </div>
                                    <label for="V_08" class="col-3 col-form-label">Hubungan dengan pasien:</label>
                                    <div class="col-3">
                                        <input type="text" id="V_08" name="V_08" style="width: 200px;">
                                    </div>
                                </li>
                                <li class="row align-items-center">
                                    <label for="V_09" class="col-3 col-form-label">Riwayat Penyakit Dahulu:</label>
                                    <div class="col-9">
                                        <input type="text" id="V_09" name="V_09" style="width: 656px;">
                                    </div>
                                </li>
                                <li class="row align-items-center">
                                    <label for="V_10" class="col-3 col-form-label">Obat-obatan yang Dikonsumsi:</label>
                                    <div class="col-9">
                                        <input type="text" id="V_10" name="V_10" style="width: 656px;">
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-3">
                            <p><strong>PEMERIKSAAN FISIK</strong></p>
                            <div class="row">
                                <div class="col-3">
                                    <p><strong>A. Keadaan Umum:</strong></p>
                                </div>
                                <div class="col">
                                    <input type="text" id="V_68" name="V_68" style="width: 50%;">
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <p>Tanda vital:</p>
                                    </div>
                                    <div class="col-3">
                                        <span style="margin-left: 10px;">TD:</span>
                                        <input type="text" id="V_11" name="V_11" style="width: 50px;">
                                        <span>/</span>
                                        <input type="text" id="V_12" name="V_12" style="width: 50px;">
                                        <span>mmHg</span>
                                    </div>
                                    <div class="col-2">
                                        <span>N:</span>
                                        <input type="text" id="V_13" name="V_13" style="width: 50px;">
                                        <span>x/menit</span>
                                    </div>
                                    <div class="col-2">
                                        <span>R:</span>
                                        <input type="text" id="V_14" name="V_14" style="width: 50px;">
                                        <span>x/menit</span>
                                    </div>
                                    <div class="col-2">
                                        <span style="margin-left: 10px;">S:</span>
                                        <input type="text" id="V_15" name="V_15" style="width: 50px;">
                                        <span>°C</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p><strong>B. Status General</strong></p>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <label for="V_16" class="col-form-label">1. Kepala</label>
                                    </div>
                                    <div class="col-9">
                                        <span>:</span>
                                        <input type="text" id="V_16" name="V_16" style="width: 650px;">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <label for="V_17" class="col-form-label">2. Leher</label>
                                    </div>
                                    <div class="col-9">
                                        <span>:</span>
                                        <input type="text" id="V_17" name="V_17" style="width: 650px;">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <label for="V_18" class="col-form-label">3. <i>Thorax</i></label>
                                    </div>
                                    <div class="col-9">
                                        <span>:</span>
                                        <input type="text" id="V_18" name="V_18" style="width: 650px;">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <label for="V_19" class="col-form-label">4. <i>Abdomen</i></label>
                                    </div>
                                    <div class="col-9">
                                        <span>:</span>
                                        <input type="text" id="V_19" name="V_19" style="width: 650px;">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <label for="V_20" class="col-form-label">5. <i>Genitalia</i></label>
                                    </div>
                                    <div class="col-9">
                                        <span>:</span>
                                        <input type="text" id="V_20" name="V_20" style="width: 650px;">
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <label for="V_21" class="col-form-label">6. <i>Extremitas</i></label>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <ol type="a">
                                            <div class="container">
                                                <li>
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <label for="V_21" class="col-form-label"><i>Extremitas</i> atas</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <span>:</span>
                                                            <input type="text" id="V_21" name="V_21" style="width: 614px;">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <label for="V_22" class="col-form-label"><i>Extremitas</i> bawah</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <span>:</span>
                                                            <input type="text" id="V_22" name="V_22" style="width: 614px;">
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p><strong>C. Pemeriksaan Neurologis</strong></p>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <label for="V_23">Kondisi umum:</label>
                                    <input type="text" id="V_23" name="V_23">
                                    <span>,</span>
                                    <label for="V_24">GCS:</label>
                                    <input type="text" id="V_24" name="V_24">
                                    <span>,</span>
                                    <label for="V_25">VAS/NRS:</label>
                                    <input type="text" id="V_25" name="V_25">
                                </div>
                            </div>

                            <ul>
                                <li>
                                    <span>Kepala</span>
                                    <div class="row">
                                        <div class="container">
                                            <table class="table table-bordered" style="border: 1px;">
                                                <thead>
                                                    <th width="15%">Pupil</th>
                                                    <th width="35%">Diameter:
                                                        <input type="text" id="V_26" name="V_26" style="width: 25%;">
                                                        <span>,</span>
                                                        <input type="text" id="V_27" name="V_27" style="width: 24%;">
                                                        <span>/</span>
                                                        <input type="text" id="V_28" name="V_28" style="width: 24%;">
                                                    </th>
                                                    <th width="10%" class="text-center">
                                                        <input type="radio" id="T_02_isokor" name="T_02" value="1">
                                                        <label for="T_02_isokor" class="form-check-label">Isokor</label>
                                                    </th>
                                                    <th width="10%" class="text-center">
                                                        <input type="radio" id="T_02_anisokor" name="T_02" value="2">
                                                        <label for="T_02_anisokor" class="form-check-label">An Isokor</label>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Reflek Cahaya
                                                        </td>
                                                        <td>
                                                            <input type="text" id="V_29" name="V_29" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="V_30" name="V_30" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="V_31" name="V_31" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Reflek Cornea
                                                        </td>
                                                        <td>
                                                            <input type="text" id="V_32" name="V_32" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="V_33" name="V_33" style="width: 100%;">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="V_34" name="V_34" style="width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            Neverus Cranialis(I-XII)
                                                            <textarea name="V_35" id="V_35" class="form-control" rows="10"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span>Leher</span>
                                    <table class="table table-bordered" style="border: 1px;">
                                        <tr>
                                            <td width="20%">
                                                Kaku duduk
                                            </td>
                                            <td>
                                                <span>:</span>
                                                <input type="text" id="V_37" name="V_37" style="width: 98%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%">
                                                Meninggal sign
                                            </td>
                                            <td>
                                                <span>:</span>
                                                <input type="text" id="V_38" name="V_38" style="width: 98%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%">
                                                Brudzinki I-IV
                                            </td>
                                            <td>
                                                <span>:</span>
                                                <input type="text" id="V_39" name="V_39" style="width: 98%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%">
                                                Kernig sign
                                            </td>
                                            <td>
                                                <span>:</span>
                                                <input type="text" id="V_40" name="V_40" style="width: 98%;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="20%">
                                                Doll’s eye phenomena
                                            </td>
                                            <td>
                                                <span>:</span>
                                                <input type="text" id="V_41" name="V_41" style="width: 98%;">
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                                <li>
                                    <span>Vertebra:</span>
                                    <input type="text" id="V_42" name="V_42" style="width: 100%;">
                                </li>
                                <li>
                                    <span>Extremitas:</span>
                                    <input type="text" id="V_43" name="V_43" style="width: 100%;">
                                </li>
                            </ul>

                            <div class="row align-items-center">
                                <div class="col-3">
                                    <span>Gerak dan Kekuatan:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_44" name="V_44" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_45" name="V_45" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="V_46" name="V_46" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_47" name="V_47" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="V_48" name="V_48" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_49" name="V_49" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="V_50" name="V_50" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_51" name="V_51" style="width: 100%;">
                                </div>
                            </div>

                            <div class="row align-items-center mt-3">
                                <div class="col-3">
                                    <span>Reflek Fisiologi:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_52" name="V_52" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_53" name="V_53" style="width: 100%;">
                                </div>
                                <div class="col-2">
                                    <span>Reflek Patologis:</span>
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_54" name="V_54" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_55" name="V_55" style="width: 100%;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <input type="text" id="V_56" name="V_56" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_57" name="V_57" style="width: 100%;">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-1">
                                    <input type="text" id="V_58" name="V_58" style="width: 100%;">
                                </div>
                                <div class="col-1">
                                    <input type="text" id="V_59" name="V_59" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p><strong>PEMERIKSAAN PENUNJANG</strong></p>
                            <ul>
                                <li>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-3">
                                            <label for="V_60">Laboratorium</label>
                                        </div>
                                        <div class="col-9">
                                            <span>:</span>
                                            <input type="text" id="V_60" name="V_60" style="width: 98%;">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-3">
                                            <label for="V_61">Radiologi</label>
                                        </div>
                                        <div class="col-9">
                                            <span>:</span>
                                            <input type="text" id="V_61" name="V_61" style="width: 98%;">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="V_62">Lain-lain</label>
                                        </div>
                                        <div class="col-9">
                                            <span>:</span>
                                            <textarea name="V_62" id="V_62" cols="85" rows="2"></textarea>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-2">
                            <p><strong>DIAGNOSIS KERJA:</strong></p>
                            <textarea name="V_63" id="V_63" cols="125" rows="10"></textarea>
                        </div>
                        <div class="mt-2">
                            <p><strong>DIAGNOSIS BANDING:</strong></p>
                            <textarea name="V_64" id="V_64" cols="125" rows="4"></textarea>
                        </div>
                        <div class="mt-2">
                            <p><strong>MASALAH:</strong></p>
                            <ol type="1">
                                <li>
                                    <span>Medis :</span>
                                    <input type="text" name="V_65" id="V_65" style="width: 100%;">
                                </li>
                                <li>
                                    <span>Keperawatan :</span>
                                    <input type="text" name="V_66" id="V_66" style="width: 100%;">
                                </li>
                            </ol>
                        </div>
                        <div class="mt-2">
                            <p><strong>SASARAN:</strong></p>
                            <textarea name="V_67" id="V_67" cols="125" rows="4"></textarea>
                        </div>
                        <div class="mt-2">
                            <p><strong>RENCANA ASUHAN/ TERAPI/INSTRUKSI <i>(standing order)</i>:</strong></p>
                            <textarea name="V_68" id="V_68" cols="125" rows="10"></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 text-center">
                                <span>Dokter</span>
                            </div>
                            <div class="col-6 text-center">
                                Penerima Penjelasan
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-center">
                                <canvas id="canvas" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD" id="TTD">
                            </div>
                            <div class="col-6 text-center">
                                <canvas id="canvas1" width="150" height="90" style="border:1px solid #000;"></canvas>
                                <input type="hidden" name="TTD_1" id="TTD_1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-center">
                                <span>(<input type="text" id="V_69" name="V_69" placeholder="Masukan Nama" style="text-align: center;">)</span>
                            </div>
                            <div class="col-6 text-center">
                                <span>(<input type="text" id="V_70" name="V_70" placeholder="Masukan Nama" style="text-align: center;">)</span>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
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