<?php
$currency_symbol = "Rp. ";
$permissions = user()->getPermissions();

$db = db_connect();
$employee_id = user()->employee_id;

$result =
    $db->query(
        "
            SELECT EMPLOYEE_ID,FULLNAME 
            from EMPLOYEE_ALL  
            WHERE employee_id in (select employee_id from doctor_schedule where clinic_id = 'P001')
            Order by fullname;
        "
    )->getRowArray() ?? [];

$result = array_change_key_case($result);

?>

<style>
    .quill-textarea-penunjang>.ql-toolbar:first-child {
        display: none !important;
    }

    /* #ModalBodyPenunjangMedis::-webkit-scrollbar {
        width: 8px;
    } */

    /* Width */
    #ModalBodyPenunjangMedis::-webkit-scrollbar {
        width: 8px;
    }

    #ModalBodyPenunjangMedis::-webkit-scrollbar {
        border-radius: 6px;
    }

    /* Track */
    #ModalBodyPenunjangMedis::-webkit-scrollbar-track {
        background: #efefef;
    }

    /* Handle */
    #ModalBodyPenunjangMedis::-webkit-scrollbar-thumb {
        background: #7a6fbe;
    }

    /* Handle on hover */
    #ModalBodyPenunjangMedis::-webkit-scrollbar-thumb:hover {
        background: #685ea2;
    }
</style>
<div class="tab-pane" id="penunjangMedis" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div><!--./col-lg-6-->
        <div class="col-lg-10 col-md-10 col-sm-12">

            <div class="accordion mt-4">
                <div class="panel-group" id="penunjangBody">
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="operasi-tab">
                        <ul class="nav nav-underline mb-3" style="border-bottom: 2px solid var(--bs-border-color);">
                            <li class="nav-item text-center flex-fill">
                                <a class="nav-link active" href="#transaksi-penunjangMedis-tab" data-bs-toggle="tab">Transaksi</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">

                            <div class="tab-pane fade show active" id="transaksi-penunjangMedis-tab">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mt-4 mb-4">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-primary" style="text-align: center;">
                                                <tr>
                                                    <th class="text-center" style="width: 10%;">Tanggal</th class="text-center">
                                                    <th class="text-center" style="width: 10%;">Kode</th class="text-center">
                                                    <th class="text-center" style="width: auto;">Nama Tindakan</th class="text-center">
                                                    <th class="text-center" style="width: 1%;">Hasil</th class="text-center">
                                                </tr>
                                            </thead>
                                            <tbody id="penunjangMedisBody">
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <form id="formSearchingTarifPenunjangMedis" action="" method="post" class="">
                                    <div class="box-body row mt-4">
                                        <input type="hidden" name="ci_csrf_token" value="">

                                        <div class="col-sm-12 col-md-12 mb-4">

                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Nomor Sesi</label>
                                                        <select id="notaNoPenunjangMedis" class="form-select" style="width: 100%">
                                                            <option value="%">Semua</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="">Pencarian Tarif</label>
                                                        <div class="input-group">
                                                            <select id="searchTarifPenunjangMedis" class="form-control fit" style="width: 70%; height: 100%;"></select>
                                                            <button type="button" class="btn btn-primary btn-sm addcharges align-items-end" onclick='addBillPenunjangMedis("searchTarifPenunjangMedis")'>
                                                                <i class="fa fa-plus"></i> Tambah
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0">
                                        <table class="table table-sm table-hover">
                                            <thead class="table-primary" style="text-align: center;">
                                                <tr>
                                                    <th class="text-center" rowspan="2" style="width: 5%;">No.</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Jenis Tindakan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Dokter</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 20%;">Tgl Tindakan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Nilai</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Jml</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 10%;">Total Tagihan</th class="text-center">
                                                    <th class="text-center" rowspan="2" style="width: 5%"></th class="text-center">
                                                </tr>
                                            </thead>
                                            <tbody id="penunjangChargesBody" class="table-group-divider">
                                            </tbody>
                                        </table>
                                        <div class="panel-footer text-end mb-4">
                                            <button type="button" id="formSaveBillPenunjangBtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <span>Simpan</span></button>
                                            <!-- <button type="button" id="formEditBillRadBtn" name="editrm" onclick="editRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-secondary pull-right"><i class="fa fa-edit"></i> <span>Edit</span></button> -->
                                            <button type="button" id="formsign" name="signrm" onclick="signRM()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-warning pull-right"><i class="fa fa-signature"></i> <span>Sign</span></button>
                                            <!-- <button type="button" id="postingSS" name="editrm" onclick="saveBundleEncounterSS()" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-edit"></i> <span>Satu Sehat</span></button> -->
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
<!-- Modal -->
<div class="modal fade modal-xl" id="modalPenunjangMedis" aria-labelledby="modalPenunjangMedisLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalPenunjangMedisLabel">Hasil Penunjang Medis</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="ModalBodyPenunjangMedis" style="height: 75vh; overflow-y: auto;">
                <form action="" id="formModalPenunjang" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="name_of_pasien" value="<?= $visit['diantar_oleh']; ?>">
                    <input type="hidden" name="age" value="<?= $visit['age']; ?>">
                    <input type="hidden" name="contact_address" value="<?= $visit['visitor_address']; ?>">
                    <input type="hidden" name="gendername" value="<?= $visit['gendername']; ?>">
                    <input type="hidden" name="no_registration" value="<?= $visit['no_registration']; ?>">
                    <input type="hidden" name="tarif_id" id="penunjang_medis_tarif_id">
                    <input type="hidden" name="bill_id" id="penunjang_medis_bill_id">
                    <input type="hidden" name="visit_id" id="penunjang_medis_visit_id">
                    <div class="row">
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="70px">
                        </div>
                        <div class="col mt-2">
                            <h3 class="kop-name" id="kop-name">
                            </h3>
                            <p class="kop-address" id="kop-address">
                        </div>
                        <div class="col-auto" align="center">
                            <img class="mt-2" src="<?= base_url('assets/img/kemenkes.png') ?>" width="70px">
                            <img class="mt-2" src="<?= base_url('assets/img/kars-bintang.png') ?>" width="70px">
                        </div>
                    </div>
                    <br>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <h3 class="text-center mb-0 my-1">HASIL PEMERIKSAAN</h3>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;"></div>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="20%">Nama</td>
                            <td width="1%">:</td>
                            <td colspan="2"><?= $visit['diantar_oleh']; ?></td>
                            <td width="20%">No.RM</td>
                            <td width="1%">:</td>
                            <td><?= $visit['no_registration']; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Umur</td>
                            <td width="1%">:</td>
                            <td><?= $visit['age']; ?></td>
                            <td>LP: <?= $visit['gendername']; ?></td>
                            <td width="20%">Tanggal</td>
                            <td width="1%">:</td>
                            <td><?= date('d-m-Y') ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Alamat</td>
                            <td width="1%">:</td>
                            <td colspan="2"><?= $visit['visitor_address']; ?></td>
                            <td width="20%">Dokter</td>
                            <td width="1%">:</td>
                            <td><?= $visit['fullname_from']; ?></td>
                        </tr>
                    </table>
                    <div style="border-bottom: .5px solid #000; border-top: .5px solid #000;padding-bottom: 2px;" class="mb-2"></div>
                    <div id="ContainerbodyBound" class="row">

                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload File Pendukung (optional)</label>
                            <input class="form-control" type="file" id="formFile" name="file" accept=".pdf, .jpg, .jpeg, .png, .webp">
                        </div>
                        <div class="mb-2">
                            <img id="imagePreviewPenunjangMedis" src="#" alt="Image Preview" style="display: none; width: 100%; height: auto;" />
                            <embed id="pdfPreviewPenunjangMedis" type="application/pdf" style="display: none; width: 100%; height: 500px;" />
                            <p id="fileName" style="display: none;"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="printPenunjangMedis" type="button" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
                <button id="savePenunjangMedis" type="button" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>