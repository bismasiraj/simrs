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
<div class="tab-pane" id="fall" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
            <div id="" class="box-tab-tools text-center">
                <a data-toggle="modal" onclick="initialAddafall()" class="btn btn-primary btn-lg" id="" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <h3>Histori Resiko Jatuh</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 20%;">Tanggal & Jam</th>
                        <th class="text-center" style="width: 10%;">Petugas</th>
                        <th class="text-center" style="width: 10%;">ALAT UKUR</th>
                        <th class="text-center" style="width: 10%;">PROVING</th>
                        <th class="text-center" style="width: 10%;">QUALITY</th>
                        <th class="text-center" style="width: 10%;">REGIO</th>
                        <th class="text-center" style="width: 10%;">SCALE</th>
                        <th class="text-center" style="width: 10%;">TIMING</th>
                        <th class="text-center" colspan="2" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody id="fallBody">

                </tbody>
            </table>
        </div>
    </div><!--./row-->
</div>
<!-- -->

<div class="modal fade" id="fallModal" role="dialog" aria-labelledby="myModalLabel">
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
                <div id="afallDocument" class="border-1 rounded-4 mb-4 p-4" style="">

                </div>
            </div>
        </div>
    </div>
</div>