<script>
    var babyAll = [];
    var babyExamAll = [];
    $("#persalinanTab").on("click", function() {
        initiatePersalinan()
        getPersalinan()
    })
    $(document).ready(function() {
        enablePersalinan()
        enableBayi()
        registerBayi()
    })
</script>
<script>
    $(document).ready(function() {
        $('#prslweight_placenta').on('input', function() {
            var decimalInput = $(this).val();
            var decimalPattern = /^[+-]?\d*\.?\d*$/;

            if (!decimalPattern.test(decimalInput)) {
                $(this).val(decimalInput.slice(0, -1)); // Remove last character if invalid
            }
        });
    })
</script>
<script type="text/javascript">
    const getPersalinan = () => {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPersalinan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit
            }),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                getLoadingscreen("contentPersalinan", "loadContentPersalinan")
            },
            success: function(data) {

                if (data) {
                    let persalinanData = data?.persalinan
                    $.each(persalinanData, function(key1, value1) {
                        $("#prsl" + key1).val(value1)
                        $('input[type="radio"][name="' + key1 + '"][value="' + value1 + '"]').prop("checked", true)
                        if ($("#flatprsl" + key1).length) {
                            $("#flatprsl" + key1).val(formatedDatetimeFlat(value1)).trigger("change")
                        }
                    })

                    let examData = data?.exam

                    $.each(examData, function(key1, value1) {
                        $("#prslexam" + key1).val(value1).trigger("change")
                    })

                    babyAll = data?.baby

                    $("#prslBayiBody").html("")
                    $.each(babyAll, function(key, value) {
                        addRowBayiLahir(value, key)
                    })
                    // console.log(babyAll)

                    babyExamAll = data?.exambaby
                }
                disablePersalinan()
            },
            error: function(xhr) { // if error occured
                alert("Error occured.please try again");
            },
            complete: function() {}
        });
    }
    $("#formPersalinan").on('submit', (function(e) {
        e.preventDefault();
        let clicked_submit_btn = $(this).closest('form').find(':submit');

        let formData = new FormData(this);

        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/savePersalinan',
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(data) {
                if (data.status === "error") {
                    let message = data.message || "An error occurred. Please try again.";
                    errorSwal(message);
                } else if (data.status === "success") {
                    successSwal('Data berhasil diperbarui.');

                    disablePersalinan()
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                let message = xhr.statusText || "Request failed. Please try again.";
                errorSwal(message);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
</script>

<script>
    const initiatePersalinan = () => {
        $("#formPersalinan").find("input, select, textarea").val(null)
        flatpickrInstances["flatprslexamination_date"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatprslexamination_date").trigger("change");

        flatpickrInstances["flatprsltime"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatprsltime").trigger("change");

        $("#prslexamination_date").val(get_date())
        $("#prslorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#prslvisit_id").val('<?= $visit['visit_id']; ?>')
        $("#prsltrans_id").val('<?= $visit['trans_id']; ?>')
        $("#prslbody_id").val(get_bodyid())
        $("#prslno_registration").val('<?= $visit['no_registration']; ?>')
        $("#prslvs_status_id").val(10)
        $("#prslexambody_id").val(get_bodyid())
    }
    const enablePersalinan = () => {
        $("#formPersalinanEditBtn").on("click", function(e) {
            e.preventDefault()
            $("#formPersalinan").find("input, select, textarea").prop("disabled", false)
            $("#formPersalinanSaveBtn").slideDown()
            $("#formPersalinanEditBtn").slideUp()
            $("#formPersalinanSignBtn").slideUp()
            $("#formPersalinanCetakBtn").slideUp()
        })
        $("#formPersalinanEditBtn").trigger("click")
    }
    const disablePersalinan = () => {
        $("#formPersalinan").find("input, select, textarea").prop("disabled", true)
        $("#formPersalinanSaveBtn").slideUp()
        if ($("#prslvalid_user").val() == '') {
            $("#formPersalinanEditBtn").slideDown()
            $("#formPersalinanSignBtn").slideDown()
            $("#formPersalinanCetakBtn").slideDown()
        } else {
            $("#formPersalinanEditBtn").slideUp()
            $("#formPersalinanSignBtn").slideUp()
            $("#formPersalinanCetakBtn").slideUp()
        }
    }
</script>

<script>
    const initiateBayi = () => {
        $("#formBayi").find("input, select, textarea").val(null)
        $("#bayiorg_unit_code").val('<?= $visit['org_unit_code']; ?>')
        $("#bayivisit_id").val('<?= $visit['visit_id']; ?>')
        $("#bayitrans_id").val('<?= $visit['trans_id']; ?>')
        $("#bayibaby_id").val(get_bodyid())
        $("#bayidocument_id").val($("#prslbody_id").val())
        $("#bayino_registration").val('<?= $visit['no_registration']; ?>')
        $("#bayivalid_date").val(null)
        $("#bayivalid_user").val(null)
        $("#bayivalid_pasien").val(null)
        $("#bayiexamvs_status_id").val(5)
        $("#bayigender1").val(1)
        $("#bayigender0").val(0)
        $("#bayigender2").val(2)
        flatpickrInstances["flatbayidate_of_birth"].setDate(
            moment().format("DD/MM/YYYY HH:mm")
        );
        $("#flatbayidate_of_birth").trigger("change");
        $("#bayivisit").val(`<?= base64_encode(json_encode($visit)); ?>`)
        $("#bayibaby_ke").val(babyAll.length + 1)
        $("#bayiexambody_id").val(get_bodyid())
        $("#bodyApgarBayi").html("")
        $("#bodyApgarBayiAddBtn").html(`<a onclick="addApgar(1, 0, 'bayibaby_id', 'bodyApgarBayi', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah APGAR</a>`)
        enableBayi()
    }
    const fillBayi = (data) => {
        $.each(data, function(key, value) {
            $("#" + key).val(value)
        })
        $("#flatbayidate_of_birth").val(formatedDatetimeFlat(data.date_of_birth))
    }
    const editBayi = (flag, key) => {
        let select = babyAll[key];
        let selectexam = {};
        $.each(babyExamAll, function(key, value) {
            if (value.pasien_diagnosa_id == select.baby_id) {
                selectexam = value;
            }
        })

        $("#formBayi").find("input, select, textarea").val(null)

        $.each(select, function(key, value) {
            $("#bayi" + key).val(value)
            $("#bayi" + key + "" + value).prop("checked", true)
            // $('input[type="radio"][name="' + key + '"][value="' + value + '"]').prop("checked", true)
        })

        $.each(selectexam, function(key, value) {
            $("#bayiexam" + key).val(value)
        })

        $("#flatbayidate_of_birth").val(formatedDatetimeFlat(select?.date_of_birth)).trigger("change")
        $("#bayivisit").val(`<?= base64_encode(json_encode($visit)); ?>`)

        $("#bodyApgarBayi").html("")
        $("#bodyApgarBayiAddBtn").html(`<a onclick="addApgar(1, 0, 'bayibaby_id', 'bodyApgarBayi', false)" class="btn btn-primary btn-lg btn-to-hide" style="width: 300px"><i class=" fa fa-plus"></i> Tambah APGAR</a>`)

        getApgar(select.baby_id, "bodyApgarBayi")


        if (flag == 1) {
            enableBayi()
        } else {
            disableBayi()
        }
        $("#persalinanModal").modal("show")


    }
    const enableBayi = () => {
        $("#formBayiEditBtn").on("click", function(e) {
            e.preventDefault()
            $("#formBayi").find("input, select, textarea").prop("disabled", false)
            $("#formBayiSaveBtn").slideDown()
            $("#formBayiEditBtn").slideUp()
            $("#formBayiSignBtn").slideUp()
            $("#formBayiCetakBtn").slideUp()
            $("#formBayi").find(".btn-edit:visible").trigger("click")
        })
        $("#formBayiEditBtn").trigger("click")
    }
    const disableBayi = () => {
        $("#formBayi").find("input, select, textarea").prop("disabled", true)
        $("#formBayiSaveBtn").slideUp()
        if ($("#bayivalid_user").val() == '') {
            $("#formBayiEditBtn").slideDown()
            $("#formBayiSignBtn").slideDown()
            $("#formBayiCetakBtn").slideDown()
        } else {
            $("#formBayiEditBtn").slideUp()
            $("#formBayiSignBtn").slideUp()
            $("#formBayiCetakBtn").slideUp()
        }
    }

    const addRowBayiLahir = (select, key) => {
        let babybirth = '';
        if (select?.birth == '1') {
            babybirth = 'Hidup'
        } else {
            babybirth = 'Mati'
        }
        let babygender = '';
        if (select?.babygender == '1') {
            babygender = 'Laki-laki'
        } else {
            babygender = 'Perempuan'
        }
        if (select?.valid_user == '' || select?.valid_user == null) {
            $("#prslBayiBody").append("<tr>")
                .append($("<td>").html(`<b>${select?.date_of_birth}</b>`))
                .append($("<td>").html(`<b>${babybirth}</b>`))
                .append($("<td>").html(`<b>${babygender}</b>`))
                .append($("<td>").html(`<div id="" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="" type="button" onclick="editBayi(1, ` + key + `)"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="" type="button" onclick="removeBayi(' ` + select?.baby_id + ` ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>`))
            // .append($("<td>").html('<button type="button" onclick="editBayi(1, ' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            // .append($("<td>").html('<button type="button" onclick="removeBayi(\'' + select?.baby_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        } else {
            $("#prslBayiBody").append("<tr>")
                .append($("<td>").html(`<b>${select?.date_of_birth}</b>`))
                .append($("<td>").html(`<b>${babybirth}</b>`))
                .append($("<td>").html(`<b>${babygender}</b>`))
                .append($("<td>").html(`<div id="aeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="" type="button" onclick="editBayi(1, ` + key + `)"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="" type="button" onclick="removeBayi(' ` + select?.baby_id + ` ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>`))
            // .append($("<td>").html('<button type="button" onclick="editBayi(0, ' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            // .append($("<td>").html('<button type="button" onclick="removeBayi(\'' + select?.baby_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        }
    }

    const addWaktuLahir = () => {
        initiateBayi()
        $("#persalinanModal").modal("show")
    }

    $("#formBayiSaveBtn").on('click', (function(e) {
        e.preventDefault();

        $("#formBayi").find(".btn-save:visible").trigger("click")

        let clicked_submit_btn = $(this).closest('form').find(':submit');

        let formData = new FormData(document.getElementById("formBayi"));

        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/saveBayi',
            type: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                clicked_submit_btn.button('loading');
            },
            success: function(res) {
                if (res.status === "error") {
                    let message = res.message || "An error occurred. Please try again.";
                    errorSwal(message);
                } else if (res.status === "success") {
                    successSwal('Data berhasil diperbarui.');
                    var isNewDocument = 0
                    var data = res.data
                    $.each(babyAll, function(key, value) {
                        if (value.bayi_id == data.bayi_id) {
                            babyAll[key] = data
                            isNewDocument = 1
                        }
                    })
                    if (isNewDocument != 1)
                        babyAll.push(data)

                    $("#prslBayiBody").html("")
                    $.each(babyAll, function(key, value) {
                        addRowBayiLahir(value, key)
                    })
                    disableBayi();
                }
                clicked_submit_btn.button('reset');
            },
            error: function(xhr) { // if error occured
                let message = xhr.statusText || "Request failed. Please try again.";
                errorSwal(message);
            },
            complete: function() {
                clicked_submit_btn.button('reset');
            }
        });
    }));
</script>

<script>
    const registerBayi = () => {
        $("#formBayiRegisterBtn").on("click", function() {
            let formData = new FormData(document.getElementById("formBayi"));

            let btnHtml = $("#formBayiRegisterBtn").html()

            $.ajax({
                url: '<?php echo base_url(); ?>admin/rm/assessment/registerBayi',
                type: "POST",
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#formBayiRegisterBtn").html(btnLoadingHtml)
                },
                success: function(res) {
                    if (res.status === "error") {
                        let message = res.message || "An error occurred. Please try again.";
                        errorSwal(message);
                    } else if (res.status === "success") {
                        successSwal('Data berhasil diperbarui.');
                        var isNewDocument = 0
                        var data = res.data
                        $.each(babyAll, function(key, value) {
                            if (value.bayi_id == data.bayi_id) {
                                babyAll[key] = data
                                isNewDocument = 1
                            }
                        })
                        if (isNewDocument != 1)
                            babyAll.push(data)

                        $("#prslBayiBody").html("")
                        $.each(babyAll, function(key, value) {
                            addRowBayiLahir(value, key)
                        })
                        disableBayi();
                    }
                    $("#formBayiRegisterBtn").html(btnHtml)
                },
                error: function(xhr) { // if error occured
                    let message = xhr.statusText || "Request failed. Please try again.";
                    errorSwal(message);
                },
                complete: function() {
                    $("#formBayiRegisterBtn").html(btnHtml)
                }
            });
        })
    }
</script>