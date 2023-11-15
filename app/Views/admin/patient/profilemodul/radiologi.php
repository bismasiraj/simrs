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
<div class="tab-pane" id="rad" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="table-responsive mt-4 mb-4">
                <table class="table table-striped table-hover">
                    <thead class="table-primary" style="text-align: center;">
                        <tr>
                            <th class="text-center" rowspan="2" style="width: 10%;">Kode</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 30%;">Nama Tindakan</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Tanggal</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: 10%;">Dokter Pemeriksa</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: auto;">Nota</th class="text-center">
                            <th class="text-center" rowspan="2" style="width: auto;"></th class="text-center">
                        </tr>

                    </thead>
                    <tbody id="radBody">
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