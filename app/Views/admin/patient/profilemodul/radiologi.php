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
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
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
                    <div class="operasi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#transaksi-rad-tab" data-bs-toggle="tab">Transaksi</a>
                            </li>
                            <?php if (user()->checkRoles(['dokterradiologi', 'superuser'])) : ?>
                                <li class="nav-item text-center flex-fill">
                                    <a class="nav-link" href="#template-rad-tab" data-bs-toggle="tab">Template Ekspertise</a>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <div class="tab-content mt-3">

                            <div class="tab-pane fade show active" id="transaksi-rad-tab">
                                <div class="table-responsive mt-4 mb-4">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary" style="text-align: center;">
                                            <tr>
                                                <th class="text-center" style="width: 10%;">Kode</th class="text-center">
                                                <th class="text-center" style="width: auto;">Nama Tindakan</th class="text-center">
                                                <th class="text-center" style="width: 1%;">Hasil</th class="text-center">
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
                                                        <label for="">Nomor Sesi</label>
                                                        <select id="notaNoRad" class="form-control" style="width: 100%">
                                                            <option value="%">Semua</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php if (user()->checkPermission("rad", "c")) : ?>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                            <label for="">Pencarian Tarif</label>
                                                            <div class="input-group">
                                                                <select id="searchTarifRad" class="form-control fit" style="width: 70%; height: 100%;"></select>
                                                                <button type="button" class="btn btn-primary btn-sm addcharges align-items-end" onclick='addBillRad("searchTarifRad")'>
                                                                    <i class="fa fa-plus"></i> Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0">
                                        <table class="table table-sm table-hover">
                                            <thead class="table-primary" style="text-align: center;">
                                                <tr>
                                                    <th class="text-center" rowspan="2" style="width: 5%;">No.</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Dokter</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Tgl Tindakan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Jml</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 5%"></th class="text-center">
                                                </tr>
                                            </thead>
                                            <tbody id="radChargesBody" class="table-group-divider">
                                            </tbody>
                                        </table>
                                        <?php if (user()->checkPermission('rad', 'c')) {
                                        ?>
                                            <div class="panel-footer text-end mb-4">
                                                <button type="button" id="formSaveBillRadBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                <!-- <button type="button" id="formEditBillRadBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button> -->
                                                <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
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
                                                    <select class="form-select" id="template_nama_dokter" type="text" name="nama_dokter" style="width: 100%; height: 100%">
                                                        <?php if (!empty($result)) : ?>
                                                            <option value="<?= $result['employee_id']; ?>"><?= $result['fullname']; ?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>

                                                <!-- Dropdown for Category -->
                                                <div class="col-md-4">
                                                    <select class="form-select" id="template_jenis_pemeriksaan" name="jenis_pemeriksaan" style="width: 100%; height: 100%">
                                                        <option value="">SEMUA</option>
                                                        <option value="rontgen">RONTGEN</option>
                                                        <option value="usg">USG</option>
                                                        <option value="ct scan">CT SCAN</option>
                                                    </select>
                                                </div>

                                                <!-- Search Button -->
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary w-100" type="button" id="btn_cari_template_rad"><i class="fas fa-search-plus"></i> Cari</button>
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
                                                                    <th class="text-center" style="width: 1% !important;">No.</th>
                                                                    <th class="text-center">Nama Template</th>
                                                                    <th class="text-center" style="width: 1% !important;"><i class="fas fa-search-plus"></i></th>
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


        </div>
    </div><!--./row-->



</div>
<!-- Modal -->
<div class="modal fade modal-fullscreen" id="modalExpertise" aria-labelledby="ModalLabelExpertise" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelExpertise">Ekspertise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formExpertise" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="bill_id" id="modalBill">
                    <input type="hidden" name="visit_id" id="modalVisit">
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
                                <select class="form-select" id="template_expertise" type="text" name="template_expertise" style="width: 100%;">

                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label for="modalNoFilm" class="form-label fw-bold">No Film</label>
                                            <input type="text" id="modalNoFilm" class="form-control" name="no_film" <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label for="formFile" class="form-label fw-bold">Upload berkas pendukung (optional)</label>
                                            <input class="form-control" type="file" id="formFileExpertise" name="dokumen_expertise" accept="image/*" <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad']) ? '' : 'disabled'; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="modalHasilBaca" class="form-label fw-bold">Hasil Baca</label>
                                    <textarea class="form-control" id="modalHasilBaca" name="hasil_baca" rows="9" <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser']) ? '' : 'disabled'; ?>></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="modalKesimpulan" class="form-label fw-bold">Kesimpulan</label>
                                    <textarea class="form-control" id="modalKesimpulan" name="kesimpulan" rows="3" <?= user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser']) ? '' : 'disabled'; ?>></textarea>
                                </div>
                                <div class="mb-2">
                                    <input type="hidden" name="isvalid" value="0" id="modalIsValid">
                                    <input type="hidden" name="iskritis" value="0" id="modalIsKritis">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-outline-primary" id="isValidExpertise" <?php user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser']) ? '' : 'style="display:none;"'; ?>>Validasi</button>
                                        <button type="button" class="btn btn-outline-primary" id="isKritisExpertise" <?php user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser']) ? '' : 'style="display:none;"'; ?>>Nilai Kritis</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="" style="height: 600px; overflow-y:auto;">
                                <label for="" class="form-label fw-bold">Preview Berkas</label>
                                <div class="mb-2 p-1 border border-1 border-dark rounded" style="height: auto; width:100%;">
                                    <img id="imagePreviewExpertise" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto; cursor:pointer;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <?php if (user()->checkRoles(['dokterradiologi', 'superuser', 'adminrad'])) : ?>
                    <button id="saveExpertise" type="submit" class="btn btn-primary">Simpan</button>
                    <button id="printExpertise" type="button" class="btn btn-success">Print</button>
                <?php endif; ?>
                <button id="batalExpertise" type="button" class="btn btn-danger" <?php user()->checkPermission("rad", 'c') && user()->checkRoles(['dokterradiologi', 'superuser']) ? '' : 'style="display:none;"'; ?>>Batalkan Tagihan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Template -->
<div class="modal fade modal-xl" id="modalTemplateExpertise" aria-hidden="true">
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
                                <textarea class="form-control" id="modalTemplateHasilBaca" rows="10" readonly></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="modalTemplateKesimpulan" class="form-label fw-bold">Kesimpulan</label>
                                <textarea class="form-control" id="modalTemplateKesimpulan" rows="5" readonly></textarea>
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