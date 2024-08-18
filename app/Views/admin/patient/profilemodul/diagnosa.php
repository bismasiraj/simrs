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
            <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                <?php echo view('admin/patient/profilemodul/profilebiodata', [
                    'visit' => $visit,
                    'pasienDiagnosaAll' => $pasienDiagnosaAll,
                    'pasienDiagnosa' => $pasienDiagnosa
                ]); ?>
            </div><!--./col-lg-6-->
            <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
                <!-- <div id="loadContentDiagnosa" class="col-12 center-spinner"></div> -->
                <div class="card border-1 rounded-4 p-4">
                    <div class="card-body">
                        <div class="modal-body pt0 pb0">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row row-eq">
                                        <!-- INI CURRENT FILLING DATA -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div id="ajax_load"></div>
                                            <div class="row">
                                                <h3>Diagnosa Klinis</h3>
                                                <hr>
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                </div><!--./col-md-12-->
                                                <div class="accordion" id="accordionDiagnosa">
                                                </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div><!--./col-md-12-->
                                                <div class="row">
                                                </div>
                                            </div><!--./row-->
                                            <div class="row">
                                                <h3>Diagnosa Perawat</h3>
                                                <hr>
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                </div><!--./col-md-12-->
                                                <div class="accordion" id="accordionDiagnosaPerawat">
                                                </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div><!--./col-md-12-->
                                                <div class="row">
                                                </div>
                                            </div><!--./row-->
                                        </div><!--./col-md-8-->
                                        <!-- INI HISTORY PART -->
                                    </div><!--./col-md-4-->
                                </div><!--./row-->
                            </div><!--./col-md-12-->
                        </div><!--./row-->
                    </div>
                </div>
                <!-- <h3>Histori Assessmen Medis</h3> -->
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th></th>
                            <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                            <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                            <th class="text-center" style="width: 20%;">S (Subyektif)</th class="text-center">
                            <th class="text-center" style="width: 20%;">O (Obyektif)</th class="text-center">
                            <th class="text-center" style="width: 20%;">A (Asesmen)</th class="text-center">
                            <th class="text-center" style="width: 20%;">P (Prosedur)</th class="text-center">
                        </tr>
                    </thead>
                    <tbody id="assessmentMedisHistoryBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->

<div class="modal fade" id="gcsModal" role="dialog" aria-labelledby="myModalLabel">
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
                <div id="agcsDocument" class="border-1 rounded-4 mb-4" style="">

                </div>
            </div>
        </div>
    </div>
</div>