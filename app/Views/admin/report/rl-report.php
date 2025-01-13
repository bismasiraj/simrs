<?php

$this->extend('layout/basiclayout', [
    'orgunit' => $orgunit,
    'img_time' => $img_time
]) ?>
<?php $this->section('cssContent') ?>
<!-- DataTables -->
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<link href="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
    rel="stylesheet" type="text/css" />
<?php $this->endSection() ?>
<?php $this->section('topbar') ?>
<?php echo view('layout/partials/topbar.php', [
    'title' => $title,
    'pagetitle' => 'dashboard',
    'subtitle' => 'dashboard',
]); ?>
<?php $this->endSection() ?>
<?php $this->section('content') ?>

<style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }

    th {
        text-align: center;
    }
</style>
<?php
$currency_symbol = "Rp. ";
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card rounded-4">
                    <div class="card-body">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $title ?></h3>
                                <div class="box-tools pull-right">
                                </div>
                            </div> -->
                            <div class="box-body pb0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <form id="register" action="" method="post" class="">
                                                <?= csrf_field(); ?>
                                                <div class="box-body row">
                                                    <?php
                                                    if (isset($mulai)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="mb-3">
                                                                <label>Mulai Tanggal</label>
                                                                <div>
                                                                    <div class="input-group" id="mulai">
                                                                        <input type="text" id="mulai-date" name="mulai"
                                                                            class="form-control  dateFlatTime-rl">
                                                                        <!-- <input name="mulai" type="text" class="form-control"
                                                                        placeholder="yyyy-mm-dd"
                                                                        data-date-format="yyyy-mm-dd"
                                                                        data-provide="datepicker"
                                                                        data-date-autoclose="true"
                                                                        data-date-container='#mulai'
                                                                        value="<?= date('Y-m-d'); ?>"> -->
                                                                        <span class="input-group-text"><i
                                                                                class="mdi mdi-calendar"></i></span>
                                                                    </div>
                                                                    <!-- input-group -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (isset($akhir)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="mb-3">
                                                                <label>Hingga Tanggal</label>
                                                                <div>
                                                                    <div class="input-group" id="akhir">
                                                                        <input type="text" id="akhir-date" name="akhir"
                                                                            class="form-control   dateFlatTime-rl">
                                                                        <!-- <input name="akhir" type="text" class="form-control"
                                                                        placeholder="yyyy-mm-dd"
                                                                        data-date-format="yyyy-mm-dd"
                                                                        data-provide="datepicker"
                                                                        data-date-autoclose="true"
                                                                        data-date-container='#akhir'
                                                                        value="<?= date('Y-m-d'); ?>"> -->
                                                                        <span class="input-group-text"><i
                                                                                class="mdi mdi-calendar"></i></span>
                                                                    </div>
                                                                    <!-- input-group -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    if (isset($customtext)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customtextTitle; ?></label><small class="req">
                                                                    *</small>
                                                                <input id="customtext" name="customtext" placeholder=""
                                                                    type="text" class="form-control start_date" value="" />
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    if (isset($customtext1)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customtext1Title; ?></label><small class="req">
                                                                    *</small>
                                                                <input id="customtext1" name="customtext1" placeholder=""
                                                                    type="text" class="form-control start_date" value="" />
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                    if (isset($customtext2)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customtext2Title; ?></label><small class="req">
                                                                    *</small>
                                                                <input id="customtext2" name="customtext2" placeholder=""
                                                                    type="text" class="form-control start_date" value="" />
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($clinic)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Poli</label><small class="req"> *</small>
                                                                <select id="klinik" class="form-control" name="clinic_id"
                                                                    autocomplete="off">
                                                                    <option value="%">Semua</option>
                                                                    <?php $cliniclist = array();
                                                                    foreach ($clinic as $key => $value) {
                                                                        $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
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
                                                    <?php } ?>
                                                    <?php if (!empty($schedule)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Dokter</label>
                                                                <select id="dokter" class="form-control" name="employee_id">
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
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="text-danger" id="error_doctor"></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($status)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Jenis Pasien</label><small class="req"> *</small>
                                                                <select id="statuss" class="form-control"
                                                                    name="status_pasien_id">
                                                                    <?php foreach ($status as $key => $value) { ?>
                                                                        <option value="<?= $value['status_pasien_id']; ?>">
                                                                            <?= $value['name_of_status_pasien']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($visitStatus)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Status Kunjung</label><small class="req"> *</small>
                                                                <select id="visitStatus" class="form-control"
                                                                    name="isattended">
                                                                    <?php foreach ($visitStatus as $key => $value) { ?>
                                                                        <option value="<?= $value['isattended']; ?>">
                                                                            <?= $value['visitstatus']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($kota)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Kab / Kota</label><small class="req"> *</small>
                                                                <select id="kota" class="form-control" name="kota">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($kota as $key => $value) { ?>
                                                                        <option value="<?= $value['kode_kota']; ?>">
                                                                            <?= $value['nama_kota']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($isnew)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Baru / Lama</label><small class="req"> *</small>
                                                                <select id="isnew" class="form-control" name="isnew">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($isnew as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($isrj)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Rajal / Ranap</label><small class="req"> *</small>
                                                                <select id="isrj" class="form-control" name="isrj">
                                                                    <option value="%">Semua</option>
                                                                    <option value="1">Rawat Jalan</option>
                                                                    <option value="0">Rawat Inap</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($sex)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Jenis Kelamin</label><small class="req"> *</small>
                                                                <select id="sex" class="form-control" name="sex">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($sex as $key => $value) { ?>
                                                                        <option value="<?= $value['gender']; ?>">
                                                                            <?= $value['name_of_gender']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($regulation)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Jenis Barang Berdasarkan UU</label><small
                                                                    class="req"> *</small>
                                                                <select id="regulation" class="form-control"
                                                                    name="regulation">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($regulation as $key => $value) { ?>
                                                                        <option value="<?= $value['regulate_id']; ?>">
                                                                            <?= $value['regulation_type']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($goods)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Jenis Barang </label><small class="req"> *</small>
                                                                <select id="goods" class="form-control" name="goods">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($goods as $key => $value) { ?>
                                                                        <option value="<?= $value['isalkes']; ?>">
                                                                            <?= $value['thealkes']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($diagnosa)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group"><label for="diag_awal">Diagnosis</label>
                                                                <div class="p-2 select2-full-width">
                                                                    <select name="diagnosa_id"
                                                                        class="form-control patient_list_ajax"
                                                                        id="filldiagnosa">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($itemName)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group"><label for="diag_awal">Nama
                                                                    Barang</label>
                                                                <div class="p-2 select2-full-width">
                                                                    <select name="nama_obat"
                                                                        class="form-control patient_list_ajax"
                                                                        id="fillitemname">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($itemId)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group"><label for="diag_awal">Nama
                                                                    Barang</label>
                                                                <div class="p-2 select2-full-width">
                                                                    <select name="brand_id"
                                                                        class="form-control patient_list_ajax"
                                                                        id="fillitemid">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($dokterfill)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group"><label for="diag_awal">Dokter</label>
                                                                <div class="p-2 select2-full-width">
                                                                    <select name="dokter"
                                                                        class="form-control patient_list_ajax"
                                                                        id="filldokter">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($employee_allDoctor)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group"><label for="diag_awal">Dokter</label>
                                                                <div class="p-2 select2-full-width mt-n5"
                                                                    style="margin-top: -8px;">
                                                                    <select name="employee_allDoctor"
                                                                        class="form-control patient_list_ajax"
                                                                        id="employee_allDoctor">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if (!empty($fillTop)) { ?>
                                                        <div class="col-sm-1 col-md-1">
                                                            <div class="mb-3">
                                                                <label>Filter Top</label>
                                                                <div>
                                                                    <div class="input-group" id="fill_top">
                                                                        <input type="number" id="fill_top" name="fill_top"
                                                                            class="form-control" value="10">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>


                                                    <?php if (!empty($treatTarif)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Transaksi Pembayaran</label><small class="req">
                                                                    *</small>
                                                                <select id="tarif_id" class="form-control" name="tarif_id">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($treatTarif as $key => $value) { ?>
                                                                        <option value="<?= $value['tarif_id']; ?>">
                                                                            <?= $value['tarif_name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($shift)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Shift</label><small class="req"> *</small>
                                                                <select id="shift" class="form-control" name="shift">
                                                                    <option value="1">Shift Pagi (08.01 sd 14.00)</option>
                                                                    <option value="2">Shift Sore (14.01 sd 20.00)</option>
                                                                    <option value="3">Shift Malam (20.01 sd 08.00)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($shiftdays)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Shift</label><small class="req"> *</small>
                                                                <select id="shift" class="form-control" name="shift">
                                                                    <option value="%">Semua</option>
                                                                    <?php foreach ($shiftdays as $key => $value) { ?>
                                                                        <option value="<?= $value['shift_id']; ?>">
                                                                            <?= $value['shift_desc']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($custom)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customTitle; ?></label><small
                                                                    class="req"></small>
                                                                <select id="custom" class="form-control" name="custom">
                                                                    <?php foreach ($custom as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($custom1)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customTitle1; ?></label><small
                                                                    class="req"></small>
                                                                <select id="custom1" class="form-control" name="custom1">
                                                                    <?php foreach ($custom1 as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($custom2)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customTitle2; ?></label><small
                                                                    class="req"></small>
                                                                <select id="custom2" class="form-control" name="custom2">
                                                                    <?php foreach ($custom2 as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($custom3)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customTitle3; ?></label><small
                                                                    class="req"></small>
                                                                <select id="custom3" class="form-control" name="custom3">
                                                                    <?php foreach ($custom3 as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($custom4)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label><?= $customTitle4; ?></label><small
                                                                    class="req"></small>
                                                                <select id="custom4" class="form-control" name="custom4">
                                                                    <?php foreach ($custom4 as $key => $value) { ?>
                                                                        <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($tipeantrol)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Tipe Layanan</label><small class="req"> *</small>
                                                                <select id="tipeantrol" class="form-control"
                                                                    name="tipeantrol">
                                                                    <option value="%">Semua</option>
                                                                    <option value="1">Mulai Waktu Tunggu Amisi</option>
                                                                    <option value="2">Mulai Layan Admisi</option>
                                                                    <option value="3">Mulai Tunggu Poli</option>
                                                                    <option value="4">Mulai Layan Poli</option>
                                                                    <option value="5">Selesai layan poli/mulai tunggu
                                                                        farmasi</option>
                                                                    <option value="6">Mulai layan farmasi</option>
                                                                    <option value="7">Selesai layan farmasi</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($kasir)) { ?>
                                                        <div class="col-sm-2 col-md-2">
                                                            <div class="form-group">
                                                                <label>Kasir</label><small class="req"> *</small>
                                                                <select id="kasir" class="form-control" name="kasir">
                                                                    <option value="%">Semua</option>
                                                                    <?php
                                                                    usort($kasir, fn($a, $b) => $a['fullname'] <=> $b['fullname']);
                                                                    ?>
                                                                    <?php foreach ($kasir as $key => $value) { ?>
                                                                        <option value="<?= $value['username']; ?>">
                                                                            <?= $value['fullname']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if (!empty($x)) { ?>
                                                        <div class="col-sm-3">
                                                            <div class="form-group"><label>X</label><input type="text"
                                                                    name="topx" id="topx" placeholder="" value="<?= $x; ?>"
                                                                    class="form-control"></div>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                </div>

                                                <div class="row">
                                                    <?php if (!empty($btn_sub)) { ?>
                                                        <div class="col-sm-12">
                                                            <div class="">
                                                                <button type="submit" id="registersubmit" name="search"
                                                                    value="search_filter"
                                                                    class="btn btn-primary btn-sm pull-right"><i
                                                                        class="fa fa-search"></i>
                                                                    <?php echo lang('search'); ?></button>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } ?>
                                                    <div class="my-4 text-center">
                                                        <button id="showReportBtn" type="button"
                                                            class="btn btn-primary waves-effect waves-light"
                                                            data-bs-toggle="modal" data-bs-target="#reportModal">Lihat
                                                            Data</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .retrieve-data {
                                    overflow-x: auto;
                                    overflow-y: auto;
                                }

                                .table-responsive {
                                    width: max-content;
                                    vertical-align: middle;
                                    max-height: 65vh;
                                }

                                table {
                                    /* text-align: left; */
                                    position: relative;
                                }

                                th {
                                    /* background: white; */
                                    position: sticky;
                                    top: 0;
                                }
                            </style>
                            <div class="tabsborderbg"></div>
                            <div class="box-body retrieve-data">
                                <div class="table-responsive">
                                    <table class="table table-hover"
                                        data-export-title="<?php echo lang('Word.opd_patient'); ?>"
                                        style="text-align: center">

                                    </table>
                                </div>
                            </div>
                            <?php
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div>


<!-- sample modal content -->
<div id="reportModal" class="modal fade" tabindex="-1" aria-labelledby="#reportModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="reportModalLabel">
                    <?php echo $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="tableDiv" class="modal-body">

                <table id="reportDataTable" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead id="headdata" class="table-primary">
                        <?php if (isset($header)) { ?>
                            <?= $header; ?>
                        <?php } ?>
                    </thead>
                    <tbody id="bodydata">
                    </tbody>
                    <tfoot id="footdata">
                    </tfoot>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php $this->endSection() ?>


<?php $this->section('jsContent') ?>

<script src="<?php echo base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/libs/pdfmake/build/pdfmake.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/libs/pdfmake/build/vfs_fonts.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
</script>


<!-- <script src="<?php echo base_url(); ?>assets/js/pages/datatables.init.js"></script> -->
<script type="text/javascript">
    var dttable = $('#reportDataTable').DataTable({
        // dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
        dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"l><"datatablesjmlshow">>',
        lengthChange: true,
        buttons: ['copy', {
            text: 'Exel',
            action: function(e, dt, node, config) {
                var nameprint = '<?= $title; ?>';
                fnPrintExcel(nameprint, 'reportDataTable');
            }
        }, {
            text: 'PDF',
            action: function(e, dt, node, config) {
                var nameprint = '<?= $title; ?>';
                fnPrintPdf(nameprint, 'reportDataTable');
            }
        }, {
            extend: 'print',
            title: '<?= $title; ?>',
            customize: function(win) {
                // console.log(win);

                var head = $('#reportDataTable').find('thead').clone();
                $(win.document.body).find('thead').replaceWith(head);
            }
        }],
        title: '<?= $title; ?>',

        aaSorting: [],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All']
        ]

    });
    var date_format_new = '';
    var dokterdpjp = new Array();
    var skunj = new Array();
    <?php $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

    <?php
    if (!empty($schedule)) {


        asort($dokter);
        foreach ($dokter as $key => $value) {
            foreach ($value as $key1 => $value1) {
    ?>
                dokterdpjp.push(['<?= $key; ?>', '<?= $key1; ?>', '<?= $value1; ?>']);
    <?php
            }
        }
    }
    ?>

    function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function sortOption(id) {
        var options = $('#' + id + ' option');
        var arr = options.map(function(_, o) {
            return {
                t: $(o).text(),
                v: o.value
            };
        }).get();
        arr.sort(function(o1, o2) {
            return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
        });
        options.each(function(i, o) {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
        });
        $("#" + id).prepend(new Option('Semua', '%'));
        $("#" + id).val('%');
    }
    <?php if (!empty($schedule)) { ?>
        $("#klinik").on("click", function() {
            $("#dokter").html("");
            var clinicSelected = $("#klinik").val();
            dokterdpjp.forEach((value, key) => {
                if (value[0] == clinicSelected || clinicSelected == '%') {
                    $("#dokter").append(new Option(value[2], value[1]));
                }
            })

            sortOption('dokter')
        });
    <?php } ?>
    $(document).ready(function() {

        // sortOption('status')
        // sortOption('visitStatus')
        const StartToday = moment(new Date()).format("DD/MM/YYYY");
        const today = moment(new Date()).format("DD/MM/YYYY");

        $("#mulai-date").val(StartToday);
        $("#akhir-date").val(today);


        $("#mulai-date").on('change', function() {
            const startDate = $(this).val();
            const endDate = $("#akhir-date").val();


            const formattedStartDate = convertDateRl(startDate);
            const formattedEndDate = convertDateRl(endDate);


            if (formattedEndDate && moment(formattedEndDate).isBefore(moment(formattedStartDate))) {

                $("#akhir-date").val(moment(formattedStartDate).format("DD/MM/YYYY"));
            }

            $("#akhir-date").attr('min', formattedStartDate);
        });



        $("#akhir-date").on('change', function() {
            const startDate = $("#mulai-date").val();
            const endDate = $(this).val();

            const formattedStartDate = convertDateRl(startDate);
            const formattedEndDate = convertDateRl(endDate);

            if (formattedEndDate && formattedEndDate < formattedStartDate) {
                errorSwal("End date cannot be earlier than start date!");

                $(this).val(moment(formattedStartDate).format("DD/MM/YYYY"));
            }
        });



        flatpickr(".dateFlatTime-rl", {
            enableTime: false,
            dateFormat: "d/m/Y",

            onChange: function(selectedDates, dateStr, instance) {}
        });
        $(".dateFlatTime-rl").prop("readonly", false)

    });

    const convertDateRl = (dateString) => {
        const formats = ["YYYY-MM-DD", "DD/MM/YYYY", "YYYY-MM-DD HH:mm", "DD/MM/YYYY HH:mm"];
        const parsedDate = moment(dateString, formats, true);
        if (parsedDate.isValid()) {
            return parsedDate.format("YYYY-MM-DD");
        } else {
            return null;
        }
    };

    <?php if (empty($btn_sub)) { ?>
        $("#showReportBtn").click(function() {
            $("#register").submit();
        });
    <?php } ?>

    $("#register").on('submit', (function(e) {
        e.preventDefault();
        $("#registersubmit").html('<i class="spinner-border spinner-border-sm"></i>')
        const formData = new FormData(this);
        const startDate = formData.get('mulai');
        const endDate = formData.get('akhir');
        if (startDate) {
            const formattedStartDate = convertDateRl(startDate);
            formData.set('mulai', formattedStartDate);
        }
        if (endDate) {
            const formattedEndDate = convertDateRl(endDate);
            formData.set('akhir', formattedEndDate);
        }
        $.ajax({
            url: '<?php echo base_url(); ?>admin/report/<?= basename($actual_link); ?>post',
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var stringcolumn = '';
                var footercolumn = '';
                var newDataTableVar;
                // alert(data.body)
                dttable.clear()
                let headerElements = $.parseHTML(data.header);

                if (typeof data.header !== 'undefined') {
                    $("#tableDiv").html("")
                    $("#tableDiv").append(
                        '<table id="reportDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> <thead id = "headdata"class = "table-primary" ></thead> <tbody id = "bodydata" ></tbody> <tfoot id = "footdata" ></tfoot> </table>'
                    )
                    $("#headdata").append(data.header)

                    var fileTitle = $("#custom").text()
                    var newDataTableVar = $('#reportDataTable').DataTable({
                        dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"l><"datatablesjmlshow">>',
                        // dom: '<"mb-3"B>rt<"bottom"<"left-col-datatable"p><"center-col-datatable"i><"right-col-datatable"<"datatablestextshow"><"datatablesjmlshow"l><"datatablestextentries">>>',
                        lengthChange: true,
                        buttons: ['copy', {
                            text: 'Exel',
                            action: function(e, dt, node, config) {
                                var nameprint = '<?= $title; ?>';
                                fnPrintExcel(nameprint, 'reportDataTable');
                            }
                        }, {
                            text: 'PDF',
                            action: function(e, dt, node, config) {
                                var nameprint = '<?= $title; ?>';
                                fnPrintPdf(nameprint, 'reportDataTable');
                            }
                        }, {
                            extend: 'print',
                            title: fileTitle + ' - <?= $title; ?>',
                            customize: function(win) {
                                // console.log(win);

                                var head = $('#reportDataTable').find('thead')
                                    .clone();
                                $(win.document.body).find('thead').replaceWith(
                                    head);
                            }

                        }],
                        aaSorting: [],
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All']
                        ]

                    });

                } else {
                    newDataTableVar = dttable;
                }
                data.body.forEach((element, key) => {
                    // console.log(element)
                    // �['2023-08-05', 'BHP1196', 'Cystofix set FR10,8cm', '1.00', 'Pcs', `<button type="button" onclick="rinciObatAlkes('247�ff"><i class="fa fa-search"></i> Rincian</button>`]
                    // ['UMUM', 126, 576, 169, 283, 124, 293, 114, 576, 0]
                    var arhasil = ['2023-08-05', 'BHP1196', 'Cystofix set FR10,8cm', '1.00',
                        'Pcs',
                        `<button type="button" onclick="rinciObatAlkes('247�ff"><i class="fa fa-search"></i> Rincian</button>`,
                        '2023-08-05', '2023-08-05', '2023-08-05', '2023-08-05'
                    ];
                    newDataTableVar.row.add(element).draw()
                });
                if (typeof data.footer !== 'undefined') {
                    data.footer.forEach((element, key) => {
                        footercolumn += '<tr class="table-light">';
                        element.forEach((element1, key1) => {
                            footercolumn += "<td style='padding: 20px'>" +
                                element1 + "</td>";
                        });
                        footercolumn += '</tr>'

                    });
                }

                $("#footdata").html(footercolumn);
                $("#registersubmit").html(
                    '<button type="submit" id="registersubmit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> search</button>'
                )


                <?php if (!empty($btn_sub)) { ?>
                    $('#showReportBtn').click()
                <?php } ?>

            },
            error: function() {
                $("#registersubmit").html(
                    '<button type="submit" id="registersubmit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> search</button>'
                )

            }
        });
    }));

    function getBase64FromUrl(url) {
        return fetch(url)
            .then((response) => response.blob())
            .then((blob) => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onloadend = () => resolve(reader.result);
                    reader.onerror = reject;
                    reader.readAsDataURL(blob);
                });
            });
    }

    const fnPrintPdf = (nameprint, table_id) => {
        const currentUrl = window.location.href;

        var doc = new jsPDF(currentUrl.split('/report/')[1] === "rl_4_A" ? "l" : "p", "pt", "a4");

        getBase64FromUrl('<?= base_url('assets/img/logo.png') ?>')
            .then((base64Logo) => {
                doc.addImage(base64Logo, 'PNG', 40, 20, 70, 70);

                doc.setFontSize(12);
                doc.text('<?= @$kop['name_of_org_unit'] ?>', (doc.internal.pageSize.width / 2) - 170, 40, {
                    align: 'center'
                });

                doc.setFontSize(10);
                doc.text('<?= @$kop['contact_address'] ?>', (doc.internal.pageSize.width / 2) - 170, 60, {
                    align: 'center'
                });


                getBase64FromUrl('<?= base_url('assets/img/kemenkes.png') ?>')
                    .then((base64Kemenkes) => {
                        doc.addImage(base64Kemenkes, 'PNG', doc.internal.pageSize.width - 110, 20, 70, 70);

                        doc.autoTable({
                            html: `#${table_id}`,
                            startY: 120,
                            theme: 'grid',
                            columnStyles: {
                                0: {
                                    halign: "center"
                                },
                            },
                            // fontSize: 8,
                            bodyStyles: {
                                minCellHeight: 30,
                                valign: "middle",
                            },
                            styles: {
                                lineWidth: 0.5,
                                lineColor: [0, 0, 0],
                                fillColor: [255, 255, 255],
                                textColor: [0, 0, 0],
                            },
                            headStyles: {
                                fillColor: [16, 180, 174],
                                textColor: [0, 0, 0],
                                halign: 'center',
                                valign: 'middle',
                            },
                            didDrawCell: function(data) {
                                if (data.column.dataKey === 5 && data.cell.section ===
                                    "body") {
                                    doc.autoTable({
                                        startY: data.cell.y + 2,
                                        margin: {
                                            left: data.cell.x + data.cell
                                                .padding("left")
                                        },
                                        tableWidth: "wrap",
                                        styles: {
                                            lineWidth: 0.2,
                                            lineColor: [0, 0, 0],
                                        },
                                    });
                                }
                            },
                        });

                        doc.save(`${nameprint}.pdf`);

                    });
            })
            .catch((err) => {
                console.error('Gagal mengonversi gambar ke base64:', err);
            });
    };

    const fnPrintExcel = (nameprint, table_id) => {
        let tab_text = "<table border='2px'><tr>";
        const tab = document.getElementById(table_id);

        for (let j = 0; j < tab.rows.length; j++) {
            tab_text += "<tr>" + tab.rows[j].innerHTML + "</tr>";
        }

        tab_text += "</table>";

        const myBlob = new Blob([tab_text], {
            type: "application/vnd.ms-excel"
        });
        const url = window.URL.createObjectURL(myBlob);
        const a = document.createElement("a");

        document.body.appendChild(a);
        a.href = url;
        a.download = `${nameprint}.xls`;
        a.click();

        setTimeout(() => {
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }, 0);

        return true;
    };





    // $("#showReportBtn").click(function() {
    //     $("#register").submit();
    // });
</script>
<?php if (!empty($diagnosa)) { ?>
    <script type="text/javascript">
        $('#filldiagnosa').select2({
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDiagnosisListAjax',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
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
    </script>
<?php } ?>
<?php if (!empty($itemName)) { ?>
    <script type="text/javascript">
        $('#fillitemname').select2({
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatNameListAjax',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
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
    </script>
<?php } ?>
<?php if (!empty($dokterfill)) { ?>
    <script type="text/javascript">
        $('#filldokter').select2({
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getDokterListAjax',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
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
    </script>
<?php } ?>
<?php if (!empty($employee_allDoctor)) { ?>
    <script>
        let employee_allDoctor = <?= json_encode($employee_allDoctor); ?>;

        employee_allDoctor.unshift({
            id: '%',
            text: 'Semua'
        });

        $('#employee_allDoctor').select2({
            placeholder: 'Pilih Dokter',
            allowClear: false,
            width: '100%',
            data: employee_allDoctor
        });

        $('#employee_allDoctor').val('%').trigger('change');
    </script>

<?php } ?>

<?php if (!empty($itemName)) { ?>
    <script type="text/javascript">
        function rinciObatAlkes(id, namaobat, tgl) {
            $("#rinci" + id).button('loading');
            // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
            $.ajax({

                url: '<?php echo base_url(); ?>admin/report/<?= basename($actual_link); ?>rincipost',
                type: "POST",
                data: JSON.stringify({
                    'description': namaobat,
                    'tgl': tgl,
                    'clinic': $("#klinik").val(),
                    'isrj': $("#isrj").val()
                }),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#bodycustom").html("");
                    var stringcolumn = '';
                    var footercolumn = '';
                    alert(data.body)
                    data.body.forEach((element, key) => {
                        stringcolumn += '<tr class="table-light">';
                        element.forEach((element1, key1) => {
                            stringcolumn += "<td style='padding: 20px'>" + element1 + "</td>";
                        });
                        stringcolumn += '</tr>'

                    });
                    if (typeof data.footer !== 'undefined') {
                        data.footer.forEach((element, key) => {
                            footercolumn += '<tr class="table-light">';
                            element.forEach((element1, key1) => {
                                footercolumn += "<td style='padding: 20px'>" + element1 + "</td>";
                            });
                            footercolumn += '</tr>'

                        });
                    }

                    $("#customtitle").html("Rincian Pasien Pengguna <p>" + namaobat + "</p>")

                    $("#bodycustom").html(stringcolumn);
                    $("#headcustom").html(data.header);
                    $("#footcustom").html(footercolumn);
                    $("#custommodal").modal('show')
                    $("#rinci" + id).button('reset');
                },
                error: function() {
                    $("#rinci" + id).button('reset');
                }
            });
        }
    </script>
<?php } ?>
<?php if (!empty($itemId)) { ?>
    <script type="text/javascript">
        $('#fillitemid').select2({
            ajax: {
                url: '<?= base_url(); ?>admin/patient/getObatIdListAjax',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
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
    </script>
<?php } ?>
<?php $this->endSection() ?>