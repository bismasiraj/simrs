<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
.pointer {
    cursor: pointer;
}

.quill>.ql-toolbar:first-child {
    display: none !important;
}
</style>

<div class="tab-pane" id="patientOperationRequest" role="tabpanel">
    <div class="row">
        <div id="load-content-requestOperation" class="col-12 center-spinner"></div>
        <div id="contentToHide-requestOperation" class="col-12">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                        'visit' => $visit,
                    ]); ?>
                </div>

                <div class="col-lg-10 col-md-12 col-xs-12">
                    <?php if (user()->checkPermission("pasienoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                    <div class="row mt-3 ">
                        <div class="col-md-12">
                            <div class="box-tab-tools text-center spppoli-to-hide">
                                <a data-toggle="modal" data-target="#create-modal-operasi"
                                    class="btn btn-primary btn-lg spppoli-to-hide" id="btn-create-operasi"
                                    style="width: 300px"><i class=" fa fa-plus"></i> Tambah Permintaan</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="panel-group" id="table">
                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">PERMINTAAN TINDAKAN OPERASI</h3>
                        <table class="table table-bordered table-hover table-centered" style="text-align: center">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="w-auto text-nowrap">No</th>
                                    <th scope="col" class="w-auto text-nowrap">Tanggal</th>
                                    <th scope="col" class="w-auto text-nowrap">Tindakan Operasi</th>
                                    <th scope="col" class="w-auto text-nowrap">Tarif</th>
                                    <th scope="col" class="w-auto text-nowrap">Dokter</th>
                                    <th scope="col" class="w-auto text-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody id="bodydataRequestOperation" class="table-group-divider">

                                <tr>
                                    <td colspan="3">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if (user()->checkPermission("assesmenoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'r') || user()->checkRoles(['superuser'])) { ?>

                    <div class="card mt-4" id="container-tab">
                        <div id="load-content-requestOperation-tab" class="col-12 center-spinner"></div>
                        <div id="contentToHide-requestOperation-tab" class="card-body">
                            <h3 class="card-title text-center text-primary" id="nama-tindakan-operasi"></h3>
                            <!-- update -->

                            <div class="operasi-tab">
                                <ul class="nav nav-underline" style="border-bottom: 2px solid var(--bs-border-color);">
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs " aria-current="page" href="#pra-operasi"
                                            data-bs-toggle="tab">Asesmen Pra Operasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" aria-current="page"
                                            href="#catatan-keperawatan" data-bs-toggle="tab">Catatan Keperawatan Peri
                                            Operasi</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" href="#checklist-keselamatan"
                                            data-bs-toggle="tab">Checklist
                                            Keselamatan Operasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" href="#checklist-anestesi"
                                            data-bs-toggle="tab">Checklist
                                            Anestesi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" href="#laporan-pembedahan"
                                            data-bs-toggle="tab">Laporan
                                            Pembedahan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" href="#laporan-anesthesi"
                                            data-bs-toggle="tab">Asesmen Pra
                                            Anestesi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" href="#anesthesi-lengkap"
                                            data-bs-toggle="tab">Catatan
                                            Anestesi dan Sedasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link nav-link-oprs" href="#informasi-post-operasi"
                                            data-bs-toggle="tab">Instruksi Post Operasi</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-3">


                                    <!-- catatan -->
                                    <?php echo view('admin/patient/profilemodul/operasi/praoperasi.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>

                                    <!-- catatan -->
                                    <?php echo view('admin/patient/profilemodul/operasi/catatan-keperawatan.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>

                                    <!-- keselamatan -->
                                    <?php echo view('admin/patient/profilemodul/operasi/checklist-keselamatan.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>


                                    <!-- anestesi -->
                                    <?php echo view('admin/patient/profilemodul/operasi/checklist-anestesi.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>

                                    <!-- pembedahan -->
                                    <?php echo view('admin/patient/profilemodul/operasi/laporan-pembedahan.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>

                                    <!-- post operasi -->
                                    <?php echo view('admin/patient/profilemodul/operasi/informasi-post-operasi.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>


                                    <?php echo view('admin/patient/profilemodul/operasi/laporan-anesthesi.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>
                                    <?php echo view('admin/patient/profilemodul/operasi/anesthesi-lengkap.php', [
                                            'title' => 'Test',
                                            'visit' => $visit,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                        ]) ?>


                                </div>
                            </div>

                            <div class="col-12 my-3 d-flex justify-content-end gap-2">
                                <input type="hidden" name="save-operasi">
                                <button type="button" id="btn-reset-data" class="btn btn-primary">Tutup</button>
                            </div>
                        </div>
                    </div>

                    <!-- 999999999999999 -->
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="create-modal-permintaan-operasi" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">PERMINTAAN TINDAKAN OPERASI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body" style="height: 75vh; overflow-y: auto;">
                <form id="formDokumentPermintaanOperasi">
                    <div id="content-hide" hidden>
                    </div>
                    <div id="content-param-permintaan-operasi"></div>
                    <div id="dropdown-param-tindakan-operasi"></div>
                    <!-- <div id="template-tindakan-operasi"></div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-warning" id="cetak-oprs-permintaan">Cetak
                    Permintaan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    id="close-create-modal-permintaan-operasi">Keluar</button>
                <?php if (user()->checkPermission("pasienoperasi", 'c') || user()->checkPermission("assesmenoperasi", 'c') || user()->checkRoles(['superuser'])) { ?>

                <button type="button" class="btn btn-primary spppoli-to-hide"
                    id="btn-save-permintaan-operasi-modal">Simpan</button>
                <button type="button" class="btn btn-primary spppoli-to-hide"
                    id="btn-edit-permintaan-operasi-modal">Perbarui</button>
                <button type="button" class="btn btn-primary spppoli-to-hide"
                    id="btn-updateAndInsert-permintaan-operasi-modal" hidden>Perbarui</button>

                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="notif-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-notif"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="content-notif">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-notif">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- <div class="modal fade" tabindex="-1" id="modal-suratpengantarOprs" data-bs-backdrop="static"> -->

<!-- <div class="modal-dialog modal-fullscreen" role="document"> -->
<div class="card border-1 rounded-4 m-4 p-4" id="coverkopSuratPengantaroprs" style="display: none;">

    <div class="card-body">
        <div class="modal-body pt0 pb0">
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/logo.png" width="70px">
                    </div>
                    <div class="col mt-2">
                        <h3 class="kop-name-oprs text-center" id="kop-name-oprs">
                        </h3>
                        <p class="kop-address-oprs text-center" id="kop-address-oprs">
                        </p>
                    </div>
                    <div class="col-auto" align="center">
                        <img class="mt-2" src="<?= base_url() ?>assets/img/paripurna.png" width="100px">

                    </div>
                </div>
                <br>
                <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;">
                </div>
                <div class="row">
                    <h6 class="text-center pt-2"><?= @$title; ?></h6>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <h3><b><u id="content-title" class="content-title">PERMOHONAN OPERASI</u></b>
                        </h3>
                    </div>
                </div>

                <form id="form-oprs-cover-latter">

                    <div class="p-3 mt-3">
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Tanggal</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="tgl-val2-oprs-latter"></div>


                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Nama
                                pasien</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="diantar_oleh-val2-oprs-latter" class="thename">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">No.Register</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="no_registration-val2-oprs-latter"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 d-flex align-items-center">
                                <label for="sa" class="col-sm-4 col-form-label">TTL / Umur</label>
                                <label for="sa" class="col-sm-auto col-form-label">:</label>
                                <div class="col d-flex align-items-center gap-1">
                                    <span id="tgl_lahir-val2-oprs-latter"></span> / <span
                                        id="age-val2-oprs-latter"></span>
                                </div>
                            </div>

                            <div class="col-sm-4 d-flex">
                                <label for="sa" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                <label for="sa" class="col-sm-auto col-form-label">:</label>
                                <div class="col pt-2">
                                    <div id="gendername-val2-oprs-latter"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="sa" class="col-sm-3 col-form-label">Alamat/Ruang</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="contact_address-val2-oprs-latter" class="theaddress">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="sa" class="col-sm-3 col-form-label">Pemeriksaan yang diminta</label>
                            <label for="sa" class="col-sm-auto col-form-label">:</label>
                            <div class="col pt-2">
                                <div id="desc_tarif-val2-oprs-latter"></div>

                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                Keterangan klinis / Diagnosa : <br>
                                <div class="col pt-2">
                                    <div id="diagnosa_desc-val2-oprs-latter"></div>
                                </div>
                                <!-- <span id="hasil-tindakan-val2-coverfisio"></span> -->

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                Advice Dokter : <br>
                                <div class="col pt-2">
                                    <div id="advice_doctor-val2-oprs-latter"></div>
                                </div>
                                <!-- <span id="hasil-tindakan-val2-coverfisio"></span> -->

                            </div>
                        </div>

                    </div>
                </form>

                <div class="row mb-2 hidden-show-ttd" id="oprs-ttd-result">
                    <div class="col-3" align="center">
                        <br>
                        <br><br>
                        <i class="hidden-show-ttd">Dicetak pada tanggal, <div id="tgl_date_oprs_cover"></div></i>

                    </div>
                    <div class="col"></div>
                    <div class="col-3" align="center">
                        <div>
                            <div id="datetime-now" class="datetime-now"></div><br>
                            Dokter
                        </div>
                        <div>
                            <div class="pt-2 pb-2" id="qrcode-oprs-conver-dokter">
                            </div>
                        </div>
                        <div id="validator-ttd-oprs-conver-dokter"></div>
                    </div>
                </div>

            </div>
            <span id="avttotal_score_oprs"></span>
        </div>

    </div>
</div>

<!-- </div>
</div> -->

<!-- modal oprasi  -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tabs
    var tabTriggerList = document.querySelectorAll('.nav-link');
    var activeTab = '';
    tabTriggerList.forEach(function(tabTrigger) {
        new bootstrap.Tab(tabTrigger);
        // Add event listener to each tab trigger
        tabTrigger.addEventListener('shown.bs.tab', function(event) {
            activeTab = event.target.getAttribute('href'); // Get the href attribute

            // You can perform further actions based on the active tab here
        });
    });

    // Initialize Bootstrap accordion
    var accordionList = document.querySelectorAll('.accordion');
    accordionList.forEach(function(accordion) {
        new bootstrap.Collapse(accordion, {
            toggle: false // Optional, to prevent all accordions from closing when opening a new one
        });
    });




});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>