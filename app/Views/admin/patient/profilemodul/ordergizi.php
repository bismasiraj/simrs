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
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
    integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="tab-pane" id="orderGizi" role="tabpanel">
    <div class="row">
        <div id="loadContentOrderGizi" class="col-12 center-spinner"></div>
        <div id="contentOrderGizi" class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div>
            <!--./col-lg-6-->
            <div class="col-lg-10 col-md-10 col-sm-12">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div id="ordergiziAdd" class="box-tab-tools text-center">
                            <a data-toggle="modal" onclick="addOrderGizi(1, 1, '','orderGiziBody')"
                                class="btn btn-primary btn-lg" id="addOrderGiziBtn" style="width: 300px"><i
                                    class=" fa fa-plus"></i> Buat Order Gizi</a>
                        </div>
                    </div>
                </div>
                <div id="orderGiziBody" class="table-rep-plugin">
                </div>
            </div>
        </div>
    </div>
    <!--./row-->

</div>


<div class="modal fade" id="bentukGizi" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Bentuk Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="bentukmultibox">
                    <input type="hidden" id="bentukgizicontainer">
                </div>
                <div class="panel-footer text-end mb-4">
                    <button type="button" id="saveBentukGizi" name="save"
                        data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i
                            class="fa fa-check-circle"></i> <span>Pilih</span></button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="peringatanGizi" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Peringatan Gizi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="peringatanmultibox">
                    <input type="hidden" id="peringatangizicontainer">
                </div>
                <div class="panel-footer text-end mb-4">
                    <button type="button" id="savePeringatanGizi" name="save"
                        data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i
                            class="fa fa-check-circle"></i> <span>Pilih</span></button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>