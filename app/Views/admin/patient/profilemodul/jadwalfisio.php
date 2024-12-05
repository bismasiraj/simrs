<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
.form-control.print-hidden-form:focus,
.input-group-text:focus {
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    border-color: #80bdff;
    outline: none;
}

.form-control.print-hidden-form:disabled,
.form-control.print-hidden-form[readonly] {
    background-color: #FFF;
    opacity: 1;
}

.form-control.print-hidden-form,
.input-group-text {
    background-color: #fff;
    border: 1px solid #fff;
    font-size: 12px;
}

.tarif-fisio {
    width: 100% !important;
    /* Ensure the Select2 container takes full width */
}

.select2-selection--single {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0.5rem;
    min-height: 38px;
}

.select2-selection__rendered {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>

<div class="tab-pane" id="jadwalFisiomodul" role="tabpanel">
    <div class="row">
        <div id="load-content-jadwalFisio" class="col-12 center-spinner"></div>
        <div id="contentToHide-jadwalFisio" class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                        'visit' => $visit,
                    ]);
                    ?>
                </div>
                <!--./col-lg-6-->
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <div class="accordion mt-4">
                        <div id="JfisioDocument" class="card border-1 rounded-4 m-4 p-4" style="display: none;">
                            <div class="card-body">
                                <ul class="nav nav-underline mb-3"
                                    style="border-bottom: 2px solid var(--bs-border-color);">
                                    <li class="nav-item text-center flex-fill">
                                        <a class="nav-link" href="#coverSendFisioterapi" data-bs-toggle="tab">Surat
                                            Pengantar Pemeriksaan Fisioterapi</a>
                                    </li>
                                    <li class="nav-item text-center flex-fill">
                                        <a class="nav-link active" href="#rawatJalanRM" data-bs-toggle="tab">Formulir
                                            Klaim
                                            Rawat Jalan Rehab Medik</a>
                                    </li>

                                    <li class="nav-item text-center flex-fill">
                                        <a class="nav-link" href="#formulirRequestFisio" data-bs-toggle="tab">Formulir
                                            Permintaan Fisioterapi</a>
                                    </li>
                                    <li class="nav-item text-center flex-fill">
                                        <a class="nav-link" href="#formulirUjiFisio" data-bs-toggle="tab">Formulir
                                            Uji Rehab Medik</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="coverSendFisioterapi">
                                        <div class="card-body">
                                            <div class="modal-body pt0 pb0">
                                                <div class="container-fluid mt-5">
                                                    <div class="row">
                                                        <div class="col-auto" align="center">
                                                            <img class="mt-2"
                                                                src="<?= base_url('assets/img/logo.png') ?>"
                                                                width="70px">
                                                        </div>
                                                        <div class="col mt-2">
                                                            <h3 class="kop-name" id="kop-name">
                                                                <?= @$kop['name_of_org_unit'] ?>
                                                            </h3>
                                                            <p class="kop-address" id="kop-address">
                                                                <?= @$kop['contact_address'] ?></p>
                                                        </div>
                                                        <div class="col-auto" align="center">
                                                            <img class="mt-2"
                                                                src="<?= base_url('assets/img/kemenkes.png') ?>"
                                                                width="70px">
                                                            <img class="mt-2"
                                                                src="<?= base_url('assets/img/kars-bintang.png') ?>"
                                                                width="70px">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div
                                                        style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="text-center pt-2"><?= @$title; ?></h6>
                                                    </div>
                                                    <div class="row">
                                                        <h5 class="text-start">Informasi Pasien</h5>
                                                    </div>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <b>Nomor RM</b>
                                                                    <div id="no_registration-val-coverfisio"
                                                                        name="no_registration">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <b>Nama Pasien</b>
                                                                    <div id="diantar_oleh-val-coverfisio"
                                                                        name="name_of_pasien" class="thename">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <b>Jenis Kelamin</b>
                                                                    <div name="gender" id="gender-val-coverfisio">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>Tanggal Lahir (Usia)</b>
                                                                    <div id="age-val-coverfisio" name="age"></div>
                                                                </td>
                                                                <td colspan="2">
                                                                    <b>Alamat Pasien</b>
                                                                    <div id="contact_address-val-coverfisio"
                                                                        name="contact_address" class="contact_address">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <b>DPJP</b>
                                                                    <div id="fullname-val-coverfisio" name="fullname">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <b>Department</b>
                                                                    <div id="clinic_id-val-coverfisio" name="clinic_id">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <b>Tanggal Masuk</b>
                                                                    <div id="visit_date-val-coverfisio"
                                                                        name="visit_date">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <div class="col text-center">
                                                            <h3><b><u id="content-title" class="content-title">Surat
                                                                        Pengantar Pemeriksaan Fisioterapi</u></b>
                                                            </h3>
                                                        </div>
                                                    </div>

                                                    <form id="form-fisioterapi-data-cover">
                                                        <input id="vactination_date-fisio-val-coverfisio"
                                                            name="vactination_date" placeholder="" type="hidden"
                                                            class="form-control block" />

                                                        <input id="org_unit_code-val-coverfisio" name="org_unit_code"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="vactination_id-fisio-val-coverfisio"
                                                            name="vactination_id" placeholder="" type="hidden"
                                                            class="form-control block" />
                                                        <input id="no_registration-fisio-val-coverfisio"
                                                            name="no_registration" placeholder="" type="hidden"
                                                            class="form-control block" />
                                                        <input id="visit_id-fisio-val-coverfisio" name="visit_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="bill_id-fisio-val-coverfisio" name="bill_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="clinic_id-fisio-val-coverfisio" name="clinic_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="terlayani-fisio-val-coverfisio" name="terlayani"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="employee_id-fisio-val-coverfisio" name="employee_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="patient_category_id-fisio-val-coverfisio"
                                                            name="patient_category_id" placeholder="" type="hidden"
                                                            class="form-control block" />
                                                        <input id="tarif_id-fisio-val-coverfisio" name="tarif_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="validation-fisio-val-coverfisio" name="validation"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="description-fisio-val-coverfisio" name="description"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="thename-fisio-val-coverfisio" name="thename"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="theaddress-fisio-val-coverfisio" name="theaddress"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="theid-fisio-val-coverfisio" name="theid"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="isrj-fisio-val-coverfisio" name="isrj" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="ageyear-fisio-val-coverfisio" name="ageyear"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="agemonth-fisio-val-coverfisio" name="agemonth"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="ageday-fisio-val-coverfisio" name="ageday"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="status_pasien_id-fisio-val-coverfisio"
                                                            name="status_pasien_id" placeholder="" type="hidden"
                                                            class="form-control block" />
                                                        <input id="gender-fisio-val-coverfisio" name="gender"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="doctor-fisio-val-coverfisio" name="doctor"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="kal_id-fisio-val-coverfisio" name="kal_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="class_room_id-fisio-val-coverfisio"
                                                            name="class_room_id" placeholder="" type="hidden"
                                                            class="form-control block" />
                                                        <input id="bed_id-fisio-val-coverfisio" name="bed_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="tarif_name-fisio-val-coverfisio" name="tarif_name"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="terapi_desc-fisio-val-coverfisio" name="terapi_desc"
                                                            placeholder="" type="hidden" class="form-control block" />

                                                        <div class="p-3 mt-3">
                                                            <div class="row">
                                                                <div class="col">
                                                                    Dengan hormat, <br>
                                                                    Bersama ini kami kirimkan pasien :
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label for="sa" class="col-sm-3 col-form-label">Nama
                                                                    pasien</label>
                                                                <label for="sa"
                                                                    class="col-sm-auto col-form-label">:</label>
                                                                <div class="col pt-2">
                                                                    <div id="diantar_oleh-val2-coverfisio"
                                                                        class="thename">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label for="sa"
                                                                    class="col-sm-3 col-form-label">Umur</label>
                                                                <label for="sa"
                                                                    class="col-sm-auto col-form-label">:</label>
                                                                <div class="col pt-2">
                                                                    <div id="age-val2-coverfisio" class="age"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label for="sa" class="col-sm-3 col-form-label">No.
                                                                    Register</label>
                                                                <label for="sa"
                                                                    class="col-sm-auto col-form-label">:</label>
                                                                <div class="col pt-2">
                                                                    <div id="no_registration-val2-coverfisio"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label for="sa"
                                                                    class="col-sm-3 col-form-label">Alamat</label>
                                                                <label for="sa"
                                                                    class="col-sm-auto col-form-label">:</label>
                                                                <div class="col pt-2">
                                                                    <div id="contact_address-val2-coverfisio"
                                                                        class="theaddress"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label for="sa"
                                                                    class="col-sm-3 col-form-label">Diagnosis
                                                                    sementara</label>
                                                                <label for="sa"
                                                                    class="col-sm-auto col-form-label">:</label>
                                                                <div class="col pt-2">
                                                                    <div id="diagnosis-fungsi-output-coverfisio"></div>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col">
                                                                    Mohon dapat diberikan tindakan / pemeriksaan : <br>
                                                                    <div class="form-check"
                                                                        style="display: flex; align-items: center;">
                                                                        <input type="checkbox"
                                                                            id="ultrasound_checkbox-fisio-cover"
                                                                            name="ultrasound_checkbox"
                                                                            class="form-check-input">
                                                                        <label for="ultrasound_checkbox-fisio-cover"
                                                                            class="form-check-label"
                                                                            style="width: 100px;">Ultrasound</label>
                                                                        <input type="text" id="ultrasound-fisio-cover"
                                                                            name="ultrasound"
                                                                            class="form-control print-hidden-form">
                                                                    </div>

                                                                    <div class="form-check"
                                                                        style="display: flex; align-items: center;">
                                                                        <input type="checkbox"
                                                                            id="tens_checkbox-fisio-cover"
                                                                            name="tens_checkbox"
                                                                            class="form-check-input">
                                                                        <label for="tens_checkbox-fisio-cover"
                                                                            class="form-check-label"
                                                                            style="width: 100px;">TENS</label>
                                                                        <input type="text" id="tens-fisio-cover"
                                                                            name="tens"
                                                                            class="form-control print-hidden-form">
                                                                    </div>

                                                                    <div class="form-check"
                                                                        style="display: flex; align-items: center;">
                                                                        <input type="checkbox"
                                                                            id="exercise_checkbox-fisio-cover"
                                                                            name="exercise_checkbox"
                                                                            class="form-check-input">
                                                                        <label for="exercise_checkbox-fisio-cover"
                                                                            class="form-check-label"
                                                                            style="width: 100px;">Exercise</label>
                                                                        <input type="text" id="exercise-fisio-cover"
                                                                            name="exercise"
                                                                            class="form-control print-hidden-form">
                                                                    </div>

                                                                    <div class="form-check"
                                                                        style="display: flex; align-items: center;">
                                                                        <input type="checkbox"
                                                                            id="infrared_checkbox-fisio-cover"
                                                                            name="infrared_checkbox"
                                                                            class="form-check-input">
                                                                        <label for="infrared_checkbox-fisio-cover"
                                                                            class="form-check-label"
                                                                            style="width: 100px;">Infrared</label>
                                                                        <input type="text" id="infrared-fisio-cover"
                                                                            name="infrared"
                                                                            class="form-control print-hidden-form">
                                                                    </div>

                                                                    <div class="form-check"
                                                                        style="display: flex; align-items: center;">
                                                                        <input type="checkbox"
                                                                            id="other_checkbox-fisio-cover"
                                                                            name="other_checkbox"
                                                                            class="form-check-input">
                                                                        <label for="other_checkbox-fisio-cover"
                                                                            class="form-check-label"
                                                                            style="width: 100px;">Lain-lain:</label>
                                                                        <input type="text" id="other_desc-fisio-cover"
                                                                            name="other_desc"
                                                                            class="form-control print-hidden-form">
                                                                    </div>



                                                                    <!-- <span id="hasil-tindakan-val2-coverfisio"></span> -->
                                                                    <br>
                                                                    Atas perhatian dan kerjasamanya kami ucapkan terima
                                                                    kasih.
                                                                    <br>
                                                                    Catatan:<input type="text"
                                                                        class="form-control print-hidden-form"
                                                                        name="description"
                                                                        id="description-val-coverfisio"></input>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form>

                                                    <div class="row mb-2 hidden-show-ttd" hidden>
                                                        <div class="col-3" align="center">
                                                            <br>
                                                            <br><br>
                                                            <i class="hidden-show-ttd" hidden>Dicetak pada tanggal
                                                                <?= tanggal_indo(date('Y-m-d')); ?></i>

                                                        </div>
                                                        <div class="col"></div>
                                                        <div class="col-3" align="center">
                                                            <div>
                                                                <div id="datetime-now" class="datetime-now"></div><br>
                                                                Dokter
                                                            </div>
                                                            <div>
                                                                <div class="pt-2 pb-2" id="qrcode-fisio-conver-dokter">
                                                                </div>
                                                            </div>
                                                            <div id="validator-ttd"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <span id="avttotal_score"></span>
                                            </div>
                                            <div class="modal-footer d-flex">
                                                <button type="button" id="save-form-fisioterapi-cover" name="save"
                                                    data-loading-text="<?php echo lang('processing') ?>"
                                                    class="btn btn-primary me-2">
                                                    <i class="fa fa-check-circle"></i> Simpan
                                                </button>
                                                <button type="button" id="print-form-fisioterapi-cover"
                                                    data-loading-text="<?php echo lang('processing') ?>"
                                                    class="btn btn-success">
                                                    <i class="fas fa-print"></i> Print
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="rawatJalanRM">
                                        <div class="card-body">
                                            <div class="modal-body pt0 pb0">
                                                <div class="container-fluid mt-5">
                                                    <div class="row">
                                                        <div class="col-auto" align="center">
                                                            <img class="mt-2"
                                                                src="<?= base_url('assets/img/logo.png') ?>"
                                                                width="70px">
                                                        </div>
                                                        <div class="col mt-2">
                                                            <h3 class="kop-name" id="kop-name">
                                                                <?= @$kop['name_of_org_unit'] ?>
                                                            </h3>
                                                            <p class="kop-address" id="kop-address">
                                                                <?= @$kop['contact_address'] ?></p>
                                                        </div>
                                                        <div class="col-auto" align="center">
                                                            <img class="mt-2"
                                                                src="<?= base_url('assets/img/kemenkes.png') ?>"
                                                                width="70px">
                                                            <img class="mt-2"
                                                                src="<?= base_url('assets/img/kars-bintang.png') ?>"
                                                                width="70px">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div
                                                        style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                                                    </div>
                                                    <div class="row">
                                                        <h6 class="text-center pt-2"><?= @$title; ?></h6>
                                                    </div>
                                                    <div class="p-3">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p><strong>I. Diisi oleh Pasien/Peserta</strong></p>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                                <p><strong>No. RM/Reg :</strong>
                                                                    <?= $visit['no_registration'] ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding: 5px; width: 200px;"><strong>Nama
                                                                            Pasien</strong></td>
                                                                    <td style="padding: 5px;">
                                                                        <?= @$visit['diantar_oleh'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px;"><strong>Tanggal
                                                                            Lahir</strong></td>
                                                                    <td style="padding: 5px;">
                                                                        <?= @$visit['date_of_birth'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px;"><strong>Alamat</strong>
                                                                    </td>
                                                                    <td style="padding: 5px;">
                                                                        <?= @$visit['contact_address'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px;"><strong>Telp/HP</strong>
                                                                    </td>
                                                                    <td style="padding: 5px;">
                                                                        <?= @$visit['phone_number'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px;"><strong>Hubungan dengan
                                                                            bertanggung</strong></td>
                                                                    <td style="padding: 5px;">
                                                                        <?= @$visit['family_notes'] ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <form id="form-fisioterapi-data">
                                                        <input id="vactination_date-fisio-val" name="vactination_date"
                                                            placeholder="" type="hidden" class="form-control block" />

                                                        <input id="org_unit_code-val" name="org_unit_code"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="vactination_id-fisio-val" name="vactination_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="no_registration-fisio-val" name="no_registration"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="visit_id-fisio-val" name="visit_id" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="bill_id-fisio-val" name="bill_id" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="clinic_id-fisio-val" name="clinic_id" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="terlayani-fisio-val" name="terlayani" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="employee_id-fisio-val" name="employee_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="patient_category_id-fisio-val"
                                                            name="patient_category_id" placeholder="" type="hidden"
                                                            class="form-control block" />
                                                        <input id="tarif_id-fisio-val" name="tarif_id" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="validation-fisio-val" name="validation"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="description-fisio-val" name="description"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="thename-fisio-val" name="thename" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="theaddress-fisio-val" name="theaddress"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="theid-fisio-val" name="theid" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="isrj-fisio-val" name="isrj" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="ageyear-fisio-val" name="ageyear" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="agemonth-fisio-val" name="agemonth" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="ageday-fisio-val" name="ageday" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="status_pasien_id-fisio-val" name="status_pasien_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="gender-fisio-val" name="gender" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="doctor-fisio-val" name="doctor" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="kal_id-fisio-val" name="kal_id" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="class_room_id-fisio-val" name="class_room_id"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="bed_id-fisio-val" name="bed_id" placeholder=""
                                                            type="hidden" class="form-control block" />
                                                        <input id="tarif_name-fisio-val" name="tarif_name"
                                                            placeholder="" type="hidden" class="form-control block" />
                                                        <input id="terapi_desc-fisio-val" name="terapi_desc"
                                                            placeholder="" type="hidden" class="form-control block" />

                                                        <div class="p-3 mt-3">
                                                            <p><strong>II. Diisi oleh Dokter Sp.KFR</strong></p>
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="padding: 5px; width: 200px;">
                                                                            <strong>Tanggal Pelayanan</strong>
                                                                        </td>
                                                                        <td id="vactination_date-fisio"
                                                                            style="padding: 5px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;">
                                                                            <strong>Anamnesa</strong>
                                                                        </td>
                                                                        <td id="anamnase-output-fisio"
                                                                            style="padding: 5px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;"><strong>Pemeriksaan
                                                                                Fisik dan Uji</strong></td>
                                                                        <td style="padding: 5px;">
                                                                            <input type="text"
                                                                                class="form-control print-hidden-form"
                                                                                id="vas-fisio" name="vas">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;">
                                                                            <strong>Fungsi</strong>
                                                                        </td>
                                                                        <td style="padding: 5px;">
                                                                            <input type="text"
                                                                                class="form-control print-hidden-form"
                                                                                id="functions-fisio" name="functions">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;"><strong>Diagnosis
                                                                                Medis (ICD-10)</strong></td>
                                                                        <td id="diagnosis-medis-output-fisio"
                                                                            style="padding: 5px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;"><strong>Diagnosis
                                                                                Fungsi (ICD-10)</strong></td>
                                                                        <td id="diagnosis-fungsi-output-fisio"
                                                                            style="padding: 5px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;"><strong>Pemeriksaan
                                                                                Penunjang/Tata</strong></td>
                                                                        <td style="padding: 5px;">
                                                                            <div class="form-check">
                                                                                <input type="checkbox"
                                                                                    id="ultrasound_checkbox-fisio"
                                                                                    name="ultrasound_checkbox"
                                                                                    class="form-check-input">
                                                                                <label for="ultrasound_checkbox-fisio"
                                                                                    class="form-check-label">Ultrasound</label>
                                                                                <input type="text" id="ultrasound-fisio"
                                                                                    name="ultrasound"
                                                                                    class="form-control print-hidden-form"
                                                                                    style="display:none;">
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox"
                                                                                    id="tens_checkbox-fisio"
                                                                                    name="tens_checkbox"
                                                                                    class="form-check-input">
                                                                                <label for="tens_checkbox-fisio"
                                                                                    class="form-check-label">TENS</label>
                                                                                <input type="text" id="tens-fisio"
                                                                                    name="tens"
                                                                                    class="form-control print-hidden-form"
                                                                                    style="display:none;">
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox"
                                                                                    id="exercise_checkbox-fisio"
                                                                                    name="exercise_checkbox"
                                                                                    class="form-check-input">
                                                                                <label for="exercise_checkbox-fisio"
                                                                                    class="form-check-label">Exercise</label>
                                                                                <input type="text" id="exercise-fisio"
                                                                                    name="exercise"
                                                                                    class="form-control print-hidden-form"
                                                                                    style="display:none;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;"><strong>Laksana KFR
                                                                                (ICD 9 CM)</strong></td>
                                                                        <td style="padding: 5px;">
                                                                            <div class="form-check">
                                                                                <input type="checkbox"
                                                                                    id="infrared_checkbox-fisio"
                                                                                    name="infrared_checkbox"
                                                                                    class="form-check-input">
                                                                                <label for="infrared_checkbox-fisio"
                                                                                    class="form-check-label">Infrared</label>
                                                                                <input type="text" id="infrared-fisio"
                                                                                    name="infrared"
                                                                                    class="form-control print-hidden-form"
                                                                                    style="display:none;">
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="checkbox"
                                                                                    id="other_checkbox-fisio"
                                                                                    name="other_checkbox"
                                                                                    class="form-check-input">
                                                                                <label for="other_checkbox-fisio"
                                                                                    class="form-check-label">Lain-lain:</label>
                                                                                <input type="text" id="other_desc-fisio"
                                                                                    name="other_desc"
                                                                                    class="form-control print-hidden-form"
                                                                                    style="display:none;">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;">
                                                                            <strong>Anjuran</strong>
                                                                        </td>
                                                                        <td style="padding: 5px;">
                                                                            <input type="text"
                                                                                class="form-control print-hidden-form"
                                                                                id="suggestion-fisio" name="suggestion">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;">
                                                                            <strong>Evaluasi</strong>
                                                                        </td>
                                                                        <td style="padding: 5px;">
                                                                            <input type="number"
                                                                                class="form-control print-hidden-form"
                                                                                id="evaluation_qty-fisio"
                                                                                name="evaluation_qty" min="0"
                                                                                style="width: 100px;">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="padding: 5px;"><strong>Suspek
                                                                                Penyakit akibat Kerja</strong></td>
                                                                        <td style="padding: 5px;">
                                                                            <div class="form-check">
                                                                                <input type="radio"
                                                                                    id="suspect_yes-fisio"
                                                                                    name="suspect_worker-radio"
                                                                                    value="1" class="form-check-input">
                                                                                <label for="suspect_yes-fisio"
                                                                                    class="form-check-label">Ya</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input type="radio"
                                                                                    id="suspect_no-fisio"
                                                                                    name="suspect_worker-radio"
                                                                                    value="0" class="form-check-input">
                                                                                <label for="suspect_no-fisio"
                                                                                    class="form-check-label">Tidak</label>
                                                                            </div>
                                                                            <div id="suspect_details_container-fisio"
                                                                                style="display:none;">
                                                                                <label
                                                                                    for="suspect_worker-fisio">Detail:</label>
                                                                                <input type="text"
                                                                                    class="form-control print-hidden-form"
                                                                                    id="suspect_worker-fisio"
                                                                                    name="suspect_worker">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </form>



                                                    <div class="row mb-2 hidden-show-ttd" hidden>
                                                        <div class="col-3" align="center">
                                                            <br>
                                                            <div>Pasien</div>
                                                            <div>
                                                                <div id="qrcode-fisio-pasien"></div>
                                                            </div>

                                                        </div>
                                                        <div class="col"></div>
                                                        <div class="col-3" align="center">
                                                            <div>
                                                                <div id="datetime-now" class="datetime-now"></div><br>
                                                                Dokter Penanggungjawab
                                                            </div>
                                                            <div>
                                                                <div class="pt-2 pb-2" id="qrcode-fisio-dokter"></div>
                                                            </div>
                                                            <div id="validator-ttd"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <span id="avttotal_score"></span>
                                            </div>
                                            <div class="modal-footer d-flex">
                                                <button type="button" id="save-form-fisioterapi" name="save"
                                                    data-loading-text="<?php echo lang('processing') ?>"
                                                    class="btn btn-primary me-2">
                                                    <i class="fa fa-check-circle"></i> Simpan
                                                </button>
                                                <button type="button" id="print-form-fisioterapi"
                                                    data-loading-text="<?php echo lang('processing') ?>"
                                                    class="btn btn-success">
                                                    <i class="fas fa-print"></i> Print
                                                </button>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="formulirRequestFisio">
                                        <div class="card-body">
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
                                                            value="<?= @$visit['fullname'] ?? @$visit['fullname_inap']; ?>" />
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
                                                                    src="<?= base_url('assets/img/logo.png') ?>"
                                                                    width="70px">
                                                            </div>
                                                            <div class="col mt-2">
                                                                <h3 class="kop-name" id="kop-name">
                                                                    <?= @$kop['name_of_org_unit'] ?>
                                                                </h3>
                                                                <p class="kop-address" id="kop-address">
                                                                    <?= @$kop['contact_address'] ?></p>
                                                            </div>
                                                            <div class="col-auto" align="center">
                                                                <img class="mt-2"
                                                                    src="<?= base_url('assets/img/kemenkes.png') ?>"
                                                                    width="70px">
                                                                <img class="mt-2"
                                                                    src="<?= base_url('assets/img/kars-bintang.png') ?>"
                                                                    width="70px">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div
                                                            style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                                                        </div>

                                                        <!-- Isi Tabel -->
                                                        <div class="py-3 px-0 mx-0">
                                                            <table class="table table-bordered" style="width:100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <td class="text-center fw-bold">DIAGNOSA</td>
                                                                        <td colspan="7">:
                                                                            <?= isset($dataTables) && !empty($dataTables) ? implode(', ', array_column($dataTables, 'description')) : '-' ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center fw-bold">Permintaan
                                                                            Terapi</td>
                                                                        <td colspan="7">
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
                                                            <div class="d-flex mt-3">
                                                                <div class="col text-center">
                                                                    <button type="button" id="addJadwalFisio"
                                                                        name="addJadwalFisio" class="btn btn-primary">
                                                                        <i class="fas fa-plus"></i> <span>Tambah</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex mt-3 gap-3">
                                                                <button type="button" id="btn-save-jadwal-fisio"
                                                                    class="btn btn-primary ms-auto"><i
                                                                        class="fas fa-save"></i> Simpan</button>
                                                                <button type="button" id="print-jadwal-fisio"
                                                                    data-loading-text="<?php echo lang('processing') ?>"
                                                                    class="btn btn-success">
                                                                    <i class="fas fa-print"></i> Print
                                                                </button>
                                                            </div>

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
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="formulirUjiFisio">
                                        <div class="card-body">
                                            <div class="container-fluid mt-5">
                                                <!-- template header -->
                                                <div class="row">
                                                    <div class="col-auto" align="center">
                                                        <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>"
                                                            width="70px">
                                                    </div>
                                                    <div class="col mt-2">
                                                        <h3 class="kop-name" id="kop-name">
                                                            <?= @$kop['name_of_org_unit'] ?>
                                                        </h3>
                                                        <p class="kop-address" id="kop-address">
                                                            <?= @$kop['contact_address'] ?></p>
                                                    </div>
                                                    <div class="col-auto" align="center">
                                                        <img class="mt-2"
                                                            src="<?= base_url('assets/img/kemenkes.png') ?>"
                                                            width="70px">
                                                        <img class="mt-2"
                                                            src="<?= base_url('assets/img/kars-bintang.png') ?>"
                                                            width="70px">
                                                    </div>
                                                </div>
                                                <br>
                                                <div
                                                    style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                                                </div>
                                                <br>
                                                <b>Lembar Hasil Tindakan Uji Fungsi / Prosedur KFR <span
                                                        id="val-detail-treatment-result"></span></b>

                                                <!-- end of template header -->
                                                <form id="form-uji-rehab-medic">
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
                                                                    class="form-control datetimeflatpickr print-hidden-form"
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
                                                        <?= isset($visit['fullname']) ? $visit['fullname'] : 'Nama Pasien'; ?>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <i class="hidden-show-ttd" hidden>Dicetak pada tanggal
                                                    <?= tanggal_indo(date('Y-m-d')); ?></i>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex">
                                            <button type="button" id="save-form-uji-rehab" name="save"
                                                data-loading-text="<?php echo lang('processing') ?>"
                                                class="btn btn-primary me-2">
                                                <i class="fa fa-check-circle"></i> Simpan
                                            </button>
                                            <button type="button" id="print-uji-rehab"
                                                data-loading-text="<?php echo lang('processing') ?>"
                                                class="btn btn-success">
                                                <i class="fas fa-print"></i> Print
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="box-tab-tools text-center mt-4">
                            <a data-toggle="modal" id="add-new-doc-Jfisio" class="btn btn-primary btn-lg"
                                style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
                        </div>
                        <div class="panel-group" id="tabelsjadwalFisio">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                Jadwal Fisioterapi
                            </h3>
                            <form>
                                <table class="table table-bordered table-hover table-centered"
                                    style="text-align: center" id="tabelsJadwalFisioterapi">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Dokter</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="bodydataJadwalFisioterapi" class="table-group-divider">
                                        <!-- Isi tabel disini -->
                                    </tbody>
                                </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>