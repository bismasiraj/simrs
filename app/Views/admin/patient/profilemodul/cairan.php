<div class="tab-pane" id="cairan" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->

        <div class="col-lg-10 col-md-10 col-xs-12">
            <div class="accordion mt-4">
                <!-- <center>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                        data-target="#create-modal-cairan-gen0023" id="add-cairan-gen0023">
                        + Tambah Dokumen
                    </button>
                </center> -->

                <?php if (user()->checkPermission("asuhancairan", 'c') && user()->checkRoles(['superuser', 'admin', 'perawat'])){ ?>
                <div id="cairanItmBtnGroup" class="row">
                    <div class="col-md-12">
                        <div id="addCairannn" class="box-tab-tools text-center">
                            <button data-toggle="modal" class="btn btn-primary btn-lg" id="add-cairan-gen0023"
                                style="width: 300px"><i class=" fa fa-plus"></i> Tambah
                                Dokumen</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row mt-4 mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="startDateCairan">Start Date</label>
                            <input type="text" id="startDateCairan" class="form-control   dateflatpickr">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="endDateCairan">End Date</label>
                            <input type="text" id="endDateCairan" class="form-control   dateflatpickr">
                        </div>
                    </div>

                    <div class="col-md-3 mt-4">
                        <div class="form-group">
                            <button type="button" id="btn-search-cairangen0023" class="btn btn-primary ">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>

                <div class="panel-group table-responsive" id="cairan">
                    <h3 class="text-uppercase font-weight-bold mt-0 pt-2">Cairan</h3>
                    <table class="table table-bordered table-hover table-centered text-center" id="tableDat-cairan0023">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Tipe Cairan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="bodydatagen0023">
                            <tr>
                                <td colspan="3">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 d-flex align-items-end justify-content-end">
                    <div class="form-group">
                        <button type="button" id="btn-print-cairangen0023" class="btn btn-secondary  ml-2">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Modal Tambah Dokumen -->
<div class="modal fade modal-xl" id="create-modal-cairan-gen0023" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-gen0023">Cairan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDokument-gen0023">
                    <!-- <div id="content-hide" hidden>
            </div> -->
                    <div id="dokument-gen0023"></div>
                    <div id="content-param"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="close-cairan-modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-save-gen0023-modal">Simpan</button>
            </div>
        </div>
    </div>
</div>