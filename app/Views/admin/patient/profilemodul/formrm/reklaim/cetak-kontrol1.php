<?php if (!empty($skdp['pasien'])) : ?>
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
                        <h3 class="text-center">Surat Kontrol Pasien BPJS</h3>
                    </div>
                    <div class="row">
                        <h5 class="text-start">Informasi Pasien</h5>
                    </div>
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
                                    <p class="m-0 mt-1 p-0">
                                        <?= (@$visit['gender'] === 1 || @$visit['gender'] === '1') ? 'Laki-laki' : 'Perempuan'; ?>

                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Tanggal Lahir (Usia)</b>
                                    <p class="m-0 mt-1 p-0"><?= tanggal_indo(substr($visit['tgl_lahir'], 0, 10)); ?> <?= ' (' . @$visit['age'] . ')'; ?></p>
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
                                    <p class="m-0 mt-1 p-0"><?= @$visit['name_of_clinic']; ?></p>
                                </td>
                                <td>
                                    <b>Tanggal Masuk</b>
                                    <p class="m-0 mt-1 p-0"><?= @$visit['visit_date']; ?></p>
                                </td>
                            </tr>
                            <!-- <tr>
                        <td>
                            <b>Kelas</b>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= @$skdp['pasien']['kelas']; ?>">
                        </td>
                        <td>
                            <b>Bangsal/Kamar</b>
                            <input type="text" class="form-control" id="bangsal" name="bangsal" value="<?= @$skdp['pasien']['bangsal']; ?>">
                        </td>
                        <td>
                            <b>Bed</b>
                            <input type="text" class="form-control" id="no_tt" name="no_tt" value="<?= @$skdp['pasien']['no_tt']; ?>">
                        </td>
                    </tr> -->
                        </tbody>
                    </table>
                    <div class="row mb-5">
                        <b class="text-center">No. Surat Kontrol: <?= @$skdp['pasien']['nosuratkontrol']; ?></b>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            Yang bertanda tangan di bawah ini <?= @$skdp['pasien']['dpjp']; ?> <br> Menerangkan bahwa:
                        </div>
                    </div>
                    <div class="container px-5">
                        <div class="row mb-1">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <label for="nama" class="col-sm-auto col-form-label">:</label>
                            <div class="col">
                                <p class="m-0 mt-1 p-0"><?= @$skdp['pasien']['diantar_oleh']; ?></p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="diagnosis" class="col-sm-3 col-form-label">Diagnosis</label>
                            <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                            <div class="col">
                                <p class="m-0 mt-1 p-0"><?= @$skdp['pasien']['diagnya']; ?></p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="farmakologi" class="col-sm-3 col-form-label">Farmakoterapi</label>
                            <label for="farmakologi" class="col-sm-auto col-form-label">:</label>
                            <div class="col">
                                <?= isset($skdp['pasien']['farmakoterapi']) ? nl2br($skdp['pasien']['farmakoterapi']) : ''; ?>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="tgl_kontrol_selanjutnya" class="col-sm-3 col-form-label">Tanggal Kontrol
                                Selanjutnya</label>
                            <label for="tgl_kontrol_selanjutnya" class="col-sm-auto col-form-label">:</label>
                            <div class="col">
                                <p class="m-0 mt-1 p-0">
                                    <?= !empty($skdp['pasien']['tglrenckontrol']) ? date('Y-m-d', strtotime($skdp['pasien']['tglrenckontrol'])) : ''; ?>
                                </p>

                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="alasan_kontrol" class="col-sm-3 col-form-label">Alasan</label>
                            <label for="alasan_kontrol" class="col-sm-auto col-form-label">:</label>
                            <div class="col">
                                <p class="m-0 mt-1 p-0"><?= @$skdp['pasien']['notes']; ?></p>


                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p>Surat Keterangan ini digunakan untuk 1(satu) kali kunjungan dengan diagnosa di atas. <br>
                                Tanggal Rujukan Awal: (Berlaku 90 hari) <br>
                                Surat Rujukan Awal berlaku sampai tanggal:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-auto" align="center">
                            <div>DPJP</div>
                            <div class="mb-1">
                                <div id="qrcode_skdp"></div>
                            </div>
                            <div id="qrcode_name_skdp"></div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->


        </body>

    </div>
    <script>
        let val = <?= json_encode(@$skdp['pasien']); ?>;
    </script>
    <script>
        var dpjpText = "<?= isset($skdp['pasien']['fullname']) ? addslashes($skdp['pasien']['fullname']) : '' ?>";

        const base64ttd_cetak_kontrol1 = <?= json_encode(@$skdp['pasien']['ttd_dok']); ?>;
        if (base64ttd_cetak_kontrol1) {
            $('#qrcode_skdp').html(`<img src="${base64ttd_cetak_kontrol1}" alt="QR Code" width="300">`);
        } else {
            $('#qrcode_skdp').html('');
        }


        // var qrcode = new QRCode(document.getElementById("qrcode_skdp"), {
        //     text: dpjpText,
        //     width: 70,
        //     height: 70,
        //     colorDark: "#000000",
        //     colorLight: "#ffffff",
        //     correctLevel: QRCode.CorrectLevel.H // High error correction
        // });

        $("#qrcode_name_skdp").html(`(<?= $skdp['pasien']['fullname'] ?? "" ?>)`)
    </script>
    <script>
        $(document).ready(function() {
            $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
            $("#no_registration").val("<?= $visit['no_registration']; ?>")
            $("#visit_id").val("<?= $visit['visit_id']; ?>")
            $("#clinic_id").val("<?= @$skdp['pasien']['name_of_clinic']; ?>")
            $("#patient_age").val("<?= substr($visit['tgl_lahir'], 0, 10); ?>")
            $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
            $("#in_date").val("<?= $visit['in_date']; ?>")
            $("#exit_date").val("<?= $visit['exit_date']; ?>")
            $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
            <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
            ?>
            $("#examination_date").val("<?= $visit['visit_date']; ?>")
            $("#employee_id").val("<?= @$skdp['pasien']['fullname']; ?>")
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
            $("#doctor").val("<?= @$skdp['pasien']['fullname']; ?>")
            $("#kal_id").val("<?= $visit['kal_id']; ?>")
            $("#petugas_id").val("<?= user()->username; ?>")
            $("#petugas").val("<?= user()->fullname; ?>")
            $("#account_id").val("<?= $visit['account_id']; ?>")
            //window.print();
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


    </script>

    </html>
<?php endif ?>