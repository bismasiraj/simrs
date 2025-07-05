<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();
// var_dump(user()->getPermissions());
// var_dump(user()->checkRoles('lab', 'superuser'));

// var_dump(user()->checkRoles(['lab', 'superuser']));

?>

<style>
/* Table Fit */
table.table-fit {
    width: auto !important;
    table-layout: auto !important;
}

table.table-fit thead th,
table.table-fit tfoot th,
table.table-fit tbody td,
table.table-fit tfoot td {
    width: auto !important;
}

/* General Styles */
.LabLIS-uploader {
    display: block;
    margin: 0 auto;
    max-width: 600px;
}

.LabLIS-uploader label {
    cursor: pointer;
}

.LabLIS-hidden {
    display: none;
}

.LabLIS-progress {
    display: block;
    width: 100%;
    height: 8px;
    border-radius: 4px;
    background-color: #eee;
    overflow: hidden;
}

.LabLIS-progress[value]::-webkit-progress-bar {
    background-color: #eee;
}

.LabLIS-progress[value]::-webkit-progress-value {
    background: linear-gradient(to right, #2d2d6f 0%, #454cad 50%);
    border-radius: 4px;
}

.LabLIS-progress[value]::-moz-progress-bar {
    background: linear-gradient(to right, #2d2d6f 0%, #454cad 50%);
    border-radius: 4px;
}

/* Image and PDF Display */
#LabLIS-file-image {
    max-width: 180px;
    display: block;
}

#LabLIS-file-preview {
    max-width: 100%;
    height: 500px;
    display: block;
}

#LabLIS-notimage {
    font-size: 16px;
}
</style>
<div class="tab-pane" id="lab" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-10 col-md-12 col-xs-12">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div id="listRequestLab" class="row">

                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div id="laboratoriumAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestLab()" class="btn btn-primary btn-lg" id="addLabBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Lab Online</a>
                    </div>
                </div> -->
            </div>
            <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="operasi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#transaksi-lab-tab" data-bs-toggle="tab">Transaksi</a>
                            </li>

                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#hasil-lab-tab" data-bs-toggle="tab">Hasil LIS</a>
                            </li>
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#table-cover-Sendlatter" data-bs-toggle="tab">Surat
                                    Pengantar Pemeriksaan</a>
                            </li>
                            <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#bridging-lab-tab" data-bs-toggle="tab">Bridging LIS</a>
                            </li>
                            <?php } ?>
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#bloodrequest-lab-tab" data-bs-toggle="tab">Blood Request</a>
                            </li>
                            <!-- <li class="nav-item text-center flex-fill">
                                <a class="nav-link" href="#upload-lab-tab" data-bs-toggle="tab">Upload</a>
                            </li> -->

                        </ul>

                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="transaksi-lab-tab">
                                <form id="formlabbill" action="" method="post">
                                    <div class="row g-3">
                                        <input type="hidden" name="ci_csrf_token" value="">

                                        <div class="col-12">

                                            <div class="row">

                                                <div class="col-lg-2 col-md-3">
                                                    <div class="form-group">
                                                        <label for="startDateLab">Start Date</label>
                                                        <input type="text" id="startDateLab"
                                                            class="form-control   dateflatpickr-lab">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3">
                                                    <div class="form-group">
                                                        <label for="endDateLab">End Date</label>
                                                        <input type="text" id="endDateLab"
                                                            class="form-control   dateflatpickr-lab">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3">
                                                    <div class="form-group">
                                                        <label for="notaNoLab">Nomor Pemeriksaan</label>
                                                        <div class="input-group">
                                                            <select id="notaNoLab" class="form-select">
                                                                <option value="%">Semua</option>
                                                            </select>
                                                            <button id="addNotaLabBtn" type="button"
                                                                onclick="addNotaLab()"
                                                                class="btn btn-success">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3">
                                                    <div class="form-group">
                                                        <label for="btn-search-lab"></label>
                                                        <div class="input-group pt-2">
                                                            <button type="button" id="btn-search-lab"
                                                                class="btn btn-primary  " name="cari"> <i
                                                                    class="fa fa-search"></i>Cari</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4 d-flex justify-content-end">
                                                    <div class="form-group">
                                                        <label for="btn-cetak"></label>
                                                        <div class="input-group pt-2">
                                                            <button type="button" id="btn-cetak"
                                                                class="btn btn-secondary  " name="cari"
                                                                disabled="disabled"><i class="far fa-file"></i> Preview
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive mt-4">
                                    <table class="table   table-hover">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th class="text-center" rowspan="2" style="width: 5%;">No.</th
                                                    class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan
                                                </th class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 20%;">Dokter</th
                                                    class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 15%;">Tgl Tindakan</th
                                                    class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th
                                                    class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 10%;">Jml</th
                                                    class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan
                                                </th class="text-center">
                                                <th class="text-center" rowspan="2" style="width: 5%"></th
                                                    class="text-center">
                                            </tr>
                                        </thead>
                                        <tbody id="labChargesBody" class="table-group-divider"></tbody>
                                    </table>
                                </div>
                                <?php if (user()->checkPermission("lab", 'c') || user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>

                                <div class="row m-4">
                                    <div class="col-md-10">
                                        <div class="form-group spppoli-to-hide">
                                            <label for="searchTarifLab">Pemeriksaan</label>
                                            <div class="input-group">
                                                <select id="select-show-lab-tarif" class="form-select fit me-2"
                                                    style="width: 10%; display: none;"></select>

                                                <select id="searchTarifLab" class="form-control fit"
                                                    style="width: 50%;"></select>

                                                <select id="searchTarifLabDinamis" class="form-select fit"
                                                    style="width: 50%; display: none;"></select>

                                                <button type="button" id="btnAddChargesLab"
                                                    class="btn btn-primary addcharges align-items-end d-none">
                                                    <i class="fa fa-plus"></i> Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>
                                <?php if (user()->checkPermission('lab', 'c')) {
                                ?>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" id="formSaveBillLabBtn" name="save"
                                        data-loading-text="<?php echo lang('processing') ?>"
                                        class="btn btn-primary me-2">
                                        <i class="fa fa-check-circle"></i> Simpan
                                    </button>
                                    <button type="button" id="formsign" name="signrm" onclick="signRM()"
                                        data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning">
                                        <i class="fa fa-signature"></i> Sign
                                    </button>
                                </div>
                                <?php
                                } ?>
                            </div>


                            <div class="tab-pane fade" id="bridging-lab-tab">
                                <div class="container-fluid">
                                    <form id="labLISForm" method="post">
                                        <!-- Top Section with Controls -->
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="side-panel">
                                                    <div class="controls">
                                                        <div class="row">
                                                            <!-- Start Date Input -->
                                                            <div class="col-lg-2 col-md-3 mb-3">
                                                                <label for="startDateLIS" class="form-label">Start
                                                                    Date</label>
                                                                <input type="text" id="startDateLIS"
                                                                    class="form-control   dateflatpickr-lab">

                                                            </div>
                                                            <!-- End Date Input -->
                                                            <div class="col-lg-2 col-md-3 mb-3">
                                                                <label for="endDateLIS" class="form-label">End
                                                                    Date</label>
                                                                <div class="d-flex">
                                                                    <input type="text" id="endDateLIS"
                                                                        class="form-control   dateflatpickr-lab">
                                                                </div>
                                                            </div>
                                                            <!-- Search Button -->
                                                            <div class="col-lg-2 col-md-3 mb-3 pt-4">
                                                                <button type="button" class="btn btn-primary  "
                                                                    id="searchLIS">
                                                                    <i class="fa fa-search"></i> Cari
                                                                </button>
                                                            </div>
                                                            <!-- Cito Checkbox -->
                                                            <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                                            <!-- <div class="col-md-2 mb-3 pt-4">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="citoCheckbox" name="citoCheckbox">
                                                                <label class="form-check-label"
                                                                    for="citoCheckbox">Cito</label>
                                                            </div> -->
                                                            <?php } ?>

                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Main Content with Tables -->
                                        <div class="container-fluid">
                                            <div class="row ">

                                                <!-- Panel Kiri -->
                                                <div class="col-md-5">

                                                    <div class="data-table box-datalabs-brig">
                                                        <table class="table table-striped" id="examinationTable">
                                                            <thead>
                                                                <tr>
                                                                    <th class="checkbox-col">
                                                                        <input type="checkbox"
                                                                            id="selectAllExaminations">
                                                                    </th>
                                                                    <th>No.</th>
                                                                    <th>No CM</th>
                                                                    <th>Nama Pasien</th>
                                                                    <th>Pemeriksaan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Isi data pemeriksaan -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <!-- Panel Tengah -->
                                                <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                                <div
                                                    class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                                                    <button type="button" class="btn btn-primary mb-2" id="moveRight">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-primary" id="moveLeft">
                                                        <i class="fas fa-arrow-left"></i>
                                                    </button>
                                                </div>
                                                <?php } ?>

                                                <!-- Panel Kanan -->
                                                <div class="col-md-5">

                                                    <div class="data-table box-datalabs-brig">
                                                        <table class="table table-striped" id="detailsTable">
                                                            <thead>
                                                                <tr>
                                                                    <th class="checkbox-col">
                                                                        <input type="checkbox" id="selectAllDetails">
                                                                    </th>
                                                                    <th>No.</th>
                                                                    <th>No CM</th>
                                                                    <th>Nama Pasien</th>
                                                                    <th>Pemeriksaan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Isi data hasil -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Save Button Positioned at the Bottom -->
                                        <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                        <div class="row mt-3">
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-success spppoli-to-hide"
                                                    id="saveLabLIS">Save</button>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>


                            <div class="tab-pane fade " id="hasil-lab-tab">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="side-panel">
                                            <div class="controls">
                                                <div class="row">

                                                    <div class="col-lg-2 col-md-3 ">
                                                        <label for="startDateLISHasil" class="form-label">Start
                                                            Date</label>
                                                        <input type="date" id="startDateLISHasil"
                                                            name="startDateLISHasil"
                                                            class="form-control   dateflatpickr-lab">
                                                    </div>

                                                    <div class="col-lg-2 col-md-3 ">
                                                        <label for="endDateLISHasil" class="form-label">End
                                                            Date</label>
                                                        <div class="d-flex">
                                                            <input type="date" id="endDateLISHasil"
                                                                name="endDateLISHasil"
                                                                class="form-control   me-3 dateflatpickr-lab">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3">
                                                        <label for="searchTarifLabHasil">Pencarian Tarif</label>
                                                        <div class="input-group">
                                                            <select id="searchTarifLabHasil" class="form-control fit"
                                                                style="width: 100%;"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-3">
                                                        <div class="form-group">
                                                            <label for="btn-search-lab"></label>
                                                            <div class="input-group pt-2">
                                                                <button type="button" id="searchLISHasil"
                                                                    class="btn btn-primary" name="cari"> <i
                                                                        class="fa fa-search"></i> Cari</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-4">
                                    <table class="table   table-borderless">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th style="width: 10%;">Nama pemeriksaan</th>
                                                <th style="width: 5%;">Hasil</th>
                                                <th style="width: 2%;">Flag</th>
                                                <th style="width: 5%;">Satuan</th>
                                                <th style="width: 10%;">Nilai Rujukan</th>
                                                <th style="width: 15%;">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasilFilterLIS" class="table-group-divider"></tbody>
                                    </table>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="fw-bold mb-0" id="hasil-list">Hasil LIS</h3>
                                    <button style="margin-right: 10px;" type="button" id="data-allLis"
                                        data-loading-text="processing" class="btn btn-outline-secondary">
                                        <i class="fa fa-history"></i> <span>Data Lengkap Hasil LIS</span>
                                    </button>
                                </div>

                                <div class="table-responsive mt-4">
                                    <form id="valid-user-hasillis-Lab">
                                        <table class="table   table-hover">

                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th class="align-middle">No.</th>
                                                    <th class="align-middle">Tanggal</th>
                                                    <th class="align-middle">Nama Pemeriksaan</th>
                                                    <th class="align-middle">Hasil</th>
                                                </tr>
                                            </thead>
                                            <tbody id="labHasilLIS" class="table-group-divider"></tbody>
                                        </table>
                                    </form>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="bloodrequest-lab-tab">
                                <div class="container-fluid">
                                    <!-- Top Section with Controls -->
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="side-panel">
                                                <div class="controls">
                                                    <form id="labBloodRequestForm" method="post">
                                                        <div class="row">
                                                            <!-- Filter Input -->
                                                            <div class="col-md-3 mb-3">
                                                                <label for="filterBloodRequest"
                                                                    class="form-label">Filter</label>
                                                                <select name="visit_id" id="filterBloodRequest"
                                                                    class="form-select">
                                                                    <option value="<?= $visit['visit_id']; ?>">
                                                                        <?= $visit['diantar_oleh']; ?></option>
                                                                    <option value="">SEMUA PASIEN</option>
                                                                </select>
                                                            </div>
                                                            <!-- Start Date Input -->
                                                            <div class="col-md-3 mb-3">
                                                                <label for="startDateBloodRequest"
                                                                    class="form-label">Start Date</label>
                                                                <input type="text" name="start_date"
                                                                    id="startDateBloodRequest"
                                                                    class="form-control dateflatpickr-lab">
                                                            </div>
                                                            <!-- End Date Input -->
                                                            <div class="col-md-3 mb-3">
                                                                <label for="endDateBloodRequest" class="form-label">End
                                                                    Date</label>
                                                                <div class="d-flex">
                                                                    <input type="text" name="end_date"
                                                                        id="endDateBloodRequest"
                                                                        class="form-control   dateflatpickr-lab">
                                                                </div>
                                                            </div>
                                                            <!-- Search Button -->
                                                            <div class="col-md-2 mb-3 pt-4">
                                                                <button type="button" class="btn btn-primary"
                                                                    id="searchBloodRequest">
                                                                    <i class="fa fa-search"></i> Cari
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Main Content with Tables -->
                                    <div class="row">
                                        <!-- Left Panel -->
                                        <div class="col-12">
                                            <div class="data-table table-responsive">
                                                <form action="" method="post" id="formBloodRequest-Lab">
                                                    <table class="table  table-striped" id="tableFormBloodRequest-Lab">
                                                        <thead>
                                                            <tr class="table-primary">
                                                                <th class="text-center align-middle" style="width:1%">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="bloodrequest_checkbox">
                                                                </th>
                                                                <th class="text-center align-middle">Nama Pasien</th>
                                                                <th class="text-center align-middle"
                                                                    style="width:1%; min-width: 150px;">Jenis Darah</th>
                                                                <th class="text-center align-middle" style="width:1%">
                                                                    Jumlah</th>
                                                                <th class="text-center align-middle" style="width:1%">
                                                                    Satuan Ukuran</th>
                                                                <th class="text-center align-middle" style="width:1%">
                                                                    Golongan Darah</th>
                                                                <th class="text-center align-middle">Diagnosa Sementara
                                                                </th>
                                                                <th class="text-center align-middle"
                                                                    style="width:1%; min-width: 100px;">Waktu Permintaan
                                                                </th>
                                                                <th class="text-center align-middle"
                                                                    style="width:1%; min-width: 100px;">Waktu Penggunaan
                                                                </th>
                                                                <th class="text-center align-middle">Calf Number</th>
                                                                <th class="text-center align-middle">Waktu Pengantaran
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbodyLabBloodRequest">

                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>


                                    </div>

                                    <!-- Save Button Positioned at the Bottom -->
                                    <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                    <div class="row mt-3">
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-primary"
                                                id="saveLabBloodRequest">Save</button>
                                        </div>
                                    </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="tab-pane fade " id="table-cover-Sendlatter">
                                <div class="box-tab-tools text-center mt-4">
                                    <a data-toggle="modal" id="add-new-doc-coverkopLetterSendLab"
                                        class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i>
                                        Tambah Dokumen</a>
                                </div>
                                <h3 class="fw-bold" for="hasil-list">Hasil Surat Pengantar</h3>
                                <div class="table-responsive mt-4">
                                    <table class="table   table-hover">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th class="align-middle" style="width: 10%;">No.</th>
                                                <th class="align-middle">No Nota</th>
                                                <th class="align-middle">Tindakan / Pemeriksaan</th>
                                                <th class="align-middle" style="width: 25%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasilbodylistLatter" class="table-group-divider"></tbody>
                                    </table>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <div class="card border-1 rounded-4 m-4 p-4" id="coverkopSuratPengantarLab" style="display: none;">
                <div class="card-body">
                    <div class="modal-body pt0 pb0">
                        <div class="container-fluid mt-5">
                            <div class="row">
                                <div class="col-auto" align="center">
                                    <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                                </div>
                                <div class="col mt-2">
                                    <h3 class="kop-name-lab text-center" id="kop-name-lab">
                                    </h3>
                                    <p class="kop-address-lab text-center" id="kop-address-lab">
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
                                    <h3><b><u id="content-title" class="content-title">Surat Pengantar
                                                Pemeriksaan</u></b>
                                    </h3>
                                </div>
                            </div>

                            <form id="form-lab-cover-latter">
                                <input id="org_unit_code-lab-val-lab-latter" name="org_unit_code"
                                    placeholder="org_unit_code" type="hidden" class="form-control block" />
                                <input id="visit_id-lab-val-lab-latter" name="visit_id" placeholder="visit_id"
                                    type="hidden" class="form-control block" />
                                <input id="trans_id-lab-val-lab-latter" name="trans_id" placeholder="trans_id"
                                    type="hidden" class="form-control block" />
                                <input id="document_id-lab-val-lab-latter" name="document_id" placeholder="document_id"
                                    type="hidden" class="form-control block" />
                                <input id="no_registration-lab-val-lab-latter" name="no_registration"
                                    placeholder="no_registration" type="hidden" class="form-control block" />
                                <input id="bill_id-lab-val-lab-latter" name="bill_id" placeholder="bill_id"
                                    type="hidden" class="form-control block" />
                                <input id="clinic_id-lab-val-lab-latter" name="clinic_id" placeholder="clinic_id"
                                    type="hidden" class="form-control block" />
                                <input id="validation-lab-val-lab-latter" name="validation" placeholder="validation"
                                    type="hidden" class="form-control block" />
                                <input id="terlayani-lab-val-lab-latter" name="terlayani" placeholder="terlayani"
                                    type="hidden" class="form-control block" />
                                <input id="iscito-lab-val-lab-latter" name="iscito" placeholder="iscito" type="hidden"
                                    class="form-control block" />
                                <input id="employee_id-lab-val-lab-latter" name="employee_id" placeholder="employee_id"
                                    type="hidden" class="form-control block" />
                                <input id="patient_category_id-lab-val-lab-latter" name="patient_category_id"
                                    placeholder="patient_category_id" type="hidden" class="form-control block" />
                                <input id="treat_date-lab-val-lab-latter" name="treat_date" placeholder="treat_date"
                                    type="hidden" class="form-control block" />
                                <input id="thename-lab-val-lab-latter" name="thename" placeholder="thename"
                                    type="hidden" class="form-control block" />
                                <input id="theaddress-lab-val-lab-latter" name="theaddress" placeholder="theaddress"
                                    type="hidden" class="form-control block" />
                                <input id="theid-lab-val-lab-latter" name="theid" placeholder="theid" type="hidden"
                                    class="form-control block" />
                                <input id="isrj-lab-val-lab-latter" name="isrj" placeholder="isrj" type="hidden"
                                    class="form-control block" />
                                <input id="ageyear-lab-val-lab-latter" name="ageyear" placeholder="ageyear"
                                    type="hidden" class="form-control block" />
                                <input id="agemonth-lab-val-lab-latter" name="agemonth" placeholder="agemonth"
                                    type="hidden" class="form-control block" />
                                <input id="ageday-lab-val-lab-latter" name="ageday" placeholder="ageday" type="hidden"
                                    class="form-control block" />
                                <input id="status_pasien_id-lab-val-lab-latter" name="status_pasien_id"
                                    placeholder="status_pasien_id" type="hidden" class="form-control block" />
                                <input id="gender-lab-val-lab-latter" name="gender" placeholder="gender" type="hidden"
                                    class="form-control block" />
                                <input id="doctor-lab-val-lab-latter" name="doctor" placeholder="doctor" type="hidden"
                                    class="form-control block" />
                                <input id="class_room_id-lab-val-lab-latter" name="class_room_id"
                                    placeholder="class_room_id" type="hidden" class="form-control block" />
                                <input id="bed_id-lab-val-lab-latter" name="bed_id" placeholder="bed_id" type="hidden"
                                    class="form-control block" />
                                <input id="keluar_id-lab-val-lab-latter" name="keluar_id" placeholder="keluar_id"
                                    type="hidden" class="form-control block" />
                                <input id="perujuk-lab-val-lab-latter" name="perujuk" placeholder="perujuk"
                                    type="hidden" class="form-control block" />
                                <input id="nota_no-lab-val-lab-latter" name="nota_no" placeholder="nota_no"
                                    type="hidden" class="form-control block" />
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
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="diantar_oleh-val2-lab-latter" class="thename">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">Umur</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="age-val2-lab-latter" class="age"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">No.
                                            Register</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="no_registration-val2-lab-latter"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="sa" class="col-sm-3 col-form-label">Alamat</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <div id="visitor_address-val2-lab-latter" class="theaddress">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="sa" class="col-sm-3 col-form-label">Diagnosis</label>
                                        <label for="sa" class="col-sm-auto col-form-label">:</label>
                                        <div class="col pt-2">
                                            <input id="diagnosa_desc-lab-val-lab-latter" name="diagnosa_desc"
                                                placeholder="" type="text" class="form-control block" />
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            Mohon dapat diberikan tindakan / pemeriksaan : <br>
                                            <div class="col pt-2">
                                                <input id="descriptions-lab-val-lab-latter" name="descriptions"
                                                    placeholder="" type="text" class="form-control block" />
                                            </div>
                                            <!-- <span id="hasil-tindakan-val2-coverfisio"></span> -->
                                            <br>
                                            Atas perhatian dan kerjasamanya kami ucapkan terima
                                            kasih.

                                        </div>
                                    </div>

                                </div>
                            </form>

                            <div class="row mb-2 hidden-show-ttd" hidden id="lab-ttd-result">
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
                                        <div class="pt-2 pb-2" id="qrcode-lab-conver-dokter">
                                        </div>
                                    </div>
                                    <div id="validator-ttd-lab-conver-dokter"></div>
                                </div>
                            </div>

                        </div>
                        <span id="avttotal_score"></span>
                    </div>
                    <div class="modal-footer d-flex">
                        <button type="button" id="save-form-lab-cover-latter" name="save"
                            data-loading-text="<?php echo lang('processing') ?>" class="btn btn-outline-primary me-2">
                            <i class="fa fa-check-circle"></i> Simpan
                        </button>
                        <button type="button" id="sign-form-lab-cover-latter" name="signrm" onclick="signarm()"
                            data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i
                                class="fa fa-signature"></i> <span>Sign</span></button>

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
<!-- -->

<!-- Modal -->
<div class="modal fade modal-xl" id="modalBridge" tabindex="-1" aria-labelledby="ModalLabelBridge" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelBridge">Dokumen Hasil Pengujian Laboratorium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formBridge" method="post" enctype="multipart/form-data">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Jenis Tindakan</td>
                                <td width="1%">:</td>
                                <td id="modalJenisTindakanLab"></td>
                            </tr>
                            <tr>
                                <td>Tanggal Tindakan</td>
                                <td width="1%">:</td>
                                <td id="modalTanggalTindakanLab"></td>
                            </tr>
                            <tr>
                                <td>Nilai</td>
                                <td width="1%">:</td>
                                <td id="modalNilaiTindakanLab"></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="form-group">
                        <div class="mb-2">
                            <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                            <label for="formFileBridge" class="form-label fw-bold">Upload berkas pendukung
                                (optional)</label>
                            <input class="form-control" type="file" id="formFileBridge" name="dokumen_Bridge"
                                accept="image/*,application/pdf">
                            <?php } ?>
                        </div>
                        <div class="mb-2">
                            <img id="imagePreviewBridge" src="#" alt="Image Preview"
                                style="display: none; max-width: 700px; height: 700px;" />
                            <embed id="pdfPreviewBridge" type="application/pdf"
                                style="display: none; width: 100%; height: 500px;" />
                            <p id="fileName" style="display: none;"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>

                <button id="saveBridge" type="button" class="btn btn-primary">Simpan</button>
                <?php } ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-xl" id="modalTfHasil" tabindex="-1" aria-labelledby="ModalLabeHasil" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabeHasil">Dokumen Hasil Laboratorium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formTfHasilLab" method="post" enctype="multipart/form-data">
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold">Nama Pemeriksaan:</div>
                        <div class="col-md-3">
                            <div class="col-md-12" id="name_pemeriksaan_valtfHas" name="tarif_name"></div>
                        </div>
                        <div class="col-md-3 fw-bold">Nama Parameter:</div>
                        <div class="col-md-3">
                            <div class="col-md-12 text-end" id="param_name_valtfHas" name="parameter_name"></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold">Hasil:</div>
                        <div class="col-md-3">
                            <div class="col-md-12" id="resultHasil_valtfHas" name="hasil"></div>
                        </div>
                        <div class="col-md-3 fw-bold">Satuan:</div>
                        <div class="col-md-3">
                            <div class="col-md-12 text-end" id="satuan_valtfHas" name="satuan"></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold">Nilai Rujukan:</div>
                        <div class="col-md-3">
                            <div class="col-md-12" id="nilairujukan_valtfHas" name="nilai_rujukan"></div>
                        </div>
                        <div class="col-md-3 fw-bold">FL:</div>
                        <div class="col-md-3">
                            <div class="col-md-12 text-end" id="fl_valtfHas" name="flag_hl"></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold">DUPLO :</div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" id="dupolo_valtfHas" name="duplo_result"></input>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 fw-bold">Catatan:</div>
                        <div class="col-md-9 ">
                            <textarea class="form-control " id="catatan_valtfHas" rows="2" name="catatan"></textarea>
                        </div>
                    </div>
                    <div id="hidden-datatfHasil">

                    </div>
                </form>
            </div>



            <div class="modal-footer">
                <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>

                <button id="saveTfHasil" type="button" class="btn btn-primary">Simpan</button>
                <?php } ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- modal History -->
<div class="modal fade modal-xl" id="modalDataAll" tabindex="-1" aria-labelledby="ModalLabelDataAll" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-md modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelBridge">Data Lengkap Hasil LIS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto">
                <table class="table table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th class="align-middle">No.</th>
                            <th class="align-middle">Tanggal</th>
                            <th class="align-middle">Nama Pemeriksaan</th>
                            <th class="align-middle">Hasil</th>
                        </tr>
                    </thead>
                    <tbody id="resultmodalDataAll" class="table-group-divider"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>