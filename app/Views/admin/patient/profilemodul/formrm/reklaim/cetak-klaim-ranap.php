<?php if (!empty($pplg['val'])): ?>
    <div class="page-break portrait">

        <?php $val = $pplg['val']; ?>



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

        <body>
            <div class="container-fluid mt-5">
                <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post"
                    autocomplete="off">
                    <div style="display: none;">
                        <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
                        <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
                        <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
                    </div>

                    <input type="hidden" name="body_id" id="body_id">
                    <input type="hidden" name="org_unit_code" id="org_unit_code">
                    <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
                    <input type="hidden" name="diagnosa_id" id="diagnosa_id">
                    <input type="hidden" name="visit_id" id="visit_id">
                    <input type="hidden" name="bill_id" id="bill_id">
                    <input type="hidden" name="class_room_id" id="class_room_id">
                    <input type="hidden" name="in_date" id="in_date">
                    <input type="hidden" name="exit_date" id="exit_date">
                    <input type="hidden" name="keluar_id" id="keluar_id">
                    <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
                    <input type="hidden" name="employee_id" id="employee_id">
                    <input type="hidden" name="description" id="description">
                    <input type="hidden" name="modified_date" id="modified_date">
                    <input type="hidden" name="modified_by" id="modified_by">
                    <input type="hidden" name="modified_from" id="modified_from">
                    <input type="hidden" name="status_pasien_id" id="status_pasien_id">
                    <input type="hidden" name="ageyear" id="ageyear">
                    <input type="hidden" name="agemonth" id="agemonth">
                    <input type="hidden" name="ageday" id="ageday">
                    <input type="hidden" name="theid" id="theid">
                    <input type="hidden" name="isrj" id="isrj">
                    <!-- <input type="hidden" name="gender" id="gender"> -->
                    <input type="hidden" name="kal_id" id="kal_id">
                    <input type="hidden" name="petugas_id" id="petugas_id">
                    <input type="hidden" name="petugas" id="petugas">
                    <?php csrf_field(); ?>
                    <div class="row">
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
                        </div>
                        <div class="col mt-2" align="center">
                            <h3>RS PKU Muhammadiyah Sampangan</h3>
                            <h3>Surakarta</h3>
                            <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK
                                No.449/0238/P-02/IORS/II/2018</p>
                        </div>
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
                        </div>
                    </div>
                    <div class="row">
                        <h3 class="text-center">Surat Perintah Rawat Inap</h3>
                    </div>
                    <div class="row">
                        <h5 class="text-start">Informasi Pasien</h5>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Nomor RM</b>
                                    <input type="text" class="form-control print-hidden-form" id="no_registration"
                                        name="no_registration">
                                    <div></div>
                                </td>
                                <td>
                                    <b>Nama Pasien</b>
                                    <input type="text" class="form-control print-hidden-form" id="thename" name="thename">
                                </td>
                                <td>
                                    <b>Jenis Kelamin</b>
                                    <select name="gender" id="gender" class="form-control print-hidden-form">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Tanggal Lahir (Usia)</b>
                                    <input type="text" class="form-control print-hidden-form" id="patient_age"
                                        name="patient_age">
                                </td>
                                <td colspan="2">
                                    <b>Alamat Pasien</b>
                                    <input type="text" class="form-control print-hidden-form" id="theaddress"
                                        name="theaddress">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>DPJP</b>
                                    <input type="text" class="form-control print-hidden-form" id="doctor" name="doctor">
                                </td>
                                <td>
                                    <b>Department</b>
                                    <input type="text" class="form-control print-hidden-form" id="clinic_id"
                                        name="clinic_id">
                                </td>
                                <td>
                                    <b>Tanggal Masuk</b>
                                    <input type="text" class="form-control print-hidden-form" id="examination_date"
                                        name="examination_date">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kelas</b>
                                    <input type="text" class="form-control print-hidden-form" id="kelas" name="kelas"
                                        value="<?= @$val['kelas']; ?>">
                                </td>
                                <td>
                                    <b>Bangsal/Kamar</b>
                                    <input type="text" class="form-control print-hidden-form" id="bangsal" name="bangsal"
                                        value="<?= @$val['name_of_class']; ?>">
                                </td>
                                <td>
                                    <b>Bed</b>
                                    <input type="text" class="form-control print-hidden-form" id="no_tt" name="no_tt"
                                        value="<?= @$val['no_tt']; ?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mb-2">
                        <h2 class="text-center"><b><u>SURAT PERINTAH RAWAT INAP</u></b></h2>
                    </div>
                    <div class="row mb-1">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <label for="nama" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p><?= @$val['nama']; ?></p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="date_of_birth" class="col-sm-2 col-form-label">Tanggal Lahir (Umur)</label>
                        <label for="date_of_birth" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p><?= @$val['date_of_birth']; ?> (<?= @$val['umur']; ?>)</p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="jeniskel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <label for="jeniskel" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p><?= @$val['jeniskel']; ?></p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <label for="alamat" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p><?= @$val['alamat']; ?></p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="diagnosis" class="col-sm-2 col-form-label">Indikasi Rawat Inap</label>
                        <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p><?= @$val['notes']; ?></p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis</label>
                        <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p><?= nl2br(htmlspecialchars(@$val['diagnosis'])); ?></p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="diagnosis" class="col-sm-2 col-form-label">Advice Dokter</label>
                        <label for="diagnosis" class="col-sm-auto col-form-label">:</label>
                        <div class="col">
                            <p id="other_notes"><?= nl2br(htmlspecialchars(@$val['other_notes'])); ?>
                            </p>
                        </div>
                    </div>
                    <!-- <div class="row mb-1">
                <label for="bangsal" class="col-sm-2 col-form-label">Mohon rawat inap di</label>
                <label for="bangsal" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="bangsal" name="bangsal" value="<?= $val['name_of_class']; ?>">
                </div>
            </div> -->
                    <!-- <div class="row mb-3">
                <label for="intruksi" class="col-sm-2 col-form-label">Instruksi Rawat Inap</label>
                <label for="intruksi" class="col-sm-auto col-form-label">:</label>
                <div class="col">
                    <input type="text" class="form-control" id="intruksi" name="intruksi" value="<?= $val['intruksi']; ?>">
                </div>
            </div> -->
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-auto" align="center">
                            <!-- <div>IGD / Poliklinik</div> -->
                            <div>Dokter yang merawat</div>
                            <div class="mb-1">
                                <div id="qrcode_suratRawatInap"></div>
                            </div>
                            <p class="p-0 m-0 py-1" id="qrcode_name_suratRawatInap">(<?= @$val['dokter']; ?>)</p>
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
            // var qrcode1 = new QRCode(document.getElementById("qrcode_suratRawatInap"), {
            //     text: "<?= isset($val['fullname']) ? $val['fullname'] : ''; ?>",
            //     width: 70,
            //     height: 70,
            //     colorDark: "#000000",
            //     colorLight: "#ffffff",
            //     correctLevel: QRCode.CorrectLevel.H // High error correction
            // });

            $("#qrcode_name_suratRawatInap").html(`(<?= $val['fullname']; ?>)`)

            const base64ttd_suratRawatInap = <?= json_encode($pplg['ttd_dok']); ?>;
            if (base64ttd_suratRawatInap) {
                $('#qrcode_suratRawatInap').html(`<img src="${base64ttd_suratRawatInap}" alt="QR Code" width="300">`);
            } else {
                $('#qrcode_suratRawatInap').html(' ');
            }
        </script>

        <script>
            $(document).ready(function() {
                $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
                $("#no_registration").val("<?= $visit['no_registration']; ?>")
                $("#visit_id").val("<?= $visit['visit_id']; ?>")
                $("#clinic_id").val("<?= $val['name_of_clinic']; ?>")
                $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
                $("#in_date").val("<?= $visit['in_date']; ?>")
                $("#exit_date").val("<?= $visit['exit_date']; ?>")
                $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
                $("#patient_age").val("<?= substr(@$visit['tgl_lahir'], 0, 10); ?>")
                <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                ?>
                $("#examination_date").val("<?= $visit['visit_date']; ?>")
                $("#employee_id").val("<?= $visit['employee_id']; ?>")
                $("#description").val("<?= $visit['description']; ?>")
                $("#modified_date").val("<?= $val['modified_date']; ?>")
                $("#modified_by").val("<?= $val['modified_by']; ?>")
                $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
                $("#ageyear").val("<?= $visit['ageyear']; ?>")
                $("#agemonth").val("<?= $visit['agemonth']; ?>")
                $("#ageday").val("<?= $visit['ageday']; ?>")
                $("#thename").val("<?= $visit['diantar_oleh']; ?>")
                $("#theaddress").val("<?= $visit['visitor_address']; ?>")
                $("#theid").val("<?= $visit['pasien_id']; ?>")
                $("#isrj").val("<?= $visit['isrj']; ?>")
                $("#gender").val("<?= $visit['gender']; ?>")
                $("#doctor").val("<?= $val['dpjp']; ?>")
                $("#kal_id").val("<?= $visit['kal_id']; ?>")
                $("#other_notes").html((`<?= $val['other_notes']; ?>`).replace(/\n/g, "<br>"))
                $("#petugas_id").val("<?= user()->username; ?>")
                $("#petugas").val("<?= user()->fullname; ?>")
                //window.print();

            })
        </script>
    <?php endif; ?>

    </div>