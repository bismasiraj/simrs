<div class="tab-pane tab-content-height
<?php if ($giTipe == 3) echo "active"; ?>
" id="rawat_inap">
    <form id="form2" action="" method="post" class="">
        <div class="box-body row">
            <input type="hidden" name="ci_csrf_token" value="">
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Bangsal</label><small class="req"> *</small>
                    <select id="iklinik" class="form-control" name="klinik" onchange="showdate(this.value)" autocomplete="off">
                        <option value="%">Semua</option>
                        <?php $cliniclist = array();
                        foreach ($clinic as $key => $value) {
                            if ($clinic[$key]['stype_id'] == '3') {
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

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Dokter</label>
                    <select id="idokter" class="form-control" name="dokter" onchange="showdate(this.value)">
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


            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Rujukan Dari</label>

                    <select name="rujukan" id="irujukan" class="form-control">
                        <option value="%">Semua</option>
                        <?php foreach ($cliniclist as $key => $value) { ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Relasi</label>
                    <select name="statuspasien" id="istatuspasien" class="form-control">
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
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" id="inama" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>No RM</label>
                    <input type="text" name="norm" id="inorm" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>No Kartu/ SEP</label>
                    <input type="text" name="nokartu" id="inokartu" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="address" id="iaddress" placeholder="" value="" class="form-control">
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input id="imulai" name="mulai" placeholder="" type="text" class="form-control" value="<?= date('Y-m-d');; ?>" readonly>
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
                    <input id="iakhir" name="akhir" placeholder="" type="text" class="form-control" value="<?= date('Y-m-d');; ?>">
                    <span class="text-danger"></span>
                </div>
                <script type="text/javascript">
                    $(function() {
                        $('#iakhir').datetimepicker({
                            format: 'YYYY-MM-DD'
                        });
                    });
                </script>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group">
                    <label>Status Rawat Inap</label>
                    <select name="keluar_id" id="icarakeluar" class="form-control">
                        <?php foreach ($caraKeluar as $key => $value) {
                        ?>
                            <option value="<?= $caraKeluar[$key]['keluar_id']; ?>"><?= $caraKeluar[$key]['cara_keluar']; ?></option>
                        <?php
                        } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button id="form2btn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
        <!-- <div class="box-body row">

        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div> -->
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
        <table class="table table-striped-columns table-borderedcustom table-hover" data-export-title="<?php echo lang('Word.ipd_patient'); ?>" style="text-align: center">
            <thead>
                <style>
                    thead tr th {
                        text-align: center !important;
                    }
                </style>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>No RM - Nama</th>
                    <th>Status/JK</th>
                    <th>Pelayanan/Dokter/HP/Phone</th>
                    <th>Rujukan dari/Tgl Masuk s/d Tgl Keluar</th>
                    <th>No Tgl Lahir - Umur</th>
                    <th>Ditagihkan ke Kelas / Hak Kelas</th>
                </tr>
            </thead>
            <tbody id="bodydata2">
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $("#form2").on('submit', (function(e) {

        e.preventDefault();
        $("#form2btn").button('loading');
        // initDatatable('ajaxlist', 'admin/patient/getopddatatable', new FormData(this), [], 100);
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getipddatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#bodydata2").html("");
                var stringcolumn = '';
                data.data.forEach((element, key) => {
                    stringcolumn += '<tr class="table tablecustom-light">';
                    element.forEach((element1, key1) => {
                        stringcolumn += "<td>" + element1 + "</td>";
                    });
                    stringcolumn += '</tr>'

                });
                $("#bodydata2").html(stringcolumn);
                $("#form2btn").button('reset');
            },
            error: function() {

            }
        });

    }));
</script>