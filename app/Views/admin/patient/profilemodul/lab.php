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
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-xs-12">
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
                            <?php if (user()->checkPermission("lab", 'c') || user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
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

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="startDateLab">Start Date</label>
                                                        <input type="text" id="startDateLab"
                                                            class="form-control   dateflatpickr">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="endDateLab">End Date</label>
                                                        <input type="text" id="endDateLab"
                                                            class="form-control   dateflatpickr">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="notaNoLab">Nomor Sesi</label>
                                                        <div class="input-group">
                                                            <select id="notaNoLab" class="form-select">
                                                                <option value="%">Semua</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
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
                                            <?php if (user()->checkPermission("lab", 'c') || user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                            <div class="row mt-3">
                                                <!-- Pencarian Tarif -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="searchTarifLab">Pencarian Tarif</label>
                                                        <div class="input-group">
                                                            <select id="searchTarifLab" class="form-control fit"
                                                                style="width: 70%;"></select>
                                                            <button type="button"
                                                                class="btn btn-primary   addcharges align-items-end"
                                                                onclick='addBillLab("searchTarifLab")'>
                                                                <i class="fa fa-plus"></i> Tambah
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
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
                                                <th class="text-center" rowspan="2" style="width: 20%;">Tgl Tindakan</th
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
                                <?php if (user()->checkPermission('rad', 'c')) {
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
                                                            <div class="col-md-3 mb-3">
                                                                <label for="startDateLIS" class="form-label">Start
                                                                    Date</label>
                                                                <input type="text" id="startDateLIS"
                                                                    class="form-control   dateflatpickr">

                                                            </div>
                                                            <!-- End Date Input -->
                                                            <div class="col-md-3 mb-3">
                                                                <label for="endDateLIS" class="form-label">End
                                                                    Date</label>
                                                                <div class="d-flex">
                                                                    <input type="text" id="endDateLIS"
                                                                        class="form-control   dateflatpickr">
                                                                </div>
                                                            </div>
                                                            <!-- Search Button -->
                                                            <div class="col-md-2 mb-3 pt-4">
                                                                <button type="button" class="btn btn-primary  "
                                                                    id="searchLIS">
                                                                    <i class="fa fa-search"></i> Cari
                                                                </button>
                                                            </div>
                                                            <!-- Cito Checkbox -->
                                                            <?php if (user()->checkPermission("lab", 'c') && user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                                            <div class="col-md-4 mb-3 pt-4">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="citoCheckbox" name="citoCheckbox">
                                                                <label class="form-check-label"
                                                                    for="citoCheckbox">Cito</label>
                                                            </div>
                                                            <?php } ?>

                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Main Content with Tables -->
                                        <div class="row">
                                            <!-- Left Panel -->
                                            <div class="col-md-5">
                                                <div class="data-table">
                                                    <table class="table table-striped" id="examinationTable">
                                                        <thead>
                                                            <tr>
                                                                <th class="checkbox-col">
                                                                    <input type="checkbox" id="selectAllExaminations">
                                                                </th>
                                                                <th>No.</th>
                                                                <th>No CM</th>
                                                                <th>Nama Pasien</th>
                                                                <th>Pemeriksaan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Examination data will be dynamically populated here -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Center Panel for Buttons -->
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

                                            <!-- Right Panel -->
                                            <div class="col-md-5">
                                                <div class="data-panel">
                                                    <div class="data-table">
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
                                                                <!-- Details data goes here -->
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
                                                <button type="button" class="btn btn-success"
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

                                                    <div class="col-md-2 ">
                                                        <label for="startDateLIS" class="form-label">Start
                                                            Date</label>
                                                        <input type="date" id="startDateLISHasil" name="startDateLIS"
                                                            class="form-control   dateflatpickr">
                                                    </div>

                                                    <div class="col-md-2 ">
                                                        <label for="endDateLIS" class="form-label">End
                                                            Date</label>
                                                        <div class="d-flex">
                                                            <input type="date" id="endDateLISHasil" name="endDateLIS"
                                                                class="form-control   me-3 dateflatpickr">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="searchTarifLabHasil">Pencarian Tarif</label>
                                                        <div class="input-group">
                                                            <select id="searchTarifLabHasil" class="form-control fit"
                                                                style="width: 100%;"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
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
                                                <th style="width: 5%;">Satuan</th>
                                                <th style="width: 7%;">Nilai Rujukan</th>
                                                <th style="width: 15%;">Metode</th>
                                                <th style="width: 2%;">Flag</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hasilFilterLIS" class="table-group-divider"></tbody>
                                    </table>
                                </div>

                                <hr>

                                <h3 class="fw-bold" for="hasil-list">Hasil LIS</h3>
                                <div class="table-responsive mt-4">
                                    <table class="table   table-hover">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th class="align-middle">No.</th>
                                                <th class="align-middle">No Sesi</th>
                                                <th class="align-middle">Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody id="labHasilLIS" class="table-group-divider"></tbody>
                                    </table>
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
                                                                    class="form-control dateflatpickr">
                                                            </div>
                                                            <!-- End Date Input -->
                                                            <div class="col-md-3 mb-3">
                                                                <label for="endDateBloodRequest" class="form-label">End
                                                                    Date</label>
                                                                <div class="d-flex">
                                                                    <input type="text" name="end_date"
                                                                        id="endDateBloodRequest"
                                                                        class="form-control   dateflatpickr">
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
                                                    <table class="table table-sm table-striped"
                                                        id="tableFormBloodRequest-Lab">
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
                        </div>
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