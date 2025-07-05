<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>
    <script src="<?= base_url(); ?>assets/libs/moment/min/moment.min.js"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        @page {
            size: A4;
        }

        body {
            width: 21cm;
            height: 29.7cm;
            margin: 0;
            font-size: 12px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .3rem;
            font-weight: 500;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <!-- template header -->
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3><?= @$organization['name_of_org_unit'] ?></h3>
                <p><?= @$organization['contact_address'] ?? "-" ?>, <?= @$organization['phone'] ?? "-" ?>, Fax:
                    <?= @$organization['fax'] ?? "-" ?>,
                    <?= @$organization['kota'] ?? "-" ?></p>
                <p><?= @$organization['sk'] ?? "-" ?></p>

            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
            </div>
        </div>

        <div class="row">
            <h4 class="text-center"><?= @$title; ?></h4>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok')); ?>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Nomor RM</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Nama Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Jenis Kelamin</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['gendername']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" style="width:33.3%">
                        <b>Tanggal Lahir (Usia)</b>
                        <p class="m-0 mt-1 p-0">
                            <?php
                            echo substr($visit['tgl_lahir'], 0, 10) . ' (' . @$visit['age'] . ')';
                            ?>

                        </p>

                    </td>
                    <td class="p-1" style="width:33.3%">
                        <b>Alamat Pasien</b>
                        <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Masuk</b>
                        <p class="m-0 mt-1 p-0">
                            <?=
                            substr(isset($visit['visit_datetime']) && $visit['visit_datetime'] ? $visit['visit_datetime'] : (isset($visit['visit_datetime']) ? $visit['visit_datetime'] : ''), 0, 16)
                            ?>
                        </p>

                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>DPJP</b>
                        <p class="m-0 mt-1 p-0"><?= @@$visit['fullname']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Department (Spesialis)</b>
                        <p class="m-0 mt-1 p-0"><?= @$val['specialist_type']; ?></p>
                    </td>
                    <td class="p-1">
                        <b>Tanggal Keluar</b>
                        <p class="m-0 mt-1 p-0">
                            <?=
                            substr(isset($visit['exit_date']) && $visit['exit_date'] ? $visit['exit_date'] : (isset($visit['visit_datetime']) ? $visit['visit_datetime'] : ''), 0, 16)
                            ?>
                        </p>

                    </td>
                </tr>

                <!-- jika pasien rawat inap -->
                <?php if (!empty($visit['class_room_id'])) : ?>
                    <tr>
                        <td class="p-1">
                            <b>Hak Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_class_plafond']; ?></p>
                        </td>
                        <td class="p-1" colspan="2">
                            <b>Bangsal/Kelas</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['name_of_class']; ?>/<?= @$val['kelas']; ?></p>
                        </td>
                        <!-- <td class="p-1">
                            <b>Bed</b>
                            <p class="m-0 mt-1 p-0"><?= @$visit['bed_id']; ?></p>
                        </td> -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- end of template header -->
        <div class="row">
            <h4 class="text-start">Subjektif (S)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 33%;">
                        <b>Keluhan Utama</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_penyakit_sekarang']; ?></p>
                        <b>Riwayat Penyakit Sekarang (Autoanamnesis)</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['anamnesis']; ?></p>
                    </td>
                    <td style="width: 33%;">
                        <b>Riwayat Penyakit Sekarang (Alloanamnesis)</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['alloanamnesis']; ?></p>
                        <b>Riwayat Penyakit Dahulu</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_penyakit_dahulu']; ?></p>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Keluarga</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_penyakit_keluarga']; ?></p>
                        <b>Riwayat Obat Yang Dikonsumsi</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_obat_dikonsumsi']; ?></p>
                        <b>Riwayat Alergi Obat</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_alergi_obat']; ?></p>
                        <b>Riwayat Alergi Non Obat</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['riwayat_alergi_nonobat']; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Obyektif (O)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4"><b>Vital Sign</b></td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>Tekanan Darah</b>
                        <p class="m-0 mt-1 p-0"><?= @(int)$val['tensi_atas'] != 0 ? @(int)$val['tensi_atas'] : '-'; ?> / <?= @(int)$val['tensi_bawah'] != 0 ? @(int)$val['tensi_bawah'] : '-'; ?> mmHg</p>
                    </td>
                    <td class="p-1">
                        <b>Denyut Nadi</b>
                        <p class="m-0 mt-1 p-0"><?= @(int)$val['nadi'] != 0 ? @(int)$val['nadi'] : '-'; ?> x/m</p>
                    </td>
                    <td class="p-1">
                        <b>Suhu Tubuh</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @$val['suhu'] != 0 ? @$val['suhu'] : '-'; ?> ℃</p>
                        </div>
                    </td>
                    <td class="p-1">
                        <b>Respiration Rate</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @(int)$val['respiration'] != 0 ? @(int)$val['respiration'] : '-'; ?> x/m</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-1">
                        <b>SpO2</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @(int)$val['spo2'] != 0 ? @(int)$val['spo2'] : '-'; ?> %</p>
                        </div>
                    </td>
                    <td class="p-1">
                        <b>Berat Badan</b>
                        <div class="input-group">
                            <p class="m-0 mt-0 p-0"><?= @$val['berat'] != 0 ? @$val['berat'] : '-'; ?> kg</p>
                        </div>
                    </td>
                    <td colspan="2">
                        <b><i>GCS / Tingkat Kesadaran</i></b>
                        <p class="m-0 mt-0 p-0">
                            <?php if (is_null(@$val['gcs'])) {
                            ?>-<?php
                            } else {
                                ?>(<?= @$val['gcs']; ?>) <?= @$val['gcs_display']; ?></p><?php
                                                                                        } ?>

                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <?php
                // check jika data lokalis ada atau tidak
                if (!empty($lokalis2)) {
                    // jika ada maka lakukan perulangan untuk menampilkan data
                    foreach ($lokalis2 as $key => $value) {
                        // jika data lokalis memiliki value score = 2 maka tampilkan
                        if ($value['value_score'] == 2) {
                            // jika key pada data adalah ganjil
                            if (($key + 1) % 2 != 0) {
                                // jika data bukan data terakhir 
                                if ($key + 1 != count($lokalis2)) {
                                    echo '<tr>';
                                    echo '<td class="p-1" style="width: 50%;">'
                                        . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                        '</td>';
                                } else {
                                    echo '<tr>';
                                    echo '<td class="p-1" colspan="2" style="width: 50%;">'
                                        . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                        '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<td class="p-1" style="width: 50%;">'
                                    . '<b>' . $value['nama_lokalis'] . '</b>' . '<p class="m-0 mt-0 p-0">' . $value['value_detail'] . '</p>' .
                                    '</td>';
                                echo "<tr>";
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="" colspan="2">
                        <b>Diagnosis Masuk</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['namadiagnosa']; ?></p>
                    </td>
                    <td class="p-1" colspan="2">
                        <b>Diagnosis Pulang</b>
                        <p class="m-0 mt-0 p-0"><?= @$val['namadiagnosapulang']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="4">
                        <b>Indikasi Rawat Inap</b>
                        <p><?= @$val['masalah_medis']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="4">
                        <b>Procedure</b>
                        <ul class="list-group list-group-numbered">
                            <?php foreach ($procbedah as $key => $value) {
                            ?>
                                <li class="list-group-item"><?= $value['treatment']; ?></li>
                            <?php
                            } ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="p-1" colspan="2">
                        <b>Cara Pulang</b>
                        <?php $dischargeWay = ['', 'Atas Persetujuan', 'Atas Permintaan Sendiri', 'Rujuk', 'Rujuk Balik', 'Melarikan Diri', 'Meninggal Dunia'] ?>
                        <p class="m-0 mt-0 p-0"><?= @$dischargeWay[$val['discharge_way']]; ?></p>
                    </td>
                    <td class="p-1" colspan="2">
                        <?php $dischargeCon = ['', 'Sembuh/Sehat', 'Membaik', 'Belum Sembuh', 'Meninggal < 48 Jam', 'Meninggal > 48 Jam'] ?>
                        <b>Kondisi Pulang</b>
                        <p class="m-0 mt-0 p-0"><?= @$dischargeCon[$val['discharge_condition']]; ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Penunjang Medis</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="p-1" style="width: 50%">
                        <b>Laboratorium</b>
                        <table class="table-borderless">
                            <tbody id="render-tables" class="">
                            </tbody>
                        </table>
                    </td>
                    <td class="p-1" style="width: 50%">
                        <b>Radiologi</b>
                        <div id="note-val_rad"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Terapi Obat (Farmakoterapi)</h4>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>
                        <b>Nama Resep</b>
                    </td>
                    <td>
                        <b>Signa</b>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach (@$recipe as $key => $value) {
                ?>
                    <tr>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$value['resep']; ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$value['signatura'] ?></p>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Take Home Prescription</h4>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>
                        <b>Nama Resep</b>

                    </td>
                    <td>
                        <b>Signature</b>

                    </td>
                </tr>
            </thead>
            <tbody>
                <?php foreach (@$recipeDischarge as $key => $value) {
                ?>
                    <tr>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$value['resep']; ?></p>
                        </td>
                        <td>
                            <p class="m-0 mt-0 p-0"><?= @$value['signatura'] ?></p>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
        <div class="row mb-3">
            <div class="col">
                <b>Terapi Tindakan (Procedure)</b>
                <ul class="list-group list-group-numbered">
                    <?php foreach ($procnonbedah as $key => $value) {
                    ?>
                        <li class="list-group-item"><?= $value['treatment']; ?></li>
                    <?php
                    } ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Tanda Tangan Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
                <p class="p-0 m-0 py-1" id="qrcode_name"></p>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Tanda Tangan Pasien/Keluarga</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
                <p class="p-0 m-0 py-1" id="qrcode_name1"></p>
            </div>
        </div>
        <i>dicetak pada tanggal <?= tanggal_indo(date('Y-m-d')); ?></i>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<script type="text/javascript">
    const cropTransparentPNG = (base64, callback) => {
        const img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);

            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;

            let top = null,
                bottom = null,
                left = null,
                right = null;

            for (let y = 0; y < canvas.height; y++) {
                for (let x = 0; x < canvas.width; x++) {
                    const index = (y * canvas.width + x) * 4;
                    const alpha = data[index + 3];
                    if (alpha > 0) {
                        if (top === null || y < top) top = y;
                        if (bottom === null || y > bottom) bottom = y;
                        if (left === null || x < left) left = x;
                        if (right === null || x > right) right = x;
                    }
                }
            }

            if (top === null) return callback(null); // tidak ada gambar

            const width = right - left + 1;
            const height = bottom - top + 1;

            const croppedCanvas = document.createElement('canvas');
            croppedCanvas.width = width;
            croppedCanvas.height = height;

            const croppedCtx = croppedCanvas.getContext('2d');
            croppedCtx.drawImage(canvas, left, top, width, height, 0, 0, width, height);

            const croppedBase64 = croppedCanvas.toDataURL('image/png');
            callback(croppedBase64);
        };
        img.src = base64;
    };
</script>
<script>
    let val = <?= json_encode($val); ?>;
    let sign = <?= json_encode($sign); ?>;

    sign = JSON.parse(sign)
    $.each(sign, function(key, value) {
        if (value.user_type == 1 && value.isvalid == 1) {
            $("#qrcode_name").html(`(<?= $visit['fullname']; ?>)`)
            $("#qrcode").html('<img class="mt-3" src="data:image/png;base64,' + value.sign_file +
                '" width="400px">')

        } else if (value.user_type == 2 && value.isvalid == 1) {
            $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)
            const base64ttd_cetak_resumePulang_pasien1 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumePulang_pasien1) {

                cropTransparentPNG(base64ttd_cetak_resumePulang_pasien1, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcode1').html('');
                    }
                });
            } else {
                $('#qrcode1').html('');
            }

            // $("#qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        } else if (value.user_type == 3 && value.isvalid == 1) {

            $("#qrcode_name1").html(`(${value.fullname??value.user_id})`)

            const base64ttd_cetak_resumePulang_pasien2 = `data:image/gif;base64,${value.sign_file}`

            if (base64ttd_cetak_resumePulang_pasien2) {
                cropTransparentPNG(base64ttd_cetak_resumePulang_pasien2, (croppedImage) => {
                    if (croppedImage) {
                        $('#qrcode1').html(
                            `<img src="${croppedImage}" alt="Signature" style="width: 100%; max-width: 55px; height: auto;">`
                        );
                    } else {
                        $('#qrcode1').html('');
                    }
                });
            } else {
                $('#qrcode1').html('');
            }

            // $("#qrcode1").html('<img class="mt-3" src="data:image/gif;base64,' + value.sign_file +
            //     '" width="400px">')

        }
    })
</script>
<script>
    $(document).ready(function() {

        $("#datetime-now").html(`${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        dataRenderTables();
        dataRenderTablesLaborat();
        renderDataPatientLaborat();
        window.print();
    })

    $(document).ready(function() {})
    const dataRenderTablesLaborat = () => {
        <?php $dataJsonTables = json_encode($lab); ?>
        let dataTable = <?php echo $dataJsonTables; ?>;

        const diagnosaList = [];
        const indicationList = [];
        dataTable?.data?.forEach((item) => {
            if (item.diagnosa_desc !== null && !diagnosaList.includes(item.diagnosa_desc)) {
                diagnosaList.push(item.diagnosa_desc);
            }
            if (item.indication_desc !== null && !indicationList.includes(item.indication_desc)) {
                indicationList.push(item.indicationList);
            }
        });

        let result;
        if (diagnosaList.length === 0) {
            result = "";
        } else if (diagnosaList.length === 1) {
            result = diagnosaList;
        } else {
            result = diagnosaList.join(" ,<br>");
        }
        let indication;
        if (diagnosaList.length === 0) {
            indication = "";
        } else if (indicationList.length === 1) {
            indication = indicationList;
        } else {
            indication = indicationList.join(" ,<br>");
        }

        $("#diagnosa_klinis_lab").html(result);
        $("#indication_desc_lab").html()
        let groupedData = {};

        dataTable?.data?.forEach(e => {
            if (e.tarif_name?.toLowerCase().includes("antigen")) {
                $("#tindakan_medis").html(`<h6>Expertise :</h6>
                    <p>Note: Rapid Antigen SARS-CoV-2
                        * Spesimen : Swab Nasofaring/ Orofaring
                        * Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen di bawah level deteksi alat
                        * Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-CoV-2 sehingga masih berisiko menularkan
                        ke orang lain,
                        disarankan tes ulang atau tes konfirmasi dengan NAAT (Nucleic Acid Amplification Tests), bila
                        probabilitas pretes relatif tinggi,
                        terutama bila pasien bergejala atau diketahui memikili kontak dengan orang yang terkonfirmasi COVID-19
                    </p>`);
            }
            if (!groupedData[e.nolab_lis]) {
                groupedData[e.nolab_lis] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm]) {
                groupedData[e.nolab_lis][e.norm] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan]) {
                groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan] = {};
            }

            if (!groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name]) {
                groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name] = [];
            }

            groupedData[e.nolab_lis][e.norm][e.kel_pemeriksaan][e.tarif_name].push(e);
        });

        let dataResultTable = '';
        let isFirstGroup = true;

        for (let nolabLis in groupedData) {
            if (groupedData.hasOwnProperty(nolabLis)) {
                for (let norm in groupedData[nolabLis]) {
                    if (groupedData[nolabLis].hasOwnProperty(norm)) {

                        const firstItem = groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]]
                            [Object.keys(groupedData[nolabLis][norm][Object.keys(groupedData[nolabLis][norm])[0]])[
                                0]][0];

                        const formattedCheckDate = moment(firstItem?.tgl_periksa).format("DD/MM/YYYY HH:mm");
                        const formattedSampleDate = moment(firstItem?.tgl_hasil).format("DD/MM/YYYY HH:mm");


                        for (let kelPemeriksaan in groupedData[nolabLis][norm]) {
                            if (groupedData[nolabLis][norm].hasOwnProperty(kelPemeriksaan)) {

                                for (let tarifName in groupedData[nolabLis][norm][kelPemeriksaan]) {
                                    if (groupedData[nolabLis][norm][kelPemeriksaan].hasOwnProperty(tarifName)) {

                                        groupedData[nolabLis][norm][kelPemeriksaan][tarifName].forEach(e => {
                                            dataResultTable += `<tr>
                                                    <td style="padding-left: 40px;">${e.parameter_name}</td>
                                                    <td>
                                                        ${(e.flag_hl?.trim() || '') === '' ? e.hasil : 
                                                            ['L', 'H', 'K', '(*)'].includes(e.flag_hl.trim()) ? `<b class="fw-bold">${e.hasil}</b>` : 
                                                            (e.flag_hl.trim().includes('K') ? `<b style="color:red;">${e.hasil}</b>` : 
                                                            e.hasil)}
                                                    </td>
                                                    <td>${!e.satuan? "-":e.satuan}</td>

                                                </tr>`;
                                        });
                                    }
                                }
                            }
                        }

                        isFirstGroup = false;
                    }
                }
            }

            $("#render-tables").html(dataResultTable);


            $("#noLab_rm").html(dataTable?.data[0]?.nolab_lis + '/ ' + dataTable?.data[0]?.norm)
            $("#name_patient").html(dataTable?.data[0]?.nama)
            $("#adresss_patient_lab").html(dataTable?.data[0]?.alamat)
            $("#date_check_lab").html(moment(dataTable?.data[0]?.tgl_hasil).format("DD/MM/YYYY HH:mm:ss"))
            $("#payment_method").html(dataTable?.data[0]?.cara_bayar_name)
            $("#doctor_send_lab").html(dataTable?.data[0]?.pengirim_name)
            $("#room_poli").html(dataTable?.data[0]?.ruang_name)
            $("#class_pay").html(`${dataTable?.data[0]?.kelas_name} - ${dataTable?.data[0]?.cara_bayar_name}`)
            $("#datetime-now-valid").html(
                `${moment(dataTable?.data[0]?.tgl_hasil_selesai).format("DD/MM/YYYY HH:mm:ss")}`)





        }
    }
    const renderDataPatientLaborat = () => {
        <?php $dataJson = json_encode($lab); ?>
        let data = <?php echo $dataJson; ?>;
        let visit = <?= json_encode($visit); ?>;


        // render patient 
        $("#gender_patient_lab").html(visit?.gender == 1 ? "Laki-laki" : "Perempuan");

        $("#doctor-responsible-lab").html(data?.visit?.doctor_responsible)

        $("#date_age_lab").html(moment(visit?.tgl_lahir).format("DD/MM/YYYY") + ' - ' + visit?.ageyear)
        $("#no_tlp_lab").html(visit?.phone_number)
        $("#validator-ttd").html("Ayu Mercuria margana, A.Md.Kes")
    }
</script>
<script>
    $(document).ready(() => {})
    const dataRenderTables = () => {
        <?php $dataJsonTables = json_encode(@$radiologi_cetak); ?>
        <?php $dataJsonTreat = json_encode(@$get_treat); ?>

        let dataTable = <?php echo $dataJsonTables; ?>;
        let dataTreat = <?php echo $dataJsonTreat; ?>;
        let note_valrad = ''
        let result_valrad = ''
        let result_rad = ''


        //     // render patient -
        $("#no_rm").html(dataTable[0]?.no_registration)
        $("#name_patient_rad").html(dataTable[0]?.thename)
        $("#gender_patient_age").html(dataTable[0]?.gender === "2" ? "Perempuan" : dataTable[0]?.gender === "2" ?
            "Laki - Laki" : !dataTable[0]?.gender ? "" : dataTable[0]?.gender + '/' +
            dataTable[0].ageyear + ' Th' + dataTable[0].agemonth + ' Bln' + dataTable[0].ageday + ' Hr')
        $("#adresss_patient_rad").html(dataTable[0]?.theaddress)
        $("#no_check").html(dataTable[0]?.nota_no)
        $("#date_check_rad").html(moment(dataTable[0]?.pickup_date).format("DD-MMM-YYYY HH:ss"))
        $("#doctor_send_rad").html(dataTable[0]?.doctor_from)
        $("#diagnosa_desc_rad").html(dataTable[0]?.diagnosa_desc)
        $("#indicational_desc_rad").html(dataTable[0]?.indication_desc)



        dataTable?.forEach((item, index) => {
            // note_valrad += `<p>${index+1}. ${item?.conclusion}</p>`;
            result_rad += `<p>${index+1}. ${item?.result_value}</p>`;
            let matchedTreat = dataTreat.find(treat => treat.tarif_id === item?.tarif_id);
            note_valrad += `<b><p>${index+1}. ${item?.tarif_name} :${item?.conclusion}</p></b>`;
            // if (matchedTreat) {
            //     result_valrad += `<p>${index+1}.  ${matchedTreat.tarif_name}</p>`;
            // } else {

            //     result_valrad += `<p>${index+1}.  ${item?.tarif_id}</p>`;
            // }
        });

        $("#dengan-hormat-val_rad").html((result_rad?.toString() ?? '').replace(/\n/g, "<br>"))
        $("#pemeriksaan-val_rad").html((result_valrad?.toString() ?? '').replace(/\n/g, "<br>"))
        $("#note-val_rad").html(note_valrad ?? "")
        $("#validator-ttd-rad").html(dataTable[0]?.doctor)
    }
</script>
<style>
    @media print {
        @page {
            margin: none;
            scale: 85;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>


</html>