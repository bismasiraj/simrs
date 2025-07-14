<?php if (!empty($fisio['value']['fioterapi_detail'])): ?>
    <div class="page-break portrait">

        <body>
            <div class="container-fluid mt-5">
                <!-- template header -->
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png"
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
                <br>
                <div class="row">
                    <h3 class="text-center pt-2 fw-bold">Lembar Hasil Uji Fungsi KFR
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
                <b>Lembar Hasil Tindakan Uji Fungsi / Prosedur KFR <span
                        id="val-detail-treatment-result"></span></b>

                <!-- end of template header -->
                <form id="formaddaujirehab">
                    <div id="inputformujirehab"></div>
                    <table class="table table-bordered">
                        <tr>
                            <td>Tanggal Pemeriksaan</td>
                            <td>
                                <input id="date-detail-vactination_date"
                                    name="vactination_date" type="hidden"
                                    class="form-control datetime-thems"
                                    placeholder="yyyy-mm-dd HH:mm ">
                                <input
                                    class="form-control datetimeflatpickr datepicker-tanggal-fisio print-hidden-form"
                                    type="text" id="flatdate-detail-vactination_date">


                                <!-- <input type="text" class="form-control print-hidden-form"
                                                        id="date-detail-vactination_date" name="vactination_date"> -->

                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosis Fungsional</td>
                            <td id="diagnosis-fungsi-uji-fisio"></td>
                        </tr>
                        <tr>
                            <td>Diagnosis Medis</td>
                            <td id="diagnosis-medis-uji-fisio"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Instrumen Uji Fungsi/ Prosedur KFR</td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text"
                                    class="form-control print-hidden-form"
                                    id="val-detail-treatment" name="treatment"></td>
                        </tr>
                        <tr>
                            <td>Hasil yang Didapat</td>
                            <td><input type="text"
                                    class="form-control print-hidden-form"
                                    id="val-detail-teraphy_result"
                                    name="teraphy_result"></td>
                        </tr>
                        <tr>
                            <td>Kesimpulan</td>
                            <td><input type="text"
                                    class="form-control print-hidden-form"
                                    id="val-detail-teraphy_conclusion"
                                    name="teraphy_conclusion">
                            </td>
                        </tr>
                        <tr>
                            <td>Rekomendasi</td>
                            <td><input type="text"
                                    class="form-control print-hidden-form"
                                    id="val-detail-teraphy_recomendation"
                                    name="teraphy_recomendation">
                            </td>
                        </tr>
                    </table>
                </form>

                <div class="row justify-content-end hidden-show-ttd" hidden>
                    <div class="col-auto" align="center">
                        <div class="mb-2">
                            <?= isset($organization['kota']) ? $organization['kota'] : 'Kota' ?>,
                            <?= tanggal_indo(date('Y-m-d')); ?></div>
                        <div class="mb-1">
                            <div id="qrcode-fisio-uji-pasien"></div>
                        </div>
                        <div id="qrcode-fisio-uji-pasien_name"></div>

                    </div>
                </div>
                <br><br>
                <i class="hidden-show-ttd" hidden>Dicetak pada tanggal
                    <?= tanggal_indo(date('Y-m-d')); ?></i>
            </div>
        </body>
    </div>
<?php endif; ?>