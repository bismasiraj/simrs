<?php
$session = session();
$gsPoli = $session->gsPoli;
$permissions = user()->getPermissions();
// dd(isset($permissions['pendaftaranrajal']['c']));
?>

<div class="tab-pane tab-content-height
<?php if ($giTipe == 1 || $giTipe == 2 || $giTipe == 73 || $giTipe == 50 || $giTipe == 5) echo "active"; ?>
" id="rawat_jalan">
    <form id="form1" action="" method="post" class="">
        <div class="box-body row">
            <div class="box-header with-border">
                <!-- <?php if ($title == 'old_patient') { ?>
                    <h3 class="box-title titlefix"><?php echo lang('Word.opd_old_patient'); ?></h3>
                <?php } else { ?>
                    <h3 class="box-title titlefix">Rawat Jalan</h3>

                <?php } ?> -->
            </div>
            <input type="hidden" name="ci_csrf_token" value="">
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Poli</label><small class="req"> *</small>
                    <select id="klinikrajal" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                        <?php if (is_null(user()->employee_id)) { ?>
                            <option value="%">Semua</option>
                        <?php } ?>
                        <?php $cliniclist = array();
                        if ($giTipe != 2 && $giTipe != 5) {
                            foreach ($clinic as $key => $value) {
                                if ($clinic[$key]['stype_id'] == '1')
                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
                            }
                        } else {
                            foreach ($clinic as $key => $value) {
                                if ($clinic[$key]['clinic_id'] == $gsPoli)
                                    $cliniclist[$clinic[$key]['clinic_id']] = $clinic[$key]['name_of_clinic'];
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

            <div class="col-sm-6 col-md-2" <?php if (user()->employee_id != '' && !is_null(user()->employee_id)) { ?> style="display: none;" <?php } ?>>
                <div class="form-group">
                    <label>Dokter</label>
                    <select id="dokter" class="form-control" name="dokter" onchange="showdate(this.value)">
                        <?php if (is_null(user()->employee_id)) { ?>
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
                        } else { ?>
                            <?php $dokterlist = array();
                            foreach ($dokter as $key => $value) {
                                foreach ($value as $key1 => $value1) {
                                    if ($key1 == user()->employee_id) {
                                        $dokterlist[$key1] = $value1;
                                    }
                                }
                            }
                            asort($dokterlist); ?>
                            <?php foreach ($dokterlist as $key => $value) { ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                            <?php } ?>
                        <?php } ?>

                    </select>
                    <span class="text-danger" id="error_doctor"></span>
                </div>
            </div>


            <div class="col-sm-6 col-md-2" style="display: none;">
                <div class="form-group">
                    <label>Rujukan Dari</label>

                    <select name="rujukan" id="rujukan" class="form-control">
                        <option value="%">Semua</option>
                        <?php foreach ($cliniclist as $key => $value) { ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-2" style="display: none;">
                <div class="form-group">
                    <label>Relasi</label>
                    <select name="statuspasien" id="statuspasien" class="form-control">
                        <option value="%">Semua</option>
                        <?php foreach ($statusPasien as $key => $value) {
                            if ($statusPasien[$key]['name_of_status_pasien'] != null && $statusPasien[$key]['name_of_status_pasien'] != '') {
                        ?>
                                <option value="<?= $statusPasien[$key]['status_pasien_id']; ?>"><?= $statusPasien[$key]['name_of_status_pasien']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2" style="display: none;">
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" id="nama" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Nama / Nomor</label>
                    <input type="text" name="norm" id="nama" placeholder="Nama/No.RM/No.SEP/No.BPJS" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2" style="display: none;">
                <div class="form-group">
                    <label>No Kartu/ SEP</label>
                    <input type="text" name="nokartu" id="nama" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2" style="display: none;">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" id="nama" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input id="mulai" name="mulai" placeholder="" type="text" class="form-control" value="<?= date('Y-m-d');; ?>">
                    <span class="text-danger"></span>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#mulai').datetimepicker({
                            format: 'YYYY-MM-DD'
                        });
                    });
                </script>
            </div>

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input id="akhir" name="akhir" placeholder="" type="text" class="form-control" value="<?= date('Y-m-d');; ?>">
                    <span class="text-danger"></span>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#akhir').datetimepicker({
                            format: 'YYYY-MM-DD'
                        });
                    });
                </script>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <button id="form1btn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> Cari</button>
                    <?php if ($giTipe == 0) {
                        if (isset($permissions['pendaftaranrajal']['c'])) {
                            if ($permissions['pendaftaranrajal']['c'] == '1') { ?>
                                <div class="box-tools addmeeting">
                                    <a data-toggle="modal" id="add" onclick="holdModal('myModals')" class="btn btn-primary btn-sm addpatient"><i class="fa fa-plus"></i> <?php echo lang('Word.add_patient'); ?></a>
                                </div>
                    <?php }
                        }
                    } ?>

                </div>
            </div>
        </div>
    </form>
    <div class="box-body">
        <div class="download_label"><?php
                                    if ($title == 'old_patient') {
                                        echo lang('Word.opd_old_patient');
                                    ?>
            <?php
                                    } else {
                                        echo lang('Word.opd_patient');
            ?>

            <?php } ?>
        </div>
        <table class="table table-striped-columns table-borderedcustom table-hover" data-export-title="<?php echo lang('Word.opd_patient'); ?>" style="text-align: center">
            <thead>
                <tr style="text-align: center">
                    <th>Antrian</th>
                    <th>Nama/No RM/<br>Cara Kunjung</th>
                    <th>Tanggal Kunjungan/<br>Tanggal Lahir</th>
                    <th>Asuransi/Gender/<br>Agama</th>
                    <th>Poli/Asal Poli/<br>Dokter</th>
                    <th>No SEP / Rujukan</th>
                    <th>Kelas / Hak Kelas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="bodydata">
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(e) {
        <?php if ($gsPoli != '') { ?>
            $("#klinikrajal").val('<?= $gsPoli; ?>')
        <?php } ?>
        $("#form1btn").trigger('click')
    })
    $("#form1").on('submit', (function(e) {

        e.preventDefault();
        $("#form1btn").button('loading');
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getopddatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#bodydata").html("");
                var stringcolumn = '';
                data.data.forEach((element, key) => {
                    stringcolumn += '<tr class="table tablecustom-light">';
                    element.forEach((element1, key1) => {
                        stringcolumn += "<td>" + element1 + "</td>";
                    });
                    stringcolumn += '</tr>'
                });
                $("#bodydata").html(stringcolumn);
                $("#form1btn").button('reset');
            },
            error: function() {

            }
        });

    }));
</script>