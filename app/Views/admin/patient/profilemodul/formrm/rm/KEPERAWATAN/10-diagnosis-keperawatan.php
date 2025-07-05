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
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>assets\js\jquery.min.js"></script>
    <script src="<?= base_url() ?>assets\libs\jquery-ui-dist\jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>


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
        <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
            autocomplete="off">
            <div style="display: none;">
                <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
            </div>


            <?php csrf_field(); ?>
            <div class="row">
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                </div>
                <div class="col mt-2" align="center">
                    <h3><?= @$kop['name_of_org_unit'] ?></h3>
                    <!-- <h3>Surakarta</h3> -->
                    <p><?= @$kop['contact_address'] ?></p>
                </div>
                <div class="col-auto" align="center">
                    <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                </div>
            </div>
            <div class="row">
                <h3 class="text-center">Diagnosis Keperawatan - Bersihan Jalan Nafas Tidak Efektif</h3>
            </div>
            <div class="row">
                <h5 class="text-start">Informasi Pasien</h5>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>
                            <b>Nomor RM</b>
                            <div id="no_registration" name="no_registration"><?= @$visit['no_registration']; ?></div>
                        </td>
                        <td>
                            <b>Nama Pasien</b>
                            <div id="thename" name="thename" class="thename"><?= @$visit['diantar_oleh']; ?></div>
                        </td>
                        <td>
                            <b>Jenis Kelamin</b>
                            <div name="gender" id="gender">
                                <?= @$visit['name_of_gender']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Lahir (Usia)</b>
                            <div id="patient_age" name="patient_age"><?= @$visit['date_of_birth']; ?>
                                (<?= @$visit['age']; ?> )</div>
                        </td>
                        <td colspan="2">
                            <b>Alamat Pasien</b>
                            <div id="theaddress" name="theaddress" class="theaddress"><?= @$visit['contact_address']; ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>DPJP</b>
                            <div id="fullname" name="fullname"><?= @@$visit['fullname']; ?></div>
                        </td>
                        <td>
                            <b>Department</b>
                            <div id="clinic_id" name="clinic_id"><?= @$visit['clinic_id']; ?></div>
                        </td>
                        <td>
                            <b>Tanggal Masuk</b>
                            <div id="examination_date" name="examination_date"><?= @$visit['visit_date']; ?></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <table class="table table-bordered">
                    <thead class="fw-bold text-center">
                        <tr>
                            <td>Standar Diagnosa Keperawatan Indonesia (SDKI)</td>
                            <td>Standar Luaran Keperawatan Indonesia (SLKI)</td>
                            <td>Standar intervensi Keperawatan Indonesia (SIKI)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="px-3">
                                            <?php $groupedPenyebab = [];

                                            foreach ($data['sdki']['penyebab'] as $penyebab) {
                                                if (isset($penyebab['checked']) && $penyebab['checked'] == 1) {
                                                    $groupedPenyebab[$penyebab['type_name']][] = $penyebab['diag_val_name'];
                                                }
                                            }
                                            ?>

                                            <?php if (!empty($groupedPenyebab)): ?>
                                                <?php foreach ($groupedPenyebab as $type_name => $penyebabs): ?>
                                                    <b><?= htmlspecialchars($type_name); ?>:</b>
                                                    <ul>
                                                        <?php foreach ($penyebabs as $penyebab_name): ?>
                                                            <li><?= htmlspecialchars($penyebab_name); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>



                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="px-2">
                                            <?php $groupedGejala = [];

                                            foreach ($data['sdki']['gejala'] as $gejala) {
                                                if ($gejala['checked'] == 1) {
                                                    $groupedGejala[$gejala['type_name']][] = $gejala;
                                                }
                                            }

                                            foreach ($groupedGejala as $type_name => $gejalaItems): ?>
                                                <b><?= htmlspecialchars($type_name); ?></b>
                                                <div class="px-3">
                                                    <ul>
                                                        <?php foreach ($gejalaItems as $item): ?>
                                                            <li><?= htmlspecialchars($item['diag_val_name']); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                            </td>


                            <td>
                                <div class="row mb-2">

                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="px-2">
                                                <?php $groupedSlki = [];

                                                foreach ($data['slki']['data'] as $slki) {
                                                    if ($slki['checked'] == 1) {
                                                        $groupedSlki[$slki['type_name']][] = $slki;
                                                    }
                                                }

                                                foreach ($groupedSlki as $type_name => $slkiItems): ?>
                                                    <b><?= htmlspecialchars($type_name); ?></b>
                                                    <div class="px-3">
                                                        <ul>
                                                            <?php foreach ($slkiItems as $item): ?>
                                                                <li><?= htmlspecialchars($item['diag_val_name']); ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="px-2">
                                            <?php $groupedsiki = [];

                                            foreach ($data['siki']['data'] as $siki) {
                                                if ($siki['checked'] == 1) {
                                                    $groupedsiki[$siki['type_name']][] = $siki;
                                                }
                                            }

                                            foreach ($groupedsiki as $type_name => $sikiItems): ?>
                                                <b><?= htmlspecialchars($type_name); ?></b>
                                                <div class="px-3">
                                                    <ul>
                                                        <?php foreach ($slkiItems as $item): ?>
                                                            <li><?= htmlspecialchars($item['diag_val_name']); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mb-3">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Penanggung Jawab Dokumen</div>
                    <div class="mb-4">
                        <div id="qrcode"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="text-start">Evaluasi Asuhan Keperawatan</h4>
            </div>
            <table class="table table-bordered">
                <thead class="fw-bold">
                    <tr>
                        <td>SDKI</td>
                        <td colspan="2">SLKI</td>
                        <td>TL</td>
                        <td>SL</td>
                        <td>Evaluasi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5"><b>D.0001-Bersihan Jalan Nafas Tidak Efektif</b></td>
                        <td rowspan="13"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Positif</td>
                        <td>Batuk efektif</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Positif</td>
                        <td>Frekuensi nafas</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Positif</td>
                        <td>Pola nafas</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Produksi sputum</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Mengi</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Wheezing</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Meconium</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Dyspnea</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Ortopnea</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Sulit bicara</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Sianosis</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Negatif</td>
                        <td>Gelisah</td>
                        <td></td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col"></div>
                <div class="col-auto" align="center">
                    <div>Penanggung Jawab Dokumen</div>
                    <div class="mb-1">
                        <div id="qrcode1"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: 'a',
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: 'a',
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    $(document).ready(function() {
        $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
        $("#no_registration").val("<?= $visit['no_registration']; ?>")
        $("#visit_id").val("<?= $visit['visit_id']; ?>")
        $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
        $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
        $("#in_date").val("<?= $visit['in_date']; ?>")
        $("#exit_date").val("<?= $visit['exit_date']; ?>")
        $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        ?>
        $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#employee_id").val("<?= $visit['employee_id']; ?>")
        $("#description").val("<?= $visit['description']; ?>")
        $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#modified_by").val("<?= user()->username; ?>")
        $("#modified_from").val("<?= $visit['clinic_id']; ?>")
        $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
        $("#ageyear").val("<?= $visit['ageyear']; ?>")
        $("#agemonth").val("<?= $visit['agemonth']; ?>")
        $("#ageday").val("<?= $visit['ageday']; ?>")
        $("#thename").val("<?= $visit['diantar_oleh']; ?>")
        $("#theaddress").val("<?= $visit['visitor_address']; ?>")
        $("#theid").val("<?= $visit['pasien_id']; ?>")
        $("#isrj").val("<?= $visit['isrj']; ?>")
        $("#gender").val("<?= $visit['gender']; ?>")
        $("#doctor").val("<?= $visit['employee_id']; ?>")
        $("#kal_id").val("<?= $visit['kal_id']; ?>")
        $("#petugas_id").val("<?= user()->username; ?>")
        $("#petugas").val("<?= user()->fullname; ?>")
        $("#account_id").val("<?= $visit['account_id']; ?>")
    })
    $("#btnSimpan").on("click", function() {
        saveSignatureData()
        saveSignatureData1()
        console.log($("#TTD").val())
        $("#form").submit()
    })
    $("#btnEdit").on("click", function() {
        $("input").prop("disabled", false);
        $("textarea").prop("disabled", false);

    })
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
<script type="text/javascript">
    window.print();
</script>

</html>