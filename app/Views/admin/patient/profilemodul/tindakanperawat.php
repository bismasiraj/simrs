<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="tindakanperawat" role="tabpanel">
    <div class="row">
        <div id="loadContentTindakanPerawat" class="col-12 center-spinner"></div>

        <div id="contentTindakanPerawat" class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--./col-lg-6-->
            <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
                <div class="row">
                    <h3>Implementasi</h3>
                    <hr>
                    <div class="col-md-12">
                        <div class="dividerhr"></div>
                    </div><!--./col-md-12-->
                    <div class="row">
                        <div class="col-md-12">
                            <form id="formTindakanKolaboratif" action="" method="post" class="">
                                <div class="box-body row mt-4">
                                    <input type="hidden" name="ci_csrf_token" value="">
                                    <div class="col-sm-12 col-md-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Nomor Sesi</label>
                                                    <select id="tindakanBodyPerawatKolaborasiNota" class="form-control" style="width: 100%">
                                                        <option value="%">Semua</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="">Pencarian Tarif</label>
                                                    <div class="input-group">
                                                        <select id="searchTarifKolaboratif" class="form-control" style="width: 80%; height: 100%;"></select>
                                                        <button type="button" class="btn btn-primary btn-sm addcharges align-items-end" onclick='addBillChargePerawat("searchTarifKolaboratif", 1, 1, 0,"tindakanBodyPerawat")'>
                                                            <i class="fa fa-plus"></i> Tambah
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                                            <div class="col-md-8"><select id="searchTarifKolaboratif" class="form-control" style="width: 100%"></select></div>
                                                            <div class="col-md-4">
                                                                <div class="box-tab-tools">
                                                                    <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifKolaboratif", 1, 1, 0,"tindakanBodyPerawat")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <style>
                                    th {
                                        width: 200px;
                                    }

                                    #chargesBody td {
                                        text-align: center;
                                    }

                                    #chargesBody p {
                                        color: cadetblue;
                                    }
                                </style>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0">
                                        <form id="formtindakanBodyPerawat" action="" method="post" class="">
                                            <table class="table table-sm table-hover">
                                                <thead class="table-primary" style="text-align: center;">
                                                    <tr>
                                                        <th class="text-center" rowspan="2" style="width: 5%;">No.</th class="text-center">
                                                        <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                        <th class="text-center" rowspan="2" style="width: 20%;">Tgl Tindakan</th class="text-center">
                                                        <th class="text-center" colspan="3" style="width: 45%;">Deskripsi Tindakan / Rincian Biaya</th class="text-center">
                                                        <th class="text-center" rowspan="2"></th class="text-center">
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center" style="width: 15%;">Nilai</th class="text-center">
                                                        <th class="text-center" style="width: 15%;">Jml</th class="text-center">
                                                        <th class="text-center" style="width: 15%;">Total Tagihan</th class="text-center">
                                                    </tr>
                                                </thead>
                                                <tbody id="tindakanBodyPerawatKolaborasi" class="table-group-divider">
                                                </tbody>
                                            </table>
                                            <div class="panel-footer text-end mb-4">
                                                <button type="button" id="formSaveTindPerawatBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                                <!-- <button type="button" id="formEditBillPoliBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button> -->
                                                <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                                <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                                            </div>
                                            <?php if (user()->checkPermission("tindakanperawat", "c")) {
                                            ?>
                                            <?php
                                            } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <a href="<?= base_url(); ?>/admin/rm/keperawatan/implementasi/<?= base64_encode(json_encode($visit)); ?>" target="_blank" class="btn btn-success w-100"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div><!--./row-->
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->

<div class="modal fade" id="gcsModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div><!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div id="agcsDocument" class="border-1 rounded-4 mb-4" style="">
                </div>
            </div>
        </div>
    </div>
</div>