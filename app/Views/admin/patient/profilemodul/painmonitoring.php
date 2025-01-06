<div class="tab-pane" id="pain" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12 mt-4">
            <div class="box-tab-tools text-center">
                <a data-toggle="modal" onclick="initialAddapain()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Dokumen</a>
            </div>
            <h3>Histori Monitoring Skala Nyeri</h3>
            <table class="table table-striped table-hover">
                <thead class="table-primary" style="text-align: center;">
                    <tr>
                        <th class="text-center" style="width: 20%;">Tanggal & Jam</th>
                        <th class="text-center" style="width: 10%;">Petugas</th>
                        <th class="text-center" style="width: 10%;">Tipe Nyeri</th>
                        <th class="text-center" style="width: 10%;">PROVING</th>
                        <th class="text-center" style="width: 10%;">QUALITY</th>
                        <th class="text-center" style="width: 10%;">REGIO</th>
                        <th class="text-center" style="width: 10%;">SCALE</th>
                        <th class="text-center" style="width: 10%;">TIMING</th>
                        <th class="text-center" colspan="2" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody id="painBody">

                </tbody>
            </table>
            <div class="d-flex mb-3">
                <a href="#" target="_blank" class="btn btn-success w-100" onclick="openPopUpTab('<?= base_url(); ?>admin/rm/keperawatan/monitoring_nyeri/<?= base64_encode(json_encode($visit)); ?>')"><i class="fa fa-print"></i> Cetak</a>
            </div>
        </div>
    </div><!--./row-->
</div>
<!-- -->

<div class="modal fade" id="painModal" role="dialog" aria-labelledby="myModalLabel">
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
                <div id="apainDocument" class="border-1 rounded-4" style="">

                </div>
            </div>
        </div>
    </div>
</div>