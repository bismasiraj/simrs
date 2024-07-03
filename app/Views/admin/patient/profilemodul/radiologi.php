<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();
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
                <div class="col-md-12">
                    <div id="listRequestRad" class="row">

                    </div>
                </div>
                <div class="col-md-12">
                    <div id="radiologiAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestRad()" class="btn btn-primary btn-lg" id="addRadBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat Radiologi Online</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-4 mb-4">
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th class="text-center" style="width: 10%;">Kode</th class="text-center">
                            <th class="text-center" style="width: 30%;">Nama Tindakan</th class="text-center">
                            <!-- <th class="text-center"  style="width: 10%;">Tanggal</th class="text-center"> -->
                            <!-- <th class="text-center"  style="width: 10%;">Dokter Pemeriksa</th class="text-center"> -->
                            <th class="text-center" style="width: auto;">Hasil</th class="text-center">
                            <th class="text-center" style="width: auto;"></th class="text-center">
                        </tr>
                    </thead>
                    <tbody id="radBody">
                    </tbody>

                </table>
            </div>
            <form id="form1" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">

                    <div class="col-sm-12 col-md-12 mb-4">

                        <?php if (isset($permissions['tindakanpoli']['c'])) {
                            if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Nomor Sesi</label>
                                            <select id="notaNoRad" class="form-control" style="width: 100%">
                                                <option value="%">Semua</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="">Pencarian Tarif</label>
                                            <div class="div">
                                                <select id="searchTarifRad" class="form-control" style="width: 80%; height: 100%;"></select>
                                                <a data-toggle="modal" onclick='addBillRad("searchTarifRad")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </form>
            <div class="table-rep-plugin">
                <div class="table-responsive mb-0">
                    <table class="table table-sm table-hover">
                        <thead class="table-primary" style="text-align: center;">
                            <tr>
                                <th class="text-center" style="width: 2%;">No.</th class="text-center">
                                <th class="text-center" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                <th class="text-center" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                <th class="text-center" style="width: 10%;">Nilai</th class="text-center">
                                <th class="text-center" style="width: 10%;">Total Tagihan</th class="text-center">
                                <th class="text-center" colspan="2" style="width: 20%;">Tanggungan pihak ke-3</th class="text-center">
                                <th class="text-center" style="width: auto;">Diskon</th class="text-center">
                                <th class="text-center" style="width: 10%;">Subsidi Satuan</th class="text-center">
                                <th class="text-center" style="width: 10%;">Subsidi Total</th class="text-center">
                                <th class="text-center"></th class="text-center">
                                <th class="text-center"></th class="text-center">
                            </tr>
                        </thead>
                        <tbody id="radChargesBody" class="table-group-divider">
                        </tbody>
                    </table>
                    <div class="panel-footer text-end mb-4">
                        <button type="button" id="formSaveBillRadBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                        <button type="button" id="formEditBillRadBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                        <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                        <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->