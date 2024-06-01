<?php

$this->extend('layout/nosidelayout', [
    'orgunit' => $orgunit,
    'img_time' => $img_time
]) ?>

<?php
$permissions = user()->getPermissions();
$group = user()->getRoles();
$pasienDiagnosa = array();
$pasienDiagnosaAll = array();
foreach ($pd as $key => $value) {
    if ($pd[$key]['visit_id'] == $visit['visit_id'] && $key == 0) {
        $pasienDiagnosa = $pd[$key];
    } else {
        $pasienDiagnosaAll[] = $pd[$key];
    }
}
// dd($pasienDiagnosaAll);
?>


<?php $this->section('content') ?>
<?php
$currency_symbol = 'Rp. ';
?>
<script src="<?php echo base_url('/') ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url('/') ?>backend/js/utils.js"></script>
<style>
    .table-biodata-header {
        text-align: center;
    }

    .table-biodata {}

    input[type=radio] {
        transform: scale(1.3);
    }

    .nav-tabs-custom .nav-item .nav-link {
        border: none;
        font-weight: bold;
        font-size: 15px;
        min-width: 120px;
        height: 100%;
    }
</style>
<div class="content-wrapper">
    <section>
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card border border-1 rounded-4">
                            <div class="card-body">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        <li class="nav-item"><a id="overviewTab" class="nav-link border-bottom" href="#overview" data-bs-toggle="tab" aria-expanded="true" role="tab">Profil</a></li>
                                        <!-- <li class="nav-item"><a id="overviewTab" class="nav-link" href="#overview" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fa fa-th text-primary"></i> Profil</a></li> -->
                                        <?php if (isset($permissions['assessmentmedis']['r'])) { ?>
                                            <li class="nav-item"><a id="assessmentmedisTab" class="nav-link border-bottom <?= isset($group[11]) || isset($group[1]) ? 'active' : '' ?>" href="#assessmentmedis" data-bs-toggle="tab" aria-expanded="true" role="tab">Assessment Medis</a></li>
                                            <!-- <li class="nav-item"><a id="assessmentmedisTab" class="nav-link border-bottom <?= isset($group[11]) ? 'active' : '' ?>" href="#assessmentmedis" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fa fa-user-md text-primary"></i> Assessment Medis</a></li> -->
                                            <li class="nav-item"><a id="assessmentigdTab" class="nav-link border-bottom <?= isset($group[13]) ? 'active' : '' ?>" href="#assessmentigd" data-bs-toggle="tab" aria-expanded="true" role="tab">Assessment Perawat</a></li>
                                        <?php }
                                        if (isset($permissions['assessmentperawat']['r'])) { ?>
                                            <!-- <li class="nav-item"><a id="assessmentigdTab" class="nav-link border-bottom <?= isset($group[13]) ? 'active' : '' ?>" href="#assessmentigd" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fa fa-user-md text-primary"></i> Assessment Perawat</a></li> -->
                                        <?php }
                                        if (isset($permissions['cppt']['r'])) { ?>
                                            <li class="nav-item"><a id="cpptTab" class="nav-link border-bottom" href="#cppt" data-bs-toggle="tab" aria-expanded="true" role="tab"> CPPT</a></li>
                                            <!-- <li class="nav-item"><a id="cpptTab" class="nav-link border-bottom" href="#assessmentigd" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fa fa-user-md text-primary"></i> CPPT</a></li> -->
                                        <?php }
                                        if (isset($permissions['eresep']['r'])) { ?>
                                            <li class="nav-item"><a id="eresepTab" class="nav-link border-bottom" href="#eresep" data-bs-toggle="tab" aria-expanded="true" role="tab">EResep</a></li>
                                            <!-- <li class="nav-item"><a id="eresepTab" class="nav-link border-bottom" href="#eresep" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fas fa-prescription text-primary"></i> E-Resep</a></li> -->
                                        <?php }
                                        if (isset($permissions['lab']['r'])) { ?>
                                            <li class="nav-item"><a id="labTab" class="nav-link border-bottom" href="#lab" data-bs-toggle="tab" aria-expanded="true" role="tab">Laboratorium</a></li>
                                            <!-- <li class="nav-item"><a id="labTab" class="nav-link border-bottom" href="#lab" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fas fa-microscope text-primary"></i>Laboratorium</a></li> -->
                                        <?php }
                                        if (isset($permissions['rad']['r'])) { ?>
                                            <li class="nav-item"><a id="radTab" class="nav-link border-bottom" href="#rad" data-bs-toggle="tab" aria-expanded="true" role="tab">Radiologi</a></li>
                                            <!-- <li class="nav-item"><a id="radTab" class="nav-link border-bottom" href="#rad" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fas fa-x-ray text-primary"></i> Radiologi</a></li> -->
                                        <?php }
                                        if (isset($permissions['resumemedis']['r'])) { ?>
                                            <li class="nav-item"><a id="rekammedisTab" class="nav-link border-bottom" href="#assessmentmedis" data-bs-toggle="tab" aria-expanded="true" role="tab">Resume Medis</a></li>
                                            <!-- <li class="nav-item"><a id="rekammedisTab" class="nav-link border-bottom" href="#assessmentmedis" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fas fa-hospital-alt text-primary"></i> Resume Medis</a></li> -->
                                        <?php }
                                        if ($visit['isrj'] == '0') { ?>
                                            <!-- <li class="nav-item"><a id="cpptTab" class="nav-link border-bottom" href="#cppt" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fa fa-book text-primary"></i> CPPT</a></li> -->
                                        <?php } else { ?>
                                            <!-- <li class="nav-item"><a is="vitalsignTab" class="nav-link border-bottom" href="#vitalsign" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fa fa-user-md text-primary"></i> Vital Sign</a></li> -->
                                        <?php } ?>
                                        <li class="nav-item"><a id="tindakanTab" class="nav-link border-bottom" href="#billpoli" data-bs-toggle="tab" aria-expanded="true" role="tab">Tindakan</a></li>
                                        <!-- <li class="nav-item"><a id="tindakanTab" class="nav-link border-bottom" href="#charges" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="far fa-caret-square-down text-primary"></i> Tindakan</a></li> -->
                                        <li class="nav-item"><a id="chargesTab" class="nav-link border-bottom" href="#charges" data-bs-toggle="tab" aria-expanded="true" role="tab">Billing</a></li>
                                        <!-- <li class="nav-item"><a id="chargesTab" class="nav-link border-bottom" href="#charges" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="far fa-caret-square-down text-primary"></i> Billing</a></li> -->
                                        <!-- <li class="nav-item"><a id="mrpasienTab" class="nav-link border-bottom" href="#mrpasien" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fas fa-file text-primary"></i> MR Pasien</a></li> -->
                                        <li class="nav-item"><a id="rmTab" class="nav-link border-bottom" href="#rm" data-bs-toggle="tab" aria-expanded="true" role="tab">Form RM</a></li>
                                        <!-- <li class="nav-item"><a id="rmTab" class="nav-link border-bottom" href="#rm" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="fas fa-hospital-alt text-primary"></i> Form RM</a></li> -->
                                        <li class="nav-item"><a id="painTab" class="nav-link border-bottom" href="#pain" data-bs-toggle="tab" aria-expanded="true" role="tab">Monitoring Nyeri</a></li>
                                        <li class="nav-item"><a id="fallTab" class="nav-link border-bottom" href="#fall" data-bs-toggle="tab" aria-expanded="true" role="tab">Fall Risk</a></li>
                                        <li class="nav-item"><a id="gcsTab" class="nav-link border-bottom" href="#gcs" data-bs-toggle="tab" aria-expanded="true" role="tab">GCS</a></li>
                                        <li class="nav-item"><a id="" class="nav-link border-bottom" href="#" data-bs-toggle="tab" aria-expanded="true" role="tab">Medical Item</a></li>
                                        <li class="nav-item"><a id="" class="nav-link border-bottom" href="#" data-bs-toggle="tab" aria-expanded="true" role="tab">Diagnosa Perawat</a></li>
                                        <li class="nav-item"><a id="" class="nav-link border-bottom" href="#" data-bs-toggle="tab" aria-expanded="true" role="tab">Order Gizi</a></li>
                                        <li class="nav-item"><a id="" class="nav-link border-bottom" href="#" data-bs-toggle="tab" aria-expanded="true" role="tab">Vital Sign</a></li>
                                        <li class="nav-item"><a id="" class="nav-link border-bottom" href="#" data-bs-toggle="tab" aria-expanded="true" role="tab">Inform Consern</a></li>
                                        <!-- <li class="nav-item"><a id="klaimTab" class="nav-link" href="#klaim" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="far fa-id-card text-primary"></i> E-Klaim</a></li> -->
                                        <!-- <li class="nav-item"><a class="nav-link" href="#coba" data-bs-toggle="tab" aria-expanded="true" role="tab"><i class="far fa-id-card text-primary"></i> coba</a></li> -->
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane tab-content-height" id="overview">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-12 border-r">
                                                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                                                        'visit' => $visit,
                                                        'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                                        'pasienDiagnosa' => $pasienDiagnosa
                                                    ]); ?>
                                                </div><!--./col-lg-6-->
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="mt-4">
                                                        <?php
                                                        if (!empty($pasienDiagnosa)) {
                                                            // if (false) {
                                                        ?>
                                                            <hr class="hr-panel-heading hr-10">

                                                        <?php
                                                        } else { ?>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Ringkasan Diagnosis:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmdescription"></div>
                                                                </li>
                                                                <li>
                                                                    <div class="rmdiagnosa_desc_05"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Riwayat Alergi:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmdiagnosa_desc_06"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmanamnase"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Periksa Fisik:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmpemeriksaan"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmpemeriksaan_02"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmpemeriksaan_03"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Pemeriksaan Lain:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmpemeriksaan_05"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmteraphy_desc"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Instruksi:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rminstruction"></div>
                                                                </li>
                                                            </ul>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-sm-12">

                                                    <div class="mb-4">
                                                        <div class="box-header border-b mt-4">
                                                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Diagnosa ICD X</h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="staff-members">
                                                                    <div class="table tablecustom-responsive">
                                                                        <table class="table tablecustom table-borderedcustom table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) ?>">
                                                                            <?php if (true) { ?>
                                                                                <thead>
                                                                                    <th>No</th>
                                                                                    <th>Diagnosa ICD X</th>
                                                                                    <th>Jenis Kasus</th>
                                                                                    <th>Jenis Kasus</th>
                                                                                    <th>Kategori Diagnosis</th>
                                                                                </thead>
                                                                                <tbody id="bodyDiagShow">
                                                                                </tbody>
                                                                            <?php }   ?>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="box-header mt-4">
                                                            <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14">Riwayat Pemeriksaan Fisik</h3>
                                                            <?php if (isset($permissions['profilexam']['c'])) {
                                                                if ($permissions['profilexam']['c'] == '1' && false) { ?>
                                                                    <div class="box-tools">
                                                                        <a data-toggle="modal" id="add" onclick="holdModal('addExamModal')" class="btn btn-primary btn-sm addpatient"><i class="fa fa-plus"></i> Tambah Pemeriksaan Fisik</a>
                                                                    </div>
                                                            <?php }
                                                            } ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <div class="box box-info">
                                                                    <div class="box-body">
                                                                        <div class="chart">
                                                                            <canvas id="medical-history-chart" height="300"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!--./col-lg-7-->
                                                        </div>
                                                        <div class="">
                                                            <div class="">
                                                                <div class="box-header mb10 pl-0">
                                                                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"></h3>
                                                                    <div class="pull-right">
                                                                        <div class="editviewdelete-icon pt8">
                                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="add-edit-members"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="staff-members">
                                                                    <div class="table table-responsive">
                                                                        <table class="table table-hover " data-export-title="<?php echo ($visit['diantar_oleh'] . $visit['no_registration']) . " - " . $visit['visit_id'] . lang('Word.opd_details'); ?>">
                                                                            <?php if (true) { ?>
                                                                                <thead class="table-primary">
                                                                                    <th>Tanggal</th>
                                                                                    <th>Berat</th>
                                                                                    <th>Suhu</th>
                                                                                    <th>Tinggi</th>
                                                                                    <th>Nadi</th>
                                                                                    <th>Tension</th>
                                                                                    <th>Saturasi</th>
                                                                                    <th>Nafas</th>
                                                                                    <th></th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $i = 0;
                                                                                    foreach ($exam as $key => $value) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?= substr($exam[$key]['examination_date'], 0, 13); ?></td>
                                                                                            <td><?= $exam[$key]['weight']; ?></td>
                                                                                            <td><?= $exam[$key]['temperature']; ?></td>
                                                                                            <td><?= $exam[$key]['height']; ?></td>
                                                                                            <td><?= $exam[$key]['nadi']; ?></td>
                                                                                            <td><?= $exam[$key]['tension_upper'] . ' / ' . $exam[$key]['tension_below']; ?></td>
                                                                                            <td><?= $exam[$key]['saturasi']; ?></td>
                                                                                            <td><?= $exam[$key]['nafas']; ?></td>
                                                                                            <?php if (isset($permissions['profilexam']['u'])) {
                                                                                                if ($permissions['profilexam']['u'] == '1') { ?>
                                                                                                    <td><a href='#' onclick='editExamFunc(<?= $key; ?>)' class='btn btn-default btn-xs pull-right' data-toggle='modal' title=''><i class='fa fa-edit'></i></a></td>
                                                                                            <?php }
                                                                                            } ?>
                                                                                        </tr>
                                                                                    <?php
                                                                                    }  ?>
                                                                                </tbody>
                                                                            <?php }   ?>
                                                                        </table>
                                                                    </div>
                                                                </div><!--./staff-members-->
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <div class="">
                                                                <div class=" box-header mb10 pl-0">
                                                                    <h3 class="text-uppercase bolds mt0 ptt10 pull-left font14"></h3>
                                                                    <div class="pull-right">
                                                                        <div class="editviewdelete-icon pt8">
                                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="add-edit-members"></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--./row-->
                                        </div><!--#/overview-->
                                        <?php echo view('admin/patient/profilemodul/charges', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/mrpasien', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/radiologi', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/lab', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/billpoli', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/prescription', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/rekammedis', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa,
                                            'clinic' => $clinic,
                                            'dokter' => $employee
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/formrm', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa,
                                            'clinic' => $clinic,
                                            'dokter' => $employee
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/cppt', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/painmonitoring', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/fallrisk', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/gcs', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/assessmentmedis', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                            'mappingAssessment' => $mappingAssessment
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/assessmentigd', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa,
                                            'aParent' => $aParent,
                                            'aType' => $aType,
                                            'aParameter' => $aParameter,
                                            'aValue' => $aValue,
                                            'mappingAssessment' => $mappingAssessment
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/vitalsign', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/eklaim', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                        <?php echo view('admin/patient/profilemodul/coba', [
                                            'title' => '',
                                            'orgunit' => $orgunit,
                                            'statusPasien' => $statusPasien,
                                            'reason' => $reason,
                                            'isattended' => $isattended,
                                            'inasisPoli' => $inasisPoli,
                                            'inasisFaskes' => $inasisFaskes,
                                            'visit' => $visit,
                                            'exam' => $exam,
                                            'pd' => $pasienDiagnosa,
                                            'suffer' => $suffer,
                                            'diagCat' => $diagCat,
                                            'employee' => $employee,
                                            'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                            'pasienDiagnosa' => $pasienDiagnosa
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="modal-chkstatus" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg">
        <form id="form-chkstatus" action="" method="POST">
            <div class="modal-content">
                <div class="">
                    <button type="button" class="close modalclosezoom" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="zoom_details">
                </div>
            </div>
        </form>
    </div>
</div>


<script src="<?php echo base_url(); ?>uploads\custom\patient\profile.js"></script>



<?php $this->endSection() ?>

<?php $this->section('jsContent') ?>

<script type="text/javascript">
    var historyJson = new Array();
    var pasienDiagnosa = new Array();
    var pasienDiagnosaAll = new Array();
    var lokalisAll = new Array();
    var riwayatAll = new Array();
    var diagnosasAll = new Array();
    var proceduresAll = new Array();
    var billPerawatJson = new Array();
</script>
<script type="text/javascript">
    $(document).ready(function() {
        getAlergi(<?= $visit['no_registration']; ?>)
    })
    $(document).prop("title", "<?= $visit['no_registration']; ?> - <?= $visit['diantar_oleh']; ?>")


    var skunj = <?= json_encode($visit); ?>;
    var exam = <?= json_encode($exam); ?>;

    function get_datesecond() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3) + ":" + String(m.getUTCSeconds() + 100).substring(1, 3);
        return dateString;
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        var color = ['#f56954', '#00a65a', '#f39c12', '#2f4074', '#00c0ef', '#3c8dbc', '#d2d6de', '#b7b83f'];

        var label = [
            <?php foreach ($exam as $key => $value) { ?> '<?= substr($exam[$key]['examination_date'], 0, 13); ?>',
            <?php } ?>
        ];
        var datasheet = [{
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['weight']; ?>,
                    <?php } ?>
                ],
                label: 'Berat',
                borderColor: "#438FFF",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['temperature']; ?>,
                    <?php } ?>
                ],
                label: 'Suhu',
                borderColor: "#A80000",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['height']; ?>,
                    <?php } ?>
                ],
                label: 'Tinggi',
                borderColor: "#12239E",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['nadi']; ?>,
                    <?php } ?>
                ],
                label: 'Nadi',
                borderColor: "#D82C20",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['tension_upper']; ?>,
                    <?php } ?>
                ],
                label: 'Sistol',
                borderColor: "#FFA500",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['tension_below']; ?>,
                    <?php } ?>
                ],
                label: 'Diastol',
                borderColor: "#FFA500",
                fill: false
            },
            {
                data: [
                    <?php foreach ($exam as $key => $value) { ?>
                        <?= $exam[$key]['nafas']; ?>,
                    <?php } ?>
                ],
                label: 'Nafas',
                borderColor: "#016E51",
                fill: false
            },
        ]

        var ctx = document.getElementById("medical-history-chart").getContext("2d");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: datasheet,
            }
        });
    });
</script>
<!-- //========datatable end===== -->
<!-- //========datatable end===== -->


<?php if (isset($permissions['profilrekammedis']['c'])) {
    if ($permissions['profilrekammedis']['c'] == '1') { ?>
        <?php
        echo view('admin/patient/modal/addRm', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa
        ]);
        ?>
<?php echo view('admin/patient/modal/addDiag', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]);
    }
} ?>
<?php if (isset($permissions['profilrekammedis']['u'])) {
    if ($permissions['profilrekammedis']['u'] == '1') { ?>
<?php echo view('admin/patient/modal/editDiag', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]);
    }
} ?>
<?php echo view('admin/patient/modal/historyPrescription', [
    'clinic' => $clinic,
    'visit' => $visit,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat
]); ?>
<?php echo view('admin/patient/modal/hasilRad', [
    'clinic' => $clinic,
    'visit' => $visit,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat
]); ?>
<script type="text/javascript">
    $('#fillitemid').select2({
        placeholder: "Input nama obat",
        ajax: {
            url: '<?= base_url(); ?>admin/patient/getObatListAjax',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term, // search term
                    employeeId: '<?= $visit['employee_id']; ?>'
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    $('#fillitemidR').select2({
        placeholder: "Input nama obat",
        ajax: {
            url: '<?= base_url(); ?>admin/patient/getObatListAjax',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term, // search term
                    employeeId: '<?= $visit['employee_id']; ?>'
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    function initializeSearchTarif(theid, clinicIdTarif) {
        $("#" + theid).select2({
            placeholder: "Input Tarif",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getTarif',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term, // search term
                        klinik: clinicIdTarif,
                        kelas: '<?= $visit['isrj'] == '1' ? 0 : $visit['class_id']; ?>'
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    }

    function initializeResepSelect2(theid, initialvalue = null) {
        $("#" + theid).select2({
            placeholder: "Input nama obat",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term, // search term
                        employeeId: '<?= $visit['employee_id']; ?>'
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialvalue, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }

    function initializeDiagSelect2(theid, initialvalue = null, initialname = null, initialcat = null) {
        $("#" + theid).select2({
            placeholder: "Input Diagnosa",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialname, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }

    function initializeProcSelect2(theid, initialvalue = null, initialname = null, initialcat = null) {
        $("#" + theid).select2({
            placeholder: "Input Prosedur",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getProcedureListAjax',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    $("#" + theid).val(null).trigger('change');
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        if (initialvalue != null) {
            var option = new Option(initialname, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }

    }


    function get_date() {
        var m = new Date();
        m.setHours(m.getHours() + 7)
        var dateString = m.getUTCFullYear() + "-" + String(m.getUTCMonth() + 1 + 100).substring(1, 3) + "-" + String(m.getUTCDate() + 100).substring(1, 3) + " " + String(m.getUTCHours() + 100).substring(1, 3) + ":" + String(m.getUTCMinutes() + 100).substring(1, 3);
        return dateString;
    }

    function getAlergi(nomor) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getAlergi',
            type: "POST",
            data: JSON.stringify({
                'nomor': nomor,
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $(".alergi").val(data)
                $("#aigdriwayat_alergi").val(data)
            },
            error: function() {

            }
        });
    }
</script>

<?php echo view('admin/patient/profilemodul/jsprofile/charges_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/mrpasien_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/radiologi_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/lab_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/billpoli_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php if (isset($permissions['tindakanpoli']['c'])) {
    if ($permissions['tindakanpoli']['c'] == '1') { ?>
<?php echo view('admin/patient/modal/addBill', [
            'title' => '',
            'orgunit' => $orgunit,
            'statusPasien' => $statusPasien,
            'reason' => $reason,
            'isattended' => $isattended,
            'inasisPoli' => $inasisPoli,
            'inasisFaskes' => $inasisFaskes,
            'visit' => $visit,
            'exam' => $exam,
            'pd' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat,
            'employee' => $employee,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa
        ]);
    }
} ?>
<?php echo view('admin/patient/profilemodul/jsprofile/prescription_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/rekammedis_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'clinic' => $clinic
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/cppt_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/painmonitoring_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/fallrisk_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/gcs_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/assessmentmedis_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
    'mappingAssessment' => $mappingAssessment
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/assessmentigd_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
    'mappingAssessment' => $mappingAssessment
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/vitalsign_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php echo view('admin/patient/profilemodul/jsprofile/eklaim_js', [
    'title' => '',
    'orgunit' => $orgunit,
    'statusPasien' => $statusPasien,
    'reason' => $reason,
    'isattended' => $isattended,
    'inasisPoli' => $inasisPoli,
    'inasisFaskes' => $inasisFaskes,
    'visit' => $visit,
    'exam' => $exam,
    'pd' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat,
    'employee' => $employee,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa
]); ?>
<?php $this->endSection() ?>