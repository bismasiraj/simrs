<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    .pointer {
        cursor: pointer;
    }
</style>

<div class="tab-pane" id="patientOperationRequest" role="tabpanel">
    <div class="row">
        <div id="load-content-requestOperation" class="col-12 center-spinner"></div>
        <div id="contentToHide-requestOperation" class="col-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                        'visit' => $visit,
                    ]); ?>
                </div>

                <div class="col-lg-9 col-md-9 col-xs-12">
                    <div class="d-flex mt-4">
                        <button type="button" class="btn btn-primary btn-lg mx-auto" data-toggle="modal" data-target="#create-modal-operasi" id="btn-create-operasi">+ Tambah Permintaan</button>
                    </div>
                    <div class="panel-group" id="table">
                        <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">PERMINTAAN TINDAKAN OPERASI</h3>
                        <table class="table table-bordered table-hover table-centered" style="text-align: center">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Tindakan Operasi</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="bodydataRequestOperation" class="table-group-divider">

                                <tr>
                                    <td colspan="3">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card mt-4" id="container-tab">

                        <div class="card-body">
                            <h3 class="card-title text-center text-primary" id="nama-tindakan-operasi"></h3>
                            <!-- update -->

                            <div class="operasi-tab">
                                <ul class="nav nav-underline" style="border-bottom: 2px solid var(--bs-border-color);">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#catatan-keperawatan" data-bs-toggle="tab">Catatan Keperawatan Peri Operasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#checklist-keselamatan" data-bs-toggle="tab">Checklist
                                            Keselamatan Operasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#checklist-anestesi" data-bs-toggle="tab">Checklist
                                            Anestesi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#laporan-pembedahan" data-bs-toggle="tab">Checklist
                                            Pembedahan</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#informasi-post-operasi" data-bs-toggle="tab">Informasi Post Operasi</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-3">


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




                                </div>
                            </div>

                            <div class="col-12 my-3 d-flex justify-content-end gap-2">
                                <input type="hidden" name="save-operasi">
                                <button type="button" id="btn-reset-data" class="btn btn-primary">Tutup</button>
                            </div>
                        </div>
                    </div>

                    <!-- 999999999999999 -->

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Create -->
<div class="modal fade modal-xl" id="create-modal-permintaan-operasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">PERMINTAAN TINDAKAN OPERASI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDokumentPermintaanOperasi">
                    <div id="content-hide" hidden>
                    </div>
                    <div id="content-param-permintaan-operasi"></div>
                    <div id="dropdown-param-tindakan-operasi"></div>
                    <!-- <div id="template-tindakan-operasi"></div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-create-modal-permintaan-operasi">Keluar</button>
                <button type="button" class="btn btn-primary" id="btn-save-permintaan-operasi-modal">Simpan</button>
                <button type="button" class="btn btn-primary" id="btn-edit-permintaan-operasi-modal">Perbarui</button>
                <button type="button" class="btn btn-primary" id="btn-updateAndInsert-permintaan-operasi-modal" hidden>Perbarui</button>
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
                if (activeTab == '#catatan-keperawatan') {

                } else if (activeTab == '#checklist-keselamatan') {

                } else if (activeTab == '#checklist-anestesi') {

                } else if (activeTab == '#laporan-pembedahan') {

                } else {

                }
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

<?php echo view('admin/patient/profilemodul/jsprofile/patientOperationRequest_js', [
    'title' => 'Test',
    'visit' => $visit,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
]) ?>