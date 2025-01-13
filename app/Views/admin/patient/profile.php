<?php

$this->extend('layout/nosidelayout', [
    'orgunit' => $orgunit,
    'img_time' => $img_time,
    'session_id' => $visit['session_id']
]) ?>

<?php
$permissions = user()->getPermissions();
$group = user()->getRoles();
$pasienDiagnosa = array();
$pasienDiagnosaAll = array();

$session = session();
$gsPoli = $session->gsPoli;
$roles = user()->getRoles();

foreach ($pd as $key => $value) {
    if ($pd[$key]['visit_id'] == $visit['visit_id'] && $key == 0) {
        $pasienDiagnosa = $pd[$key];
    } else {
        $pasienDiagnosaAll[] = $pd[$key];
    }
}
$menu = [
    'assessmentmedis' => 0,
    'assessmentperawat' => 0,
    'assessmentbidan' => 0,
    'cppt' => 0,
    'eresep' => 0,
    'lab' => 0,
    'rad' => 0,
    'fisio' => 0,
    'rekammedis' => 0,
    'tindakan' => 0,
    'charges' => 0,
    'rm' => 0,
    'pain' => 0,
    'fall' => 0,
    'gcs' => 0,
    'medicalitem' => 0,
    'diagnosa' => 0,
    'ordergizi' => 0,
    'vitalsign' => 0,
    'transfer' => 0,
    'tindakanperawat' => 0,
    'informedconcent' => 0,
    'odd' => 0,
    'nifas' => 0,
    'persalinan' => 0,
    'eklaim' => 0,
    'mrpasien' => 0,
    'casemanager' => 0,
    'suratketeranganlahir' => 0,
    'patientOperationRequest' => 0,
    'educationIntegration' => 0,
    'educationForm' => 0,
    'gizi' => 0,
    'patologi' => 0,
    'asuhancairan' => 0,
    'penunjang' => 1,
    'riwayatHamil' => 0,
    'permintaandarah' => 0,
    'pemeriksaanSaraf' => 0,
    'pemeriksaanKulit' => 0,
    'reportEKlaim' => 0,
    'treatintensive' => 0
];

if (user()->checkPermission("assessmentmedis", "r"))
    $menu['assessmentmedis'] = 1;
if (user()->checkPermission("assessmentperawat", "r"))
    $menu['assessmentperawat'] = 1;
if (user()->checkPermission("assessmentbidan", "r"))
    $menu['assessmentbidan'] = 1;
if (user()->checkPermission("cppt", "r"))
    $menu['cppt'] = 1;
if (user()->checkPermission("eresep", "r"))
    $menu['eresep'] = 1;
if (user()->checkPermission("lab", "r"))
    $menu['lab'] = 1;
if (user()->checkPermission("rad", "r"))
    $menu['rad'] = 1;
if (user()->checkPermission("fisio", "r"))
    $menu['fisio'] = 1;
if (user()->checkPermission("assessmentmedis", "r"))
    $menu['rekammedis'] = 1;
if (user()->checkPermission("tindakanmedis", "r"))
    $menu['tindakan'] = 1;
if (user()->checkPermission("charges", "r"))
    $menu['charges'] = 1;
if (user()->checkPermission("reporting", "r"))
    $menu['rm'] = 1;
if (user()->checkPermission("pain", "r"))
    $menu['pain'] = 1;
if (user()->checkPermission("fall", "r"))
    $menu['fall'] = 1;
if (user()->checkPermission("gcs", "r"))
    $menu['gcs'] = 1;
if (user()->checkPermission("medicalitem", "r"))
    $menu['medicalitem'] = 1;
if (user()->checkPermission("diagnosa", "r"))
    $menu['diagnosa'] = 1;
if (user()->checkPermission("ordergizi", "r"))
    $menu['ordergizi'] = 1;
if (user()->checkPermission("vitalsign", "r"))
    $menu['vitalsign'] = 1;
if (user()->checkPermission("tindaklanjut", "r"))
    $menu['transfer'] = 1;
if (user()->checkPermission("assessmentperawat", "r"))
    $menu['tindakanperawat'] = 1;
if (user()->checkPermission("informconcent", "r"))
    $menu['informedconcent'] = 1;
if (user()->checkPermission("odd", "r"))
    $menu['odd'] = 1;
if (user()->checkPermission("mrpasien", "r"))
    $menu['mrpasien'] = 1;
if (user()->checkPermission("casemanager", "r"))
    $menu['casemanager'] = 1;
if (user()->checkPermission("pasienoperasi", "r"))
    $menu['patientOperationRequest'] = 1;
if (user()->checkPermission("educationintegration", "r"))
    $menu['educationIntegration'] = 1;
if (user()->checkPermission("educationform", "r"))
    $menu['educationForm'] = 1;
if (user()->checkPermission("eklaim", "r"))
    $menu['eklaim'] = 1;
if (user()->checkPermission("asuhangizi", "r"))
    $menu['gizi'] = 1;
if (user()->checkPermission("asuhancairan", "r"))
    $menu['asuhancairan'] = 1;
if (user()->checkPermission("penunjangmedis", "r"))
    $menu['penunjang'] = 1;
if (user()->checkPermission("patologi", "r"))
    $menu['patologi'] = 1;
if (user()->checkPermission("reportEKlaim", "r"))
    $menu['reportEKlaim'] = 1;

if ($visit['specialist_type_id'] == '1.05') {
    $menu['nifas'] = 1;
    $menu['persalinan'] = 1;
    $menu['suratketeranganlahir'] = 1;
    $menu['riwayatHamil'] = 1;
    $menu['assessmentperawat'] = 0;
    $menu['assessmentbidan'] = 1;
}
if ($visit['specialist_type_id'] == '1.12') {
    $menu['pemeriksaanKulit'] = 1;
}
if ($visit['specialist_type_id'] == '1.16') {
    $menu['pemeriksaanSaraf'] = 1;
}
if (@$gsPoli == 'P002') {
    $menu['patientOperationRequest'] = 1;
}
if ($visit['isrj'] == 0) {
    $menu['permintaandarah'] = 1;
}
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

    .select2-container--default .select2-dropdown {
        z-index: 1050;
    }
</style>
<style>
    .modal-xl {
        /* max-width: 100%; */
        /* Remove the max-width to allow full screen */
        height: 90%;
        /* Set height to 100% */
        /* margin: 0; */
        /* Remove margins */
    }

    /* .modal-sm {
        max-height: 90%;
    } */

    .modal-content {
        height: 100%;
        /* Allow the content to fill the modal */
        border-radius: 0;
        /* Optional: Remove rounded corners */
    }

    .modal-body {
        overflow-y: auto;
        /* Enable vertical scrolling */
        /* max-height: calc(100vh - 200px); */
        /* Set max height for modal body */
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
                                        <li class="nav-item active"><a id="overviewTab" class="nav-link border-bottom active" href="#overview" data-bs-toggle="tab" aria-expanded="true" role="tab">Profil</a></li>
                                        <?php if ($menu['assessmentmedis'] == 1) { ?>
                                            <li class="nav-item"><a id="assessmentmedisTab" class="nav-link border-bottom" href="#assessmentmedis" data-bs-toggle="tab" aria-expanded="true" role="tab">Assessment Medis</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['assessmentperawat'] == 1) { ?>
                                            <li class="nav-item"><a id="assessmentigdTab" class="nav-link border-bottom" href="#assessmentigd" data-bs-toggle="tab" aria-expanded="true" role="tab">Assessment Perawat</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['assessmentbidan'] == 1) { ?>
                                            <li class="nav-item"><a id="assessmentbidanTab" class="nav-link border-bottom" href="#assessmentbidan" data-bs-toggle="tab" aria-expanded="true" role="tab">Assessment Bidan</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['cppt'] == 1) { ?>
                                            <li class="nav-item"><a id="cpptTab" class="nav-link border-bottom" href="#cppt" data-bs-toggle="tab" aria-expanded="true" role="tab"> CPPT</a></li>
                                        <?php }  ?>
                                        <?php if ($menu['vitalsign'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="vitalsignTab" class="nav-link border-bottom" href="#vitalsignmodul" data-bs-toggle="tab" aria-expanded="true" role="tab">Vital Sign</a></li>
                                        <?php
                                        } ?>
                                        <?php
                                        if ($menu['eresep'] == 1) { ?>
                                            <li class="nav-item"><a id="eresepTab" class="nav-link border-bottom" href="#eresep" data-bs-toggle="tab" aria-expanded="true" role="tab">EPrescription</a></li>
                                        <?php }  ?>
                                        <?php if ($menu['medicalitem'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="medicalitemTab" class="nav-link border-bottom" href="#eresep" data-bs-toggle="tab" aria-expanded="true" role="tab">Medical Item</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['odd'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="oddTab" class="nav-link border-bottom" href="#odd" data-bs-toggle="tab" aria-expanded="true" role="tab">ODD</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['tindakan'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="tindakanTab" class="nav-link border-bottom" href="#billpoli" data-bs-toggle="tab" aria-expanded="true" role="tab">Tindakan Medis</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['tindakanperawat'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="tindakanPerawatTab" class="nav-link border-bottom" href="#tindakanperawat" data-bs-toggle="tab" aria-expanded="true" role="tab">Implementasi</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['fisio'] == 1) { ?>
                                            <li class="nav-item"><a id="fisioTab" class="nav-link border-bottom" href="#fisio" data-bs-toggle="tab" aria-expanded="true" role="tab">Fisioterapi</a></li>
                                            <li class="nav-item"><a id="jadwalFisioTab" class="nav-link border-bottom" href="#jadwalFisiomodul" data-bs-toggle="tab" aria-expanded="true" role="tab">Jadwal Fisio</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['lab'] == 1) { ?>
                                            <li class="nav-item"><a id="labTab" class="nav-link border-bottom" href="#lab" data-bs-toggle="tab" aria-expanded="true" role="tab">Laboratorium</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['rad'] == 1) { ?>
                                            <li class="nav-item"><a id="radTab" class="nav-link border-bottom" href="#rad" data-bs-toggle="tab" aria-expanded="true" role="tab">Radiologi</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['penunjang'] == 1) { ?>
                                            <li class="nav-item"><a id="penunjangMedisTab" class="nav-link border-bottom" href="#penunjangMedis" data-bs-toggle="tab" aria-expanded="true" role="tab">Penunjang Medis</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['patologi'] == 1) { ?>
                                            <li class="nav-item"><a id="patologiTab" class="nav-link border-bottom" href="#patologi" data-bs-toggle="tab" aria-expanded="true" role="tab">Patologi</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['permintaandarah'] == 1) { ?>
                                            <li class="nav-item"><a id="PermintaanDarahTab" class="nav-link border-bottom" href="#permintaanDarah" data-bs-toggle="tab" aria-expanded="true" role="tab">Permintaan Darah</a></li>
                                        <?php }  ?>
                                        <?php
                                        if ($menu['rekammedis'] == 1) { ?>
                                            <li class="nav-item"><a id="rekammedisTab" class="nav-link border-bottom" href="#assessmentmedis" data-bs-toggle="tab" aria-expanded="true" role="tab">Resume Medis</a></li>
                                        <?php } ?>
                                        <?php if ($menu['transfer'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="transferTab" class="nav-link border-bottom" href="#transfer" data-bs-toggle="tab" aria-expanded="true" role="tab">Tindak Lanjut</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['charges'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="chargesTab" class="nav-link border-bottom" href="#charges" data-bs-toggle="tab" aria-expanded="true" role="tab">Billing</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['gcs'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="gcsTab" class="nav-link border-bottom" href="#gcs" data-bs-toggle="tab" aria-expanded="true" role="tab">GCS</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['pain'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="painTab" class="nav-link border-bottom" href="#pain" data-bs-toggle="tab" aria-expanded="true" role="tab">Monitoring Nyeri</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['fall'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="fallTab" class="nav-link border-bottom" href="#fall" data-bs-toggle="tab" aria-expanded="true" role="tab">Resiko Jatuh</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['educationIntegration'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="educationIntegrationTab" class="nav-link border-bottom" href="#educationIntegration" data-bs-toggle="tab" aria-expanded="true" role="tab">Edukasi Integrasi</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['diagnosa'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="diagnosaTab" class="nav-link border-bottom" href="#diagnosa" data-bs-toggle="tab" aria-expanded="true" role="tab">Diagnosa</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['ordergizi'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="orderGiziTab" class="nav-link border-bottom" href="#orderGizi" data-bs-toggle="tab" aria-expanded="true" role="tab">Order Gizi</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['informedconcent'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="informConcentTab" class="nav-link border-bottom" href="#infConsent" data-bs-toggle="tab" aria-expanded="true" role="tab">Inform Concent</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['nifas'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="nifasTab" class="nav-link border-bottom" href="#nifas" data-bs-toggle="tab" aria-expanded="true" role="tab">Nifas</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['persalinan'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="persalinanTab" class="nav-link border-bottom" href="#persalinan" data-bs-toggle="tab" aria-expanded="true" role="tab">Laporan Persalinan</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['riwayatHamil'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="riwayatHamilTab" class="nav-link border-bottom"
                                                    href="#riwayatHamil" data-bs-toggle="tab" aria-expanded="true"
                                                    role="tab">Riwayat Hamil</a></li>
                                        <?php } ?>
                                        <?php if ($menu['casemanager'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="casemanagerTab" class="nav-link border-bottom" href="#casemanager" data-bs-toggle="tab" aria-expanded="true" role="tab">MPP</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['suratketeranganlahir'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="suratketeranganlahirTab" class="nav-link border-bottom" href="#suratketeranganlahir" data-bs-toggle="tab" aria-expanded="true" role="tab">Surat Keterangan Lahir</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['patientOperationRequest'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="patientOperationRequestTab" class="nav-link border-bottom" href="#patientOperationRequest" data-bs-toggle="tab" aria-expanded="true" role="tab">Tindakan Operasi</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['gizi'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="giziTab" class="nav-link border-bottom" href="#gizi" data-bs-toggle="tab" aria-expanded="true" role="tab">Asuhan Gizi</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['treatintensive'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="treatintensiveTab" class="nav-link border-bottom"
                                                    href="#treatintensive" data-bs-toggle="tab" aria-expanded="true"
                                                    role="tab">Treatment Intensive</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['asuhancairan'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="cairanTab" class="nav-link border-bottom" href="#cairan" data-bs-toggle="tab" aria-expanded="true" role="tab">Balance Cairan</a></li>
                                        <?php
                                        } ?>

                                        <?php if ($menu['eklaim'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="eklaimTab" class="nav-link border-bottom" href="#klaim" data-bs-toggle="tab" aria-expanded="true" role="tab">EKlaim</a></li>
                                        <?php
                                        } ?>
                                        <?php if ($menu['reportEKlaim'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="reportEKlaimTab" class="nav-link border-bottom"
                                                    href="#reportEKlaim" data-bs-toggle="tab" aria-expanded="true"
                                                    role="tab">Reporting EKlaim</a></li>
                                        <?php
                                        } ?>

                                        <?php if ($menu['rm'] == 1) {
                                        ?>
                                            <li class="nav-item"><a id="rmTab" class="nav-link border-bottom" href="#rm" data-bs-toggle="tab" aria-expanded="true" role="tab">Reporting</a></li>
                                        <?php
                                        } ?>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane tab-content-height active show" id="overview">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-12 border-r">
                                                    <?php echo view('admin/patient/profilemodul/profilebiodata', [
                                                        'visit' => $visit,
                                                        'pasienDiagnosaAll' => $pasienDiagnosaAll,
                                                        'pasienDiagnosa' => $pasienDiagnosa,

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
                                                            <p><b><i class="fa fa-tag"></i> Anamnesis:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmanamnase"></div>
                                                                </li>
                                                                <li>
                                                                    <div class="rmalloanamnase"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Riwayat Penyakit Sekarang:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmdescription"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Diagnosa Klinis:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmanamnase"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Standing Order:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmstanding_order"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Rencana Instruksi:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rminstruction"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Periksa Lab:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmlab_result"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Periksa RO:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmro_result"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Farmakoterapi:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmteraphy_desc"></div>
                                                                </li>
                                                            </ul>
                                                            <hr class="hr-panel-heading hr-10">
                                                            <p><b><i class="fa fa-tag"></i> Terapi:</b></p>
                                                            <ul>
                                                                <li>
                                                                    <div class="rmtherapy_target"></div>
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
                                                                                    foreach ($examDetail as $key => $value) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?= substr($examDetail[$key]['examination_date'], 0, 13); ?></td>
                                                                                            <td><?= $examDetail[$key]['weight']; ?></td>
                                                                                            <td><?= $examDetail[$key]['temperature']; ?></td>
                                                                                            <td><?= $examDetail[$key]['height']; ?></td>
                                                                                            <td><?= $examDetail[$key]['nadi']; ?></td>
                                                                                            <td><?= $examDetail[$key]['tension_upper'] . ' / ' . $examDetail[$key]['tension_below']; ?></td>
                                                                                            <td><?= $examDetail[$key]['saturasi']; ?></td>
                                                                                            <td><?= $examDetail[$key]['nafas']; ?></td>
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
                                            'pasienDiagnosa' => $pasienDiagnosa,

                                        ]); ?>
                                        <?php if ($menu['patologi'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/patologi', [
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
                                        <?php
                                        } ?>
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
                                            'pasienDiagnosa' => $pasienDiagnosa,

                                        ]); ?>
                                        <?php if ($menu['rad'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>

                                        <?php if ($menu['penunjang'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/penunjangMedis', [
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

                                            ]); ?>
                                        <?php
                                        } ?>

                                        <?php if ($menu['fisio'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/fisio', [
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

                                            ]); ?>
                                            <?php echo view('admin/patient/profilemodul/jadwalfisio', [
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

                                            ]); ?>
                                        <?php
                                        } ?>

                                        <?php if ($menu['lab'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>

                                        <?php if ($menu['tindakan'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php //if ($menu['eresep'] == 1 || $menu['medicalitem'] == 1) {
                                        if (true) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['rekammedis'] == 1) {
                                        ?>
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
                                        <?php
                                        } ?>
                                        <?php if ($menu['rm'] == 1) {
                                        ?>
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
                                        <?php
                                        } ?>
                                        <?php if ($menu['cppt'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>

                                        <?php if ($menu['pain'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['fall'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['gcs'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['educationIntegration'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/educationintegration', [
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

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['assessmentmedis'] == 1) {
                                        ?>
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
                                        <?php
                                        } ?>
                                        <?php if ($menu['assessmentperawat'] == 1) {
                                        ?>
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
                                        <?php
                                        } ?>
                                        <?php if ($menu['assessmentbidan'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/assessmentbidan', [
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
                                        <?php
                                        } ?>
                                        <?php if ($menu['ordergizi'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/ordergizi', [
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
                                        <?php
                                        } ?>
                                        <?php if ($menu['vitalsign'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['transfer'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/transfer', [
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
                                                'clinicAll' => $clinicAll,
                                                'followup' => $followup,
                                                'clinicType' => $clinicType
                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['eklaim'] == 1) {
                                        ?>
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
                                                'pasienDiagnosa' => $pasienDiagnosa,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['tindakan'] == 1) {
                                        ?>
                                        <?php
                                        } ?>

                                        <?php echo view('admin/patient/profilemodul/tandatangan', [
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

                                        ]); ?>


                                        <?php if ($menu['diagnosa'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/diagnosa', [
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

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['tindakanperawat'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/tindakanperawat', [
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

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['pemeriksaanKulit'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/pemeriksaan-kulit.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['pemeriksaanSaraf'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/pemeriksaan-saraf.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['permintaandarah'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/permintaan_darah', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['informedconcent'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/informedConsent', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['odd'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/odd', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['nifas'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/nifas', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['reportEKlaim'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/reportEKlaim', [
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
                                        <?php
                                        } ?>

                                        <?php if ($menu['treatintensive'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/treat-intensive.php', [
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
                                                'dokter' => $employee,

                                            ]); ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['persalinan'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/persalinan', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['riwayatHamil'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/riwayat-Hamil.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['gizi'] == 1) {
                                        ?>
                                            <?php echo view('admin\patient\profilemodul\gizi.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['asuhancairan'] == 1) {
                                        ?>
                                            <?php echo view('admin\patient\profilemodul\cairan.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['casemanager'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/casemanager', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['suratketeranganlahir'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/surat_keterangan_lahir.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
                                        <?php if ($menu['patientOperationRequest'] == 1) {
                                        ?>
                                            <?php echo view('admin/patient/profilemodul/patientOperationRequest.php', [
                                                'title' => '',
                                                'visit' => $visit,
                                                'aParent' => $aParent,
                                                'aType' => $aType,
                                                'aParameter' => $aParameter,
                                                'aValue' => $aValue,
                                            ]) ?>
                                        <?php
                                        } ?>
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
        // getAlergi(<?= $visit['no_registration']; ?>)
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
            <?php foreach ($examDetail as $key => $value) { ?> '<?= substr($examDetail[$key]['examination_date'], 0, 13); ?>',
            <?php } ?>
        ];
        var datasheet = [{
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['weight']; ?>,
                    <?php } ?>
                ],
                label: 'Berat',
                borderColor: "#438FFF",
                fill: false
            },
            {
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['temperature']; ?>,
                    <?php } ?>
                ],
                label: 'Suhu',
                borderColor: "#A80000",
                fill: false
            },
            {
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['height']; ?>,
                    <?php } ?>
                ],
                label: 'Tinggi',
                borderColor: "#12239E",
                fill: false
            },
            {
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['nadi']; ?>,
                    <?php } ?>
                ],
                label: 'Nadi',
                borderColor: "#D82C20",
                fill: false
            },
            {
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['tension_upper']; ?>,
                    <?php } ?>
                ],
                label: 'Sistol',
                borderColor: "#FFA500",
                fill: false
            },
            {
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['tension_below']; ?>,
                    <?php } ?>
                ],
                label: 'Diastol',
                borderColor: "#FFA500",
                fill: false
            },
            {
                data: [
                    <?php foreach ($examDetail as $key => $value) { ?>
                        <?= $examDetail[$key]['nafas']; ?>,
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
            'pasienDiagnosa' => $pasienDiagnosa,

        ]);

        echo view('admin/patient/modal/addDiag', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]);
    }
}
if (isset($permissions['profilrekammedis']['u'])) {
    if ($permissions['profilrekammedis']['u'] == '1') {
        echo view('admin/patient/modal/editDiag', [
            'clinic' => $clinic,
            'visit' => $visit,
            'pasienDiagnosaAll' => $pasienDiagnosaAll,
            'pasienDiagnosa' => $pasienDiagnosa,
            'suffer' => $suffer,
            'diagCat' => $diagCat
        ]);
    }
}
echo view('admin/patient/modal/historyPrescription', [
    'clinic' => $clinic,
    'visit' => $visit,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat
]);
echo view('admin/patient/modal/hasilRad', [
    'clinic' => $clinic,
    'visit' => $visit,
    'pasienDiagnosaAll' => $pasienDiagnosaAll,
    'pasienDiagnosa' => $pasienDiagnosa,
    'suffer' => $suffer,
    'diagCat' => $diagCat
]); ?>
<script type="text/javascript">
    $('#fillitemid').select2({
        placeholder: "input nama item",
        theme: 'bootstrap-5',
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
        placeholder: "input nama item",
        theme: 'bootstrap-5',
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

    function initializeDiagGizi(theid, initialvalue = null, initialname = null, initialcat = null) {
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
                        clinic: 'gizi'
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
            // console.log(theid)
            // console.log(option)
            $("#" + theid).append(option).trigger('change');
        }
    }

    function initializeSearchTemplateExpertise(theid) {
        $("#" + theid).select2({
            theme: "bootstrap-5",
            dropdownParent: "#modalExpertise",
            placeholder: "Masukkan Template",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getTemplateExpertise',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term
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

    function initializeSearchAgeRange(theid, modalParent, initialvalue = null, initialName = null) {
        $("#" + theid).select2({
            theme: "bootstrap-5",
            dropdownParent: modalParent,
            placeholder: "Pilih Kategori Usia",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getAgeRange',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term
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
            let option = new Option(initialName, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }
    }

    function initializeSearchDokterRad(theid) {
        $("#" + theid).select2({
            theme: "bootstrap-5",
            placeholder: "Input Dokter",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDokterRad',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term
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

    function initializeSearchDietaryHabit(theid, modalParent, initialvalue = null, initialName = null) {
        $("#" + theid).select2({
            theme: "bootstrap-5",
            dropdownParent: modalParent,
            placeholder: "Pilih pola makan",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDietaryHabit',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term
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
            let option = new Option(initialName, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }
    }

    function initializeSearchTarif(theid, clinicIdTarif) {
        $("#" + theid).select2({
            placeholder: "Item",
            theme: 'bootstrap-5',
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

    function initializeSearchTarifFisio(className, initialValue = null, initialName = null) {
        $("." + className).each(function() {

            $(this).select2({
                theme: "bootstrap-5",
                ajax: {
                    url: '<?= base_url(); ?>admin/patient/getTarif',
                    type: "post",
                    dataType: 'json',
                    delay: 50,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        $(this).val(null).trigger('change');
                        return {
                            results: response
                        };

                    }.bind(this),
                    cache: true
                }
            });

            if (initialValue != null) {
                let option = new Option(initialName, initialValue, true, true);
                $(this).append(option).trigger('change');
            }
        });
    }


    function initializeSearchTarifPerawat(theid, clinicIdTarif) {
        $("#" + theid).select2({
            placeholder: "Input Tarif",
            theme: 'bootstrap-5',
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getTarifPerawat',
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
            placeholder: "input nama item",
            dropdownParent: "#prescriptionDetailModal",
            theme: 'bootstrap-5',
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

    function initializeResepRacikSelect2(theid, initialvalue = null) {
        $("#" + theid).select2({
            placeholder: "input nama item",
            dropdownParent: "#prescriptionDetailModal",
            theme: 'bootstrap-5',
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatListAjaxRacik',
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

    function initializeResepAlkesSelect2(theid, initialvalue = null) {
        $("#" + theid).select2({
            placeholder: "input nama item",
            dropdownParent: "#prescriptionDetailModal",
            theme: 'bootstrap-5',
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatAlkesListAjax',
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

    function initializeResepAllSelect2(theid, initialvalue = null) {
        $("#" + theid).select2({
            placeholder: "input nama item",
            dropdownParent: "#prescriptionDetailModal",
            theme: 'bootstrap-5',
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatAllListAjax',
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

    function initializeSearchDietaryHabit(theid, modalParent, initialvalue = null, initialName = null) {
        $("#" + theid).select2({
            theme: "bootstrap-5",
            tags: true, //new
            dropdownParent: modalParent,
            placeholder: "Pilih pola makan",
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDietaryHabit',
                type: "post",
                dataType: 'json',
                delay: 50,
                data: function(params) {
                    return {
                        searchTerm: params.term
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
            let option = new Option(initialName, initialvalue, true, true);
            $("#" + theid).append(option).trigger('change');
        }
    }

    function initializeDiagSelect2(theid, initialvalue = null, initialname = null, initialcat = null, modalParent = null) {
        let modalParentId;
        if (modalParent == null) {
            modallParentId = $(this).parent()
        } else {
            modalParentId = $("#" + modalParent)
        }
        $("#" + theid).select2({
            placeholder: "Input Diagnosa",
            dropdownParent: modalParentId,
            theme: 'bootstrap-5',
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
            dropdownParent: $(this).parent(),
            theme: 'bootstrap-5',
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

<?php echo view('admin/patient/profilemodul/jsprofile/profile_js', [
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
]);
if ($menu['assessmentmedis'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/assessmentmedis_js', [
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
    ]);
}
if (true) {
    echo view('admin/patient/profilemodul/jsprofile/assessmentigd_js', [
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
    ]);
}
if ($menu['assessmentbidan'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/assessmentbidan_js', [
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
    ]);
}
if ($menu['patologi'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/patologi_js', [
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

if ($menu['charges'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/charges_js', [
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

    ]);
}
if ($menu['mrpasien'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/mrpasien_js', [
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

    ]);
}
if ($menu['rad'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/radiologi_js', [
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

    ]);
}
if ($menu['penunjang'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/penunjangMedis_js', [
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

    ]);
}
if ($menu['fisio'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/fisio_js', [
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

    ]);
    echo view('admin/patient/profilemodul/jsprofile/jadwalfisio_js', [
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

    ]);
}
if ($menu['ordergizi'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/ordergizi_js', [
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

    ]);
}
if ($menu['lab'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/lab_js', [
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

    ]);
}
if ($menu['tindakan'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/billpoli_js', [
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

    ]);
}
if (isset($permissions['tindakanpoli']['c'])) {
    if ($permissions['tindakanpoli']['c'] == '1') {
        echo view('admin/patient/modal/addBill', [
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

        ]);
    }
}
echo view('admin/patient/profilemodul/skriningsuspect', [
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

]);
?>

<?php //if (true) {
if ($menu['eresep'] == 1 || $menu['medicalitem'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/prescription_js', [
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

    ]);
}
if ($menu['rekammedis'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/rekammedis_js', [
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
    ]);
}
if ($menu['cppt'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/cppt_js', [
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

    ]);
}
if ($menu['pain'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/painmonitoring_js', [
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

    ]);
}
if ($menu['fall'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/fallrisk_js', [
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

    ]);
}
if ($menu['gcs'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/gcs_js', [
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

    ]);
}
if ($menu['educationIntegration'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/educationintegration_js', [
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

    ]);
}
if ($menu['vitalsign'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/vitalsign_js', [
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

    ]);
}
if ($menu['transfer'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/transfer_js', [
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

    ]);
}
echo view('admin/patient/profilemodul/jsprofile/tandatangan_js', [
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

]); ?>

<?php if ($menu['diagnosa'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/diagnosa_js', [
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

    ]);
}
if ($menu['tindakanperawat'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/tindakanperawat_js', [
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

    ]);
}
if ($menu['odd'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/odd_js', [
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]);
}
if ($menu['nifas'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/nifas_js', [
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]);
}
if ($menu['persalinan'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/persalinan_js', [
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]);
}
if ($menu['riwayatHamil'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/riwayatHamil_js.php', [
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
if ($menu['pemeriksaanKulit'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/pemeriksaanKulit_js.php', [
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
if ($menu['pemeriksaanSaraf'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/pemeriksaanSaraf_js.php', [
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
if ($menu['eklaim'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/eklaim_js', [
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]);
} ?>
<?php
if ($menu['permintaandarah'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/permintaan_darah_js', [
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]);
} ?>
<?php if ($menu['gizi'] == 1) {
?>
    <?php echo view('admin\patient\profilemodul\jsprofile\gizi_js.php', [
        'title' => '',
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]) ?>
<?php
} ?>
<?php if ($menu['casemanager'] == 1) {
?>
    <?php echo view('admin\patient\profilemodul\jsprofile\casemanager_js.php', [
        'title' => '',
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]) ?>
<?php
} ?>
<?php if ($menu['asuhancairan'] == 1) {
?>
    <?php echo view('admin\patient\profilemodul\jsprofile\cairan_js.php', [
        'title' => '',
        'visit' => $visit,
        'aParent' => $aParent,
        'aType' => $aType,
        'aParameter' => $aParameter,
        'aValue' => $aValue,
    ]) ?>
<?php
} ?>
<?php echo view('admin\patient\profilemodul\jsprofile\skriningsuspect_js.php', [
    'title' => '',
    'visit' => $visit,
    'aParent' => $aParent,
    'aType' => $aType,
    'aParameter' => $aParameter,
    'aValue' => $aValue,
]) ?>
<?php if ($menu['informedconcent'] == 1) {
    echo view('admin/patient/profilemodul/jsprofile/informedConsent_js', [
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
    ]);
}
$this->endSection() ?>