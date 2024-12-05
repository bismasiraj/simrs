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

<div class="tab-pane" id="pemeriksaanKulit" role="tabpanel">
    <div class="row">
        <div id="load-content-pemeriksaanKulit" class="col-12 center-spinner"></div>
        <div id="contentToHide-pemeriksaanKulit" class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
            'visit' => $visit,
          ]); ?>
                </div>
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <div class="accordion mt-4">
                        <center>
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                data-target="#pemeriksaanKulit-modal" id="btn-doc-pemeriksaanKulit"><i
                                    class=" fa fa-plus"></i>
                                Tambah
                                Dokumen</button>
                        </center>
                        <div class="panel-group table-responsive" id="table-pemeriksaanKulit">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Assessmen Dermatovenerologi</h3>
                            <table class="table table-bordered table-hover table-centered" style="text-align: center"
                                id="tableDat-Dermatovenerologi">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="row" class="w-auto text-nowrap">No.</th>
                                        <th scope="row" class="w-auto text-nowrap">Tgl</th>
                                        <th scope="row" class="w-auto text-nowrap"></th>
                                    </tr>
                                </thead>
                                <tbody id="bodydatapemeriksaanKulit" class="table-group-divider">

                                    <tr>
                                        <td colspan="300">Data Kosong</td>
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
<div class="modal fade modal-xl" id="pemeriksaanKulit-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Assessmen Dermatovenerologi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormAssessmen_Dermatovenerologi">
                    <div id="contentAssessmen_Dermatovenerologi_Hide">
                    </div>
                    <div id="contentAssessmen_Dermatovenerologi_Show"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="close-pemeriksaanKulit-modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-action-dermatovenerologi">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="notif-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-notif"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="content-notif">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-notif">Save changes</button>
            </div>
        </div>
    </div>
</div>