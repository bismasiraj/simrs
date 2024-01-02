<?php

$permissions = user()->getPermissions();
?>

<div class="tab-pane tab-content-height 
                            <?php if ($giTipe == 0 || $giTipe == 5) echo "active"; ?>
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
                        <a data-toggle="modal" onclick="editBiodataPasien()" id="addp" class="btn btn-primary btn-sm newpatient"><i class="fa fa-plus"></i> Biodata Pasien</a>
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
                    <th style="width: 15%">NIK/Satu Sehat</th>
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
























<!-- ini modal yang dipake buat REVIEW HISTORY PASIEN termasuk BIODATA,RAJAL,RANAP -->
<?php if (isset($permissions['biodatapasien']['r'])) {
    if ($permissions['biodatapasien']['r'] == '1') {  ?>
        <div class="modal fade bs-example-modal-xl" id="rincianPasienModel" role="dialog" aria-labelledby="rincianPasienModelLabel">
            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
                <div class="modal-content rounded-4">
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

<!-- ini modal yang dipake buat REVIEW HISTORY PASIEN termasuk BIODATA,RAJAL,RANAP -->
<!-- END -->


<!-- ini modal yang dipake buat CRUD BIODATA PASIEN -->
<!-- if (isset($permissions['biodatapasien']['u'])) -->
<?php if (isset($permissions['biodatapasien']['c'])) {
    if ($permissions['biodatapasien']['c'] == '1') {  ?>
        <div class="modal fade" id="pasienModal" role="dialog" aria-labelledby="rincianPasienModelLabel">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h4 id="displayNoRegistration" class="modal-title mt-0"><?php echo lang('Word.add_patient'); ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formaddpa" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post">
                        <div class="scroll-area">
                            <div class="modal-body">
                                <input id="aupdateid" name="updateid" placeholder="" type="hidden" class="form-control" value="" />
                                <div class="row">

                                </div>
                                <div class="row">
                                    <input id="ano_registration" type="text" name="no_registration" placeholder="" class="form-control block" value="" style="display: none" />
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <div class="row">
                                            <div class=" col-md-6">
                                                <div class="form-group">
                                                    <label>Nama Pasien</label><small class="req"> *</small>
                                                    <input id="anama" type="text" name="nama" autocomplete="off" placeholder="" class="form-control" value="" required />
                                                    <span class="text-danger"><?php //echo form_error('name');
                                                                                ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>NIK</label><small class="req"> *</small>
                                                    <input id="apasien_id" type="text" name="pasien_id" autocomplete="off" placeholder="" value="" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label> <?php echo lang('Word.gender'); ?></label><small class="req"> *</small>
                                                    <select class="form-control" name="gender" id="agenders" required>
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
                                                    <label>Tanggal Lahir</label><small class="req"> *</small>
                                                    <div>
                                                        <div class="input-group" id="adatebirthgroup">
                                                            <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                                                            <input id="adatebirth" name="datebirth" type="date" class="form-control" placeholder="yyyy-mm-dd" required></input>
                                                            <!-- <input id="adatebirth" name="datebirth" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container="#adatebirthgroup" required></input> -->
                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Tempat Lahir</label><small class="req"> *</small>
                                                    <input type="text" name="placebirth" id="aplacebirth" placeholder="" value="" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Darah</label><small class="req"> *</small>
                                                    <select class="form-control" id="agoldar" name="goldar" required>
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
                                                    <label for="pwd">Pernikahan</label>
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
                                                    <div id="imgprofilediv">
                                                        <input class="filestyle form-control-file" type='file' name='file' id="axampleInputFile" size='20' data-height="26" data-default-file="<?php echo base_url() ?>uploads/patient_images/no_image.png">
                                                    </div>
                                                    <span class="text-danger"><?php //echo form_error('file'); 
                                                                                ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="address">Alamat</label><small class="req"> *</small>
                                                    <input name="address" id="aaddress" placeholder="" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kalurahan">Kelurahan</label><small class="req"> *</small>
                                                    <div class="input-group">
                                                        <select name="kalurahan" id="akalurahan" class="form-control" disabled required>
                                                            <option value=""><?php echo lang('Word.select') ?></option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button id="openSearchKalurahanBtn" class="form-control" onclick="showKalurahanModal()" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="row">
                                                    <div id="calculate" class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>RT / RW</label>
                                                            <div style="clear: both;overflow: hidden;">
                                                                <input type="text" id="art" name="rt" value="" class="form-control" style="width: 30%; float: left;">
                                                                <input type="text" id="arw" name="rw" value="" class="form-control" autocomplete="off" style="width: 30%;float: left; margin-left: 4px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pwd">No Telp</label>
                                                    <input id="aphone" autocomplete="off" name="phone" type="text" placeholder="" class="form-control" value="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>HP</label><small class="req"> *</small>
                                                    <input type="text" placeholder="" id="amobile" value="" name="mobile" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--./col-md-6-->

                                    <div class="col md-12 col-sm-12 mb-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Ayah</label>
                                                    <input name="ayah" id="aayah" placeholder="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Ibu</label>
                                                    <input name="ibu" id="aibu" placeholder="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Suami/Istri</label>
                                                    <input name="sutri" id="asutri" placeholder="" class="form-control">
                                                </div>
                                            </div>
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
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <div class="row">
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
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label for="pwd">Catatan</label>
                                            <textarea name="description" id="adescription" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>No.Peserta</label>
                                                    <div class="input-group" id="akk_nogroup">
                                                        <span class="input-group-btn">
                                                            <button id="openGetPesertaBtn" class="form-control" onclick="showGetPesertaModal()" type="button"><i class="fa fa-search"></i></button>
                                                        </span>
                                                        <input name="kk_no" id="akk_no" placeholder="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Asuransi</label><small class="req">*</small>
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
                                                <div class="mb-3">
                                                    <label>TMT</label>
                                                    <div>
                                                        <div class="input-group" id="atmtgroup">
                                                            <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                                                            <input id="atmt" name="tmt" type="date" class="form-control" placeholder="dd-mm-yyyy">
                                                            <!-- <input id="atmt" name="tmt" type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-provide="datepicker" data-date-autoclose="true" data-date-container="#atmtgroup"> -->
                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="mb-3">
                                                    <label>TAT</label>
                                                    <div>
                                                        <div class="input-group" id="atatgroup">
                                                            <!-- <span class="input-group-text"><i class="mdi mdi-calendar"></i></span> -->
                                                            <input id="atat" name="tat" type="date" class="form-control" placeholder="dd-mm-yyyy">
                                                            <!-- <input id="atat" name="tat" type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-provide="datepicker" data-date-autoclose="true" data-date-container="#atatgroup"> -->
                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
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
                                            <label>Kelas</label><small class="req">*</small>
                                            <select class="form-control" id="aclass_id" name="class_id" required>
                                                <?php foreach ($kelas as $key => $value) { ?>
                                                    <option value="<?php echo $kelas[$key]['class_id']; ?>"><?php echo $kelas[$key]['name_of_class']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php //echo form_error('blood_group'); 
                                                                        ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>No. Satu Sehat</label>
                                            <div class="input-group" id="asspasien_idgroup">
                                                <span class="input-group-btn">
                                                    <button id="asspasien_idsearch" class="form-control" onclick="getPasienSatuSehat()" type="button"><i class="fa fa-search"></i></button>
                                                </span>
                                                <input name="sspasien_id" id="asspasien_id" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="" id="customfield"></div>
                                </div><!--./row-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="pull-right">
                                <button type="submit" id="formaddpabtn" data-loading-text="<?php echo lang('Word.processing'); ?>" class="btn btn-primary pull-right"><i class="fa fa-check-circle"></i> <?php echo lang('Word.save'); ?></button>
                                <button type="button" id="formeditpabtn" onclick="formpaToggleBtn()" data-loading-text="<?php echo lang('Word.processing'); ?>" class="btn btn-primary pull-right" style="display: none"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php }
} ?>
<!-- INI MODAL YANG DIPAKE BUAT CRUD BIODATA PASIEN -->
<!--END-->

<div id="addDiagnosaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addDiagnosaModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Pilih kunjungan rawat jalan yang akan dirawat-inapkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDiagnosaForm" action="" method="post" class="">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="formrow-firstname-input">Diagnosa</label>
                            <div class="input-group">
                                <!-- <label class="mb-3">Nama Pasien / No RM</label> -->
                                <input type="search" name="search_text" id="searchDiagnosaText" class=" form-control" placeholder="Kode diagnosa atau Nama diagnosa" aria-label="Kode diagnosa atau Nama diagnosa">
                                <button class="btn btn-outline-secondary" type="submit" id="searchDiagnosaBtn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-12">
                    <div id="loadingHistoryrajal"></div>
                    <table id="addDiagnosaTable" class="table table-bordered table-striped table-centered table-hover" data-export-title="Diagnosa">
                        <thead class="table-primary">
                            <tr style="text-align: center">
                                <th>Kode Diagnosa</th>
                                <th>Nama Diagnosa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ajaxlist" class="table-group-divider">
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Pilih kunjungan rawat jalan yang akan dirawat-inapkan -->
<div id="addKalurahanModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addDiagnosaModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Pilih kunjungan rawat jalan yang akan dirawat-inapkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addKalurahanForm" action="" method="post" class="">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="formrow-firstname-input">Kelurahan/Kecamatan/Kota/Provinsi</label>
                            <div class="input-group">
                                <input type="search" name="search_text" id="searchKalurahanText" class=" form-control" placeholder="Nama Kelurahan/Kecamatan/Kota/Provinsi" aria-label="Nama Kelurahan/Kecamatan/Kota/Provinsi">
                                <button class="btn btn-outline-secondary" type="submit" id="searchKalurahanBtn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-md-12">
                    <div id="loadingHistoryrajal"></div>
                    <table id="addKalurahanTable" class="table table-bordered table-striped table-centered table-hover" data-export-title="Kalurahan">
                        <thead class="table-primary">
                            <tr style="text-align: center">
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="ajaxlist" class="table-group-divider">
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- INI MODAL UNTUK GE PESERTA -->
<style>
    #searchNomorPeserta {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    #getPesertaType {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
</style>
<div id="getPesertaBpjsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="getPesertaBpjs" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title mt-0">GET PESERTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="getPesertaBpjsForm" action="" method="post" class="">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="tglSepGetPeserta">Tanggal SEP</label>
                                <input class="form-control" type="date" name="tglSEP" id="tglSepGetPeserta">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="formrow-firstname-input">Identitas Peserta</label>
                                <div class="input-group">
                                    <div class="col-md-3">
                                        <select name="getPesertaType" id="getPesertaType" class="form-control">
                                            <option value="nik">NIK</option>
                                            <option value="nokartu">No.BPJS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="search" name="search_text" id="searchNomorPeserta" class=" form-control" placeholder="Nama Kelurahan/Kecamatan/Kota/Provinsi" aria-label="Nama Kelurahan/Kecamatan/Kota/Provinsi">
                                            <button class="btn btn-outline-secondary" type="submit" id="searchGetPesertaBtn"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="resultGetPeserta" class="col-md-12">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="nokartu">No Kartu</label><input id="gpnoKartu" name="noKartu" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">No KTP/NIK</label><input id="gpnik" name="nik" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Status</label><select id="gpstatusPeserta" name="statusPeserta" class="form-control" disabled></select></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Nama</label><input id="gpnama" name="nama" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">No MR</label><input id="gpnoMR" name="noMR" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Jenis Kelamin</label><input id="gpsex" name="sex" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Informasi Dinsos</label><input id="gpdinsos" name="dinsos" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">No. SKTM</label><input id="gpnoSKTM" name="noSKTM" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Prolanis PRB</label><input id="gpprolanisPRB" name="prolanisPRB" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Jenis Peserta</label><select id="gpjenisPeserta" name="jenisPeserta" type="text" class="form-control" disabled></select></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Kelas Tanggungan</label><select id="gphakKelas" name="hakKelas" type="text" class="form-control" disabled></select></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Pisa</label><input id="gppisa" name="pisa" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">No. Telp</label><input id="gpnoTelepon" name="noTelepon" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Provider Umum</label><select id="gpprovUmum" name="provUmum" class="form-control" disabled></select></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Tgl Cetak Kartu</label><input id="gptglCetakKartu" name="tglCetakKartu" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Umur</label><input id="gpumurSekarang" name="umurSekarang" type="text" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Tanggal Lahir</label><input id="gptglLahir" name="gptglLahir" type="date" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Tanggal TAT</label><input id="gptglTAT" name="gptglTAT" type="date" class="form-control" disabled /></div>
                        </div>
                        <div class="col-sm-3 col-xs-12 mb-3">
                            <div class="form-group"><label for="">Tanggal TMT</label><input id="gptglTMT" name="gptglTMT" type="date" class="form-control" disabled /></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="terapkanGetPeserta()" type="button" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right">Terapkan<i class="fas fa-angle-double-right"></i></button>
            </div>
        </div><!-- /.modal-content rounded-4 -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->