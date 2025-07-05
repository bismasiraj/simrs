<?php
if (!empty($sketdiag['val'])) :
?>
<div class="page-break portrait">

    <body>
        <div class="container-fluid mt-5">
            <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
                autocomplete="off">
                <?php csrf_field(); ?>
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="90px">
                    </div>
                    <div class="col mt-2" align="center">
                        <h3><?= @$kop['name_of_org_unit'] ?></h3>
                        <p><?= @$kop['contact_address'] ?? "-" ?>, <?= @$kop['phone'] ?? "-" ?>, Fax:
                            <?= @$kop['fax'] ?? "-" ?>,
                            <?= @$kop['kota'] ?? "-" ?></p>
                        <p><?= @$kop['sk'] ?? "-" ?></p>

                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="90px">
                    </div>
                </div>
                <div class="row">
                    <h3 class="text-center">Surat Keterangan Diagnosis</h3>
                </div>
                <div class="row">
                    <h5 class="text-start">Informasi Pasien</h5>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <b>Nomor RM</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['no_registration']; ?></p>
                            </td>
                            <td>
                                <b>Nama Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['diantar_oleh']; ?></p>
                            </td>
                            <td>
                                <b>Jenis Kelamin</b>
                                <p class="m-0 mt-1 p-0">
                                    <?= (@$visit['gender'] === 1 || @$visit['gender'] === '1') ? 'Laki-laki' : 'Perempuan'; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Tanggal Lahir (Usia)</b>
                                <p class="m-0 mt-1 p-0"><?= substr(@$visit['tgl_lahir'], 0, 10); ?></p>

                            </td>
                            <td colspan="2">
                                <b>Alamat Pasien</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visitor_address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>DPJP</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['fullname'] ?></p>

                            </td>
                            <td>
                                <b>Department</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic'];; ?></p>

                            </td>
                            <td>
                                <b>Tanggal Masuk</b>
                                <p class="m-0 mt-1 p-0"><?= @$visit['visit_date']; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mb-2">
                    <h2 class="text-center"><b><u>SURAT KETERANGAN DIAGNOSIS</u></b></h2>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        Yang bertanda tangan di bawah ini dokter RS PKU Muhammadiyah Sampangan Surakarta menerangkan
                        bahwa:
                    </div>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= @$sketdiag['val']['diantar_oleh']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= substr(@$visit['tgl_lahir'], 0, 10); ?>
                                (<?= @$sketdiag['val']['usia']; ?>)</p>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0">
                                <?= (@$visit['gender'] === 1 || @$visit['gender'] === '1') ? 'Laki-laki' : 'Perempuan'; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= @$sketdiag['val']['visitor_address']; ?></p>
                        </td>
                    </tr>

                </table>
                <p>Telah diperiksa di RS PKU Muhammadiyah Sampangan Surakarta pada</p>
                <table class="table table-borderless">
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= @$visit['visit_date']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosis</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= @$sketdiag['val']['teraphy_desc']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Tindakan</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= @$sketdiag['val']['tindakan']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Terapi</td>
                        <td>:</td>
                        <td>
                            <p class="m-0 mt-1 p-0"><?= @$sketdiag['val']['farmakoterapi']; ?></p>
                        </td>
                    </tr>
                </table>

                <div class="row">
                    <div class="col">
                        Demikian harap menjadikan periksa.
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-auto" align="center">
                        <div>Dokter yang memeriksa,</div>
                        <div class="mb-1">
                            <div id="qrcode_cetak_diag"></div>
                        </div>
                        <div><?= @$visit['fullname']; ?></div>
                    </div>
                </div>
            </form>
        </div>
    </body>

    <?php if (!is_null(@$sketdiag['val']['valid_user'])) {
        ?>
    <script>
    // var qrcode = new QRCode(document.getElementById("qrcode"), {
    //     text: '<?= @$sketdiag['val']['valid_user'] . ': ' . @$sketdiag['val']['valid_date']; ?>',
    //     width: 75,
    //     height: 75,
    //     colorDark: "#000000",
    //     colorLight: "#ffffff",
    //     correctLevel: QRCode.CorrectLevel.H // High error correction
    // });



    const base64ttd_cetak_diag = <?= json_encode(@$sketdiag['val']['ttd_dok']); ?>;
    if (base64ttd_cetak_diag) {
        $('#qrcode_cetak_diag').html(`<img src="${base64ttd_cetak_diag}" alt="QR Code" width="300">`);
    } else {
        $('#qrcode_cetak_diag').html('');
    }
    </script>
    <?php
        } ?>
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
            size: A5;
            /* Set the page size to A5 */
            margin: 10mm;
            /* Adjust the margin if needed */
        }

        body {
            font-family: Arial, sans-serif;
            transform: scale(0.7);
            transform-origin: top left;
            width: 100%;
        }

        /* Additional styles for printed content */
        .print-header,
        .print-footer {
            text-align: center;
        }

        .content {
            padding: 20px;
        }
    }
    </style>
    <script type="text/javascript">
    //window.print();
    </script>


</div>

<?php
endif;
?>