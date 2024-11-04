<div class="tab-pane fade " id="laporan-anesthesi">
    <form action="" id="form-laporan-anesthesi">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree1000">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree1000" aria-expanded="false" aria-controls="flush-collapseThree">
                        LAPORAN ANESTHESI & SEDASI
                    </button>
                </h2>
                <div id="flush-collapseThree1000" class="accordion-collapse collapse" aria-labelledby="flush-headingThree1000" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="informasiMedis-laporan">

                    </div>
                    <div class="card-body">
                        <!-- ------------------ -->
                        <div id="vitalSignLaporanAnesthesi" class="card border-1 rounded-4 m-4 p-4" style="display: none;">
                            <div class="card-body">
                                <form id="formvitalsign-laporanAnesthesi" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                                    <div class="modal-body pt0 pb0">
                                        <input id="clinic_id-laporanAnesthesi" name="clinic_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['clinic_id']; ?>" />
                                        <input id="class_room_id-laporanAnesthesi" name="class_room_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['class_room_id']; ?>" />
                                        <input id="bed_id-laporanAnesthesi" name="bed_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['bed_id']; ?>" />
                                        <input id="keluar_id-laporanAnesthesi" name="keluar_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['keluar_id']; ?>" />
                                        <input id="employee_id-laporanAnesthesi" name="employee_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['employee_id']; ?>" />
                                        <input id="no_registration-laporanAnesthesi" name="no_registration" placeholder="" type="hidden" class="form-control block" value="<?= $visit['no_registration']; ?>" />
                                        <input id="visit_id-laporanAnesthesi" name="visit_id" placeholder="" type="hidden" class="form-control block" value="<?= $visit['visit_id']; ?>" />
                                        <input id="org_unit_code-laporanAnesthesi" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
                                        <input id="doctor-laporanAnesthesi" name="doctor" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['doctor'] ?? $visit['fullname']; ?>" />
                                        <input id="kal_id-laporanAnesthesi" name="kal_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['kal_id']; ?>" />
                                        <input id="theid-laporanAnesthesi" name="theid" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                        <input id="thename-laporanAnesthesi" name="thename" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                        <input id="theaddress-laporanAnesthesi" name="theaddress" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                        <input id="status_pasien_id-laporanAnesthesi" name="status_pasien_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['status_pasien_id']; ?>" />
                                        <input id="isrj-laporanAnesthesi" name="isrj" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['isrj']; ?>" />
                                        <input id="gender-laporanAnesthesi" name="gender" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['gender']; ?>" />
                                        <input id="ageyear-laporanAnesthesi" name="ageyear" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['ageyear']; ?>" />
                                        <input id="agemonth-laporanAnesthesi" name="agemonth" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['agemonth']; ?>" />
                                        <input id="ageday-laporanAnesthesi" name="ageday" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['ageday']; ?>" />
                                        <input id="body_id-laporanAnesthesi" name="body_id_vt" placeholder="" type="hidden" class="form-control block" value="" />
                                        <input id="modified_by-laporanAnesthesi" name="modified_by" placeholder="" type="hidden" class="form-control block" value="<?= user()->username ?>" />
                                        <input id="trans_id-laporanAnesthesi" name="trans_id" placeholder="" type="hidden" class="form-control block" value="<?= @$visit['trans_id']; ?>" />
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="anamnase-laporanAnesthesi" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S) Anamnesis</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control" id="anamnase-laporanAnesthesi" name="anamnase" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <h3><b>Vital Sign</b></h3>
                                                        <hr>
                                                        <label class="col-xs-6 col-sm-6 col-md-2 col-form-label">Pemeriksaan Fisik</label>
                                                        <div class="col-xs-6 col-sm-6 col-md-10">
                                                            <div class="row mb-2">
                                                                <!--==new -->
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Jenis EWS</label>
                                                                        <select class="form-select" name="vs_status_id" id="vs_status_id-laporanAnesthesi">
                                                                            <option value="" selected>-- pilih --</option>
                                                                            <option value="1">Dewasa</option>
                                                                            <option value="4">Anak</option>
                                                                            <option value="5">Neonatus</option>
                                                                            <option value="10">Obsetric</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!--==endofnew -->
                                                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>BB(Kg)</label>
                                                                        <div class=" position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="weight" id="weight-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-bb-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Tinggi(cm)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="height" id="height-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-height-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Suhu(°C)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="temperature" id="temperature-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-temperature-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                                    <div class="form-group">
                                                                        <label>Nadi(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="nadi" id="nadi-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-nadi-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                        <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="tension_upper-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                                <span class="h6" id="badge-tension_upper-laporanAnesthesi"></span>
                                                                            </div>
                                                                            <h4 class="mx-2">/</h4>
                                                                            <div class="position-relative">
                                                                                <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="tension_below-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                                <span class="h6" id="badge-tension_below-laporanAnesthesi"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Saturasi(SpO2%)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="saturasi-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-saturasi-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Nafas/RR(/menit)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="nafas" id="nafas-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-nafas-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Diameter Lengan(cm)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="arm_diameter-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-arm_diameter-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Penggunaan Oksigen (L/mnt)</label>
                                                                        <div class="position-relative">
                                                                            <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="oxygen_usage-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
                                                                            <span class="h6" id="badge-oxygen_usage-laporanAnesthesi"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                                    <div class="form-group">
                                                                        <label>Kesadaran</label>
                                                                        <select class="form-select" name="awareness" id="awareness-laporanAnesthesi" onchange="vitalsignInput(this)">
                                                                            <option value="0">Sadar</option>
                                                                            <option value="3">Nyeri</option>
                                                                            <option value="10">Unrespon</option>
                                                                        </select>
                                                                        <span class="h6" id="badge-awareness-laporanAnesthesi"></span>
                                                                    </div>
                                                                </div>
                                                                <div id="container-vitalsign-laporanAnesthesi">

                                                                </div>
                                                                <div class="col-sm-12 mt-2">
                                                                    <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="pemeriksaan-laporanAnesthesi" placeholder="" value="" class="form-control"></textarea></div>
                                                                </div>
                                                                <!-- <div class="col-sm-12">
                                                            <div class="mb-4">
                                                                <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="pemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                            </div>
                                                        </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="description-laporanAnesthesi" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A) Assesment</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control" id="description-laporanAnesthesi" name="description" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4" style="display: none">
                                                        <label for="instruction-laporanAnesthesi" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P) Rencana Penatalaksanaan</label>
                                                        <div class="col-sm-10">
                                                            <textarea type="text" class="form-control" id="instruction-laporanAnesthesi" name="instruction" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 mb-4">
                                                        <label for="examination_date-laporanAnesthesi" class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal Periksa</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group" id="examinationdate--laporanAnesthesi">
                                                                <input id="flatexamination_date-laporanAnesthesi" type="text" class="form-control datetimeflatpickr" placeholder="yyyy-mm-dd">
                                                                <input id="examination_date-laporanAnesthesi" name="examination_date" type="hidden" class="form-control" placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--./col-lg-7-->
                                            </div><!--./row-->
                                            <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="examination_date">Tgl Periksa</label>
                                            <input type='text' name="examination_date" class="form-control" id='examination_date' />
                                        </div>
                                    </div> -->
                                            <div class="col-sm-6" style="display: none;">
                                                <div class="form-group"><label>Perawat</label><input type="text" name="petugas-laporanAnesthesi" id="petugas-laporanAnesthesi" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                                            </div>
                                        </div>
                                        <span id="total_score-laporanAnesthesi"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="box-tab-tools text-center mt-4">
                            <a data-toggle="modal" onclick="setDataVitalSignLaporanAnesthesi()" class="btn btn-primary btn-lg" style="width: 300px"><i class=" fa fa-plus"></i> Tambah Vitalsign</a>
                        </div>
                        <h3>Histori Vital Sign</h3>
                        <table class="table table-striped table-hover">
                            <thead class=" table-primary" style="text-align: center;">
                                <tr>
                                    <th class="text-center" style="width: 10%;">Tanggal & Jam</th class="text-center">
                                    <th class="text-center" style="width: 10%;">Petugas</th class="text-center">
                                    <th class="text-center" colspan="6" style="width: 70%;">SOAP</th class="text-center">
                                    <th class="text-center" style="width: 5%;"></th class="text-center">
                                    <th class="text-center" style="width: 5%;"></th class="text-center">
                                </tr>
                            </thead>
                            <tbody id="vitalSignBodyLaporanAnesthesi">
                                <?php
                                $total = 0;
                                ?>
                            </tbody>
                        </table>
                        <!-- ----------------- -->
                    </div>
                </div>
            </div>


        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-print-laporan-anesthesi" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak
            </button>

            <button type="button" id="btn-save-laporan-anesthesi" class="btn btn-primary btn-save-operasi"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>

<script type='text/javascript'>
    var mrJson;
    var lastOrder = 0;
    var vitalsign = <?= json_encode($exam); ?>;
    var visit = '<?= $visit['visit_id']; ?>'
    var nomor = '<?= $visit['no_registration']; ?>';

    $(document).ready(function(e) {

        var nomor = '<?= $visit['no_registration']; ?>';
        var ke = '%'
        var mulai = '2023-08-01' //tidak terpakai
        var akhir = '2023-08-31' //tidak terpakai
        var lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        var klinik = '%'
        var rj = '%'
        var status = '%'
        var nota = '%'
        var trans = '<?= $visit['trans_id']; ?>'
        var visit = '<?= $visit['visit_id']; ?>'
        $("#examination_date").val(get_date())
        // setDataVitalSign()


    })

    $("#flush-headingThree1000").on("click", function() {
        getVitalSignLaporanAnesthesi()
    })

    // $("#vs_status_id-laporanAnesthesi").on("change", function() {
    //     var optionSelected = $("option:selected", this);
    //     console.log(optionSelected.val());
    //     $('#container-vitalsign-laporanAnesthesi').empty();

    //     switch (optionSelected.val()) {
    //         case '4':
    //             let isi = `
    //             <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
    //                             <div class="form-group">
    //                                 <label>aaaaaa</label>
    //                                 <div class="position-relative">
    //                                     <input onchange="vitalsignInput(this)" type="text" name="temperature" id="temperature-laporanAnesthesi" placeholder="" value="" class="form-control vitalsignclass" autocomplete="off">
    //                                     <span class="h6" id="badge-temperature-laporanAnesthesi"></span>
    //                                 </div>
    //                             </div>
    //                         </div>`;
    //             console.log(isi);
    //             $('#container-vitalsign-laporanAnesthesi').append(isi);
    //             break;
    //         case '10':
    //             break;
    //     }
    //     $('.vitalsignclass-laporanAnesthesi').each((index, each) => {
    //         $(each).change(element => {
    //             vitalsignInput({
    //                 value: $(each).val(),
    //                 name: $(each).attr('name'),
    //                 uniq_name: '-laporanAnesthesi',
    //                 type: optionSelected.val()
    //             })
    //         })
    //         vitalsignInput({
    //             value: $(each).val(),
    //             name: $(each).attr('name'),
    //             uniq_name: '-laporanAnesthesi',
    //             type: optionSelected.val()
    //         })
    //     });
    // })

    $("#formvitalsign-laporanAnesthesi").on('submit', (function(e) {
        let clicked_submit_btn = $(this).closest('form').find(':submit');
        e.preventDefault();
        clicked_submit_btn.html('<i class="spinner-border spinner-border-sm"></i>')
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/Assessment/saveExaminationInfo', //==new
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
                    // errorSwal(message);
                    errorSwal(message)
                    getVitalSign()
                } else {
                    // successSwal(data.message);
                    successSwal(data.message)
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
                    getVitalSign()
                }
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            error: function(xhr) { // if error occured
                errorSwal("Error occured.please try again");
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            complete: function() {
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            }
        });
    }));

    function setDataVitalSignLaporanAnesthesi() {
        $("#formvitalsign-laporanAnesthesi").find("input, textarea").val(null)
        $("#formvitalsign-laporanAnesthesi").find("#total_score-laporanAnesthesi").html("")
        $("#formvitalsign-laporanAnesthesi").find("span.h6").html("")
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#body_id-laporanAnesthesi").val(bodyId)
        $("#clinic_id-laporanAnesthesi").val('<?= $visit['clinic_id']; ?>')
        $("#trans_id-laporanAnesthesi").val('<?= $visit['trans_id']; ?>')
        $("#class_room_id-laporanAnesthesi").val('<?= $visit['class_room_id']; ?>')
        $("#bed_id-laporanAnesthesi").val()
        $("#keluar_id-laporanAnesthesi").val('<?= $visit['keluar_id']; ?>')
        $("#employee_id-laporanAnesthesi").val('<?= $visit['employee_id']; ?>')
        $("#no_registration-laporanAnesthesi").val('<?= $visit['no_registration']; ?>')
        $("#visit_id-laporanAnesthesi").val('<?= $visit['visit_id']; ?>')
        $("#org_unit_code-laporanAnesthesi").val('<?= $visit['org_unit_code']; ?>')
        $("#doctor-laporanAnesthesi").val('<?= $visit['fullname']; ?>')
        $("#kal_id-laporanAnesthesi").val('<?= $visit['kal_id']; ?>')
        $("#theid-laporanAnesthesi").val('<?= $visit['pasien_id']; ?>')
        $("#thename-laporanAnesthesi").val('<?= $visit['diantar_oleh']; ?>')
        $("#theaddress-laporanAnesthesi").val('<?= $visit['visitor_address']; ?>')
        $("#status_pasien_id-laporanAnesthesi").val('<?= $visit['status_pasien_id']; ?>')
        $("#isrj-laporanAnesthesi").val('<?= $visit['isrj']; ?>')
        $("#gender-laporanAnesthesi").val('<?= $visit['gender']; ?>')
        $("#ageyear-laporanAnesthesi").val('<?= $visit['ageyear']; ?>')
        $("#agemonth-laporanAnesthesi").val('<?= $visit['agemonth']; ?>')
        $("#ageday-laporanAnesthesi").val('<?= $visit['ageday']; ?>')
        $("#examination_date-laporanAnesthesi").val(get_date())

        //havin
        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#vs_status_id-laporanAnesthesi").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#vs_status_id-laporanAnesthesi").prop("selectedIndex", 1);
        } else {
            $("#vs_status_id-laporanAnesthesi").prop("selectedIndex", 2);
        }
        enableVitalSignLaporanAnesthesi()
        $("#vitalSignLaporanAnesthesi").slideDown()
    }


    const addRowVitalSigncatatanLaporanAnesthesi = (examselect, key) => {
        $("#vitalSignBodyLaporanAnesthesi").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date)?.substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="copyVitalSignLaporanAnesthesi(' + key +
                    ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>'
                ))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect
                    .body_id +
                    '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'
                ))
            )
            .append($("<tr>")
                .append($("<td>").html(''))
                .append($("<td>").html(examselect.tension_upper + '/' + examselect.tension_below + 'mmHg'))
                .append($("<td>").html(examselect.nadi + '/menit'))
                .append($("<td>").html(examselect.nafas + '/menit'))
                .append($("<td>").html(examselect.temperature + '/°C'))
                .append($("<td>").html(examselect.saturasi + '/SpO2%'))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>S</b>"))
                .append($("<td colspan='5'>").html(examselect.anamnase))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>O</b>"))
                .append($("<td colspan='5'>").html(examselect.pemeriksaan))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>A</b>"))
                .append($("<td colspan='5'>").html(examselect.description))
            )
            .append($("<tr>")
                .append($("<td>").html("<b>P</b>"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
            .append($("<tr>")
                .append($("<td>").html("Instruksi"))
                .append($("<td colspan='5'>").html(examselect.instruction))
            )
    }

    function vitalsignInput(prop) {
        var value = prop.value.trim();
        var name = '' + prop.name + `-LaporanAnesthesi`; //=new
        var data;
        var totalScore = [];

        if (isNaN(value) || value === "") {
            value = 0;
        } else {
            value = parseFloat(value);
        }

        let scoreFunction;
        if (prop.type == 1) {
            scoreFunction = getAdultScore;
        } else {
            scoreFunction = getNeonatalScore;
        }
        switch (name) {

            case "nadi-laporanAnesthesi":
                data = scoreFunction('nadi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "temperature-laporanAnesthesi":
                data = scoreFunction('suhu', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "saturasi-laporanAnesthesi":
                data = scoreFunction('saturasi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "nafas-laporanAnesthesi":
                data = scoreFunction('pernapasan', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "oxygen_usage-laporanAnesthesi":
                data = scoreFunction('oksigen', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "weight-laporanAnesthesi":
                if (value < 10) {
                    value = 10.00;
                } else if (value > 50) {
                    value = 50.00;
                } else {
                    value = value.toFixed(2);
                }
                break;
            case "tension_upper-laporanAnesthesi":
                if (value < 50) {
                    value = 50.00;
                } else if (value > 250) {
                    value = 250.00;
                }
                data = scoreFunction('darah', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "height-laporanAnesthesi":
                if (value > 250) {
                    value = 250;
                }
                break;
            case "tension_below-laporanAnesthesi":
                if (value < 0) {
                    value = 0.00;
                } else if (value > 300) {
                    value = 300.00;
                }
                break;
            default:
                break;
        }

        prop.value = value;

        document.getElementById('total_score-laporanAnesthesi').textContent = 'Total Skor: ' +
            sumTextContentFromClass(
                'badge-score');
    }


    function disableVitalSignLaporanAnesthesi() {
        $("#examination_date-laporanAnesthesi").prop("disabled", true)
        $("#petugas-laporanAnesthesi").prop("disabled", true)
        $("#weight-laporanAnesthesi").prop("disabled", true)
        $("#height-laporanAnesthesi").prop("disabled", true)
        $("#temperature-laporanAnesthesi").prop("disabled", true)
        $("#nadi-laporanAnesthesi").prop("disabled", true)
        $("#tension_upper-laporanAnesthesi").prop("disabled", true)
        $("#tension_below-laporanAnesthesi").prop("disabled", true)
        $("#saturasi-laporanAnesthesi").prop("disabled", true)
        $("#nafas-laporanAnesthesi").prop("disabled", true)
        $("#arm_diameter-laporanAnesthesi").prop("disabled", true)
        $("#anamnase-laporanAnesthesi").prop("disabled", true)
        $("#oxygen_usage-laporanAnesthesi").prop("disabled", true)
        $("#vs_status_id-laporanAnesthesi").prop("disabled", true)
        $("#pemeriksaan-laporanAnesthesi").prop("disabled", true)
        $("#teraphy_desc-laporanAnesthesi").prop("disabled", true)
        $("#description-laporanAnesthesi").prop("disabled", true)
        $("#clinic_id-laporanAnesthesi").prop("disabled", true)
        $("#trans_id-laporanAnesthesi").prop("disabled", true) //==new
        $("#class_room_id-laporanAnesthesi").prop("disabled", true)
        $("#bed_id-laporanAnesthesi").prop("disabled", true)
        $("#keluar_id-laporanAnesthesi").prop("disabled", true)
        $("#employee_id-laporanAnesthesi").prop("disabled", true)
        $("#no_registraiton-laporanAnesthesi").prop("disabled", true)
        $("#visit_id-laporanAnesthesi").prop("disabled", true)
        $("#org_unit_code-laporanAnesthesi").prop("disabled", true)
        $("#doctor-laporanAnesthesi").prop("disabled", true)
        $("#kal_id-laporanAnesthesi").prop("disabled", true)
        $("#theid-laporanAnesthesi").prop("disabled", true)
        $("#thename-laporanAnesthesi").prop("disabled", true)
        $("#theaddress-laporanAnesthesi").prop("disabled", true)
        $("#status_pasien_id-laporanAnesthesi").prop("disabled", true)
        $("#isrj-laporanAnesthesi").prop("disabled", true)
        $("#gender-laporanAnesthesi").prop("disabled", true)
        $("#ageyear-laporanAnesthesi").prop("disabled", true)
        $("#agemonth-laporanAnesthesi").prop("disabled", true)
        $("#ageday-laporanAnesthesi").prop("disabled", true)
        $("#instruction-laporanAnesthesi").prop("disabled", true)
        $("#formvitalsignsubmit-laporanAnesthesi").hide()
        $("#formvitalsignedit").show()
    }

    function enableVitalSignLaporanAnesthesi() {
        $("#examination_date-laporanAnesthesi").prop("disabled", false)
        $("#petugas-laporanAnesthesi").prop("disabled", false)
        $("#weight-laporanAnesthesi").prop("disabled", false)
        $("#height-laporanAnesthesi").prop("disabled", false)
        $("#temperature-laporanAnesthesi").prop("disabled", false)
        $("#nadi-laporanAnesthesi").prop("disabled", false)
        $("#tension_upper-laporanAnesthesi").prop("disabled", false)
        $("#tension_below-laporanAnesthesi").prop("disabled", false)
        $("#saturasi-laporanAnesthesi").prop("disabled", false)
        $("#nafas-laporanAnesthesi").prop("disabled", false)
        $("#arm_diameter-laporanAnesthesi").prop("disabled", false)
        $("#oxygen_usage-laporanAnesthesi").prop("disabled", false)
        $("#vs_status_id-laporanAnesthesi").prop("disabled", false)
        $("#anamnase-laporanAnesthesi").prop("disabled", false)
        $("#pemeriksaan-laporanAnesthesi").prop("disabled", false)
        $("#teraphy_desc-laporanAnesthesi").prop("disabled", false)
        $("#description-laporanAnesthesi").prop("disabled", false)
        $("#clinic_id-laporanAnesthesi").prop("disabled", false)
        $("#trans_id-laporanAnesthesi").prop("disabled", false) //==new
        $("#class_room_id-laporanAnesthesi").prop("disabled", false)
        $("#bed_id-laporanAnesthesi").prop("disabled", false)
        $("#keluar_id-laporanAnesthesi").prop("disabled", false)
        $("#employee_id-laporanAnesthesi").prop("disabled", false)
        $("#no_registraiton-laporanAnesthesi").prop("disabled", false)
        $("#visit_id-laporanAnesthesi").prop("disabled", false)
        $("#org_unit_code-laporanAnesthesi").prop("disabled", false)
        $("#doctor-laporanAnesthesi").prop("disabled", false)
        $("#kal_id-laporanAnesthesi").prop("disabled", false)
        $("#theid-laporanAnesthesi").prop("disabled", false)
        $("#thename-laporanAnesthesi").prop("disabled", false)
        $("#theaddress-laporanAnesthesi").prop("disabled", false)
        $("#status_pasien_id-laporanAnesthesi").prop("disabled", false)
        $("#isrj-laporanAnesthesi").prop("disabled", false)
        $("#gender-laporanAnesthesi").prop("disabled", false)
        $("#ageyear-laporanAnesthesi").prop("disabled", false)
        $("#agemonth-laporanAnesthesi").prop("disabled", false)
        $("#ageday-laporanAnesthesi").prop("disabled", false)
        $("#instruction-laporanAnesthesi").prop("disabled", false)

        $("#formvitalsignsubmit-laporanAnesthesi").show()
        $("#formvitalsignedit").hide()
    }

    function copyVitalSignLaporanAnesthesi(key) {
        var examselect = vitalsign[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#ageday-laporanAnesthesi").val(examselect.ageday)
        $("#agemonth-laporanAnesthesi").val(examselect.agemonth)
        $("#ageyear-laporanAnesthesi").val(examselect.ageyear)
        $("#anamnase-laporanAnesthesi").val(examselect.anamnase)
        $("#arm_diameter-laporanAnesthesi").val(examselect.arm_diameter)
        $("#bed_id-laporanAnesthesi").val(examselect.bed_id)
        $("#body_id-laporanAnesthesi").val(examselect.body_id)
        $("#class_room_id-laporanAnesthesi").val(examselect.class_room_id)
        $("#clinic_id-laporanAnesthesi").val(examselect.clinic_id)
        $("#description-laporanAnesthesi").val(examselect.description)
        $("#doctor-laporanAnesthesi").val(examselect.doctor)
        $("#employee_id-laporanAnesthesi").val(examselect.employee_id)
        $("flatexamination_date-laporanAnesthesi").val(nowtime).trigger("change")
        $("#gender-laporanAnesthesi").val(examselect.gender)
        $("#height-laporanAnesthesi").val(examselect.height)
        $("#instruction-laporanAnesthesi").val(examselect.instruction)
        $("#isrj-laporanAnesthesi").val(examselect.isrj)
        $("#kal_id-laporanAnesthesi").val(examselect.kal_id)
        $("#keluar_id-laporanAnesthesi").val(examselect.keluar_id)
        $("#nadi-laporanAnesthesi").val(examselect.nadi)
        $("#nafas-laporanAnesthesi").val(examselect.nafas)
        $("#no_registraiton-laporanAnesthesi").val(examselect.no_registraiton)
        $("#org_unit_code-laporanAnesthesi").val(examselect.org_unit_code)
        $("#oxygen_usage-laporanAnesthesi").val(examselect.oxygen_usage)
        $("#vs_status_id-laporanAnesthesi").val(examselect.vs_status_id)
        $("#pemeriksaan-laporanAnesthesi").val(examselect.pemeriksaan)
        $("#petugas-laporanAnesthesi").val(examselect.petugas)
        $("#saturasi-laporanAnesthesi").val(examselect.saturasi)
        $("#status_pasien_id-laporanAnesthesi").val(examselect.status_pasien_id)
        $("#temperature-laporanAnesthesi").val(examselect.temperature)
        $("#tension_below-laporanAnesthesi").val(examselect.tension_below)
        $("#tension_upper-laporanAnesthesi").val(examselect.tension_upper)
        $("#teraphy_desc-laporanAnesthesi").val(examselect.teraphy_desc)
        $("#theaddress-laporanAnesthesi").val(examselect.theaddress)
        $("#theid-laporanAnesthesi").val(examselect.pasien_id)
        $("#thename-laporanAnesthesi").val(examselect.diantar_oleh)
        $("#visit_id-laporanAnesthesi").val(examselect.visit_id)
        $("#weight-laporanAnesthesi").val(examselect.weight)

        $("#org_unit_code-laporanAnesthesi").val(examselect.org_unit_code)
        $("#pasien_diagnosa_id-laporanAnesthesi").val(examselect.pasien_diagnosa_id)
        $("#no_registration-laporanAnesthesi").val(examselect.no_registration)
        $("#visit_id-laporanAnesthesi").val(examselect.visit_id)
        $("#trans_id-laporanAnesthesi").val(examselect.trans_id) //==new
        $("#bill_id-laporanAnesthesi").val(examselect.bill_id)
        $("#class_room_id-laporanAnesthesi").val(examselect.class_room_id)
        $("#bed_id-laporanAnesthesi").val(examselect.bed_id)
        $("#in_date-laporanAnesthesi").val(examselect.in_date)
        $("#exit_date-laporanAnesthesi").val(examselect.exit_date)
        $("#keluar_id-laporanAnesthesi").val(examselect.keluar_id)
        $("#imt_score-laporanAnesthesi").val(examselect.imt_score)
        $("#imt_desc-laporanAnesthesi").val(examselect.imt_desc)
        $("#oxygen_usage-laporanAnesthesi").val(examselect.oxygen_usage)
        $("#pemeriksaan-laporanAnesthesi").val(examselect.pemeriksaan)
        $("#medical_treatment-laporanAnesthesi").val(examselect.medical_treatment)
        $("#modified_date-laporanAnesthesi").val(examselect.modified_date)
        $("#modified_by-laporanAnesthesi").val(examselect.modified_by)
        $("#modified_from-laporanAnesthesi").val(examselect.modified_from)
        $("#status_pasien_id-laporanAnesthesi").val(examselect.status_pasien_id)
        $("#ageyear-laporanAnesthesi").val(examselect.ageyear)
        $("#agemonth-laporanAnesthesi").val(examselect.agemonth)
        $("#ageday-laporanAnesthesi").val(examselect.ageday)
        $("#thename-laporanAnesthesi").val(examselect.thename)
        $("#theaddress-laporanAnesthesi").val(examselect.theaddress)
        $("#theid-laporanAnesthesi").val(examselect.theid)
        $("#isrj-laporanAnesthesi").val(examselect.isrj)
        $("#gender-laporanAnesthesi").val(examselect.gender)
        $("#doctor-laporanAnesthesi").val(examselect.doctor)
        $("#kal_id-laporanAnesthesi").val(examselect.kal_id)
        $("#petugas_id-laporanAnesthesi").val(examselect.petugas_id)
        $("#petugas-laporanAnesthesi").val(examselect.petugas)
        $("#account_id-laporanAnesthesi").val(examselect.account_id)
        $("#kesadaran-laporanAnesthesi").val(examselect.kesadaran)
        $("#isvalid-laporanAnesthesi").val(examselect.isvalid)

        $("#anamnase-laporanAnesthesi").val(examselect.anamnase)
        $("#description-laporanAnesthesi").val(examselect.description)
        $("#weight-laporanAnesthesi").val(examselect.weight).trigger("change")
        $("#height-laporanAnesthesi").val(examselect.height).trigger("change")
        $("#temperature-laporanAnesthesi").val(examselect.temperature).trigger("change")
        $("#nadi-laporanAnesthesi").val(examselect.nadi).trigger("change")
        $("#tension_upper-laporanAnesthesi").val(examselect.tension_upper).trigger("change")
        $("#tension_lower-laporanAnesthesi").val(examselect.tension_lower).trigger("change")
        $("#saturasi-laporanAnesthesi").val(examselect.saturasi).trigger("change")
        $("#nafas-laporanAnesthesi").val(examselect.nafas).trigger("change")
        $("#arm_diameter-laporanAnesthesi").val(examselect.arm_diameter).trigger("change")
        $("#oxygen_usage-laporanAnesthesi").val(examselect.oxygen_usage).trigger("change")
        $("#vs_status_id-laporanAnesthesi").val(examselect.vs_status_id).trigger("change")
        $("#pemeriksaan-laporanAnesthesi").val(examselect.pemeriksaan).trigger("change")

        $("#vitalSignLaporanAnesthesi").slideDown()
        enableVitalSignLaporanAnesthesi()
        //=new
        // data1 = getAdultScore('nadi', examselect.nadi);
        // data2 = getAdultScore('suhu', examselect.temperature);
        // data3 = getAdultScore('saturasi', examselect.saturasi);
        // data4 = getAdultScore('pernapasan', examselect.nafas);
        // data5 = getAdultScore('oksigen', examselect.oxygen_usage);
        // data6 = getAdultScore('darah', examselect.tension_upper);

        // let totalSkor = data1.score + data2.score + data3.score + data4.score + data5.score + data6.score;
        // document.getElementById('total_score').textContent = 'Total Skor: ' + totalSkor;
        //endofnew

        // $("#cpptModal").modal("show")
        // $("#formsavebtnid").show()
        // $("#formeditid").hide()
    }
    var vitalsigndesc = []

    var i = 0

    // for (let index = vitalsign.length; index >= 0; index--) {
    //     vitalsigndesc.push(vitalsign[index]);
    // }
    // console.log(vitalsigndesc)
    // vitalsign = vitalsigndesc
    $(function() {
        vitalsign.forEach((element, key) => {
            examselect = vitalsign[key];
            addRowVitalSigncatatanLaporanAnesthesi(examselect, key)
        });

        vitalsign.forEach((element, key) => {
            examselect = vitalsign[key];

            if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {

                disableVitalSignLaporanAnesthesi()
                $("#formvitalsignsubmit-laporanAnesthesi").hide()
                $("#formvitalsignedit-laporanAnesthesi").show()

                $("#clinic_id-laporanAnesthesi").val(examselect.clinic_id)
                $("#class_room_id-laporanAnesthesi").val(examselect.class_room_id)
                $("#bed_id-laporanAnesthesi").val(examselect.bed_id)
                $("#keluar_id-laporanAnesthesi").val(examselect.keluar_id)
                $("#employee_id-laporanAnesthesi").val(examselect.employee_id)
                $("#no_registration-laporanAnesthesi").val(examselect.no_registration)
                $("#visit_id-laporanAnesthesi").val(examselect.visit_id)
                $("#org_unit_code-laporanAnesthesi").val(examselect.org_unit_code)
                $("#doctor-laporanAnesthesi").val(examselect.fullname)
                $("#kal_id-laporanAnesthesi").val(examselect.kal_id)
                $("#theid-laporanAnesthesi").val(examselect.pasien_id)
                $("#thename-laporanAnesthesi").val(examselect.diantar_oleh)
                $("#theaddress-laporanAnesthesi").val(examselect.visitor_address)
                $("#status_pasien_id-laporanAnesthesi").val(examselect.status_pasien_id)
                $("#isrj-laporanAnesthesi").val(examselect.isrj)
                $("#gender-laporanAnesthesi").val(examselect.gender)
                $("#ageyear-laporanAnesthesi").val(examselect.ageyear)
                $("#agemonth-laporanAnesthesi").val(examselect.agemonth)
                $("#ageday-laporanAnesthesi").val(examselect.ageday)
                $("#body_id-laporanAnesthesi").val(examselect.body_id)

                $("#examination_date-laporanAnesthesi").val(examselect.examination_date)
                $("#petugas-laporanAnesthesi").val(examselect.petugas)
                $("#weight-laporanAnesthesi").val(examselect.weight)
                $("#height-laporanAnesthesi").val(examselect.height)
                $("#temperature-laporanAnesthesi").val(examselect.temperature)
                $("#nadi-laporanAnesthesi").val(examselect.nadi)
                $("#tension_upper-laporanAnesthesi").val(examselect.tension_upper)
                $("#tension_below-laporanAnesthesi").val(examselect.tension_below)
                $("#saturasi-laporanAnesthesi").val(examselect.saturasi)
                $("#nafas-laporanAnesthesi").val(examselect.nafas)
                $("#arm_diameter-laporanAnesthesi").val(examselect.arm_diameter)
                $("#anamnase-laporanAnesthesi").val(examselect.anamnase)
                $("#oxygen_usage-laporanAnesthesi").val(examselect.oxygen_usage)
                $("#vs_status_id-laporanAnesthesi").val(examselect.vs_status_id)
                $("#pemeriksaan-laporanAnesthesi").val(examselect.pemeriksaan)
                $("#teraphy_desc-laporanAnesthesi").val(examselect.teraphy_desc)
                $("#description-laporanAnesthesi").val(examselect.description)
                $("#clinic_id-laporanAnesthesi").val(examselect.clinic_id)
                $("#trans_id-laporanAnesthesi").val(examselect.trans_id) //==new
                $("#class_room_id-laporanAnesthesi").val(examselect.class_room_id)
                $("#bed_id-laporanAnesthesi").val(examselect.bed_id)
                $("#keluar_id-laporanAnesthesi").val(examselect.keluar_id)
                $("#employee_id-laporanAnesthesi").val(examselect.employee_id)
                $("#no_registraiton-laporanAnesthesi").val(examselect.no_registraiton)
                $("#visit_id-laporanAnesthesi").val(examselect.visit_id)
                $("#org_unit_code-laporanAnesthesi").val(examselect.org_unit_code)
                $("#doctor-laporanAnesthesi").val(examselect.doctor)
                $("#kal_id-laporanAnesthesi").val(examselect.kal_id)
                $("#theid-laporanAnesthesi").val(examselect.theid)
                $("#thename-laporanAnesthesi").val(examselect.thename)
                $("#theaddress-laporanAnesthesi").val(examselect.theaddress)
                $("#status_pasien_id-laporanAnesthesi").val(examselect.status_pasien_id)
                $("#isrj-laporanAnesthesi").val(examselect.isrj)
                $("#gender-laporanAnesthesi").val(examselect.gender)
                $("#ageyear-laporanAnesthesi").val(examselect.ageyear)
                $("#agemonth-laporanAnesthesi").val(examselect.agemonth)
                $("#ageday-laporanAnesthesi").val(examselect.ageday)
                $("#instruction-laporanAnesthesi").val(examselect.instruction)
            }

            if (typeof $("#body_id-laporanAnesthesi").val() !== 'undefined' || $(
                    "#body_id-laporanAnesthesi")
                .val() == "-laporanAnesthesi") {
                $("#clinic_id-laporanAnesthesi").val('<?= $visit['clinic_id']; ?>')
                $("#trans_id-laporanAnesthesi").val('<?= $visit['trans_id']; ?>') //==new
                $("#class_room_id-laporanAnesthesi").val('<?= $visit['class_room_id']; ?>')
                $("#bed_id-laporanAnesthesi").val()
                $("#keluar_id-laporanAnesthesi").val('<?= $visit['keluar_id']; ?>')
                $("#employee_id-laporanAnesthesi").val('<?= $visit['employee_id']; ?>')
                $("#no_registration-laporanAnesthesi").val('<?= $visit['no_registration']; ?>')
                $("#visit_id-laporanAnesthesi").val('<?= $visit['visit_id']; ?>')
                $("#org_unit_code-laporanAnesthesi").val('<?= $visit['org_unit_code']; ?>')
                $("#doctor-laporanAnesthesi").val('<?= $visit['fullname']; ?>')
                $("#kal_id-laporanAnesthesi").val('<?= $visit['kal_id']; ?>')
                $("#theid-laporanAnesthesi").val('<?= $visit['pasien_id']; ?>')
                $("#thename-laporanAnesthesi").val('<?= $visit['diantar_oleh']; ?>')
                $("#theaddress-laporanAnesthesi").val('<?= $visit['visitor_address']; ?>')
                $("#status_pasien_id-laporanAnesthesi").val('<?= $visit['status_pasien_id']; ?>')
                $("#isrj-laporanAnesthesi").val('<?= $visit['isrj']; ?>')
                $("#gender-laporanAnesthesi").val('<?= $visit['gender']; ?>')
                $("#ageyear-laporanAnesthesi").val('<?= $visit['ageyear']; ?>')
                $("#agemonth-laporanAnesthesi").val('<?= $visit['agemonth']; ?>')
                $("#ageday-laporanAnesthesi").val('<?= $visit['ageday']; ?>')


            }
        });

    })

    function getVitalSignLaporanAnesthesi() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/PatientOperationRequest/getExaminfo',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor,
                'account_id': '11'
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                vitalsign = data.examInfo
                $("#vitalSignBodyLaporanAnesthesi").html("")
                vitalsign.forEach((element, key) => {
                    examselect = vitalsign[key];
                    addRowVitalSigncatatanLaporanAnesthesi(examselect, key)
                });
            },
            error: function() {

            }
        });
    }
</script>