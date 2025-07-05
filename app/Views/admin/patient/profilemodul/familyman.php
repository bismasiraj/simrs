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

<div class="tab-pane" id="familyman" role="tabpanel">
    <div class="row">
        <div id="load-content-familyman" class="col-12 center-spinner"></div>
        <div id="contentToHide-familyman" class="col-12">
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
                                data-target="#create-modal-familyman" id="btn-create-familyman">+ Tambah
                                Dokumen</button>
                        </center>
                        <!-- <div class="panel-group" id="tableInfCon">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Family </h3>
                            <table class="table table-bordered table-hover table-centered" style="text-align: center"
                                id="table-familyman">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="row" style="width: 1%;">No</th>
                                        <th scope="col">Family</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="bodydata-familyman" class="table-group-divider">

                                    <tr>
                                        <td colspan="20">Data Kosong</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade modal-xl" id="create-modal-familyman" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-familyman-modal">Informasi Keluarga / Penanggung Jawab</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);"
                        id="familyManTabContent">
                        <li class="nav-item text-center flex-fill">
                            <a class="nav-link" href="#listFamilymanTabels" data-bs-toggle="tab">List Terdaftar</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="listFamilymanTabels">
                            <center>
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                    data-target="#create-modal-familyman" id="btn-create-familyman-modal">+ Tambah
                                    Dokumen</button>
                            </center>
                            <div class="panel-group" id="tableFamilyMan">
                                <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Family </h3>
                                <table class="table table-bordered table-hover table-centered"
                                    style="text-align: center" id="table-familyman">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="row" style="width: 1%;">No</th>
                                            <th scope="col">Family</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodydata-familyman" class="table-group-divider">

                                        <tr>
                                            <td colspan="20">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="FormInputFamilyMan">
                            <form id="formDokument-familyman">
                                <div id="contentfamilyman_visit_Show"></div>
                                <hr>
                                <div id="contentfamilyman_Hide">
                                </div>
                                <div id="contentfamilyman_Show"></div>
                            </form>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-outline-primary" id="btn-save-familyman-modal"> <i
                                        class="fa fa-check-circle"></i> Simpan</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- <form id="formDokument-familyman">
                    <div id="contentfamilyman_visit_Show"></div>
                    <hr>
                    <div id="contentfamilyman_Hide">
                    </div>
                    <div id="contentfamilyman_Show"></div>
                </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="close-create-modal-familyman">Keluar</button>

            </div>
        </div>
    </div>
</div>