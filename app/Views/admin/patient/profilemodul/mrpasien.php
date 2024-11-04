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
<div class="tab-pane" id="mrpasien" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
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
                <table class="table mt-4 mb-4 table-hover table-striped">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th class="text-center" rowspan="2" style="width: 20%;">Tanggal & Jam</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Poliklinik</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 30%;">SOAP</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 30%;">Instruksi Pengobatan / Tindakan</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Petugas DPJP</th class="text-center">
                        </tr>

                    </thead>
                    <tbody id="mrBody">
                        <?php
                        $total = 0;

                        ?>


                    </tbody>

                </table>
            </div>
        </div>
    </div><!--./row-->

</div>
<!-- -->