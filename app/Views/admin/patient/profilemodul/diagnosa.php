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
<div class="tab-pane" id="diagnosa" role="tabpanel">
    <div class="row">
        <div id="loadContentDiagnosa" class="col-12 center-spinner"></div>
        <div id="contentDiagnosa" class="row">
            <div class="col-lg-2 col-md-12 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div>
            <!--./col-lg-6-->
            <div class="col-lg-10 col-md-12 col-xs-12">
                <div class="card border-1 rounded-4 p-4">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" id="diagnosaTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="dokter-diag-tab" data-bs-toggle="tab"
                                    data-bs-target="#dokter" type="button" role="tab" aria-controls="dokter"
                                    aria-selected="true">
                                    Diagnosa Dokter
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="perawat-diag-tab" data-bs-toggle="tab"
                                    data-bs-target="#perawat" type="button" role="tab" aria-controls="perawat"
                                    aria-selected="false">
                                    Diagnosa Perawat
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="diagnosaTabContent">
                            <div class="tab-pane fade show active" id="dokter-diag-content" role="tabpanel"
                                aria-labelledby="dokter-diag-tab">
                                <h2 class="mb-3">Diagnosa Klinis</h2>

                                <!-- ASESMEN MEDIS -->
                                <div class="mb-4">
                                    <h5 class="mb-2"><span class="badge bg-primary">ASESMEN MEDIS</span></h5>
                                    <hr>
                                    <div class="dividerhr mb-3"></div>
                                    <div class="accordion" id="accordionDiagnosa"></div>
                                </div>

                                <!-- CPPT -->
                                <div>
                                    <h5 class="mb-2"><span class="badge bg-primary">CPPT</span></h5>
                                    <hr>
                                    <div class="dividerhr mb-3"></div>
                                    <div class="accordion" id="accordionDiagnosaDoktercppt"></div>
                                </div>
                            </div>


                            <!-- Tab Diagnosa Perawat -->
                            <div class="tab-pane fade" id="perawat-diag-content" role="tabpanel"
                                aria-labelledby="perawat-diag-tab">
                                <h2>Diagnosa Perawat</h2>

                                <!-- ASESMEN Perawat -->
                                <div class="mb-4">
                                    <h5 class="mb-2"><span class="badge bg-primary">ASESMEN PERAWAT</span></h5>
                                    <hr>
                                    <div class="dividerhr mb-3"></div>
                                    <div class="accordion" id="accordionDiagnosaPerawat"></div>
                                </div>

                                <!-- CPPT -->
                                <div>
                                    <h5 class="mb-2"><span class="badge bg-primary">CPPT</span></h5>
                                    <hr>
                                    <div class="dividerhr mb-3"></div>
                                    <div class="accordion" id="accordionDiagnosaPerawatcppt"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover mt-4">
                    <thead class="table-primary text-center">
                        <tr>
                            <th></th>
                            <th style="width: 10%;">Tanggal & Jam</th>
                            <th style="width: 10%;">Petugas</th>
                            <th style="width: 20%;">S (Subyektif)</th>
                            <th style="width: 20%;">O (Obyektif)</th>
                            <th style="width: 20%;">A (Asesmen)</th>
                            <th style="width: 20%;">P (Prosedur)</th>
                        </tr>
                    </thead>
                    <tbody id="assessmentMedisHistoryBody"></tbody>
                </table>
            </div>

        </div>
    </div>
    <!--./row-->
</div>
<!-- -->

<div class="modal fade" id="gcsModal" role="dialog" aria-labelledby="myModalLabel" data-bs-backdrop="static">
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
            </div>
            <!--./modal-header-->
            <div class="modal-body pt0 pb0">
                <div id="agcsDocument" class="border-1 rounded-4 mb-4" style="">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-xl" id="ModalAskep" tabindex="-1" aria-labelledby="ModalLabelAskep" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelAskep">INTERVENSI KEPERAWATAN
                    BERSIHAN JALAN NAPAS TIDAK EFEKTIF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionAskep">

                    <!-- Accordion Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOneAskep">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOneAskep" aria-expanded="true"
                                aria-controls="collapseOneAskep">
                                Diagnosis Keperawatan (SDKI)
                            </button>
                        </h2>
                        <div id="collapseOneAskep" class="accordion-collapse collapse show"
                            aria-labelledby="headingOneAskep" data-bs-parent="#accordionAskep">
                            <div class="accordion-body">
                                <form id="formDiagnosisAskep">
                                    <div class="mb-3 row" id="diagnosisAskepRender">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwoAskep">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwoAskep" aria-expanded="false"
                                aria-controls="collapseTwoAskep">
                                Standar Luaran Keperawatan Indonesia (SLKI)
                            </button>
                        </h2>
                        <div id="collapseTwoAskep" class="accordion-collapse collapse" aria-labelledby="headingTwoAskep"
                            data-bs-parent="#accordionAskep">
                            <div class="accordion-body">
                                <form id="formLuaranAskep">

                                    <div class="mb-3 row" id="luaranAskepRender">
                                        <!-- <label for="luaranInput" class="form-label">Luaran</label>
                                        <input type="text" class="form-control" id="luaranInput"> -->
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThreeAskep">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThreeAskep" aria-expanded="false"
                                aria-controls="collapseThreeAskep">
                                Standar Intervensi Keperawatan Indonesia (SIKI)
                            </button>
                        </h2>
                        <div id="collapseThreeAskep" class="accordion-collapse collapse"
                            aria-labelledby="headingThreeAskep" data-bs-parent="#accordionAskep">
                            <div class="accordion-body">
                                <form id="formIntervensiAskep">
                                    <div class="mb-3 row" id="intervensiAskepRender">
                                        <!-- <label for="intervensiInput" class="form-label">Intervensi</label>
                                        <input type="text" class="form-control" id="intervensiInput"> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCetakAskep" data-loading-text="processing"
                    class="btn btn-light pull-right"><i class="fa fa-signature"></i>
                    <span>Cetak</span></button>
                <button id="saveButtonAskep" type="button" class="btn btn-primary" disabled>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>