<script src="<?= base_url('assets/js/default.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="tab-pane fade show active" id="catatan-keperawatan">
    <form action="" id="form-catatan-keperawatan">
        <div id="accordionCatatan" class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        CATATAN KEPERAWATAN PRA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionCatatan">
                    <div class="card-body">
                        <!-- ------------------ -->
                        <form id="formvitalsign-catatanKeperawatan" accept-charset="utf-8" action=""
                            enctype="multipart/form-data" method="post" class="ptt10">
                            <div class="modal-body pt0 pb0">
                                <input id="avtclinic_id-catatanKeperawatan" name="clinic_id" placeholder=""
                                    type="hidden" class="form-control block" value="<?= $visit['clinic_id']; ?>" />
                                <input id="avtclass_room_id-catatanKeperawatan" name="class_room_id" placeholder=""
                                    type="hidden" class="form-control block" value="<?= $visit['class_room_id']; ?>" />
                                <input id="avtbed_id-catatanKeperawatan" name="bed_id" placeholder="" type="hidden"
                                    class="form-control block" value="<?= $visit['bed_id']; ?>" />
                                <input id="avtkeluar_id-catatanKeperawatan" name="keluar_id" placeholder=""
                                    type="hidden" class="form-control block" value="<?= $visit['keluar_id']; ?>" />
                                <input id="avtemployee_id-catatanKeperawatan" name="employee_id" placeholder=""
                                    type="hidden" class="form-control block" value="<?= $visit['employee_id']; ?>" />
                                <input id="avtno_registration-catatanKeperawatan" name="no_registration" placeholder=""
                                    type="hidden" class="form-control block"
                                    value="<?= $visit['no_registration']; ?>" />
                                <input id="avtvisit_id-catatanKeperawatan" name="visit_id" placeholder="" type="hidden"
                                    class="form-control block" value="<?= $visit['visit_id']; ?>" />
                                <input id="avtorg_unit_code-catatanKeperawatan" name="org_unit_code" placeholder=""
                                    type="hidden" class="form-control block" value="<?= $visit['org_unit_code']; ?>" />
                                <input id="avtdoctor-catatanKeperawatan" name="doctor" placeholder="" type="hidden"
                                    class="form-control block"
                                    value="<?= @$visit['doctor'] ?? $visit['fullname']; ?>" />
                                <input id="avtkal_id-catatanKeperawatan" name="kal_id" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['kal_id']; ?>" />
                                <input id="avttheid-catatanKeperawatan" name="theid" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="avtthename-catatanKeperawatan" name="thename" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="avttheaddress-catatanKeperawatan" name="theaddress" placeholder=""
                                    type="hidden" class="form-control block" value="<?= @$visit['theid']; ?>" />
                                <input id="avtstatus_pasien_id-catatanKeperawatan" name="status_pasien_id"
                                    placeholder="" type="hidden" class="form-control block"
                                    value="<?= @$visit['status_pasien_id']; ?>" />
                                <input id="avtisrj-catatanKeperawatan" name="isrj" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['isrj']; ?>" />
                                <input id="avtgender-catatanKeperawatan" name="gender" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['gender']; ?>" />
                                <input id="avtageyear-catatanKeperawatan" name="ageyear" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['ageyear']; ?>" />
                                <input id="avtagemonth-catatanKeperawatan" name="agemonth" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['agemonth']; ?>" />
                                <input id="avtageday-catatanKeperawatan" name="ageday" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['ageday']; ?>" />
                                <input id="avtbody_id-catatanKeperawatan" name="body_id_vt" placeholder="" type="hidden"
                                    class="form-control block" value="" />
                                <input id="avtmodified_by-catatanKeperawatan" name="modified_by" placeholder=""
                                    type="hidden" class="form-control block" value="<?= user()->username ?>" />
                                <input id="avttrans_id-catatanKeperawatan" name="trans_id" placeholder="" type="hidden"
                                    class="form-control block" value="<?= @$visit['trans_id']; ?>" />
                                <!--==new -->
                                <!-- <input id="avtvs_status_id-catatanKeperawatan" name="vs_status_id" placeholder="" type="hidden" class="form-control block" value="" /> -->
                                <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtanamnase"
                                                    class="col-xs-6 col-sm-6 col-md-3 col-form-label">(S)
                                                    Anamnesis</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control"
                                                        id="avtanamnase-catatanKeperawatan" name="anamnase"
                                                        placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <h3 id="">
                                                    <b>Vital Sign</b>
                                                </h3>
                                                <hr>
                                                <label class="col-xs-6 col-sm-6 col-md-2 col-form-label">Pemeriksaan
                                                    Fisik</label>
                                                <div class="col-xs-6 col-sm-6 col-md-10">
                                                    <div class="row mb-2">
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>BB(Kg)</label>
                                                                <div class=" position-relative">
                                                                    <input type="text" name="weight"
                                                                        id="avtweight-catatanKeperawatan" placeholder=""
                                                                        value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-bb-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Tinggi(cm)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="height"
                                                                        id="avtheight-catatanKeperawatan" placeholder=""
                                                                        value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-avtheight-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Suhu(°C)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="temperature"
                                                                        id="avttemperature-catatanKeperawatan"
                                                                        placeholder="" value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-avttemperature-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2 position-relative">
                                                            <div class="form-group">
                                                                <label>Nadi(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nadi"
                                                                        id="avtnadi-catatanKeperawatan" placeholder=""
                                                                        value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-avtnadi-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group"><label>T.Darah(mmHg)</label>
                                                                <div class="col-sm-12 "
                                                                    style="display: flex;  align-items: center;">
                                                                    <div class="position-relative">
                                                                        <input type="text" name="tension_upper"
                                                                            id="avttension_upper-catatanKeperawatan"
                                                                            placeholder="" value=""
                                                                            class="form-control vitalsignclass-catatanKeperawatan">
                                                                        <span class="h6"
                                                                            id="badge-avttension_upper-catatanKeperawatan"></span>
                                                                    </div>
                                                                    <h4 class="mx-2">/</h4>
                                                                    <div class="position-relative">
                                                                        <input type="text" name="tension_below"
                                                                            id="avttension_below-catatanKeperawatan"
                                                                            placeholder="" value=""
                                                                            class="form-control vitalsignclass-catatanKeperawatan">
                                                                        <span class="h6"
                                                                            id="badge-avttension_below-catatanKeperawatan"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Saturasi(SpO2%)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="saturasi"
                                                                        id="avtsaturasi-catatanKeperawatan"
                                                                        placeholder="" value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-avtsaturasi-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Nafas/RR(/menit)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="nafas"
                                                                        id="avtnafas-catatanKeperawatan" placeholder=""
                                                                        value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-avtnafas-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Diameter Lengan(cm)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="arm_diameter"
                                                                        id="avtarm_diameter-catatanKeperawatan"
                                                                        placeholder="" value="" class="form-control">
                                                                    <span class="h6"
                                                                        id="badge-avtarm_diameter-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Penggunaan Oksigen (L/mnt)</label>
                                                                <div class="position-relative">
                                                                    <input type="text" name="oxygen_usage"
                                                                        id="avtoxygen_usage-catatanKeperawatan"
                                                                        placeholder="" value=""
                                                                        class="form-control vitalsignclass-catatanKeperawatan">
                                                                    <span class="h6"
                                                                        id="badge-avtoxygen_usage-catatanKeperawatan"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--==new -->
                                                        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                                                            <div class="form-group">
                                                                <label>Jenis EWS</label>
                                                                <select class="form-select" name="vs_status_id"
                                                                    id="avtvs_status_id-catatanKeperawatan">
                                                                    <option selected>-- pilih --</option>
                                                                    <option value="1">Dewasa</option>
                                                                    <option value="4">Anak</option>
                                                                    <option value="5">Neonatus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--==endofnew -->
                                                        <div class="col-sm-12 mt-2">
                                                            <div class="form-group"><label>Pemeriksaan</label><textarea
                                                                    name="pemeriksaan"
                                                                    id="avtpemeriksaan-catatanKeperawatan"
                                                                    placeholder="" value=""
                                                                    class="form-control"></textarea></div>
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
                                                <label for="avtdescription"
                                                    class="col-xs-6 col-sm-6 col-md-3 col-form-label">(A)
                                                    Assesment</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtdescription"
                                                        name="description" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4" style="display: none">
                                                <label for="avtinstruction"
                                                    class="col-xs-6 col-sm-6 col-md-3 col-form-label">(P) Rencana
                                                    Penatalaksanaan</label>
                                                <div class="col-sm-10">
                                                    <textarea type="text" class="form-control" id="avtinstruction"
                                                        name="instruction" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row mt-4 mb-4">
                                                <label for="avtexamination_date"
                                                    class="col-xs-6 col-sm-6 col-md-3 col-form-label">Tanggal
                                                    Periksa</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group" id="avtexaminationdate">
                                                        <input id="avtexamination_date" name="examination_date"
                                                            type="datetime-local" class="form-control"
                                                            placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                                            data-provide="datepicker" data-date-autoclose="true"
                                                            data-date-container='#aeexaminationdate'
                                                            value="<?= date('Y-m-d'); ?>">
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
                                        <div class="form-group"><label>Perawat</label><input type="text" name="petugas"
                                                id="avtpetugas" placeholder="" value="<?= user_id(); ?>"
                                                class="form-control"></div>
                                    </div>
                                </div>
                                <span id="total_score-catatanKeperawatan"></span>
                            </div>
                            <!-- <div class="modal-footer">
                                <div class="panel-footer text-end mb-4">
                                    <button type="submit" id="formvitalsignsubmit-catatanKeperawatan"
                                        data-loading-text="<?php echo lang('Word.processing') ?>"
                                        class="btn btn-primary"><?php echo lang('Word.save'); ?></button>
                                    <button type="button" id="formvitalsignedit-catatanKeperawatan"
                                        onclick="enableVitalSign()" style="display: none;"
                                        data-loading-text="<?php echo lang('Word.processing') ?>"
                                        class="btn btn-secondary">Edit</button>
                                </div>
                            </div> -->
                        </form>
                        <!-- ----------------- -->
                    </div>
                    <div class="accordion-body" id="template-tindakan-operasi">

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThreess">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThreess" aria-expanded="false"
                        aria-controls="flush-collapseThreess">
                        CATATAN KEPERAWATAN INTRA OPERATIF
                    </button>
                </h2>
                <div id="flush-collapseThreess" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingThreess" data-bs-parent="#accordionCatatan">
                    <div class="accordion-body" id="cKeperawatanIntraOperatif">

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThrees">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThrees" aria-expanded="false"
                        aria-controls="flush-collapseThrees">
                        CATATAN KEPERAWATAN PASCA OPERASI
                    </button>
                </h2>
                <div id="flush-collapseThrees" class="accordion-collapse collapse" aria-labelledby="flush-headingThrees"
                    data-bs-parent="#accordionCatatan">
                    <div class="accordion-body">
                        <div class="row" id="cKeperawatanPascaOperatif">

                        </div>
                        <div class="row" id="cKeperawatanPascaOperatifBromage">

                        </div>
                        <div class="row" id="cKeperawatanPascaOperatifSteward">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-3 d-flex justify-content-end gap-2">
            <button type="button" id="btn-save-catatan-keperawatan"
                class="btn btn-primary btn-save-operasi">Simpan</button>
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
    $("#avtexamination_date").val(get_date())
    // setDataVitalSign()
})

$("#vitalsignTab").on("click", function() {
    getVitalSign()
})

$("#avtvs_status_id-catatanKeperawatan").on("change", function() {
    var optionSelected = $("option:selected", this);
    $('.vitalsignclass-catatanKeperawatan').each((index, each) => {
        $(each).change(element => {
            vitalsignInput({
                value: $(each).val(),
                name: $(each).attr('name'),
                uniq_name: '-catatanKeperawatan',
                type: optionSelected.val()
            })
        })
        vitalsignInput({
            value: $(each).val(),
            name: $(each).attr('name'),
            uniq_name: '-catatanKeperawatan',
            type: optionSelected.val()
        })
    });
})


function setDataVitalSign() {
    $("#formvitalsign-catatanKeperawatan").find("input, textarea").val(null)
    $("#formvitalsign-catatanKeperawatan").find("#total_score-catatanKeperawatan").html("")
    $("#formvitalsign-catatanKeperawatan").find("span.h6").html("")
    var bodyId = ''

    const date = new Date();
    bodyId = date.toISOString().substring(0, 23);
    bodyId = bodyId.replaceAll("-", "").replaceAll(":", "").replaceAll(".", "").replaceAll("T", "");
    $("#avtbody_id-catatanKeperawatan").val(bodyId)
    $("#avtclinic_id-catatanKeperawatan").val('<?= $visit['clinic_id']; ?>')
    $("#avttrans_id-catatanKeperawatan").val('<?= $visit['trans_id']; ?>')
    $("#avtclass_room_id-catatanKeperawatan").val('<?= $visit['class_room_id']; ?>')
    $("#avtbed_id-catatanKeperawatan").val()
    $("#avtkeluar_id-catatanKeperawatan").val('<?= $visit['keluar_id']; ?>')
    $("#avtemployee_id-catatanKeperawatan").val('<?= $visit['employee_id']; ?>')
    $("#avtno_registration-catatanKeperawatan").val('<?= $visit['no_registration']; ?>')
    $("#avtvisit_id-catatanKeperawatan").val('<?= $visit['visit_id']; ?>')
    $("#avtorg_unit_code-catatanKeperawatan").val('<?= $visit['org_unit_code']; ?>')
    $("#avtdoctor-catatanKeperawatan").val('<?= $visit['fullname']; ?>')
    $("#avtkal_id-catatanKeperawatan").val('<?= $visit['kal_id']; ?>')
    $("#avttheid-catatanKeperawatan").val('<?= $visit['pasien_id']; ?>')
    $("#avtthename-catatanKeperawatan").val('<?= $visit['diantar_oleh']; ?>')
    $("#avttheaddress-catatanKeperawatan").val('<?= $visit['visitor_address']; ?>')
    $("#avtstatus_pasien_id-catatanKeperawatan").val('<?= $visit['status_pasien_id']; ?>')
    $("#avtisrj-catatanKeperawatan").val('<?= $visit['isrj']; ?>')
    $("#avtgender-catatanKeperawatan").val('<?= $visit['gender']; ?>')
    $("#avtageyear-catatanKeperawatan").val('<?= $visit['ageyear']; ?>')
    $("#avtagemonth-catatanKeperawatan").val('<?= $visit['agemonth']; ?>')
    $("#avtageday-catatanKeperawatan").val('<?= $visit['ageday']; ?>')
    $("#avtexamination_date-catatanKeperawatan").val(get_date())

    //havin
    var ageYear = <?= $visit['ageyear']; ?>;
    var ageMonth = <?= $visit['agemonth']; ?>;
    var ageDay = <?= $visit['ageday']; ?>;

    if (ageYear === 0 && ageMonth === 0 && ageDay <= 28) {
        $("#avtvs_status_id-catatanKeperawatan").prop("selectedIndex", 3);
    } else if (ageYear >= 18) {
        $("#avtvs_status_id-catatanKeperawatan").prop("selectedIndex", 1);
    } else {
        $("#avtvs_status_id-catatanKeperawatan").prop("selectedIndex", 2);
    }
}

const addRowVitalSigncatatanKeperawatan = (examselect, key) => {
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

function vitalsignInputcatatanKeperawatan(prop) {
    var value = prop.value.trim();
    var name = 'avt' + prop.name + `-catatanKeperawatan`; //=new
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

        case "avtnadi-catatanKeperawatan":
            data = scoreFunction('nadi', value);
            setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
            break;
        case "avttemperature-catatanKeperawatan":
            data = scoreFunction('suhu', value);
            setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
            break;
        case "avtsaturasi-catatanKeperawatan":
            data = scoreFunction('saturasi', value);
            setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
            break;
        case "avtnafas-catatanKeperawatan":
            data = scoreFunction('pernapasan', value);
            setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
            break;
        case "avtoxygen_usage-catatanKeperawatan":
            data = scoreFunction('oksigen', value);
            setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
            break;
        case "avtweight-catatanKeperawatan":
            if (value < 10) {
                value = 10.00;
            } else if (value > 50) {
                value = 50.00;
            } else {
                value = value.toFixed(2);
            }
            break;
        case "avttension_upper-catatanKeperawatan":
            if (value < 50) {
                value = 50.00;
            } else if (value > 250) {
                value = 250.00;
            }
            data = scoreFunction('darah', value);
            setBadge(name, 'badge-' + name, 'bg-' + data.color, data.score);
            break;
        case "avtheight-catatanKeperawatan":
            if (value > 250) {
                value = 250;
            }
            break;
        case "avttension_below-catatanKeperawatan":
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

    document.getElementById('total_score-catatanKeperawatan').textContent = 'Total Skor: ' +
        sumTextContentFromClass(
            'badge-score');
}


function disableVitalSign() {
    $("#avtexamination_date-catatanKeperawatan").prop("disabled", true)
    $("#avtpetugas-catatanKeperawatan").prop("disabled", true)
    $("#avtweight-catatanKeperawatan").prop("disabled", true)
    $("#avtheight-catatanKeperawatan").prop("disabled", true)
    $("#avttemperature-catatanKeperawatan").prop("disabled", true)
    $("#avtnadi-catatanKeperawatan").prop("disabled", true)
    $("#avttension_upper-catatanKeperawatan").prop("disabled", true)
    $("#avttension_below-catatanKeperawatan").prop("disabled", true)
    $("#avtsaturasi-catatanKeperawatan").prop("disabled", true)
    $("#avtnafas-catatanKeperawatan").prop("disabled", true)
    $("#avtarm_diameter-catatanKeperawatan").prop("disabled", true)
    $("#avtanamnase-catatanKeperawatan").prop("disabled", true)
    $("#avtoxygen_usage-catatanKeperawatan").prop("disabled", true)
    $("#avtvs_status_id-catatanKeperawatan").prop("disabled", true)
    $("#avtpemeriksaan-catatanKeperawatan").prop("disabled", true)
    $("#avtteraphy_desc-catatanKeperawatan").prop("disabled", true)
    $("#avtdescription-catatanKeperawatan").prop("disabled", true)
    $("#avtclinic_id-catatanKeperawatan").prop("disabled", true)
    $("#avttrans_id-catatanKeperawatan").prop("disabled", true) //==new
    $("#avtclass_room_id-catatanKeperawatan").prop("disabled", true)
    $("#avtbed_id-catatanKeperawatan").prop("disabled", true)
    $("#avtkeluar_id-catatanKeperawatan").prop("disabled", true)
    $("#avtemployee_id-catatanKeperawatan").prop("disabled", true)
    $("#avtno_registraiton-catatanKeperawatan").prop("disabled", true)
    $("#avtvisit_id-catatanKeperawatan").prop("disabled", true)
    $("#avtorg_unit_code-catatanKeperawatan").prop("disabled", true)
    $("#avtdoctor-catatanKeperawatan").prop("disabled", true)
    $("#avtkal_id-catatanKeperawatan").prop("disabled", true)
    $("#avttheid-catatanKeperawatan").prop("disabled", true)
    $("#avtthename-catatanKeperawatan").prop("disabled", true)
    $("#avttheaddress-catatanKeperawatan").prop("disabled", true)
    $("#avtstatus_pasien_id-catatanKeperawatan").prop("disabled", true)
    $("#avtisrj-catatanKeperawatan").prop("disabled", true)
    $("#avtgender-catatanKeperawatan").prop("disabled", true)
    $("#avtageyear-catatanKeperawatan").prop("disabled", true)
    $("#avtagemonth-catatanKeperawatan").prop("disabled", true)
    $("#avtageday-catatanKeperawatan").prop("disabled", true)
    $("#avtinstruction-catatanKeperawatan").prop("disabled", true)
}

function enableVitalSign() {
    $("#avtexamination_date-catatanKeperawatan").prop("disabled", false)
    $("#avtpetugas-catatanKeperawatan").prop("disabled", false)
    $("#avtweight-catatanKeperawatan").prop("disabled", false)
    $("#avtheight-catatanKeperawatan").prop("disabled", false)
    $("#avttemperature-catatanKeperawatan").prop("disabled", false)
    $("#avtnadi-catatanKeperawatan").prop("disabled", false)
    $("#avttension_upper-catatanKeperawatan").prop("disabled", false)
    $("#avttension_below-catatanKeperawatan").prop("disabled", false)
    $("#avtsaturasi-catatanKeperawatan").prop("disabled", false)
    $("#avtnafas-catatanKeperawatan").prop("disabled", false)
    $("#avtarm_diameter-catatanKeperawatan").prop("disabled", false)
    $("#avtoxygen_usage-catatanKeperawatan").prop("disabled", false)
    $("#avtvs_status_id-catatanKeperawatan").prop("disabled", false)
    $("#avtanamnase-catatanKeperawatan").prop("disabled", false)
    $("#avtpemeriksaan-catatanKeperawatan").prop("disabled", false)
    $("#avtteraphy_desc-catatanKeperawatan").prop("disabled", false)
    $("#avtdescription-catatanKeperawatan").prop("disabled", false)
    $("#avtclinic_id-catatanKeperawatan").prop("disabled", false)
    $("#avttrans_id-catatanKeperawatan").prop("disabled", false) //==new
    $("#avtclass_room_id-catatanKeperawatan").prop("disabled", false)
    $("#avtbed_id-catatanKeperawatan").prop("disabled", false)
    $("#avtkeluar_id-catatanKeperawatan").prop("disabled", false)
    $("#avtemployee_id-catatanKeperawatan").prop("disabled", false)
    $("#avtno_registraiton-catatanKeperawatan").prop("disabled", false)
    $("#avtvisit_id-catatanKeperawatan").prop("disabled", false)
    $("#avtorg_unit_code-catatanKeperawatan").prop("disabled", false)
    $("#avtdoctor-catatanKeperawatan").prop("disabled", false)
    $("#avtkal_id-catatanKeperawatan").prop("disabled", false)
    $("#avttheid-catatanKeperawatan").prop("disabled", false)
    $("#avtthename-catatanKeperawatan").prop("disabled", false)
    $("#avttheaddress-catatanKeperawatan").prop("disabled", false)
    $("#avtstatus_pasien_id-catatanKeperawatan").prop("disabled", false)
    $("#avtisrj-catatanKeperawatan").prop("disabled", false)
    $("#avtgender-catatanKeperawatan").prop("disabled", false)
    $("#avtageyear-catatanKeperawatan").prop("disabled", false)
    $("#avtagemonth-catatanKeperawatan").prop("disabled", false)
    $("#avtageday-catatanKeperawatan").prop("disabled", false)
    $("#avtinstruction-catatanKeperawatan").prop("disabled", false)

    $("#formvitalsignsubmit-catatanKeperawatan").toggle()
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
    addRowVitalSigncatatanKeperawatan(examselect, key)
});

vitalsign.forEach((element, key) => {
    examselect = vitalsign[key];

    if (examselect.visit_id == '<?= $visit['visit_id']; ?>') {

        disableVitalSign()
        $("#formvitalsignsubmit-catatanKeperawatan").hide()
        $("#formvitalsignedit-catatanKeperawatan").show()

        $("#avtclinic_id-catatanKeperawatan").val(examselect.clinic_id)
        $("#avtclass_room_id-catatanKeperawatan").val(examselect.class_room_id)
        $("#avtbed_id-catatanKeperawatan").val(examselect.bed_id)
        $("#avtkeluar_id-catatanKeperawatan").val(examselect.keluar_id)
        $("#avtemployee_id-catatanKeperawatan").val(examselect.employee_id)
        $("#avtno_registration-catatanKeperawatan").val(examselect.no_registration)
        $("#avtvisit_id-catatanKeperawatan").val(examselect.visit_id)
        $("#avtorg_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
        $("#avtdoctor-catatanKeperawatan").val(examselect.fullname)
        $("#avtkal_id-catatanKeperawatan").val(examselect.kal_id)
        $("#avttheid-catatanKeperawatan").val(examselect.pasien_id)
        $("#avtthename-catatanKeperawatan").val(examselect.diantar_oleh)
        $("#avttheaddress-catatanKeperawatan").val(examselect.visitor_address)
        $("#avtstatus_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
        $("#avtisrj-catatanKeperawatan").val(examselect.isrj)
        $("#avtgender-catatanKeperawatan").val(examselect.gender)
        $("#avtageyear-catatanKeperawatan").val(examselect.ageyear)
        $("#avtagemonth-catatanKeperawatan").val(examselect.agemonth)
        $("#avtageday-catatanKeperawatan").val(examselect.ageday)
        $("#avtbody_id-catatanKeperawatan").val(examselect.body_id)

        $("#avtexamination_date-catatanKeperawatan").val(examselect.examination_date)
        $("#avtpetugas-catatanKeperawatan").val(examselect.petugas)
        $("#avtweight-catatanKeperawatan").val(examselect.weight)
        $("#avtheight-catatanKeperawatan").val(examselect.height)
        $("#avttemperature-catatanKeperawatan").val(examselect.temperature)
        $("#avtnadi-catatanKeperawatan").val(examselect.nadi)
        $("#avttension_upper-catatanKeperawatan").val(examselect.tension_upper)
        $("#avttension_below-catatanKeperawatan").val(examselect.tension_below)
        $("#avtsaturasi-catatanKeperawatan").val(examselect.saturasi)
        $("#avtnafas-catatanKeperawatan").val(examselect.nafas)
        $("#avtarm_diameter-catatanKeperawatan").val(examselect.arm_diameter)
        $("#avtanamnase-catatanKeperawatan").val(examselect.anamnase)
        $("#avtoxygen_usage-catatanKeperawatan").val(examselect.oxygen_usage)
        $("#avtvs_status_id-catatanKeperawatan").val(examselect.vs_status_id)
        $("#avtpemeriksaan-catatanKeperawatan").val(examselect.pemeriksaan)
        $("#avtteraphy_desc-catatanKeperawatan").val(examselect.teraphy_desc)
        $("#avtdescription-catatanKeperawatan").val(examselect.description)
        $("#avtclinic_id-catatanKeperawatan").val(examselect.clinic_id)
        $("#avttrans_id-catatanKeperawatan").val(examselect.trans_id) //==new
        $("#avtclass_room_id-catatanKeperawatan").val(examselect.class_room_id)
        $("#avtbed_id-catatanKeperawatan").val(examselect.bed_id)
        $("#avtkeluar_id-catatanKeperawatan").val(examselect.keluar_id)
        $("#avtemployee_id-catatanKeperawatan").val(examselect.employee_id)
        $("#avtno_registraiton-catatanKeperawatan").val(examselect.no_registraiton)
        $("#avtvisit_id-catatanKeperawatan").val(examselect.visit_id)
        $("#avtorg_unit_code-catatanKeperawatan").val(examselect.org_unit_code)
        $("#avtdoctor-catatanKeperawatan").val(examselect.doctor)
        $("#avtkal_id-catatanKeperawatan").val(examselect.kal_id)
        $("#avttheid-catatanKeperawatan").val(examselect.theid)
        $("#avtthename-catatanKeperawatan").val(examselect.thename)
        $("#avttheaddress-catatanKeperawatan").val(examselect.theaddress)
        $("#avtstatus_pasien_id-catatanKeperawatan").val(examselect.status_pasien_id)
        $("#avtisrj-catatanKeperawatan").val(examselect.isrj)
        $("#avtgender-catatanKeperawatan").val(examselect.gender)
        $("#avtageyear-catatanKeperawatan").val(examselect.ageyear)
        $("#avtagemonth-catatanKeperawatan").val(examselect.agemonth)
        $("#avtageday-catatanKeperawatan").val(examselect.ageday)
        $("#avtinstruction-catatanKeperawatan").val(examselect.instruction)
    }

    if (typeof $("#avtbody_id-catatanKeperawatan").val() !== 'undefined' || $(
            "#avtbody_id-catatanKeperawatan")
        .val() == "-catatanKeperawatan") {
        $("#avtclinic_id-catatanKeperawatan").val('<?= $visit['clinic_id']; ?>')
        $("#avttrans_id-catatanKeperawatan").val('<?= $visit['trans_id']; ?>') //==new
        $("#avtclass_room_id-catatanKeperawatan").val('<?= $visit['class_room_id']; ?>')
        $("#avtbed_id-catatanKeperawatan").val()
        $("#avtkeluar_id-catatanKeperawatan").val('<?= $visit['keluar_id']; ?>')
        $("#avtemployee_id-catatanKeperawatan").val('<?= $visit['employee_id']; ?>')
        $("#avtno_registration-catatanKeperawatan").val('<?= $visit['no_registration']; ?>')
        $("#avtvisit_id-catatanKeperawatan").val('<?= $visit['visit_id']; ?>')
        $("#avtorg_unit_code-catatanKeperawatan").val('<?= $visit['org_unit_code']; ?>')
        $("#avtdoctor-catatanKeperawatan").val('<?= $visit['fullname']; ?>')
        $("#avtkal_id-catatanKeperawatan").val('<?= $visit['kal_id']; ?>')
        $("#avttheid-catatanKeperawatan").val('<?= $visit['pasien_id']; ?>')
        $("#avtthename-catatanKeperawatan").val('<?= $visit['diantar_oleh']; ?>')
        $("#avttheaddress-catatanKeperawatan").val('<?= $visit['visitor_address']; ?>')
        $("#avtstatus_pasien_id-catatanKeperawatan").val('<?= $visit['status_pasien_id']; ?>')
        $("#avtisrj-catatanKeperawatan").val('<?= $visit['isrj']; ?>')
        $("#avtgender-catatanKeperawatan").val('<?= $visit['gender']; ?>')
        $("#avtageyear-catatanKeperawatan").val('<?= $visit['ageyear']; ?>')
        $("#avtagemonth-catatanKeperawatan").val('<?= $visit['agemonth']; ?>')
        $("#avtageday-catatanKeperawatan").val('<?= $visit['ageday']; ?>')


    }
});
$("#formvitalsign-catatanKeperawatan").on('submit', (function(e) {
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
                addRowVitalSigncatatanKeperawatan(examselect, key)
            });
        },
        error: function() {

        }
    });
}
</script>