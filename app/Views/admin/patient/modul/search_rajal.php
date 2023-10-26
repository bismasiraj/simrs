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

<?php if (isset($permissions['pendaftaranrajal']['c'])) {
    if ($permissions['pendaftaranrajal']['c'] == '1') { ?>
        <div class="modal fade" id="myModals" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog pup100" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close pupclose" data-dismiss="modal">&times;</button>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-9">
                                <div class="p-2 select2-full-width">
                                    <select onchange="get_PatientDetailspv(this.value)" class="form-control patient_list_ajax" name='' id="addpatient_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-1">
                                <a data-toggle="modal" id="add" onclick="holdModal('myModalpa')" class="modalbtnpatient"><i class="fa fa-plus"></i> <span><?php echo lang('new_patient'); ?></span></a>
                            </div>
                        </div>
                    </div>

                </div><!--./modal-header-->
                <form id="formaddpv" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                    <div class="pup-scroll-area">
                        <div class="modal-body pt0 pb0">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <input name="no_registration" id="pvno_registration" type="hidden" class="form-control" />
                                    <input name="diantar_oleh" id="pvdiantar_oleh" type="hidden" class="form-control" />
                                    <input name="visitor_address" id="pvvisitor_address" type="hidden" class="form-control" />
                                    <input name="org_unit_code" id="pvorg_unit_code" type="hidden" class="form-control" />
                                    <input name="tgl_lahir" id="pvtgl_lahir" type="hidden" class="form-control" />
                                    <input name="gender" id="pvgender" type="hidden" class="form-control" />
                                    <input name="payor_id" id="pvpayor_id" type="hidden" class="form-control" />
                                    <input name="clinic_id_from" id="pvclinic_id_from" type="hidden" class="form-control" />
                                    <input name="pasien_id" id="pvpasien_id" type="hidden" class="form-control" />
                                    <input name="karyawan" id="pvkaryawan" type="hidden" class="form-control" />
                                    <input name="family_status_id" id="pvfamily_status_id" type="hidden" class="form-control" />
                                    <input name="account_id" id="pvaccount_id" type="hidden" class="form-control" />
                                    <input name="coverage_Id" id="pvcoverage_Id" type="hidden" class="form-control" />
                                    <input name="ageday" id="pvageday" type="hidden" class="form-control" />
                                    <input name="agemonth" id="pvagemonth" type="hidden" class="form-control" />
                                    <input name="ageyear" id="pvageyear" type="hidden" class="form-control" />
                                    <input name="kode_agama" id="pvagama" type="hidden" class="form-control" />
                                    <input name="aktif" id="pvaktif" type="hidden" class="form-control" />
                                    <input name="isrj" id="pvisrj" type="hidden" class="form-control" />

                                    <div class="row row-eq">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <div id="ajax_load"></div>
                                            <div class="row ptt10" id="patientDetails" style="display:none">
                                                <div class="col-lg-12">
                                                    <div class="singlelist24bold pb10">
                                                        <span id="patient_name"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-9" id="pvMyinfo">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <table class="table tablecustom table-bordered mb0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="bolds">No. Peserta</td>
                                                                        <td id="pvkk_no"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">PISA</td>
                                                                        <td id="pvcoverages"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">NIK</td>
                                                                        <td id="pvpasien_id"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Status di Keluarga</td>
                                                                        <td id="pvfamily"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Hak Kelas</td>
                                                                        <td id="pvclass_id"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Tempat Lahir</td>
                                                                        <td id="pvplacebirth"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Tgl Lahir</td>
                                                                        <td id="pvdatebirth"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Umur</td>
                                                                        <td id="pvage"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Jenis Kelamin</td>
                                                                        <td id="pvgender"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Catatan</td>
                                                                        <td id="pvdescription"></td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <table class="table tablecustom tablecustom table-bordered mb0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="bolds">Alamat</td>
                                                                        <td id="pvaddress"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">RT/RW</td>
                                                                        <td id="pvrtrw"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Kel</td>
                                                                        <td id="pvkalurahan"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Kecamatan</td>
                                                                        <td id="pvkecamatan"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Kota/Kab</td>
                                                                        <td id="pvkota"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Prov</td>
                                                                        <td id="pvprov"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Telp/HP</td>
                                                                        <td id="pvphone"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Status</td>
                                                                        <td id="pvstatus"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Kelompok</td>
                                                                        <td id="pvpayor"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <table class="table tablecustom tablecustom table-bordered mb0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="bolds">Ayah</td>
                                                                        <td id="pvayah"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Ibu</td>
                                                                        <td id="pvibu"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Suami/Istri</td>
                                                                        <td id="pvsutri"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Pendidikan</td>
                                                                        <td id="pvedukasi"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Pekerjaan</td>
                                                                        <td id="pvpekerjaan"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Gol Darah</td>
                                                                        <td id="pvgoldar"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Agama</td>
                                                                        <td id="pvagama"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="bolds">Perkawinan</td>
                                                                        <td id="pvperkawinan"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div><!-- ./col-md-9 -->
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <?php $file = "uploads/images/profile_male.png"; ?>
                                                    <img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" id="image" alt="User profile picture">
                                                </div><!-- ./col-md-3 -->
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                </div><!--./col-md-12-->

                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="clinic_id">Tujuan</label>
                                                        <div>
                                                            <select name='clinic_id' id="clinic_id" class="form-control select2 act" style="width:100%">
                                                                <?php $cliniclist = array();
                                                                foreach ($clinic as $key => $value) {
                                                                    if ($clinic[$key]['stype_id'] == '1') {
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
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="employee_id">Dokter</label>
                                                        <div>
                                                            <select name='employee_id' id="employee_id" class="form-control select2 act" style="width:100%">
                                                                <?php $dokterlist = array();
                                                                foreach ($dokter as $key => $value) {
                                                                    if ($key == 'P003') {
                                                                        foreach ($value as $key1 => $value1) {
                                                                            $dokterlist[$key1] = $value1;
                                                                        }
                                                                    }
                                                                }
                                                                asort($dokterlist);
                                                                ?>
                                                                <?php foreach ($dokterlist as $key => $value) { ?>
                                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="kddpjp">Perujuk</label>
                                                        <div>
                                                            <select name='kddpjp' id="kddpjp" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($dpjp as $key => $value) { ?>
                                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="class_id">Kelas</label>
                                                        <div>
                                                            <select name='class_id' id="pvclass_id" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($kelas as $key => $value) { ?>
                                                                    <option value="<?= $kelas[$key]['class_id']; ?>"><?= $kelas[$key]['name_of_class']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="class_id_plafond">Hak Kelas</label>
                                                        <div>
                                                            <select name='class_id_plafond' id="pvclass_id_plafond" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($kelas as $key => $value) { ?>
                                                                    <option value="<?= $kelas[$key]['class_id']; ?>"><?= $kelas[$key]['name_of_class']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="status_pasien_id">Status Bayar</label>
                                                        <div>
                                                            <select name='status_pasien_id' id="status_pasien_id" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($statusPasien as $key => $value) { ?>
                                                                    <option value="<?= $statusPasien[$key]['status_pasien_id']; ?>"><?= $statusPasien[$key]['name_of_status_pasien']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label for="visit_date">Tgl Kunj/SEP</label><input type='text' name="visit_date" class="form-control" id='visit_date' /></div>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            $('#visit_date').datetimepicker({
                                                                format: 'YYYY-MM-DD hh:mm:ss'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group"><label for="booked_date">Booking</label><input type='text' name="booked_date" class="form-control" id='booked_date' /></div>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            $('#booked_date').datetimepicker({
                                                                format: 'YYYY-MM-DD hh:mm:ss'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <label for="kdpoli_eks">Eksekutif</label>
                                                    <div class="form-group">
                                                        <div>
                                                            <select name='kdpoli_eks' id="kdpoli_eks" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Ya</option>
                                                                <option value="0">Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="isnew">Baru</label>
                                                        <div>
                                                            <select name='isnew' id="isnew" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Ya</option>
                                                                <option value="0">Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="cob">COB</label>
                                                        <div>
                                                            <select name='cob' id="cob" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Ya</option>
                                                                <option value="0">Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Catatan</label>
                                                        <textarea name="description" rows="4" class="form-control" autocomplete="off"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="pvbackcharge">Katarak</label>
                                                        <div>
                                                            <select name='backcharge' id="pvbackcharge" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Ya</option>
                                                                <option value="0">Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="way_id">Cara Datang</label>
                                                        <div>
                                                            <select name='way_id' id="way_id" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($way as $key => $value) { ?>
                                                                    <option value="<?= $way[$key]['way_id']; ?>"><?= $way[$key]['way']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="reason_id">Alasan/Lakalantas</label>
                                                        <div>
                                                            <select name='reason_id' id="reason_id" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($reason as $key => $value) { ?>
                                                                    <option value="<?= $reason[$key]['reason_id']; ?>"><?= $reason[$key]['reason']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="isattended">Sudah Dilayani</label>
                                                        <div>
                                                            <select name='isattended' id="isattended" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($isattended as $key => $value) { ?>
                                                                    <option value="<?= $isattended[$key]['isattended']; ?>"><?= $isattended[$key]['visitstatus']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <div>
                                                        <h3>Parameter Lakalantas</h3>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group"><label for="pvvalid_rm_date">Tanggal Kejadian</label><input type='text' name="valid_rm_date" class="form-control" id='pvvalid_rm_date' /></div>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            $('#pvvalid_rm_date').datetimepicker({
                                                                format: 'YYYY-MM-DD hh:mm:ss'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="pvpenjamin">Penjamin Lakalantas</label>
                                                        <div>
                                                            <select name="penjamin" id="pvpenjamin" class="form-control" style="width:100%" multiple>
                                                                <option value="0">Pribadi</option>
                                                                <option value="1">Jasa Raharja PT</option>
                                                                <option value="2">BPJS Ketenagakerjaan</option>
                                                                <option value="3">TASPEN PT</option>
                                                                <option value="4">ASABRI PT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="lokasilaka">Lokasi Laka</label>
                                                        <div class="p-2 select2-full-width">
                                                            <select class="form-control patient_list_ajax" name='pvlokasilaka' id="lokasilaka">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="pvispertarif">Suplesi</label>
                                                        <div>
                                                            <select name='ispertarif' id="pvispertarif" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Ya</option>
                                                                <option value="0">Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="pvtemptrans">No LP</label><input id="pvtemptrans" name="temptrans" type="text" class="form-control" /></div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="pvdelete_sep">Keterangan</label><input id="pvdelete_sep" name="delete_sep" type="text" class="form-control" /></div>
                                                </div>


                                                <div class="col-sm-12 col-xs-12">
                                                    <div>
                                                        <h3>Parameter SEP</h3>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="tujuankunj">Tujuan Kunjungan</label>
                                                        <div>
                                                            <select name="tujuankunj" id="tujuankunj" class="form-control" style="width:100%">
                                                                <option value="0">Normal</option>
                                                                <option value="1">Prosedur</option>
                                                                <option value="2">Konsul Dokter</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="flagprocedure">Procedure</label>
                                                        <div>
                                                            <select name="flagprocedure" id="flagprocedure" class="form-control" style="width:100%">
                                                                <option value="0">Prosedur Tidak Berkelanjutan</option>
                                                                <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                                                <option value="99">-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="kdpenunjang">Penunjang</label>
                                                        <div>
                                                            <select name="kdpenunjang" id="kdpenunjang" class="form-control" style="width:100%">
                                                                <option value="1">Radioterapi</option>
                                                                <option value="2">Kemoterapi</option>
                                                                <option value="3">Rehab Medik</option>
                                                                <option value="4">Rehab Psikososial</option>
                                                                <option value="5">Transfusi Darah</option>
                                                                <option value="6">Pelayanan Gigi</option>
                                                                <option value="7">Laboratorium</option>
                                                                <option value="8">USG</option>
                                                                <option value="9">Farmasi</option>
                                                                <option value="10">Lain-lain</option>
                                                                <option value="11">MRI</option>
                                                                <option value="12">Hemodialisa</option>
                                                                <option value="99">-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-xs-4">
                                                    <div class="form-group"><label for="assesmenpel">Assesment Pelayanan</label>
                                                        <div>
                                                            <select name="assesmenpel" id="assesmenpel" class="form-control" style="width:100%">
                                                                <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                                                                <option value="2">Jam poli telah berakhir pada hari sebelumnya</option>
                                                                <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                                                                <option value="4">Atas Instruksi RS</option>
                                                                <option value="5">Tujuan Kontrol</option>
                                                                <option value="99">-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>






                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <?php
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!--./row-->
                                        </div><!--./col-md-8-->
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-eq ptt10">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="asalrujukan">Asal Rujukan</label>
                                                        <div>
                                                            <select name='asalrujukan' id="asalrujukan" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Faskes 1</option>
                                                                <option value="2">Faskes 2 (RS)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="norujukan">No. Rujukan</label><input id="norujukan" name="norujukan" type="text" class="form-control" /></div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="kdpoli">Poli Rujukan</label>
                                                        <div>
                                                            <select name='kdpoli' id="kdpoli" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($inasisPoli as $key => $value) { ?>
                                                                    <option value="<?= $inasisPoli[$key]['kdpoli']; ?>"><?= $inasisPoli[$key]['nmpoli']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group"><label for="tanggal_rujukan">Tgl Rujukan</label><input type='text' name="tanggal_rujukan" class="form-control" id='tanggal_rujukan' /></div>
                                                    <script type="text/javascript">
                                                        $(function() {
                                                            $('#tanggal_rujukan').datetimepicker({
                                                                format: 'YYYY-MM-DD'
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="ppkrujukan">PPK Rujukan</label>
                                                        <div>
                                                            <select name='ppkrujukan' id="ppkrujukan" class="form-control select2 act" style="width:100%">
                                                                <?php foreach ($inasisFaskes as $key => $value) { ?>
                                                                    <option value="<?= $inasisFaskes[$key]['kdprovider']; ?>"><?= $inasisFaskes[$key]['nmprovider']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="diag_awal">Diagnosis Rujukan</label>
                                                        <div class="p-2 select2-full-width">
                                                            <select class="form-control patient_list_ajax" name='diag_awal' id="diag_awal">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <a data-toggle="modal" id="add" onclick="getRujukan()" class="modalbtnpatient"><i class="fa fa-plus"></i> <span>Get Rujukan</span></a>
                                                </div>
                                                <div class="col-sm-6 col-xs-12" style="display: none;">
                                                    <div class="form-group"><label for="conclusion"></label><input name="conclusion" type="text" class="form-control" /></div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="diagnosa_id">Diagnosis RS</label><input name="diagnosa_id" type="text" class="form-control" /></div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12" style="display: none;">
                                                    <div class="form-group"><label for="kdpoli_from"></label><input name="kdpoli_from" type="text" class="form-control" /></div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <div>
                                                        <h3>Parameter SEP</h3>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="tujuankunj">Tujuan Kunjungan</label>
                                                        <div>
                                                            <select name='tujuankunj' id="tujuankunj" class="form-control select2 act" style="width:100%">
                                                                <option value="0">Normal</option>
                                                                <option value="1">Prosedur</option>
                                                                <option value="2">Konsul Dokter</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="kdpenunjang">Penunjang</label>
                                                        <div>
                                                            <select name='kdpenunjang' id="kdpenunjang" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Radioterapi</option>
                                                                <option value="2">Kemoterapi</option>
                                                                <option value="3">Rehab Medik</option>
                                                                <option value="4">Rehab Psikososial</option>
                                                                <option value="5">Transfusi Darah</option>
                                                                <option value="6">Pelayanan Gigi</option>
                                                                <option value="7">Laboratorium</option>
                                                                <option value="8">USG</option>
                                                                <option value="9">Farmasi</option>
                                                                <option value="10">Lain-lain</option>
                                                                <option value="11">MRI</option>
                                                                <option value="12">Hemodialisa</option>
                                                                <option value="99">-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="flagprocedure">Procedure</label>
                                                        <div>
                                                            <select name='flagprocedure' id="flagprocedure" class="form-control select2 act" style="width:100%">
                                                                <option value="0">Prosedur Tidak Berkelanjutan</option>
                                                                <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                                                                <option value="99">-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <div class="form-group"><label for="assesmentpel">Assesment Pelayanan</label>
                                                        <div>
                                                            <select name='assesmentpel' id="assesmentpel" class="form-control select2 act" style="width:100%">
                                                                <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                                                                <option value="2">Jam poli telah berakhir pada hari sebelumnya</option>
                                                                <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                                                                <option value="4">Atas Instruksi RS</option>
                                                                <option value="5">Tujuan Kontrol</option>
                                                                <option value="99">-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="edit_sep">No. SKDP</label><input id="edit_sep" name="edit_sep" type="text" class="form-control" /></div>
                                                    <a data-toggle="modal" id="add" onclick="insertSKDP()" class="modalbtnpatient"><i class="fa fa-search"></i> <span>SKDP</span></a>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="specimenno">No. SPRI</label><input id="specimenno" name=" specimenno" type="text" class="form-control" /></div>
                                                    <a data-toggle="modal" id="add" onclick="insertSPRI()" class="modalbtnpatient"><i class="fa fa-search"></i> <span>SPRI</span></a>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group"><label for="no_skpinap">SEP RI</label><input id="no_skpinap" name="no_skpinap" type="text" class="form-control" disabled /></div>
                                                </div>
                                                <div class="">
                                                    <div class="col-md-12">
                                                        <div class="dividerhr"></div>
                                                        <h3>SEP</h3>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <a data-toggle="modal" id="addSep" onclick="insertSep()" class="modalbtnpatient"><i class="fa fa-plus"></i> <span>Insert SEP</span></a>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <a data-toggle="modal" id="editSep" onclick="editSep()" class="modalbtnpatient"><i class="fa fa-edit"></i> <span>Edit SEP</span></a>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <a data-toggle="modal" id="deleteSep" onclick="deleteSep()" class="modalbtnpatient"><i class="fa fa-remove"></i> <span>Delete SEP</span></a>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="col-md-12">
                                                        <div class="dividerhr"></div>
                                                        <h3>Follow Up</h3>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <a data-toggle="modal" id="add" onclick="insertSPRI()" class="modalbtnpatient"><i class="fa fa-search"></i> <span>Rujukan</span></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="dividerhr"></div>
                                                </div>


                                            </div>

                                        </div><!--./row-->
                                    </div><!--./col-md-4-->
                                </div><!--./row-->
                            </div><!--./col-md-12-->
                        </div><!--./row-->
                    </div>
            </div>

            <div class="box-footer sticky-footer">
                <div class="pull-right">
                    <button type="submit" id="formaddpvbtn" name="save" data-loading-text="<?php echo lang('processing') ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <span><?php echo lang('save'); ?></span></button>
                </div>
                <div class="pull-right" style="margin-right: 10px; ">
                    <button type="submit" id="formaddpvbtn_save_print" data-loading-text="<?php echo lang('processing') ?>" name="save_print" class="btn btn-info pull-right printsavebtn"><i class="fa fa-print"></i> <?php echo lang('save_print'); ?></button>
                </div>
            </div>
            </form>
        </div>
<?php }
} ?>

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

<script>
    $("#formaddpv").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/addvisit',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.status == "fail") {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    url = '<?= base_url(); ?>' + '/admin/patient/profile/' + data.visit_id
                    $("#myModals").modal("hide")
                    $("#patientDetails").hide();
                    window.open(url)

                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));

    function get_PatientDetailspv(id) {
        var base_url = "<?php echo base_url(); ?>backend/images/loading.gif";
        $("#ajax_load").html("<center><img src='" + base_url + "'/>");
        if (id == '') {
            $("#ajax_load").html("");
            $("#patientDetails").hide();
        } else {
            $.ajax({
                url: baseurl + 'admin/patient/getpatientDetails',
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $("#ajax_load").html("");
                        $("#patientDetails").show();
                        resetModal();
                        skunj = data
                        if (data.ismeninggal == 0) {
                            var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo lang('Word.disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                        } else {
                            var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo lang('Word.enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                        }
                        $("patientid").val(data.no_registration);
                        $("#pvpatient_name").html(data.name_of_pasien + " (" + data.no_registration + ")");
                        $("#pvkk_no").html(data.KK_NO);
                        coverage.forEach((element, index) => {
                            if (index == data.coverage_id) {
                                $("#pvcoverages").html(element);
                            }
                        });
                        $("#pvpasien_id").html(data.pasien_id);
                        kelas.forEach(value => {
                            if (value[0] == data.class_id) {
                                $("#pvclass_id").html(value[1]);
                            }
                        });
                        $("#pvplacebirth").html(data.place_of_birth);
                        $("#pvdatebirth").html(data.date_of_birth.substring(0, 10));
                        $("#pvage").html(data.patient_age);
                        $("#pvdescription").html(data.description);
                        $("#pvaddress").html(data.contact_address);
                        $("#pvrtrw").html(data.rt + " / " + data.rw);
                        kalurahan.forEach(kalvalue => {
                            if (skunj.kal_id == kalvalue[0]) {
                                $("#pvkalurahan").html(kalvalue[1]);
                                kecamatan.forEach(kecvalue => {
                                    if (kecvalue[0] == kalvalue[2]) {
                                        $("#pvkecamatan").html(kecvalue[1]);
                                        kota.forEach(kotavalue => {
                                            if (kecvalue[2] == kotavalue[1]) {
                                                $("#pvkota").html(kotavalue[2]);
                                                prov.forEach(provvalue => {
                                                    if (provvalue[0] == kotavalue[0]) {
                                                        $("#pvprov").html(provvalue[2]);
                                                    }
                                                })
                                            }

                                        });
                                    }
                                });
                            }
                        })

                        $("#pvphone").html(data.phone_number + " / " + data.mobile);
                        statusPasien.forEach(value => {
                            if (value[0] == data.status_pasien_id) {
                                $("#pvstatus").html(value[1]);
                            }
                        });
                        payor.forEach(payorvalue => {
                            if (payorvalue[1] == data.payor_id) {
                                $("#pvpayor").html(payorvalue[3]);
                            }
                        });

                        $("#pvayah").html(data.father);
                        $("#pvibu").html(data.mother);
                        $("#pvsutri").html(data.spouse);
                        education.forEach(value => {
                            if (value[0] == data.education_type_code) {
                                $("#pvedukasi").html(value[1]);
                            }
                        });
                        job.forEach(jobvalue => {
                            if (jobvalue[0] == data.job_id) {
                                $("#pvpekerjaan").html(jobvalue[1]);
                            }
                        });
                        blood.forEach(bloodvalue => {
                            if (bloodvalue[1] == data.blood_type_id) {
                                $("#pvgoldar").html(bloodvalue[0]);
                            }
                        });
                        agama.forEach(agamavalue => {
                            if (agamavalue[0] == data.kode_agama) {
                                $("#pvagama").html(agamavalue[1]);
                            }
                        });
                        marital.forEach(maritalvalue => {
                            if (maritalvalue[0] == data.maritalstatusid) {
                                $("#pvperkawinan").html(maritalvalue[1]);
                            }
                        });
                        gender.forEach(gendervalue => {
                            if (gendervalue[0] == data.gender) {
                                $("#pvgender").html(gendervalue[1]);
                            }
                        });
                        family.forEach(value => {
                            if (value[0] == data.family_status_id) {
                                $("#pvfamily").html(value[1]);
                            }
                        });
                        $("#pvemployee_id").html("");
                        var clinicSelected = 'P003';
                        dokterdpjp.forEach((value, key) => {
                            if (value[0] == clinicSelected) {
                                $("#pvemployee_id").append(new Option(value[2], value[1]));
                            }
                        })


                        $("#pvdiantar_oleh").val(skunj.name_of_pasien);
                        $("#pvno_registration").val(skunj.no_registration);
                        $("#pvvisitor_address").val(skunj.visitor_address);
                        $("#pvorg_unit_code").val(skunj.org_unit_code);
                        $("#pvtgl_lahir").val(skunj.date_of_birth);
                        $("#pvgender").val(skunj.gender);
                        $("#pvpayor_id").val(skunj.payor_id);
                        $("#pvclinic_id_from").val("P000");
                        $("#pvclass_id_plafond").val(skunj.class_id);
                        $("#pvclass_id").val(skunj.class_id);
                        $("#booked_date").val(get_date());
                        $("#visit_date").val(get_date());
                        $("#status_pasien_id").val(skunj.status_pasien_id);
                        $("#clinic_id_from").val('P000');
                        $("#tanggal_rujukan").val(get_date());
                        $("#pvpasien_id").val(skunj.status_pasien_id);
                        var age = getAge(skunj.date_of_birth);
                        $("#pvageyear").val(age.years)
                        $("#pvagemonth").val(age.month)
                        $("#pvageday").val(age.days)
                        $("#pvcoverage_id").val(skunj.coverage_id)
                        $("#pvagama").val(skunj.kode_agama)
                        $("#pvaktif").val(skunj.aktif)
                        $("#pvfamily_status_id").val(skunj.family_status_id)

                        $("#kdpoli_eks").val(0)
                        $("#isnew").val(0)
                        $("#cob").val(0)
                        $("#way_id").val(17)
                        $("#way_id").val(17)
                        $("#isattended").val(0)
                        $("#pvisrj").val(1);


                        $("#formaddpvbtn").removeProp("disabled")
                        $("#formaddpvbtn_save_print").removeProp("disabled")


                        $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fa fa-pencil'></i></a>" + link + "");
                    } else {
                        $("#ajax_load").html("");
                        $("#patientDetails").hide();
                    }

                    // holdModal('myModal');
                    // patientvisit(data.no_registration);
                },
            });
        }

    }
</script>

<script type="text/javascript">
    $("#clinic_id").on("click", function() {
        $("#employee_id").html("");
        var clinicSelected = $("#clinic_id").val();
        dokterdpjp.forEach((value, key) => {
            if (value[0] == clinicSelected) {
                $("#employee_id").append(new Option(value[2], value[1]));
            }
            dpjp.forEach((value, key) => {
                if (key == value[1]) {
                    $("#kddpjp").append(new Option(value, key));
                }
            })
        })
    });
    $("#employee_id").on("click", function() {
        $("#kddpjp").html("");
        var dokterSelected = $("#employee_id").val();
        console.log(dokterSelected)
        dpjp.forEach((value, key) => {
            console.log(key)

            if (key == dokterSelected) {
                $("#kddpjp").append(new Option(value, key));
            }
        })
    });

    function getRujukan() {
        alert("Get Rujukan Berhasil")
        $("#asalrujukan").val(1)
        $("#norujukan").val('0097R0090520B000006')
        $("#kdpoli").val('INT')
        $("#tanggal_rujukan").val('2020-05-19 00:00:00.000')
        $("#ppkrujukan").val('0097B011')
    }

    function insertSep() {
        var clicked_submit_btn = $("#deleterujukan")

        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/deleteRujukan',
            type: "POST",
            data: JSON.stringify({
                'noKartu': $("#pvkk_no").text(),
                "tglSep": "2021-07-30",
                "ppkPelayanan": $("#pvorg_unit_code").val(),
                "jnsPelayanan": $("#pvisrj").val(),
                "klsRawat": {
                    "klsRawatHak": $("#pvclass_id_plafond").val(),
                    "klsRawatNaik": $("#pvclass_id").val(),
                    "pembiayaan": "1",
                    "penanggungJawab": "Pribadi"
                },
                "noMR": $("#pvno_registration").val(),
                "rujukan": {
                    "asalRujukan": $("#asalrujukan").val(),
                    "tglRujukan": $("#tanggal_rujukan").val(),
                    "noRujukan": $("#norujukan").val(),
                    "ppkRujukan": $("#ppkrujukan").val()
                },
                "catatan": "",
                "diagAwal": $("#diag_awal").val(),
                "poli": {
                    "tujuan": $("#clinic_id").val(),
                    "eksekutif": $("#kdpoli_eks").val()
                },
                "cob": {
                    "cob": "0"
                },
                "katarak": {
                    "katarak": $("#pvbackcharge").val()
                },
                "jaminan": {
                    "lakaLantas": "0",
                    "noLP": "12345",
                    "penjamin": {
                        "tglKejadian": "",
                        "keterangan": "",
                        "suplesi": {
                            "suplesi": "0",
                            "noSepSuplesi": "",
                            "lokasiLaka": {
                                "kdPropinsi": "",
                                "kdKabupaten": "",
                                "kdKecamatan": ""
                            }
                        }
                    }
                },
                "tujuanKunj": "0",
                "flagProcedure": "",
                "kdPenunjang": "",
                "assesmentPel": "",
                "skdp": {
                    "noSurat": "0301R0110721K000021",
                    "kodeDPJP": "31574"
                },
                "dpjpLayan": "",
                "noTelp": "081111111101",
                "user": "Coba Ws"
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.metaData.code == '200') {
                    $("#arnorujukan").val("");
                }

            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
                clicked_submit_btn.button('reset');
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        })
        alert("insert SEP Berhasil")
        $("#no_skp").val('0701R0010520V001645')
    }

    function deleteSep() {
        alert("Delete SEP Berhasil")
        $("#no_skp").val('')
    }

    function insertSKDP() {
        alert("Get Nomor SKDP Berhasil")
        $("#edit_sep").val("0701R0010422K002046")
    }

    function insertSPRI() {
        alert("Get Nomor SKDP Berhasil")
        $("#specimenno").val("0701R0010422K002045")
    }
</script>