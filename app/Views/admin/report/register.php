<?php

$this->extend('layout/default', [
    'orgunit' => $orgunit,
    'img_time' => $img_time
]) ?>

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
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body pb0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <form id="register" action="" method="post" class="">
                                        <?= csrf_field(); ?>
                                        <div class="box-body row">
                                            <?php
                                            if (isset($mulai) ? $mulai != '0' : true) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label>Mulai Tanggal</label><small class="req"> *</small>
                                                        <input id="mulai" name="mulai" placeholder="" type="text" class="form-control start_date" value="" />
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function() {
                                                        $('#mulai').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });
                                                    });
                                                </script>
                                            <?php } ?>
                                            <?php if (isset($akhir) ? $akhir != '0' : true) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label>Hingga Tanggal</label><small class="req"> *</small>
                                                        <input id="akhir" name="akhir" placeholder="" type="text" class="form-control end_date" value="" />
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function() {
                                                        $('#akhir').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });
                                                    });
                                                </script>
                                            <?php } ?>
                                            <?php
                                            if (isset($customtext)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label><?= $customtextTitle; ?></label><small class="req"> *</small>
                                                        <input id="customtext" name="customtext" placeholder="" type="text" class="form-control start_date" value="" />
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (isset($customtext1)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label><?= $customtext1Title; ?></label><small class="req"> *</small>
                                                        <input id="customtext1" name="customtext1" placeholder="" type="text" class="form-control start_date" value="" />
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if (isset($customtext2)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label><?= $customtext2Title; ?></label><small class="req"> *</small>
                                                        <input id="customtext2" name="customtext2" placeholder="" type="text" class="form-control start_date" value="" />
                                                    </div>
                                                </div>
                                            <?php } ?>


                                            <?php if (!empty($clinic)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label>Poli</label><small class="req"> *</small>
                                                        <select id="klinik" class="form-control" name="clinic_id" autocomplete="off">
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
                                                        <select id="status" class="form-control" name="status_pasien_id">
                                                            <?php foreach ($status as $key => $value) { ?>
                                                                <option value="<?= $value['status_pasien_id']; ?>"><?= $value['name_of_status_pasien']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($visitStatus)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label>Status Kunjung</label><small class="req"> *</small>
                                                        <select id="visitStatus" class="form-control" name="isattended">
                                                            <?php foreach ($visitStatus as $key => $value) { ?>
                                                                <option value="<?= $value['isattended']; ?>"><?= $value['visitstatus']; ?></option>
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
                                                                <option value="<?= $value['kode_kota']; ?>"><?= $value['nama_kota']; ?></option>
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
                                                                <option value="<?= $value['gender']; ?>"><?= $value['name_of_gender']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($regulation)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label>Jenis Barang Berdasarkan UU</label><small class="req"> *</small>
                                                        <select id="regulation" class="form-control" name="regulation">
                                                            <option value="%">Semua</option>
                                                            <?php foreach ($regulation as $key => $value) { ?>
                                                                <option value="<?= $value['regulate_id']; ?>"><?= $value['regulation_type']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($diagnosa)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group"><label for="diag_awal">Diagnosis</label>
                                                        <div class="p-2 select2-full-width">
                                                            <select name="diagnosa_id" class="form-control patient_list_ajax" id="filldiagnosa">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                            <?php if (!empty($itemName)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group"><label for="diag_awal">Nama Barang</label>
                                                        <div class="p-2 select2-full-width">
                                                            <select name="nama_obat" class="form-control patient_list_ajax" id="fillitemname">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                            <?php if (!empty($itemId)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group"><label for="diag_awal">Nama Barang</label>
                                                        <div class="p-2 select2-full-width">
                                                            <select name="brand_id" class="form-control patient_list_ajax" id="fillitemid">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                            <?php if (!empty($dokterfill)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group"><label for="diag_awal">Dokter</label>
                                                        <div class="p-2 select2-full-width">
                                                            <select name="dokter" class="form-control patient_list_ajax" id="filldokter">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                            <?php if (!empty($treatTarif)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label>Transaksi Pembayaran</label><small class="req"> *</small>
                                                        <select id="tarif_id" class="form-control" name="tarif_id">
                                                            <option value="%">Semua</option>
                                                            <?php foreach ($treatTarif as $key => $value) { ?>
                                                                <option value="<?= $value['tarif_id']; ?>"><?= $value['tarif_name']; ?></option>
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
                                                                <option value="<?= $value['shift_id']; ?>"><?= $value['shift_desc']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($custom)) { ?>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class="form-group">
                                                        <label><?= $customTitle; ?></label><small class="req"></small>
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
                                                        <label><?= $customTitle1; ?></label><small class="req"></small>
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
                                                        <label><?= $customTitle2; ?></label><small class="req"></small>
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
                                                        <label><?= $customTitle3; ?></label><small class="req"></small>
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
                                                        <label><?= $customTitle4; ?></label><small class="req"></small>
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
                                                        <select id="tipeantrol" class="form-control" name="tipeantrol">
                                                            <option value="%">Semua</option>
                                                            <option value="1">Mulai Waktu Tunggu Amisi</option>
                                                            <option value="2">Mulai Layan Admisi</option>
                                                            <option value="3">Mulai Tunggu Poli</option>
                                                            <option value="4">Mulai Layan Poli</option>
                                                            <option value="5">Selesai layan poli/mulai tunggu farmasi</option>
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
                                                            usort($kasir, fn ($a, $b) => $a['fullname'] <=> $b['fullname']);
                                                            ?>
                                                            <?php foreach ($kasir as $key => $value) { ?>
                                                                <option value="<?= $value['username']; ?>"><?= $value['fullname']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <?php if (!empty($x)) { ?>
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label>X</label><input type="text" name="topx" id="topx" placeholder="" value="<?= $x; ?>" class="form-control"></div>
                                                </div>
                                            <?php
                                            } ?>

                                            <div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <p></p>
                                                    <button type="submit" id="registersubmit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right"><i class="fa fa-search"></i> <?php echo lang('search'); ?></button>
                                                </div>
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
                            <table class="table table-striped-columns table-bordered table-hover ajaxlist table-borderedcustom" data-export-title="<?php echo lang('Word.opd_patient'); ?>" style="text-align: center">
                                <thead id="headdata" class="thead-dark">


                                </thead>
                                <tbody id="bodydata">
                                </tbody>
                                <tfoot id="footdata">
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php
                    ?>

                </div>
            </div>
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div>
<div class="modal fade" id="collectionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('collection_list'); ?></h4>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="custommodal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-media-content">
            <div class="modal-header modal-media-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modalTitle"></h4>
            </div><!--./modal-header-->
            <div class="scroll-area">
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" id="customtitle"></h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body pb0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-body retrieve-data">
                                        <div class="">
                                            <table class="table table-striped-columns table-bordered table-hover" data-export-title="<?php echo lang('Word.opd_patient'); ?>" style="text-align: center">
                                                <thead id="headcustom">


                                                </thead>
                                                <tbody id="bodycustom">
                                                </tbody>
                                                <tfoot id="footcustom">
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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

        sortOption('status')
        sortOption('visitStatus')


    });

    $("#register").on('submit', (function(e) {

        e.preventDefault();
        $("#registersubmit").button('loading');
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({

            url: '<?php echo base_url(); ?>admin/report/<?= basename($actual_link); ?>post',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#bodydata").html("");
                var stringcolumn = '';
                var footercolumn = '';
                // alert(data.body)
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

                $("#bodydata").html(stringcolumn);
                $("#headdata").html(data.header);
                $("#footdata").html(footercolumn);
                $("#registersubmit").button('reset');
            },
            error: function() {
                $("#registersubmit").button('reset');
            }
        });

    }));
</script>

<?php $this->endSection() ?>


<?php $this->section('jsContent') ?>
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