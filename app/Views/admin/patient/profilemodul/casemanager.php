<div class="tab-pane" role="tabpanel" id="casemanager">
    <div class="row">
        <div id="load-content-cm" class="col-12 center-spinner"></div>
        <div id="contentToHideCM" class="col-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                        'visit' => $visit,
                    ]); ?>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-12">
                    <div class="accordion mt-4">
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#create-modal-casemanager2" id="btn-create-casemanager">+ Tambah Dokumen</button>
                        </div>
                        <div class="panel-group" id="tableInfCon">
                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Dokumentasi Case Manager</h3>
                            <table class="table table-bordered table-hover table-centered" style="text-align: center">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Dokumen</th>
                                        <th scope="col" width="1%"><i class="fas fa-search-plus"></i></th>
                                        <th scope="col" width="1%"><i class="fas fa-edit"></i></th>
                                        <th scope="col" width="1%"><i class="fas fa-trash-alt"></i></th>
                                        <th scope="col" width="1%"><i class="fas fa-print"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="bodydataCM" class="table-group-divider">

                                    <tr>
                                        <td colspan="6">Data Kosong</td>
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
<div class="modal fade modal-xl" id="create-modal-casemanager" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Case Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDokumentCM">
                    <!-- <div>
                        <label for="exampleDataList" class="col-form-label">Dokumen</label>
                        <select class="form-select" id="parameter_id_casemanager" name="parameter_id">
                        </select>
                    </div> -->
                    <div id="content-param-casemanager" class="row"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-create-modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-save-cm-modal">Simpan</button>
                <button type="button" class="btn btn-primary" id="btn-edit-cm-modal">Perbarui</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade modal-xl" id="create-modal-casemanager2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Case Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDokumentCM">
                    <!-- <div>
                        <label for="exampleDataList" class="col-form-label">Dokumen</label>
                        <select class="form-select" id="parameter_id_casemanager" name="parameter_id">
                        </select>
                    </div> -->
                    <div id="content-param-casemanager" class="row"></div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-create-modal">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-save-cm-modal">Simpan</button>
                <button type="button" class="btn btn-primary" id="btn-edit-cm-modal">Perbarui</button>
            </div>
        </div>
    </div>
</div>

<?php echo view('admin/patient/profilemodul/jsprofile/casemanager_js', [
    'title' => 'Case Manager',
    'visit' => $visit,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
]) ?>