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
    // $(document).ready(function() {
    //     $('#prslweight_placenta').on('input', function() {
    //         var decimalInput = $(this).val();
    //         var decimalPattern = /^[+-]?\d*\.?\d*$/;

    //         if (!decimalPattern.test(decimalInput)) {
    //             $(this).val(decimalInput.slice(0, -1)); // Remove last character if invalid
    //         }
    //     });
    // })
</script>
<script type="text/javascript">
    const getPersalinan = () => {

        // postData({
        //     'visit_id': visit.visit_id
        // }, 'admin/rm/assessment/getPersalinan', function(data) {

        //     if (data) {
        //         let persalinanData = data?.persalinan
        //         $.each(persalinanData, function(key1, value1) {
        //             $("#prsl" + key1).val(value1)
        //             $('input[type="radio"][name="' + key1 + '"][value="' + value1 + '"]').prop("checked", true)
        //             if ($("#flatprsl" + key1).length) {
        //                 $("#flatprsl" + key1).val(formatedDatetimeFlat(value1)).trigger("change")
        //             }
        //         })

        //         let examData = data?.exam

        //         $.each(examData, function(key1, value1) {
        //             $("#prslexam" + key1).val(value1).trigger("change")
        //         })

        //         babyAll = data?.baby

        //         $("#prslBayiBody").html("")
        //         $.each(babyAll, function(key, value) {
        //             addRowBayiLahir(value, key)
        //         })
        //         // console.log(babyAll)

        //         babyExamAll = data?.exambaby
        //         disablePersalinan()
        //     } else {
        //         enablePersalinan()
        //     }
        // }, () => {
        //     getLoadingscreen("contentPersalinan", "loadContentPersalinan")
        // })

        $.ajax({
            url: '<?php echo base_url(); ?>admin/rm/assessment/getPersalinan',
            type: "POST",
            data: JSON.stringify({
                'visit_id': visit.visit_id
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
                    disablePersalinan()
                } else {
                    enablePersalinan()
                }
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

        postDataForm(formData, 'admin/rm/assessment/savePersalinan', (data) => {
            if (data.status === "error") {
                let message = data.message || "An error occurred. Please try again.";
                errorSwal(message);
            } else if (data.status === "success") {
                successSwal('Data berhasil diperbarui.');

                disablePersalinan()
            }
            clicked_submit_btn.button('reset');
        }, () => {
            clicked_submit_btn.button('loading');
        })
    }));


    $("#formPersalinanCetakBtn").off().on("click", function(e) {
        openPopUpTab('<?= base_url() . '/admin/rm/keperawatan/laporan_persalinan/' . base64_encode(json_encode($visit)); ?>' + '/' + $("#prslbody_id").val())
    })

    const signPersalinanDokter = () => {
        $("#prslvalid_doctor").prop("class", "valid_user")
        $("#prslvalid_user").prop("class", "")

        $("#signvalid_date").val("valid_date")
        $("#signvalid_user").val("valid_doctor")
        $("#signvalid_pasien").val("valid_pasien")
        $("#signtombolsave").val("formPersalinanSaveBtn")
        $("#signform").val("formPersalinan")
        $("#signcontainer").val("prsl")
        $("#signdocs_type").val(12)
        $("#signsign_id").val($("#prslbody_id").val())
        $("#signuser_type").val(1).trigger("change")
        $("#signsign_ke").val(1)
        $("#signtitle").val("Laporan Persalinan Doctor")
        $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        $("#signno_registration").val("<?= $visit['no_registration']; ?>")
        $("#signdatebirth").val(null)
        $("#user_id").val("<?= user()->username; ?>")
        $("#digitalSignModal").modal("show")
        $("#password").focus()
    }
    const signPersalinaPerawat = () => {
        $("#prslvalid_doctor").prop("class", "")
        $("#prslvalid_user").prop("class", "valid_user")
        $("#signvalid_date").val("valid_date")
        $("#signvalid_user").val("valid_user")
        $("#signvalid_pasien").val("valid_pasien")
        $("#signtombolsave").val("formPersalinanSaveBtn")
        $("#signform").val("formPersalinan")
        $("#signcontainer").val("prsl")
        $("#signdocs_type").val(12)
        $("#signsign_id").val($("#prslbody_id").val())
        $("#signuser_type").val(1).trigger("change")
        $("#signsign_ke").val(2)
        $("#signtitle").val("Laporan Persalinan Doctor")
        $("#signsign_path").val('<?= user()->getFullname(); ?>: ' + get_date())
        $("#signno_registration").val("<?= $visit['no_registration']; ?>")
        $("#signdatebirth").val(null)
        $("#user_id").val("<?= user()->username; ?>")
        $("#digitalSignModal").modal("show")
        $("#password").focus()
    }
</script>

<script>
    const initiatePersalinan = () => {
        $("#formPersalinan").find("input:not([type='radio']), select, textarea").val(null);
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
        enablePersalinan()
    }
    const enablePersalinan = () => {
        $("#formPersalinanEditBtn").on("click", function(e) {
            e.preventDefault()
            $("#formPersalinan").find("input, select, textarea").prop("disabled", false)
            $("#formPersalinanSaveBtn").slideDown()
            $("#formPersalinanEditBtn").slideUp()
            $("#formPersalinanSignDoctorBtn").slideUp()
            $("#formPersalinanSignPerawatBtn").slideUp()
            $("#formPersalinanCetakBtn").slideUp()
            $("#addBayiBtn").hide()
        })
        $("#formPersalinanEditBtn").trigger("click")
    }
    const disablePersalinan = () => {
        $("#formPersalinan").find("input, select, textarea").prop("disabled", true)
        $("#formPersalinanSaveBtn").slideUp()
        if ($("#prslvalid_user").val() == '' && $("#prslvalid_doctor").val() == '') {
            $("#formPersalinanEditBtn").slideDown()
            $("#formPersalinanSignDoctorBtn").slideDown()
            $("#formPersalinanSignPerawatBtn").slideDown()
            $("#formPersalinanCetakBtn").slideDown()
            $("#addBayiBtn").show()
        } else {
            $("#formPersalinanEditBtn").slideUp()
            // $("#formPersalinanSignDoctorBtn").slideUp()
            // $("#formPersalinanSignPerawatBtn").slideUp()
            $("#formPersalinanCetakBtn").slideDown()
            $("#addBayiBtn").hide()
        }
        if ($("#prslvalid_doctor").val() != '') {
            $("#formPersalinanSignDoctorBtn").slideUp()
        } else {
            $("#formPersalinanSignDoctorBtn").slideDown()
        }
        if ($("#prslvalid_user").val() != '') {
            $("#formPersalinanSignPerawatBtn").slideUp()
        } else {
            $("#formPersalinanSignPerawatBtn").slideDown()
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
        $("#bayibirth1").val(1)
        $("#bayibirth0").val(0)
        $("#bayigender1").val(1)
        $("#bayigender3").val(3)
        $("#bayigender2").val(2)
        $("#bayigender0").val(0)
        let dpjpanak = doctors.filter(item => item.specialist_type_id == '1.04') // flatpickrInstances["flatbayidate_of_birth"].setDate(

        const selectElement = document.getElementById("bayiemployee_id");
        selectElement.innerHTML = "";
        dpjpanak.forEach(doctor => {
            const option = document.createElement("option");
            option.value = doctor.employee_id;
            option.text = doctor.fullname;
            selectElement.appendChild(option);
        });

        //     moment().format("DD/MM/YYYY HH:mm")
        // );
        // $("#flatbayidate_of_birth").trigger("change");
        $("#bayidate_of_birth").val(get_date())
        $("#bayivisit").val(`<?= base64_encode(json_encode($visit)); ?>`)
        if (babyAll == null) {
            babyAll = []
        }
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
        $("#bayidate_of_birth").val(data.date_of_birth)
        // $("#flatbayidate_of_birth").val(formatedDatetimeFlat(data.date_of_birth))
    }
    const editBayi = (flag, key) => {
        let select = babyAll[key];
        let selectexam = {};
        let dpjpanak = doctors.filter(item => item.specialist_type_id == '1.04') // flatpickrInstances["flatbayidate_of_birth"].setDate(
        const selectElement = document.getElementById("bayiemployee_id");
        selectElement.innerHTML = "";
        dpjpanak.forEach(doctor => {
            const option = document.createElement("option");
            option.value = doctor.employee_id;
            option.text = doctor.fullname;
            selectElement.appendChild(option);
        });
        $.each(babyExamAll, function(key, value) {
            // console.log(value.document_id)
            // console.log(select.baby_id)
            if (value.document_id == select.baby_id) {
                selectexam = value;
                // console.log(selectexam)
            }
        })

        $("#formBayi").find("input, select, textarea").val(null)

        // $("#bayiexamvs_status_id").val(5)
        // $("#bayibirth1").val(1)
        // $("#bayibirth0").val(0)
        // $("#bayigender1").val(1)
        // $("#bayigender0").val(0)
        // $("#bayigender2").val(2)

        $.each(select, function(key, value) {
            if (key == 'birth_con') {
                $("#bayibirth" + value).prop("checked", true)
            } else if (key == 'gender') {
                $("#bayigender" + value).prop("checked", true)
            } else {
                $("#bayi" + key).val(value)
            }
        })
        $("#bayibirth1").val(1)
        $("#bayibirth0").val(0)
        $("#bayigender1").val(1)
        $("#bayigender3").val(3)
        $("#bayigender2").val(2)
        $("#bayigender0").val(0)


        $.each(selectexam, function(key, value) {
            $("#bayiexam" + key).val(value)
        })

        $("#bayiexamweight").val(selectexam['weight'] * 1000)
        if ($("#bayiexambody_id").val() == '') {
            $("#bayiexambody_id").val(get_bodyid())
        }

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
    $("#formBayiEditBtn").on("click", function(e) {
        e.preventDefault()
        $("#formBayi").find("input, select, textarea").prop("disabled", false)
        $("#formBayiSaveBtn").slideDown()
        $("#formBayiEditBtn").slideUp()
        $("#formBayiSignBtn").slideUp()
        $("#formBayiCetakBtn").slideUp()
        $("#formBayiRegisterBtn").slideUp()
        $("#formBayiRegisterRMBtn").slideUp()
        $("#formBayi").find(".btn-edit:visible").trigger("click")
    })

    const enableBayi = () => {
        $("#formBayiEditBtn").trigger("click")
        $("#formBayi").find("input, select, textarea").prop("disabled", false)
        $("#formBayiSaveBtn").slideDown()
        $("#formBayiEditBtn").slideUp()
        $("#formBayiSignBtn").slideUp()
        $("#formBayiCetakBtn").slideUp()
        $("#formBayiRegisterBtn").slideUp()
        $("#formBayiRegisterRMBtn").slideUp()
        $("#formBayi").find(".btn-edit:visible").trigger("click")
    }
    const disableBayi = () => {
        $("#formBayiSaveBtn").slideUp()
        // $("#formBayiEditBtn").trigger("click")
        // $("#formBayi").find("input, select, textarea").prop("disabled", false)
        $("#formBayiSaveBtn").slideUp()
        $("#formBayiEditBtn").slideDown()
        $("#formBayiSignBtn").slideDown()
        $("#formBayiCetakBtn").slideDown()
        $("#formBayiRegisterBtn").slideDown()
        $("#formBayiRegisterRMBtn").slideDown()
        $("#formBayi").find(".btn-edit:visible").trigger("click")
        let bayibabyno = $("#bayibabyno").val()
        if (bayibabyno == '') {
            $("#formBayiRegisterRMBtn").slideDown()
            $("#formBayiRegisterBtn").slideUp()
        } else {
            $("#formBayiRegisterRMBtn").slideUp()
            $("#formBayiRegisterBtn").slideDown()
        }

        if ($("#bayivalid_user").val() == '') {
            $("#formBayiEditBtn").slideDown()
            $("#formBayiSignBtn").slideDown()
            $("#formBayiCetakBtn").slideDown()
        } else {
            $("#formBayiEditBtn").slideUp()
            $("#formBayiSignBtn").slideUp()
            $("#formBayiCetakBtn").slideUp()
        }
        $("#formBayi").find("input, select, textarea").prop("disabled", true)

    }

    const addRowBayiLahir = (select, key) => {
        let babybirth = '';
        if (select?.birth_con == '1') {
            babybirth = 'Hidup'
        } else {
            babybirth = 'Mati'
        }
        let babygender = '';
        if (select?.gender == '1') {
            babygender = 'Laki-laki'
        } else if (select?.gender == '2') {
            babygender = 'Perempuan'
        } else if (select?.gender == '3') {
            babygender = 'Ambigu'
        } else {
            babygender = '-'
        }
        if (select?.valid_user == '' || select?.valid_user == null) {
            $("#prslBayiBody").append("<tr>")
                .append($("<td>").html(`<b>${select?.date_of_birth}</b>`))
                .append($("<td>").html(`<b>${babybirth}</b>`))
                .append($("<td>").html(`<b>${babygender}</b>`))
                .append($("<td>").html(`<div id="" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="" type="button" onclick="editBayi(0, ` + key + `)"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="" type="button" onclick="removeBayi(' ` + select?.baby_id + ` ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>`))
            // .append($("<td>").html('<button type="button" onclick="editBayi(1, ' + key + ')" class="btn btn-warning" data-row-id="1" autocomplete="off"><i class="fa fa-edit">Edit</i></button>'))
            // .append($("<td>").html('<button type="button" onclick="removeBayi(\'' + select?.baby_id + '\')" class="btn btn-danger" data-row-id="1" autocomplete="off"><i class="fa fa-trash"></i></button>'))
        } else {
            $("#prslBayiBody").append("<tr>")
                .append($("<td>").html(`<b>${select?.date_of_birth}</b>`))
                .append($("<td>").html(`<b>${babybirth}</b>`))
                .append($("<td>").html(`<b>${babygender}</b>`))
                .append($("<td>").html(`<div id="aeditDeleteCharge' + key + '" class="btn-group-vertical" role="group" aria-label="Vertical button group"><div class="btn-group-vertical" role="group" aria-label="Vertical button group"><button id="" type="button" onclick="editBayi(0, ` + key + `)"class="btn btn-success waves-effect waves-light" data-row-id="1" autocomplete="off">Edit</button><button id="" type="button" onclick="removeBayi(' ` + select?.baby_id + ` ')" class="btn btn-danger" data-row-id="1" autocomplete="off">Hapus</button></div>`))
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

        postDataForm(formData, 'admin/rm/assessment/saveBayi', (res) => {
            if (res.status === "error") {
                let message = res.message || "An error occurred. Please try again.";
                errorSwal(message);
            } else if (res.status === "success") {
                successSwal('Data berhasil diperbarui.');
                getPersalinan()
                // var isNewDocument = 0
                // var data = res.data
                // $.each(babyAll, function(key, value) {
                //     if (value.bayi_id == data.bayi_id) {
                //         babyAll[key] = data
                //         isNewDocument = 1
                //     }
                // })
                // if (isNewDocument != 1)
                //     babyAll.push(data)

                // $("#prslBayiBody").html("")
                // $.each(babyAll, function(key, value) {
                //     addRowBayiLahir(value, key)
                // })
                disableBayi();
            }
            clicked_submit_btn.button('reset');
        }, () => {
            clicked_submit_btn.button('loading');
        })
    }));
</script>

<script>
    const registerBayi = () => {
        $("#formBayiRegisterBtn").on("click", function() {
            enableBayi()
            let formData = new FormData(document.getElementById("formBayi"));

            let btnHtml = $("#formBayiRegisterBtn").html()

            $("#formBayiRegisterBtn").html(btnLoadingHtml)

            postDataForm(formData, 'admin/rm/assessment/registerBayi', (res) => {
                if (res.status === "error") {
                    let message = res.message || "An error occurred. Please try again.";
                    errorSwal(message);
                } else if (res.status === "success") {
                    var isNewDocument = 0
                    var norm = res.data
                    $("#bayibabyno").val(norm)
                    $("#formBayiSaveBtn").trigger("click")
                    disableBayi()
                }
                $("#formBayiRegisterBtn").html(btnHtml)
            }, () => {
                $("#formBayiRegisterBtn").html(btnLoadingHtml)
            });
        })
        $("#formBayiRegisterRMBtn").on("click", function() {
            enableBayi()
            let formData = new FormData(document.getElementById("formBayi"));

            let btnHtml = $("#formBayiRegisterRMBtn").html()

            $("#formBayiRegisterRMBtn").html(btnLoadingHtml)

            postDataForm(formData, 'admin/rm/assessment/registerBayiRM', (res) => {
                if (res.status === "error") {
                    let message = res.message || "An error occurred. Please try again.";
                    errorSwal(message);
                } else if (res.status === "success") {
                    var isNewDocument = 0
                    var norm = res.data
                    $("#bayibabyno").val(norm)
                    $("#formBayiSaveBtn").trigger("click")
                    disableBayi()
                }
                $("#formBayiRegisterRMBtn").html(btnHtml)
            }, () => {
                $("#formBayiRegisterRMBtn").html(btnLoadingHtml)
            });
        })
    }
</script>