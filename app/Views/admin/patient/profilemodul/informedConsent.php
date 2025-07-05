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

<div class="tab-pane" id="infConsent" role="tabpanel">
    <div class="row">
        <div id="load-content-inf" class="col-12 center-spinner"></div>
        <div id="contentToHide" class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
            'visit' => $visit,
          ]); ?>
                </div>
                <div class="col-lg-10 col-md-12 col-xs-12">
                    <div class="accordion mt-4">
                        <center>
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                                data-target="#create-modal" id="btn-create">+ Tambah Dokumen</button>
                        </center>

                        <div class="panel-group" id="tableInfCon">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Informed Consent</h3>
                            <table class="table table-bordered table-hover table-centered" style="text-align: center">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="row" style="width: 1%;">No</th>
                                        <th scope="col">Tgl</th>
                                        <th scope="col">Dokumen</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="bodydata" class="table-group-divider">

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
<div class="modal fade modal-xl" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog  modal-dialog-scrollable modal-fullscreen-lg-down" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Informed Consent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDokument">
                    <!-- <div id="content-hide" hidden>
            </div> -->
                    <div>
                        <label for="exampleDataList" class="col-form-label">Dokumen</label>
                        <select class="form-select" id="inf_parameter_id" name="parameter_id">
                        </select>
                    </div>
                    <div id="content-param"></div>
                </form>
            </div>
            <div class="modal-footer modal-footer py-0 px-3">
                <div id="formsignInf" class="mb-4">
                    <p class="text-danger mb-0 p-0 small">*Perhatian: Jika berwarna merah, berarti proses tanda tangan
                        sudah selesai.
                    </p>

                    <button type="button" id="formsignInfvalid_user" name="signInf" data-filed="valid_user" da
                        data-sign-ke="1" data-user-type="1" data-button-id="btn-save-inf-modal"
                        class="btn btn-outline-warning">
                        <i class="fa fa-signature"></i> <span>Sign Petugas</span>
                    </button>
                    <button type="button" id="formsignInfvalid_pasien" name="signInf" data-filed="valid_pasien"
                        data-sign-ke="2" data-user-type="2" data-button-id="btn-save-inf-modal"
                        class="btn btn-outline-warning">
                        <i class="fa fa-signature"></i> <span>Sign Pasien / Keluarga</span>
                    </button>
                    <button type="button" id="formsignInfvalid_other" name="signInf" data-filed="valid_other"
                        data-sign-ke="3" data-user-type="3" data-button-id="btn-save-inf-modal"
                        class="btn btn-outline-warning">
                        <i class="fa fa-signature"></i> <span>Sign Saksi 1</span>
                    </button>
                    <button type="button" id="formsignInfvalid_other2" name="signInf" data-filed="valid_other2"
                        data-sign-ke="4" data-user-type="3" data-button-id="btn-save-inf-modal"
                        class="btn btn-outline-warning">
                        <i class="fa fa-signature"></i> <span>Sign Saksi 2</span>
                    </button>
                    <button type="button" id="formsignInfvalid_other3" name="signInf" data-filed="valid_other3"
                        data-sign-ke="5" data-user-type="3" data-button-id="btn-save-inf-modal"
                        class="btn btn-outline-warning">
                        <i class="fa fa-signature"></i> <span>Sign Saksi 3</span>
                    </button>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="close-create-modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-save-inf-modal">Simpan</button>
                <button type="button" class="btn btn-primary" id="btn-edit-inf-modal">Perbarui</button>
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