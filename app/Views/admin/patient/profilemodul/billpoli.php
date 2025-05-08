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
<div class="tab-pane" id="billpoli" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-xs-12">
            <!-- <div class="row mt-4">
                <div class="col-md-12">
                    <div id="listRequestbillpoli" class="row">

                    </div>
                </div>
                <div class="col-md-12">
                    <div id="billpolioratoriumAdd" class="box-tab-tools text-center">
                        <a data-toggle="modal" onclick="requestbillpoli()" class="btn btn-primary btn-lg" id="addbillpoliBtn" style="width: 300px"><i class=" fa fa-plus"></i> Buat billpoli Online</a>
                    </div>
                </div>
            </div>
            <div class="accordion mt-4">
                <div class="panel-group" id="billpoliBody">
                </div>
            </div> -->

            <form id="formbillpoli" action="" method="post" class="">
                <div class="box-body row mt-4">
                    <input type="hidden" name="ci_csrf_token" value="">

                    <div class="col-sm-12 col-md-12 mb-4">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Nomor Sesi</label>
                                    <select id="notaNoPoli" class="form-control" style="width: 100%">
                                        <option value="%">Semua</option>
                                    </select>
                                </div>
                            </div>
                            <?php if (user()->checkPermission("tindakanmedis", "c")) {
                            ?>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="">Pencarian Tarif</label>
                                        <div class="input-group">
                                            <select id="searchTarifbillpoli" class="form-control" style="width: 80%; height: 100%;"></select>
                                            <button type="button" class="btn btn-primary btn-sm addcharges align-items-end" onclick='addBillBillPoli("searchTarifbillpoli")'>
                                                <i class="fa fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        </div>

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
                            <tbody id="billPoliChargesBody" class="table-group-divider">
                                <?php
                                $total = 0;
                                ?>
                            </tbody>
                        </table>
                        <?php if (user()->checkPermission("tindakanmedis", "c")) {
                        ?>
                            <div class="panel-footer text-end mb-4">
                                <button type="button" id="formSaveBillPoliBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                <!-- <button type="button" id="formEditBillPoliBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button> -->
                                <!-- <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button> -->
                                <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->