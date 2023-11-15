<?php

$permissions = user()->getPermissions();
?>
<div class="tab-pane tab-content-height 
                            <?php if ($giTipe == 0) echo "active"; ?>
                            " id="biodata">
    <div class="row">
        <!-- <div class="col-md-12">
            
        </div> -->
        <div class="col-md-10">
            <div class="mt-4">
                <form id="formbiodata" action="" method="post" class="">
                    <div class="col-sm-3">
                        <?php if (isset($permissions['biodatapasien']['r'])) {
                            if ($permissions['biodatapasien']['r'] == '1') {  ?>
                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Nama Pasien / Nomor</label>
                                    <div class="input-group">
                                        <!-- <label class="mb-3">Nama Pasien / No RM</label> -->
                                        <input type="search" name="search_text" id="nama" class=" form-control" placeholder="input nama/nomor rekam medis pasien" aria-label="Nama Pasien / No RM" aria-describedby="formbiodatabtn">
                                        <button id="formbiodatabtn" class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
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
            </div>
        </div>
        <div class="col-md-2">
            <div class="mt-4 text-end">
                <?php if (isset($permissions['biodatapasien']['c'])) {
                    if ($permissions['biodatapasien']['c'] == '1') { ?>
                        <a data-toggle="modal" onclick="holdModal('addPasienModal')" id="addp" class="btn btn-primary btn-sm newpatient"><i class="fa fa-plus"></i> Biodata Pasien</a>
                <?php }
                } ?>
            </div>
        </div>


        <!-- <div class="">
                            <button type="submit" class="btn btn-primary pull-right btn-sm mt10 delete_selected" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> "><i class="fa fa-trash"></i> <?php echo lang('Word.delete_selected'); ?></button>
                        </div> -->
        <style>
            .ajaxlist {
                text-align: center;
            }
        </style>
        <table id="datapasien" class="table table-bordered dt-responsive nowrap table-striped table-centered table-hover" data-export-title="<?= lang('Word.patient_list'); ?>">
            <thead class="table-primary">
                <tr>
                    <th style="width: 5%">No MR</th>
                    <th style="width: 20%"><?php echo lang('Word.patient_name'); ?></th>
                    <th style="width: 10%"><?php echo lang('Word.age'); ?></th>
                    <th style="width: 5%"><?php echo lang('Word.gender'); ?></th>
                    <th style="width: 15%"><?php echo lang('Word.phone'); ?></th>
                    <th style="width: 15%"><?php echo lang('Word.guardian_name'); ?></th>
                    <th style="width: 20%"><?php echo lang('Word.address'); ?></th>
                    <th style="width: 10%">Aksi</th>
                </tr>
            </thead>
            <tbody class="ajaxlist" class="table-group-divider">
            </tbody>
        </table>
        <!-- </form> -->
    </div>
</div>
<?php if (isset($permissions['biodatapasien']['r'])) {
    if ($permissions['biodatapasien']['r'] == '1') {  ?>
        <div class="modal fade bs-example-modal-xl" id="rincianPasienModel" role="dialog" aria-labelledby="rincianPasienModelLabel">
            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <div class="modalicon">

                            <div id='edit_delete'>
                                <a href="#" data-placement="bottom" data-toggle="tooltip" title="<?php echo lang('Word.edit'); ?>"><i class="fas fa-pencil-alt">Edit</i></a>
                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo lang('Word.delete'); ?>"><i class="fas fa-trash">Delete</i></a>
                            </div>
                        </div>
                        <h4 class="modal-title" id="modal_head"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="row">
                            <div class="col-sm-4 col-xs-6">
                                <div class="form-group15">
                                </div>
                            </div><!--./col-sm-4-->
                        </div><!-- ./row -->
                    </div><!--./modal-header-->
                    <div class="modal-body">
                        <div class="">
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
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <table class="table table-hover">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="bolds">Noss. Peserta</td>
                                                                            <td id="kk_no"></td>
                                                                            <td class="bolds">Alamat</td>
                                                                            <td id="address"></td>
                                                                            <td class="bolds">Ayah</td>
                                                                            <td id="ayah"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">PISA</td>
                                                                            <td id="coverages"></td>
                                                                            <td class="bolds">RT/RW</td>
                                                                            <td id="rtrw"></td>
                                                                            <td class="bolds">Ibu</td>
                                                                            <td id="ibu"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">NIK</td>
                                                                            <td id="pasien_id"></td>
                                                                            <td class="bolds">Kel</td>
                                                                            <td id="kalurahan"></td>
                                                                            <td class="bolds">Suami/Istri</td>
                                                                            <td id="sutri"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Status di Keluarga</td>
                                                                            <td id="family"></td>
                                                                            <td class="bolds">Kecamatan</td>
                                                                            <td id="kecamatan"></td>
                                                                            <td class="bolds">Pendidikan</td>
                                                                            <td id="edukasi"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Hak Kelas</td>
                                                                            <td id="class_id"></td>
                                                                            <td class="bolds">Kota/Kab</td>
                                                                            <td id="kota"></td>
                                                                            <td class="bolds">Pekerjaan</td>
                                                                            <td id="pekerjaan"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Tempat Lahir</td>
                                                                            <td id="placebirth"></td>
                                                                            <td class="bolds">Prov</td>
                                                                            <td id="prov"></td>
                                                                            <td class="bolds">Gol Darah</td>
                                                                            <td id="goldar"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Tgl Lahir</td>
                                                                            <td id="datebirth"></td>
                                                                            <td class="bolds">Telp/HP</td>
                                                                            <td id="phone"></td>
                                                                            <td class="bolds">Agama</td>
                                                                            <td id="agama"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Umur</td>
                                                                            <td id="age"></td>
                                                                            <td class="bolds">Status</td>
                                                                            <td id="status"></td>
                                                                            <td class="bolds">Perkawinan</td>
                                                                            <td id="perkawinan"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Jenis Kelamin</td>
                                                                            <td id="gender"></td>
                                                                            <td class="bolds">Kelompok</td>
                                                                            <td id="payor"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="bolds">Catatan</td>
                                                                            <td id="description"></td>
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
        <div class="modal fade" id="editPasienModal" role="dialog" aria-labelledby="editPasienModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_head"><?php echo lang('Word.patient_details'); ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <div class="modal fade" id="addPasienModal" role="dialog" aria-labelledby="rincianPasienModelLabel">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mt-0"><?php echo lang('Word.add_patient'); ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formaddpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="scroll-area">
                            <div class="modal-body">
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
                                                <!-- <div class="form-group">
                                                    <label for="adatebirth">Tanggal Lahir</label>
                                                    <input type='text' name="datebirth" class="form-control" id='adatebirth' />
                                                </div> -->
                                                <div class="mb-3">
                                                    <label>Tanggal Lahir</label>
                                                    <div>
                                                        <div class="input-group" id="adatebirth">
                                                            <input name="datebirth" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container="#adatebirth">

                                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>

                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
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