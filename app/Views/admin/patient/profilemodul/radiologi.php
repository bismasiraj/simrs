<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();

$db = db_connect();
$employee_id = user()->employee_id;

$result =
    $db->query(
        "
            SELECT EMPLOYEE_ID,FULLNAME 
            from EMPLOYEE_ALL  
            WHERE employee_id in (select employee_id from doctor_schedule where clinic_id = 'P016' and EMPLOYEE_ID = '$employee_id' )
            Order by fullname;
        "
    )->getRowArray() ?? [];

$result = array_change_key_case($result);
?>

<style>
.quill-editor-expertise {
    min-height: 120px;
}
</style>
<div class="tab-pane" id="rad" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="row mt-4">
                <!-- <div class="col-md-12">
                    <div id="listRequestRad" class="row">

                    </div>
                </div> -->
                <!-- <div class="col-md-12">
                    <div id="radiologiAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestRad()" class="btn btn-primary btn-lg" id="addRadBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Radiologi Online</a>
                    </div>
                </div> -->
            </div>

            <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="radiologi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#transaksi-rad-tab" data-bs-toggle="tab">Transaksi</a>
                            </li>
                            <?php if (user()->checkRoles(['dokterradiologi', 'superuser'])) : ?>
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#template-rad-tab" data-bs-toggle="tab">Template
                                    Ekspertise</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#table-cover-Sendlatter-rad" data-bs-toggle="tab">Surat
                                    Permohonan</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">

                            <div class="tab-pane fade " id="table-cover-Sendlatter-rad">
                                <div class="box-tab-tools text-center mt-4">
                                    <a data-toggle="modal" id="add-new-doc-coverkopLetterSendRad"
                                        class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i>
                                        Tambah Dokumen</a>
                                </div>
                                <h3 class="fw-bold" for="hasil-list">Hasil Permohonan Radiologi</h3>
                                <div class="table-responsive mt-4">
                                    <table class="table   table-hover">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th class="align-middle" style="width: 10%;">No.</th>
                                                <th class="align-middle">No Nota</th>
                                                <th class="align-middle" style="width: 25%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasilbodylistLatterRad" class="table-group-divider"></tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade show active" id="transaksi-rad-tab">
                                <div class="text-end">
                                    <button style="margin-right: 10px;" type="button" id="data-allradiologi"
                                        data-loading-text="processing" class="btn btn-outline-secondary">
                                        <i class="fa fa-history"></i> <span>Data Lengkap Hasil Radiologi</span>
                                    </button>
                                </div>
                                <div class="table-responsive mt-4 mb-4">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary" style="text-align: center;">
                                            <tr>
                                                <th class="text-center" style="width: 20%;">Tanggal</th>
                                                <th class="text-center" style="width: 60%;">Nama Tindakan</th>
                                                <!-- <th class="text-center"  style="width: 10%;">Tanggal</th class="text-center"> -->
                                                <!-- <th class="text-center"  style="width: 10%;">Dokter Pemeriksa</th class="text-center"> -->
                                                <th class="text-center" style="width: auto;">Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody id="radBody">
                                        </tbody>

                                    </table>
                                </div>
                                <form id="formSearchingTarifRad" action="" method="post" class="">
                                    <div class="box-body row mt-4">
                                        <input type="hidden" name="ci_csrf_token" value="">

                                        <div class="col-sm-12 col-md-12 mb-4">

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Nomor Pemeriksaan</label>
                                                        <div class="input-group">
                                                            <select id="notaNoRad" class="form-control">
                                                                <option value="%">Semua</option>
                                                            </select>
                                                            <button id="addNotaRadBtn" onclick="addNotaRad()"
                                                                type="button" class="btn btn-success">+</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0">
                                        <table class="table table-sm table-hover">
                                            <thead class="table-primary" style="text-align: center;">
                                                <tr>
                                                    <th class="text-center" rowspan="2" style="width: 5%;">No.</th
                                                        class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis
                                                        Tindakan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Dokter</th
                                                        class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Tgl Tindakan
                                                    </th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th
                                                        class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Jml</th
                                                        class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Total
                                                        Tagihan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 5%"></th
                                                        class="text-center">
                                                </tr>
                                            </thead>
                                            <tbody id="radChargesBody" class="table-group-divider">
                                            </tbody>
                                        </table>
                                        <?php if (user()->checkPermission("rad", "c")) : ?>
                                        <div class="col-md-10 m-4">
                                            <div class="form-group spppoli-to-hide">
                                                <label for="">Pemeriksaan</label>
                                                <!-- <div class="input-group">
                                                            <select id="searchTarifRad" class="form-control fit"
                                                                style="width: 70%; height: 100%;"></select>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm addcharges align-items-end"
                                                                onclick='addBillRad("searchTarifRad")'>
                                                                <i class="fa fa-plus"></i> Tambah
                                                            </button>
                                                        </div> -->
                                                <div class="input-group">
                                                    <select id="select-show-rad-tarif" class="form-select fit me-2"
                                                        style="width: 10%; display: none;"></select>

                                                    <select id="searchTarifRad" class="form-control fit"
                                                        style="width: 50%;"></select>

                                                    <select id="searchTarifRadDinamis" class="form-select fit"
                                                        style="width: 50%; display: none;"></select>

                                                    <button type="button" id="btnAddChargesRad"
                                                        class="btn btn-primary addcharges align-items-end d-none">
                                                        <i class="fa fa-plus"></i> Tambah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                        <?php if (user()->checkPermission('rad', 'c')) {
                                        ?>
                                        <div class="panel-footer text-end mb-4 spppoli-to-hide">
                                            <button type="button" id="formSaveBillRadBtn" name="save"
                                                data-loading-text="<?php echo lang('processing') ?>"
                                                class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i>
                                                <span>Save</span></button>
                                            <!-- <button type="button" id="formEditBillRadBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button> -->
                                            <button type="button" id="formsign"
                                                data-loading-text="<?php echo lang('processing') ?>"
                                                class="btn btn-warning pull-right"><i class="fa fa-signature"></i>
                                                <span>Save & Sign</span></button>
                                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                        </div>
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (user()->checkRoles(['dokterradiologi', 'superuser'])) : ?>
                            <div class="tab-pane fade" id="template-rad-tab">
                                <div class="container-fluid">
                                    <form action="" method="post" id="form-template-rad">
                                        <div class="input-group row g-2">
                                            <div class="col-md-6">
                                                <select class="form-select" id="template_nama_dokter" type="text"
                                                    name="nama_dokter" style="width: 100%; height: 100%">
                                                    <?php if (!empty($result)) : ?>
                                                    <option value="<?= $result['employee_id']; ?>">
                                                        <?= $result['fullname']; ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <!-- Dropdown for Category -->
                                            <div class="col-md-4">
                                                <select class="form-select" id="template_jenis_pemeriksaan"
                                                    name="jenis_pemeriksaan" style="width: 100%; height: 100%">
                                                    <option value="">SEMUA</option>
                                                    <option value="rontgen">RONTGEN</option>
                                                    <option value="usg">USG</option>
                                                    <option value="ct scan">CT SCAN</option>
                                                </select>
                                            </div>

                                            <!-- Search Button -->
                                            <div class="col-md-2">
                                                <button class="btn btn-primary w-100" type="button"
                                                    id="btn_cari_template_rad"><i class="fas fa-search-plus"></i>
                                                    Cari</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="" method="post" class="mt-3">
                                        <!-- Main Content with Tables -->
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="">
                                                    <table class="table table-striped" id="tableTemplate">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 1% !important;">
                                                                    No.</th>
                                                                <th class="text-center">Nama Template</th>
                                                                <th class="text-center" style="width: 1% !important;"><i
                                                                        class="fas fa-search-plus"></i></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="bodyContainerTemplateRad">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-1 rounded-4 m-4 p-4" id="coverkopSuratPengantarRad" style="display: none;">
                <div class="card-body">
                    <div class="modal-body pt0 pb0">
                        <div class="container-fluid mt-5">
                            <div class="row">
                                <div class="col-auto" align="center">
                                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                                </div>
                                <div class="col mt-2">
                                    <h3 class="kop-name-rad text-center" id="kop-name-rad">
                                    </h3>
                                    <p class="kop-address-rad text-center" id="kop-address-rad">
                                    </p>
                                </div>
                                <div class="col-auto" align="center">
                                    <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">

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
                                <div class="col text-center">
                                    <h3><b><u id="content-title" class="content-title">PERMOHONAN RADIOLOGI</u></b>
                                    </h3>
                                </div>
                            </div>

                            <form id="form-rad-cover-latter">
                                <input id="org_unit_code-rad-val-rad-latter" name="org_unit_code"
                                    placeholder="org_unit_code" type="hidden" class="form-control block" />
                                <input id="visit_id-rad-val-rad-latter" name="visit_id" placeholder="visit_id"
                                    type="hidden" class="form-control block" />
                                <input id="trans_id-rad-val-rad-latter" name="trans_id" placeholder="trans_id"
                                    type="hidden" class="form-control block" />

                                <input id="document_id-rad-val-rad-latter" name="document_id" placeholder="document_id"
                                    type="hidden" class="form-control block" />
                                <input id="no_registration-rad-val-rad-latter" name="no_registration"
                                    placeholder="no_registration" type="hidden" class="form-control block" />
                                <input id="bill_id-rad-val-rad-latter" name="bill_id" placeholder="bill_id"
                                    type="hidden" class="form-control block" />
                                <input id="clinic_id-rad-val-rad-latter" name="clinic_id" placeholder="clinic_id"
                                    type="hidden" class="form-control block" />
                                <input id="validation-rad-val-rad-latter" name="validation" placeholder="validation"
                                    type="hidden" class="form-control block" />
                                <input id="terlayani-rad-val-rad-latter" name="terlayani" placeholder="terlayani"
                                    type="hidden" class="form-control block" />
                                <input id="iscito-rad-val-rad-latter" name="iscito" placeholder="iscito" type="hidden"
                                    class="form-control block" />
                                <input id="employee_id-rad-val-rad-latter" name="employee_id" placeholder="employee_id"
                                    type="hidden" class="form-control block" />
                                <input id="patient_category_id-rad-val-rad-latter" name="patient_category_id"
                                    placeholder="patient_category_id" type="hidden" class="form-control block" />
                                <input id="thename-rad-val-rad-latter" name="thename" placeholder="thename"
                                    type="hidden" class="form-control block" />
                                <input id="theaddress-rad-val-rad-latter" name="theaddress" placeholder="theaddress"
                                    type="hidden" class="form-control block" />
                                <input id="theid-rad-val-rad-latter" name="theid" placeholder="theid" type="hidden"
                                    class="form-control block" />
                                <input id="isrj-rad-val-rad-latter" name="isrj" placeholder="isrj" type="hidden"
                                    class="form-control block" />
                                <input id="ageyear-rad-val-rad-latter" name="ageyear" placeholder="ageyear"
                                    type="hidden" class="form-control block" />
                                <input id="agemonth-rad-val-rad-latter" name="agemonth" placeholder="agemonth"
                                    type="hidden" class="form-control block" />
                                <input id="ageday-rad-val-rad-latter" name="ageday" placeholder="ageday" type="hidden"
                                    class="form-control block" />
                                <input id="status_pasien_id-rad-val-rad-latter" name="status_pasien_id"
                                    placeholder="status_pasien_id" type="hidden" class="form-control block" />
                                <input id="gender-rad-val-rad-latter" name="gender" placeholder="gender" type="hidden"
                                    class="form-control block" />
                                <input id="doctor-rad-val-rad-latter" name="doctor" placeholder="doctor" type="hidden"
                                    class="form-control block" />
                                <input id="class_room_id-rad-val-rad-latter" name="class_room_id"
                                    placeholder="class_room_id" type="hidden" class="form-control block" />
                                <input id="bed_id-rad-val-rad-latter" name="bed_id" placeholder="bed_id" type="hidden"
                                    class="form-control block" />
                                <input id="keluar_id-rad-val-rad-latter" name="keluar_id" placeholder="keluar_id"
                                    type="hidden" class="form-control block" />
                                <input id="perujuk-rad-val-rad-latter" name="perujuk" placeholder="perujuk"
                                    type="hidden" class="form-control block" />
                                <input id="nota_no-rad-val-rad-latter" name="nota_no" placeholder="nota_no"
                                    type="hidden" class="form-control block" />
                                <input id="clinic_id_from-rad-val-rad-latter" name="clinic_id_from"
                                    placeholder="clinic_id_from" type="hidden" class="form-control block" />
                                <input id="employee_id_from-rad-val-rad-latter" name="employee_id_from"
                                    placeholder="employee_id_from" type="hidden" class="form-control block" />
                                <div class="p-3 mt-3">
                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">Tanggal</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <input id="treat_date-rad-val-rad-latter" name="treat_date" placeholder=""
                                                type="text" class="form-control block " />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">Nama
                                            pasien</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="diantar_oleh-val2-rad-latter" class="thename">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">No.Register</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="no_registration-val2-rad-latter"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8 d-flex align-items-center">
                                            <label for="sa" class="col-sm-4 col-form-label">TTL / Umur</label>
                                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                                            <div class="col d-flex align-items-center gap-1">
                                                <span id="date_of_birth-val2-rad-latter"></span> / <span
                                                    id="age-val2-rad-latter"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 d-flex">
                                            <label for="sa" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                                            <div class="col pt-2">
                                                <div id="gendername-val2-rad-latter"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">Alamat/Ruang</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="visitor_address-val2-rad-latter" class="theaddress">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="sa" class="col-sm-3 col-form-label">Pemeriksaan yang diminta</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <input id="descriptions-rad-val-rad-latter" name="descriptions"
                                                placeholder="" type="text" class="form-control block " />
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            Keterangan klinis / Diagnosa : <br>
                                            <div class="col pt-2">

                                                <input id="diagnosa_desc-rad-val-rad-latter" name="diagnosa_desc"
                                                    placeholder="" type="text" class="form-control block " />
                                            </div>
                                            <!-- <span id="hasil-tindakan-val2-coverfisio"></span> -->

                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="row mb-2 hidden-show-ttd" hidden id="rad-ttd-result">
                                <div class="col-3" align="center">
                                    <br>
                                    <br><br>
                                    <i class="hidden-show-ttd">Dicetak pada tanggal
                                        <?= tanggal_indo(date('Y-m-d')); ?></i>

                                </div>
                                <div class="col"></div>
                                <div class="col-3" align="center">
                                    <div>
                                        <div id="datetime-now" class="datetime-now"></div><br>
                                        Dokter
                                    </div>
                                    <div>
                                        <div class="pt-2 pb-2" id="qrcode-rad-conver-dokter">
                                        </div>
                                    </div>
                                    <div id="validator-ttd-rad-conver-dokter"></div>
                                </div>
                            </div>

                        </div>
                        <span id="avttotal_score"></span>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="button" id="save-form-rad-cover-latter" name="save"
                            data-loading-text="<?php echo lang('processing') ?>" class="btn btn-outline-primary me-2">
                            <i class="fa fa-check-circle"></i> Save
                        </button>
                        <button type="button" id="sign-form-rad-cover-latter" name="signrm"
                            data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i
                                class="fa fa-signature"></i> <span>Save & Sign</span></button>
                        <!-- <button type="button" id="print-form-fisioterapi-cover"
                            data-loading-text="<?php echo lang('processing') ?>" class="btn btn-success">
                            <i class="fas fa-print"></i> Print
                        </button> -->
                    </div>

                </div>
            </div>


        </div>
    </div>
    <!--./row-->



</div>
<!-- Modal -->
<div class="modal fade modal" id="modalExpertise" aria-labelledby="ModalLabelExpertise" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content table-responsive ">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelExpertise">Ekspertise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="formExpertise" method="post" enctype="multipart/form-data">
                <input type="hidden" name="bill_id" id="modalBill">
                <input type="hidden" name="visit_id" id="modalVisit">
                <div class="modal-body" style="height: 80vh; overflow-y: auto;">
                    <table>
                        <tbody>
                            <tr>
                                <td>Jenis Tindakan</td>
                                <td width="1%">:</td>
                                <td id="modalJenisTindakan"></td>
                            </tr>
                            <tr>
                                <td>Tanggal Tindakan</td>
                                <td width="1%">:</td>
                                <td id="modalTanggalTindakan"></td>
                            </tr>
                            <tr>
                                <td>Nilai</td>
                                <td width="1%">:</td>
                                <td id="modalNilaiTindakan"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mb-3">
                        <div class="col-6">
                            <?php if (user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad'])) : ?>
                            <select class="form-select" id="template_expertise" type="text" name="template_expertise"
                                style="width: 100%;">
                            </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="mb-2">
                                    <label for="modalNoFilm" class="form-label fw-bold">No Film</label>
                                    <input type="text" id="modalNoFilm" class="form-control" name="no_film"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>
                                </div>
                                <div class="mb-2">
                                    <label for="modalHasilBaca" class="form-label fw-bold">Hasil Baca</label>
                                    <textarea class="form-control" id="modalHasilBaca" name="hasil_baca" rows="3"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="modalKesimpulan" class="form-label fw-bold">Kesimpulan</label>
                                    <textarea class="form-control" id="modalKesimpulan" name="kesimpulan" rows="3"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="formFile" class="form-label fw-bold">Upload berkas pendukung
                                        (optional)</label>
                                    <br>
                                    <label for="formFile mt-2" class="form-label fw-bold">Gambar / File 1</label>
                                    <input class="form-control  formFileExpertise" data-index="1" type="file"
                                        id="formFileExpertise" name="dokumen_expertise"
                                        accept=".pdf, .jpg, .jpeg, .png, .webp"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>

                                    <label for="formFile" class="form-label fw-bold">Gambar / File 2</label>
                                    <input class="form-control  formFileExpertise" data-index="2" type="file"
                                        id="formFileExpertise1" name="dokumen_expertise1"
                                        accept=".pdf, .jpg, .jpeg, .png, .webp"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>

                                    <label for="formFile" class="form-label fw-bold">Gambar / File 3</label>
                                    <input class="form-control  formFileExpertise" data-index="3" type="file"
                                        id="formFileExpertise2" name="dokumen_expertise2"
                                        accept=".pdf, .jpg, .jpeg, .png, .webp"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>

                                    <label for="formFile" class="form-label fw-bold">Gambar / File 4</label>
                                    <input class="form-control  formFileExpertise" data-index="4" type="file"
                                        id="formFileExpertise3" name="dokumen_expertise3"
                                        accept=".pdf, .jpg, .jpeg, .png, .webp"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>

                                    <label for="formFile" class="form-label fw-bold">Gambar / File 5</label>
                                    <input class="form-control  formFileExpertise" data-index="5" type="file"
                                        id="formFileExpertise4" name="dokumen_expertise4"
                                        accept=".pdf, .jpg, .jpeg, .png, .webp"
                                        <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>

                                </div>
                                <?php if (user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad'])) : ?>
                                <div class="mb-2">
                                    <input type="hidden" name="isvalid" value="0" id="modalIsValid">
                                    <input type="hidden" name="iskritis" value="0" id="modalIsKritis">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-primary isValidExpertise"
                                            id="isValidExpertise">Validasi</button>
                                        <button type="button" class="btn btn-outline-primary"
                                            id="isKritisExpertise">Nilai Kritis</button>
                                    </div>
                                </div>
                                <?php endif; ?>


                                <div class="mb-2">
                                    <label for="diagnosisExpertise" class="form-label fw-bold">Diagnosis Klinis</label>
                                    <input type="text" id="diagnosisExpertise" class="form-control"
                                        name="diagnosa_desc">
                                    <div class="mb-2">
                                        <label for="indikasiExpertise" class="form-label fw-bold">Indikasi Medis</label>
                                        <input type="text" id="indikasiExpertise" class="form-control"
                                            name="indication_desc">
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-6">
                            <label for="" class="form-label fw-bold">Preview Berkas</label>
                            <div id="carouselExpertise" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" id="data-render-all-Expertise"></div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExpertise"
                                    data-bs-slide="prev"
                                    style="background-color: #7b7b7b; border-radius: 50%; width: 50px; height: 50px;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExpertise"
                                    data-bs-slide="next"
                                    style="background-color: #7b7b7b; border-radius: 50%; width: 50px; height: 50px;">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>

                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button id="printExpertise" type="button" class="btn btn-outline-success">Print</button>
                    <?php if (user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad'])) : ?>
                    <button id="saveExpertise" type="submit" class="btn btn-primary">Simpan</button>
                    <?php endif; ?>
                    <button id="batalExpertise" type="button" class="btn btn-danger spppoli-to-hide">Batalkan
                        Tagihan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Template -->
<div class="modal fade modal-xl" id="modalTemplateExpertise" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelTemplateExpertise">Template Ekspertise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <div class="mb-2">
                                <label for="modalTemplateType" class="form-label fw-bold">Type</label>
                                <input type="text" class="form-control" id="modalTemplateType" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <div class="mb-2">
                                <label for="modalTemplateTreatment" class="form-label fw-bold">Treatment</label>
                                <input type="text" class="form-control" id="modalTemplateTreatment" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="mb-2">
                                <label for="modalTemplateHasilBaca" class="form-label fw-bold">Hasil Baca</label>
                                <textarea class="form-control" id="modalTemplateHasilBaca" rows="6" readonly></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="modalTemplateKesimpulan" class="form-label fw-bold">Kesimpulan</label>
                                <textarea class="form-control" id="modalTemplateKesimpulan" rows="3"
                                    readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- modal History -->
<div class="modal fade modal-xl" id="modalDataAllRadiologi" tabindex="-1" aria-labelledby="ModalLabelDataAll"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-md modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelBridge">Data Lengkap Hasil Radiologi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto">
                <table class="table table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th class="text-center" style="width: 1%;">No</th>
                            <th class="text-center" style="width: 20%;">Tanggal</th>
                            <th class="text-center" style="width: 60%;">Nama Tindakan</th>
                            <th class="text-center" style="width: auto;">Hasil</th>
                        </tr>
                    </thead>
                    <tbody id="resultmodalDataAllRadiologi" class="table-group-divider"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>