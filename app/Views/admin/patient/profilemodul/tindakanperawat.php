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
<div class="tab-pane" id="tindakanperawat" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12 mt-4">
            <div class="row">
                <h3 id="">Tindakan Keperawatan</h3>
                <hr>
                <div class="col-md-12">
                    <div class="dividerhr"></div>
                </div><!--./col-md-12-->
                <div class="accordion" id="accordionDiagnosa">
                    <div id="atipTindakanKolaboratif_Group" class="accordion-item">
                        <h2 class="accordion-header" id="tindakanPerawat">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawat" aria-expanded="true" aria-controls="collapseTindakanPerawat">
                                <b>TINDAKAN KOLABORATIF</b>
                            </button>
                        </h2>
                        <div id="collapseTindakanPerawat" class="accordion-collapse collapse" aria-labelledby="tindakanPerawat" data-bs-parent="#accodrionAssessmentAwal" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="form1" action="" method="post" class="">
                                            <div class="box-body row mt-4">
                                                <input type="hidden" name="ci_csrf_token" value="">
                                                <div class="col-sm-12 col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-8"><select id="searchTarifPerawat" class="form-control" style="width: 100%"></select></div>
                                                        <div class="col-md-4">
                                                            <div class="box-tab-tools">
                                                                <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawat", 1, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (isset($permissions['tindakanpoli']['c'])) {
                                                        if ($permissions['tindakanpoli']['c'] == '1') { ?>
                                                            <div class="row">
                                                                <div class="col-md-8"><select id="searchTarif" class="form-control" style="width: 100%"></select></div>
                                                                <div class="col-md-4">
                                                                    <div class="box-tab-tools">
                                                                        <a data-toggle="modal" onclick='addBillChargePerawat("searchTarif")' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <style>
                                                th {
                                                    width: 200px;
                                                }

                                                #chargesBody td {
                                                    text-align: center;
                                                }

                                                #chargesBody p {
                                                    color: cadetblue;
                                                }
                                            </style>
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive mb-0">
                                                    <form id="formchargesBodyPerawat" action="" method="post" class="">
                                                        <table class="table table-sm table-hover">
                                                            <thead class="table-primary" style="text-align: center;">
                                                                <tr>
                                                                    <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: auto;">Prosedur Non Tarif</th class="text-center">
                                                                    <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                                                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 5%;">Jml</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                                    <th class="text-center" rowspan="2"></th class="text-center">
                                                                </tr>
                                                            </thead>
                                                            <tbody id="chargesBodyPerawat" class="table-group-divider">
                                                                <?php
                                                                $total = 0;
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="atipTindakanMandiri_Group" class="accordion-item">
                        <h2 class="accordion-header" id="tindakanPerawatMandiri">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTindakanPerawatMandiri" aria-expanded="true" aria-controls="collapseTindakanPerawatMandiri">
                                <b>TINDAKAN MANDIRI</b>
                            </button>
                        </h2>
                        <div id="collapseTindakanPerawatMandiri" class="accordion-collapse collapse" aria-labelledby="tindakanPerawatMandiri" data-bs-parent="#accodrionAssessmentAwal" style="">
                            <div class="accordion-body text-muted">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="form1" action="" method="post" class="">
                                            <div class="box-body row mt-4">
                                                <input type="hidden" name="ci_csrf_token" value="">
                                                <div class="col-sm-12 col-md-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-8"><select id="searchTarifPerawatMandiriSelf" class="form-control" style="width: 100%"></select></div>
                                                        <div class="col-md-4">
                                                            <div class="box-tab-tools">
                                                                <a data-toggle="modal" onclick='addBillChargePerawat("searchTarifPerawatMandiriSelf", 2, 1)' class="btn btn-primary btn-sm addcharges"><i class="fa fa-plus"></i> Tambah</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <style>
                                                th {
                                                    width: 200px;
                                                }

                                                #chargesBody td {
                                                    text-align: center;
                                                }

                                                #chargesBody p {
                                                    color: cadetblue;
                                                }
                                            </style>
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive mb-0">
                                                    <form id="formchargesBodyPerawatMandiri" action="" method="post" class="">
                                                        <table class="table table-sm table-hover">
                                                            <thead class="table-primary" style="text-align: center;">
                                                                <tr>
                                                                    <th class="text-center" rowspan="2" style="width: 2%;">No.</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 10%;">Tgl Tindakan</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: auto;">Prosedur Non Tarif</th class="text-center">
                                                                    <!-- <th class="text-center" rowspan="2">Cetak</th class="text-center"> -->
                                                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 5%;">Jml</th class="text-center">
                                                                    <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                                    <th class="text-center" rowspan="2"></th class="text-center">
                                                                </tr>
                                                            </thead>
                                                            <tbody id="chargesBodyPerawatMandiri" class="table-group-divider">
                                                                BISMA
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--./row-->
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