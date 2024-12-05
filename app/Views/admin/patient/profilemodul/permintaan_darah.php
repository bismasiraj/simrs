<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();

$db = db_connect();

?>

<style>
    .quill-textarea-patologi>.ql-toolbar:first-child {
        display: none !important;
    }
</style>
<script>
    console.log("permintaan darah masuk")
</script>
<div class="tab-pane" id="permintaanDarah" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">
            <div class="card mb-3 mt-4">
                <div class="card-body">
                    <div class="PermintaanDarah-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active">Permintaan</a>
                            </li>
                        </ul>

                        <div class="row">
                            <div class="col-12">
                                <div class="box-tab-tools text-center mb-3">
                                    <button type="button" class="btn btn-primary btn-lg" id="tambah_permintaan_request" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Permintaan Darah</button>
                                </div>
                                <form action="" method="post" id="formPermintaanDarah">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th class="text-center" style="width: 12%">Jenis Darah</th>
                                            <th class="text-center" style="width: 5%">Jumlah</th>
                                            <th class="text-center" style="width: 10%">Satuan Ukuran</th>
                                            <th class="text-center" style="width: 9%">Golongan Darah</th>
                                            <th class="text-center" style="width: 23%">Diagnosa Sementara</th>
                                            <th class="text-center" style="width: 10%">Waktu Penggunaan</th>
                                            <th class="text-center" style="width: 10%">Transfusion Start</th>
                                            <th class="text-center" style="width: 10%">Transfusion End</th>
                                            <th class="text-center" style="width: 10%">Reaction Desc</th>
                                            <th class="text-center" style="width: 1%"><i class="fa fa-trash"></i></th>
                                        </thead>
                                        <tbody id="tbodyPermintaanDarah">

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-primary ms-auto" id="btnSavePermintaanDarah">Simpan</button>
                        </div>
                        <hr>
                        <div class="row mt-3">
                            <h3>History Permintaan Darah</h3>
                            <div class="col-12">
                                <table class="table table-bordered" id="tableHistoryBlood">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>No.</th>
                                            <th>Jenis Darah</th>
                                            <th>Golongan Darah</th>
                                            <th>Jumlah</th>
                                            <th>Ukuran</th>
                                            <th>Tanggal Permintaan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyPermintaanDarahHistory"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--./row-->



</div>