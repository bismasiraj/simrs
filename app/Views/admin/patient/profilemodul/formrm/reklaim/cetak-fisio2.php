<?php if (!empty($fisio['value']['fisioterapi'])): ?>
    <div class="page-break portrait">

        <body>
            <div class="container-fluid mt-5">
                <div class="row">
                    <form action="" method="post" autocomplete="off"
                        id="form-jadwal-fisio">
                        <input name="org_unit_code" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['org_unit_code']; ?>" />
                        <input name="vactination_id" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['vactination_id']; ?>" />
                        <input name="no_registration" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['no_registration']; ?>" />
                        <input name="visit_id" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['visit_id']; ?>" />
                        <input name="clinic_id" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['clinic_id']; ?>" />
                        <input name="employee_id" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['employee_id']; ?>" />
                        <input name="thename" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['thename']; ?>" />
                        <input name="theaddress" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['theaddress']; ?>" />
                        <input name="theid" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['theid']; ?>" />
                        <input name="isrj" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['isrj']; ?>" />
                        <input name="ageyear" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['ageyear']; ?>" />
                        <input name="agemonth" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['agemonth']; ?>" />
                        <input name="ageday" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['ageday']; ?>" />
                        <input name="doctor" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @@$visit['fullname'] ?? @$visit['fullname_inap']; ?>" />
                        <input name="class_room_id" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['class_room_id']; ?>" />
                        <input name="bed_id" placeholder="" type="hidden"
                            class="form-control block"
                            value="<?= @$visit['bed_id']; ?>" />
                        <input name="vactination_id" placeholder="" type="hidden"
                            class="form-control block" value=""
                            id="reqJadwal_vactination_id" />
                        <input name="evaluasi_qty" placeholder="" type="hidden"
                            class="form-control block" value=""
                            id="reqJadwal_evaluasi_qty" />



                        <!-- Header Organisasi -->
                        <div class="row">
                            <div class="col-auto" align="center">
                                <img class="mt-2"
                                    src="<?= base_url() ?>assets/img/logo.png"
                                    width="70px">
                            </div>
                            <div class="col mt-2">
                                <h3 class="kop-name text-center" id="kop-name">
                                    <?= @$kop['name_of_org_unit'] ?>
                                </h3>
                                <p class="kop-address text-center" id="kop-address">
                                    <?= @$kop['contact_address'] ?></p>
                            </div>
                            <div class="col-auto" align="center">
                                <img class="mt-2"
                                    src="<?= base_url() ?>assets/img/paripurna.png"
                                    width="100px">

                            </div>
                        </div>
                        <br>
                        <div
                            style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                        </div>

                        <div class="row">
                            <h3 class="text-center pt-2 fw-bold">Permintaan Fisioterapi
                            </h3>
                        </div>

                        <div class="row">
                            <h5 class="text-start">Informasi Pasien</h5>
                        </div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <b>No. RM / Nama Pasien / Jenis Kelamin</b>
                                        <p class="p-1"><?= @$visit['no_registration'] . ' / ' . @$visit['diantar_oleh'] . ' / ' . @$visit['name_of_gender']  ?></p>
                                    </td>
                                    <td style="width: 50%;">
                                        <b>Tanggal Masuk</b>
                                        <p class="p-1"><?= tanggal_indo(substr(@$visit['visit_date'], 0, 10)) ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">
                                        <b>Tanggal Lahir (Umur)</b>
                                        <p class="p-1"><?= tanggal_indo(substr($visit['tgl_lahir'], 0, 10)) . ' (' . @$visit['age'] . ')'; ?></p>
                                    </td>
                                    <td style="width: 50%;">
                                        <b>Alamat</b>
                                        <p class="p-1"><?= @$visit['visitor_address']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">
                                        <b>DPJP</b>
                                        <p class="p-1"><?= @$visit['fullname']; ?></p>
                                    </td>
                                    <td style="width: 50%;">
                                        <b>Department</b>
                                        <p class="p-1"><?= @$visit['name_of_clinic']; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <h4 class="text-center pt-2 fw-bold">Daftar Terapi
                            </h4>
                        </div>
                        <!-- Isi Tabel -->
                        <div class="py-3 px-0 mx-0">
                            <table class="table table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <td class="text-center fw-bold">DIAGNOSA</td>
                                        <td colspan="8" id="diagnosis-protokol">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center fw-bold">Permintaan
                                            Terapi</td>
                                        <td colspan="8">
                                            <input type="text"
                                                class="form-control print-hidden-form"
                                                name="treatment"
                                                id="input_treatment_jadwal_fisio">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle fw-bold"
                                            rowspan="2">PROGRAM
                                        </td>
                                        <td class="text-center align-middle fw-bold"
                                            rowspan="2">Deskripsi
                                        </td>
                                        <td class="text-center align-middle fw-bold"
                                            rowspan="2">TANGGAL
                                        </td>
                                        <td colspan="2"
                                            class="text-center align-middle fw-bold">
                                            WAKTU
                                            PELAYANAN</td>
                                        <td class="text-center align-middle fw-bold"
                                            rowspan="2">PASIEN
                                        </td>
                                        <td class="text-center align-middle fw-bold"
                                            rowspan="2">DOKTER
                                        </td>
                                        <td class="text-center align-middle fw-bold"
                                            rowspan="2">TERAPIS
                                        </td>
                                        <td class="text-center align-middle fw-bold row-to-hide"
                                            rowspan="2"><i class="fas fa-trash-alt"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Mulai</td>
                                        <td class="text-center">Selesai</td>
                                    </tr>
                                </thead>
                                <tbody id="tbody-jadwal-fisio">

                                </tbody>

                            </table>
                        </div>
                        <!-- Bagian Bawah -->
                        <div class="row mb-2">
                            <div class="col-3" align="center"></div>
                            <div class="col"></div>
                            <div class="col-3" align="center">
                                <div>
                                    <div id="datetime-now" class="datetime-now"></div>
                                    <br>
                                </div>
                                <div>
                                    <div class="pt-2 pb-2" id="qrcode1"></div>
                                </div>
                                <div id="validator-ttd"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </body>

    </div>
<?php endif; ?>