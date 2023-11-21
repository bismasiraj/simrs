<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="assessmentigd" role="tabpanel">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>


        </div><!--./col-lg-6-->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <form id="formassessmentigd" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                <div class="modal-body pt0 pb0">
                    <input id="aigdclinic_id" name="clinic_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdclass_room_id" name="class_room_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdkeluar_id" name="keluar_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdemployee_id" name="employee_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdno_registration" name="no_registration" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdvisit_id" name="visit_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdorg_unit_code" name="org_unit_code" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigddoctor" name="doctor" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdkal_id" name="kal_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdtheid" name="theid" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdthename" name="thename" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdtheaddress" name="theaddress" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdstatus_pasien_id" name="status_pasien_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdisrj" name="isrj" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdgender" name="gender" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdageyear" name="ageyear" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdagemonth" name="agemonth" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdageday" name="ageday" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdbody_id" name="body_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdmodified_by" name="modified_by" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdpasien_diagnosa_id" name="pasien_diagnosa_id" placeholder="" type="text" class="form-control block" value="" style="display: none" />
                    <input id="aigdassessment_type" name="assessment_type" placeholder="" type="text" class="form-control block" value="" style="display: none" />

                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table class="table table-borderless mt-4 mb-4">
                                    <tr>
                                        <td class="bolds">
                                            Tanggal-Jam Keberangkatan
                                        </td>
                                        <td>
                                            <!-- <input type="text" name="examination_date" id="aigdexamination_date" placeholder="" value="" class="form-control"> -->
                                            <!-- <label for="aeexamination_date" class="col-sm-2 col-form-label">Tanggal Periksa</label> -->
                                            <div class="col-sm-10">
                                                <div class="input-group" id="aigdexamination_dategroup">
                                                    <input id="aigdexamination_date" name="examination_date" type="text" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#aigdexamination_dategroup' value="<?= date('Y-m-d'); ?>">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="bolds">
                                            Rujukan
                                        </td>
                                        <td>
                                            <label class="radio-inline"><input type="radio" value="1" name="t_01">Ya</label>
                                            <label class="radio-inline"><input type="radio" value="0" name="t_01" checked>Tidak</label>
                                        </td>
                                        <td class="bolds">
                                            Dari:
                                        </td>
                                        <td>
                                            <input type="text" name="v_01" id="aigdv_01" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            Kasus
                                        </td>
                                        <td colspan="5">
                                            <label class="radio-inline"><input type="radio" value="1" name="t_02">Trauma</label>
                                            <label class="radio-inline"><input type="radio" value="2" name="t_02">Non Trauma</label>
                                            <label class="radio-inline"><input type="radio" value="3" name="t_02">True Emergency</label>
                                            <label class="radio-inline"><input type="radio" value="4" name="t_02">False Emergency</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Riwayat Alergi
                                        </td>
                                        <td>
                                            <label class="radio-inline"><input type="radio" value="1" name="t_04">Ya</label>
                                            <label class="radio-inline"><input type="radio" value="0" name="t_04" checked>Tidak</label>
                                        </td>
                                        <td class="bolds">
                                            Yaitu Obat-obatan:
                                        </td>
                                        <td>
                                            <input type="text" name="riwayat_alergi" id="aigdriwayat_alergi" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">

                                        </td>
                                        <td>
                                        </td>
                                        <td class="bolds">
                                            Makanan:
                                        </td>
                                        <td>
                                            <input type="text" name="v_02" id="aigdv_02" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">

                                        </td>
                                        <td>
                                        </td>
                                        <td class="bolds">
                                            Lingkungan:
                                        </td>
                                        <td>
                                            <input type="text" name="v_03" id="aigdv_03" placeholder="" value="" class="form-control">
                                        </td>
                                    </tr>
                                </table>
                                <h3>
                                    ANAMNESIS (Alasasan Masuk Rumah Sakit Serta Riwayat Penyakit Yang Positif)
                                </h3>
                                <table class="table table-borderless mt-4 mb-4">
                                    <tr>
                                        <td class="bolds">
                                            Auto/Alloanamnesis dengan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="alloanamnesis_contact" id="aigdalloanamnesis_contact" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                        <td class="bolds">
                                            Hubungan dengan pasien
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="alloanamnesis_hub" id="aigdalloanamnesis_hub" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            Anamnesis
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="anamnase" id="aigdanamnase" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Riwayat Penyakit Dahulu
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="diagnosa_history" id="aigddiagnosa_history" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Riwayat Pengobatan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="riwayat_obat" id="aigdriwayat_obat" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                                <h3>
                                    Pemeriksaan Fisik
                                </h3>
                                <table class="table table-borderless mt-4 mb-4">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="width: 12.5%;">Tekanan Darah</th>
                                            <th style="width: 12.5%;">Nadi</th>
                                            <th style="width: 12.5%;">RR</th>
                                            <th style="width: 12.5%;">SpO2</th>
                                            <th style="width: 12.5%;">Suhu</th>
                                            <th style="width: 12.5%;">Nyeri</th>
                                            <th style="width: 12.5%;">BB</th>
                                            <th style="width: 12.5%;">TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="tension_upper" id="aigdtension_upper" placeholder="" value="" class="form-control">
                                                <!-- <div class="col-sm-12" style="display: flex;  align-items: center;">
                                                    <input type="text" name="tension_upper" id="aigdtension_upper" placeholder="" value="" class="form-control">
                                                    <h4>/</h4>
                                                    <input type="text" name="tension_below" id="aigdtension_below" placeholder="" value="" class="form-control">
                                                </div> -->
                                            </td>
                                            <td>/</td>
                                            <td>
                                                <input onchange="assessmentIgdInput(this)" type="text" name="tension_below" id="aigdtension_below" placeholder="" value="" class="form-control">
                                            </td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="nadi" id="aigdnadi" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="nafas" id="aigdnafas" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="saturasi" id="aigdsaturasi" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="temperature" id="aigdtemperature" placeholder="" value="" class="form-control"></td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="1" name="t_012">Ya</label>
                                                <label class="radio-inline"><input type="radio" value="0" name="t_012" checked>Tidak</label>
                                            </td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="weight" id="aigdweight" placeholder="" value="" class="form-control"></td>
                                            <td><input onchange="assessmentIgdInput(this)" type="text" name="height" id="aigdheight" placeholder="" value="" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-borderless mt-4 mb-4">

                                    <tr>
                                        <td class="bolds">
                                            Pemeriksaan
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="pemeriksaan" id="aigdpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                        <td class="bolds">
                                            Status Lokalis
                                        </td>
                                        <td>
                                            <div class="col-md-12"><textarea name="lokalis" id="aigdlokalis" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>

                                    <tr>
                                        <td class="bolds">
                                            Laboratorium
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="v_33" id="aigdv_33" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Radiologi
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="v_34" id="aigdv_34" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            EKG
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="v_35" id="aigdv_35" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds">
                                            Diagnosis
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12"><textarea name="diagnosa_desc" id="aigddiagnosa_desc" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-borderless mt-4 mb-4">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%;">Tekanan Darah</th>
                                            <th style="width: 50%;">Masalah Medis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="col-md-12"><textarea name="v_36" id="aigdv_36" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                            <td>
                                                <div class="col-md-12"><textarea name="v_37" id="aigdv_37" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds" colspan="2">
                                                Rencana Asuhan / Terapi / Instruksi di IGD (Berikan Keterangan waktu/Jam jika sudah dilaksanakan)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="col-md-12"><textarea name="instruction" id="aigdinstruction" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds" colspan="2">
                                                Sasaran
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="col-md-12"><textarea name="description" id="aigddescription" placeholder="" value="" class="form-control"></textarea></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3>Tindak Lanjut</h3>
                                <table class="table table-borderless mt-4 mb-4">
                                    <tbody>
                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigdpulang" name="pulang">
                                                <label for="aigdpulang"> Pulang</label><br>
                                            </td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="1" name="t_010">Atas Ijin Dokter</label>
                                                <label class="radio-inline"><input type="radio" value="2" name="t_010">Atas Permintaan Sendiri</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigdranap" name="ranap">
                                                <label for="ranap"> Rawat Inap</label><br>
                                            </td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_010">Rawat Inap</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigddirujuk" name="dirujuk">
                                                <label for="dirujuk"> Dirujuk</label><br>
                                            </td>
                                            <td>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_011">Tempat Penuh</label>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_011">Perlu Fasilitas Lebih</label>
                                                <label class="radio-inline"><input type="radio" value="3" name="t_011">Permintaan Pasien/Keluarga</label>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="bolds">
                                                <input type="checkbox" id="aigddirujuk" name="dirujuk">
                                                <label for="aigddirujuk"> Meninggal</label><br>
                                            </td>
                                            <td>
                                                Tanggal dan Jam
                                            </td>
                                            <td>
                                                <div class="col-md-2"><input type='text' name="v_31" class="form-control" id='aigdv_31' /></div>
                                            </td>
                                            <script type="text/javascript">
                                                $(function() {
                                                    $('#aigdexamination_date').datetimepicker({
                                                        format: 'YYYY-MM-DD hh:mm:ss'
                                                    });
                                                });
                                            </script>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-borderless mt-4 mb-4">
                                    <tr>
                                        <td class="bolds" colspan="2">
                                            Rencana Asuhan / Terapi / Instruksi di IGD (Berikan Keterangan waktu/Jam jika sudah dilaksanakan)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-md-12"><textarea name="teraphy_desc" id="aigdteraphy_desc" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bolds" colspan="2">
                                            Catatan Penting (Kondisi saat keluar IGD)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-md-12"><textarea name="diagnosa_kerja" id="aigddiagnosa_kerja" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-borderless mt-4 mb-4">
                                    <tr>
                                        <td class="bolds">Tanggal Jam Edukasi</td>
                                        <td>
                                            <div class="col-md-2"><input type='text' name="education_date" class="form-control" id='aigdeducation_date' /></div>
                                        </td>
                                        <script type="text/javascript">
                                            $(function() {
                                                $('#aigdeducation_date').datetimepicker({
                                                    format: 'YYYY-MM-DD hh:mm:ss'
                                                });
                                            });
                                        </script>
                                    </tr>
                                    <tr>
                                        <td class="bolds">Penerima Edukasi</td>
                                        <td>
                                            <div class="col-md-12"><textarea name="v_39" id="aigdv_39" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                        <td class="bolds">Lainnya</td>
                                        <td>
                                            <div class="col-md-12"><textarea name="v_40" id="aigdv_40" placeholder="" value="" class="form-control"></textarea></div>
                                        </td>
                                    </tr>
                                </table>
                            </div><!--./col-lg-7-->
                        </div><!--./row-->
                        <!-- <div class="col-sm-6">
                            <div class="form-group">
                                <label for="examination_date">Tgl Periksa</label>
                                <input type='text' name="examination_date" class="form-control" id='examination_date' />
                            </div>

                        </div> -->
                        <div class="col-sm-6" style="display: none;">
                            <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="aigdpetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mb-4">
                    <div class="pull-right">
                        <button type="submit" id="formassessmentigdsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                        <button type="button" id="formassessmentigdedit" onclick="enableAssessmentIgd()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--./row-->

</div>
<!-- -->