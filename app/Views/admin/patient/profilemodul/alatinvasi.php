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

<div class="tab-pane" id="gearinvasi" role="tabpanel">
    <div class="row">
        <div id="load-content-gear" class="col-12 center-spinner"></div>
        <div id="contentToHide-gear" class="col-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
            'visit' => $visit,
          ]); ?>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-12">
                    <div class="accordion mt-4">
                        <center>
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                data-target="#create-modal-gear" id="btn-create-gear">+ Tambah Dokumen</button>
                        </center>
                        <div class="panel-group" id="tableInfCon">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">ALAT INVASIF</h3>
                            <table class="table table-bordered table-hover table-centered" style="text-align: center"
                                id="table-tools">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="row" style="width: 1%;">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Alat Invasif</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Ukuran</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="bodydata-gear" class="table-group-divider">

                                    <tr>
                                        <td colspan="20">Data Kosong</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade modal-xl" id="create-modal-gear" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-gear-modal">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDokument-alatInvasif">
                    <div id="contentToolsInvasif_Hide">
                    </div>
                    <div id="contentToolsInvasif_Show"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="close-create-modal-gear">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-save-tools-modal">Simpan</button>
            </div>
        </div>
    </div>
</div>



<?php echo view('admin/patient/profilemodul/jsprofile/alatinvasi_js.php', [
  'title' => 'Test',
  'visit' => $visit,
  'aParent' => $aParent,
  'aType' => $aType,
  'aParameter' => $aParameter,
  'aValue' => $aValue,
]) ?>