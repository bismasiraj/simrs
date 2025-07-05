<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.css"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


    <script src="<?= base_url() ?>assets/libs/qrcode/qrcode.min.js"></script>

    <script src="<?= base_url() ?>assets\libs\moment\min\moment.min.js"></script>

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

        .table-container-split {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .table-container-split table {
            width: 45%;
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

        thead.border {
            border-bottom: 1px solid black !important;
            border-top: 1px solid black !important;
        }

        tbody.border {
            border-bottom: 1px solid black !important;
        }

        @media print {
            @page {
                margin: none;
                /* scale: 85; */
            }

            .container {
                width: 100%;
                /* Sesuaikan dengan lebar kertas A4 */
            }

            td {
                background-color: inherit;
                color: inherit;
                border: inherit;
                padding: inherit;
                text-align: inherit;
            }

            .d-flex button {
                display: none;
            }

        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">

        <div style="display: none;">
            <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
            <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
            <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
        </div>
        <?php csrf_field(); ?>
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
            </div>
            <div class="col mt-2">
                <h3><?= @$kop['name_of_org_unit'] ?></h3>
                <!-- <h3>Surakarta</h3> -->
                <p><?= @$kop['contact_address'] ?></p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
            </div>
        </div>
        <br>
        <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
        <div class="row">
            <h6 class="text-center pt-2"><?= @$title; ?></h6>
        </div>
        <div class="p-3">
            <div class="row">
                <div class="col-6">
                    <p><strong>I. Diisi oleh Pasien/Peserta</strong></p>
                </div>
                <div class="col-6 text-end">
                    <p><strong>No. RM/Reg :</strong> <?= $visit['no_registration'] ?></p>
                </div>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Nama Pasien</strong></td>
                        <td><?= @$visit['diantar_oleh'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Lahir</strong></td>
                        <td><?= @$visit['date_of_birth'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td><?= @$visit['contact_address'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Telp/HP</strong></td>
                        <td><?= @$visit['phone_number'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Hubungan dengan bertanggung</strong></td>
                        <td><?= @$visit['family_notes'] ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <form id="form-isioterapi">
            <div class="p-3 mt-3">
                <p><strong>II. Diisi oleh Dokter Sp.KFR</strong></p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Tanggal Pelayanan</strong></td>
                            <td><?= @$fisioterapi['vactination_date'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Anamnesa</strong></td>
                            <?php if (isset($diagnosa) && is_array($diagnosa)): ?>
                                <td>
                                    <?php
                                    $anamnaseList = [];
                                    foreach ($diagnosa as $item) {
                                        if (!empty($item['anamnase'])) {
                                            $anamnaseList[] = $item['anamnase'];
                                        }
                                    }
                                    echo implode(', ', $anamnaseList);
                                    ?>
                                </td>
                            <?php endif; ?>


                        </tr>
                        <tr>
                            <td><strong>Pemeriksaan Fisik dan Uji</strong></td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <label for="vas">VAS:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="vas" name="vas"
                                            value="<?= @$fisioterapi['vas'] ?>" style="width: 100%;">
                                    </div>
                                </div>
                            </td>


                        </tr>

                        <tr>
                            <td><strong>Fungsi</strong></td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <input type="text" class="form-control" id="vas" name="vas"
                                            value="<?= @$fisioterapi['functions'] ?>" style="width: 100%;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Diagnosis Medis (ICD-10)</strong></td>
                            <?php if (isset($diagnosa) && is_array($diagnosa)): ?>
                                <td>
                                    <?php
                                    $diag_medis = [];
                                    foreach ($diagnosa as $item) {
                                        if ($item['diag_cat'] == '1') {
                                            $diag_medis[] = $item['diagnosa_desc'];
                                        }
                                    }
                                    echo implode(', ', $diag_medis);
                                    ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td><strong>Diagnosis Fungsi (ICD-10)</strong></td>
                            <td><?php if (isset($diagnosa) && is_array($diagnosa)): ?>
                            <td>
                                <?php
                                    $diag_fungsi = [];
                                    foreach ($diagnosa as $item) {
                                        if ($item['diag_cat'] == '17') { // Memeriksa diag_cat
                                            $diag_fungsi[] = $item['diagnosa_desc'];
                                        }
                                    }
                                    echo implode(', ', $diag_fungsi); // Menggabungkan dengan koma dan spasi
                                ?>
                            </td>
                        <?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Pemeriksaan Penunjang/Tata</strong></td>
                            <td>
                                <div class="row">
                                    <div class="col-auto">
                                        Fisioterapi:
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input type="checkbox" id="ultrasound" name="ultrasound" value="1"
                                                <?= @$fisioterapi['ultrasound'] == '1' ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="ultrasound" class="form-check-label">Ultrasound</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input type="checkbox" id="tens" name="tens" value="1"
                                                <?= @$fisioterapi['tens'] == '1' ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="tens" class="form-check-label">TENS</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input type="checkbox" id="exercise" name="exercise" value="1"
                                                <?= @$fisioterapi['exercise'] == '1' ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="exercise" class="form-check-label">Exercise</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Laksana KFR (ICD 9 CM)</strong></td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="infrared" name="infrared" value="1"
                                                class="form-check-input">
                                            <label for="infrared" class="form-check-label">Infrared</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="other_checkbox" name="other_checkbox" value="1"
                                                <?= !empty(@$fisioterapi['other_desc']) ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="other_checkbox" class="form-check-label">Lain-lain:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="other_desc" name="other_desc"
                                            value="<?= @$fisioterapi['other_desc'] ?>"
                                            style="<?= empty(@$fisioterapi['other_desc']) ? 'display:none;' : '' ?>"
                                            <?= empty(@$fisioterapi['other_desc']) ? 'disabled' : '' ?>>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        <tr>
                            <td><strong>Anjuran</strong></td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <input type="text" class="form-control" id="suggestion" name="suggestion"
                                            value="<?= @$fisioterapi['suggestion'] ?>" style="width: 100%;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Evaluasi</strong></td>
                            <td>
                                <div class="row align-items-center">

                                    <div class="col">
                                        <input type="number" class="form-control" id="evaluation_qty"
                                            name="evaluation_qty" value="<?= @$fisioterapi['evaluation_qty'] ?>"
                                            style="width: 100%;">
                                    </div>
                                    <div class="col-auto">
                                        <label for="kali">kali</label>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td><strong>Suspek Penyakit akibat Kerja</strong></td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="radio" id="suspect_yes" name="suspect_worker" value="1"
                                                <?= empty(@$suspect_worker) ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="suspect_yes" class="form-check-label">Ya</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="radio" id="suspect_no" name="suspect_worker" value="0"
                                                <?= !empty(@$suspect_worker) ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="suspect_no" class="form-check-label">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-2" id="suspect_details_container"
                                    style="display: <?= empty(@$suspect_worker) ? 'none' : 'block'; ?>">

                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <label for="suspect_worker">Detail:</label>
                                        </div>

                                        <div class="col">
                                            <input type="text" class="form-control" id="suspect_worker"
                                                name="suspect_worker"
                                                value="<?= !empty(@$suspect_worker) ? @$suspect_worker : '' ?>"
                                                <?= empty(@$suspect_worker) ? 'disabled' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" id="save-form-isioterapi" name="save"
                    data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary me-2">
                    <i class="fa fa-check-circle"></i> Simpan
                </button>
                <button type="button" id="edit-form-isioterapi" name="update"
                    data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning me-2">
                    <i class="fa fa-check-circle"></i> Edit
                </button>
                <button type="button" id="edit-form-isioterapi" name="signrm" onclick="signRM()"
                    data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning">
                    <i class="fa fa-signature"></i> Print
                </button>

            </div>

        </form>

        <div class="row mb-2">
            <div class="col-3" align="center">
                <br>
                <div>Pasien</div>
                <div id="qrcode-container">
                    <div id="qrcode"></div>
                </div>

            </div>
            <div class="col"></div>
            <div class="col-3" align="center">
                <div>
                    <div id="datetime-now"></div><br> Dokter Penanggungjawab
                </div>
                <div>
                    <div class="pt-2 pb-2" id="qrcode1"></div>
                </div>
                <div id="validator-ttd"></div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

<script>
    $(document).ready(function() {
        $("#datetime-now").html(`Surakarta,${moment(new Date()).format("DD/MM/YYYY HH:mm:ss")}`)

        function toggleOtherDesc() {
            if ($('#other_checkbox').is(':checked')) {
                $('#other_desc').show().prop('disabled', false);
            } else {
                $('#other_desc').hide().val('').prop('disabled', true);
            }
        }

        toggleOtherDesc();

        $('#other_checkbox').on('change', function() {
            toggleOtherDesc();
        });


        function toggleSuspectDetails() {
            if ($('#suspect_no').is(':checked')) {
                $('#suspect_details_container').show();
                $('#suspect_worker').prop('disabled', false);
            } else if ($('#suspect_yes').is(':checked')) {
                $('#suspect_details_container').hide();
                $('#suspect_worker').val('').prop('disabled', true);
            }
        }


        toggleSuspectDetails();


        $('input[name="suspect_worker"]').on('change', function() {
            toggleSuspectDetails();
        });

        <?php $dataJson = json_encode($visit); ?>
        let data = <?php echo $dataJson; ?>;

        <?php $dataJson1 = json_encode(@$diagnosa); ?>
        let data2 = <?php echo $dataJson1; ?>;

        console.log(data2);


        var qrcode = new QRCode(document.getElementById("qrcode1"), {
            text: `${data?.pengirim_name ?? data?.diantar_oleh}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: `${data?.fullname}`, // Your text here
            width: 70,
            height: 70,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H // High error correction
        });


    })
</script>


<script type="text/javascript">
    window.print();
</script>

</html>