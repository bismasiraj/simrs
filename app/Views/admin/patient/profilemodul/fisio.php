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
<div class="tab-pane" id="fisio" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
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
                    <tbody id="fisioBody">
                        <?php
                        $total = 0;

                        ?>


                    </tbody>

                </table>
            </div>
            <form id="formSearchingTarifFisio" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">

                    <div class="col-sm-12 col-md-12 mb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Nomor Sesi</label>
                                    <select id="notaNofisio" class="form-control" style="width: 100%">
                                        <option value="%">Semua</option>
                                    </select>
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
                        <tbody id="fisioChargesBody" class="table-group-divider">
                        </tbody>
                    </table>
                    <?php if (user()->checkPermission("fisio", "c")) {
                    ?>
                        <div class="col-md-10 m-4">
                            <div class="form-group spppoli-to-hide">
                                <label for="">Pemeriksaan/Tindakan</label>
                                <div class="input-group">
                                    <select id="searchTariffisio" class="form-control" style="width: 80%; height: 100%;"></select>
                                    <button id="searchTariffisioBtn" type="button" class="btn btn-primary btn-sm addcharges align-items-end d-none" onclick='addBillfisio("searchTariffisio")'>
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
                    <?php if (user()->checkPermission("fisio", "c")) {
                    ?>
                        <div class="panel-footer text-end mb-4 spppoli-to-hide">
                            <button type="button" id="formSaveBillfisioBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                            <button type="button" id="formEditBillfisioBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button>
                            <!-- <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button> -->
                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->