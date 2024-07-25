<div class="tab-pane fade show active" id="catatan-keperawatan">
    <form action="" id="form-catatan-keperawatan">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        CATATAN KEPERAWATAN PRA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionCatatan">
                    <div class="card-body">
                        <form id="formvitalsign" accept-charset="utf-8" action="" enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="modal-body pt0 pb0">
                                <input id="avtclinic_id" name="clinic_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtclass_room_id" name="class_room_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtbed_id" name="bed_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtkeluar_id" name="keluar_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtemployee_id" name="employee_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtno_registration" name="no_registration" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtvisit_id" name="visit_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtorg_unit_code" name="org_unit_code" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtdoctor" name="doctor" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtkal_id" name="kal_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avttheid" name="theid" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtthename" name="thename" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avttheaddress" name="theaddress" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtstatus_pasien_id" name="status_pasien_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtisrj" name="isrj" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtgender" name="gender" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtageyear" name="ageyear" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtagemonth" name="agemonth" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtageday" name="ageday" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtbody_id" name="body_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avtmodified_by" name="modified_by" placeholder="" type="hidden" class="form-control block" value="" />
                                <input id="avttrans_id" name="trans_id" placeholder="" type="hidden" class="form-control block" value="" />
                                <!--==new -->
                                <!-- <input id="avtvs_status_id" name="vs_status_id" placeholder="" type="hidden" class="form-control block" value="" /> -->
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtanamnase" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                    Anamnesis</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtanamnase" name="anamnase" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <h3 id=""><b>Vital Sign</b></h3>
                                                <hr>
                                                <label class="col-xs-6 col-sm-6 col-md-2 col-form-label">Pemeriksaan
                                                    Fisik</label>
                                                <div class="col-xs-6 col-sm-6 col-md-10">
                                                    <div class="row mb-2">
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="weight" id="avtweight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-bb"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="height" id="avtheight" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avtheight"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="temperature" id="avttemperature" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avttemperature"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nadi" id="avtnadi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avtnadi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 " style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_upper" id="avttension_upper" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-avttension_upper"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input onchange="vitalsignInput(this)" type="text" name="tension_below" id="avttension_below" placeholder="" value="" class="form-control">
                                                                        <span class="h6" id="badge-avttension_below"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="saturasi" id="avtsaturasi" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avtsaturasi"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="nafas" id="avtnafas" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avtnafas"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="arm_diameter" id="avtarm_diameter" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avtarm_diameter"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input onchange="vitalsignInput(this)" type="text" name="oxygen_usage" id="avtoxygen_usage" placeholder="" value="" class="form-control">
                                                                    <span class="h6" id="badge-avtoxygen_usage"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id" id="avtvs_status_id">
                                                                    <option value="" selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea name="pemeriksaan" id="avtpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                        <!-- <div class="col-sm-12">
                                                        <div class="mb-4">
                                                            <div class="form-group"><label>Tanggal Periksa</label><textarea name="examination_date" id="avtpemeriksaan" placeholder="" value="" class="form-control"></textarea></div>
                                                        </div>
                                                    </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtdescription" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                    Assesment</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtdescription" name="description" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtinstruction" class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P) Rencana
                                                    Penatalaksanaan</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtinstruction" name="instruction" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4">
                                                <label for="avtexamination_date" class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                    Periksa</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group" id="avtexaminationdate">
                                                        <input id="avtexamination_date" name="examination_date" type="datetime-local" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" data-date-autoclose="true" data-date-container='#aeexaminationdate' value="<?= date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--./col-lg-7-->
                                    </div>
                                    <!--./row-->
                                    <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="examination_date">Tgl Periksa</label>
                                        <input type='text' name="examination_date" class="form-control" id='examination_date' />
                                    </div>
                                </div> -->
                                    <div class="col-sm-6" style="display: none;">
                                        <div class="form-group"><label>Perawat</label><input type="text" name="petugas" id="avtpetugas" placeholder="" value="<?= user_id(); ?>" class="form-control"></div>
                                    </div>
                                </div>
                                <span id="total_score"></span>
                            </div>
                            <div class="modal-footer">
                                <div class="panel-footer text-end mb-4">
                                    <button type="submit" id="formvitalsignsubmit" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                                    <button type="button" id="formvitalsignedit" onclick="enableVitalSign()" style="display: none;" data-loading-text="<?php echo lang('Word.processing') ?>" class="btn btn-secondary">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="accordion-body" id="template-tindakan-operasi">

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThreess">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThreess" aria-expanded="false" aria-controls="flush-collapseThreess">
                        CATATAN KEPERAWATAN INTRA OPERATIF
                    </button>
                </h2>
                <div id="flush-collapseThreess" class="accordion-collapse collapse" aria-labelledby="flush-headingThreess" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif">

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThrees">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThrees" aria-expanded="false" aria-controls="flush-collapseThrees">
                        CATATAN KEPERAWATAN PASCA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThrees" class="accordion-collapse collapse" aria-labelledby="flush-headingThrees" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanPascaOperatif">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-save-catatan-keperawatan" class="btn btn-primary btn-save-operasi">Simpan</button>
        </div>
    </form>
</div>

<script>
    // $('#btn-save-catatan-keperawatan').on('click', function(e) {
    //     // Code to handle click event

    //     e.preventDefault();
    //     tinymce.triggerSave();

    //     let formElement = $('#form-catatan-keperawatan')[0];
    //     let dataSend = new FormData(formElement);
    //     let jsonObj = {};
    //     dataSend.forEach((value, key) => {
    //         jsonObj[key] = value;
    //     });
    //     postData(jsonObj, 'admin/PatientOperationRequest/insertDataPraOprasi', (res) => {
    //         if (res.respon === true) {
    //             successSwal('Data berhasil disimpan.');
    //             $('#form-catatan-keperawatan')[0].reset();
    //             let visit_id = '<?php echo $visit['visit_id']; ?>';
    //             tinymce.remove();
    //             // getDataTables({
    //             //     visit_id: visit_id
    //             // });
    //         }
    //     });

    // });
</script>

<script type='text/javascript'>
    var mrJson;
    var lastOrder = 0;
    var vitalsign = <?= json_encode($exam); ?>;

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
        $("#avtexamination_date").val(get_date())
        // setDataVitalSign()
    })



    function setDataVitalSign() {
        $("#formvitalsign").find("input, textarea").val(null)
        $("#formvitalsign").find("#total_score").html("")
        $("#formvitalsign").find("span.h6").html("")
        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
        $("#avtbody_id").val(bodyId)
        $("#avtclinic_id").val('<?= $visit['clinic_id']; ?>')
        $("#avttrans_id").val('<?= $visit['trans_id']; ?>')
        $("#avtclass_room_id").val('<?= $visit['class_room_id']; ?>')
        $("#avtbed_id").val()
        $("#avtkeluar_id").val('<?= $visit['keluar_id']; ?>')
        $("#avtemployee_id").val('<?= $visit['employee_id']; ?>')
        $("#avtno_registration").val('<?= $visit['no_registration']; ?>')
        $("#avtvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#avtorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#avtdoctor").val('<?= $visit['fullname']; ?>')
        $("#avtkal_id").val('<?= $visit['kal_id']; ?>')
        $("#avttheid").val('<?= $visit['pasien_id']; ?>')
        $("#avtthename").val('<?= $visit['diantar_oleh']; ?>')
        $("#avttheaddress").val('<?= $visit['visitor_address']; ?>')
        $("#avtstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
        $("#avtisrj").val('<?= $visit['isrj']; ?>')
        $("#avtgender").val('<?= $visit['gender']; ?>')
        $("#avtageyear").val('<?= $visit['ageyear']; ?>')
        $("#avtagemonth").val('<?= $visit['agemonth']; ?>')
        $("#avtageday").val('<?= $visit['ageday']; ?>')
        $("#avtexamination_date").val(get_date())

        //havin
        var ageYear = <?= $visit['ageyear']; ?>;
        var ageMonth = <?= $visit['agemonth']; ?>;
        var ageDay = <?= $visit['ageday']; ?>;

        if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
            $("#avtvs_status_id").prop("selectedIndex", 3);
        } else if (ageYear >= 18) {
            $("#avtvs_status_id").prop("selectedIndex", 1);
        } else {
            $("#avtvs_status_id").prop("selectedIndex", 2);
        }
    }

    function addRowVitalSign(examselect, key) {
        $("#vitalSignBody").append($("<tr>")
                .append($("<td rowspan='7'>").append((examselect.examination_date).substring(0, 16)))
                .append($("<td rowspan='7'>").html(examselect.petugas))
                .append($("<td>").html(''))
                .append($("<td>").html('<b>Tekanan Darah</b>'))
                .append($("<td>").html('<b>Nadi</b>'))
                .append($("<td>").html('<b>Nafas/RR</b>'))
                .append($("<td>").html('<b>Temp</b>'))
                .append($("<td>").html('<b>SpO2</b>'))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="copyVitalSign(' + key +
                    ')" class="btn btn-success" data-row-id="1" autocomplete="off"><i class="fa fa-copy">Copy</i></button>' +
                    '<button type="button" onclick="editCppt(' + key +
                    ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'
                ))
                .append($("<td rowspan='7'>").html('<button type="button" onclick="removeRacik(\'' + examselect.body_id +
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
        var name = 'avt' + prop.name; //=new
        var data;
        var totalScore = [];

        if (isNaN(value) || value === "") {
            value = 0;
        } else {
            value = parseFloat(value);
        }


        switch (name) {
            case "avtnadi":
                data = getAdultScore('nadi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "avttemperature":
                data = getAdultScore('suhu', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "avtsaturasi":
                data = getAdultScore('saturasi', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "avtnafas":
                data = getAdultScore('pernapasan', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "avtoxygen_usage":
                data = getAdultScore('oksigen', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "avtweight":
                if (value < 10) {
                    value = 10.00;
                } else if (value > 50) {
                    value = 50.00;
                } else {
                    value = value.toFixed(2);
                }
                break;
            case "avttension_upper":
                if (value < 50) {
                    value = 50.00;
                } else if (value > 250) {
                    value = 250.00;
                }
                data = getAdultScore('darah', value);
                setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
                break;
            case "avtheight":
                if (value > 250) {
                    value = 250;
                }
                break;
            case "avttension_below":
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

        document.getElementById('total_score').textContent = 'Total Skor: ' + sumTextContentFromClass('badge-score');
    }

    function setBadge(propId, badgeId, className, textContent) {
        var badge = document.getElementById(badgeId);
        if (badge) {
            if (className == 'bg-light') {
                badge.className =
                    'badge-score h6 badge position-absolute top-50 start-100 translate-middle text-dark border border-1 border-dark ' +
                    className;
                badge.textContent = textContent;
            } else {
                badge.className = 'badge-score h6 badge position-absolute top-50 start-100 translate-middle ' + className;
                badge.textContent = textContent;
            }
        }
    }

    function sumTextContentFromClass(className) {
        var elements = document.getElementsByClassName(className);
        var totalSum = 0;

        for (var i = 0; i < elements.length; i++) {
            var text = elements[i].textContent.trim();
            var value = parseFloat(text);

            if (!isNaN(value)) {
                totalSum += value;
            }
        }

        return totalSum;
    }

    function disableVitalSign() {
        $("#avtexamination_date").prop("disabled", true)
        $("#avtpetugas").prop("disabled", true)
        $("#avtweight").prop("disabled", true)
        $("#avtheight").prop("disabled", true)
        $("#avttemperature").prop("disabled", true)
        $("#avtnadi").prop("disabled", true)
        $("#avttension_upper").prop("disabled", true)
        $("#avttension_below").prop("disabled", true)
        $("#avtsaturasi").prop("disabled", true)
        $("#avtnafas").prop("disabled", true)
        $("#avtarm_diameter").prop("disabled", true)
        $("#avtanamnase").prop("disabled", true)
        $("#avtoxygen_usage").prop("disabled", true)
        $("#avtvs_status_id").prop("disabled", true)
        $("#avtpemeriksaan").prop("disabled", true)
        $("#avtteraphy_desc").prop("disabled", true)
        $("#avtdescription").prop("disabled", true)
        $("#avtclinic_id").prop("disabled", true)
        $("#avttrans_id").prop("disabled", true) //==new
        $("#avtclass_room_id").prop("disabled", true)
        $("#avtbed_id").prop("disabled", true)
        $("#avtkeluar_id").prop("disabled", true)
        $("#avtemployee_id").prop("disabled", true)
        $("#avtno_registraiton").prop("disabled", true)
        $("#avtvisit_id").prop("disabled", true)
        $("#avtorg_unit_code").prop("disabled", true)
        $("#avtdoctor").prop("disabled", true)
        $("#avtkal_id").prop("disabled", true)
        $("#avttheid").prop("disabled", true)
        $("#avtthename").prop("disabled", true)
        $("#avttheaddress").prop("disabled", true)
        $("#avtstatus_pasien_id").prop("disabled", true)
        $("#avtisrj").prop("disabled", true)
        $("#avtgender").prop("disabled", true)
        $("#avtageyear").prop("disabled", true)
        $("#avtagemonth").prop("disabled", true)
        $("#avtageday").prop("disabled", true)
        $("#avtinstruction").prop("disabled", true)
    }

    function enableVitalSign() {
        $("#avtexamination_date").prop("disabled", false)
        $("#avtpetugas").prop("disabled", false)
        $("#avtweight").prop("disabled", false)
        $("#avtheight").prop("disabled", false)
        $("#avttemperature").prop("disabled", false)
        $("#avtnadi").prop("disabled", false)
        $("#avttension_upper").prop("disabled", false)
        $("#avttension_below").prop("disabled", false)
        $("#avtsaturasi").prop("disabled", false)
        $("#avtnafas").prop("disabled", false)
        $("#avtarm_diameter").prop("disabled", false)
        $("#avtoxygen_usage").prop("disabled", false)
        $("#avtvs_status_id").prop("disabled", false)
        $("#avtanamnase").prop("disabled", false)
        $("#avtpemeriksaan").prop("disabled", false)
        $("#avtteraphy_desc").prop("disabled", false)
        $("#avtdescription").prop("disabled", false)
        $("#avtclinic_id").prop("disabled", false)
        $("#avttrans_id").prop("disabled", false) //==new
        $("#avtclass_room_id").prop("disabled", false)
        $("#avtbed_id").prop("disabled", false)
        $("#avtkeluar_id").prop("disabled", false)
        $("#avtemployee_id").prop("disabled", false)
        $("#avtno_registraiton").prop("disabled", false)
        $("#avtvisit_id").prop("disabled", false)
        $("#avtorg_unit_code").prop("disabled", false)
        $("#avtdoctor").prop("disabled", false)
        $("#avtkal_id").prop("disabled", false)
        $("#avttheid").prop("disabled", false)
        $("#avtthename").prop("disabled", false)
        $("#avttheaddress").prop("disabled", false)
        $("#avtstatus_pasien_id").prop("disabled", false)
        $("#avtisrj").prop("disabled", false)
        $("#avtgender").prop("disabled", false)
        $("#avtageyear").prop("disabled", false)
        $("#avtagemonth").prop("disabled", false)
        $("#avtageday").prop("disabled", false)
        $("#avtinstruction").prop("disabled", false)

        $("#formvitalsignsubmit").toggle()
        $("#formvitalsignedit").toggle()
    }

    var vitalsigndesc = []

    var i = 0

    // for (let index = vitalsign.length; index >= 0; index--) {
    //     vitalsigndesc.push(vitalsign[index]);
    // }
    // console.log(vitalsigndesc)
    // vitalsign = vitalsigndesc

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];
        addRowVitalSign(examselect, key)
    });

    vitalsign.forEach((element, key) => {
        examselect = vitalsign[key];

        if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {

            disableVitalSign()
            $("#formvitalsignsubmit").hide()
            $("#formvitalsignedit").show()

            $("#avtclinic_id").val(examselect.clinic_id)
            $("#avtclass_room_id").val(examselect.class_room_id)
            $("#avtbed_id").val(examselect.bed_id)
            $("#avtkeluar_id").val(examselect.keluar_id)
            $("#avtemployee_id").val(examselect.employee_id)
            $("#avtno_registration").val(examselect.no_registration)
            $("#avtvisit_id").val(examselect.visit_id)
            $("#avtorg_unit_code").val(examselect.org_unit_code)
            $("#avtdoctor").val(examselect.fullname)
            $("#avtkal_id").val(examselect.kal_id)
            $("#avttheid").val(examselect.pasien_id)
            $("#avtthename").val(examselect.diantar_oleh)
            $("#avttheaddress").val(examselect.visitor_address)
            $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
            $("#avtisrj").val(examselect.isrj)
            $("#avtgender").val(examselect.gender)
            $("#avtageyear").val(examselect.ageyear)
            $("#avtagemonth").val(examselect.agemonth)
            $("#avtageday").val(examselect.ageday)
            $("#avtbody_id").val(examselect.body_id)

            $("#avtexamination_date").val(examselect.examination_date)
            $("#avtpetugas").val(examselect.petugas)
            $("#avtweight").val(examselect.weight)
            $("#avtheight").val(examselect.height)
            $("#avttemperature").val(examselect.temperature)
            $("#avtnadi").val(examselect.nadi)
            $("#avttension_upper").val(examselect.tension_upper)
            $("#avttension_below").val(examselect.tension_below)
            $("#avtsaturasi").val(examselect.saturasi)
            $("#avtnafas").val(examselect.nafas)
            $("#avtarm_diameter").val(examselect.arm_diameter)
            $("#avtanamnase").val(examselect.anamnase)
            $("#avtoxygen_usage").val(examselect.oxygen_usage)
            $("#avtvs_status_id").val(examselect.vs_status_id)
            $("#avtpemeriksaan").val(examselect.pemeriksaan)
            $("#avtteraphy_desc").val(examselect.teraphy_desc)
            $("#avtdescription").val(examselect.description)
            $("#avtclinic_id").val(examselect.clinic_id)
            $("#avttrans_id").val(examselect.trans_id) //==new
            $("#avtclass_room_id").val(examselect.class_room_id)
            $("#avtbed_id").val(examselect.bed_id)
            $("#avtkeluar_id").val(examselect.keluar_id)
            $("#avtemployee_id").val(examselect.employee_id)
            $("#avtno_registraiton").val(examselect.no_registraiton)
            $("#avtvisit_id").val(examselect.visit_id)
            $("#avtorg_unit_code").val(examselect.org_unit_code)
            $("#avtdoctor").val(examselect.doctor)
            $("#avtkal_id").val(examselect.kal_id)
            $("#avttheid").val(examselect.theid)
            $("#avtthename").val(examselect.thename)
            $("#avttheaddress").val(examselect.theaddress)
            $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
            $("#avtisrj").val(examselect.isrj)
            $("#avtgender").val(examselect.gender)
            $("#avtageyear").val(examselect.ageyear)
            $("#avtagemonth").val(examselect.agemonth)
            $("#avtageday").val(examselect.ageday)
            $("#avtinstruction").val(examselect.instruction)
        }

        if (typeof $("#avtbody_id").val() !== 'undefined' || $("#avtbody_id").val() == "") {
            $("#avtclinic_id").val('<?= $visit['clinic_id']; ?>')
            $("#avttrans_id").val('<?= $visit['trans_id']; ?>') //==new
            $("#avtclass_room_id").val('<?= $visit['class_room_id']; ?>')
            $("#avtbed_id").val()
            $("#avtkeluar_id").val('<?= $visit['keluar_id']; ?>')
            $("#avtemployee_id").val('<?= $visit['employee_id']; ?>')
            $("#avtno_registration").val('<?= $visit['no_registration']; ?>')
            $("#avtvisit_id").val('<?= $visit['visit_id']; ?>')
            $("#avtorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
            $("#avtdoctor").val('<?= $visit['fullname']; ?>')
            $("#avtkal_id").val('<?= $visit['kal_id']; ?>')
            $("#avttheid").val('<?= $visit['pasien_id']; ?>')
            $("#avtthename").val('<?= $visit['diantar_oleh']; ?>')
            $("#avttheaddress").val('<?= $visit['visitor_address']; ?>')
            $("#avtstatus_pasien_id").val('<?= $visit['status_pasien_id']; ?>')
            $("#avtisrj").val('<?= $visit['isrj']; ?>')
            $("#avtgender").val('<?= $visit['gender']; ?>')
            $("#avtageyear").val('<?= $visit['ageyear']; ?>')
            $("#avtagemonth").val('<?= $visit['agemonth']; ?>')
            $("#avtageday").val('<?= $visit['ageday']; ?>')


        }
    });
    $("#formvitalsign").on('submit', (function(e) {
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
                    // errorMsg(message);
                    errorSwal(message)
                    getVitalSign()
                } else {
                    // successMsg(data.message);
                    successSwal(data.message)
                    disableVitalSign()
                    $("#formvitalsignsubmit").toggle()
                    $("#formvitalsignedit").toggle()
                    getVitalSign()
                }
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            error: function(xhr) { // if error occured
                errorMsg("Error occured.please try again");
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            },
            complete: function() {
                clicked_submit_btn.html("<?php echo lang('Word.save'); ?>");
            }
        });
    }));

    function getVitalSign() {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getAssessmentKeperawatan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit,
                'nomor': nomor
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                vitalsign = data.examInfo
                $("#vitalSignBody").html("")
                vitalsign.forEach((element, key) => {
                    examselect = vitalsign[key];
                    addRowVitalSign(examselect, key)
                });
            },
            error: function() {

            }
        });
    }
</script>

<script>
    function copyVitalSign(key) {
        var examselect = vitalsign[key];

        var bodyId = ''

        const date = new Date();
        bodyId = date.toISOString().substring(0, 23);
        bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");

        $("#avtageday").val(examselect.ageday)
        $("#avtagemonth").val(examselect.agemonth)
        $("#avtageyear").val(examselect.ageyear)
        $("#avtanamnase").val(examselect.anamnase)
        $("#avtarm_diameter").val(examselect.arm_diameter)
        $("#avtbed_id").val(examselect.bed_id)
        $("#avtbody_id").val(bodyId)
        $("#avtclass_room_id").val(examselect.class_room_id)
        $("#avtclinic_id").val(examselect.clinic_id)
        $("#avtdescription").val(examselect.description)
        $("#avtdoctor").val(examselect.doctor)
        $("#avtemployee_id").val(examselect.employee_id)
        $("#avtexamination_date").val(get_date())
        $("#avtgender").val(examselect.gender)
        $("#avtheight").val(examselect.height)
        $("#avtinstruction").val(examselect.instruction)
        $("#avtisrj").val(examselect.isrj)
        $("#avtkal_id").val(examselect.kal_id)
        $("#avtkeluar_id").val(examselect.keluar_id)
        $("#avtnadi").val(examselect.nadi)
        $("#avtnafas").val(examselect.nafas)
        $("#avtno_registraiton").val(examselect.no_registraiton)
        $("#avtorg_unit_code").val(examselect.org_unit_code)
        $("#avtoxygen_usage").val(examselect.oxygen_usage)
        $("#avtvs_status_id").val(examselect.vs_status_id)
        $("#avtpemeriksaan").val(examselect.pemeriksaan)
        $("#avtpetugas").val(examselect.petugas)
        $("#avtsaturasi").val(examselect.saturasi)
        $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
        $("#avttemperature").val(examselect.temperature)
        $("#avttension_below").val(examselect.tension_below)
        $("#avttension_upper").val(examselect.tension_upper)
        $("#avtteraphy_desc").val(examselect.teraphy_desc)
        $("#avttheaddress").val(examselect.theaddress)
        $("#avttheid").val(examselect.pasien_id)
        $("#avtthename").val(examselect.diantar_oleh)
        $("#avtvisit_id").val(examselect.visit_id)
        $("#avtweight").val(examselect.weight)

        $("#avtorg_unit_code").val(examselect.org_unit_code)
        $("#avtpasien_diagnosa_id").val(examselect.pasien_diagnosa_id)
        $("#avtno_registration").val(examselect.no_registration)
        $("#avtvisit_id").val(examselect.visit_id)
        $("#avttrans_id").val(examselect.trans_id) //==new
        $("#avtbill_id").val(examselect.bill_id)
        $("#avtclass_room_id").val(examselect.class_room_id)
        $("#avtbed_id").val(examselect.bed_id)
        $("#avtin_date").val(examselect.in_date)
        $("#avtexit_date").val(examselect.exit_date)
        $("#avtkeluar_id").val(examselect.keluar_id)
        $("#avtimt_score").val(examselect.imt_score)
        $("#avtimt_desc").val(examselect.imt_desc)
        $("#avtoxygen_usage").val(examselect.oxygen_usage)
        $("#avtpemeriksaan").val(examselect.pemeriksaan)
        $("#avtmedical_treatment").val(examselect.medical_treatment)
        $("#avtmodified_date").val(examselect.modified_date)
        $("#avtmodified_by").val(examselect.modified_by)
        $("#avtmodified_from").val(examselect.modified_from)
        $("#avtstatus_pasien_id").val(examselect.status_pasien_id)
        $("#avtageyear").val(examselect.ageyear)
        $("#avtagemonth").val(examselect.agemonth)
        $("#avtageday").val(examselect.ageday)
        $("#avtthename").val(examselect.thename)
        $("#avttheaddress").val(examselect.theaddress)
        $("#avttheid").val(examselect.theid)
        $("#avtisrj").val(examselect.isrj)
        $("#avtgender").val(examselect.gender)
        $("#avtdoctor").val(examselect.doctor)
        $("#avtkal_id").val(examselect.kal_id)
        $("#avtpetugas_id").val(examselect.petugas_id)
        $("#avtpetugas").val(examselect.petugas)
        $("#avtaccount_id").val(examselect.account_id)
        $("#avtkesadaran").val(examselect.kesadaran)
        $("#avtisvalid").val(examselect.isvalid)

        $("#avtanamnase").val(examselect.anamnase)
        $("#avtdescription").val(examselect.description)
        $("#avtweight").val(examselect.weight)
        $("#avtheight").val(examselect.height)
        $("#avttemperature").val(examselect.temperature)
        $("#avtnadi").val(examselect.nadi)
        $("#avttension_upper").val(examselect.tension_upper)
        $("#avttension_lower").val(examselect.tension_lower)
        $("#avtsaturasi").val(examselect.saturasi)
        $("#avtnafas").val(examselect.nafas)
        $("#avtarm_diameter").val(examselect.arm_diameter)
        $("#avtoxygen_usage").val(examselect.oxygen_usage)
        $("#avtvs_status_id").val(examselect.vs_status_id)
        $("#avtpemeriksaan").val(examselect.pemeriksaan)

        //=new
        data1 = getAdultScore('nadi', examselect.nadi);
        data2 = getAdultScore('suhu', examselect.temperature);
        data3 = getAdultScore('saturasi', examselect.saturasi);
        data4 = getAdultScore('pernapasan', examselect.nafas);
        data5 = getAdultScore('oksigen', examselect.oxygen_usage);
        data6 = getAdultScore('darah', examselect.tension_upper);
        setBadge('avtnadi', 'badge-avtnadi', 'bg-' + data1.color, data1.score);
        setBadge('avttemperature', 'badge-avttemperature', 'bg-' + data2.color, data2.score);
        setBadge('avtsaturasi', 'badge-avtsaturasi', 'bg-' + data3.color, data3.score);
        setBadge('avtnafas', 'badge-avtnafas', 'bg-' + data4.color, data4.score);
        setBadge('avtoxygen_usage', 'badge-avtoxygen_usage', 'bg-' + data5.color, data5.score);
        setBadge('avttension_upper', 'badge-avttension_upper', 'bg-' + data6.color, data6.score);

        let totalSkor = data1.score + data2.score + data3.score + data4.score + data5.score + data6.score;
        document.getElementById('total_score').textContent = 'Total Skor: ' + totalSkor;
        //endofnew

        // $("#cpptModal").modal("show")
        // $("#formsaveavtbtnid").show()
        // $("#formeditavtid").hide()
    }

    function editCpptVitalSign(key) {
        var examselect = vitalsign[key];

        $.each(examselect, function(key, value) {
            $("#avt" + key).val(value)
        })
        // $("#avtvs_status_id" + examselect.vs_status_id).prop("checked", true)
        // $("#cpptModal").modal("show")
        $("#avtDocument").find("input, select, textarea").prop("disabled", false)
        $("#formsaveavtbtnid").show()
        $("#formeditavtid").hide()
        getFallRisk(examselect.body_id, "bodyFallRiskCppt")
        getGcs(examselect.body_id, "bodyGcsCppt")
        if (examselect.petugas == '<?= user()->getFullname(); ?>') {
            // alert("Tidak dapat meengubah inputan CPPT milik dokter/petugas lain")
        } else {

            // $("#cpptageday").val(examselect.ageday)
            // $("#cpptagemonth").val(examselect.agemonth)
            // $("#cpptageyear").val(examselect.ageyear)
            // $("#cpptanamnase").val(examselect.anamnase)
            // $("#cpptarm_diameter").val(examselect.arm_diameter)
            // $("#cpptbed_id").val(examselect.bed_id)
            // $("#cpptbody_id").val(examselect.body_id)
            // $("#cpptclass_room_id").val(examselect.class_room_id)
            // $("#cpptclinic_id").val(examselect.clinic_id)
            // $("#cpptdescription").val(examselect.description)
            // $("#cpptdoctor").val(examselect.doctor)
            // $("#cpptemployee_id").val(examselect.employee_id)
            // $("#cpptexamination_date").val(examselect.examination_date)
            // $("#cpptgender").val(examselect.gender)
            // $("#cpptheight").val(examselect.height)
            // $("#cpptinstruction").val(examselect.instruction)
            // $("#cpptisrj").val(examselect.isrj)
            // $("#cpptkal_id").val(examselect.kal_id)
            // $("#cpptkeluar_id").val(examselect.keluar_id)
            // $("#cpptnadi").val(examselect.nadi)
            // $("#cpptnafas").val(examselect.nafas)
            // $("#cpptno_registraiton").val(examselect.no_registraiton)
            // $("#cpptorg_unit_code").val(examselect.org_unit_code)
            // $("#cpptpemeriksaan").val(examselect.pemeriksaan)
            // $("#cpptpetugas").val(examselect.petugas)
            // $("#cpptsaturasi").val(examselect.saturasi)
            // $("#cpptstatus_pasien_id").val(examselect.status_pasien_id)
            // $("#cppttemperature").val(examselect.temperature)
            // $("#cppttension_below").val(examselect.tension_below)
            // $("#cppttension_upper").val(examselect.tension_upper)
            // $("#cpptteraphy_desc").val(examselect.teraphy_desc)
            // $("#cppttheaddress").val(examselect.theaddress)
            // $("#cppttheid").val(examselect.pasien_id)
            // $("#cpptthename").val(examselect.diantar_oleh)
            // $("#cpptvisit_id").val(examselect.visit_id)
            // $("#cpptweight").val(examselect.weight)
        }
    }
</script>