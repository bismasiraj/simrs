<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();

$db = db_connect();

?>

<style>
    .quill-textarea-patologi>.ql-toolbar:first-child {
        display: none !important;
    }
</style>
<div class="tab-pane" id="patologi" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="patologi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#transaksi-patologi-tab" data-bs-toggle="tab">Transaksi</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">

                            <div class="tab-pane fade show active" id="transaksi-patologi-tab">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mt-4 mb-4">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-primary" style="text-align: center;">
                                                <tr>
                                                    <th class="text-center" style="width: 10%;">Tanggal</th class="text-center">
                                                    <th class="text-center" style="width: 10%;">Kode</th class="text-center">
                                                    <th class="text-center" style="width: auto;">Nama Tindakan</th class="text-center">
                                                    <th class="text-center" style="width: 1%;">Hasil</th class="text-center">
                                                </tr>
                                            </thead>
                                            <tbody id="patologiBody">
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <form id="formSearchingTarifPatologi" action="" method="post" class="">
                                    <div class="box-body row mt-4">
                                        <input type="hidden" name="ci_csrf_token" value="">

                                        <div class="col-sm-12 col-md-12 mb-4">

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Nomor Sesi</label>
                                                        <select id="notaNoPatologi" class="form-select" style="width: 100%">
                                                            <option value="%">Semua</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php if (user()->checkPermission("patologi", 'c') || user()->checkRoles(['dokterlab', 'superuser', 'adminlab'])) { ?>
                                                    <div class="col-md-10">
                                                        <div class="form-group spppoli-to-hide">
                                                            <label for="">Pencarian Tarif</label>
                                                            <div class="input-group">
                                                                <select id="searchTarifPatologi" class="form-control fit" style="width: 70%; height: 100%;"></select>
                                                                <button id="searchTarifPatologiBtn" type="button" class="btn btn-primary btn-sm addcharges align-items-end" onclick='addBillPatologi("searchTarifPatologi")'>
                                                                    <i class="fa fa-plus"></i> Tambah
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
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
                                            <tbody id="patologiChargesBody" class="table-group-divider">
                                            </tbody>
                                        </table>
                                        <div class="panel-footer text-end mb-4 spppoli-to-hide">
                                            <button type="button" id="formSaveBillPatologiBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <!-- <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->



</div>


<!-- Modal -->
<div class="modal fade modal-xl" id="modalPatologi" aria-labelledby="modalPatologiLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalPatologiLabel">Hasil Patologi</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="ModalBodyPatologi" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formModalPatologi" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name_of_pasien" value="<?= $visit['diantar_oleh']; ?>">
                    <input type="hidden" name="age" value="<?= $visit['age']; ?>">
                    <input type="hidden" name="visitor_address" value="<?= $visit['visitor_address']; ?>">
                    <input type="hidden" name="gendername" value="<?= @$visit['gendername']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="tarif_id" id="patologi_tarif_id">
                    <input type="hidden" name="bill_id" id="patologi_bill_id">
                    <input type="hidden" name="visit_id" id="patologi_visit_id">
                    <input type="hidden" name="isvalid" value="0" id="modalIsValid_patologi">
                    <input type="hidden" name="iskritis" value="0" id="modalIsKritis_patologi">
                    <div class="row">
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                        </div>
                        <div class="col mt-2">
                            <h3 class="kop-name-patologi" id="kop-name-patologi">
                            </h3>
                            <p class="kop-address-patologi" id="kop-address-patologi">
                        </div>
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                            <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                        </div>
                    </div>
                    <br>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <h3 class="text-center mb-0 my-1">HASIL PEMERIKSAAN PATOLOGI ANATOMI</h3>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="20%">Nama</td>
                            <td width="1%">:</td>
                            <td colspan="2"><?= $visit['diantar_oleh']; ?></td>
                            <td width="20%">No.RM</td>
                            <td width="1%">:</td>
                            <td><?= $visit['no_registration']; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Umur</td>
                            <td width="1%">:</td>
                            <td><?= $visit['age']; ?></td>
                            <td>LP: <?= @$visit['gendername']; ?></td>
                            <td width="20%">Tanggal</td>
                            <td width="1%">:</td>
                            <td><?= date('d-m-Y') ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Alamat</td>
                            <td width="1%">:</td>
                            <td colspan="2"><?= $visit['visitor_address']; ?></td>
                            <td width="20%">Dokter</td>
                            <td width="1%">:</td>
                            <td id="doctor_patologi"></td>
                        </tr>
                    </table>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;" class="mb-2"></div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="template_patologi" class="form-label">Template</label>
                                <select class="form-select" id="template_patologi" type="text" name="template_patologi" style="width: 100%;">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="patologi_no_sampel" class="form-label">No Sampel</label>
                                <input type="text" class="form-control" name="no_sampel" id="patologi_no_sampel">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="patologi_tarif_name" class="form-label">Jenis Pemeriksaan</label>
                                <input type="text" class="form-control" name="tarif_name" id="patologi_tarif_name" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="patologi_diagnosa_klinis" class="form-label">Diagnosa Klinis</label>
                                <input type="text" class="form-control" name="diagnosa_klinis" id="patologi_diagnosa_klinis">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="patologi_asal_jaringan" class="form-label">Asal Jaringan</label>
                                <input type="text" class="form-control" name="asal_jaringan" id="patologi_asal_jaringan">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="patologi_makroskopik" class="form-label">Makroskopik</label>
                                <textarea name="makroskopik" class="form-control quill-patologi" rows="8" id="patologi_makroskopik"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="patologi_mikroskopik" class="form-label">Mikroskopik</label>
                                <textarea name="mikroskopik" class="form-control quill-patologi" rows="8" id="patologi_mikroskopik"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="patologi_conclusion" class="form-label">Kesimpulan</label>
                                <textarea name="conclusion" class="form-control quill-patologi" rows="8" id="patologi_conclusion"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary" id="isValidPatologi">Validasi</button>
                            <button type="button" class="btn btn-outline-primary" id="isKritisPatologi">Nilai Kritis</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFilePatologi" class="form-label">Upload File Pendukung (optional)</label>
                            <input class="form-control" type="file" id="formFilePatologi" name="file" accept=".pdf, .jpg, .jpeg, .png, .webp">
                        </div>
                        <div class="mb-2">
                            <img id="imagePreviewPatologi" src="#" alt="Image Preview" style="display: none; width: 100%; height: auto;" />
                            <embed id="pdfPreviewPatologi" type="application/pdf" style="display: none; width: 100%; height: 500px;" />
                            <p id="fileNamePatologi" style="display: none;"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="printPatologi" type="button" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
                <button id="savePatologi" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>