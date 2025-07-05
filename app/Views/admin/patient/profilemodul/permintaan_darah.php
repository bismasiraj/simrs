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
</script>
<div class="tab-pane" id="permintaanDarah" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="card mb-3 mt-4">
                <div class="card-body">
                    <div class="PermintaanDarah-tabsub">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#permintaandarahtabsub"
                                    data-bs-toggle="tab">Permintaan</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">

                            <div class="tab-pane fade show active" id="permintaandarahtabsub">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="box-tab-tools text-center mb-3">
                                            <button type="button" class="btn btn-primary btn-lg"
                                                id="tambah_permintaan_request"><i class=" fa fa-plus"></i> Tambah
                                                Permintaan
                                                Darah</button>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="no_sesi_booldRequesr">Nomor Sesi</label>
                                                <div class="input-group">
                                                    <select id="no_sesi_booldRequesr" class="form-select">
                                                        <option value="%">Semua</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-4">
                                            <form action="" method="post" id="formPermintaanDarah">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <th class="text-center" scope="col">Permintaan Dokter
                                                        </th>
                                                        <th class="text-center" scope="col">Jenis Darah</th>
                                                        <th class="text-center" scope="col">Jumlah</th>
                                                        <th class="text-center" scope="col">Satuan Ukuran</th>
                                                        <th class="text-center" scope="col">Golongan Darah</th>
                                                        <th class="text-center" scope="col">Diagnosa Sementara
                                                        </th>
                                                        <th class="text-center" scope="col">Waktu Penggunaan</th>
                                                        <th class="text-center" scope="col">Transfusion Start
                                                        </th>
                                                        <th class="text-center" scope="col">Transfusion End</th>
                                                        <th class="text-center" scope="col">Reaction Desc</th>
                                                        <th class="text-center" scope="col">Action</th>
                                                    </thead>
                                                    <tbody id="tbodyPermintaanDarah">

                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-sm btn-primary ms-auto"
                                        id="btnSavePermintaanDarah">Simpan</button>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <h3>History Permintaan Darah</h3>
                                    <div class="col-12 table-responsive">
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
            </div>
            <!-- Modal -->
            <div class="modal fade" id="bloodRequestModal" tabindex="-1" aria-labelledby="bloodRequestModalLabel"
                aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bloodRequestModalLabel">Permintaan Darah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="bodybloodRequestModal">
                            <div class="container-fluid mt-5">
                                <div class="row">
                                    <div class="col-auto" align="center">
                                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                                    </div>
                                    <div class="col mt-2">
                                        <h3 class="kop-name-boold_request text-center" id="kop-name-boold_request">
                                        </h3>
                                        <p class="kop-address-boold_request text-center" id="kop-address-boold_request">
                                        </p>
                                    </div>
                                    <div class="col-auto" align="center">
                                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">

                                    </div>
                                </div>
                                <br>
                                <div
                                    style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                                </div>
                                <div class="row">
                                    <h6 class="text-center pt-2"><?= @$title; ?></h6>
                                </div>

                                <div class="row">
                                    <div class="col text-center">
                                        <h3><b><u id="content-title" class="content-title">PERMINTAAN DARAH UNTUK
                                                    TRANFUSI</u></b>
                                        </h3>
                                    </div>
                                </div>

                                <form id="form-boold_request-cover-latter">
                                    <div class="p-3 mt-3">
                                        <div class="row">
                                            <label for="sa" class="col-sm-3 col-form-label">Rumah Sakit</label>
                                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                                            <div class="col pt-2">
                                                <div id="rs-val2-booldRequest-latter" class="thename">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="sa" class="col-sm-3 col-form-label">Bagian sesuai dpjp</label>
                                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                                            <div class="col pt-2">
                                                <div id="dpjpspecial-val2-booldRequest-latter" class="thename">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="sa" class="col-sm-3 col-form-label">Dokter yang meminta</label>
                                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                                            <div class="col pt-2">
                                                <div id="fullname-val2-booldRequest-latter" class="thename">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <u class="fw-bold">
                                                    PENDERITA :
                                                </u>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 d-flex align-items-center">
                                                <label for="sa" class="col-sm-3 col-form-label">Nama</label>
                                                <label for="sa" class="col-sm-auto col-form-label">: </label>
                                                <div class="col pt-2">
                                                    <div id="diantar_oleh-val2-booldRequest-latter" class="thename">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 d-flex">
                                                <label for="sa" class="col-sm-3 col-form-label">Tgl Lahir/Umur</label>
                                                <label for="sa" class="col-sm-auto col-form-label">: </label>
                                                <div class="col d-flex  pt-2">
                                                    <div id="tgl_lahir-val2-booldRequest-latter" class="age"></div>
                                                    &nbsp;( <div id="age-val2-booldRequest-latter" class="age"></div> )
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 d-flex align-items-center">
                                                <label for="sa" class="col-sm-3 col-form-label">Alamat</label>
                                                <label for="sa" class="col-sm-auto col-form-label">: </label>
                                                <div class="col pt-2">
                                                    <div id="visitor_address-val2-booldRequest-latter"
                                                        class="theaddress">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 d-flex">
                                                <label for="sa" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                <label for="sa" class="col-sm-auto col-form-label">: </label>
                                                <div class="col pt-2">
                                                    <div id="gendername-val2-booldRequest-latter"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="sa" class="col-sm-3 col-form-label">Ruang / Kelas</label>
                                            <label for="sa" class="col-sm-auto col-form-label">: </label>
                                            <div class="col pt-2">
                                                <div id="name_of_class_room-val2-booldRequest-latter"></div>
                                                <div id="name_of_class-val2-booldRequest-latter"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <label for="sa" class="col-sm-3 col-form-label">Diagnosis Sementara</label>
                                            <label for="sa" class="col-sm-auto col-form-label">: </label>
                                            <div class="col pt-2">
                                                <div id="diagnosa_desc-val2-booldRequest-latter"></div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="sa" class="col-sm-3 col-form-label">Diperlukan tanggal</label>
                                            <label for="sa" class="col-sm-auto col-form-label">: </label>
                                            <div class="col pt-2">
                                                <div id="using_time-val2-booldRequest-latter"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="sa" class="col-sm-3 col-form-label">HB</label>
                                            <label for="sa" class="col-sm-auto col-form-label">: </label>
                                            <div class="col pt-2">
                                                <div id="hb_last-val2-booldRequest-latter"></div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <label for="sa" class="col-sm-3 col-form-label text-end">Jenis darah yang
                                                diperlukan</label>
                                            <label for="sa" class="col-auto col-form-label">:</label>
                                            <div class="col-sm-3">
                                                <label id="databooldtype-val2-lab-latter"></label>
                                            </div>

                                            <label for="diagnosa_desc-lab-val-lab-latter"
                                                class="col-sm-2 col-form-label text-end pe-0">Sejumlah</label>
                                            <label for="diagnosa_desc-lab-val-lab-latter"
                                                class="col-auto col-form-label px-1">:</label>
                                            <!-- <div class="col-sm-1 text-center"> -->
                                            <label id="jmlh-val2-booldRequest-latter"
                                                class="theaddress col-auto col-form-label px-1"></label>
                                            <!-- <div id="jmlh-val2-booldRequest-latter" class="theaddress "></div> -->
                                            <!-- </div> -->
                                            <!-- <label for="measure_id-val2-booldRequest-latter"
                                                class="col-auto col-form-label ps-1">cc / kantong</label> -->
                                        </div>




                                    </div>
                                </form>

                                <div class="row mb-2 hidden-show-ttd" hidden>
                                    <div class="col-3" align="center">
                                        <br>
                                        <br><br>
                                        <i class="hidden-show-ttd" hidden>Dicetak pada tanggal
                                            <?= tanggal_indo(date('Y-m-d')); ?></i>

                                    </div>
                                    <div class="col"></div>
                                    <div class="col-3" align="center">
                                        <div>
                                            <div id="datetime-now" class="datetime-now"></div><br>
                                            Dokter
                                        </div>
                                        <div>
                                            <div class="pt-2 pb-2" id="qrcode-darah-conver-dokter">
                                            </div>
                                        </div>
                                        <div id="validator-darah-ttd"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-warning"
                                id="cetak_boldReq_modal">Cetak</button>

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!--./row-->



</div>