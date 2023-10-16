<?php

$permissions = user()->getPermissions();
?>
<div class="box-body">
    <div class="box-tools pull-right">
        <?php if (isset($permissions['biodatapasien']['c'])) {
            if ($permissions['biodatapasien']['c'] == '1') { ?>
                <a data-toggle="modal" onclick="holdModal('myModalpa')" id="addp" class="btn btn-primary btn-sm newpatient"><i class="fa fa-plus"></i> <?php echo lang('Word.add_new_patient'); ?></a>
        <?php }
        } ?>
    </div>
    <form id="formbiodata" action="" method="post" class="">
        <div class="col-sm-3">
            <?php if (isset($permissions['biodatapasien']['r'])) {
                if ($permissions['biodatapasien']['r'] == '1') {  ?>
                    <div class="form-group">
                        <label>Nama Pasien / No RM</label>
                        <div class="input-group">
                            <input type="text" name="search_text" id="nama" placeholder="" value="" class="form-control">
                            <span class="input-group-btn">
                                <button id="formbiodatabtn" type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </div>
            <?php
                }
            } ?>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
            </div>
        </div>
    </form>

    <!-- <div class="">
                            <button type="submit" class="btn btn-primary pull-right btn-sm mt10 delete_selected" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> "><i class="fa fa-trash"></i> <?php echo lang('Word.delete_selected'); ?></button>
                        </div> -->
    <style>
        .ajaxlist {
            text-align: center;
        }
    </style>
    <table class="table table-striped table-borderedcustom table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
        <thead>
            <tr>
                <th><input type="checkbox" name="checkAll"> #</th>
                <th><?php echo lang('Word.patient_name'); ?></th>
                <th><?php echo lang('Word.age'); ?></th>
                <th><?php echo lang('Word.gender'); ?></th>
                <th><?php echo lang('Word.phone'); ?></th>
                <th><?php echo lang('Word.guardian_name'); ?></th>
                <th><?php echo lang('Word.address'); ?></th>
                <th><?php echo lang('Word.dead'); ?></th>
                <?php if (!empty($fields)) {
                    foreach ($fields as $fields_key => $fields_value) {
                ?>
                        <th><?php echo ucfirst($fields_value->name); ?></th>
                <?php }
                } ?>
                <th class="noExport"><?php echo lang('Word.action'); ?></th>
            </tr>
        </thead>
        <tbody class="ajaxlist">
        </tbody>
    </table>
    <!-- </form> -->
</div>

<?php if (isset($permissions['biodatapasien']['r'])) {
    if ($permissions['biodatapasien']['r'] == '1') {  ?>
        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog pup100" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close" data-placement="bottom" data-toggle="tooltip" title="<?php echo lang('Word.close'); ?>" data-dismiss="modal">&times;</button>

                        <div class="modalicon">

                            <div id='edit_delete'>
                                <a href="#" data-placement="bottom" data-toggle="tooltip" title="<?php echo lang('Word.edit'); ?>"><i class="fa fa-pencil"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo lang('Word.delete'); ?>"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        <h4 class="modal-title" id="modal_head"></h4>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="form-group15">
                                </div>
                            </div><!--./col-sm-4-->
                        </div><!-- ./row -->
                    </div><!--./modal-header-->
                    <div class="pup-scroll-area">
                        <div class="modal-body pt0 pb0">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form id="formadd" accept-charset="utf-8" action="<?php echo base_url() . "admin/patient" ?>" enctype="multipart/form-data" method="post">
                                        <input class="" name="id" type="hidden" id="patientid">
                                        <div class="row row-eq">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="row ptt10">
                                                    <div class="col-lg-12">
                                                        <div class="singlelist24bold pb10">
                                                            <span id="patient_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xs-9" id="Myinfo">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <table class="table tablecustom table-bordered mb0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="bolds">No. Peserta</td>
                                                                            <td id="kk_no"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">PISA</td>
                                                                            <td id="coverages"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">NIK</td>
                                                                            <td id="pasien_id"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Status di Keluarga</td>
                                                                            <td id="family"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Hak Kelas</td>
                                                                            <td id="class_id"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Tempat Lahir</td>
                                                                            <td id="placebirth"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Tgl Lahir</td>
                                                                            <td id="datebirth"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Umur</td>
                                                                            <td id="age"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Jenis Kelamin</td>
                                                                            <td id="gender"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Catatan</td>
                                                                            <td id="description"></td>
                                                                        </tr>


                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <table class="table tablecustom table-bordered mb0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="bolds">Alamat</td>
                                                                            <td id="address"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">RT/RW</td>
                                                                            <td id="rtrw"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Kel</td>
                                                                            <td id="kalurahan"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Kecamatan</td>
                                                                            <td id="kecamatan"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Kota/Kab</td>
                                                                            <td id="kota"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Prov</td>
                                                                            <td id="prov"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Telp/HP</td>
                                                                            <td id="phone"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Status</td>
                                                                            <td id="status"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Kelompok</td>
                                                                            <td id="payor"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                                <table class="table tablecustom table-bordered mb0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="bolds">Ayah</td>
                                                                            <td id="ayah"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Ibu</td>
                                                                            <td id="ibu"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Suami/Istri</td>
                                                                            <td id="sutri"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Pendidikan</td>
                                                                            <td id="edukasi"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Pekerjaan</td>
                                                                            <td id="pekerjaan"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Gol Darah</td>
                                                                            <td id="goldar"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Agama</td>
                                                                            <td id="agama"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Perkawinan</td>
                                                                            <td id="perkawinan"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div><!-- ./col-md-9 -->

                                                    <style>
                                                        #imagebiodata img {
                                                            width: 300px !important;
                                                            height: auto;
                                                        }
                                                    </style>
                                                    <div class="col-lg-3 col-md-3 col-sm-12" id="imagebiodata">


                                                    </div><!-- ./col-md-3 -->
                                                </div>
                                                <div id="visit_report_id"></div>
                                            </div><!--./col-md-8-->
                                        </div><!--./row-->
                                    </form>
                                </div><!--./col-md-12-->
                            </div><!--./row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>
<?php if (isset($permissions['biodatapasien']['u'])) {
    if ($permissions['biodatapasien']['u'] == '1') {  ?>
        <div class="modal fade" id="editModal" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo lang('Word.patient_details'); ?></h4>
                    </div><!--./modal-header-->
                    <form id="formeditpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                        <div class="modal-body pt0 pb0">
                            <input id="eupdateid" name="updateid" placeholder="" type="hidden" class="form-control" value="" />
                            <div class="row">
                                <input id="eno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pasien</label><small class="req"> *</small>
                                        <input id="enama" name="nama" placeholder="" type="text" class="form-control" value="" />
                                        <span class="text-danger"><?php //echo form_error('name'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="text" name="pasien_id" id="epasien_id" placeholder="" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> <?php echo lang('Word.gender'); ?></label>
                                                <select class="form-control" name="gender" id="egenders">
                                                    <?php foreach ($gender as $key => $value) { ?>
                                                        <option value="<?php echo $gender[$key]['gender']; ?>"><?php echo $gender[$key]['name_of_gender']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="edatebirth">Tanggal Lahir</label>
                                                <input type='text' name="datebirth" class="form-control" id='edatebirth' />
                                            </div>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#edatebirth').datetimepicker({
                                                        format: 'YYYY-MM-DD'
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label><small class="req"> *</small>
                                                <input type="text" name="placebirth" id="eplacebirth" placeholder="" value="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./col-md-6-->
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Darah</label>
                                                <select class="form-control" id="egoldar" name="goldar">
                                                    <?php foreach ($blood as $key => $value) { ?>
                                                        <option value="<?php echo $blood[$key]['blood_type_id']; ?>"><?php echo $blood[$key]['name_of_type']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                            ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="pwd"><?php echo lang('Word.marital_status'); ?></label>
                                                <select name="perkawinan" id="eperkawinan" class="form-control">
                                                    <?php
                                                    foreach ($marital as $key => $value) {
                                                    ?>
                                                        <option value="<?php echo $marital[$key]['maritalstatusid']; ?>"><?php echo $marital[$key]['name_of_maritalstatus']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">
                                                    <?php echo lang('Word.patient_photo'); ?>
                                                </label>
                                                <div>
                                                    <input class="filestyle form-control-file" type='file' name='file' id="exampleInputFile" size='20' data-height="26" data-default-file="<?php echo base_url() ?>uploads/patient_images/no_image.png">
                                                </div>
                                                <span class="text-danger"><?php //echo form_error('file'); 
                                                                            ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./col-md-6-->
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="pwd">No Telp</label>
                                        <input id="ephone" autocomplete="off" name="phone" type="text" placeholder="" class="form-control" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>HP</label>
                                        <input type="text" placeholder="" id="emobile" value="" name="mobile" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input name="address" id="eaddress" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select class="form-control" id="eprov" name="prov">
                                                    <option value=""><?php echo lang('Word.select'); ?></option>
                                                    <?php foreach ($prov as $key => $value) { ?>
                                                        <option value="<?php echo $prov[$key]['province_code']; ?>"><?php echo $prov[$key]['name_of_province']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                            ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="kota">Kota/Kabupaten</label>
                                                <select name="kota" id="ekota" class="form-control" disabled>
                                                    <option value=""><?php echo lang('Word.select') ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <select name="kecamatan" id="ekecamatan" class="form-control" disabled>
                                                    <option value=""><?php echo lang('Word.select') ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="kalurahan">Kelurahan</label>
                                                <select name="kalurahan" id="ekalurahan" class="form-control" disabled>
                                                    <option value=""><?php echo lang('Word.select') ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./col-md-6-->
                                <div class="col-md-3 col-sm-12">
                                    <div class="row">
                                        <div id="calculate" class="col-sm-12">
                                            <div class="form-group">
                                                <label>RT / RW</label>
                                                <div style="clear: both;overflow: hidden;">
                                                    <input type="text" placeholder="RT" name="rt" id="ert" value="" class="form-control" style="width: 30%; float: left;">
                                                    <input type="text" id="erw" placeholder="RW" name="rw" value="" class="form-control patient_age_month" autocomplete="off" style="width: 30%;float: left; margin-left: 4px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ayah</label>
                                        <input name="ayah" id="eayah" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ibu</label>
                                        <input name="ibu" id="eibu" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Suami/Istri</label>
                                        <input name="sutri" id="esutri" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="pwd">Catatan</label>
                                        <textarea name="description" id="edescription" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>No.Peserta</label>
                                        <input name="kk_no" id="ekk_no" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Asuransi</label>
                                        <select class="form-control" id="estatus" name="status">
                                            <?php foreach ($statusPasien as $key => $value) { ?>
                                                <option value="<?php echo $statusPasien[$key]['status_pasien_id']; ?>"><?php echo $statusPasien[$key]['name_of_status_pasien']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="tmt">TMT</label>
                                        <input type='text' name="tmt" class="form-control" id='etmt' />
                                    </div>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#etmt').datetimepicker({
                                                format: 'YYYY-MM-DD'
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="tat">TAT</label>
                                        <input type='text' name="tat" class="form-control" id='etat' />
                                    </div>
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#etat').datetimepicker({
                                                format: 'YYYY-MM-DD'
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Pisa</label>
                                        <select class="form-control" id="episa" name="pisa">
                                            <?php foreach ($coverage as $key => $value) { ?>
                                                <option value="<?php echo $coverage[$key]['coverage_id']; ?>"><?php echo $coverage[$key]['coveragetype']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Kelompok</label>
                                        <select class="form-control" id="epayor" name="payor">
                                            <option value=""><?php echo lang('Word.select'); ?></option>
                                            <?php foreach ($payor as $key => $value) { ?>
                                                <option value="<?php echo $payor[$key]['payor_id']; ?>"><?php echo $payor[$key]['payor']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select class="form-control" id="eclass_id" name="class_id">
                                            <?php foreach ($kelas as $key => $value) { ?>
                                                <option value="<?php echo $kelas[$key]['class_id']; ?>"><?php echo $kelas[$key]['name_of_class']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                    ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status di Keluarga</label>
                                                <select class="form-control" id="efamily" name="family">
                                                    <?php foreach ($family as $key => $value) { ?>
                                                        <option value="<?php echo $family[$key]['family_status_id']; ?>"><?php echo $family[$key]['family_status']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                            ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Agama</label>
                                                <select class="form-control" id="eagama" name="agama">
                                                    <?php foreach ($agama as $key => $value) { ?>
                                                        <option value="<?php echo $agama[$key]['kode_agama']; ?>"><?php echo $agama[$key]['nama_agama']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                            ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="kota">Pendidikan</label>
                                                <select class="form-control" id="eedukasi" name="edukasi">
                                                    <?php foreach ($education as $key => $value) { ?>
                                                        <option value="<?php echo $education[$key]['education_type_code']; ?>"><?php echo $education[$key]['name_of_edu_type']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="kalurahan">Pekerjaan</label>
                                                <select name="pekerjaan" id="epekerjaan" class="form-control">
                                                    <?php foreach ($job as $key => $value) { ?>
                                                        <option value="<?php echo $job[$key]['job_id']; ?>"><?php echo $job[$key]['name_of_job']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--./col-md-6-->
                                <div class="" id="customfield"></div>
                            </div><!--./row-->
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="submit" id="formeditpabtn" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-info"><?php echo lang('Word.save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>
<?php if (isset($permissions['biodatapasien']['c'])) {
    if ($permissions['biodatapasien']['c'] == '1') {  ?>
        <div class="modal fade" id="myModalpa" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?php echo lang('Word.add_patient'); ?></h4>
                    </div>
                    <form id="formaddpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="scroll-area">
                            <div class="modal-body pt0 pb0">
                                <input id="aupdateid" name="updateid" placeholder="" type="hidden" class="form-control" value="" />
                                <div class="row">
                                    <input id="ano_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                                    <div class=" col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pasien</label><small class="req"> *</small>
                                            <input id="anama" name="nama" placeholder="" type="text" class="form-control" value="" />
                                            <span class="text-danger"><?php //echo form_error('name'); 
                                                                        ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" name="pasien_id" id="apasien_id" placeholder="" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label> <?php echo lang('Word.gender'); ?></label>
                                                    <select class="form-control" name="gender" id="agenders">
                                                        <?php foreach ($gender as $key => $value) { ?>
                                                            <option value="<?php echo $gender[$key]['gender']; ?>"><?php echo $gender[$key]['name_of_gender']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="edatebirth">Tanggal Lahir</label>
                                                    <input type='text' name="datebirth" class="form-control" id='adatebirth' />
                                                </div>
                                                <script type="text/javascript">
                                                    $(function() {
                                                        $('#adatebirth').datetimepicker({
                                                            format: 'YYYY-MM-DD'
                                                        });
                                                    });
                                                </script>
                                            </div>

                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label><small class="req"> *</small>
                                                    <input type="text" name="placebirth" id="aplacebirth" placeholder="" value="" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Darah</label>
                                                    <select class="form-control" id="agoldar" name="goldar">
                                                        <?php foreach ($blood as $key => $value) { ?>
                                                            <option value="<?php echo $blood[$key]['blood_type_id']; ?>"><?php echo $blood[$key]['name_of_type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                                ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pwd"><?php echo lang('Word.marital_status'); ?></label>
                                                    <select name="perkawinan" id="aperkawinan" class="form-control">
                                                        <?php
                                                        foreach ($marital as $key => $value) {
                                                        ?>
                                                            <option value="<?php echo $marital[$key]['maritalstatusid']; ?>"><?php echo $marital[$key]['name_of_maritalstatus']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">
                                                        <?php echo lang('Word.patient_photo'); ?>
                                                    </label>
                                                    <div>
                                                        <input class="filestyle form-control-file" type='file' name='file' id="axampleInputFile" size='20' data-height="26" data-default-file="<?php echo base_url() ?>uploads/patient_images/no_image.png">
                                                    </div>
                                                    <span class="text-danger"><?php //echo form_error('file'); 
                                                                                ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="pwd">No Telp</label>
                                            <input id="aphone" autocomplete="off" name="phone" type="text" placeholder="" class="form-control" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>HP</label>
                                            <input type="text" placeholder="" id="amobile" value="" name="mobile" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input name="address" id="aaddress" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control" id="aprov" name="prov">
                                                        <option value=""><?php echo lang('Word.select'); ?></option>
                                                        <?php foreach ($prov as $key => $value) { ?>
                                                            <option value="<?php echo $prov[$key]['province_code']; ?>"><?php echo $prov[$key]['name_of_province']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                                ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kota">Kota/Kabupaten</label>
                                                    <select name="kota" id="akota" class="form-control" disabled>
                                                        <option value=""><?php echo lang('Word.select') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <select name="kecamatan" id="akecamatan" class="form-control" disabled>
                                                        <option value=""><?php echo lang('Word.select') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kalurahan">Kelurahan</label>
                                                    <select name="kalurahan" id="akalurahan" class="form-control" disabled>
                                                        <option value=""><?php echo lang('Word.select') ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->
                                    <div class="col-md-3 col-sm-12">
                                        <div class="row">
                                            <div id="calculate" class="col-sm-12">
                                                <div class="form-group">
                                                    <label>RT / RW</label>
                                                    <div style="clear: both;overflow: hidden;">
                                                        <input type="text" placeholder="RT" name="rt" id="art" value="" class="form-control" style="width: 30%; float: left;">
                                                        <input type="text" id="arw" placeholder="RW" name="rw" value="" class="form-control patient_age_month" autocomplete="off" style="width: 30%;float: left; margin-left: 4px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Ayah</label>
                                            <input name="ayah" id="aayah" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Ibu</label>
                                            <input name="ibu" id="aibu" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Suami/Istri</label>
                                            <input name="sutri" id="asutri" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="pwd">Catatan</label>
                                            <textarea name="description" id="adescription" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>No.Peserta</label>
                                            <input name="kk_no" id="akk_no" placeholder="" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Asuransi</label>
                                            <select class="form-control" id="astatus" name="status">
                                                <?php foreach ($statusPasien as $key => $value) { ?>
                                                    <option value="<?php echo $statusPasien[$key]['status_pasien_id']; ?>"><?php echo $statusPasien[$key]['name_of_status_pasien']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                        ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="tmt">TMT</label>
                                            <input type='text' name="tmt" class="form-control" id='atmt' />
                                        </div>
                                        <script type="text/javascript">
                                            $(function() {
                                                $('#atmt').datetimepicker({
                                                    format: 'YYYY-MM-DD'
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="tat">TAT</label>
                                            <input type='text' name="tat" class="form-control" id='atat' />
                                        </div>
                                        <script type="text/javascript">
                                            $(function() {
                                                $('#atat').datetimepicker({
                                                    format: 'YYYY-MM-DD'
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Pisa</label>
                                            <select class="form-control" id="apisa" name="pisa">
                                                <?php foreach ($coverage as $key => $value) { ?>
                                                    <option value="<?php echo $coverage[$key]['coverage_id']; ?>"><?php echo $coverage[$key]['coveragetype']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                        ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Kelompok</label>
                                            <select class="form-control" id="apayor" name="payor">
                                                <option value=""><?php echo lang('Word.select'); ?></option>
                                                <?php foreach ($payor as $key => $value) { ?>
                                                    <option value="<?php echo $payor[$key]['payor_id']; ?>"><?php echo $payor[$key]['payor']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                        ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select class="form-control" id="aclass_id" name="class_id">
                                                <?php foreach ($kelas as $key => $value) { ?>
                                                    <option value="<?php echo $kelas[$key]['class_id']; ?>"><?php echo $kelas[$key]['name_of_class']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                        ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Status di Keluarga</label>
                                                    <select class="form-control" id="afamily" name="family">
                                                        <?php foreach ($family as $key => $value) { ?>
                                                            <option value="<?php echo $family[$key]['family_status_id']; ?>"><?php echo $family[$key]['family_status']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                                ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select class="form-control" id="aagama" name="agama">
                                                        <?php foreach ($agama as $key => $value) { ?>
                                                            <option value="<?php echo $agama[$key]['kode_agama']; ?>"><?php echo $agama[$key]['nama_agama']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                                ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kota">Pendidikan</label>
                                                    <select class="form-control" id="aedukasi" name="edukasi">
                                                        <?php foreach ($education as $key => $value) { ?>
                                                            <option value="<?php echo $education[$key]['education_type_code']; ?>"><?php echo $education[$key]['name_of_edu_type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kalurahan">Pekerjaan</label>
                                                    <select name="pekerjaan" id="apekerjaan" class="form-control">
                                                        <?php foreach ($job as $key => $value) { ?>
                                                            <option value="<?php echo $job[$key]['job_id']; ?>"><?php echo $job[$key]['name_of_job']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->
                                    <div class="" id="customfield"></div>
                                </div><!--./row-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="submit" id="formaddpabtn" data-loading-text="<?php echo lang('Word.processing'); ?>" class="btn btn-info pull-right"><i class="fa fa-check-circle"></i> <?php echo lang('Word.save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>



<script type="text/javascript">
    var coverage = status = jenis = kelas = kalurahan = kecamatan = kota = prov = statusPasien = payor = education = marital = agama = job = blood = gender = family = new Array();
    var skunj = new Array();

    gender = [
        <?php foreach ($gender as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $gender[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    <?php foreach ($coverage as $key => $value) { ?>
        coverage[<?= $coverage[$key]['coverage_id']; ?>] = '<?= $coverage[$key]['coveragetype']; ?>';
    <?php } ?>
    <?php foreach ($status as $key => $value) { ?>
        status[<?= $status[$key]['status_peserta_kode']; ?>] = '<?= $status[$key]['status_peserta']; ?>';
    <?php } ?>
    <?php foreach ($jenis as $key => $value) { ?>
        jenis[<?= $jenis[$key]['kdjnspeserta']; ?>] = '<?= $jenis[$key]['nmjnspeserta']; ?>';
    <?php } ?>
    kelas = [
        <?php foreach ($kelas as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kelas[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    kalurahan = [
        <?php foreach ($kalurahan as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kalurahan[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    kecamatan = [
        <?php foreach ($kecamatan as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kecamatan[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    kota = [
        <?php foreach ($kota as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $kota[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    prov = [
        <?php foreach ($prov as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $prov[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    statusPasien = [
        <?php foreach ($statusPasien as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $statusPasien[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    payor = [
        <?php foreach ($payor as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $payor[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    agama = [
        <?php foreach ($agama as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $agama[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    marital = [
        <?php foreach ($marital as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $marital[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    blood = [
        <?php foreach ($blood as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $blood[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    job = [
        <?php foreach ($job as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $job[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];

    education = [
        <?php foreach ($education as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $education[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
    family = [
        <?php foreach ($family as $key => $value) { ?>[
                <?php foreach ($value as $key1 => $value1) { ?> '<?= str_replace("'", " ", $family[$key][$key1]); ?>',
                <?php } ?>],
        <?php } ?>
    ];
</script>

<!-- //========datatable start===== -->
<script type="text/javascript">
    // (function($) {
    //     'use strict';
    //     $(document).ready(function() {

    //         var search_text = $('#search_text').val();
    //         console.log(search_text)
    //         initDatatable('ajaxlist', 'admin/admin/getpatientdatatable', {
    //             'search_text': search_text
    //         }, [], 100, [{
    //             "bSortable": false,
    //             "aTargets": [0, 8]
    //         }]);
    //     })
    // }(jQuery))

    $("#formbiodata").on('submit', (function(e) {

        e.preventDefault();
        // $("#formbiodatabtn").button('loading');
        $.ajax({
            url: '<?php echo base_url(); ?>admin/admin/getpatientdatatable',
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $(".ajaxlist").html("");
                var stringcolumn = '';
                data.data.forEach((element, key) => {
                    stringcolumn += '<tr class="table tablecustom-light">';
                    element.forEach((element1, key1) => {
                        stringcolumn += "<td>" + element1 + "</td>";
                    });
                    stringcolumn += '</tr>'

                });
                $(".ajaxlist").html(stringcolumn);
                $("#formbiodatabtn").button('reset');

            },
            error: function() {

            }
        });
    }))

    function getpatientdatatable() {
        alert('masuk')

    }
</script>
<!-- //========datatable end===== -->

<script type="text/javascript">
    function showdate(value) {
        if (value == 'period') {
            $('#fromdate').show();
            $('#todate').show();
        } else {
            $('#fromdate').hide();
            $('#todate').hide();
        }
    }

    function holdModal(modalId) {
        $('#' + modalId).modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function getpatientData(id) {
        $('#modal_head').html("<?php echo lang('Word.patient_details'); ?>");
        $.ajax({
            url: baseurl + 'admin/patient/getpatientDetails',
            type: "POST",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                skunj = data
                var link = '';
                <?php if (user()->checkPermission('biodatapasien', 'd')) { ?>
                    if (data.ismeninggal == 0) {
                        var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.disable'); ?>' onclick='patient_deactive(" + id + ")' data-placement='bottom' data-original-title='<?php echo lang('Word.disable'); ?>'><i class='fa fa-thumbs-o-down'></i></a><a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                    } else {
                        var link = "<a href='#' data-toggle='tooltip' title='<?php echo lang('Word.enable'); ?>' onclick='patient_active(" + id + ")' data-original-title='<?php echo lang('Word.enable'); ?>'><i class='fa fa-thumbs-o-up'></i></a> <a href='#' data-toggle='tooltip'  onclick='delete_record(" + id + ")' data-original-title='<?php echo lang('Word.delete'); ?>'><i class='fa fa-trash'></i></a>";
                    }
                <?php } ?>


                if (data.gender == '1') {
                    $("#imagebiodata").html('<img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_male.png' ?>" alt="User profile picture">')
                } else {
                    $("#imagebiodata").html('<img class="profile-user-img img-responsive" src="<?php echo base_url() . 'uploads/images/profile_female.png' ?>" alt="User profile picture">')
                }

                $("patientid").val(data.no_registration);
                $("#patient_name").html(data.name_of_pasien + " (" + data.no_registration + ")");
                $("#kk_no").html(data.KK_NO);
                coverage.forEach((element, index) => {
                    if (index == data.coverage_id) {
                        $("#coverages").html(element);
                    }
                });
                $("#pasien_id").html(data.pasien_id);
                kelas.forEach(value => {
                    if (value[0] == data.class_id) {
                        $("#class_id").html(value[1]);
                    }
                });
                $("#placebirth").html(data.place_of_birth);
                $("#datebirth").html(data.date_of_birth.substring(0, 10));
                $("#age").html(data.patient_age);
                $("#description").html(data.description);
                $("#address").html(data.contact_address);
                $("#rtrw").html(data.rt + " / " + data.rw);
                kalurahan.forEach(kalvalue => {
                    if (skunj.kal_id == kalvalue[0]) {
                        $("#kalurahan").html(kalvalue[1]);
                        kecamatan.forEach(kecvalue => {
                            if (kecvalue[0] == kalvalue[2]) {
                                $("#kecamatan").html(kecvalue[1]);
                                kota.forEach(kotavalue => {
                                    if (kecvalue[2] == kotavalue[1]) {
                                        $("#kota").html(kotavalue[2]);
                                        prov.forEach(provvalue => {
                                            if (provvalue[0] == kotavalue[0]) {
                                                $("#prov").html(provvalue[2]);
                                            }
                                        })
                                    }

                                });
                            }
                        });
                    }
                })

                $("#phone").html(data.phone_number + " / " + data.mobile);
                statusPasien.forEach(value => {
                    if (value[0] == data.status_pasien_id) {
                        $("#status").html(value[1]);
                    }
                });
                payor.forEach(payorvalue => {
                    if (payorvalue[1] == data.payor_id) {
                        $("#payor").html(payorvalue[3]);
                    }
                });

                $("#ayah").html(data.father);
                $("#ibu").html(data.mother);
                $("#sutri").html(data.spouse);
                education.forEach(value => {
                    if (value[0] == data.education_type_code) {
                        $("#edukasi").html(value[1]);
                    }
                });
                job.forEach(jobvalue => {
                    if (jobvalue[0] == data.job_id) {
                        $("#pekerjaan").html(jobvalue[1]);
                    }
                });
                blood.forEach(bloodvalue => {
                    if (bloodvalue[1] == data.blood_type_id) {
                        $("#goldar").html(bloodvalue[0]);
                    }
                });
                agama.forEach(agamavalue => {
                    if (agamavalue[0] == data.kode_agama) {
                        $("#agama").html(agamavalue[1]);
                    }
                });
                marital.forEach(maritalvalue => {
                    if (maritalvalue[0] == data.maritalstatusid) {
                        $("#perkawinan").html(maritalvalue[1]);
                    }
                });
                gender.forEach(gendervalue => {
                    if (gendervalue[0] == data.gender) {
                        $("#gender").html(gendervalue[1]);
                    }
                });
                family.forEach(value => {
                    if (value[0] == data.family_status_id) {
                        $("#family").html(value[1]);
                    }
                });
                $('#edit_delete').html("<a href='#' onclick='editRecord(" + id + ")' data-toggle='tooltip' data-placement='bottom' title='edit' data-target='' data-toggle='modal'   data-original-title='edit'><i class='fa fa-pencil'></i></a>" + link + "");
                holdModal('myModal');
                patientvisit(data.no_registration);
            },
        });
    }

    function patientvisit(id) {
        $.ajax({
            url: baseurl + 'admin/patient/patientvisit',
            type: "POST",
            data: {
                'id': id
            },
            dataType: 'json',
            success: function(data) {
                $('#visit_report_id').html(data);
            }
        });
    }

    function editRecord(id) {
        $("#eno_registration").val(skunj.no_registration);
        $("#enama").val(skunj.name_of_pasien);
        $("#epasien_id").val(skunj.pasien_id);
        $("#eclass_id").val(skunj.class_id);
        $("#eplacebirth").val(skunj.place_of_birth);
        $("#edatebirth").val(skunj.date_of_birth.substring(0, 10));
        $("#edescription").val(skunj.description);
        $("#eaddress").val(skunj.contact_address);
        $("#ert").val(skunj.rt);
        $("#erw").val(skunj.rw);
        $("#eayah").val(skunj.father)
        $("#eibu").val(skunj.mother)
        $("#esutri").val(skunj.spouse)
        $("#ephone").val(skunj.phone_number);
        $("#emobile").val(skunj.mobile);
        $("#estatus").val(skunj.status_pasien_id);
        $("#epayor").val(skunj.payor_id);
        $("#eedukasi").val(skunj.education_type_code);
        $("#epekerjaan").val(skunj.job_id);
        $("#egoldar").val(skunj.blood_type_id);
        $("#eagama").val(skunj.kode_agama);
        $("#egender").val(skunj.gender);
        $("#episa").val(skunj.coverage_id);
        $("#efamily").val(skunj.family_status_id);
        $("#ekk_no").val(skunj.kk_no);
        $("#etmt").val(skunj.tmt.substring(0, 10));
        $("#etat").val(skunj.tat.substring(0, 10));
        $("#eperkawinan").val(skunj.maritalstatusid);

        var kalselect = '';
        var kotaselect = '';
        var provselect = '';

        $("#ekalurahan").html()
        $("#ekecamatan").html()
        $("#ekota").html()

        kalurahan.forEach(kalvalue => {
            if (skunj.kal_id == kalvalue[0]) {
                $("#ekalurahan").append(new Option(kalvalue[1], skunj.kal_id))
                $('#ekalurahan').val(skunj.kal_id)
                $('#ekalurahan').prop("disabled", false)
                // $('select[id="ekalurahan"] option[value="' + kalvalue[0] + '"]').attr("selected", "selected");
                kecamatan.forEach(kecvalue => {
                    if (kecvalue[0] == kalvalue[2]) {
                        $("#ekecamatan").append(new Option(kecvalue[1], kecvalue[0]))
                        $('#ekecamatan').val(kecvalue[0])
                        $('#ekecamatan').prop("disabled", false)
                        kota.forEach(kotavalue => {
                            if (kecvalue[2] == kotavalue[1]) {
                                $("#ekota").append(new Option(kotavalue[2], kotavalue[1]));
                                $('#ekota').val(kotavalue[1])
                                $('#ekota').prop("disabled", false)
                                prov.forEach(provvalue => {
                                    if (provvalue[0] == kotavalue[0]) {
                                        $('#eprov').val(kotavalue[0])
                                    }
                                })
                            }

                        });
                    }
                });
            }
        })

        $("#myModal").modal('hide');
        holdModal('editModal');
    }

    $(document).ready(function(e) {
        $('#eprov').on("click", function() {
            $("#ekota").html("")
            $("#ekecamatan").html("")
            $("#ekecamatan").prop("disabled", true)
            $("#ekalurahan").html("")
            $("#ekalurahan").prop("disabled", true)
            var selprov = $('#eprov').val()
            kota.forEach(kotavalue => {
                if (kotavalue[0] == selprov) {
                    $("#ekota").append(new Option(kotavalue[2], kotavalue[1]));
                    $("#ekota").prop("disabled", false)
                }

            });
        })
        $('#ekota').on("click", function() {
            $("#ekecamatan").html("")
            $("#ekecamatan").prop("disabled", true)
            $("#ekalurahan").html("")
            $("#ekalurahan").prop("disabled", true)
            var selkota = $('#ekota').val()
            kecamatan.forEach(kecvalue => {
                if (kecvalue[2] == selkota) {
                    $("#ekecamatan").append(new Option(kecvalue[1], kecvalue[0]))
                    $("#ekecamatan").prop("disabled", false)
                }
            });
        })
        $('#ekecamatan').on("click", function() {
            $("#ekalurahan").html("")
            $("#ekalurahan").prop("disabled", true)
            var selkec = $('#ekota').val()
            kalurahan.forEach(kalvalue => {
                if (selkec == kalvalue[2]) {
                    console.log(kalvalue[2])
                    $("#ekalurahan").append(new Option(kalvalue[1], kalvalue[0]))
                    $("#ekalurahan").prop("disabled", false)
                    $("#ekalurahan").val(kalvalue[0])
                }
            })
        })
        $("#formeditpa").on('submit', (function(e) {
            $("#formeditpabtn").button('loading');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/update',
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.status == "fail") {
                        var message = "";
                        $.each(data.error, function(index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    } else {
                        successMsg(data.message);
                        window.location.reload(true);
                    }
                    $("#formeditpabtn").button('reset');
                },
                error: function() {

                }
            });
        }));
    });

    function delete_record(id) {
        if (confirm(<?php echo "'" . lang('Word.patient_delete_alert_message') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deletePatient',
                type: "POST",
                data: {
                    delid: skunj.no_registration
                },
                dataType: 'json',
                success: function(data) {
                    successMsg(<?php echo "'" . lang('Word.delete_message') . "'"; ?>);
                    $("#myModal").modal("hide");
                    table.ajax.reload();
                }
            })
        }
    }

    function patient_deactive(id) {
        if (confirm(<?php echo "'" . lang('Word.are_you_sure_to_deactivate_account') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/deactivePatient',
                type: "POST",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status == "fail") {
                        var message = (data.message);
                        errorMsg(message);
                    } else {
                        successMsg(<?php echo "'" . lang('Word.record_disable') . "'"; ?>);
                        window.getpatientData(id);
                    }
                }
            })
        }
    }

    function CalculateAgeInQCe(DOB, txtAge, Txndate) {
        if (DOB.value != '') {
            now = new Date(Txndate)
            var txtValue = DOB;
            if (txtValue != null)
                dob = txtValue.split('/');
            if (dob.length === 3) {
                born = new Date(dob[2], dob[1] * 1 - 1, dob[0]);
                if (now.getMonth() == born.getMonth() && now.getDate() == born.getDate()) {
                    age = now.getFullYear() - born.getFullYear();
                } else {
                    age = Math.floor((now.getTime() - born.getTime()) / (365.25 * 24 * 60 * 60 * 1000));
                }
                if (isNaN(age) || age < 0) {

                } else {
                    if (now.getMonth() > born.getMonth()) {
                        var calmonth = now.getMonth() - born.getMonth();
                    } else {
                        var calmonth = born.getMonth() - now.getMonth();
                    }
                    $("#eage_year").val(age);
                    $("#eage_month").val(calmonth);
                    return age;
                }
            }
        }
    }

    function patient_active(id) {
        if (confirm(<?php echo "'" . lang('Word.are_you_sure_to_active_account') . "'"; ?>)) {
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/activePatient',
                type: "POST",
                data: {
                    activeid: id
                },
                dataType: 'json',
                success: function(data) {
                    successMsg(<?php echo "'" . lang('Word.record_active') . "'"; ?>);
                    window.getpatientData(id);
                }
            })
        }
    }

    $(document).on('click', '.delete_selected', function() {
        var $this = $(this);
        let obj = [];
        $('input:checkbox.enable_delete').each(function() {
            (this.checked ? obj.push($(this).val()) : "");
        });
        if (confirm('<?php echo lang('Word.patient_delete_alert_message'); ?>')) {
            $.ajax({
                url: base_url + 'admin/patient/bulk_delete',
                type: "POST",
                dataType: 'json',
                data: {
                    'delete_id': obj
                },
                beforeSend: function() {
                    $this.button('loading');
                },
                success: function(res) {
                    $this.button('reset');
                    if (res.status == 1) {
                        successMsg(res.msg);
                        table.ajax.reload();
                    } else {
                        var message = "";
                        $.each(res.error, function(index, value) {
                            message += value;
                        });
                        errorMsg(message);
                    }
                },
                error: function(xhr) { // if error occured
                    alert("<?php echo lang('Silahkan coba kembali'); ?>");
                    $this.button('reset');
                },
                complete: function() {
                    $this.button('reset');

                }
            });
        }
    });
</script>


<script type="text/javascript">
    $(document).ready(function(e) {
        $('#aprov').on("click", function() {
            $("#akota").html("")
            $("#akecamatan").html("")
            $("#akecamatan").prop("disabled", true)
            $("#akalurahan").html("")
            $("#akalurahan").prop("disabled", true)
            var selprov = $('#aprov').val()
            kota.forEach(kotavalue => {
                if (kotavalue[0] == selprov) {
                    $("#akota").append(new Option(kotavalue[2], kotavalue[1]));
                    $("#akota").prop("disabled", false)
                }

            });
        })
        $('#akota').on("click", function() {
            $("#akecamatan").html("")
            $("#akecamatan").prop("disabled", true)
            $("#akalurahan").html("")
            $("#akalurahan").prop("disabled", true)
            var selkota = $('#akota').val()
            kecamatan.forEach(kecvalue => {
                if (kecvalue[2] == selkota) {
                    $("#akecamatan").append(new Option(kecvalue[1], kecvalue[0]))
                    $("#akecamatan").prop("disabled", false)
                }
            });
        })
        $('#akecamatan').on("click", function() {
            $("#akalurahan").html("")
            $("#akalurahan").prop("disabled", true)
            var selkec = $('#akota').val()
            kalurahan.forEach(kalvalue => {
                if (selkec == kalvalue[2]) {
                    console.log(kalvalue[2])
                    $("#akalurahan").append(new Option(kalvalue[1], kalvalue[0]))
                    $("#akalurahan").prop("disabled", false)
                    $("#akalurahan").val(kalvalue[0])
                }
            })
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#formaddpa").on('submit', (function(e) {
            let clicked_submit_btn = $(this).closest('form').find(':submit');
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url(); ?>admin/patient/addpatient',
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
                        window.location.reload(true);
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
    });

    function addappointmentModal(patient_id = '', modalid) {
        var div_data = '';
        $.ajax({
            url: '<?php echo base_url(); ?>admin/patient/getpatientDetails',
            type: "POST",
            data: {
                id: patient_id
            },
            dataType: 'json',
            success: function(data) {
                var option = new Option(data.patient_name + " (" + data.id + ")", data.id, true, true);
                $(".patient_list_ajax").append(option).trigger('change');
                $("#" + modalid).modal('show');
                holdModal(modalid);
            }
        })
    }
</script>