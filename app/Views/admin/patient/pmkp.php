<?php

// $this->extend('layout/nosidelayout', [
//     'orgunit' => $orgunit,
//     'img_time' => $img_time
// ]);
$this->extend('layout/basiclayout', [
    'orgunit' => @$orgunit,
    'img_time' => @$img_time
])
?>

<?php $this->section('cssContent') ?>
<!-- DataTables -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php $this->endSection() ?>

<?php $this->section('topbar') ?>
<?php echo view('layout/partials/topbar.php', [
    'title' => @$title,
    'pagetitle' => 'dashboard',
    'subtitle' => 'dashboard',
]); ?>
<?php $this->endSection() ?>
<?php $this->section('content'); ?>
<div class="content-wrapper">
    <section>
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card border border-1 rounded-4">
                            <div class="card-body">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pmkp-ranap-tab" data-bs-toggle="tab" data-bs-target="#rawat_jalan_pmkp" type="button" role="tab" aria-controls="rawat_jalan" aria-selected="false" tabindex="-1"><i class="fa fa-stethoscope text-primary"></i> Rawat Jalan</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pmkp-ralan-tab" data-bs-toggle="tab" data-bs-target="#rawat_inap_pmkp" type="button" role="tab" aria-controls="rawat_inap" aria-selected="false" tabindex="-1"><i class="fa fa-procedures text-primary"></i> Rawat Inap</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content mt-3">
                                        <div class="tab-pane tab-content-height" id="rawat_inap_pmkp" role="tabpanel" aria-labelledby="home-tab">
                                            <form action="" method="POST" id="formSearchPMKP">
                                                <input type="hidden" name="keluar_id" value="0">

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Nama Pasien</label>
                                                            <input type="text" name="nama" class="form-control" id="nama">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Nama RM</label>
                                                            <input type="text" name="norm" class="form-control" id="norm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Bangsal</label>
                                                            <select id="iklinikGizi" class="form-select" name="klinik" autocomplete="off">
                                                                <option value="%">Semua</option>
                                                                <?php $cliniclist = array();
                                                                foreach ($clinic as $key => $value) {
                                                                    if ($clinic[$key]['stype_id'] == '3') {
                                                                        $cliniclist[$clinic[$key]['name_of_clinic']] = $clinic[$key]['name_of_clinic'];
                                                                    }
                                                                }
                                                                asort($cliniclist);
                                                                ?>
                                                                <?php foreach ($cliniclist as $key => $value) { ?>
                                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <div class="mt-4">
                                                                    <div class="mb-0">
                                                                        <div>
                                                                            <button id="btn-search-pmkp" type="button" name="search" class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-search"></i> Cari</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <div class="d-flex justify-content-end gap-3 mb-3">
                                                <button type="button" class="btn btn-success" id="btnCetakForm" disabled><i class="fas fa-print"></i> Cetak</button>
                                                <button type="button" class="btn btn-success" id="btnGrafikForm" disabled><i class="fas fa-chart-bar"></i> Grafik</button>
                                                <button type="button" class="btn btn-warning" id="btnAnalisisForm" disabled><i class="fas fa-calculator"></i> Analisis</button>
                                                <button type="button" class="btn btn-primary" id="btnInsertForm" disabled><i class="fas fa-sticky-note"></i> Formulir</button>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th width="1%" class="text-center">No.</th>
                                                        <th width="23%" class="text-center">Nama Pasien (No RM)</th>
                                                        <th class="text-center">Dokter</th>
                                                        <th width="23%" class="text-center">Bangsal</th>
                                                        <th width="23%" class="text-center">TGL Lahir / Usia</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="containerTablePMKP">

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane show active tab-content-height" id="rawat_jalan_pmkp" role="tabpanel" aria-labelledby="home-tab">
                                            <form action="" id="formSearchRalanPMKP" method="post">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-2">
                                                        <div class="form-group">
                                                            <label>Pelayanan</label><small class="req"> *</small>
                                                            <select id="klinikrajal" class="form-select" name="klinik" autocomplete="off">
                                                                <option value="%">Semua</option>
                                                                <?php if (is_null(user()->employee_id)) { ?>
                                                                <?php } ?>
                                                                <?php $cliniclist = array();

                                                                foreach ($clinic as $key => $value) {
                                                                    if ($clinic[$key]['stype_id'] == '1') {
                                                                        $cliniclist[$clinic[$key]['name_of_clinic']] = $clinic[$key]['name_of_clinic'];
                                                                    }
                                                                }
                                                                asort($cliniclist);
                                                                ?>
                                                                <?php foreach ($cliniclist as $key => $value) { ?>
                                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger" id="error_search_type"></span>
                                                    </div>
                                                    <div class="col-sm-6 col-md-2">
                                                        <div class="form-group">
                                                            <label>Dokter</label>
                                                            <select id="dokter" class="form-control" name="dokter">
                                                                <?php if (!is_null(user()->employee_id) && isset($roles['11'])) { ?>
                                                                    <option value="<?= user()->employee_id; ?>"><?= user()->getFullname(); ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="%">Semua</option>
                                                                    <?php $dokterlist = array();
                                                                    foreach ($dokter as $key => $value) {
                                                                        foreach ($value as $key1 => $value1) {
                                                                            $dokterlist[$key1] = $value1;
                                                                        }
                                                                    }
                                                                    asort($dokterlist);
                                                                    ?>
                                                                    <?php foreach ($dokterlist as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                            <span class="text-danger" id="error_doctor"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Nama / Nomor</label>
                                                            <input type="text" name="norm" id="nama" placeholder="Nama/No.RM/No.SEP/No.BPJS" value="" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-2">
                                                        <div class="mb-3">
                                                            <label>Tanggal Awal</label>
                                                            <div>
                                                                <div class="input-group">
                                                                    <input id="mulai" type="text" class="form-control dateflatpickr-pmkp bg-white" autocomplete="off" name="mulai">
                                                                    <!-- <input type="hidden" id="searchmulai" name="mulai"> -->

                                                                    <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

                                                                </div>
                                                                <!-- input-group -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-md-2">
                                                        <div class="mb-3">
                                                            <label>Tanggal Akhir</label>
                                                            <div>
                                                                <div class="input-group">
                                                                    <input id="akhir" type="text" class="form-control dateflatpickr-pmkp bg-white" autocomplete="off" name="akhir">
                                                                    <!-- <input type="hidden" id="searchakhir" name="akhir"> -->


                                                                    <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->

                                                                </div>
                                                                <!-- input-group -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <div class="mt-4">
                                                                    <div class="mb-0">
                                                                        <div>
                                                                            <button id="btn-search-ralan-pmkp" type="button" name="search" class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-search"></i> Cari</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr>
                                            <div class="d-flex justify-content-end gap-3 mb-3">
                                                <button type="button" class="btn btn-success" id="btnCetakFormRalan" disabled><i class="fas fa-print"></i> Cetak</button>
                                                <button type="button" class="btn btn-success" id="btnGrafikFormRalan" disabled><i class="fas fa-chart-bar"></i> Grafik</button>
                                                <button type="button" class="btn btn-warning" id="btnAnalisisFormRalan" disabled><i class="fas fa-calculator"></i> Analisis</button>
                                                <button type="button" class="btn btn-primary" id="btnInsertFormRalan" disabled><i class="fas fa-sticky-note"></i> Formulir</button>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th width="1%" class="text-center">No.</th>
                                                        <th width="23%" class="text-center">Nama Pasien (No RM)</th>
                                                        <th class="text-center">Dokter</th>
                                                        <th width="23%" class="text-center">Bangsal</th>
                                                        <th width="23%" class="text-center">TGL Lahir / Usia</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="containerTablePMKP_ralan">

                                                </tbody>
                                            </table>
                                        </div>
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

<div class="modal fade" id="modal_formulir_pmkp" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">FORMULIR PMKP - <span id="modal_name_of_clinic"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:75vh; overflow-y: auto;">
                <form action="" method="post" id="formPMKP">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th><i class="fas fa-check"></i></th>
                            </tr>
                        </thead>
                        <tbody id="body_container_pmkp">

                        </tbody>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex">
                    <button class="btn btn-primary ms-auto" type="button" id="btn_save_form_pmkp"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal_grafik_pmkp" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">GRAFIK PMKP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:75vh; overflow-y: auto;">
                <form action="" method="post" id="form_grafik_search">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Kategori</label>
                            <select name="kategori" id="select_kategori_grafik" class="form-select">
                                <option value="1">Minggu</option>
                                <option value="2">Bulan</option>
                                <option value="3">Tahun</option>
                            </select>
                        </div>
                        <div class="col-3" id="display_select_bulan">
                            <label for="">Bulan</label>
                            <input type="month" name="bulan" class="form-control" value="<?= date('Y-m'); ?>">
                        </div>
                        <div class="col-3 collapse" id="display_select_tahun">
                            <label for="">Tahun</label>
                            <select name="tahun" class="form-select">
                                <?php
                                $currentYear = date("Y");
                                $years = [];

                                for ($i = -5; $i <= 5; $i++) {
                                    $years[] = $currentYear + $i;
                                }
                                foreach ($years as $year) : ?>
                                    <option value="<?= $year; ?>" <?= $year == $currentYear ? 'selected' : ''; ?>><?= $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="select_indicator_formulir">Indikator</label>
                            <select name="indicator_id" id="select_indicator_formulir" class="form-select">

                            </select>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="mt-4">
                                        <div class="mb-0">
                                            <div>
                                                <button id="btn-search-kategori-pmkp" type="button" name="search" class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-search"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row mt-3">
                    <div class="col-4">
                    </div>
                    <div class="col-8">
                        <canvas id="container-grafik-pmkp" style="width:100%;"></canvas>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex">
                    <button class="btn btn-secondary ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal_analisis_pmkp" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">ANALISIS PMKP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:75vh; overflow-y: auto;">
                <form action="" method="post" id="form_analisis_search">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Kategori</label>
                            <select name="kategori" id="select_kategori_analisis" class="form-select">
                                <option value="1">Bulan</option>
                                <option value="2">Tahun</option>
                            </select>
                        </div>
                        <div class="col-3" id="display_select_bulan_analisis">
                            <label for="">Bulan</label>
                            <input type="month" name="bulan" class="form-control" value="<?= date('Y-m'); ?>">
                        </div>
                        <div class="col-3 collapse" id="display_select_tahun_analisis">
                            <label for="">Tahun</label>
                            <select name="tahun" class="form-select">
                                <?php
                                $currentYear = date("Y");
                                $years = [];

                                for ($i = -5; $i <= 5; $i++) {
                                    $years[] = $currentYear + $i;
                                }
                                foreach ($years as $year) : ?>
                                    <option value="<?= $year; ?>" <?= $year == $currentYear ? 'selected' : ''; ?>><?= $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="mt-4">
                                        <div class="mb-0">
                                            <div>
                                                <button id="btn-search-analisis-pmkp" type="button" name="search" class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-search"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">Laporan Mutu Bulanan</h3>
                        <table class="table table-bordered">
                            <tr class="table-primary">
                                <th width="1%">NO.</th>
                                <th>INDIKATOR MUTU</th>
                                <th width="1%">CAPAIAN</th>
                                <th width="1%">STANDAR</th>
                                <th>RENCANA TINDAK LANJUT</th>
                            </tr>
                            <tbody id="container_analisis_pmkp">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex">
                    <button class="btn btn-secondary ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<div class="modal fade" id="modal_cetak_pmkp" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">CETAK PMKP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:75vh; overflow-y: auto;">
                <form action="" method="post" id="form_cetak_search">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Kategori</label>
                            <select name="kategori" id="select_kategori_cetak" class="form-select">
                                <option value="1">Bulan</option>
                                <option value="2">Tahun</option>
                            </select>
                        </div>
                        <div class="col-3" id="display_select_bulan_cetak">
                            <label for="">Bulan</label>
                            <input type="month" name="bulan" class="form-control" value="<?= date('Y-m'); ?>">
                        </div>
                        <div class="col-3 collapse" id="display_select_tahun_cetak">
                            <label for="">Tahun</label>
                            <select name="tahun" class="form-select">
                                <?php
                                $currentYear = date("Y");
                                $years = [];

                                for ($i = -5; $i <= 5; $i++) {
                                    $years[] = $currentYear + $i;
                                }
                                foreach ($years as $year) : ?>
                                    <option value="<?= $year; ?>" <?= $year == $currentYear ? 'selected' : ''; ?>><?= $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="mt-4">
                                        <div class="mb-0">
                                            <div>
                                                <button id="btn-search-cetak-pmkp" type="button" name="search" class="btn btn-primary waves-effect waves-light me-1"><i class="fa fa-search"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>

            </div>
            <div class="modal-footer">
                <div class="d-flex">
                    <button class="btn btn-secondary ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('jsContent'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let bangsal = '';
        flatpickr('.dateflatpickr-pmkp', {
            dateFormat: 'Y-m-d',
            defaultDate: moment().format('YYYY-MM-DD'),
            enableTime: false,
            time_24hr: true,
            onChange: function(selectedDates, dateStr, instance) {
                console.log(selectedDates);
            }
        });


    });



    (function() {


        // =================================================
        $('#tanggal_gizi').val(moment().format('YYYY-MM-DD'))

        $("#btn-search-pmkp").on('click', (function(e) {
            e.preventDefault();
            renderData();

        }));
        $("#btn-search-ralan-pmkp").on('click', (function(e) {
            e.preventDefault();
            renderDataRalan();

        }));


        const renderData = () => {
            let formData = document.querySelector('#formSearchPMKP')
            let dataSend = new FormData(formData)

            let jsonObj = {};

            dataSend.append('isrj', false);
            dataSend.append('mulai', moment().format('YYYY-MM-DD'));

            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            let date = jsonObj.mulai;
            $.ajax({
                url: '<?php echo base_url(); ?>admin/PMKP/renderData',
                type: "POST",
                data: dataSend,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    var name_of_clinic = jsonObj?.klinik
                    var isrj = jsonObj?.isrj
                    if (jsonObj.klinik.includes('%')) {
                        $('#btnInsertForm').prop('disabled', true);
                        $('#btnAnalisisForm').prop('disabled', true);
                        $('#btnGrafikForm').prop('disabled', true);
                        $('#btnCetakForm').prop('disabled', true);
                    } else {
                        $('#btnInsertForm').prop('disabled', false);
                        $('#btnAnalisisForm').prop('disabled', false);
                        $('#btnGrafikForm').prop('disabled', false);
                        $('#btnCetakForm').prop('disabled', false);
                    }
                    let templateHtml = '';
                    templateHtml = dataTemplate({
                        data: res.data,
                        container: templateHtml,
                        table: '#containerTablePMKP'
                    });

                    insertRanap({
                        dataSend: dataSend,
                        name_of_clinic: name_of_clinic
                    })

                    grafikRanap({
                        formulir: res?.formulir,
                        name_of_clinic: name_of_clinic
                    });

                    analisisRanap({
                        name_of_clinic: name_of_clinic,
                        isrj: isrj
                    })

                    cetakRanap({
                        formulir: res?.formulir,
                        name_of_clinic: name_of_clinic
                    })

                },
                error: function() {

                }
            });

        }

        const insertRanap = (props) => {
            let dataSend = props?.dataSend
            $('#btnInsertForm').off().on('click', function(e) {
                $('#modal_formulir_pmkp').modal('show');
                $('#modal_name_of_clinic').text(props?.name_of_clinic.toUpperCase());

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/PMKP/getForm',
                    type: "POST",
                    data: dataSend,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {

                        let dataHtml = '';

                        result.data.forEach((item, index) => {


                            const indicatorsHtml = item.indicators.map(indicator => {

                                return `
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <label class="form-check-label" for="form-${index}-${indicator.indicator_id}">${indicator.indicators}</label>
                                                </td>
                                                <td width="1%" class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="indicators-${item.no_registration}[]" value="${indicator.indicator_id}" id="form-${index}-${indicator.indicator_id}" ${indicator.checked == 1 ? 'checked' : ''}>
                                                </td>
                                            </tr>
                                        `;
                            }).join('');

                            dataHtml += `
                                    
                                    <tr class="table-primary">
                                        <input type="hidden" name="employee_id[]" value="${item.employee_id}">
                                        <input type="hidden" name="clinic_id[]" value="${item.clinic_id}">
                                        <input type="hidden" name="thename[]" value="${item.name}">
                                        <input type="hidden" name="no_registration[]" value="${item.no_registration}">
                                        <th width="1%" class="text-center p-0">${index+1}</th>
                                        <td class="fw-bold" colspan="2"><h5 class="mb-0">${item.name}</h5></td>
                                    </tr>
                                    ${indicatorsHtml}
                                    `;
                        });

                        $('#body_container_pmkp').html(dataHtml);


                        $('#btn_save_form_pmkp').off().on('click', function(e) {
                            let formData = document.querySelector('#formPMKP');
                            let dataSend = new FormData(formData);

                            let employee_id = dataSend.getAll('employee_id[]');
                            let clinic_id = dataSend.getAll('clinic_id[]');
                            let thename = dataSend.getAll('thename[]');
                            let no_registration = dataSend.getAll('no_registration[]');
                            let jsonObj = {};
                            jsonObj.data_pmkp = [];
                            dataSend.forEach((value, key) => {
                                jsonObj[key] = value;
                            });
                            for (let i = 0; i < thename.length; i++) {
                                let entry = {

                                    employee_id: employee_id[i],
                                    clinic_id: clinic_id[i],
                                    thename: thename[i],

                                    no_registration: no_registration[i],
                                    no_registration: no_registration[i],
                                }

                                let indicators = dataSend.getAll(`indicators-${no_registration[i]}[]`);

                                entry.indicators = [];
                                for (let j = 0; j < indicators.length; j++) {
                                    entry.indicators.push(indicators[j]);
                                }
                                jsonObj.data_pmkp.push(entry);
                                delete jsonObj[`indicators-${no_registration[i]}[]`]
                            };
                            delete jsonObj['employee_id[]']
                            delete jsonObj['indicators[]']
                            delete jsonObj['no_registration[]']
                            delete jsonObj['thename[]']
                            delete jsonObj['clinic_id[]']
                            postData(jsonObj, 'admin/PMKP/insertData', (res) => {
                                if (res.status) {
                                    successSwal(res.message);
                                    $('#modal_formulir_pmkp').modal('hide');
                                } else {
                                    errorSwal(res.message);
                                    $('#modal_formulir_pmkp').modal('hide');
                                }
                            });
                        })
                    },
                    error: function() {

                    }
                });
            })
        }

        const grafikRanap = (props) => {
            $('#btnGrafikForm').off().on('click', function(e) {
                let optionFormulir = '';
                $('#select_indicator_formulir').html('');
                $('#select_indicator_formulir').append('<option value="%">Semua</option>');

                props?.formulir.forEach(indicator => {
                    optionFormulir += `<option value="${indicator.indicator_id}">${indicator.indicators}</option>`;
                });
                $('#select_indicator_formulir').append(optionFormulir);

                $('#modal_grafik_pmkp').modal('show');
                filterSelectGrafik();

                $('#btn-search-kategori-pmkp').off().on('click', function(e) {
                    let form = document.querySelector('#form_grafik_search');
                    let dataSend = new FormData(form)
                    let myChart;

                    let jsonObj = {};
                    dataSend.forEach((value, key) => {
                        jsonObj[key] = value;
                    });
                    jsonObj.name_of_clinic = props?.name_of_clinic;

                    postData(jsonObj, 'admin/PMKP/getDataStatistik', (res) => {

                        if (res.respon) {

                            const label_name = res.data.map(item => item.label_name);
                            const capaian = res.data.map(item => item.capaian);

                            var xValues = label_name;
                            var yValues = capaian;

                            if (Chart.getChart("container-grafik-pmkp")) {
                                Chart.getChart("container-grafik-pmkp")?.destroy()
                            }
                            myChart = new Chart("container-grafik-pmkp", {
                                type: "bar",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false,
                                            position: 'top',
                                        },
                                        title: {
                                            display: false,
                                        }
                                    }
                                }
                            });
                        } else {
                            errorSwal(res.message)

                        }
                    });
                })
            })
        }

        const analisisRanap = (props) => {

            $('#btnAnalisisForm').off().on('click', function(e) {
                $('#modal_analisis_pmkp').modal('show');

                filterSelectAnalisis();

                $('#btn-search-analisis-pmkp').off().on('click', function(e) {
                    let form = document.querySelector('#form_analisis_search');
                    let dataSend = new FormData(form)

                    let jsonObj = {};
                    dataSend.forEach((value, key) => {
                        jsonObj[key] = value;
                    });
                    jsonObj.name_of_clinic = props?.name_of_clinic;
                    jsonObj.isrj = props?.isrj;

                    postData(jsonObj, 'admin/PMKP/getDataAnalisis', (result) => {

                        let dataHtml = '';

                        result.data.forEach((item, index) => {
                            dataHtml +=
                                `
                                <tr>
                                    <th class="text-center">${index+1}</th>
                                    <td class="align-middle">${item.indicator_name}</td>
                                    <td class="align-middle text-center">${parseFloat(item?.capaian).toFixed(0)}%</td>
                                    <td class="align-middle text-center">${parseFloat(item.target).toFixed(0)}</td>
                                    <td class="align-middle">${parseFloat(item?.capaian).toFixed(0) == (item.target) ? 'Pertahankan' : 'Tingkatkan'}</td>
                                </tr>
                                `;
                        });
                        $('#container_analisis_pmkp').html(dataHtml)

                    });

                })

            })
        }

        const cetakRanap = (props) => {
            $('#btnCetakForm').off().on('click', function(e) {
                $('#modal_cetak_pmkp').modal('show');
                filterSelectCetak();

                $('#btn-search-cetak-pmkp').off().on('click', function(e) {

                    let form = document.querySelector('#form_cetak_search');
                    let dataSend = new FormData(form)

                    let jsonObj = {};
                    dataSend.forEach((value, key) => {
                        jsonObj[key] = value;
                    });
                    jsonObj.name_of_clinic = props?.name_of_clinic;
                    jsonObj.isrj = props?.isrj;

                    postData(jsonObj, 'admin/PMKP/getDataCetak', (result) => {
                        if (result.respon) {

                            actionCetak({
                                data: result?.data
                            })
                        }

                    });

                })

            })
        }

        const dataTemplate = (props) => {
            const table = $(props?.table).closest('table').DataTable({
                dom: "tr<'row'<'col-sm-4'p><'col-sm-4 text-center'i><'col-sm-4 text-end'l>>",
                stateSave: true,
                "bDestroy": true
            });
            table.clear();
            let dataHtml = '';
            props?.data.forEach((item, index) => {
                const formattedDate = moment(props?.date).format('YYYY-MM-DD')
                dataHtml = `
                    <tr>
                        <input type="hidden" name="visit_id[]" value="${item.visit_id}">
                        <td class="text-center align-middle">${index+1}</td>
                        <td class="text-center align-middle">${item.thename}</td>
                        <td class="text-center align-middle">${item.fullname}</td>
                        <td class="text-center align-middle">${item.name_of_clinic}</td>
                        <td class="text-center align-middle">${item.umur}</td>
                    </tr>
                    `;
                table.row.add($(dataHtml));
            });
            table.draw();

        }

        const actionCetak = (props) => {


            var url = '<?= base_url() . 'admin/PMKP/cetak/'; ?>' + btoa(JSON.stringify(props));
            // Redirect to the URL
            window.open(url, '_blank');
        }

        // ========================= RAWAT JALAN ===============================

        const renderDataRalan = () => {
            let formData = document.querySelector('#formSearchRalanPMKP')
            let dataSend = new FormData(formData)

            let jsonObj = {};

            dataSend.append('isrj', true);
            dataSend.forEach((value, key) => {
                jsonObj[key] = value;
            });
            let date = jsonObj.mulai;
            $.ajax({
                url: '<?php echo base_url(); ?>admin/PMKP/renderDataRalan',
                type: "POST",
                data: dataSend,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    var name_of_clinic = jsonObj?.klinik
                    var isrj = jsonObj?.isrj
                    if (jsonObj.klinik.includes('%')) {
                        $('#btnInsertFormRalan').prop('disabled', true);
                        $('#btnAnalisisFormRalan').prop('disabled', true);
                        $('#btnGrafikFormRalan').prop('disabled', true);
                        $('#btnCetakFormRalan').prop('disabled', true);
                    } else {
                        $('#btnInsertFormRalan').prop('disabled', false);
                        $('#btnAnalisisFormRalan').prop('disabled', false);
                        $('#btnGrafikFormRalan').prop('disabled', false);
                        $('#btnCetakFormRalan').prop('disabled', false);
                    }
                    let templateHtml = '';
                    templateHtml = dataTemplate({
                        data: res.data,
                        container: templateHtml,
                        table: '#containerTablePMKP_ralan'
                    });

                    insertRalan({
                        dataSend: dataSend,
                        name_of_clinic: name_of_clinic
                    });

                    grafikRalan({
                        formulir: res?.formulir,
                        name_of_clinic: name_of_clinic
                    });

                    analisisRalan({
                        name_of_clinic: name_of_clinic,
                        isrj: isrj
                    });
                    cetakRalan({
                        formulir: res?.formulir,
                        name_of_clinic: name_of_clinic
                    })
                },
                error: function() {

                }
            });

        }

        const insertRalan = (props) => {
            let dataSend = props?.dataSend;

            $('#btnInsertFormRalan').off().on('click', function(e) {

                $('#modal_formulir_pmkp').modal('show');
                $('#modal_name_of_clinic').text(props?.name_of_clinic.toUpperCase());

                $.ajax({
                    url: '<?php echo base_url(); ?>admin/PMKP/getForm',
                    type: "POST",
                    data: dataSend,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {



                        let dataHtml = '';

                        result.data.forEach((item, index) => {

                            // Collect the indicators into an array
                            const indicatorsHtml = item.indicators.map(indicator => {

                                return `
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <label class="form-check-label" for="form-${index}-${indicator.indicator_id}">${indicator.indicators}</label>
                                                </td>
                                                <td width="1%" class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="indicators-${item.no_registration}[]" value="${indicator.indicator_id}" id="form-${index}-${indicator.indicator_id}" ${indicator.checked == 1 ? 'checked' : ''}>
                                                </td>
                                            </tr>
                                        `;
                            }).join(''); // Join them into a single string

                            dataHtml += `

                                        <tr class="table-primary">
                                            <input type="hidden" name="employee_id[]" value="${item.employee_id}">
                                            <input type="hidden" name="clinic_id[]" value="${item.clinic_id}">
                                            <input type="hidden" name="thename[]" value="${item.name}">
                                            <input type="hidden" name="no_registration[]" value="${item.no_registration}">
                                            <th width="1%" class="text-center p-0">${index+1}</th>
                                            <td class="fw-bold" colspan="2"><h5 class="mb-0">${item.name}</h5></td>
                                        </tr>
                                        ${indicatorsHtml}
                                    `;
                        });

                        $('#body_container_pmkp').html(dataHtml);
                        $('#btn_save_form_pmkp').off().on('click', function(e) {
                            let formData = document.querySelector('#formPMKP');
                            let dataSend = new FormData(formData);

                            let employee_id = dataSend.getAll('employee_id[]');
                            let clinic_id = dataSend.getAll('clinic_id[]');
                            let thename = dataSend.getAll('thename[]');
                            let no_registration = dataSend.getAll('no_registration[]');
                            let jsonObj = {};
                            jsonObj.data_pmkp = [];
                            dataSend.forEach((value, key) => {
                                jsonObj[key] = value;
                            });
                            for (let i = 0; i < thename.length; i++) {
                                let entry = {

                                    employee_id: employee_id[i],
                                    clinic_id: clinic_id[i],
                                    thename: thename[i],

                                    no_registration: no_registration[i],
                                    no_registration: no_registration[i],
                                }

                                let indicators = dataSend.getAll(`indicators-${no_registration[i]}[]`);

                                entry.indicators = [];
                                for (let j = 0; j < indicators.length; j++) {
                                    entry.indicators.push(indicators[j]); // Push into indicators array
                                }
                                jsonObj.data_pmkp.push(entry);
                                delete jsonObj[`indicators-${no_registration[i]}[]`]
                            };
                            delete jsonObj['employee_id[]']
                            delete jsonObj['indicators[]']
                            delete jsonObj['no_registration[]']
                            delete jsonObj['thename[]']
                            delete jsonObj['clinic_id[]']

                            postData(jsonObj, 'admin/PMKP/insertData', (res) => {
                                if (res.status) {
                                    successSwal(res.message);
                                    $('#modal_formulir_pmkp').modal('hide');
                                } else {
                                    errorSwal(res.message);
                                    $('#modal_formulir_pmkp').modal('hide');
                                }
                            });
                        })

                    },
                    error: function() {

                    }
                });
            })
        }

        const grafikRalan = (props) => {
            $('#btnGrafikFormRalan').off().on('click', function(e) {
                let optionFormulir = '';
                $('#select_indicator_formulir').html('');
                $('#select_indicator_formulir').append('<option value="%">Semua</option>');

                props?.formulir.forEach(indicator => {
                    optionFormulir += `<option value="${indicator.indicator_id}">${indicator.indicators}</option>`;
                });
                $('#select_indicator_formulir').append(optionFormulir); // Append the option to the select

                $('#modal_grafik_pmkp').modal('show');
                filterSelectGrafik();

                $('#btn-search-kategori-pmkp').off().on('click', function(e) {
                    let form = document.querySelector('#form_grafik_search');
                    let dataSend = new FormData(form)
                    let myChart;

                    let jsonObj = {};
                    dataSend.forEach((value, key) => {
                        jsonObj[key] = value;
                    });
                    jsonObj.name_of_clinic = props?.name_of_clinic;

                    postData(jsonObj, 'admin/PMKP/getDataStatistik', (res) => {

                        if (res.respon) {
                            const label_name = res.data.map(item => item.label_name);
                            const capaian = res.data.map(item => item.capaian);
                            var xValues = label_name;
                            var yValues = capaian;

                            if (Chart.getChart("container-grafik-pmkp")) {
                                Chart.getChart("container-grafik-pmkp")?.destroy()
                            }
                            myChart = new Chart("container-grafik-pmkp", {
                                type: "bar",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false,
                                            position: 'top',
                                        },
                                        title: {
                                            display: false,
                                        }
                                    }
                                }

                            });
                        } else {
                            errorSwal(res.message)

                        }
                    });
                })
            })
        }

        const analisisRalan = (props) => {

            $('#btnAnalisisFormRalan').off().on('click', function(e) {
                $('#modal_analisis_pmkp').modal('show');

                filterSelectAnalisis();

                $('#btn-search-analisis-pmkp').off().on('click', function(e) {
                    let form = document.querySelector('#form_analisis_search');
                    let dataSend = new FormData(form)

                    let jsonObj = {};
                    dataSend.forEach((value, key) => {
                        jsonObj[key] = value;
                    });
                    jsonObj.name_of_clinic = props?.name_of_clinic;
                    jsonObj.isrj = props?.isrj;

                    postData(jsonObj, 'admin/PMKP/getDataAnalisis', (result) => {

                        let dataHtml = '';

                        result.data.forEach((item, index) => {
                            dataHtml +=
                                `
                                <tr>
                                    <th class="text-center">${index+1}</th>
                                    <td class="align-middle">${item.indicator_name}</td>
                                    <td class="align-middle text-center">${parseFloat(item?.capaian).toFixed(0)}%</td>
                                    <td class="align-middle text-center">${parseFloat(item.target).toFixed(0)}</td>
                                    <td class="align-middle">${parseFloat(item?.capaian).toFixed(0) == (item.target) ? 'Pertahankan' : 'Tingkatkan'}</td>
                                </tr>
                                `;
                        });
                        $('#container_analisis_pmkp').html(dataHtml)

                    });

                })

            })
        }
        const cetakRalan = (props) => {
            $('#btnCetakFormRalan').off().on('click', function(e) {
                $('#modal_cetak_pmkp').modal('show');
                filterSelectCetak();

                $('#btn-search-cetak-pmkp').off().on('click', function(e) {

                    let form = document.querySelector('#form_cetak_search');
                    let dataSend = new FormData(form)

                    let jsonObj = {};
                    dataSend.forEach((value, key) => {
                        jsonObj[key] = value;
                    });
                    jsonObj.name_of_clinic = props?.name_of_clinic;
                    jsonObj.isrj = props?.isrj;

                    postData(jsonObj, 'admin/PMKP/getDataCetak', (result) => {
                        if (result.respon) {

                            actionCetak({
                                data: result?.data
                            })
                        }

                    });

                })

            })
        }

        const filterSelectGrafik = (props) => {
            $('#select_kategori_grafik').on('change', function(e) {
                if ($('#select_kategori_grafik').val() == 3) {
                    $('#display_select_tahun').show();
                    $('#display_select_bulan').hide();
                } else {
                    $('#display_select_bulan').show();
                    $('#display_select_tahun').hide();
                }
            })
        }

        const filterSelectAnalisis = (props) => {
            $('#select_kategori_analisis').on('change', function(e) {
                if ($('#select_kategori_analisis').val() == 2) {
                    $('#display_select_tahun_analisis').show();
                    $('#display_select_bulan_analisis').hide();
                } else {
                    $('#display_select_bulan_analisis').show();
                    $('#display_select_tahun_analisis').hide();
                }
            })
        }
        const filterSelectCetak = (props) => {
            $('#select_kategori_cetak').on('change', function(e) {
                if ($('#select_kategori_cetak').val() == 2) {
                    $('#display_select_tahun_cetak').show();
                    $('#display_select_bulan_cetak').hide();
                } else {
                    $('#display_select_bulan_cetak').show();
                    $('#display_select_tahun_cetak').hide();
                }
            })
        }

    })()
</script>
<?php $this->endSection(); ?>